
<?php
//extends para heredar
   defined('BASEPATH') OR exit('No direct script access allowed');

   class PedidosModel extends  CI_Model
   {
       //funcion para solicitar los datos que se solicitan en modelos
    public function __construct()
   {
        parent::__construct();
        $this->load->model("Helpers");
   } 
  //listar pedidos
   public function selectPedidos( $idpersona = null){
 
    $this->db->select("p.idpedido, p.referenciacobro,p.idtransaccionpaypal, DATE_FORMAT(p.fecha, '%d/%m/%Y') as fecha, p.monto,
    tp.tipopago,tp.idtipopago, p.status,p.USD ");
    $this->db->from("pedido p ");
    $this->db->join("tipopago tp", "p.tipopagoid = tp.idtipopago"); 
        
    if( $idpersona != null){
       $this->db->where(" p.personaid ", $idpersona); 
    }  

     return $this->db->get()->result();  
   
   }	
   //listar orden de pedidos
   public function selectPedido($idpedido, $idpersona = null){

      $busqueda = "";
      if($idpersona != null){
         $busqueda =  $this->db->where(" p.personaid ", $idpersona); 
      }
      $request = array();
      $this->db->select("p.idpedido, p.referenciacobro,p.idtransaccionpaypal, p.personaid, DATE_FORMAT(p.fecha, '%d/%m/%Y') as fecha,  
      p.costo_envio, p.costo_envioP, p.monto,  p.tipopagoid,  t.tipopago,  p.direccion_envio, p.status,p.USD ");
      $this->db->from("pedido p ");
      $this->db->join("tipopago t", "p.tipopagoid = t.idtipopago");  
      $this->db->where(" p.idpedido ", $idpedido); 
      $busqueda; 

      $requestPedido = $this->db->get()->result();  

      if(count($requestPedido) > 0 ){

         for ($c=0; $c < count($requestPedido) ; $c++) { 
            $idpersona = $requestPedido[$c]->personaid;
         }    
    
         $this->db->select("idpersona, nombres,apellidos,telefono, email_user, nit, nombrefiscal, direccionfiscal ");
         $this->db->from("persona");        
         $this->db->where(" idpersona ", $idpersona); 
         $requestcliente = $this->db->get()->result(); 

        
         $this->db->select(" p.idproducto, p.nombre as producto, d.precio,d.USD, d.cantidad");
         $this->db->from(" detalle_pedido d"); 
         $this->db->join("producto p", "d.productoid = p.idproducto");         
         $this->db->where(" d.pedidoid ", $idpedido); 
         $requestProductos = $this->db->get()->result(); 

         $request = array('cliente' => $requestcliente,
                          'orden'   => $requestPedido,
                          'detalle' => $requestProductos
          );
      }	
      return $request;
     
   }
   //consultar transaccion paypal
   public function selectTransPaypal($idtransaccion, $idpersona = NULL){

      $busqueda = "";
      if($idpersona != NULL){
         $busqueda =  $this->db->where(" personaid ", $idpersona);       
      }
      $objTransaccion = array();

      $this->db->select("datospaypal");
      $this->db->from("pedido");
      $this->db->where(" idtransaccionpaypal ", $idtransaccion); 
      $busqueda;

      $requestData = $this->db->get()->result();  
    
      if(!empty($requestData)){

         for ($c=0; $c < count($requestData) ; $c++) { 
            $datospaypal = $requestData[$c]->datospaypal;
         }           
         $objData = json_decode( $datospaypal );       
         //$urlOrden = $objData->purchase_units[0]->payments->captures[0]->links[2]->href;
         $urlOrden = $objData->links[0]->href;             
         $objTransaccion = $this->Helpers->CurlConnectionGet($urlOrden,"application/json", $this->Helpers->getTokenPaypal());
   
      }
      return $objTransaccion;
   }
   //haciendo reembolso paypal
   public function reembolsoPaypal( $idtransaccion,  $observacion){

      $response = false;
     
      $this->db->select("idpedido,datospaypal");
      $this->db->from("pedido");
      $this->db->where(" idtransaccionpaypal ", $idtransaccion); 
      $requestData = $this->db->get()->result(); 
 
      if(!empty($requestData)){
         for ($c=0; $c < count($requestData) ; $c++) { 
            $datospaypal = $requestData[$c]->datospaypal;
            $idpedido = $requestData[$c]->idpedido;
         }  
         $objData = json_decode($datospaypal);    
       
         // $urlReembolso = $objData->purchase_units[0]->payments->captures[0]->links[1]->href;
         $urlReembolso = $objData->links[0]->href;         
           
         $objTransaccion = $this->Helpers->CurlConnectionGet($urlReembolso,"application/json", $this->Helpers->getTokenPaypal());

         $Reembolso = $objTransaccion->purchase_units[0]->payments->captures[0]->links[1]->href;
     
         $objTransaccion = $this->Helpers->CurlConnectionPost($Reembolso,"application/json",$this->Helpers->getTokenPaypal());

         // var_dump(     $objTransaccion  );  exit; 
         if(isset($objTransaccion->status) &&  $objTransaccion->status == "COMPLETED"){
       
            $idtrasaccion = $objTransaccion->id;
            $status = $objTransaccion->status;
            $jsonData = json_encode($objTransaccion);
            $observacion = $observacion;
       
            $arrData = array(
                          'pedidoid' => $idpedido,
                          'idtransaccion'=> $idtrasaccion,
                          'datosreembolso' => $jsonData,
                          'observacion'=> $observacion,
                          'status'=>  $status
             );

      
             $request_insert =   $this->db->insert("reembolso", $arrData);
        
            if($request_insert > 0){

               $this->db->where(" idpedido ", $idpedido); 
               $this->db->SET('status',"");                          
      
               $arrPedido = array(			
                    'status' => "Reembolsado",                 		      
               );
               $this->db->update(" pedido ", $arrPedido); 
               $response = true;
              }
              
         }
         return $response;
      }
   }
   //actualñizar pedidos
   public function updatePedido($idpedido, $transaccion , $idtipopago,  $estado){

     
      if($transaccion == ""){

         $this->db->where('idpedido',$idpedido );
         $this->db->SET('status',""); 
         $query_insert = 'pedido';                     
         $arrData = array(
              'status'  => $estado,
            );
      }else{

         $this->db->where('idpedido',$idpedido );
         $this->db->SET('idtransaccionpaypal',"");         
         $this->db->SET('tipopagoid',""); 
         $this->db->SET('status',"");  
         $query_insert = 'pedido';   
         
         $arrData = array(
            'idtransaccionpaypal' => $transaccion,
            'tipopagoid'      => $idtipopago,
            'status'          => $estado
                   );
      }  
      $request_insert = $this->db->update($query_insert,$arrData);
        return $request_insert;
   }

}

?>
