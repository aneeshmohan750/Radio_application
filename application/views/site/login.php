	<div class="se-pre-con"></div>
	<div class="loginSection">
        	<span class="bgMic"></span>
            <div class="signUp">
            	<h2><a href="javascript:void(0);"></a></h2>
            </div>
            <div class="loginFormSection wow bounceInDown center">
            	<h2><span>login</span><hr></h2>
                <div class="formHolder">
				<div class="errorHolder" style="display:none;">
                    	<p id="message_div" ></p>
                 </div>
                <form name="loginForm">
                	<div class="inputHolderContact queryInput">
                    	<span class="username"></span>
                        <label>Username</label>
                        <input type="text" id="username" name="username">
                    </div>
                    <div class="inputHolderContact queryInput">
                    	<span class="password"></span>
                        <label>Password</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <input type="hidden" name="company_url" id="company_url" value="<?php echo $company_url; ?>" />
                    <p><a href="<?php echo base_url(); ?>forget_password">Forgot your password?</a></p>
                    <a class="login" id="user_login" href="javascript:void(0);" >login</a>
                    <!--<a class="login" id="active_directory_login" href="javascript:void(0);">login</a>-->
                </form>
                </div>
            </div>
        </div>
        <script>
  wow = new WOW(
    {
   animateClass: 'animated',
   offset:       250,
   callback:     function(box) {
   console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
   }
    }
  );
  wow.init();
//  document.getElementById('moar').onclick = function() {
//    var section = document.createElement('section');
//    section.className = 'section--purple wow fadeInDown';
//    this.parentNode.insertBefore(section, this);
//  };

 $(document).ready(function(){
       $(".se-pre-con").fadeOut("slow");
	   $("#username,#password").keyup(function(event){
          if(event.keyCode == 13){
            $("#user_login").click();
          }
       }); 
	  $('#user_login').click(function(){
	        $(".se-pre-con").fadeIn("slow");
			var company_url=$('#company_url').val();
			$('.errorHolder').hide();
	        if($('#username').val()!='' && $('#password').val()!='')
			{
				dataString = $('form[name=loginForm]').serialize();
				$.ajax({
					type:'POST',
					data:dataString,
					dataType:'json',
					url:'<?php echo base_url();?>'+'index.php/common_ajax/verifylogin',
					success:function(data) {
						  if (data.status=='success'){
							window.location.href = "<?php echo base_url();?>"+company_url+"";			    				  
						  }
						  else{	
						     $(".se-pre-con").fadeOut("slow");		  
							 $('#message_div').html(data.message);
							 $('.errorHolder').show();					
						  }
					}             
				});
		    }
			else{
			 $(".se-pre-con").fadeOut("slow");
			 $('#message_div').html("Invalid Username or Password.");
			 $('.errorHolder').show();
			}			  		  								  
	   });
	  
	   $('#active_directory_login').click(function(){
	        $(".se-pre-con").fadeIn("slow");
			$('.errorHolder').hide();
	        if($('#username').val()!='' && $('#password').val()!='')
			{
				dataString = $('form[name=loginForm]').serialize();
				$.ajax({
					type:'POST',
					data:dataString,
					dataType:'json',
					url:'<?php echo base_url();?>'+'index.php/common_ajax/activedirectorylogin',
					success:function(data) {
						  if (data.status=='success'){
							window.location.href = "<?php echo base_url();?>";			    				  
						  }
						  else{	
						     $(".se-pre-con").fadeOut("slow");		  
							 $('#message_div').html(data.message);
							 $('.errorHolder').show();					
						  }
					}             
				});
		    }
			else{
			 $(".se-pre-con").fadeOut("slow");
			 $('#message_div').html("Invalid Username or Password.");
			 $('.errorHolder').show();
			}			  		  								  
	   }); 
	   
	});

</script>
