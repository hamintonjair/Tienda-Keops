//document.write(`<script src="${base_url()}/assets/Template/Admin/js/plugins/jsBarcode.all.min.js"></script>`);
var divLoading = document.querySelector("#divLoading");

$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});
window.addEventListener('load', function() {
    // fntModalUsuario();

}, false);
//insertar producto
window.addEventListener('load', function() {
    let base_url = 'http://localhost/sitio-keops/';
    if (document.querySelector("#formProducto")) {
        let productos = this.document.querySelector("#formProducto");
        productos.onsubmit = function(e) {
            e.preventDefault();

            let descripcion = document.querySelector('#txtDescripcionC').value;
            let nombre = document.querySelector('#txtNombre').value;
            let codigo = document.querySelector('#txtCodigo').value;
            let precio = document.querySelector('#txtPrecio').value;
            let stock = document.querySelector('#txtStock').value;
            let usd = document.querySelector('#USD').value;

            if (nombre == '' || codigo == '' || precio == '' || stock == '' || usd == '') {
                MostrarAlertt("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            if (descripcion == '') {
                MostrarAlertt("Atención", "Es necesario que agregues una descripción.", "error");
                return false;
            }

            if (codigo.length < 5) {
                MostrarAlertt("Atención", "El código debe ser mayor que 5 dígitos.", "error");
                return false;
            }
            divLoading.style.display = "flex";
            let formData = new FormData($("#formProducto")[0]);

            tinymce.triggerSave();
            $.ajax({
                type: 'POST',
                url: base_url + 'Productos/setProductos',
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                async: false,
                success: function(datos) {

                    if (datos.status == true) {
                      
                        Mostrarr("Atención", datos.post, "success");                    
                        document.querySelector("#idProducto").value = datos.idproducto.idproducto;
                        document.querySelector("#containerGallery").classList.remove("notblock");

                    } else {
                        MostrarAlertt("Error", datos.msg, "error");
                    };
                    divLoading.style.display = "none";
                  
                }

            });

            return false;
        }

    }

    //funcion para la carga de imagen

    if (document.querySelector(".btnAddImage")) {
        let btnAddImage = document.querySelector(".btnAddImage");
        btnAddImage.onclick = function(e) {
            let key = Date.now();
            let newElement = document.createElement("div");
            newElement.id = "div" + key;
            newElement.innerHTML = `
				 <div class="prevImage" ></div>
				 <input type="file" name="foto" id="img${key}" class="inputUploadfile">
				 <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload "></i></label>
				 <button class="btnDeleteImage notblock " type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
            document.querySelector("#containerImages").appendChild(newElement);
            document.querySelector("#div" + key + " .btnUploadfile").click();
            fntInputFile();
        }

    }

    fntInputFile();

}, false);

$(document).on("click", "s", function(e) {
    e.preventDefault();
    $('#modalFormProductos').modal("show");
    var idproducto = this.getAttribute("us");

    alert(idproducto);

})


if (document.querySelector("#txtCodigo")) {
    let inputCodigo = document.querySelector("#txtCodigo");
    inputCodigo.onkeyup = function() {
        if (inputCodigo.value.length >= 5) {
            document.querySelector('#divBarcode').classList.remove("notblock");
            fntBarcode();
        } else {
            document.querySelector('#divBarcode').classList.add("notblock");
        }
    }
}

tinymce.init({
    selector: '#txtDescripcionC',
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

//guardar imagen
function fntInputFile() {
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function(inputUploadfile) {
        inputUploadfile.addEventListener('change', function() {
          
            let base_url = 'http://localhost/sitio-keops/';
            let idProducto = document.querySelector("#idProducto").value;
            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");
            let uploadFoto = document.querySelector("#" + idFile).value;
            let fileimg = document.querySelector("#" + idFile).files;
            let prevImg = document.querySelector("#" + parentId + " .prevImage");
            let nav = window.URL || window.webkitURL;
            if (uploadFoto != '') {
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                    prevImg.innerHTML = "Archivo no válido";
                    uploadFoto.value = "";
                    return false;
                } else {              
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${base_url}assets/Template/Admin/images/loading.svg" >`;
                    let formData = new FormData($("#formProducto")[0]);
                    formData.append('idproducto', idProducto);
                    formData.append("foto", this.files[0]);
                    $.ajax({
                        type: 'POST',
                        url: base_url + 'Productos/setImage',
                        dataType: "json",
                        data: formData,
                        contentType: false,
                        processData: false,
                        async: false,
                        success: function(data) {
                            if (data.status) {

                                prevImg.innerHTML = `<img src="${objeto_url}">`;
                                document.querySelector("#" + parentId + " .btnDeleteImage").setAttribute("imgname", data.imgname);
                                document.querySelector("#" + parentId + " .btnUploadfile").classList.add("notblock");
                                document.querySelector("#" + parentId + " .btnDeleteImage").classList.remove("notblock");

                                Mostrarr("Atención", data.img, "success");

                            } else {
                                MostrarAlertt("Oops...", data.msg, "info");

                            }                       
                        }
                    });
                }
            }

        });
    });
}

//ver productos
$(document).on("click", ".btnVerProducto", function(e) {
    e.preventDefault();
    var idproducto = this.getAttribute("rl");
    let base_url = 'http://localhost/sitio-keops/';
    $.ajax({
        type: 'POST',
        url: base_url + 'Productos/getProducto/' + idproducto,
        dataType: "json",
        data: {
            idproducto: idproducto
        },
        success: function(datos) {
            if (datos.status) {

                let htmlImage = "";
                let objProducto = datos.data;
                let estadoProducto = datos.status == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celCodigo").innerHTML = objProducto.codigo;
                document.querySelector("#celNombre").innerHTML = objProducto.nombre;
                document.querySelector("#celPrecio").innerHTML = objProducto.precio;
                document.querySelector("#celStock").innerHTML = objProducto.stock;
                document.querySelector("#celCategoria").innerHTML = objProducto.categoria;
                document.querySelector("#celStatus").innerHTML = estadoProducto;
                document.querySelector("#celDescripcion").innerHTML = objProducto.descripcion;


                if (objProducto.images) {
                    let objProductos = objProducto.images;

                    for (let p = 0; p < objProductos.length; p++) {
                        htmlImage += `<img src="${objProductos[p].url_image}"></img>`;
                    }

                }
                document.querySelector("#celFotos").innerHTML = htmlImage;
                $('#modalViewProductos').modal('show');
            } else {
                MostrarAlertt("Error", datos.msg, "error");
            }

        }
    });

});

//editar producto
$(document).on("click", ".btnEditProducto", function(e) {
    e.preventDefault();
    var idProducto = this.getAttribute("rl");
    let base_url = 'http://localhost/sitio-keops/';
    // rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Producto";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    $.ajax({
        type: 'POST',
        url: base_url + 'Productos/getProducto/' + idProducto,
        dataType: "json",
        data: {
            idProducto: idProducto
        },
        success: function(datos) {
            if (datos.status) {

                let htmlImage = "";
                let objProducto = datos.data;
                document.querySelector("#idProducto").value = objProducto.idproducto;
                document.querySelector("#txtNombre").value = objProducto.nombre;
                document.querySelector("#txtDescripcionC").value = objProducto.descripcion;
                document.querySelector("#txtCodigo").value = objProducto.codigo;
                document.querySelector("#txtPrecio").value = objProducto.precio;
                document.querySelector("#txtStock").value = objProducto.stock;
                document.querySelector("#listCategoria").value = objProducto.categoriaid;
                document.querySelector("#listStatus").value = objProducto.status;
                tinymce.activeEditor.setContent(objProducto.descripcion);
                $('#listCategoria').selectpicker('render');
                $('#listStatus').selectpicker('render');
                fntBarcode();

                if (objProducto.images.length > 0 || objProducto.images.length < 0) {
                    let objProductos = objProducto.images;
                    for (let p = 0; p < objProductos.length; p++) {
                        let key = Date.now() + p;
                        htmlImage += `<div id="div${key}">
                            <div class="prevImage">
                            <img src="${objProductos[p].url_image}"></img>
                            </div>
                            <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgname="${objProductos[p].img}">
                            <i class="fas fa-trash-alt"></i></button></div>`;
                    }
                }
                document.querySelector("#containerImages").innerHTML = htmlImage;
                document.querySelector("#divBarcode").classList.remove("notblock");
                document.querySelector("#containerGallery").classList.remove("notblock");
                $('#modalFormProductos').modal('show');
            } else {
                MostrarAlertt("Error", datos.msg, "error");
            }
        }

    });

});

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

//eliminar imagen
 function fntDelItem(element){
            let nameImg = document.querySelector(element+' .btnDeleteImage').getAttribute("imgname");
            let idProducto = document.querySelector("#idProducto").value;
            let base_url = 'http://localhost/sitio-keops/';
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Productos/delFile'; 
        
            let formData = new FormData();
            formData.append('idproducto',idProducto);
            formData.append("file",nameImg);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState != 4) return;
                if(request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        let itemRemove = document.querySelector(element);
                        itemRemove.parentNode.removeChild(itemRemove);
                        Mostrarr("", objData.post , "success");
                    }else{
                        MostrarAlertt("", objData.msg , "error");
                    }
                }
            }
        }

function fntBarcode() {
    let codigo = document.querySelector('#txtCodigo').value;
    JsBarcode("#barcode", codigo);
}


function printBarcode(area) {
    let elementArea = document.querySelector(area);
    let vprint = window.open(' ', 'popimpr', 'height=400,width=600');
    vprint.document.write(elementArea.innerHTML);
    vprint.document.close();
    vprint.print();
    vprint.close();
}

function openModalProductos() {

    document.querySelector('#idProducto').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Producto";
    document.querySelector('#formProducto').reset();
    document.querySelector("#divBarcode").classList.add("notblock");
    document.querySelector("#containerGallery").classList.add("notblock");
    document.querySelector("#containerImages").innerHTML = "";
    $('#modalFormProductos').modal('show');
}
function btnActionCancelar(){
    location.reload();
}



function MostrarAlertt(title, text, icon) {
    Swal.fire({
        title,
        text,
        icon,

    });
   
}

function Mostrarr(title, text, icon) {
    Swal.fire({
        title,
        text,
        icon,

    });
}

function Mostrar(title, text, icon) {
    Swal.fire({
        title,
        text,
        icon,

    });
    location.reload();
}
