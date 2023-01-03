<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Contactos extends CI_Controller{

		function __construct()
		{
			parent::__construct();            
			session_start();
			if(empty($_SESSION['login']))
			{
             echo '<script>window.location.href="http://localhost/sitio-keops/login"</script>';			
			}
            $this->load->model("Helpers"); 
            $this->load->model("ContactosModel"); 
            $this->Helpers->getPermisos(MDCONTACTOS);
		}

    //contacto
	public function Contactos()
	{
		if(empty($_SESSION['permisosMod']->r)){
                echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';				
		}	
        $contactos = $this->ContactosModel->selectContactos();

        $this->load->view('layouts/Administrador/header_admin');		
        $this->load->view('layouts/Administrador/body');
        $this->load->view('layouts/Administrador/nav_admin');
        $this->load->view('layouts/Contactos/contactos', compact('contactos'));
        $this->load->view('layouts/Administrador/footer_admin' );	
    
	}
  //ver mensajes
	public function getMensaje($idmensaje){

		if ($this->input->is_ajax_request())
		{
			if($_SESSION['permisosMod']->r){

					$idmensaje = intval($idmensaje);
					if($idmensaje > 0){
						$arrData = $this->ContactosModel->selectMensaje($idmensaje);
				
						if(empty($arrData)){
							$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
						}else{
							for($i =0; $i < count($arrData ); $i++){
								$datos = 	$arrData[$i];
							}
							$arrResponse = array('status' => true, 'post' => $datos);
						
						}
						echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
					}
			}
		}else {
			redirect('error');						
		  } 
		die();
	}

}
?>