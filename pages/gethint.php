<?php
// Array with names

include('../dist/includes/dbcon.php');
$query=mysqli_query($con,"select stud_first,stud_last,stud_id from student")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
	   

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($row as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
            $id=$row['stud_id'];
		echo "<div style='margin-bottom:5px;' class='searchresult'>";
		$query1=mysqli_query($con,"select stud_pic from student where stud_id='$id'")or die(mysqli_error());
		$row1=mysqli_fetch_array($query1);
		$img=$row1['stud_pic'];
		$img1="<img style='width:70px;height:70px;box-shadow:1px 1px 8px #000;border-radius:8px;margin-right:10px;' src='../dist/img/$img'>";
                $hint ="<a href='enrol.php?id=$id'>".$img1.$row['stud_first']." ".$row['stud_last']."</a>";
                echo "</div>";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint;
}
?>