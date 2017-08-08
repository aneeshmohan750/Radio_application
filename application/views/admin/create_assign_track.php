<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Assign Track</h1>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"> Assign Track </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
              <form role="form" id="create_assign_track_form" name="create_assign_track_form">
                <div class="loadings" style="display:none;">
						<img src="<?php echo $this->config->item('assets_url')?>images/preloader.gif"><span>Processing your request...</span></div>
                <div class="form-group">
                  <label>Track<em>*</em></label>
                 <select class="form-control" name="track_id" id="track_id"><option value="-1">
                    <?php foreach($track_list as $track): ?>
                     <option value="<?php echo $track['id']; ?>"><?php echo $track['name']; ?></option>
                    <?php endforeach; ?>
                  </select>  
                  <p class="help-block"></p>
                </div>
                <div class="form-group">
                  <label>Company<em>*</em></label>
                  <select class="form-control" name="company_id" id="company_id"><option value="-1">
                    <?php foreach($company_list as $company): ?>
                     <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                    <?php endforeach; ?>
                  </select>  
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="track_type" id="track_type1" value="Library" checked>Play as recorded show
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="track_type" id="track_type2" value="Live">Play as live now
                        </label>
                    </div>
                </div>
                <div class="form-group">
                  <label>Track Profile Image(Resolution 247 X 247)</label>
                  <div class="controls">
                    <input type="file" name="track_image" id="track_image" style="float:left">
                    <input type="button" id="upload_track_image" class="btn btn-primary" value="Upload" />
                    <input type="hidden" name="uploaded_track_image" id="uploaded_track_image" />
                    <div id="assign_track_image"></div>
                  </div>
                </div>
                <div class="form-group">
                    <label>Highlight</label>
                    <br />
                    <label class="checkbox-inline">
                        <input type="checkbox" name="heighlight" id="heighlight" value="1">Highlight this track on home page
                    </label>
                </div>
                <div class="form-group">
                    <label>Disable Download</label>
                    <br />
                    <label class="checkbox-inline">
                        <input type="checkbox" name="disable_download" id="disable_download" value="1">Disable file download 
                    </label>
                </div>
                 <div class="form-group">
                    <label>Date</label>
                   <input class="form-control calendar" placeholder="Date" id="date" name="date">
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
	
	$('.calendar').datepicker({
				format: "yyyy-mm-dd",
				autoclose: true,
				todayHighlight: true
         });
    
	$('#upload_track_image').on('click', function() {
		var file_data = $('#track_image').prop('files')[0];
		var ext = $('#track_image').val().split('.').pop().toLowerCase();
		var file_name=$('#track_image').val();
		if(file_name==''){
		  alert("Please select a file")
	      return false;
		}
		if(ext!='jpg' && ext!='png') {
			 alert("Invalid File");
			 return false;
		 }
		$('.loadings').show();     
		var form_data = new FormData();                  
		form_data.append('file', file_data);                    
		$.ajax({
				    url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/upload_track_image', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                         
					type: 'post',
					success: function(php_script_response){
						$('#uploaded_track_image').val(php_script_response);
						$('#assign_track_image').html('<img width="200" src="<?php echo base_url();?>uploads/tracks/'+php_script_response+'">');
						$('.loadings').hide();
					}
		 });
	});		 
	
	$('#create_assign_track_form').submit(function(e) {
	       e.preventDefault();
		   var track = $("#track_id").val();
		   var company  =  $("#company_id").val();
		   if(track==-1){
				alert("Please Select track");
				return false;
			}
		   else if(company==-1){
			  	alert("Please select company");
				return false;
		   }
		   $('.loadings').show();	
		   dataString = jQuery('form[name=create_assign_track_form]').serialize();  
		   $.ajax({   
							type:'POST',
							data:dataString,
							dataType:'json',
							url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/create_assign_track',
							success: function(data){
								if(data.status=="success"){				
									window.location='<?php echo base_url(); ?>admin/index/assign_tracks'; 
								}
								else if(data.status=="limit_reached"){
								   $('.loadings').hide();	
								   swal("Limit Reached!", "Maximum Number of highlighted tracks are added in this company", "error");
								}
								else if(data.status=="live_track_set"){
								   $('.loadings').hide();	
								   swal("Live Track Already Set!", "Live Track is already set for this company", "error");
								}
								else{
								   $('.loadings').hide();
								}
													
							}
			});  
	    
  });
	
});

</script> 