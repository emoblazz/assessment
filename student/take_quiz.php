<?php session_start();
if(empty($_SESSION['sid'])):
header('Location:../index.php');
endif;
if(empty($_SESSION['quiz_id'])):
header('Location:quiz.php');
endif;
error_reporting(0);
date_default_timezone_set("Asia/Manila");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SICCMS | Take Test</title>
     <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->

    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

    
    <?php
       $current=date("H:i:s");

    ?>	

  </head>
   <body class="hold-transition skin-blue sidebar-mini">  
    <div class="wrapper">
		
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
	
        <!-- Main content -->
        <section class="content" >
	  <div class="row">
	      <div class="col-md-8">
		<div class="box">
			<div class="box-body">
			  <div class="col-md-1">
				  <h4>Quiz Title: </h4>
				</div>
				<div class="col-md-6">
				  <h4>
				    <?php
					include('../dist/includes/dbcon.php');
					$quiz_id=$_SESSION['quiz_id'];
					$sid=$_SESSION['sid'];
					$query=mysqli_query($con,"select * from quiz where quiz_id='$quiz_id'")or die(mysqli_error());
					    $row=mysqli_fetch_array($query);
					    
						echo $row['quiz_title'];
				      ?>
				  </h4>
				</div>
				<div class="col-md-4">
				  <h4>Duration: <?php echo $row['quiz_duration'];?> minute/s</h4>
				  <?php $dif=strtotime($_SESSION['end'])-strtotime($current);
				    /* $hour=floor($dif/3600);
					$minutes=$dif/60;
					$mil=$dif%3600/60;
					$sec="00";
				    $left=$hour.":".$minutes.":".$sec;
				    $timer=$dif*1000;
					echo $left; */
					$hour=floor($dif/3600);
					$minutes=$dif/60;
					$sec=$dif%60;
					$left=$hour.":".$minutes.":".$sec;
				  ?>
				  <h4>Remaining Time: <div id="hms"><?php echo $left;?></div>
					</h4>
				
			</div><!--box body-->
		</div><!--box-->
      
      </div>
       <?php
		$quiz_id=$_SESSION['quiz_id'];
		$question_id=$_SESSION['question_id'];
		if (isset($_REQUEST['qid']))
		{$question_id=$_REQUEST['qid'];}
		
		$query=mysqli_query($con,"select *,question_order.answer as stud_answer from question natural join question_order where quiz_id='$quiz_id' and question_id='$question_id' and stud_id='$sid'")or die(mysqli_error($con));
		
		    $i=0;
		    $row=mysqli_fetch_array($query);
		      $question_id=$row['question_id'];
			  $stud_answer=$row['stud_answer'];
		      $i++;
	  ?>	

	      <div class="box box-info">
                <div class="box-header">
                <form method="post" action="quiz_update.php" name="finish" id="finish">
								  <input type="hidden" value="<?php echo $quiz_id;?>" name="quiz_id">
								  <input type="hidden" value="<?php echo $question_id;?>" name="question_id">
								 <input type="hidden" value="<?php echo $row['points'];?>" name="points">
								 <?php 
								 $query1=mysqli_query($con,"select * from question_order where question_id='$question_id' and stud_id='$sid'")or die(mysqli_error($con));
								  $row1=mysqli_fetch_array($query1);?>
								 <input type="hidden" value="<?php echo $row1['q_order'];?>" name="qorder">
								 <input type="hidden" value="<?php echo $row1['order_id'];?>" name="order_id">
			<h4 class="box-title">Item # <span data-toggle="tooltip" title="" class="badge bg-light-blue"><h2><?php echo $row1['q_order'];?></h2></span></h4>					  
                  - <?php echo $row['question_type']." (".$row['points'];?>pt/s)
                </div>
                <div class="box-body">
                  <!-- Color Picker -->
                  <div class="form-group"><input type="hidden" value="<?php echo $row['question_type'];?>" name="type">
                    <p style="font-size:16px;"><?php echo $row['question'];?></p><br>
                    <?php
		      $query1=mysqli_query($con,"select * from answer where question_id='$question_id'")or die(mysqli_error());
		      
		      if ($row['question_type']=="Multiple Choice")
			{
			while ($row1=mysqli_fetch_array($query1)){
			    $letter=$row1['letter'];
			    $choices=$row1['choices'];
			   
			    if ($letter<>$stud_answer){$checked="";}
			    else $checked="checked";
			   
			echo "
			  <div class='col-md-6'>
			    <p><input type='radio' name='answer' value='$letter' $checked>
			    $letter.$choices</p><br>
			  </div>
			";
			
			      }
			     
			}
			if ($row['question_type']=="True or False")
			{
			while ($row2=mysqli_fetch_array($query1)){
			    $choices=$row2['choices'];
			   // $answer=$row['answer'];
				
			    if ($choices==$stud_answer)$checked="checked";
				elseif ($stud_answer=="")$checked=" ";
			   else $checked="";
			   
			echo "
			  <div class='col-md-4'>
			    <input type='radio' name='answer' value='$choices' $checked> <h3>$choices</h3>
			  </div>
			";
			      }
			}
			if ($row['question_type']=="Modified True or False")
			{
			$row3=mysqli_fetch_array($query1);
			  $answer=$row['answer'];
			  echo "
			  <div class='col-md-3'>
			    <input class='form-control' type='text' name='answer' value='$answer'>
			  </div>
			";
			}
			if ($row['question_type']=="Identification")
			{
			$answer=$row['answer'];
			echo "
			  <div class='col-md-6'>
			    <input class='form-control' type='text' name='answer' value='$answer'>
			  </div>
			";
			}
			if ($row['question_type']=="Enumeration")
			{
			  $i=0;
			  while ($row3=mysqli_fetch_array($query1)){
			      $choices=$row3['choices'];
			      $answer=$row['answer'];
				 
				     $answer=explode(",",$answer);
				      echo "
					<div class='col-md-12'>
					  <input type='text' name='answer[]' value='$answer[$i]'>
					</div>
				      ";
				      $i++;
				    
				 
			  }
			}
			if ($row['question_type']=="Matching Type")
			{
			echo "
			<div class='col-lg-12'>
			  <div class='col-md-4'>
			    <h4>Answer</h4>
			  </div>
			  <div class='col-md-4'>
			    <h4>COLUMN A</h4>
			  </div>
			  <div class='col-md-4'>
			   <h4>COLUMN B</h4>
			  </div>
			</div>"; 
			$i=0;
			while ($row4=mysqli_fetch_array($query1)){	
			    $choices=$row4['choices'];
			    $cola=$row4['cola'];
			    $letter=$row4['letter'];
			    $answer=$row['answer'];
			    
			    echo "
			    <div class='col-lg-12'>
			      <div class='col-md-4'>
				";
			$answer1=explode(",",$answer);
			echo "	<input type='text' name='answer[]' value='$answer1[$i]'>  
				<input type='hidden' name='answer_id[]' value='$row4[answer_id]'>
			      </div>
			      <div class='col-md-4'>
				$cola
			      </div>
			      <div class='col-md-4'>
			      $letter.
				$choices
			      </div>
			    </div><br>
			    ";$i++;
				  }
			}
                    ?>	
                    <div class="footer">
                    <?php 
		      $quiz_id=$_SESSION['quiz_id'];
		      $sid=$_SESSION['sid'];
		      $findmax=mysqli_query($con,"select MAX(q_order) as maxorder from question_order where quiz_id='$quiz_id' and stud_id='$sid'")or die(mysqli_error($con));
			    $rowmax=mysqli_fetch_array($findmax);
			    
			    $question_id=$_SESSION['question_id'];
			    if (isset($_REQUEST['qid']))
				{$question_id=$_REQUEST['qid'];}
			    
			    $query5=mysqli_query($con,"select * from question natural join question_order where quiz_id='$quiz_id' and question_id='$question_id'")or die(mysqli_error($con));
			    $row5=mysqli_fetch_array($query5);
			    
			    if (($row5['q_order'])<($rowmax['maxorder']))
			    {
			      echo "<button type='submit' name='finish' id='finish' class='btn-lg btn-warning pull-right'><i class='glyphicon glyphicon-log-out'></i>Finish</button>";	    
			      echo "<button type='submit' name='next' class='btn-lg btn-primary pull-right'><i class='glyphicon glyphicon-forward'></i>Next</button>";
			      
			    }
			    else
			    {
			       echo "<button type='submit' name='finish' id='finish' class='btn-lg btn-primary pull-right'><i class='glyphicon glyphicon-log-out'></i>Submit & Finish</button>";
			    }
		    ?>
		      
		    </div>
                  </div><!-- /.form group -->
                  </form>
                </div><!-- /.box-body -->
              </div><!--box-->
	    </div><!--col-->
	    
	  
	    <div class="col-md-4"><!--start right col-->

		  <!-- Profile Image -->
		  <div class="box box-primary">
		    <div class="box-body box-profile">
		      <a href="#" class="btn btn-primary btn-block"><b>Item #</b></a><br><br>
		      
		      <?php
			
			$sid=$_SESSION['sid'];
			$query1=mysqli_query($con,"select * from question_order where quiz_id='$quiz_id' and stud_id='$sid'")or die(mysqli_error($con));
			    while ($row1=mysqli_fetch_array($query1)){
		      ?>
			  <div class="col-md-2 col-sm-6 col-xs-2">
			    <div class="small-box" style="background-color:#ff8000">
			      <a href="take_quiz.php?qid=<?php echo $row1['question_id'];?>" class="small-box-footer">
				<?php echo $row1['q_order'];?>
			      </a>     
			    </div>
			    
			  </div><?php }?> 
		    </div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!--col-->
	  </div><!--row-->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
   
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../dist/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../dist/js/bootstrap.min.js"></script>
	
    <script>
      $(document).ready(function (e) {
    var $worked = $("#worked");

    function update() {
        var myTime = $worked.html();
        var ss = myTime.split(":");
        var dt = new Date();
        dt.setHours(0);
        dt.setMinutes(ss[0]);
        dt.setSeconds(ss[1]);

        var dt2 = new Date(dt.valueOf() - 1000);
        var temp = dt2.toTimeString().split(" ");
        var ts = temp[0].split(":");

        $worked.html(ts[1]+":"+ts[2]);
        setTimeout(update, 1000);
    }

    setTimeout(update, 1000);
    
});
    

    
    </script>
	
<script type="text/javascript">
    function count() {
 
    var startTime = document.getElementById('hms').innerHTML;
    var pieces = startTime.split(":");
    var time = new Date();    
	time.setHours(pieces[0]);
    time.setMinutes(pieces[1]);
    time.setSeconds(pieces[2]);
    var timedif = new Date(time.valueOf() - 1000);
    var newtime = timedif.toTimeString().split(" ")[0];
    document.getElementById('hms').innerHTML=newtime;
    setTimeout(count, 1000);
}
count();
 
</script>
    <script>
    function disable_f5(e)
{
  if ((e.which || e.keyCode) == 116)
  {
      e.preventDefault();
  }
}

$(document).ready(function(){
    $(document).bind("keydown", disable_f5);    
});

    
    window.onload=function(){ 
    window.setTimeout(function() { document.finish.submit(); },<?php echo $timer;?>);}
    
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
