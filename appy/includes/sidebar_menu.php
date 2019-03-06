
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


    function SideBarMenu($path, $current, $config){
        
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

        <!--SIDEBAR MENU START-->
        <div id="tl_side-menu"> <a href="bartender.html#" id="tl-close-btn" class="crose"><i class="fa fa-close"></i></a>
            <div class="content mCustomScrollbar">
                <div id="content-1" class="content">
                    <div class="tl_side-navigation">
                        <nav>
                            <ul class="navbar-nav">
                                <li class="active"><a href="index.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Home<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="index.html">Home 1</a></li>
                                        <li><a href="index-2.html">Home 2</a></li>
                                    </ul>
                                </li>
                                <li><a href="http://themelooper.com/html/jz/job-seekers.html">About</a></li>
                                <li><a href="http://themelooper.com/html/jz/employers.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Event<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="event.html">Event</a></li>
                                        <li><a href="event-detail.html">Event Detail</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="menu.html">Menu</a></li>
                                <li class="dropdown"><a href="bartender.html#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Gallery<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="gallery-2-col.html">Gallery 2 Col</a></li>
                                        <li><a href="gallery-masonry.html">Gallery Masnory</a></li>
                                    </ul>
                                </li>
                                <li><a href="http://themelooper.com/html/jz/jobs.html" data-toggle="dropdown" role="button" aria-expanded="false">Bartender<span class="caret"></span></a>
                                    <ul  class="dropdown-menu" role="menu">
                                        <li><a href="bartender.html">Bartender</a></li>
                                        <li><a href="bartender-detailhtml.html">Bartender Detail</a></li>
                                    </ul>
                                </li>
                                <li><a href="http://themelooper.com/html/jz/companies.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Blog<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-detail.html">Blog Detail</a></li>
                                    </ul>
                                </li>
                                <li><a href="404.html">Error 404</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="sidebar-social">
                <ul>
                    <li><a href="bartender.html#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                    <li><a href="bartender.html#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    <li><a href="bartender.html#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                    <li><a href="bartender.html#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                    <li><a href="bartender.html#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                    <li><a href="bartender.html#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
        <!--SIDEBAR MENU END--> 
        
        
        
    <?php
    }
