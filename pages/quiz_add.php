<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
if (isset($_POST['save']))
{
	$tid=$_SESSION['id'];
	$title = $_POST['title'];
	$class = $_POST['class'];
	$duration = $_POST['duration'];
	$type = $_POST['type'];
	$term = $_POST['term'];
	$date=date('Y-m-d');
	$time=date('h:i:s');
	
	mysqli_query($con,"INSERT INTO quiz(quiz_title,quiz_date,quiz_time,quiz_type,quiz_duration,t_id,quiz_term) VALUES('$title','$date','$time','$type','$duration','$tid','$term')")or die(mysqli_error());
	
	$id=mysqli_insert_id($con);
		 
		  foreach($class as $chk1) {	
			  mysqli_query($con,"INSERT INTO class_quiz(quiz_id,class_id) VALUES('$id','$chk1')")or die(mysqli_error($con));
			  }
			  echo "<script type='text/javascript'>alert('Successfully created new test!');</script>";
			  echo "<script>document.location='quiz.php'</script>";   
	
}	
?>