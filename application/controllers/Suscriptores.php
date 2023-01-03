<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Suscriptores extends CI_Controller{
        
		public function __construct()
		{
			parent::__construct();
			session_start();          
			if(empty($_SESSION['login']))
			{
                echo '<script>window.location.href="http://localhost/sitio-keops/login"</script>';						
			}
            $this->load->model("Helpers");
			$this->load->model("SuscriptoresModel");
            $this->Helpers->getPermisos(MSUSCRIPTORES);
		}

		public function Suscriptor()
		{
			if(empty($_SESSION['permisosMod']->r)){
                echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';		
			}
			$suscriptores = $this->SuscriptoresModel->selectSuscriptores();
		
			$this->load->view('layouts/Administrador/header_admin');		
			$this->load->view('layouts/Administrador/body');
			$this->load->view('layouts/Administrador/nav_admin');
			$this->load->view('layouts/Suscriptores/suscriptores',compact('suscriptores'));
			$this->load->view('layouts/Administrador/footer_admin' );	
	
		}

	

	}
?>