 $(document).ready(function() {
        $('.codejiitem').click(function (event) {
            fn_genreport(this);
        });
        
        $('#btn_busqueda_eji').click(function (event) {
            search(this);
        });
        
       
        $(".result_search_eji").on('click','.btnAnulaEJI', function(event) {
               
               let ID_EJI = event.target.id;
               let ID_Empresa = document.getElementById("hidden_empresa_autentificada").value;

               alert("Anulando: " + ID_EJI + " Empresa:" + ID_Empresa);
               
               if (confirm("Confirma anular esta evaluacion?")) { 
                let askKey = prompt("Ingrese clave de autorizacion: ");

                if (askKey === 'KAOEV2018') {
                    $.ajax({
                        url : 'ajax/ajax_anulaEJI.php', 
                        method : 'GET',
                        data: {ID_EJI: ID_EJI, ID_Empresa: ID_Empresa}, 
                                    
                        success: function (result) {
                    
                        let API = JSON.parse(result);
                        console.log(API);
                            if (API[0].status === 'OK'){
                                alert(API[0].mensaje);
                                location.reload();
                            }else if (API[0].status === 'FAIL'){
                                alert(API[0].mensaje);
                            } else{
                                alert("No se puedo obtener estado el vale, informe a sistemas.");
                            }
                        }
                    }); // Fin de ajax;
                }else{
                    alert("Clave no aceptada");
                }
                
               } // Fin de confirm
                  
               
        }); 



    });  
      
   
   //Generacion de reportes segun row clickeado
        function fn_genreport(this_elemento){
            var data_id = this_elemento.id;
            window.open('reportes/reporte_byid.php?codEV='+data_id);
            
        };
            
        function search(){
              var post_dateini = document.getElementById("dateini_modal").value;
              var post_datefin = document.getElementById("datefin_modal").value;
              $.ajax({
                  url : 'grid_search.php', 
                  method : 'POST',
                  data: {post_dateini: post_dateini , post_datefin: post_datefin}, 
                            
               success: function (result) {
                   $('.result_search_eji').show().html(result);
                   }
               });
        };    