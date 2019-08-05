$(document).ready(function() {
    
    // Inicio de funciones
    app = {
        OnInit: function () {
            app.getAllVehiculos('');
        },
        getAllVehiculos: function (busqueda) { 
            $.ajax({
                url: 'API_ajax.php?action=getAllVehiculos',
                method: 'GET',
                data: { busqueda, busqueda },
        
                success: function (response) {
                    console.log(response);
                    let JSONresponse = JSON.parse(response);
                    console.log(JSONresponse.data);
                    app.showResults(JSONresponse.data);
                   
                }, error: function (error) {
                    alert('No se pudo completar la operación, informe a sistemas. #' + error.status + ' ' + error.statusText);
                },complete: function() {
                }
        
            });
        },
        getAllProveedores: function (busqueda, tipo) { 
            $.ajax({
                url: 'API_ajax.php?action=getProveedoresWinfenix',
                method: 'GET',
                data: { busqueda, tipo },
        
                success: function (response) {
                    console.log(response);
                    let JSONresponse = JSON.parse(response);
                    console.log(JSONresponse.data);
                    //app.showResults(JSONresponse.data);
                   
                }, error: function (error) {
                    alert('No se pudo completar la operación, informe a sistemas. #' + error.status + ' ' + error.statusText);
                },complete: function() {
                }
        
            });
        },
        aprobarOrden: function (codOrden) { 
            console.log(codOrden);
            $.ajax({
                url: 'API_ajax.php?action=aprobarOrden',
                method: 'GET',
                data: { codOrden, codOrden },
        
                success: function (response) {
                    console.log(response);
                    let JSONresponse = JSON.parse(response);
                    alert(JSONresponse.message + ' se aprobaron ' + JSONresponse.data + ' ordene(s)');
                    app.getAllVehiculos('');
                   
                }, error: function (error) {
                    alert('No se pudo completar la operación, informe a sistemas. #' + error.status + ' ' + error.statusText);
                },complete: function() {
                }
        
            });
        },
        canDoPago: function (codOrden) { 
            console.log(codOrden);
            $.ajax({
                url: 'API_ajax.php?action=canDoPago',
                method: 'GET',
                data: { codOrden, codOrden },
        
                success: function (response) {
                    console.log(response);
                    let JSONresponse = JSON.parse(response);
                    if (JSONresponse.isAvailable) {
                        window.location.replace('../ws-estadovehiculo/crearpago.php?codOrden='+codOrden);
                    }else{
                        alert('Negado, la orden ya posee movimientos');
                    }
                   
                   
                }, error: function (error) {
                    alert('No se pudo completar la operación, informe a sistemas. #' + error.status + ' ' + error.statusText);
                },complete: function() {
                }
        
            });
        },
        enviarorden: function (IDDocument) { 
            console.log(IDDocument);
            let email = prompt("Ingrese email del proveedor");

            if (email != null) {
                $.ajax({
                    url: 'API_ajax.php?action=sendOrden',
                    method: 'GET',
                    data: { email: email, IDDocument: IDDocument },
            
                    success: function (response) {
                        console.log(response);
                        let JSONresponse = JSON.parse(response);
                        alert(JSONresponse.data.mensaje);
                        
                    }, error: function (error) {
                        alert('No se pudo completar la operación, informe a sistemas. #' + error.status + ' ' + error.statusText);
                    },complete: function() {
                    }
            
                });
                
            }
        },
        showResults: function (arrayData) {
        
            $('#tbodyresults').html('');
           
            arrayData.forEach(row => {
                
                let rowHTML = `
                    <tr>
                        <td>
                            ${ row.codigo }
                        </td>
                        <td>
                            ${ row.placa }
                        </td>
                        <td>
                            ${ row.nombreVehiculo }
                        </td>
                        <td>
                            ${ row.nombreAsignadoA }
                        </td>
                        <td>
                            ${ app.getTipoDocumentoIs(row.codigo.substr(0, 3)) }
                        </td>
                        <td>
                            ${ row.fecha }
                        </td>
                        <td>
                            ${ row.kilometraje + 'km' }
                        </td>
                        <td>
                            ${ row.estado == 1 ? 'Aprobado' : 'Sin revision' }
                        </td>

                       
                        <td class="text-right">
                            ${ app.showMenus(row.codigo.substr(0, 3), row.codigo) }
                        </td>
                    </tr>


                   
                        `;
    
                $('#tbodyresults').append(rowHTML);
    
            });
    
        },
        getTipoDocumentoIs: function (codigo) {
            switch (codigo) {
                case 'EST':
                    return 'Informe de Estado';
                    break;
                
                case 'ODP':
                    return '<span class="text-danger">Orden de Pedido</span>';
                break;
            
                default:
                    return 'No definido';
                    break;
            }
        },
        showMenus: function (codigo, ID) {
            switch (codigo) {
                case 'EST':
                    return `
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-cog">
                            </span></button>
                            <ul class="dropdown-menu pull-right">
                                <li><a class="btn-xs btn_showinforme" data-codigo="${ ID }"><i class="fa fa-check"></i> Ver detalle</a></li>
                            </ul>
                        </div>
                        `;
                    break;
                
                case 'ODP':
                    return `
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-cog">
                            </span></button>
                            <ul class="dropdown-menu pull-right">
                                <li><a class="btn-xs btn_showinforme" data-codigo="${ ID }"><i class="fa fa-check"></i> Ver detalle</a></li>
                                <li><a class="btn-xs btn_aprobarOrden" data-codigo="${ ID }"><i class="fa fa-thumbs-up"></i> Aprobar Orden</a></li>
                                <li><a class="btn-xs btn_sendOrden" data-codigo="${ ID }"><i class="fa fa-thumbs-up"></i> Enviar Orden</a></li>
                                <li><a class="btn-xs btn_crearPagoWinFenix" data-codigo="${ ID }"><i class="fa fa-thumbs-up"></i> Crear Pago</a></li>
                            </ul>
                        </div>
                        `;
                break;
            
                default:
                    return 'No definido';
                    break;
            }
        }
    } 
    // Inicio acciones
    app.OnInit();

    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });

    $("#btn_busqueda").on("click", function() {
        let busqueda = $('#txt_busqueda').val();
        console.log(busqueda);
        app.getAllVehiculos(busqueda);
    });

    // Boton de creacion de PDF en busqueda de documentos
    $("#tbodyresults").on("click", '.btn_showinforme', function(event) {
        let IDDocument = $(this).data("codigo");

        window.open('./API_documentos.php?action=generaReporte&IDDocument='+IDDocument);
       
    });

    // Boton de de aprobacion de orden
    $("#tbodyresults").on("click", '.btn_aprobarOrden', function(event) {
        let IDDocument = $(this).data("codigo");
        app.aprobarOrden(IDDocument);
    });

    // Boton de de envio de orden PDF por email
    $("#tbodyresults").on("click", '.btn_sendOrden', function(event) {
        let IDDocument = $(this).data("codigo");
        app.enviarorden(IDDocument);
    });

    // Boton de de envio de orden PDF por email
    $("#tbodyresults").on("click", '.btn_crearPagoWinFenix', function(event) {
        let IDDocument = $(this).data("codigo");
        app.canDoPago(IDDocument);
    });

    // Boton de de envio de orden PDF por email
    $("#searchClienteModal").on("click", function(event) {
        let termino = $('#terminoBusquedaModalCliente').val();
        let tipo = $('#tipoBusquedaModalCliente').val();
        app.getAllProveedores(termino,tipo);
    });

    

   
});

