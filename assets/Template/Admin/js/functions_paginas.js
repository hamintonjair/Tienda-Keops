var divLoading = document.querySelector("#divLoading");
;
tinymce.init({
    selector: '#txtContenido',
    width: "100%",
    heigth: 400,
    statubar: true,
    plugins: 'preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker editimage help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable export',
    tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
    tinydrive_dropbox_app_key: 'YOUR_DROPBOX_APP_KEY',
    tinydrive_google_drive_key: 'YOUR_GOOGLE_DRIVE_KEY',
    tinydrive_google_drive_client_id: 'YOUR_GOOGLE_DRIVE_CLIENT_ID',
    mobile: {
        plugins: 'preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker help formatpainter pageembed charmap mentions quickbars linkchecker emoticons advtable'
    },
    menu: {
        tc: {
            title: 'Comments',
            items: 'addcomment showcomments deleteallconversations'
        }
    },
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
});

if(document.querySelector("#formPaginas")){

    let formPaginas = document.querySelector("#formPaginas");
    let base_url = 'http://localhost/sitio-keops/';
    formPaginas.onsubmit = function(e) {
        e.preventDefault();
        let strTitulo = document.querySelector('#txtTitulo').value;
        let strContenido = document.querySelector('#txtContenido').value;
        let intStatus = document.querySelector('#listStatus').value;
        if(strTitulo == '' || strContenido == '' || intStatus == '' )
        {
            return false;
        }
        divLoading.style.display = "flex";
        tinyMCE.triggerSave();    
        let formData = new FormData(formPaginas);
        $.ajax({				
                type: 'POST',
                url: base_url + 'Paginas/setPagina',
                dataType: "json",  
                data: formData,  
                contentType: false,
                processData: false,
                async: false,
                success: function(data) {                
                    if(data.status){
                        
                        MostrarAlertaAlert("", data.msg , "success");
                        location.reload();                       
                    }else{
                        MostrarAlertaAlert("", data.msg , "error");
                    
                    }                    
                    divLoading.style.display = "none";
                    return false;
                }
      });		

    }
}


 if (document.querySelector("#foto")) {
        var foto = document.querySelector("#foto");
        foto.onchange = function(e) {
            let base_url = 'http://localhost/sitio-keops/';
            var uploadFoto = document.querySelector("#foto").value;
            var fileimg = document.querySelector("#foto").files;
            var nav = window.URL || window.webkitURL;
            var contactAlert = document.querySelector('#form_alert');

            if (uploadFoto != '') {
                var type = fileimg[0].type;
                var name = fileimg[0].name;
                if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                    if (document.querySelector('#img')) {
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.add("notBlock");
                    foto.value = "";
                    return false;
                } else {
                    contactAlert.innerHTML = '';
                    if (document.querySelector('#img')) {
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                    var objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + objeto_url + ">";
                }
            } else {
                alert("No selecciono foto");
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
        document.querySelector('#foto').value = "";
        document.querySelector('.delPhoto').classList.add("notBlock");
        document.querySelector('#img').remove();
    }



// if(document.querySelector("#foto")){
//     let foto = document.querySelector("#foto");
//     foto.onchange = function(e) {
//         let uploadFoto = document.querySelector("#foto").value;
//         let fileimg = document.querySelector("#foto").files;
//         let nav = window.URL || window.webkitURL;
//         let contactAlert = document.querySelector('#form_alert');
//         if(uploadFoto !=''){
//             let type = fileimg[0].type;
//             let name = fileimg[0].name;
//             if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
//                 contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
//                 if(document.querySelector('#img')){
//                     document.querySelector('#img').remove();
//                 }
//                 document.querySelector('.delPhoto').classList.add("notBlock");
//                 foto.value="";
//                 return false;
//             }else{  
//                     contactAlert.innerHTML='';
//                     if(document.querySelector('#img')){
//                         document.querySelector('#img').remove();
//                     }
//                     document.querySelector('.delPhoto').classList.remove("notBlock");
//                     let objeto_url = nav.createObjectURL(this.files[0]);
//                     document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objeto_url+">";
//                 }
//         }else{
//             alert("No selecciono foto");
//             if(document.querySelector('#img')){
//                 document.querySelector('#img').remove();
//             }
//         }
//     }
// }

// if(document.querySelector(".delPhoto")){
//     let delPhoto = document.querySelector(".delPhoto");
//     delPhoto.onclick = function(e) {
//         if(document.querySelector("#foto_remove")){
//             document.querySelector("#foto_remove").value= 1;
//         }
//         removePhoto();
//     }
// }
// function removePhoto(){
//     document.querySelector('#foto').value ="";
//     document.querySelector('.delPhoto').classList.add("notBlock");
//     if(document.querySelector('#img')){
//         document.querySelector('#img').remove();
//     }
// }
 /**Eliminar producto */
 $(document).on("click",".btnDelProducto", function(e){
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
                 title: 'Eliminar Producto',
                 text: "¿Realmente quiere eliminar el Producto?",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonText: 'Si, Eliminar!',
                 cancelButtonText: 'No, cancel!',
                 reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
     
               $.ajax({
                 url: base_url + 'Productos/delProducto/'+ id_delete,
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
                     'El Producto no fue eliminado',
                      'error'
                     )
                    }
               })
});
function fntDelInfo(idpagina){
    let base_url = 'http://localhost/sitio-keops/';
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
       buttonsStyling: false
      })           
         swalWithBootstrapButtons.fire({
          title: 'Eliminar Página',
          text: "¿Realmente quiere eliminar el página?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Si, Eliminar!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
     }).then((result) => {
     if (result.isConfirmed) {

        $.ajax({
          url: base_url + 'Paginas/delPagina/'+ idpagina,
          type: "post",
          dataType: "json",
          data: {
            idPagina: idpagina
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
              'El Producto no fue eliminado',
               'error'
              )
             }
        })
 
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