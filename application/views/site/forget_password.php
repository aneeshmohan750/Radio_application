	<div class="se-pre-con"></div>
	<div class="loginSection">
        	<span class="bgMic"></span>
            <div class="signUp">
            	<h2><a href="javascript:void(0);"></a></h2>
            </div>
            <div class="loginFormSection wow bounceInDown center">
            	<h2><span>Forgot Password</span><hr></h2>
                <div class="formHolder">
				<div class="errorHolder" style="display:none;">
                    	<p id="message_div" ></p>
                 </div>
                 <div class="successHolder" style="display:none;">
                            <p id="successmessage"></p>
       </div>
                <form name="forgetpasswordForm">
                	<div class="inputHolderContact queryInput">
                    	<span class="email"></span>
                        <label>Email</label>
                        <input type="text" id="email" name="email">
                    </div>
                      <p><a href="<?php echo base_url(); ?>login">Back to login</a></p>                
                    <a class="login" id="forgot_password" href="javascript:void(0);">Send</a>
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
	   
	    $('#forgot_password').click(function(){
	        $(".se-pre-con").fadeIn("slow");
			$('.errorHolder').hide();
			$('.successHolder').hide();
	        if($('#email').val()!='')
			{
				dataString = $('form[name=forgetpasswordForm]').serialize();
				$.ajax({
					type:'POST',
					data:dataString,
					dataType:'json',
					url:'<?php echo base_url();?>'+'index.php/common_ajax/forget_password',
					success:function(data) {
						  if (data.status=='success'){
							 $(".se-pre-con").fadeOut("slow");		  
							 $('#successmessage').html('Password reset link has been sent.');
							 $('.successHolder').show();			    				  
						  }
						  else{	
						     $(".se-pre-con").fadeOut("slow");		  
							 $('#message_div').html('Email id not found');
							 $('.errorHolder').show();					
						  }
					}             
				});
		    }
			else{
			 $(".se-pre-con").fadeOut("slow");
			 $('#message_div').html("Invalid email.");
			 $('.errorHolder').show();
			}			  		  								  
	   });
	   
	   
	   
 });

</script>
