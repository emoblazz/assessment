
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
              <img src="../dist/img/<?php echo $_SESSION['pic'];?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['name'];?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          </li>
                     
        
            <li>
              <a href="assignment.php">
                <i class="glyphicon glyphicon-save"></i> <span>Assignment</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-calendar"></i> <span>Attendance</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                
                <li class="active">
                  <a href="#"><i class="fa fa-circle-o"></i> Prelim <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu menu-open" style="display: block;">
                    <?php
                      $query1=mysqli_query($con,"select * from class where t_id='$id' and class_stat='Active'")or die(mysqli_error());
			while($row1=mysqli_fetch_array($query1)){
			?>
			<li><a href="../pages/attendance.php?cid=<?php echo $row1['class_id'];?>&term=Prelim"><i class="fa fa-circle-o"></i> <?php echo $row1['class_name'];?></a></li>
                        <?php }?>
                    
                  </ul>
            </li>
				
            
            
            
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Midterm <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu menu-open">
                    <?php
                      $query1=mysqli_query($con,"select * from class where t_id='$id' and class_stat='Active'")or die(mysqli_error());
			while($row1=mysqli_fetch_array($query1)){
			?>
			<li><a href="../pages/attendance.php?cid=<?php echo $row1['class_id'];?>&term=Midterm"><i class="fa fa-circle-o"></i> <?php echo $row1['class_name'];?></a></li>
                        <?php }?>
                    
                  </ul>
                </li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Endterm <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu menu-open">
                    <?php
                      $query1=mysqli_query($con,"select * from class where t_id='$id' and class_stat='Active'")or die(mysqli_error());
			while($row1=mysqli_fetch_array($query1)){
			?>
			<li><a href="../pages/attendance.php?cid=<?php echo $row1['class_id'];?>&term=Endterm"><i class="fa fa-circle-o"></i> <?php echo $row1['class_name'];?></a></li>
                        <?php }?>
                    
                  </ul>
                </li>
              </ul>
            </li>
			
			<li class="treeview">
              <a href="">
                <i class="glyphicon glyphicon-user"></i>
                <span>Class</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
				<li><a href="../pages/class.php"><i class="glyphicon glyphicon-plus-sign"></i>Create Class</a></li>
				

              <?php
		include('dbcon.php');
		$id=$_SESSION['id'];
		$query=mysqli_query($con,"select * from class where t_id='$id' and class_stat='Active'")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		
		  
	      ?>		
                <li style="background-color:<?php echo $row['class_color'];?>;"><a href="../pages/class_home.php?cid=<?php echo $row['class_id'];?>"><i class="fa fa-circle-o"></i> <?php echo $row['class_name'];?></a></li>
              <?php }?>  
				
              </ul>
            </li>
            
	   <li>
              <a href="quiz.php">
                <i class="glyphicon glyphicon-save"></i> <span>Assessment</span>
              </a>
            </li>
	    
	   
           
             
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
