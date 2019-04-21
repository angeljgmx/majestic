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
        $_SESSION['nav_noticias'] = ($current == "noticias") ? ' class="active"' : "";
        $_SESSION['nav_eventos'] = ($current == "eventos") ? ' class="active"' : "";
        $_SESSION['nav_platos'] = ($current == "platos") ? ' class="active"' : "";
        $_SESSION['nav_contacto'] = ($current == "contacto") ? ' class="active"' : "";
                
        // Control de errores
        $debug = DEBUG;
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        
        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion();
        
        ?>
        <div class="navigation"> 
            <strong class="logo">
                <a href="<?php echo $path."app/inicio.php"; ?>">
                    <img width="200" src="<?php echo $path."uploads/imagenes/logo/".$_SESSION['pref_logh']; ?>" alt="<?php echo $_SESSION['cont_nomb']; ?>">
                </a>
            </strong>
            <nav class="navbar navbar-inverse">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav" id="nav">
                        <li class="active"><a href="<?php echo $path."app/inicio.php"; ?>">Inicio</a></li>
                        <li><a href="<?php echo $path."app/eventos.php"; ?>">Eventos</a></li>
                        <li class="logo-col"></li>
                        <li><a href="<?php echo $path."app/contacto.php"; ?>">Contacto</a></li>
                    </ul>
                </div>
            </nav>
      </div>
        
        
        
    <?php
    }