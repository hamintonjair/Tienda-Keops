<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RolesModel extends CI_Model
{
	public $intidrol;
	public $strRol;
	public $strDescripcion;
	public $intStatus;

    function __construct()
	{
		parent::__construct();
		
	}	
	/**listamos los roles */
	public function listarRoles()
	{	
		$whereAdmin = "";
		if ($_SESSION['idUser'] != 1){
				$whereAdmin = " and idrol != 1";	
		}	
	  $this->db->where('status != 0' .$whereAdmin);		
	  $this->db->from('rol');
	 	  
	  return $this->db->get()->result();	 
	}
	//funcion llamada en el controlador usuarios
	public function getRoles()
	{	
		$whereAdmin = "";
		if ($_SESSION['idUser'] != 1){
				$whereAdmin = " and idrol != 1";	
		}	
		$this->db->where('status != 2'.$whereAdmin);
		$this->db->from('rol');
		 	  
		return $this->db->get()->result();	
	}
	
	// validamos si ya existe los datos que vamos a registrar	
	public function ValidarRoles($nombrerol)
	{		
	  $this->db->select('nombrerol');
	  $this->db->from('rol');
	  $this->db->where('nombrerol', $nombrerol);
	  $resultado = $this->db->get();

	  if($resultado->num_rows() > 0)
	  {
		  return 1;
	  }else{
		  return false;
	  }	  	
	}	
	/*insert*/		
	public function insertRol($data)
    {	
		$this->db->insert('rol', $data);		
	}
	// validamos los datos que vamos a eliminar editar 
	public function editar(int $idrol)
	{			
	  $this->db->where('idrol', $idrol);
	  $this->db->from('rol');	  
	  $resultado = $this->db->get();

	  if($resultado->num_rows() > 0)
	  {
		  return $resultado->row();
	  }	
	}
	/*update*/
	public function updateRol($data)
	{
	  return $this->db->update('rol', $data, array('idrol' => $data['idrol']));
	}
	// validamos si existe usuarios asignados a este rol
	public function ValidarDelete($idrol)
	{	
	  $this->db->select('*');
	  $this->db->from('persona');
	  $this->db->where('rolid',$idrol);
	  $resultado = $this->db->get();
	
		if($resultado->num_rows() > 0)
		{
			return 1;	
		}else{ 
			return false;	 
		}	 	
	}
	/**delete*/
	public function delete($idrol)
	{
	  $this->db->delete('rol', $idrol, array('idrol' => $idrol['idrol']));
	}
}


