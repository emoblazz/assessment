<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SICCMS | Project</title>
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
				$term=$_REQUEST['term'];
				$head=mysqli_query($con,"select * from class where class_id='$cid'")or die(mysqli_error());
				  $rowhead=mysqli_fetch_array($head);
	?>			  
        <!-- Main content -->
        <section class="content" >
	  <div class="row" >
	    <div class="col-md-8" >    
		<div class="box box-primary">
		  <div class="box-body">
			<div class="row" style="background-color:<?php echo $rowhead['class_color'];?>;">
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
				<h4><b>Project for <?php echo $term;?></b></h4>
			   </div><!--col-->
			 </div><!--row-->  
		  </div> <!-- Box body -->
		</div> <!-- Box box widget -->
	 
              
	  <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
          <form method="post" action="project_save.php">
              <ul class="nav nav-tabs">
                 <li class="active"><a href="#tab_1" data-toggle="tab"><?php echo $term;?> Project</a></li>
                 
              </ul>
	      <?php
		include('../dist/includes/dbcon.php');
		$cid=$_REQUEST['cid'];
		
		  
	      ?>
              <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                  
		    <input type="hidden" class="form-control" name="term" value="<?php echo $term;?>">
		    <input type="hidden" class="form-control" name="cid" value="<?php echo $cid;?>">
		    <?php
		      $cid=$_REQUEST['cid'];
		      $id=$_SESSION['id'];
			  $query1=mysqli_query($con,"select * from enrol natural join student where enrol.class_id='$cid'")or die(mysqli_error());
			    $count=mysqli_num_rows($query1);
				if ($count<1) echo "<h4 class='text-red'>No student enrolled in this class!</h4>";
				while($row2=mysqli_fetch_array($query1))
				{
				  $stud_id=$row2['stud_id'];
				  $at=mysqli_query($con,"select * from grade where stud_id='$stud_id' and class_id='$cid' and term='$term' and type='Project'")or die(mysqli_error());
				      $rowat=mysqli_fetch_array($at);
				      $countat=mysqli_num_rows($at);
		    ?>
		    
                    <div class="box box-widget" style="border-bottom:1px solid #fbe553">
			<div class="box-header with-border">
			  <div class="user-block">
			    <div class="col-lg-9"><input type="hidden" class="form-control" name="sid[]" value="<?php echo $row2['stud_id'];?>">
				<img class="img-circle" src="../dist/img/<?php echo $row2['stud_pic'];?>" alt="user image">
				<span class="username"><a href="#"><?php echo $row2['stud_first']." ".$row2['stud_last'];?></a></span>
			    </div>	  
			    <div class="col-lg-3">
				<input type="number" class="form-control" name="score[]" placeholder="Equivalent" value="<?php echo $rowat['grade'];?>">
			    </div>
			  </div><!-- /.user-block -->
			</div><!-- /.box-header -->
			
						
		    </div>
		    <?php }?>
		    
		    <div>
		      <input type="submit" class="btn btn-primary" value="Save" name="<?php if ($countat=="0")echo 'save';else echo "update";?>">
		      <input type="reset" class="btn" value="Clear" name="Reset">
		    </div>
		    </form>
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
