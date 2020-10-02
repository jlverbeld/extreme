$(document).ready(function () {

})
//Guardado de Datos - Formulario de Registro 
function guardarDatos() {
    var idCliente = $('#idCliente').val();
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var email = $('#email').val();
    var telefono = $('#telefono').val();
    var comentario = $('#comentario').val();
    var usuario = $('#usuario').val();
    var password = $('#password').val();

    var emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (usuario.length == 0) {
        Swal.fire(
            'Avertencia!',
            'El campo usuario se encuentra vacio',
            'warning'
        )
    }else if (nombre.length == 0) {
        Swal.fire(
            'Avertencia!',
            'El campo nombre se encuentra vacio',
            'warning'
        )
    } else if (apellido.length == 0) {
        Swal.fire(
            'Avertencia!',
            'El campo apellido se encuentra vacio',
            'warning'
        )
    } else if (email.length == 0) {
        Swal.fire(
            'Avertencia!',
            'El campo email se encuentra vacio',
            'warning'
        )
    } else if (!emailRegex.test(email)) {
        Swal.fire(
            'Avertencia!',
            'Correo electrónico inválido',
            'warning'
        )
    } else if (telefono.length == 0) {
        Swal.fire(
            'Avertencia!',
            'El campo teléfono se encuentra vacio',
            'warning'
        )
    } else if (telefono.length != 7) {
        Swal.fire(
            'Avertencia!',
            'El campo teléfono debe contar con 7 caracteres',
            'warning'
        )
    } else if (comentario.length == 0) {
        Swal.fire(
            'Avertencia!',
            'El campo comentario se encuentra vacio',
            'error'
        )
    } else {
        if (idCliente == '') {
            var accion = 'guardarCliente';
            $.ajax({
                type: "POST",
                dataType: "html",
                url: 'crtDashboard.php',
                data: {
                    'nombre': nombre,
                    'apellido': apellido,
                    'email': email,
                    'telefono': telefono,
                    'comentario': comentario,
                    'usuario' : usuario,
                    'password' : password,
                    'accion': accion
                },
                success: function (data) {
                    Swal.fire(
                        'Buen Trabajo!',
                        data,
                        'success'
                    )

                    location.href = ('../../site/dashboard/dashboard')
                }
            });
        } else {
            var accion = 'editarCliente';
            $.ajax({
                type: "POST",
                dataType: "html",
                url: 'crtDashboard.php',
                data: {
                    'idCliente': idCliente,
                    'nombre': nombre,
                    'apellido': apellido,
                    'email': email,
                    'telefono': telefono,
                    'comentario': comentario,
                    'usuario' : usuario,
                    'password' : password,
                    'accion': accion
                },
                success: function (data) {
                    Swal.fire(
                        'Correcto!',
                        data,
                        'success'
                    )

                    location.href = ('../../site/dashboard/dashboard')
                }
            });
        }

    }



}

//Edicion de datos del Cliente
function editarCliente(idCliente) {
    var accion = 'consultarCliente'

    $.ajax({
        type: "POST",
        dataType: "html",
        url: 'crtDashboard.php',
        data: {
            'idCliente': idCliente,
            'accion': accion
        },
        success: function (data) {
            var data = JSON.parse(data);

            $('#idCliente').val(data.id);
            $('#nombre').val(data.firstname);
            $('#apellido').val(data.lastname);
            $('#email').val(data.email);
            $('#telefono').val(data.phone);
            $('#comentario').val(data.commentary);
            $('#usuario').val(data.user);
            $('#usuario').attr('disabled',true);


        }
    });



}

//Eliminar Cliente
function eliminarCliente(idCliente) {

    Swal.fire({
        title: 'Estas Seguro?',
        text: "No podras revertir esta accion!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                dataType: "html",
                url: 'crtDashboard.php',
                data: {
                    'idCliente': idCliente,
                    'accion': 'eliminarCliente'
                },
                success: function (data) {

                    Swal.fire(
                        'Buen Trabajo!',
                        data,
                        'success'
                    )

                    location.href = ('../../site/dashboard/dashboard')
                }
            });
        }
    })




}

//Asignar PQR
function cargarUsuarioPQR(idUsuario) {
    $('#idPQR').val('');
    $('#estadosPQR').css('display', 'none')
    $('#estado_pqr').css('display', 'block');
    $('#idUsuario').val('');
    $('#tipo_pqr').val('');
    $('#asunto_pqr').val('');
    $('#estado_pqr').val('');
    $('#accionBtnPqr').removeClass('btn-warning')
    $('#accionBtnPqr').addClass('btn-primary')
    $('#accionBtnPqr').html('Crear')
    $('#asunto_pqr').attr('disabled', false);
    $('#tipo_pqr').attr('disabled', false);
    $.ajax({
        type: "POST",
        dataType: "html",
        url: 'crtDashboard.php',
        data: {
            'idUsuario': idUsuario,
            'accion': 'cargarIdUsuarioPQR'
        },
        success: function (data) {
            var data = JSON.parse(data);
            $('#tituloPqr').html('Crear PQR para ' + data['firstname'])

            $('#idUsuario').val(data['id'])
        }
    });
}

//Registro de PQR
function guardarPQR() {
    var idPQR = $('#idPQR').val();


    var idUsuario = $('#idUsuario').val();
    var tipo_pqr = $('#tipo_pqr').val();
    var asunto_pqr = $('#asunto_pqr').val();
    var estado_pqr = $('#estado_pqr').val();


    if (idPQR != '') {
        $.ajax({
            type: "POST",
            dataType: "html",
            url: 'crtDashboard.php',
            data: {
                'idUsuario': idUsuario,
                'tipo_pqr': tipo_pqr,
                'asunto_pqr': asunto_pqr,
                'estado_pqr': estado_pqr,
                'idPQR': idPQR,
                'accion': 'modificarPQR'
            },
            success: function (data) {
                Swal.fire(
                    '',
                    'Estado de PQR Modificado Correctamente!',
                    'success'
                )

                location.href = ('../../site/dashboard/dashboard')

            }
        });
    } else {
        $.ajax({
            type: "POST",
            dataType: "html",
            url: 'crtDashboard.php',
            data: {
                'idUsuario': idUsuario,
                'tipo_pqr': tipo_pqr,
                'asunto_pqr': asunto_pqr,
                'accion': 'guardarPQR'
            },
            success: function (data) {
                Swal.fire(
                    '',
                    'PQR Creado y asignado Correctamente!',
                    'success'
                )

                location.href = ('../../site/dashboard/dashboard')

            }
        });
    }



}

//Carga de datos para edicion de estado PQR
function cargarPQR(idPQR) {
    $("#estado_pqr option[value='Nuevo']").attr("disabled", false);
    $("#estado_pqr option[value='En ejecución']").attr("disabled", false);
    $("#estado_pqr option[value='Cerrado']").attr("disabled", false);
    $.ajax({
        type: "POST",
        dataType: "html",
        url: 'crtDashboard.php',
        data: {
            'idPQR': idPQR,
            'accion': 'cargarPQR'
        },
        success: function (data) {
            var data = JSON.parse(data);
            console.log(data);
            $('#tituloPqr').html('PQR de ' + data[0]['firstname'])

            $('#idPQR').val(data[0]['pqrId']);
            $('#estadosPQR').css('display', 'block');
            $('#idUsuario').val(data[0]['id_usuario']);
            $('#tipo_pqr').val(data[0]['tipo_pqr']);
            $('#tipo_pqr').attr('disabled', true);
            $('#asunto_pqr').val(data[0]['asunto_pqr']);
            $('#asunto_pqr').attr('disabled', true);
            $('#estado_pqr').val(data[0]['estado']);
            if(data[0]['estado'] == 'Nuevo'){
                $("#estado_pqr option[value='Nuevo']").attr("disabled", true);
                $("#estado_pqr option[value='Cerrado']").attr("disabled", true);
            }else if(data[0]['estado'] == 'En ejecución'){
                $("#estado_pqr option[value='Nuevo']").attr("disabled", true);
                $("#estado_pqr option[value='En ejecución']").attr("disabled", true);
            }else if(data[0]['estado'] == 'Cerrado'){
                $("#estado_pqr option[value='Nuevo']").attr("disabled", true);
                $("#estado_pqr option[value='En ejecución']").attr("disabled", true);
                $("#estado_pqr option[value='Cerrado']").attr("disabled", true);
            } 

            if(data[0]['estado'] == 'Cerrado'){
                $('#accionBtnPqr').attr("disabled", true);
            }
            $('#accionBtnPqr').removeClass('btn-primary')
            $('#accionBtnPqr').addClass('btn-warning')
            $('#accionBtnPqr').html('Modificar')
        }
    });
}

//Eliminacion via ID de PQR
function eliminarPQR(idPQR) {

    Swal.fire({
        title: 'Estas Seguro?',
        text: "No podras revertir esta accion!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.value) {

            $.ajax({
                type: "POST",
                dataType: "html",
                url: 'crtDashboard.php',
                data: {
                    'idPQR': idPQR,
                    'accion': 'eliminarPQR'
                },
                success: function (data) {
                    if (data == 1) {
                        Swal.fire(
                            '',
                            'PQR Eliminado Correctamente',
                            'success'
                        )
                    } else {
                        Swal.fire(
                            '',
                            'Ocurrio un error al eliminar PQR',
                            'warning'
                        )
                    }

                    location.href = ('../../site/dashboard/dashboard')


                }
            });

        }
    })

}