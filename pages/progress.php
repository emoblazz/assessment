<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SICCMS | Progress</title>
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
        <section class="content-header">
          <h1>
	    <i class="glyphicon glyphicon-flash"></i>
            Progress
	  <?php
		include('../dist/includes/dbcon.php');
		$cid=$_REQUEST['cid'];
		  $query1=mysqli_query($con,"select * from class where class_id='$cid'")or die(mysqli_error());
			 $row1=mysqli_fetch_array($query1);		  
	    ?>
	    <?php echo $row1['class_name'];?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Progress</li>
          </ol>
		  
        </section>
	
        <!-- Main content -->
        <section class="content" >
	
	<div class="row">
            <div class="col-md-12">
		 <div class="box">
                <div class="box-header">
                  
                </div><!-- /.box-header -->
                <div class="box-body">
		  <div class="col-lg-3">
		    <a href="grade.php?cid=<?php echo $_REQUEST['cid'];?>&term=Prelim" class="btn btn-block btn-lg btn-primary"><i class="glyphicon glyphicon-align-left"></i><br>Prelim</a>
		  </div>
		  <div class="col-lg-3">
		    <a href="grade.php?cid=<?php echo $_REQUEST['cid'];?>&term=Midterm" class="btn btn-block btn-lg btn-primary"><i class="glyphicon glyphicon-align-center"></i><br>Midterm</a>
		  </div>
		  <div class="col-lg-3">
		    <a href="grade.php?cid=<?php echo $_REQUEST['cid'];?>&term=Endterm" class="btn btn-block btn-lg btn-primary"><i class="glyphicon glyphicon-align-right"></i><br>Endterm</a>
		  </div>
		  <div class="col-lg-3">
		    <a href="final.php?cid=<?php echo $_REQUEST['cid'];?>&term=final" class="btn btn-block btn-lg btn-warning"><i class="glyphicon glyphicon-align-justify"></i><br>Final</a>
		  </div>  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            
            </div><!-- /.col (right) -->
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
