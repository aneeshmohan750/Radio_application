<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Create Company</h1>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"> Create Company </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
              <form role="form" id="create_company_form" name="create_company_form">
                <div class="loadings" style="display:none;">
						<img src="<?php echo $this->config->item('assets_url')?>images/preloader.gif"><span>Processing your request...</span></div>
                <div class="form-group">
                  <label>Company Name<em>*</em></label>
                  <input class="form-control" placeholder="Company Name" id="company_name" name="company_name">
                  <p class="help-block"></p>
                </div>
                <div class="form-group">
                  <label>Location</label>
                  <input class="form-control" placeholder="Location" id="location" name="location">
                </div>
                <div class="form-group">
                  <label>Company Logo<em>*</em></label>
                  <div class="controls">
                    <input type="file" name="company_logo" id="company_logo" style="float:left">
                    <input type="button" id="upload_company_logo" class="btn btn-primary" value="Upload" />
                    <input type="hidden" name="uploaded_logo" id="uploaded_logo" />
                    <div id="logo"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Radio Name<em>*</em></label>
                  <input class="form-control" placeholder="Radio Name" id="radio_name" name="radio_name">
                </div>
                <div class="form-group">
                 <label>Show Radio Logo</label>
                <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1"  id="enable_radio_logo" name="enable_radio_logo">
                      Show Radio Logo on Header </label>
                  </div>
               </div>   
                <div class="form-group radio-logo">
                  <label>Radio Logo (Resolution 57 X 57) (jpg and png images only)</label>
                  <div class="controls">
                    <input type="file" name="radio_logo" id="radio_logo" style="float:left">
                    <input type="button" id="upload_radio_logo" class="btn btn-primary" value="Upload" />
                    <input type="hidden" name="uploaded_logo_radio" id="uploaded_logo_radio" />
                    <div id="logo_radio"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Email<em>*</em></label>
                  <input class="form-control" placeholder="Email" id="email" name="email">
                </div>
                <div class="form-group">
                  <label>Page Title<em>*</em></label>
                  <input class="form-control" placeholder="Page Title" id="page_title" name="page_title">
                </div>
                <div class="form-group">
                  <label>Page Banner (Resolution 1349 X 334)</label>
                  <div class="controls">
                    <input type="file" name="page_banner" id="page_banner" style="float:left">
                    <input type="button" id="upload_page_banner" class="btn btn-primary" value="Upload" />
                    <input type="hidden" name="uploaded_banner" id="uploaded_banner" />
                    <div id="banner"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Favicon (Resolution 100 X 100)(png images only)</label>
                  <div class="controls">
                    <input type="file" name="favicon" id="favicon" style="float:left">
                    <input type="button" id="upload_favicon" class="btn btn-primary" value="Upload" />
                    <input type="hidden" name="uploaded_favicon" id="uploaded_favicon" />
                    <div id="favicon"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label>News</label>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" id="enable_news" name="enable_news" >
                      Enable News Section </label>
                  </div>
                </div>
                <div class="form-group">
                  <label>Active Directory Login</label>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1"  id="active_directory_login" name="active_directory_login">
                      Enable Active Directory Login for users </label>
                  </div>
                </div>
                <div class="form-group active-directory">
                  <label>Domain FQDN</label>
                  <input class="form-control" placeholder="Domain FQDN" id="domain_fqdn" name="domain_fqdn">
                </div>
                <div class="form-group active-directory">
                  <label>LDAP Server</label>
                  <input class="form-control" placeholder="LDAP Server" id="ldap_server" name="ldap_server">
                </div>
                 <div class="form-group">
                  <label>Company Single Login</label>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1"  id="active_single_login" name="active_single_login">
                      Enable Single Login for this company </label>
                  </div>
                </div>
               <!-- <div class="form-group single-login">
                  <label>IP Address</label>
                  <input class="form-control" placeholder="IP Address" id="ip_address" name="ip_address">
                </div>-->
                
               <div class="form-group">
                  <label>Radio Access Type</label>
                  <select name="radio_access" id="radio_access" class="form-control">
                   <option value="public">Public</option>
                   <option value="custom">Custom</option>
                  </select>
                </div>   
               <div class="form-group" style="display:none;" id="ip_address_map">
                  <label>IP Address</label>
                  <div id="ip_address_list">
                   <input class="form-control ip_list" placeholder="IP" id="ip_address1" name="ip_address[]">
                  </div>
                  <a href="javascript:void(0);" id="add_list">Add</a>
                </div>
                
                <div class="form-group">
                  <label>Footer Line</label>
                  <textarea name="footer_line" id="footer_line" class="form-control" placeholder="Footer Line" rows="4" ></textarea>
                </div>
                
                <div class="form-group">
                  <label>Welcome Mail Format</label>
                  <textarea name="mail_format" id="mail_format" class="form-control" placeholder="Content" rows="4" ></textarea>
                </div>
                
                <button type="submit" id="submit_btn" name="submit_btn" class="btn btn-primary">Submit</button>
              <!--  <button type="reset" class="btn btn-default">Reset Button</button>-->
              </form>
            </div>
          </div>
          <!-- /.row (nested) --> 
        </div>
        <!-- /.panel-body --> 
      </div>
      <!-- /.panel --> 
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row --> 
</div>
<script>

if(CKEDITOR.instances['mail_format']) { delete CKEDITOR.instances["mail_format"];}
		CKEDITOR.replace("mail_format",{height:"300",width:"900",extraAllowedContent: 'style;*[id,rel](*){*}'});
		

$(document).ready(function(){
	$('#upload_company_logo').on('click', function() {
		var file_data = $('#company_logo').prop('files')[0];
		var ext = $('#company_logo').val().split('.').pop().toLowerCase();
		var file_name=$('#company_logo').val();
		if(file_name==''){
		  alert("Please select a file")
	      return false;
		}
		if(ext!='jpg' && ext!='png') {
			 alert("Invalid File");
			 return false;
		 }
		$('.loadings').show();     
		var form_data = new FormData();                  
		form_data.append('file', file_data);                    
		$.ajax({
				    url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/upload_image', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                         
					type: 'post',
					success: function(php_script_response){
						$('#uploaded_logo').val(php_script_response);
						$('#logo').html('<img width="200" src="<?php echo base_url();?>uploads/logo/'+php_script_response+'">');
						$('.loadings').hide();
					}
		 });
	});
	
	$('#upload_radio_logo').on('click', function() {
		var file_data = $('#radio_logo').prop('files')[0];
		var ext = $('#radio_logo').val().split('.').pop().toLowerCase();
		var file_name=$('#radio_logo').val();
		if(file_name==''){
		  alert("Please select a file")
	      return false;
		}
		if(ext!='jpg' && ext!='png') {
			 alert("Invalid File");
			 return false;
		 }
		$('.loadings').show();     
		var form_data = new FormData();                  
		form_data.append('file', file_data);                    
		$.ajax({
				    url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/upload_radio_image', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                         
					type: 'post',
					success: function(php_script_response){
						$('#uploaded_logo_radio').val(php_script_response);
						$('#logo_radio').html('<img width="200" src="<?php echo base_url();?>uploads/radio_logo/'+php_script_response+'">');
						$('.loadings').hide();
					}
		 });
	});
	
	
	$('#upload_page_banner').on('click', function() {
		var file_data = $('#page_banner').prop('files')[0];
		var ext = $('#page_banner').val().split('.').pop().toLowerCase();
		var file_name=$('#page_banner').val();
		if(file_name==''){
		  alert("Please select a file")
	      return false;
		}
		if(ext!='jpg' && ext!='png') {
			 alert("Invalid File");
			 return false;
		 }
		$('.loadings').show();     
		var form_data = new FormData();                  
		form_data.append('file', file_data);                    
		$.ajax({
				    url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/upload_page_banner', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                         
					type: 'post',
					success: function(php_script_response){
						$('#uploaded_banner').val(php_script_response);
						$('#banner').html('<img width="200" src="<?php echo base_url();?>uploads/banner/'+php_script_response+'">');
						$('.loadings').hide();
					}
		 });
	});
	
	$('#upload_favicon').on('click', function() {
		var file_data = $('#favicon').prop('files')[0];
		var ext = $('#favicon').val().split('.').pop().toLowerCase();
		var file_name=$('#favicon').val();
		if(file_name==''){
		  alert("Please select a file")
	      return false;
		}
		if(ext!='png') {
			 alert("Invalid File only png files allowed");
			 return false;
		 }
		$('.loadings').show();     
		var form_data = new FormData();                  
		form_data.append('file', file_data);                    
		$.ajax({
				    url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/upload_favicon', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                         
					type: 'POST',
					success: function(data){
						if(data.status=='success'){
							$('#uploaded_favicon').val(data.filename);
							$('#favicon_image').html('<img width="100" src="<?php echo base_url();?>uploads/favicon/'+data.filename+'">');
							$('.loadings').hide();							
						}
						else{
							$('.loadings').hide();
							swal("Wrong Image Resolution!", "Favicon resolution should be 100 X 100", "error");
						}
					}
		 });
	});
	
   $('#active_directory_login').click(function(){	   
	    if ($('#active_directory_login').is(":checked")){			 
			 $('.active-directory').fadeIn(100);			 
		}
		else{
		   $('.active-directory').fadeOut(100);		  	
		}
	   
   });
   
   $('#enable_radio_logo').click(function(){	   
	    if ($('#enable_radio_logo').is(":checked")){			 
			 $('.radio-logo').fadeIn(100);			 
		}
		else{
		   $('.radio-logo').fadeOut(100);		  	
		}
	   
   });
   
   $('#radio_access').change(function(){
      
	  var radio_access = $(this).val();
	  if(radio_access=='public')
	    $('#ip_address_map').hide();
	  else
	     $('#ip_address_map').show();	
	    
   });
   
   $('#add_list').click(function(){
	  
	  $('#ip_address_list').append('<input class="form-control ip_list" placeholder="IP"  name="ip_address[]"><a href="javascript:void(0);>Delete</a>"'); 
	   
   });
   
   /*$('#active_single_login').click(function(){	   
	    if ($('#active_single_login').is(":checked")){			 
			 $('.single-login').fadeIn(100);			 
		}
		else{
		   $('.single-login').fadeOut(100);		  	
		}
	   
   });*/


  $('#create_company_form').submit(function(e) {
	       e.preventDefault();
		   CKupdate();
		   var name = $("#company_name").val();
		   var logo = $("#uploaded_logo").val();
		   var radio_logo = $("#uploaded_logo_radio").val();
		   var radio_name = $("#radio_name").val();
		   if(name==null || name==''){
				alert("Please enter Company  name");
				$("#company_name").focus();
				return false;
			}
		   else if(logo==null || logo==''){
			  	alert("Please upload company  logo");
				return false;
		   }
		   else if(radio_name==null || radio_name==''){
			    alert("Please enter radio name");
				return false;
		   }
		   else if ($('#enable_radio_logo').is(":checked") && radio_logo==''){	
		        alert("Please upload radio logo");
				return false;
		   }
		   $('.loadings').show();	
		   dataString = jQuery('form[name=create_company_form]').serialize();  
		   $.ajax({   
							type:'POST',
							data:dataString,
							dataType:'json',
							url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/create_company',
							success: function(data){
								if(data.status=="success"){				
									window.location='<?php echo base_url(); ?>admin/index/company'; 
								}
								else{
								   $('.loadings').hide();
								}
													
							}
			});  
	    
  });
	
});

function CKupdate(){
    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances['mail_format'].updateElement();
}

</script> 