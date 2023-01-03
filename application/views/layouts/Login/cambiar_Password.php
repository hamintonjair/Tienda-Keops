<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.png">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Admin/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/<?php echo base_url(); ?>assets/Template/Cliente/assets2/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libreria/sweetalert2/dist/sweetalert2.min.css">
    <title>Cambiar Contraseña</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Cambiar contraseña Tienda Virtual</h1>
      </div>
      <div class="login-box flipped">  
        <form id="formCambiarPass" name="formCambiarPass" class="forget-form" action="">
          <input id="idUsuario" name="idUsuario" type="hidden" value="<?= $idpersona; ?>" required>
          <input id="txtEmail" name="txtEmail" type="hidden" value="<?= $email; ?>" required>
          <input id="txtToken" name="txtToken" type="hidden" value="<?= $token; ?>" required>
          <h3 class="login-head"><i class="fas fa-key"></i>Cambiar contraseña</h3>
          <div class="form-group">           
            <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Nueva contraseña" required>
          </div>
          <div class="form-group">           
            <input id="txtPasswordConfirm" name="txtPasswordConfirm" class="form-control" type="password" placeholder="Confirmar contraseña" required>
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>REINICIAR</button>
          </div>          
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="<?php echo base_url(); ?>assets/Template/Admin/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/Template/Admin/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/Template/Admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/Template/Admin/js/fontawesome.js"></script>
    <script src="<?php echo base_url(); ?>assets/Template/Admin/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?php echo base_url(); ?>assets/Template/Admin/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_login.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libreria/sweetalert2/dist/sweetalert2.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>