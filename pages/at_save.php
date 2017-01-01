<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$sid = $_POST['sid'];
	$score = $_POST['score'];
	$term = $_POST['term'];
	$total = $_POST['total'];
	$cid = $_POST['cid'];
	
	
	$i=0;	
	foreach($sid as $id) {	
	
		$equiv=($score[$i]/$total)*100;
	
		if ($score['$i']==0)
		{
			mysqli_query($con,"INSERT INTO grade (score,total,grade,stud_id,class_id,term,type) VALUES('$score[$i]','$total','$equiv','$id','$cid','$term','Attendance')")or die(mysqli_error());
		
		}
		if ($equiv<>0)
		{	
			mysqli_query($con,"UPDATE grade SET score='$score[$i]',grade='$equiv',total='$total' where class_id='$cid' and stud_id='$id' and term='$term'") or die(mysqli_error()); 
		}
		$i++;
	}
	
	   
					  echo "<script type='text/javascript'>alert('Successfully updated attendance!');</script>";
					  echo "<script>document.location='attendance.php?cid=$cid&term=$term'</script>";  
			
	
?>
