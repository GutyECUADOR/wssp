// Evitar enter en formularios

$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});

// Variables Globales
    var totalEvaluacion = 0;
    
        // Function suma todos los inputs que tengan la clase factor
        function calcularTotalFactor() {
	var total = 0
	$(".factor").each(
		function(index, value) {
			total = total + eval($(this).val());
		}
	);
        return total; 
        }


        function calcularTotalbyClass(claseName) {
	var total = 0
	$("."+claseName).each(
		function(index, value) {
			total = total + eval($(this).val());
		}
	);
        return total; 
        }
      
        //Calcula la suma de valores de los elementos que contengan X clase y la pone en el elemento HTML indicado
        function setValoresTotales(idHTMLElement,className){
            document.getElementById(""+idHTMLElement).innerHTML = calcularTotalbyClass(''+className);
        }
        
        // Function que valida el total maximo del factor
        function validarFactor(){
            if (calcularTotalFactor() <= 105){
                return true;
                }else{
                swal({  title: 'Error',
                            text: 'Factor por encima del 105%, factor actual de solicitud: ' +calcularTotalFactor() + ' %',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true} 
                            );
                return false;
            }
        }
      
        // Funcion de carga de modal window
        function loadmodal() {
               $("#modalcodigo").modal();
                //Obtener valor seleccionado y mostrarlo en el modal
                var val_evalua = document.getElementById("txt_empleadoIdentificado").value;
                $("#myModalLabel_usuario").text(val_evalua);
                          
            }
        
        
        // Funcion de valdacion de codigo de seguridad
                    
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
            
          
            
 
        function alert_sweet(){
            
            swal({  title: 'Test',
                            text: 'Message:  ' ,  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true} 
                            );
            
        }
       
        
                    
        function showselectJefes(str){
                         var val_evalua = document.getElementById("select_empresaa").value; //Obtenemos el value del select
                         
                        $.ajax({
                           type : 'get',
                            url : 'ajax_select_jefes.php', 

                           data: {cod_WF: str},
                          
                        success : function(r)
                            {
                              document.getElementById("seleccion_supervisor").innerHTML=r;
                            }
                            });
                    }
                    
                    
        function showselectEmpleados(str){
                        $.ajax({
                           type : 'get',
                            url : 'ajax_select_empleado.php', 

                           data: {cod_WF: str, excluyente:"" },
                          
                        success : function(r)
                            {
                              document.getElementById("ajax_result").innerHTML=r;
                              document.getElementById("txt_cargo").value="";
                            }
                            });
                    }            
                    
        function showselectBodegas(str){
                         var val_evalua = document.getElementById("select_empresaa").value; //Obtenemos el value del select
                         
                        $.ajax({
                           type : 'get',
                            url : 'ajax_select_bodegas.php', 

                           data: {cod_WF: str},
                          
                        success : function(r)
                            {
                              document.getElementById("cod_txt_empresa").innerHTML=r;
                            }
                            });
                    
                    }        
                    
        function showselectChkListRealizados(){
                        var supervisor = document.getElementById("txt_cisolicitante").value; //Obtenemos el value del select
                         
                        $.ajax({
                           type : 'get',
                            url : 'ajax_select_ChListRealizados.php', 

                           data: {cod_WF: supervisor},
                          
                        success : function(r)
                            {
                              document.getElementById("seleccion_chlentrada").innerHTML=r;
                            }
                            });
                    
                    }
                    
                    
        function valida_cargo(){
                         var cod_empleado = document.getElementById("select_Empleado").value;
                         
                           $.ajax({
                                type : 'get',
                                 url : 'valida_cargo_json.php', 
                                 dataType: "json",

                                data: {cod_user: cod_empleado},

                             success : function(response)
                                 {
                                   if(response.length!==0){
                                        document.getElementById("txt_cargo").value = response[0]['Cargo'];
                                    }else{
                                        document.getElementById("txt_cargo").value = "-No especificado-";
                                    }
                                 }
                                 });
                    }
                                


        function validar_formulario() {
                if((document.getElementById("seleccion_supervisor_txtchk").value == "-- Sin Identificar -- "))
                {
                    swal({  title: 'Solicitante inválido',
                            text: 'La CI del solicitante no es correcta o no esta registrada en la base de datos',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                      return false;                               
                }else if(validaObsChecks()==false){
                    return false;
                }else if(validaObsChecks()==true){
                    return true;
                }
        }
        
        
        function search(){
            $('#btn_busqueda_chlocales').click(function(){
              var empresa_search = document.getElementById("seleccion_empresa").value;
              var post_dateini = document.getElementById("dateini_modal").value;
              var post_datefin = document.getElementById("datefin_modal").value;
               $.ajax({
                  url : 'search.php', 
                  method : 'POST',
                  data: {empresa_search: empresa_search, post_dateini: post_dateini , post_datefin: post_datefin}, 
                            
               success: function (result) {
                   $('.result_search').html(result);
                   }
               });
           });
        };
            
        function showselectLocales(str){
                         var val_evalua = document.getElementById("seleccion_empresa").value; //Obtenemos el value del select
                         
                        $.ajax({
                           type : 'get',
                            url : 'ajax_select_locales.php', 

                           data: {cod_WF: str, cod_db:val_evalua},
                          
                        success : function(r)
                            {
                              document.getElementById("seleccion_local").innerHTML=r;
                            }
                            });
        }    
        
        function showselectLocalesNoModal(){
                         var val_evalua = document.getElementById("seleccion_empresa_chlocales").value; //Obtenemos el value del select
                         
                        $.ajax({
                           type : 'get',
                            url : 'ajax_locales_search.php', 

                           data: {cod_WF:val_evalua},
                          
                        success : function(r)
                            {
                              document.getElementById("seleccion_local_chlocales").innerHTML=r;
                            }
                            });
        }    
            
            
        // Funcion de Menùs
        $('.nav-list').on('click', 'li', function() {
        $('.nav-list li.active').removeClass('active');
        $(this).addClass('active');
        });
        
        
        //Generacion de reportes segun row clickeado
       function fn_genreport(){
            var empresa_search = document.getElementById("seleccion_empresa").value;
            var dateini = document.getElementById("dateini_modal").value;
            var datefin = document.getElementById("datefin_modal").value;
            if (empresa_search!="" && dateini!="" & datefin!="" ){
                alert("Generando reporte.");
                window.open('reportes/reporteMensual.php?empresa_search='+empresa_search+'&dateini='+dateini+'&datefin='+datefin);
            }else{
                alert("No se han completado los datos, indique fecha y empresa");
            }
           
        };
        
        function fn_genreport_Excel(){
            var empresa_search = document.getElementById("seleccion_empresa").value;
            var dateini = document.getElementById("dateini_modal").value;
            var datefin = document.getElementById("datefin_modal").value;
            if (empresa_search!="" && dateini!="" & datefin!="" ){
                alert("Generando reporte Excel.");
                window.open('reportes/reporte_excel.php?empresa_search='+empresa_search+'&dateini='+dateini+'&datefin='+datefin);
            }else{
                alert("No se han completado los datos, indique fecha y empresa");
            }
           
        };
        
      //Edicion de check list
       function fn_reporteIndividual(this_elemento){
            var data_id = this_elemento.id;
            alert("Generando reporte con ID: " + data_id);
            window.open('reportes/reporteIndividual.php?dataid='+data_id);
            
        };