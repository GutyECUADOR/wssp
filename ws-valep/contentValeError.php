<div class="contenedor-formulario">
		<div class="wrap">
                            <div class="txtcentro">
                                    <h5>SOLICITUD DE VALES POR PÉRDIDA</h5>
                            </div>
                    
                             <form autocomplete="off"  class="formulario" name="formulario_registro" method="POST">
                                <div class="centrado">
	           		   	<img class="logo" src="../ws-admin/img/logo.png" alt="Logo">
                    		</div>
                                 
                                <div class="row">
                                    <div class="col-lg-12 center-align">
                                                       
                                        <div class="bs-callout bs-callout-primary">
                                            <h5 class="center-align">Se ha dispuesto los siguientes dias como fechas habilitadas para realizar las solicitudes por perdida, Gracias.</h5>
                                            <?php
                                            echo '<h5 class="center-align">Del : '.$fechainicio.' al '.$fechafinal.' los dias: ';
                                                
                                                foreach($diasHabiles as $value){
                                                echo $value .' ';
                                                
                                                }
                                            echo '</h5>';    
                                            echo '<h5 class="center-align">Fecha Actual: '.$fechaActual.' ('.$nombreDia.')</h5>';
                                            ?>
                                        </div>
                                        
                                        <a href="../" class="btn btn-primary">Regresar</a>
                                    </div> 
                                    
                                </div>    
                                  
                            </form>
                           
                </div>
 </div>
