<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">KAO Formularios</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
          <li><a href="../">Inicio<span class="sr-only"></span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Formularios <span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="../ws-evalua/">Evaluación (Locales)</a></li>
              <li><a href="../ws-evanfitriones/">Evaluación (Anfitriones)</a></li>
              <li><a href="../ws-evaluagge/">Evaluación (Jefe Inmediato)</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="../ws-chlocales/">CheckList (Locales)</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="../ws-valep/">Vales por pérdida</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="../ws-estadovehiculo/">Estado del Vehiculo</a></li>
            <li><a href="../ws-estadovehiculo/ordenPedido.php">Orden de Pedido Vehiculo</a></li>
           
          </ul>
        </li>
        
        <?php
          if ($_SESSION) {
            echo '<li><a href="../ws-admin/">Administracion <span class="sr-only"></span></a></li>';
          }else {
            echo '<li><a href="../ws-admin/">Iniciar Sesión <span class="sr-only"></span></a></li>';
          }
        ?>
        
        
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>