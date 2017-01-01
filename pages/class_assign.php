<?php session_start();?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SICCMS | Class Assignment</title>
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
        <?php
				include('../dist/includes/dbcon.php');
				$cid=$_REQUEST['cid'];
				$aid=$_REQUEST['aid'];
				$head=mysqli_query($con,"select * from class natural join assign natural join assign_class where class_id='$cid' and assign_id='$aid'")or die(mysqli_error());
				  $rowhead=mysqli_fetch_array($head);
	?>	
	
        <!-- Main content -->
        <section class="content" >
	  <div class="row">
	      
	    <div class="col-md-8">    
	      <div class="box box-primary">
		  <div class="box-body">
			<div class="row" style="background-color:<?php echo $rowhead['class_color'];?>;">
			  <div class="col-md-2">
			      <img class="img-circle" src="../dist/img/students.png" alt="user image" style="width:100px;padding:10px;">
			  </div>
			  <div class="col-md-10">
				<h3><b>
				<a href="class_home.php?cid=<?php echo $cid;?>">
				<?php  
				  echo $rowhead['class_name'];
				  ?></a>
				</b></h3>
				<h5>Members <b>(
				<?php
				$count=mysqli_query($con,"select COUNT(*) as count from enrol where class_id='$cid'")or die(mysqli_error());
				  $count=mysqli_fetch_array($count);
				  echo $count['count'];
				?>  
				)</b></h5>
			   </div><!--col-->
			 </div><!--row-->  
		  </div> <!-- Box body -->
		</div> <!-- Box box widget -->
		
		<div class="box box-primary">
		  <div class="box-body">
			<div class="row" style="margin:0px 3px;">
			  
			  <div class="col-md-6">
				<h4><b><?php echo $rowhead['assign_desc'];?></b></h4>
				<h5>Due: <b><?php echo date("M d, Y",strtotime($rowhead['assign_due']));?></b></h5>
				<h5>Points: <b><?php echo $rowhead['assign_pts'];?></b></h5>
			  </div>
			  <div class="col-md-6">
				<h5>&nbsp;</h5>
				<h5>Term: <b><?php echo $rowhead['assign_term'];?></b></h5>
				
			  </div><!--col-->
			 </div><!--row-->  
		  </div> <!-- Box body -->
		</div> <!-- Box box widget -->
       
	  <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                 <li class="active"><a href="#tab_1" data-toggle="tab">Submissions</a></li>
                 
                 
              </ul>
	      <?php
		include('../dist/includes/dbcon.php');
		$cid=$_REQUEST['cid'];
		$aid=$_REQUEST['aid'];
		  $query1=mysqli_query($con,"select * from stud_assign natural join assign_class natural join student where class_id='$cid' and assign_id='$aid'")or die(mysqli_error());
			$row2=mysqli_fetch_array($query1);
	      ?>
              <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
			<?php
							include('../dist/includes/dbcon.php');
							$cid=$_REQUEST['cid'];
							$aid=$_REQUEST['aid'];
							$query=mysqli_query($con,"select * from stud_assign natural join assign_class natural join student natural join enrol natural join assign where assign_class.class_id='$cid' and assign_id='$aid' order by stud_assign.date_posted desc,stud_assign.time_posted desc")or die(mysqli_error());
							  $countassign=mysqli_num_rows($query);
							    if ($countassign<1) echo "<h4 class='text-red'>No submission from this class yet!</h4>";
								while($row=mysqli_fetch_array($query)){
								$gid=$row['grade_id'];
									
						?> 
							<div class="box box-widget"  style="border-bottom:1px solid #fbe553">
							<div class="box-header with-border">
							  <div class="user-block">
							    <div class="col-md-10 col-xs-8">
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
							  <p><?php echo $row['content'];?></p>
								<?php
									$said=$row['stud_assign_id'];
									$query2=mysqli_query($con,"select * from upload where stud_assign_id='$said'")or die(mysqli_error());
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
							<div class="row" id="score">			
								<div class="box-tools col-md-12 col-xs-12">
									<form method="post" action="getscore.php">
									 <div class="box-tools col-md-3 col-xs-6">
										<input type="hidden" value="<?php echo $_REQUEST['cid'];;?>" name="cid">
										<input type="hidden" value="<?php echo $_REQUEST['aid'];;?>" name="aid">
										<input type="hidden" class="form-control" value="<?php echo $row['stud_assign_id'];?>" name="id">
										<input type="hidden" class="form-control" value="<?php echo $row['stud_id'];?>" name="sid">
										<?php $query3=mysqli_query($con,"select * from stud_assign left join grade on stud_assign.grade_id=grade.grade_id where stud_assign_id='$row[stud_assign_id]'")or die(mysqli_error());
										$row3=mysqli_fetch_array($query3);
										?>
										<input type="number" class="form-control" placeholder="Score" name="score" value="<?php echo $row3['score'];?>">
										<input type="hidden" value="<?php echo $row3['grade_id'];?>" name="gid">
									 </div>
									 <div class="box-tools col-md-3  col-xs-6">			
										<input type="text" class="form-control" placeholder="Total" value="<?php echo $row['assign_pts'];?>" name="total" readonly>
									 </div>
									 <div class="box-tools col-md-4  col-xs-5">			
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
