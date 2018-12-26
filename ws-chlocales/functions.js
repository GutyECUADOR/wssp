// Evitar enter en formularios

$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
    
    $('[data-toggle="tooltip"]').tooltip(); 
});




//
        function validacheck(id_checkbox){
            alert("ID"+id_checkbox);
            if( $("#"+id_checkbox.id).prop('checked') ) {
               document.getElementById("obs_SupervChk"+id_checkbox.id).value = "";
               $("#obs_SupervChk"+id_checkbox.id).attr("readonly","readonly");
            }else{
               $("#obs_SupervChk"+id_checkbox.id).removeAttr("readonly");
            }
        }
        
        function validaObsChecks(){
           if($("#chk1").prop('checked')==false && (document.getElementById("obs_Encargadochk1").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 1</span></b>, los campos no marcados requieren observación obligatoria ',  
                            type: 'warning',  
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                return false;
               
           }else if($("#chk2").prop('checked')==false && (document.getElementById("obs_Encargadochk2").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 2</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                    
                return false;    
               
           }else if($("#chk3").prop('checked')==false && (document.getElementById("obs_Encargadochk3").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 3</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',  
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;
                
            }else if($("#chk4").prop('checked')==false && (document.getElementById("obs_Encargadochk4").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 4</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',    
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;    
                
            }else if($("#chk5").prop('checked')==false && (document.getElementById("obs_Encargadochk5").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 5</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',   
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;      
                
            }else if($("#chk6").prop('checked')==false && (document.getElementById("obs_Encargadochk6").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 6</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;          
            
            }else if($("#chk7").prop('checked')==false && (document.getElementById("obs_Encargadochk7").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 7</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',   
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;          
            
            }else if($("#chk8").prop('checked')==false && (document.getElementById("obs_Encargadochk8").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 8</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',   
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;          
            
            }else if($("#chk9").prop('checked')==false && (document.getElementById("obs_Encargadochk9").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 9</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',    
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;      
            
            }else if($("#chk10").prop('checked')==false && (document.getElementById("obs_Encargadochk10").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 10</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',    
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;          
            
            }else if($("#chk11").prop('checked')==false && (document.getElementById("obs_Encargadochk11").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 11</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',    
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false; 
                
            }else if($("#chk12").prop('checked')==false && (document.getElementById("obs_Encargadochk12").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 12</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',    
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;     
                
            }else if($("#chk13").prop('checked')==false && (document.getElementById("obs_Encargadochk13").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 13</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',   
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;         
                
            }else if($("#chk14").prop('checked')==false && (document.getElementById("obs_Encargadochk14").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 14</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning', 
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;      
              
            }else if($("#chk15").prop('checked')==false && (document.getElementById("obs_Encargadochk15").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 15</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',    
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;      
            
            }else if($("#chk16").prop('checked')==false && (document.getElementById("obs_Encargadochk16").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 16</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',    
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;      
            
            }else if($("#chk17").prop('checked')==false && (document.getElementById("obs_Encargadochk17").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 17</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',    
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;      
             
            }else if($("#chk18").prop('checked')==false && (document.getElementById("obs_Encargadochk18").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 18</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',    
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;      
            
            }else if($("#chk19").prop('checked')==false && (document.getElementById("obs_Encargadochk19").value=="")){
               swal({  title: 'Campo sin Observación',
                            text: 'No se ha especificado una observación en <b><span style="color:#E72E2E">sección 19</span></b>, los campos no marcados requieren observación obligatoria',  
                            type: 'warning',    
                            html: true,
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                
                return false;      
                
           }else{
               return true;
           }
                
                
                
            
            
        }
        
        
        // Funcion de carga de modal window
        function loadmodal() {
                
                           $("#modalcodigo").modal();
                            //Obtener valor seleccionado y mostrarlo en el modal
                            var val_evalua = document.getElementById("seleccion_supervisor_txtchk").value;
                            $("#myModalLabel_usuario").text(val_evalua);
                          
                        
            }
        
        
        // Funcion de valdacion de codigo de seguridad
                    
                    function ajaxvalidacod_seguridad(){
                   
                       var cod_usu_ing =document.getElementById("cajacod").value;
                       var ci_usu =document.getElementById("txt_cisolicitante").value;
                       
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
                                        $("#txt_cisolicitante").attr("readonly","readonly");
                                        //showselectChkListRealizados(); Funcion carga ultimo check del usuario ci ingresado
                                      } 
                            }
                            });
                   
                    };   
     
        function ajaxvalidacod_json(){
                       var cod_usu_ing =document.getElementById("txt_cisolicitante").value;
                       
                        $.ajax({
                           type : 'get',
                            url : 'valida_cod_json.php', 
                            dataType: "json",

                           data: {dato_ci: cod_usu_ing},

                        success : function(response)
                            {
                                
                                     if(response.length!==0){
                                        
                                        document.getElementById("seleccion_supervisor_txtchk").value = response[0]['Nombre']+response[0]['Apellido'];
                                       
                                    }else{
                                        document.getElementById("seleccion_supervisor_txtchk").value = "-- Sin Identificar -- ";
                                    
                                    }
                            }
                        });
        }
            
          
              
       
     
        
        
        function alert_sweet(){
            
            swal({  title: 'Test',
                            text: 'Message:  ' + a,  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true} 
                            );
            
        }
       
        //Edicion de check list
       function fn_editChListDiario(this_elemento){
            var data_id = this_elemento.id;
            var dataDB_id = document.getElementById("db"+data_id).value;
            alert("Editando check list con ID: CHLOCAL-" + data_id);
            window.open('edicionDiaria.php?id_chlocal='+data_id+'&id_db='+dataDB_id);
            
        };
        
       function searchChklistDia(){
              //var cedula = document.getElementById("txt_CIRUC").value;
              var empresa = document.getElementById("select_empresaModal").value;
              var bodega = document.getElementById("select_bodegaModal").value;
             
            
               $.ajax({
                  url : 'search_chlocalesDiarios.php', 
                  method : 'POST',
                  data: {empresa:empresa, bodega: bodega}, 
                            
               success: function (result) {
                   $('.resultmodal_chlocales').show().html(result);
                   }
               });
        };
       
                    
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
                    
        function showSelectBodegasByElement(cod_empresa,id_select){
                        $.ajax({
                           type : 'get',
                            url : 'ajax_select_bodegas.php', 

                           data: {cod_WF: cod_empresa},
                          
                        success : function(respuesta)
                            {
                              document.getElementById(id_select).innerHTML=respuesta;
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