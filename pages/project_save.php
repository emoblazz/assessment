<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$sid = $_POST['sid'];
	$score = $_POST['score'];
	$term = $_POST['term'];
	$cid = $_POST['cid'];

	if (isset($_POST['save']))
	{
	$i=0;
	foreach($sid as $id) {	
	  
	  mysqli_query($con,"INSERT INTO grade(class_id,stud_id,grade,term,type) VALUES('$cid','$id','$score[$i]','$term','Project')")or die(mysqli_error());
		$i++;			}
			        
	}
	if (isset($_POST['update']))
	{
	  $i=0;
	foreach($sid as $id) {	
	  
	mysqli_query($con,"UPDATE grade SET grade='$score[$i]' where class_id='$cid' and stud_id='$id' and term='$term'") or die(mysqli_error()); 
		$i++;			}
		
	}
	
					  echo "<script type='text/javascript'>alert('Successfully updated project!');</script>";
					  echo "<script>document.location='project.php?cid=$cid&term=$term'</script>";  
	
?>
