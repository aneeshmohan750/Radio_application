<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Handles admin functions.
 *
 * @package		CodeIgniter
 * @subpackage	Models
 * @category	Models
 * @author
 */

// ------------------------------------------------------------------------

class Common_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	 
	function safe_html($input_field)
	{ 
		return htmlspecialchars(trim(strip_tags($input_field)));
	}
	
	function safe_sql($input_field)
	{ 
		return mysql_real_escape_string(trim(strip_tags($input_field)));
	}
	
	
	/**
	 * to send emails to a given email address
	 *
	 * @param Sring $to_email
	 * @param Sring $from
	 * @param Sring $subject
	 * @param Sring $body_content
	 * @param Array $attachment
	 * @param Sring $from_mail
	 * @return Boolean
	 */
	
	
	
	function send_mail($to_email='', $from='', $subject, $body_content, $attachment = array(), $from_mail='', $cc=array(), $bcc=array(), $batch_mode=false, $batch_size=200)
	{
		$this->load->library ('email');
		$this->email->_smtp_auth	= FALSE; 	    
		$this->email->protocol		= "mail";
		//$this->email->smtp_host		= $this->config->item('smtp_host');
		//$this->email->smtp_user		= $this->config->item('smtp_from');
		//$this->email->smtp_pass		= $this->config->item('smtp_password');
		$this->email->mailtype		= $this->config->item('mailtype');
		
		//$this->email->smtp_timeout	= $this->config->item('smtp_timeout');
		//$this->email->smtp_port		= $this->config->item('smtp_port');
		//$this->email->smtp_crypto	= $this->config->item('smtp_crypto');
		$this->email->charset		= $this->config->item('charset');
 		
		$from_name					= ($from=='')?$this->config->item('smtp_from_name'):$from;
		$reply_mail					= ($from_mail=='')?$this->config->item('smtp_from'):$from_mail;
		$this->email->from($reply_mail, $from_name);
		$this->email->to($to_email);
		if(!empty($cc)){
			$this->email->cc($cc);
		}
		if(!empty($bcc)){
			$this->email->bcc($bcc);
		}
		$this->email->reply_to($reply_mail,$from_name);        
		//$this->email->set_mailtype('html');
		$this->email->subject($subject);
		$this->email->message($body_content);
		if($attachment !=''){
			foreach($attachment as $attach ){
				$this->email->attach($attach);
			}
		}
                
		if ($this->email->send ()){
			
 echo $this->email->print_debugger();exit;
		}
		else{
			
 echo $this->email->print_debugger();exit;
		}
	}
			
	/**
	 * get the config value
	 *
	 * @return unknown
	 */
	function get_config_item($conf_name){				
		$query = $this->db->query("SELECT config_value FROM ".$this->db->dbprefix."site_configuration WHERE config_name='".$conf_name."'");
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			if($row->config_value){
				return $row->config_value;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	
	/**
	 * get the config value
	 *
	 * @return unknown
	 */
	function get_config_script($conf_name){				
		$query = $this->db->query("SELECT config_text FROM ".$this->db->dbprefix."site_configuration WHERE config_name='".$conf_name."'");
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			if($row->config_text){
				return $row->config_text;			
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	
	/**
	 * to get the url of the post page
	 *
	 * @return String
	 */
	function get_post_url()
	{
		$postURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$postURL .= "s";}
		$postURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$postURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$postURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $postURL;
	}
	
	function prepare_select_box_data( $table, $fields, $where = array(), $insert_null = false,$order_by = '',$other_array = array()){
		
		list($key, $val) 	= explode(',',$fields);
		$key 				= trim($key);
		$val 				= trim($val);
		$order_by			= $order_by ? $order_by : $val;
		$input_array 		= $this->get_data( $table, $fields, $where, $order_by );

		$select_box_array 	= array();
		$total_records 		= count($input_array);
		if($insert_null) {
			$select_box_array[''] = $insert_null===true ? '' : $insert_null;
		}
		for($i = 0; $i < $total_records; $i++){
		 	$select_box_array[$input_array[$i][$key]] = $input_array[$i][$val];
		}
		if (is_array($other_array) and count($other_array) > 0){
			foreach ($other_array as $key => $val){
				$select_box_array[$key]				=	$val;
			}
		}
		return $select_box_array;
	}
	
    function record_count($table) {
        return $this->db->count_all($table);
     }
	
	function get_data( $table, $fields = '*', $where = array(),$order_by = '' ){
		if((is_array($where) && count($where)>0) or (!is_array($where) && trim($where) != '')) $this->db->where($where);
		if($order_by) $this->db->order_by($order_by);
		$this->db->select($fields);
		$query = $this->db->get($table);
		return $query->result_array();
	}
	
	function get_limit_data( $table, $fields = '*', $where = array(),$order_by = '',$start='',$limit=''){
		if((is_array($where) && count($where)>0) or (!is_array($where) && trim($where) != '')) $this->db->where($where);
		if($order_by) $this->db->order_by($order_by);
		$this->db->select($fields);
		$this->db->limit($start,$limit);
		$query = $this->db->get($table);
		$data_arr = $query->result_array();
		$data_html =$this->get_data_html($table,$data_arr);
		return $data_html;
	}
	
	function check_selectbox_values($aWhere=array(), $table_name=""){
		if($aWhere){
			$this->db->where($aWhere, "", false); 
		}
		$this->db->select('id');
		$this->db->from( $table_name ); 
		$result   = $this->db->get();
		$result = $result->result_array();
		$array_list = array();
		foreach ($result AS $res):
			$array_list[] = $res['id'];
		endforeach;
		return $array_list;
	}
	 
	function get_custom_data( $table, $fields = '*', $where = array(),$order_by = '' ){
		if((is_array($where) && count($where)>0) or (!is_array($where) && trim($where) != '')) 
		
		$this->db->where($where, "", false); 
		if($order_by) $this->db->order_by($order_by);
		$this->db->select($fields);
		$query = $this->db->get($table);
		return $query->result_array();
	}
	
	/**
	 * function to get the page titles and meta details
	 *
	 * @return unknown
	 */
	function get_page_meta($meta_id){
		$this->db->select('*');			
		$this->db->where('meta_id', $meta_id);			
		$query = $this->db->get("page_meta_details"); 			
		$result = array();
		if($query->row()) {	
			return $query->row();
		} 
		else return false;
	}
	 
	/**
	 * function for file_upload musik_track musik_mix_track
	 */  
	function file_upload($field_name = '',$upload_path = '',$allowed_type = '',$max_size = 1024){  
		if(@$_FILES[$field_name]['name']){
			$file  							=	explode('.', $_FILES[$field_name]['name']); 
			$name  							=	$file[0];
			$upload_path					=	upload_path().$upload_path; 
			
			if (!@$allowed_type){
				$config['allowed_types'] 	=   'gif|jpg|png|jpeg';
			}else{
				$config['allowed_types'] 	=   $allowed_type;
			}
			$config['upload_path'] 			=	$upload_path;
			$config['max_size'] 			=   $max_size;
			$config['remove_spaces'] 		=   TRUE; 
			$file_name						=	str_replace('(','_',$_FILES[$field_name]['name']);
			$file_name						=	str_replace(')','_',$file_name);
			$file_name						=	str_replace('-','_',$file_name);
			$config['file_name']	    	=   time().$file_name;
			
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			//$uplod_result					=	 ;
			$bStatus = false;
			$data = array();
			
			if( $this->upload->do_upload($field_name) ){
				
				$bStatus 	= true;
				
				//echoo('test 1');
				//_print_r($this->upload->data());
				$data 		= array('upload_data' => $this->upload->data());
				//return $data["upload_data"]["file_name"];
			}else{
				//echoo('test 1');
				$bStatus 	= false;
				$data['error_msg'] = $this->upload->display_errors();
			}
			
			return array($bStatus, $data);
			//return false; 
		} 
	}
 
	/**
	 * function to send email
	 *
	 * @return unknown
	 */
	function process_send_mail  ($email, $email_array, $title = '' ,$from_name ='',$from='',$attachment=array(), $mailsubject='')
	{
		$values_array		= array ();			
		$result_array       = $this->common_model->get_mail_content_and_title ($title);
		foreach ($result_array as $key=>$value)
		{
			$mail_subject   = ($mailsubject) ? $mailsubject : $key;
			$email_body     = $value;
		}
		$matches            = array();
		preg_match_all("/\{\%([a-z_A-Z0-9]*)\%\}/",$email_body, $matches);
		$variables_array    = $matches[1];
	
		if (count($variables_array) > 0) 
		foreach (@$variables_array as $key)
		{
			@$values_array[] = @$email_array[$key];
		}
	
		$new_variables_array    = array();
		foreach($variables_array as $variable)
		{
			$new_variables_array[] = '/\{\%'.$variable.'\%\}/';
		}
		$body_content ='';
		$body_content .= preg_replace ($new_variables_array, $values_array, $email_body);		
		
		if ($this->common_model->send_mail($email,$from_name, $mail_subject, $body_content,array(),$from))
			return TRUE;
		else
			return FALSE;
		
	}
	
	// function to get email title and content 
	function get_mail_content_and_title ($message_title = '')
	{
        $this->db->select('subject AS TITLE, content AS BODY_CONTENT');
        $this->db->from('email_templates');
        $this->db->where('title', $message_title);		
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $result_array[$row->TITLE] = $row->BODY_CONTENT;
            }
            return $result_array;
		}
		else
		{
		    return FALSE;
		}
	}
	
	/**
	 * check any user exist
	 */
	function isUser($email)
	{
		$this->db->where('email', $email);
		$this->db->where('status','1');
		$this->db->select('*');
		$this->db->from('user_details');
		$result		= $this->db->get ();
		if ($result->row()){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * check any user exist
	 */
	function getUserbyEmail($email)
	{
		$this->db->where('email', $email);
		$this->db->select('*');
		$this->db->from('user_details');
		$result		= $this->db->get ();
		if ($result->row()){
			return $result->row();   
		}else{
			return false;
		}
	}
	
	/**
	 * get user details
	 *
	 * @return unknown
	 */
	function getCAProfileDetails($id){	
		if(isset ($id) && '' != $id){			
			$this->db->where('user_id',$id);
			$this->db->where('status','1');
			$this->db->select('*');
			$query	=	$this->db->get('user_profile');			
			if($query->row()){
				return $query->row();
			}else{
				return FALSE;
			}
		}else{ 
			return FALSE;
		}		
	}
	
	/**
	 * forgot password
	 */
	function forgot_password($email)
	{
		
		$this->db->where('email', $email);
		$this->db->where('status','1');
		$this->db->select('*');
		$this->db->from('user_details');
		$result_set   				= $this->db->get ();
		if (0 < $result_set->num_rows()){
			$row 					= $result_set->row();   
			
			$forgot_pwd				= random_string('alnum', 10);
			$ret_result['forgot_pwd']	= $forgot_pwd;
			$this->db->set('forgot_pwd', $forgot_pwd);
			$this->db->where('id', $row->id);
			$this->db->update('user_details'); 			
			$ret_result['first_name']	=	$row->first_name;
			$ret_result['last_name']	=	$row->last_name;
			$ret_result['id']		=	$row->id;
			$ret_result['email']	=	$row->email;
			return $ret_result;
		}else{
			return false;
		}
	}
	
	/**
	 * check any user exist
	 */
	function isPenindingUser($email)
	{
		$this->db->where('email', $email);
		$this->db->where('status','2');
		$this->db->select('*');
		$this->db->from('user_details');
		$result		= $this->db->get ();
		if ($result->row()){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * resend_link
	 */
	function resend_link($email)
	{
		$this->db->where('email', $email);
		$this->db->where('status','2');
		$this->db->select('*');
		$this->db->from('user_details');
		$result		= $this->db->get ();
		if ($result->row()){
			return $result->row();   
		}else{
			return false;
		}
		
	}
	
	// Common save
	function save($table, $data){
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	
	// Update
	function update($table, $data, $where){
		 if(!empty($data)){ 
			$this->db->where($where, "", false); 
			$this->db->set ($data);
			if($this->db->update ($table)){
				return TRUE;
			}else{
				return FALSE;
			}
        }
	}
	 
	// Common Delete function
	function delete($table, $where=array()) {
		if(!empty($table)){  
			if( $this->db->delete($table, $where) ){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	
	function get_company_logo($company_id){	   
	    $this->db->select('logo');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $logo = $row->logo;
            }
            return $logo;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function get_company_name($company_id){	   
	    $this->db->select('name');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $name = $row->name;
            }
            return $name;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	
	function get_company_feedback_mail($company_id){	   
	    $this->db->select('email');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $email = $row->email;
            }
            return $email;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function get_company_radio($company_id){	   
	    $this->db->select('radio_name');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $radio_name = $row->radio_name;
            }
            return $radio_name;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function get_company_radio_logo($company_id){	   
	    $this->db->select('radio_logo');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $radio_logo = $row->radio_logo;
            }
            return $radio_logo;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function get_company_banner($company_id){	   
	    $this->db->select('page_banner');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $page_banner = $row->page_banner;
            }
            return $page_banner;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function get_company_page_graphics($company_id){	   
	    $this->db->select('page_graphics');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $page_graphics = $row->page_graphics;
            }
            return $page_graphics;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function get_company_color_theme($company_id){
	   
	    $this->db->select('color_theme');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $color_theme = $row->color_theme;
            }
            return $color_theme;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function get_company_footer_line($company_id){
	   
	    $this->db->select('footer_line');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $footer_line = $row->footer_line;
            }
            return $footer_line;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function get_company_page_title($company_id){
	   
	    $this->db->select('page_title');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $page_title = $row->page_title;
            }
			if($page_title=='')
			  $page_title="Enjoy working while keeping yourself updated with the latest trends in music.";
            return $page_title;
		}
		else
		{
			$page_title="Enjoy working while keeping yourself updated with the latest trends in music.";
		    return $page_title;
		}	 
	
	}
	
	function get_company_favicon($company_id){
	   
	    $this->db->select('favicon');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $favicon = $row->favicon;
            }
			
			return $favicon;
		}
		else
		{
		    return false;
		}	 
	
	}
	
	function check_company_common_url($company_id){
	   
	    $this->db->select('common_url_login');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $common_url_login = $row->common_url_login;
            }
            return $common_url_login;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function check_company_radio_logo($company_id){	   
	    $this->db->select('enable_radio_logo');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $enable_radio_logo = $row->enable_radio_logo;
            }
            return $enable_radio_logo;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function get_welcome_mail_message($company_id){
	   
	    $this->db->select('welcome_mail');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $welcome_mail = $row->welcome_mail;
            }
            return $welcome_mail;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function enable_company_news($company_id){
	   
	    $this->db->select('enable_news');
        $this->db->from('company');
        $this->db->where('id', $company_id);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $enable_news = $row->enable_news;
            }
            return $enable_news;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function get_company_onair_programmme($company_id,$arg){
	   
	   $query=$this->db->query("SELECT t.name,t.audio_src,t.id,t.protocol_type FROM tracks as t
									   LEFT JOIN assign_tracks as a ON(t.id=a.track_id) 
									   WHERE a.company_id=".$company_id." AND a.type='Live' GROUP BY t.id");
									  /* echo "SELECT t.name,t.audio_src,t.id,t.protocol_type FROM tracks as t
									   LEFT JOIN assign_tracks as a ON(t.id=a.track_id) 
									   WHERE a.company_id=".$company_id." AND a.type='Live' GROUP BY t.id";
									   exit;		*/
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
			    if($arg=='audio_src')
                 $onair_programme = $row->audio_src;
				else if($arg=='name')
				  $onair_programme = $row->name;
				else if($arg=='protocol_type')
				  $onair_programme = $row->protocol_type;  
				else
				  $onair_programme = $row->id;   
            }
            return $onair_programme;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function get_highlighted_programs($company_id){	
		 $query=$this->db->query("SELECT t.name,t.description,t.audio_src,t.detail_description,a.track_image,t.duration,t.id,t.protocol_type FROM tracks as t
									   LEFT JOIN assign_tracks as a ON(t.id=a.track_id) 
									   WHERE a.company_id=".$company_id." AND a.heighlight=1  GROUP BY t.id ORDER BY a.date DESC");	 		 
		 return $query->result();
	}
	
	function program_list($company_id){	
		 $query=$this->db->query("SELECT t.name,t.description,t.audio_src,t.duration,t.detail_description,a.track_image,t.protocol_type,
		                                    t.id,a.date as track_date,a.disable_download FROM tracks as t
									   LEFT JOIN assign_tracks as a ON(t.id=a.track_id) 
									   WHERE a.company_id=".$company_id." AND a.type='Library' GROUP BY t.id");	
									  	 
		 return $query->result();	}
	

	function get_current_live_show($company_id){	
		 $query=$this->db->query("SELECT t.name,t.description,t.audio_src,t.detail_description,a.track_image,t.duration,t.id,a.date as track_date FROM tracks as t
									   LEFT JOIN assign_tracks as a ON(t.id=a.track_id) 
									   WHERE a.company_id=".$company_id." AND a.type='Live' GROUP BY t.id");	 		 
		 return $query->result();
	}
	
	function get_listeners($company_id,$track_id){	
		 $query=$this->db->query("SELECT l.id FROM track_user_log as l
									   LEFT JOIN users as u ON(l.user_id=u.id) 
									   WHERE u.company_id=".$company_id." AND l.track_id=".$track_id." ");	 		 
		 return $query->num_rows();
	}
	
	function get_previous_tracks($company_id){	
		 $query=$this->db->query("SELECT t.name,t.description,t.audio_src,t.detail_description,t.id,h.date as track_date FROM company_track_history as h
									   LEFT JOIN tracks as t ON(t.id=h.track_id) 
									   WHERE h.company_id=".$company_id."");	 		 
		 return $query->result();
	}
	
	function get_company_news_list($company_id){	
		 $query=$this->db->query("SELECT n.title,n.id,n.image  FROM company_news_rel as c
									   LEFT JOIN news as n ON(n.id=c.news_id) 
									   WHERE c.company_id=".$company_id."");	
									 	 
		 return $query->result();
	}
	
	function get_downloads_count($track_id,$user_id){
		
		$this->db->select('download_count');
        $this->db->from('user_downloads');
        $this->db->where('user_id', $user_id);
		$this->db->where('track_id', $track_id);		
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $download_count = $row->download_count;
            }
            return $download_count;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function fetch_user_id_from_code($reset_code){
		
		$this->db->select('id');
        $this->db->from('users');
        $this->db->where('reset_password_code', $reset_code);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $user_id = $row->id;
            }
            return $user_id;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function fetch_admin_user_id_from_code($reset_code){
		
		$this->db->select('id');
        $this->db->from('admin_users');
        $this->db->where('reset_password_code', $reset_code);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            foreach ($select_query->result() as $row)
            {
                $user_id = $row->id;
            }
            return $user_id;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	
	function check_company_url($company_url){
		
		$this->db->select('id');
        $this->db->from('company');
        $this->db->where('company_url', $company_url);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            return TRUE;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function check_company_access($company_url){
		
		$this->db->select('*');
        $this->db->from('company');
        $this->db->where('company_url', $company_url);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
             foreach ($select_query->result() as $row)
            {
                $company_id = $row->id;
				$access_type = $row->radio_access;
            }
		}
		
		if($access_type=='public')
		
		  return true;
		  
		else{
		  
		  $this->db->select('ip_address');
          $this->db->from('company_allowed_ip');
          $this->db->where('company_id', $company_id);
		  $this->db->where('status', 1);	
          $select_query   = $this->db->get ();
		  if (0 < $select_query->num_rows ())
		  {
              foreach ($select_query->result() as $row)
              {
                  $ip_address = $row->ip_address;
				  if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
				     $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				  else
				     $user_ip = $_SERVER['REMOTE_ADDR']; 	 
				  if($this->ip_in_range($user_ip,$ip_address))			   				   
				    return true;

               }
			  $this->save("ip_log",array("ip_address"=>$user_ip,"log_date"=>date("Y-m-d H:m:s"),"status"=>1)); 
			  return false; 
		   }
		  else
		    return true; 
		  	
		}
		
	 return true;	
	
	}
	
	
	function check_mail($email){
		
		$this->db->select('id');
        $this->db->from('users');
        $this->db->where('email', $email);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            return TRUE;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function check_admin_mail($email){
		
		$this->db->select('id');
        $this->db->from('admin_users');
        $this->db->where('email', $email);	
        $select_query   = $this->db->get ();
		if (0 < $select_query->num_rows ())
		{
            return TRUE;
		}
		else
		{
		    return FALSE;
		}	 
	
	}
	
	function check_poll($user_id,$common_url,$company_id){  
	  if($common_url==0){
		  	 
		$query=$this->db->query("SELECT p.id FROM poll_answers as p LEFT JOIN polls as ps ON(ps.id=p.poll_question_id) 
		                  WHERE p.user_id=".$user_id." AND ps.company_id=".$company_id."");	
						  
		 if ($query->num_rows() > 0)
		{
			
            return FALSE;
		}
		else
		{
		    return TRUE;
		}	 	
	  }
	  
	  else{
		return TRUE;  
	  }
	
	}
	
	function get_total_poll($poll_id){
	  
	    $this->db->select('id');
        $this->db->from('poll_answers');
        $this->db->where('poll_question_id', $poll_id);	
        $select_query   = $this->db->get ();
		$total_poll=$select_query->num_rows (); 
		return  $total_poll;
	
	}
	
	function get_poll_answer_count($poll_id,$option){
	  
	    $this->db->select('id');
        $this->db->from('poll_answers');
        $this->db->where('poll_question_id', $poll_id);
		$this->db->where('poll_answer', $option);	
        $select_query   = $this->db->get ();
		$poll_answer_count=$select_query->num_rows ();
		return  $poll_answer_count;	 
	
	}
	
	function forget_password_update($data,$email_id) 
   {
      $this->db->where('email', $email_id);
      $this->db->update('users', $data);	  
	  return true;              
    }
	function forget_admin_password_update($data,$email_id) 
   {
      $this->db->where('email', $email_id);
      $this->db->update('admin_users', $data);	  
	  return true;              
    }
	
	/**
 * Check if a given ip is in a network
 * @param  string $ip    IP to check in IPV4 format eg. 127.0.0.1
 * @param  string $range IP/CIDR netmask eg. 127.0.0.0/24, also 127.0.0.1 is accepted and /32 assumed
 * @return boolean true if the ip is in this range / false if not.
 */
   function ip_in_range( $ip, $range ) {
	 if ( strpos( $range, '/' ) == false ) {
		$range .= '/32';
	 }
	// $range is in IP/CIDR format eg 127.0.0.1/24
	list( $range, $netmask ) = explode( '/', $range, 2 );
	$range_decimal = ip2long( $range );
	$ip_decimal = ip2long( $ip );
	$wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
	$netmask_decimal = ~ $wildcard_decimal;
	return ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );
  }          
	
 /* function create_user(){
    
	$this->db->query("INSERT INTO users (first_name,last_name,username,password,email,status) VALUES('ANEESH','MOHAN','admin',LEFT(MD5(CONCAT(MD5('admin'), 'cloud')), 50),'annesh@websight.net',1)");
  
  }	*/
	   
	 	 
 
} 
?>