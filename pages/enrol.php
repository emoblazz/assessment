<?php
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id=$_REQUEST['id'];
$cid=$_SESSION['cid'];
$tid=$_SESSION['id'];
date_default_timezone_set("Asia/Manila"); 
$date=date("Y-m-d");	

$set=mysqli_query($con,"select COUNT(*) as count from enrol where stud_id='$id' and class_id='$cid'")or die(mysqli_error());
  $row=mysqli_fetch_array($set);
    $count=$row['count'];
if ($count==0)
{
    mysqli_query($con,"INSERT INTO enrol(stud_id,class_id) VALUES('$id','$cid')")or die(mysqli_error());  
    
    mysqli_query($con,"INSERT INTO t_log(t_id,activity_type,activity,stud_id,log_date,class_id) VALUES('$tid','enrol','added you to the group','$id','$date','$cid')")or die(mysqli_error());  
    
    echo "<script type='text/javascript'>alert('Successfully added to the group!');</script>";
    echo "<script>document.location='view_class.php?cid=$cid'</script>";
}
else
{
    echo "<script type='text/javascript'>alert('Already added to the group!');</script>";
    echo "<script>document.location='view_class.php?cid=$cid'</script>";
			
}
?>		

