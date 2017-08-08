<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Company</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Company List
                           <a style="float:right;" href="<?php echo base_url(); ?>admin/index/create_company">Create</a>
                        </div>
                         <div><div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Logo</th>
                                            <th>Company Url</th>
                                            <th>Email</th>
                                            <th class="td-actions" align="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($company_list){ ?>
                                      <?php foreach($company_list as $company): ?>
                                        <tr class="gradeA" id="company_id_row_<?php echo $company['id']; ?>">
                                            <td><a href="<?php echo base_url(); ?>admin/index/edit_company/<?php echo $company['id']; ?>"><?php echo $company['name']; ?></a></td>
                                            <td class="center"><img width="75" src="<?php echo base_url(); ?>/uploads/logo/<?php echo $company['logo']; ?>" ></td>
                                            <td><?php echo base_url().$company['company_url'].($company['company_auth_code']!='' ? '?auth='.$company['company_auth_code'] : '' ); ?></td>
                                            <td ><?php echo $company['email']; ?></td>
                                            <td class="td-actions" align="center"><a href="javascript:void(0)" onClick="delete_confirm(<?php echo $company['id']; ?>)" >Delete</a> | <a href="<?php echo base_url(); ?>admin/index/company_radio_history/<?php echo $company['id']; ?>"  >View History</a></td>
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
	
  function delete_confirm(company_id){
  
  swal({   title: "Are you sure?",   text: "Do you want to delete the company!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){ delete_company(company_id);   });

 }


 function delete_company(company_id){  
        $.ajax({   
				 type:'POST',
				 dataType:'json',
				data:'enity_name=company&entity_id='+company_id,
				 url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/delete_entity',
				 success: function(data){
					if(data.status=="success"){
					      $('#company_id_row_'+company_id).fadeOut(100); 
						  swal("Deleted!", "Company has been deleted.", "success");						  
					}												
				}
		});
}
	
    </script>       