
var divLoading = document.querySelector("#divLoading");
let rowTable;
//trael los datos para el reembolso de paypal
function fntTransaccion(idtransaccion){
      let base_url = 'http://localhost/sitio-keops/';
    divLoading.style.display = "flex";
    $.ajax({				
        type: 'POST',
        url: base_url + 'Pedidos/getTransaccion/'+idtransaccion,
        dataType: "json",    
        contentType: false,
        processData: false,
        async: false,
        success: function(data) {
          
            if(data.status){						
                document.querySelector("#divModal").innerHTML = data.html;
                $('#modalReembolso').modal('show');
            }else{
                MostrarAlertaAlert("", data.msg , "error");
               
            }
              
            divLoading.style.display = "none";
            return false;
        }
    });		
}
//realizar el reembolso de paypal
function fntReembolsar(){
    let base_url = 'http://localhost/sitio-keops/';
    let idtransaccion = document.querySelector("#idtransaccion").value;
    let observacion = document.querySelector("#txtObservacion").value;
    if(idtransaccion == '' || observacion == ''){
        MostrarAlertaAlert("", "Complete los datos para continuar." , "error");
        return false;
    }

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
       buttonsStyling: false
      })      
         swalWithBootstrapButtons.fire({
            title: "Hacer Reembolso",
            text: "¿Realmente quiere realizar el reembolso?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, eliminar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true

      }).then((result) => {
      if (result.isConfirmed) {
         
        $('#modalReembolso').modal('hide');  
        divLoading.style.display = "flex";        
        let request = (window.XMLHttpRequest) ? 
        new XMLHttpRequest() : 
        new ActiveXObject('Microsoft.XMLHTTP');
        
        let ajaxUrl = base_url+'/Pedidos/setReembolso';
        let formData = new FormData();
        formData.append('idtransaccion',idtransaccion);
        formData.append('observacion',observacion);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
         if(request.readyState != 4) return;
            if(request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status){  
                    window.location.reload();
                }else{
                    MostrarAlertaAlert("Error", objData.msg , "error");
                }
                 divLoading.style.display = "none";
                return false;
            }
          }
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
        //   divLoading.style.display = "none";
         return false;
      })
}
//mostrar los datos del pedido seleccionado a actualizar
function fntEditInfo(element,idpedido){
 let base_url = 'http://localhost/sitio-keops/';
    var rowTable = element.parentNode.parentNode.parentNode;

    divLoading.style.display = "flex";
    $.ajax({
        type: 'POST',
        url: base_url + 'Pedidos/getPedido/' + idpedido ,
        dataType: "json",  
        success: function(data) {
            if(data.status)           { 
               
                document.querySelector("#divModal").innerHTML = data.html;
               $('#modalFormPedido').modal('show');
               $('select').selectpicker();
               fntUpdateInfo();
            }else{
                MostrarAlertaAlert("Error", data.msg , "error");
            }           
             divLoading.style.display = "none";
            return false;
        }
    })
   
}
//actualizacion informacion de pedidos
function fntUpdateInfo(){      
   let base_url = 'http://localhost/sitio-keops/';
    let formUpdatePedido = document.querySelector("#formUpdatePedido");
    formUpdatePedido.onsubmit = function(e) {
        e.preventDefault();

        let transaccion;
        if(document.querySelector("#txtTransaccion")){
            transaccion = document.querySelector("#txtTransaccion").value;
            if(transaccion == ""){
                MostrarAlertaAlert("", "Complete los datos para continuar." , "error");
                return false;
            }
        }         
        divLoading.style.display = "flex";
    
        let formData = new FormData(formUpdatePedido);
        $.ajax({
			type: 'POST',
			url: base_url + 'Pedidos/setPedido',
			dataType: "json",
			data: formData,
			contentType: false,
			processData: false,
			async: false,
			success: function(data) {
				if(data.status)
                { 
                    MostrarAlertaSuccess("", data.msg ,"success");
                    $('#modalFormPedido').modal('hide');
                    location.reload();  
             
                }else{
                    MostrarAlertaAlert("Error", data.msg , "error");
                }
				divLoading.style.display = "none";
				return false;
			}
            
		})
    }
}


function MostrarAlertaAlert(title, text, icon)
  {  
        Swal.fire({
            title,
            text,
            icon                      
         });         
		
  }
function MostrarAlertaSuccess(title, text, icon)
  {  
        Swal.fire({
            title,
            text,
            icon                      
         });  
	     
  }