<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Polls</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Polls List
                           <a style="float:right;" href="<?php echo base_url(); ?>admin/index/create_poll">Create</a>
                        </div>
                         <div><div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Poll Name</th>
                                            <th>Company</th>
                                            <th>Status</th>                                    
                                            <th class="td-actions" align="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($poll_list){ ?>
                                      <?php foreach($poll_list as $poll): ?>
                                        <tr class="gradeA" id="poll_id_row_<?php echo $poll['id']; ?>">
                                            <td><a href="<?php echo base_url(); ?>admin/index/edit_poll/<?php echo $poll['id']; ?>"><?php echo $poll['poll_question']; ?></a></td>
                                             <td ><?php $CI =& get_instance(); echo $CI->get_entity_name('company',$poll['company_id']); ?></td> 
                                            <td><?php if($poll['status']==1) echo 'Active'; else  echo 'In active'; ?></td>                                           
                                            <td class="td-actions" align="center"><a href="javascript:void(0)" onClick="delete_confirm(<?php echo $poll['id']; ?>)" >Delete</a></td>
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
	
  function delete_confirm(poll_id){
  
  swal({   title: "Are you sure?",   text: "Do you want to delete the poll!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){ delete_poll(poll_id);   });

 }


 function delete_poll(poll_id){  
        $.ajax({   
				 type:'POST',
				 dataType:'json',
				 data:'enity_name=polls&entity_id='+poll_id,
				 url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/delete_entity',
				 success: function(data){
					if(data.status=="success"){
					      $('#poll_id_row_'+poll_id).fadeOut(100); 
						  swal("Deleted!", "Poll has been deleted.", "success");						  
					}												
				}
		});
}
	
    </script>       