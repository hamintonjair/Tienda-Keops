<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {

    public function __construct()
    {
	
	  parent:: __construct();
	  session_start();
	  $this->load->model("PedidosModel");
	  $this->load->model("TtipoPagoModel");
      $this->load->model("Helpers");
	  $this->load->model("ConfiguracionModel");
	
		
	  if(empty($_SESSION['login']))
	  {
		echo '<script>window.location.href="http://localhost/sitio-keops/login"</script>';				
	  }	  
		$this->Helpers->getPermisos(MPEDIDOS);   

    }
	//listar pedidos
	public function VerPedidos()
	{	           
          if(empty($_SESSION['permisosMod']->r)){
              echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';	
          }   

		  $idpersona = "";

		  if( $_SESSION['userData']->idrol == RCLIENTES ){
					$idpersona = $_SESSION['userData']->idpersona;
			}   
		  $datos = array(        
				'pedidos'=> $this->PedidosModel->selectPedidos( $idpersona ),
			); 	
			
         $this->load->view('layouts/Administrador/header_admin');
         $this->load->view('layouts/Administrador/body');		
		 $this->load->view('layouts/Administrador/nav_admin');
	     $this->load->view('layouts/Pedidos/pedidos', $datos );
		 $this->load->view('layouts/Administrador/footer_admin');
	}	

	//ver orden de pedidos
	public function orden($idpedido){

		if(!is_numeric($idpedido)){
			echo '<script>window.location.href="http://localhost/sitio-keops/pedidos"</script>';	
		
		}
		if(empty($_SESSION['permisosMod']->r)){
			echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';	
		}
		$idpersona = "";

		if( $_SESSION['userData']->idrol == RCLIENTES ){
			$idpersona = $_SESSION['userData']->idpersona;
		}
		$datos = $this->ConfiguracionModel->getEmpresa(); 

		for($i=0;$i< count($datos);$i++){
           $logo = $datos[$i]->logo;
		}
		$data = array(        
			'pedidos'=>  $this->PedidosModel->selectPedido($idpedido,$idpersona),
		    'url_logo' => base_url().'assets/Template/Admin/images/uploads/'.$logo,
		);
		
	   
		$this->load->view('layouts/Administrador/header_admin');
		$this->load->view('layouts/Administrador/body');		
		$this->load->view('layouts/Administrador/nav_admin');
		$this->load->view('layouts/Pedidos/orden', $data );
		$this->load->view('layouts/Administrador/footer_admin');
	}
	//ver transaccion paypal
	public function transaccion($transaccion){

		if(empty($_SESSION['permisosMod']->r)){
			echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';	
		}
		$idpersona = "";
		if( $_SESSION['userData']->idrol == RCLIENTES ){
			$idpersona = $_SESSION['userData']->idpersona;
		}
		$datos = $this->ConfiguracionModel->getEmpresa(); 

		for($i=0;$i< count($datos);$i++){
           $logo = $datos[$i]->logo;
		}		
		$requestTransaccion  = array(    

			'pedidos'=> $this->PedidosModel->selectTransPaypal($transaccion,$idpersona),
			'url_logo' => base_url().'assets/Template/Admin/images/uploads/'.$logo,	
		);

		$this->load->view('layouts/Administrador/header_admin');
		$this->load->view('layouts/Administrador/body');		
		$this->load->view('layouts/Administrador/nav_admin');
		$this->load->view('layouts/Pedidos/transaccion', $requestTransaccion );
		$this->load->view('layouts/Administrador/footer_admin');
	}
	//trembolso de pedidos por paypal
	public function getTransaccion($transaccion){

		if ($this->input->is_ajax_request()) {

			if($_SESSION['permisosMod']->r && $_SESSION['userData']->idrol != RCLIENTES){

				if($transaccion == ""){
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					$transaccion = $this->Helpers->strClean($transaccion);

					$requestTransaccion  = array(   
						'pedidos'=> $this->PedidosModel->selectTransPaypal($transaccion),	
					);
				
					if(empty($requestTransaccion)){
						$arrResponse = array("status" => false, "msg" => "Datos no disponibles.");
					}else{
						$htmlModal = $this->Helpers->getFile("layouts/Modal/modalReembolso",$requestTransaccion);
						$arrResponse = array("status" => true, "html" => $htmlModal);
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		else{
			redirect('error');	
		}
	    die();	
	}
     //eliminando reembolso paypal
	public function setReembolso(){

		if ($_POST) {

			if($_SESSION['permisosMod']->u && $_SESSION['userData']->idrol!= RCLIENTES){
				//dep($_POST);
				$transaccion = $this->Helpers->strClean($this->input->post('idtransaccion'));
				$observacion = $this->Helpers->strClean($this->input->post('observacion'));

				$requestTransaccion = $this->PedidosModel->reembolsoPaypal($transaccion,$observacion);
		
				if($requestTransaccion){
					$arrResponse = array("status" => true, "msg" => "El reembolso se ha procesado.");
				}else{
					$arrResponse = array("status" => false, "msg" => "No es posible procesar el reembolso.");
				}
			}else{
				$arrResponse = array("status" => false, "msg" => "No es posible realizar el proceso, consulte al administrador.");
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		else{
			redirect('error');	
		}
		die();
	}
	//extraer los pedidos para editarlo
	public function getPedido($pedido){

		if ($this->input->is_ajax_request()) {
			if($_SESSION['permisosMod']->u && $_SESSION['userData']->idrol != RCLIENTES){
				if($pedido == ""){
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					$requestPedido['pedido'] =  $this->PedidosModel->selectPedido($pedido,"");
			
					if(empty($requestPedido)){
						$arrResponse = array("status" => false, "msg" => "Datos no disponibles.");
					}else{
					    $requestPedido['tipospago'] =  $this->TtipoPagoModel->getTipoPago();										
	
						$htmlModal = $this->Helpers->getFile("layouts/Modal/modalPedidos",$requestPedido);						
						$arrResponse = array("status" => true, "html" => $htmlModal);
								
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		else{
			redirect('error');	
		}
		die();
	}
	//editar los pedidos
	public function setPedido(){
		if($this->input->is_ajax_request()){
		
			if($_SESSION['permisosMod']->u && $_SESSION['userData']->idrol != RCLIENTES){

				$idpedido = !empty($this->input->post('idpedido')) ? intval($this->input->post('idpedido')) : "";
				$estado = !empty($this->input->post('listEstado')) ? $this->Helpers->strClean($this->input->post('listEstado')) : "";
				$idtipopago =  !empty($this->input->post('listTipopago')) ? intval($this->input->post('listTipopago')) : "";
				$transaccion = !empty($this->input->post('txtTransaccion')) ? $this->Helpers->strClean($this->input->post('txtTransaccion')) : "";

				if($idpedido == ""){
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					if($idtipopago == ""){
						if($estado == ""){
							$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
						}else{
							$requestPedido = $this->PedidosModel->updatePedido($idpedido,"","",$estado);
							if($requestPedido){
								$arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente");
							}else{
								$arrResponse = array("status" => false, "msg" => "No es posible actualizar la información.");
							}
						}
					}else{

						if($transaccion == "" || $idtipopago =="" || $estado == ""){
							$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
						}else{
							$requestPedido = $this->PedidosModel->updatePedido($idpedido,$transaccion,$idtipopago,$estado);
							if($requestPedido){
								$arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente");
							}else{
								$arrResponse = array("status" => false, "msg" => "No es posible actualizar la información.");
							}
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}else{
			redirect('error');	
		}
		die();
		
	}
}
