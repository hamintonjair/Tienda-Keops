<?php
//extends para heredar
   defined('BASEPATH') OR exit('No direct script access allowed');

   class ClientesModel extends  CI_Model
   {
       //funcion para solicitar los datos que se solicitan en modelos
    public function __construct()
   {
        parent::__construct();
   }    
       
        /**insertamops los usuarios */
   public function InsertCliente($data)
   {   
         $this->db->insert('persona', $data);    
   }
    //  //listar clientes que el estatus sea diferente cero, es decir que no esten eliminados
   public function listarCliente()
	{		
      $this->db->select("idpersona,identificacion,nombres,apellidos,telefono,email_user,status ");
      $this->db->from("persona");      
      $this->db->where("rolid", 3);  
      $this->db->where('status != 0');
      return $this->db->get()->result(); 
     
	} 
    public function selectCliente(int $idpersona)
	{		
          $this->db->select("idpersona,identificacion,nombres,apellidos,telefono,email_user, nit,nombrefiscal,direccionfiscal,status,
          DATE_FORMAT(datecreated, '%d-%m-%Y') as fechaRegistro");
		  $this->db->from("persona");		 
		  $this->db->where("idpersona", $idpersona);   
		  $resultados = $this->db->get();
		  if($resultados->num_rows() > 0)
	         {
		       return $resultados->row();
	         }	
	} 
    //listar todos los clientes para poder editarlo
	public function selectClientes(int $idpersona)
	{		
          $this->db->select("idpersona,identificacion,nombres,apellidos,telefono,email_user, nit,nombrefiscal,direccionfiscal,status ");
		  $this->db->from("persona");	  
		  $this->db->where("idpersona", $idpersona);   
		  $resultados = $this->db->get();
		  if($resultados->num_rows() > 0)
	         {
		      return $resultados->row();
	         }	
	} 
    //update datos de cliente
	public function updateCliente($identificacion,$nombres,$apellidos,$telefono,$email_user, $password,$nit,$nombrefiscal,$direccionfiscal,$idpersona)
	{ 
          
            if( $password != ""){
			$this->db->where('idpersona', $idpersona);
			$this->db->SET('identificacion',"");
			$this->db->SET('nombres',"");
			$this->db->SET('apellidos',"");
			$this->db->SET('telefono',"");
			$this->db->SET('email_user',"");
            $this->db->SET('password',"");
			$this->db->SET('nit',"");
            $this->db->SET('nombrefiscal',"");
			$this->db->SET('direccionfiscal',"");	
		
			$datos = array(			
				"identificacion"  => $identificacion,
				"nombres"         => $nombres,
				"apellidos"       => $apellidos,
				"telefono"        => $telefono,	
				"email_user"      => $email_user,				
                "nit"             => $nit, 
                "nombrefiscal"    => $nombrefiscal,                        
                "direccionfiscal" => $direccionfiscal, 
                "password"        => $password, 	
				
			);
		
		}else{

			$this->db->where('idpersona', $idpersona);
			$this->db->SET('identificacion',"");
			$this->db->SET('nombres',"");
			$this->db->SET('apellidos',"");
			$this->db->SET('telefono',"");
			$this->db->SET('email_user',"");                
			$this->db->SET('nit',"");
            $this->db->SET('nombrefiscal',"");
			$this->db->SET('direccionfiscal',"");
	
			$datos = array(			
				"identificacion"  => $identificacion,
				"nombres"         => $nombres,
				"apellidos"       => $apellidos,
				"telefono"        => $telefono,	
				"email_user"      => $email_user,
                "nit"             => $nit, 
                "nombrefiscal"    => $nombrefiscal, 
                "direccionfiscal" => $direccionfiscal, 	
				 
			);				
		}	
        
	   return $this->db->update('persona', $datos); 
	}
    // eliminar cliente			
	public function delete($idpersona)
	{
	  $this->db->where('idpersona',$idpersona);
	  $this->db->delete('persona');
	}
 }