<?php
include('../dist/includes/dbcon.php');

 if (isset($_POST['update']))
 { 
 $id = $_POST['id'];
 $name = $_POST['name'];
 $color = $_POST['color'];
 $status = $_POST['status'];



 mysqli_query($con,"UPDATE class SET class_name='$name',class_color='$color',class_stat='$status' where class_id='$id'")
 or die(mysqli_error()); 

	echo "<script type='text/javascript'>alert('Successfully updated class details!');</script>";
	echo "<script>document.location='view_class.php?cid=$id'</script>";
 } 

