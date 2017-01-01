<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

	include('../dist/includes/dbcon.php');

	$id=$_REQUEST['id'];
	$qid=$_REQUEST['qid'];
	// sending query
	mysqli_query($con,"DELETE FROM question WHERE question_id = '$id'")
	or die(mysqli_error());
	mysqli_query($con,"DELETE FROM answer WHERE question_id = '$id'")
	or die(mysqli_error());
  	
	echo "<script type='text/javascript'>alert('Successfully deleted a question!');</script>";
	echo "<script>document.location='create_quiz.php?qid=$qid'</script>";
?>										

