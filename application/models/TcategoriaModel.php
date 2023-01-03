<?php
//extends para heredar
   defined('BASEPATH') OR exit('No direct script access allowed');

   class TcategoriaModel extends  CI_Model
   {
       //funcion para solicitar los datos que se solicitan en modelos
    public function __construct()
   {
        parent::__construct();
   } 
   //cargar las categorias en el sitio
   public function getCategoriasT($idcategoria)
   {	     
        $result = $this->db->query("SELECT idcategoria, nombre, descripcion, portada, ruta
        FROM categoria WHERE status != 0 AND idcategoria IN ($idcategoria)")->result();

      if($result){
        for ($c=0; $c < count($result) ; $c++) { 
           $result[$c]->portada = base_url().'assets/Template/Admin/images/uploads/'.$result[$c]->portada;
        }       
      }
       return $result;     
   }    
      //cargar las categorias en el sitio
   public function getCategoriasT2($idcategoria)
   {	     
           $result = $this->db->query("SELECT idcategoria, nombre, descripcion, portada, ruta
           FROM categoria WHERE status != 0 AND idcategoria IN ($idcategoria)")->result();
   
         if($result){
           for ($c=0; $c < count($result) ; $c++) { 
              $result[$c]->portada = base_url().'assets/Template/Admin/images/uploads/'.$result[$c]->portada;
           }       
         }
          return $result;     
      }      
 //seleccionar las categorias relacionado a productos
   public function getCategorias(){

      $request = $this->db->query("SELECT c.idcategoria, c.nombre, c.portada, c.ruta, count(p.categoriaid) AS cantidad
      FROM producto p 
      INNER JOIN categoria c
      ON p.categoriaid = c.idcategoria
      WHERE c.status = 1
      GROUP BY p.categoriaid, c.idcategoria")->result();
		
		if(count($request) > 0){     
			for ($c=0; $c < count($request) ; $c++) { 
            $request[$c]->portada = base_url().'assets/Template/Admin/images/uploads/'.$request[$c]->portada;
			} 
       
		}
		return $request;
	}
}

?>