<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Import Users</h1>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"> Import Users </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
              <form role="form" id="import_user_form" name="import_user_form">
                <div class="loadings" style="display:none;">
						<img src="<?php echo $this->config->item('assets_url')?>images/preloader.gif"><span>Processing your request...</span></div>
                <div class="controls" style="float:right;margin-right:-300px"> <a target="_blank" href="<?php echo base_url(); ?>admin/index/download_csv/users_import.csv">Download Sample CSV for User Import</a></div>        
                <div class="form-group">
                  <label>Upload File</label>
                  <div class="controls">
                    <input type="file" name="import_user_file" id="import_user_file" style="float:left">
                    <input type="button" id="upload_import_user" class="btn btn-primary" value="Upload" />
                    <input type="hidden" name="import_user" id="import_user" />
                   
                  </div>
                   <span id="upload_success_message"></span>
 
                </div>
                 <div class="form-group">
                 <label>Company</label>
                  <select class="form-control" style="width:250px;" name="company_id" id="company_id" >
                      <option value="-1"></option>
                      <?php foreach($company_list as $company): ?>
                       <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                      <?php endforeach; ?>
                 </select> 
                 
                
                  <div class="error_list"></div> 
                </div>
                <a  id="validate_btn" name="validate_btn" class="btn btn-primary">Validate</a>
                <a style="display:none;"  id="import_btn" name="import_btn" class="btn btn-primary">Import</a>
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
$(document).ready(function(){
	
	$('#upload_import_user').on('click', function() {
		var file_data = $('#import_user_file').prop('files')[0];
		var ext = $('#import_user_file').val().split('.').pop().toLowerCase();
		var file_name=$('#import_user_file').val();
		if(file_name==''){
		  alert("Please select a file")
	      return false;
		}
		if(ext!='xlsx' && ext!='csv') {
			 alert("Invalid File");
			 return false;
		 }
		$('.loadings').show();     
		var form_data = new FormData();                  
		form_data.append('file', file_data);                    
		$.ajax({
				    url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/upload_excel', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                         
					type: 'post',
					success: function(php_script_response){
						$('#import_user').val(php_script_response);
						$('.loadings').hide();
						$('#upload_success_message').html('File has been successfully uploaded');
						$('#upload_success_message').show();
					}
		 });
	});	
	
	
	$('#validate_btn').on('click', function() {     
	  var uploaded_file  = $('#import_user').val();
	  var company  = $('#company_id').val();  	
	  var reurl=''; 
	  if(uploaded_file==''){
	        alert("Please upload the file");
			 return false; 
	  }
	  if(company==-1){
	     alert("Please select company");
			 return false; 
	  }
	  var ext = uploaded_file.split('.').pop().toLowerCase();
	  if(ext=='xlsx')
	    reurl='<?php echo base_url();?>'+'index.php/admin/custom_ajax/validate_user_excel_file';
	  else if(ext=='csv')
	    reurl='<?php echo base_url();?>'+'index.php/admin/custom_ajax/validate_user_csv_file';
	   $('.error_list').html('');
	   $('.loadings').show();    
	   $.ajax({   
							type:'POST',
							data:'uploaded_file='+uploaded_file+'&company='+company,
							dataType:'json',
							url:reurl,
							success: function(data){
								if(data.status=="success"){													 
									$('.loadings').hide();
									swal("Validated Successfully!", "Import file has been validated successfully.", "success");   									
									$('#validate_btn').hide();
									$('#import_btn').show();
								}
								else if(data.status=="error_company"){
								   $('.loadings').hide();
								   swal("Validation Error!", "Company Name not found", "error");
								   $('.error_list').html('<h4><strong>Following Comapany Names Not found</strong></h4>');
								   data.name_arr.forEach(function(entry) {
                                          $('.error_list').append('<p>'+entry+' is not found</p>');
                                   });   
								}
								
								else if(data.status=="error_email"){
								   $('.loadings').hide();
								   swal("Validation Error!", "Email id already exist in the system", "error");
								   $('.error_list').html('<h4><strong>Following Email ids already exist in the system.</strong></h4>');
								   data.email_arr.forEach(function(entry) {
                                          $('.error_list').append('<p>'+entry+' is already exist</p>');
                                   });   
								}
								
								else if(data.status=="email_duplicate"){
								   $('.loadings').hide();
								   swal("Validation Error!", "Duplicate entries for email id exist in the file.", "error");
								}
								
								else{
								   $('.loadings').show();
								   swal("Validation Error!", "Excel Format is incorrect beacuse of fields mismatch.", "error");
								}
													
							},
						 error: function (request, status, error) {
                              $('.loadings').show();
                         }
					}); 
	  

 });
 
 $('#import_btn').on('click', function() {     
	   var uploaded_file  = $('#import_user').val();
	   var company  = $('#company_id').val();	
	   var reurl='';
	   var ext = uploaded_file.split('.').pop().toLowerCase();
	  if(ext=='xlsx')
	    reurl='<?php echo base_url();?>'+'index.php/admin/custom_ajax/import_user_excel_file';
	  else if(ext=='csv')
	    reurl='<?php echo base_url();?>'+'index.php/admin/custom_ajax/import_user_csv_file';	 
	   $('.loadings').show();    
	   $.ajax({   
							type:'POST',
							data:'uploaded_file='+uploaded_file+'&company='+company,
							dataType:'json',
							url:reurl,
							success: function(data){
								if(data.status=="success"){													 
									$('.loadings').hide();
									swal("Imported Successfully!", "File has been imported successfully.", "success");   									
								}
								else{
								   $('.loadings').show();
								   swal("Validation Error!", "Mandatory fields are not set.", "error");
								}
													
							},
						 error: function (request, status, error) {
                              $('.loadings').show();
                         }
					}); 
	  

 });
		 
	
	
});

</script> 