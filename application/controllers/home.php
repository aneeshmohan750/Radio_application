<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
        
    var $gen_contents = array();
        
    public function __construct() {
            parent::__construct();
            $this->load->model(array('common_model'));
			$this->load->model(array('master_model'));
			$this->load->library('form_validation');
			$this->load->helper('cookie');
        }
    	
	public function index($username='') {
		
		 if($this->session->userdata('logged_in')){
			 $this->gen_contents['current_controller'] = "Index";             
			 $session_data = $this->session->userdata('logged_in');
			 $this->gen_contents['username'] = $session_data['USERNAME'];
			 $this->gen_contents['user_id'] = $session_data['USERID'];
			 $this->gen_contents['name'] = $session_data['NAME'];
			 $this->gen_contents['company_id'] =$session_data['COMPANY'];
			 $this->gen_contents['page_title']= $this->common_model->get_company_page_title($this->gen_contents['company_id']);
			 $this->gen_contents['favicon']= $this->common_model->get_company_favicon($this->gen_contents['company_id']);
			 $this->gen_contents['company_logo']=$this->common_model->get_company_logo($this->gen_contents['company_id']);
			 $this->gen_contents['company_radio_logo']=$this->common_model->get_company_radio_logo($this->gen_contents['company_id']);
			 $this->gen_contents['company_name']=$this->common_model->get_company_name($this->gen_contents['company_id']);
			 $this->gen_contents['company_feedback_mail']=$this->common_model->get_company_feedback_mail($this->gen_contents['company_id']);
			 $this->gen_contents['company_radio']=$this->common_model->get_company_radio($this->gen_contents['company_id']);
			 $this->gen_contents['company_color_theme']=$this->common_model->get_company_color_theme($this->gen_contents['company_id']);
			 $this->gen_contents['check_radio_logo']=$this->common_model->check_company_radio_logo($this->gen_contents['company_id']);
			 $this->gen_contents['footer_line']=$this->common_model->get_company_footer_line($this->gen_contents['company_id']);
			 $this->gen_contents['company_banner']=$this->common_model->get_company_banner($this->gen_contents['company_id']);
			 $this->gen_contents['color_array']=($this->gen_contents['company_id']==8) ? array("0"=>"pink-idfc","1"=>"green-idfc","2"=>"orange-idfc","3"=>"blue-idfc") : array("0"=>"pink","1"=>"green","2"=>"orange","3"=>"blue") ;
			 $this->gen_contents['highlighted_program_list']=$this->common_model->get_highlighted_programs($this->gen_contents['company_id']);
			 $this->gen_contents['onair_programme']=$this->common_model->get_company_onair_programmme($this->gen_contents['company_id'],'name');
			 $this->gen_contents['onair_programme_src']=$this->common_model->get_company_onair_programmme($this->gen_contents['company_id'],'audio_src');
			 $this->gen_contents['onair_programme_id']=$this->common_model->get_company_onair_programmme($this->gen_contents['company_id'],'id');
			 $this->gen_contents['news_list']=$this->common_model->get_company_news_list($this->gen_contents['company_id']);
			 $this->gen_contents['programme_list']=$this->common_model->program_list($this->gen_contents['company_id']);
			 $this->gen_contents['poll_list']=$this->common_model->get_data('polls','*',array('status'=>1,'company_id'=>$this->gen_contents['company_id']));
			 $this->gen_contents['company_common_url']=$this->common_model->check_company_common_url($this->gen_contents['company_id']);
			 $this->gen_contents['check_poll']=$this->common_model->check_poll($this->gen_contents['user_id'],$this->gen_contents['company_common_url'],$this->gen_contents['company_id']);
			 $this->gen_contents['enable_news']=$this->common_model->enable_company_news($this->gen_contents['company_id']);
			 $this->gen_contents['poll_cookie']=get_cookie('poll_submitted');
			 $this->load->view('common/main_header',$this->gen_contents);	           
			 $this->load->view('site/index',$this->gen_contents);
			 $this->load->view('common/footer',$this->gen_contents);		     
		 }
			 
		 else{
			 $this->gen_contents['current_controller'] = "index";
             $this->gen_contents['page_title'] = "Login";
		     $this->load->view('common/login_header',$this->gen_contents);
			 $this->load->view('common/gacode',$this->gen_contents);          
			 $this->load->view('site/login',$this->gen_contents);
			 $this->load->view('common/footer',$this->gen_contents);  
		 }  
		   		
   }
   
   public function download_mp3($track_id){
	    
		$file='';
		$session_data = $this->session->userdata('logged_in');
		$user_id=$session_data['USERID'];
		$downloads=$this->common_model->get_data('user_downloads','download_count',array("track_id"=>$track_id,"user_id"=>$user_id));
		if($downloads){		  
			   redirect('index', 'refresh');	
		}
		else{
		   	$this->common_model->save('user_downloads',array("track_id"=>$track_id,"user_id"=>$user_id,"download_count"=>1));
		}
		$track_details = $this->common_model->get_data('tracks','audio_src',array("id"=>$track_id));
		if($track_details){
		  $file = $track_details[0]['audio_src']; 
		}
		$session_data = $this->session->userdata('logged_in');
		
		header("Content-type: application/x-file-to-save"); 
        header("Content-Disposition: attachment; filename=".basename($file)); 
        readfile($file);
   
   }
   
   public function RadioHatke(){
   
     if(!$this->session->userdata('logged_in') and  $_GET['auth']){    
	   
	   $user_details = $this->common_model->get_data('users','username,password',array("auth_token"=>$_GET['auth']));
	   if($user_details){   
		   $login_details['username'] =  $user_details[0]['username'];	    
		   $login_details['password'] =  $user_details[0]['password'];	   
		   $this->authentication->process_user_auto_login($login_details);
		   $this->load->view('common/main_header',$this->gen_contents);
	   }
	   redirect('', 'refresh');	   
	 }	 
	else{
		  redirect('', 'refresh'); 
	 }
   
   }
   
   public function Hponair(){
   
     if(!$this->session->userdata('logged_in') and  $_GET['auth']){    
	   
	   $user_details = $this->common_model->get_data('users','username,password',array("auth_token"=>$_GET['auth']));
	   if($user_details){   
		   $login_details['username'] =  $user_details[0]['username'];	    
		   $login_details['password'] =  $user_details[0]['password'];	   
		   $this->authentication->process_user_auto_login($login_details);
		   $this->load->view('common/main_header',$this->gen_contents);
	   }
	   redirect('', 'refresh');	   
	 }	 
	else{
		  redirect('', 'refresh'); 
	 }
   
   }
   
   public function get_download_count($track_id,$user_id){
	  
	 $download_count=$this->common_model->get_downloads_count($track_id,$user_id);  
	 return $download_count;
	   
   }
   
   public function get_poll_percent($option,$poll_id){
	  
	 $poll_total_count=$this->common_model->get_total_poll($poll_id);
	 $poll_answer_count=$this->common_model->get_poll_answer_count($poll_id,$option); 
	
	 if($poll_total_count > 0){
	   $percent =  round(($poll_answer_count/$poll_total_count)*100);
	   return $percent;
	 }
	 else
	    return 0;
	   
   }
   
   
   public function login() {
	   if($this->session->userdata('logged_in')){
	           redirect('index', 'refresh');
	   }
	   else{
	         $this->gen_contents['current_controller'] = "login";
             $this->gen_contents['page_title'] = "Coroporate Radio";         
			 $this->load->view('common/login_header',$this->gen_contents);
			 $this->load->view('common/gacode',$this->gen_contents);          
			 $this->load->view('site/login',$this->gen_contents);
			 $this->load->view('common/footer',$this->gen_contents);  					 
		 }
   }
   
    public function forget_password() {
	         $this->gen_contents['current_controller'] = "forget_password";
             $this->gen_contents['page_title'] = "Coroporate Radio";         
			 $this->load->view('common/login_header',$this->gen_contents); 
			 $this->load->view('common/login_header_close',$this->gen_contents);           
			 $this->load->view('site/forget_password',$this->gen_contents);
			 $this->load->view('common/footer',$this->gen_contents);  					 
		 
   }
   
   public function resetpassword($reset_code)
	
	{
            $this->gen_contents['current_controller'] = "index";
            $this->gen_contents['page_title'] = "Coroporate Radio";
			$this->gen_contents['user_id']=$this->common_model->fetch_user_id_from_code($reset_code);
			if($this->gen_contents['user_id']){
				 $this->load->view('common/login_header',$this->gen_contents); 
				 $this->load->view('common/login_header_close',$this->gen_contents);    
				$this->load->view('site/reset_password', $this->gen_contents);
				$this->load->view('common/footer',$this->gen_contents);
			}
			else
			{
			  redirect('index', 'refresh');
			}	
		  
	
	}
   
  public function active_directory_login() {
	   if($this->session->userdata('logged_in')){
	           redirect('index', 'refresh');
	   }
	   else{
	         $this->gen_contents['current_controller'] = "login";
             $this->gen_contents['page_title'] = "Login";
			 $this->load->view('common/login_header',$this->gen_contents);         
			 $this->load->view('site/login',$this->gen_contents);
			 $this->load->view('common/footer',$this->gen_contents);  				 
		 }
   }
  
  public function logout() {
	 delete_cookie("poll_submitted"); 
	 $this->authentication->user_logout();
     redirect('login');
   
   }	 
   
     
        
}

/* End of file index.php */

?>