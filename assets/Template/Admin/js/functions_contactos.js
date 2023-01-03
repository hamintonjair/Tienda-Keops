
function fntViewInfo(idmensaje){ 
    let base_url = 'http://localhost/sitio-keops/';
    $.ajax({				
        type: 'POST',
        url: base_url + 'Contactos/getMensaje/'+idmensaje,
        dataType: "json",   
     
        success: function(data) {
          
            if(data.status){	
                           
                document.querySelector("#celCodigo").innerHTML = data.post.id;
                document.querySelector("#celNombre").innerHTML = data.post.nombre;
                document.querySelector("#celEmail").innerHTML = data.post.email;
                document.querySelector("#celFecha").innerHTML = data.post.fecha;
                document.querySelector("#celMensaje").innerHTML = data.post.mensaje;
                $('#modalViewMensaje').modal('show');
            }else{
                MostrarAlertaAlert("", data.msg , "error");
               
            }
        }
    });		
}

function MostrarAlertaAlert(title, text, icon)
  {  
        Swal.fire({
            title,
            text,
            icon                      
         });         
		
  }
