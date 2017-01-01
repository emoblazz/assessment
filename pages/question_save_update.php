<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

	$question_id=$_POST['question_id'];
	$question=$_POST['question'];
	$points=$_POST['points'];
	$answer=$_POST['answer'];
	$qid=$_POST['qid'];
	$type=$_POST['type'];
	
	
	
  if (isset($_POST['update'])){
	
	if ($type=="Multiple Choice")
	{
		
		$aid=$_POST['aid'];  
		$choices = $_POST['choices'];
		$letter = $_POST['letter'];
				
		$i=0;
		foreach($aid as $id) { 
			mysqli_query($con,"update answer set answer='$answer',choices='$choices[$i]' where answer_id='$id'")or die(mysqli_error($con));  
			$i++;
			
		}
	}
	if ($type=="Enumeration")
	{
		
		$aid=$_POST['aid'];  
		$answer = $_POST['answer'];
		
		$i=0;
		foreach($aid as $id) { 
			mysqli_query($con,"update answer set answer='$answer[$i]' where answer_id='$id'")or die(mysqli_error($con));  
			$i++;
			
		}
	}
	if ($type=="Matching Type")
	{
		
		$aid=$_POST['aid'];  
		$answer = $_POST['answer2'];
		$letter = $_POST['letter1'];
		
		$choice = $_POST['choice1'];
		$cola = $_POST['cola'];
		
		$i=0;
		foreach($aid as $id) { 
			mysqli_query($con,"update answer set answer='$answer[$i]',cola='$cola[$i]',letter='$letter[$i]',choices='$choice[$i]' where answer_id='$id'")or die(mysqli_error($con));  
			$i++;
			
		}
	}
	else{
	
		    
		    mysqli_query($con,"update answer set answer='$answer' where question_id='$question_id'")or die(mysqli_error($con));  
		   
	 }
	 mysqli_query($con,"update question set question='$question',points='$points' where question_id='$question_id'")or die(mysqli_error($con));  
	 echo "<script>document.location='create_quiz.php?qid=$qid'</script>";   
   }
?>