<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
    function __construct()
	{
        // metodo contructor para llamar el model   
        parent::__construct();
        session_start();
        session_regenerate_id(true);

        if(empty($_SESSION['login']))
        {
           echo '<script>window.location.href="http://localhost/sitio-keops//login"</script>';				
        }
        $this->load->model("RolesModel");	
        $this->load->model("UsuariosModel");
        $this->load->model("Helpers");        
		$this->Helpers->getPermisos(MUSUARIOS); 
  	
	}	
    //ver usuarios
    public function VerUsuarios()
    {
        $datos = array(
            'rol'=>$this->RolesModel->getRoles(),
            'persona'=>$this->UsuariosModel->getRoles()
        );
        if (empty($_SESSION['permisosMod']->r)){
            echo '<script>window.location.href="http://localhost/sitio-keops//dashboard"</script>';	
        }    
 
        $this->load->view('layouts/Administrador/header_admin');
        $this->load->view('layouts/Administrador/body');		
		$this->load->view('layouts/Administrador/nav_admin');
	    $this->load->view('layouts/Usuarios/usuarios', $datos);
		$this->load->view('layouts/Administrador/footer_admin');
    }
    //insert usuarios
    public function InsertUsuario()
    {
        if ($this->input->is_ajax_request()) {
            
		   if(empty($identificacion = $this->input->post("stridentificacion")) || empty($nombre = $this->input->post("strNombre"))
           || empty($apellido = $this->input->post("strApellido")) || empty( $telefono = $this->input->post("strTelefono"))
           || empty($email = $this->input->post("strEmail")) || empty($intTipoid = $this->input->post("strRolid"))
           ||empty($status = $this->input->post("strStatus")) || $intTipoid = $this->input->post("strRolid") == "Seleccionar.." ||
           $status = $this->input->post("strStatus")== "Seleccionar.." )           {

             $respuesta = array('status' => false, 'msg' => 'Todos los campos son obligatorios.');                   
              
           }
           else
           {                   
                $identificacion = intval($this->Helpers->strClean($this->input->post("stridentificacion")));
                $nombre = ucwords($this->Helpers->strClean($this->input->post("strNombre")));
                $apellido =ucwords($this->Helpers->strClean($this->input->post("strApellido")));
                $telefono =intval($this->Helpers->strClean($this->input->post("strTelefono")));
                $email = strtolower($this->Helpers->strClean($this->input->post("strEmail")));         
                $intTipoid = intval($this->Helpers->strClean($this->input->post("strRolid")));
                $status = intval($this->Helpers->strClean($this->input->post("strStatus")));  
                                  
                $cedula = $this->UsuariosModel->ValidarUsuarios($identificacion);
                $responseEmail = $this->UsuariosModel->ValidarEmail($email);
              
                if($cedula == true || $responseEmail == true)
                {
                    $respuesta = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');
                }
                else
                {                       
                        //genera el password si viene vacio de lo contrario el que ingreso el usuario
                        $password = empty($this->input->post("strPassword")) ? $this->Helpers->passGenerator():  $this->input->post("strPassword");
                        $passwordEncript =  hash("SHA256", $password );  
           
                   if($_SESSION['permisosMod']->w){

                            $datos = array(
                                "idpersona"       => '',
                                "identificacion"  => $identificacion,
                                "nombres"         => $nombre,
                                "apellidos"       => $apellido,
                                "telefono"        => $telefono,
                                "email_user"      => $email,
                                "password"        => $passwordEncript,        
                                "rolid"           => $intTipoid,
                                "status"          => $status,                                 
                                );                                
                           
                            if($this->UsuariosModel->InsertarUsuario( $datos) == true)
                            {    
                        
                                $respuesta = array('status' => true, 'post' => 'Usuario agregado correctamentes.');

                                $nombreUsuario = $nombre.' '.$apellido;
                                $dataUsuario = array(
                                'nombreUsuario' => $nombreUsuario,
                                'emailC'         =>$email,
                                'password'      =>$password,
                                'asunto'        =>'Bienvenido a tu tienda en línea',                              
                               
                                );
                                $this->Helpers->sendEmail($dataUsuario,'email_bienvenida');
                             
                            }                  
                            else{                         
                                $respuesta = array('status' => false, 'msg' => 'No es posible agregar el usuario.');
                            }  
                     }
                }   
            }     
            echo json_encode($respuesta ,JSON_UNESCAPED_UNICODE);

      } else {
        redirect('error');						
      }          
    
      die();	
    }

    //Select Usuarios
    public function getUsuario(int $idpersona)
    {
        if ($this->input->is_ajax_request())
         {
           if ($_SESSION['permisosMod']->r){
                $idusuario = intval($idpersona);
                if($idusuario > 0)
                {
                    $datos = $this->UsuariosModel->selectUsuario($idusuario);
                
                    if(empty($datos))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Datos no encontrados');
                    
                    }else
                    {
                        $respuesta = array('status' => true, 'post' => $datos);
                    }
                }
                echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
             }
                    
      }else {
        redirect('error');						
      } 
       die();
    }

    //edit Usuarios
    public function EditarUsuario(int $idpersona)
    {    
       if ($this->input->is_ajax_request())
        { 
            if ($_SESSION['permisosMod']->r){
                $idusuario = intval($idpersona);
                if($idusuario > 0)
                {
                    $datos = $this->UsuariosModel->selectusuarios($idusuario);
                
                    if(empty($datos))
                    {
                        $resultado = (array('status'=>false,'msg' =>'Datos no encontrado'));					
                    }
                    else
                    {
                        $resultado = (array('status'=>true,'post' =>$datos));						
                    }
                         
                } 
                echo json_encode($resultado,JSON_UNESCAPED_UNICODE);    
            }
        } 
        else 
        {
         redirect('error');						
        } 
        die();  
    }

    //update de usuarios
    public function updateUsuario()
    {
        if ($this->input->is_ajax_request()) {          
            
                $idpersona = $this->input->post("edit_idUsuario");
                $identificacion = $this->input->post("edit_actualizar_identificacion");
                $nombres = $this->input->post("edit_actualizar_nombre");
                $apellidos = $this->input->post("edit_actualizar_apellidos");
                $telefono = $this->input->post("edit_actualizar_telefono");	
                $email_user = $this->input->post("edit_actualizar_email");                       
                $status = $this->input->post("edit_actualizar_status");	
                $rolid = $this->input->post("edit_actualizar_rol");	
       
                if(empty($rolid) || $rolid == "Seleccionar.." ){
                                 
                    $respuesta = (array('status' => false, 'msg' => 'El campo rol es obligatorio'));
                }else if($status == "Seleccionar.."){
                                 
                    $respuesta = (array('status' => false, 'msg' => 'El campo estado es obligatorio'));
                }else{                
                    $password = "";
            
                    if(!empty($this->input->post("edit_actualizar_password"))){
                        $password =  hash("SHA256",$_POST["edit_actualizar_password"]);               
                    
                    }   

                    if($_SESSION['permisosMod']->d){

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
                                                                 
                                        if($this->UsuariosModel->updateUsuario($identificacion,$nombres,$apellidos,$password,
                                        $telefono,$email_user,$rolid,$status,$idpersona)){
                                            $respuesta = (array('status' => true, 'post' => 'Usuario Actualizados con exito')); 
                                        }else{
                                            $respuesta = (array('status' => false, 'post' => 'El usuario no se pudo actualizar')); 
                                        };

                                };  
                    }	
              	
                }     
           
             echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
             
        }
        else
        {
			redirect('error');						
	    }  
          die();      
	}
    /**delete usuario */
	public function deleteUsuario()
    {
        if ($this->input->is_ajax_request()) {
            
            if ($_SESSION['permisosMod']->d){
                    $intIdUsuario = $this->input->post('id_delete');
                        
                    $respuesta = $this->UsuariosModel->delete($intIdUsuario );
                
                    if(empty($respuesta))
                    {           
                        $resultado = (array('status'=>true,'post' =>'Se ha eliminado el Usuario'));           
                    }			
                    else{
                        $resultado = (array('status'=>false,'msg' =>'Error al eliminar el Usuario'));
                        }	
                 echo json_encode($resultado ,JSON_UNESCAPED_UNICODE);
            }	  	
        }else {
			redirect('error');						
	    }	
       			
	    die();	   
    }	
    public function perfil(){

        $this->load->view('layouts/Administrador/header_admin');
        $this->load->view('layouts/Administrador/body');		
		$this->load->view('layouts/Administrador/nav_admin');
	    $this->load->view('layouts/Usuarios/perfil');
		$this->load->view('layouts/Administrador/footer_admin');
    }
    public function PutPerfil(){
      
        if ($this->input->is_ajax_request()) {
            if(empty($this->input->post("strIdentificacion")) || empty( $this->input->post("strNombre"))
            || empty($this->input->post("strApellido")) || empty( $this->input->post("strTelefono")))
            {
                $respuesta = array('status' => false, 'msg' => 'Datos incorrectos.');              
            }else{
                
                $idUsuario = $_SESSION['idUser'];
                $identificacion = $this->input->post("strIdentificacion");
                $nombre = $this->input->post("strNombre");
                $apellido = $this->input->post("strApellido");
                $telefono =intval($this->input->post("strTelefono"));             
                $password = "";

                if(!empty($this->input->post("strPassword"))){
                    $password =  hash("SHA256",$_POST["strPassword"]);
                   
                }               

                   $respuesta = $this->UsuariosModel->updatePerfil( $identificacion, $nombre, $apellido, $telefono, $password, $idUsuario);
               
                if($respuesta)
                {
                    $resultados = $this->Helpers->sessionUser($_SESSION['idUser']);
                    $_SESSION['userData'] = $resultados;
                    
                     $resultado = (array('status' => true, 'post' => 'Datos Actualizados con exito'));   

                }else
                {
                     $resultado = (array('status' => false, 'msg' => 'No es posible almacenar los datos.'));   
                }                
          
                 echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
               
            }    
        }else{
            redirect('error');	
        }
        die();
    }
    //actualizar datos fiscales
    public function PutFiscal(){      
       
        if ($this->input->is_ajax_request()) {
            if(empty($this->input->post("strNit")) || empty( $this->input->post("strNombreFiscal"))
            || empty($this->input->post("strDireccionFiscal")))
            {
                $respuesta = array('status' => false, 'msg' => 'Datos incorrecto.');              
            }else{
                
                $idUsuario = $_SESSION['idUser'];
                $nit = $this->input->post("strNit");
                $nombreFiscal = $this->input->post("strNombreFiscal");
                $dirFiscal = $this->input->post("strDireccionFiscal"); 

                $respuesta = $this->UsuariosModel->updateFiscal( $nit, $nombreFiscal, $dirFiscal, $idUsuario);
  
                if($respuesta)
                {
                    $resultados = $this->Helpers->sessionUser($_SESSION['idUser']);
                    $_SESSION['userData'] = $resultados;
                    
                     $resultado = (array('status' => true, 'post' => 'Datos Actualizados con exito'));   

                }else
                {
                     $resultado = (array('status' => false, 'msg' => 'No es posible almacenar los datos.'));   
                }              
                echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
             
              
            }    
        }else{
            redirect('error');	
        } 
        die();
    }
}