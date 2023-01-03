<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_Controller {

    function __construct(){

        parent::__construct();
        session_start();
        $this->load->model("Helpers"); 
        $this->load->model("TproductosModel");   
        $this->load->model("TcategoriaModel");
        $this->Helpers->getPermisos(MDPAGINAS);
    }
	public function Services()
	{	
        $pagina =  1;		
		$cantProductos = $this->TproductosModel->cantServicios();
		$total_registro = $cantProductos[0]->total_registro;

		$desde = ($pagina-1) * PROPORPAGINA;
		$total_paginas = ceil($total_registro / PROPORPAGINA);	
		$productos = $this->TproductosModel->getServiciosPage($desde,PROPORPAGINA);
		$categoria = $this->TcategoriaModel->getCategorias();

		$banner = $this->TcategoriaModel->getCategoriasT(CAT_BANNERSEVICIOS);
		$pagina = array(
			     'pagina'=>$pagina,
			     'total_paginas'=>$total_paginas,
		   );

		$this->load->view('layouts/Principal/header');
		$this->load->view('layouts/Principal/Carrito/modalCarrito');	
        $this->load->view('layouts/Principal/Servicios/banner_servicios', compact('banner'));	
		$this->load->view('layouts/Principal/Servicios/services', compact('productos','pagina','categoria'));
		$this->load->view('layouts/Principal/footer');
	}	


}
