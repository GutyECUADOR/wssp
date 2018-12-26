 $(document).ready(function() {
        $('.codejiitem').click(function (event) {
            fn_genreport(this);
        });
        
        $('#btn_busqueda_eji').click(function (event) {
            search(this);
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