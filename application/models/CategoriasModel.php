<?php
//extends para heredar
   defined('BASEPATH') OR exit('No direct script access allowed');

   class CategoriasModel extends  CI_Model
   {
       //funcion para solicitar los datos que se solicitan en modelos
    public function __construct()
   {
        parent::__construct();
   }    
   //insertamos una categoria 
   public function InsertCategorias( $nombre, $descripcion,$portada,$ruta,$status){
   
        $datos = array(			
            "nombre"        => $nombre,
            "descripcion"   => $descripcion,
            "portada"       => $portada,
			"ruta"          => $ruta,		
            "status"        => $status,			
                
        );
        return  $this->db->insert('categoria',$datos);
   }
   // validamos si ya existe los datos que vamos a registrar	
   public function ValidarCategorias($categoria)
	{		
	  $this->db->select('nombre');
	  $this->db->from('categoria'); 
	  $this->db->where('nombre', $categoria);
	  $resultado = $this->db->get();

	  if($resultado->num_rows() > 0)
	  {
		  return 1;
	  }else{
		  return false;
	  }	  	
	}	
    //listar las categorias para mostrar en la vista principal
     public function listarCategorias()
	{		
      $this->db->select("*");
      $this->db->from("categoria");    
      $this->db->where('status != 0');
      return $this->db->get()->result();     
	} 
  // validamos los datos que vamos a editar o verlos
	public function editCategoria($idcategoria)
	{			
	  $this->db->where('idcategoria', $idcategoria);
	  $this->db->from('categoria');	  
	  $resultado = $this->db->get();

	  if($resultado->num_rows() > 0)
	  {
		  return $resultado->row();
	  }	
	}
    //update categoria
    public function updateCategoria($idcategoria, $nombre, $descripcion,$portada,$ruta,$status){

        $this->db->select("*");
        $this->db->from("categoria");	
        $this->db->where("nombre",$nombre);
        $this->db->where("idcategoria != $idcategoria");  
        
        $resultados = $this->db->get();
        if($resultados->num_rows() > 0)
           {
             return 1;
           }else{

            $this->db->where('idcategoria', $idcategoria);
			$this->db->SET('nombre',"");
			$this->db->SET('descripcion',"");
			$this->db->SET('portada',"");
			$this->db->SET('status',"");	

			$datos = array(			
				"nombre"        => $nombre,
				"descripcion"   => $descripcion,
				"portada"       => $portada,
				"ruta"          => $ruta,	
				"status"        => $status,	
			
			);
          
            return $this->db->update('categoria',$datos);
           }
    }
    // validamos si existehay productos asociadops a esta categoria 
	public function ValidarDelete($idcategoria)
	{	
	  $this->db->select('*');
	  $this->db->from('producto');
	  $this->db->where('categoriaid',$idcategoria);
	  $resultado = $this->db->get();
	
		if($resultado->num_rows() > 0)
		{
			return 1;	
		}else{ 
			return false;	 
		}	 	
	}
    // eliminar categoria			
	public function delete($idcategoria)
	{
	  $this->db->where('idcategoria',$idcategoria);
	  return $this->db->delete('categoria');
	}
	//categorias para el foother
	public function getCategoriasFooter(){

		$request = $this->db->query("SELECT idcategoria, nombre, descripcion, portada, ruta
				FROM categoria WHERE  status = 1 AND idcategoria IN (".CAT_FOOTER.")")->result();
	
		if(count($request) > 0){
			for ($c=0; $c < count($request) ; $c++) { 
				$request[$c]->portada = base_url().'assets/Template/Admin/images/uploads/'.$request[$c]->portada;				
			
			}
		}
		return $request;
	}
	public function getCategoriasFooter2(){

		$request = $this->db->query("SELECT idcategoria, nombre, descripcion, portada, ruta
				FROM categoria WHERE  status = 1 AND idcategoria IN (".CAT_FOOTER2.")")->result();
	
		if(count($request) > 0){
			for ($c=0; $c < count($request) ; $c++) { 
				$request[$c]->portada = base_url().'assets/Template/Admin/images/uploads/'.$request[$c]->portada;				
			
			}
		}
		return $request;
	}
	
 }