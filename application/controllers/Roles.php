<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

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
		$this->load->model("Helpers");
		$this->Helpers->getPermisos(MUSUARIOS);     
	}		
 	/**vista rol */
	public function Rol()
	{				
		// guardamos la consulta en la variable $rol, y los datos son traido del modelo
		
		if (empty($_SESSION['permisosMod']->r)){
				echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';	
		} 
		 $datos = array(
		      'rol'=>$this->RolesModel->listarRoles()
	    	);  

		$this->load->view('layouts/Administrador/header_admin');		
		$this->load->view('layouts/Administrador/body');
		$this->load->view('layouts/Administrador/nav_admin');
		$this->load->view('layouts/Rol/roles', $datos);
		$this->load->view('layouts/Administrador/footer_admin');
	}	
	/**insert rol */
	public function InsertRol()
    {
        if ($this->input->is_ajax_request()) {

			if($_SESSION['permisosMod']->w){    
				$nombrerol = $this->input->post("strNombre");
				$descripcion = $this->input->post("strDescripcion");
				$status = $this->input->post("intStatus");
				$respuesta = $this->RolesModel->ValidarRoles($nombrerol);  

			
				if($status == "Seleccionar.."){
					$resultado = array('status' => false, 'msg' => 'El campo estado es obligatorio.'); 
				}else if($respuesta > 0)
				{
					$resultado = (array('status'=>false,'msg' =>'Ya existe un Rol con este nombre.'));						
				}			
				else
				{	
				
					$datos = array(
									"idrol"       => '',
									"nombrerol"   => $nombrerol,
									"descripcion" => $descripcion,
									"status"      => $status,
									);
					if(empty($this->RolesModel->insertRol($datos) == true)){
						$resultado = (array('status'=>true,'post' =>'Rol agregado con exito.'));	
					}else{
						$resultado = (array('status'=>false,'post' =>'No se pudo agregar el rol.'));	
					};  		
					
				}	
				echo json_encode($resultado,JSON_UNESCAPED_UNICODE);	
			}	
			// redirect('roles');	
        } else {
			redirect('error');						
	    }					
		die();	
	}
	/**editar rol */
	public function editarRol(int $idrol)
	{
		if ($this->input->is_ajax_request()) {

			$intIdrol = $this->db->escape($idrol);
			if($_SESSION['permisosMod']->u){ 
				if($intIdrol > 0)
				{
					$datos = $this->RolesModel->editar($intIdrol);

					
					if(empty($datos))
					{
						$resultado = (array('status'=>false,'msg' =>'Datos no encontrado'));					
					}
					else
					{
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
		/**update rol */
	public function updateRol()
    {
        if ($this->input->is_ajax_request()) {
			
			if($_SESSION['permisosMod']->w){   
				$intIdRol = $this->input->post("actualizar_id");
				$nombrerol =$this->Helpers->strClean($this->input->post("actualizar_nombre"));
				$descripcion =$this->Helpers->strClean($this->input->post("actualizar_descripcion"));
				$status = $this->input->post("actualizar_status");		 
		
					$datos = array(
									"idrol"       => $intIdRol ,
									"nombrerol"   => $nombrerol,
									"descripcion" => $descripcion,
									"status"      => $status,
								);
					if($this->RolesModel->updateRol($datos)){
						$resultado = (array('status'=>true,'post' =>'Rol Actualizado con exito'));	
					}
					else{
						$resultado = (array('status'=>false,'msg' =>'Error no se pudieron actualizar los datos'));
					};  
				echo json_encode($resultado,JSON_UNESCAPED_UNICODE);
		 	}		
        }else {
			redirect('error');						
	    }
			
			die();	
	}
		/**delete rol */
	public function deleteRole()
    {
        if ($this->input->is_ajax_request()) {

			if($_SESSION['permisosMod']->d){   

				$intIdRol = $this->input->post('id_delete');
				$datos = array(	'idrol' => $intIdRol );
			/**validamos en la tabla relacionada con la de rol, si exiaste registro con el id del rol no se eliminara */
				$respuesta = $this->RolesModel->ValidarDelete($intIdRol);

				if($respuesta > 0 )
				{
					$resultado = (array('status'=>false,'msg' =>'No es posible eliminar un Rol asociado a usuarios'));						
				}			
				else{
					$resultado = $this->RolesModel->delete($datos);
					
					if(empty($resultado)){

						$resultado = (array('status'=>true,'post' =>'Se ha eliminado el Rol'));	
					}
					else{
						$resultado = (array('status'=>false,'msg' =>'Error al eliminar el Rol'));
					}; 
				} 	
					echo json_encode($resultado ,JSON_UNESCAPED_UNICODE);	
			}

        }else {
			redirect('error');						
	    }					
	    die();	   
    }	   
}

