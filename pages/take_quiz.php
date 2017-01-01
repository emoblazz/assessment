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
	<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.min.css"></link>
	<link rel="stylesheet" type="text/css" href="../dist/css/prettify.css"></link>
	<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap-wysihtml5.css"></link>
   <style type="text/css" media="screen">
	.btn.jumbo {
		font-size: 20px;
		font-weight: normal;
		padding: 14px 24px;
		margin-right: 10px;
		-webkit-border-radius: 6px;
		-moz-border-radius: 6px;
		border-radius: 6px;
	}
</style>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30181385-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini" onload="start()">
    <div class="wrapper">
		<?php include('../dist/includes/header.php');?>
		<?php include('../dist/includes/aside.php');?>
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
	
        <!-- Main content -->
        <section class="content" >
	  <div class="row">
	      <div class="col-md-12">
		<div class="box">
			<div class="box-body">
			<form name="question" method="post" action="answer_save.php">
				<div class="col-md-1">
				  <h4>Quiz Title: </h4>
				  </div>
				  <div class="col-md-6">
				  <h4>
				    <?php
					include('../dist/includes/dbcon.php');
					$id=$_REQUEST['qid'];
					$query=mysqli_query($con,"select * from quiz where quiz_id='$id'")or die(mysqli_error());
					    $row=mysqli_fetch_array($query);
						echo $row['quiz_title'];
				      ?>
				  </h4>
				</div>
				<div class="col-md-4">
				  <h4>Duration: 10 minutes</h4>
				</div>
			</div><!--box body-->
		</div><!--box-->
	      </div><!--col-->	  
	  </div><!--row-->
	  <?php
	      $id=$_REQUEST['qid'];
		$query=mysqli_query($con,"select * from question where quiz_id='$id' order by RAND(question_id)")or die(mysqli_error());
		  $i=0;
		    while ($row=mysqli_fetch_array($query)){
		      $qid=$row['question_id'];
		      $i++;
	  ?>	
	  <div class="row">
	    <div class="col-md-12">
	      <div class="box box-info">
                <div class="box-header">
                  <h4 class="box-title">Q# <?php echo $i;?></h4><input type="text" value="<?php echo $qid;?>" name="question_id">
								 <input type="text" value="<?php echo $row['points'];?>" name="points">
                  - <?php echo $row['question_type']." (".$row['points'];?>pt/s)
                </div>
                <div class="box-body">
                  <!-- Color Picker -->
                  <div class="form-group">
                    <label style="font-size:16px;"><?php echo $row['question'];?></label>
                    <?php
		      $query1=mysqli_query($con,"select * from answer where question_id='$qid'")or die(mysqli_error());
		      
		      if ($row['question_type']=="Multiple Choice")
			{
			while ($row=mysqli_fetch_array($query1)){
			    $letter=$row['letter'];
			    $choices=$row['choices'];
			echo "
			  <div class='col-md-3'>
			    <input type='radio' name='answer' value='$letter'>
			    $letter.$choices
			  </div>
			";
			      }
			     
			}
			if ($row['question_type']=="True or False")
			{
			while ($row=mysqli_fetch_array($query1)){
			    $choices=$row['choices'];
			echo "
			  <div class='col-md-3'>
			    <input type='radio' name='answer' value='$choices'> $choices
			  </div>
			";
			      }
			}
			if ($row['question_type']=="Modified True or False")
			{
			echo "
			  <div class='col-md-3'>
			    <input class='form-control' type='text' name='answer'>
			  </div>
			";
			}
			if ($row['question_type']=="Identification")
			{
			echo "
			  <div class='col-md-3'>
			    <input class='form-control' type='text' name='answer'>
			  </div>
			";
			}
			
                    ?>		
                  </div><!-- /.form group -->
                  </form>
                </div><!-- /.box-body -->
              </div>
	    </div><!--col-->
	  
	  </div><!--row-->	    
	  <?php }?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php include('../dist/includes/footer.php');?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

   
    
    <!-- jQuery 2.1.4 -->
	<script src="../dist/js/wysihtml5-0.3.0.js"></script>
	<script src="../dist/js/jquery-1.7.2.min.js"></script>
	<script src="../dist/js/prettify.js"></script>
	<script src="../dist/js/bootstrap.min.js"></script>
	
<script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
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
