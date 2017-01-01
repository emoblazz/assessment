<?php
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
date_default_timezone_set("Asia/Manila"); 
$date=date("Y-m-d");
$tid=$_SESSION['id'];
$cid=$_SESSION['cid'];

	$id=$_POST['id'];
	{
	// sending query
        $query1=mysqli_query($con,"select * from enrol where enrol_id='$id'")or die(mysqli_error());
        $row=mysqli_fetch_array($query1);
        $stud_id=$row['stud_id'];
	
	
	mysqli_query($con,"INSERT INTO t_log(t_id,activity_type,activity,log_date,class_id,stud_id) VALUES('$tid','unenrol','remove you to the group','$date','$cid','$stud_id')")or die(mysqli_error());  
	
	mysqli_query($con,"DELETE FROM enrol WHERE enrol_id='$id'")or die(mysqli_error()); 
	echo "<script>document.location='view_class.php?cid=$_SESSION[cid]'</script>";
	}
?>										




