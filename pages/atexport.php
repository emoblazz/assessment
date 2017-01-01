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
    <title>SICCMS | Export Grade</title>
	<link rel="icon" href="psits.png" type="image/x-icon"/>
	<link rel="shortcut icon" href="psits.png" type="image/x-icon"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->

    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">


  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    
           <div class="row">
            <div class="col-md-12">
		 <div class="box">
                <div class="box-header">
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Assignment</th>
                        <th>Quiz</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
		      include('../dist/includes/dbcon.php');
		      $cid=$_REQUEST['cid'];
		      $query=mysqli_query($con,"select * from enrol natural join student where class_id='$cid'")or die(mysqli_error());
		      $i=0;
		      while($row=mysqli_fetch_array($query)){
		      $id=$row['stud_id'];
		      $i++;
		    ?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['stud_first']." ".$row['stud_last'];?></td>
                        <?php $query1=mysqli_query($con,"select * from assign natural join stud_assign where stud_id='$id'")or die(mysqli_error());
			      while($row=mysqli_fetch_array($query1)){
				
			      ?>
                        <td>
			  <?php echo $row['grade']/$row['assign_pts']*100;?>
			</td>
			<?php }?>  
                        <?php $query1=mysqli_query($con,"select * from quiz_result where stud_id='$id'")or die(mysqli_error());
			      while($row=mysqli_fetch_array($query1)){
				
			      ?>
                        <td>
			  <?php echo $row['score']/$row['total']*100;?>
			</td>
			<?php }?>    
                      </tr>
                    <?php }?>  
                     
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Assignment</th>
                        <th>Quiz</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            
            </div><!-- /.col (right) -->
<!--           </div> -->
  </body>
</html>
