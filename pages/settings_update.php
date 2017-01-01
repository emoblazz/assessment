<?php
session_start();if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$sem = $_POST['sem'];
 $sy = $_POST['sy'];
 
 if (isset($_POST['update']))
 { 
 
  mysqli_query($con,"UPDATE settings SET sem='$sem',sy='$sy'") or die(mysqli_error()); 
		mysqli_query($con,"UPDATE sy SET status='Active' where year='$sy'") or die(mysqli_error()); 
		mysqli_query($con,"UPDATE sy SET status='Inactive' where year<>'$sy'") or die(mysqli_error()); 
 } 
  if (isset($_POST['add']))
 { 
  mysqli_query($con,"INSERT INTO settings(sem,sy) VALUES('$sem','$sy')")or die(mysqli_error());   
	mysqli_query($con,"UPDATE sy SET status='Active' where year='$sy'") or die(mysqli_error()); 
 } 
 
 $_SESSION['sem']=$sem;
 $_SESSION['sy']=$sy;
 echo "<script type='text/javascript'>alert('Successfully updated settings!');</script>";
	echo "<script>document.location='settings.php'</script>";
