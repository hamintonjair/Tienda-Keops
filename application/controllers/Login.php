<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
 	  {	
       
      session_start();    
      if(isset($_SESSION['login']))
      {
        echo '<script>window.location.href="http://localhost/sitio-keops/dashboard"</script>';				
      }
      parent:: __construct();
      $this->load->model("UsuariosModel");	
      $this->load->model("AuthModel");
      $this->load->model("Helpers");
  	}	

    public function Login()
    {      
      $this->load->view('layouts/Login/login');
    }    
	 //inicio de sesion
    public function LoginUser()
    {    
      if ($this->input->is_ajax_request()) { 

          if(empty($this->input->post('strEmail') || empty($this->input->post('strPassword'))))
          {
            $resultados = (array('status'=>false,'msg' =>'Error de datos'));			
          }
          else
          {
              $email_user = strtolower($this->Helpers->strClean($this->input->post('strEmail')));          
              $password =  hash("SHA256",$_POST["strPassword"]);

              $respuesta = $this->AuthModel->ValidarLogin( $email_user, $password);            
              
              if(empty($respuesta))
              {
                 $resultados = (array('status'=>false,'msg' =>'El usuario o la Contraseña es incorrecto'));	
              }else{

                  if($respuesta->status == 1)
                    {   //funcion para poder las variables de sesion       
                      $_SESSION['idUser'] = $respuesta->idpersona;
                      $_SESSION['login'] = true;  
                      $_SESSION['timeout'] = true; 
                      $_SESSION['inicio'] = time();  

                   //  $datos = $this->AuthModel->sessionLogin($_SESSION['idUser']);    
                      //se almacenan los datos de ese usuario en la variable de session 

                      $datos =  $this->Helpers->sessionUser($_SESSION['idUser']);  
                      $_SESSION['userData'] = $datos;             
                      $resultados = (array('status'=>true, 'post' => 'Logueado'));					
                      
                    }else{
                        $resultados = (array('status'=>false,'msg' =>'Usuario inactivo'));				
                    }
              }   
           }  
            echo json_encode($resultados ,JSON_UNESCAPED_UNICODE);	          
      }else 
      {
        redirect('error');
                
      }	
          sleep(2);     		
      die();
    }	
    //cerrando al login
     public function Logout()
    {    
      session_unset();
      session_destroy();      
      echo '<script>window.location.href="http://localhost/sitio-keops/login"</script>';				

    }
    //reseteando el password
    public function resetPass()
    {
      if($this->input->is_ajax_request()){

        if(empty($this->input->post('txtEmailReset'))){

          $resultados= array('status' =>false, 'msg' => 'Error de datos.');

        }else{

            $token = $this->Helpers->token();
            $strEmail = strtolower($this->Helpers->strClean($this->input->post('txtEmailReset')));
            $data = $this->AuthModel->getUserEmail($strEmail);

            if(empty($data)){

              $resultados = array('status' =>false, 'msg' => 'Usuario no existente.');

            }else{

              $idpersona = $data->idpersona;
              $nombreUsuario = $data->nombres.' '.$data->apellidos;

              $url_recovery = base_url().'login/confirmUser/'.$strEmail.'/'.$token;
              $resultadoUpdate = $this->AuthModel->setTokenUser($idpersona,$token);
            
              $dataUsuario = array(
                'nombreUsuario' => $nombreUsuario,
                'email'         =>$strEmail,
                'asunto'        =>'Recuperar cuenta',
                'url_recovery'  =>$url_recovery,
                'empresa'       =>'Tienda Virtual',
                'web_empresa'   =>'http://localhost/sitio-keops/',
              );         

              if($resultadoUpdate){

                   $senEmail = $this->Helpers->sendEmail($dataUsuario,'email_cambioPassword');                

                        if($senEmail == true)
                        {                                       
                          $resultados = array('status' => true, 'post' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña.');
                        }else{

                          $resultados = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta más tarde.');
                        }                
             
              }else{

                $resultados = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta más tarde.');
              }  
            }
        }     
          echo json_encode($resultados,JSON_UNESCAPED_UNICODE);	    
      }else{
        redirect('error');
      }
       sleep(3); 
       die();
    }
    //confirmacion del token para cambio de contraseña
    public function confirmUser($params = "",$params1= "")
    {    
      if(empty($params) || empty($params1)){
       
          echo '<script>window.location.href="http://localhost/Tienda-online"</script>';			
      }
      else
      {
        //explode convierte en un array la cadena y lo separamos por coma
        $arrParams = explode(',',$params);
        $arrParams1 = explode(',',$params1);
        $strEmail = $this->Helpers->strClean($arrParams[0]);
        $strToken = $this->Helpers->strClean($arrParams1[0]);

        $datos =  $this->AuthModel->getUsuario($strEmail,$strToken);       
       
        if(empty($datos)){         
          echo '<script>window.location.href="http://localhost/Tienda-online"</script>';			
        }
        else
        {           
          $data = array(
            "idpersona" => $datos->idpersona,
            "email" => $strEmail,
            "token" => $strToken,
          );             
          $this->load->view('layouts/Login/cambiar_Password',$data);
        }      
      } 
    }
    //validando los datos obtenidos y actulizamos la contraseña
    public function setPassword()
    {
      if($this->input->is_ajax_request()){

          if(empty($this->input->post('idUsuario') || empty($this->input->post('strEmail')) || empty($this->input->post('strToken'))
          || empty($this->input->post('strPassword')) || empty($this->input->post('strPasswordConfirm')))){

              $resultados = array('status' => false, 'msg' => 'Error de datos.');
          }else{
                  $idpersona = intval($this->input->post('idUsuario'));
                  $email     = strtolower($this->Helpers->strClean($this->input->post('strEmail')));
                  $password  = $this->Helpers->strClean($this->input->post('strPassword'));
                  $passwordConfirm  = $this->Helpers->strClean($this->input->post('strPasswordConfirm'));
                  $token     = $this->Helpers->strClean($this->input->post('strToken'));              
                 
                  if($password != $passwordConfirm){
                     $resultados = array('status' => false, 'msg' => 'Las contraseñas no son iguales.');
                  }else{
                       $datos =  $this->AuthModel->getUsuario($email,$token); 
                      if(empty($datos))
                      {
                          $resultados = array('status' => false, 'msg' => 'Error de datos.');
                      }else{

                          $strPassword = hash("SHA256", $password);
                          $resultPassword = $this->AuthModel->insertPassword($idpersona, $strPassword);
                        
                          if($resultPassword){
                            $resultados = array('status' => true, 'post' => 'Contraseña actualizada con éxito.');

                          }else{
                              $resultados = array('status' => false, 'msg' => 'No es posible realizar el proceso, intentelo más tarde.');

                          }
                      }           
               }         
          }
          echo json_encode($resultados ,JSON_UNESCAPED_UNICODE);	 
      }else{
        redirect("error");
      }  
      die();
    }
}