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
    <title>SICCMS | Update Question</title>
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
         <section class="content-header">
          <?php
		include('../dist/includes/dbcon.php');
		    $qid=$_REQUEST['qid'];
		    $query1=mysqli_query($con,"select * from quiz where quiz_id='$qid'")or die(mysqli_error());
		      $row1=mysqli_fetch_array($query1);
	  ?>
          <h1>
            <?php echo $row1['quiz_title'];?>		
          </h1>
          
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="quiz.php">Quiz</a></li>
             <li class="active"><a href="create_quiz.php?qid=<?php echo $row1['quiz_id'];?>"><?php echo $row1['quiz_title'];?></a></li>
          </ol>
		  
        </section>
	
        <!-- Main content -->
        <section class="content" >
	  <div class="row">
	      
	      <div class="col-md-12">
			<div class="box">
			<form name="question" method="post" action="question_save_update.php">
			    <div class="box-header with-border">
			      <h3 class="box-title">Question</h3>
			    </div>
				
				<?php
				  
				    $qid=$_REQUEST['qid'];
				    $question_id=$_REQUEST['question_id'];
				    $query=mysqli_query($con,"select * from question where question_id='$question_id'")or die(mysqli_error());
				    	$row=mysqli_fetch_array($query);

				  ?>
				<div class="box-body">
				  <div class="row">
				      <div class="form-group">
					<div class="col-sm-12">
					    <textarea class="textarea" name="question" placeholder="Enter text ..." style="width: 100%; height:100px" required>
					    <?php echo $row['question'];?></textarea>
					</div>
				      </div>
				  </div>
				  <div class="col-md-7">
				      <div class="form-group">
					  <label for="type">Type of Question</label>
					  <div class="col-sm-6">
					    <select class="form-control" placeholder="Enter ..." name="type" id="type">
						  <option value="<?php echo $row['question_type'];?>"><?php echo $row['question_type'];?></option>
					    </select>
					  </div>
				      </div>
				  </div>
				  <div class="col-md-3">
				      <div class="form-group">
					  <label for="type">Points</label>
					  <div class="col-md-8 col-xs-3">
					      <input type="text" class="form-control" name="points" value="<?php echo $row['points'];?>" required>
					      <input type="hidden" class="form-control" name="question_id" value="<?php echo $_REQUEST['question_id'];?>">
					      <input type="hidden" class="form-control" name="qid" value="<?php echo $qid;?>">
					  </div>
				      </div>
				 </div> 
			     </div><!--row-->	  
			    <hr>
			     <div class="row"> 
			      <div class="col-md-12 col-xs-12">
				<div class="form-group">
				  
				  
				
		
                    <?php
		      $query1=mysqli_query($con,"select * from answer where question_id='$question_id'")or die(mysqli_error());
		      
		      if ($row['question_type']=="Multiple Choice")
			{
			while ($row=mysqli_fetch_array($query1)){
			    $aid=$row['answer_id'];
			    $letter=$row['letter'];
			    $choices=$row['choices'];
			    $answer=$row['answer'];
			    if ($letter<>$answer){$checked="";}
			    else $checked="checked";
			    			   
			echo "
			<div class='col-md-6 col-xs-12'>
			      	
				<div class='col-md-1 col-xs-1'>
				    <input type='radio' name='answer' value='$letter' id='$letter' $checked>
				    
				</div>    
				<div class='col-md-1 col-xs-1'>
				  <label for='$letter'><h4>$letter. </h4></label>
				</div>
				<div class='col-md-9 col-xs-9'>
				  <input class='form-control' type='text' value='$choices' name='choices[]'>
				  <input class='form-control' type='hidden' value='$aid' name='aid[]'>
				</div>  
			  </div>
			";
			
			      }echo "<br><br><br>";
			     
			}
			if ($row['question_type']=="True or False")
			{
			while ($row=mysqli_fetch_array($query1)){
			    $choices=$row['choices'];
			    $answer=$row['answer'];
			    if ($choices==$answer)$checked="checked";
			    else $checked="0";
			   
			echo "
			  <div class='col-md-3 col-xs-6'>
			      	<div class='col-md-1 '>
				    <input type='radio' name='answer' value='$choices' id='$choices' $checked> 
				</div>    
				<div class='col-md-3 col-xs-6'>
				    <label for='$choices'><h3>$choices</h3></label>
				</div>    
			  </div>
			";
			      }
			}
			
			if ($row['question_type']=="Modified True or False")
			{
			  $row=mysqli_fetch_array($query1);
			  $answer=$row['answer'];
			    
			echo "
			  <div class='col-md-5 col-xs-12'>
			    <div class='col-md-12 col-xs-12'>
			      <label for='type'>Answer</label>
			      <input class='form-control' type='text' name='answer' value='$answer'>
			   </div>
			  </div>
			";
			}
			if ($row['question_type']=="Identification")
			{
			$row=mysqli_fetch_array($query1);
			$answer=$row['answer'];
			echo "
			   <div class='col-md-5 col-xs-12'>
			    <div class='col-md-12 col-xs-12'>
			      <label for='type'>Answer</label>
			      <input class='form-control' type='text' name='answer' value='$answer'>
			   </div>
			  </div>
			";
			}
			 if ($row['question_type']=="Enumeration")
			{
			while ($row=mysqli_fetch_array($query1)){
			    $aid=$row['answer_id'];
			    $answer=$row['answer'];
			    
			    			   
			echo "
			<div class='col-md-6 col-xs-12'>
			    
				<div class='col-md-9 col-xs-9'>
				  <input class='form-control' type='text' value='$answer' name='answer[]'>
				  <input class='form-control' type='hidden' value='$aid' name='aid[]'>
				</div>  
			  </div>
			";
			
			      }echo "<br><br><br>";
			     
			}
			 if ($row['question_type']=="Matching Type")
			{
			while ($row=mysqli_fetch_array($query1)){
			    $aid=$row['answer_id'];
			    $answer=$row['answer'];
			    $cola=$row['cola'];
			    $letter=$row['letter'];
			    $choices=$row['choices'];
			    
			    			   
			echo "
			<div class='col-md-2'><input type='hidden' class='form-control' name='aid[]' value='$aid'><input type='text' class='form-control' name='answer2[]' value='$answer'></div><div class='col-md-4'><input type='text' class='form-control' name='cola[]' value='$cola'></div><div class='col-md-1'><input type='text' class='form-control' value='$letter' name='letter1[]' readonly></div><div class='col-md-4'><input type='text' class='form-control' name='choice1[]' value='$choices'></div>
			";
			
			      }echo "<br><br><br>";
			     
			}
			
                    ?>		
			  <div class='col-md-3 col-xs-12 pull-right' style="margin-bottom:20px">
			      <?php
				  echo "<button type='submit' name='update' class='btn-lg btn-primary'><i class='glyphicon glyphicon-log-out'></i> Save Changes</button>";
				?>
				
			  </div>
			  </div><!--form group-->
			  </div><!--col-->
		     </div> 
                    
		    
                  </form>
	    </div><!--box-body-->
	</div><!--box-->	  
		
	</div>
		
               
          
		  
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
	<script src="../dist/js/bootstrap-wysihtml5.js"></script>

	<script>
		$('.textarea').wysihtml5();
	</script>

	<script type="text/javascript" charset="utf-8">
		$(prettyPrint);
	</script>
		<script>
	jQuery(document).ready(function(){
		jQuery("#multiple").hide();
		jQuery("#tf").hide();
		jQuery("#mtf").hide();	
		jQuery("#mt").hide();	
		jQuery("#identification").hide();	
		jQuery("#enumeration").hide();			

		jQuery("#type").change(function(){	
			var x = jQuery(this).val();			
			if(x == 'Multiple Choice') {
				jQuery("#multiple").show();
				jQuery("#tf").hide();
				jQuery("#mtf").hide();
				jQuery("#mt").hide();
				jQuery("#identification").hide();
				jQuery("#enumeration").hide();
			} else if(x == 'True or False') {
				jQuery("#multiple").hide();
				jQuery("#tf").show();
				jQuery("#mtf").hide();
				jQuery("#mt").hide();
				jQuery("#identification").hide();
				jQuery("#enumeration").hide();
			} 
			else if(x == 'Modified True or False') {
				jQuery("#multiple").hide();
				jQuery("#tf").hide();
				jQuery("#mtf").show();
				jQuery("#mt").hide();
				jQuery("#identification").hide();
				jQuery("#enumeration").hide();
			}
			else if(x == 'Matching Type') {
				jQuery("#multiple").hide();
				jQuery("#tf").hide();
				jQuery("#mtf").hide();
				jQuery("#mt").show();
				jQuery("#identification").hide();
				jQuery("#enumeration").hide();
			}
			else if(x == 'Identification') {
				jQuery("#multiple").hide();
				jQuery("#tf").hide();
				jQuery("#mtf").hide();
				jQuery("#mt").hide();
				jQuery("#identification").show();
				jQuery("#enumeration").hide();
			}
			else if(x == 'Enumeration') {
				jQuery("#multiple").hide();
				jQuery("#tf").hide();
				jQuery("#mtf").hide();
				jQuery("#mt").hide();
				jQuery("#identification").hide();
				jQuery("#enumeration").show();
			}else {
				jQuery("#multiple").hide();
				jQuery("#tf").hide();
				jQuery("#mtf").hide();
				jQuery("#mt").hide();
				jQuery("#identification").hide();
				jQuery("#enumeration").hide();
			}
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
