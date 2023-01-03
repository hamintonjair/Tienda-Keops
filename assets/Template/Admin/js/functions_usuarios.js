window.addEventListener('load', function(){
    // fntModalUsuario();
    VerUsuario()
},false);

//Insert usuarios
(function($){    
  $("#formUsuario").submit(function(e){
            e.preventDefault();
          let base_url = 'http://localhost/sitio-keops/';
          var stridentificacion   = $('#txtIdentificacion').val();
          var strNombre           = $('#txtNombre').val();
          var strApellido         = $('#txtApellido').val();
          var strTelefono         = $('#txtTelefono').val();       
          var strEmail            = $('#txtEmail').val();
          var strRolid            = $('#listRolid').val(); 
          var strStatus           = $('#listStatus').val();
          var strPassword         = $('#txtPassword').val();         
        
          if(stridentificacion == '' || strNombre == '' || strApellido == '' || strTelefono == '' || strEmail == '' || strRolid == '' || strStatus == '')
          {
            alertError("Error", "Todos los campos son obligatorios.", "error");
              return false;
          }   
          else
          {     
              $.ajax({
                  type: 'POST',
                  url: base_url + 'Usuarios/InsertUsuario',
                  dataType: "json",           
                  data: {                                
                         "stridentificacion": stridentificacion,
                         "strNombre":         strNombre,
                         "strApellido":       strApellido,
                         "strTelefono":       strTelefono,
                         "strEmail":          strEmail,
                         "strRolid":          strRolid,   
                         "strStatus":         strStatus, 
                         "strPassword":       strPassword,            
                         },             
                  success:function(datos)
                  {                           
                     if(datos.status == false){                                      
                         alertError("Oops..." ,datos.msg, "info");  
                         return;    
                     }else{ 
                        Mostrar( "Atención", datos.post, "success");             
                       
                     }                                                    
                  }, 
                  error: function()
                  {             
                    MostrarAlerta("Error!","Los datos no pudieron ser ingresados", "error");               
                   
                  }                           
              });              
              // $('#form')[0].reset();
           }  
        });   
})(jQuery)   
    
   //Ver usuarios              
function VerUsuario(){
    var btnVerUsuario = document.querySelectorAll(".btnVerUsuario");
    btnVerUsuario.forEach(function(btnVerUsuario){
      btnVerUsuario.addEventListener('click', function()
      {
        let base_url = 'http://localhost/sitio-keops/';
        var idpersona = this.getAttribute("us");       

           $.ajax({
           type: 'POST',
           url: base_url + 'Usuarios/getUsuario/'+idpersona,
           dataType: "json", 
              data:  {                       
                          idpersona:idpersona
                     },  
                     success:function(dato)
                        {  
                          if(dato.status){  
                            
                                    var estadoUsuario = dato.post.status ==  1?
                            
                                    '<span class="badge badge-success">Action</span>':
                                    '<span class="badge badge-danger">Inactivo</span>';
                                
                                    document.querySelector("#celIdentificacion").innerHTML = dato.post.identificacion;
                                    document.querySelector("#celNombre").innerHTML = dato.post.nombres;
                                    document.querySelector("#celApellido").innerHTML = dato.post.apellidos;
                                    document.querySelector("#celTelefono").innerHTML = dato.post.telefono;
                                    document.querySelector("#celEmail").innerHTML = dato.post.email_user;
                                    document.querySelector("#celTipoUsuario").innerHTML = dato.post.nombrerol;
                                    document.querySelector("#celEstado").innerHTML = estadoUsuario;
                                    document.querySelector("#celFechaRegistro").innerHTML = dato.post.datecreated;
                                    $('#modalViewUser').modal("show");                                              
                          }
                          else
                          {
                            alertError("Error", dato.msg, "error");
                          }                      
                                                                            
                        }                             
                 }); 
             });
       });
}


//Editar usuarios
$(document).on("click",".btnEditUsuario", function(e){
  e.preventDefault();
  let base_url = 'http://localhost/sitio-keops/';
  var idpersona = $(this).attr("rl");  
  document.querySelector('#update').classList.replace("btn-primary", "btn-info");

  if(idpersona == "")
  {
    alertError("Error","Id persona required","error")
  }
  else
  {
      $.ajax({
       url: base_url + 'Usuarios/EditarUsuario/'+ idpersona,
       type: "post",
       dataType: "json",
       data: {
               idpersona: idpersona
             },
       success: function(datos)
       {        
         if(datos.status == true){ 

            $("#edit_idUsuario").val(datos.post.idpersona);
            $("#edit_lisIdentificacion").val(datos.post.identificacion);
            $("#edit_lisNombre").val(datos.post.nombres);
            $("#edit_lisApellido").val(datos.post.apellidos);  
            $("#edit_lisTelefono").val(datos.post.telefono);
            $("#edit_lisEmail").val(datos.post.email_user);
            $("#edit_listRolid").val(datos.post.nombrerol);
          
            // if(datos.post.status == 1)
            // {
            //      var optionSelect = '<option value="1" selected class="notBlock ">Activo</option>';
            //      var htmlSelect = `${optionSelect}<option value="1">Inactivo</option>`;
            // }      
            // else
            // {
            //      var optionSelect = '<option value="2" selected class="notBlock ">Inactivo</option>';
            //      var htmlSelect = `${optionSelect}<option value="2">Activo</option>`;
            // }    
            //    $("#edit_Password").val(datos.post.password); 

            //     document.querySelector('#edit_listStatus').innerHTML = htmlSelec;
               $('#modalEditarUsuario').modal('show');         
         }
         else
         {
              alertError("Error", dato.msg, "error");
         }      
       }
   });
 }

});
//update usuarios
$(document).on("click","#updateUsuario", function(e){
    e.preventDefault();
    let base_url = 'http://localhost/sitio-keops/';
    var edit_idUsuario = $('#edit_idUsuario').val();
    var edit_actualizar_identificacion = $('#edit_lisIdentificacion').val();
    var edit_actualizar_nombre = $('#edit_lisNombre').val();
    var edit_actualizar_apellidos = $('#edit_lisApellido').val();
    var edit_actualizar_telefono = $('#edit_lisTelefono').val();
    var edit_actualizar_email = $('#edit_lisEmail').val();
    var edit_actualizar_rol = $('#edit_listRolid').val();
    var edit_actualizar_password = $('#edit_Password').val();
    var edit_status = $('#edit_listStatus').val();
    
    /**tomamos el valor que trae el status y en la condicion la cambiamos  el valor para actualizarlo  */
     
      $.ajax({
        url: base_url + 'Usuarios/updateUsuario',
        type: "post",
        dataType: "json",
        data: {
                 edit_idUsuario: edit_idUsuario,
                 edit_actualizar_identificacion: edit_actualizar_identificacion,
                 edit_actualizar_nombre: edit_actualizar_nombre,
                 edit_actualizar_apellidos: edit_actualizar_apellidos,
                 edit_actualizar_telefono: edit_actualizar_telefono,      
                 edit_actualizar_email: edit_actualizar_email,
                 edit_actualizar_rol: edit_actualizar_rol,
                 edit_actualizar_password: edit_actualizar_password,
                 edit_actualizar_status: edit_status,

              },
              success: function(data)
              {                    
                if(data.status == false)
                {           
                  alertError("Error",data.msg ,"error")       
                }      
                else
                {     
                  MostrarActualizado("Atencion",data.post ,"success")               
                }                             
              }              
         });        
   });
 /**Eliminar Usuarios */
$(document).on("click",".btnDelUsuario", function(e){
   e.preventDefault();
    let base_url = 'http://localhost/sitio-keops/';  
    var id_delete = $(this).attr("rl");    
            
          const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
             buttonsStyling: false
            })      
               swalWithBootstrapButtons.fire({
                title: 'Eliminar Usuario',
                text: "¿Realmente quiere eliminar el Usuario?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
           }).then((result) => {
           if (result.isConfirmed) {
    
              $.ajax({
                url: base_url + 'Usuarios/deleteUsuario/'+ id_delete,
                type: "post",
                dataType: "json",
                data: {
                  id_delete: id_delete
                      },                 
                      success: function(data){
                       if(data.status == true ){
                           swalWithBootstrapButtons.fire(
                             'Eliminado!',
                              data.post,
                              'success',
                                location.reload()
                            );
                       }else{
                              swalWithBootstrapButtons.fire(
                             'Cancelado!',
                              data.msg,
                              'error'
                              );       
                           }
                        }
                        
                     });
                   
              } else if (
                   /* Read more about handling dismissals below */
                  result.dismiss === Swal.DismissReason.cancel
                 ) {
                     swalWithBootstrapButtons.fire(
                     'Cancelado!',
                    'El usuario no fue eliminado',
                     'error'
                    )
                   }
              })
        });

 function MostrarActualizado(title, text, icon)
  {  
         Swal.fire({
             title,
             text,
             icon,    
             confirmButtonColor: '#3085d6',
             confirmButtonText: 'Yes!'
           }).then((result) => {
             if (result.isConfirmed) {
               Swal.fire(
                 'Actualizado',
                 'Se actualizaron los datos',
                 'success',
                location.reload(),
               )          
             }            
           })          
           $('#modalFormUsuario').modal("hide")                        
        
 }
function MostrarNoActualizado(title, text, icon)
 {  
         Swal.fire({
             title,
             text,
             icon,    
             confirmButtonColor: '#3085d6',
             confirmButtonText: 'Yes!'
           }).then((result) => {
           if (result.isConfirmed) {
               Swal.fire(
                 'Error',
                 'Los datos no se pudieron actualizar',
                 'error',             
               )
             }            
           })          
       $('#modalFormUsuario').modal("hide")
 }  

 
 function openModalUsuario(){
      
  document.querySelector('#idUsuario').value ="";
  document.querySelector('.modal-header').classList.replace( "headerUpdate","headerRegister");
  document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
  document.querySelector('#formUsuario').reset();
  $('#modalFormUsuario').modal('show');

}

/*funciones para las alertas */
function Mostrar(title, text, icon)
{  
   Swal.fire({
       title,
       text,
       icon,    
       confirmButtonColor: '#3085d6',
       confirmButtonText: 'Yes!'
     }).then((result) => {
       if (result.isConfirmed) {
         Swal.fire(
           'Guardado',
           'Los datos se guardaron correctamente',
           'success',
           location.reload(),
         )
       }            
     })  
 
     $('#modalFormUsuario').modal("hide")  
}
function MostrarAlerta(title, text, icon)
{  
Swal.fire({
  title,
  text,
  icon,    
  confirmButtonColor: '#3085d6',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Error',
      'El usuario no fue agregado',
      'error',
      location.reload(),
    )
  }            
})          
$('#modalFormUsuario').modal("hide")    
}
// $(document).ready(function() {
//     $('.#listRolid').select2();
// });

function alertError(title, text, icon)
{
  Swal.fire({
  title,
  text,
  icon,    
  })
}