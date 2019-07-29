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
                                <li><a class="btn-xs btn_aprobarOrden" data-codigo="${ ID }"><i class="fa fa-thumbs-up"></i> Enviar Orden</a></li>
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


   
});

