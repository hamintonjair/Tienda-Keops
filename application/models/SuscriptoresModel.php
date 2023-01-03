<?php 

 defined('BASEPATH') OR exit('No direct script access allowed');
    class SuscriptoresModel extends CI_Model{
        public function __construct()
        {
           parent::__construct();
        }  
        
       //ver suscriptores
        public function selectSuscriptores()
        {
            $request = $this->db->query("SELECT idsuscripcion, nombre, email, DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha
                    FROM suscripciones ORDER BY idsuscripcion DESC")->result();
       
            return $request;
        }

    }
 ?>