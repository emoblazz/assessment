<?php
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
include('../dist/includes/dbcon.php');

 if (isset($_POST['update']))
 { 
	 $qid = $_POST['qid'];
	 $title = $_POST['title'];
	 $type = $_POST['type'];
	 $duration = $_POST['duration'];
	 $status = $_POST['status']; 
	 $cqid = $_POST['cqid']; 
	 $cid = $_POST['cid'];
	 $class = $_POST['class']; 
	 $term = $_POST['term']; 
	 $tid=$_SESSION['id'];
	 date_default_timezone_set("Asia/Manila"); 
	 $date=date("Y-m-d");
	 mysqli_query($con,"UPDATE quiz SET quiz_title='$title',quiz_type='$type',quiz_duration='$duration',quiz_term='$term' where quiz_id='$qid'")
	 or die(mysqli_error()); 
	 
	 
	 mysqli_query($con,"UPDATE class_quiz SET class_quiz_stat='$status' where class_quiz_id='$cqid'")
	 or die(mysqli_error()); 
	 
	 
	  foreach($class as $chk1) {	
			mysqli_query($con,"INSERT INTO class_quiz(quiz_id,class_id) VALUES('$qid','$chk1')")or die(mysqli_error($con));
			mysqli_query($con,"INSERT INTO t_log (t_id,activity_type,activity,activity_id,log_date,class_id) values ('$tid','test','activated a test','$qid','date','$chk1')") or die(mysqli_error()); 
			
			 }
	    mysqli_query($con,"INSERT INTO t_log (t_id,activity_type,activity,activity_id,log_date,class_id) values ('$tid','test','activated a test','$qid','date','$cid')") or die(mysqli_error($con)); 
		  
	    if ($status=="Deactivated")
	    {
	      
		  
	       $query=mysqli_query($con,"SELECT * FROM enrol where class_id='$cid' and stud_id NOT IN (select stud_id from quiz_result where quiz_id='$qid')")or die(mysqli_error($con));
		  while ($row=mysqli_fetch_array($query)){
		      $sid=$row['stud_id'];
		      
		      mysqli_query($con,"INSERT INTO grade(stud_id,class_id,term,score,grade,type) values ('$sid','$cid','$term','0','0','$type')") or die(mysqli_error($con)); 
		      
		      $id=mysqli_insert_id($con);
		      mysqli_query($con,"INSERT INTO quiz_result(stud_id,quiz_id,grade_id) values ('$sid','$qid','$id')") or die(mysqli_error($con)); 

		      
		  }
	    }
		
		echo "<script type='text/javascript'>alert('Successfully updated quiz details!');</script>";
		echo "<script>document.location='quiz.php'</script>";
	
} 
 if (isset($_POST['remove']))
 { 
	
	 $cqid = $_POST['cqid']; 
	 
	 mysqli_query($con,"DELETE from class_quiz where class_quiz_id='$cqid'")
	 or die(mysqli_error()); 

		echo "<script type='text/javascript'>alert('Successfully deleted a quiz!');</script>";
		echo "<script>document.location='quiz.php'</script>";
	
} 

