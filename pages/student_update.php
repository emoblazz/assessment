<?php
include('../dist/includes/dbcon.php');

 if (isset($_POST['update']))
 { 
 $id = $_POST['id'];
 $last = ucwords($_POST['last']);
 $first = ucwords($_POST['first']);
 $bday = $_POST['bday'];
 $contact = $_POST['contact'];
 $email = $_POST['email'];
 $address = ucwords($_POST['address']);
 $cys = $_POST['cys'];
 $name = $_FILES["image"]["name"];
	if ($name=="")
	{	
	$name=$_POST['image1'];
	}
	else
	{
		
	$type = $_FILES["image"]["type"];
	$size = $_FILES["image"]["size"];
	$temp = $_FILES["image"]["tmp_name"];
	$error = $_FILES["image"]["error"];
	
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
 mysqli_query($con,"UPDATE student SET stud_last='$last',stud_first='$first',stud_bday='$bday',stud_contact='$contact',stud_email='$email',stud_address='$address',stud_pic='$name',stud_class='$cys' where stud_id='$id'")
 or die(mysqli_error()); 

	echo "<script type='text/javascript'>alert('Successfully updated student details!');</script>";
	echo "<script>document.location='student.php'</script>";
  
 }
