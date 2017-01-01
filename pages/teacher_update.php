<?php
include('../dist/includes/dbcon.php');

 if (isset($_POST['update']))
 { 
	 $id = $_POST['id'];
	 $id1 = $_POST['id1'];
	 $last = $_POST['last'];
	 $first = $_POST['first'];
	 $pass = $_POST['pass'];
	 $salut = $_POST['salut'];
	 $image = $_FILES["image"]["name"];
		 if ($image=="")
		 {
			$name=$_POST['image1']; 
		 }
		else
		{
			$name = $_FILES["image"]["name"];
			$type = $_FILES["image"]["type"];
			$size = $_FILES["image"]["size"];
			$temp = $_FILES["image"]["tmp_name"];
			$error = $_FILES["image"]["error"];
			
				if ($error > 0){
					die("Error uploading file! Code $error.");
					}
				else{
					if($size > 100000000000) //conditions for the file
					{
					die("Format is not allowed or file size is too big!");
					}
				else
					  {
					move_uploaded_file($temp, "../dist/img/".$name);
					  }
					}
		}
	 mysqli_query($con,"UPDATE teacher SET t_id='$id',t_last='$last',t_first='$first',password='$pass',t_salut='$salut',t_pic='$name' where t_id='$id1'")
	 or die(mysqli_error()); 

		echo "<script type='text/javascript'>alert('Successfully updated teacher details!');</script>";
		echo "<script>document.location='teacher.php'</script>";
	
} 

