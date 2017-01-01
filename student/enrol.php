<?php session_start();
if(empty($_SESSION['sid'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SICCMS | Class</title>
	<link rel="icon" href="psits.png" type="image/x-icon"/>
	<link rel="shortcut icon" href="psits.png" type="image/x-icon"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->

    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
   
  <body>
  <div class="row" style="margin-top:200px;text-align:center">
    <div class="col-md-5">
    </div>
    <div class="col-md-2">
	<form method="post" action="">
	  <input type="hidden" name="cid" value="<?php echo $_REQUEST['cid'];?>">
		      <!-- Date and time range -->
		      <div class="form-group">
			<h3> Enter Class Code </h3>
			<div class="input-group">
			  <input type="text" class="form-control" name="code"><br><br>
			  <input class="btn btn-primary" type="submit" name="join" value="Join">
			  <a href="home.php" class="btn btn-default">Back</a>
			</div>
		      </div><!-- /.form group -->
	</form>
    </div>
    <div class="col-md-5">
    </div>
  </div>
  </body>
</html>
<?php
include('../dist/includes/dbcon.php');

if (isset($_POST['join']))
{
    $id=$_SESSION['sid'];
    $cid=$_POST['cid'];
    $code=$_POST['code'];
    date_default_timezone_set("Asia/Manila"); 
    $date=date("Y-m-d");
    
    $check=mysqli_query($con,"select class_code,class_id from class where class_id='$cid' and class_code='$code'")or die(mysqli_error());
      $row1=mysqli_fetch_array($check);
	$match=mysqli_num_rows($check);
	if ($match==0){
	    echo "<script type='text/javascript'>alert('Class Code Mismatch!');</script>";
	    echo "<script>document.location='home.php'</script>";
	  }
	else {
      
	  $set=mysqli_query($con,"select COUNT(*) as count from enrol where stud_id='$id' and class_id='$cid'")or die(mysqli_error());
	    $row=mysqli_fetch_array($set);
	      $count=$row['count'];
		  if ($count==0)
		  {
		      mysqli_query($con,"INSERT INTO enrol(stud_id,class_id) VALUES('$id','$cid')")or die(mysqli_error());  
		      mysqli_query($con,"INSERT INTO stud_log(stud_id,activity_type,activity,log_date,class_id) VALUES('$id','enrol','joined the group','$date','$cid')")or die(mysqli_error());  
		      
		      echo "<script type='text/javascript'>alert('Successfully added to the group!');</script>";
		      echo "<script>document.location='home.php'</script>";
		  }
		  else
		  {
		      echo "<script type='text/javascript'>alert('Already added to the group!');</script>";
		      echo "<script>document.location='home.php'</script>";
					  
		  }
	}
}
?>		

