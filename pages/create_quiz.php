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
    <title>SICCMS | Create Quiz</title>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
        <section class="content-header">
          <h1>
            Quiz
            
			
          </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="quiz.php">Quiz</a></li>
          </ol>
		  
        </section>
	
        <!-- Main content -->
        <section class="content" >
	  <div class="row">
	      
	      <div class="col-md-12">
			<div class="box">
			<div class="box-body">
			<form name="question" method="post" action="question_save.php">
				<h3>Quiz Title: 
				<input type="hidden" value="<?php echo $_REQUEST['qid'];?>" name="qid">
				<?php
				    include('../dist/includes/dbcon.php');
				    
				    $id=$_REQUEST['qid'];
				    $query=mysqli_query($con,"select * from quiz where quiz_id='$id'")or die(mysqli_error());
				    	$row=mysqli_fetch_array($query);
					    echo $row['quiz_title'];

				  ?>
				</h3><hr>
				<h3>Add New Question</h3>
				<textarea class="textarea" name="question" id="question" placeholder="Enter Question or Instruction here(for matching type)" style="width: 100%; height:100px" required></textarea>
				<div class="col-md-6">
				  <select class="form-control" placeholder="Enter ..." name="type" id="type" required>
					  <option value="">Type of Question</option>
					  <option value="Multiple Choice">Multiple Choice</option>
					  <option value="True or False">True or False</option>
					  <option value="Modified True or False">Modified True or False</option>
					  <option value="Matching Type">Matching Type</option>
					  <option value="Identification">Identification</option>
					  <option value="Enumeration">Enumeration</option>
				  </select>
				</div>
				<div class="col-md-4">
				  <label class="pull-left">Points: </label> 
				  <div class="input-group">
				    <input type="number" class="form-control" name="pts" required>
				    
				  </div> 
				</div>
				<div class="col-md-2">
				  <button class="btn btn-primary">Save</button>
				</div>
				<div class="control-group col-md-12">
					<label class="control-label" for="inputEmail"></label>
						<div class="controls">			
							<div id="multiple" class="col-md-8">
									<label class="pull-left">A: </label> <div class="input-group">
									<input type="text" class="form-control" name="mtext[]">
									<span class="input-group-addon">
										<div class="iradio_minimal checked" aria-checked="true" aria-disabled="false">
											<input type="radio" name="mchoice" value="A">
											<input type="hidden" name="letter[]" value="A">
										</div>
									</span>
									</div> 
									<label class="pull-left">B: </label> <div class="input-group">
									<input type="text" class="form-control" name="mtext[]">
									<span class="input-group-addon">
										<div class="iradio_minimal checked" aria-checked="true" aria-disabled="false">
											<input type="radio" name="mchoice" value="B">
											<input type="hidden" name="letter[]" value="B">
										</div>
									</span>
									</div> 
									<label class="pull-left">C: </label> <div class="input-group">
									<input type="text" class="form-control" name="mtext[]">
									<span class="input-group-addon">
										<div class="iradio_minimal checked" aria-checked="true" aria-disabled="false">
											<input type="radio" name="mchoice" value="C">
											<input type="hidden" name="letter[]" value="C">
										</div>
									</span>
									</div> 
									<label class="pull-left">D: </label> <div class="input-group">
									<input type="text" class="form-control" name="mtext[]">
									<span class="input-group-addon">
										<div class="iradio_minimal checked" aria-checked="true" aria-disabled="false">
											<input type="radio" name="mchoice" value="D">
											<input type="hidden" name="letter[]" value="D">
										</div>
									</span>
									</div> 	
									
							</div>
							<div id="tf">
								<div class="form-group">
									<div class="radio">
										<label class="">
										<input type="radio" name="tf" id="optionsRadios1" value="True" checked >
										True
										</label>
									</div>
									<div class="radio">
										<label class="">
										<input type="radio" name="tf" id="optionsRadios1" value="False">
										False
										</label>
									</div>
									
								</div>
							</div>
							<div id="mtf">
								<div class="radio">
									<label class="">
									  <input type="radio" name="mtf" id="optionsRadios1" value="True" checked="" >
									  True
									</label>
								</div>
								<div class="radio col-md-6">
									<label class="">
									  <input type="radio" name="mtf" id="optionsRadios1" value="False" checked="" >
									  Write Correct Answer if False
									  <input type="text" class="form-control" name="answermtf">
									</label>
								</div>
							</div>
							
							<div id="identification">
								<input name="answer1" class="form-control" type="text">
							</div>
							<div id="enumeration" class="col-md-4">
								<input type="text" class="form-control" name="answer[]">
								<input type="text" class="form-control" name="answer[]">
								<input type="text" class="form-control" name="answer[]">
								<input type="text" class="form-control" name="answer[]">
								<input type="text" class="form-control" name="answer[]">
								<button id="addfield">Add</button><br>
							</div>
							
							<div id="mt" class="row">
								<div class="col-md-2">
									Answer
									
									<input type="text" class="form-control" name="answer2[]">
									<input type="text" class="form-control" name="answer2[]">
									<input type="text" class="form-control" name="answer2[]">
									<input type="text" class="form-control" name="answer2[]">
									<input type="text" class="form-control" name="answer2[]">
								</div>
								<div class="col-md-4">
									Column A
									<input type="text" class="form-control" name="question1[]">
									<input type="text" class="form-control" name="question1[]">
									<input type="text" class="form-control" name="question1[]">
									<input type="text" class="form-control" name="question1[]">
									<input type="text" class="form-control" name="question1[]">
								</div>
								<div class="col-md-1">
									Choices
									<input type="text" class="form-control" value="A" name="letter1[]" readonly>
									<input type="text" class="form-control" value="B" name="letter1[]" readonly>
									<input type="text" class="form-control" value="C" name="letter1[]" readonly>
									<input type="text" class="form-control" value="D" name="letter1[]" readonly>
									<input type="text" class="form-control" value="E" name="letter1[]" readonly>
							
								</div>
								<div class="col-md-4">
									Column B
									<input type="text" class="form-control" name="choice1[]">
									<input type="text" class="form-control" name="choice1[]">
									<input type="text" class="form-control" name="choice1[]">
									<input type="text" class="form-control" name="choice1[]">
									<input type="text" class="form-control" name="choice1[]">
								</div>
								<button id="addmt" onClick="addInput('mt');">Add</button>
							</div>
						</div>
						
				</div>
				
				
			</form>
			</div>
			</div>
		</div>
		
	</div>
		
               
              <!-- Box Comment -->
	      
		  <div class="row">
			  <div class="col-md-12">
				<div class="box">
					<div class="box-body">
		<?php
		include('../dist/includes/dbcon.php');
		$id=$_REQUEST['qid'];
		$query=mysqli_query($con,"select * from question where quiz_id='$id'")or die(mysqli_error());
		$quizcount=mysqli_num_rows($query);
		if ($quizcount<1)echo "<h3 class='text-red'>No Available Question!</h3>";
		else {
		echo "
		<table id='example1' class='table table-bordered table-striped'>
                    <thead>
                      <tr>
			<th>Item</th>
                        <th>Type</th>
                        <th>Question</th>
                        <th>Points</th>
			<th>Choices</th>
			<th>Correct</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>";
                    ?>
<?php
		
		$i=1;
		
		while ($row=mysqli_fetch_array($query)){
			$question_id=$row['question_id'];

?>

<div id="delquestion<?php echo $question_id;?>" class="modal fade in col-md-12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;height:200px">
  <div class="modal-dialog">
    <div class="modal-content">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Delete Question</h4>
         </div>
	 <div class="modal-body">
	    <form class="form-horizontal" method="post" action="question_del.php">
		<!-- Title -->
		<input type="hidden" name="qid" value="<?php echo $id;?>">
		<input type="hidden" name="id" value="<?php echo $question_id;?>">
                <div class="form-group">
		  <p>Are you sure you want to delete this?</p>
                </div> 
               
	</div> <!--end of modal body-->
        <div class="modal-footer col-md-10">
	    <button type="submit" name="delete" class="btn btn-primary">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">No</button>
        </div></form>
    </div><!--end of modal content-->
            
  </div><!--end of modal dialog-->
 </div><!--end of modal-->
 
                      <tr>
			<td><?php echo $i++;?></td>
                        <td><?php echo $row['question_type'];?></td>
                        <td><?php
			    if ($row['question_type']=="Matching Type")
			    {
			    $cola=mysqli_query($con,"select cola,question_id from answer where question_id='$question_id'")or die(mysqli_error());	
					while ($rowcola=mysqli_fetch_array($cola)){
					echo $rowcola['cola'];echo "<br>";
					}
			    }
			    else
			    echo $row['question'];
			    ?>
			</td>
                        <td><?php 
			  if (($row['question_type']=="Matching Type") or ($row['question_type']=="Enumeration"))
				{
				$c=mysqli_query($con,"select COUNT(*) as count,points from answer natural join question where question_id='$question_id'")or die(mysqli_error());	
					$rowc=mysqli_fetch_array($c);
					$sum=$rowc['count']*$rowc['points'];
					echo $rowc['points']." (";
					echo $sum.")";
					
				}
				else
				{
				$pt2=$row['points'];
				echo $pt2;
				}
				
				
						
						?></td>
			<td>
				<?php	
					$query1=mysqli_query($con,"select * from answer where question_id='$question_id'")or die(mysqli_error());						while ($row1=mysqli_fetch_array($query1)){?>	
				<?php echo "<b>".$row1['letter']."</b>"." ".$row1['choices'];?><br>  
				<?php	}?>
			</td>
			<td>
			  <?php 
			    $query2=mysqli_query($con,"select * from answer where question_id='$question_id' group by answer order by answer_id asc ")or die(mysqli_error());	
			    while ($row2=mysqli_fetch_array($query2)){
			    echo $row2['answer'];echo "<br>";}?>
			</td>
                        <td><a class="btn btn-warning" href="question_update.php?question_id=<?php echo $question_id;?>&qid=<?php echo $id;?>" data-toggle="tooltip" data-original-title="Update Questions"><i class="glyphicon glyphicon-pencil"> </i></a>
			<a data-target="#delquestion<?php echo $question_id;?>" data-toggle="modal" data-original-title="Delete Question" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>				
						</td>
                      </tr>
                      
<?php }?>                     
                    </tbody>
                   <?php
				 $id=$_REQUEST['qid'];  
			    $points=mysqli_query($con,"select *,SUM(points) as spoints from question
				where quiz_id='$id' and (question_type='Multiple Choice' or question_type='Modified True or False' or question_type='True or False' or 
				question_type='Identification')")
				or die(mysqli_error());	
				  $row4=mysqli_fetch_array($points);
				      $total=$row4['spoints'];
				      
				$mpoints=mysqli_query($con,"select *,SUM(points) as mpoints from question natural join answer
				where quiz_id='$id' and question_type='Enumeration'")
				or die(mysqli_error());	
				  $row5=mysqli_fetch_array($mpoints);
			    
				$mpoints1=mysqli_query($con,"select *,SUM(points) as mpoints1 from question natural join answer
				where quiz_id='$id' and question_type='Matching Type'")
				or die(mysqli_error());	
			    $row6=mysqli_fetch_array($mpoints1);
						$total=$total+$row5['mpoints']+$row6['mpoints1'];
						
						
                   echo "
                   <tfoot>
                      <tr>
                        <th></th>
                        <th></th>
                        
                        <th>Total Points</th>
						<th>$total</th>
						<th></th>
						<th></th>
						
                        <th></th>
                      </tr>
                    </tfoot>
                  </table>";}?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  </div>	
			</div>
           
<!--end of col 1-->
      
	  </div><!-- /.row -->	
		  
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
				jQuery("textarea[name='question']").val();
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
<script type="text/javascript">
           function createPetField() {
	      var input = document.createElement('input');
	      input.type = 'text';
	      input.name = 'answer[]';
	      input.class='form-control';
	      input.style.height = "33px";
	      input.style.width = "318px";
	      return input;
	    }

	    var form = document.getElementById('enumeration');
	    document.getElementById('addfield').addEventListener('click', function(e) {
	      form.appendChild(createPetField());
	    });
        </script>
<script>
var counter = 1;
var limit = 2;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + 10 + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = " <div class='col-md-2'><input type='text' class='form-control' name='answer2[]'><input type='text' class='form-control' name='answer2[]'><input type='text' class='form-control' name='answer2[]'><input type='text' class='form-control' name='answer2[]'><input type='text' class='form-control' name='answer2[]'></div><div class='col-md-4'><input type='text' class='form-control' name='question1[]'><input type='text' class='form-control' name='question1[]'><input type='text' class='form-control' name='question1[]'><input type='text' class='form-control' name='question1[]'><input type='text' class='form-control' name='question1[]'></div><div class='col-md-1'><input type='text' class='form-control' value='F' name='letter1[]' readonly><input type='text' class='form-control' value='G' name='letter1[]' readonly><input type='text' class='form-control' value='H' name='letter1[]' readonly><input type='text' class='form-control' value='I' name='letter1[]' readonly><input type='text' class='form-control' value='J' name='letter1[]' readonly></div><div class='col-md-4'><input type='text' class='form-control' name='choice1[]'><input type='text' class='form-control' name='choice1[]'><input type='text' class='form-control' name='choice1[]'><input type='text' class='form-control' name='choice1[]'><input type='text' class='form-control' name='choice1[]'></div>";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}
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
