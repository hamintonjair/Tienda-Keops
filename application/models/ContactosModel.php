<?php
//extends para heredar
   defined('BASEPATH') OR exit('No direct script access allowed');

   class ContactosModel extends  CI_Model
   {
       //funcion para solicitar los datos que se solicitan en modelos
    public function __construct()
   {
        parent::__construct();
   }    
    //ver contactos
	public function selectContactos()
	{
		$request = $this->db->query("SELECT id, nombre, email, DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha
				FROM contacto ORDER BY id DESC")->result();
	
		return $request;
	}
    //ver mensajes
	public function selectMensaje( $idmensaje){
		
		$request = $this->db->query("SELECT id, nombre, email, DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha, mensaje
				FROM contacto WHERE id = $idmensaje")->result();	
		return $request;
	}
}

?>