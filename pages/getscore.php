<?php
session_start();
include('../dist/includes/dbcon.php');

 if (isset($_POST['update']))
 { 
$cid = $_POST['cid'];
$aid = $_POST['aid'];
$id = $_POST['id'];
$sid = $_POST['sid'];
$score = $_POST['score'];
$gid = $_POST['gid'];
$total = $_POST['total'];
$equiv=$score/$total*100;
date_default_timezone_set("Asia/Manila"); 
$date=date("Y-m-d");
$tid=$_SESSION['id'];

if($gid=="")
{
 $query=mysqli_query($con,"SELECT * from assign where assign_id='$aid'")or die(mysqli_error($con));
  $row=mysqli_fetch_array($query);
  $term=$row['assign_term'];
  
 mysqli_query($con,"INSERT INTO grade(stud_id,class_id,term,score,total,grade,type) values ('$sid','$cid','$term','$score','$total','$equiv','Assignment')") or die(mysqli_error($con)); 
	$gid=mysqli_insert_id($con);
	
  mysqli_query($con,"UPDATE stud_assign SET grade_id='$gid' where stud_assign_id='$id'")
  or die(mysqli_error()); 

  $query1=mysqli_query($con,"SELECT * from stud_assign where stud_assign_id='$id'")or die(mysqli_error($con));
  $row1=mysqli_fetch_array($query1);
  $sid=$row1['stud_id'];
  //$aid=$row1['assign_id'];
		  
  mysqli_query($con,"INSERT INTO t_log(t_id,activity_type,activity,log_date,activity_id,stud_id,class_id) VALUES ('$tid','grade','graded your assignment','$date','$aid','$sid','$cid')")or die(mysqli_error($con));  
    
	echo "<script type='text/javascript'>alert('Successfully added a score!');</script>";
	echo "<script>document.location='class_assign.php?aid=$aid&cid=$cid'</script>";
}
else
{
  mysqli_query($con,"UPDATE grade SET score='$score',grade='$equiv' where grade_id='$gid'")
  or die(mysqli_error()); 

  echo "<script type='text/javascript'>alert('Successfully updated the score!');</script>";
  echo "<script>document.location='class_assign.php?aid=$aid&cid=$cid'</script>";
}
 } 

