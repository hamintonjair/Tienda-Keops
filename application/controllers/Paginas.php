<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Paginas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        
		session_start();
		if(empty($_SESSION['login']))
		{
            echo '<script>window.location.href="http://localhost/sitio-keops/login"</script>';	
		}
        $this->load->model("Helpers"); 
        $this->load->model("PaginasModel");
		$this->Helpers->getPermisos(MDPAGINAS);
	}
    //ver paginas
	public function Paginas()
	{
		if(empty($_SESSION['permisosMod']->r)){
            echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';	
		}        
		
        $this->load->view('layouts/Administrador/header_admin');		
        $this->load->view('layouts/Administrador/body');
        $this->load->view('layouts/Administrador/nav_admin');
        $this->load->view('layouts/Paginas/paginas');
        $this->load->view('layouts/Administrador/footer_admin' );	

	}
     //editar pagina
	public function editar($idpost){

		if(empty($_SESSION['permisosMod']->u)){

            echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';	
		}
		$idpost = intval($idpost);

		if($idpost > 0){

			$infoPage = $this->Helpers->getInfoPage($idpost);
          
			if(empty($infoPage)){
                echo '<script>window.location.href="http://localhost/sitio-keops/paginas"</script>';			
			}else{
				$data['infoPage'] = $infoPage;            
			}
            $this->load->view('layouts/Administrador/header_admin');		
            $this->load->view('layouts/Administrador/body');
            $this->load->view('layouts/Administrador/nav_admin');
            $this->load->view('layouts/Paginas/editar_paginas',$data);
            $this->load->view('layouts/Administrador/footer_admin' );	    
	
		}else{
            echo '<script>window.location.href="http://localhost/sitio-keops/paginas"</script>';		
		}

	}
    //crear páginas
	public function crear(){

		if(empty($_SESSION['permisosMod']->w)){
            echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';	
		}

        $this->load->view('layouts/Administrador/header_admin');		
        $this->load->view('layouts/Administrador/body');
        $this->load->view('layouts/Administrador/nav_admin');
        $this->load->view('layouts/Paginas/crear_pagina');
        $this->load->view('layouts/Administrador/footer_admin' );
       
	}

	public function getPaginas(){

		if($_SESSION['permisosMod']->r){
			$arrData = $this->PaginasModel->selectPaginas();
			
			for ($i=0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				$urlPage = base_url()."".$arrData[$i]->ruta;

				if($arrData[$i]->status == 1)
					{
						$arrData[$i]->status = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]->status = '<span class="badge badge-danger">Inactivo</span>';
					}

				if($_SESSION['permisosMod']->r){
					$btnView = '<a title="Ver página" href="'.$urlPage.'" target="_balnck" class="btn btn-info btn-sm"> <i class="far fa-eye"></i></a>'; 
				}
				if($_SESSION['permisosMod']->u){
					$btnEdit = '<a title="Editar página" href="'.base_url().'paginas/editar/'.$arrData[$i]->idpost.'" class="btn btn-primary btn-sm"> <i class="fas fa-pencil-alt"></i></a>';
				}
				// if($_SESSION['permisosMod']->d){	
				// 	$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]->idpost.')" title="Eliminar página"><i class="far fa-trash-alt"></i></button>';
				// }
				$arrData[$i]->options = '<div class="text-center">'.$btnView.' '.$btnEdit.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
    //insertar y actualizar pagina
	public function setPagina(){
		if($this->input->is_ajax_request()){
			
			//dep($_FILES);
			if(empty($this->input->post('txtTitulo')) || empty($this->input->post('txtContenido')) || empty($this->input->post('listStatus')))
			{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			}else{
				$intIdPost = empty($this->input->post('idPost')) ? 0 : intval($this->input->post('idPost'));
				$strTitulo =  $this->Helpers->strClean($this->input->post('txtTitulo'));
				$strContenido = $this->Helpers->strClean($this->input->post('txtContenido'));
				$intStatus = intval($this->input->post('listStatus'));
				$ruta = strtolower($this->Helpers->clear_cadena($strTitulo));
				$ruta = str_replace(" ","-",$ruta);

				$foto   	 	= $_FILES['foto'];
				$nombre_foto 	= $foto['name'];
				$type 		 	= $foto['type'];
				$url_temp    	= $foto['tmp_name'];
				$imgPortada 	= '';
				$request = "";
				if($nombre_foto != ''){
					$imgPortada = 'img_'.md5(date('d-m-Y H:i:s')).'.jpg';
				}

				if($intIdPost == 0)
				{
					//Crear
					$option = 1;
					$request = $this->PaginasModel->insertPost($strTitulo, 
														$strContenido,
														$imgPortada, 
														$ruta,
														$intStatus);
				}else{
					//Actualizar
					if($_SESSION['permisosMod']->u){
						if($nombre_foto == ''){
							if($this->input->post('foto_actual') != '' AND $this->input->post('foto_remove') == 0 ){
								$imgPortada = $this->input->post('foto_actual');
							}
						}
						$request = $this->PaginasModel->updatePost($intIdPost,$strTitulo, $strContenido,$imgPortada,$intStatus);
						$option = 2;
					}
				}          
				if($request)
				{
					if($option == 1){
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						if($nombre_foto != ''){$this->Helpers->uploadImage($foto,$imgPortada); }
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');

						if($nombre_foto != ''){ $this->Helpers->uploadImage($foto,$imgPortada); }

						if(($nombre_foto == '' AND $this->input->post('foto_remove') == 1 AND $this->input->post('foto_actual') != '')
							|| ($nombre_foto != '' AND $this->input->post('foto_actual') != '')){
                                $this->Helpers->deleteFile($this->input->post('foto_actual'));
						}
					}
				}else if($request == 0){
					$arrResponse = array('status' => false, 'msg' => 'La página ya existe.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}else{
			redirect('error');	
		}

		die();
	}

	//eliminar página
	public function delPagina(){

		if($_POST){
			if($_SESSION['permisosMod']->d){
				$intIdpagina = intval($this->input->post('idPagina'));

				$requestDelete = $this->PaginasModel->deletePagina($intIdpagina);
				if($requestDelete){
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la página.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la página.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

}

 ?>