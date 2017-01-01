<header class="main-header">
        <!-- Logo -->
        <a href="home.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b><i class="glyphicon glyphicon-home"></i></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Assessment</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="navigation">
				<span class="glyphicon glyphicon-align-justify" style="float:left;z-index:10000"></span>
                

          </a>
          <?php
		include('dbcon.php');
		$id=$_SESSION['id'];
		$query=mysqli_query($con,"select * from class where t_id='$id' and class_stat='Active'")or die(mysqli_error());
		$count=mysqli_num_rows($query);
		  
	      ?>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
	    <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="glyphicon glyphicon-stats"></i> Progress
                  <span class="label label-warning"><?php echo $count;?></span>
                </a>
                <ul class="dropdown-menu">
				<?php 
				while($row=mysqli_fetch_array($query)){
				?>
                  <li><a href="progress.php?cid=<?php echo $row['class_id'];?>" style="color:#000"><?php echo $row['class_name'];?></a></li>
                <?php }?>  
                </ul>
              </li>
			  
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="glyphicon glyphicon-bell"></i> Notifs
                  
                </a>
                <ul class="dropdown-menu">
                  
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                     <?php 
                   $id=$_SESSION['id'];
                   
                   $query1=mysqli_query($con,"select * from stud_log natural join student natural join class where t_id='$id' order by slog_id desc")or die(mysqli_error());
		      
		      while ($row1=mysqli_fetch_array($query1))
		      {

		      
                   ?>
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i><?php echo $row1['stud_first']." ".$row1['stud_last']." ".$row1['activity'];?>
                        </a>
                      </li>
                     <?php }?>
                    </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
                  </li>
                  
                </ul>
              </li>
              
              <li class="dropdown user user-menu">
		
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		
                  <img src="../dist/img/<?php echo $_SESSION['pic'];?>" class="user-image" alt="User Image">
                  <span class="hidden-xs">
                  <?php
		    echo $_SESSION['name'];
                    ?>
                  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../dist/img/<?php echo $_SESSION['pic'];?>" class="img-circle" alt="User Image">
                    <p>
                      <?php
                        echo $_SESSION['name'];
                    ?>
                      
                    </p>
                  </li>
                  <!-- Menu Body -->
                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="account_settings.php" class="btn btn-warning btn-flat">Account Settings</a>
                    </div>
                    
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>