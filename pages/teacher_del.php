<?php session_start();
include('session.php');

	include('../dist/includes/dbcon.php');

	$id =$_REQUEST['id'];

	// sending query
	mysqli_query($con,"DELETE FROM teacher WHERE t_id = '$id'")
	or die(mysqli_error());
  	
	echo "<script type='text/javascript'>alert('Successfully deleted a teacher!');</script>";
	echo "<script>document.location='teacher.php'</script>";
?>										

