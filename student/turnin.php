<?php 
session_start();
if(empty($_SESSION['sid'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$sid=$_SESSION['sid'];
	$content = $_POST['content'];
	$aid = $_POST['aid'];
	date_default_timezone_set("Asia/Manila");
	$date=date('Y-m-d');
	$time=date('h:i:s');
	
	$query=mysqli_query($con,"select COUNT(*) as count from stud_assign where assign_id='$aid' and stud_id='$sid'")or die(mysqli_error($con));	
	$row1=mysqli_fetch_array($query);
	if ($row1['count']<1)
	{
	$query1=mysqli_query($con,"select * from assign where assign_id='$aid'")or die(mysqli_error($con));	
	$row2=mysqli_fetch_array($query1);
	  if ($row2['assign_due']<$date)
	    {
	    $status="Late";
	    }
	  else
	  {$status="Submitted";}
	    
	  $max_file_size = 100000*100; //10000 kb
	    $path = "../dist/uploads/"; // Upload directory
	    $count = 0;

	    
	  mysqli_query($con,"INSERT INTO stud_assign(assign_id,content,date_posted,time_posted,stud_id,status) VALUES('$aid','$content','$date','$time','$sid','$status')")or die(mysqli_error($con));
	  $id=mysqli_insert_id($con);
			  
	    if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		    // Loop $_FILES to exeicute all files
		    foreach ($_FILES['files']['name'] as $f => $name) {     
			if ($_FILES['files']['error'][$f] == 4) {
			    continue; // Skip file if any error found
			}	       
			if ($_FILES['files']['error'][$f] == 0) {	           
			    if ($_FILES['files']['size'][$f] > $max_file_size) {
				$message[] = "$name is too large!.";
				continue; // Skip large files
				
			    }
			    else{ // No error found! Move uploaded files 
				if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
				$count++; // Number of successfully uploaded file
				
			  mysqli_query($con,"INSERT INTO upload(stud_assign_id,file) VALUES('$id','$name')")or die(mysqli_error($con));
			  
			  $class=mysqli_query($con,"select * from assign_class natural join enrol where assign_id='$aid' and stud_id='$sid'")or die(mysqli_error($con));	
			    $rowclass=mysqli_fetch_array($class);
			    $cid=$rowclass['class_id'];
			    
			  mysqli_query($con,"INSERT INTO stud_log(stud_id,activity_type,activity,log_date,class_id) VALUES('$sid','assignment','submmitted assignment','$date','$cid')")or die(mysqli_error());  
			  
			  echo "<script type='text/javascript'>alert('Successfully turned in assignment!');</script>";
			  echo "<script>document.location='home.php'</script>"; 
	
			    }
			}
		    }
	    }  
	  
	}	
	else 
	{
	echo "<script type='text/javascript'>alert('Assignment already submitted!');</script>";
	echo "<script>document.location='home.php'</script>"; 	
	 
	}
	
?>