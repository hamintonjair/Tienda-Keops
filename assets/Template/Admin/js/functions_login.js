var divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector("#formLogin")) {

        let base_url = 'http://localhost/sitio-keops/';
        let formLogin = document.querySelector("#formLogin");
        formLogin.onsubmit = function(e) {
            e.preventDefault();
      
            var strEmail = $('#txtEmail').val();
            var strPassword = $('#txtPassword').val();


            if (strEmail == "" || strPassword == "") {
                MostrarAlerta("Atencion", "Escribe un usuario y contraseña.", "error");
                return false;
            } else {
                divLoading.style.display = "flex",
                    $.ajax({

                        type: 'POST',
                        url: base_url + 'Login/LoginUser',
                        dataType: "json",
                        data: {
                            "strEmail": strEmail,
                            "strPassword": strPassword,

                        },
                        success: function(dato) {
                            if (dato.status == true) {
                                MostrarAlerta("Atención", dato.post, "success");
                                window.location.href = base_url + 'dashboard';
                                window.location.reload(false);
                                divLoading.style.display = "none";
                            } else {

                                MostrarAlerta("Error", dato.msg, "error");
                                divLoading.style.display = "none";
                                //     document.querySelector('#txtPassword').val() = "";
                            }
                        },
                        error: function() {
                            MostrarAlerta("Atención", "No se pudo iniciar sesión", "error");
                            divLoading.style.display = "none";
                        },

                    })

            }

        }
    }
    //resetear password
    if (document.querySelector("#formRecetPass")) {
        let base_url = 'http://localhost/sitio-keops/';
        let formRecetPass = document.querySelector("#formRecetPass");
        formRecetPass.onsubmit = function(e) {
            e.preventDefault();

            let txtEmailReset = document.querySelector('#txtEmailReset').value;

            if (txtEmailReset == "") {
                MostrarAlerta("Por favor", "Escribe tu correo electrónico.", "error");
                return false;
            } else {
                divLoading.style.display = "flex";
                $.ajax({
                    type: 'POST',
                    url: base_url + 'Login/resetPass',
                    dataType: "json",
                    data: {
                        "txtEmailReset": txtEmailReset,
                    },
                    success: function(datos) {

                        if (datos.status == true) {

                            Swal.fire({
                                title: "",
                                text: datos.post,
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = base_url + 'login';
                                    divLoading.style.display = "none";
                                }
                            })

                        } else {

                            MostrarAlerta("Error", datos.msg, "error");
                            divLoading.style.display = "none";
                        }
                    },
                    error: function() {

                        MostrarAlerta("Atención", "Error en el proceso", "error");
                        divLoading.style.display = "none";
                    }

                })
            }
        }
    }
    //cambiar password
    if (document.querySelector("#formCambiarPass")) {
        let base_url = 'http://localhost/sitio-keops/';
        let formCambiarPass = document.querySelector("#formCambiarPass");
        formCambiarPass.onsubmit = function(e) {
            e.preventDefault();

            let strPassword = document.querySelector('#txtPassword').value;
            let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
            let idUsuario = document.querySelector('#idUsuario').value;
            let strEmail = document.querySelector('#txtEmail').value;
            let strToken = document.querySelector('#txtToken').value;

            if (strPassword == "" || strPasswordConfirm == "") {
                MostrarAlerta("Por favor", "Escribe la nueva contraseña.", "error");
                return false;
            } else {
                if (strPassword.length < 5) {
                    MostrarAlerta("Atención", "La contraseña debe tener un mínimo de 5 caracteres.", "info");
                    return false;
                }
                if (strPassword != strPasswordConfirm) {
                    MostrarAlerta("Atención", "Las contraseñas no son iguales.", "error");
                    return false;
                } else {
                    $.ajax({
                        type: 'POST',
                        url: base_url + 'Login/setPassword',
                        dataType: "json",
                        data: {
                            "idUsuario": idUsuario,
                            "strEmail": strEmail,
                            "strToken": strToken,
                            "strPassword": strPassword,
                            "strPasswordConfirm": strPasswordConfirm,
                        },
                        success: function(dato) {
                            if (dato.status == true) {

                                Swal.fire({
                                    title: "",
                                    text: dato.post,
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Iniciar sessión'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = base_url + 'login';
                                    }
                                })

                            } else {

                                MostrarAlerta("Error", dato.msg, "error");
                            }
                        },
                        error: function() {
                            MostrarAlerta("Atención", "Error en el proceso", "error");
                        }
                    })
                }
            }
        }
    }
});

function MostrarAlerta(title, text,icon) {
    Swal.fire({
        title,
        text,
        icon
       

    })
}