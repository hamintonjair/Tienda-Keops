<?php
//extends para heredar
   defined('BASEPATH') OR exit('No direct script access allowed');

   class TtipoPagoModel extends  CI_Model
   {
       //funcion para solicitar los datos que se solicitan en modelos
    public function __construct()
   {
        parent::__construct();
   } 

   //tipo de pago
   public function getTipoPago(){   

      $this->db->select('*');
      $this->db->from("tipopago");
      $this->db->where('status !=0');
      return $this->db->get()->result();	 
  }

}

?>