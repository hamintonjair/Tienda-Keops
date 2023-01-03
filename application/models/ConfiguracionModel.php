<?php
//extends para heredar
   defined('BASEPATH') OR exit('No direct script access allowed');

   class ConfiguracionModel extends  CI_Model
   {
       
    public function __construct()
    {
            parent::__construct();
    }    
    //datos empresa
	public function getEmpresa()
	{
        $this->db->select('*');
        $this->db->from('empresa');
        $request = $this->db->get()->result();    
		return $request;
	}
   	//update datos del configuracion
	public function updateConfiguracion($idConfiguracion, $Nombre, $Direccion, $Teléfono,  $Whatsapp, $EmailEmpresa,  $EmailPedido,       $EmailSucripcion, $EmailContacto, $EmailRemitente, $Remitente, $PaginaWeb, $Descripcion, $NombreTienda, $CostoEnvio,$costo_envioP,       $Facebook, $Instagram, $Linkedin,  $Twitter,  $idClientePaypal, $SecretPaypal,$imgPortada )
	{
		
			$this->db->where('id', $idConfiguracion);
			$this->db->SET('empresa',"");
			$this->db->SET('direccion',"");
			$this->db->SET('telefono',"");
			$this->db->SET('whatsapp',"");
			$this->db->SET('email_empresa',"");
            $this->db->SET('email_pedido',"");
			$this->db->SET('email_suscripcion',"");
			$this->db->SET('email_contacto',"");
			$this->db->SET('email_remitente',"");
			$this->db->SET('web_empresa',"");
            $this->db->SET('remitente',"");
			$this->db->SET('descripcion',"");
            $this->db->SET('nombre_tienda',"");
			$this->db->SET('costo_evio',"");
			$this->db->SET('costo_envioP',"");
			$this->db->SET('idcliente_paypal',"");
			$this->db->SET('secret_paypal',"");
			$this->db->SET('facebook',"");
            $this->db->SET('instagram',"");
			$this->db->SET('linkedin',"");
			$this->db->SET('twitter',"");
			if($imgPortada == "portada_categoria.png" ){
			
				$datos = array(			
					"empresa"         => $Nombre,
					"direccion"       => $Direccion,
					"telefono"        => $Teléfono,
					"whatsapp"        => $Whatsapp,			
					"email_empresa"   => $EmailEmpresa,       
					"email_pedido"    => $EmailPedido,
					"email_suscripcion"  => $EmailSucripcion,
					"email_contacto"  => $EmailContacto,
					"email_remitente" => $EmailRemitente,			
					"web_empresa"     => $PaginaWeb,      
					"remitente"       => $Remitente,			
					"descripcion"     => $Descripcion,       
					"nombre_tienda"   => $NombreTienda,
					"costo_evio"      => $CostoEnvio,
					"costo_envioP"      => $costo_envioP,
					"idcliente_paypal"  => $idClientePaypal,
					"secret_paypal"   => $SecretPaypal,			
					"facebook"        => $Facebook,    
					"instagram"       => $Instagram,
					"linkedin"        => $Linkedin,			
					"twitter"         => $Twitter,    
				
				);	
			}else{

			 $this->db->SET('logo',"");
			 $datos = array(			
				"empresa"         => $Nombre,
				"direccion"       => $Direccion,
				"telefono"        => $Teléfono,
				"whatsapp"        => $Whatsapp,			
				"email_empresa"   => $EmailEmpresa,       
                "email_pedido"    => $EmailPedido,
				"email_suscripcion"  => $EmailSucripcion,
				"email_contacto"  => $EmailContacto,
				"email_remitente" => $EmailRemitente,			
				"web_empresa"     => $PaginaWeb,      
                "remitente"       => $Remitente,			
				"descripcion"     => $Descripcion,       
                "nombre_tienda"   => $NombreTienda,
				"costo_evio"      => $CostoEnvio,
				"costo_envioP"      => $costo_envioP,
				"idcliente_paypal"  => $idClientePaypal,
				"secret_paypal"   => $SecretPaypal,			
				"facebook"        => $Facebook,    
                "instagram"       => $Instagram,
				"linkedin"        => $Linkedin,			
				"twitter"         => $Twitter,    
				"logo"            => $imgPortada, 
				  
			);		
		}

	   return $this->db->update('empresa', $datos); 	
	}
}
?>