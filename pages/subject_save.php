<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

	$title = $_POST['title'];
	$code = $_POST['code'];
	
	mysqli_query($con,"INSERT INTO subject(subject_code,subject_title) VALUES('$code','$title')")or die(mysqli_error());  
	echo "<script type='text/javascript'>alert('Successfully added new subject!');</script>";
	echo "<script>document.location='subject.php'</script>";   
	
	
?>