<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos extends CI_Controller {

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
		$this->load->model("PermisosModel");
		$this->load->model("ConfiguracionModel");
	
	}		
	/**vista para añadir los permisos */
	public function PermisosAdd( $idrol="")
	{			
		$data = array( 
			    'permisos' => $this->PermisosModel->permisoRol($idrol),
                'rol' => $this->RolesModel->getRoles(),
				'modulo' => $this->PermisosModel->getModulos(),
				'empresa' => $this->ConfiguracionModel->getEmpresa(),
		);		
	
		$this->load->view('layouts/Administrador/header_admin');		
		$this->load->view('layouts/Administrador/body');
		$this->load->view('layouts/Administrador/nav_admin');
		$this->load->view('layouts/Rol/addPermisos',$data );
		$this->load->view('layouts/Administrador/footer_admin');
	}
	//Buscar permisos asignados
	public function BuscarPermisos(){

	       $modulo = $this->input->post('modulo');
		   $rol = $this->input->post('rol');							
	
			//condicion para validar que solo se este enviando el idmodulo y rol para poder hacer la consulta de busqueda
		   if(!empty($modulo) || !empty($rol))	 
			{  			
				$data = array( 			  		  			
					'rol' => $this->RolesModel->getRoles(),
					'modulo' => $this->PermisosModel->getModulos(),
					'permisos' => $this->PermisosModel->SelectPermisosRol($rol,$modulo),			  
			      );		
		
				$this->load->view('layouts/Administrador/header_admin');		
				$this->load->view('layouts/Administrador/body');
				$this->load->view('layouts/Administrador/nav_admin');
				$this->load->view('layouts/Rol/addPermisos',$data);		
				$this->load->view('layouts/Administrador/footer_admin');	  		
			
	    }
	}
	//add los permisos a los roles
	public function store()
	{	
        if ($this->input->is_ajax_request()) {
					
			$idmodulo = $this->input->post('modulo');
			$idrol = $this->input->post('idrol');	
		
			$r = $this->input->post('r');
			$w = $this->input->post('w');
			$u = $this->input->post('u');
			$d = $this->input->post('d');

			$datos = $this->PermisosModel->ValidarPermisos($idrol,$idmodulo);
			
			if($datos == true){
				
			   //condición para asignarle los permisos a los roles de usuarios				
				$resultado = (array('status'=>false,'msg' =>'Este Rol ya tiene un permiso asignado a este módulo'));						
			}
			else	
         	{			   
				$data = array(
						"moduloid" => $idmodulo,
						"rolid" => $idrol,
						"r" => $r,
						"w" => $w,
						"u" => $u,
						"d" => $d
						);

					if($this->PermisosModel->guardarPermisos($data)==true)
						{		
							$resultado = (array('status'=>true,'post' =>'Permiso agregado con exito'));				
										
						}	
					else{
							$resultado = (array('status'=>false,'post' =>'Error al agregar el permiso'));		
						}							
					
			}	
			
			echo json_encode($resultado,JSON_UNESCAPED_UNICODE);	
		} else {
			redirect('error');						
	    }		
		die();			
	}

	/**se actualiza los datos d ela vista */
	public function actualizar()
	{	
		if ($this->input->is_ajax_request()) {
			
			$idmodulo = $this->input->post('modulo');	
			$idrol = $this->input->post('idrol');

			$r = $this->input->post('read');
			$w = $this->input->post('write');
			$u = $this->input->post('update');
			$d = $this->input->post('delete');   
		
		
			if($this->PermisosModel->update($idrol,$idmodulo,$r,$w,$u,$d) == true)
			{		
				$resultado = (array('status'=>true,'post' =>'El permiso fue actualizados'));				
			}
			else
			{
				$resultado = (array('status'=>false,'post' =>'No se pudo actulizar el permiso'));		
			}

		   echo json_encode($resultado,JSON_UNESCAPED_UNICODE);

		} else {
			redirect('error');						
	    }		
		die();		
	}

	public function rol_especificos($idpermisos)
	{	
		 $data = array( 
			'permisos' => $this->PermisosModel->permisosRolEspecificos( $idpermisos),
		);		
		$this->load->view('layouts/Administrador/header_admin');		
		$this->load->view('layouts/Administrador/body');
		$this->load->view('layouts/Administrador/nav_admin');
		$this->load->view('layouts/Rol/permisosEspecificos',$data);
		$this->load->view('layouts/Administrador/footer_admin');
	
	}	
}

