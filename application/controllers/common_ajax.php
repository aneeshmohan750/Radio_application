<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_ajax extends CI_Controller {

 public function __construct()
 {
   parent::__construct();
   $this->load->model(array('master_model'));
   $this->load->helper('cookie');
  
 }

 public function verifylogin()
 {
        $this->mcontents = array();
        if (!empty($_POST)) {
		    $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->_init_login_validation_rules(); //server side validation of input values
            if ($this->form_validation->run() == FALSE) {// form validation
                $arr = array('status' =>'failed','message'=>'Invalid Username or Password');
            } else {
			    $this->_init_login_details(); 
                $login_details['username'] = $this->input->post("username");
                $login_details['password'] = $this->input->post("password");
				
                if ($this->authentication->process_user_login($login_details) == 'success') {
				  
                   $arr = array('status' =>'success');
                } else if ($this->authentication->process_user_login($login_details) == 'inactive') {
                   $arr = array('status' =>'failed','message'=>'Your account is inactivated');
                } else {
                    sf('error_message', 'Invalid Username or Password');
                    $arr = array('status' =>'failed','message'=>'Invalid Username or Password');
                }
            }
		 echo json_encode($arr); 
	     exit;	
        }
   
 }
 
 public function submitcontact()
 { 
         
		   $session_data = $this->session->userdata('logged_in');
		   $data = array (
					'name' => $this->input->post('nameForm'),
					'email' => $this->input->post('emailForm'),
					'message' => $this->input->post('messageForm'),
					'user_id' => $session_data['USERID'],
					'company_id' =>$session_data['COMPANY'],
					'submit_date' => date("Y-m-d H:m:s"),   
			  );
			   $this->load->library('phpmailer');
	 $this->load->library('smtp');
			  $contact_details = $this->common_model->save("feedback",$data);			  
			  if($contact_details){			  
				    $feedback_mail = $this->common_model->get_company_feedback_mail($session_data['COMPANY']);
				    $to= $feedback_mail;
				  
				    $subject = "Radio Feedback";
				    $message = "<font face='Arial' size='2'>A visitor to the website has submitted the feedback. Details are as follows; <br><br>";
				    $message .="<b>Name: </b>".$this->input->post('nameForm')."<br><br>"; 
				    $message .="<b>Email: </b>".$this->input->post('emailForm')."<br><br>";
				    $message .="<b>Subject: </b>".$subject."<br><br>";
				    $message .="<b>Message: </b>";
				    $message .=$this->input->post('messageForm')."<br /><br>";
				    $message .="Best Regards,<br />";
				    $message .="Webmaster<br><br></font>";				  
			
				    $mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->CharSet = 'UTF-8';
					
					$mail->Host       = "smtp.gmail.com"; // SMTP server example
					//$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
					$mail->SMTPAuth   = true;                  // enable SMTP authentication
					$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
					$mail->Username   = "webmaster@timbremedia.in"; // SMTP account username example
					$mail->Password   = "Welcome@123!";        // SMTP account password example
					
					$mail->From = 'webmaster@timbremedia.in';
					$mail->FromName = 'Timbremedia Webmaster';
					
					$mail->AddAddress($to); 
					$mail->AddReplyTo('webmaster@timbremedia.in', 'Webmaster');
					
					$mail->IsHTML(true);
					
					$mail->Subject = $subject;
					
					$mail->Body    =  $message;
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
					
					$mail->Send();

				    $to = $this->input->post('emailForm');	   
				    $subject = "Radio Feedback";
				    $message = "<font face='Arial' size='2'>Dear ".$this->input->post('nameForm').",<br /><br />";
				    $message .="Thank you for the feedback. We will get back to you soon.<br /><br /><br />";
				    $message .="Best Regards,<br />";
				    $message .="Timbremedia</font>";
				  
				
				    $mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->CharSet = 'UTF-8';
					
					$mail->Host       = "smtp.gmail.com"; // SMTP server example
					//$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
					$mail->SMTPAuth   = true;                  // enable SMTP authentication
					$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
					$mail->Username   = "webmaster@timbremedia.in"; // SMTP account username example
					$mail->Password   = "Welcome@123!";        // SMTP account password example
					
					$mail->From = 'webmaster@timbremedia.in';
					$mail->FromName = 'Timbremedia Webmaster';
					
					$mail->AddAddress($to, 'Information'); 
					$mail->AddReplyTo('webmaster@timbremedia.in', 'Webmaster');
					
					$mail->IsHTML(true);
					
					$mail->Subject = $subject;
					
					$mail->Body    =  $message;
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
					
					$mail->Send();
				
				
				    $output=json_encode(array("success"=>"yes"));
				    echo $output;
				    exit;
				
			  }
			  
			  else{
				
				  $output=json_encode(array("success"=>"no"));
				  echo $output;
				  exit;
				
			  }
		 						 
  
 }
 
 
 
  public function record_log(){
	  
	 $data = array (
					'track_id' => $this->input->post('track_id'),
					'user_id' => $this->input->post('user_id'),
					'listen_date' => date("Y-m-d H:m:s"),   
			  );
	$user_log = $this->common_model->get_data('track_user_log','id',array("track_id"=>$this->input->post('track_id'),"user_id"=>$this->input->post('user_id')));
	if(!$user_log){			
	  $this->common_model->save('track_user_log',$data);
	}
	
	$arr=array("status"=>"success");			  
    echo json_encode($arr);			  
	exit;
	  
  }
  
  public function forget_password()
 {
  
   if($_POST)
   {
     $email_id=$this->input->post('email');
     $reset_password_code= $this->rand_string(20);
     $result=$this->common_model->check_mail($email_id);
     if($result==true){
	       $data = array('reset_password_code' =>$reset_password_code);
		    $to = $email_id;
		   //$to='aneeshmohan750@gmail.com';	   
           $subject = "Password Reset";
     
	       $message = "<font face='Arial' size='2'>Dear Member,<br /><br />We have received a password reset request for your legitimate access to corporate radio. As we do not send passwords by email, we would suggest you to click on the below link and reset the password to one that is convenient and which you can memorise.  Please note that this link can be used only once. <br /><br />";
           $message .="<a href='".base_url()."resetpassword/".$reset_password_code."'><img src='".base_url()."assets/images/clickhere.jpg' /></a><br /><br />";
	 
           $this->load->library('phpmailer');
	       $this->load->library('smtp');
	       $mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->CharSet = 'UTF-8';
			
			$mail->Host       = "smtp.gmail.com"; // SMTP server example
			//$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
			$mail->Username   = "webmaster@timbremedia.in"; // SMTP account username example
			$mail->Password   = "Welcome@123!";        // SMTP account password example
			
			$mail->From = 'webmaster@timbremedia.in';
			$mail->FromName = 'Timbremedia Webmaster';
			
			$mail->AddAddress($to); 
			$mail->AddReplyTo('webmaster@timbremedia.in', 'Wale');
			
			$mail->IsHTML(true);
			
			$mail->Subject = $subject;
			
			$mail->Body    =  $message;
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			
			$mail->Send();
	
 
		    $this->common_model->forget_password_update($data,$email_id);
		    $arr = array('status' =>'success');
            echo json_encode($arr); 
	        exit;
	 }
	 else
	 {
	     $arr = array('status' =>'auth_failed');
         echo json_encode($arr); 
	     exit;
	 
	 } 
   
   }

 }
 
  public function reset_password()
 {
  
   if($_POST)
   {
     $password=$this->input->post('password');
     $user_id= $this->input->post('user_id');
	 $query = $this->db->query("UPDATE users SET password = LEFT(MD5(CONCAT(MD5('$password'), 'cloud')), 50),
	                                             reset_password_code='' 
						                      WHERE id=".$user_id."");
	 $arr = array('status' =>'success');
     echo json_encode($arr); 
	 exit;										  
	 
   }
 
 }
 
 public function poll(){
  
  if($_POST)
   {
     $session_data = $this->session->userdata('logged_in');
	 $user_id = $session_data['USERID'];
	 $data = array (
					'poll_question_id' => $this->input->post('poll_question_id'),
					'poll_answer' => $this->input->post('option'),
					'user_id' => $user_id,
					'ip_address' => $_SERVER['REMOTE_ADDR'],
					'voted_at' => date("Y-m-d H:m:s"),   
			  );
				
	  $poll_details = $this->common_model->save('poll_answers',$data);
			
	  $cookie = array(
        'name'   => 'poll_submitted',
        'value'  => '1',
        'expire' => time()+54000,
        );
    set_cookie($cookie);
			
	if($poll_details){
				  $arr=array("status"=>"success");			  
	 }
	else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
	 }
	 $arr = array('status' =>'success');
     echo json_encode($arr); 
	 exit;										  
	 
   }	 
	 
 
 
 }
  
  public function activedirectorylogin(){
	  
    define('DOMAIN_FQDN', 'TIMBREMEDIA.IN');
   define('LDAP_SERVER', 'adfsdfsdfsdfd');
    $user = strip_tags($this->input->post('username')) .'@'. DOMAIN_FQDN;
    $pass = stripslashes($this->input->post('password'));

    $ldaphost = "ldaps://ldap.gcjgchgc.com/";

// Connecting to LDAP
$conn = ldap_connect($ldaphost)
          or die("Could not connect to {$ldaphost}");
     
	 echo $conn;
	 exit;
	 
    if (!$conn)
        $err = 'Could not connect to LDAP server';

    else
    {
		
        define('LDAP_OPT_DIAGNOSTIC_MESSAGE', 0x0032);

        ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);

        $bind = @ldap_bind($conn, $user, $pass);
        echo $bind;
		exit;
        ldap_get_option($conn, LDAP_OPT_DIAGNOSTIC_MESSAGE, $extended_error);
		
        
        if (!empty($extended_error))
        {
			 echo  $extended_error;
			 exit;
            $errno = explode(',', $extended_error);
            $errno = $errno[2];
            $errno = explode(' ', $errno);
            $errno = $errno[2];
            $errno = intval($errno);

            if ($errno == 532)
                $err = 'Unable to login: Password expired';
        }

        elseif ($bind)
        {
            $base_dn = array("CN=Users,DC=". join(',DC=', explode('.', DOMAIN_FQDN)), 
                "OU=Users,OU=People,DC=". join(',DC=', explode('.', DOMAIN_FQDN)));
            echo "asdasd";
			exit;
            $result = ldap_search(array($conn,$conn), $base_dn, "(cn=*)");
            
            
                foreach ($result as $res)
                {
				   
                    $info = ldap_get_entries($conn, $res);
                    print_r($info);
					exit;
                    for ($i = 0; $i < $info['count']; $i++)
                    {
					 
                        if (isset($info[$i]['userprincipalname']) AND strtolower($info[$i]['userprincipalname'][0]) == strtolower($user))
                        {
                            session_start();

                            $username = explode('@', $user);
                            $_SESSION['foo'] = 'bar';

                            // set session variables...

                            break;
                        }
                    }
                }
            
        }
    }
   
    // session OK, redirect to home page
    if (isset($_SESSION['foo']))
    {
        header('Location: /');
        exit();
    }

   // elseif (!isset($err)) $err = 'Unable to login: '. ldap_error($conn);

    ldap_close($conn);

  
  }
  
  public function rand_string($length) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($chars),0,$length);

    }	
 
 /**
     * validating the form elemnets
     */
  public function _init_login_validation_rules() {
        $this->form_validation->set_rules('username', 'username', 'required|max_length[50]');
        $this->form_validation->set_rules('password', 'password', 'required|max_length[20]');
    }

  public function _init_login_details() {
        $this->username = $this->common_model->safe_html($this->input->post("username"));
        $this->password = $this->common_model->safe_html($this->input->post("password"));
    }
	

 
}
?>