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
	  <div class="row" >
	    <div class="col-md-8" >    
		<div class="box box-primary">
		  <div class="box-body">
			<div class="row" style="background-color:<?php echo $rowhead['class_color'];?>">
			  <div class="col-md-2">
			      <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-wrench"></i></span>
			  </div>
			  <div class="col-md-10">
				<h3>Criteria Settings</h3>				
			   </div><!--col-->
			 </div><!--row-->  
		  </div> <!-- Box body -->
		</div> <!-- Box box widget -->
	 
              
	  <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
              
                 <li class="active"><a href="#tab_1" data-toggle="tab">Criteria</a></li>
                 
                 <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
	     
              <div class="tab-content">
	      <?php
		  if (isset($_POST['search']))
		  {
		  $cid=$_POST['class'];
		  $query1=mysqli_query($con,"select * from criteria where class_id='$cid'")or die(mysqli_error());
			$row2=mysqli_fetch_array($query1);
		}	
	      ?>
                  <div class="tab-pane active" id="activity">
                    <!-- Post -->
                   
                    <div class="post">
                      

                      <form class="form-horizontal">
                        <div class="form-group margin-bottom-none">
                          <div class="form-group">
			    <label class="control-label col-lg-2" for="at">Attendance</label>
			    <div class="col-lg-3">
                                <input type="number" class="form-control" id="at" name="at" value="<?php echo $row2['attendance']*100;?>">  
			    </div>
                          </div>  
                          <div class="form-group">
			    <label class="control-label col-lg-2" for="assign">Assignment</label>
			    <div class="col-lg-3">
                                <input type="number" class="form-control" id="assign" name="assign" value="<?php echo $row2['assign']*100;?>">  
			    </div>
                          </div>  
                          <div class="form-group">
			    <label class="control-label col-lg-2" for="quiz">Quiz</label>
			    <div class="col-lg-3">
                                <input type="number" class="form-control" id="quiz" name="quiz" value="<?php echo $row2['quiz']*100;?>">  
			    </div>
                          </div>  
                          <div class="form-group">
			    <label class="control-label col-lg-2" for="exam">Exam</label>
			    <div class="col-lg-3">
                                <input type="number" class="form-control" id="exam" name="exam" value="<?php echo $row2['exam']*100;?>">  
			    </div>
                          </div>  
                          <div class="form-group">
			    <label class="control-label col-lg-2" for="proj">Project</label>
			    <div class="col-lg-3">
                                <input type="number" class="form-control" id="proj" name="project" value="<?php echo $row2['project']*100;?>">  
			    </div>
                          </div>  
                         
                        </div>                        
                      </form>
                    </div><!-- /.post -->
                  </div>
		    </div><!-- /.tab-content -->
		  </div><!-- nav-tabs-custom -->
		  
		</div>
            <div class="col-md-4"><!--start right col-->

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
		  <a href="#" class="btn btn-primary btn-block"><b>Criteria</b></a>
                  <ul class="list-group list-group-unbordered">
                
                    <li class="list-group-item">
                      
                    </li>
                  

		  
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
