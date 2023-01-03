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
    <title>Login - Dashboard</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Login- Tienda Virtual</h1>
      </div>
      <div class="login-box">
      <div id="divLoading" >
          <div>
            <img src="<?php echo base_url(); ?>assets/Template/Admin/images/loading.svg" alt="Loading">
          </div>
        </div>            
        <form class="login-form" name="formLogin" id="formLogin" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIAR SESIÓN</h3>           
          <div class="form-group">
            <label class="control-label">USUARIO</label>
            <input id="txtEmail" class="form-control" type="text" name="txtEmail" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">CONTRASEÑA</label>
            <input id="txtPassword" class="form-control" type="password" name="txtPassword" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="utility">             
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">¿Olvidaste contraseña?</a></p>
            </div>
          </div>
          <div id="alertLogin" class="text-center"></div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-info btn-block"><i class="fa fa-sign-in-alt"></i>INICIAR SESIÓN</button>           
          </div>              
        </form class="forget-form">        
        <form class="forget-form" id="formRecetPass" name="formRecetPass" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>¿Olvidaste contraseña?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input id="txtEmailReset" name="txtEmailReset" class="form-control" type="email" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-info btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>REINICIAR</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Iniciar sesión</a></p>
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

  <style>
    #divLoading{
      position: absolute;
      top: 0;
      width: 100%;
      height: 100%;    
      display: flex;
      justify-content: center;
      align-items: center;
      background: rgba(254,254,255, .65);
      z-index: 1;
      display: none;
     }
     #divLoading img{
      width: 50px;
      height: 50px;
     }
  </style>
</html>