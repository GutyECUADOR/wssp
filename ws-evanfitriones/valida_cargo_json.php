<?php
/*
 * Function valida_cargo_json()
 *
 * Retorna Objeto JSON con informaciòn del usuario ingresado, necesario CI 
 *
 * @param cod_user (string) indica el codigo del usuario en la base de datos
 * @return (JSON Object)
 */

include('../ws-admin/acceso_db_sbio.php');
include('../ws-admin/acceso_db_vales.php');
include_once ('../ws-admin/acceso_multi_db.php');

$cod_ingresado = $_GET['cod_user'];

$consulta_user = "SELECT A.Codigo as CodigoN, A.Nombre as NombreN, A.Apellido as ApellidoN , A.Cedula as CedulaN,  A.Empresa_WF as EmpresaN FROM SBIOKAO.dbo.Empleados as A WHERE Codigo ='$cod_ingresado'";
$result_query_user = odbc_exec($conexion_sbio, $consulta_user);

if (odbc_num_rows($result_query_user)>=1)
    {
    $ci_user= trim(odbc_result($result_query_user,"CedulaN"));
    $cod_db= trim(odbc_result($result_query_user,"EmpresaN")); //Obtener codigo de base de datos tabla Empresas_WF
   
    // Recuperamos ODBC segun codigo base de datos
    $conexion_db_empresa = getDataBase($cod_db);
    
    if ($conexion_db_empresa != FALSE){
        
        $consulta_cargo = "SELECT A.codigo as CodigoN, A.cargo as CargoN, B.Nombre as DescN FROM dbo.ROL_EMPLEADOS as A INNER JOIN dbo.ROL_Cargos as B ON a.cargo = B.Codigo  WHERE A.codigo = '$ci_user'";
        $result_query_cargo = odbc_exec($conexion_db_empresa, $consulta_cargo);

        if (odbc_num_rows($result_query_cargo)>=1)
        {
            //Identifique aqui los nombres de las filas que se muestran como resultante de SQL querry
            $ci_empleado = trim(odbc_result($result_query_cargo,"CodigoN"));
            $cod_cargo_emp = trim(odbc_result($result_query_cargo,"CargoN"));
            $desc_cargo_emp = iconv("iso-8859-1", "UTF-8",trim(odbc_result($result_query_cargo,"DescN")));
            
            $rawdata = array(["ci"=>$ci_empleado, "codCargo"=>$cod_cargo_emp, "Cargo"=>$desc_cargo_emp]);
            echo json_encode($rawdata);
        }
        else{
            $rawdata = ""; 
            echo json_encode($rawdata);  
        }
        
    
    }  else
    {
       $rawdata = ""; 
        echo json_encode($rawdata);  
    }
   
    
    } 