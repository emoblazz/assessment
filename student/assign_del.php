<?php
include("../dist/includes/dbcon.php");
$id=$_GET['id'];
$result=mysqli_query($con,"DELETE FROM stud_assign WHERE stud_assign_id ='$id'")
	or die(mysqli_error());
	$del=mysqli_query($con,"DELETE FROM upload WHERE stud_assign_id ='$id'")
	or die(mysqli_error());


?>