<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="" class="navbar-brand"><b>Assessment</b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="glyphicon glyphicon-align-justify" style="float:left;z-index:10000"></span>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">   
              <ul class="nav navbar-nav">
                <li class=""><a href="#">About <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Contact</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Register <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#" data-target="#teacherreg" data-toggle="modal">Teacher</a></li>
                    <li><a href="#" data-target="#studentreg" data-toggle="modal">Student</a></li>
                    
                  </ul>
                </li>
              </ul>
             
            </div><!-- /.navbar-collapse -->
            
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          

          <!-- Main content -->
          <section class="content">
            <div class="row" style="text-align:center;margin-top:80px;">   
	      <div class="col-md-3 col-xs-12" style="text-align:center">
		
	      </div>
	      <div class="col-md-6 col-xs-12 well" style="text-align:center;opacity:.8">
		<div class="row">
		  <h3>Login</h3>
		  <hr style="border-color:#eeaa11">
		</div>
		<div class="row">
		  <div class="col-md-4 col-xs-12 teacher"><a href="" data-target="#teacherlog" data-toggle="modal"><h3>Teacher</h3></a></div>
		  <div class="col-md-4 col-xs-12"><img class="img-circle" src="dist/img/lock.png" alt="User Avatar" style="width:150px"></div>
		  <div class="col-md-4 col-xs-12 student"><a href="" data-target="#studentlog" data-toggle="modal"><h3>Student</h3></a></div>
	      </div>
	      <div class="col-md-3 col-xs-12" style="text-align:center">
		
	      </div>
	    
              
            </div>
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
     
    </div><!-- ./wrapper -->
 <!--start of modal for teacher login-->   
 <div id="teacherlog" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
		  <div class="modal-content">
                      <div class="modal-header" style="background-color:#fbe553">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"><img src="dist/img/teacher.png" class="img-circle" style="width:70px;border-color:#ffbb22;">Teacher Login</h4>
                      </div>
                      <div class="modal-body">
			  <form class="form-horizontal" method="post" action="login.php">
                             <!-- Title -->
                             <div class="form-group">
				  <label class="control-label col-lg-3" for="tuser">Username</label>
				  <div class="col-lg-8">
                                     <input type="text" class="form-control" id="tuser" name="tuser" placeholder="Username" required>  
				  </div>
                             </div> 
                             <div class="form-group">
				  <label class="control-label col-lg-3" for="last">Password</label>
				  <div class="col-lg-8">
                                     <input type="password" class="form-control" id="tpass" name="tpass" placeholder="Password" required>  
				  </div>
                             </div> 
                            
                      </div>       
                      <!--end of modal body-->
                      <div class="modal-footer">
			<button type="submit" name="login" class="btn btn-primary">Login</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                      </div>
               </div>
               
               <!--end of modal content-->
                </form>
           </div>
        </div>   
<!--end of teacherlog modal-->

<!--start of modal for student login-->   
 <div id="studentlog" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
		  <div class="modal-content">
                      <div class="modal-header" style="background-color:#2db8eb;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"><img src="dist/img/student.png" class="img-circle" style="width:70px;border-color:#ffbb22;">Student Login</h4>
                      </div>
                      <div class="modal-body">
			  <form class="form-horizontal" method="post" action="login.php">
                             <!-- Title -->
                             
                             <div class="form-group">
				  <label class="control-label col-lg-3" for="suser">Username</label>
				  <div class="col-lg-8">
                                     <input type="text" class="form-control" id="suser" name="suser" placeholder="Username" required>  
				  </div>
                             </div> 
                             
                              <div class="form-group">
				  <label class="control-label col-lg-3" for="spass">Password</label>
				  <div class="col-lg-8">
                                     <input type="password" class="form-control" id="spass" name="spass" placeholder="Password" required>  
				  </div>
                             </div> 
             
                        
                      </div>       
                      <!--end of modal body-->
                      <div class="modal-footer">
			<button type="submit" name="slogin" class="btn btn-primary">Login</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                      </div>
               </div>
               
               <!--end of modal content-->
                </form>
           </div>
        </div>   
<!--end of studentlog modal-->


<!--start of modal for student reg-->   
 <div id="studentreg" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
		  <div class="modal-content">
                      <div class="modal-header" style="background-color:#2db8eb;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"><i class="glyphicon glyphicon-plus" style="font-size:30px;"></i><img src="dist/img/student.png" class="img-circle" style="width:70px;border-color:#ffbb22;">Register as Student</h4>
                      </div>
                      <div class="modal-body">
			  <form class="form-horizontal" method="post" action="pages/student_save.php" enctype='multipart/form-data'>
                             <!-- Title -->
                             
                             <div class="form-group">
				  <label class="control-label col-lg-3" for="slast">Last Name</label>
				  <div class="col-lg-8">
                                     <input type="text" class="form-control" id="slast" name="slast" placeholder="Last Name" required>  
				  </div>
                             </div> 
                             <div class="form-group">
				  <label class="control-label col-lg-3" for="sfirst">First Name</label>
				  <div class="col-lg-8">
                                     <input type="text" class="form-control" id="sfirst" name="sfirst" placeholder="First Name" required>  
				  </div>
                             </div>
					
                             <div class="form-group">
				  <label class="control-label col-lg-3" for="spass">Birthday</label>
				  <div class="col-lg-8">
                                     <input type="date" class="form-control" id="spass" name="sbday">  
				  </div>
                             </div>
                             
                              <div class="form-group">
				  <label class="control-label col-lg-3" for="semail">Username</label>
				  <div class="col-lg-8">
                                     <input type="text" class="form-control" id="semail" name="suser" placeholder="Username">  
				  </div>
                             </div> 
                              <div class="form-group">
				  <label class="control-label col-lg-3" for="spass">Password</label>
				  <div class="col-lg-8">
                                     <input type="password" class="form-control" id="spass" name="spass"  placeholder="Password">  
				  </div>
                             </div> 
             
                             <div class="form-group">
				  <label class="control-label col-lg-3" for="simage">Picture</label>
				  <div class="col-lg-8">
                                     <input type="file" class="form-control" id="simage" name="simage">  
				  </div>
                             </div> 
                      </div>       
                      <!--end of modal body-->
                      <div class="modal-footer">
			<button type="submit" name="save" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                      </div>
               </div>
               
               <!--end of modal content-->
                </form>
           </div>
        </div>   
<!--end of studentreg modal-->


<!--start of modal for teacher reg-->   
 <div id="teacherreg" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
		  <div class="modal-content">
                      <div class="modal-header" style="background-color:#fbe553">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"><i class="glyphicon glyphicon-plus" style="font-size:30px;"></i><img src="dist/img/teacher.png" class="img-circle" style="width:70px;border-color:#ffbb22;">Register as Teacher</h4>
                      </div>
                      <div class="modal-body">
			  <form class="form-horizontal" method="post" action="pages/teacher_save.php" enctype='multipart/form-data'>
                             <!-- Title -->
                             <div class="form-group">
				  <label class="control-label col-lg-3" for="tsalut">Salutation</label>
				  <div class="col-lg-8">
                                     <select class="form-control" id="tsalut" name="tsalut" required>  
					<option>Mr.</option>
					<option>Ms.</option>
					<option>Mrs.</option>
					<option>Prof.</option>
					<option>Dr.</option>
					
                                     </select>
				  </div>
                             </div> 
                             <div class="form-group">
				  <label class="control-label col-lg-3" for="tlast">Last Name</label>
				  <div class="col-lg-8">
                                     <input type="text" class="form-control" id="tlast" name="tlast" placeholder="Last Name" required>  
				  </div>
                             </div> 
                             <div class="form-group">
				  <label class="control-label col-lg-3" for="tfirst">First Name</label>
				  <div class="col-lg-8">
                                     <input type="text" class="form-control" id="tfirst" name="tfirst" placeholder="First Name" required>  
				  </div>
                             </div>
							
                             <div class="form-group">
				  <label class="control-label col-lg-3" for="tbday">Birthday</label>
				  <div class="col-lg-8">
                                     <input type="date" class="form-control" id="tbday" name="tbday">  
				  </div>
                             </div>
                              
                              <div class="form-group">
				  <label class="control-label col-lg-3" for="tuser">Username</label>
				  <div class="col-lg-8">
                                     <input type="text" class="form-control" id="tuser" name="tuser" placeholder="Username">  
				  </div>
                             </div> 
                              <div class="form-group">
				  <label class="control-label col-lg-3" for="tpass">Password</label>
				  <div class="col-lg-8">
                                     <input type="password" class="form-control" id="tpass" name="tpass"  placeholder="Password">  
				  </div>
                             </div> 
             
                             <div class="form-group">
				  <label class="control-label col-lg-3" for="timage">Picture</label>
				  <div class="col-lg-8">
                                     <input type="file" class="form-control" id="timage" name="timage">  
				  </div>
                             </div> 
                      </div>       
                      <!--end of modal body-->
                      <div class="modal-footer">
			<button type="submit" name="save" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                      </div>
               </div>
               
               <!--end of modal content-->
                </form>
           </div>
        </div>   
<!--end of teacherreg modal-->
<!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
</html>
