<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Timbre Media Radio Admin Forgot Password</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $this->config->item('assets_url')?>admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo $this->config->item('assets_url')?>admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo $this->config->item('assets_url')?>admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo $this->config->item('assets_url')?>admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reset Password</h3>
                    </div>
					<div id="message_div"></div>
                    <div class="panel-body">
                        <form name="resetpasswordForm">
                          <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?> " />
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="New Password" name="password" id="password" type="password" autofocus>
                                </div>  
                                
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password" type="password" autofocus>
                                </div>                              
                               
                                <!-- Change this to a button or input when using this as a form -->
                                <a id="reset_password" class="btn btn-lg btn-success btn-block">Submit</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo $this->config->item('assets_url')?>admin/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $this->config->item('assets_url')?>admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo $this->config->item('assets_url')?>admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo $this->config->item('assets_url')?>admin/dist/js/sb-admin-2.js"></script>

<script>
	$(document).ready(function(){
	   $("#password,#confirm_password").keyup(function(event){
          if(event.keyCode == 13){
            $("#reset_password").click();
          }
       }); 
	  $('#reset_password').click(function(){
			var password = $('#password').val();
			var confirm_password=$('#confirm_password').val();
			if(password=='' || confirm_password==''){
				  $('#message_div').html("<div class='alert alert-danger'>Please Enter Password</div>");	
			}
			else if($('#password').val()!= $('#confirm_password').val()){
			     $('#message_div').html("<div class='alert alert-danger'>Password Mismatch</div>");			
			}
	        else
			{
				dataString = $('form[name=resetpasswordForm]').serialize();
				$.ajax({
					type:'POST',
					data:dataString,
					dataType:'json',
					url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/reset_password',
					success:function(data) {
						  if (data.status=='success'){
							 window.location.href = "<?php echo base_url();?>/admin/index";	    				  
						  }
					}             
				});
		    }	  		  								  
	   });
	});
</script>


