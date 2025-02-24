window.addEventListener('load', function(){
    // fntModalUsuario();
    btnVerCliente()
},false);

//Insert clientes
(function($) {
    $("#formCliente").submit(function(e) {
        e.preventDefault();
        let base_url = 'http://localhost/sitio-keops/';
        var stridentificacion = $('#txtIdentificacion').val();
        var strNombre = $('#txtNombre').val();
        var strApellido = $('#txtApellido').val();
        var strTelefono = $('#txtTelefono').val();
        var strEmail = $('#txtEmail').val();
        var strNit = $('#txtNit').val();
        var strNomFiscal = $('#txtNombreFiscal').val();
        var strDirFiscal = $('#txtDirFiscal').val();
        var strPassword = $('#txtPassword').val();

        if (strNit == '' || strNomFiscal == '' || strDirFiscal == '' || stridentificacion == '' || strNombre == '' ||
            strApellido == '' || strTelefono == '' || strEmail == '') {
            alertError("Error", "Todos los campos son obligatorios.", "error");
            return false;
        } else {
            $.ajax({
                type: 'POST',
                url: base_url + 'Clientes/SetCliente',
                dataType: "json",
                data: {
                    "stridentificacion": stridentificacion,
                    "strNombre": strNombre,
                    "strApellido": strApellido,
                    "strTelefono": strTelefono,
                    "strEmail": strEmail,
                    "strNit": strNit,
                    "strNombreFiscal": strNomFiscal,
                    "strDirFiscal": strDirFiscal,
                    "strPassword": strPassword,
                },
                success: function(dato) {

                    if (dato.status == false) {
                        alertError("Oops...", dato.msg, "info");
                        return;
                    } else {
                        Mostrar("Atención", dato.post, "success");
                    }
                },
                error: function() {
                    alertError("Error!", "Los datos no pudieron ser ingresados", "error");
                },
            });
            // $('#form')[0].reset();
        }
    });
})(jQuery)


// });   
function openModalClientes() {

    document.querySelector('#idCliente').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Cliente";
    document.querySelector('#formCliente').reset();
    $('#modalFormCliente').modal('show');

}

//ver clientes
function btnVerCliente(){
    var btnVerCliente = document.querySelectorAll(".btnVerCliente");
    btnVerCliente.forEach(function(btnVerCliente){
        let base_url = 'http://localhost/sitio-keops/';
        btnVerCliente.addEventListener('click', function()
        {
            var idpersona = this.getAttribute("us");        
            $.ajax({
                type: 'POST',
                url: base_url + 'Clientes/getCliente/' + idpersona,
                dataType: "json",
                data: {
                    idpersona: idpersona
                },
                success: function(dato) {
                    if (dato.status) {

                        var estadoUsuario = dato.post.status == 1 ?

                            '<span class="badge badge-success">Action</span>' :
                            '<span class="badge badge-danger">Inactivo</span>';

                        document.querySelector("#celIdentificacion").innerHTML = dato.post.identificacion;
                        document.querySelector("#celNombre").innerHTML = dato.post.nombres;
                        document.querySelector("#celApellido").innerHTML = dato.post.apellidos;
                        document.querySelector("#celTelefono").innerHTML = dato.post.telefono;
                        document.querySelector("#celEmail").innerHTML = dato.post.email_user;
                        document.querySelector("#celIde").innerHTML = dato.post.nit;
                        document.querySelector("#celNomFiscal").innerHTML = dato.post.nombrefiscal;
                        document.querySelector("#celDirFiscal").innerHTML = dato.post.direccionfiscal;
                        document.querySelector("#celFechaRegistro").innerHTML = dato.post.fechaRegistro;
                        $('#modalViewCliente').modal("show");
                    } else {
                        alertError("Error", dato.msg, "error");
                    }
                    }

                });
            });
        });
   
}

//Editar cliente
$(document).on("click",".btnEditCliente", function(e){
    e.preventDefault();
    let base_url = 'http://localhost/sitio-keops/';
    var idpersona = $(this).attr("rl");  
   // document.querySelector('#update').classList.replace("btn-primary", "btn-info");

    if(idpersona == "")
    {
      alertError("Error","Id persona required","error")
    }
    else
    {
        $.ajax({
         url: base_url + 'Clientes/EditarCliente/'+ idpersona,
         type: "post",
         dataType: "json",
         data: {
                 idpersona: idpersona
               },
         success: function(datos)
         {        
           if(datos.status == true){ 
  
              $("#edit_idCliente").val(datos.post.idpersona);
              $("#edit_Identificacion").val(datos.post.identificacion);
              $("#edit_Nombre").val(datos.post.nombres);
              $("#edit_Apellido").val(datos.post.apellidos);  
              $("#edit_Telefono").val(datos.post.telefono);
              $("#edit_Email").val(datos.post.email_user);
              $("#edit_Password").val(datos.post.password); 
              $("#edit_Nit").val(datos.post.nit);
              $("#edit_NombreFiscal").val(datos.post.nombrefiscal);
              $("#edit_DirFiscal").val(datos.post.direccionfiscal);      
    
             $('#modalEditarCliente').modal('show');         
           }
           else
           {
                alertError("Error", dato.msg, "error");
           }      
         }
     });
   }
  
  });

  //update cliente
$(document).on("click","#updateCliente", function(e){
    e.preventDefault();
    let base_url = 'http://localhost/sitio-keops/';
    var edit_idCliente = $('#edit_idCliente').val();   
    var edit_actualizar_identificacion = $('#edit_Identificacion').val();
    var edit_actualizar_nombre = $('#edit_Nombre').val();
    var edit_actualizar_apellidos = $('#edit_Apellido').val();
    var edit_actualizar_telefono = $('#edit_Telefono').val();
    var edit_actualizar_email = $('#edit_Email').val();
    var edit_actualizar_password = $('#edit_Password').val();
    var edit_actualizar_nit = $('#edit_Nit').val();
    var edit_actualizar_nombrefiscal = $('#edit_NombreFiscal').val();
    var edit_actualizar_dirfiscal = $('#edit_DirFiscal').val();

    
    /**tomamos el valor que trae el status y en la condicion la cambiamos  el valor para actualizarlo  */
    
      $.ajax({
        url: base_url + 'Clientes/updateCliente',
        type: "post",
        dataType: "json",
        data: {
                 edit_idCliente: edit_idCliente,
                 edit_actualizar_identificacion: edit_actualizar_identificacion,
                 edit_actualizar_nombre: edit_actualizar_nombre,
                 edit_actualizar_apellidos: edit_actualizar_apellidos,
                 edit_actualizar_telefono: edit_actualizar_telefono,      
                 edit_actualizar_email: edit_actualizar_email,
                 edit_actualizar_password: edit_actualizar_password,
                 edit_actualizar_nit: edit_actualizar_nit,
                 edit_actualizar_nombrefiscal: edit_actualizar_nombrefiscal,
                 edit_actualizar_dirfiscal: edit_actualizar_dirfiscal,

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
   
 /**Eliminar cliente */
 $(document).on("click",".btnDelCliente", function(e){
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
               title: 'Eliminar Cliente',
               text: "¿Realmente quiere eliminar el Cliente?",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: 'Si, Eliminar!',
               cancelButtonText: 'No, cancel!',
               reverseButtons: true
          }).then((result) => {
          if (result.isConfirmed) {
   
             $.ajax({
               url: base_url + 'Clientes/deleteCliente/'+ id_delete,
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
                   'El cliente no fue eliminado',
                    'error'
                   )
                  }
             })
       });
              


function MostrarAlerta(title, text, icon) {
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
                'El cliente no fue agregado',
                'error',
                location.reload(),
            )
        }
    })
}

function alertError(title, text, icon) {
    Swal.fire({
        title,
        text,
        icon,
    })

}

function Mostrar(title, text, icon) {
    Swal.fire({
        title,
        text,
        icon,
    })
    location.reload(),
        $('#modalFormCliente').modal("hide");
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
