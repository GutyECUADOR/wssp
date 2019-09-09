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
                        solicitud.supervisor = cedula.trim();
                        app.loadmodal();
                    }else{
                        $('#txt_empleadoIdentificado').val(`Sin identificar`);
                        solicitud.supervisor = null;
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
        addItemsToSolicitud: function (){
            let list = document.getElementsByClassName("itemEV");
            for (let item of list) {
                if (item.value) {
                    let itemEV = new Item(item.id,item.value);
                    solicitud.items.push(itemEV);
                }
            }
        },
        loadmodal: function () {
            $("#modalSeguridad").modal();
             //Obtener valor seleccionado y mostrarlo en el modal
             var val_evalua = document.getElementById("txt_empleadoIdentificado").value;
             $("#myModalLabel_usuario").text(val_evalua);
                       
        },
        validacod_seguridad: function (cedula, codigo){
        
            $.ajax({
                url: 'API_ajax.php?action=validacod_seguridad',
                method: 'GET',
                data: {cedula, codigo},

                success : function(response) {
                    console.log(response);
                    const JSONresponse = JSON.parse(response);
                   
                    $("#txt_CIRUC").attr("readonly","readonly");

                    if (JSONresponse.data) {
                        $('#modalresponse').html('El codigo de validacion es correcto');
                        $('#modalSeguridad').modal('hide');
                        

                    }else{
                        $('#modalresponse').html('El codigo de validacion es incorrecto, reintente.');
                    }
                    
                    
                }
            });
        
        },
        valida_cargoEmpleado: function (cedula){
        
            $.ajax({
                url: 'API_ajax.php?action=valida_cargoEmpleado',
                method: 'GET',
                data: { cedula },

                success : function(response) {
                    console.log(response);
                    const JSONresponse = JSON.parse(response);
                    console.log(JSONresponse);

                    if (JSONresponse.data) {
                        $('#txt_cargo').val(JSONresponse.data.descripcionCargo);
                    }else{
                        $('#txt_cargo').val('Sin identificar');
                    }
                    
                    
                }
            });
        
        },
        getEmpleadosByDB: function (codigoDB) {
            $.ajax({
                url: 'API_ajax.php?action=getEmpleadosByDB',
                method: 'GET',
                data: { codigoDB },
        
                success: function (response) {
                    const JSONresponse = JSON.parse(response);
                    const empleados = JSONresponse.data;
                    document.querySelector('#select_Empleado').options.length = 0;
                    
                    let opt = document.createElement("option");
                    opt.value="";
                    opt.innerHTML = `Seleccione por favor`; 
                    document.querySelector('#select_Empleado').appendChild(opt);

                    empleados.forEach(function(empleado) {
                        let opt = document.createElement("option");
                        opt.value= empleado.Codigo.trim();
                        opt.innerHTML = `${empleado.Apellido} ${empleado.Nombre} `; 
                        document.querySelector('#select_Empleado').appendChild(opt);
                      });
                  
                
                   
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

    $("#txt_CIRUC").on("change", function() {
        let cedula = $(this).val();
        console.log(cedula);
        app.searchEmpleado(cedula);
    });

    $("#btn_validarpass").on("click", function() {
        let cedula = $('#txt_CIRUC').val(); // revisar a objeto
        let codigo = $('#cajacod').val(); 
        app.validacod_seguridad(cedula,codigo);
    });

    $("#select_Empleado").on("change", function() {
        let cedula = $(this).val();
        console.log(cedula);
        solicitud.empleado = cedula.trim();
        app.valida_cargoEmpleado(cedula);
    });

    $("#select_Empresa").on("change", function() {
        let codeDB = $(this).val();
        console.log(codeDB);
        solicitud.empresa = codeDB;
        app.getEmpleadosByDB(codeDB);
    });

    $("#metaPorcent").on("change", function() {
        let seleccion = $(this).val();
        console.log(seleccion);
        solicitud.porcentajeMeta = seleccion;
    });


    

    $("#txt_observacion").on("keyup", function() {
        let observacion = $(this).val();
        solicitud.observacion = observacion;
    });

    $("#btn_test").on("click", function() {
        console.log(solicitud);
        Swal.fire({
            title: 'Ups, no se pudo registrar!',
            text: `El registro no se realizo de forma correcta, reintente. Tiempo de espera agotado`,
            type: 'error',
            confirmButtonText: 'Aceptar'
        })
    });

    let registerForm = $('#registerForm');
    registerForm.on("submit", function(event) {
        event.preventDefault();
        app.addItemsToSolicitud();
        solicitud.calculaTotal();

        console.log(solicitud);
       
        let solicitudJSON = JSON.stringify(solicitud);

        $.ajax({
            url: 'API_ajax.php?action=saveSolicitud',
            method: 'POST',
            data: { solicitud: solicitudJSON },

            success: function(response) {
                console.log(response);
                const responseJSON = JSON.parse(response);
                registerForm.trigger("reset");
                $("#txt_CIRUC").attr("readonly",false);
                document.querySelector('#select_Empleado').options.length = 0;
                $('#cajacod').val('');
                solicitud = new Solicitud();
                $('html, body').animate({ scrollTop: 0 }, 'fast');

                if (responseJSON.insertCorrect) {
                    Swal.fire({
                        title: 'Registro correcto!',
                        text: `El codigo de su evlauacion es: ${responseJSON.newCod}`,
                        type: 'success',
                        confirmButtonText: 'Aceptar'
                    })
                }else{
                    Swal.fire({
                        title: 'Ups, no se pudo registrar!',
                        text: `El registro no se realizo de forma correcta, reintente. ${responseJSON.message}`,
                        type: 'error',
                        confirmButtonText: 'Aceptar'
                    })
                }
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
        this.supervisor = null,
        this.empleado = null,
        this.empresa = null,
        this.porcentajeMeta = null,
        this.items = [],
        this.sumatoria = null,
        this.observacion = null;
    }

    calculaTotal(){
        let total = this.items.reduce(function (total, currentValue) {
            return total + Number(currentValue.valor);
        }, 0);
        this.sumatoria = total
    }
}

class Item {
    constructor(codigo, valor) {
        this.codigo = codigo,
        this.valor = valor
    }
}