<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller 
{
    function __construct()
	{		// metodo contructor para llamar el model
     
        parent::__construct();
        session_start();
        session_regenerate_id(true);
		
        if(empty($_SESSION['login']))
        {
          echo '<script>window.location.href="http://localhost/sitio-keops/login"</script>';				
        }	
        $this->load->model("ClientesModel");
        $this->load->model("UsuariosModel");	
        $this->load->model("Helpers");
      
        $this->Helpers->getPermisos(MCLIENTES);  
	}	
    public function VerClientes()
    {  
          if(empty($_SESSION['permisosMod']->r)){
              echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';	
          }
          $datos = array(
            // 'rol'=>$this->RolesModel->getRoles(),
              'persona'=>$this->UsuariosModel->getRoles(),
              'persona'=>$this->ClientesModel->listarCliente()
            );            
        	// guardamos la consulta en la variable $rol, y los datos son traido del modelo
        
        $this->load->view('layouts/Administrador/header_admin');
        $this->load->view('layouts/Administrador/body');		
		    $this->load->view('layouts/Administrador/nav_admin');
	      $this->load->view('layouts/Cliente/clientes', $datos );
		    $this->load->view('layouts/Administrador/footer_admin');
    }
    //insert cliente
    public function SetCliente()
    {
        if ($this->input->is_ajax_request()) {

        
                  if(empty($identificacion = $this->input->post("stridentificacion")) || empty($nombre = $this->input->post("strNombre"))
                    || empty($apellido = $this->input->post("strApellido")) || empty( $telefono = $this->input->post("strTelefono"))
                    || empty($email = $this->input->post("strEmail")) || empty($Nit = $this->input->post("strNit")) || empty( $DirFiscal = $this->input->post("strDirFiscal"))
                    || empty( $NomFiscal = $this->input->post("strNombreFiscal")))
                {
                  $respuesta = array('status' => false, 'msg' => 'Todos los campos son obligatorios.');      
                }
                else
                {  
                      $idUsuario = $this->input->post("idUsuario");
                      $identificacion = $this->Helpers->strClean($this->input->post("stridentificacion"));
                      $nombre = ucwords($this->Helpers->strClean($this->input->post("strNombre")));
                      $apellido =ucwords($this->Helpers->strClean($this->input->post("strApellido")));
                      $telefono =intval($this->Helpers->strClean($this->input->post("strTelefono")));
                      $email = strtolower($this->Helpers->strClean($this->input->post("strEmail")));         
                      $Nit = $this->Helpers->strClean($this->input->post("strNit"));
                      $DirFiscal =$this->Helpers->strClean($this->input->post("strDirFiscal"));  
                      $NomFiscal =$this->Helpers->strClean($this->input->post("strNombreFiscal")); 
                      $intTipoId = 3;                  
            
                      $cedula = $this->UsuariosModel->ValidarUsuarios($identificacion);
                      $responseEmail = $this->UsuariosModel->ValidarEmail($email);
                                
                      if($cedula == true && $responseEmail == true)
                      {
                          $respuesta = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');
                      }
                      else
                      {                         
                        
                        //se genera el password si viene vacio de lo contrario se encripta
                            $password = empty($this->input->post("strPassword")) ? $this->Helpers->passGenerator():  $this->input->post("strPassword");
                            $passwordEncript =  hash("SHA256", $password );   

                          if($_SESSION['permisosMod']->w){                   
                                $datos = array(                      
                                    "identificacion"  => $identificacion,
                                    "nombres"         => $nombre,
                                    "apellidos"       => $apellido,
                                    "telefono"        => $telefono,
                                    "email_user"      => $email,
                                    "password"        => $passwordEncript,        
                                    "nit"             => $Nit,
                                    "nombrefiscal"    => $DirFiscal, 
                                    "direccionfiscal" => $NomFiscal,
                                    "rolid"           => $intTipoId,
                            
                                    );    
                                
                              if(empty($this->ClientesModel->InsertCliente($datos)))                  
                              {
                                $respuesta = array('status' => true, 'post' => 'Cliente agregado correctamente.'); 

                                  $nombreUsuario = $nombre.' '.$apellido;
                                  $dataUsuario = array(
                                  'nombreUsuario' => $nombreUsuario,
                                  'email'         =>$email,
                                  'password'      =>$password,
                                  'asunto'        =>'Bienvenido a tu tienda en línea',                               
                                  // 'empresa'       =>'Tienda Virtual',
                                  // 'web_empresa'   =>'http://localhost/sitio-keops/',
                                  );
                                  $this->Helpers->sendEmail($dataUsuario,'email_bienvenida');                

                              }                  
                              else
                              {     
                                $respuesta = array('status' => false, 'msg' => 'No es posible almacenar el cliente.');             
                                
                              }    
                          
                        }
                  }
             }
           echo json_encode(  $respuesta  ,JSON_UNESCAPED_UNICODE);    
      } else {
                redirect('error');						
      }  
        die();	
    }
    //Select clientes
    public function getCliente(int $idpersona)
    {        
          if ($this->input->is_ajax_request())
           {
             if ($_SESSION['permisosMod']->r){

                $idusuario = intval($idpersona);           
                if($idusuario > 0)
                {
                    $datos = $this->ClientesModel->selectCliente($idusuario);
                
                    if(empty($datos))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Datos no encontrados');
                    
                    }else
                    {
                        $respuesta = array('status' => true, 'post' => $datos);
                    }
                }
                echo json_encode($respuesta);
              }                  
        } else 
        {
          redirect('error');						
        } 
         die();
      }

    //edit Usuarios
    public function EditarCliente(int $idpersona)
     {    
        if ($this->input->is_ajax_request())
         { 
           if($_SESSION['permisosMod']->u){
                $idusuario = intval($idpersona);
                if($idusuario > 0)
                {
                    $datos = $this->ClientesModel->selectClientes($idusuario);
                
                    if(empty($datos))
                    {
                        $resultado = (array('status'=>false,'msg' =>'Datos no encontrado'));					
                    }
                    else
                    {
                        $resultado = (array('status'=>true,'post' =>$datos));						
                    }             
                }
             }
             echo json_encode($resultado,JSON_UNESCAPED_UNICODE);          
         } 
         else 
         {
          redirect('error');						
         } 
         die();  
     }

    //update de usuarios
    public function updateCliente()
    {
        if ($this->input->is_ajax_request()) {          
            
                $idcliente = $this->input->post("edit_idCliente");
                $identificacion = $this->input->post("edit_actualizar_identificacion");
                $nombres = $this->input->post("edit_actualizar_nombre");
                $apellidos = $this->input->post("edit_actualizar_apellidos");
                $telefono = $this->input->post("edit_actualizar_telefono");	
                $email_user = $this->input->post("edit_actualizar_email");                       
                $password = $this->input->post("edit_actualizar_password");	
                $nit = $this->input->post("edit_actualizar_nit");	
                $NomFiscal = $this->input->post("edit_actualizar_nombrefiscal");	
                $dirfiscal = $this->input->post("edit_actualizar_dirfiscal");	
                
         
                    $password = "";
            
                    if(!empty($this->input->post("edit_actualizar_password"))){
                        $password =  hash("SHA256",$_POST["edit_actualizar_password"]);               
                    
                    }              
                    if($_SESSION['permisosMod']->u){
                          $resultadoEm = $this->UsuariosModel->DiferenteEmail($email_user);
                          $resultadoId = $this->UsuariosModel->diferenteIdentificacion($identificacion);

                    
                          if($resultadoEm > 0)
                          {
                              $respuesta = (array('status' => false, 'msg' => 'El E-mail ya se encuentran registrado'));	
                          }
                          else if( $resultadoId > 0)
                          {
                              $respuesta = (array('status' => false, 'msg' => 'La identificación ya se encuentran registrado'));
                          }
                          else{
                        
                                  if($this->ClientesModel->updateCliente($identificacion,$nombres,$apellidos,
                                  $telefono,$email_user,$password,$nit,$NomFiscal,$dirfiscal,$idcliente)){
                                    $respuesta = (array('status' => true, 'post' => 'Cliente Actualizados con exito')); 
                                  }else{
                                    $respuesta = (array('status' => true, 'post' => 'El cliente no se pudo actualizar')); 
                                  };

                          };  	
                  }   
            echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);             
        }
        else
        {
		 	redirect('error');						
	    }  
         die();       
   	} 
    /**delete cliente */
    public function deleteCliente()
    {
        if ($this->input->is_ajax_request()) {
      
          if($_SESSION['permisosMod']->d){
               $intIdUsuario = $this->input->post('id_delete');      
                  
              $respuesta = $this->ClientesModel->delete($intIdUsuario );
                  
              if(empty($respuesta))
              {           
                  $resultado = (array('status'=>true,'post' =>'Se ha eliminado el Cliente'));           
              }			
              else{
                    $resultado = (array('status'=>false,'msg' =>'Error al eliminar el Cliente'));
                }		
          }
             echo json_encode($resultado ,JSON_UNESCAPED_UNICODE);			
        }else {
       redirect('error');						
      }	
      die();	   
    }	
    	
}

