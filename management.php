<!DOCTYPE html>

<html lang="es">

<head>

  <?php

    include("headers.php");
    $error=false;
    if (!isset($_SESSION["username"])) {
          header('Location: login.php ');
        }
    if ($_SESSION["type"] != 1) {
      header('Location: index.php ');
    }
    if(isset($_POST['id_user'])){

    	$sql = "UPDATE opt_users SET active_user = 0 WHERE id_user = ".$_POST['id_user'].";";
        mysqli_query($con, $sql) or die("Error al ejecutar la consulta.");
    }
    if (isset($_POST['pk']) && isset($_POST['name']) && isset($_POST['value'])) {
      echo "<script>alert('GG');</script>";
      if (!empty($_POST['pk']) && !empty($_POST['name']) && !empty($_POST['value'])) {
        if ($_POST['name'] == 'id_user_type') {
          $sql = "update opt_users set  id_user_type = ".$_POST['value']." where id_user = ".$_POST['pk'].";";
          mysqli_query($con, $sql) or die("Error al ejecutar la consulta.");
        }
        else if ($_POST['name'] == 'password_user'){
          $password=password_hash($_POST['value'],PASSWORD_BCRYPT,$options_hash_password);
          $sql = "update opt_users set password_user = '".$password."' where id_user = ".$_POST['pk'].";";
          mysqli_query($con, $sql) or die("Error al ejecutar la consulta.");
        }
      }
    }
    if (isset($_POST['register']) && !empty($_POST['email_user']) 
               && !empty($_POST['password_user']) && !empty($_POST['password_verify']) && !empty($_POST['name_user'])) {
      if ($_POST['password_user'] == $_POST['password_verify']) {
        
        $password=password_hash($_POST['password_user'],PASSWORD_BCRYPT,$options_hash_password);
        $sql = "INSERT INTO opt_users (id_user_type, name_user, email_user, password_user) VALUES (1, '".$_POST['name_user']."', '".$_POST['email_user']."', '".$password."')";
        if (mysqli_query($con, $sql)) {
            $error_message="La cuenta se creo con exito.";
        } else {
            $error=true;
            $error_message="Error al crear usuario.";
        }
      }
      else{
        $error=true;
        $error_message="Las contraseñas no coinciden.";
      }
      
    }
    else{
      if (isset($_POST['register'])) {
        $error=true;
        $error_message="Alguno de los campos esta vacios.";
      }
      
    }
    
  ?>


</head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <?php
        include("sidebar.php");
      ?>
       <div class="content-wrapper">
       <section class="content-header">
           
        </section>
        <!-- Main content -->
        <section class="content">
                <div id="table_users" class="col-md-8 col-xs-12">
                  <table id="tablaUsuarios" class="table responsive table-bordered">
                          
                          <thead>
                            <tr>
                              <th>Nombre</th>
                              <th>Email</th>
                              <th>Tipo de Usuario</th>
                              <th>Clave</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                                $query="select id_user,name_user,id_user_type,type,email_user from opt_users natural join opt_users_type where active_user = 1;";
                                $statement = $con->prepare($query);
                                $statement->execute();
                                $statement->store_result();
                                $statement->bind_result($id_user, $name_user, $id_user_type, $type, $email_user);
                               
                                while ($statement->fetch()) {
                                   echo "<tr>";
                                   //<a href="#" id="username" data-type="text" data-pk="1" data-url="/post" data-title="Enter username">superuser</a>
                                  echo "<td>".htmlentities(utf8_encode($name_user),0,"UTF-8")."</td>";
                                  echo "<td>".htmlentities(utf8_encode($email_user),0,"UTF-8")."</td>";
                                  if($email_user == $_SESSION['username']){
                                    echo '<td>'.$type.'</td>';
                                  }else
                                  echo '<td><a href="#" class="x-editable-select" id="id_user_type" data-type="select" data-pk="'.$id_user.'" data-url="management.php" data-title="Selecciona el tipo de usuario">'.$type.'</a></td>
                                  ';
                                  echo '<td><a href="#" class="x-editable" id="password_user" data-type="password" data-pk="'.$id_user.'" data-url="management.php" data-title="Ingrese la nueva contraseña">Modificar</a></td>
                                  ';
                                  if($email_user == $_SESSION['username']){
                                    echo '<td></td>';
                                  }else
                                  echo '<td><a href="#" > <i id="'.$id_user.'" class = "fa fa-trash-o boton_borrar" style = "color:red"></a></td>';
                                  echo "</tr>";
                                }
                                
                            ?>
                          </tbody>
                    </table>
                  </div>
          <div id="" class="col-md-4 col-xs-12">
            <div class="">
              <div class="register-box-body">
                <p class="login-box-msg">Registrar un nuevo usuario</p>
                <?php
                  if ($error) {
                    echo " <p class='login-box-msg' style='color:red;'>".$error_message."</p>";
                  }
                  else{
                    if (isset($_POST['register'])) {
                      echo " <p class='login-box-msg' style='color:green;'>".$error_message."</p>";
                    }
                    
                  }
                  
                ?>
                <form action="management.php" method="post">
                  <div class="form-group has-feedback">
                    <input type="text" name="name_user" class="form-control" placeholder="Nombre completo">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input type="email" name="email_user" class="form-control" placeholder="Correo Electr&oacute;nico">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input type="password" name="password_user" class="form-control" placeholder="Contraseña">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input type="password" name="password_verify" class="form-control" placeholder="Repetir Contraseña">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                  </div>
                  <div class="row">
                    <button type="submit" name="register" class="btn btn-primary btn-block btn-flat">Registrar</button>
                  </div>
                </form>


               
              </div><!-- /.form-box -->
            </div><!-- /.register-box -->
           </div>
          </section>
        </div><!-- Content Wrapper-->
        <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- Main Wrapper -->
    <?php
      include("footer.php");
    ?>
    <script type="text/javascript">
  function recargarTabla1(){
    $('#tablaUsuarios').DataTable().draw();
  }

  function recargarTabla(){
    $('#tablaUsuarios').DataTable().destroy();
    $('#tablaUsuarios').DataTable({
            "pageLength": 4,
            "order": [[ 2, 'asc' ]],
            "oLanguage":
            {
              "sInfo": "Ver del _START_ al _END_ de _TOTAL_ registros.",
              "sSearch": "Buscar",
              "sLengthMenu": "Mostrar _MENU_ registros",
              "oPaginate":
              {
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
        
              }
            },
            "responsive": true
          });
      $('.x-editable').editable();
      $('.x-editable-select').editable({
        source: [
              {value: 1, text: 'Administrador'},
              {value: 2, text: 'Supervisor'},
              {value: 3, text: 'Usuario'}
             ]
      });
  }
</script>
    <script type="text/javascript">
      $("#menu_management").addClass("active");
      recargarTabla();
      
    </script>
    <script>
    	 $( ".boton_borrar" ).click(function() {
            var id_selected=$(this).attr("id");
            $("#status_update").html('<span style="float:right; font-size: 10px;"  ><i class="fa fa-refresh fa-spin fa-3x fa-fw margin-bottom"></i></span>');
            $.post("management.php",
              {
                  id_user: id_selected
              }).done(function(data,status){
                location.reload();
              });
          });
    </script>

    
  </body>
</html>