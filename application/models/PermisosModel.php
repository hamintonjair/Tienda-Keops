<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//extends para heredar
class PermisosModel extends CI_Model
{
      
       //funcion para solicitar los datos que se solicitan en modelos
      public function __construct()
      {
          parent::__construct();
      }    
       /**seleccionamos los modulos que no tengan estatus 0 */
      public function selectModulos()
      {
            $this->db->select('*');
            $this->db->from('modulo');
            $this->db->where('status != 0');	 	  
            return $this->db->get()->result();
	}
      //buscar los roles para mostrarlos
      public function getRoles($idrol)
	{	
            $this->db->where('idrol',$idrol);
            $resultados = $this->db->get("rol");
            return $resultados->result();           
	}	
       /**consultar los modulos*/
      public function getModulos()
      {                
            $this->db->from('modulo');
            return $this->db->get()->result();
      }      

      /**guardar los permisos */
      public function guardarPermisos($data)
      {
            return $this->db->insert("permisos",$data);
      }
      /**editar los permisos */
      public function Permisos($idrol)
      {     
            $this->db->select("p.*,m.titulo as modulos, r.nombrerol as roles");
            $this->db->from("permisos p");
            $this->db->join("rol r", "p.rolid = r.idrol");
            $this->db->join("modulo m", "p.moduloid = m.idmodulo");  
            $this->db->where('rolid', $idrol);     
            $resultados = $this->db->get();
            return $resultados->row();

      }
      /**actualizamos los permisos */
      public function update($rol, $idmodulo,$r,$w,$u,$d)
      {        
            $this->db->where('rolid',$rol);
            $this->db->where('moduloid',$idmodulo);   
            $this->db->SET('r',$r ); 
            $this->db->SET('w',$w ); 
            $this->db->SET('u',$u ); 
            $this->db->SET('d',$d ); 

            return $this->db->update('permisos'); 
      }
      /**eliminamos los permisos */
      public function delete($idrol)
      {
            $this->db->where('rolid',$idrol);
            $this->db->delete('permisos');
      }
      /**permisos para Rol especifico */
      public function permisosRolEspecificos($idpermiso)
	{		
            $this->db->select("p.*,m.titulo as modulos, r.nombrerol as roles");
            $this->db->from("permisos p");
            $this->db->join("rol r", "p.rolid = r.idrol");
            $this->db->join("modulo m", "p.moduloid = m.idmodulo");  
            $this->db->where('rolid', $idpermiso);     
            $resultados = $this->db->get();
            return $resultados->result();
	}
      //buscar que permisos tiene el rol y en qué modulo
      public function SelectPermisosRol($idrol,$idmodulo)
	{		
            $this->db->select("p.*,m.titulo as modulos, r.nombrerol as roles,r,w,u,d");
            $this->db->from("permisos p");  
            $this->db->join("rol r", "p.rolid = r.idrol");
            $this->db->join("modulo m", "p.moduloid = m.idmodulo");
            $this->db->where('rolid', $idrol); 
            $this->db->where('moduloid', $idmodulo); 
               
            $resultados = $this->db->get();
            return $resultados->result();
	}
      //buscar permisos para add
      public function permisoRol($idrol )
	{		
            $this->db->select("r,w,u,d");
            $this->db->from("permisos");          
            $this->db->where('rolid', $idrol); 
            $resultados = $this->db->get();
            return $resultados->result();
	}
      //Validamos si tiene permisos antes de add uno nuevo
      public function ValidarPermisos($idrol,$idmodulo)
	{
            $this->db->select("p.*,m.titulo as modulos, p.rolid,p.moduloid,p.r,p.w,p.u,p.d");
            $this->db->from("permisos p");            
            $this->db->join("modulo m", "p.moduloid = m.idmodulo");          
            $this->db->where('p.rolid', $idrol);  
            $this->db->where('p.moduloid', $idmodulo);    
               
            $resultados = $this->db->get()->result();	
            return $resultados;           
	}

      //seleccionar los permisos de los roles para enviarlo al helpers y controlar los modulos de inicio de sesion
      public function permisosModulos($idrol)
      {
            $this->db->select("p.*,m.titulo as modulos, p.rolid,p.moduloid,p.r,p.w,p.u,p.d");
            $this->db->from("permisos p");            
            $this->db->join("modulo m", "p.moduloid = m.idmodulo");          
            $this->db->where('p.rolid', $idrol);      
               
            $resultados = $this->db->get()->result();
       
            $arrPermisos = array();
            for($i=0; $i < count($resultados); $i++){
                  $arrPermisos[$resultados[$i]->moduloid] = $resultados[$i];
            }
            return $arrPermisos;
      
      }
}
