<?php 
session_start();
if(empty($_SESSION['sid'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	date_default_timezone_set("Asia/Manila");
	$qid=$_REQUEST['qid'];
	$sid=$_SESSION['sid'];
	$_SESSION['start']=date("H:i:s");
	$_SESSION['time']=$_REQUEST['time'];
	$time=$_SESSION['time'];
	$_SESSION['end']=date("H:i:s",strtotime("+$time minutes",strtotime($_SESSION['start'])));
	
	$check=mysqli_query($con,"select COUNT(*) as count from question_order where quiz_id='$qid' and stud_id='$sid'")or die(mysqli_error($con));
	$row=mysqli_fetch_array($check);
	  if ($row['count']<1)
	    {
	
	$query1=mysqli_query($con,"select * from question where quiz_id='$qid' order by RAND(question_id)")or die(mysqli_error($con));
		$i=0;
		while($row2=mysqli_fetch_array($query1))
		    {
			$i++;
			$question_id=$row2['question_id'];		      	  
			
			mysqli_query($con,"INSERT INTO question_order(stud_id,question_id,q_order,quiz_id)VALUES('$sid','$question_id','$i','$qid')")or die(mysqli_error($con));  
			
		    }
	}	    
		    $query2=mysqli_query($con,"select * from question_order where quiz_id='$qid' and stud_id='$sid' and q_order='1'")or die(mysqli_error($con));
			$row2=mysqli_fetch_array($query2);
	
		    $_SESSION['question_id']=$row2['question_id'];
		    $_SESSION['quiz_id']=$qid;
		    echo "<script>document.location='take_quiz.php'</script>";   
	
?>