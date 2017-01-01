<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$tid=$_SESSION['id'];
	$title =$_POST['title'];
	$class =$_POST['class'];
	$due = $_POST['due'];
	$pts = $_POST['pts'];
	$term = $_POST['term'];
	$aid = $_POST['aid'];
	date_default_timezone_set("Asia/Manila");
	
	mysqli_query($con,"update assign set assign_desc='$title',assign_due='$due',assign_pts='$pts',assign_term='$term' where t_id='$tid' and assign_id='$aid'")or die(mysqli_error());
	
	foreach($class as $class1){
		$query=mysqli_query($con,"select * from assign_class where assign_id='$aid' and class_id='$class1'")or die(mysqli_error());
					$count=mysqli_num_rows($query);
						if ($count==0){
						//echo $class1;
						mysqli_query($con,"INSERT INTO assign_class(assign_id,class_id) VALUES('$aid','$class1')")or die(mysqli_error($con));
						}
		
	}
	    $max_file_size = 100000*100; //10mb
	    $path = "../dist/uploads/"; // Upload directory
	    $count = 0;

	    
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
				
				mysqli_query($con,"INSERT INTO t_upload(assign_id,file) VALUES('$aid','$name')")or die(mysqli_error());
			
				 
	
			    }
			}
		    }
	    
	    

	mysqli_query($con,"DELETE FROM assign_class WHERE assign_id='$aid' and class_id NOT IN('".implode("','",$class)."')")or die(mysqli_error());
				
	
	echo "<script type='text/javascript'>alert('Successfully updated assignment!');</script>";
	echo "<script>document.location='assignment.php'</script>";  

	
?>
