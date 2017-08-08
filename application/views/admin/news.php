<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">News</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            News
                           <a style="float:right;" href="<?php echo base_url(); ?>admin/index/create_news">Create</a>
                        </div>
                         <div><div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Company</th>
                                            <th>Date</th>                                                
                                            <th class="td-actions" align="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($news_list){ ?>
                                      <?php foreach($news_list as $news): ?>
                                        <tr class="gradeA" id="news_id_row_<?php echo $news['id']; ?>">
                                            <td><a href="<?php echo base_url(); ?>admin/index/edit_news/<?php echo $news['id']; ?>"><?php echo $news['title']; ?></a></td>
                                            <td><?php $CI =& get_instance(); echo $CI->get_company_list($news['id']); ?></td>
                                            <td class="center"><?php echo $news['date']; ?></td>                                           
                                            <td class="td-actions" align="center"><a href="javascript:void(0)" onClick="delete_confirm(<?php echo $news['id']; ?>)" >Delete</a></td>
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
	
  function delete_confirm(news_id){
  
  swal({   title: "Are you sure?",   text: "Do you want to delete the news!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){ delete_news(news_id);   });

 }


 function delete_news(news_id){  
        $.ajax({   
				 type:'POST',
				 dataType:'json',
				 data:'enity_name=news&entity_id='+news_id,
				 url:'<?php echo base_url();?>'+'index.php/admin/custom_ajax/delete_news',
				 success: function(data){
					if(data.status=="success"){
					      $('#news_id_row_'+news_id).fadeOut(100); 
						  swal("Deleted!", "News has been deleted.", "success");						  
					}												
				}
		});
}
	
    </script>       