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
    <title>SICCMS | Class</title>
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
     <script type="text/css">
      a:hover{
	  background-color:#ffbb22;
      
    }
    </script>
    <script>
    function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                
            }
        }
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
		<?php include('../dist/includes/header.php');?>
		<?php include('../dist/includes/aside.php');?>
      <!-- Left side column. contains the logo and sidebar -->
      
		<div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-header">
            <h1>Processing...</h1>
        </div>
        <div class="modal-body">
            <div class="progress progress-striped active">
                <div class="bar" style="width: 100%;"></div>
            </div>
        </div>
    </div>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php
		include('../dist/includes/dbcon.php');
		$id=$_REQUEST['cid'];
		$_SESSION['cid']=$id;
		$cid=$_SESSION['cid'];
		$query=mysqli_query($con,"select * from class where class_id='$cid'")or die(mysqli_error());
		$row=mysqli_fetch_array($query);
		echo $row['class_name']." Members";
		  
?>		
            
			
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="class.php">Class</a></li>
            <li class="active"><?php echo $row['class_name'];?></li>
          </ol>
		  
        </section>
	
        <!-- Main content -->
        <section class="content" >
	
	<div class="row">
            <div class="col-md-8">

              <div class="box box-primary">
                
                <div class="box-body">
<?php
include('../dist/includes/dbcon.php');

		$query=mysqli_query($con,"select * from enrol natural join student where class_id='$cid' order by stud_last")or die(mysqli_error());
		$count=mysqli_num_rows($query);
		if ($count==0) echo "<div class='callout callout-danger'>
                    <h4>No Record!</h4>
                  </div>";
		else{
		  echo "
		    <table id='example1' class='table table-bordered table-striped'>
			<thead>
			  <tr>
			    <th>Picture</th>
			    <th>Name</th>
			    <th>Action</th>
			  </tr>
			</thead>
			<tbody>";
?>                    
<?php
		while ($row=mysqli_fetch_array($query)){
		$id=$row['stud_id'];
		$last=$row['stud_last'];
		$first=$row['stud_first'];
		$pic=$row['stud_pic'];
		$enrolid=$row['enrol_id'];
		
?>

<div id="update<?php echo $id;?>" class="modal modal-primary fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
		  <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Remove Student</h4>
                      </div>
                      <div class="modal-body">
			  <form class="form-horizontal" method="post" action="unenrol.php">
			     
                             <!-- Title -->
                             <div class="form-group"><input type="hidden" name="id" value="<?php echo $enrolid;?>">
				  <p>Are you sure you want to remove <b><?php echo $first." ".$last;?></b>?</p>
                             </div> <br>
                             
                         </div>
                             
                      <!--end of modal body-->
                      <div class="modal-footer">
			<button type="submit" name="update" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">No</button>
                      </div>
               </div>
               
               <!--end of modal content-->
                </form>
           </div>
 </div>
 </div>
               <!--end of modal-->
                      <tr>
                        <td><img src="../dist/img/<?php echo $pic;?>" alt="Product Image" style="height:50px;width:40px;"></td>
                        <td><?php echo $first." ".$last;?></td>
                        
                        <td><input type="submit" class="btn btn-danger" data-target="#update<?php echo $id;?>" data-toggle="modal" value="Remove">
						</td>
                      </tr>
                      
<?php }?>                     
                    </tbody>
<?php
	    echo "
                    <tfoot>
                      <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>";}
?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              

            </div><!-- /.col (left) -->
            
            <?php
            
            $query=mysqli_query($con,"select * from class where class_id='$cid'")or die(mysqli_error());
		$row=mysqli_fetch_array($query);
	      ?>
            <div class="col-md-4">
	      <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"> Add Student</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post">
                  <div class="form-group">
                    <label>Student Name</label>
		    <input type="text" name="txtsearch" class="form-control" id="txtsearch" placeholder="Type First Name, Last Name here..." 
		    onkeyup="showHint(this.value)" autocomplete="off" required>&nbsp;					
			<div class=" suggestions" id="txtHint" >

			</div>
		 </form>	    
                  </div><!-- /.form group -->      
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <div class="box box-primary">
                <div class="box-header">
                  <a href="" data-target="#set<?php echo $cid;?>" data-toggle="modal" ><h3 class="box-title"><i class="glyphicon glyphicon-wrench"></i> Set Evaluation Criteria</h3></a>
                </div>
              
              </div><!-- /.box -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Update Class
		   
                  </h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="class_update.php">
                  <div class="form-group">
                    <label>Class Name</label>
                    <div class="input-group col-md-12"><input type="hidden" name="id" value="<?php echo $row['class_id'];?>">
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['class_name'];?>">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
			<label>Subject</label>
			<select class="form-control col-md-12" data-placeholder="Select Subject" name="subject" required>
			  <option><?php echo $row['subject_code'];?></option>
			  <?php
				$query2=mysqli_query($con,"select * from subject")or die(mysqli_error());
				  while($row2=mysqli_fetch_array($query2)){		
			  ?>
				<option><?php echo $row2['subject_code'];?></option>
			<?php }?>
						</select>
							
						
					  </div><!-- /.form-group -->
                  <div class="col-md-6 col-xs-6">
		    <div class="form-group">
		      <label>Class Code</label>
		      <div class="input-group col-md-12">                     
			<span class="badge bg-green">  <?php echo $row['class_code'];?></span>
		      </div><!-- /.input group -->
		    </div><!-- /.form group -->
		  </div>
		  <div class="col-md-6 col-xs-6">
		    <!-- Date and time range -->
		    <div class="form-group">
		      <label>Choose Color</label>
		      <div class="input-group">
			<input type="color" class="form-control pull-right" id="color" name="color" value="<?php echo $row['class_color'];?>">
		      </div><!-- /.input group -->
		    </div><!-- /.form group -->
                  </div>
                  <div class="col-md-6 col-xs-6">
		  <div class="form-group">
                    <label>Status</label>
                    <div class="input-group">
                      <select class="form-control" id="status" name="status">
			  <option><?php echo $row['class_stat'];?></option>
			  <option>Active</option>
			  <option>Archive</option>
                      </select>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  </div>
                  <!-- Date and time range -->
                  <div class="col-md-6 col-xs-6">
                  <div class="form-group">
		    <label></label>
                    <div class="input-group">
                      <button class="btn btn-primary pull-right" id="update" name="update" type="submit">
                        Save
                      </button>
                    </div>
                  </div><!-- /.form group -->
		</div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
	    </form>
              <!-- iCheck -->
            
            </div><!-- /.col (right) -->
          </div>
         
<?php
            
            $criteria=mysqli_query($con,"select * from criteria where class_id='$cid'")or die(mysqli_error());
		$row2=mysqli_fetch_array($criteria);
		$count=mysqli_num_rows($criteria);
		if($count<1)$stat="save";else $stat="update";
	      ?>
<div id="set<?php echo $cid;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
		  <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Set Evaluation Criteria</h4>
                      </div>
                      <div class="modal-body">
			  <form class="form-horizontal" method="post" action="criteria_save.php">
			     
                             <!-- Title -->
                             <div class="form-group">
			    <label class="control-label col-lg-4" for="at">Attendance</label>
			    <div class="col-lg-8"> <input type="hidden" class="form-control" name="cid" value="<?php echo $cid;?>">  
                                <input type="number" class="form-control" id="at" name="at" value="<?php echo $row2['attendance']*100;?>">  
			    </div>
                          </div>  
                          <div class="form-group">
			    <label class="control-label col-lg-4" for="assign">Assignment</label>
			    <div class="col-lg-8">
                                <input type="number" class="form-control" id="assign" name="assign" value="<?php echo $row2['assign']*100;?>">  
			    </div>
                          </div>  
                          <div class="form-group">
			    <label class="control-label col-lg-4" for="quiz">Quiz</label>
			    <div class="col-lg-8">
                                <input type="number" class="form-control" id="quiz" name="quiz" value="<?php echo $row2['quiz']*100;?>">  
			    </div>
                          </div>  
                          <div class="form-group">
			    <label class="control-label col-lg-4" for="exam">Exam</label>
			    <div class="col-lg-8">
                                <input type="number" class="form-control" id="exam" name="exam" value="<?php echo $row2['exam']*100;?>">  
			    </div>
                          </div>  
                          <div class="form-group">
			    <label class="control-label col-lg-4" for="proj">Project</label>
			    <div class="col-lg-8">
                                <input type="number" class="form-control" id="proj" name="project" value="<?php echo $row2['project']*100;?>">  
			    </div>
                          </div>  
                      </div>
                             
                      <!--end of modal body-->
                      <div class="modal-footer">
			<button type="submit" name="<?php echo $stat;?>" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
                      </div>
               </div>
               
               <!--end of modal content-->
                </form>
           </div>
 </div>
 </div>
               <!--end of modal-->		  
		  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php include('../dist/includes/footer.php');?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

   
    
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
