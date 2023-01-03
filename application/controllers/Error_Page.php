<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_Page extends CI_Controller {

	public function __construct()
    { 	
	  parent:: __construct();
	  $this->load->model("Helpers"); 
    }

    public function Error_page()	{	
		
		$pageContent = $this->Helpers->getPageRout('not-found');

		if(empty($pageContent)){
				echo '<script>window.location.href="http://localhost/sitio-keops/"</script>';		
		}else{

			$data['page'] = $pageContent;
			$this->load->view('layouts/Principal/header');		
			$this->load->view('layouts/Error/error',$data);
			$this->load->view('layouts/Principal/footer');
		}		

	}
}