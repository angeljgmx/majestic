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
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav no-margins">
                <li><a href="index.html">Home</a></li>
                <li class="dropdown">
                    <a href="events.html" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Events <i class="caret"></i></a>
                    <ul class="dropdown-menu multi-level">
                        <li><a href="events.html">All events</a></li>
                        <li><a href="single-event.html">Single event</a></li>
                        <li><a href="single-event-big.html">Big single event</a></li>
                    </ul>
                </li>
                <li><a href="gallery.html">Gallery</a></li>
                <li class="scroll-show"><a href="index.html"><img src="images/logo-small.png" alt="logo"></a></li>
                <li><a href="products.html">Products</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="contacts.html">Contacts</a></li>
            </ul>
        </div>
        <!-- ./main menu -->
    <?php
    }