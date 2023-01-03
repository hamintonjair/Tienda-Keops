window.addEventListener('load', function() {
    // fntModalUsuario();
    VerCategoria()
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

    //NUEVA CATEGORIA

    $("#formCategoria").submit(function(e) {
        e.preventDefault();
        let base_url = 'http://localhost/sitio-keops/';
        let formData = new FormData($("#formCategoria")[0]);

        $.ajax({
            type: 'POST',
            url: base_url + 'Categorias/setCategoria',
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            success: function(dato) {

                if (dato.status == true) {

                    $('#modalFormCategorias').modal("hide");
                    //   formCategoria.reset();
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


//ver info categorias
function VerCategoria() {
    var btnVerCategoria = document.querySelectorAll(".btnVerCategoria");
    btnVerCategoria.forEach(function(btnVerCategoria) {
        btnVerCategoria.addEventListener('click', function() {
            let base_url = 'http://localhost/sitio-keops/';
            var idcategoria = this.getAttribute("us");

            $.ajax({
                type: 'POST',
                url: base_url + 'Categorias/getCategorias/' + idcategoria,
                dataType: "json",
                data: {
                    idcategoria: idcategoria
                },
                success: function(dato) {
                    if (dato.status) {

                        var estado = dato.post.status == 1 ?

                            '<span class="badge badge-success">Action</span>' :
                            '<span class="badge badge-danger">Inactivo</span>';

                        document.querySelector("#celId").innerHTML = dato.post.idcategoria;
                        document.querySelector("#celNombre").innerHTML = dato.post.nombre;
                        document.querySelector("#celDescripcion").innerHTML = dato.post.descripcion;
                        document.querySelector("#celEstado").innerHTML = estado;
                        document.querySelector("#imgCategoria").innerHTML = '<img src="' + dato.post.url_portada + '"></img>';


                        $('#modalViewCategoria').modal("show");
                    } else {
                        MostrarAlert("Error", dato.msg, "error");
                    }
                }

            });
            // location.reload();
        });
    });

}

//update categoria
$(document).on("click", ".btnEditCategoria", function(e) {
    e.preventDefault();
    let base_url = 'http://localhost/sitio-keops/';
    document.querySelector('#titleModal').innerHTML = "Actualizar Categoría";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    var idcategoria = $(this).attr("rl");
    // document.querySelector('#update').classList.replace("btn-primary", "btn-info");


    if (idcategoria == "") {
        alertError("Error", "Id persona required", "error")
    } else {
        let formData = new FormData($("#formCategoria")[0]);
        $.ajax({
            type: 'POST',
            url: base_url + 'Categorias/getCategorias/' + idcategoria,
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,

            success: function(dato) {
                if (dato.status) {

                    $("#idCategoria").val(dato.post.idcategoria);
                    $("#txtNombre").val(dato.post.nombre);
                    $("#txtDescripcion").val(dato.post.descripcion);
                    $("#foto_actual").val(dato.post.portada);
                    $("#foto_remove").val(0);

                    if (dato.post.status == 1) {
                        document.querySelector("#listStatus").value = 1;
                    } else {
                        document.querySelector("#listStatus").value = 2;
                    }
                    $("#listStatus").selectpicker('render');

                    if (document.querySelector('#img')) {
                        document.querySelector('#img').src = dato.post.url_portada;
                    } else {
                        document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + dato.post.url_portada + ">";
                    }
                    if (dato.post.portada == 'img_portada.png') {
                        document.querySelector('.delPhoto').classList.add("notBlock");
                    } else {
                        document.querySelector('.delPhoto').classList.remove("notBlock");
                    }
                    $('#modalFormCategorias').modal("show");
                } else {
                    MostrarAlert("Error", dato.msg, "error");
                }
            }

        });
    }
});

/**Eliminar categorias */
$(document).on("click", ".btnDelCategoria", function(e) {
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
                url: base_url + 'Categorias/deleteCategoria/' + id_delete,
                type: "post",
                dataType: "json",
                data: {
                    id_delete: id_delete
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
                'La categoría no fue eliminada',
                'error'
            )
        }
    })
});


function openModalCategorias() {

    document.querySelector('#idCategoria').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Categoria";
    document.querySelector('#formCategoria').reset();
    $('#modalFormCategorias').modal('show');

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