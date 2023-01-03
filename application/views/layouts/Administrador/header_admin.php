
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
      $this->load->model("ConfiguracionModel");
      $empresa = $this->ConfiguracionModel->getEmpresa();       
      $N_empresa =  $empresa[0]->empresa;    
    ; ?>
  <title><?= $N_empresa; ?></title>
    <meta charset="utf-8">
    <meta name="description" content="<?= $N_empresa; ?>">   <!-- Twitter meta--> 

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jojama">
    <meta name="theme-color" content="#206A5D">
    <!-- Main CSS-->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">  

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Admin/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Admin/css/bootstrap-select.min.css">    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Admin/js/datepicker/jquery-ui.min.css">


    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Admin/css/select2.min.css">  -->
    <!-- Font-icon css-->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Admin/css/style.css"> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Admin/css/style2.css">  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Admin/css/stylereal.css"> 
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Admin/css/toastr.css">  -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libreria/sweetalert2/dist/sweetalert2.min.css">
    </head>

    <!-- Sidebar menu-->


