<?php
//extends para heredar
   defined('BASEPATH') OR exit('No direct script access allowed');

   class PaginasModel extends  CI_Model
   {
       //funcion para solicitar los datos que se solicitan en modelos
    public function __construct()
   {
        parent::__construct();
   }   
     //extraer los post
	public function selectPaginas(){
		$request = $this->db->query("SELECT idpost, titulo,  DATE_FORMAT(datecreate, '%d/%m/%Y') as fecha, ruta, status
				FROM post  
				WHERE status != 0 ")->result();	
		return $request;
	}	
     //actualizar post
	public function updatePost($idPost,  $titulo,  $contenido,  $portada,  $status){

        $this->db->where( "idPost",$idPost);
        $this->db->SET( "titulo","");
        $this->db->SET( "contenido","");   
        $this->db->SET( "portada","");         
        $this->db->SET( "status","");         

        $datos = array(   
           
           "titulo"     => $titulo,
           "contenido"  => $contenido,  
           "portada"    => $portada,              
           "status"     => $status,	
           	          
        );   
		$request = $this->db->update('post',$datos);
	    return $request;
	}
   //insertar post
	public function insertPost( $titulo,  $contenido,  $portada,  $ruta,  $status){

       $this->db->select('*');
       $this->db->from('post');
       $this->db->where('ruta', $ruta);
       $request =  $this->db->get()->result();

       if(empty($request)){

            $datos = array(   
            
                "titulo"     => $titulo,
                "contenido"  => $contenido,  
                "portada"    => $portada,              
                "ruta"       => $ruta,
                "status"     => $status,	
                            
            );     
            $return =$this->db->insert('post',$datos);  

        }else{
          $return = 0;
        }
		return $return;
	}
   //eliminar pos
	public function deletePagina( $idpagina){
  
        $this->db->where( "idPost",$idpagina);             
        $this->db->SET( "status",""); 

        $arrData = array(
            "status"     => 0,
        );  
		$request = $this->db->update('post',$arrData);
		return $request;
	}
}

 ?>