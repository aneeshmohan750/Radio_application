<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User List
                           <a style="float:right;" href="<?php echo base_url(); ?>admin/index/create_user"> Create </a><span style="float:right;"> | </span>
                           <a style="float:right;" href="<?php echo base_url(); ?>admin/index/import_user"> Import </a>
                           
                        </div>
                         <div><div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>                                           
                                            <th>Company</th>
                                            <th class="td-actions" align="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($user_list){ ?>
                                      <?php foreach($user_list as $user): ?>
                                        <tr class="gradeA" id="user_id_row_<?php echo $user['id']; ?>">
                                            <td><a href="<?php echo base_url(); ?>admin/index/edit_user/<?php echo $user['id']; ?>"><?php echo $user['username']; ?></a></td>
                                            <td><?php echo $user['first_name']; ?></td>
                                            <td class="center"><?php echo $user['last_name']; ?></td>                                           
                                            <td ><?php $CI =& get_instance(); echo $CI->get_entity_name('company',$user['company_id']); ?></td>
                                            <td class="td-actions" align="center"><a href="javascript:void(0)" onClick="delete_confirm(<?php echo $user['id']; ?>)" >Delete</a></td>
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
	
  function delete_confirm(user_id){
  
  swal({   title: "Are you sure?",   text: "Do you want to delete the user!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){ delete_user(user_id);   });

 }


 function delete_user(user_id){  
        $.ajax({   
				 type:'POST',
				 dataType:'json',
				data:'enity_name=users&entity_id='+user_id,
				 url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/delete_entity',
				 success: function(data){
					if(data.status=="success"){
					      $('#user_id_row_'+user_id).fadeOut(100); 
						  swal("Deleted!", "User has been deleted.", "success");						  
					}												
				}
		});
}
	
    </script>       