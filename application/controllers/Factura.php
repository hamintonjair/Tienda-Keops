<?php 
defined('BASEPATH') OR exit('No direct script access allowed');   

       require(APPPATH.'libraries/html2pdf/vendor/autoload.php');
       use Spipu\Html2Pdf\Html2Pdf;

	class Factura extends CI_Controller{
		public function __construct()
		{
			parent::__construct();
			session_start();          
            $this->load->model("FacturaModel");   
            $this->load->model("Helpers");      
          
			if(empty($_SESSION['login']))
			{
				echo '<script>window.location.href="http://localhost/sitio-keops/login"</script>';		
			}
            $this->Helpers->getPermisos(MPEDIDOS);
		}
      //generar factura
		public function generarFactura($idpedido)
		{		
            if($_SESSION['permisosMod']->r){
				if(is_numeric($idpedido)){
					$idpersona = "";
					if($_SESSION['permisosMod']->r && $_SESSION['userData']->idrol == RCLIENTES){
						$idpersona = $_SESSION['userData']->idpersona;                     
					}
					$data = array(
                        'pedido' => $this->FacturaModel->selectPedido($idpedido,$idpersona),
                    );
                    $pedido = $data['pedido'];  
					if(empty($pedido)){
						echo "Datos no encontrados";
					}else{                   
            
                         $orden =  $pedido['orden'];  
                                   
                        for($i=0; $i < count($orden ); $i++){
                            $idpedido = $orden[$i]->idpedido;
                        }   
                            
						$html = $this->Helpers->getFile("layouts/Modal/comprobantePDF",$data);  
                                     
						$html2pdf = new Html2Pdf('p','A4','es','true','UTF-8');
						$html2pdf->writeHTML($html);
                                       
                        if((ob_end_clean())){
                          
                            while (ob_get_level() > 0) {
                                    ob_end_flush();
                                
                            }                          
                        };
						$html2pdf->output('factura #-'.$idpedido.'.pdf');                     
            
					}
				}else{
					echo "Dato no válido";
				}
			}else{
				echo '<script>window.location.href="http://localhost/sitio-keops/login"</script>';	
				die();
			}
		}

	}

