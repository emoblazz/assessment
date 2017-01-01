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


  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
		<?php include('../dist/includes/header.php');?>
		<?php include('../dist/includes/aside.php');?>
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Assessment
            
			
          </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Assessment</li>
          </ol>
		  
        </section>
	
        <!-- Main content -->
        <section class="content" >
	
	<div class="row">
            <div class="col-md-8">
		<div class="nav-tabs-custom">
		  <ul class="nav nav-tabs">
		    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Active</a></li>
		    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Deactivated</a></li>
		    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Unassigned</a></li>
		    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
		  </ul>
		  <div class="tab-content">
		    <div class="tab-pane active" id="tab_1">
			    <?php 
				include('../dist/includes/dbcon.php');
				$id=$_SESSION['id'];
				$query=mysqli_query($con,"select * from quiz natural join class_quiz natural join class where quiz.t_id='$id' and class_stat='Active' and class_quiz_stat='Activated' order by quiz_id desc")or die(mysqli_error());
				$quizcount=mysqli_num_rows($query);
				if ($quizcount<1){echo "<h3 class='text-red'>No Available Assessment!</h3>";}
				else {
				  echo "
				    <table id='example1' class='table table-bordered table-striped'>
				      <thead>
					<tr>
					  <th>Title</th>
					  <th>Class</th>
					  <th>Duration</th>
					  <th>Date Created</th>
					  <th>Term</th>
					  <th>Action</th>
					</tr>
				      </thead>
				      <tbody>";
			      ?>
			      <?php
				while ($row=mysqli_fetch_array($query)){
				$quiz_id=$row['quiz_id'];
			      ?>

    <div id="updatequiz<?php echo $quiz_id;?>" class="modal fade in col-md-12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
      <div class="modal-dialog">
	<div class="modal-content" style="height:450px;">
	    <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		  <h4 class="modal-title">Update Class Quiz</h4>
	    </div>
	    <div class="modal-body">
		<form class="form-horizontal" method="post" action="class_quiz_update.php">
		    <!-- Title -->
		    <div class="form-group">
		      <label class="control-label col-lg-3" for="title">Quiz Title</label>
		      <div class="col-lg-7"><input type="hidden" class="form-control" name="qid" value="<?php echo $quiz_id;?>">  
		      <input type="hidden" class="form-control" name="cid" value="<?php echo $row['class_id'];?>">  
		      <input type="hidden" class="form-control" name="cqid" value="<?php echo $row['class_quiz_id'];?>">  
			  <input type="text" class="form-control" id="title" name="title" placeholder="Title of the Quiz" value="<?php echo $row['quiz_title'];?>">  
		      </div>
		    </div> 
		    <div class="form-group">
		      <label class="control-label col-lg-3" for="type">Type</label>
		      <div class="col-lg-7">
			  <select class="form-control" id="type" name="type">
			      <option><?php echo $row['quiz_type'];?></option>
			      <option>Quiz</option>
			      <option>Exam</option>
			  </select>
		      </div>
		    </div> 
		    <div class="form-group">
		      <label class="control-label col-lg-3" for="duration">Duration</label>
		      <div class="col-lg-7">
			  <input type="text" class="form-control" id="duration" name="duration" value="<?php echo $row['quiz_duration'];?>">  
		      </div>
		    </div> 
		     <div class="form-group">
		      
			<label class="control-label col-lg-3" for="term">Term</label>
			<div class="col-lg-7">
				    <select class="form-control" id="term" name="term" required>
				      <option><?php echo $row['quiz_term'];?></option> 
				      <option>Prelim</option>
				      <option>Midterm</option>
				      <option>Endterm</option>
				    </select>
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="col-lg-3" for="status">Assessment Status</label>
		     <div class="col-lg-7">
			    <select class="form-control" id="status" name="status">
			      <option><?php echo $row['class_quiz_stat'];?></option> 
			      <option value="Activated">Activate</option>
			      <option value="Deactivated">Deactivate</option> 
			    </select>
		    </div>
		    </div>
		    <div class="form-group">
			<label class="col-lg-12" for="class">Assign to Class</label>
				  <?php
					$id=$_SESSION['id'];
					$assignquiz=mysqli_query($con,"select * from class where t_id='$id' and class_id<>$row[class_id] and class_stat='Active'")or die(mysqli_error());
					  while ($rowassign=mysqli_fetch_array($assignquiz)){
				  echo "
					<div class='col-md-6'>		
					    <div class='checkbox'>
						<label>
						  <input type='checkbox' name='class[]' value='$rowassign[class_id]' id='class'>
						  $rowassign[class_name]
						</label>
					    </div>
					</div>";
				  }?>
		    </div>
	    </div> <!--end of modal body-->
	    <div class="modal-footer col-md-10">
		<button type="submit" name="update" class="btn btn-primary">Save</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
	    </div></form>
	</div><!--end of modal content-->
		
      </div><!--end of modal dialog-->
    </div><!--end of modal-->	
    
    <div id="removequiz<?php echo $row['class_quiz_id'];?>" class="modal fade in col-md-12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
	<div class="modal-content" style="height:200px;">
	    <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		  <h4 class="modal-title">Remove Class Quiz</h4>
	    </div>
	    <div class="modal-body">
		<form class="form-horizontal" method="post" action="class_quiz_update.php">
		    <!-- Title -->
		    <p>Are you sure you want to remove <?php echo $row['quiz_title'];?> for <?php echo $row['class_name'];?>?</p>
		    <input type="hidden" class="form-control" name="cqid" value="<?php echo $row['class_quiz_id'];?>">  
		    
	    </div> <!--end of modal body-->
	    <div class="modal-footer col-md-10">
		<button type="submit" name="remove" class="btn btn-danger">Yes</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">No</button>
	    </div></form>
	</div><!--end of modal content-->
		
      </div><!--end of modal dialog-->
    </div><!--end of modal-->
				<tr>
				    <td><?php echo $row['quiz_title'];?></td>
				    <td><?php echo $row['class_name'];?></td>	
				    <td><?php echo $row['quiz_duration'];?> mins</td>
				    <td><?php echo $row['quiz_date'];?></td>
				    <td><?php echo $row['quiz_term'];?></td>
				    <td>
				      <a class="btn btn-block btn-warning" data-target="#updatequiz<?php echo $quiz_id;?>" data-toggle="modal" data-original-title="Update Quiz"><i class="glyphicon glyphicon-edit"> </i></a>
				      <a class="btn btn-block btn-success" data-toggle="tooltip" href="create_quiz.php?qid=<?php echo $quiz_id;?>" data-original-title="View Questions"><i class="glyphicon glyphicon-eye-open"> </i></a>
				    <a class="btn btn-block btn-danger" data-target="#removequiz<?php echo $row['class_quiz_id'];?>" data-toggle="modal" data-original-title="Remove Quiz"><i class="glyphicon glyphicon-remove"></i></a>
				      <a class="btn btn-block btn-primary" data-toggle="tooltip" href="create_quiz.php?qid=<?php echo $quiz_id;?>" data-original-title="View Results"><i class="glyphicon glyphicon-flash"> </i></a>
				    </td>
				</tr>
			
				<?php }?>                     
			      </tbody>
			      <?php
				echo "
				<tfoot>
				    <tr>
					<th>Title</th>
					<th>Class</th>
					<th>Duration</th>
					<th>Date Created</th>
					<th>Term</th>
					<th>Action</th>
				    </tr>
				</tfoot>
			    </table>";}
			  ?>
		    </div><!-- /.tab-pane -->
		    <div class="tab-pane" id="tab_2">
			      <?php 
			    include('../dist/includes/dbcon.php');
			    $id=$_SESSION['id'];
			    $query=mysqli_query($con,"select * from quiz natural join class_quiz natural join class where quiz.t_id='$id' and class_stat='Active' and class_quiz_stat='Deactivated'")or die(mysqli_error());
			    $quizcount=mysqli_num_rows($query);
			    if ($quizcount<1){echo "<h3 class='text-red'>No Available Assessment!</h3>";}
			    else {
			      echo "
				<table id='example1' class='table table-bordered table-striped'>
				  <thead>
				    <tr>
				      <th>Title</th>
				      <th>Class</th>
				      <th>Duration</th>
				      <th>Date Created</th>
				      <th>Term</th>
				      <th>Action</th>
				    </tr>
				  </thead>
				  <tbody>";
			  ?>
			  <?php
			    while ($row=mysqli_fetch_array($query)){
			    $quiz_id=$row['quiz_id'];
			  ?>

<div id="updatequiz<?php echo $quiz_id;?>" class="modal fade in col-md-12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:300px;">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Update Class Quiz</h4>
         </div>
	 <div class="modal-body">
	    <form class="form-horizontal" method="post" action="class_quiz_update.php">
		<!-- Title -->
                <div class="form-group">
		  <label class="control-label col-lg-3" for="title">Quiz Title</label>
		  <div class="col-lg-7"><input type="hidden" class="form-control" name="qid" value="<?php echo $quiz_id;?>">  
		  <input type="hidden" class="form-control" name="cid" value="<?php echo $row['class_id'];?>">  
		  <input type="hidden" class="form-control" name="cqid" value="<?php echo $row['class_quiz_id'];?>">  
		      <input type="text" class="form-control" id="title" name="title" placeholder="Title of the Quiz" value="<?php echo $row['quiz_title'];?>">  
		  </div>
		</div> 
		<div class="form-group">
		  <label class="control-label col-lg-3" for="type">Type</label>
		  <div class="col-lg-7">
                       <select class="form-control" id="type" name="type">
			  <option><?php echo $row['quiz_type'];?></option>
			  <option>Quiz</option>
			  <option>Exam</option>
                       </select>
		  </div>
                </div> 
                <div class="form-group">
		  <label class="control-label col-lg-3" for="duration">Duration</label>
		  <div class="col-lg-7">
                       <input type="text" class="form-control" id="duration" name="duration" value="<?php echo $row['quiz_duration'];?>">  
		  </div>
                </div> 
                
                <div class="form-group">
		  <label class="control-label col-lg-3" for="status">Assessment Status</label>
		  <div class="col-lg-7">
                        <select class="form-control" id="status" name="status">
			  <option><?php echo $row['class_quiz_stat'];?></option> 
			  <option value="Activated">Activate</option>
			  <option value="Deactivated">Deactivate</option> 
                        </select>
		  </div>
                </div>
	</div> <!--end of modal body-->
        <div class="modal-footer col-md-10">
	    <button type="submit" name="update" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
        </div></form>
    </div><!--end of modal content-->
            
  </div><!--end of modal dialog-->
 </div><!--end of modal-->	
 
 <div id="removequiz<?php echo $row['class_quiz_id'];?>" class="modal fade in col-md-12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:200px;">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Remove Class Quiz</h4>
         </div>
	 <div class="modal-body">
	    <form class="form-horizontal" method="post" action="class_quiz_update.php">
		<!-- Title -->
		<p>Are you sure you want to remove <?php echo $row['quiz_title'];?> for <?php echo $row['class_name'];?>?</p>
		<input type="hidden" class="form-control" name="cqid" value="<?php echo $row['class_quiz_id'];?>">  
                
	</div> <!--end of modal body-->
        <div class="modal-footer col-md-10">
	    <button type="submit" name="remove" class="btn btn-danger">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">No</button>
        </div></form>
    </div><!--end of modal content-->
            
  </div><!--end of modal dialog-->
 </div><!--end of modal-->
			    <tr>
				<td><?php echo $row['quiz_title'];?></td>
				<td><?php echo $row['class_name'];?></td>	
				<td><?php echo $row['quiz_duration'];?> mins</td>
				<td><?php echo $row['quiz_date'];?></td>
				<td><?php echo $row['quiz_term'];?></td>
				<td>
				  <a class="btn btn-block btn-success" data-toggle="tooltip" href="create_quiz.php?qid=<?php echo $quiz_id;?>" data-original-title="View Questions"><i class="glyphicon glyphicon-eye-open"> </i></a>
				 
				  <a class="btn btn-block btn-primary" data-toggle="tooltip" href="create_quiz.php?qid=<?php echo $quiz_id;?>" data-original-title="View Results"><i class="glyphicon glyphicon-flash"> </i></a>
				</td>
			    </tr>
		    
			    <?php }?>                     
			  </tbody>
			  <?php
			    echo "
			    <tfoot>
				<tr>
				    <th>Title</th>
				    <th>Class</th>
				    <th>Duration</th>
				    <th>Date Created</th>
				    <th>Term</th>
				    <th>Action</th>
				</tr>
			    </tfoot>
			</table>";}
		      ?>
		    </div><!-- /.tab-pane -->
		    <div class="tab-pane" id="tab_3">
			    <?php 
			    include('../dist/includes/dbcon.php');
			    $id=$_SESSION['id'];
			    $query=mysqli_query($con,"select * from quiz natural join class_quiz natural join class where quiz.t_id='$id' and class_stat='Active' and class_quiz_stat=''")or die(mysqli_error());
			    $quizcount=mysqli_num_rows($query);
			    if ($quizcount<1){echo "<h3 class='text-red'>No Available Assessment!</h3>";}
			    else {
			      echo "
				<table id='example1' class='table table-bordered table-striped'>
				  <thead>
				    <tr>
				      <th>Title</th>
				      <th>Class</th>
				      <th>Duration</th>
				      <th>Date Created</th>
				      <th>Term</th>
				      <th>Action</th>
				    </tr>
				  </thead>
				  <tbody>";
			  ?>
			  <?php
			    while ($row=mysqli_fetch_array($query)){
			    $quiz_id=$row['quiz_id'];
			  ?>

<div id="updatequizstat<?php echo $quiz_id;?>" class="modal fade in col-md-12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:300px;">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Update Class Quiz</h4>
         </div>
	 <div class="modal-body">
	    <form class="form-horizontal" method="post" action="class_quiz_update.php">
		<!-- Title -->
                <div class="form-group">
		  <label class="control-label col-lg-3" for="title">Quiz Title</label>
		  <div class="col-lg-7"><input type="hidden" class="form-control" name="qid" value="<?php echo $quiz_id;?>">  
		  <input type="hidden" class="form-control" name="cid" value="<?php echo $row['class_id'];?>">  
		  <input type="hidden" class="form-control" name="cqid" value="<?php echo $row['class_quiz_id'];?>">  
		      <input type="text" class="form-control" id="title" name="title" placeholder="Title of the Quiz" value="<?php echo $row['quiz_title'];?>">  
		  </div>
		</div> 
		<div class="form-group">
		  <label class="control-label col-lg-3" for="type">Type</label>
		  <div class="col-lg-7">
                       <select class="form-control" id="type" name="type">
			  <option><?php echo $row['quiz_type'];?></option>
			  <option>Quiz</option>
			  <option>Exam</option>
                       </select>
		  </div>
                </div> 
                <div class="form-group">
		  <label class="control-label col-lg-3" for="duration">Duration</label>
		  <div class="col-lg-7">
                       <input type="text" class="form-control" id="duration" name="duration" value="<?php echo $row['quiz_duration'];?>">  
		  </div>
                </div> 
                
                <div class="form-group">
		      <label class="control-label col-lg-3" for="status">Status</label>
		      <div class="col-lg-7">
			    <select class="form-control" id="status" name="status">
			      <option><?php echo $row['class_quiz_stat'];?></option> 
			      <option value="Activated">Activate</option>
			      <option value="Deactivated">Deactivate</option> 
			    </select>
		      </div>
		    </div>
		 <div class="form-group">
		      <label class="control-label col-lg-3" for="status">Term</label>
		      <div class="col-lg-7">
			    <select class="form-control" id="status" name="term">
			      <option><?php echo $row['quiz_term'];?></option> 
			      <option>Prelim</option>
			      <option>Midterm</option>
			      <option>Endterm</option>
			    </select>
		      </div>
		    </div>
                
	</div> <!--end of modal body-->
        <div class="modal-footer col-md-10">
	    <button type="submit" name="update" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
        </div></form>
    </div><!--end of modal content-->
            
  </div><!--end of modal dialog-->
 </div><!--end of modal-->	
 
 <div id="removequiz<?php echo $row['class_quiz_id'];?>" class="modal fade in col-md-12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:200px;">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Remove Class Quiz</h4>
         </div>
	 <div class="modal-body">
	    <form class="form-horizontal" method="post" action="class_quiz_update.php">
		<!-- Title -->
		<p>Are you sure you want to remove <?php echo $row['quiz_title'];?> for <?php echo $row['class_name'];?>?</p>
		<input type="hidden" class="form-control" name="cqid" value="<?php echo $row['class_quiz_id'];?>">  
                
	</div> <!--end of modal body-->
        <div class="modal-footer col-md-10">
	    <button type="submit" name="remove" class="btn btn-danger">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">No</button>
        </div></form>
    </div><!--end of modal content-->
            
  </div><!--end of modal dialog-->
 </div><!--end of modal-->
			    <tr>
				<td><?php echo $row['quiz_title'];?></td>
				<td><?php echo $row['class_name'];?></td>	
				<td><?php echo $row['quiz_duration'];?> mins</td>
				<td><?php echo $row['quiz_date'];?></td>
				<td><?php echo $row['quiz_term'];?></td>
				<td>
				  <a class="btn btn-block btn-warning" data-target="#updatequizstat<?php echo $quiz_id;?>" data-toggle="modal" data-original-title="Update Quiz"><i class="glyphicon glyphicon-edit"> </i></a>
				  <a class="btn btn-block btn-success" data-toggle="tooltip" href="create_quiz.php?qid=<?php echo $quiz_id;?>" data-original-title="View Questions"><i class="glyphicon glyphicon-eye-open"> </i></a>
				 <a class="btn btn-block btn-danger" data-target="#removequiz<?php echo $row['class_quiz_id'];?>" data-toggle="modal" data-original-title="Remove Quiz"><i class="glyphicon glyphicon-remove"></i></a>
				
				</td>
			    </tr>
		    
			    <?php }?>                     
			  </tbody>
			  <?php
			    echo "
			    <tfoot>
				<tr>
				    <th>Title</th>
				    <th>Class</th>
				    <th>Duration</th>
				    <th>Date Created</th>
				    <th>Term</th>
				    <th>Action</th>
				</tr>
			    </tfoot>
			</table>";}
		      ?>
		      
		      
		    </div><!-- /.tab-pane -->
		  </div><!-- /.tab-content -->
		</div>

              

            </div><!-- /.col (left) -->
            <div class="col-md-4">
              <div class="box box-primary">
		  <div class="box-header with-border">
		    <h3 class="box-title">Add Assessment</h3>
		  </div>
		  <div class="box-body">
		    <form name="question" method="post" action="quiz_add.php">
		      <div class="control-group">
			
			<div class="controls">			
			  
				<div class="form-group">
				  <label for="title">Title</label>
				  <input type="text" class="form-control" id="title" placeholder="Title of Assessment" name="title" required>
				</div>
				<div class="row">
				  <div class="col-md-6">
				    <label for="type">Type</label>
				    <select class="form-control" id="type" name="type" required>
				      <option>Quiz</option>
				      <option>Exam</option>
				    </select>
				  </div>
				  <div class="col-md-6">
				    <label for="duration">Duration</label>
				    <input type="text" class="form-control" id="duration" name="duration" placeholder="Time in minutes" required>
				  </div>
				</div>
				  <div class="form-group">
				    <label for="term">Term</label>
				    <select class="form-control" id="term" name="term" required>
				      <option>Prelim</option>
				      <option>Midterm</option>
				      <option>Endterm</option>
				    </select>
				  </div>
				
				<div class="form-group">
				  <?php
					
					$id=$_SESSION['id'];
					$query=mysqli_query($con,"select * from class where t_id='$id' and class_stat='Active'")or die(mysqli_error());
					  while ($row=mysqli_fetch_array($query)){
				  ?>
					<div class="col-md-6">		
					    <div class="checkbox">
						<label>
						  <input type="checkbox" name="class[]" value="<?php echo $row['class_id'];?>">
						  <?php echo $row['class_name'];?>
						</label>
					    </div>
					</div>
				  <?php }?>
		  
				 </div><!--form group-->
				 <div class="form-group col-md-12">
				    <label for="exampleInputEmail1">&nbsp;</label>
				    <button type="submit" class="btn btn-primary" name="save">Save</button>
				    <button type="reset" class="btn" id="clear">Clear</button>
				</div>
			  
			</div><!--controls-->		
		      </div><!--control-group-->
		      </form>
		    </div><!--box-body-->
		  </div><!--box-->
		  
            
            </div><!-- /.col (right) -->
          </div>
         
		  
		  
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
  </body>
</html>
