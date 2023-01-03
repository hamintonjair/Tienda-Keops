<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Controller {

   function __construct(){

	  parent::__construct();
	  session_start();	
	  $this->load->model("Helpers");
	  $this->load->model("ConfiguracionModel");
	  $this->Helpers->getPermisos(MDCONFIGURACION);
   }
	public function configuracion()
	{	
		$datos = $this->ConfiguracionModel->getEmpresa(); 

		for($i=0;$i< count($datos);$i++){
           $logo = $datos[$i]->logo;
		}
	    $url['url_logo'] = base_url().'assets/Template/Admin/images/uploads/'.$logo;	
		$empresa ['empresa'] = $datos;	
		$this->load->view('layouts/Administrador/header_admin');
		$this->load->view('layouts/Administrador/body');		
		$this->load->view('layouts/Administrador/nav_admin');
		$this->load->view('layouts/Configuracion/configuracion',compact('url','empresa')  );
		$this->load->view('layouts/Administrador/footer_admin');
		
	}	
	public function putConfiguracion()
	{	 
		if ($this->input->is_ajax_request()) {			
		
			if(empty($this->input->post("Nombre")) || empty($this->input->post("Direccion"))|| empty($this->input->post("Telefono")) || empty( $this->input->post("Whatsapp"))|| empty($this->input->post("EmailEmpresa")) || empty($this->input->post("EmailPedido")) || empty($this->input->post("EmailSucripcion"))|| empty($this->input->post("EmailContacto"))|| empty($this->input->post("EmailRemitente")) || empty($this->input->post("Remitente"))|| empty($this->input->post("Descripcion"))|| empty($this->input->post("NombreTienda"))|| empty( $this->input->post("CostoEnvio")) || empty( $this->input->post("costo_envioP"))|| empty( $this->input->post("Facebook"))||empty( $this->input->post("idClientePaypal"))|| empty( $this->input->post("SecretPaypal"))){
				
			  $respuesta = array('status' => false, 'msg' => 'Hay campos son obligatorios.');      
			}else{  
				
				$idConfiguracion = $this->input->post("idConfiguracion");
				$Nombre =  $this->Helpers->strClean($this->input->post("Nombre"));
				$Direccion = $this->Helpers->strClean($this->input->post("Direccion"));		
				$Telefono = $this->Helpers->strClean($this->input->post("Telefono"));
				$Whatsapp = $this->Helpers->strClean($this->input->post("Whatsapp"));
				$EmailEmpresa = strtolower($this->Helpers->strClean($this->input->post("EmailEmpresa")));      
				$EmailPedido = strtolower($this->Helpers->strClean($this->input->post("EmailPedido")));  
				$EmailSucripcion = strtolower($this->Helpers->strClean($this->input->post("EmailSucripcion")));  
				$EmailContacto = strtolower($this->Helpers->strClean($this->input->post("EmailContacto")));  
				$EmailRemitente = strtolower($this->Helpers->strClean($this->input->post("EmailRemitente")));     
				$Remitente = $this->Helpers->strClean($this->input->post("Remitente"));
				$PaginaWeb =$this->Helpers->strClean($this->input->post("PaginaWeb"));  
				$Descripcion =$this->Helpers->strClean($this->input->post("Descripcion"));
				$cadena =$this->Helpers->strClean($this->input->post("NombreTienda"));
				$NombreTienda =str_replace(' ', '', $cadena);
				$CostoEnvio = $this->input->post("CostoEnvio");
				$costo_envioP = $this->input->post("costo_envioP");
				$Facebook =$this->Helpers->strClean($this->input->post("Facebook"));  
				$Instagram =$this->Helpers->strClean($this->input->post("Instagram"));
				$Linkedin =$this->Helpers->strClean($this->input->post("Linkedin"));
				$Twitter = $this->Helpers->strClean($this->input->post("Twitter"));				 
				$idClientePaypal =$this->Helpers->strClean($this->input->post("idClientePaypal"));
				$SecretPaypal =$this->Helpers->strClean($this->input->post("SecretPaypal"));				
								
				$Logo = $this->input->post("Logo");
				$descripcion = $this->input->post("txtDescripcion");
				$status = intval($this->input->post("listStatus"));					
		    	$ruta =$this->Helpers->clear_cadena($Logo );
				$ruta = str_replace(" " , "-",$ruta);	
				$foto        = $_FILES['foto2'];
				$nombre_foto = $foto['name'];
				$type        = $foto['type'];
				$url_temp    = $foto['tmp_name'];						
				$imgPortada  = 'portada_categoria.png';

				if($nombre_foto != ""){
			     	$imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
				}

			}
				
			$respuesta = $this->ConfiguracionModel->updateConfiguracion( 
															$idConfiguracion,
															$Nombre, 
															$Direccion, 
															$Telefono, 
															$Whatsapp, 
															$EmailEmpresa, 
															$EmailPedido,
															$EmailSucripcion,
															$EmailContacto, 
															$EmailRemitente, 
															$Remitente, 
															$PaginaWeb, 
															$Descripcion, 
															$NombreTienda,
															$CostoEnvio, 
															$costo_envioP,
															$Facebook, 
															$Instagram, 
															$Linkedin, 
															$Twitter,														
															$idClientePaypal, 
															$SecretPaypal,
															$imgPortada );
		 
               
			if($respuesta)
			{
				$resultados = $this->Helpers->sessionUser($_SESSION['idUser']);
				$_SESSION['userData'] = $resultados;
				
				 $resultado = (array('status' => true, 'post' => 'Datos Actualizados con exito'));  
			
							if($nombre_foto != "" ){
								$this->Helpers->uploadImage($foto,$imgPortada);
							}
							if(($nombre_foto == "" && $this->input->post("foto_remove") == 1 && $this->input->post("foto_actual") == 'portada_categoria.php')
							|| ($nombre_foto != "" && $this->input->post("foto_actual") != 'portada_categoria.png')){
								//eliminamos la foto que esta en la carpeta uploads para reemplazarla
								$this->Helpers->deleteFile(	$this->input->post("foto_actual"));
							}

			}else
			{
				 $resultado = (array('status' => false, 'msg' => 'No es posible almacenar los datos.'));   
			}                
	  
			 echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
	
		}else{

			redirect('error');	
		}
		die();		
	}	
}
