<?php session_start();
if(empty($_SESSION['sid'])):
header('Location:../index.php');
endif;
error_reporting(0);
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
    <script type="text/javascript" src="../dist/js/jquery-1.3.2.min.js"></script>
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
		<?php include('../dist/includes/stud_header.php');?>
		<?php include('../dist/includes/stud_aside.php');?>
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          </ol>
		  
        </section>
	
        <!-- Main content -->
        <section class="content" >

	<div class="row">
            <div class="col-md-8">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Assignment</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Submissions</a></li>
                  
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
				
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
			<?php
			  include('../dist/includes/dbcon.php');
				$id=$_SESSION['sid'];
				$query1=mysqli_query($con,"select * from assign natural join assign_class natural join teacher natural join enrol where stud_id='$id' order by assign_date desc,assign_time desc")or die(mysqli_error());
				 $countassign=mysqli_num_rows($query1);
					      if ($countassign<1) echo "<h4 class='text-red'>No posted assignment!</h4>";
					while($row2=mysqli_fetch_array($query1))
					  {
			?>
                    <div class="box box-widget" style="border-bottom:1px solid #fbe553">
			<div class="box-header with-border">
			   
			    <div class="user-block">
				<img class="img-circle" src="../dist/img/<?php echo $row2['t_pic'];?>" alt="user image">
				<span class="username"><a href="#"><?php echo $row2['t_first']." ".$row2['t_last'];?></a>  
				<?php
				    $aid=$row2['assign_id'];
				    $query3=mysqli_query($con,"select class_name,assign_id,class_id from assign_class natural join class natural join enrol where assign_id='$aid' and stud_id='$id'")or die(mysqli_error());
					while($row1=mysqli_fetch_array($query3)){ 
					  $cid=$row1['class_id'];
					  echo " >> ";echo "<a href='class_home.php?cid=$cid'>".$row1['class_name']."</a>";}?>
				</span>
				<span class="description"><?php echo date('M d, Y', strtotime($row2['assign_date']))." - ".date('h:i:s a', strtotime($row2['assign_time']));?></span>
			      </div><!-- /.user-block -->
			</div><!-- /.box-header -->
			<div class="box-body">
			    <!-- post text -->
			    <h4><b><?php echo $row2['assign_desc'];?></b></h4>
			    <p>Due: <b><?php echo date("M d, Y",strtotime($row2['assign_due']));?></b></p>
			    <p>Points: <b><?php echo $row2['assign_pts'];?></b></p>
				<?php
					$aid=$row2['assign_id'];
					$query2=mysqli_query($con,"select * from t_upload where assign_id='$aid'")or die(mysqli_error());
						while($row1=mysqli_fetch_array($query2)){
						  $file="../dist/uploads/$row1[file]";
						  $ext = pathinfo($file, PATHINFO_EXTENSION);	
						   include("../dist/includes/ext.php");	
				?> 
				<!-- Attachment -->
				<div class="attachment-block clearfix col-xs-12">
					 <a  data-placement="bottom" title="Download" id="<?php echo $row1['t_upload_id']; ?>Download" href="../dist/uploads/<?php echo $row1['file']; ?>">
					<img class="attachment-img" src="../dist/uploads/<?php echo $display; ?>" alt="attachment image">
					<div class="attachment-pushed ">
					    <h4 class="attachment-heading"><?php echo $row1['file'];?></a></h4>
					    <div class="attachment-text">
						<?php 
						  include("../dist/includes/size.php");	
						?></a>
					      </div><!-- /.attachment-text -->
					</div><!-- /.attachment-pushed -->
				 </div><!-- /.attachment-block -->
						<?php }?>
				<div class="col-md-4 col-xs-12" style="margin-top:10px;">
				      <!-- small box -->
					  <div class="small-box bg-aqua">
									<div class="inner">
									  <h3><a href="#turnin<?php echo $aid;?>" data-target="#turnin<?php echo $aid;?>" data-toggle="modal" style="color:#fff;">Turn in</h3>
									  <p>
									  <?php
									    $query2=mysqli_query($con,"select COUNT(*) as submitted from stud_assign where assign_id='$aid'")or die(mysqli_error());
										$row=mysqli_fetch_array($query2);
										echo "Submissions (<b>".$row['submitted'].")</b>";
									  ?> 
									  </p></a>
									</div>
									<div class="icon">
									  <i class="glyphicon glyphicon-share"></i>
									</div>
									<a href="#turnin<?php echo $aid;?>" data-target="#turnin<?php echo $aid;?>" data-toggle="modal" style="color:#fff;" class="small-box-footer">Turn in</a>
								  </div>
						</div>
						</div><!-- /.box-body -->
						
					  </div>
					  
					  <!--start modal-->
					  
<div id="turnin<?php echo $aid;?>" class="modal modal-primary fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                       <h4 class="modal-title">Submit Assignment</h4>
                    </div>
                    <div class="modal-body">
			<form class="form-horizontal" method="post" action="turnin.php" enctype='multipart/form-data'>
			  <div class="form-group">
			    <label class="control-label col-lg-2" for="content">Content</label>
			  <div class="col-lg-9"><input type="hidden" class="form-control" id="aid" name="aid" value="<?php echo $aid;?>">  
                            <textarea class="form-control" name="content"></textarea>
			  </div>
                          </div> 
                             
                          <div class="form-group">
			    <label class="control-label col-lg-2" for="file">File</label>
			    <div class="col-lg-9">
                                <input type="file" class="form-control" id="file" name="files[]" multiple="multiple">  
			    </div>
                          </div> 
		    </div><!--end of modal body-->
                    <div class="modal-footer">
			<button type="submit" name="turnin" class="btn btn-primary">Turn In</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                    </div>
            </div><!--end of modal content-->
			</form>
        </div><!--end of modal-dialog-->
 </div>
                <!--end of modal-->
							<?php }?>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
			<?php
							include('../dist/includes/dbcon.php');
							
							$query=mysqli_query($con,"select * from stud_assign natural join student natural join assign where stud_id='$id' order by stud_assign.date_posted desc,stud_assign.time_posted desc")or die(mysqli_error());
							 $count=mysqli_num_rows($query);
							    if ($count<1) echo "<h4 class='text-red'>You have no submission yet!</h4>";
								while($row=mysqli_fetch_array($query)){
									$said=$row['stud_assign_id'];
						?> 	
							<div class="box box-widget" id="record">
							<div class="box-header with-border">
							 <div class="box-tools pull-right">
							 <span class="action"><a href="#" id="<?php echo $said;?>" class="btn_delete" title="Delete"><i class="glyphicon glyphicon-remove text-red"></i></a></span>
							</div>
							  <div class="user-block">
							      <div class="col-md-8">
								<img class="img-circle" src="../dist/img/<?php echo $row['stud_pic'];?>" alt="user image">
								<span class="username"><a href="#"><?php echo $row['stud_first']." ".$row['stud_last'];?></a> >> <?php echo $row['assign_desc'];?></span>
								<span class="description"><?php echo date('M d, Y', strtotime($row['date_posted']))." - ".date('h:i:s a', strtotime($row['time_posted']));?></span>
							      </div>
							      <div class="box-tools col-md-4">
								  <div class="col-md-12">
								      <div class="box box-success box-solid">
									<div class="box-header with-border">
									  <h3 class="box-title">Score: <?php echo $row['grade']." / ".$row['assign_pts'];?></h3>
									  
									</div><!-- /.box-header -->
									
								      </div><!-- /.box -->
								    </div>
							      </div><!-- /.box-tools -->
							
							  </div><!-- /.user-block -->
							  
							</div><!-- /.box-header -->
							<div class="box-body">
							  <!-- post text -->
							  <p><?php echo $row['content'];?></p>
							  <p><span data-toggle="tooltip" title="" class="badge 
							    <?php 
							      $stat=$row['status'];
							      if ($stat=="Submitted")
								echo "bg-green";
							      if ($stat=="Late")
								echo "bg-orange";
							      if ($stat=="Not Submitted")
								echo "bg-red";	
							      
							    ?>" data-original-title="Status"><?php echo $row['status'];?></span></p>
								<?php
									$sid=$row['stud_assign_id'];
									$query2=mysqli_query($con,"select * from upload where stud_assign_id='$sid'")or die(mysqli_error());
										while($row1=mysqli_fetch_array($query2)){
											$file="../dist/uploads/$row1[file]";
											$ext = pathinfo($file, PATHINFO_EXTENSION);	
											include("../dist/includes/ext.php");	
											
								?> 
							  <!-- Attachment -->
							  <div class="attachment-block clearfix">
								<a  data-placement="bottom" title="Download" id="<?php echo $row1['upload_id']; ?>Download" href="../dist/uploads/<?php echo $row1['file']; ?>">
									<img class="attachment-img" src="../dist/uploads/<?php echo $display; ?>" alt="attachment image">
								<div class="attachment-pushed">
								  <h4 class="attachment-heading"><?php echo $row1['file'];?></a></h4>
								  <div class="attachment-text">
									<?php 
									
									include("../dist/includes/size.php");		
									?>
								  </div><!-- /.attachment-text -->
								</div><!-- /.attachment-pushed -->
							  </div><!-- /.attachment-block -->
										<?php }?>
							
							</div><!-- /.box-body -->
							
						  </div>
								<?php }?>			  
		 </div><!-- /.tab-pane -->
                
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!--end left col-->
            <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Join a Class</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="">
                  <div class="form-group">
                    <label>Class Name</label>
		    <input type="text" name="txtsearch" class="form-control" id="txtsearch" placeholder="Type First Name, Last Name here..." 
		    onkeyup="showHint(this.value)" autocomplete="off" required>&nbsp;					
			<div class=" suggestions" id="txtHint" >
		  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <div class="nav-tabs-custom">
		   <ul class="nav nav-tabs">
			<li class="active"><a href="#active" data-toggle="tab" aria-expanded="true">Active</a></li>
			<li class=""><a href="#archived" data-toggle="tab" aria-expanded="false">Archived</a></li>
		   </ul>
		   <div class="tab-content">
			<div class="tab-pane active" id="active">
			    <div class="box-body">
				<?php
				include('../dist/includes/dbcon.php');
				$id=$_SESSION['sid'];
				$query=mysqli_query($con,"select * from enrol natural join class natural join teacher where stud_id='$id' and class_stat='Active'")or die(mysqli_error());
				$countassign=mysqli_num_rows($query);
				if ($countassign<1) echo "<h4 class='text-red'>You have no active class yet!</h4>";
		
				while($row=mysqli_fetch_array($query)){
				$id=$row['class_id'];
				$query1=mysqli_query($con,"select COUNT(*) as count from enrol where class_id='$id'")or die(mysqli_error());  
				$row1=mysqli_fetch_array($query1);
				?>		
		
	    
			    <div class="col-md-12 col-sm-12 col-xs-12">
			      <div class="small-box" style="background-color:<?php echo $row['class_color'];?>">
				<div class="inner"><a href="class_home.php?cid=<?php echo $id;?>">
				  <h4><b><?php echo $row['class_name'];?></b></h4>
				  <h5><b><?php echo $row['t_salut']." ".$row['t_first']." ".$row['t_last'];?></b></h5>
				  <p>Enrolled <b>(<?php echo $row1['count'];?>)</b></p></a>
				</div>
				
			      </div>
			    </div><!-- /.col -->
			    
			  
			    <?php }?> 

		    </div><!-- /.box-body -->
		</div><!-- /.tab-pane -->
		<div class="tab-pane" id="archived">
		    <div class="box-body">
		<?php
		include('../dist/includes/dbcon.php');
		$id=$_SESSION['sid'];
		$query1=mysqli_query($con,"select * from enrol natural join class natural join teacher where stud_id='$id' and class_stat='Archive'")or die(mysqli_error());
		$count1=mysqli_num_rows($query1);
		if ($count1==0){
		echo "<div class='callout callout-danger'>
                    <h4>No Record!</h4>
                  </div>";
                  }
                  
		while($row=mysqli_fetch_array($query1)){
		$id=$row['class_id'];
		$query1=mysqli_query($con,"select COUNT(*) as count,class_id from enrol where class_id='$id'")or die(mysqli_error());  
		$row1=mysqli_fetch_array($query1);
		?>		
	      
          
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="small-box" style="background-color:<?php echo $row['class_color'];?>">
                <div class="inner">
                  <h4><b><?php echo $row['class_name'];?></b></h4>
                  <h5><b><?php echo $row['t_salut']." ".$row['t_first']." ".$row['t_last'];?></b></h5>
                  <p>Enrolled <b>(<?php echo $row1['count'];?>)</b></p>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="view_class.php?cid=<?php echo $row['class_id'];?>" class="small-box-footer">
                  Manage <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- /.col -->
            
          
<?php }?> 

                </div><!-- /.box-body -->
	    </div><!-- /.tab-pane -->
	    </div><!-- /.tab-content -->
	  </div>
          </div><!-- /.col (right) -->
          </div><!--row-->	  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php include('../dist/includes/footer.php');?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->
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
	url: "assign_del.php",
	data: dataString,
	success: function(){
		
	      }
	  });
	  
	  $("#record"+id).slideUp('slow', function() {$(this).remove();});
      }
      return false;
      });

      });
    </script>
   
    
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
