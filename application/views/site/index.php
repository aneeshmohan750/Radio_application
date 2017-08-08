<div id="home-preloader"></div>
<section class="banner">
	<span class="bgGradient <?php if(!$onair_programme) echo "hideRadio"; ?>"></span>
  <div class="newRadioHolder <?php if(!$onair_programme) echo "hideRadio"; ?> ">
    <div class="radioPlayerSection">
      <h3 id="programme_type">on air now</h3>
      <h2 id="programme_name"><?php echo $onair_programme; ?></h2>
      <div class="playerRadio">
      <?php if($onair_track_protocol_type=='http'){ ?>
        <audio  id="audio_player" controls src="<?php if($onair_programme_src) echo $onair_programme_src; else echo "".base_url()."uploads/audio/zbxMhk9myR.mp3" ?>"></audio>
      <?php } ?>
      <?php if($onair_track_protocol_type=='mms'){ ?>
        <object id="mediaplayer" classid="clsid:22d6f312-b0f6-11d0-94ab-0080c74c7e95" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#version=5,1,52,701" standby="loading microsoft windows media player components..." type="application/x-oleobject" width="320" height="310">
     <param name="filename" value="<?php echo $onair_programme_src; ?>">
     <param name="animationatstart" value="true">
     <param name="transparentatstart" value="true">
     <param name="autostart" value="true">
     <param name="showcontrols" value="true">
     <param name="ShowStatusBar" value="true">
     <param name="windowlessvideo" value="true">
     <embed type="application/x-mplayer2" src="<?php echo $onair_programme_src; ?>" autostart="true" showcontrols="true" showstatusbar="1" bgcolor="white" width="320" height="310">
</object>
      <?php } ?>  
	   <?php if($onair_track_protocol_type=='rtmp'){ ?>
	   <div id="rtmpElement"></div>
	   <script type="text/javascript">

var playerInstance = jwplayer("rtmpElement");
playerInstance.setup({ /*player.swf*/
	flashplayer: "<?php echo $this->config->item('assets_url')?>/player.swf",
	file: "<?php echo $onair_programme_src; ?>",
	width: 320,
	height: 70,
	type: 'flv',
	autostart: true,
	media_id : 'rtmpElement'
});
</script>
	   <?php } ?>
      </div>
	  <div id="rtmpElement"></div>
      <div id="loadingAudio">loading.....</div>
      <input type="hidden" name="live_audio" id="live_audio" value="<?php echo $onair_programme_src; ?>" />
    </div>
  </div>
  <img src="<?php echo base_url(); ?>uploads/banner/<?php if($company_banner) echo $company_banner; else echo "banner01.jpg"; ?> "> </section>
<div class="clearFix"></div>
<div class="mainContainer">
  <div >
    <div class="rightSection">
      <div class="commentOuter <?php if(!$enable_news){ echo "hideNews"; } ?>">     
       <?php if($news_list){ ?>
        <ul id="nt-title">		
		<?php foreach($news_list as $news): ?>
          <li>
            <div class="commentArea">
              <figure><img src="<?php echo base_url(); ?>uploads/news/<?php if($news->image) echo $news['image']; else echo "news.png"; ?> "></figure>
              <p><a href="javascript:void(0);"><?php echo $news->title; ?></a></p>
            </div>
          </li>
        <?php endforeach; ?>  
        </ul>
	   <?php } ?>
       	
      </div>
    </div>
    
    
    
  </div>
  
  
    
  <div class="tabItem recordShow recordedShowsItem show">
    <?php if($programme_list_fc){ ?> 
     <div class="streamClassification">
   <h2>For all FC and SC locations</h2>
	<ul>
	 <?php foreach($programme_list_fc as $programme): ?>
      <li>
        <figure> <?php if($programme->track_image) { ?><img src="<?php echo base_url(); ?>uploads/tracks/<?php echo $programme->track_image; ?>"> <?php } ?> </figure>
        <aside>
          <h4><?php echo $programme->name; ?></h4>
          <p><?php echo $programme->description; ?><br/></p>
             <input type="hidden" name="audio_src_height" id="audio_src_height_<?php echo $programme->id; ?>" value="<?php echo $programme->audio_src; ?>" />
             <input type="hidden" name="audio_desc_height" id="audio_desc_height_<?php echo $programme->id; ?>" value="<?php echo $programme->detail_description; ?>" />
           <?php $CI =& get_instance(); 
		   $download_count= $CI->get_download_count($programme->id,$user_id); ?>
		    <a href="javascript:void(0);" id="play_<?php echo $programme->id; ?>" onClick="change_audio_source('audio_src_height','<?php echo $programme->name; ?>','Now Playing','audio_desc_height','<?php echo $programme->id; ?>','programme','<?php echo $programme->protocol_type; ?>')" class="btnPlay">play</a> <a href="javascript:void(0);" id="playing_<?php echo $programme->id; ?>" class="btnPlay nowPlaying" >Now Playing</a></aside>
      </li>
     <?php endforeach; ?>
    </ul>
    </div>
  <?php } ?>
  <?php if($programme_list_all){ ?> 
  <div class="streamClassification">
   <h2>For all delivery stations only</h2>
	<ul>
	 <?php foreach($programme_list_all as $programme): ?>
      <li>
        <figure> <?php if($programme->track_image) { ?><img src="<?php echo base_url(); ?>uploads/tracks/<?php echo $programme->track_image; ?>"> <?php } ?> </figure>
        <aside>
          <h4 class="amazonCode"><?php echo $programme->name; ?></h4>
          <p><?php echo $programme->description; ?><br/></p>
             <input type="hidden" name="audio_src_height" id="audio_src_height_<?php echo $programme->id; ?>" value="<?php echo $programme->audio_src; ?>" />
             <input type="hidden" name="audio_desc_height" id="audio_desc_height_<?php echo $programme->id; ?>" value="<?php echo $programme->detail_description; ?>" />
           <?php $CI =& get_instance(); 
		   $download_count= $CI->get_download_count($programme->id,$user_id); ?>
		    <a href="javascript:void(0);" id="play_<?php echo $programme->id; ?>" onClick="change_audio_source('audio_src_height','<?php echo $programme->name; ?>','Now Playing','audio_desc_height','<?php echo $programme->id; ?>','programme','<?php echo $programme->protocol_type; ?>')" class="btnPlay amazon">play</a> <a href="javascript:void(0);" id="playing_<?php echo $programme->id; ?>" class="btnPlay amazon nowPlaying" >Now Playing</a></aside>
      </li>
     <?php endforeach; ?>
    </ul>
    </div>
  <?php } ?>	
    <div class="clearFix"></div>
  </div>
 <!-- <div class="tabItem" id="schedulesItem"> </div>
    <!------------------------------------Schedules wil be here------------------------------->

  
  <div class="tabItem yourThoughtsItem">
    <div class="contactFormHolder">
      <p>You've heard what's on our minds, it's your turn to share your thoughts with us! Write in with your feedback and we'd be happy to help!</p>
	   <div class="errorHolder" style="display:none;">
                            <p id="errormessage"></p>
       </div>
       <div class="successHolder" style="display:none;">
                            <p id="successmessage"></p>
       </div>
      <form id="frmcontact" name="frmcontact" method="post">
      <div class="inputHolder queryInput"> <span>Location Name<em>*</em></span>
          <label>Enter here</label>
          <input type="text" id="locnameForm" name="locnameForm">
        </div>
        <div class="inputHolder queryInput"> <span>Location Type<em>*</em></span>
          <select name="location_type" id="location_type">
           <option value="-1">Select Location Type</option>
           <option value="FC">FC</option>
           <option value="SC">SC</option>
           <option value="DC">DC</option>
         </select>  
        </div>
        <div class="inputHolder queryInput"> <span>Username<em>*</em></span>
         <!-- <label>Enter here</label>-->
          <input type="text" id="emailForm" name="emailForm" value="<?php echo $username; ?>" disabled="disabled">
        </div>
        <div class="inputHolder queryInput"> <span>User alias<em>*</em></span>
         <!-- <label>Enter here</label>-->
          <input type="text" id="emailForm" name="emailForm" value="<?php echo $username; ?>" disabled="disabled">
        </div>
         <div class="inputHolder queryInput"> <span>Type of Feedback<em>*</em></span>
         <!-- <label>Enter here</label>-->
         <select name="location_type" id="location_type">
           <option value="-1">Select Feedback Type</option>
           <option value="FC">Feedback Type1</option>
           <option value="SC">Feedback Type2</option>
           <option value="DC">Feedback Type3</option>
         </select>  
        </div>
        <div class="inputHolder textHolder queryInput"> <span>Your Message<em>*</em></span>
          <label>Message</label>
          <textarea id="messageForm" name="messageForm"></textarea>
        </div>
        <a href="javascript:void(0);" class="btnSubmitNow" id="contact">Submit Now</a>
        <div class="clearFix"></div>
      </form>
    </div>
  </div>
  <div class="tabItem yourRequestItem">
    <div class="contactFormHolder">
      <p>Share your requests here with us</p>
	   <div class="errorRequestHolder" style="display:none;">
                            <p id="errorrequestmessage"></p>
       </div>
       <div class="successRequestHolder" style="display:none;">
                            <p id="successrequestmessage"></p>
       </div>
      <form id="frmrequest" name="frmrequest" method="post">

        <div class="inputHolder queryInput"> <span>Request Type<em>*</em></span>
          <select name="request_type" id="request_type">
           <option value="-1">Select Request Type</option>
           <option value="localization">Request for Localization</option>
           <option value="music_feedback">Feedback on Music</option>
           <option value="content_feedback">Feedback on Content</option>
           <option value="hour_submission">Request Hour Submission</option>
           <option value="interview_request">Interview Request</option>
           <option value="birthdays">Birthdays For the week</option>
           <option value="localsite_info">Local Site Information</option>
         </select>  
        </div>
        <div class="inputHolder queryInput"> <span>Username<em>*</em></span>
         <!-- <label>Enter here</label>-->
          <input type="text" id="emailForm" name="emailForm" value="<?php echo $username; ?>" disabled="disabled">
        </div>
        <div class="inputHolder queryInput"> <span>User alias<em>*</em></span>
         <!-- <label>Enter here</label>-->
          <input type="text" id="emailForm" name="emailForm" value="<?php echo $username; ?>" disabled="disabled">
        </div>
        <div class="inputHolder textHolder queryInput"> <span>Your Message<em>*</em></span>
          <label>Message</label>
          <textarea id="messageRequestForm" name="messageRequestForm"></textarea>
        </div>
        <a href="javascript:void(0);" class="btnSubmitNow" id="request">Submit Now</a>
        <div class="clearFix"></div>
      </form>
    </div>
  </div>
  <div class="clearFix"></div>
</div>
<footer>
  <p>&copy;<?php echo $company_name; ?>. <?php echo date('Y'); ?><br /><?php echo $footer_line; ?></p>

</footer>
</div>
<script src="<?php echo $this->config->item('assets_url')?>js/audioplayer.js"></script>
<script>$( function() {$('audio').audioPlayer();} );</script>
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

 function change_audio_source(audio_src,name,type,description,track_id,programme,protocol_type){
   var audio;
   if(audio_src=='live_audio')
      audio = $('#'+audio_src).val();
   else	  
      audio=$('#'+audio_src+'_'+track_id).val();
   var desc= $('#'+description+'_'+track_id).val();
   $('.newRadioHolder').removeClass('hideRadio');
   if(programme=='programme'){
     $('.nowPlaying').hide();
	 $('#play'+track_id).hide();
	 $('#playing_'+track_id).show();
   }
   else{
       $('.nowPlaying').hide();
   }
   if(audio_src=='live_audio' && name==''){
	  $('.newRadioHolder').addClass('hideRadio');   
   }
   /*$('#audio_player').attr("src",audio);
   if(document.getElementById('audio_player')!=null){
     document.getElementById('audio_player').play();
   }	 
   else{
   document.getElementById('embed_audio').play;
   }*/
    if(protocol_type=='http'){
	   $('.playerRadio').html('<audio id="audio_player" src="'+audio+'"></audio>');
	   $('audio').audioPlayer();
	   if(document.getElementById('audio_player')!=null){
		  
		 document.getElementById('audio_player').play();
	   }	 
	   else{
		 document.getElementById('embed_audio').play();
	   }
	   $('.playerRadio .audioplayer' ).addClass('audioplayer-playing');
	   jwplayer("rtmpElement").remove();
   }
   else if(protocol_type=='mms'){
	  
	 $('.playerRadio').html('<object id="audio_player" classid="clsid:22d6f312-b0f6-11d0-94ab-0080c74c7e95" codebase=""  type="application/x-oleobject" width="320" height="70"><param name="filename" value="'+audio+'"><param name="animationatstart" value="true"><param name="transparentatstart" value="true"><param name="autostart" value="true"><param name="showcontrols" value="true"><param name="ShowStatusBar" value="true"><param name="windowlessvideo" value="true"><embed type="application/x-mplayer2" src="'+audio+'" autostart="true" showcontrols="true" showstatusbar="1" bgcolor="white" width="320" height="60"></object>');
	 jwplayer("rtmpElement").remove();  
   }
   
   else if(protocol_type=='rtmp'){
     $('.playerRadio').html('');
	 var playerInstance = jwplayer("rtmpElement");
playerInstance.setup({ /*player.swf*/
	flashplayer: "<?php echo $this->config->item('assets_url')?>/player.swf",
	file: ''+audio+'',
	width: 320,
	height: 70,
	type: 'flv',
	autostart: true,
	media_id : 'rtmpElement'
});
   
   }
   
   
   
   $('#programme_name').text(name);
   $('#programme_type').text(type);
   
   user_log(track_id,<?php echo $user_id; ?>)
 }
 
 function user_log(track_id,user_id){
	
	$.ajax({
					type:'POST',
					data:'track_id='+track_id+'&user_id='+user_id,
					dataType:'json',
					url:'<?php echo base_url();?>'+'index.php/common_ajax/record_log',
					success:function(data) {
					
				}             
         });	  
	 
 }


$(document).ready(function(){
  
  /*$('.menu1 a').click(function(){ 
    var programme_name =$('#live_audio').val();
	if(programme_name!='')  
	 change_audio_source('live_audio','<?php echo $onair_programme; ?>','on air now','','<?php echo $onair_programme_id; ?>','','<?php echo $onair_track_protocol_type ?>')
  
  });*/
  
  /*$('#btnpoll').click(function(){
	   var option=$('input[name=option]:checked').val();
	   if(!option){
		alert('Please select an option');
		return false;   
	   }
	   $('#pollForm').hide(); 
	   $('#question').hide(); 
	   $('#reply').show();
	   dataString = $('form[name=pollForm]').serialize();
	   $.ajax({
					type:'POST',
					data:dataString,
					dataType:'json',
					url:'<?php echo base_url();?>'+'index.php/common_ajax/poll',
					success:function(data) {
				}             
         });	  
	   
  });*/
  
  $("#frmcontact").submit(function(e) {
		        e.preventDefault();
				$('.successHolder').show();                  
			    $('#successmessage').html('Your feedback message is submitting.....');
			    dataString = $('form[name=frmcontact]').serialize();
				$.ajax({
					type:'POST',
					data:dataString,
					dataType:'json',
					url:'<?php echo base_url();?>'+'index.php/common_ajax/submitcontact',
					success:function(data) {
					if (data.success=='yes'){ 
					    $('.successHolder').show();                  
						$('#successmessage').html('Your feedback message has been submitted.');  
						document.getElementById("frmcontact").reset(); 				  
					}
				}             
         });	  
			   
			   
			});  
  
  $("#contact").click(function(){ 
                var name     = $("#locnameForm").val();
                var locationType           = $("#location_type").val();
                var message         = $("#messageForm").val();
                var success = 1;
                $("#locnameForm").removeClass("error");
                $("#location_type").removeClass("error");
                $("#messageForm").removeClass("error");
				$('.successHolder').hide();
				$('.errorHolder').hide();
				$('#errormessage').html('');  
                if(name==null || name==''){
                    $("#nameForm").addClass("error");
					$('.errorHolder').show();
					$('#errormessage').html('Please enter Location name');
                    success = 2;
					return false;
                }
                
				if(locationType==-1){
                    $("#location_type").addClass("error");
					$('.errorHolder').show();
					$('#errormessage').html('Please enter Location Type');
                    success = 2;
					return false;
                } 
               
                
                if(message==null || message==''){
                    $("#messageForm").addClass("error");
					$('.errorHolder').show();
					$('#errormessage').html('Please enter a message');
                    success = 2;
					return false;
                }
                if(success == 1) {
                    $("#frmcontact").submit();
                }
            });
	
	$("#frmrequest").submit(function(e) {
		        e.preventDefault();
				$('.successRequestHolder').show();                  
			    $('#successrequestmessage').html('Your Request is submitting.....');
			    dataString = $('form[name=frmrequest]').serialize();
				$.ajax({
					type:'POST',
					data:dataString,
					dataType:'json',
					url:'<?php echo base_url();?>'+'index.php/common_ajax/submitcontact',
					success:function(data) {
					if (data.success=='yes'){ 
					    $('.successRequestHolder').show();                  
						$('#successrequestmessage').html('Your Request has been submitted.');  
						document.getElementById("frmrequest").reset(); 				  
					}
				}             
         });	  
			   
			   
			});  
  
  $("#request").click(function(){ 
                var request_type     = $("#request_type").val();
                var message         = $("#messageRequestForm").val();
                var success = 1;
                $("#request_type").removeClass("error");
                $("#messageRequestForm").removeClass("error");
				$('.successRequestHolder').hide();
				$('.errorRequestHolder').hide();
				$('#errorrequestmessage').html('');  
                if(request_type==-1){
                    $("#request_type").addClass("error");
					$('.errorRequestHolder').show();
					$('#errorrequestmessage').html('Please Select Request Type');
                    success = 2;
					return false;
                }
                
                
                if(message==null || message==''){
                    $("#messageRequestForm").addClass("error");
					$('.errorRequestHolder').show();
					$('#errorrequestmessage').html('Please enter a message');
                    success = 2;
					return false;
                }
                if(success == 1) {
                    $("#frmrequest").submit();
                }
            });

			

});

</script>
