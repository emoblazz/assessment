<?php session_start();

include('dist/includes/dbcon.php');

if(isset($_POST['login']))
{

$user_unsafe=$_POST['tuser'];
$pass_unsafe=$_POST['tpass'];

$user = mysqli_real_escape_string($con,$user_unsafe);
$pass = mysqli_real_escape_string($con,$pass_unsafe);

$query=mysqli_query($con,"select * from teacher where t_user='$user' and t_pass='$pass'")or die(mysqli_error());
	$row=mysqli_fetch_array($query);
           $id=$row['t_id'];
           $salut=$row['t_salut'];
           $first=$row['t_first'];
           $last=$row['t_last'];
           $pic=$row['t_pic'];
           $counter=mysqli_num_rows($query);
  	if ($counter == 0) 
	  {	
	  echo "<script type='text/javascript'>alert('Invalid Username or Password!');
	  document.location='index.php'</script>";
	  } 
	  elseif ($counter > 0)
	  {
	  $_SESSION['id']=$id;	
	 // $_SESSION['id']=$row['t_id'];
	  $_SESSION['pic']=$row['t_pic'];
	  $_SESSION['name']=$salut." ".$first." ".$last;
	  
	  echo "<script type='text/javascript'>document.location='pages/close_assign.php'</script>";
  
	  }
}

if(isset($_POST['slogin']))
{

$user_unsafe=$_POST['suser'];
$pass_unsafe=$_POST['spass'];

$user = mysqli_real_escape_string($con,$user_unsafe);
$pass = mysqli_real_escape_string($con,$pass_unsafe);

$query=mysqli_query($con,"select * from student where stud_user='$user' and stud_pass='$pass'")or die(mysqli_error());
	$row=mysqli_fetch_array($query);
           $id=$row['stud_id'];
           $first=$row['stud_first'];
           $last=$row['stud_last'];
           $pic=$row['stud_pic'];
           $counter=mysqli_num_rows($query);
  	if ($counter == 0) 
	  {	
	  echo "<script type='text/javascript'>alert('Invalid Username or Password!');
	  document.location='index.php'</script>";
	  } 
	  elseif ($counter > 0)
	  {
	  $_SESSION['sid']=$id;
	  $_SESSION['spic']=$pic;
	  $_SESSION['sname']=$first." ".$last;
	  
	  echo "<script type='text/javascript'>document.location='student/home.php'</script>";
    }
	 
}?>
	
