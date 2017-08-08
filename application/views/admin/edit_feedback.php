<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Feedback</h1>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"> Feedback </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
            <?php if($feedback_list){ ?>
             <?php foreach($feedback_list as $feedback): ?>
              <form role="form" id="edit_feedback" name="edit_feedback">
              <input type="hidden" name="feedback_id" id="feedback_id" value="<?php echo $feedback['id']; ?> " />
                <div class="loadings" style="display:none;">
						<img src="<?php echo $this->config->item('assets_url')?>images/preloader.gif"><span>Processing your request...</span></div>
                <div class="form-group">
                  <label>Name</label><br />
                  <?php echo $feedback['name']; ?>
                  <p class="help-block"></p>
                </div>
                <div class="form-group">
                  <label>Email</label><br />
                  <?php echo $feedback['email']; ?>
                </div>
                
                 <div class="form-group">
                  <label>Message</label><br />
                  <?php echo $feedback['message']; ?>
                </div>
                
                <div class="form-group">
                  <label>Date</label><br />
                  <?php echo $feedback['submit_date']; ?>
                </div>
                
                <div class="form-group">
                  <label>Action</label>
                  <select name="action" id="action" class="form-control">
                    <option value="-1"></option>
                    <option <?php if($feedback['action']=='pending') echo 'selected="selected"'; ?> value="pending">Pending</option>
                    <option <?php if($feedback['action']=='action_taken') echo 'selected="selected"'; ?> value="action_taken">Action Taken</option>
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
	
	$('#edit_feedback').submit(function(e) {
	       e.preventDefault();
		   $('.loadings').show();	
		   dataString = jQuery('form[name=edit_feedback]').serialize();  
		   $.ajax({   
							type:'POST',
							data:dataString,
							dataType:'json',
							url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/edit_feedback',
							success: function(data){
								if(data.status=="success"){				
									window.location='<?php echo base_url(); ?>admin/index/feedback'; 
								}
													
							}
			});  
	    
  });
	
});

</script> 