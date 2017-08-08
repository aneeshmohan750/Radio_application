<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Create Track</h1>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"> Create Track </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
              <form role="form" id="create_track_form" name="create_track_form">
                <div class="loadings" style="display:none;">
						<img src="<?php echo $this->config->item('assets_url')?>images/preloader.gif"><span>Processing your request...</span></div>
                <div class="form-group">
                  <label>Track Name</label>
                  <input class="form-control" placeholder="Track Name" id="track_name" name="track_name">
                  <p class="help-block"></p>
                </div>
                <div class="form-group">
                  <label>Track Description</label>
                  <textarea class="form-control"  id="track_description" name="track_description"></textarea>
                </div>
                 <div class="form-group">
                  <label>Track Detail Description</label>
                  <textarea class="form-control"  id="track_detail_description" name="track_detail_description"></textarea>
                </div>
                <div class="form-group">
                  <label>Track Duration</label>
                  <input class="form-control" placeholder="Track Duration" id="track_duration" name="track_duration">
                </div>
                <div class="form-group">
                  <label>Track Category</label>
                  <br />
                  <select multiple="multiple" placeholder="Select Category" name="track_category_id[]" id="track_category_id" class="SlectBox" >
                    <?php foreach($track_category_list as $track_category): ?>
                     <option value="<?php echo $track_category['id']; ?>"><?php echo $track_category['name']; ?></option>
                    <?php endforeach; ?>
                  </select>  
                </div>
                <div class="form-group">
                  <label>Track</label>
                  <select class="form-control" name="track_type" id="track_type">
                    <option value="-1"></option>
                    <option value="audio_file">Audio File</option>
                    <option value="file_location">File Location</option>
                    <option value="stream_url">Stream Url</option>
                    <option value="live_stream_url">Live Stream Url</option>
                  </select>
                  <div class="controls" style="padding-top:30px;display:none;" id="audio_upload">
                    <input type="file" name="audio_file" id="audio_file" style="float:left">
                    <input type="button" id="upload_audio_file" class="btn btn-primary" value="Upload" />  
                  </div>
                   <div style="padding-top:30px;display:none;" id="protocoltypeDiv">
                      <label>Track Protocol Type</label>
                      <select class="form-control" name="protocol_type" id="protocol_type">
                        <option value="http">http</option>
                        <option value="mms">mms</option>
                        <option value="rstp">rstp</option>
                        <option value="rtmp">rtmp</option>
                      </select>
                  </div><p id="support_note" style="display:none;">(This protocol will work only on media player supported browsers like IE)</p> 
                  <div style="padding-top:30px;display:none;" id="track_url_text">
                   <input  class="form-control" placeholder="Track Url" id="track_url" name="track_url">
                  </div> 
                </div>
                <div class="form-group">
                  <label>Keywords</label>
                 <textarea class="form-control"  id="keywords" name="keywords"></textarea>
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
	
	window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 5 });
	
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
	
	$('#create_track_form').submit(function(e) {
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
		   dataString = jQuery('form[name=create_track_form]').serialize();  
		   $.ajax({   
							type:'POST',
							data:dataString,
							dataType:'json',
							url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/create_track',
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