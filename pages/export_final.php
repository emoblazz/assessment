<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SICCMS | Grade</title>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
		  
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
		      
                        <?php 
                        include('../dist/includes/dbcon.php');
                        $cid=$_REQUEST['cid'];
                      
                        ?>
			
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <?php 
                        
                        $cid=$_REQUEST['cid'];
                        $term="Prelim";
                        $term2="Midterm";
                        $term3="Endterm";
                        
                        $criteria=mysqli_query($con,"select * from criteria where class_id='$cid'")or die(mysqli_error());
			    $rowc=mysqli_fetch_array($criteria);
                        ?>
			<th>Prelim</th>
			<th>Midterm</th>
			<th>Endterm</th>
			<th>Final</th>
			<th>Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
		      
		      $cid=$_REQUEST['cid'];
		      $stud=mysqli_query($con,"select * from enrol natural join student where class_id='$cid'")or die(mysqli_error());
		      $i=0;
		      while($rowstud=mysqli_fetch_array($stud)){
		      $sid=$rowstud['stud_id'];
		     
		      $i++;
		    ?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $rowstud['stud_first']." ".$rowstud['stud_last'];?></td>
                        <?php 
			    
			    $at=mysqli_query($con,"select * from grade where class_id='$cid' and stud_id='$sid' and term='$term' and type='Attendance'")or die(mysqli_error());
			    $rowat=mysqli_fetch_array($at);
			    //display attendance
			    $at_ave=number_format($rowat['grade']*$rowc['attendance'],2);    
                       
			    //display assignment
			    $query1=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term' and class_id='$cid' and type='Assignment'")or die(mysqli_error());
			      $i1=0;
			      $assign=0;
			      while($row=mysqli_fetch_array($query1)){
				$assign=$assign+$row['grade'];
				$i1++;
			  }
				$ave=($assign/$i1)*$rowc['assign'];
				$assign_ave=number_format($ave,2);     
			    //display quiz	
			    $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term' and class_id='$cid' and type='Quiz'")or die(mysqli_error());
			      $iq=0;
			      $quiz=0;
			      while($rowq=mysqli_fetch_array($queryq)){
				$iq++;
				$quiz=$quiz+$rowq['grade'];
				}
				$q_ave=number_format($quiz/$iq*$rowc['quiz'],2);
			    //display exam
			    $querye=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term' and class_id='$cid' and type='Exam'")or die(mysqli_error($con));
			      $ie=0;
			      $exam=0;
			      while($rowexam=mysqli_fetch_array($querye)){
				$ie++;
				$exam=$exam+$rowexam['grade'];
			      }
			      $e_ave=$exam/$ie;
			      $exam_ave=number_format($e_ave*$rowc['exam'],2);
			      //display project
			      $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term' and class_id='$cid' and type='Project'")or die(mysqli_error());
				$rowq=mysqli_fetch_array($queryq);
				$proj_ave=number_format($rowq['grade']*$rowc['project'],2);
			  
			 //display prelim
			  $total=number_format($at_ave+$assign_ave+$q_ave+$exam_ave+$proj_ave,2);
			  echo "<th>$total</th>";	  

			  //midterm
			    
			    $at=mysqli_query($con,"select * from grade where class_id='$cid' and stud_id='$sid' and term='$term2' and type='Attendance'")or die(mysqli_error());
			    $rowat=mysqli_fetch_array($at);
			    //display attendance
			    $at_ave=number_format($rowat['grade']*$rowc['attendance'],2);    
                       
			    //display assignment
			    $query1=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term2' and class_id='$cid' and type='Assignment'")or die(mysqli_error());
			      $i1=0;
			      $assign=0;
			      while($row=mysqli_fetch_array($query1)){
				$assign=$assign+$row['grade'];
				$i1++;
			  }
				$ave=($assign/$i1)*$rowc['assign'];
				$assign_ave=number_format($ave,2);     
			    //display quiz	
			    $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term2' and class_id='$cid' and type='Quiz'")or die(mysqli_error());
			      $iq=0;
			      $quiz=0;
			      while($rowq=mysqli_fetch_array($queryq)){
				$iq++;
				$quiz=$quiz+$rowq['grade'];
				}
				$q_ave=number_format($quiz/$iq*$rowc['quiz'],2);
			    //display exam
			    $querye=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term2' and class_id='$cid' and type='Exam'")or die(mysqli_error($con));
			      $ie=0;
			      $exam=0;
			      while($rowexam=mysqli_fetch_array($querye)){
				$ie++;
				$exam=$exam+$rowexam['grade'];
			      }
			      $e_ave=$exam/$ie;
			      $exam_ave=number_format($e_ave*$rowc['exam'],2);
			      //display project
			      $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term2' and class_id='$cid' and type='Project'")or die(mysqli_error());
				$rowq=mysqli_fetch_array($queryq);
				$proj_ave=number_format($rowq['grade']*$rowc['project'],2);
			  
			 //display midterm
			  $total2=number_format($at_ave+$assign_ave+$q_ave+$exam_ave+$proj_ave,2);
			  echo "<th>$total2</th>";
			 
			 //display endterm
			 
			    $at=mysqli_query($con,"select * from grade where class_id='$cid' and stud_id='$sid' and term='$term3' and type='Attendance'")or die(mysqli_error());
			    $rowat=mysqli_fetch_array($at);
			    //display attendance
			    $at_ave=number_format($rowat['grade']*$rowc['attendance'],2);    
                       
			    //display assignment
			    $query1=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term3' and class_id='$cid' and type='Assignment'")or die(mysqli_error());
			      $i1=0;
			      $assign=0;
			      while($row=mysqli_fetch_array($query1)){
				$assign=$assign+$row['grade'];
				$i1++;
			  }
				$ave=($assign/$i1)*$rowc['assign'];
				$assign_ave=number_format($ave,2);     
			    //display quiz	
			    $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term3' and class_id='$cid' and type='Quiz'")or die(mysqli_error());
			      $iq=0;
			      $quiz=0;
			      while($rowq=mysqli_fetch_array($queryq)){
				$iq++;
				$quiz=$quiz+$rowq['grade'];
				}
				$q_ave=number_format($quiz/$iq*$rowc['quiz'],2);
			    //display exam
			    $querye=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term3' and class_id='$cid' and type='Exam'")or die(mysqli_error($con));
			      $ie=0;
			      $exam=0;
			      while($rowexam=mysqli_fetch_array($querye)){
				$ie++;
				$exam=$exam+$rowexam['grade'];
			      }
			      $e_ave=$exam/$ie;
			      $exam_ave=number_format($e_ave*$rowc['exam'],2);
			      //display project
			      $queryq=mysqli_query($con,"select * from grade where stud_id='$sid' and term='$term3' and class_id='$cid' and type='Project'")or die(mysqli_error());
				$rowq=mysqli_fetch_array($queryq);
				$proj_ave=number_format($rowq['grade']*$rowc['project'],2);
			  
			 //display prelim
			  $total3=number_format($at_ave+$assign_ave+$q_ave+$exam_ave+$proj_ave,2);
			  echo "<th>$total3</th>";
			  $final=number_format(($total*.3)+($total2*.3)+($total3*.4),2);
			  echo "<th>$final</th>";
			  if ($final>=75)
			  echo "<th>Passed</th>";
			  else
			  echo "<th>Failed</th>";
			?>
                      </tr>
                    <?php
                   }
                     ?>  
                     
                    </tbody>
                   
                  </table>

  </body>
</html>
