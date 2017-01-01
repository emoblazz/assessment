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
            Subject
            
			
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
                
                <div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        
                        <th>Subject Code</th>
                        <th>Subject Title</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		include('../dist/includes/dbcon.php');
		
		$query=mysqli_query($con,"select * from subject order by subject_code")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		
?>
                      <tr>
                        <td id="record"><?php echo $row['subject_code'];?></td>
                        <td><?php echo $row['subject_title'];?></td>
                        <td>
							<a href="#updateordinance<?php echo $row['subject_code'];?>" data-target="#updateordinance<?php echo $row['subject_code'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
							
						</td>
                      </tr>
<div id="updateordinance<?php echo $row['subject_code'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Subject Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="subject_update.php" enctype='multipart/form-data'>
                
					  <input  type="hidden" name="sid" value="<?php echo $row['subject_code'];?>">
					  
				  <div class="row">
					  <div class="form-group col-md-12" id="dynamicInput">
						<label>Subject Code</label>
						<input type="text" class="form-control" name="code" placeholder="Subject Code" value="<?php echo $row['subject_code'];?>" readonly required>
					  </div><!-- /.form-group -->
					  <div class="form-group col-md-12" id="dynamicInput">
						<label>Subject Title</label>
						<input type="text" class="form-control" name="title" placeholder="Subject Title" value="<?php echo $row['subject_title'];?>" required>
						
					  </div><!-- /.form-group -->
				  </div>
				 
                  
              </div>
              <div class="modal-footer">
		<button type="submit" class="btn btn-primary" name="update">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div></form>
            </div>
			
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal-->                    
<?php }?>					  
                    </tbody>
                    <tfoot>
                      <tr>
                        
                        <th>Subject Code</th>
                        <th>Subject Title</th>
                        <th>Action</th>
                      </tr>					  
                    </tfoot>
                  </table>


                </div><!-- /.box-body -->
              </div><!-- /.box -->

              

            </div><!-- /.col (left) -->
            <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create Subject</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="subject_save.php">
                  <div class="form-group">
                    <label>Subject Code</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control" id="name" name="code" placeholder="Subject Code" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
		  
                  <!-- Date and time range -->
                  <div class="form-group">
                    <label>Subject Title</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control" id="color" name="title" placeholder="Subject Title" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                  <!-- Date and time range -->
                  <div class="form-group">
                    
                    <div class="input-group">
                      <button class="btn btn-primary" id="daterange-btn">
                        Save
                      </button>
                      <button class="btn" type="reset">
                        Clear
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
