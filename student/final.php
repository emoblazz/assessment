<?php session_start();
if(empty($_SESSION['sid'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SICCMS | Grade</title>
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
        <section class="content-header">
          <h1>
	    <i class="glyphicon glyphicon-flash"></i>
            Progress
           
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
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
		    
                        <?php 
                        include('../dist/includes/dbcon.php');
                        $cid=$_REQUEST['cid'];
                        $sid=$_SESSION['sid'];
                    ?>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <?php 
                        include('../dist/includes/dbcon.php');
                        $cid=$_REQUEST['cid'];
                        $term="Prelim";
                        $term2="Midterm";
                        $term3="Endterm";
                        
                        $criteria=mysqli_query($con,"select * from criteria where class_id='$cid'")or die(mysqli_error());
			    $rowc=mysqli_fetch_array($criteria);
                        ?>
			<th>Prelim</th>
			<th>Midterm</th>
			<th>Endterm</th>
			<th>Final</th>
			<th>Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
		      
		      $cid=$_REQUEST['cid'];
		      $stud=mysqli_query($con,"select * from enrol natural join student where class_id='$cid' and stud_id='$sid'")or die(mysqli_error());
		      $i=0;
		      while($rowstud=mysqli_fetch_array($stud)){
		      $sid=$rowstud['stud_id'];
		     
		      $i++;
		    ?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $rowstud['stud_first']." ".$rowstud['stud_last'];?></td>
                        <?php 
			    
			    $at=mysqli_query($con,"select * from grade where class_id='$cid' and stud_id='$sid' and term='$term' and type='Attendance'")or die(mysqli_error());
			    $rowat=mysqli_fetch_array($at);
			    //display attendance
			    $at_ave=number_format($rowat['grade']*$rowc['attendance'],2);    
                       
			    //display assignment
			    $query1=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term' and class_id='$cid' and type='Assignment'")or die(mysqli_error());
			      $i1=0;
			      $assign=0;
			      while($row=mysqli_fetch_array($query1)){
				$assign=$assign+$row['grade'];
				$i1++;
			  }
				$ave=($assign/$i1)*$rowc['assign'];
				$assign_ave=number_format($ave,2);     
			    //display quiz	
			    $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term' and class_id='$cid' and type='Quiz'")or die(mysqli_error());
			      $iq=0;
			      $quiz=0;
			      while($rowq=mysqli_fetch_array($queryq)){
				$iq++;
				$quiz=$quiz+$rowq['grade'];
				}
				$q_ave=number_format($quiz/$iq*$rowc['quiz'],2);
			    //display exam
			    $querye=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term' and class_id='$cid' and type='Exam'")or die(mysqli_error($con));
			      $ie=0;
			      $exam=0;
			      while($rowexam=mysqli_fetch_array($querye)){
				$ie++;
				$exam=$exam+$rowexam['grade'];
			      }
			      $e_ave=$exam/$ie;
			      $exam_ave=number_format($e_ave*$rowc['exam'],2);
			      //display project
			      $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term' and class_id='$cid' and type='Project'")or die(mysqli_error());
				$rowq=mysqli_fetch_array($queryq);
				$proj_ave=number_format($rowq['grade']*$rowc['project'],2);
			  
			 //display prelim
			  $total=number_format($at_ave+$assign_ave+$q_ave+$exam_ave+$proj_ave,2);
			  echo "<th>$total</th>";	  

			  //midterm
			    
			    $at=mysqli_query($con,"select * from grade where class_id='$cid' and stud_id='$sid' and term='$term2' and type='Attendance'")or die(mysqli_error());
			    $rowat=mysqli_fetch_array($at);
			    //display attendance
			    $at_ave=number_format($rowat['grade']*$rowc['attendance'],2);    
                       
			    //display assignment
			    $query1=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term2' and class_id='$cid' and type='Assignment'")or die(mysqli_error());
			      $i1=0;
			      $assign=0;
			      while($row=mysqli_fetch_array($query1)){
				$assign=$assign+$row['grade'];
				$i1++;
			  }
				$ave=($assign/$i1)*$rowc['assign'];
				$assign_ave=number_format($ave,2);     
			    //display quiz	
			    $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term2' and class_id='$cid' and type='Quiz'")or die(mysqli_error());
			      $iq=0;
			      $quiz=0;
			      while($rowq=mysqli_fetch_array($queryq)){
				$iq++;
				$quiz=$quiz+$rowq['grade'];
				}
				$q_ave=number_format($quiz/$iq*$rowc['quiz'],2);
			    //display exam
			    $querye=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term2' and class_id='$cid' and type='Exam'")or die(mysqli_error($con));
			      $ie=0;
			      $exam=0;
			      while($rowexam=mysqli_fetch_array($querye)){
				$ie++;
				$exam=$exam+$rowexam['grade'];
			      }
			      $e_ave=$exam/$ie;
			      $exam_ave=number_format($e_ave*$rowc['exam'],2);
			      //display project
			      $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term2' and class_id='$cid' and type='Project'")or die(mysqli_error());
				$rowq=mysqli_fetch_array($queryq);
				$proj_ave=number_format($rowq['grade']*$rowc['project'],2);
			  
			 //display midterm
			  $total2=number_format($at_ave+$assign_ave+$q_ave+$exam_ave+$proj_ave,2);
			  echo "<th>$total2</th>";
			 
			 //display endterm
			 
			    $at=mysqli_query($con,"select * from grade where class_id='$cid' and stud_id='$sid' and term='$term3' and type='Attendance'")or die(mysqli_error());
			    $rowat=mysqli_fetch_array($at);
			    //display attendance
			    $at_ave=number_format($rowat['grade']*$rowc['attendance'],2);    
                       
			    //display assignment
			    $query1=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term3' and class_id='$cid' and type='Assignment'")or die(mysqli_error());
			      $i1=0;
			      $assign=0;
			      while($row=mysqli_fetch_array($query1)){
				$assign=$assign+$row['grade'];
				$i1++;
			  }
				$ave=($assign/$i1)*$rowc['assign'];
				$assign_ave=number_format($ave,2);     
			    //display quiz	
			    $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term3' and class_id='$cid' and type='Quiz'")or die(mysqli_error());
			      $iq=0;
			      $quiz=0;
			      while($rowq=mysqli_fetch_array($queryq)){
				$iq++;
				$quiz=$quiz+$rowq['grade'];
				}
				$q_ave=number_format($quiz/$iq*$rowc['quiz'],2);
			    //display exam
			    $querye=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term3' and class_id='$cid' and type='Exam'")or die(mysqli_error($con));
			      $ie=0;
			      $exam=0;
			      while($rowexam=mysqli_fetch_array($querye)){
				$ie++;
				$exam=$exam+$rowexam['grade'];
			      }
			      $e_ave=$exam/$ie;
			      $exam_ave=number_format($e_ave*$rowc['exam'],2);
			      //display project
			      $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term3' and class_id='$cid' and type='Project'")or die(mysqli_error());
				$rowq=mysqli_fetch_array($queryq);
				$proj_ave=number_format($rowq['grade']*$rowc['project'],2);
			  
			 //display prelim
			  $total3=number_format($at_ave+$assign_ave+$q_ave+$exam_ave+$proj_ave,2);
			  echo "<th>$total3</th>";
			  $final=number_format(($total*.3)+($total2*.3)+($total3*.4),2);
			  echo "<th>$final</th>";
			  if ($final>=75)
			  echo "<th>Passed</th>";
			  else
			  echo "<th>Failed</th>";
			?>
                      </tr>
                    <?php
                   }
                     ?>  
                     
                    </tbody>
                   
                  </table>
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
