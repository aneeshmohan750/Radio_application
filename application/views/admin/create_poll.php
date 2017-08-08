<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Create Poll</h1>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"> Create Poll </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
              <form role="form" id="create_poll_form" name="create_poll_form">
                <div class="loadings" style="display:none;">
						<img src="<?php echo $this->config->item('assets_url')?>images/preloader.gif"><span>Processing your request...</span></div>
                <div class="form-group">
                  <label>Poll Question</label>
                  <input class="form-control" placeholder="Poll Question" id="poll_question" name="poll_question">
                </div>
                <div class="form-group">
                  <label>Poll Answer1</label>
                  <input class="form-control" placeholder="Poll Answer1" id="poll_answer1" name="poll_answer1">
                </div>
                
                 <div class="form-group">
                  <label>Poll Answer2</label>
                 <input class="form-control" placeholder="Poll Answer2" id="poll_answer2" name="poll_answer2">
                </div>
               <div class="form-group">
                  <label>Poll Answer3</label>
                 <input class="form-control" placeholder="Poll Answer3" id="poll_answer3" name="poll_answer3">
                </div>
                <div class="form-group">
                  <label>Poll Answer4</label>
                  <input class="form-control" placeholder="Poll Answer4" id="poll_answer4" name="poll_answer4">
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
                    <label>Active</label>
                    <br />
                    <label class="checkbox-inline">
                        <input type="checkbox" name="active" id="active"  value="1">
                        <label>This is the active poll</label>
                    </label>
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
	
	
	$('#create_poll_form').submit(function(e) {
	       e.preventDefault();
		   var question = $("#poll_question").val();
		   
		   if(question==null || question==''){
				alert("Please enter Question");
				return false;
		   }
		   $('.loadings').show();	
		   dataString = jQuery('form[name=create_poll_form]').serialize();  
		   $.ajax({   
							type:'POST',
							data:dataString,
							dataType:'json',
							url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/create_poll',
							success: function(data){
								if(data.status=="success"){				
									window.location='<?php echo base_url(); ?>admin/index/polls'; 
								}
								else{
								   $('.loadings').hide();
								}
													
							}
			});  
	    
  });
	
});

</script> 