// Evitar enter en formularios

$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
    
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
      });


    $("#formularioMain").on('submit', function(event) {
        event.preventDefault();

        let txt_CIRUC = $("#txt_CIRUC").val();
        let select_empresaa = $("#select_empresaa").val();
        let seleccion_empleado = $("#seleccion_empleado").val();

        console.log(txt_CIRUC + select_empresaa + seleccion_empleado );

        if(txt_CIRUC != '' && select_empresaa != '' && seleccion_empleado != ''){
            $.ajax({
                url : 'ajax/ajax_isRegistroDuplicado.php', 
                method : 'GET',
                data: {txt_CIRUC: txt_CIRUC, select_empresaa:select_empresaa, seleccion_empleado:seleccion_empleado}, 
                            
                success: function (result) {
            
                let API = JSON.parse(result);
               
                    if (API[0].status === 'TRUE'){
                        console.log(API[0].mensaje);
                        $("#formularioMain").unbind().submit();
                    }else if (API[0].status === 'FAIL'){
                        alert(API[0].mensaje);
                    } else{
                        alert("No se puedo realizar la peticion, informe a sistemas.");
                    }
                }
            }); // Fin de ajax;
        }

        
    });
});

     // Eventos Listener de los elementos
      
        document.getElementById('txt_CIRUC').addEventListener('keyup', ajaxvalidacod_json ,false);
        document.getElementById('txt_CIRUC').addEventListener('change', loadmodal ,false);
        document.getElementById('select_empresaa').addEventListener('change', showselectEmpleados ,false);
       
        document.getElementById('formularioMain').addEventListener('submit', function(event){
          
            if (validaFormMain()) {
                //Eliminar los preventDefault para envio de forumulario (MODO PRUEBAS)
               
                console.log('Validacion correcta');
            }else{
                event.preventDefault() ;
                event.stopPropagation();
                console.log('Validacion fallida');
            }

        })

        //Validacion manual de los campos requeridos
        function validaFormMain(){
            if (!$('#txt_CIRUC').val()){
                    showMensajeError('Cedula o RUC');
                return false;
            }
            else if($('#select_empresaa').val()==""){
                    showMensajeError('Seleccion de empresa');
                    return false;
            } 
            else if($('#seleccion_empleado').val()==""){
                showMensajeError('Seleccion de empleado');
                return false;
            } 
            else if(existeVacio('txt_nummeta_esencial[]')){ //TRUE si existe error
                showMensajeError('Meta de Pestaña Actividades Esenciales');
                activaTab('tab1'); //Activamos pestaña correspondiente
                return false;
            }
            else if(existeVacio('txt_numcumplidos_esencial[]')){ //TRUE si existe error
                showMensajeError('Cumplidos de Pestaña Actividades Esenciales');
                activaTab('tab1'); //Activamos pestaña correspondiente
                return false;
            }
            else if(isSelectVacio('seleccion_valConocimiento[]')){ //TRUE si existe error
                showMensajeError('Seleccion Valor de Conocimientos de Pestaña Conocimientos');
                activaTab('tab2'); //Activamos pestaña correspondiente
                return false;
            }
            else if(isSelectVacio('seleccion_valcompetenciaTecnica[]')){ //TRUE si existe error
                showMensajeError('Nivel que desarrolla de Pestaña Comp. Tecnicas');
                activaTab('tab3'); //Activamos pestaña correspondiente
                return false;
            }
            else if(isSelectVacio('seleccion_valcompetenciaUniversal[]')){ //TRUE si existe error
                showMensajeError('Frecuencia de Aplicación de Pestaña Comp. Universales');
                activaTab('tab4'); //Activamos pestaña correspondiente
                return false;
            }

            
            else{
                return true; //Indica que ha pasado todos los filtros de validacion.
            }
            
        }

        //Funcion retorna validacion si existe elemento de grupo de name en vacio.
        function existeVacio(nombreGrupoElementosHTML){
            let txt_nummeta_esencial = document.getElementsByName(nombreGrupoElementosHTML);
            let validacion = false;    
            txt_nummeta_esencial.forEach(function(elementSimple) {
                   if (elementSimple.value === ''){
                        validacion = true;
                        //true si existen campos vacios
                   }else{
                       //false si pasa la validacion, no existen campos vacios
                       validacion = false;
                   }
                });
            return validacion;
        }

        function activaTab(tab){
            $('.nav-tabs a[href="#' + tab + '"]').tab('show');
        };
        

        //Funcion retorna validacion si existe elemento de grupo de name en vacio.
        function isSelectVacio(nombreGrupoElementosHTML){
            let txt_nummeta_esencial = document.getElementsByName(nombreGrupoElementosHTML);
            let validacion = false;    
            txt_nummeta_esencial.forEach(function(elementSimple) {
                   if (elementSimple.value === '' || elementSimple.value==='0'){
                        validacion = true;
                        //true si existen campos vacios
                   }else{
                       //false si pasa la validacion, no existen campos vacios
                       validacion = false;
                   }
                });
            return validacion;
        }

        function showMensajeError(campoError){
            swal({
                title: 'Campo Obligatorio',
                text: `El campo "${campoError}" se encuentra vacio o no tiene un valor válido`,  
                type: 'warning',
                confirmButtonText: 'Aceptar', 
                showConfirmButton: true,
              });
        }

        //Indicar aqui todas las funciones de calculo de totales de seccion
        
        $('.factor').keyup(function (event) {
            validarFactor();
            
            validaCumplido();
            
            totalActiEsenciales();
        });
        
        $('#seleccion_4porcentextra').change(function (event) {
            validaCumplido();
            totalActiEsenciales();
            calculaTotalGeneral();
        });
        
        $('#txt_factorConocimientos').keyup(function (event) {
            totalConocimientos();
            calculaTotalGeneral();
        });
        
        $('#txt_factorComTecnicas').keyup(function (event) {
            totalCompetenciasTecnicas();
            calculaTotalGeneral();
        });
        
        $('#txt_factorUniversales').keyup(function (event) {
            totalCompetenciasUniversales();
            calculaTotalGeneral();
        });
        
        $('#txt_factorTIL').keyup(function (event) {
            totalTIL();
            calculaTotalGeneral();
        });
        
        
        // Bottones que añaden filas extras
         $('#btn_add_row_esencial').click(function (event) {
            add_row_esencial();
        });
        
         $('#btn_add_row_conocimiento').click(function (event) {
            add_row_conocimiento();
        });
        
         $('#btn_add_row_comtecnica').click(function (event) {
            add_row_comtecnicas();
        });
        
        $('#btn_add_row_comuniversal').click(function (event) {
            add_row_universal();
        });
        
        $('#btn_add_row_queja').click(function (event) {
            add_row_queja();
        });
        
        
        $('#seleccion_tieneLiderazgo').change(function (event) {
            
            totalTIL();
            calculaTotalGeneral();
        });
        
       
       
       
        //EVENTOS DE CALCULOS DE LAS SECCIONES
        
        $(".ajax_result_cliente").on('change','select.seleccion_empleado', function() {
           valida_cargo();
        });
        
        
        $(".row_esencial,.result_add_asencial").on('keyup','input.txt_nummeta_esencial, input.txt_numcumplidos_esencial', function() {
            validaCumplido();
            totalActiEsenciales();
            calculaTotalGeneral();
        });
        
        
        $(".row_conocimiento ,.result_add_conocimiento").on('change','select.txt_conocimiento, select.seleccion_valConocimiento', function() {
            totalConocimientos();
            calculaTotalGeneral();
        });
        
        $(".row_ComTecnicas ,.result_add_ComTecnicas").on('change','select.seleccion_valcompetenciaTecnica', function() {
            totalCompetenciasTecnicas();
            calculaTotalGeneral();
        });
        
         $(".row_Universales ,.result_add_ComUniversales").on('change','select.seleccion_valcompetenciaUniversal', function() {
            totalCompetenciasUniversales();
            calculaTotalGeneral();
        });
        
        
        
        $(".row_TIL").on('change','select.seleccion_valTIL', function() {
            totalTIL();
            calculaTotalGeneral();
        });
        
        $(".row_relClienteInterno, .result_add_ClienteInterno").on('change','select.seleccion_valrelClienteInterno', function() {
            totalRelClienteInterno();
            calculaTotalGeneral();
        });
        
        $(".row_relClienteInterno, .result_add_ClienteInterno").on('keyup','input.txt_reduccionPtsClienteInterno', function() {
            totalRelClienteInterno();
            calculaTotalGeneral();
        });
        
        $(".result_add_ClienteInterno").on('focus','input.pickyDate', function() {
            $('.pickyDate').datepicker({
                    format: "yyyy-mm-dd",
                    language: "es",
                    clearBtn: true,
                    orientation: "bottom right",
                    autoclose: true,
                    todayHighlight: true
                    
                
                });
        });
        
        
        
        //Competencias tecnicas
        $(".row_ComTecnicas ,.result_add_ComTecnicas").on('change','select.seleccion_relevanciacompetenciaTecnica', function() {
            
            var clickedelement  = $(this);
            var grupo_selectcomtecnicas = $(".seleccion_relevanciacompetenciaTecnica");
            var indice_tecnicas = grupo_selectcomtecnicas.index(clickedelement);
                
            var valorSelectTecnicas = $(".seleccion_competenciaTecnica option:selected")[indice_tecnicas].value;
            var valorSelectRelevancia = $(".seleccion_relevanciacompetenciaTecnica option:selected")[indice_tecnicas].value;
            
            $.ajax({
               type : 'get',
                url : 'ajax_getInfoTenicas.php', 
               data: {codTenica: valorSelectTecnicas, nivel: valorSelectRelevancia},

                success : function(response)
                {
                  document.getElementsByName("txt_observacionComTecnicas[]")[indice_tecnicas].value = response;
                }
                });
            
        });
        
       //Competencias Universales
       
       $(".row_Universales ,.result_add_ComUniversales").on('change','select.seleccion_relevanciacompetenciaUniversal', function() {
            
            var clickedelement  = $(this);
            var grupo_selectcomtecnicas = $(".seleccion_relevanciacompetenciaUniversal");
            var indice_universal = grupo_selectcomtecnicas.index(clickedelement);
                
            var valorSelectUniversales = $(".seleccion_competenciaUniversal option:selected")[indice_universal].value;
            var valorSelectRelevancia = $(".seleccion_relevanciacompetenciaUniversal option:selected")[indice_universal].value;
            
            $.ajax({
               type : 'get',
                url : 'ajax_getInfoUniversales.php', 
               data: {codTenica: valorSelectUniversales, nivel: valorSelectRelevancia},

                success : function(response)
                {
                  document.getElementsByName("txt_observacionUniversales[]")[indice_universal].value = response;
                }
                });
            
        });
       
       //Trabajo en Equipo, Inicitativa y Liderazgo
       
       $(".row_TIL").on('change','select.seleccion_relevanciaTIL', function() {
            
            var clickedelement  = $(this);
            var grupo_select_TIL = $(".seleccion_relevanciaTIL");
            var indice_TIL = grupo_select_TIL.index(clickedelement);
                
            var valorTXT_TIL = $(".descripcion_valTIL")[indice_TIL].value;
            var valorSelectRelevancia = $(".seleccion_relevanciaTIL option:selected")[indice_TIL].value;
            
            $.ajax({
               type : 'get',
                url : 'ajax_getInfoTIL.php', 
               data: {codigo: valorTXT_TIL, nivel: valorSelectRelevancia},

                success : function(response)
                {
                  document.getElementsByName("txt_observacionTIL[]")[indice_TIL].value = response;
                }
                });
            
        });
       
       
        
        // Function suma todos los inputs que tengan la clase factor
        function calcularTotalFactor() {
            var total = 0;
            $(".factor").each(
                    function(index, value) {
                            total = total + eval($(this).val());
                    }
            );
            return total; 
        }
        
        // Function que valida el total maximo del factor
        function validarFactor(){
            if (calcularTotalFactor() <= 105){
                return true;
                }else{
                    swal({
                      title: 'Factor de evaluación superado o no asignado',
                      text: 'Revise los factores, Factor Actual: ' +calcularTotalFactor() + ' %',  
                      type: 'warning',
                      confirmButtonText: 'Aceptar', 
                      showConfirmButton: true,
                    });    
                    
                return false;
            }
        }
      
        function getValorPorcentCumplido(porcentaje_cumplido){
            if (!isNaN(porcentaje_cumplido)){
                if (porcentaje_cumplido >= 90.5){
                    return 5;    
                }else if (porcentaje_cumplido >= 80.5 && porcentaje_cumplido <= 90.4){
                    return 4;    
                }else if (porcentaje_cumplido >= 70.5 && porcentaje_cumplido <= 80.4){
                    return 3;    
                }else if (porcentaje_cumplido >= 60.5 && porcentaje_cumplido <= 70.4){
                    return 2;    
                }else{
                    return 1;    
                } 
            }else{
                return 0;
            }
        }
        
        function sumaElementsWithClass(class_name){
            var total = 0;
            $("."+class_name).each(
                    function(index, value) {
                            total = total + eval($(this).val());
                    }
            );
            return total;
        }
        
        function getValorFactor(nivel_cumplido){
            if (!isNaN(nivel_cumplido)){
                factor = document.getElementById("txt_factorActividades").value;
                if (nivel_cumplido == 5){
                    return factor;    
                }else if (nivel_cumplido == 4){
                    return factor*0.75;    
                }else if (nivel_cumplido == 3){
                    return factor*0.50;    
                }else if (nivel_cumplido == 2){
                    return factor*0.25;    
                }else{
                    return 0;    
                } 
            }else{
                return 0;
            }
            
        }
        
      
        function validaCumplido(){
            position = null;
            rows = document.getElementsByName("txt_nummeta_esencial[]");
               
                for (i = 0, total = rows.length; i < total; i++) {
                    position = i;
                    var numMeta = document.getElementsByName("txt_nummeta_esencial[]")[position].value;
                    var numLogrados = document.getElementsByName("txt_numcumplidos_esencial[]")[position].value;
                    var porcentCumplido = (numLogrados*100)/numMeta;
                    
                        if (!isNaN(porcentCumplido)){
                            document.getElementsByName("txt_cumplido_esencial[]")[position].value = porcentCumplido.toFixed(0);  
                            var val_cumplido = getValorPorcentCumplido(porcentCumplido);
                            document.getElementsByName("txt_nivel_esencial[]")[position].value = val_cumplido;
                            var puntaje_item = getValorFactor(val_cumplido);
                            var total_itemsesenciales = document.getElementsByClassName("itemfactor").length;
                            document.getElementsByName("txt_valorfac_esencial[]")[position].value = (puntaje_item/total_itemsesenciales).toFixed(2);
                            
                        }
                       
                    
                }    
                                
        }
        
         function validaCumplidoCant(){
            position = null;
            rows = document.getElementsByName("txt_numcumplidos_esencial[]");
               
                for (i = 0, total = rows.length; i < total; i++) {
                   
                    position = i;
                    var numMeta = document.getElementsByName("txt_nummeta_esencial[]")[position].value;
                    var numLogrados = document.getElementsByName("txt_numcumplidos_esencial[]")[position].value;
                    var porcentCumplido = (numLogrados*100)/numMeta;
                    
                        if (!isNaN(porcentCumplido)){
                            document.getElementsByName("txt_cumplido_esencial[]")[position].value = porcentCumplido.toFixed(0);  
                            var val_cumplido = getValorPorcentCumplido(porcentCumplido);
                            document.getElementsByName("txt_nivel_esencial[]")[position].value = val_cumplido;
                            var puntaje_item = getValorFactor(val_cumplido);
                            var total_itemsesenciales = document.getElementsByClassName("itemfactor").length;
                            document.getElementsByName("txt_valorfac_esencial[]")[position].value = (puntaje_item/total_itemsesenciales).toFixed(2);
                            
                        }
                    
                }    
                                
        }
        
        
        function totalActiEsenciales(){
            var total_porcentCumplido = sumaElementsWithClass('itemfactor');
           
            if (!isNaN(total_porcentCumplido)){
                //console.log($('#seleccion_4porcentextra').val());
                if ($('#seleccion_4porcentextra').val()==="1" && total_porcentCumplido<26){
                        document.getElementById("total_ActEsenciales").value = (total_porcentCumplido+4).toFixed(2); 
                        document.getElementById("resultado1").innerHTML = (total_porcentCumplido+4).toFixed(2);
                        return total_porcentCumplido+4;  
                    }else{
                       document.getElementById("total_ActEsenciales").value = total_porcentCumplido.toFixed(2); 
                        document.getElementById("resultado1").innerHTML = total_porcentCumplido.toFixed(2); 
                        return total_porcentCumplido; 
                    }
                       
                }
            
            return 0;    
        }
            
        function totalConocimientos(){
            var factor_Conocimientos = $('#txt_factorConocimientos').val();
            var num_items_conocimientos = $('.seleccion_valConocimiento').length;
            var unidadAsignada_conocimientos = (factor_Conocimientos/num_items_conocimientos);
            var total_conocimiento = 0;
            
                $(".seleccion_valConocimiento").each(
                    function() {
                        switch ($(this).val()){
                            case '5':
                                total_conocimiento = total_conocimiento  + (unidadAsignada_conocimientos);
                            break;
                            case '4':
                                total_conocimiento = total_conocimiento  + (unidadAsignada_conocimientos * 0.75);
                            break;
                            case '3':
                                total_conocimiento = total_conocimiento  + (unidadAsignada_conocimientos * 0.50);
                            break;
                            case '2':
                                total_conocimiento = total_conocimiento  + (unidadAsignada_conocimientos * 0.25);
                            break;
                            case '1':
                                total_conocimiento = total_conocimiento  + 0;
                            break;
                            default:
                                total_conocimiento = total_conocimiento  +0;
                        }
                    
                    }      
                );
                 
            document.getElementById("total_conocimientos").value = total_conocimiento.toFixed(2); 
            document.getElementById("resultado2").innerHTML = total_conocimiento.toFixed(2);
            return total_conocimiento;
        }
        
        function totalCompetenciasTecnicas(){
            var factor_CompetenciasTecnicas = $('#txt_factorComTecnicas').val();
            var num_items_CompetenciasTecnicas = $('.seleccion_valcompetenciaTecnica').length;
            var unidadAsignada_CompetenciasTecnicas = (factor_CompetenciasTecnicas/num_items_CompetenciasTecnicas);
            var total_CompetenciasTecnicas = 0;
            
                $(".seleccion_valcompetenciaTecnica").each(
                    function() {
                        switch ($(this).val()){
                            case '5':
                                total_CompetenciasTecnicas = total_CompetenciasTecnicas  + (unidadAsignada_CompetenciasTecnicas);
                            break;
                            case '4':
                                total_CompetenciasTecnicas = total_CompetenciasTecnicas  + (unidadAsignada_CompetenciasTecnicas * 0.75);
                            break;
                            case '3':
                                total_CompetenciasTecnicas = total_CompetenciasTecnicas  + (unidadAsignada_CompetenciasTecnicas * 0.50);
                            break;
                            case '2':
                                total_CompetenciasTecnicas = total_CompetenciasTecnicas  + (unidadAsignada_CompetenciasTecnicas * 0.25);
                            break;
                            case '1':
                                total_CompetenciasTecnicas = total_CompetenciasTecnicas  + 0;
                            break;
                            default:
                                total_CompetenciasTecnicas = total_CompetenciasTecnicas  +0;
                        }
                    
                    }      
                );
                 
            document.getElementById("total_com_tenicas").value = total_CompetenciasTecnicas.toFixed(2); 
            document.getElementById("resultado3").innerHTML = total_CompetenciasTecnicas.toFixed(2);
            return total_CompetenciasTecnicas;
        }
        
        function totalCompetenciasUniversales(){
            var factor_CompetenciasUniversales = $('#txt_factorUniversales').val();
            var num_items_CompetenciasUniversales = $('.seleccion_valcompetenciaUniversal').length;
            var unidadAsignada_CompetenciasUniversales = (factor_CompetenciasUniversales/num_items_CompetenciasUniversales);
            var total_CompetenciasUniversales = 0;
            
                $(".seleccion_valcompetenciaUniversal").each(
                    function() {
                        switch ($(this).val()){
                            case '5':
                                total_CompetenciasUniversales = total_CompetenciasUniversales  + (unidadAsignada_CompetenciasUniversales);
                            break;
                            case '4':
                                total_CompetenciasUniversales = total_CompetenciasUniversales  + (unidadAsignada_CompetenciasUniversales * 0.75);
                            break;
                            case '3':
                                total_CompetenciasUniversales = total_CompetenciasUniversales  + (unidadAsignada_CompetenciasUniversales * 0.50);
                            break;
                            case '2':
                                total_CompetenciasUniversales = total_CompetenciasUniversales  + (unidadAsignada_CompetenciasUniversales * 0.25);
                            break;
                            case '1':
                                total_CompetenciasUniversales = total_CompetenciasUniversales  + 0;
                            break;
                            default:
                                total_CompetenciasUniversales = total_CompetenciasUniversales  +0;
                        }
                    
                    }      
                );
                 
            document.getElementById("total_competenciasUniversales").value = total_CompetenciasUniversales.toFixed(2); 
            document.getElementById("resultado4").innerHTML = total_CompetenciasUniversales.toFixed(2);
            return total_CompetenciasUniversales;
        }
        
        
        function totalTIL(){
            var factor_TIL = $('#txt_factorTIL').val();
            var num_items_TIL = $('.seleccion_valTIL').length;
            var unidadAsignada_TIL = 0;
            var total_TIL = 0;
            
            
                if ($("select#seleccion_tieneLiderazgo").val() === "1" ){
                    unidadAsignada_TIL = (factor_TIL/num_items_TIL);
                    $("#seleccion_valTIL_liderazgo").addClass("itemTIL");
                    $("#seleccion_relevanciaTIL").addClass("required");
                    $("#seleccion_valTIL_liderazgo").addClass("required");
                   
                }else{
                     unidadAsignada_TIL = (factor_TIL/(num_items_TIL-1));
                     
                    $("#seleccion_valTIL_liderazgo").removeClass("itemTIL");
                    $("#seleccion_relevanciaTIL").removeClass("required");
                    $("#seleccion_valTIL_liderazgo").removeClass("required");
                    
                }
                    
                $(".itemTIL").each(
                    function() {
                        switch ($(this).val()){
                            case '5':
                                total_TIL = total_TIL  + (unidadAsignada_TIL);
                            break;
                            case '4':
                                total_TIL = total_TIL  + (unidadAsignada_TIL * 0.75);
                            break;
                            case '3':
                                total_TIL = total_TIL  + (unidadAsignada_TIL * 0.50);
                            break;
                            case '2':
                                total_TIL = total_TIL  + (unidadAsignada_TIL * 0.25);
                            break;
                            case '1':
                                total_TIL = total_TIL  + 0;
                            break;
                            default:
                                total_TIL = total_TIL  +0;
                        }
                    
                    }      
                );    
                document.getElementById("total_TIL").value = total_TIL.toFixed(2); 
                document.getElementById("resultado5").innerHTML = total_TIL.toFixed(2);
                return total_TIL;
        }
        
        
        function totalRelClienteInterno(){
            var total_RelClienteInterno = 0;
                $(".seleccion_valrelClienteInterno").each(function() {
                    
                        var clickedelement  = $(this);
                        var grupo_quejas = $(".seleccion_valrelClienteInterno");
                        var indice_queja = grupo_quejas.index(clickedelement);
                    
                        var valorSelectAplicableQueja = $(".seleccion_valrelClienteInterno option:selected")[indice_queja].value;
                        if (valorSelectAplicableQueja == 1){
                            total_RelClienteInterno = total_RelClienteInterno + eval($(".txt_reduccionPtsClienteInterno")[indice_queja].value);
                        }
                    
                        
                    }       
                );
                 
            if(isNaN(total_RelClienteInterno)){
                total_RelClienteInterno = 0;
            }
            
            document.getElementById("total_ClienteInterno").value = total_RelClienteInterno; 
            document.getElementById("resultado6").innerHTML = total_RelClienteInterno;
            
            return total_RelClienteInterno;
        }
        
        //CALCULO DE RESULTADOS TOTALES
        
        function calculaTotalGeneral(){
            var factorTotalOk = 0;
            var puntajeEvaluacion = 0;
            var reduccionPuntos = totalRelClienteInterno();
            puntajeEvaluacion = totalActiEsenciales() + totalConocimientos() +totalCompetenciasTecnicas() + totalCompetenciasUniversales() + totalTIL() + 10;
            puntajeEvaluacion = puntajeEvaluacion - reduccionPuntos;
            
            factorTotalOk = calcularTotalFactor();
            document.getElementById("totalFactorGeneral").innerHTML = factorTotalOk;
            document.getElementById("totalFactorGeneraltxt").value = factorTotalOk;
            document.getElementById("resultadoTotalGneneral").innerHTML = puntajeEvaluacion;
            document.getElementById("totalresultGeneraltxt").value = puntajeEvaluacion;
            
            return puntajeEvaluacion;
        }
        
      
      
        // Funcion de carga de modal window
        function loadmodal() {
               $("#modalcodigo").modal();
                //Obtener valor seleccionado y mostrarlo en el modal
                var val_evalua = document.getElementById("txt_empleadoIdentificado").value;
                $("#myModalLabel_usuario").text(val_evalua);
                          
            }
        
        
        // Funcion de valdacion de codigo de seguridad
                    
        function ajaxvalidacod_seguridad() {

            let cod_usu_ing = document.getElementById("txt_cajacod").value;
            let ci_usu = document.getElementById("txt_CIRUC").value;
        
            $.ajax({
                type: 'GET',
                url: 'valida_cod_seguridad.php',
        
                data: { post_cod_usr: cod_usu_ing, ci_usu: ci_usu },
        
                success: function(response) {
        
                    let APIResp = JSON.parse(response);
                    let mensajeResp = APIResp[0].mensaje;
        
                    //Validamos respuesta TRUE desde API
                    if (APIResp[0].estatus === true) {
                        //Cerramos modal de codigo
                        $('#txt_CIRUC').attr("readonly", "readonly");
                        $('#modalcodigo').modal('toggle');
                        console.log(mensajeResp);
        
                    } else {
                        console.warn(mensajeResp);
                        let divError = `
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                 <p> ${mensajeResp}.</p>
                            </div>`;
        
                        $('.resultmodal').html(divError);
        
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
                                        
                                        document.getElementById("txt_empleadoIdentificado").value = response[0]['Nombre']+response[0]['Apellido'];
                                       
                                    }else{
                                        document.getElementById("txt_empleadoIdentificado").value = "-- Sin Identificar -- ";
                                    
                                    }
                            }
                        });
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
                    
                    
        function showselectEmpleados(){
                        var empresa = document.getElementById("select_empresaa").value;
            
                        $.ajax({
                           type : 'get',
                            url : 'ajax_select_empleado.php', 

                           data: {cod_WF: empresa, excluyente:"" },
                          
                        success : function(r)
                            {
                              document.getElementById("ajax_result_cliente").innerHTML=r;
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
                    
        
                    
        function valida_cargo(){
                         var cod_empleado = document.getElementById("seleccion_empleado").value;
                         
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
        
        function setCountNumActividades (){
            document.getElementById("txt_numActividadesEsenciales").value = (rows_esenciales.length);
            document.getElementById("txt_numConocimientos").value = (rows_conocimientos.length);
            document.getElementById("txt_numComTecnicas").value = (rows_ComTecnicas.length);
            document.getElementById("txt_numUniversales").value = (row_Universales.length);
            document.getElementById("txt_numTIL").value = document.getElementsByClassName("row_TIL").length;
            
        }
                
        var limite_esenciales = 1; 
        var rows_esenciales = document.getElementsByClassName("row_esencial");
        function add_row_esencial(){
                         
                        $.ajax({
                           type : 'get',
                            url : 'agrega_row_esencial.php', 
                          
                        success : function(response)
                            {
                                if (limite_esenciales < 25){
                                    $('.result_add_asencial').append(response); 
                                    setCountNumActividades();
                                    limite_esenciales++;
                                }else{
                                     swal({  title: 'Límite alcanzado',
                                        text: 'Se pueden registrar hasta 25 items',  
                                        type: 'warning',    
                                        showCancelButton: false,   
                                        closeOnConfirm: false,   
                                        confirmButtonText: 'Aceptar', 
                                        showLoaderOnConfirm: true } 
                                        ); 
                                }
                              
                            }
                        });
                      
            };                             

           
            function remove_extra_esencial(row_clicked_delete){
                  
                if (limite_esenciales <= 1)  
                    {
                        swal({  title: 'Solicitud Vacia',
                            text: 'Debe existir al menos 1 item',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                    }
                    else
                    {    
                        limite_esenciales--;
                        position_delete_prod = false;
                        rows = document.getElementsByClassName("btn_remove_esencial");
                       
                        for (i = 0, total = rows.length; i < total; i++) {
                            if (rows[i] === row_clicked_delete){
                            position_delete_prod = i;
                            document.getElementsByClassName("row_esencial")[position_delete_prod].remove();
                            
                            }
                        }
                      
                    }
                validaCumplido();
                totalActiEsenciales();
                setCountNumActividades();   
            }  


        var limite_conocimientos = 1; 
        var rows_conocimientos = document.getElementsByClassName("row_conocimiento");
        function add_row_conocimiento(){
                         
                        $.ajax({
                           type : 'get',
                            url : 'agrega_row_conocimiento.php', 
                          
                        success : function(response)
                            {
                                if (limite_conocimientos < 25){
                                    $('.result_add_conocimiento').append(response); 
                                    setCountNumActividades();
                                    limite_conocimientos++;
                                }else{
                                     swal({  title: 'Límite alcanzado',
                                        text: 'Se pueden registrar hasta 25 items',  
                                        type: 'warning',    
                                        showCancelButton: false,   
                                        closeOnConfirm: false,   
                                        confirmButtonText: 'Aceptar', 
                                        showLoaderOnConfirm: true } 
                                        ); 
                                }
                              
                            }
                        });
                      
            };        
            
        function remove_extra_conocimiento(row_clicked_delete){
                  
                if (limite_conocimientos <= 1)  
                    {
                        swal({  title: 'Solicitud Vacia',
                            text: 'Debe existir al menos 1 item',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                    }
                    else
                    {    
                        limite_conocimientos--;
                        position_delete_prod = false;
                        rows = document.getElementsByClassName("btn_remove_conocimiento");
                       
                        for (i = 0, total = rows.length; i < total; i++) {
                            if (rows[i] === row_clicked_delete){
                            position_delete_prod = i;
                            document.getElementsByClassName("row_conocimiento")[position_delete_prod].remove();
                            
                            }
                        }
                      
                    }
                totalConocimientos();
                setCountNumActividades();   
            }      
            
            
        var limite_com_tecnicas = 1; 
        var rows_ComTecnicas = document.getElementsByClassName("row_ComTecnicas");
        function add_row_comtecnicas(){
                         
                        $.ajax({
                           type : 'get',
                            url : 'agrega_row_com_tecnicas.php', 
                          
                        success : function(response)
                            {
                                if (limite_com_tecnicas < 25){
                                    $('.result_add_ComTecnicas').append(response); 
                                    setCountNumActividades();
                                    limite_com_tecnicas++;
                                }else{
                                     swal({  title: 'Límite alcanzado',
                                        text: 'Se pueden registrar hasta 25 items',  
                                        type: 'warning',    
                                        showCancelButton: false,   
                                        closeOnConfirm: false,   
                                        confirmButtonText: 'Aceptar', 
                                        showLoaderOnConfirm: true } 
                                        ); 
                                }
                              
                            }
                        });
                      
            };        
            

        function remove_extra_ComTecnica(row_clicked_delete){
                  
                if (limite_com_tecnicas <= 1)  
                    {
                        swal({  title: 'Solicitud Vacia',
                            text: 'Debe existir al menos 1 item',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                    }
                    else
                    {    
                        limite_com_tecnicas--;
                        position_delete = false;
                        rows_ComTecnica = document.getElementsByClassName("btn_remove_com_tecnica");
                       
                        for (i = 0, total = rows_ComTecnica.length; i < total; i++) {
                            if (rows_ComTecnica[i] === row_clicked_delete){
                            position_delete = i;
                            document.getElementsByClassName("row_ComTecnicas")[position_delete].remove();
                            
                            }
                        }
                      
                    }
                totalCompetenciasTecnicas();
                setCountNumActividades();   
            }      
            
            
        var limite_row_Universales = 1; 
        var row_Universales = document.getElementsByClassName("row_Universales");
        function add_row_universal(){
                         
                        $.ajax({
                           type : 'get',
                            url : 'agrega_row_com_universal.php', 
                          
                        success : function(response)
                            {
                                if (limite_row_Universales < 25){
                                    $('.result_add_ComUniversales').append(response); 
                                    setCountNumActividades();
                                    limite_row_Universales++;
                                }else{
                                     swal({  title: 'Límite alcanzado',
                                        text: 'Se pueden registrar hasta 25 items',  
                                        type: 'warning',    
                                        showCancelButton: false,   
                                        closeOnConfirm: false,   
                                        confirmButtonText: 'Aceptar', 
                                        showLoaderOnConfirm: true } 
                                        ); 
                                }
                              
                            }
                        });
                      
            };        
            
            
            function remove_extra_universal(row_clicked_delete){
                  
                if (limite_row_Universales <= 1)  
                    {
                        swal({  title: 'Solicitud Vacia',
                            text: 'Debe existir al menos 1 item',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                    }
                    else
                    {    
                        limite_row_Universales--;
                        position_delete = false;
                        rows_universales = document.getElementsByClassName("btn_remove_com_universal");
                       
                        for (i = 0, total = rows_universales.length; i < total; i++) {
                            if (rows_universales[i] === row_clicked_delete){
                            position_delete = i;
                            document.getElementsByClassName("row_Universales")[position_delete].remove();
                            
                            }
                        }
                      
                    }
                totalCompetenciasUniversales();
                setCountNumActividades();   
            }      
            
            
            
        var limite_row_quejas = 1; 
        var row_quejas = document.getElementsByClassName("row_relClienteInterno");
        function add_row_queja(){
                         
                        $.ajax({
                           type : 'get',
                            url : 'agrega_row_queja.php', 
                          
                        success : function(response)
                            {
                                if (limite_row_quejas < 25){
                                    $('.result_add_ClienteInterno').append(response); 
                                    setCountNumActividades();
                                    limite_row_quejas++;
                                }else{
                                     swal({  title: 'Límite alcanzado',
                                        text: 'Se pueden registrar hasta 25 items',  
                                        type: 'warning',    
                                        showCancelButton: false,   
                                        closeOnConfirm: false,   
                                        confirmButtonText: 'Aceptar', 
                                        showLoaderOnConfirm: true } 
                                        ); 
                                }
                              
                            }
                        });
                      
            };  
            
            
            function remove_extra_queja(row_clicked_delete){
                  
                    if (limite_row_quejas <= 0)  
                    {
                        swal({  title: 'Solicitud Vacia',
                            text: 'No existen filas que eliminar',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                    }
                    else
                    {    
                        limite_row_quejas--;
                        position_delete = false;
                        rows_quejas = document.getElementsByClassName("btn_remove_queja");
                       
                        for (i = 0, total = rows_quejas.length; i < total; i++) {
                            if (rows_quejas[i] === row_clicked_delete){
                            position_delete = i;
                            document.getElementsByClassName("row_relClienteInterno")[position_delete].remove();
                            
                            }
                        }
                      
                    }
                totalRelClienteInterno();
                setCountNumActividades();   
                  
            
            }      
            
            
          