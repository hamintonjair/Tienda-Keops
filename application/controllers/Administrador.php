<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Administrador extends CI_Controller 
{	
	public function __construct()
    {
	
	  parent:: __construct();	 
	  
	   session_start();		 
	  if(empty($_SESSION['login']))
	  {
		echo '<script>window.location.href="http://localhost/sitio-keops/login"</script>';				
	  }		
	   $this->load->model('DashboardModel');
	  $this->load->model("Helpers");
	  $this->Helpers->getPermisos(MDASHBOARD);   

    }

	public function Dashboard()
	{	
		// $data['page_id'] = 2;
		
			$anio = date('Y');
			$mes = date('m');
			$data = array(
				 'page_functions_js' => "functions_dashboard.js",
				 'usuarios'  => $this->DashboardModel->cantUsuarios(),
				 'clientes'  => $this->DashboardModel->cantClientes(),
				 'productos' => $this->DashboardModel->cantProductos(),
				 'pedidos'   => $this->DashboardModel->cantPedidos(),
				 'lastOrders'=> $this->DashboardModel->lastOrders(),		
				
				 'productosTen' => $this->DashboardModel->productosTen(),				
			  );

			$pagosMes = array(
				'pagosMes'   => $this->DashboardModel->selectPagosMes($anio,$mes),
				'ventasMDia' => $this->DashboardModel->selectVentasMes($anio,$mes),
				'ventasAnio' => $this->DashboardModel->selectVentasAnio($anio),
			);	
			
    
		$this->load->view('layouts/Administrador/header_admin');		
		$this->load->view('layouts/Administrador/body');
		$this->load->view('layouts/Administrador/nav_admin');

		//dep($data['ventasAnio']);exit;
		if( $_SESSION['userData']->idrol == RCLIENTES ){	
			
			$this->load->view('layouts/Administrador/dashboardCliente',$data);	
		}else{			
		     $this->load->view('layouts/Administrador/dashboard',$data);	
		}		
		$this->load->view('layouts/Administrador/footer_admin',$pagosMes );
			
	}
    //seleccionar tipo d epagos por mes
	public function tipoPagoMes(){

		if($_POST){
			// $grafica = "tipoPagoMes";
			$nFecha = str_replace(" ","",$this->input->post('fecha'));			
			$arrFecha = explode('-',$nFecha);
			$mes = $arrFecha[0];
			$anio = $arrFecha[1];					
			$pagos = array(
				'pagosMes'   => $this->DashboardModel->selectPagosMes($anio,$mes),
				'grafica' =>"tipoPagoMes",			
			);	
					
			$script = $this->Helpers->getFile("layouts/Modal/graficas",$pagos);		
			echo $script;
			die();
		}
	}
	//ventas por dia
	public function ventasMes(){
		if($_POST){
		
			$nFecha = str_replace(" ","",$this->input->post('fecha'));
			$arrFecha = explode('-',$nFecha);
			$mes = $arrFecha[0];
			$anio = $arrFecha[1];
			$pagos = array(
				'ventasMDia' => $this->DashboardModel->selectVentasMes($anio,$mes),
				'grafica' =>"ventasMes",			
			);			
			$script =  $this->Helpers->getFile("layouts/Modal/graficas",$pagos);
			echo $script;
			die();
		}
	}
	//pagos por años
	public function ventasAnio(){
		if($_POST){
			
			$anio = intval($this->input->post('anio'));
			$pagos = array(
				'ventasAnio' => $this->DashboardModel->selectVentasAnio($anio),
				'grafica' =>"ventasAnio",			
			);	
			$script =  $this->Helpers->getFile("layouts/Modal/graficas",$pagos);
			echo $script;
			die();
		}
	}
}