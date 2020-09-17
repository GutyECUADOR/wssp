<?php
    $conexion_ok = false;    
        function getDataBase($cod_db) {
            switch ($cod_db) {
            case 001:
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=IMPORKAO_V7;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de BODEGA GYL");
                break;
            
            case '001':
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=IMPORKAO_V7;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de BODEGA GYL");
                break;

            case 002:
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=KINDRED_V7;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de BODEGA GYL");
                break;
            
            case '002':
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=KINDRED_V7;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de BODEGA GYL");
                break;

            case 003:
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=KINSMAN_V7;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de BODEGA GYL");
                break;
            
            case '003':
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=KINSMAN_V7;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de BODEGA GYL");
                break;
            
            case 004:
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=FALVAREZ_V7;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de BODEGA GYL");
                break;
            
            case '004':
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=FALVAREZ_V7;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de BODEGA GYL");
                break;

            case 005:
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=BODEGA_GYE;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de BODEGA GYL");
                break;
            
            case '005':
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=BODEGA_GYE;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de BODEGA GYL");
                break;

            case 006:
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=SCKINSMAN_V7;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de VERONICA CARRASCO");
                break;
            
            case '006':
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=SCKINSMAN_V7;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de VERONICA CARRASCO");
                break;

            case 007:
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=VJCB_V7;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de VERONICA CARRASCO");
                break;
            
            case '007':
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=VJCB_V7;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");//or die ("Error en conexion ODBC de VERONICA CARRASCO");
                break;
            
            case 008:
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=;', 'sfb', 'sfb123' )  or die ("Error en conexion ODBC");// Base de datos modelo, autenticacion de SQL requiere user y pass
                break;
            
            case '008':
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=;', 'sfb', 'sfb123' ) or die ("Error en conexion ODBC"); // Base de datos modelo, autenticacion de SQL requiere user y pass
                break;

            case 009:
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=KAO_wssp;', 'sfb', 'sfb123') or die ("Error en conexion ODBC");  // Base de datos WSSP
                break;
            
            case '009':
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=KAO_wssp;', 'sfb', 'sfb123') or die ("Error en conexion ODBC");  // Base de datos WSSP
                break;
				
			case 010:
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=SBIOKAO;', 'sfb', 'sfb123') or die ("Error en conexion ODBC");  // Base de datos SBIO
                break;
            
            case '010':
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=SBIOKAO;', 'sfb', 'sfb123') or die ("Error en conexion ODBC");  // Base de datos SBIO
                break;	
            
            default:
                $conexion_ok = odbc_connect('Driver={SQL Server};Server=196.168.1.201;Database=MODELOKIND_V7;', 'sfb', 'sfb123' ) or die ("Error en conexion ODBC"); // Base de datos modelo, autenticacion de SQL requiere user y pass
                break;
            }
            
            return $conexion_ok ;
            
}