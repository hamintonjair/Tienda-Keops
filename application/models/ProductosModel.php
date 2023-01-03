<?php
//extends para heredar
   defined('BASEPATH') OR exit('No direct script access allowed');

   class ProductosModel extends  CI_Model
   {
       //funcion para solicitar los datos que se solicitan en modelos
    public function __construct()
   {
        parent::__construct();
   } 
    //listar los productos para mostrar en la vista principal
    public function listarProductos()
    {		            
       $this->db->select("p.idproducto,p.codigo,p.nombre,p.descripcion,p.categoriaid,c.nombre as categoria,p.precio,p.stock,p.status,p.USD ");
       $this->db->from("producto p");
       $this->db->join("categoria c", "p.categoriaid = c.idcategoria");     
       $this->db->where("p.status != 0");   
       return $this->db->get()->result();  
      
    } 
    //validar si ya existe un producto con el nombre enviado
    public function ValidarProductos($nombre){
      $this->db->select('nombre');
      $this->db->from('producto'); 
      $this->db->where('nombre', $nombre);  
      $resultado = $this->db->get(); 

      if($resultado->num_rows() > 0)
      {      
            return 1;
      }else{
         return 0;
      }	  	
    }
    public function ValidarCodigo($codigo){
      $this->db->select('codigo');
      $this->db->from('producto'); 
      $this->db->where('codigo', $codigo);  
      $resultado = $this->db->get(); 

      if($resultado->num_rows() > 0)
      {      
            return 1;
      }else{
         return 0;
      }	  	
    }
    public function ValidarCodigov($codigo,$idProducto){
     
      $this->db->select('codigo');
      $this->db->from('producto'); 
      $this->db->where('codigo', $codigo);  
      $this->db->where('idproducto', $idProducto);  
      $resultado = $this->db->get(); 

      if($resultado->num_rows() > 0)
      {      
            return 1;
      }else{
         return 0;
      }	  	
    }
     //insertamos un producto 
   public function InsertProducto( $nombre,$descripcion,$codigo,$Categoriaid,$precio,$stock,$ruta,$status, $USD ){   
  
     $datos = array(			
            "nombre"        => $nombre,
            "descripcion"   => $descripcion,
            "codigo"        => $codigo,
            "categoriaid"   => $Categoriaid,	
            "precio"        => $precio,
            "stock"         => $stock,
            "ruta"          => $ruta,
            "status"        => $status,	
            "USD"           => $USD,	
                     
            );
        $result = $this->db->insert('producto',$datos);

        if($result == true){
          $this->db->select('idproducto');
          $this->db->from('producto'); 
          $this->db->where('codigo', $codigo);         

          $resultado = $this->db->get();
              
          if($resultado->num_rows() > 0)
          {
              return $resultado->row();
            }else{
              return false;
          }
        }
        
  
   }
   //update producto
   function updateProducto($idProducto,$nombre,$descripcion,$codigo,$Categoriaid,$precio,$stock,$ruta,$status,$USD){
     
     
      $this->db->select('*');  
      $this->db->from('producto');  
      $this->db->where("codigo = '{$codigo}' and idproducto != '{$idProducto}'");     
      $resultado = $this->db->get()->result();   

      if(empty($resultado)){
       
         $this->db->where( "idproducto",$idProducto);
         $this->db->SET( "nombre","");
         $this->db->SET( "descripcion","");   
         $this->db->SET( "codigo","");         
         $this->db->SET( "categoriaid","");
         $this->db->SET( "precio","");
         $this->db->SET( "stock","");
         $this->db->SET( "ruta","");
         $this->db->SET( "status","");    
         $this->db->SET( "USD","");    
           

         $datos = array(   
            
            "nombre"        => $nombre,
            "descripcion"   => $descripcion,  
            "codigo"        => $codigo,              
            "categoriaid"   => $Categoriaid,	
            "precio"        => $precio,
            "stock"         => $stock,
            "ruta"          => $ruta,
            "status"        => $status,	
            "USD"           => $USD,		
               
         );     
       
      }else{        
      
           return 'exist';
       }

      $resultado= $this->db->update('producto', $datos); 

      if($resultado)
       {      
             return 1;
       }else{
          return 0;
       }	 
         
     
   }
   //insertar imagen
   function insertarImage($idproducto, $imagen){

      $datos = array(
         'productoid' => $idproducto,
         'img' => $imagen
      );

      return $this->db->insert('imagen', $datos );
   }
   //selecionar los productos
   function selectProducto( $idproducto){

      $this->db->select("p.idproducto,p.codigo,p.nombre,p.descripcion,p.precio,p.stock,p.categoriaid,c.nombre as categoria,p.status,p.USD ");
      $this->db->from("producto p");
      $this->db->join("categoria c", "p.categoriaid = c.idcategoria");     
      $this->db->where("idproducto", $idproducto);   
      $resultados = $this->db->get();
      
      if($resultados->num_rows() > 0)
          {
          return $resultados->row();
          }	

   }
   //seleccionar imagen
   function selectImages($idproducto){

      $this->db->select("productoid, img");
      $this->db->from("imagen");
      $this->db->where("productoid", $idproducto);   
      return $this->db->get()->result(); 
 
   }
   //delete imagen
   public function deleteImage($idproducto, $imagen){

      $this->db->where("productoid = '{$idproducto}' and img = '{$imagen}'");  
       return $this->db->delete('imagen');

   }
   //delete producto
	function deleteProducto( $idproducto){    
     
      // $result = $this->db->update(" producto set status = ? WHERE idproducto = '{$idProducto}'");   

      $this->db->where('idproducto ', $idproducto);   
      $this->db->delete( "producto");    
     
	}

}
