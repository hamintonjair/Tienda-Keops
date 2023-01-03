<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursales extends CI_Controller {

	function __construct(){
        parent:: __construct();
        session_start();
        $this->load->model("TcategoriaModel"); 
        $this->load->model("Helpers"); 

        $this->Helpers->getPermisos(MDPAGINAS);
    }
    
    //sucursales
    public function Sucursales()
    {	
        $footer = $this->TcategoriaModel->getCategoriasT(CAT_FOOTER);
        $catFotter = $this->Helpers->getCatFooter();
        $pageContent = $this->Helpers->getPageRout('sucursales');

        if(empty($pageContent)){
            echo '<script>window.location.href="http://localhost/sitio-keops/"</script>';			
        }else{
            $sucursales['sucursales'] =  $pageContent ;

            $this->load->view('layouts/Principal/header');
            $this->load->view('layouts/Principal/Carrito/modalCarrito');	
            $this->load->view('layouts/Principal/Sucursales/sucursales', $sucursales);
            $this->load->view('layouts/Principal/footer',compact('catFotter','footer'));	
        }	
    }	
}
