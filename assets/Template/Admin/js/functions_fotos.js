
window.addEventListener('load', function() {
    // fntModalUsuario();
    VerFotos()
}, false);

document.addEventListener("DOMContentLoaded", function() {

    if (document.querySelector("#foto")) {
        var foto = document.querySelector("#foto");
        foto.onchange = function(e) {

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

    //NUEVA Fotos

    $("#formFotos").submit(function(e) {
        e.preventDefault();
        let base_url = 'http://localhost/sitio-keops/';
        let formData = new FormData($("#formFotos")[0]);

        $.ajax({
            type: 'POST',
            url: base_url + 'Fotos/setFotos',
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            success: function(dato) {

                if (dato.status == true) {

                    $('#modalFormFotos').modal("hide");
                    //   formFotos.reset();
                    Mostrar("Atención", dato.post, "success");
                    removePhoto();

                } else {
                    MostrarAlert("Error", dato.msg, "error");
                }
                location.reload();
            }


        })
        return false;

    })


}, false);

//ver info Fotoss
function VerFotos() {
    var btnVerFotos = document.querySelectorAll(".btnVerFotos");
    btnVerFotos.forEach(function(btnVerFotos) {
        btnVerFotos.addEventListener('click', function() {
            let base_url = 'http://localhost/sitio-keops/';
            var idFotos = this.getAttribute("us");

            $.ajax({
                type: 'POST',
                url: base_url + 'Fotos/getFotos/' + idFotos,
                dataType: "json",
                data: {
                    idFotos: idFotos
                },
                success: function(dato) {
                    if (dato.status){
                       
                        document.querySelector("#celId").innerHTML = dato.post.id;                        
                        document.querySelector("#celDescripcion").innerHTML = dato.post.descripcion;                    
                        document.querySelector("#imgFotos").innerHTML = '<img style="width: 298px; height: 198px" src="' + dato.post.url_portada + '"></img>';


                        $('#modalViewFotos').modal("show");
                    } else {
                        MostrarAlert("Error", dato.msg, "error");
                    }
                }

            });
            // location.reload();
        });
    });

}

//update fotos
$(document).on("click", ".btnEditFotos", function(e) {
    e.preventDefault();
    let base_url = 'http://localhost/sitio-keops/';
    document.querySelector('#titleModal').innerHTML = "Actualizar Foto";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    var idFotos = $(this).attr("rl");
    // document.querySelector('#update').classList.replace("btn-primary", "btn-info");


    if (idFotos == "") {
        alertError("Error", "Id persona required", "error")
    } else {
        let formData = new FormData($("#formFotos")[0]);
        $.ajax({
            type: 'POST',
            url: base_url + 'Fotos/getFotos/' + idFotos,
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,

            success: function(dato) {
                if (dato.status) {

                    $("#idFotos").val(dato.post.id);                  
                    $("#txtDescripcion").val(dato.post.descripcion);
                    $("#foto_actual").val(dato.post.img);
                    $("#foto_remove").val(0);

                    if (document.querySelector('#img')) {
                        document.querySelector('#img').src = dato.post.url_portada;
                    } else {
                        document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + dato.post.url_portada + ">";
                    }
                    if (dato.post.img == 'img_portada.png') {
                        document.querySelector('.delPhoto').classList.add("notBlock");
                    } else {
                        document.querySelector('.delPhoto').classList.remove("notBlock");
                    }
                    $('#modalFormFotos').modal("show");
                } else {
                    MostrarAlert("Error", dato.msg, "error");
                }
            }

        });
    }
});

/**Eliminar FOTOS */
$(document).on("click", ".btnDelFotos", function(e) {
    e.preventDefault();
    let base_url = 'http://localhost/sitio-keops/';
    var idFotos = $(this).attr("rl");

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        title: 'Eliminar Categoria',
        text: "¿Realmente quiere eliminar la categoría?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, Eliminar!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: base_url + 'Fotos/deleteFoto/' + idFotos,
                type: "post",
                dataType: "json",
                data: {
                    idFotos: idFotos
                },
                success: function(data) {
                    if (data.status == true) {
                        swalWithBootstrapButtons.fire(
                            'Eliminado!',
                            data.post,
                            'success',
                            location.reload()
                        );
                    } else {
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
                'La foto no fue eliminada',
                'error'
            )
        }
    })
});

function openModalFotos() {

    document.querySelector('#idFotos').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Foto";
    document.querySelector('#formFotos').reset();
    $('#modalFormFotos').modal('show');

}

function Mostrar(title, text, icon) {
    Swal.fire({
        title,
        text,
        icon,

    });


}

function MostrarAlert(title, text, icon) {
    Swal.fire({
        title,
        text,
        icon,

    });
}
