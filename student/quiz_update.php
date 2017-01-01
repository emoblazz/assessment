<?php 
session_start();
if(empty($_SESSION['sid'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

	$question_id=$_POST['question_id'];
	$qorder=$_POST['qorder'];
	$answer=$_POST['answer'];
	$oid=$_POST['order_id'];
	$sid=$_SESSION['sid'];
	$quiz_id=$_SESSION['quiz_id'];
	$type=$_POST['type'];
	
  if (isset($_POST['next'])){
	if ($type=="Matching Type")
	{
	
	$answer=$_POST['answer'];
	$aid=$_POST['answer_id'];
	      $i=0;
	      foreach($answer as $a)
	      {
	      
		$mt=mysqli_query($con,"select * from question natural join answer where answer_id='$aid[$i]' and answer='$a'")or die(mysqli_error($con));
 		$countmt=mysqli_num_rows($mt);
 		$rowmt=mysqli_fetch_array($mt);
 		if ($countmt>0)
 		      {$score=$score+$rowmt['points'];}
		
		 $i++;
	      }
	      
	      $answer=implode(",",$answer);
		mysqli_query($con,"update question_order set answer='$answer',q_score='$score' where order_id='$oid'")or die(mysqli_error($con));  
	    
	}
	else if ($type=="Enumeration")
	{
		$i=0;
		foreach ($answer as $a)
		{
		$enum=mysqli_query($con,"select * from answer natural join question where question_id='$question_id' and answer='$a'")or die(mysqli_error($con));
		  $count=mysqli_num_rows($enum);
		  $rowenum=mysqli_fetch_array($enum);
		  
		  if ($count>0)
		    $score=$score+$rowenum['points'];  
		  } 
		  $answer1=implode(",",$answer);
		  mysqli_query($con,"update question_order set answer='$answer1',q_score='$score' where order_id='$oid'")or die(mysqli_error($con));  
	}
	else if (($type=="Identification") or ($type=="True or False") or ($type=="Modified True or False") or ($type=="Multiple Choice")){
 	$query1=mysqli_query($con,"select * from answer natural join question where question_id='$question_id' group by question_id")or die(mysqli_error($con));
	  $row1=mysqli_fetch_array($query1);
	        $correct=$row1['answer'];
	        $score=$row1['points'];
	        
		  if($correct==$answer)
		  {
		    
		    mysqli_query($con,"update question_order set answer='$answer',q_score='$score' where order_id='$oid'")or die(mysqli_error($con));  
		  }
		  else
		  {
		    mysqli_query($con,"update question_order set answer='$answer',q_score='0' where order_id='$oid''")or die(mysqli_error($con));  
		  }
		  }
		    $next=$qorder+1;
		    $query1=mysqli_query($con,"select * from question_order where quiz_id='$quiz_id' and stud_id='$sid' and q_order='$next'")or die(mysqli_error($con));
			$row2=mysqli_fetch_array($query1);
			$_SESSION['question_id']=$row2['question_id'];
			echo "<script>document.location='take_quiz.php'</script>";   
	}
   
  if (isset($_POST['finish'])){
	if ($type=="Matching Type")
	{
	  $answer=$_POST['answer'];
	$aid=$_POST['answer_id'];
	      $i=0;
	      foreach($answer as $a)
	      {
	      
		$mt=mysqli_query($con,"select * from question natural join answer where answer_id='$aid[$i]' and answer='$a'")or die(mysqli_error($con));
 		$countmt=mysqli_num_rows($mt);
 		$rowmt=mysqli_fetch_array($mt);
 		if ($countmt>0)
 		      {$score=$score+$rowmt['points'];}
		
		 $i++;
	      }
	      
	     $answer=implode(",",$answer);
		mysqli_query($con,"update question_order set answer='$answer',q_score='$score' where order_id='$oid'")or die(mysqli_error($con));  
	}
	else if ($type=="Enumeration")
	{
		$i=0;
		foreach ($answer as $a)
		{
		$enum=mysqli_query($con,"select * from answer natural join question where question_id='$question_id' and answer='$a'")or die(mysqli_error($con));
		  $count=mysqli_num_rows($enum);
		  $rowenum=mysqli_fetch_array($enum);
		  
		  if ($count>0)
		    $score=$score+$rowenum['points'];  
		  } 
		  $answer1=implode(",",$answer);
		  mysqli_query($con,"update question_order set answer='$answer1',q_score='$score' where order_id='$oid'")or die(mysqli_error($con));  
	}
	else if (($type=="Identification") or ($type=="True or False") or ($type=="Modified True or False") or ($type=="Multiple Choice")){
 	$query1=mysqli_query($con,"select * from answer natural join question where question_id='$question_id' group by question_id")or die(mysqli_error($con));
	  $row1=mysqli_fetch_array($query1);
	        $correct=$row1['answer'];
	        $score=$row1['points'];
	        
		  if($correct==$answer)
		  {
		    
		    mysqli_query($con,"update question_order set answer='$answer',q_score='$score' where order_id='$oid'")or die(mysqli_error($con));  
		  }
		  else
		  {
		    mysqli_query($con,"update question_order set answer='$answer',q_score='0' where order_id='$oid'")or die(mysqli_error($con));  
		  }
	}
		   
	  $date=date("Y-m-d");
	  $points=mysqli_query($con,"select *,SUM(points) as spoints from question where quiz_id='$quiz_id' and (question_type='Multiple Choice' or question_type='Modified True or False' or question_type='True or False' or question_type='Identification')")or die(mysqli_error());	
			$row4=mysqli_fetch_array($points);
			$total=$row4['spoints'];
			
	  $mpoints=mysqli_query($con,"select *,SUM(points) as mpoints from question natural join answer where quiz_id='$quiz_id' and question_type='Enumeration'")or die(mysqli_error());	
			$row5=mysqli_fetch_array($mpoints);
			$total=$total+$row5['mpoints'];
	
	$mpoints1=mysqli_query($con,"select *,SUM(points) as mpoints1 from question natural join answer where quiz_id='$quiz_id' and question_type='Matching Type'")or die(mysqli_error());	
			$row6=mysqli_fetch_array($mpoints1);
			$total=$total+$row5['mpoints']+$row6['mpoints1'];
			
	
			$scorequery=mysqli_query($con,"select *,SUM(q_score) as score from question_order where quiz_id='$quiz_id' and stud_id='$sid'")or die(mysqli_error());
			  $rowpt=mysqli_fetch_array($scorequery);
			  $score=$rowpt['score'];
			  $equiv=$score/$total*100;
			  $equiv=number_format($equiv,2);	
		
		$class=mysqli_query($con,"select class_id,quiz_term,quiz_type from class_quiz natural join enrol natural join quiz where quiz_id='$quiz_id' and stud_id='$sid'")or die(mysqli_error());
			  $classrow=mysqli_fetch_array($class);
			  $class_id=$classrow['class_id'];
			  $term=$classrow['quiz_term'];
			  $type=$classrow['quiz_type'];
			  
		mysqli_query($con,"insert into grade(stud_id,class_id,score,total,grade,term,type) values ('$sid','$class_id','$score','$total','$equiv','$term','$type')")or die(mysqli_error($con));  
		$id = mysqli_insert_id($con);
		mysqli_query($con,"insert into quiz_result (quiz_id,stud_id,quiz_taken,grade_id) values ('$quiz_id','$sid','$date','$id')")or die(mysqli_error($con));  
		 
		 echo "<script>document.location='result.php'</script>";   
	 
   }
?>