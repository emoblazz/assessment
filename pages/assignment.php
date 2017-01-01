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
    <title>SICCMS | Assignment</title>
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
    <script type="text/javascript" src="../dist/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript">

	$(document).ready(function()
	{
		$('.btn_delete').click(function()
		{
			
				var id = $(this).parent().parent().attr('id');
				var data = 'id=' + id ;
				var parent = $(this).parent().parent();

				$.ajax(
				{
					   type: "POST",
					   
					   data: data,
					   cache: false,
					
					   success: function()
					   {
							parent.fadeOut('slow', function() {$(this).remove();});
					   }
				 });				
			
		});
		
		// style the table with alternate colors
		// sets specified color for every odd row
		
	});
	
</script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
		<?php include('../dist/includes/header.php');?>
		<?php include('../dist/includes/aside.php');?>
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
	
        <!-- Main content -->
        <section class="content" >
	  <div class="row">
	    <div class="col-md-8">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Posts</a></li>
                  
                  
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
				
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
				  <?php
						include('../dist/includes/dbcon.php');
						$id=$_SESSION['id'];
						$query1=mysqli_query($con,"select *,DATE_FORMAT(assign_time,'%r') from assign natural join teacher where t_id='$id' order by assign_date desc,assign_time desc")or die(mysqli_error());
						 $countassign=mysqli_num_rows($query1);
						  if ($countassign<1) echo "<h4 class='text-red'>You have not created any post yet!</h4>";
							while($row2=mysqli_fetch_array($query1))
							{
							$aid=$row2['assign_id'];	

				?>
<div id="updatequiz<?php echo $aid;?>" class="modal fade in col-md-12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
   <div class="modal-dialog">
		<div class="modal-content" style="height:500px;">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			  <h4 class="modal-title">Update Post</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="post" action="assign_update.php" enctype="multipart/form-data">
					<!-- Title -->
					<div class="form-group">
						  <label class="control-label col-lg-3" for="title">Description/Title</label>
						  <div class="col-lg-7">
							  <input type="hidden" class="form-control" name="aid" value="<?php echo $aid;?>">  
							  <input type="text" class="form-control" id="title" name="title" placeholder="Title/Description" value="<?php echo $row2['assign_desc'];?>">  
						  </div>
					</div> 
					<div class="form-group">
						  <label class="control-label col-lg-3" for="type">Deadline</label>
						  <div class="col-lg-7">
								<input type="date" class="form-control span2" name="due" value="<?php echo $row2['assign_due'];?>" required>
						  </div>
					</div> 
					<div class="form-group">
							<label class="control-label col-lg-3" for="duration">Points</label>
							  <div class="col-lg-7">	
								<input type="text" class="form-control" placeholder="Points" name="pts" value="<?php echo $row2['assign_pts'];?>" required>
							  </div>
					</div> 
					
					<div class="form-group">
						<label class="control-label col-lg-3">Term</label>
						<div class="col-lg-7">	
						<select class="form-control" name="term" required>
						  <option><?php echo $row2['assign_term'];?></option>
						  <option>Prelim</option>
						  <option>Midterm</option>
						  <option>Endterm</option>
						</select>
						</div>
					</div>
					<div class="form-group">
					<label class="control-label col-lg-3" for="class">Upload File/s</label>
						<div class="col-lg-7"> 
							
								<input type="file" class="postbox-file-upload multi" name="files[]" multiple="multiple">
								<i>Upload multiple files by selecting multiple files.</i><br>
								<?php 
								
								$upload=mysqli_query($con,"select * from t_upload where assign_id=$aid")or die(mysqli_error());
											while($rowup=mysqli_fetch_array($upload)){
												$upid=$rowup['t_upload_id'];
								?>
							
								<div>
								<?php echo $rowup['file'];?>
								<span class="action"><a href="#" id="<?php echo $upid;?>" class="btn_delete" title="Delete">X</a></span>
								</div>
							<?php }?>
						</div>
									
					</div>
					<div class="form-group">
					<label class="control-label col-lg-3" for="class">Class</label>
						<div class="col-md-9">		
						<?php
								
								$id=$_SESSION['id'];
								$aid=$row2['assign_id'];	
								$query=mysqli_query($con,"select *,class.class_id as cid from class left join assign_class on class.class_id=assign_class.class_id where t_id='$id' and class_stat='Active' and assign_class.assign_id='$aid'")or die(mysqli_error());
								  while ($row=mysqli_fetch_array($query)){
										if ($row['assign_id']<>0)
										{
											$checked="checked";
										}
										else{
											$checked="";
										}	
								  ?>
									<div class="col-md-5">		
									  <div class="checkbox">
										<label>
										  <input type="checkbox" name="class[]" value="<?php echo $row['cid'];?>" <?php echo $checked;?>>
										  <?php echo $row['class_name'];?>
										</label>
									  </div>
									</div>

									<?php }
									$query5=mysqli_query($con,"select * from class where t_id='$id' and class_stat='Active' and class_id NOT IN (SELECT class_id FROM assign_class WHERE assign_id = '$aid')")or die(mysqli_error());
									while ($row5=mysqli_fetch_array($query5)){
									?>
									<div class="col-md-5">		
									  <div class="checkbox">
										<label>
										  <input type="checkbox" name="class[]" value="<?php echo $row5['class_id'];?>">
										  <?php echo $row5['class_name'];?>
										</label>
									  </div>
									</div>
									<?php }?>
						</div>
					</div><!--end of form group-->
			</div> <!--end of modal body-->
			<div class="modal-footer col-md-10">
				<button type="submit" name="update" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</form>
		</div><!--end of modal content-->
    </div><!--end of modal dialog-->
</div><!--end of modal-->		
	
                    <div class="box box-widget">
						<div class="box-header with-border">
						  <div class="user-block">
							<img class="img-circle" src="../dist/img/<?php echo $row2['t_pic'];?>" alt="user image">
							<span class="username"><a href="#"><?php echo $row2['t_first']." ".$row2['t_last'];?></a>  
								<?php
								$aid=$row2['assign_id'];
								$query3=mysqli_query($con,"select class_name,assign_id,class_id from assign_class natural join class where assign_id='$aid'")or die(mysqli_error());
										while($row1=mysqli_fetch_array($query3)){ 
										$cid=$row1['class_id'];
										echo " >> ";echo "<a href='class_assign.php?cid=$cid&aid=$aid'>".$row1['class_name']."</a>";}?>
										<a data-target="#updatequiz<?php echo $aid;?>" data-toggle="modal" data-original-title="Update Post" class="pull-right"><i class="glyphicon glyphicon-edit"></i></a>
							</span>
							<span class="description"><?php echo date('M d, Y', strtotime($row2['assign_date']))." - ".date('h:i:s A', strtotime($row2['assign_time']));?></span>
						  </div><!-- /.user-block --> 
						</div><!-- /.box-header -->
						<div class="box-body" style="border-bottom:1px solid #fbe553">
						  <!-- post text -->
						  <div class="col-md-6">
						      <h4><b><?php echo $row2['assign_desc'];?></b></h4>
						      <p>Due: <b><?php echo date("M d, Y",strtotime($row2['assign_due']));?></b></p>
						      <p>Points: <b><?php echo $row2['assign_pts'];?></b></p>
						  </div>
								<?php
									$aid=$row2['assign_id'];
									$query2=mysqli_query($con,"select * from t_upload where assign_id='$aid'")or die(mysqli_error());
										while($row1=mysqli_fetch_array($query2)){
											$file="../dist/uploads/$row1[file]";
											$ext = pathinfo($file, PATHINFO_EXTENSION);	
											include("../dist/includes/ext.php");	
								?> 
						<div class="col-md-6">
						    <p>&nbsp;</p>
						    <p>Term: <b><?php echo $row2['assign_term'];?></b></p>
						    
						</div>
							<!-- Attachment -->
							  <div class="attachment-block clearfix col-xs-12">
								<a  data-placement="bottom" title="Download" id="<?php echo $row1['upload_id']; ?>Download" href="../dist/uploads/<?php echo $row1['file']; ?>">
								  <img class="attachment-img" src="../dist/uploads/<?php echo $display; ?>" alt="attachment image">
								<div class="attachment-pushed ">
								  <h4 class="attachment-heading"><?php echo $row1['file'];?></a></h4>
								  <div class="attachment-text">
									<?php 
									
									include("../dist/includes/size.php");	
											
									?>
								  </div><!-- /.attachment-text -->
								</div><!-- /.attachment-pushed -->
							  </div><!-- /.attachment-block -->
							  
						<?php }?>
						<div class="col-md-4 col-xs-12" style="margin-top:10px;">
								  <!-- small box -->
								  <div class="small-box bg-aqua">
									<div class="inner">
									  <h3>Turned in</h3>
									  <p>
									  <?php
									    $query2=mysqli_query($con,"select COUNT(*) as submitted from stud_assign where assign_id='$aid'")or die(mysqli_error());
										$row=mysqli_fetch_array($query2);
										echo "Submissions (<b>".$row['submitted'].")</b>";
									  ?> 
									  </p>
									</div>
									<div class="icon">
									  <i class="glyphicon glyphicon-share"></i>
									</div>
									<div style="margin:auto;width:60px;">
									<a style="color:#fff;" href='class_assign.php?cid=<?php echo $cid;?>&aid=<?php echo $aid;?>'> View <i class="glyphicon glyphicon-share-alt"></i></a>
									</div>
								  </div>
						</div>
						</div><!-- /.box-body -->
						
					
		  </div>
							<?php }?>
                  </div><!-- /.tab-pane -->
                  
                 
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!--end col-->
          <div class="col-md-4"><!--start col right-->    
	      <div class="box box-widget">
                <div class="box-body">
                  <div class="small-box">
					<div class="callout callout-warning">
						<h4>Create Post</h4>
					</div>
				 </div>
				 <form role="form" method="post" action="assign_save.php" enctype="multipart/form-data">
                    <!-- textarea -->
                    <div class="form-group">
					  <label>Title/Description</label> 	
                      <input type="text" class="form-control" placeholder="Title/Description" name="title" id="title" required>
                      <div id="more" style="">
						<label>Deadline</label>
						<input type="date" class="form-control span2" name="due" required>
						<label>Points</label>		
						<input type="text" class="form-control" placeholder="Points" name="pts" required>
						
						<label>Term</label>		
						<select class="form-control" name="term" required>
						  <option>Prelim</option>
						  <option>Midterm</option>
						  <option>Endterm</option>
						</select>
						<label>Upload File/s</label>
						<input type="file" class="postbox-file-upload multi" name="files[]" multiple="multiple" required>
						<i>Upload multiple files by selecting multiple files.</i>
					
						
						<div class="form-group col-md-12">
						
						<?php
						include('../dist/includes/dbcon.php');
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

						  
						</div>
					  </div>	  
					  <div class="form-group">
						<button type="submit" class="btn btn-primary pull-right" name="post">Post Assignment</button>
					  </div>	
                    </div>
				 </form>
				</div> <!-- Box body -->
			</div> <!-- Box box widget -->
        </div> <!-- col -->      
            
	  </div>
		  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php include('../dist/includes/footer.php');?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->
	
</div>
    <script>
    $(function() {
      $(".btn_delete").click(function(){
      var element = $(this);
      var id = element.attr("id");
      var dataString = 'id=' + id;
      if(confirm("Sure you want to delete this comment?"))
      {
	$.ajax({
	type: "GET",
	url: "file_del.php",
	data: dataString,
	success: function(){
		
	      }
	  });
	  
	  $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
	  .animate({ opacity: "hide" }, "slow");
      }
      return false;
      });

      });
    </script>
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../dist/js/jquery.min.js"></script>
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
