<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Track Category</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Track Category
                           <a style="float:right;" href="<?php echo base_url(); ?>admin/index/create_track_category">Create</a>
                        </div>
                         <div><div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th>                                      
                                            <th class="td-actions" align="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($track_category_list){ ?>
                                      <?php foreach($track_category_list as $category): ?>
                                        <tr class="gradeA" id="category_id_row_<?php echo $category['id']; ?>">
                                            <td><a href="<?php echo base_url(); ?>admin/index/edit_track_category/<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></td>
                                                                                
                                            <td class="td-actions" align="center"><a href="javascript:void(0)" onClick="delete_confirm(<?php echo $category['id']; ?>)" >Delete</a></td>
                                        </tr>
                                      <?php endforeach; ?>
                                   <?php } ?>     
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
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
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
		 
    });
	
  function delete_confirm(track_category_id){
  
  swal({   title: "Are you sure?",   text: "Do you want to delete the news!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){ delete_track_category(track_category_id);   });

 }


 function delete_track_category(track_category_id){  
        $.ajax({   
				 type:'POST',
				 dataType:'json',
				 data:'enity_name=track_category&entity_id='+track_category_id,
				 url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/delete_entity',
				 success: function(data){
					if(data.status=="success"){
					      $('#category_id_row_'+track_category_id).fadeOut(100); 
						  swal("Deleted!", "Track Category has been deleted.", "success");						  
					}												
				}
		});
}
	
    </script>       