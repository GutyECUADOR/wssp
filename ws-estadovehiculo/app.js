// Evitar enter en formularios

$(document).ready(function() {
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
                    }else{
                        $('#txt_empleadoIdentificado').val(`Sin identificar`);
                    }
                   
                }, error: function (error) {
                    alert('No se pudo completar la operación, informe a sistemas. #' + error.status + ' ' + error.statusText);
                },complete: function() {
                }
        
            });
        },
        searchVehiculo: function (empresa, placa) { 
            $.ajax({
                url: 'API_ajax.php?action=searchVehiculo',
                method: 'GET',
                data: { empresa: empresa, placa: placa },
        
                success: function (response) {
                    console.log(response);
                    let JSONresponse = JSON.parse(response);
                    
                    if (JSONresponse.error == false && JSONresponse.data != false) {
                        $('#txt_empleadoIdentificado').val(`${JSONresponse.data.Apellido.trim()} ${JSONresponse.data.Nombre.trim()}`);
                    }else{
                        $('#txt_empleadoIdentificado').val(`Sin identificar`);
                    }
                   
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

    

    $("#txt_CIRUC").on( "keyup", function() {
        let cedula = $(this).val();
        console.log(cedula);
        app.searchEmpleado(cedula);
    });

    $("#btn_registrar").on( "click", function() {
        console.log('Funciona');
    });
});


                    
    function ajaxvalidacod_seguridad(){
    
        var cod_usu_ing =document.getElementById("cajacod").value;
        var ci_usu =document.getElementById("txt_CIRUC").value;
        
        $.ajax({
            type : 'post',
            url : 'valida_cod_seguridad.php', 

            data: {post_cod_usr: cod_usu_ing, ci_usu: ci_usu},

        success : function(r)
            {
                $('#mymodal').show();  // put your modal id 
                $('.resultmodal').show().html(r);
            
                        var verificacion_cod = document.getElementById("cod_veri").value;
                        if(verificacion_cod !== "")
                        {
                        document.getElementById("aceptar_modal1").removeAttribute('disabled');
                        $("#txt_CIRUC").attr("readonly","readonly");
                        //showselectChkListRealizados(); Funcion carga ultimo check del usuario ci ingresado
                        } 
            }
            });
    
    };   
     
        function ajaxvalidacod_json(){
                       var cod_usu_ing =document.getElementById("txt_CIRUC").value;
                       
                        $.ajax({
                           type : 'get',
                            url : 'valida_cod_json.php', 
                            dataType: "json",

                           data: {dato_ci: cod_usu_ing},

                        success : function(response)
                            {
                                
                                     if(response.length!==0){
                                        
                                        document.getElementById("txt_empleadoIdentificado").value = response[0]['Nombre'].trim() +" "+response[0]['Apellido'].trim();
                                       
                                    }else{
                                        document.getElementById("txt_empleadoIdentificado").value = "-- Sin Identificar -- ";
                                    
                                    }
                            }
                        });
        }
            
          

    