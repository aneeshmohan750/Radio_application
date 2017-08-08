<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Radio History - Current</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Recorded Shows
                          
                        </div>
                         <div><div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sl. No.</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Listeners</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($recordred_shows){ $i=1; ?>
                                      <?php foreach($recordred_shows as $record): ?>
                                        <tr class="gradeA" >
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $record->name; ?></td>
                                            <td><?php echo $record->description; ?></td>
                                            <td><?php echo  $record->track_date; ?></td>
                                            <td><?php $CI =& get_instance(); echo $CI->get_listeners($company_id,$record->id); ?></td>
                                        </tr>
                                      <?php $i=$i+1; ?>  
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
           
           <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Live Shows
                          
                        </div>
                         <div><div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                    <thead>
                                        <tr>
                                            <th>Sl. No.</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Listeners</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($live_shows){ $i=1; ?>
                                      <?php foreach($live_shows as $live): ?>
                                        <tr class="gradeA" >
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $live->name; ?></td>
                                            <td><?php echo $live->description; ?></td>
                                            <td><?php echo $live->track_date; ?></td>
                                            <td><?php $CI =& get_instance(); echo $CI->get_listeners($company_id,$live->id); ?></td>
                                        </tr>
                                       <?php $i=$i+1; ?>    
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
        
              <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Radio History - Previous</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Shows
                          
                        </div>
                         <div><div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                    <thead>
                                        <tr>
                                            <th>Sl. No.</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Listeners</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($track_history){ $i=1; ?>
                                      <?php foreach($track_history as $history): ?>
                                        <tr class="gradeA" >
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $history->name; ?></td>
                                            <td><?php echo $history->description; ?></td>
                                            <td><?php echo  $history->track_date; ?></td>
                                            <td><?php $CI =& get_instance(); echo $CI->get_listeners($company_id,$history->id); ?></td>
                                        </tr>
                                      <?php $i=$i+1; ?>  
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
		$('#dataTables-example1').DataTable({
                responsive: true
        });
		$('#dataTables-example2').DataTable({
                responsive: true
        });
    });
	
 
	
    </script>       