<?php
include('../ws-admin/acceso_db.php');

        $color_row=array('#DDDDDD', '#CBCBCB');
        $ind_color=0;
        $estadochk = 0;
        $num_check = 0;
        
        
        
	echo " <table border=0 align='center' width='100%'>";    
            echo " <tr class='celdagridtitulos'>
             <td width='80%'>Cargo</td>
             <td width='20%'>Estado</td>
                  </tr>
                ";  
            //Construcción Filas
            $sql = "SELECT * FROM tbl_optcurriculums ORDER BY option_curriculo ASC";
            mysql_query("SET NAMES 'utf8'"); /*ACEPTAR CARACTERES UTF-8*/
            $resultado = mysql_query($sql);
            $cony=0;
            while($fila=mysql_fetch_array($resultado))
                {
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                $num_check++;
                $texto =$fila['option_curriculo'];
                
                
                if ($fila['estado_opt'] === 'on') {
                    $checked = 'checked="checked"';
                    $checked2 = '';
                 } elseif ($fila['estado_opt'] === 'off') {
                    $checked = '';
                    $checked2 = 'checked="checked"';
                 }
 
                echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$fila['option_curriculo']."</td>";
                    $valorcargo = $fila['option_curriculo'];
                    echo"<input type='hidden' name='cargo[]' value='$valorcargo'>";
                    echo"<td class='celdagrid'>";
                    echo"<input type='radio' name=".'estado_radio'.$cont." value='on' $checked/>";
                    echo"<input type='radio' name=".'estado_radio'.$cont." value='off' $checked2/>";
                    echo"</td>";
                    // echo"<td class='celdagrid'><a id='add' href='funciones.php' target='_self' data-toggle='modal' data-target='#modaleliminarreg'><span class='glyphicon glyphicon-remove'></span></a></td>";
        
                    
                echo "</tr>";
                }
       
        echo "</table>";
        
       