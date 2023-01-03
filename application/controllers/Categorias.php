<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {
    function __construct()
	{

        // metodo contructor para llamar el model
        parent::__construct();
		session_start();
        session_regenerate_id(true);

        if(empty($_SESSION['login']))
        {
           echo '<script>window.location.href="http://localhost/sitio-keops/login"</script>';				
        }
        $this->load->model("RolesModel");	
        $this->load->model("CategoriasModel");
        $this->load->model("Helpers"); 
		       
		$this->Helpers->getPermisos(MCATEGORIAS); 	
	}	
    //ver categorias
    public function VerCategorias()
      {  
          if (empty($_SESSION['permisosMod']->r)){
              echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';	
          }    
		  $datos = array(            
              'categoria'=>$this->CategoriasModel->listarCategorias()
            ); 
          $this->load->view('layouts/Administrador/header_admin');
          $this->load->view('layouts/Administrador/body');		
          $this->load->view('layouts/Administrador/nav_admin');
          $this->load->view('layouts/Categoria/categorias', $datos);
          $this->load->view('layouts/Administrador/footer_admin');
    }

    /**insert categorias */
	public function setCategoria()
    {		
        if ($this->input->is_ajax_request()) {           
 
			if(empty($this->input->post("txtNombre"))|| empty($this->input->post("txtDescripcion"))
			|| empty($this->input->post("listStatus")) || $status = $this->input->post("listStatus") == "Seleccionar.."){

				$resultado = (array('status' => false, 'msg' =>'Datos incorrectos.'));
			}else{
						
				$idCategoria =intval($this->input->post("idCategoria"));						
				$categoria = $this->input->post("txtNombre");
				$descripcion = $this->input->post("txtDescripcion");
				$status = intval($this->input->post("listStatus"));					
		    	$ruta =$this->Helpers->clear_cadena($categoria );
				$ruta = str_replace(" " , "-",$ruta);	
				$foto        = $_FILES['foto'];
				$nombre_foto = $foto['name'];
				$type        = $foto['type'];
				$url_temp    = $foto['tmp_name'];						
				$imgPortada  = 'portada_categoria.png';

				$respuesta = $this->CategoriasModel->ValidarCategorias($categoria);  
			
				if($nombre_foto != ""){
			     	$imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
				}
				if($idCategoria == 0)
				{ 	
						if($respuesta > 0)
						{
							$resultado = (array('status'=>false,'msg' =>'¡Atención! El nombre de la categoría ya existe.'));				
						}else{
								//Crear
							$respuesta = $this->CategoriasModel->InsertCategorias($categoria,$descripcion,$imgPortada,	$ruta,$status); 
							$option = 1;	
						}		 						
				}else
					{
						//update
						if($nombre_foto == ""){
							if($this->input->post("foto_actual") != 'portada_categoria.png' && $this->input->post("foto_remove") == 0){
								$imgPortada = $this->input->post("foto_actual");
							};
						}
						$respuesta = $this->CategoriasModel->updateCategoria($idCategoria,$categoria,$descripcion,$imgPortada,	$ruta,$status); 
						$option = 2;					
				}	
				if($respuesta > 0){
						if($option == 1){
							$resultado = (array('status'=>true,'post' =>'Categoría guardado con exito.'));	
							if($nombre_foto != ""){
								$this->Helpers->uploadImage($foto,$imgPortada);					
							}
						}else{
							
							$resultado = (array('status'=>true,'post' =>'Categoría Actualizados con exito.'));
							if($nombre_foto != "" ){
								$this->Helpers->uploadImage($foto,$imgPortada);
							}
							if(($nombre_foto == "" && $this->input->post("foto_remove") == 1 && $this->input->post("foto_actual") != 'portada_categoria.php')
							|| ($nombre_foto != "" && $this->input->post("foto_actual") != 'portada_categoria.png')){
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
	//editar o ver categoria
	public function getCategorias(int $idcategoria)
    {        
		if ($this->input->is_ajax_request()) {

			$categoria = $this->db->escape($idcategoria);
			if($_SESSION['permisosMod']->r){ 
				if($categoria > 0){
					
					$datos = $this->CategoriasModel->editCategoria($categoria);
					
					if(empty($datos))
					{
						$resultado = (array('status'=>false,'msg' =>'Datos no encontrado'));					
					}
					else
					{							
						$datos->url_portada = base_url().'assets/Template/Admin/images/uploads/'.$datos->portada;
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
	//eliminar categoría
	public function deleteCategoria(){

		if ($this->input->is_ajax_request()) {
      			
			if($_SESSION['permisosMod']->d){   
				
				 $intIdCategoria = $this->input->post('id_delete');
			
			   /**validamos en la tabla relacionada con la de rol, si exiaste registro con el id del rol no se eliminara */
				$respuesta = $this->CategoriasModel->ValidarDelete($intIdCategoria);

				if($respuesta > 0 )
				{
					$resultado = (array('status'=>false,'msg' =>'No es posible eliminar una categoría con productos asociados'));						
				}			
				else{
					  $result = $this->CategoriasModel->delete($intIdCategoria );

					if($result == true){

						$resultado = (array('status'=>true,'post' =>'Se ha eliminado la categoría'));	
					}
					else{
						$resultado = (array('status'=>false,'msg' =>'Error al eliminar la categoría'));
					}; 
				} 	
				echo json_encode($resultado ,JSON_UNESCAPED_UNICODE);	
			}		
			
		  }else {
		 redirect('error');						
		}			 		
		die();	   
	}
	public function getSelectCategorias(){

		if ($this->input->is_ajax_request())
		{         		
			$datos = $this->CategoriasModel->listarCategorias();
				if(!empty($datos)){
					for($i=0; $i < count($datos); $i++){
						if($datos[$i]->status == 1){
							$respuesta = array('status' => true, 'post' => $datos);
						}else{
							$respuesta = array('status' => false, 'msg' => 'Datos no encontrados');
						}
					}
				}
				
			echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
	  } else{
        redirect('error');						
      } 
		die();
	}
} 