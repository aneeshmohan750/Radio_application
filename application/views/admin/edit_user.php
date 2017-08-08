<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Edit User</h1>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"> Edit User </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
            <?php if($user_details){ ?>
              <?php foreach($user_details as $user): ?>
              <form role="form" id="edit_user_form" name="edit_user_form">
              <input type="hidden" name="user_id" id="user_id" value="<?php echo $user['id']; ?>" />
                <div class="loadings" style="display:none;">
						<img src="<?php echo $this->config->item('assets_url')?>images/preloader.gif"><span>Processing your request...</span></div>
                <div class="form-group">
                  <label>First Name<em>*</em></label>
                  <input class="form-control" placeholder="First Name" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>">
                  <p class="help-block"></p>
                </div>
                <div class="form-group">
                  <label>Last Name<em>*</em></label>
                  <input class="form-control" placeholder="Last Name" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>">
                </div>
                <div class="form-group">
                  <label>Username<em>*</em></label>
                  <input class="form-control" placeholder="Username" id="username" name="username" value="<?php echo $user['username']; ?>" >
                </div>
                <div class="form-group">
                  <label>Email<em>*</em></label>
                  <input class="form-control" placeholder="Email" id="email" name="email" value="<?php echo $user['email']; ?>" >
                </div>
                 <div class="form-group">
                  <label>Company<em>*</em></label>
                  <select class="form-control" name="company_id" id="company_id"><option value="-1">
                    <?php foreach($company_list as $company): ?>
                     <option <?php if($user['company_id']==$company['id']) echo "selected='selected'";?> value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                    <?php endforeach; ?>
                  </select>  
                </div>
                <button type="submit" id="submit_btn" name="submit_btn" class="btn btn-primary">Submit</button>
              <!--  <button type="reset" class="btn btn-default">Reset Button</button>-->
              </form>
              <?php endforeach; ?>
              <?php } ?>
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
	$('#edit_user_form').submit(function(e) {
	       e.preventDefault();
		   var first_name = $("#first_name").val();
		   var last_name  =  $("#last_name").val();
		   var username = $("#username").val();
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
		   $('.loadings').show();	
		   dataString = jQuery('form[name=edit_user_form]').serialize();  
		   $.ajax({   
							type:'POST',
							data:dataString,
							dataType:'json',
							url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/edit_user',
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