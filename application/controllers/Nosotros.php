<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nosotros extends CI_Controller {

	function __construct(){
        parent:: __construct();
        session_start();
        $this->load->model("TcategoriaModel"); 
        $this->load->model("FotosModel"); 
        $this->load->model("Helpers"); 

        $this->Helpers->getPermisos(MDPAGINAS);
    }
     //acerca de
    public function Mas( $pagina = null)
    {	        
        // $pagina =  1;	
        $pagina = is_numeric($pagina) ? $pagina : 1;	

        
		$cantFotos = $this->FotosModel->cantFotos();
		$total_registro = $cantFotos[0]->total_registro;

		$desde = ($pagina-1) * PROPORPAGINA;
		$total_paginas = ceil($total_registro / PROPORPAGINA);	
		$productos = $this->FotosModel->getFotosPage($desde,PROPORPAGINA);

		$categoria = $this->TcategoriaModel->getCategorias();
		$banner = $this->TcategoriaModel->getCategoriasT(CAT_BANNERSEVICIOS);
		$pagina = array(
			     'pagina'=>$pagina,
			     'total_paginas'=>$total_paginas,
		   );


        $footer = $this->TcategoriaModel->getCategoriasT(CAT_FOOTER);
        $catFotter = $this->Helpers->getCatFooter();
        $nosotros = $this->Helpers->getPageRout('nosotros');

        if(empty($nosotros)){

            echo '<script>window.location.href="http://localhost/sitio-keops"</script>';				

        }else{
            // $nosotros['nosotros'] =  $pageContent ;

            $this->load->view('layouts/Principal/header');
            $this->load->view('layouts/Principal/Carrito/modalCarrito');	
            $this->load->view('layouts/Principal/Nosotros/nosotros', compact('productos', 'nosotros', 'pagina'));
            $this->load->view('layouts/Principal/footer',compact('catFotter','footer'));	
        }	
    }	
}