<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Edit Track Category</h1>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"> Edit Track Category </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
            <?php if($track_category_list){ ?>
            <?php foreach($track_category_list as $category): ?>
              <form role="form" id="edit_track_category_form" name="edit_track_category_form">
              <input type="hidden" name="track_category_id" id="track_category_id" value="<?php echo $category['id']; ?> " />
                <div class="loadings" style="display:none;">
						<img src="<?php echo $this->config->item('assets_url')?>images/preloader.gif"><span>Processing your request...</span></div>
                <div class="form-group">
                  <label>Track Category Name</label>
                  <input class="form-control" placeholder="Name" id="name" name="name" value="<?php echo $category['name']; ?>" >
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
	
	$('#edit_track_category_form').submit(function(e) {
	       e.preventDefault();
		   var name = $("#name").val();
		   
		   if(name==null || name==''){
				alert("Please enter Category Name");
				return false;
		   }
		   $('.loadings').show();	
		   dataString = jQuery('form[name=edit_track_category_form]').serialize();  
		   $.ajax({   
							type:'POST',
							data:dataString,
							dataType:'json',
							url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/edit_track_category',
							success: function(data){
								if(data.status=="success"){				
									window.location='<?php echo base_url(); ?>admin/index/track_category'; 
								}
								else{
								   $('.loadings').hide();
								}
													
							}
			});  
	    
  });
	
});

</script> 