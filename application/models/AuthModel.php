<?php
//extends para heredar
  class AuthModel extends  CI_Model
  {
    //funcion para solicitar los datos que se solicitan en modelos
    public function __construct()
    {
            parent::__construct();
    }    
    //validar usuario para iniciar sesion
    public function ValidarLogin($email,$password)
    {	
          $this->db->select('idpersona,status');
          $this->db->from('persona');
          $this->db->where('password', $password);
          $this->db->where('email_user', $email);
        
          $resultado = $this->db->get();
              
          if($resultado->num_rows() > 0)
          {
              return $resultado->row();
            }else{
              return false;
          }
        
    }	
    //validamos el usuario para que nos traiga los datos de inicio de sesion
    public function sessionLogin($idUser)
    {
        $this->db->select("p.idpersona, p.identificacion, p.nombres, p.apellidos,
        p.telefono, p.email_user, p.nit, p.nombrefiscal, p.direccionfiscal, r.idrol,
        r.nombrerol, p.status");
        $this->db->from("persona p");
        $this->db->join("rol r", "p.rolid = r.idrol" );  	 
        $this->db->where("p.idpersona", $idUser); 

          $resultados = $this->db->get();
        
        if($resultados->num_rows() > 0){
            
             return $resultados->row();
          }	
    }
    //select usuario para restablecer
    public function getUserEmail($email)
    {
      $this->db->select("idpersona, nombres, apellidos, status");
      $this->db->from('persona');
      $this->db->where('email_user', $email);
      $this->db->where('status', 1);

      $resultados = $this->db->get();
      if($resultados->num_rows() > 0)
      {
        return $resultados->row();
      }
    }
    //envio del token para restaurar la contraseña
    public function setTokenUser($idpersona,$token)
    { 
      $this->db->where('idpersona', $idpersona);    
      $this->db->SET('token',$token ); 
      return $this->db->update('persona'); 

    }
    //consultar el id personas con las siguientes condiciones
    public function getUsuario($email,$token)
    {
      $this->db->select("idpersona");
      $this->db->from('persona');
      $this->db->where('email_user', $email);
      $this->db->where('token', $token);
      $this->db->where('status', 1);
     
      $resultados = $this->db->get();
      if($resultados->num_rows() > 0)
       {
        return $resultados->row();
      }
    }
    //insertar el nuevo password reseteado
    public function insertPassword($idpersona,$password)
    {
      $this->db->where('idpersona', $idpersona);    
      $this->db->SET('password',$password ); 
      $this->db->SET('token',"" ); 
      return $this->db->update('persona'); 
    }
  }
?>