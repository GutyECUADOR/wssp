<?php
error_reporting(0);
        foreach (glob("./docwf/xml/*.xml") as $nombre_fichero) 
        {
                $rucFORM = $_SESSION['RUCACTIVO']; //RUC recibido del form necesario

                $xml= simplexml_load_file("$nombre_fichero");
                $numDOCUMENT = $xml->comprobante; //Carga del nodo completo
                $nodoCOMPROBANTE = $xml->comprobante;
                $rucBUSCADO = $rucFORM;
                $typeDOCUMENT="comprobanteRetencion";  
                
            $coincidenciatypeDOCUMENT = strpos($nodoCOMPROBANTE, $typeDOCUMENT);
            if ($coincidenciatypeDOCUMENT == TRUE) //AGREGAR ENLACE SOLO SI ES NOTA DE CRÉDITO
            {
                
                   if(empty($rucBUSCADO)) //Evitar error de falta de RUC
                    { $rucBUSCADO ="abc"; }

                $coincidenciaRUC = strpos($nodoCOMPROBANTE, $rucBUSCADO);

                if ($coincidenciaRUC == TRUE) 
                    {
                    //NODOS XML QUE SE BUSCA
                     $claveAccesoCLAVE = "claveAcceso";  
                     $fechaEmisionCLAVE = "fechaEmision";
                     $secuencialCLAVE = "razonSocialComprador";
                     $importeTotalCLAVE = "valorRetenido";
                     
                        //BUSQUEDA DEL TEXTO EN EL NODO y SU POSICION
                        $COINCIDENCIAclaveAcceso = strpos($nodoCOMPROBANTE, $claveAccesoCLAVE);
                        $COINCIDENCIAfechaEmision = strpos($nodoCOMPROBANTE, $fechaEmisionCLAVE);
                        $COINCIDENCIAsecuencial = strpos($nodoCOMPROBANTE, $secuencialCLAVE);
                        $COINCIDENCIAimporteTotal = strpos($nodoCOMPROBANTE, $importeTotalCLAVE);

                       if ($COINCIDENCIAclaveAcceso == TRUE) 
                            {
                            // EXTRACCION DEL STRING BUSCADOD ENTRO DEL NODO      
                            $nDOCUMENT = strip_tags(substr($nodoCOMPROBANTE, $COINCIDENCIAclaveAcceso+12,63)); 
                            
                            $fechaDOCUMENT = strip_tags(substr($nodoCOMPROBANTE, $COINCIDENCIAfechaEmision+13,43));
                            $secuencialDOCUMENT = strip_tags(substr($nodoCOMPROBANTE, $COINCIDENCIAsecuencial-1,40));
                            $importetotalDOCUMENT = strip_tags(substr($nodoCOMPROBANTE, $COINCIDENCIAimporteTotal+14,20));
                            $importetotalDOCUMENT = 0;
                               
                            $linkPDF = "<a href='./docwf/ride/RIDE_$nDOCUMENT.pdf' target='_blank'>$icono</a>"; //Listar documento con LINK
                            $linkXML = "<a href='./docwf/xml/$nDOCUMENT.xml' target='_blank'>$iconoXML</a>";
                            $cont++;   //Resultados obtenidos
        
                            //GUARDADO EN ARREGLOS
                            
                            $arraytotal[$cont][0]= $fechaDOCUMENT;
                            $arraytotal[$cont][1]= $secuencialDOCUMENT;
                            $arraytotal[$cont][2]= $importetotalDOCUMENT;
                            $arraytotal[$cont][3]= "Retención";
                            $arraytotal[$cont][4]= $linkPDF;
                            $arraytotal[$cont][5]= $linkXML;
                    
                            }
                    }            
            }               
        }        
