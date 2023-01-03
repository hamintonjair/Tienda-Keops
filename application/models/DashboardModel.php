<?php
//extends para heredar
   defined('BASEPATH') OR exit('No direct script access allowed');
	class DashboardModel extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
            $this->load->model("Helpers");
		}
         //cantidad de usuarios activos
		public function cantUsuarios(){

            $this->db->select('COUNT(*) as total');		
            $this->db->from('persona');
            $this->db->where('status != 0');
            $request = $this->db->get()->result();

            for($i=0; $i < count($request); $i++){
                $total = $request[$i]->total;
            }	
			return $total;
		}
		//cantidad de clientes activos
		public function cantClientes(){

            $this->db->select('COUNT(*) as total');		
            $this->db->from('persona');
            $this->db->where('status != 0');
            $this->db->where('rolid ', RCLIENTES);
            $request = $this->db->get()->result();

            for($i=0; $i < count($request); $i++){
                $total = $request[$i]->total;
            }	         
			return $total;
		}
		//cantidad de productos activos
		public function cantProductos(){

            $this->db->select('COUNT(*) as total');		
            $this->db->from('producto');
            $this->db->where('status != 0');        
            $request = $this->db->get()->result();

            for($i=0; $i < count($request); $i++){
                $total = $request[$i]->total;
            }	
			return $total;
		}
		//cantidad de pedidos por tipo de clientes
		public function cantPedidos(){
           
			$rolid = $_SESSION['userData']->idrol;
			$idUser = $_SESSION['userData']->idpersona;
			$where = "";
		
			if($rolid == RCLIENTES ){
                $where =   $this->db->where('personaid',$idUser);     
			
			}
            $this->db->select('COUNT(*) as total');		
            $this->db->from('pedido');
            $where ;  

            $request = $this->db->get()->result();
            for($i=0; $i < count($request); $i++){
                $total = $request[$i]->total;
            }	
            return $total;
		}
		//seleccionar pedidos y ordenarlos
		public function lastOrders(){

			$rolid = $_SESSION['userData']->idrol;
			$idUser = $_SESSION['userData']->idpersona;
			$where = "";
			if($rolid == RCLIENTES ){
                $where =   $this->db->where('p.personaid',$idUser);   
			}
            $this->db->select('p.idpedido,  CONCAT(pr.nombres," ",pr.apellidos) as nombre,p.monto, p.status');		
            $this->db->from('pedido p');
            $this->db->join('persona pr','p.personaid = pr.idpersona');
            $where;
            $this->db->order_by(' p.idpedido DESC');       
            $this->db->LIMIT(10);  
            $request = $this->db->get()->result();    
		
			return $request;
		}	
		//pagos por meses
		public function selectPagosMes($anio, $mes){
		
            $this->db->select('p.tipopagoid, tp.tipopago, COUNT(p.tipopagoid) as cantidad, SUM(p.monto) as total');		
            $this->db->from('pedido p');
            $this->db->join('tipopago tp','p.tipopagoid = tp.idtipopago ');
            $this->db->where('MONTH(p.fecha)', $mes);
            $this->db->where('YEAR(p.fecha)', $anio);
            $this->db->group_by('tipopagoid'); 

            $pagos = $this->db->get()->result(); 
		
			$meses = $this->Helpers->Meses();
			$arrData = array('anio' => $anio, 'mes' => $meses[intval($mes-1)], 'tipospago' => $pagos );  

			return $arrData;
		}
		//ventas diarias por año y meses
		public function selectVentasMes($anio, $mes){
			$rolid = $_SESSION['userData']->idrol;
			$idUser = $_SESSION['userData']->idpersona;
			
			// $where = "";
			// if($rolid == RCLIENTES ){
            //     $where =   $this->db->where('personaid',$idUser); 
			// 	var_dump(	$idUser , $where );exit;  		
			// }
			$totalVentasMes = 0;
			$arrVentaDias = array();
			$dias = cal_days_in_month(CAL_GREGORIAN,$mes, $anio);

			$n_dia = 1;
			for ($i=0; $i < $dias ; $i++) { 
				$date = date_create($anio."-".$mes."-".$n_dia);
				$fechaVenta = date_format($date,"Y-m-d");		

				$this->db->select('DAY(fecha) AS dia, COUNT(idpedido) AS cantidad, SUM(monto) AS total ');		
				$this->db->from('pedido');				
				$this->db->where('DATE(fecha)',$fechaVenta );
				$this->db->where('status','Completo');
				if($rolid == RCLIENTES ){
				 $this->db->where('personaid',$idUser); 
						
				}
				// $this->db->where('personaid',$idUser);
				// $where;
				$ventaDia = $this->db->get()->result();				 
			
				$ventaDia['dia'] = $n_dia;			
				$ventaDia[0]->total= $ventaDia[0]->total == "" ? 0 : $ventaDia[0]->total;				
				$totalVentasMes += $ventaDia[0]->total;	
				array_push($arrVentaDias, $ventaDia);
			   
				$n_dia++;													
			} 				
			$meses = $this->Helpers->Meses();	    
			$arrData = array('anio' => $anio, 'mes' => $meses[intval($mes-1)], 'total' => $totalVentasMes,'ventas' => $arrVentaDias );	
          	// var_dump(	$arrData );exit;  	
			return $arrData;
		}
		//vantas por año
		public function selectVentasAnio($anio){
			$arrMVentas = array();
			$arrMeses = $this->Helpers->Meses();
			for ($i=1; $i <= 12; $i++) { 
				$arrData = array('anio'=>'','no_mes'=>'','mes'=>'','venta'=>'');

				// $venta = $this->db->query("SELECT $anio AS anio, $i AS mes, SUM(monto) AS venta 
				// FROM pedido WHERE MONTH(fecha)= $i AND YEAR(fecha) = $anio AND status = 'Completo' 
				// GROUP BY MONTH(fecha) ")->result();

				$this->db->select(''.$anio.' AS anio, '.$i.' AS mes, SUM(monto) AS venta ');		
				$this->db->from('pedido');				
				$this->db->where('MONTH(fecha)',$i );
				$this->db->where('YEAR(fecha)',$anio );
				$this->db->where('status','Completo');
				$this->db->order_by('MONTH(fecha)'); 

				$ventaMes = $this->db->get()->result();		

				$arrData['mes'] = $arrMeses[$i-1];
				
				if(empty($ventaMes)){
					$arrData['anio'] = $anio;
					$arrData['no_mes'] = $i;
					$arrData['venta'] = 0;
				
				}else{
							
					$arrData['anio'] =  $ventaMes[0]->anio;					
					$arrData['no_mes'] = $ventaMes[0]->mes;
					$arrData['venta'] =  $ventaMes[0]->venta;					
				}
				array_push($arrMVentas, $arrData);
				# code...
			}	         
			$arrVentas = array('anio' => $anio, 'meses' => $arrMVentas);

			return $arrVentas;
		}
		//seleccionar productos maxima de 10
		public function productosTen(){
			
            $this->db->select('*');		
            $this->db->from('producto');
            $this->db->where('status = 1');
			$this->db->order_by('idproducto DESC'); 
			$this->db->LIMIT(10);  

            $request = $this->db->get()->result();	
			return $request;
			
		}
	 }
 ?>