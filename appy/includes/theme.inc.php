<?php

    /* Kamila */

//=============================================================================================================================================================================================//

    // Definicion de la cabecera HTML de las paginas
    function HeaderHTML($path, $page_title, $meta, $css, $js, $config){
        
         // Librerias requeridas
        require_once $path.'core/db.class.core.php';
        require_once $path.'core/modals.core.php';
        require_once $path.'includes/config.inc.php';
        require_once $path.'app/includes/init_common.inc.php';
               
        // Control de errores
        $debug = DEBUG; 

        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion();
        
        // Inicializaion de información comun
        InitCommon($path);
       
        // Meta - keywords
        if ((isset($config['meta_keywords'])) && ($config['meta_keywords'] != "")){
            $keywords = $_SESSION['pref_keyw']." ".$config['meta_keywords'];
        }
        else {
            $keywords = "";
        }
        
        $author = "Angel Garcia";
        
        // Meta - description
        if ((isset($config['meta_description'])) && ($config['meta_description'] != "")){
            $description = $config['meta_description'];
        }
        else {
            $description = $_SESSION['pref_desc'];
        }    
        ?>

        <!DOCTYPE html>
        <!--[if lt IE 10]> <html  lang="en" class="iex"> <![endif]-->
        <!--[if (gt IE 10)|!(IE)]><!-->
        <html lang="en">
            <!--<![endif]-->
            <head>
                
                <!-- Meta Tags -->
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="description" content="<?php echo $description; ?>" />
                <meta name="keywords" content="<?php echo $keywords; ?>" />
                <meta name="author" content="<?php echo $author; ?>" />
                <?php echo $meta; ?>
                
                <!-- Librerias JS -->
                <script src="<?php echo $path."app/"; ?>scripts/jquery-2.1.4.min.js"></script>
                <script src="<?php echo $path."app/"; ?>scripts/script.js"></script>
                <?php 
                    // Scripts js adicionales
                    echo $js; 
                ?>
                
                <!-- Favicon and Touch Icons -->
                <link href="<?php echo $path."app/"; ?>images/favicon.png" rel="shortcut icon" type="image/png">
                <link href="<?php echo $path."app/"; ?>images/apple-touch-icon.png" rel="apple-touch-icon">
                <link href="<?php echo $path."app/"; ?>images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
                <link href="<?php echo $path."app/"; ?>images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
                <link href="<?php echo $path."app/"; ?>images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

                <!-- Stylesheet -->
                <link rel="stylesheet" href="<?php echo $path."app/"; ?>scripts/bootstrap/css/bootstrap.css">
                <link rel="stylesheet" href="<?php echo $path."app/"; ?>css/components.css">
                <link rel="stylesheet" href="<?php echo $path."app/"; ?>css/image-box.css">
                <link rel="stylesheet" href="<?php echo $path."app/"; ?>css/content-box.css">
                <link rel="stylesheet" href="<?php echo $path."app/"; ?>scripts/magnific-popup.css"> 
                <link rel="stylesheet" href="<?php echo $path."app/"; ?>scripts/flexslider/flexslider.css">
                <link rel="stylesheet" href="<?php echo $path."app/"; ?>style.css">
                <link rel="stylesheet" href="<?php echo $path."app/"; ?>scripts/font-awesome/css/font-awesome.min.css">
                <link rel="stylesheet" href="<?php echo $path."app/"; ?>scripts/flaticon/flaticon.css">
                <link rel="stylesheet" href="<?php echo $path."app/"; ?>css/animations.css">
                <!-- Estilos adicionales -->
                <link rel="stylesheet" type="text/css" href="<?php echo $path."app/"; ?>css/custom-bootstrap.css">
                <link rel="stylesheet" type="text/css" href="<?php echo $path."app/"; ?>css/custom.css">

                <?php 
                    // Hojas de stilo adicionales
                    echo $css; 
                ?>
            
                <!-- google font CSS-->
                   
                <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700' rel='stylesheet' type='text/css'>
                <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
                <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
                <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600" rel="stylesheet">

                <!-- Page Title -->
                <title><?php echo $page_title; ?></title>

                <!--[if lt IE 9]>
                    <script src="<?php echo $path."app/"; ?>js/html5shiv.min.js"></script>
                    <script src="<?php echo $path."app/"; ?>js/respond.min.js"></script>
                <![endif]-->
            </head>
<?php
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//        
        
        // Pagina Actual
        $_SESSION['pgna_actl'] = basename($_SERVER['PHP_SELF']);
        //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//        // Aviso inicio de session           
//        if (isset($_GET['sson_mnsg'])){
//
//            if ($_GET['sson_mnsg'] == "success"){
//                $modal_alert_type = "success";
//                $modal_message = "Usted a iniciado sesi&oacute;n en nuestro sistema exitosamente";
//            }
//            if ($_GET['sson_mnsg'] == "error"){
//                $modal_alert_type = "error";
//                $modal_message = "Ocurrio un problema y no ha podido iniciar sesi&oacute;n en nuestro sistema. Verifique su direcci&oacute;n de correo y su contrase&ntilde;a y pruebe nuevamente";
//            }
//            if ($_GET['sson_mnsg'] == "info"){
//                $modal_alert_type = "info";
//                $modal_message = "Ha cerrado su sesi&oacute;n exitosamente en nuestro sistema. Si desea realizar una nueva operaci&oacute;n deber&aacute; iniciar sesi&oacute;n nuevamente";
//            }
//                    
//                $modal_title = "Inicio de sesi&oacute;n";
//                $modal_config = "";
//                ModalMessage($modal_title, $modal_alert_type, $modal_message, $modal_config);
//        }
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
            
            // Aviso al inicio
            $_SESSION['fecha_actual'] = date("d-m-Y");

            $sql_avso = "SELECT * FROM tbla_avso WHERE (avso_estd = '1') AND (avso_fini  <= '".date("Y\-m\-d", strtotime($_SESSION['fecha_actual']))."') AND (avso_ffin  >= '".date("Y\-m\-d", strtotime($_SESSION['fecha_actual']))."')";
            $consulta_avso = $conec->dbQuery($sql_avso, $debug);
            $exite_aviso = $conec->dbNumRows($consulta_avso);

            // Pagina actual
            $pagina = basename($_SERVER['PHP_SELF']);

            if (($exite_aviso == 1) AND ($pagina == "index.php")){

                // Datos del aviso
                $datos_avso = $conec->dbFetchObjet($consulta_avso);
                $_SESSION['avso_imgn'] = $datos_avso->avso_imgn;
                $_SESSION['avso_exst'] = TRUE;

                // Inclusion del css del shadowbox
                echo "<link rel=\"stylesheet\" href=\"".$path."assets/global/plugins/shadowbox/shadowbox.css\" type=\"text/css\" media=\"screen\" /> \n";  
            }
            else {
                 $_SESSION['avso_exst'] = FALSE;
            }
    }
//=============================================================================================================================================================================================//

    function BodyBegin($path){
        ?>
        <body>
        <?php
        include_once $path."app/includes/analyticstracking.php";
    }
//=============================================================================================================================================================================================//
    
    function PageHeader($path, $current){
        
        // Inclusion de la funcion de navegacion
        include $path.'app/includes/navigation.inc.php';
        include $path.'app/includes/sidebar_menu.php';
        $config = [];
        ?>

        <header class="fixed-top scroll-change" data-menu-anima="fade-left">
            <div class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="navbar-main navbar-middle">
                    <div class="container">
                        <div class="scroll-hide">
                            <div class="container">
                                <a class="navbar-brand center" href="<?php echo $path."app/index.php"; ?>">
                                    <img width="250" src="<?php echo $path."uploads/imagenes/logo/".$_SESSION['pref_logh']; ?>" alt="logo" />
                                </a>
                            </div>
                        </div>
                        <div class="navbar-header">
                            <a class="navbar-brand" href="<?php echo $path."app/"; ?>index.html">
                                <img src="<?php echo $path."uploads/imagenes/logo/".$_SESSION['pref_logh']; ?>" alt="logo" />
                            </a>
                            <button type="button" class="navbar-toggle">
                                <i class="fa fa-bars"></i> 
                            </button>
                        </div>
                        <?php
                            Navigation($path, $current, $config);
                        ?>
                    </div>
                </div>
            </div>
        </header>
     <?php       
    }
//=============================================================================================================================================================================================//

    
    function PageTitle($path, $page_title){
        // Inclusion de la clase para el breadcrumbs
        include $path.'core/breadcrumbs.class.core.php';

        // Inicializacion de la clase
        $breadcrumb = new breadcrumb;

        // Removemos el directorio para que no se muestre
        $breadcrumb->removeDirs = array ("adms", "public", "user", "app");

        // No mostramos la extencion del archivo
        $breadcrumb->hideFileExt = TRUE;

        // Primera letra en mayusculas para los elementos del breadcrumbs
        $breadcrumb->dirformat='ucfirst';

        // Cambiamos "_" por "" en los nombres de los elementos
        $breadcrumb->_toSpace = TRUE;
        
        // Clase Css
        $breadcrumb->cssClass = "text-color-kamila";

        ?>
        <div class="header-title ken-burn" data-parallax="scroll" data-position="top" data-natural-height="705" data-natural-width="1620" data-image-src="images/title-3.jpg">
            <div class="container">
                <div class="title-base">
                    <h1 class="text-xl"><?php echo $page_title; ?></h1>
                    <hr />
                    <ol class="breadcrumb">
                        <?php echo $breadcrumb->show_breadcrumb(); ?>
                    </ol>
                </div>
            </div>
        </div>
        <?php
    }
//=============================================================================================================================================================================================//
              
    function ContentBegin(){
        ?>
        <div class="section-empty text-center">
            <div class="container content">
        <?php
    }
//=============================================================================================================================================================================================//

    function ContentEnd(){
        ?>
            </div>
        </div>
        <?php
    }
//=============================================================================================================================================================================================//
   
//=============================================================================================================================================================================================//
    
    function Footer($path){

        // Librerias requeridas
        require_once $path.'app/includes/core.app.php';
        CoreApp($path);
        require_once $path.'includes/config.inc.php';

        // Control de errores
        $debug = DEBUG; 

        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion(); 

        $sql_twtr = "SELECT rdsc_user FROM tbla_rdsc WHERE rdsc_nomb = 'Twitter'";
        $query_twtr = $conec->dbQuery($sql_twtr, $debug);
        $user_twtr = $conec->dbFetchObjet($query_twtr);

        //$user = $user_twtr->rdsc_user;
        $count = 2;
        //$string = LastTweets($path, $user, $count);

        // Redes Sociales
        $sql_rdsc= "SELECT * FROM tbla_rdsc WHERE rdsc_estd = 1"; 
        $query_rdsc = $conec->dbQuery($sql_rdsc, $debug); 

        ?>
            <!-- footer -->
        <div class="footer-section section-bg-animation header-animation">
            <div id="anima-layer-a" class="anima-layer fog-1"></div>
            <div id="anima-layer-b" class="anima-layer fog-2"></div>
            <div class="container content overlay-content text-center">
                <hr class="space" />
                <hr class="h" />
                <h1>GET IN TOUCH</h1>
                <p class="text-bold">
                    47 Chandos Place, London, WC2N 4HS
                </p>
                <hr class="space s" />
                <a class="anima-button circle-button btn-sm" href="contacts.html"><i class="fa fa-map-marker"></i>Locate us on map </a>
            </div>
        </div>
        <footer>
            <div class="container pt-20 pb-0">
                <div class="row">
                    <div class="col-md-8">
                        <div class="copy-row">
                            <div class="tag-row">
                                <span>Copyright © 2016</span>
                                <span>47 Chandos Place London WC2N 4HS</span>
                                <span>020 7836 0291</span>
                                <span>info@soundoflondon.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <div class="btn-group social-group">
                            <a target="_blank" href="products.html#"><i class="fa fa-facebook"></i></a>
                            <a target="_blank" href="products.html#"><i class="fa fa-twitter"></i></a>
                            <a target="_blank" href="products.html#"><i class="fa fa-instagram"></i></a>
                            <a target="_blank" href="products.html#"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>        
    <?php
    }
//=============================================================================================================================================================================================//
    
    function ScriptsJS($path, $sjs){
        ?>
        <script async src="<?php echo $path."app/"; ?>scripts/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo $path."app/"; ?>scripts/imagesloaded.min.js"></script>
        <script src='<?php echo $path."app/"; ?>scripts/parallax.min.js'></script>
        <script src='<?php echo $path."app/"; ?>scripts/flexslider/jquery.flexslider-min.js'></script>
        <script src='<?php echo $path."app/"; ?>scripts/jquery.progress-counter.js'></script>
        <script src='<?php echo $path."app/"; ?>scripts/jquery.twbsPagination.min.js'></script>
        <script src='<?php echo $path."app/"; ?>scripts/isotope.min.js'></script>
        <script src='<?php echo $path."app/"; ?>scripts/jquery.magnific-popup.min.js'></script>
        <script src='<?php echo $path."app/"; ?>scripts/jquery.tab-accordion.js'></script>
        <script src='<?php echo $path."app/"; ?>scripts/jquery.spritely.min.js'></script>
        <script src="<?php echo $path."app/"; ?>scripts/smooth.scroll.min.js"></script>      
        
        <script type="text/javascript">
            $(document).ready(function(){
            $("#basic").modal('show');
            });
        </script>
        <?php 
        echo $sjs;
    }
//=============================================================================================================================================================================================//
    
    function BodyEnd(){
        ?>
            </body>
        </html>
        <?php
    }    
//=============================================================================================================================================================================================//
    
    function CommonHeader($path, $page_title, $meta, $css, $js, $current, $config){
        HeaderHTML($path, $page_title, $meta, $css, $js, $config);
        BodyBegin($path);
        PageHeader($path, $current);
        PageTitle($path, $page_title);
        ContentBegin();
    }
//=============================================================================================================================================================================================//

    function CommonFooter($path, $sjs, $config){
        ContentEnd();
        Footer($path);
        ScriptsJS($path, $sjs);
        BodyEnd();
    }
//=============================================================================================================================================================================================//

    ?>
