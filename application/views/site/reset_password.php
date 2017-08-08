	<div class="se-pre-con"></div>
	<div class="loginSection">
        	<span class="bgMic"></span>
            <div class="signUp">
            	<h2><a href="javascript:void(0);"></a></h2>
            </div>
            <div class="loginFormSection wow bounceInDown center">
            	<h2><span>Reset Password</span><hr></h2>
                <div class="formHolder">
				<div class="errorHolder" style="display:none;">
                    	<p id="message_div" ></p>
                 </div>
                 <div class="successHolder" style="display:none;">
                            <p id="successmessage"></p>
       </div>
                <form name="resetpasswordForm">
                   <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?> " />
                	 <div class="inputHolderContact queryInput">
                    	<span class="password"></span>
                        <label>New Password</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="inputHolderContact queryInput">
                    	<span class="password"></span>
                        <label>Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password">
                    </div>
                      <p><a href="<?php echo base_url(); ?>login">Back to login</a></p>                
                    <a class="login" id="reset_password" href="javascript:void(0);">Reset</a>
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
	    $('#reset_password').click(function(){
	        $(".se-pre-con").fadeIn("slow");
			$('.errorHolder').hide();
			var password = $('#password').val();
			var confirm_password=$('#confirm_password').val();
			if(password=='' || confirm_password==''){
				  $(".se-pre-con").fadeOut("slow");		  
				  $('#message_div').html('Invalid Entry');
				  $('.errorHolder').show();		
			}
			else if($('#password').val()!= $('#confirm_password').val()){
			      $(".se-pre-con").fadeOut("slow");		  
				  $('#message_div').html('Password Mismatch');
				  $('.errorHolder').show();			
			}
	        else
			{
				dataString = $('form[name=resetpasswordForm]').serialize();
				$.ajax({
					type:'POST',
					data:dataString,
					dataType:'json',
					url:'<?php echo base_url();?>'+'index.php/common_ajax/reset_password',
					success:function(data) {
						  if (data.status=='success'){
							 window.location.href = "<?php echo base_url();?>";	    				  
						  }
					}             
				});
		    }	  		  								  
	   });
	   
	   
	   
 });

</script>
