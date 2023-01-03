function openModalConfiguracion(){     
  
    $('#modalFormConfiguracion').modal('show');  
}
var divLoading = document.querySelector("#divLoading");
  //Insert configuracion

document.addEventListener("DOMContentLoaded", function() {

    if (document.querySelector("#foto2")) {
        var foto2 = document.querySelector("#foto2");
        foto2.onchange = function(e) {

            var uploadFoto = document.querySelector("#foto2").value;
            var fileimg = document.querySelector("#foto2").files;
            var nav = window.URL || window.webkitURL;
            var contactAlert = document.querySelector('#form_alert');

            if (uploadFoto != '') {
                var type = fileimg[0].type;
                var name = fileimg[0].name;
                if (type  != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido, debe ser de formato png.</p>';
                    if (document.querySelector('#img')) {
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.add("notBlock");
                    foto2.value = "";
                    return false;
                } else {
                    contactAlert.innerHTML = '';
                    if (document.querySelector('#img')) {
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                    var objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhoto2 div').innerHTML = "<img id='img' src=" + objeto_url + ">";
                }
            } else {
                alert("No selecciono logo");
                if (document.querySelector('#img')) {
                    document.querySelector('#img').remove();
                }
            }
        }
    }


    if (document.querySelector(".delPhoto")) {
        var delPhoto = document.querySelector(".delPhoto");
        delPhoto.onclick = function(e) {
            document.querySelector("#foto_remove").value = 1;
            removePhoto();
        }
    }
    //remueve las fotos
    function removePhoto() {
        document.querySelector('#foto2').value = "";
        document.querySelector('.delPhoto').classList.add("notBlock");
        document.querySelector('#img').remove();
    }

  (function($){    
    $("#formConfiguracion").submit(function(e){
              e.preventDefault();
        let base_url = 'http://localhost/sitio-keops/';
           let formConfiguracion = document.querySelector("#formConfiguracion");

            var Nombre          = $('#Nombre').val();
            var Direccion       = $('#Direccion').val();
            var Telefono        = $('#Telefono').val();
            var Whatsapp        = $('#Whatsapp').val();           
            var EmailEmpresa    = $('#EmailEmpresa').val();         
            var EmailPedido     = $('#EmailPedido').val(); 
            var EmailSucripcion = $('#EmailSucripcion').val();
            var EmailContacto   = $('#EmailContacto').val();
            var EmailRemitente  = $('#EmailRemitente').val();                   
            var Remitente       = $('#Remitente').val();         
            var Descripcion     = $('#Descripcion').val();
            var NombreTienda    = $('#NombreTienda').val();           
            var CostoEnvio      = $('#CostoEnvio').val(); 
            var costo_envioP      = $('#costo_envioP').val();         
            var Facebook        = $('#Facebook').val();                     
            var idClientePaypal = $('#idClientePaypal').val();           
            var SecretPaypal    = $('#SecretPaypal').val();         
           
  
            if(Nombre == '' || Direccion == '' || Telefono == '' || Whatsapp == '' || EmailEmpresa == '' || EmailPedido == '' || EmailSucripcion == '' || EmailContacto == '' || EmailRemitente == '' || Remitente == '' || Descripcion == '' || NombreTienda == '' || CostoEnvio == '' || costo_envioP == '' || Facebook == '' || idClientePaypal == '' || SecretPaypal == '')
            {
              alertError("Error", "Todos los campos son obligatorios.", "error");
                return false;
            } 
            divLoading.style.display = "flex";
            let formData = new FormData(formConfiguracion);    
            $.ajax({
                type: 'POST',
                url: base_url + 'Configuracion/putConfiguracion',
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                async: false,
                success:function(dato)
                {                   
                    if(dato.status == false){
                      alertError("Oops...",dato.msg, "info");                     
                      return
                      
                    }else{  
                        $('#modalFormConfiguracion').modal('show'); 
                        MostrarAlert("Atención",dato.post, "success");  
                    }                                   
                },
                error: function()
                {             
                  alertError("Error!","Los datos no pudieron ser ingresados", "error");                     
                
                },
               
            })
                divLoading.style.display = "none";                      
          });   
     })(jQuery)  
 
    }, false);


function btnActionCancela(){
    location.reload();
}

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
       $('#modalFormConfiguracion').modal('hide');  
 }
  