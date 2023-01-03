<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto extends CI_Controller {

   function __construct(){

	  parent::__construct();
	  session_start();
	  $this->load->model("Helpers"); 
	  $this->Helpers->getPermisos(MDPAGINAS);
   }
	public function Contact()
	{	
	    $pageContent = $this->Helpers->getPageRout('contacto');
        if(empty($pageContent)){
            echo '<script>window.location.href="http://localhost/sitio-keops/"</script>';				

        }else{
			$contactos['contactos'] =  $pageContent ;
	
			$this->load->view('layouts/Principal/header');
			$this->load->view('layouts/Principal/Carrito/modalCarrito');	
			$this->load->view('layouts/Principal/Contacto/contact',$contactos);
			$this->load->view('layouts/Principal/footer');
		}
	}		
}
