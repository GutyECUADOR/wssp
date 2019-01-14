$(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();

    // Listeners

    $('#select_tipoUser').change(function(e) {
        getXMLDataModules();
    });

    $('.resultModulos').on('change', '.checkmodulo', function(e) {
        let tipoUser = $("#select_tipoUser option:selected").val();
        let nombreNodo = e.target.id;
        let valor = $(this).prop('checked');

        ajax_actualizaNodoXMLPermiso(tipoUser, nombreNodo, valor);
        alert('Actualizado' + tipoUser + nombreNodo, valor);
    });

    $('.btn_actualizar').click(function(e) {
        e.preventDefault();
        let id_boton = e.target.id; // Nombre del campo
        let nombreInput = id_boton + "_input"; // Permite identidicar de que input se tomara el valor
        let nodoName = id_boton;
        let valorNodo = $('#' + nombreInput).val();

        console.log(nodoName, valorNodo);
        ajax_actualizaNodoXML(nodoName, valorNodo);
        alert('Actualizado.');
        location.reload();
    });




    function ajax_actualizaNodoXML(nodo, valor) {

        $.ajax({
            type: 'get',
            url: 'ajax/ajax_actualizaXML.php',

            data: { nodo: nodo, valor: valor },

            success: function(response) {

                console.log(response);
                let APIResp = JSON.parse(response);
                let mensajeResp = APIResp[0].mensaje;

                //Validamos respuesta TRUE desde API
                if (APIResp[0].estatus === true) {

                    console.log(mensajeResp);

                } else {
                    console.warn(mensajeResp);

                }
            }
        });

    };


    function ajax_actualizaNodoXMLPermiso(tipoUser, nodo, valor) {

        if (valor === false) {
            valor = '';
        }
        $.ajax({
            type: 'get',
            url: 'ajax/ajax_actualizaXMLPermiso.php',

            data: { tipoUser: tipoUser, nodo: nodo, valor: valor },

            success: function(response) {

                console.log(response);
                let APIResp = JSON.parse(response);
                let mensajeResp = APIResp[0].mensaje;

                //Validamos respuesta TRUE desde API
                if (APIResp[0].estatus === true) {

                    console.log(mensajeResp);

                } else {
                    console.warn(mensajeResp);

                }
            }
        });

    };


    function getXMLDataModules() {
        let tipoUser = $("#select_tipoUser option:selected").val();
        if (tipoUser != '') {
            $.ajax({
                type: 'get',
                url: 'ajax/ajax_getModulesByUser.php',

                data: { tipoUser: tipoUser },

                success: function(response) {

                    $('.resultModulos').html(response);
                }
            });
        } else {
            alert('Seleccione tipo de usuario');
            $('.resultModulos').html('');
        }



    };



});