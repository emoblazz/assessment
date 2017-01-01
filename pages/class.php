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
    <title>SICCMS | Class</title>
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
            <div class="col-md-8">

              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Active Class</h3>
                </div>
                <div class="box-body">
		<?php
		include('../dist/includes/dbcon.php');
		$id=$_SESSION['id'];
		$query=mysqli_query($con,"select * from class where t_id='$id' and class_stat='Active'")or die(mysqli_error());
		$countassign=mysqli_num_rows($query);
		if ($countassign<1) echo "<h4 class='text-red'>You have not created any class yet!</h4>";
		while($row=mysqli_fetch_array($query)){
		$id=$row['class_id'];
		$query1=mysqli_query($con,"select COUNT(*) as count from enrol where class_id='$id'")or die(mysqli_error());  
		$row1=mysqli_fetch_array($query1);
?>		
	      
          
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="small-box" style="background-color:<?php echo $row['class_color'];?>">
                <div class="inner">
                  <h4><b><?php echo $row['class_name'];?></b></h4>
                  <p><?php echo $row1['count'];?></p>
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
              </div><!-- /.box -->

              

            </div><!-- /.col (left) -->
            <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create Class</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="class_save.php">
                  <div class="form-group">
                    <label>Class Name</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Class Name" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
		  <div class="form-group">
			<label>Subject</label>
			<select class="form-control col-md-12" data-placeholder="Select Subject" name="subject" required>
			  <?php
				$query2=mysqli_query($con,"select * from subject")or die(mysqli_error());
				  while($row2=mysqli_fetch_array($query2)){		
			  ?>
				<option><?php echo $row2['subject_code'];?></option>
			<?php }?>
						</select>
							
						
					  </div><!-- /.form-group -->
                  <!-- Date and time range -->
                  <div class="form-group">
                    <label>Choose Color</label>
                    <div class="input-group">
                      <input type="color" class="form-control pull-right" id="color" name="color" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                  <!-- Date and time range -->
                  <div class="form-group">
                    
                    <div class="input-group">
                      <button class="btn btn-primary pull-right" id="daterange-btn">
                        Save
                      </button>
                    </div>
                  </div><!-- /.form group -->

                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- iCheck -->
            
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
