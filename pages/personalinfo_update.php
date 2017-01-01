<?php
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
 $id = $_SESSION['id'];
 if (isset($_POST['update']))
 { 
 $last = $_POST['last'];
 $first = $_POST['first'];
 $salut = $_POST['salut'];


 mysqli_query($con,"UPDATE teacher SET t_last='$last',t_first='$first',t_salut='$salut' where t_id='$id'")
 or die(mysqli_error()); 
 
 $_SESSION['name']=$salut." ".$first." ".$last;

	echo "<script type='text/javascript'>alert('Successfully updated personal details!');</script>";
	echo "<script>document.location='account_settings.php'</script>";
 } 
  if (isset($_POST['updateusername']))
  { 
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $pass1 = $_POST['pass1'];

    if ($pass<>$pass1)
    {
    echo "<script type='text/javascript'>alert('Invalid password!');</script>";
	    echo "<script>document.location='account_settings.php'</script>";
    }
    else{
    mysqli_query($con,"UPDATE teacher SET t_user='$username' where t_id='$id'")
    or die(mysqli_error()); 

	    echo "<script type='text/javascript'>alert('Successfully updated login details!');</script>";
	    echo "<script>document.location='account_settings.php'</script>";
	   } 
  } 
  
   if (isset($_POST['updatepass']))
  { 
    $new = $_POST['new'];

    mysqli_query($con,"UPDATE teacher SET t_pass='$new' where t_id='$id'")
    or die(mysqli_error()); 

	    echo "<script type='text/javascript'>alert('Successfully changed your password!');</script>";
	    echo "<script>document.location='account_settings.php'</script>";
  } 
 
  if (isset($_POST['upload']))
  { 
  $name = $_FILES["image"]["name"];
	
		
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
			
			mysqli_query($con,"UPDATE teacher SET t_pic='$name' where t_id='$id'")or die(mysqli_error()); 	
			 $_SESSION['pic']=$name;
			echo "<script type='text/javascript'>alert('Successfully changed your picture!');</script>";
			echo "<script>document.location='account_settings.php'</script>";
		  
		      }
		   }
		
		
}
