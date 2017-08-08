<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Create User</h1>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"> Create User </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
              <form role="form" id="create_user_form" name="create_user_form">
                <div class="loadings" style="display:none;">
						<img src="<?php echo $this->config->item('assets_url')?>images/preloader.gif"><span>Processing your request...</span></div>
                <div class="form-group">
                  <label>First Name<em>*</em></label>
                  <input class="form-control" placeholder="First Name" id="first_name" name="first_name">
                  <p class="help-block"></p>
                </div>
                <div class="form-group">
                  <label>Last Name<em>*</em></label>
                  <input class="form-control" placeholder="Last Name" id="last_name" name="last_name">
                </div>
                <div class="form-group">
                  <label>Username<em>*</em></label>
                  <input class="form-control" placeholder="Username" id="username" name="username">
                </div>
                <div class="form-group">
                  <label>Email<em>*</em></label>
                  <input class="form-control" placeholder="Email" id="email" name="email">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input class="form-control" placeholder="Password" id="password" name="password" type="password">
                </div>
                 <div class="form-group">
                  <label>Confirm Password</label>
                  <input class="form-control" placeholder="Confirm Password" id="confirm_password" name="confirm_password" type="password">
                </div>
                 <div class="form-group">
                  <label>Company<em>*</em></label>
                  <select class="form-control" name="company_id" id="company_id"><option value="-1">
                    <?php foreach($company_list as $company): ?>
                     <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                    <?php endforeach; ?>
                  </select>  
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
$(document).ready(function(){
	$('#create_user_form').submit(function(e) {
	       e.preventDefault();
		   var first_name = $("#first_name").val();
		   var last_name  =  $("#last_name").val();
		   var username = $("#username").val();
		   var password = $("#password").val();
		   var confirm_password = $("#confirm_password").val();
		   
		   if(first_name==null || first_name==''){
				alert("Please enter first name");
				$("#first_name").focus();
				return false;
			}
		   else if(last_name==null || last_name==''){
			  	alert("Please enter last name ");
				return false;
		   }
		   else if(username==null || username==''){
			    alert("Please enter username");
				return false;
		   }
		   else if(password!=confirm_password){
			    alert("Password Mismatch");
				return false;  
		   }
		   $('.loadings').show();	
		   dataString = jQuery('form[name=create_user_form]').serialize();  
		   $.ajax({   
							type:'POST',
							data:dataString,
							dataType:'json',
							url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/create_user',
							success: function(data){
								if(data.status=="success"){				
									window.location='<?php echo base_url(); ?>admin/index/user'; 
								}
								else if(data.status=='email_exist'){
								   $('.loadings').hide();
								   swal("Validation Error!", "Email Id already exist", "error");
								}
								else{
								   $('.loadings').hide();
								}
													
							}
			});  
	    
  });
	
});

</script> 