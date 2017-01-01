<?php 
session_start();
if(empty($_SESSION['sid'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SICCMS | Home</title>
	<link rel="icon" href="psits.png" type="image/x-icon"/>
	<link rel="shortcut icon" href="psits.png" type="image/x-icon"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->

    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
		<?php include('../dist/includes/stud_header.php');?>
		<?php include('../dist/includes/stud_aside.php');?>
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
	<?php
				include('../dist/includes/dbcon.php');
				$cid=$_REQUEST['cid'];
				$head=mysqli_query($con,"select * from class where class_id='$cid'")or die(mysqli_error());
				  $rowhead=mysqli_fetch_array($head);
	?>			  
        <!-- Main content -->
        <section class="content" >
	  <div class="row" >
	    <div class="col-md-8" >    
		<div class="box box-primary">
		  <div class="box-body">
			<div class="row" style="background-color:<?php echo $rowhead['class_color'];?>">
			  <div class="col-md-2">
			      <img class="img-circle" src="../dist/img/students.png" alt="user image" style="width:100px;padding:10px;">
			  </div>
			  <div class="col-md-10">
				<h4><b>
				<?php
				  
				  echo $rowhead['class_name'];
				  ?>
				</b></h4>
				<h5>Members <b>(
				<?php
				$head=mysqli_query($con,"select COUNT(*) as count from enrol where class_id='$cid'")or die(mysqli_error());
				  $rowhead=mysqli_fetch_array($head);
				  echo $rowhead['count'];
				?>  
				)</b></h5>
			   </div><!--col-->
			 </div><!--row-->  
		  </div> <!-- Box body -->
		</div> <!-- Box box widget -->
	 
              
	  <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                 <li class="active"><a href="#tab_1" data-toggle="tab">Assignment</a></li>
                 <li><a href="#tab_2" data-toggle="tab">Submissions</a></li>
                 
                 <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
	      <?php
		include('../dist/includes/dbcon.php');
		$cid=$_REQUEST['cid'];
		//$aid=$_REQUEST['aid'];
		  $query1=mysqli_query($con,"select * from assign_class natural join assign natural join teacher where class_id='$cid'")or die(mysqli_error());
			$row2=mysqli_fetch_array($query1);
	      ?>
              <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
		    <?php
		      $cid=$_REQUEST['cid'];
		      
			  $query1=mysqli_query($con,"select * from assign natural join teacher natural join assign_class where class_id='$cid' order by assign_date desc,assign_time desc")or die(mysqli_error());
			    $count=mysqli_num_rows($query1);
				 if ($count<1) echo "<h4 class='text-red'>No assignment posted yet!</h4>";
				while($row2=mysqli_fetch_array($query1))
				{
				$aid=$row2['assign_id'];
		    ?>
					  <!--start modal-->
					  
<div id="turnin<?php echo $aid;?>" class="modal modal-primary fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                       <h4 class="modal-title">Submit Assignment</h4>
                    </div>
                    <div class="modal-body">
			<form class="form-horizontal" method="post" action="turnin.php" enctype='multipart/form-data'>
			  <div class="form-group">
			    <label class="control-label col-lg-2" for="content">Content</label>
			  <div class="col-lg-9"><input type="hidden" class="form-control" id="aid" name="aid" value="<?php echo $aid;?>">  
                            <textarea class="form-control" name="content"></textarea>
			  </div>
                          </div> 
                             
                          <div class="form-group">
			    <label class="control-label col-lg-2" for="file">File</label>
			    <div class="col-lg-9">
                                <input type="file" class="form-control" id="file" name="files[]" multiple="multiple">  
			    </div>
                          </div> 
		    </div><!--end of modal body-->
                    <div class="modal-footer">
			<button type="submit" name="turnin" class="btn btn-primary">Turn In</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                    </div>
            </div><!--end of modal content-->
			</form>
        </div><!--end of modal-dialog-->
 </div>
                <!--end of modal-->		    
                    <div class="box box-widget" style="border-bottom:1px solid #fbe553">
			<div class="box-header with-border">
			  <div class="user-block">
				<img class="img-circle" src="../dist/img/<?php echo $row2['t_pic'];?>" alt="user image">
				<span class="username"><a href="#"><?php echo $row2['t_first']." ".$row2['t_last'];?></a>  
					<?php
					  $aid=$row2['assign_id'];
					    $query3=mysqli_query($con,"select class_name,assign_id,class_id from assign_class natural join class where assign_id='$aid'")or die(mysqli_error());
						while($row1=mysqli_fetch_array($query3)){ 
						  $cid=$row1['class_id'];
						  echo " >> ";echo "<a href='#'>".$row1['class_name']."</a>";}?>
				</span>
				<span class="description"><?php echo date('M d, Y', strtotime($row2['assign_date']))." - ".date('h:i:s a', strtotime($row2['assign_time']));?></span>
			  </div><!-- /.user-block -->
			</div><!-- /.box-header -->
			<div class="box-body">
			 <!-- post text -->
			  <h4><?php echo $row2['assign_desc'];?></h4>
			  <p>Due: <b><?php echo date("M d, Y",strtotime($row2['assign_due']));?></b></p>
			  <p>Points: <b><?php echo $row2['assign_pts'];?></b></p>
			    <?php
				$aid=$row2['assign_id'];
				  $query2=mysqli_query($con,"select * from t_upload where assign_id='$aid'")or die(mysqli_error());
					while($row1=mysqli_fetch_array($query2)){
					  $file="../dist/uploads/$row1[file]";
					  $ext = pathinfo($file, PATHINFO_EXTENSION);	
						include("../dist/includes/ext.php");	
			    ?> 
			<!-- Attachment -->
			<div class="attachment-block clearfix col-xs-12">
			  <a  data-placement="bottom" title="Download" id="<?php echo $row1['upload_id']; ?>Download" href="../dist/uploads/<?php echo $row1['file']; ?>">
			  <img class="attachment-img" src="../dist/uploads/<?php echo $display; ?>" alt="attachment image">
			  <div class="attachment-pushed ">
			    <h4 class="attachment-heading"><?php echo $row1['file'];?></a></h4>
			    <div class="attachment-text">
				<?php 
					include("../dist/includes/size.php");	
				?>
			    </div><!-- /.attachment-text -->
			  </div><!-- /.attachment-pushed -->
			</div><!-- /.attachment-block --> 
			<?php }?>
			<div class="col-md-4 col-xs-12" style="margin-top:10px;">
			  <!-- small box -->
			  <div class="small-box bg-aqua">
				<div class="inner">
									  <h3><a href="#turnin<?php echo $aid;?>" data-target="#turnin<?php echo $aid;?>" data-toggle="modal" style="color:#fff;">Turn in</h3>
									  <p>
									  <?php
									    $query2=mysqli_query($con,"select COUNT(*) as submitted from stud_assign where assign_id='$aid'")or die(mysqli_error());
										$row=mysqli_fetch_array($query2);
										echo "Submissions (<b>".$row['submitted'].")</b>";
									  ?> 
									  </p>
									</div>
				<div class="icon">
				  <i class="glyphicon glyphicon-share"></i>
				</div>
				<a href="#turnin<?php echo $aid;?>" data-target="#turnin<?php echo $aid;?>" data-toggle="modal" class="small-box-footer"> Submit <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
		  </div><!-- /.box-body -->
						
					  </div>
							<?php }?>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
						<?php
							include('../dist/includes/dbcon.php');
							$cid=$_REQUEST['cid'];
							$sid=$_SESSION['sid'];
							$query=mysqli_query($con,"select * from stud_assign natural join student natural join assign natural join assign_class where class_id='$cid' and stud_id='$sid' order by stud_assign.date_posted desc,stud_assign.time_posted desc")or die(mysqli_error());
							$count=mysqli_num_rows($query);
							if ($count<1) echo "<h4 class='text-red'>No submissions yet!</h4>";
								while($row=mysqli_fetch_array($query)){
									
						?> 
							<div class="box box-widget"  style="border-bottom:1px solid #fbe553">
							<div class="box-header with-border">
							  <div class="user-block">
							    <div class="col-md-10 col-xs-10">
								<img class="img-circle" src="../dist/img/<?php echo $row['stud_pic'];?>" alt="user image">
								<span class="username"><a href="#"><?php echo $row['stud_first']." ".$row['stud_last'];?></a></span>
								<span class="description"><?php echo date('M d, Y', strtotime($row['date_posted']))." - ".date('h:i:s a', strtotime($row['time_posted']));?></span>
							    </div>
							    <div class="col-md-2 col-xs-2">
								<span data-toggle="tooltip" title="" class="badge 
								<?php if ($row['status']=="Submitted")echo "bg-green";
								      elseif ($row['status']=="Late")echo "bg-orange";
								      else echo "bg-red";?>"> 
								      <?php echo $row['status'];?></span>
							    </div>	  
							  </div><!-- /.user-block -->
							  
							</div><!-- /.box-header -->
							<div class="box-body">
							  <!-- post text -->
							  <h4><a href=""><?php echo $row['assign_desc'];?></a></h4>
							  <p><?php echo $row['content'];?></p>
								<?php
									$id=$row['stud_assign_id'];
									$query2=mysqli_query($con,"select * from upload where stud_assign_id='$id'")or die(mysqli_error());
										while($row1=mysqli_fetch_array($query2)){
											$file="../dist/uploads/$row1[file]";
											$ext = pathinfo($file, PATHINFO_EXTENSION);	
											     include("../dist/includes/ext.php");	
								?> 
							  <!-- Attachment -->
							  <div class="attachment-block clearfix">
								<a  data-placement="bottom" title="Download" id="<?php echo $row1['upload_id']; ?>Download" href="../dist/uploads/<?php echo $row1['file']; ?>">
									<img class="attachment-img" src="../dist/uploads/<?php echo $display; ?>" alt="attachment image">
								<div class="attachment-pushed">
								  <h4 class="attachment-heading"><?php echo $row1['file'];?></a></h4>
								  <div class="attachment-text">
									<?php 
									
									include("../dist/includes/size.php");	
											
									?>
								  </div><!-- /.attachment-text -->
								</div><!-- /.attachment-pushed -->
							  </div><!-- /.attachment-block -->
										<?php }?>
							
							</div><!-- /.box-body -->
							
						  </div>
								<?php }?>
						
				  </div><!-- /.tab-pane -->
                 
		    </div><!-- /.tab-content -->
		  </div><!-- nav-tabs-custom -->
		  
		</div>
            <div class="col-md-4"><!--start right col-->

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
		  <a href="#" class="btn btn-primary btn-block"><b>Members</b></a>
                  <ul class="list-group list-group-unbordered">
                  <?php
		      $cid=$_REQUEST['cid'];
		      $query1=mysqli_query($con,"select * from student natural join enrol where class_id='$cid' order by stud_last,stud_first")or die(mysqli_error());
		      while ($row=mysqli_fetch_array($query1)){

		  ?>
                    <li class="list-group-item">
                      <b><?php echo $row['stud_first']." ".$row['stud_last'];?></b> 
                    </li>
                  <?php
		    }

		  ?>
                  </ul>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--right col-->
	  </div>
		  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php include('../dist/includes/footer.php');?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

   
    
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../dist/js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
  </body>
</html>
