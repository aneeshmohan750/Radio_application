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
                        <div class="panel-heading">
                            Feedback 
                            <a id="delete_feedback" style="float:right;" href="javascript:void(0);">Delete</a>                        
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Company</th>
                                            <!--<th>Action</th>
                                            <th>Status</th>   -->                                                 
                                            <th class="td-actions" align="center">Date</th>
                                            <th class="td-actions" align="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($feedback_list){ ?>
                                      <?php foreach($feedback_list as $feedback): ?>
                                        <tr class="gradeA" id="feedback_id_row_<?php echo $feedback['id']; ?>" >
                                             <td><input class="checkboxClass" type="checkbox" name="feedbacks[]" id="feedback_<?php echo $feedback['id']; ?>" value="<?php echo $feedback['id'] ?>" /> </td>
                                            <td><a href="<?php echo base_url(); ?>admin/index/edit_feedback/<?php echo $feedback['id']; ?>"><?php echo $feedback['name']; ?></a></td>
                                            <td><?php echo $feedback['email']; ?></td>
                                            <td><?php echo $feedback['message'] ?></td>                                            
                                            <td><?php $CI =& get_instance(); echo $CI->get_entity_name('company',$feedback['company_id']); ?></td>                                        
                                           <!-- <td><?php //echo $feedback['action'] ?></td>
                                             <td><?php //echo $feedback['status'] ?></td>-->
                                             <td><?php echo $feedback['submit_date'] ?></td>
                                             <td class="td-actions" align="center"><a href="javascript:void(0)" onClick="delete_confirm(<?php echo $feedback['id']; ?>)" >Delete</a> </td>
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
		
		$('#delete_feedback').click(function(){
			var feedback_list = [];
			$('.checkboxClass').each(function() { //loop through each checkbox
                if ($(this).is(":checked")){
				   feedback_list.push($(this).val());
				}
            });
			if(feedback_list.length>0){
				swal({   title: "Are you sure?",   text: "Do you want to delete the selected feedbacks!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){ delete_selected_feedback(feedback_list);   });		 		
			}
			else{
			  alert("Please select an item");	
			}
		});
		
		
		 
    });
 function delete_selected_feedback(feedback_list){
   
           $.ajax({   
					type:'POST',
					data:'feedback_list='+feedback_list,
					dataType:'json',
					url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/delete_feedback',
					success: function(data){
						if(data.status=="success"){				
							window.location='<?php echo base_url(); ?>admin/index/feedback'; 
						}
						
											
					}
				});  		
 
 }
	
 function delete_confirm(feedback_id){
  
  swal({   title: "Are you sure?",   text: "Do you want to delete the feedback!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){ delete_feedback(feedback_id);   });

 }


 function delete_feedback(feedback_id){  
        $.ajax({   
				 type:'POST',
				 dataType:'json',
				data:'enity_name=feedback&entity_id='+feedback_id,
				 url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/delete_entity',
				 success: function(data){
					if(data.status=="success"){
					      $('#feedback_id_row_'+feedback_id).fadeOut(100); 
						  swal("Deleted!", "Feedback has been deleted.", "success");						  
					}												
				}
		});
}
	
    </script>       