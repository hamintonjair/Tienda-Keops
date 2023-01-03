
   /**Insertar Roles */
(function($){    
      $("#formRol").submit(function(e){
                e.preventDefault();

      let base_url = 'http://localhost/sitio-keops/';
      var strNombre      = $('#txtNombre').val();
      var strDescripcion = $('#txtDescripcion').val();
      var intStatus      = $('#listStatus').val();       
        
      if(strNombre == "" || strDescripcion == "" || intStatus == "")
      {
        MostrarAlertaObligado("Atención", "Todos los campos son obligatorios.", "error");
        return false;
      }   
      else
      {     
          $.ajax({
              type: 'POST',
              url: base_url + 'Roles/InsertRol',
              dataType: "json",           
              data: {                       
                     "strNombre":       strNombre,
                     "strDescripcion":  strDescripcion,
                     "intStatus":       intStatus,
                     },                       
              success:function(dato)
              {                       
                 if(dato.status == false){
                  MostrarAlerta("Oops...",dato.msg, "info"); 
                  return
                  
                 }else{               
                  Mostrar("Atención",dato.post,"success");              
                 }                                                    
              }
              , error: function()
              {                           
                MostrarAlertaObligado( "Error","Los datos no pudieron ser ingresados", "error");      
              }                             
          });  
        
          // $('#form')[0].reset();
      } 
    });      
  })(jQuery)


  /**Editar Roles */
$(document).on("click",".btnEditRol", function(e){
   e.preventDefault();
   let base_url = 'http://localhost/sitio-keops/';
   var id = $(this).attr("rl");  
   document.querySelector('#update').classList.replace("btn-primary", "btn-info");

   if(id == "")
   {
     alert("Id rol required")
   }
   else
   {
       $.ajax({
        url: base_url + 'Roles/editarRol/'+ id,
        type: "post",
        dataType: "json",
        data: {
               id: id
              },
        success: function(dato)
        {        
          if(dato.status == true){  
                         
             $("#edit_editar_Rol").val(dato.post.idrol);
             $("#edit_nombre").val(dato.post.nombrerol);
             $("#edit_descripcion").val(dato.post.descripcion);  
    
             if(dato.post.status == 1)
             {
                  var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                  var htmlSelect = `${optionSelect}<option value="1">Inactivo</option>`;
             }      
             else
             {
                  var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
                  var htmlSelect = `${optionSelect}<option value="2">Activo</option>`;
             }                  
                 document.querySelector('#edit_listStatus').innerHTML = htmlSelect;
                $('#modalEditarRol').modal('show');      
 
          }
          else
          {
            MostrarAlertaObligado("Error", dato.msg, "error");
          }      
        }
    });
  }


   });


//Añadir Permisos
 (function($){    
      $("#AddPermisos").submit(function(e){
                e.preventDefault();
    let base_url = 'http://localhost/sitio-keops/';
    var idrol = $('#rol').val();
    var modulo = $('#modulo').val();
    var read =   $("#re:checked").val();         
    var write =  $('#we:checked').val();
    var update = $('#ue:checked').val();
    var delet =  $('#de:checked').val();
    /**tomamos el valor que trae el status y en la condicion la cambiamos  el valor para actualizarlo  */
   

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
     buttonsStyling: false
    })      
       swalWithBootstrapButtons.fire({
        title: 'Agregar Permisos',
        text: "¿Realmente quiere agregar el Permiso?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Deseas agregar el permiso!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
    if (result.isConfirmed) {

        $.ajax({
          url: base_url + 'Permisos/store',
          type: "post",
          dataType: "json",
          data: {
                "idrol": idrol,
                "modulo": modulo,
                "r": read,
                "w": write, 
                "u": update,
                "d": delet,           
           },              
          success: function(data){
                if(data.status == true ){
                    swalWithBootstrapButtons.fire(                      
                        'Agregado!',
                        data.post,
                        'success',                  
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
                'No se pudo agregar',
                'error'
              )
            }  

       })
    });      
  })(jQuery)

 //Actualizar Permisos

  $(document).on("click","#ActualizarPermisos", function(e){
              e.preventDefault();
        let base_url = 'http://localhost/sitio-keops/';
        var idrol =  $('#idrol').val();
        var modulo = $('#idmodulo').val();     
        var read =   $("#rea:checked").val();         
        var write =  $('#wea:checked').val();
        var update = $('#uea:checked').val();
        var delet =  $('#dea:checked').val();
      
       $.ajax({
          url: base_url + 'Permisos/actualizar',
          type: "post",
          dataType: "json",
          data: {
                  "idrol":  idrol,
                  "modulo": modulo,
                  "read":   read,
                  "write":  write, 
                  "update": update,
                  "delete": delet,                
              
                },
                success: function(data)
                {                    
                  if(data.status == false)
                  {           
                    MostrarAlertaObligado("Error",data.msg ,"error")               
                  }      
                  else
                  {     
                    MostrarAlertaObligado("Atencion",data.post ,"success")    
                    refrescar();       
                  }                             
                }              
          });       

});      

 /**Eliminar Roles */
$(document).on("click",".btnDelRol", function(e){
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
            title: 'Eliminar Rol',
            text: "¿Realmente quiere eliminar el Rol?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
              url: base_url + 'Roles/deleteRole/'+ id_delete,
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
                            refrescar(),
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
                    'El Rol no fue eliminado',
                    'error'
                  )
                }
        })
  });   

  

    /**eliminar permisos rol */
$(document).on("click","#btnDeletePermisos", function(e){
      e.preventDefault();
      let base_url = 'http://localhost/sitio-keops/';
      var id_delete = $(this).attr("href");    
      
      const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
         buttonsStyling: false
        })      
           swalWithBootstrapButtons.fire({
            title: 'Eliminar Permiso',
            text: "¿Realmente quiere eliminar el Permiso?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
              url: base_url + 'Permisos/eliminar/'+ id_delete,
              type: "post",
              dataType: "json",
              data: {
                       id_delete: id_delete
                    },                 
              success: function(data){
                    if(data.response == true ){
                        swalWithBootstrapButtons.fire(
                            'Eliminado!',
                            data.post,
                            'success',                    
                            window.location.href = base_url + 'permisos',
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
                    'Su archivo no fue eliminado',
                    'error'
                  )
                }
          })      
    });

    //Editar Roles
$(document).on("click",".btnEditPermisos", function(e){
      e.preventDefault();
      let base_url = 'http://localhost/sitio-keops/';
      var id = $(this).attr("rl");  
      document.querySelector('#update').classList.replace("btn-primary", "btn-info");
 
      if(id == "")
      {
        alert("Id rol required")
      }
      else
      {
          $.ajax({
           url: base_url + 'Roles/editarRol/'+ id,
           type: "post",
           dataType: "json",
           data: {
                  id: id
                 },
           success: function(dato)
           {        
             if(dato.status == true){  
                            
                $("#edit_editar_Rol").val(dato.post.idrol);
                $("#edit_nombre").val(dato.post.nombrerol);
                $("#edit_descripcion").val(dato.post.descripcion);  
       
                if(dato.post.status == 1)
                {
                     var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                     var htmlSelect = `${optionSelect}<option value="1">Inactivo</option>`;
                }      
                else
                {
                     var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
                     var htmlSelect = `${optionSelect}<option value="2">Activo</option>`;
                }                  
                    document.querySelector('#edit_listStatus').innerHTML = htmlSelect;
                   $('#modalEditarRol').modal('show');         
             }
             else
             {
              MostrarAlertaObligado("Error", dato.msg, "error");
             }      
           }
       });
     }
 
     });


       //update Roles
$(document).on("click","#update", function(e){
      e.preventDefault();
      let base_url = 'http://localhost/sitio-keops/';
      var edit_actualizar_id = $('#edit_editar_Rol').val();
      var edit_actualizar_nombre = $('#edit_nombre').val();
      var edit_actualizar_descripcion = $('#edit_descripcion').val();
      var edit_status = $('#edit_listStatus').val();
      /**tomamos el valor que trae el status y en la condicion la cambiamos  el valor para actualizarlo  */
      
      if(edit_status == 1)
        {
            var optionSelect = "2";          
        }
        else
        {
            var optionSelect = "1";   
        }
       var edit_actualizar_status =  optionSelect;
     
        $.ajax({
          url: base_url + 'Roles/updateRol',
          type: "post",
          dataType: "json",
          data: {
                   actualizar_id: edit_actualizar_id,
                   actualizar_nombre: edit_actualizar_nombre,
                   actualizar_descripcion: edit_actualizar_descripcion,
                   actualizar_status: edit_actualizar_status,                   
                },
                success: function(data)
                {                    
                  if(data.status == false)
                  {           
                    MostrarNoActualizado("Error",data.msg ,"error")               
                  }      
                  else
                  {     
                    MostrarActualizado("Atencion",data.post ,"success")           
                  }                             
                }              
              });        
       });
      
    
function refrescar()
    {
       location.reload();     
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
                 refrescar(),
              )
            }            
          })          
          $('#modalFormRol').modal("hide")  
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
                'Los datos no se pudieron guardar',
                'error',               
              )
            }            
          })          
          $('#modalFormRol').modal("hide") 
   
  }
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
                'Se guardó el nuevo cambio',
                'success',
                refrescar(),
              )          
            }            
          })          
          $('#modalEditarRol').modal("hide")                        
       
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
          $('#modalEditarRol').modal("hide")
   }  
  function openModal(){
      
        document.querySelector('#idRol').value ="";
        document.querySelector('.modal-header').classList.replace( "headerUpdate","headerRegister");
        document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
        document.querySelector('#btnText').innerHTML = "Guardar";
        document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
        document.querySelector('#formRol').reset();   
        $('#modalFormRol').modal('show');
   }
  function MostrarAlertaObligado(title, text, icon)
  {  
        Swal.fire({
            title,
            text,
            icon   
                     
         });         
        
  }
