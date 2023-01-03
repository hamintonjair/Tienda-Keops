<?php
//extends para heredar
   defined('BASEPATH') OR exit('No direct script access allowed');

   class TproductosModel extends CI_Model
   {
       //funcion para solicitar los datos que se solicitan en modelos
    public function __construct()
   {
        parent::__construct();
   } 
       //cargar todos los productos a la vista
   public function getProducto()
   {		 
         $this->db->select("p.idproducto,p.codigo,p.nombre,p.descripcion,p.categoriaid,c.nombre as categoria,p.precio,p.ruta,p.stock,p.USD");
         $this->db->from("producto p");
         $this->db->join("categoria c", "p.categoriaid = c.idcategoria");     
         $this->db->where("p.categoriaid != 7");
         $this->db->where("p.categoriaid != 8");
         $this->db->where("p.categoriaid != 9");
         $this->db->where("p.status != 0"); 
         $this->db->order_by('p.idproducto DESC ');            
         $this->db->LIMIT(CANTPORDHOME);  
         $result = $this->db->get()->result();        
        
         if(count($result) > 0 ){
            for ($c=0; $c < count($result) ; $c++) { 
               $idProducto = $result[$c]->idproducto;
            
               $this->db->select('img');
               $this->db->from('imagen');
               $this->db->where('productoid', $idProducto);

                $arImg = $this->db->get()->result();              
                 
               if(count($arImg) > 0){                
     
                    for ($i=0; $i < count($arImg) ; $i++) { 
                        $arImg[$i]->url_image = base_url().'assets/Template/Admin/images/uploads/'.$arImg[$i]->img;
                      
                     }                                     
               }
                    $result[$c]->images =  $arImg;        
            }              
         } 
           return  $result ;
   }   

    //cargar los productos por nombre
   public function getProductos($idproducto,$ruta)
   {		 
   
         $this->db->select("p.idproducto,p.codigo,p.nombre,p.descripcion,p.categoriaid,c.nombre as categoria, c.ruta as ruta_categoria,
         p.precio,p.ruta,p.stock,p.USD ");
         $this->db->from("producto p");
         $this->db->join("categoria c", "p.categoriaid = c.idcategoria");     
         $this->db->where("p.status != 0");     
         $this->db->where("p.idproducto",$idproducto);       
         $this->db->where("p.ruta", $ruta);  

         $result = $this->db->get()->result();        
       
         if(!empty($result)){
            
            for ($c=0; $c < count($result) ; $c++) { 
               $idProducto = $result[$c]->idproducto;
              
               $this->db->select('img');
               $this->db->from('imagen');
               $this->db->where('productoid', $idProducto);

                $arImg = $this->db->get()->result();              
             
               if(count($arImg) > 0){                
                 
                    for ($i=0; $i < count($arImg) ; $i++) { 
                        $arImg[$i]->url_image = base_url().'assets/Template/Admin/images/uploads/'.$arImg[$i]->img;
                      
                     }                               
               }
                        
                $result[$c]->images =  $arImg;      
        
            }              
         } 
           return  $result ;
   }   
       //extraer productos randows
    public function getProductosRandow($idcategoria,$cant,$option)
   {       
 
         if($option == "r"){

            $option = 'RAND()';

         }else if($option == "a"){

            $option = 'idproducto ASC';
         }else{

            $option = 'idproducto DESC';
         }       
               $this->db->select("p.idproducto,p.codigo,p.nombre,p.descripcion,p.categoriaid,c.nombre as categoria,p.precio,p.ruta,p.stock,p.USD ");
               $this->db->from("producto p");
               $this->db->join("categoria c", "p.categoriaid = c.idcategoria");     
               $this->db->where("p.status != 0");  
               $this->db->where("p.categoriaid", $idcategoria);              
               $this->db->order_by($option);          
               $this->db->limit( $cant);

               $result = $this->db->get()->result();      
               
                  
               if(!empty($result) > 0 ){
                  for ($c=0; $c < count($result) ; $c++) { 
                     $idProducto = $result[$c]->idproducto;
                  
                     $this->db->select('img');
                     $this->db->from('imagen');
                     $this->db->where('productoid', $idProducto);
      
                        $arImg = $this->db->get()->result();              
                        
                     if(count($arImg) > 0){                
            
                           for ($i=0; $i < count($arImg) ; $i++) { 
                              $arImg[$i]->url_image = base_url().'assets/Template/Admin/images/uploads/'.$arImg[$i]->img;
                              
                           }                                     
                     }
                      $result[$c]->images =  $arImg;        
                  }              
            }           
      return  $result ; 
   }
     //productos para el carrito
   public function  getProductoIDT($idproducto)
   {	               
            $this->db->select("p.idproducto,p.codigo,p.nombre,p.descripcion,p.categoriaid,c.nombre as categoria,p.precio,p.ruta,p.stock,p.USD ");
            $this->db->from("producto p");
            $this->db->join("categoria c", "p.categoriaid = c.idcategoria");     
            $this->db->where("p.status != 0");     
            $this->db->where("p.idproducto",$idproducto);       
         
   
            $result = $this->db->get()->result();        
          
            if(!empty($result)){
               
               for ($c=0; $c < count($result) ; $c++) { 
                  $idProducto = $result[$c]->idproducto;
                 
                  $this->db->select('img');
                  $this->db->from('imagen');
                  $this->db->where('productoid', $idProducto);
   
                   $arImg = $this->db->get()->result();              
                
                  if(count($arImg) > 0){                
                    
                       for ($i=0; $i < count($arImg) ; $i++) { 
                           $arImg[$i]->url_image = base_url().'assets/Template/Admin/images/uploads/'.$arImg[$i]->img;
                         
                        }                               
                  }                              
                   $result[$c]->images =  $arImg;      
           
               }              
            } 
              return  $result ;
   } 
   //paginacion
   public function getProductoPage($desde, $porpagina)
   {	                
			$result = $this->db->query("SELECT p.idproducto,
               p.codigo,
               p.nombre,
               p.descripcion,
               p.categoriaid,
               c.nombre as categoria,
               p.precio,
               p.ruta,
               p.stock,
               p.USD
         FROM producto p 
         INNER JOIN categoria c
         ON p.categoriaid = c.idcategoria
         WHERE p.status = 1  AND p.categoriaid != 7 AND p.categoriaid != 8
          AND p.categoriaid != 9  ORDER BY p.idproducto DESC LIMIT $desde,$porpagina")->result();

      
         if(count($result) > 0 ){
            for ($c=0; $c < count($result) ; $c++) { 
               $idProducto = $result[$c]->idproducto;
            
               $this->db->select('img');
               $this->db->from('imagen');
               $this->db->where('productoid', $idProducto);

                $arImg = $this->db->get()->result();              
                 
               if(count($arImg) > 0){                
     
                    for ($i=0; $i < count($arImg) ; $i++) { 
                        $arImg[$i]->url_image = base_url().'assets/Template/Admin/images/uploads/'.$arImg[$i]->img;
                      
                     }                                     
               }
                    $result[$c]->images =  $arImg;        
            }              
         } 

           return  $result ;
   }  
    //paginacion servicios
    public function getServiciosPage($desde, $porpagina)
    {	                
          $result = $this->db->query("SELECT p.idproducto,
                p.codigo,
                p.nombre,
                p.descripcion,
                p.categoriaid,
                c.nombre as categoria,
                p.precio,
                p.ruta,
                p.stock,
                p.USD
          FROM producto p 
          INNER JOIN categoria c
          ON p.categoriaid = c.idcategoria
          WHERE p.status = 1 AND p.categoriaid != 1 AND p.categoriaid != 2
          AND p.categoriaid != 3 AND p.categoriaid != 4 AND p.categoriaid != 5
          AND p.categoriaid != 6 ORDER BY p.idproducto DESC LIMIT $desde,$porpagina")->result();
 
       
          if(count($result) > 0 ){
             for ($c=0; $c < count($result) ; $c++) { 
                $idProducto = $result[$c]->idproducto;
             
                $this->db->select('img');             
                $this->db->from('imagen');
                $this->db->where('productoid', $idProducto);
 
                 $arImg = $this->db->get()->result();              
                  
                if(count($arImg) > 0){                
      
                     for ($i=0; $i < count($arImg) ; $i++) { 
                         $arImg[$i]->url_image = base_url().'assets/Template/Admin/images/uploads/'.$arImg[$i]->img;
                       
                      }                                     
                }
                     $result[$c]->images =  $arImg;        
             }              
          } 
 
            return  $result ;
    } 
       //cargar la categorias en el sitio
   public function getProductosCategorias($idcategoria,$ruta)
   {	        
              
                $this->db->select("idcategoria, nombre");
                $this->db->from("categoria");
                $this->db->where("idcategoria", $idcategoria);
                $data = $this->db->get()->result(); 
           
                if(!empty($data)){
    
                   for ($i=0; $i < count($data) ; $i++) { 
                         $nCatergoria = $data[$i]->nombre;
                         // $nRuta= $data[$i]->ruta;
                         
                   }                                
                      $this->db->select("p.idproducto,p.codigo,p.nombre,p.descripcion,p.categoriaid,c.nombre as categoria,p.precio,
                      p.ruta,p.stock,p.USD");
                      $this->db->from("producto p");
                      $this->db->join("categoria c", "p.categoriaid = c.idcategoria");     
                      $this->db->where("p.status != 0");  
                      $this->db->where("p.categoriaid", $idcategoria );          
                      $this->db->where("c.ruta", $ruta);   
                      $result = $this->db->get()->result();                      
                    
                      if(count($result) > 0 ){
                         for ($c=0; $c < count($result) ; $c++) { 
                            $idProducto = $result[$c]->idproducto;
                         
                            $this->db->select('img');
                            $this->db->from('imagen');
                            $this->db->where('productoid', $idProducto);
             
                               $arImg = $this->db->get()->result();              
                               
                            if(count($arImg) > 0){                
                   
                                  for ($i=0; $i < count($arImg) ; $i++) { 
                                     $arImg[$i]->url_image = base_url().'assets/Template/Admin/images/uploads/'.$arImg[$i]->img;
                                     
                                  }                                     
                            }  
                                  $result[$c]->images =  $arImg;                        
                              
                         }              
                      } 
                      $result = array(
                                       'idcategoria' => $idcategoria,
                                        // 'ruta' => $this->$nRuta,
                                        'categoria' => $nCatergoria,
                                        'productos' => $result
                                     );
                } 
                       
               return $result ; 
   } 
   //paginacion categoria
   public function getProductosCategoriasP($idcategoria ,$ruta , $desde = null, $porpagina = null)
   {	        
               $this->strRuta = $ruta;    
               $where = "";
                if(is_numeric($desde) AND is_numeric($porpagina)){
                     $where = " LIMIT ".$desde.",".$porpagina;
                }
     
                 $data = $this->db->query("SELECT idcategoria, nombre,ruta FROM 
                 categoria WHERE idcategoria = $idcategoria")->result();

                if(!empty($data)){
    
                   for ($i=0; $i < count($data) ; $i++) { 
                         $nCatergoria = $data[$i]->nombre;
                          $nRuta= $data[$i]->ruta;                     
                     
                   }   
                   
                   $result = $this->db->query("SELECT p.idproducto,
                              p.codigo,
                              p.nombre,
                              p.descripcion,
                              p.categoriaid,
                              c.nombre as categoria,
                              p.precio,
                              p.ruta,
                              p.stock,
                              p.USD
                              FROM producto p 
                              INNER JOIN categoria c
                              ON p.categoriaid = c.idcategoria
                              WHERE p.status != 0 AND p.categoriaid = $idcategoria AND c.ruta = '{$this->strRuta}'
				                	ORDER BY p.idproducto DESC  ". $where)->result();                                          
                    
                      if(count($result) > 0 ){
                         for ($c=0; $c < count($result) ; $c++) { 
                           $idProducto = $result[$c]->idproducto;
                         
                            $arImg = $this->db->query("SELECT img FROM imagen WHERE productoid = $idProducto")->result();
                                                                   
                            if(count($arImg) > 0){                
                   
                                  for ($i=0; $i < count($arImg) ; $i++) { 
                                     $arImg[$i]->url_image = base_url().'assets/Template/Admin/images/uploads/'.$arImg[$i]->img;
                                     
                                  }                                     
                            }  
                             $result[$c]->images =  $arImg;                                              
                         }              
                      } 
                      $result = array(
                                       'idcategoria' => $idcategoria,
                                        'ruta' => $nRuta,
                                        'categoria' => $nCatergoria,
                                        'productos' => $result
                                     );
                } 
            
               return $result ; 
   } 
   //cantidad de productos para ver mas
   public function cantProductos($categoria = null){

      $this->db->select('COUNT(*) as total_registro');		
      $this->db->from('producto');
      $this->db->where('categoriaid != 7'); 
      $this->db->where('categoriaid != 8'); 
      $this->db->where('categoriaid != 9'); 
      $this->db->where('status = 1'); 

      if($categoria != null){
           $this->db->where('categoriaid ',$categoria);
		}    
      $request = $this->db->get()->result();

		return $request;

	}
   public function cantServicios($categoria = null){

      $this->db->select('COUNT(*) as total_registro');		
      $this->db->from('producto');
      $this->db->where('categoriaid != 1'); 
      $this->db->where('categoriaid != 2'); 
      $this->db->where('categoriaid != 3'); 
      $this->db->where('categoriaid != 4'); 
      $this->db->where('categoriaid != 5'); 
      $this->db->where('categoriaid != 6'); 
      $this->db->where('status = 1'); 

      if($categoria != null){
           $this->db->where('categoriaid ',$categoria);
		}    
      $request = $this->db->get()->result();

		return $request;

	}
   //paginacion enm busqueda
	public function cantProdSearch($busqueda){
	
		$total_registro = $this->db->query("SELECT COUNT(*) as total_registro 
                                           FROM producto
                                           WHERE nombre LIKE '%$busqueda%' 
                                           AND status = 1 ")->result();	
                                        
		return $total_registro;
	}
   //busqueda
	public function getProdSearch($busqueda, $desde, $porpagina){
	
      $request  = $this->db->query("SELECT p.idproducto,
						p.codigo,
						p.nombre,
						p.descripcion,
						p.categoriaid,
						c.nombre as categoria,
						p.precio,
						p.ruta,
						p.stock,
                  p.USD
				FROM producto p 
				INNER JOIN categoria c
				ON p.categoriaid = c.idcategoria
				WHERE p.status = 1 AND p.nombre LIKE '%$busqueda%' ORDER BY p.idproducto DESC LIMIT $desde,$porpagina")->result();
		
				if(count($request) > 0){
					for ($c=0; $c < count($request) ; $c++) { 
						$intIdProducto = $request[$c]->idproducto;

						$arrImg = $this->db->query("SELECT img
								FROM imagen
								WHERE productoid = $intIdProducto")->result();
					   
						if(!empty($arrImg)){
                
							for ($i=0; $i < count($arrImg); $i++) { 
                        $arrImg[$i]->url_image = base_url().'assets/Template/Admin/images/uploads/'.$arrImg[$i]->img;					
							}
						}
                  $request[$c]->images =  $arrImg;      
					}
				}
		return $request;
	}


}

?>