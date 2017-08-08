<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Edit News</h1>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"> Edit News </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
            <?php if($news_details){ ?>
            <?php foreach($news_details as $news): ?>
              <form role="form" id="edit_news_form" name="edit_news_form">
              <input type="hidden" name="news_id" id="news_id" value="<?php echo $news['id']; ?> "  />
                <div class="loadings" style="display:none;">
						<img src="<?php echo $this->config->item('assets_url')?>images/preloader.gif"><span>Processing your request...</span></div>
                <div class="form-group">
                  <label>Title</label>
                  <input class="form-control" placeholder="Title" id="title" name="title" value="<?php echo $news['title']; ?>"  >
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control"  id="description" name="description"><?php echo $news['description']; ?></textarea>
                </div>
               
                <div class="form-group">
                  <label>Company</label>
                   <br /> 
                   <select multiple="multiple" placeholder="Select Company" name="company_id[]" id="company_id"  class="SlectBox">
                    <?php foreach($company_list as $company): ?>
                     <option <?php if(in_array($company['id'],$company_news_rel)) echo "selected='selected'"; ?> value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                    <?php endforeach; ?>
                  </select>  
                </div>
                <div class="form-group">
                  <label>Image (Resolution 43 X 43)</label>
                  <div class="controls">
                    <input type="file" name="news_image" id="news_image" style="float:left">
                    <input type="button" id="upload_news_image" class="btn btn-primary" value="Upload" />
                    <input type="hidden" name="uploaded_news_image" id="uploaded_news_image" />
                    <div id="news_icon_image"><?php if($news['image']){ ?><img width="50" src="<?php echo base_url();?>uploads/news/<?php echo $news['image']; ?>"><?php } ?></div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Date</label>
                  <input class="form-control calendar" placeholder="Date" id="date" name="date" value="<?php echo $news['date']; ?>">
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
	$('.calendar').datepicker({
				format: "yyyy-mm-dd",
				autoclose: true,
				todayHighlight: true
    });
	/*$('#title').on('keyup', function() {
    limitText(this, 60)
   });*/
	window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 5 });
	$('#upload_news_image').on('click', function() {
		var file_data = $('#news_image').prop('files')[0];
		var ext = $('#news_image').val().split('.').pop().toLowerCase();
		var file_name=$('#news_image').val();
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
				    url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/upload_news_image', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                         
					type: 'post',
					success: function(php_script_response){
						$('#uploaded_news_image').val(php_script_response);
						$('#news_icon_image').html('<img width="50" src="<?php echo base_url();?>uploads/news/'+php_script_response+'">');
						$('.loadings').hide();
					}
		 });
	});		 
	
	$('#edit_news_form').submit(function(e) {
	       e.preventDefault();
		   var title = $("#title").val();
		   
		   if(title==null || title==''){
				alert("Please enter title");
				return false;
		   }
		   $('.loadings').show();	
		   dataString = jQuery('form[name=edit_news_form]').serialize();  
		   $.ajax({   
							type:'POST',
							data:dataString,
							dataType:'json',
							url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/edit_news',
							success: function(data){
								if(data.status=="success"){				
									window.location='<?php echo base_url(); ?>admin/index/news'; 
								}
								else{
								   $('.loadings').hide();
								}
													
							}
			});  
	    
  });
	
});

function limitText(field, maxChar){
    var ref = $(field),
        val = ref.val();
    if ( val.length >= maxChar ){
        ref.val(function() {
            console.log(val.substr(0, maxChar))
            return val.substr(0, maxChar);       
        });
    }
}

</script> 