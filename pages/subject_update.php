<?php
include('../dist/includes/dbcon.php');

 if (isset($_POST['update']))
 { 
 $code = $_POST['code'];
 $title = $_POST['title'];



 mysqli_query($con,"UPDATE subject SET subject_title='$title' where subject_code='$code'")
 or die(mysqli_error()); 

	echo "<script type='text/javascript'>alert('Successfully updated subject details!');</script>";
	echo "<script>document.location='subject.php'</script>";
 } 

