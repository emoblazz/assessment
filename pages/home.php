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
    <title>Assessment | Home</title>
	<link rel="icon" href="psits.png" type="image/x-icon"/>
	<link rel="shortcut icon" href="psits.png" type="image/x-icon"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
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
            Class
            
			
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Class</li>
          </ol>
		  
        </section>
	
        <!-- Main content -->
        <section class="content" >
	
	<div class="row">
            <div class="col-md-12">
		  <div class="nav-tabs-custom">
		      <ul class="nav nav-tabs">
			<li class="active"><a href="#active" data-toggle="tab" aria-expanded="true">Active</a></li>
			<li class=""><a href="#archived" data-toggle="tab" aria-expanded="false">Archived</a></li>
			
		      </ul>
		      <div class="tab-content">
			<div class="tab-pane active" id="active">
			  <div class="box-body">
		  <?php
		  include('../dist/includes/dbcon.php');
		  $id=$_SESSION['id'];
		  $query=mysqli_query($con,"select * from class where t_id='$id' and class_stat='Active'")or die(mysqli_error());
		    $countactive=mysqli_num_rows($query);
		    if ($countactive<1){echo "<div class='callout callout-danger'>
						<h4>No have not added a class yet!</h4>
					      </div>";}
		  while($row=mysqli_fetch_array($query)){
		  $id=$row['class_id'];
		  $query1=mysqli_query($con,"select COUNT(*) as count from enrol where class_id='$id'")or die(mysqli_error());  
		  $row1=mysqli_fetch_array($query1);
  ?>		
		
	    
	      <div class="col-md-4 col-sm-6 col-xs-12">
		<div class="small-box" style="background-color:<?php echo $row['class_color'];?>">
		  <div class="inner">
		    <h5><b><?php echo $row['class_name'];?></b></h5>
		    <h5><b><?php echo $row['subject_code'];?></b></h5>
		    <p>Enrolled <b>(<?php echo $row1['count'];?>)</b></p>
		  </div>
		  <div class="icon">
		    <i class="fa fa-shopping-cart"></i>
		  </div>
		  <a href="view_class.php?cid=<?php echo $row['class_id'];?>" class="small-box-footer">
		    Manage <i class="fa fa-arrow-circle-right"></i>
		  </a>
		</div>
	      </div><!-- /.col -->
	      
	    
  <?php }?> 

		  </div><!-- /.box-body -->
		      </div><!-- /.tab-pane -->
		      <div class="tab-pane" id="archived">
			  <div class="box-body">
		<?php
		include('../dist/includes/dbcon.php');
		$id=$_SESSION['id'];
		$query1=mysqli_query($con,"select * from class where t_id='$id' and class_stat='Archive'")or die(mysqli_error());
		$count1=mysqli_num_rows($query1);
		if ($count1==0){
		echo "<div class='callout callout-danger'>
                    <h4>No Archived Class!</h4>
                  </div>";
                  }
                  
		while($row=mysqli_fetch_array($query1)){
		$id=$row['class_id'];
		$query1=mysqli_query($con,"select COUNT(*) as count,class_id from enrol where class_id='$id'")or die(mysqli_error());  
		$row1=mysqli_fetch_array($query1);
?>		
	      
          
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="small-box" style="background-color:<?php echo $row['class_color'];?>">
                <div class="inner">
                  <h4><b><?php echo $row['class_name'];?></b></h4>
                  <h5><b><?php echo $row['subject_code'];?></b></h5>
                  <p>Enrolled <b>(<?php echo $row1['count'];?>)</b></p>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="view_class.php?cid=<?php echo $row['class_id'];?>" class="small-box-footer">
                  Manage <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- /.col -->
            
          
<?php }?> 

                </div><!-- /.box-body -->
		      </div><!-- /.tab-pane -->
		    </div><!-- /.tab-content -->
		  </div>
              
            
            </div><!-- /.col (left) -->
            
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
