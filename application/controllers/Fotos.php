<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fotos extends CI_Controller {

    
   function __construct(){

    parent::__construct();
    session_start();	
    $this->load->model("Helpers");
    $this->load->model("FotosModel");
    $this->Helpers->getPermisos(MDFOTOS);

    }
	public function Fotos()
	{	
        if (empty($_SESSION['permisosMod']->r)){
            echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';	
        }    
        $datos = array(            
            'fotos'=>$this->FotosModel->selectFotos()
          ); 
        $this->load->view('layouts/Administrador/header_admin');
        $this->load->view('layouts/Administrador/body');		
        $this->load->view('layouts/Administrador/nav_admin');
        $this->load->view('layouts/Fotos/fotos', $datos);
        $this->load->view('layouts/Administrador/footer_admin');
	}	
//insertar y update foto
    public function setFotos(){
        if ($this->input->is_ajax_request()) {           
 
			if(empty($this->input->post("txtDescripcion"))){
				$resultado = (array('status' => false, 'msg' =>'Datos incorrectos.'));
			}else{
						
				$idFotos =intval($this->input->post("idFotos"));							
				$descripcion = $this->input->post("txtDescripcion");						
		               
				$foto        = $_FILES['foto'];
				$nombre_foto = $foto['name'];
				$type        = $foto['type'];
				$url_temp    = $foto['tmp_name'];						
				$imgPortada  = 'portada_Fotos.png';
				
				if($nombre_foto != ""){
			     	$imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
				}
				if($idFotos == 0)
				{ 	
						//Crear
							$respuesta = $this->FotosModel->InsertFotos($descripcion,$imgPortada); 
							$option = 1;	
							 						
				}else
					{
						//update
						if($nombre_foto == ""){
							if($this->input->post("foto_actual") != 'portada_Fotos.png' && $this->input->post("foto_remove") == 0){
								$imgPortada = $this->input->post("foto_actual");
							};
						}
						$respuesta = $this->FotosModel->updateFotos($idFotos,$descripcion,$imgPortada); 
						$option = 2;					
				}	
				if($respuesta > 0){
						if($option == 1){
							$resultado = (array('status'=>true,'post' =>'Foto guardado con exito.'));	
							if($nombre_foto != ""){
								$this->Helpers->uploadImage($foto,$imgPortada);					
							}
						}else{
							
							$resultado = (array('status'=>true,'post' =>'Categoría Actualizados con exito.'));
							if($nombre_foto != "" ){
								$this->Helpers->uploadImage($foto,$imgPortada);
							}
							if(($nombre_foto == "" && $this->input->post("foto_remove") == 1 && $this->input->post("foto_actual") != 'portada_Fotos.php')
							|| ($nombre_foto != "" && $this->input->post("foto_actual") != 'portada_Fotos.png')){
								//eliminamos la foto que esta en la carpeta uploads para reemplazarla
								$this->Helpers->deleteFile(	$this->input->post("foto_actual"));
							}
                           
						}
				}else{
						$resultado = (array('status'=>false,'msg' =>'No es posible almacenar los datos.'));

				}		
				
			}	
		
			echo json_encode($resultado,JSON_UNESCAPED_UNICODE);		
        } else {
			redirect('error');						
	    }
		die();	
    }

    //editar o ver Fotos
	public function getFotos(int $idFotos)
    {        
		if ($this->input->is_ajax_request()) {

			$Fotos = $this->db->escape($idFotos);
			if($_SESSION['permisosMod']->r){ 
				if($Fotos > 0){
					
					$datos = $this->FotosModel->editFotos($Fotos);
					
					if(empty($datos))
					{
						$resultado = (array('status'=>false,'msg' =>'Datos no encontrado'));					
					}
					else
					{							
						$datos->url_portada = base_url().'assets/Template/Admin/images/uploads/'.$datos->img;
						$resultado = (array('status'=>true,'post' =>$datos));	
							
					}
			
					echo json_encode($resultado,JSON_UNESCAPED_UNICODE);
				}
			}
		}
		else{
			redirect('error');	
		}
		die();		
	
	}

		//eliminar fotos
	public function deleteFoto(){

		if ($this->input->is_ajax_request()) {
					  
			if($_SESSION['permisosMod']->d){   
					
				$idFotos = $this->input->post('idFotos');	 
				$result = $this->FotosModel->delete($idFotos );
	           
					if($result == true){
	
						$resultado = (array('status'=>true,'post' =>'Se ha eliminado la foto'));	
					}
					else{
						$resultado = (array('status'=>false,'msg' =>'Error al eliminar la foto'));
					}; 
				} 	
				echo json_encode($resultado ,JSON_UNESCAPED_UNICODE);	
								
			}else {
			 redirect('error');						
		}			 		
			die();	   
	}

}
