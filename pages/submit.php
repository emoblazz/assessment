<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

	$sid = $_POST['sid'];
	$prelim = $_POST['prelim'];
	$midterm = $_POST['midterm'];
	$endterm = $_POST['endterm'];
	$final = $_POST['final'];
	$cid = $_POST['cid'];
	
	$i=0;
	foreach($sid as $id) {	
		mysqli_query($con,"UPDATE enrol SET prelim='$prelim[$i]',midterm='$midterm[$i]',endterm='$endterm[$i]',final='$final[$i]' where class_id='$cid' and stud_id='$id'")
 or die(mysqli_error()); 
	$i++;
				}
			        
	 
					  echo "<script type='text/javascript'>alert('Successfully submitted grades!');</script>";
					  echo "<script>document.location='home.php'</script>";  
			
?>
