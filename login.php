<!DOCTYPE html>
<html>
  <head>
      <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="js/bootstrap.min.js"></script>
      <?php
        $error=false;
        include("headers.php");
        if (isset($_POST['login']) && !empty($_POST['email']) 
               && !empty($_POST['password'])) {
          $query="select * from opt_users where email_user = ? and (id_user_type = 1 or id_user_type = 2);";
          $statement = $con->prepare($query);
          $statement->bind_param('s', $_POST['email']);
          $statement->execute();
          $statement->store_result();
          $total_rows=$statement->num_rows;
          if ($total_rows==1) {
            
            $password=password_hash($_POST['password'],PASSWORD_BCRYPT,$options_hash_password);
            $query1="select * from opt_users where email_user = ? and (id_user_type = 1 or id_user_type = 2) and password_user = ? and active_user = 1;";
            $statement1 = $con->prepare($query1);
            $statement1->bind_param('ss', $_POST['email'], $password);
            $statement1->execute();
            $statement1->store_result();
            $total_rows1=$statement1->num_rows;
            if ($total_rows1==1) {
                
                $_SESSION['valid'] = true;
                
                $_SESSION['username'] = $_POST['email'];
                $statement1->bind_result($id_user, $id_user_type, $name_user, $email_user, $password_user, $user_active);
                while($statement1->fetch())
                {
                    $_SESSION['name'] = $name_user;
                     $_SESSION['type'] = $id_user_type;
                }
                header('Location: index.php ');
            }
            else{
              $error=true;
            }
          }
          else{
              $error=true;
          }
        }
      ?>

  </head>

  <body class="hold-transition login-page">

    <div class="login-box">
      <div class="login-logo">
         <a href="index.php"><img class="image-logo-opt" src="img/logo.png"/><br>
       Obras P&uacute;blicas</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Inicia sesión para acceder a la plataforma.</p>
        <?php
          if ($error) {
            echo " <p class='login-box-msg' style='color:red;'>Error, Usuario y/o contrase&ntilde;a incorrectos.</p>";
          }
          
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post">
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
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
  </body>
</html>
