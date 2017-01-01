<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

	$name = $_POST['name'];
	$color = $_POST['color'];
	$id = $_SESSION['id'];
	$subject = $_POST['subject'];
	
	
	$string="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$limit=5;
	  $i=0;
	  $code="";
	  while($i<$limit)
	  {
	  $rand=rand(0,62);
	  $code=$code.$string[$rand];
	  $i++;
	  }
	  
	mysqli_query($con,"INSERT INTO class(class_name,class_color,class_stat,t_id,class_code,subject_code) VALUES('$name','$color','Active','$id','$code','$subject')")or die(mysqli_error($con));  
	
	$cid=mysqli_insert_id($con);
	$at = $_POST['at']/100;
	$assign = $_POST['assign']/100;
	$quiz =$_POST['quiz']/100;
	$exam =$_POST['exam']/100;
	$project =$_POST['project']/100;
	//$att =$_POST['att']/100;
	//$seat =$_POST['seat']/100;
	
	mysqli_query($con,"INSERT INTO criteria(class_id,attendance,assign,quiz,exam,project) VALUES('$cid','$at','$assign','$quiz','$exam','$project')")or die(mysqli_error($con));  
	
	
	echo "<script type='text/javascript'>alert('Successfully added new class!');</script>";
	echo "<script>document.location='home.php'</script>";   
	
	
?>