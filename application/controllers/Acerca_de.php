<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_Controller {

	public function Service()
	{	
		$this->load->view('layouts/Principal/header');
		$this->load->view('layouts/Principal/Carrito/modalCarrito');	
		$this->load->view('layouts/Principal/Acerca_de/acerca_de');
		$this->load->view('layouts/Principal/footer');
	}	


}
