<?php
    /****************************************/
    /* UNET-FOST                                         
    /* MAYO 2018
     * Aplicacion desarrollada por UNET-CETI
     * Email: ajgarcia@unet.edu.ve
     *        jhernandez@unet.edu.ve
     */                       
    /****************************************/
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//


    function Navigation($path, $current, $config){
        
        // Archivos requeridos
        require_once $path.'core/db.class.core.php';
        include_once $path.'includes/config.inc.php'; 
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        
        // Clase para la pagina actual
        $_SESSION['nav_inicio'] = ($current == "inicio") ? ' class="active"' : "";
        $_SESSION['nav_sobre_nosotros'] = ($current == "empresa") ? ' class="active"' : "";
        $_SESSION['nav_noticias'] = ($current == "noticias") ? ' class="active"' : "";
        $_SESSION['nav_eventos'] = ($current == "eventos") ? ' class="active"' : "";
        $_SESSION['nav_contacto'] = ($current == "contacto") ? ' class="active"' : "";
                
        // Control de errores
        $debug = DEBUG;
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        
        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion();
        
        // Eventos
//        $sql_evnt = "SELECT id, evnt_nomb, evnt_estd, evnt_freg "
//            ."FROM tbla_evnt "
//            ."WHERE evnt_estd = 1 "
//            ."ORDER BY evnt_freg ASC";
//        $query_evnt = $conec->dbQuery($sql_evnt, $debug);
        
        ?>    

        <!-- main menu-->
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav" id="nav">
                    <li class="active"><a href="<?php echo $path."app/inicio.php"; ?>">Inicio</a></li>
                    <li><a href="<?php echo $path."app/eventos.php"; ?>">Eventos</a></li>
                    <li class="logo-col"></li>
                    <li><a href="menu.html">menu</a></li>
                    <li><a href="contact.html">Contacto</a></li>
                </ul>
            </div>
        </nav>
        <!-- ./main menu -->
        
        
        
    <?php
    }