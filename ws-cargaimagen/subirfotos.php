<?PHP
include_once ('../ws-admin/acceso_db.php');
session_start();
	  
$nombreinput_foto=$_FILES['input_foto']['name'];
$ruta1=$_FILES['input_foto']['tmp_name'];
	if(is_uploaded_file($ruta1))
	{ 
		if($_FILES['input_foto']['type'] == 'image/png' OR $_FILES['input_foto']['type'] == 'image/gif' OR $_FILES['input_foto']['type'] == 'image/jpeg')
		{
		$tips = 'jpg';
		$type = array('image/jpeg' => 'jpg');
		$name = 'foto-'.$_SESSION['user_ruc'].'.'.$tips; /*Renombre de arhivo*/
		$destino1 =  "fotos/".$name; /* URL de destino*/
		copy($ruta1,$destino1);

		$ruta_imagen = $destino1;

		$miniatura_ancho_maximo = 32;  /* Dimensiones de escalado de Fotografia*/
		$miniatura_alto_maximo = 32;

		$info_imagen = getimagesize($ruta_imagen);
		$imagen_ancho = $info_imagen[0];
		$imagen_alto = $info_imagen[1];
		$imagen_tipo = $info_imagen['mime'];

			switch ( $imagen_tipo ){
			  case "image/jpg":
			  case "image/jpeg":
				$imagen = imagecreatefromjpeg( $ruta_imagen );
				break;
			  case "image/png":
				$imagen = imagecreatefrompng( $ruta_imagen );
				break;
			  case "image/gif":
				$imagen = imagecreatefromgif( $ruta_imagen );
				break;
			}
                        
		$lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );
		imagecopyresampled($lienzo, $imagen, 0, 0, 0, 0, $miniatura_ancho_maximo, $miniatura_alto_maximo, $imagen_ancho, $imagen_alto);  
		imagejpeg($lienzo, $destino1, 80);
		
                /*REGISTRO DE URL EN BASE DE DATOS, REVISAR DIRECTORIO DE CARGA*/ 
                mysql_query("update tbl_usuarios set foto='../ws-cargaimagen/".$destino1."'where ruc='".$_SESSION['user_ruc']."'");
                
               }	
	}

        
	