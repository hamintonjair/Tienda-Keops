
function openModalPerfil(){     
  
    $('#modalFormPerfil').modal('show');
  
}
  //Insert perfil
(function($){    
  $("#formPerfil").submit(function(e){
            e.preventDefault();
          let base_url = 'http://localhost/sitio-keops/';
          var stridentificacion   = $('#txtIdentificacion').val();
          var strNombre           = $('#txtNombre').val();
          var strApellido         = $('#txtApellido').val();
          var strTelefono         = $('#txtTelefono').val();           
          var strPassword         = $('#txtPassword').val();         
          var strPasswordConfirm  = $('#txtPasswordConfirm').val(); 

          if(stridentificacion == '' || strNombre == '' || strApellido == '' || strTelefono == '')
          {
            alertError("Error", "Todos los campos son obligatorios.", "error");
              return false;
          }   
         
          else
          {  
  
            if(strPassword != ''  || strPasswordConfirm != ''){
              
                  if(strPassword.length < 5 )
                    {
                      alertError("Atención", "La contraseña debe tener un mínimo de 5 caracteres.", "info");
                      return false;
                    }   
                  if(strPassword != strPasswordConfirm){
                        alertError("Atención", "Las contraseñas no son iguales.", "info");
                        return false;
                    }   
             }     
           if(strPassword == '' && strPasswordConfirm == '' || strPassword == strPasswordConfirm ){
              $.ajax({
                      type: 'POST',
                      url: base_url + 'Usuarios/PutPerfil',
                      dataType: "json",           
                      data: {                                
                            "strIdentificacion": stridentificacion,
                            "strNombre":         strNombre,
                            "strApellido":       strApellido,
                            "strTelefono":       strTelefono,                       
                            "strPassword":       strPassword,  
                            "strPasswordConfirm":strPasswordConfirm, 
                                    
                            },             
                      success:function(dato)
                      {                       
        
                          if(dato.status == false){
                            alertError("Oops...",dato.msg, "info");                     
                            return
                            
                          }else{  
                              $('#modalFormPerfil').modal('show'); 
                              MostrarAlert("Atención",dato.post, "success");  
                          }                                   
                      },
                      error: function()
                      {             
                        alertError("Error!","Los datos no pudieron ser ingresados", "error");                     
                      
                      },                             
                  });   
               }
           }  
        });   
   })(jQuery)   

  //Update datos fiscales 
  $(document).on("click","#formFiscal", function(e){
    e.preventDefault();
      let base_url = 'http://localhost/sitio-keops/';
      var strNit             = $('#txtNit').val();
      var strNombreFiscal    = $('#txtNombreFiscal').val();
      var strDireccionFiscal = $('#txtDireccionFiscal').val();           

      if(strNit == '' || strNombreFiscal == '' || strDireccionFiscal == '')
      {
        alertError("Error", "Todos los campos son obligatorios.", "error");
          return false;
      }   
     
      else
      {      
          $.ajax({
                  type: 'POST',
                  url: base_url + 'Usuarios/PutFiscal',
                  dataType: "json",           
                  data: {                                
                        "strNit":            strNit,
                        "strNombreFiscal":   strNombreFiscal,
                        "strDireccionFiscal":strDireccionFiscal,                            
                                
                        },             
                  success:function(dato)
                  {                      
                      if(dato.status == false){
                        alertError("Oops...",dato.msg, "info");                     
                        return
                        
                      }else{  
                          $('#modalFormPerfil').modal('show'); 
                          MostrarAlert("Atención",dato.post, "success");  
                      }                                   
                  },
                  error: function()
                  {             
                    alertError("Error!","Los datos no pudieron ser ingresados", "error");                     
                  
                  },                             
              });   
          } 
      
  });
  
function alertError(title, text, icon)
{
      Swal.fire({
      title,
      text,
      icon,    
      })
     
}

function MostrarAlert(title, text, icon)
{      
   Swal.fire({
      title,
      text,
      icon,    
      })
   location.reload(),           
  $('#modalFormPerfil').modal('hide');  
}