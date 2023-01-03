<?php
//extends para heredar
          
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\SMTP;
    // use PHPMailer\PHPMailer\Exception;
    // require (APPPATH.'Libraries/phpmailer/Exception.php');
    // require (APPPATH.'Libraries/phpmailer/PHPMailer.php');
    // require (APPPATH.'Libraries/phpmailer/SMTP.php');
   
   class Helpers extends  CI_Model
   {   
       //funcion para solicitar los datos que se solicitan en modelos
       public function __construct()
       {
          parent::__construct();               
          $this->load->model("PermisosModel");	
          $this->load->model("AuthModel");	
          $this->load->model("CategoriasModel");	
          $this->load->model("ConfiguracionModel");	
       }  

    //Para envío de correo
	const ENVIRONMENT = 1; // Local: 0, Produccón: 1;

    function sendEmail($data,$template)
    {  
          $empresa = $this->ConfiguracionModel->getEmpresa();
          $email_remitente =  $empresa[0]->email_remitente;
          $N_empresa=  $empresa[0]->empresa;    
        
                $asunto = $data['asunto'];
                $emailDestino = $data['emailC'];
                $usuario = $data['nombreUsuario'];      
          
               try {    
                    $config = array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'smtp.gmail.com',
                        'smtp_user' => 'hamintonjair@gmail.com', //Su Correo de Gmail Aqui
                        'smtp_pass' => 'eorjdlcmzvzufiuw', // Su Password de Gmail aqui
                        'smtp_port' => '465',
                        'smtp_crypto' =>'ssl',
                        'mailtype' => 'html',
                        'wordwrap' => TRUE,
                        'charset' => 'utf-8'
                        );
                        $this->load->library('email', $config);
                        $this->email->set_newline("\r\n");
        
                        ob_start();
                        $this->load->view('layouts/Email/'.$template.'.php', $data);
                        $mensaje = ob_get_clean();
                        $this->email->from($email_remitente, $N_empresa);
                        $this->email->subject( $asunto);
                        $this->email->message($mensaje);
                        $this->email->to($emailDestino,$usuario);                                     
                        if($respuesta = $this->email->send()){
                            return $respuesta;
                        }else {
                         return false;
                        }   
                        
                    } catch (Exception $e) {
                            return false;
                    }
              
        
    }  
    //envio email pedidos
    public function sendEmailPedido($data, $pedido, $template)
    {    
        $empresa = $this->ConfiguracionModel->getEmpresa();
        $email_remitente =  $empresa[0]->email_remitente;
        $N_empresa =  $empresa[0]->empresa; 

        $asunto = $data['asunto'];
        $emailDestino = $data['email'];        
        $emailCopia = !empty($data['emailCopia']) ? $data['emailCopia'] : "";
    
       try {    
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_user' => 'hamintonjair@gmail.com', //Su Correo de Gmail Aqui
                'smtp_pass' => 'eorjdlcmzvzufiuw', // Su Password de Gmail aqui
                'smtp_port' => '465',
                'smtp_crypto' =>'ssl',
                'mailtype' => 'html',
                'wordwrap' => TRUE,
                'charset' => 'utf-8'
                );
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");

                ob_start();
                $this->load->view('layouts/Email/'.$template.'.php', $pedido);
                $mensaje = ob_get_clean();
                $this->email->from(  $email_remitente,   $N_empresa);
                $this->email->subject( $asunto);
                $this->email->message($mensaje);
                $this->email->to($emailDestino);
                $this->email->cc($emailCopia);
                if($respuesta = $this->email->send()){
                    return $respuesta;
                }else {
                 return false;
                }   
                
            } catch (Exception $e) {
                    return false;
            }        
         
    } 
   
    //control de modulos de inicio de sesion ´para los roles
    public function getPermisos($idmodulo)
    {   
        if(!empty($_SESSION['userData'])){  

            $idrol = $_SESSION['userData']->idrol;     
            $arrPermisos = $this->PermisosModel->permisosModulos($idrol);
            $permisos = '';
            $permisosMod = '';

            if(count($arrPermisos) > 0){
                $permisos = $arrPermisos;
                $permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo] : "";
            }

            $_SESSION['permisos'] = $permisos;
            $_SESSION['permisosMod'] = $permisosMod;
        }
     
    }   
    function getFile(string $url, $data)
    { 
        ob_start();
        $this->load->view($url, $data);
        // require_once("Views/{$url}.php");
        $file = ob_get_clean();
        return $file;        
    }
    //funcion para tomar el id del usuario logueado y poder darle permiso a los modulos
    public function sessionUser($idpersona){
        
        return $this->AuthModel->sessionLogin($idpersona);

    }
   // control de inisio de session
    public function sessionStart(){
        session_start();
        $inactivo = 60;
        if(isset($_SESSION['timeout'])){
            $session_in = time() - $_SESSION['inicio'];
            if($session_in > $inactivo){             
                  echo '<script>window.location.href="http://localhost/sitio-keops/login/logout"</script>';	
            }
        }else{
           echo '<script>window.location.href="http://localhost/sitio-keops/login/logout"</script>';	
        }
    }
    //meses
    public function Meses(){
        $meses = array("Enero", 
                      "Febrero", 
                      "Marzo", 
                      "Abril", 
                      "Mayo", 
                      "Junio", 
                      "Julio", 
                      "Agosto", 
                      "Septiembre", 
                      "Octubre", 
                      "Noviembre", 
                      "Diciembre");
        return $meses;
    }
   
   //funcion para las cadenas de caracteres y reemplazarlas, eliminando exceso de espacios entre palabras
    function strClean($strCadena){   
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
        $string = trim($string); //Elimina espacios en blanco al inicio y al final      
        $string = stripslashes($string); // Elimina las \ invertidas
        $string = str_ireplace("<script>","",$string);
        $string = str_ireplace("</script>","",$string);
        $string = str_ireplace("<script src>","",$string);
        $string = str_ireplace("<script type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE FROM","",$string);
        $string = str_ireplace("INSERT INTO","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("OR '1'='1","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace("LIKE ´","",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);
        return $string;    
    }  


    function clear_cadena(string $cadena){
        //Reemplazamos la A y a
        $cadena = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $cadena
        );
 
        //Reemplazamos la E y e
        $cadena = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $cadena );
 
        //Reemplazamos la I y i
        $cadena = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $cadena );
 
        //Reemplazamos la O y o
        $cadena = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $cadena );
 
        //Reemplazamos la U y u
        $cadena = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $cadena );
 
        //Reemplazamos la N, n, C y c
        $cadena = str_replace(
        array('Ñ', 'ñ', 'Ç', 'ç',',','.',';',':'),
        array('N', 'n', 'C', 'c','','','',''),
        $cadena
        );
        return $cadena;
    }
    //funcion para generar el password
    function passGenerator($length = 10)
    {
        $pass = "";
        $longitudPass=$length;
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena=strlen($cadena);

        for($i=1; $i<=$longitudPass; $i++)
        {
            $pos = rand(0,$longitudCadena-1);
            $pass .= substr($cadena,$pos,1);
        }
        return $pass;
    }
    //funcion para generar un token y poder restablecer contraseña
    function token()
    {
        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
        return $token;
    }

    function getTokenPaypal(){
        $empresa = $this->ConfiguracionModel->getEmpresa();
		$urlpaypal =  $empresa[0]->urlpaypal;
        $idcliente_paypal =  $empresa[0]->idcliente_paypal;
		$secret_paypal =  $empresa[0]->secret_paypal;
        $payLogin = curl_init(	$urlpaypal."/v1/oauth2/token");
        curl_setopt($payLogin, CURLOPT_SSL_VERIFYPEER, FALSE);//verifica el certificado SSL en la conexion
        curl_setopt($payLogin, CURLOPT_RETURNTRANSFER,TRUE); 
        curl_setopt($payLogin, CURLOPT_USERPWD,   $idcliente_paypal.":".$secret_paypal );
        curl_setopt($payLogin, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $result = curl_exec($payLogin);
        $err = curl_error($payLogin);
        curl_close($payLogin);
      
        if($err){
            $request = "CURL Error #:" . $err;
        }else{
            $objData = json_decode($result);
             $request =  $objData->access_token;   
        }
        return $request;
    }
    function CurlConnectionGet(string $ruta, string $contentType = null, string $token){
        $content_type = $contentType != null ? $contentType : "application/x-www-form-urlencoded";
        if($token != null){
            $arrHeader = array('Content-Type:'.$content_type,
                            'Authorization: Bearer '.$token);
        }else{
            $arrHeader = array('Content-Type:'.$content_type);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ruta);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if($err){
            $request = "CURL Error #:" . $err;
        }else{
            $request = json_decode($result);
        }
        return $request;
    }
    function CurlConnectionPost(string $ruta, string $contentType = null, string $token){
        $content_type = $contentType != null ? $contentType : "application/x-www-form-urlencoded";
        if($token != null){
            $arrHeader = array('Content-Type:'.$content_type,
                            'Authorization: Bearer '.$token);
                     
        }else{
            $arrHeader = array('Content-Type:'.$content_type);
        }           
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ruta);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
        $result = curl_exec($ch);
        $err = curl_error($ch);
      
        curl_close($ch);
      
        if($err){
            $request = "CURL Error #:" . $err;
        }else{
            $request = json_decode($result);
        }

        return $request;
    }
    //funcion para valores monetarios, recibir cantidades
    function formatMoney($cantidad)
    {      
        $cantidad = number_format($cantidad,2,",",".");
        return $cantidad;
    }
    //el signo peso para el precio
    function Money(){
        
        $money = "$";        
        return $money;
    }
    //almacenar la imagen en la carpeta del proyecto
    function uploadImage(array $data, $name){
        $url_temp = $data['tmp_name'];
        $destino = 'assets/Template/Admin/images/uploads/'.$name;
        $move = move_uploaded_file($url_temp, $destino);
        return $move;
    } 
    //eliminamos la foto que ya exista para la actualizacion
     function deleteFile( $name){ 
       unlink('assets/Template/Admin/images/uploads/'.$name);
    }
    //footer
    function getCatFooter(){

        return $this->CategoriasModel->getCategoriasFooter();
    }
    function getCatFooter2(){
      
        return $this->CategoriasModel->getCategoriasFooter2();

    }
    //informacion d elas paginas
    function getInfoPage($idpagina){
       
        $request = $this->db->query("SELECT * FROM post WHERE idpost = $idpagina")->result();      
        return $request;
    }
    //nopsotros
    function getPageRout($ruta){
       
        if($ruta == "inicio"){
            $request = $this->db->query("SELECT * FROM post WHERE ruta = '$ruta' AND status = 1 ")->result();  

            if(!empty($request)){
    
                for ($i=0; $i < count($request) ; $i++) { 
    
                    $request[$i]->portada =  $request[$i]->portada != "" ? base_url().'assets/Template/Admin/images/uploads/'.$request[$i]->portada : "";
                 }   
            }   
        }else{
             $request = $this->db->query("SELECT * FROM post WHERE ruta = '$ruta' AND status != 0 ")->result();  

            if(!empty($request)){

                for ($i=0; $i < count($request) ; $i++) { 

                    $request[$i]->portada =  $request[$i]->portada != "" ? base_url().'assets/Template/Admin/images/uploads/'.$request[$i]->portada : "";
                }   
            }   
        }
       
        return $request;
    
    }
    //paginas
    function viewPage($idpagina){
        
        $request = $this->db->query("SELECT * FROM post WHERE idpost = $idpagina ")->result();
       
        if(!empty($request)){

            for ($i=0; $i < count($request) ; $i++) { 
                  
                if(($request[$i]->status == 2  && isset($_SESSION['permisosMod']) && $_SESSION['permisosMod']->u == true) || $request[$i]->status == 1){
                    return true;  
                }else{
                      return false;
                 }
             }   
        } 
    }

}