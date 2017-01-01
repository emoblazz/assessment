<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$tid=$_SESSION['id'];
	$title = $_POST['title'];
	$class = $_POST['class'];
	$due = $_POST['due'];
	$pts = $_POST['pts'];
	$term = $_POST['term'];
	date_default_timezone_set("Asia/Manila");
	$date=date('Y-m-d');
	$time=date('H:i:s');
	
	
	mysqli_query($con,"INSERT INTO assign(assign_desc,assign_date,assign_due,assign_time,assign_pts,t_id,assign_term) VALUES('$title','$date','$due','$time','$pts','$tid','$term')")or die(mysqli_error());
	    $id=mysqli_insert_id($con);
	    
	foreach($class as $chk1) {	
				    mysqli_query($con,"INSERT INTO assign_class(assign_id,class_id) VALUES('$id','$chk1')")or die(mysqli_error($con));
				    
				    mysqli_query($con,"INSERT INTO t_log(t_id,activity_type,activity,activity_id,class_id,log_date) VALUES('$tid','assignment','posted new assignment','$id','$chk1','$date')")or die(mysqli_error());
					}
			        
	    $max_file_size = 100000*100; //10mb
	    $path = "../dist/uploads/"; // Upload directory
	    $count = 0;

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
				
				mysqli_query($con,"INSERT INTO t_upload(assign_id,file) VALUES('$id','$name')")or die(mysqli_error());
			
				 
	
			    }
					  echo "<script type='text/javascript'>alert('Successfully posted new assignment!');</script>";
					  echo "<script>document.location='assignment.php'</script>";  
			}
		    }
	    }

	
	
?>
