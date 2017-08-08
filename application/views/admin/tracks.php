<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tracks</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Track List
                           <a style="float:right;" href="<?php echo base_url(); ?>admin/index/create_track">Create</a>
                        </div>
                         <div><div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Track Name</th>
                                            <th>Duration</th>
                                            <th style="display:none">Keyword</th>                                                
                                            <th class="td-actions" align="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($track_list){ ?>
                                      <?php foreach($track_list as $track): ?>
                                        <tr class="gradeA" id="track_id_row_<?php echo $track['id']; ?>">
                                            <td><a href="<?php echo base_url(); ?>admin/index/edit_track/<?php echo $track['id']; ?>"><?php echo $track['name']; ?></a></td>
                                            <td class="center"><?php echo $track['duration']; ?></td> 
                                            <td class="center" style="display:none"><?php echo $track['keywords']; ?></td>                                           
                                            <td class="td-actions" align="center"><a href="javascript:void(0)" onClick="delete_confirm(<?php echo $track['id']; ?>)" >Delete</a></td>
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
	
  function delete_confirm(track_id){
  
  swal({   title: "Are you sure?",   text: "Do you want to delete the track!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){ delete_track(track_id);   });

 }


 function delete_track(track_id){  
        $.ajax({   
				 type:'POST',
				 dataType:'json',
				 data:'enity_name=tracks&entity_id='+track_id,
				 url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/delete_entity',
				 success: function(data){
					if(data.status=="success"){
					      $('#track_id_row_'+track_id).fadeOut(100); 
						  swal("Deleted!", "Track has been deleted.", "success");						  
					}												
				}
		});
}
	
    </script>       