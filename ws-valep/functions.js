// Evitar enter en formularios

$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});



$(function ajaxbusqueda_valepANT(){
            $('#btn_search_valep').click(function(){
                var id_search =document.getElementById("seleccion_empresa_valep").value;
                var user_dateini =document.getElementById("dateini_modal").value;
                var user_datefin =document.getElementById("datefin_modal").value;
             
                $.ajax({
                   type : 'post',
                    url : 'busqueda_reporteANT.php', 
                   data: {post_id: id_search, post_dateini: user_dateini , post_datefin: user_datefin},

                success : function(r)
                    {
                      $('#mymodal').show();  // modal id 
                      $('.resultmodal_valep').show().html(r);
                    }
             });
            });
        });
            
        function fn_genreport_valepANT(this_elemento){
            var data_id = this_elemento.id;
            isANT=true;
            alert("Datos añadidos del documento: " +data_id );
                $.ajax({
                           type : 'post',
                            url : 'agrega_row_ANT.php', 
                            data: {doc_id: data_id},
                          
                        success : function(response)
                            {
                                if (limite < 25){
                                    $('.result_add').append(response);
                                    document.getElementById("btn_add_producto").setAttribute("disabled","disabled");
                                    limite++;
                                    calcular_total();
                                }else{
                                     swal({  title: 'Límite alcanzado',
                                        text: 'Se pueden registrar hasta 25 productos por solicitud',  
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
       
        
 
        
        function ajaxvalidacod(){
                       var cod_usu_ing =document.getElementById("txt_cisolicitante").value;
                       var val_empresa = document.getElementById("select_empresaa").value; //Obtenemos el value del select
                         
                        $.ajax({
                           type : 'get',
                            url : 'valida_cod_habilitados.php', 
                            dataType: "json",

                           data: {dato_ci: cod_usu_ing, cod_DataBase:val_empresa},

                        success : function(response)
                            {
                                     if(response.length!==0){
                                        document.getElementById("txt_solicitante_name").value = response[0]['Nombre'];
                                        document.getElementById("cod_txt_cliente").value = response[0]['Cod_Cliente'];
                                    }else{
                                        document.getElementById("txt_solicitante_name").value = "- Sin Identificar -";
                                    }
                            }
                        });
                    }; 
            
            var limite = 1;     
            function add_row(){
                         
                        $.ajax({
                           type : 'get',
                            url : 'agrega_row.php', 
                          
                        success : function(response)
                            {
                                if (limite < 25){
                                    $('.result_add').append(response);  
                                    limite++;
                                }else{
                                     swal({  title: 'Límite alcanzado',
                                        text: 'Se pueden registrar hasta 25 productos por solicitud',  
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
            
            var limite_emp = 1;     
            function add_row_emp(){
                   
                        $.ajax({
                           type : 'get',
                            url : 'agrega_row_emp.php', 
                          
                        success : function(response)
                            {
                                if (limite_emp < 15){
                                    $('.result_emp_add').append(response);  
                                    limite_emp++;
                                     valor_porcentaje();       
                                }else{
                                      swal({  title: 'Límite alcanzado',
                                        text: 'Se pueden registrar hasta 15 empleados por solicitud',  
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
                    
            
                    function add_row_emp_EDITA(){
                   
                        $.ajax({
                           type : 'get',
                            url : 'agrega_row_emp_EDITA.php', 
                          
                        success : function(response)
                            {
                                if (limite_emp < 15){
                                    $('.result_emp_add').append(response);  
                                    limite_emp++;
                                     valor_porcentaje();       
                                }else{
                                      swal({  title: 'Límite alcanzado',
                                        text: 'Se pueden registrar hasta 15 empleados por solicitud',  
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

            function remove_extra_prod(row_clicked_delete){
                  
                if (limite <= 1)  
                    {
                        swal({  title: 'Solicitud Vacia',
                            text: 'Debe existir al menos 1 producto',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                    }
                    else
                    {    
                        limite--;
                        position_delete_prod = false;
                        rows = document.getElementsByClassName("removeprod_ico");
                       
                        for (i = 0, total = rows.length; i < total; i++) {
                            if (rows[i] === row_clicked_delete){
                            position_delete_prod = i;
                            document.getElementsByName("row_productos[]")[position_delete_prod].remove();
                            
                                if (rows.length<=0){
                                document.getElementById("txt_subtotal").value= "";
                                document.getElementById("txt_iva").value= "";
                                document.getElementById("txt_total").value= "";
                                }
                            }
                        }
                        calcular_total();
                        
                       
                    }
                       
                    
            };
        
              
              
            function remove_emp(row_clicked_delete){
                   
                    if (limite_emp <= 1)  
                        {
                            swal({  title: 'Solicitud Vacia',
                            text: 'Debe existir al menos 1 empleado en el registro',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                        }
                        else
                        {    
                            limite_emp--;
                        position_emp = false;
                        rows = document.getElementsByClassName("removeprod_ico_emp");
                       
                        for (i = 0, total = rows.length; i < total; i++) {
                            if (rows[i] === row_clicked_delete){
                            position_emp = i;
                            document.getElementsByName("row_empleados[]")[position_emp].remove();
                            valor_porcentaje();
                            }
                        }
                        }
            };  
                    
        
           
        function ajaxvalidacod_producto(row_clicked){
                        position = false;
                        rows = document.getElementsByClassName("rowproducto");
                       
                        for (i = 0, total = rows.length; i < total; i++) {
                            if (rows[i] === row_clicked){
                            position = i;
                                
                                var mutli_cod = document.getElementsByName("txt_cod_product[]")[position].value;
                                var val_empresa = document.getElementById("select_empresaa").value; //Obtenemos el value del select
                        
                                //alert(mutli_cod);
                                $.ajax({
                                   type : 'get',
                                    url : 'valida_producto.php', 
                                    dataType: "json",

                                    data: {cod_producto: mutli_cod, cod_DataBase:val_empresa},

                                    success : function(response)
                                    {   
                                      //j = i-1;Contador adicional para evitar modificar i y generar bucle
                                    
                                        if(response.length!==0){
                                            document.getElementsByName("txt_detalle_product[]")[position].value = response[0]['nombre'];
                                            document.getElementsByName("txt_cant_product[]")[position].value = 1;
                                            
                                            var porcent_descuento = getDescuento();
                                            var costo_prod = response[0]['precio'];
                                            var costo_prod_fixed = (Math.round(costo_prod * 100) / 100).toFixed(2);
                                            var val_descuento = (costo_prod_fixed*porcent_descuento/100).toFixed(2);
                                            var prod_incdesc = (costo_prod_fixed - val_descuento).toFixed(2);
                                            
                                            if(response[0]['codigo'].trim()=="SERV-075"){
                                                swal({  title: 'Producto Editable',
                                                    text: 'El producto indicado, permite edición de precio.',  
                                                    type: 'info',    
                                                    showCancelButton: false,   
                                                    closeOnConfirm: false,   
                                                    confirmButtonText: 'Aceptar', 
                                                    showLoaderOnConfirm: true } 
                                                    ); 
                                                document.getElementsByName("txt_precio_product[]")[position].readOnly=false;
                                                document.getElementsByName("txt_descuento[]")[position].value=0;
                                            }else{
                                                document.getElementsByName("txt_precio_product[]")[position].readOnly=true;
                                                document.getElementsByName("txt_descuento[]")[position].value = 10; 
                                            }
                                            
                                            
                                            document.getElementsByName("txt_precio_product[]")[position].value = prod_incdesc;
                                            document.getElementsByName("hidden_precio_product[]")[position].value = prod_incdesc;

                                        }else{
                                            document.getElementsByName("txt_detalle_product[]")[position].value = "- Sin Identificar -";
                                            document.getElementsByName("txt_cant_product[]")[position].value = 0;
                                            document.getElementsByName("txt_precio_product[]")[position].value = 0;
                                        }
                                    }
                                });
                                //Fin de AJAX
                            
                            
                            
                            }
                        }
                    }; 
                    
        
        function ajaxEditaDescuento(row_clicked){
                        position = false;
                        rows = document.getElementsByClassName("rowdescuento");
                        
                        for (i = 0, total = rows.length+1; i < total; i++) {
                         
                            if (rows[i] === row_clicked){
                            position = i; //Identifico fila a trabajar
                                
                                var mutli_cod = document.getElementsByName("txt_cod_product[]")[position].value;
                                var val_empresa = document.getElementById("select_empresaa").value; //Obtenemos el value del select
                                
                                $.ajax({
                                   type : 'get',
                                    url : 'valida_producto.php', 
                                    dataType: "json",

                                    data: {cod_producto: mutli_cod, cod_DataBase:val_empresa},

                                    success : function(response)
                                    {   
                                      
                                        if(response.length!==0){
                                            if(response[0]['codigo'].trim()=="SERV-075"){
                                                var costo_prod = document.getElementsByName("hidden_precio_product[]")[position].value;
                                            }else{
                                                var costo_prod = response[0]['precio']; //Obtengo precio del producto sin descuento
                                            }    

                                            var cantidad = document.getElementsByName("txt_cant_product[]")[position].value; //Obtengo cantidad
                                            var porcent_descuento=document.getElementsByName("txt_descuento[]")[position].value; //Obtengo % descuento ingresado
                                            
                                            
                                            var val_descuento = (Math.round(costo_prod * porcent_descuento) / 100).toFixed(2); //Calculo coste con descuento individual
                                            var costo_prod_fixed = (Math.round(costo_prod * 100) / 100).toFixed(2);
                                           
                                            var prod_incdesc = (costo_prod_fixed - val_descuento).toFixed(2);
                                            var val_total_prod = (prod_incdesc*cantidad).toFixed(2);
                                            
                                            document.getElementsByName("txt_precio_product[]")[position].value = val_total_prod;
                                            
                                        }else{
                                            document.getElementsByName("txt_precio_product[]")[position].value = 0;
                                        }
                                    }
                                });
                                
                               
                            }
                        }
                        
                       
                        
                    }; 
        
        function extra_prod(row_clicked){
                        
                        position_cant = false;
                        rows = document.getElementsByClassName("rowcantidad");
                       
                        for (i = 0, total = rows.length; i < total; i++) {
                            if (rows[i] === row_clicked){
                            position_cant = i;
                            var precio_prod = document.getElementsByName("hidden_precio_product[]")[position_cant].value;
                            var mutli_cod = document.getElementsByName("txt_cant_product[]")[position_cant].value; // Valor X multiplica
                                
                            document.getElementsByName("txt_precio_product[]")[position_cant].value = (precio_prod * mutli_cod).toFixed(2);
                            
                            }
                        }
        }
        
        var iva=getiva();
        var isANT=false;
        function getiva(){
              var iva_activo = 'T12';
              $.ajax({
                           type : 'get',
                            url : 'valida_iva.php', 
                            dataType: "json",

                            data: {activo: iva_activo},
                       
                        success : function(response)
                            {
                              iva = response;
                            }
                        });
                        
                        if(isANT===true){
                            return 0;
                        }else{
                            return 0;
                        } 
        }
        
        
        //Obtenemos descuento por AJAX
        var descuento = getDescuento();
        function getDescuento(){
              var cod_usu_ing = document.getElementById("txt_cisolicitante").value;
                 
              $.ajax({
                           type : 'get',
                            url : 'valida_descuento.php', 
                            dataType: "json",

                            data: {cod_usu_ing: cod_usu_ing},
                       
                        success : function(response)
                            {
                              descuento = 10;
                            }
                        });
                        
                       return descuento;
        }
        
        
       
        function calcular_total() {
                //Suma de columna de valores
                var importe_total = 0;
                $(".importe_linea").each(
                        function(index, value) {
                                importe_total = importe_total + eval($(this).val());
                        }
                );
                $("#txt_subtotal").val(importe_total.toFixed(2));

                var iva_db = getiva();
                var iva = importe_total.toFixed(2)*iva_db/100;
                
                
                document.getElementById("txt_iva").value= iva.toFixed(2);

                var total_factura = importe_total + iva;
                document.getElementById("txt_total").value= total_factura.toFixed(2);

                return total_factura.toFixed(2);
                };
        
        function valida_numeros(e){
            tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla==8){
                return true;
            }

            // Patron de entrada, en este caso solo acepta numeros
            patron =/[0-9-.]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }  
        
        function calcular_total_empleados() {
                //Suma de columna de valores
                var importe_total_emp = 0;
                $(".importe_linea_emp").each(
                        function(index, value) {
                                importe_total_emp = importe_total_emp + eval($(this).val());
                        }
                );
              
                return importe_total_emp;
                };
        
        function valida_empleados_ok() {
             
                var usuarios_desconocidos = 0;
                $(".row_deusuario").each(
                        function(index, value) {
                                if ($(this).val()==="- Sin Identificar -")
                                usuarios_desconocidos++;
                        }
                );
                return usuarios_desconocidos;
                };
                
         function valida_productos_ok() {
             
                var productos_desconocidos = 0;
                $(".row_deproducto").each(
                        function(index, value) {
                                if ($(this).val()==="- Sin Identificar -")
                                productos_desconocidos++;
                        }
                );
                return productos_desconocidos;
                };        
       
       
        function porcentaje(){
            var porcenttotal = 100;
            
            rows = document.getElementsByClassName("rowempleado");
            var porcent = porcenttotal/rows.length;
            for (i = 0, total = rows.length; i < total; i++) {
            document.getElementsByName("txt_porcent_emp[]")[i].value = porcent.toFixed(2);   
            }
        return porcent;
        }
        
        
        function valor_porcentaje(){
            porcentaje();
            rows = document.getElementsByClassName("rowempleado");
            var total_pagar = document.getElementById("txt_total").value;
            for (i = 0, total = rows.length; i < total; i++) {
                var parcial = document.getElementsByName("txt_porcent_emp[]")[i].value;
                var val_parcial = (total_pagar*parcial)/100;
                document.getElementsByName("txt_valor_emp[]")[i].value = val_parcial.toFixed(2);
                  
            }
           
            
           
        }
        
        
        function valor_porcentaje_manual(){
            rows = document.getElementsByClassName("rowempleado");
            var total_pagar = document.getElementById("txt_total").value;
            for (i = 0, total = rows.length; i < total; i++) {
                var parcial = document.getElementsByName("txt_porcent_emp[]")[i].value;
                var val_parcial = (total_pagar*parcial)/100;
                document.getElementsByName("txt_valor_emp[]")[i].value = val_parcial.toFixed(2);
            }
        }
        
        function cuotas_ok(){
            rows = document.getElementsByClassName("rowempleado");
            var total_pagar = document.getElementById("txt_total").value;
            
            if (total_pagar / rows.length >= 5){
                
            }
        }
        
        
        function valida_porcentaje_send(){
            sumatoria = 0;
                $(".valporcent").each(
                        function(index, value) {
                                sumatoria = sumatoria + eval($(this).val());
                        }
                );
        return sumatoria;
        }
        
        
        
        function valida_porcentaje_manual(){
            sumatoria = 0;
                $(".valporcent").each(
                        function(index, value) {
                                sumatoria = sumatoria + eval($(this).val());
                        }
                );
        
                if (sumatoria==99.99 || sumatoria >100 ){
                    sumaporcent = Math.round(99.99);
                
                                  
                   
                } else{
                    sumaporcent = sumatoria;
                }
                
            if (sumaporcent!==100){
                     swal({  title: 'Datos incorrectos',
                            text: 'La suma del porcentaje indica un '+sumaporcent+' % del valor total',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            );
                     return false;
                }else{
                    swal({  title: 'Datos correctos',
                            text: 'La suma del porcentaje indica un '+sumaporcent+' % del valor total',  
                            type: 'info',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            );
                     return true;
                }
               
        }
        
        
        function alert_sweet(){
            swal({  title: 'Test',
                            text: 'Message: ' + calcular_total() + ' y ' + calcular_total_empleados(),  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true} 
                            );
            
        }
        
         //Valida si existen codigos de producto repetido
        function productoRepetido(this_value){
            var val2=this_value.value;
            var contador_productos=0;
            var rows = document.getElementsByClassName("rowproducto");
            for (i = 0, total = rows.length; i < total; i++) {
                var txtrow = document.getElementsByName("txt_cod_product[]")[i].value;
                    if (txtrow == val2){
                        contador_productos++;
                        if (contador_productos >=2){
                            document.getElementsByName("txt_cod_product[]")[i].value = "";
                            swal({  title: 'Datos incorrectos',
                            text: 'Existen '+contador_productos+' códigos iguales, cambie el código o elimine la fila duplicada',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            );
                        }
                        
                    } 
            }
        }
        
        
        //Valida si existen campos repetidos en CI de recargo
        function empleadoRepetido(this_value){
            var val2=this_value.value;
            var contador=0;
            var rows = document.getElementsByClassName("rowempleado");
            for (i = 0, total = rows.length; i < total; i++) {
                var txtrow = document.getElementsByName("txt_ci_empleado[]")[i].value;
                    if (txtrow == val2){
                        contador++;
                        if (contador >=2){
                            document.getElementsByName("txt_ci_empleado[]")[i].value = "";
                            swal({  title: 'Datos incorrectos',
                            text: 'Se ingreso '+contador+' cédulas iguales, cambie el numero o elimine la fila duplicada',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            );
                        }
                        
                    } 
            }
        }
        
       //Recupera los datos del empleado por AJAX
        function ajaxvalidaemp(row_clicked){
                        rows = document.getElementsByClassName("rowempleado");
                        for (i = 0, total = rows.length; i < total; i++) {
                            if (rows[i] === row_clicked){
                            position = i;
                                
                                var cod_usu_ing = document.getElementsByName("txt_ci_empleado[]")[position].value;
                                var val_empresa = document.getElementById("select_empresaa").value; //Obtenemos el value del select
                        
                                //alert(cod_usu_ing);
                                $.ajax({
                                   type : 'get',
                                    url : 'valida_cod.php', 
                                    dataType: "json",

                                    data: {dato_ci: cod_usu_ing, cod_DataBase:val_empresa},

                                    success : function(response)
                                    {   
                                        porcentaje();
                                        if(response.length!==0){
                                            document.getElementsByName("txt_nombre_emp[]")[position].value = response[0]['Nombre'];
                                            document.getElementsByName("txt_hiddenwinf_emp[]")[position].value = response[0]['CodigoWinF'];
                                        }else{
                                            document.getElementsByName("txt_nombre_emp[]")[position].value = "- Sin Identificar -";
                                            document.getElementsByName("txt_porcent_emp[]")[position].value = 0;
                                        }
                                    }
                                });
                                //Fin de AJAX
                            }
                        }
                    }; 
                    
        function showselectBodegas(str){
                         var val_evalua = document.getElementById("select_empresaa").value; //Obtenemos el value del select
                         
                        $.ajax({
                           type : 'get',
                            url : 'ajax_select_empleado.php', 

                           data: {cod_WF: str, excluyente:val_evalua},
                          
                        success : function(r)
                            {
                              document.getElementById("cod_txt_empresa").innerHTML=r;
                            }
                            });
                    
                    }
                    
                    
         function showselectSupervisores(str){
                         var val_evalua = document.getElementById("select_empresaa").value; //Obtenemos el value del select
                         
                        $.ajax({
                           type : 'get',
                            url : 'ajax_select_superv.php', 

                           data: {cod_WF: str, excluyente:val_evalua},
                          
                        success : function(r)
                            {
                              document.getElementById("select_dirigidoa").innerHTML=r;
                            }
                            });
                    
                    }            


        function validar_formulario() {
                if(document.formulario_registro.txt_solicitante_name.value==="- Sin Identificar -")
                {
                     swal({  title: 'Solicitante inválido',
                            text: 'La CI del solicitante no es correcta o no esta registrada en el sistema',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                     
                      return false;                               
                }
            
                else if (document.formulario_registro.txt_total.value==="" || document.formulario_registro.txt_total.value==="NaN" || document.formulario_registro.txt_total.value<=0)
                {
                    swal({  title: 'Solicitud Vacia',
                            text: 'Debe existir un monto que reportar, revise el calculo del Total',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                     return false;                               
                }
                
                else if(valida_productos_ok()>=1)
                {
                     swal({  title: 'Producto no registrado',
                            text: 'Se ha detectado productos inválidos o no registrados en el sistema',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                     
                      return false;                               
                }
                
                else if(valida_empleados_ok()>=1)
                {
                     swal({  title: 'Empleado no registrado',
                            text: 'Se ha detectado empleados inválidos o no registrados en el sistema',  
                            type: 'warning',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true } 
                            ); 
                     
                      return false;                               
                }
               
                else if (valida_porcentaje_manual()===true) {
                      return true;
                }else
                       return false;
                }            
                    
            