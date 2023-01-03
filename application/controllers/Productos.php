<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
    function __construct()
	{
        // metodo contructor para llamar el model
        parent::__construct();
        session_start();
        session_regenerate_id(true);

        if(empty($_SESSION['login']))
        {
           echo '<script>window.location.href="http://localhost/sitio-keops/login"</script>';				
        }
        $this->load->model("RolesModel");	
        $this->load->model("CategoriasModel");
        $this->load->model("ProductosModel");
        $this->load->model("Helpers");        
	     $this->Helpers->getPermisos(MPRODUCTOS); 	
	}
    //ver productos
  public function VerProductos()
   {
        if (empty($_SESSION['permisosMod']->r)){
            echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';	
        } 
       $datos = array(            
            'categoria'=>$this->CategoriasModel->listarCategorias(),
            'producto'=>$this->ProductosModel->listarProductos(),
        
          );  
        $this->load->view('layouts/Administrador/header_admin');
        $this->load->view('layouts/Administrador/body');		
        $this->load->view('layouts/Administrador/nav_admin');
        $this->load->view('layouts/Producto/Productos', $datos);
        $this->load->view('layouts/Administrador/footer_admin');
  }
 
  //insert productos
 public function setProductos()
 {		   

       if ($this->input->is_ajax_request()) {          

         if(empty($this->input->post("txtNombre"))|| empty($this->input->post('txtCodigo'))
         || empty($this->input->post('listCategoria')) ||   $Categoriaid = $this->input->post('listCategoria') == "Seleccionar.."
         || empty($this->input->post("listStatus")) || $status = $this->input->post("listStatus") == "Seleccionar.." || empty($this->input->post("USD"))){

            $resultado = (array('status' => false, 'msg' =>'Datos incorrectos.'));
         }else{
                  
            $idProducto =intval($this->input->post("idProducto"));						
            $nombre =$this->Helpers->strClean($this->input->post("txtNombre"));						
            $descripcion = $this->Helpers->strClean($this->input->post("txtDescripcion"));
            $codigo = $this->Helpers->strClean($this->input->post("txtCodigo"));
            $Categoriaid = $this->Helpers->strClean($this->input->post("listCategoria"));	
            $precio = strtolower($this->input->post("txtPrecio"));
            $stock = intval($this->input->post("txtStock"));
            $status = intval($this->input->post("listStatus"));
            $usd = $this->input->post("USD");	           
            $USD  = substr(  $precio / $usd, 0,5);
   
            $respuesta = $this->ProductosModel->ValidarProductos($nombre);  
            $respuestaCodigo = $this->ProductosModel->ValidarCodigo($codigo);  
            $respuesta = "";
            $ruta =$this->Helpers->clear_cadena( $nombre);
            $ruta = str_replace(" " , "-",$ruta);	
       
            //si el idi es igual a cero, quiere decir que vamos a crear un producto, ya que solo se envia el id cuando se va a actualizar
            if($idProducto == 0)
            { 	
                  if($respuesta == 1 || $respuestaCodigo  == 1 )
                  {
                     $resultado = (array('status'=>false,'msg' =>'¡Atención! ya existe un producto con este Nombre o Código Ingresado..'));	

                  }else if( $respuesta != 1 &&  $respuestaCodigo != 1 ){

                     if($_SESSION['permisosMod']->w) {
                        $respuesta = $this->ProductosModel->InsertProducto($nombre,
                                                                           $descripcion,                         $codigo,                                 
                                                                           $Categoriaid,
                                                                           $precio,
                                                                           $stock,
                                                                           $ruta,
                                                                           $status,
                                                                           $USD );          
                                                                    
                        $resultado = (array('status'=>true,'idproducto' => $respuesta, 'post' => 'Producto guardado con exito.'));	
                     }
                     
                     
                  }else{               
                        $resultado = (array('status'=>false,'msg' =>'No es posible almacenar los datos.'));			
                     } 	 						
           }else{             
                 //   //update   
                 if($_SESSION['permisosMod']->u) {
                   $respuesta = $this->ProductosModel->updateProducto($idProducto,
                                                                           $nombre,
                                                                           $descripcion,  
                                                                           $codigo,      
                                                                           $Categoriaid,
                                                                           $precio,
                                                                           $stock,  
                                                                           $ruta,                                
                                                                           $status,
                                                                           $USD 
                                                                        ); 

                                                             
                 }
                  
                  if($respuesta > 0){  

                      $resultado = (array('status'=>true, 'idproducto' => $idProducto, 'post' =>'Producto Actualizados correctamente.'));	

                  }if($respuesta == "exist"){              
                      
                     $resultado = (array('status'=>false,'msg' =>'¡Atención! ya existe un producto con este Código Ingresado..'));	
                                            
                  }if($respuesta < 1){ 
                      
                        $resultado = (array('status'=>false,'msg' =>'No es posible almacenar los datos.'));	
                       		
                  }                 
              }
         }
               
         echo json_encode($resultado,JSON_UNESCAPED_UNICODE);	

      } else {
        redirect('error');						
      }
     die();	
  }
 //guardar imagen en la db y en la carpeta upload del proyecto
  public function setImage(){
    
   if ($this->input->is_ajax_request()) {    
            
            if(empty( $this->input->post("idproducto"))){
               $result_image = array('status' => false, 'msg' => 'Error de datos.');
            }else{
               $idProducto   = intval($this->input->post("idproducto"));           
               $foto         = $_FILES['foto'];
               $imgNombre    = 'pro_'.md5(date('d-m-Y H:m:s')).'.jpg';  
                
               $result_image = $this->ProductosModel->insertarImage($idProducto, $imgNombre);
   
               if($result_image){

                  $uploadImage = $this->Helpers->uploadImage($foto,$imgNombre);
                  $result = array('status' => true, 'imgname' => $imgNombre, 'img' => 'Archivo cargado.');
               }else{
                  $result = array('status' => false, 'msg' => 'Error al cargar.');
               }
            }
            sleep(3);  
             echo json_encode( $result ,JSON_UNESCAPED_UNICODE);     
        
       }else {
         redirect('error');						
       }
       die();
  }

  //select productos para editarlo
  public function getProducto( $id){

   if ($this->input->is_ajax_request()) {  

      if($_SESSION['permisosMod']->r) {
           $idproducto = intval($id);     
            if($idproducto > 0){
               $datos  = $this->ProductosModel->selectProducto( $idproducto );
                  if(empty( $datos )){
                     $result= array('status' => false, 'msg' => 'Datos no encontrados.');
                  }else{
                     $arrImg = $this->ProductosModel->selectImages($idproducto);           
               
                     if(count($arrImg) > 0){                
                     
                        for ($i = 0; $i < count( $arrImg ); $i++){
                           $arrImg[$i]->url_image = base_url().'assets/Template/Admin/images/uploads/'. $arrImg[$i]->img;
                        
                        } 
                        $datos->images = $arrImg;             
                     }else{
                     
                           $arrImg['url_image'] = base_url().'assets/Template/Admin/images/uploads/';
                           $datos->images = $arrImg;   
                     }

                     $result =  array('status' => true, 'data' => $datos);
                  
                  }  
                  echo json_encode( $result ,JSON_UNESCAPED_UNICODE);                   
            }
         }else {
            redirect('error');						
         }
      }          
     die();
  }

  //delete producto
 public function delProducto(){

   if ($this->input->is_ajax_request()) {
      
         if($_SESSION['permisosMod']->d){

            $intIProducto = $this->input->post('id_delete');     
                    
            $respuesta = $this->ProductosModel->deleteProducto($intIProducto );
               
            if(empty($respuesta))
            {           
               $resultado = (array('status'=>true,'post' =>'Se ha eliminado el producto'));           
            }			
            else{
                  $resultado = (array('status'=>false,'msg' =>'Error al eliminar el producto'));
               }		
         }
           echo json_encode($resultado ,JSON_UNESCAPED_UNICODE);
      }else {
      redirect('error');						
   }	
 			
   die();	   
 }


//delete imagen
 public function delFile(){

      if($_POST){
            
         if(empty( $this->input->post('idproducto')) || empty( $this->input->post('file'))){
            $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
         }else{

               $idProducto = $this->input->post('idproducto');     
               $imgNombre  =  $this->Helpers->strClean($_POST['file']);
               $request_image = $this->ProductosModel->deleteImage($idProducto,$imgNombre);
      
         
               if($request_image > 0){
                  $deleteFile =   $this->Helpers->deleteFile($imgNombre);
                  $arrResponse = array('status' => true, 'post' => 'Archivo eliminado');
               }else{
                  $arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
               }
            }
        
         echo json_encode($arrResponse ,JSON_UNESCAPED_UNICODE);		
      }else {
         redirect('error');		
      }	    	
      die();	   
   }
 
}
