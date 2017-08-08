<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Assigned Tracks</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Assigned Track List
                           <a style="float:right;" href="<?php echo base_url(); ?>admin/index/create_assign_track">Create</a>
                        </div>
                         <div><div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Assigned Track</th>
                                            <th>Assigned Company</th>
                                            <th>Type</th>
                                            <th>Date</th>                                                
                                            <th class="td-actions" align="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($assign_track_list){ ?>
                                      <?php foreach($assign_track_list as $track): ?>
                                        <tr class="gradeA" id="assign_track_id_row_<?php echo $track['id']; ?>">
                                            <td><a href="<?php echo base_url(); ?>admin/index/edit_assign_track/<?php echo $track['id']; ?>"><?php $CI =& get_instance(); echo $CI->get_entity_name('tracks',$track['track_id']); ?></a></td>
                                            <td><?php $CI =& get_instance(); echo $CI->get_entity_name('company',$track['company_id']); ?></td>
                                            <td class="center"><?php if($track['type']=='Library') echo 'Play as recorded show'; else echo 'Play as live now'; ?></td> 
                                            <td class="center"><?php echo $track['date']; ?></td>                                           
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
	
  function delete_confirm(assign_track_id){
  
  swal({   title: "Are you sure?",   text: "Do you want to delete the track!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){ delete_assign_track(assign_track_id);   });

 }


 function delete_assign_track(assign_track_id){  
        $.ajax({   
				 type:'POST',
				 dataType:'json',
				 data:'enity_name=assign_tracks&entity_id='+assign_track_id,
				 url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/delete_entity',
				 success: function(data){
					if(data.status=="success"){
					      $('#assign_track_id_row_'+assign_track_id).fadeOut(100); 
						  swal("Deleted!", "Assigned Track has been deleted.", "success");						  
					}												
				}
		});
}
	
    </script>       