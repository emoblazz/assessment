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
		<?php include('../dist/includes/header.php');?>
		<?php include('../dist/includes/aside.php');?>
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
	
        <!-- Main content -->
        <section class="content" >
	  <div class="row">
	      
	    <div class="col-md-8">    
	      
       
	  <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                 <li class="active"><a href="#tab_1" data-toggle="tab">Assignment</a></li>
                 <li><a href="#tab_2" data-toggle="tab">Submitted</a></li>
                 <li><a href="#tab_3" data-toggle="tab">Grade</a></li>    
                 <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
	      <?php
		include('../dist/includes/dbcon.php');
		$cid=$_REQUEST['cid'];
		$aid=$_REQUEST['aid'];
		  $query1=mysqli_query($con,"select * from assign_class natural join assign natural join teacher where class_id='$cid' and assign_id='$aid'")or die(mysqli_error());
			$row2=mysqli_fetch_array($query1);
	      ?>
              <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
		    <?php
		      $cid=$_REQUEST['cid'];
		      $id=$_SESSION['id'];
			  $query1=mysqli_query($con,"select * from assign natural join teacher natural join assign_class where class_id='$cid' and t_id='$id' order by assign_date desc,assign_time desc")or die(mysqli_error());
				while($row2=mysqli_fetch_array($query1))
				{
		    ?>
                    <div class="box box-widget">
			<div class="box-header with-border">
			  <div class="user-block">
				<img class="img-circle" src="../dist/img/<?php echo $row2['t_pic'];?>" alt="user image">
				<span class="username"><a href="#"><?php echo $row2['t_first']." ".$row2['t_last'];?></a>  
					<?php
					  $aid=$row2['assign_id'];
					    $query3=mysqli_query($con,"select class_name,assign_id,class_id from assign_class natural join class where assign_id='$aid'")or die(mysqli_error());
						while($row1=mysqli_fetch_array($query3)){ 
						  $cid=$row1['class_id'];
						  echo " >> ";echo "<a href='class_assign.php?aid=$aid&cid=$cid'>".$row1['class_name']."</a>";}?>
				</span>
				<span class="description"><?php echo date('M d, Y', strtotime($row2['assign_date']))." - ".date('h:i:s a', strtotime($row2['assign_time']));?></span>
			  </div><!-- /.user-block -->
			</div><!-- /.box-header -->
			<div class="box-body">
			 <!-- post text -->
			  <p><?php echo $row2['assign_desc'];?></p>
			  <p>Points: <b><?php echo $row2['assign_pts'];?></b></p>
			    <?php
				$aid=$row2['assign_id'];
				  $query2=mysqli_query($con,"select * from t_upload where assign_id='$aid'")or die(mysqli_error());
					while($row1=mysqli_fetch_array($query2)){
					  $file="../dist/uploads/$row1[file]";
					  $ext = pathinfo($file, PATHINFO_EXTENSION);	
						if (($ext=="jpg") or ($ext=="jpeg") or ($ext=="png") or ($ext=="gif"))	
						  {		
						  $display=$row1['file'];
						  }	
						if ($ext=="ppt")	
						  {		
						  $display="ppt.png";
						  }
						if (($ext=="docx") or ($ext=="docx"))		
						  {		
						  $display="word.png";
						  }
						if ($ext=="pdf")		
						  {		
						  $display="pdf.png";
						  }
			    ?> 
			<!-- Attachment -->
			<div class="attachment-block clearfix col-xs-12">
			  <a href="http://www.lipsum.com/">
			  <img class="attachment-img" src="../dist/uploads/<?php echo $display; ?>" alt="attachment image">
			  <div class="attachment-pushed ">
			    <h4 class="attachment-heading"><?php echo $row1['file'];?></a></h4>
			    <div class="attachment-text">
				<?php 
					$bytes=filesize($file);
					if ($bytes >= 1073741824)
					{
					  $bytes = number_format($bytes / 1073741824, 2) . ' GB';
					}
					elseif ($bytes >= 1048576)
					{
					$bytes = number_format($bytes / 1048576, 2) . ' MB';
					}
					elseif ($bytes >= 1024)
					{
					$bytes = number_format($bytes / 1024, 2) . ' KB';
					}
					elseif ($bytes > 1)
					{
					$bytes = $bytes . ' bytes';
					}
					elseif ($bytes == 1)
					{
					$bytes = $bytes . ' byte';
					}
					else
					{
					$bytes = '0 bytes';
					}
					echo $bytes;
				?>
			    </div><!-- /.attachment-text -->
			  </div><!-- /.attachment-pushed -->
			</div><!-- /.attachment-block --> 
			<?php }?>
			<div class="col-md-4 col-xs-12" style="margin-top:10px;">
			  <!-- small box -->
			  <div class="small-box bg-aqua">
				<div class="inner">
				  <h3>Turn in</h3>
				</div>
				<div class="icon">
				  <i class="glyphicon glyphicon-share"></i>
				</div>
				<a href="#" class="small-box-footer"> Submit <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
		  </div><!-- /.box-body -->
						<div class="box-footer box-comments">
						  <div class="box-comment">
							<!-- User image -->
							<img class="img-circle img-sm" src="../dist/img/user3-128x128.jpg" alt="user image">
							<div class="comment-text">
							  <span class="username">
								Maria Gonzales
								<span class="text-muted pull-right">8:03 PM Today</span>
							  </span><!-- /.username -->
							  It is a long established fact that a reader will be distracted
							  by the readable content of a page when looking at its layout.
							</div><!-- /.comment-text -->
						  </div><!-- /.box-comment -->
						  <div class="box-comment">
							<!-- User image -->
							<img class="img-circle img-sm" src="../dist/img/user5-128x128.jpg" alt="user image">
							<div class="comment-text">
							  <span class="username">
								Nora Havisham
								<span class="text-muted pull-right">8:03 PM Today</span>
							  </span><!-- /.username -->
							  The point of using Lorem Ipsum is that it has a more-or-less
							  normal distribution of letters, as opposed to using
							  'Content here, content here', making it look like readable English.
							</div><!-- /.comment-text -->
						  </div><!-- /.box-comment -->
						</div><!-- /.box-footer -->
						<div class="box-footer">
						  <form action="#" method="post">
							<img class="img-responsive img-circle img-sm" src="../dist/img/user4-128x128.jpg" alt="alt text">
							<!-- .img-push is used to add margin to elements next to floating images -->
							<div class="img-push">
							  <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
							</div>
						  </form>
						</div><!-- /.box-footer -->
					  </div>
							<?php }?>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
						<?php
							include('../dist/includes/dbcon.php');
							$cid=$_REQUEST['cid'];
							$query=mysqli_query($con,"select * from stud_assign natural join student natural join assign where t_id='$id' order by stud_assign.date_posted desc,stud_assign.time_posted desc")or die(mysqli_error());
								while($row=mysqli_fetch_array($query)){
									
						?> 
							<div class="box box-widget">
							<div class="box-header with-border">
							  <div class="user-block">
								<img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="user image">
								<span class="username"><a href="#"><?php echo $row['stud_first']." ".$row['stud_last'];?></a></span>
								<span class="description"><?php echo date('M d, Y', strtotime($row['date_posted']))." - ".date('h:i:s a', strtotime($row['time_posted']));?></span>
							  </div><!-- /.user-block -->
							  
							</div><!-- /.box-header -->
							<div class="box-body">
							  <!-- post text -->
							  <p><?php echo $row['content'];?></p>
								<?php
									$id=$row['stud_assign_id'];
									$query2=mysqli_query($con,"select * from upload where stud_assign_id='$id'")or die(mysqli_error());
										while($row1=mysqli_fetch_array($query2)){
											$file="../dist/uploads/$row1[file]";
											$ext = pathinfo($file, PATHINFO_EXTENSION);	
											if (($ext=="jpg") or ($ext=="jpeg") or ($ext=="png") or ($ext=="gif"))	
											{		
												$display=$row1['file'];
											}	
											if ($ext=="ppt")	
											{		
												$display="ppt.png";
											}
											if (($ext=="docx") or ($ext=="docx"))		
											{		
												$display="word.png";
											}
											if ($ext=="pdf")		
											{		
												$display="pdf.png";
											}
								?> 
							  <!-- Attachment -->
							  <div class="attachment-block clearfix">
								<a href="http://www.lipsum.com/">
									<img class="attachment-img" src="../dist/uploads/<?php echo $display; ?>" alt="attachment image">
								<div class="attachment-pushed">
								  <h4 class="attachment-heading"><?php echo $row1['file'];?></a></h4>
								  <div class="attachment-text">
									<?php 
									
									$bytes=filesize($file);
										if ($bytes >= 1073741824)
										{
											$bytes = number_format($bytes / 1073741824, 2) . ' GB';
										}
										elseif ($bytes >= 1048576)
										{
											$bytes = number_format($bytes / 1048576, 2) . ' MB';
										}
										elseif ($bytes >= 1024)
										{
											$bytes = number_format($bytes / 1024, 2) . ' KB';
										}
										elseif ($bytes > 1)
										{
											$bytes = $bytes . ' bytes';
										}
										elseif ($bytes == 1)
										{
											$bytes = $bytes . ' byte';
										}
										else
										{
											$bytes = '0 bytes';
										}
											echo $bytes;
											
									
											
									?>
								  </div><!-- /.attachment-text -->
								</div><!-- /.attachment-pushed -->
							  </div><!-- /.attachment-block -->
										<?php }?>
							<div class="row" id="score">			
								<div class="box-tools col-md-10">
									<form method="post" action="getscore.php">
									 <div class="box-tools col-md-3">
										<input type="hidden" value="<?php echo $_REQUEST['cid'];;?>" name="cid">
										<input type="hidden" value="<?php echo $_REQUEST['aid'];;?>" name="aid">
										<input type="hidden" class="form-control" value="<?php echo $row['stud_assign_id'];?>" name="id">
										<input type="number" class="form-control" placeholder="Score" name="score" value="<?php echo $row['grade'];?>">
									 </div>
									 <div class="box-tools col-md-3">			
										<input type="text" class="form-control" placeholder="Total" value="<?php echo $row['assign_pts'];?>" readonly>
									 </div>
									 <div class="box-tools col-md-4">			
										<button class="btn btn-primary" type="submit" name="update">Save</button>
										<button type="reset" class="btn">Clear</button>
									 </div>
									 </form>
								  </div><!-- /.box-tools -->
							</div><!-- /row -->
							</div><!-- /.box-body -->
							
						  </div>
								<?php }?>
						
				  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
						<div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
			<th>No.</th>
			 <th>Picture</th>
                        <th>Name</th>
                        <th>Score</th>
                      </tr>
                    </thead>
                    <tbody>
	    <?php
	      include('../dist/includes/dbcon.php');
	      $aid=$_REQUEST['aid'];
		$query=mysqli_query($con,"select * from student natural join stud_assign natural join assign_class where assign_id='$aid' and class_id='$cid' order by stud_last,stud_first")or die(mysqli_error());
		$i=0;
		while ($row=mysqli_fetch_array($query)){
		$id=$row['stud_id'];
		$last=$row['stud_last'];
		$first=$row['stud_first'];
		$pic=$row['stud_pic'];
		$grade=$row['grade'];
		$i++;

	    ?>

                      <tr>
			<td><?php echo $i;?></td>
                        <td><img src="../dist/img/<?php echo $pic;?>" alt="Product Image" style="height:100px;width:80px;"></td>
                        <td><?php echo $last.", ".$first;?></td>
                        <td><?php echo $grade;?></td>
                      </tr>
                      
<?php }?>                     
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No.</th>
			<th>Picture</th>
                        <th>Name</th>
                        <th>Score</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
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
