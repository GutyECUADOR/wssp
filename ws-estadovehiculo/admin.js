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
                            ${ row.placa }
                        </td>
                        <td>
                            ${ row.nombreVehiculo }
                        </td>
                        <td>
                            ${ row.nombreAsignadoA }
                        </td>
                        <td>
                            ${ row.fecha }
                        </td>
                        <td>
                            ${ row.kilometraje + 'km' }
                        </td>
                       
                        <td class="text-right">
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-cog">
                                </span></button>
                                <ul class="dropdown-menu pull-right">
                                <li><a class="btn-xs btn_edit_ticket" data-codigo="${ row.codigo }"><i class="fa fa-check"></i> Ver detalle</a></li>
                                    <li><a class="btn-xs btn_finalizar_ticket" data-codigo="${ row.codigo }"><i class="fa fa-thumbs-up"></i> Finalizar</a></li>
                                  
                                </ul>
                            </div>
                        </td>
                    </tr>


                   
                        `;
    
                $('#tbodyresults').append(rowHTML);
    
            });
    
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

   
});

