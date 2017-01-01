<?php session_start();
if(empty($_SESSION['sid'])):
header('Location:../index.php');
endif;error_reporting(0);
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
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-striped">
                    <thead>
		      <tr>
                        
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <?php 
                        
                        $cid=$_REQUEST['cid'];
                        $term=$_REQUEST['term'];
                        
                        $criteria=mysqli_query($con,"select * from criteria where class_id='$cid'")or die(mysqli_error());
			    $rowc=mysqli_fetch_array($criteria);
                        //display attendance
                        $at=mysqli_query($con,"select * from grade where class_id='$cid' and term='$term' and type='Attendance'")or die(mysqli_error());
			    $row=mysqli_fetch_array($at);
			      $atpercent=$rowc['attendance']*100;
			      if($atpercent<>0)
			      {
			      echo "<th>Attendance</th>";
			      echo "<th>".($rowc['attendance']*100)."%</th>";
			      }
                        //display assign
                        $assign=mysqli_query($con,"select * from assign natural join assign_class where class_id='$cid' and assign_term='$term'")or die(mysqli_error());
			  $i=0;
			    while($row=mysqli_fetch_array($assign)){
			      $i++;
			      $aspercent=$rowc['assign']*100;
			      if($aspercent<>0)
			      {
			      echo "<th>Assign$i</th>";
			     
			      }
			      if($aspercent<>0)
			      {
			      echo "<th>".($rowc['assign']*100)."%</th>";   
			    } }
			//display quiz    
			$quiz=mysqli_query($con,"select * from class_quiz natural join quiz where class_id='$cid' and quiz_term='$term' and quiz_type='Quiz'")or die(mysqli_error());
			  $i=0;
			    while($row1=mysqli_fetch_array($quiz)){
			      $i++;
			      $qpercent=$rowc['quiz']*100;
			      if($qpercent<>0)
			      {
			      echo "<th>Quiz $i</th>";
			      
			    }
			  }
			      if($qpercent<>0)
			      {
			      echo "<th>".($rowc['quiz']*100)."%</th>";   
			      }
			//display exam    
			$exam=mysqli_query($con,"select * from class_quiz natural join quiz where class_id='$cid' and quiz_term='$term' and quiz_type='Exam'")or die(mysqli_error());
			  $row1=mysqli_fetch_array($exam);
			      $epercent=$rowc['exam']*100;
			      if($epercent<>0)
			      {
			      echo "<th>Exam</th>";
			      echo "<th>".($rowc['exam']*100)."%</th>";   
			    }
			  ?>
			<?php
			  $ppercent=$rowc['project']*100;
			  if($ppercent<>0)
			  {
			  echo "<th>Project</th>";
			  echo "<th>".($rowc['project']*100)."%</th>";
			  }
			  if ($ppercent<>0)
			  {
			  echo "<th>".$term." Grade</th>";  
			  }
			  ?>
			  <th>Action
			  </th>
                      </tr>
                      
                    </thead>
                    <tbody>
                    <?php
		      
		      $cid=$_REQUEST['cid'];
		      $sid=$_SESSION['sid'];
		      $stud=mysqli_query($con,"select * from enrol natural join student where class_id='$cid' and stud_id='$sid'")or die(mysqli_error());
		      $i=0;
		      while($rowstud=mysqli_fetch_array($stud)){
		      $sid=$rowstud['stud_id'];
		     
		      $i++;
		    ?><form method="post" action="adjust.php"><input type="hidden" name="cid" value="<?php echo $cid;?>"><input type="hidden" name="term" value="<?php echo $term;?>">
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $rowstud['stud_first']." ".$rowstud['stud_last'];?></td>
                        <?php 
			    //display attendance
			    $at=mysqli_query($con,"select * from grade where class_id='$cid' and stud_id='$sid' and term='$term' and type='Attendance'")or die(mysqli_error());
			    $rowat=mysqli_fetch_array($at);
			      $ap=$rowc['attendance']*100;
			      $at_ave=number_format($rowat['grade']*$rowc['attendance'],2);
			      if($ap<>0)
			      {
			      echo "<td>";
			      echo "$rowat[grade]";
			      echo "<th>";			      
			      echo $at_ave;
			      echo "</th>";
			      }
			      
			      ?>
			
                        <?php 
                        //display assignment
                        $query1=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term' and class_id='$cid' and type='Assignment'")or die(mysqli_error());
			      $i1=0;
			      $assign=0;
			      while($row=mysqli_fetch_array($query1)){
				
			      ?>
                        
			  <?php 
			  $asp=$rowc['assign']*100;
			      if($asp<>0)
			      {
			      echo "<td>$row[grade]</td>";
			      }
			      $assign=$assign+$row['grade'];
			      $i1++;
			  ?>
			
			<?php }
			      $ave=($assign/$i1)*$rowc['assign'];
			      if($asp<>0)
			      {
			      $assign_ave=number_format($ave,2);
			      echo "<th>$assign_ave</th>";
			      }
			?> 
		     
			<?php $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term' and class_id='$cid' and type='Quiz'")or die(mysqli_error());
			      $iq=0;
			      $quiz=0;
			      while($rowq=mysqli_fetch_array($queryq)){
				
			      ?>
                        
			  <?php 
			    $qp=$rowc['quiz']*100;
			      if($qp<>0)
			      {
				echo "<td>$rowq[grade]</td>";
				$iq++;
				$quiz=$quiz+$rowq['grade'];
				
			      }
			  ?>
			
			<?php }
				$q_ave=number_format($quiz/$iq*$rowc['quiz'],2);
				if($qp<>0)
				{
				echo "<th>";
				echo $q_ave;
				echo "</th>";
				}
				?>
			<?php $querye=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term' and class_id='$cid' and type='Exam'")or die(mysqli_error($con));
			   // $count1=mysqli_num_rows($querye);
			      $ie=0;
			      $exam=0;
			      $rowexam=mysqli_fetch_array($querye);
				
			      ?>
                       
			  <?php 
			      
			      $exp=$rowc['exam']*100;
			      $ie++;
				$exam=$exam+$rowexam['grade'];
				$e_ave=$exam/$ie;
				$exam_ave=number_format($e_ave*$rowc['exam'],2);
			      if($exp<>0)
			      {
				echo "<td>$rowexam[grade]</td>";
				
				echo "<th>".$exam_ave."</th>";
			      }	    
			  ?>
			
			
			
			
			<?php $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term' and class_id='$cid' and type='Project'")or die(mysqli_error());
			      $rowq=mysqli_fetch_array($queryq);
				
			      ?>
			      
                        
			  <?php 
			  $pp=$rowc['project']*100;
			  if($pp<>0)
			  {
			  echo "<td>$rowq[grade]</td>";
			  $proj_ave=number_format($rowq['grade']*$rowc['project'],2);
			  echo "<th>$proj_ave</th>";    
			  }
			  ?> 
			
			
			<?php
			$final=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term' and class_id='$cid'")or die(mysqli_error());
			      $rowfinal=mysqli_fetch_array($final);
			      $total=number_format($at_ave+$assign_ave+$q_ave+$exam_ave+$proj_ave,2);
			echo "<th>$total</th>";
			
			?>
			<td><button class="btn tn-block btn-primary" type="submit">Save</button></td>
                      </tr>
                    <?php
                   }
                     ?>  
                    </tbody>
                   
                  </table>
                  </form>
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
