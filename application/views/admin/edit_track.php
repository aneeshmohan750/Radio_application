<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Edit Track</h1>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"> Edit  Track </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
            <?php if($track_details){ ?>
            <?php foreach($track_details as $track): ?>
              <form role="form" id="edit_track_form" name="edit_track_form">
              <input type="hidden" name="track_id" id="track_id" value="<?php echo $track['id']; ?>" />
                <div class="loadings" style="display:none;">
						<img src="<?php echo $this->config->item('assets_url')?>images/preloader.gif"><span>Processing your request...</span></div>
                <div class="form-group">
                  <label>Track Name</label>
                  <input class="form-control" placeholder="Track Name" id="track_name" name="track_name" value="<?php echo $track['name']; ?>">
                  <p class="help-block"></p>
                </div>
                <div class="form-group">
                  <label>Track Description</label>
                  <textarea class="form-control"  id="track_description" name="track_description"><?php echo $track['description']; ?></textarea>
                </div>
                <div class="form-group">
                  <label>Track Detail Description</label>
                  <textarea class="form-control"  id="track_detail_description" name="track_detail_description"><?php echo $track['detail_description']; ?></textarea>
                </div>
                <div class="form-group">
                  <label>Track Duration</label>
                  <input class="form-control" placeholder="Track Duration" id="track_duration" name="track_duration" value="<?php echo $track['duration']; ?>">
                </div>
                <div class="form-group">
                  <label>Track Category</label>
                   <br /> 
                   <select multiple="multiple" placeholder="Select Category" name="track_category_id[]" id="track_category_id"  class="SlectBox" >
                    <?php foreach($track_category_list as $track_category): ?>
                     <option <?php if(in_array($track_category['id'],$track_category_rel)) echo "selected='selected'"; ?> value="<?php echo $track_category['id']; ?>"><?php echo $track_category['name']; ?></option>
                    <?php endforeach; ?>
                  </select>  
                </div>
                <div class="form-group">
                  <label>Track</label>
                  <select class="form-control" name="track_type" id="track_type">
                    <option value="-1"></option>
                    <option value="audio_file" <?php if($track['track_type']=='audio_file') echo 'selected="selected"' ?>>Audio File</option>
                    <option value="file_location" <?php if($track['track_type']=='file_location') echo 'selected="selected"' ?>>File Location</option>
                    <option value="stream_url" <?php if($track['track_type']=='stream_url') echo 'selected="selected"' ?>>Stream Url</option>
                    <option value="live_stream_url" <?php if($track['track_type']=='live_stream_url') echo 'selected="selected"' ?>>Live Stream Url</option>
                  </select>
                  <div class="controls" style="padding-top:30px;display:none;" id="audio_upload">
                    <input type="file" name="audio_file" id="audio_file" style="float:left">
                    <input type="button" id="upload_audio_file" class="btn btn-primary" value="Upload" />  
                  </div>
                  <div style="padding-top:30px;display:none;" id="protocoltypeDiv">
                      <label>Track Protocol Type</label>
                      <select class="form-control" name="protocol_type" id="protocol_type">
                        <option value="http" <?php if($track['protocol_type']=='http') echo 'selected="selected"' ?>>http</option>
                        <option value="mms" <?php if($track['protocol_type']=='mms') echo 'selected="selected"' ?> >mms</option>
                        <option value="rstp" <?php if($track['protocol_type']=='rstp') echo 'selected="selected"' ?> >rstp</option>
                        <option value="rtmp" <?php if($track['protocol_type']=='rtmp') echo 'selected="selected"' ?> >rtmp</option>
                      </select>
                  </div> <p style="display:none;"  id="support_note">(This protocol will work only on media player supported browsers like IE)</p> 
                  <div style="padding-top:30px;display:none;" id="track_url_text">
                   <input  class="form-control" placeholder="Track Url" id="track_url" name="track_url" value="<?php echo $track['audio_src']; ?>">
                  </div> 
                </div>
                <div class="form-group">
                  <label>Keywords</label>
                 <textarea class="form-control"  id="keywords" name="keywords"><?php echo $track['keywords']; ?></textarea>
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
	window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 5 });
	
	      var track_type = $('#track_type').val();
	      var protocol_type = $('#protocol_type').val();
	
		 if(track_type=='audio_file'){
			$('#track_url_text').show(); 
		    $('#audio_upload').show();
		 }
		 else if(track_type=='file_location'){
		    $('#track_url_text').show();
			$('#protocoltypeDiv').show();  
		    $('#audio_upload').hide();
		 }
		 else if(track_type=='stream_url'){
		    $('#track_url_text').show();
			$('#protocoltypeDiv').show();  
		    $('#audio_upload').hide();
		 }
		 else if(track_type=='live_stream_url'){
		    $('#track_url_text').show();
			$('#protocoltypeDiv').show();  
		    $('#audio_upload').hide();
		 }
		 
		 if(protocol_type=='http'){
			 $('#support_note').hide();	 
		 }
		 else{
		     $('#support_note').show();	 	 
		 }
	
	$('#track_type').change(function(){
		 var track_type = $(this).val();
		 if(track_type=='audio_file'){
			$('#track_url_text').hide();
			$('#protocoltypeDiv').hide();   
		    $('#audio_upload').show();
		 }
		 else if(track_type=='file_location'){
		    $('#track_url_text').show();
			$('#protocoltypeDiv').show();   
		    $('#audio_upload').hide();
		 }
		 else if(track_type=='stream_url'){
		    $('#track_url_text').show(); 
			$('#protocoltypeDiv').show();
		    $('#audio_upload').hide();
		 }
		 else if(track_type=='live_stream_url'){
		    $('#track_url_text').show();
			$('#protocoltypeDiv').show(); 
		    $('#audio_upload').hide();
		 }
	
	});
	
	$('#protocol_type').change(function(){
	   
	   var protocol_type = $(this).val();
	   if(protocol_type=='http'){
		     $('#support_note').hide();	
	   }
	   else{
		  $('#support_note').show();	  
	   }
	
	});
	
	$('#upload_audio_file').on('click', function() {
		var file_data = $('#audio_file').prop('files')[0];
		var ext = $('#audio_file').val().split('.').pop().toLowerCase();
		var file_name=$('#audio_file').val();
		if(file_name==''){
		  alert("Please select a file")
	      return false;
		}
		if(ext!='mp3' && ext!='ogg') {
			 alert("Invalid File");
			 return false;
		 }
		$('.loadings').show();     
		var form_data = new FormData();                  
		form_data.append('file', file_data);                    
		$.ajax({
				    url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/upload_audio_file', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                         
					type: 'post',
					success: function(php_script_response){
						$('#track_url_text').show(); 
						$('#track_url').val('<?php echo base_url();?>uploads/audio/'+php_script_response+'');
						$('.loadings').hide();
					}
		 });
	});		 
	
	$('#edit_track_form').submit(function(e) {
	       e.preventDefault();
		   var track_name = $("#track_name").val();
		   var track_url  =  $("#track_url").val();
		   if(track_name==null || track_name==''){
				alert("Please enter track name");
				$("#track_name").focus();
				return false;
			}
		   else if(track_url==null || track_url==''){
			  	alert("Please enter track url ");
				return false;
		   }
		   $('.loadings').show();	
		   dataString = jQuery('form[name=edit_track_form]').serialize();  
		   $.ajax({   
							type:'POST',
							data:dataString,
							dataType:'json',
							url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/edit_track',
							success: function(data){
								if(data.status=="success"){				
									window.location='<?php echo base_url(); ?>admin/index/tracks'; 
								}
								else{
								   $('.loadings').hide();
								}
													
							}
			});  
	    
  });
	
});

</script> 