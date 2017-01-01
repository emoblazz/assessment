<?php 

include('../dist/includes/dbcon.php');
	
	$salut = $_POST['tsalut'];
	$last = $_POST['tlast'];
	$first = $_POST['tfirst'];
	$pass = $_POST['tpass'];
	$user = $_POST['tuser'];
	
	$name = $_FILES["timage"]["name"];
	if ($name=="")
	{
		$name="default.gif";
	}
	else
	{
	$name = $_FILES["timage"]["name"];
	$type = $_FILES["timage"]["type"];
	$size = $_FILES["timage"]["size"];
	$temp = $_FILES["timage"]["tmp_name"];
	$error = $_FILES["timage"]["error"];
	
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
		mysqli_query($con,"INSERT INTO teacher(t_last,t_first,t_pass,t_salut,t_pic,t_user) VALUES('$last','$first','$pass','$salut','$name','$user')")or die(mysqli_error());  
echo "<script type='text/javascript'>alert('Successfully added new teacher!');</script>";
	echo "<script>document.location='../index.php'</script>";   
	
	
?>