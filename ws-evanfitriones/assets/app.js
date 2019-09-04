// Evitar enter en formularios

$(document).ready(function() {
    // Creacion de objeto a enviar a API

    var solicitud = new Solicitud();

    // Inicio de funciones
    app = {
        searchEmpleado: function (cedula) { 
            $.ajax({
                url: 'API_ajax.php?action=getEmpleadoByID',
                method: 'GET',
                data: { cedula, cedula },
        
                success: function (response) {
                    console.log(response);
                    let JSONresponse = JSON.parse(response);
                    
                    if (JSONresponse.error == false && JSONresponse.data != false) {
                        $('#txt_empleadoIdentificado').val(`${JSONresponse.data.Apellido.trim()} ${JSONresponse.data.Nombre.trim()}`);
                        solicitud.empleado = cedula.trim();
                        app.loadmodal();
                    }else{
                        $('#txt_empleadoIdentificado').val(`Sin identificar`);
                        solicitud.empleado = null;
                    }
                   
                }, error: function (error) {
                    alert('No se pudo completar la operación, informe a sistemas. #' + error.status + ' ' + error.statusText);
                },complete: function() {
                }
        
            });
        },
        searchVehiculo: function (placa, empresa) {
            if (empresa) {
                $.ajax({
                    url: 'API_ajax.php?action=getVehiculoByPlaca',
                    method: 'GET',
                    data: { placa: placa, empresa: empresa },
            
                    success: function (response) {
                        console.log(response);
                        let JSONresponse = JSON.parse(response);
                        
                        if (JSONresponse.error == false && JSONresponse.data != false) {
                            $('#txt_vehiculoIdentificado').val(`${JSONresponse.data.Nombre.trim()}`);
                            solicitud.vehiculo = placa.trim();
                            solicitud.empresa = empresa.trim();
                        }else{
                            $('#txt_vehiculoIdentificado').val(`Sin identificar`);
                            solicitud.vehiculo = null;
                            solicitud.empresa = null;
                        }
                       
                    }, error: function (error) {
                        alert('No se pudo completar la operación, informe a sistemas. #' + error.status + ' ' + error.statusText);
                    },complete: function() {
                    }
            
                });
            }else{
                alert('No se han ingresado todos los parametros, seleccione empresa');
            }
            
            
        },
        addItems: function (){
            let list = document.getElementsByClassName("itemVehiculo");
            for (let item of list) {
                if (item.value) {
                    let ItemVehiculo = new Item(item.id,item.value);
                    solicitud.items.push(ItemVehiculo);
                }
            }
        },
        loadmodal: function () {
            $("#modalcodigo").modal();
             //Obtener valor seleccionado y mostrarlo en el modal
             var val_evalua = document.getElementById("txt_empleadoIdentificado").value;
             $("#myModalLabel_usuario").text(val_evalua);
                       
        },
        validacod_seguridad: function (cedula, codigoseguridad){
        
            $.ajax({
                url: 'API_ajax.php?action=getEmpleadoByID',
                method: 'GET',
                data: {cedula, codigoseguridad},

                success : function(response) {
                    document.getElementById("aceptar_modal1").removeAttribute('disabled');
                    $("#txt_CIRUC").attr("readonly","readonly");
                           
                }
            });
        
        },
        getEmpleadosByDB: function (codeDB) {
            $.ajax({
                url: 'API_ajax.php?action=getEmpleadosByDB',
                method: 'GET',
                data: { codeDB },
        
                success: function (response) {
                    console.log(response);
                   
                }, error: function (error) {
                    alert('No se pudo completar la operación, informe a sistemas. #' + error.status + ' ' + error.statusText);
                },complete: function() {
                }
        
            });
        }
        
    
    } 
    // Inicio acciones

    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });

    $("#txt_CIRUC").on("keyup", function() {
        let cedula = $(this).val();
        console.log(cedula);
        app.searchEmpleado(cedula);
    });

    $("#select_Empresa").on("change", function() {
        let codeDB = $(this).val();
        console.log(codeDB);
        app.getEmpleadosByDB(codeDB);
    });

    $("#txt_placas").on("keyup", function() {
        let cedula = $(this).val();
        let empresa = $('#select_empresa').val();
        console.log(cedula, empresa);
        app.searchVehiculo(cedula, empresa);
    });

    $("#txt_kilometraje").on("keyup", function() {
        let kilometraje = $(this).val();
        solicitud.kilometraje = kilometraje;
    });

    $("#txt_observacion").on("keyup", function() {
        let observacion = $(this).val();
        solicitud.observacion = observacion;
    });


    let registerForm = $('#registerForm');
    registerForm.on("submit", function(event) {
        event.preventDefault();
        app.addItems();

        console.log(solicitud);
       
        let solicitudJSON = JSON.stringify(solicitud);

        $.ajax({
            url: 'API_ajax.php?action=saveSolicitud',
            method: 'POST',
            data: { solicitud: solicitudJSON },

            success: function(response) {
                console.log(response);
                toastr.success('Registro exitoso', 'Realizado', {timeOut: 5000, progressBar: true, positionClass: "toast-top-right"});
                registerForm.trigger("reset");
                $('html, body').animate({ scrollTop: 0 }, 'fast');
            },
            error: function(error) {
                alert('No se pudo completar la operación. #' + error.status + ' ' + error.statusText, '. Intentelo mas tarde.');
            }

        });
    });
});


class Solicitud {
    constructor() {
        this.fecha = new Date(),
        this.empleado = null,
        this.vehiculo = null,
        this.empresa = null,
        this.kilometraje = null,
        this.items = []
        this.observacion = null;
    }
}

class Item {
    constructor(codigo, valor) {
        this.codigo = codigo,
        this.valor = valor
    }
}