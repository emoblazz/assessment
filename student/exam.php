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
	<script language="JavaScript"><!--
javascript:window.history.forward(1);
//--></script>
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
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          </ol>
		  
        </section>
	
        <!-- Main content -->
        <section class="content" >
	
	<div class="row">
            <div class="col-md-8">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Active Exam</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Previous Exam</a></li>
                  
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
				
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
			<?php
			  include('../dist/includes/dbcon.php');
				$id=$_SESSION['sid'];
				$querymain=mysqli_query($con,"select * from quiz natural join class_quiz natural join class natural join enrol where stud_id='$id' and class_quiz_stat='Activated' and quiz_type='Exam' order by quiz_id desc")or die(mysqli_error());
				  $countquiz=mysqli_num_rows($querymain);
				  if ($countquiz<1){echo "<h4 class='text-red'>No active exam yet!</h4>";} 
				  while($rowmain=mysqli_fetch_array($querymain))
					  {
					    $qid=$rowmain['quiz_id'];
					     $time=$rowmain['quiz_duration'];
			?>
                    <div class="box box-widget">
			<div class="box-header with-border">
			    <h4><a href=""><?php echo $rowmain['class_name']." - ".$rowmain['quiz_title'];?></a></h4>
			</div><!-- /.box-header -->
			<div class="box-body">
			    <!-- post text -->
			    <div class="col-md-6 col-xs-8">
				<p>Duration: <b><?php echo $rowmain['quiz_duration'];?></b></p>
			      
				  <?php
				    $query1=mysqli_query($con,"select SUM(points) as sum,COUNT(*) as count from question where quiz_id='$qid'")or die(mysqli_error());
					$row3=mysqli_fetch_array($query1);
					
				    $points=mysqli_query($con,"select *,SUM(points) as spoints from question
				where quiz_id='$qid' and (question_type='Multiple Choice' or question_type='Modified True or False' or question_type='True or False' or 
				question_type='Identification')")
				or die(mysqli_error());	
				  $row4=mysqli_fetch_array($points);
				      $total=$row4['spoints'];
				      
				$mpoints=mysqli_query($con,"select *,SUM(points) as mpoints from question natural join answer
				where quiz_id='$qid' and question_type='Enumeration'")
				or die(mysqli_error());	
				  $row5=mysqli_fetch_array($mpoints);
			    
				$mpoints1=mysqli_query($con,"select *,SUM(points) as mpoints1 from question natural join answer
				where quiz_id='$qid' and question_type='Matching Type'")
				or die(mysqli_error());	
			    $row6=mysqli_fetch_array($mpoints1);
						$total=$total+$row5['mpoints']+$row6['mpoints1'];
						
					  
				  ?>
				  <p>Items: <b><?php echo $row3['count'];?></b></p>
				  <p>Points:<b><?php echo $total;?></b></p>
			    </div>
			    <div class="col-md-6 col-xs-4">
			    <?php
			      $taken=mysqli_query($con,"select COUNT(*) as counttaken from quiz_result where stud_id='$id' and quiz_id='$qid'")or die(mysqli_error());
				$row5=mysqli_fetch_array($taken);
				if ($row5['counttaken']==0)
				{
				  echo "<a class='btn btn-app text-green' href='order.php?qid=$qid&time=$time'>
					<i class='glyphicon glyphicon-play'></i> Take Test
			      </a>";
			      }
			      else{
			      echo "<a class='btn btn-app text-red'>
					<i class='glyphicon glyphicon-remove'></i> Test Already Taken
			      </a>";
				}
			    ?>
			      
			    </div>
			</div><!-- /.box-body -->
		    </div><!--box-->
		     <?php }?>
					  


		 
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
			<?php
			  include('../dist/includes/dbcon.php');
				$id=$_SESSION['sid'];
				$querymain=mysqli_query($con,"select * from quiz natural join class_quiz natural join class natural join enrol where stud_id='$id' and class_quiz_stat='Deactivated' and quiz_type='Exam'")or die(mysqli_error());
				$countquiz=mysqli_num_rows($querymain);
				  if ($countquiz<1){echo "<h4 class='text-red'>No previous exam!</h4>";} 
				  while($rowmain=mysqli_fetch_array($querymain))
					  {
					    $qid=$rowmain['quiz_id'];
			?>
			<div class="box box-widget">
			    <div class="box-header with-border">
				<div class="col-md-8 col-xs-8">
				    <h4><a href=""><?php echo $rowmain['class_name']." - ".$rowmain['quiz_title'];?></a></h4>
				</div>
				<div class="col-md-4 col-xs-4">
				<?php
				  $taken=mysqli_query($con,"select COUNT(*) as counttaken from quiz_result where stud_id='$id' and quiz_id='$qid' and equiv='0'")or die(mysqli_error());
				    $row5=mysqli_fetch_array($taken);
				    if ($row5['counttaken']==0)
				    {
				      echo "<a class='btn btn-app text-red'>
					    <i class='glyphicon glyphicon-remove'></i> Not Taken
				  </a>";
				  }
				  else{
				  echo "<a class='btn btn-app text-green'>
					    <i class='glyphicon glyphicon-ok'></i>Taken
				  </a>";
				    }
				?>
				</div>
				
			    </div><!-- /.box-header -->

			</div><!--box-->
			<?php }?>			  
		 </div><!-- /.tab-pane -->
                
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!--end left col-->
            <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Exam Results</h3><span class="pull-right">Equivalent</span>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="">
                  
		    <?php
		    $query3=mysqli_query($con,"select * from quiz_result natural join quiz where stud_id='$id' and quiz_type='Exam' order by quiz_result_id desc")or die(mysqli_error());
			$count=mysqli_num_rows($query3);
			if ($count<1) echo "No have not taken any test yet.";
			while($row1=mysqli_fetch_array($query3)){
			  $equiv=$row1['equiv'];
			  if ($equiv>74)
			      $badge="green";
			  else $badge="red";
			  
		    ?>						
		    <div class="col-md-12">
			<label><?php echo $row1['quiz_title'];?></label>
		   
			<span class="badge bg-<?php echo $badge;?> pull-right"><?php echo $row1['equiv'];?>%</span>
                    </div>
		    <?php }?>
		  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
          </div><!-- /.col (right) -->
          </div><!--row-->	  
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
