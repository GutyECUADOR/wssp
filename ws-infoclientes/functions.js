// Evitar enter en formularios
$(document).ready(function() {

    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });

    $('#divEmail').hide();


    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

});

// ENVIO DEL FORMULARIO

document.getElementById('formularioMain').addEventListener('submit', function(event) {
    event.preventDefault();
    updateDataCliente();
    sendEmail();

})


function showMensajeError(campoError) {
    swal({
        title: 'Campo Obligatorio',
        text: `El campo "${campoError}" se encuentra vacio o no tiene un valor válido`,
        type: 'warning',
        confirmButtonText: 'Aceptar',
        showConfirmButton: true,
    });
}


// ASIGNACION DE EVENTOS

$("#txt_ruc").on('keyup', function() {
    let codEmpresa = $('#select_empresaa').val(); // Recupera el codigo del select 002 etc.
    let cedulaCliente = $(this).val();
    getInfoCliente(codEmpresa, cedulaCliente);
});

$("#select_deportes").on('change', function() {
    let deportes = $(this).val(); // Recupera el codigo del select 002 etc.
    console.log(deportes);
});

$("#recibirInfoMail").on('change', function() {

    let $input = $(this);
    if ($input.prop('checked')) {
        $('#divEmail').show();
    } else {
        $('#divEmail').hide();
    }

});

$("#boton_edit").on('click', function() {
    $('#txt_nombre').prop("readonly", false); // Element(s) are now enabled.
    $('#txt_direccion').prop("readonly", false); // Element(s) are now enabled.
    $('#txt_telefono').prop("readonly", false); // Element(s) are now enabled.
    $('#txt_correoCliente').prop("readonly", false); // Element(s) are now enabled.
});

// FUNCIONES

function getInfoCliente(codEmpresa, cedulaCliente) {
    $.ajax({
        type: 'get',
        url: 'ajax/ajax_getInfoCliente.php',
        data: { cod_WF: codEmpresa, ruc: cedulaCliente },

        success: function(response) {
            let responseObject = JSON.parse(response);
            console.log(responseObject);

            if (responseObject.status === 'OK' && responseObject.resultados.length > 0) {
                //Despliege de resultados
                $('#txt_nombre').val(responseObject.resultados[0].nombre);
                $('#txt_direccion').val(responseObject.resultados[0].direccion);
                $('#txt_telefono').val(responseObject.resultados[0].telefono);

                $('#txt_correo').val(responseObject.resultados[0].mail);
                $('#txt_correoCliente').val(responseObject.resultados[0].mail);

                $('#boton_edit').prop("disabled", false); // Element(s) are now enabled.
            } else {
                $('#txt_nombre').val('');
                $('#txt_direccion').val('');
                $('#txt_telefono').val('');
                $('#txt_nombre').prop("readonly", true); // Element(s) are now enabled.
                $('#txt_direccion').prop("readonly", true); // Element(s) are now enabled.
                $('#txt_telefono').prop("readonly", true); // Element(s) are now enabled.

                $('#txt_correo').val('');
                $('#txt_correoCliente').val('');

                $('#boton_edit').prop("disabled", true); // Element(s) are now enabled.
            }
        },
        error: function(XMLHttpRequest) {
            alert("Error #404: No se ha podido recuperar la informacion del servidor, tipo de error: " + XMLHttpRequest.statusText);
        }
    });
}

function sendEmail() {

    let correoCliente = $('#txt_correo').val();
    console.log('Enviando correo a: ' + correoCliente);
    if (correoCliente.length > 0) {
        $.ajax({
            type: 'post',
            url: 'PHPMailer/',
            data: { correoCliente: correoCliente },

            success: function(response) {
                let responseObject = JSON.parse(response);
                console.log(responseObject);

                if (responseObject.status === 'OK') {
                    swal({
                        title: 'Registro correcto',
                        text: 'Envio correcto',
                        type: 'success',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Acepta'
                    }).then(function() {
                        document.getElementById('formularioMain').reset();
                        location.reload();
                    });

                } else if (responseObject.status === 'fail') {
                    swal({
                        title: 'Error',
                        text: `No se ha podido enviar el correo, reintente. Si el problema persiste informe a sistemas.`,
                        type: 'error',
                        confirmButtonText: 'Aceptar',
                        showConfirmButton: true,
                    });

                }
            },
            error: function(XMLHttpRequest) {
                alert("Error #404: No se ha podido realizar la peticion al servidor, tipo de error: " + XMLHttpRequest.statusText);
                console.warn("Error #404: No se ha podido realizar la peticion al servidor, tipo de error: " + XMLHttpRequest.statusText);

            }
        });
    }


}


function updateDataCliente() {
    $.ajax({
        type: 'post',
        url: 'ajax/ajax_updateDataCliente.php',
        data: $("#formularioMain").serialize(),

        success: function(response) {

            console.log(response);
            let responseObject = JSON.parse(response);
            console.log(responseObject);

            if (responseObject.status === 'OK') {

            } else {

            }
        },
        error: function(XMLHttpRequest) {
            alert("Error #404: No se ha podido recuperar la informacion del servidor, tipo de error: " + XMLHttpRequest.statusText);
        }
    });
}