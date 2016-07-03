<header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>O</b>PT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Obras</b> P&uacute;blicas</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- User Account: style can be found in dropdown.less -->
              <?php
              	if (isset($_SESSION['valid'])) {
              		if ($_SESSION['valid']==true) {
              			echo '<li class="dropdown user user-menu">
			                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			                  <img src="img/logoTulancingo.png" class="user-image" alt="User Image">
			                  <span class="hidden-xs">'.htmlentities(utf8_encode($_SESSION['name']),0,"UTF-8").'</span>
			                </a>
			                <ul class="dropdown-menu">
			                  <!-- User image -->
			                  <li class="user-header">
			                    <img src="img/logoTulancingo.png" class="img-circle" alt="User Image">
			                    <p>
			                      '.$_SESSION['name'].'
			                      
			                    </p>
			                  </li>
			                  <!-- Menu Body -->
			                  <li class="user-body">
			                    
			                  </li>
			                  <!-- Menu Footer-->
			                  <li class="user-footer">
			                    
			                    <div class="pull-right">
			                      <a href="logout.php" class="btn btn-default btn-flat">Cerrar Sesion</a>
			                    </div>
			                  </li>
			                </ul>
			              </li>';
              		}

              	}
              	else{
	          			echo '<li class="dropdown notifications-menu">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							    <i class="fa fa-sign-in"></i> Login
							  </a>
							  <ul class="dropdown-menu">
							    <div style="padding: 20px;">
							          <form action="login.php" method="post">
							          <div class="form-group has-feedback">
							            <input type="email" name="email" class="form-control" placeholder="Correo Electr&oacute;nico">
							            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
							          </div>
							          <div class="form-group has-feedback">
							            <input type="password" name="password" class="form-control" placeholder="Contraseña">
							            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
							          </div>
							          <div class="row">
							            
							            <div class="col-xs-4">
							              <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Iniciar</button>
							            </div><!-- /.col -->
							          </div>
							        </form>
							    </div>        
							  </ul>
							</li>';
              		}
              	
              ?>
            </ul>
          </div>
        </nav>
      </header>
      
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <ul class="sidebar-menu">
            <li class="header">MEN&Uacute; PRINCIPAL</li>
            <li id="menu_baches">
              <a href="index.php?show=baches">
                <i class="fa fa-automobile"></i> <span>Baches</span></a>
            </li>
            <li id="menu_alumbrado">
              <a href="index.php?show=alumbrado">
                <i class="fa fa-lightbulb-o"></i> <span>Alumbrado p&uacute;blico</span></a>
            </li>
            <li id="menu_obras">
              <a href="index.php?show=obras">
                <i class="fa fa-warning"></i> <span>Obras en progreso</span></a>
            </li>
            <li id="otros">
              <a href="index.php?show=otros">
                <i class="fa fa-folder-open"></i> <span>Otros</span></a>
            </li>
            <?php
                if ($_SESSION['type'] == 1) {
                  echo '<li class="header">ADMINISTRACI&Oacute;N</li>
                        <li id="menu_management">
                          <a href="management.php">
                            <i class="fa fa-users"></i> <span>Control de Usuarios</span></a>
                        </li>';
                }
            ?>
            
            <li class="header">REPORTES</li>
            <li class="treeview" id="denuncias_tree">
              <a href="#">
                <i class="fa fa-list"></i> <span>Denuncias</span> <i class="fa fa-angle-right pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li id="menu_new">
                  <a href="denuncias.php?show=new"><i class="fa fa-map-pin" style="color:white;"></i> Nuevas</a>
                </li>
                <li id="menu_all">
                  <a href="denuncias.php?show=all"><i class="fa fa-map-pin" style="color:blue;"></i> Todas</a>
                </li>
                <li id="menu_receive">
                  <a href="denuncias.php?show=receive"><i class="fa fa-map-pin" style="color:red;"></i> Recibidas</a>
                </li>
                <li id="menu_progress">
                  <a href="denuncias.php?show=progress"><i class="fa fa-map-pin" style="color:yellow;"></i> En progreso</a>
                </li>
                <li id="menu_complete">
                  <a href="denuncias.php?show=complete"><i class="fa fa-map-pin" style="color:green;"></i> Completadas</a>
                </li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>