<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
        
    var $gen_contents = array();
        
    public function __construct() {
            parent::__construct();
			$this->load->library('form_validation');
			
        }
    	
	public function index() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "Index";
             $this->gen_contents['page_title'] = "Index";
			 $this->gen_contents['company_count']=sizeof($this->common_model->get_data('company','id'));
			 $this->gen_contents['user_count']=sizeof($this->common_model->get_data('users','id'));
			 $this->gen_contents['track_count']=sizeof($this->common_model->get_data('tracks','id'));
			 $this->gen_contents['feedback_count']=sizeof($this->common_model->get_data('feedback','id'));
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/index',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function company() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "company";
             $this->gen_contents['page_title'] = "Company";
			 $this->gen_contents['company_list']=$this->common_model->get_data('company','id,name,location,email,logo,company_url,company_auth_code');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/company',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function create_company() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "create_company";
             $this->gen_contents['page_title'] = "Create Company";
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/create_company',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function edit_company($company_id) {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "edit_company";
             $this->gen_contents['page_title'] = "Edit Company";
			 $this->gen_contents['company_details']=$this->common_model->get_data('company','*',array('id'=>$company_id));
			 $this->gen_contents['company_allowed_ip']=$this->common_model->get_data('company_allowed_ip','*',array('company_id'=>$company_id));
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/edit_company',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function user() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "user";
             $this->gen_contents['page_title'] = "User";
			 $this->gen_contents['user_list']=$this->common_model->get_data('users','id,first_name,last_name,username,company_id,email');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/user',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function create_user() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "user_company";
             $this->gen_contents['page_title'] = "Create User";
			 $this->gen_contents['company_list']=$this->common_model->get_data('company','id,name');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/create_user',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function edit_user($user_id) {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "edit_user";
             $this->gen_contents['page_title'] = "Edit User";
			 $this->gen_contents['user_details']=$this->common_model->get_data('users','*',array('id'=>$user_id));
			 $this->gen_contents['company_list']=$this->common_model->get_data('company','id,name');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/edit_user',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function tracks() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "tracks";
             $this->gen_contents['page_title'] = "Tracks";
			 $this->gen_contents['track_list']=$this->common_model->get_data('tracks','id,name,category_id,duration,description,keywords');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/tracks',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function create_track() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "create_track";
             $this->gen_contents['page_title'] = "Create Track";
			 $this->gen_contents['track_category_list']=$this->common_model->get_data('track_category','id,name');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/create_track',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function edit_track($track_id) {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "edit_track";
             $this->gen_contents['page_title'] = "Edit Track";
			 $this->gen_contents['track_details']=$this->common_model->get_data('tracks','*',array('id'=>$track_id));
			 $this->gen_contents['track_category_list']=$this->common_model->get_data('track_category','id,name');
			 $track_category_rel=$this->common_model->get_data('track_category_rel','category_id',array('track_id'=>$track_id));
			 $rel=array();
			 foreach($track_category_rel as $cat_rel){
			      $rel[]=$cat_rel['category_id'];
			 }
			 $this->gen_contents['track_category_rel']=$rel;
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/edit_track',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function assign_tracks() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "assign_tracks";
             $this->gen_contents['page_title'] = "Assigned Tracks List";
			 $this->gen_contents['assign_track_list']=$this->common_model->get_data('assign_tracks','id,track_id,company_id,type,date');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/assign_tracks',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function create_assign_track() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "create_assign_track";
             $this->gen_contents['page_title'] = "Assign Track";
			 $this->gen_contents['track_list']=$this->common_model->get_data('tracks','id,name');
			 $this->gen_contents['company_list']=$this->common_model->get_data('company','id,name');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/create_assign_track',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function edit_assign_track($track_id) {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "edit_track";
             $this->gen_contents['page_title'] = "Edit Track";
			 $this->gen_contents['assign_track_details']=$this->common_model->get_data('assign_tracks','*',array('id'=>$track_id));
			 $this->gen_contents['track_list']=$this->common_model->get_data('tracks','id,name');
			 $this->gen_contents['company_list']=$this->common_model->get_data('company','id,name');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/edit_assign_track',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
    public function news() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "news";
             $this->gen_contents['page_title'] = "News List";
			 $this->gen_contents['news_list']=$this->common_model->get_data('news','id,title,company_id,date');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/news',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function create_news() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "create_news";
             $this->gen_contents['page_title'] = "Create News";
			 $this->gen_contents['company_list']=$this->common_model->get_data('company','id,name');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/create_news',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function edit_news($news_id) {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "edit_track";
             $this->gen_contents['page_title'] = "Edit Track";
			 $this->gen_contents['news_details']=$this->common_model->get_data('news','*',array('id'=>$news_id));
			 $this->gen_contents['company_list']=$this->common_model->get_data('company','id,name');
			
			 $company_news_rel=$this->common_model->get_data('company_news_rel','company_id',array('news_id'=>$news_id));
			 
			 $rel=array();
			 foreach($company_news_rel as $comp_rel){
			      $rel[]=$comp_rel['company_id'];
			 }
			 $this->gen_contents['company_news_rel']=$rel;
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/edit_news',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function track_category() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "track_category";
             $this->gen_contents['page_title'] = "Track Category List";
			 $this->gen_contents['track_category_list']=$this->common_model->get_data('track_category','id,name');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/track_category',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function create_track_category() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "create_track_category";
             $this->gen_contents['page_title'] = "Create Track Category";
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/create_track_category',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function edit_track_category($category_id) {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "edit_track_category";
             $this->gen_contents['page_title'] = "Edit Track Category";
			 $this->gen_contents['track_category_list']=$this->common_model->get_data('track_category','*',array('id'=>$category_id));
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/edit_track_category',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function polls() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "polls";
             $this->gen_contents['page_title'] = "Polls";
			 $this->gen_contents['poll_list']=$this->common_model->get_data('polls','id,poll_question,status,company_id');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/polls',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function create_poll() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "create_poll";
             $this->gen_contents['page_title'] = "Create Poll";
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->gen_contents['company_list']=$this->common_model->get_data('company','id,name');
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/create_poll',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function edit_poll($poll_id) {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "edit_poll";
             $this->gen_contents['page_title'] = "Edit Poll";
			 $this->gen_contents['poll_details']=$this->common_model->get_data('polls','*',array('id'=>$poll_id));
			 $this->gen_contents['company_list']=$this->common_model->get_data('company','id,name');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/edit_poll',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function feedback() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "feedback";
             $this->gen_contents['page_title'] = "Feedback";
			 $this->gen_contents['feedback_list']=$this->common_model->get_data('feedback','id,name,email,message,submit_date,company_id,action,status');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/feedback',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
    public function edit_feedback($feedback_id) {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "edit_feedback";
             $this->gen_contents['page_title'] = "Edit Feedback";
			 $this->common_model->update('feedback',array("status"=>"read"),array("id"=>$feedback_id));		
			 $this->gen_contents['feedback_list']=$this->common_model->get_data('feedback','*',array('id'=>$feedback_id));
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/edit_feedback',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
 
    public function import_user() {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "import_user";
             $this->gen_contents['page_title'] = "Import User";
			 $this->gen_contents['company_list']= $this->common_model->get_data('company','id,name');
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/import_users',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   
   public function company_radio_history($company_id) {
		 if($this->session->userdata('admin_logged_in')){
			 $this->gen_contents['current_controller'] = "company_radio_history";
             $this->gen_contents['page_title'] = "Company Radio History";
			 $this->gen_contents['recordred_shows']=$this->common_model->program_list($company_id);
			 $this->gen_contents['live_shows']=$this->common_model->get_current_live_show($company_id);
			 $this->gen_contents['track_history']=$this->common_model->get_previous_tracks($company_id);
			 $this->gen_contents['company_id'] = $company_id;
			 $this->load->view('admin/common/header',$this->gen_contents);
			 $this->load->view('admin/common/top_menu_header',$this->gen_contents);
			 $this->load->view('admin/common/left_side_bar',$this->gen_contents);				           
			 $this->load->view('admin/company_history',$this->gen_contents);
			 $this->load->view('admin/common/footer',$this->gen_contents);		     
		 }
		 else{
		    redirect('admin/index/login', 'refresh');
		 }  
		   		
   }
   
   public function download_csv($file){
   
    $uploaded_file = base_url().'uploads/sample_excel/'.$file;
    header('HTTP/1.1 200 OK');
	header('Cache-Control: no-cache, must-revalidate');
	header("Pragma: no-cache");
	header("Expires: 0");
	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename=$file");
	readfile($uploaded_file);
	exit;
   
   }
   
   public function get_entity_name($model,$id){
     $entity_name=$this->common_model->get_data($model,'id,name',array('id'=>$id));
	 if($entity_name)
	   return $entity_name[0]['name'];
	 else
	   return false;   
	 
   }
   public function get_listeners($company_id,$track_id){
	  $log_count=$this->common_model->get_listeners($company_id,$track_id); 
	  return $log_count;  
   
   }
   
   public function get_company_list($news_id){
     $news_details =$this->common_model->get_data('company_news_rel','company_id',array('news_id'=>$news_id));	 
	 $company_len = sizeof($news_details);
	 $company_name='';
	 $len=1;
	 foreach($news_details as $news){	   
	   if($len!=1){
	     $company_name.=','; 
	   }
	   $company_name.=$this->get_entity_name('company',$news['company_id']);
	   $len = $len+1;      
	 }	
	return $company_name;    
   }
	   
   	    
   public function login() {
	   if($this->session->userdata('admin_logged_in')){
	           redirect('admin/index', 'refresh');
	   }
	   else{
	         $this->gen_contents['current_controller'] = "login";
             $this->gen_contents['page_title'] = "Login";         
			 $this->load->view('admin/login',$this->gen_contents);				 
		 }
   }
   
    public function forgot_password() {
	   if($this->session->userdata('admin_logged_in')){
	           redirect('admin/index', 'refresh');
	   }
	   else{
	         $this->gen_contents['current_controller'] = "forgot_password";
             $this->gen_contents['page_title'] = "Forgot Password";         
			 $this->load->view('admin/forgot_password',$this->gen_contents);				 
		 }
   }
   
   public function resetpassword($reset_code)
	
	{
            $this->gen_contents['current_controller'] = "resetpassword";
            $this->gen_contents['page_title'] = "Reset Password";
			$this->gen_contents['user_id']=$this->common_model->fetch_admin_user_id_from_code($reset_code);
			if($this->gen_contents['user_id']){  
				$this->load->view('admin/reset_password', $this->gen_contents);
			}
			else
			{
			  redirect('admin/index/login');
			}	
		  
	
	}
   
   public function user_logout() {
	 $this->authentication->admin_logout();
     redirect('admin/index/login');
   
   }	
       
        
}

/* End of file index.php */