<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
//extends para heredar
   class TclienteModel extends CI_Model
   {
      
       public function __construct()
       {
          parent::__construct();
       }  
         
        /**insertamops los usuarios */
   public function InsertCliente($data)
   {   
      $email = $data['email_user'];    
      $result =     $this->db->insert('persona', $data); 

     if($result == true){
   
      $this->db->select('idpersona');
      $this->db->from('persona'); 
      $this->db->where('email_user', $email );         

      $resultado = $this->db->get();
          
         if($resultado->num_rows() > 0)
         {        
            return $resultado->row();
         }else{
          
            return false;
         }
      }  
   }
   //insertar pedido
   // public function insertPedido($idtransaccionpaypal, $datospaypal, $personaid, $costo_evioU, $costo_envioP,  $monto, $tipopagoid,  $direccionenvio, $status,	$montoUSD ){
   //    $datos = array(
   //       "idtransaccionpaypal" =>  $idtransaccionpaypal,
   //       "datospaypal"         =>  $datospaypal,
   //       "personaid"           =>  $personaid,
   //       "costo_envio"         =>  $costo_evioU,
   //       "costo_envioP"        =>  $costo_envioP,
   //       "monto"               =>  $monto,
   //       "tipopagoid"          =>  $tipopagoid,
   //       "direccion_envio"     =>  $direccionenvio,
   //       "status"              =>  $status,
   //       "USD"                 =>  $montoUSD ,
   //     );

   //    $result = $this->db->insert('pedido',$datos);  

   //    if($result == true){
   
   //       $this->db->select('idpedido');
   //       $this->db->from('pedido'); 
   //       $this->db->where('idtransaccionpaypal', $idtransaccionpaypal );         
   
   //         $resultado = $this->db->get();
             
   //          if($resultado->num_rows() > 0)
   //          {        
   //             return $resultado->row();
   //          }else{
             
   //             return false;
   //          }
   //    }
   // }
	public function insertPedido($idtransaccionpaypal, $datospaypal, $personaid, $costo_evioU, $costo_envioP, $monto, $tipopagoid, $direccionenvio, $status, $montoUSD) {
		$datos = array(
			 "idtransaccionpaypal" => $idtransaccionpaypal,
			 "datospaypal"         => $datospaypal,
			 "personaid"           => $personaid,
			 "costo_envio"         => $costo_evioU,
			 "costo_envioP"        => $costo_envioP,
			 "monto"               => $monto,
			 "tipopagoid"          => $tipopagoid,
			 "direccion_envio"     => $direccionenvio,
			 "status"              => $status,
			 "USD"                 => $montoUSD
		);
  
		$result = $this->db->insert('pedido', $datos);  
  
		if($result) {
			 // Devuelve el id del pedido recién insertado
			 return $this->db->insert_id();
		} else {
			 return false;
		}
  }
  
   //insertar detalle pedido
   public function insertDetalle($idpedido, $productoid, $precio, $USD, $cantidad){
     
      $datos = array(
         "pedidoid"   =>  $idpedido,
         "productoid" =>  $productoid,
         "precio"     =>  $precio,
         "USD"        =>  $USD,
         "cantidad"   =>  $cantidad,   
       );    
      return $this->db->insert('detalle_pedido',$datos);  
   }
   //seleccionar pedidos
   public function getPedido($idpedido){

      $request = array();
      $this->db->select("p.idpedido, p.referenciacobro, p.idtransaccionpaypal,p.personaid,p.fecha,
      p.costo_envio,p.costo_envioP, p.monto, p.tipopagoid, t.tipopago, p.direccion_envio, p.status,p.USD ");
      $this->db->from("pedido p");
      $this->db->join("tipopago t", "p.tipopagoid = t.idtipopago");     
      $this->db->where("p.idpedido", $idpedido);  

       $resultPedido = $this->db->get()->result();        
       
         if(count($resultPedido) > 0 ){
          
            $this->db->select("p.idproducto, p.nombre as producto, d.precio, d.USD,d.cantidad");
            $this->db->from("detalle_pedido d");
            $this->db->join("producto p", "d.productoid = p.idproducto");     
            $this->db->where("d.pedidoid", $idpedido);  

            $resultProductos = $this->db->get()->result();       
            
            $request = array(
                         'orden' => $resultPedido,
							    'detalle' => $resultProductos
							);
          }	
          return  $request ;
   }

   //insertar detalles de pedidos temporales
   public function insertDetalleTemp($pedidoTemp)
   {
      $idCliente = $pedidoTemp['idcliente'];
      $idtransaccion = $pedidoTemp['idtransaccion'];
      $productos = $pedidoTemp['productos'];     
     
      $this->db->select('*');
      $this->db->from('detalle_temp');
      $this->db->where('transaccionid', $idtransaccion );
      $this->db->where('personaid',  $idCliente );

      $respon = $this->db->get()->result(); 
      //si no hay lo inserta de lo contrario actualiza
      if(empty($respon)){

         foreach ( $productos  as $producto){

             $result = array(
                      "personaid" =>  $idCliente,
                      "productoid" =>  $producto['idproducto'],
                      "precio" =>  $producto['precio'],
                      "cantidad" =>  $producto['cantidad'],
                      "transaccionid" =>  $idtransaccion,
                        );
          
           $this->db->insert('detalle_temp',$result);      
       
         }

      }else{
        
         $this->db->where('transaccionid', $idtransaccion );
         $this->db->where('personaid',  $idCliente );
         $this->db->delete('detalle_temp');

         foreach ( $productos  as $producto){

            $result = array(
                     "personaid" =>  $idCliente,
                     "productoid" =>  $producto['idproducto'],
                     "precio" =>  $producto['precio'],
                     "cantidad" =>  $producto['cantidad'],
                     "transaccionid" =>  $idtransaccion,
                       );
         
          $this->db->insert('detalle_temp',$result);      
      
        }
      }  
   }
   //suscripciones
   public function setSuscripcion($nombre, $email){
		
		$srequestql = 	$this->db->query("SELECT * FROM suscripciones WHERE email = '{$email}'")->result();
		
		if(empty($request)){

         $datos = array(
            "nombre"   =>  $nombre,
            "email" =>  $email,
        
          );    
         return $this->db->insert('suscripciones',$datos );  

		}else{
			$return = false;
		}
		return $return;
	}
   //enviar correo de contacto
   public function setContacto($nombre,  $email,  $mensaje,  $ip,  $dispositivo,  $useragent){
	
		$nombre   = $nombre != "" ? $nombre : ""; 
		$email 	 = $email != "" ? $email : ""; 
		$mensaje	 = $mensaje != "" ? $mensaje : ""; 
		$ip 		 = $ip != "" ? $ip : ""; 
		$dispositivo = $dispositivo != "" ? $dispositivo : ""; 
		$useragent 	 = $useragent != "" ? $useragent : ""; 

      $datos = array(
         "nombre"   => $nombre,
         "email"   => $email,
         "mensaje" => $mensaje,
         "ip"      => $ip,  
         "dispositivo" => $dispositivo,
         "useragent"   => $useragent,   
       );   		
       return $this->db->insert('contacto',$datos);  
	}
       
}

?>