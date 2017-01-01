<?php 

include('../dist/includes/dbcon.php');
	
	$last = $_POST['slast'];
	$first = $_POST['sfirst'];
	$pass = $_POST['spass'];
	$user = $_POST['suser'];
	
	$name = $_FILES["simage"]["name"];
	if ($name=="")
	{
		$name="default.gif";
	}
	else
	{
	$name = $_FILES["simage"]["name"];
	$type = $_FILES["simage"]["type"];
	$size = $_FILES["simage"]["size"];
	$temp = $_FILES["simage"]["tmp_name"];
	$error = $_FILES["simage"]["error"];
	
		if ($error > 0){
			die("Error uploading file! Code $error.");
			}
		else{
			if($size > 100000000000) //conditions for the file
				{
				die("Format is not allowed or file size is too big!");
				}
		else
		      {
			move_uploaded_file($temp, "../dist/img/".$name);
		      }
			}
	}	
		mysqli_query($con,"INSERT INTO student(stud_last,stud_first,stud_pass,stud_pic,stud_user) VALUES('$last','$first','$pass','$name','$user')")or die(mysqli_error());  
	echo "<script type='text/javascript'>alert('You are successfully registered!');</script>";
	echo "<script>document.location='../index.php'</script>";   
	
	
?>