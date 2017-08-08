<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom_ajax extends CI_Controller {

 public function __construct()
 {
   parent::__construct();
   $this->load->model(array('master_model'));
  
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
                $login_details['username'] = $this->username;
                $login_details['password'] = $this->password;
                if ($this->authentication->process_admin_login($login_details) == 'success') {
                   $arr = array('status' =>'success');
                } else if ($this->authentication->process_admin_login($login_details) == 'inactive') {
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
 
 public function create_company()
 {
        $arr = array();
		$auth_code='';
        if (!empty($_POST)) {
			$company_url = preg_replace('/\s+/', '', $this->input->post('company_name'));
			if($this->input->post('active_single_login')){
			  $auth_code=$this->rand_string(6);
			}
		    $data = array (
					'name' => $this->input->post('company_name'),
					'location' => $this->input->post('location'),
					'logo' => $this->input->post('uploaded_logo'),
					'radio_logo'=>$this->input->post('uploaded_logo_radio'),
					'page_banner' => $this->input->post('uploaded_banner'),
					'radio_name' => $this->input->post('radio_name'),
					'email'  => $this->input->post('email'),
					'active_directory' => $this->input->post('active_directory_login'),
					'domain_fqdn' => $this->input->post('domain_fqdn'),
					'ldap_server' => $this->input->post('ldap_server'),
					'enable_news' => $this->input->post('enable_news'),
					'favicon' => $this->input->post('uploaded_favicon'),
					'common_url_login' => trim($this->input->post('active_single_login')),
					'company_auth_code'=>$auth_code,
					'enable_radio_logo' => $this->input->post('enable_radio_logo'),
					'company_url' => $company_url,
					'radio_access' => $this->input->post('radio_access'),
					'footer_line' => $this->input->post('footer_line'),
					'page_title' => $this->input->post('page_title'),
					'status' =>1,
					'create_date' => date("Y-m-d H:m:s"),   
			  );
				
			$company_details = $this->common_model->save('company',$data);
			
			if($this->input->post('radio_access')=='custom'){
			  
			  if($this->input->post('ip_address')){
				
				$ip_address_list = $this->input->post('ip_address');
				
				foreach($ip_address_list as $ip_address){
				  if($ip_address){
					  
					  $data = array ("company_id"=>	$company_details,
									 "ip_address" => $ip_address,
									 "status" =>1);
					  $company_allowed_ip = $this->common_model->save('company_allowed_ip',$data);
				  }
					
				}
				  				  
			  }
			
			}
			
			if($this->input->post('active_single_login')){
				$password='demo_'.$company_url.'';
				$query = $this->db->query("INSERT INTO users
											 SET first_name='Demo',
											 last_name='".$this->input->post('company_name')."',
											 username='demo_".$company_url."',
											 email='".$this->input->post('email')."',
											 password = LEFT(MD5(CONCAT(MD5('$password'), 'cloud')), 50),
											 company_id='".$company_details."',
											 auth_token='".$auth_code."',
											 status=1,
											 created_at='".date("Y-m-d H:m:s")."'");
			}
			
			if($company_details){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function edit_company()
 {
        $arr = array();
        if (!empty($_POST)) {
			$company_url = preg_replace('/\s+/', '', $this->input->post('company_url'));
			$company_id = $this->input->post('company_id');
		    $data = array (
					'name' => $this->input->post('company_name'),
					'location' => $this->input->post('location'),
					'logo' => $this->input->post('uploaded_logo'),
					'radio_logo'=>$this->input->post('uploaded_logo_radio'),
					'page_banner' => $this->input->post('uploaded_banner'),
					'radio_name' => $this->input->post('radio_name'),
					'email'  => $this->input->post('email'),
					'active_directory' => $this->input->post('active_directory_login'),
					'enable_news' => $this->input->post('enable_news'),
					'favicon' => $this->input->post('uploaded_favicon'),
					'domain_fqdn' => $this->input->post('domain_fqdn'),
					'ldap_server' => $this->input->post('ldap_server'),
					'common_url_login' => $this->input->post('active_single_login'),
					'enable_radio_logo' => $this->input->post('enable_radio_logo'),
					'company_url' => $company_url,
					'radio_access' => $this->input->post('radio_access'),
					'footer_line' => $this->input->post('footer_line'),
					'page_title' => $this->input->post('page_title'),
					'welcome_mail' => $this->input->post('mail_format')
			  );
				
			$company_details = $this->common_model->update('company',$data,array("id"=>$company_id));
			
			if($this->input->post('radio_access')=='custom'){
			  
			  if($this->input->post('ip_address')){

				$this->common_model->delete('company_allowed_ip',array('company_id'=>$company_id));
				
				$ip_address_list = $this->input->post('ip_address');
				
				foreach($ip_address_list as $ip_address){
				  if($ip_address){
					  
					  $data = array ("company_id"=>	$company_id,
									 "ip_address" => $ip_address,
									 "status" =>1);
					  $company_allowed_ip = $this->common_model->save('company_allowed_ip',$data);
				  }
					
				}
				  				  
			  }
			
			}
			
			if($company_details){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function create_user()
 {
        $arr = array();
        if (!empty($_POST)) {
			$user_details = $this->common_model->get_data('users','id',array("email"=>$this->input->post('email'),"company_id"=>$this->input->post('company_id')));
			if($user_details){
			   $arr=array("status"=>"email_exist");
			   echo json_encode($arr);			  
	           exit;	
			}
		    $password=$this->input->post('confirm_password');		
			$query = $this->db->query("INSERT INTO users
			                             SET first_name='".$this->input->post('first_name')."',
										 last_name='".$this->input->post('last_name')."',
										 username='".$this->input->post('username')."',
										 email='".$this->input->post('email')."',
										 password = LEFT(MD5(CONCAT(MD5('$password'), 'cloud')), 50),
										 company_id='".$this->input->post('company_id')."',
										 status=1,
										 created_at='".date("Y-m-d H:m:s")."'");
			
				
			$users_details =$this->db->insert_id();
			if($this->input->post('email'))	
			  $this->send_welcome_mail($users_details,$this->input->post('company_id'),$this->input->post('email'));
			if($users_details){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function edit_user()
 {
        $arr = array();
        if (!empty($_POST)) {
			$user_id = $this->input->post('user_id');
			$user_details = $this->common_model->get_data('users','id',array("email"=>$this->input->post('email'),"company_id"=>$this->input->post('company_id'),"id !=" => "$user_id"));
			if($user_details){
			   $arr=array("status"=>"email_exist");
			   echo json_encode($arr);			  
	           exit;	
			}
		    $query = $this->db->query("UPDATE users
			                             SET first_name='".$this->input->post('first_name')."',
										 last_name='".$this->input->post('last_name')."',
										 username='".$this->input->post('username')."',
										 email='".$this->input->post('email')."',
										 company_id='".$this->input->post('company_id')."'
										 WHERE id='".$this->input->post('user_id')."'
										 ");
			
		    $arr=array("status"=>"success");			  
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function create_track()
 {
        $arr = array();
        if (!empty($_POST)) {
		    $data = array (
					'name' => $this->input->post('track_name'),
					'description' => $this->input->post('track_description'),
					'detail_description' => $this->input->post('track_detail_description'),
					'track_type' => $this->input->post('track_type'),
					'audio_src' => trim($this->input->post('track_url')),
					'protocol_type' => $this->input->post('protocol_type'),
					'duration' => $this->input->post('track_duration'),
					'keywords' => $this->input->post('keywords'),
					'status' =>1,
					'create_date' => date("Y-m-d H:m:s"),   
			  );
				
			$track_details = $this->common_model->save('tracks',$data);
			
			$category_list=$this->input->post('track_category_id');
			if($category_list){
				
				foreach($category_list as $category){
				   $data =array(
					   'track_id' =>  $track_details,
					   'category_id' => $category
				   );
				   $this->common_model->save('track_category_rel',$data);	
				}
			}
			if($track_details){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function edit_track()
 {
        $arr = array();
		$track_cat_rel = array();
        if (!empty($_POST)) {
			/*$mp3file = new MP3File($this->input->post('track_url'));
			$duration1 = $mp3file->getDurationEstimate();//(faster) for CBR only
$duration2 = $mp3file->getDuration();//(slower) for VBR (or CBR)
echo "duration: $duration1 seconds"."\n";
echo "estimate: $duration2 seconds"."\n";*/
		    $data = array (
					'name' => $this->input->post('track_name'),
					'description' => $this->input->post('track_description'),
					'detail_description' => $this->input->post('track_detail_description'),
					'duration' => $this->input->post('track_duration'),
					'track_type' => $this->input->post('track_type'),
					'protocol_type' => $this->input->post('protocol_type'),
					'audio_src' => trim($this->input->post('track_url')),
					'keywords' => $this->input->post('keywords')					
			  );				
			$track_details = $this->common_model->update('tracks',$data,array("id"=>$this->input->post('track_id')));
			
			$category_list=$this->input->post('track_category_id');
			
			if($category_list){
				foreach($category_list as $category){
				   $data =array(
					   'track_id' =>  $this->input->post('track_id'),
					   'category_id' => $category
				   );
				   $track_cat_rel=$this->common_model->get_data('track_category_rel','*',array('track_id'=>$this->input->post('track_id'),'category_id' => $category));
				   if(!$track_cat_rel){
					 $this->common_model->save('track_category_rel',$data);	
				   }
				}
			}
			if($track_details){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function create_assign_track()
 {
        $arr = array();
		if($this->input->post('heighlight')==1){
		  $heighlights=$this->common_model->get_data('assign_tracks','*',array('company_id'=>$this->input->post('company_id'),'heighlight'=>1));
		  if($heighlights==4){
			 $arr=array("status"=>"limit_reached");
			 echo json_encode($arr);			  
	         exit;	  
		  }
		}
		if($this->input->post('track_type')=='Live'){
		  $live_tracks=$this->common_model->get_data('assign_tracks','*',array('company_id'=>$this->input->post('company_id'),'type'=>'Live'));
		  if($live_tracks==1){
			 $arr=array("status"=>"live_track_set");
			 echo json_encode($arr);			  
	         exit;	  
		  }
		}
        if (!empty($_POST)) {
		    $data = array (
					'track_id' => $this->input->post('track_id'),
					'company_id' => $this->input->post('company_id'),
					'heighlight' => $this->input->post('heighlight'),
					'disable_download' => $this->input->post('disable_download'),
					'type' => $this->input->post('track_type'),
					'track_image' => $this->input->post('uploaded_track_image'),
					'date' => $this->input->post('date'),
					'status' =>1,
					'create_date' => date("Y-m-d H:m:s"),   
			  );
				
			$track_details = $this->common_model->save('assign_tracks',$data);
			
			if($track_details){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function edit_assign_track()
 {
        $arr = array();
		if($this->input->post('heighlight')==1){
		  $assign_track_id=$this->input->post('assign_track_id');	
		 
		  $heighlights=$this->common_model->get_data('assign_tracks','*',
		  array('company_id'=>$this->input->post('company_id'),'heighlight'=>1,'id !=' => '$assign_track_id'));
		  if(sizeof($heighlights)==4){
			 $arr=array("status"=>"limit_reached");
			 echo json_encode($arr);			  
	         exit;	  
		  }
		}
		if($this->input->post('track_type')=='Live'){
		  $live_tracks=$this->common_model->get_data('assign_tracks','*',
		  array('company_id'=>$this->input->post('company_id'),'type'=>'Live','id !=' => '$assign_track_id'));
		  if(sizeof($live_tracks)==1){
			 $arr=array("status"=>"live_track_set");
			 echo json_encode($arr);			  
	         exit;	  
		  }
		}
        if (!empty($_POST)) {
		    $data = array (
					'track_id' => $this->input->post('track_id'),
					'company_id' => $this->input->post('company_id'),
					'heighlight' => $this->input->post('heighlight'),
					'disable_download' => $this->input->post('disable_download'),
					'type' => $this->input->post('track_type'),
					'track_image' => $this->input->post('uploaded_track_image'),
					'date' => $this->input->post('date')						
			  );				
			$track_details = $this->common_model->update('assign_tracks',$data,array("id"=>$this->input->post('assign_track_id')));			
			if($track_details){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function create_news()
 {
        $arr = array();
        if (!empty($_POST)) {
		    $data = array (
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'image' => $this->input->post('uploaded_news_image'),
					'date' => $this->input->post('date'),
					'status' =>1
			  );
				
			$news = $this->common_model->save('news',$data);
			
			$company_list=$this->input->post('company_id');
			
			foreach($company_list as $company){
			   $data =array(
			       'news_id' =>  $news,
				   'company_id' => $company
			   );
			   $company_news_rel=$this->common_model->get_data('company_news_rel','*',array('news_id'=>$news,'company_id' => $company));
			   if(!$company_news_rel){
			     $this->common_model->save('company_news_rel',$data);	
			   }
			}	
			
			if($news){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function edit_news()
 {
        $arr = array();
        if (!empty($_POST)) {
		    $data = array (
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'image' => $this->input->post('uploaded_news_image'),
					'date' => $this->input->post('date')						
			  );				
			$news_details = $this->common_model->update('news',$data,array("id"=>$this->input->post('news_id')));
			
			$company_list=$this->input->post('company_id');
			
			$this->common_model->delete('company_news_rel',array("news_id"=>$this->input->post('news_id')));
			
			foreach($company_list as $company){
			   $data =array(
			       'news_id' =>  $this->input->post('news_id'),
				   'company_id' => $company
			   );
			   $company_news_rel=$this->common_model->get_data('company_news_rel','*',array('news_id'=>$this->input->post('news_id'),'company_id' => $company));
			   if(!$company_news_rel){
			     $this->common_model->save('company_news_rel',$data);	
			   }
			}	
						
			if($news_details){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function create_track_category()
 {
        $arr = array();
        if (!empty($_POST)) {
		    $data = array (
					'name' => $this->input->post('name'),
					'status' =>1
			  );
				
			$track_category = $this->common_model->save('track_category',$data);
			
			if($track_category){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function edit_track_category()
 {
        $arr = array();
        if (!empty($_POST)) {
		    $data = array (
					'name' => $this->input->post('name'),						
			  );				
			$track_category = $this->common_model->update('track_category',$data,array("id"=>$this->input->post('track_category_id')));			
			if($track_category){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function create_poll()
 {
        $arr = array();
        if (!empty($_POST)) {
			
			/*if($this->input->post('active')==1){
			   $polls = $this->common_model->get_data('polls','id',array("status"=>1));
			   if(sizeof($polls)!=0){
				   $arr=array("status"=>"active_poll_exist");			  
				  echo json_encode($arr);			  
				  exit;   
			   }
			}*/
		    $data = array (
					'poll_question' => $this->input->post('poll_question'),
					'option1' => $this->input->post('poll_answer1'),
					'option2' => $this->input->post('poll_answer2'),
					'option3' => $this->input->post('poll_answer3'),
					'option4' => $this->input->post('poll_answer4'),
					'company_id' => $this->input->post('company_id'),
					'status' => $this->input->post('active')
			  );
				
			$polls = $this->common_model->save('polls',$data);
			
			if($polls){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function edit_poll()
 {
        if (!empty($_POST)) {
			
			$poll_id= $this->input->post('poll_id');
			/*if($this->input->post('active')==1){
			   $polls = $this->common_model->get_data('polls','id',array("status"=>1,"id !=" => "$poll_id"));
			   if(sizeof($polls)!=0){
				   $arr=array("status"=>"active_poll_exist");			  
				  echo json_encode($arr);			  
				  exit;   
			   }
			}*/
		    $data = array (
					'poll_question' => $this->input->post('poll_question'),
					'option1' => $this->input->post('poll_answer1'),
					'option2' => $this->input->post('poll_answer2'),
					'option3' => $this->input->post('poll_answer3'),
					'option4' => $this->input->post('poll_answer4'),
					'company_id' => $this->input->post('company_id'),
					'status' => $this->input->post('active')
			  );
				
			$polls = $this->common_model->update('polls',$data,array('id'=>$this->input->post('poll_id')));
			
			if($polls){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
 public function edit_feedback()
 {
        $arr = array();
        if (!empty($_POST)) {
		    $data = array (
					'action' => $this->input->post('action'),					
			  );				
			$feedback_details = $this->common_model->update('feedback',$data,array("id"=>$this->input->post('feedback_id')));			
			if($feedback_details){
				  $arr=array("status"=>"success");			  
			}
			else{
			      $arr=array("status"=>"failed");			  
				  echo json_encode($arr);			  
				  exit;
			}
		
		}
		else{
		   $arr=array("status"=>"failed");			  
		}
		
      echo json_encode($arr);			  
	  exit;
	 
 }
 
  public function delete_entity()
 {
     if($this->common_model->delete($this->input->post('enity_name'),array("id"=>$this->input->post('entity_id')))){
	    $arr=array("status"=>"success");
	 }
	 else{
	     $arr=array("status"=>"failed");
	 }
	 echo json_encode($arr);			  
	 exit;
 
 }
 
  public function delete_feedback()
 {
	 $feedbacks=$this->input->post('feedback_list');
	 $feedback_arr=explode(",",$feedbacks);
	 foreach($feedback_arr as $feedback){
		 $this->common_model->delete("feedback",array("id"=>$feedback)); 
	 }
	 $arr=array("status"=>"success");
	 echo json_encode($arr);			  
	 exit;
  
 
 }
 
 public function delete_news()
 {
     if($this->common_model->delete($this->input->post('enity_name'),array("id"=>$this->input->post('entity_id')))){
	    $this->common_model->delete('company_news_rel',array("news_id"=>$this->input->post('entity_id')));
		$arr=array("status"=>"success");
	 }
	 else{
	     $arr=array("status"=>"failed");
	 }
	 echo json_encode($arr);			  
	 exit;
 
 }
 
 
 public function forgot_password()
 {
  
   if($_POST)
   {
     $email_id=$this->input->post('email');
     $reset_password_code= $this->rand_string(20);
     $result=$this->common_model->check_admin_mail($email_id);
     if($result==true){
	       $data = array('reset_password_code' =>$reset_password_code);
		   $to = $email_id;	   
           $subject = "Password Reset";
     
	       $message = "<font face='Arial' size='2'>Dear Member,<br /><br />We have received a password reset request for your legitimate access to corporate radio. As we do not send passwords by email, we would suggest you to click on the below link and reset the password to one that is convenient and which you can memorise.  Please note that this link can be used only once. <br /><br />";
           $message .="The link to reset password: <a href='".base_url()."admin/index/resetpassword/".$reset_password_code."'>".base_url()."resetpassword/".$reset_password_code."</a><br /><br />";
	 
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
			$mail->AddReplyTo('webmaster@timbremedia.in', 'webmaster');
			
			$mail->IsHTML(true);
			
			$mail->Subject = $subject;
			
			$mail->Body    =  $message;
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			
			$mail->Send();
	
 
		    $this->common_model->forget_admin_password_update($data,$email_id);
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
 
 public function upload_image() {
	if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
		$filename = $_FILES['file']['tmp_name'];
        $size = getimagesize($filename);
        list($width, $height) = getimagesize($filename); 
	    $extension = end(explode('.', $_FILES['file']['name']));
		$file_name=$this->rand_string(10).'.'.$extension;
        move_uploaded_file($_FILES['file']['tmp_name'], $this->config->item("upload_file_path").'logo/'.$file_name);
	    echo $file_name;
		exit;	
    }
   
  }
  
   public function upload_radio_image() {
	if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
		$filename = $_FILES['file']['tmp_name'];
        $size = getimagesize($filename);
        list($width, $height) = getimagesize($filename); 
	    $extension = end(explode('.', $_FILES['file']['name']));
		$file_name=$this->rand_string(10).'.'.$extension;
        move_uploaded_file($_FILES['file']['tmp_name'], $this->config->item("upload_file_path").'radio_logo/'.$file_name);
	    echo $file_name;
		exit;	
    }
   
  }
 
 public function upload_page_banner() {
	if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
		$filename = $_FILES['file']['tmp_name'];
        $size = getimagesize($filename);
        list($width, $height) = getimagesize($filename); 
	    $extension = end(explode('.', $_FILES['file']['name']));
		$file_name=$this->rand_string(10).'.'.$extension;
        move_uploaded_file($_FILES['file']['tmp_name'], $this->config->item("upload_file_path").'banner/'.$file_name);
	    echo $file_name;
		exit;	
    }
   
  } 
  
  public function upload_track_image() {
	if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
		$filename = $_FILES['file']['tmp_name'];
        $size = getimagesize($filename);
        list($width, $height) = getimagesize($filename); 
	    $extension = end(explode('.', $_FILES['file']['name']));
		$file_name=$this->rand_string(10).'.'.$extension;
        move_uploaded_file($_FILES['file']['tmp_name'], $this->config->item("upload_file_path").'tracks/'.$file_name);
	    echo $file_name;
		exit;	
    }
   
  } 
  
  public function upload_news_image() {
	if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
		$filename = $_FILES['file']['tmp_name'];
        $size = getimagesize($filename);
        list($width, $height) = getimagesize($filename); 
	    $extension = end(explode('.', $_FILES['file']['name']));
		$file_name=$this->rand_string(10).'.'.$extension;
        move_uploaded_file($_FILES['file']['tmp_name'], $this->config->item("upload_file_path").'news/'.$file_name);
	    echo $file_name;
		exit;	
    }
   
  } 
  
   public function upload_favicon() {
	if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
		$filename = $_FILES['file']['tmp_name'];
        $size = getimagesize($filename);
        list($width, $height) = getimagesize($filename);
		if($width!=100 and $height!=100){
		  $arr=array("status"=>"image_size_error");	
		  echo json_encode($arr);		  
	      exit;
		}
	    $extension = end(explode('.', $_FILES['file']['name']));
		$file_name=$this->rand_string(10).'.'.$extension;
        move_uploaded_file($_FILES['file']['tmp_name'], $this->config->item("upload_file_path").'favicon/'.$file_name);		  
	    $arr=array("status"=>"success","filename"=>$file_name);	
		echo json_encode($arr);		  
	    exit;	
    }
   
  } 
  
  public function upload_audio_file() {
	if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
		$filename = $_FILES['file']['tmp_name'];
		$extension = end(explode('.', $_FILES['file']['name']));
		$file_name=$this->rand_string(10).'.'.$extension;		
        move_uploaded_file($_FILES['file']['tmp_name'], $this->config->item("upload_file_path").'audio/'.$file_name);
	    echo $file_name;
		exit;	
    }
   
  }
  
  public function upload_excel() {
    
	if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
	    $extension = end(explode('.', $_FILES['file']['name']));
		$file_name=$this->rand_string(10).'.'.$extension;
        move_uploaded_file($_FILES['file']['tmp_name'], $this->config->item("upload_file_path").'excel/'.$file_name);
	    echo $file_name;
		exit;	
    }
   
  }
  
  public function validate_user_excel_file(){
    
	  $uploaded_file_name =$this->input->post('uploaded_file');
	  $company_error_list=array();
	  $email_error_list=array();
	  $email_arr=array();
	  ini_set('memory_limit', '-1');
	  $this->load->library('excel');
	  //$uploaded_file = FCPATH.'uploads\\excel\\'.$uploaded_file;
	  $uploaded_file = FCPATH.'uploads/excel/'.$uploaded_file_name;
	  //read file from path
      $objPHPExcel = PHPExcel_IOFactory::load($uploaded_file);
	  	  
	     //get only the Cell Collection
	  $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
         //extract to a PHP readable array format
      foreach ($cell_collection as $cell) {
			$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
			//header will/should be in row 1 only. of course this can be modified to suit your need.
			if($row==1){
			  $header[$row][$column] = $data_value;
			}
			if ($row > 1) {
			   $content[$row][$column] = $data_value;
			}		
       }	      
	  
	  foreach ($header[1] as $index=>$value){	
			    if($index =='A' and $value!='First Name'){
				    $arr= array("status"=>"failed");
                    echo json_encode($arr);
                    exit; 	
				}
               else if($index =='B' and $value!='Last Name'){
				    $arr= array("status"=>"failed");
                    echo json_encode($arr);
                    exit; 					
				}
				
				else if($index =='C' and $value!='Username'){
				    $arr= array("status"=>"failed");
                    echo json_encode($arr);
                    exit; 					
				}
				
				else if($index =='D' and $value!='Email'){
				    $arr= array("status"=>"failed");
                    echo json_encode($arr);
                    exit; 					
				}
				
				else if($index =='E' and $value!='Company'){
				    $arr= array("status"=>"failed");
                    echo json_encode($arr);
                    exit; 					
				}
			   
	  }
	  
	  if($content){
		  foreach($content as $row_content){
			 foreach($row_content as $index=>$value)
			  {  
			        if($this->toNum($index)==4){
					    $user_details = $this->common_model->get_data('users','id',array("email"=>$value));
						if($user_details){
						   $email_error_list[]=$value;
						}
						if(in_array($value,$email_arr)){
						    $arr= array("status"=>"email_duplicate");
                            echo json_encode($arr);
                            exit;  
						}
						else{
							 $email_arr[]=$value;
						}
						
					}
					
					if($this->toNum($index)==5){
					    $company_details = $this->common_model->get_data('company','id',array("name"=>$value));
						if(!$company_details){
						   $company_error_list[]=$value;
						}
					}
						
			  }
				
		  }
	  }
	 
	 if(!empty($email_error_list)){
	  $arr= array("status"=>"error_email","email_arr"=>$email_error_list);
      echo json_encode($arr);
      exit; 	
	
	}
	
	if(!empty($company_error_list)){
	  $arr= array("status"=>"error_company","name_arr"=>$company_error_list);
      echo json_encode($arr);
      exit; 	
	
	}   
   
     $arr= array("status"=>"success");
     echo json_encode($arr);
     exit; 	   
	 
	 
	 
	 
	 
 }
 
 public function import_user_excel_file(){
    
	  $uploaded_file_name =$this->input->post('uploaded_file');
	  $product_error_code=array();
	  ini_set('memory_limit', '-1');
	  $this->load->library('excel');
	  $user_arr=array();
	  $company=false;
	  /*$uploaded_file = FCPATH.'uploads\\excel\\'.$uploaded_file;*/
	  $uploaded_file = FCPATH.'uploads/excel/'.$uploaded_file_name;
	  //read file from path
      $objPHPExcel = PHPExcel_IOFactory::load($uploaded_file);
	  	  
	     //get only the Cell Collection
	  $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
         //extract to a PHP readable array format
      foreach ($cell_collection as $cell) {
			$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
			//header will/should be in row 1 only. of course this can be modified to suit your need.
			if($row==1){
			  $header[$row][$column] = $data_value;
			}
			if ($row > 1) {
			   $content[$row][$column] = $data_value;
			}		
       }	      
	  
	  if($content){
		  foreach($content as $row_content){
			 foreach($row_content as $index=>$value)
			  {  
			   
					if($this->toNum($index)==1){
					   $user_arr["first_name"]=$value;
					}
					if($this->toNum($index)==2){
					   $user_arr["last_name"]=$value;
					}
					if($this->toNum($index)==3){
					   $user_arr["username"]=$value;
					}
					if($this->toNum($index)==4){
					   $user_arr["email"]=$value;
					}
					
					if($this->toNum($index)==5){
					    $company_details = $this->common_model->get_data('company','id',array("name"=>$value));
						if(!$company_details){
						   $arr= array("status"=>"failed");
                           echo json_encode($arr);
                           exit; 
						}
						else{
						    $user_arr["company_id"]= $company_details[0]['id'];	 
						}
					}
					
				}
				if($user_arr){
					   $user_arr['status']=1;
					   $user_id=$this->common_model->save("users",$user_arr);
					   if($user_arr["email"])
					     $this->send_welcome_mail($user_id,$user_arr["company_id"],$user_arr["email"]);
			    }  
				
			  }
		  }
     
	 
	 
     $arr= array("status"=>"success");
     echo json_encode($arr);
     exit; 	   
 }
 
 public function validate_user_csv_file(){
	 $company_error_list=array();
	  $email_error_list=array();
	  $email_arr=array();
	 $row = 1;
	 $uploaded_file_name =$this->input->post('uploaded_file');
	 $company=$this->input->post('company');
	  $uploaded_file = FCPATH.'uploads/excel/'.$uploaded_file_name;
if (($handle = fopen($uploaded_file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        if($row==1){
		   for ($c=0; $c < $num; $c++) {
               if($c ==0 and $data[$c]!='First Name'){
				    $arr= array("status"=>"failed");
                    echo json_encode($arr);
                    exit; 	
				}
			   else if($c ==1 and $data[$c]!='Last Name'){
				    $arr= array("status"=>"failed");
                    echo json_encode($arr);
                    exit; 	
				}
			  
			  else if($c ==2 and $data[$c]!='Username'){
				    $arr= array("status"=>"failed");
                    echo json_encode($arr);
                    exit; 	
				}
			  
			  else if($c ==3 and $data[$c]!='Email'){
				    $arr= array("status"=>"failed");
                    echo json_encode($arr);
                    exit; 	
				}	
			  		
          } 	
		}
		else{
			
			for ($c=0; $c < $num; $c++) {
			
			 if($c==3){
					    $user_details = $this->common_model->get_data('users','id',array("email"=>$data[$c],"company_id"=>$company));
						if($user_details){
						   $email_error_list[]=$data[$c];
						}
						if(in_array($data[$c],$email_arr)){
						    $arr= array("status"=>"email_duplicate");
                            echo json_encode($arr);
                            exit;  
						}
						else{
							 $email_arr[]=$data[$c];
						}
						
					}	
				
			}
			
			
		}
        $row++;
        
    }
    fclose($handle);
}

if(!empty($email_error_list)){
	  $arr= array("status"=>"error_email","email_arr"=>$email_error_list);
      echo json_encode($arr);
      exit; 	
	
	}
	
	if(!empty($company_error_list)){
	  $arr= array("status"=>"error_company","name_arr"=>$company_error_list);
      echo json_encode($arr);
      exit; 	
	
	}   
   
     $arr= array("status"=>"success");
     echo json_encode($arr);
     exit; 	   
	  

 }
 
 public function import_user_csv_file(){
	 $company_error_list=array();
	  $email_error_list=array();
	  $email_arr=array();
	  $user_arr=array();
	 $row = 1;
	 $uploaded_file_name =$this->input->post('uploaded_file');
	  $uploaded_file = FCPATH.'uploads/excel/'.$uploaded_file_name;
	  $company=$this->input->post('company');
if (($handle = fopen($uploaded_file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        if($row>1){
		   for ($c=0; $c < $num; $c++) {
               if($c ==0 ){
				    $user_arr["first_name"]=$data[$c]; 	
				}
			   if($c ==1 ){
				    $user_arr["last_name"]=$data[$c]; 	
				}
			  
			  if($c ==2 ){
				    $user_arr["username"]=$data[$c]; 	
				}
			  
			  if($c ==3 and $data[$c]!='Email'){
				     $user_arr["email"]=$data[$c]; 	
				}	
			 		
          } 
		    if($user_arr){
		      $user_arr['status']=1;
			  $user_arr['company_id']=$company;
			  $user_arr['created_at']=date("Y-m-d H:m:s");
			  $this->common_model->save("users",$user_arr);
			}
		  	
		}
		
        $row++;
        
    }
    fclose($handle);
	
	
     $arr= array("status"=>"success");
     echo json_encode($arr);
     exit; 	   
	
	
}


 }
 
 public function send_welcome_mail($user_id,$company_id,$email){
	 	 
	 $this->load->library('phpmailer');
	 $this->load->library('smtp');		  			 		  
	 $reset_password_code= $this->rand_string(20);
	 $data = array('reset_password_code' =>$reset_password_code);				  
	 $subject = "Welcome Mail";
	 $message = $this->common_model->get_welcome_mail_message($company_id);
	 $message .="<br /><br />The link to Set password: <a href='".base_url()."resetpassword/".$reset_password_code."'><img src='".base_url()."assets/images/clickhere.jpg' /></a></a><br /><br />";
	 $message .="Best Regards,<br />";
	 $message .="Webmaster<br><br></font>";				  
	 $to=$email;			  			  
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

	 $this->common_model->forget_password_update($data,$email);
				  
		 

 }
 
  public function reset_password()
 {
  
   if($_POST)
   {
     $password=$this->input->post('password');
     $user_id= $this->input->post('user_id');
	 $query = $this->db->query("UPDATE admin_users SET crypted_password = LEFT(MD5(CONCAT(MD5('$password'), 'cloud')), 50),
	                                             reset_password_code='' 
						                      WHERE id=".$user_id."");
	 $arr = array('status' =>'success');
     echo json_encode($arr); 
	 exit;										  
	 
   }
 
 }
 
  public function toNum($data) {
    $alphabet = array( 'A', 'B', 'C', 'D', 'E',
                       'F', 'G', 'H', 'I', 'J',
                       'K', 'L', 'M', 'N', 'O',
                       'P', 'Q', 'R', 'S', 'T',
                       'U', 'V', 'W', 'X', 'Y',
                       'Z');
    $alpha_flip = array_flip($alphabet);
    $return_value = -1;
    $length = strlen($data);
    for ($i = 0; $i < $length; $i++) {
        $return_value +=
            ($alpha_flip[$data[$i]] + 1) * pow(26, ($length - $i - 1));
    }
    return $return_value+1;;
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
