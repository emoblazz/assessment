<?php
include("../dist/includes/dbcon.php");
$id=$_GET['id'];
$result=mysqli_query($con,"DELETE FROM t_upload WHERE t_upload_id ='$id'")
	or die(mysqli_error());

?>