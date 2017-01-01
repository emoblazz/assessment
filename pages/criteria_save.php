<?php 

include('../dist/includes/dbcon.php');

	$cid = $_POST['cid'];
	$at = $_POST['at']/100;
	$assign = $_POST['assign']/100;
	$quiz =$_POST['quiz']/100;
	$exam =$_POST['exam']/100;
	$project =$_POST['project']/100;
	
	if (isset($_POST['update']))
	{
	mysqli_query($con,"UPDATE criteria SET attendance='$at',assign='$assign',quiz='$quiz',exam='$exam',project='$project' where class_id='$cid'") or die(mysqli_error()); 
	
	}
	else{
	mysqli_query($con,"INSERT INTO criteria(class_id,attendance,assign,quiz,exam,project) VALUES('$cid','$at','$assign','$quiz','$exam','$project')")or die(mysqli_error());  
	
	}	
	echo "<script type='text/javascript'>alert('Successfully updated criteria for this class!');</script>";
	echo "<script>document.location='view_class.php?cid=$cid'</script>";   	
	
?>