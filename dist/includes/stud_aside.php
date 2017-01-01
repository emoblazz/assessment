
<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form -->
         
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li>
            <div class="user-panel">
            <div class="pull-left image">
              <img src="../dist/img/<?php echo $_SESSION['spic'];?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['sname'];?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          </li>
                     
        
           
            <li class="treeview">
              <a href="">
                <i class="glyphicon glyphicon-user"></i>
                <span>Class</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">		

              <?php
		include('dbcon.php');
		$id=$_SESSION['sid'];
		$query=mysqli_query($con,"select * from class natural join enrol where stud_id='$id' and class_stat='Active'")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		
		  
	      ?>		
                <li style="background-color:<?php echo $row['class_color'];?>;"><a href="../student/class_home.php?cid=<?php echo $row['class_id'];?>"><i class="fa fa-circle-o"></i> <?php echo $row['class_name'];?></a></li>
              <?php }?>  
				
              </ul>
            </li>
	    <li class="treeview">
              <a href="">
                <i class="glyphicon glyphicon-log-in"></i>
                <span>Assessment</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">				
                <li><a href="quiz.php">Quiz</a></li>
		<li><a href="exam.php">Exam</a></li>
              </ul>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
