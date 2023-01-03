<?php
//extends para heredar
   defined('BASEPATH') OR exit('No direct script access allowed');

   class FotosModel extends  CI_Model
   {
          
    //ver contactos
	public function selectFotos()
	{
        $this->db->select("*");
        $this->db->from("fotos");    
        return $this->db->get()->result();    
	}

    //insertamos una fotos 
   public function InsertFotos( $descripcion,$img){
   
    $datos = array(			
       
         "descripcion"   => $descripcion,
         "img"          => $img,
   	    
    );
    return  $this->db->insert('fotos',$datos);
    }

    //update foto
    public function updateFotos($idFotos,$descripcion,$img){

        $this->db->where('id', $idFotos);		
		$this->db->SET('descripcion',"");
		$this->db->SET('img',"");		

			$datos = array(	
				"descripcion"   => $descripcion,
				"img"           => $img,							
			);
         
            return $this->db->update('fotos',$datos);
    }
    // validamos los datos que vamos a editar o verlos
	public function editFotos($idFotos)
	{			
	  $this->db->where('id', $idFotos);
	  $this->db->from('fotos');	  
	  $resultado = $this->db->get();

	  if($resultado->num_rows() > 0)
	  {
		  return $resultado->row();
	  }	
	}
    //cantidad de fotos para páginar
    public function cantFotos($id = null){

        $this->db->select('COUNT(*) as total_registro');		
        $this->db->from('fotos');      
        $request = $this->db->get()->result();  
          return $request;
  
    }

      //paginacion servicios
    public function getFotosPage($desde, $porpagina)
    {	                
             $result = $this->db->query("SELECT id,  descripcion ,img FROM fotos                
             ORDER BY id DESC LIMIT $desde,$porpagina")->result();     
         
       if(count($result) > 0){                     
             for ($i=0; $i < count($result) ; $i++) { 
               $result[$i]->url_image = base_url().'assets/Template/Admin/images/uploads/'.$result[$i]->img;
                           
              }                                     
        }       
       return  $result ;
  } 
 
    // eliminar foto			
	public function delete($idFoto)
	{
	  $this->db->where('id',$idFoto);
	   return $this->db->delete('fotos');
	}
   
}

?>