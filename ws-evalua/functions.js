$(function ajaxbusqueda(){
        $('.push').click(function(){
           var user_search =document.getElementById("seleccion_empleado_modal").value;
           var user_dateini =document.getElementById("dateini_modal").value;
           var user_datefin =document.getElementById("datefin_modal").value;
           
            $.ajax({
               type : 'post',
                url : 'busqueda_reporte.php', 
               data: {post_username: user_search, post_dateini: user_dateini , post_datefin: user_datefin},
                  
            success : function(r)
                {
                   
                  $('#mymodal').show();  // put your modal id 
                  $('.resultmodal').show().html(r);
                }
         });
        });

        });
        
        // Busqueda de evaluaciones
        $(function search_ev(){
            $('#btn_busqueda_ev').click(function(){
              var data_id = document.getElementById("txt_busqueda_ev").value;
              //alert("Busqueda: "+ data_id);
               $.ajax({
                  url : 'search_evalua.php', 
                  method : 'POST',
                  data :  'ajax_id='+ data_id,  // in php you should use $_POST['ajax_id'] to get this value 
               success: function (result) {
                   $('.result_search_ev').show().html(result);
                   }
               });
           });
        });
        
        
        // Función de Eliminar evaluaciones
        $(function delete_ev(){
            $('#btn_delete_ev').click(function(){
              var data_id = document.getElementById("txt_cod_ev").value;
               $.ajax({
                  url : 'eliminar_evalua.php', 
                  method : 'POST',
                  data :  'ajax_id='+ data_id,  
               success: function (result) {
                   $('#Modal_Eliminar').show();  // modal id 
                   $('.result_delete_ev').show().html(result);
                   }
               });
           });
        });
        
        
        
        // Funcion de Busqueda AJAX para reportes cruzados
        
        $(function ajaxbusquedacruce(){
        $('.pushcruce').click(function(){
           var user_search =document.getElementById("seleccion_empleado_modal_cruce").value;
         
            $.ajax({
               type : 'post',
                url : 'busqueda_reporte_cruce.php', 
            
               data: {post_username: user_search},
                  
            success : function(r)
                {
                   
                  $('#mymodal').show();  // put your modal id 
                  $('.resultmodalcruce').show().html(r);
                }
         });
        });
        });
        
        
        //Generacion de reportes segun row clickeado
       function fn_genreport_row(this_elemento){
            var data_id = this_elemento.id;
            alert("Generando reporte con ID:" + data_id);
            window.open('reportes/reporte_evaluado_byid.php?seleccion_empleado_resultados='+data_id);
            
        };
        
        // Funcion de Busqueda AJAX para reportes segun, utilizada en grid dinamico
        
        $(function fn_genreport(){
         $('.codev').click(function(){
           var data_id = ($(this).attr('id')); //ID de tabla dinamica
          
            $.ajax({
               url : 'reportes/reporte_evaluado_byid.php', // in here you should put your query 
               method : 'GET',
               data :  'seleccion_empleado_resultados='+ data_id, // here you pass your id via ajax .
                          // in php you should use $_POST['post_id'] to get this value 
            success: function () {
                        alert('Generando reporte con ID : '+ data_id);
                        window.open('reportes/reporte_evaluado_byid.php?seleccion_empleado_resultados='+data_id);
                }
 
         });  
        });
        });
