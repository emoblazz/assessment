<?php
include('../dist/includes/dbcon.php');

  $id = $_POST['id'];
  $grade = $_POST['grade'];
  $cid = $_POST['cid'];
  $term = $_POST['term'];
  
  $i=0;
  foreach($id as $gid)
    {
      mysqli_query($con,"UPDATE grade SET grade='$grade[$i]' where grade_id='$gid'") or die(mysqli_error($con)); 
      $i++;
    }  

	echo "<script type='text/javascript'>alert('Successfully updated grade details!');</script>";
	echo "<script>document.location='grade.php?cid=$cid&term=$term'</script>";


