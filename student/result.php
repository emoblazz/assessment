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
    <script type="text/css">
      a:hover{
	  background-color:#ffbb22;
      
    }
    </script>
    <script>
    function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                
            }
        }
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>

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
            RESULT
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          </ol>
		  
        </section>
	
        <!-- Main content -->
        <section class="content" >
	
	<div class="row">
            <div class="col-md-8">
		<div class="box box-primary">
		    <div class="box-header">
		      <h2 class="box-title">
			<?php
			   include('../dist/includes/dbcon.php');
			   $quiz_id=$_SESSION['quiz_id'];
			   $sid=$_SESSION['sid'];
			   $query2=mysqli_query($con,"select SUM(q_score) as score,quiz_title,total,grade from question_order natural join quiz natural join quiz_result natural join grade where quiz_id='$quiz_id' and stud_id='$sid'")or 			die(mysqli_error($con));
				    $row1=mysqli_fetch_array($query2);
				      echo $row1['quiz_title'];
				      unset($_SESSION['quiz_id']);
			?>
		      </h2>
		    </div>
		    <div class="box-body" style="text-align:center">
		      <!-- Date range -->
		      <form method="post" action="">
		      <div class="form-group">
			<h2>Score: <?php echo $row1['score']." / ".$row1['total'];?></h2> 
			<span data-toggle="tooltip" title="" class="badge <?php if ($row1['grade']>=75) echo "bg-green"; else echo "bg-red";?>"><h1><i class="glyphicon glyphicon-certificate"></i> <?php echo $row1['grade'];?>%</h1></span> 
		      </div>
		    </div><!-- /.box-body -->
		  </div><!-- /.box -->
	    </div><!--end left col-->
            <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Quiz Results</h3><span class="pull-right">Equivalent</span>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="">
                  
		    <?php
		    $query3=mysqli_query($con,"select * from quiz_result natural join quiz natural join grade where stud_id='$id' and quiz_type='Quiz' order by quiz_result_id desc")or die(mysqli_error());
			$count=mysqli_num_rows($query3);
			if ($count<1) echo "No have not taken any test yet.";
			while($row1=mysqli_fetch_array($query3)){
			  $equiv=$row1['grade'];
			  if ($equiv>74)
			      $badge="green";
			  else $badge="red";
			  
		    ?>						
		    <div class="col-md-12">
			<label><?php echo $row1['quiz_title'];?></label>
		   
			<span class="badge bg-<?php echo $badge;?> pull-right"><?php echo $row1['grade'];?>%</span>
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
