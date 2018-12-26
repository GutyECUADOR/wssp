    <div class="sidebar-left">
        <!-- Bloque perfil de usuario-->
        <div class="container-menu">
        <h5 class="tituloh5">Perfil de Usuario</h5>    
            <div>
                <img class="imagenusuario" src="<?PHP 
                    if ($_SESSION['user_pic']!='')
                    {echo $_SESSION['user_pic'];
                    }else
                    {echo '../ws-cargaimagen/fotos/photo-nouser.jpg';}    

                ?>" alt="USR">
            </div>

            <div class="infousuario">
                <span class="textperfilusuario">
                <?PHP echo 'Bienvenido, '.$_SESSION['user_autentificado'];
                      echo '</br>CI: '.$_SESSION['user_ruc'];
                      echo '</br> Acceso: '.$_SESSION['user_lv'];
                ?>

                </span>
            </div>

        <div class="footer"></div>

        </div>
        <!-- Bloque Menus-->
        <div class="container-menu">  
        <nav id="evanfitriones">
        <h5 class="tituloh5">Menú Principal</h5>
            <ul class="menu">
                <?PHP 
                include '../ws-admin/build_menuleft.php';
                ?> 
            </ul>
            <div class="footer">Todos los derechos reservados © 2017 - <?php echo date('Y')?>, <?php echo 'Ver ' .APP_VERSION?></div>
        </nav>
        </div>
    </div>