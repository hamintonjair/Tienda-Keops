
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuariosModel extends CI_Model
{
 
    function __construct()
	{
		parent::__construct();		
	}

    public function listarUsuarios()
	{	
	  $this->db->select('*');
	  $this->db->from('persona');
	  $this->db->where('status != 0');	 	  
	  return $this->db->get()->result();	 
	}
    /**validamos si ya existe el usuarios */
    public function ValidarUsuarios($identificacion)
	{	
		$this->db->select('*');
		$this->db->from('persona');
		$this->db->where('identificacion', $identificacion );
		$resultado = $this->db->get();

		if($resultado->num_rows() > 0)
		{
			return true;
		}else{
			return false;
		}	  	
	}	
     /**validamos si ya existe el email */
    public function ValidarEmail($email)
	{	
		$this->db->select('email_user');
		$this->db->from('persona');
		$this->db->where('email_user', $email);
		$resultado = $this->db->get();

		if($resultado->num_rows() > 0)
		{
			return true;
		}else{
			return false;
		}	  	
	}
	//validar
	public function DiferenteEmail($email)
	{	
		$this->db->select('email_user');
		$this->db->from('persona');
		$this->db->where('email_user' != $email);
		$resultado = $this->db->get();

		if($resultado->num_rows() > 0)
		{
			return true;
		}else{
			return false;
		}	  	
	}
	  /**validamos si ya existe la identificacion */
	public function validarIdentificacion($identificacion)
	{
		$this->db->select('identificacion');
		$this->db->from('persona');
		$this->db->where('identificacion', $identificacion);
		$resultados = $this->db->get();
	
    	if($resultados->num_rows() > 0)
	     {
				return true;
	     }
	    else{   	
			return false;
		}		    
    }
	//validar
	public function diferenteIdentificacion($identificacion)
	{
		$this->db->select('identificacion');
		$this->db->from('persona');
		$this->db->where('identificacion'!=$identificacion);
		$resultados = $this->db->get();
	
    	if($resultados->num_rows() > 0)
	     {
				return true;
	     }
	    else{   	
			return false;
		}		    
    }
    	
    /**insertamos los usuarios */
    public function InsertarUsuario($data)
    {   
       return $this->db->insert('persona', $data);        
    }
	/**selecionamos todos los roles de la tabla personas con status diferente de cero */
	public function getRoles()
	{ 
			$whereAdmin = "";
			if ($_SESSION['idUser'] != 1){
				$whereAdmin = " and p.idpersona != 1 ";	
			}
		  $this->db->select("p.*,r.nombrerol, r.idrol");
		  $this->db->from("persona p");
		  $this->db->join("rol r", "p.rolid = r.idrol");     
		  $this->db->where("p.status != 0".$whereAdmin);   
		  $this->db->where("p.rolid != 3");  
		  $resultados = $this->db->get();
		  return $resultados->result();
	}
	/**seleccionamos el usuario de la tabla persona */
	public function selectUsuario(int $idpersona)
	{		
          $this->db->select("p.*,r.nombrerol");
		  $this->db->from("persona p");
		  $this->db->join("rol r", "p.rolid = r.idrol");     
		  $this->db->where("p.idpersona", $idpersona);   
		  $resultados = $this->db->get();
		  if($resultados->num_rows() > 0)
	         {
		       return $resultados->row();
	         }	
	} 
	//listar todos los usuarios para poder editarlo
	public function selectusuarios(int $idpersona)
	{		
          $this->db->select("p.idpersona,p.identificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.status,r.idrol,r.nombrerol ");
		  $this->db->from("persona p");
		  $this->db->join("rol r", "p.rolid = r.idrol");     
		  $this->db->where("p.idpersona", $idpersona);   
		  $resultados = $this->db->get();
		  if($resultados->num_rows() > 0)
	         {
		      return $resultados->row();
	         }	
	} 
//update datos de usuario
	public function updateUsuario($identificacion,$nombres,$apellidos,$password, $telefono,$email_user,$rolid,$status,$idpersona )
	{ 
	
		if( $password != ""){
			$this->db->where('idpersona', $idpersona);
			$this->db->SET('identificacion',"");
			$this->db->SET('nombres',"");
			$this->db->SET('apellidos',"");
			$this->db->SET('telefono',"");
			$this->db->SET('email_user',"");
			$this->db->SET('password',"");
			$this->db->SET('rolid',"");
			$this->db->SET('status',"");

			$datos = array(			
				"identificacion"  => $identificacion,
				"nombres"         => $nombres,
				"apellidos"       => $apellidos,
				"telefono"        => $telefono,	
				"email_user"      => $email_user,	
				"password"        => $password, 
				"rolid"           => $rolid,	
				"status"          => $status,  
			);
		
		}else{

			$this->db->where('idpersona', $idpersona);
			$this->db->SET('identificacion',"");
			$this->db->SET('nombres',"");
			$this->db->SET('apellidos',"");
			$this->db->SET('telefono',"");
			$this->db->SET('email_user',"");
			$this->db->SET('rolid',"");	
			$this->db->SET('status',"");

			
			$datos = array(			
				"identificacion"  => $identificacion,
				"nombres"         => $nombres,
				"apellidos"       => $apellidos,
				"telefono"        => $telefono,	
				"email_user"      => $email_user,
				"rolid"           => $rolid,				
				"status"          => $status,  
			);
				
		}
	
	   return $this->db->update('persona', $datos); 
	}

	// eliminar usuario		
	public function delete($idpersona)
	{
	  $this->db->where('idpersona',$idpersona);
	  $this->db->delete('persona');
	}
	//update datos del perfil
	public function updatePerfil($identificacion,$nombre,$apellido,$telefono,$password,$idpersona)
	{
		if( $password != ""){
			$this->db->where('idpersona', $idpersona);
			$this->db->SET('identificacion',"");
			$this->db->SET('nombres',"");
			$this->db->SET('apellidos',"");
			$this->db->SET('telefono',"");
			$this->db->SET('password',"");

			$datos = array(			
				"identificacion"  => $identificacion,
				"nombres"         => $nombre,
				"apellidos"       => $apellido,
				"telefono"        => $telefono,			
				"password"        => $password,        
			);
		
		}else{

			$this->db->where('idpersona', $idpersona);
			$this->db->SET('identificacion',"");
			$this->db->SET('nombres',"");
			$this->db->SET('apellidos',"");
			$this->db->SET('telefono',"");	
			
			$datos = array(			
				"identificacion"  => $identificacion,
				"nombres"         => $nombre,
				"apellidos"       => $apellido,
				"telefono"        => $telefono,		    
			);
				
		}
	
	   return $this->db->update('persona', $datos); 	
	}
//update datos fiscales
	public function updateFiscal($nit, $nombreFiscal, $direccionFiscal, $idpersona)
	{
		$this->db->where('idpersona', $idpersona);
			$this->db->SET('nit',"");
			$this->db->SET('nombrefiscal',"");
			$this->db->SET('direccionfiscal',"");
		

			$datos = array(			
				"nit"               => $nit,
				"nombrefiscal"      => $nombreFiscal,
				"direccionfiscal"   => $direccionFiscal,				      
			);
		return $this->db->update('persona', $datos);
	}
}