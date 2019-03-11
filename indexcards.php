<?php $hoy = date("F j, Y, g:i a"); 
$basURL = 'http://196.168.1.202:8090';
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

     <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
	<link rel="shortcut icon" href="\wssp\ws-admin\img\favicon.ico">
    
  <link rel="stylesheet" href="ws-admin/librerias/bootstrap4/css/bootstrap.min.css">
  <link rel="stylesheet" href="ws-admin/mystyles.css">
 

  <script src="ws-admin/js/jquery-latest.js"></script>
  <script src="ws-admin/librerias/bootstrap4/js/bootstrap.min.js">

    <script type="text/javascript" src="mainmenu/core/myjs.js"></script>
    <title>Menú Principal</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="http://www.kaosportcenter.com">
    <img src="<?php echo $basURL?>/wssp/ws-admin/img/logo.png" width="65" height="30" class="d-inline-block align-top" alt="">
    KAO Sport Center 
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="http://196.168.1.1/gw">Web Access <span class="sr-only">(current)</span></a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="./ws-admin/">Iniciar Sesión</a>
      </li>
    </ul>
    
  </div>
</nav>
</br>

  <?php 
  
  
  if(file_exists('./ws-admin/configuraciones.xml') && $configXML = simplexml_load_file('./ws-admin/configuraciones.xml')){
    $enMantenimiento = $configXML->enMantenimiento;
    $finMantenimiento = $configXML->finMantenimiento;
    

    if ($enMantenimiento == 'true'){
      echo '
      <div class="container">
      <div class="alert alert-danger" role="alert">
        <p class="text-center">Los formularios se encuentran en mantenimiento, no realice ninguna accion de momento, intentelo mas tarde.</p>
        <p class="text-center"> Fin de mantenimiento previsto a las: <strong>'.$finMantenimiento.'</strong></p>
      </div>
      </div>
      ';
    }else{
  ?>
 <div class="container">
    <!-- .card-group assumes the entire width of the .container and acts as a row for all the .card in it --> 
    <div class="card-columns">
      <div class="card">
        <img class="card-img-top" src="<?php echo $basURL?>/wssp/mainmenu/files/backgrpundKAO.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title text-center">Vales por perdida</h5>
          <p class="card-text text-center">Realice los vales por mercadería perdida.</p>
          <p class="card-text"><small class="text-muted">No requiere clave de autorizacion</small></p>
          <a href="./ws-valep/" class="btn btn-primary btn-block">Realizar</a>
        </div>
    </div>
    <div class="card">
      <img class="card-img-top" src="<?php echo $basURL?>/wssp/mainmenu/files/backgrpundKAO.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title text-center">Evaluación de locales</h5>
        <p class="card-text text-center">Evaluación para el personal de locales.</p>
        <p class="card-text"><small class="text-muted">Requiere clave de autorizacion</small></p>
        <a href="./ws-evalua/" class="btn btn-primary btn-block">Realizar</a>
      </div>
    </div>

    <div class="card">
      <img class="card-img-top" src="<?php echo $basURL?>/wssp/mainmenu/files/backgrpundKAO.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title text-center">Evaluación de anfitriones</h5>
        <p class="card-text text-center">Evaluación para los anfitriones.</p>
        <p class="card-text"><small class="text-muted">No requiere clave de autorizacion</small></p>
        <a href="./ws-evanfitriones/" class="btn btn-primary btn-block">Realizar</a>
      </div>
    </div>

    <div class="card">
      <img class="card-img-top" src="<?php echo $basURL?>/wssp/mainmenu/files/backgrpundKAO.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title text-center">Evaluación de Jefes</h5>
        <p class="card-text text-center">Evaluación para los jefes inmediatos del personal.</p>
        <p class="card-text"><small class="text-muted">Requiere clave de autorizacion</small></p>
        <a href="./ws-evaluagge/" class="btn btn-primary btn-block">Realizar</a>
      </div>
    </div>

    <div class="card">
      <img class="card-img-top" src="<?php echo $basURL?>/wssp/mainmenu/files/backgrpundKAO.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title text-center">CheckList (Locales)</h5>
        <p class="card-text text-center">Checklist de entrada y salida de locales.</p>
        <p class="card-text"><small class="text-muted">Requiere clave de autorizacion</small></p>
        <a href="./ws-chlocales/" class="btn btn-primary btn-block">Realizar</a>
      </div>
    </div>

    <div class="card">
      <img class="card-img-top" src="<?php echo $basURL?>/wssp/mainmenu/files/backgrpundKAO.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title text-center">Evaluación de Conocimientos (Anual)</h5>
        <p class="card-text text-center">Evaluación de conocimientos para jefes.</p>
        <p class="card-text"><small class="text-muted">Requiere clave de autorizacion</small></p>
        <a href="./ws-chlocales/" class="btn btn-primary btn-block disabled">Realizar</a>
      </div>
    </div>

    
    <div class="card">
      <img class="card-img-top" src="<?php echo $basURL?>/wssp/mainmenu/files/backgrpundKAO.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title text-center">Mantenimientos App</h5>
        <p class="card-text text-center">Aplicativo para el registro y asignacion de mantenimientos.</p>
        <p class="card-text"><small class="text-muted">Requiere clave de autorizacion</small></p>
        <a href="../../mantenimientoApp" class="btn btn-primary btn-block">Realizar</a>
      </div>
    </div>


    


  

  </div>
  <?php
    }
  ?>
  
  <?php 
  }else{
      die ('Error no se pudo cargar el archivo de configuraciones XML, informe a sistemas.');
  }

  ?>

  
  
</div>

    <br>
    <div id="footer" class="footer">
      <div class="push-spaces text-center">
      <strong> Version 2.8.0 - </strong>.
      Contáctar con soporte KAO <a href="mailto:soporteweb@sudcompu.net?" target="_blank">Soporte Web</a>
      para sugerencias o reporte de errores

      <p>Copyright &copy; 2017 KAO Sport Center</p>
      

      </div>
    
      

    </div>



 
</body>
</html>
