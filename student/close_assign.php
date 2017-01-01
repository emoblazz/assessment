<?php
session_start();
$sid=$_SESSION['sid'];
include('../dist/includes/dbcon.php');

date_default_timezone_set("Asia/Manila");
$date=date('Y-m-d');
 
	 //display all assignment created by teacher that are active
	 $query=mysqli_query($con,"SELECT * FROM assign natural join class natural join enrol where stud_id='$sid' and class_stat='Active' and assign_due<'$date'")or die(mysqli_error());
		  while ($row=mysqli_fetch_array($query)){
		      $aid=$row['assign_id'];
		      $cid=$row['class_id'];
		      
		      //check student who doesnt submit assignment
		      $query1=mysqli_query($con,"SELECT * FROM enrol where class_id='$cid' and stud_id NOT IN (select stud_id from stud_assign where assign_id='$aid')")or die(mysqli_error());
			  while ($row1=mysqli_fetch_array($query1)){
			      $sid=$row1['stud_id'];
			      
			      //insert to db
			      mysqli_query($con,"INSERT INTO stud_assign (stud_id,assign_id,grade,equiv,status) values ('$sid','$aid','0','0','Not Submitted')") or die(mysqli_error()); 
		      }
		      }
		echo "<script>document.location='home.php'</script>";

