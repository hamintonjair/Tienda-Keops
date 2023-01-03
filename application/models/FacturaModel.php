
<?php
//extends para heredar
   defined('BASEPATH') OR exit('No direct script access allowed');

   class FacturaModel extends  CI_Model
   {
       //funcion para solicitar los datos que se solicitan en modelos
    public function __construct()
   {
        parent::__construct();
   } 

   public function selectPedido($idpedido, $idpersona = NULL){

    $busqueda = "";
    if($idpersona != null){
       $busqueda =  $this->db->where(" p.personaid ", $idpersona); 
    }
    $request = array();
    $this->db->select("p.idpedido, p.referenciacobro,p.idtransaccionpaypal, p.personaid, DATE_FORMAT(p.fecha, '%d/%m/%Y') as fecha,  
    p.costo_envio, p.monto,  p.tipopagoid,  t.tipopago,  p.direccion_envio, p.status ");
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

      
       $this->db->select(" p.idproducto, p.nombre as producto, d.precio, d.cantidad");
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
}

	