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
        <html lang="en">
            <head>
                
                <!-- Meta Tags -->
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="description" content="<?php echo $description; ?>" />
                <meta name="keywords" content="<?php echo $keywords; ?>" />
                <meta name="author" content="<?php echo $author; ?>" />
                <?php echo $meta; ?>
                
                <!-- Favicon and Touch Icons -->
                <link href="<?php echo $path."app/"; ?>images/favicon.png" rel="shortcut icon" type="image/png">
                <link href="<?php echo $path."app/"; ?>images/apple-touch-icon.png" rel="apple-touch-icon">
                <link href="<?php echo $path."app/"; ?>images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
                <link href="<?php echo $path."app/"; ?>images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
                <link href="<?php echo $path."app/"; ?>images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

                <!-- Stylesheet -->
                <link href="<?php echo $path."app/"; ?>css/style.css" rel="stylesheet" type="text/css">
                <!--BOOTSTRAP CSS-->
                <link href="<?php echo $path."app/"; ?>css/bootstrap.css" rel="stylesheet" type="text/css">
                <!--THEME COLOR CSS-->
                <link href="<?php echo $path."app/"; ?>css/theme_color.css" rel="stylesheet" type="text/css">
                <!---Responsive CSS-->
                <link href="<?php echo $path."app/"; ?>css/responsive_query.css" rel="stylesheet">
                <!---Owl Carousel CSS-->
                <link href="<?php echo $path."app/"; ?>css/owl.carousel.css" rel="stylesheet">
                <!--FONTAWESOME CSS-->
                <link href="<?php echo $path."app/"; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
                <!---PrettyPhoto CSS-->
                <link href="<?php echo $path."app/"; ?>css/prettyPhoto.css" rel="stylesheet">
             
                <link href="<?php echo $path."app/"; ?>fonts/flaticons/flaticon.css" rel="stylesheet" >
                
                <!-- Estilos adicionales -->
<!--                <link rel="stylesheet" type="text/css" href="<?php echo $path."app/"; ?>plugins/tooltipster-master/tooltipster/dist/css/tooltipster.bundle.min.css" />-->
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
                
                <!-- Librerias JS -->
                <?php 
                    // Scripts js adicionales
                    echo $js; 
                ?>

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
        
    }
//=============================================================================================================================================================================================//

    function WrapperBegin(){
        ?>
            <div id="wrapper"> 
        <?php
    }
//=============================================================================================================================================================================================//
    
    function PageHeader($path, $current){
        
        // Inclusion de la funcion de navegacion
        include $path.'app/includes/navigation.inc.php';
        include $path.'app/includes/sidebar_menu.php';
        $config = [];
        ?>
        
        <header id="header"> 
            <!-- Navigation Row Start -->
            <div class="container">
                <div class="top-bar"> <strong class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> open at : 6 pm  to  2 am</strong>
                    <div class="top-social"> <strong class="title"><span class="color_gold"><i class="fa fa-user font-16"></i>&nbsp; <?php echo $_SESSION['user_nmap']; ?></span></strong>
                        <ul>
                            <li><a href="<?php echo $_SESSION['fcbk_link'];?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="<?php echo $_SESSION['twet_link'];?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="<?php echo $_SESSION['inst_link'];?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="navigation"> 
                    <strong class="logo"><a href="<?php echo $path."app/inicio.php"; ?>"><img width="200" src="<?php echo $path."uploads/imagenes/logo/".$_SESSION['pref_logh']; ?>" alt="<?php echo $_SESSION['cont_nomb']; ?>"</a></strong>
                    <?php
                    Navigation($path, $current, $config);
                    ?>
                    <div class="top-right-box">
                        <div class="burger-nav">
                            <div class="tl-burger-nav">
                                <!--<div id="tl_side-menu-btn" class="cp_side-menu"><a href="bartender.html#" class=""><i class="fa fa-align-justify" aria-hidden="true"></i></a></div>-->

                                    <?php
                                    SideBarMenu($path, $current, $config);
                                    ?>

                            </div>
                        </div>
<!--                        <div class="tl_search_holder">
                            <button id="trigger-overlay" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>-->
                    </div>
                </div>
            </div>

            <!--Navigation Row End--> 

            <!--Search Bar Holder Start-->
            <div class="overlay overlay-contentscale">
                <button type="button" class="overlay-close">Close</button>
                <div class="tl_search_inner">
                    <form method="get">
                        <input type="text" placeholder="Enter your search" required>
                        <button class="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <!--Search Bar Holder End--> 
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
        <!--Inner BANNER-->
        <div id="inner-banner" class="inner-banner-bg-3">
            <div class="container">
                <h1><?php echo $page_title; ?></h1>
                <ol class="breadcrumb">
                    <?php echo $breadcrumb->show_breadcrumb(); ?>
                </ol>
            </div>
        </div>
        <!--Inner BANNER--> 

        <?php
    }
//=============================================================================================================================================================================================//
    
    function MainBegin(){
        ?>
        <!--Main-->
        <div id="main"> 
        <?php
    }
//=============================================================================================================================================================================================//
            
    function ContentBegin(){
        ?>
        <section class="about-section">
            <div class="container">
        <?php
    }
//=============================================================================================================================================================================================//

    function ContentEnd(){
        ?>
            </div>
        </section>
        <?php
    }
//=============================================================================================================================================================================================//

    function Newsletter(){
        ?>
        <section class="newsletter">
            <div class="container">
                <div class="row">
                    <div class="col-md-6"> <strong class="title">Get Updates </strong>
                        <h2>Stay In Touch With Updates</h2>
                    </div>
                    <div class="col-md-6">
                        <form action="bartender.html#">
                            <input type="text" required>
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
//=============================================================================================================================================================================================//
    
    function MainEnd(){
        ?>
            </div>
      <!--Main-->
      <?php
    }
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

        ?>
        <!-- footer -->
        <footer id="footer"> <strong class="footer-logo"><a href="index.html"><img src="images/logo.png" alt=""></a></strong>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <address>
                            <p><span>Call us</span> +01 315 0006 565</p>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <address>
                            <p><span>Address</span> Canal View Socity JzStreet La 0005846</p>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <address>
                            <p><span>Email</span> <a href="mailto:">support@jzpub.com</a></p>
                        </address>
                    </div>
                </div>
                <strong class="copyrights">Jz Pub &copy; 2016 All Rights Reserved <a href="bartender.html#">Terms of Use</a> and <a href="bartender.html#">Privacy Policy</a></strong>
                <div class="footer-social">
                    <ul>
                        <li><a href="bartender.html#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="bartender.html#"><i class="fa fa-tripadvisor" aria-hidden="true"></i></a></li>
                        <li><a href="bartender.html#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    <?php
    }
//=============================================================================================================================================================================================//

    function WrapperEnd(){
        ?>
            </div>
        <?php
    }
//=============================================================================================================================================================================================//
    
    function ScriptsJS($path, $sjs){
        ?>
        <!---JQuery-1.11.3.js--> 
        <script type="text/javascript" src="<?php echo $path."app/"; ?>js/jquery-1.11.3.min.js"></script> 
        <!---Bootstrap.js--> 
        <script type="text/javascript" src="<?php echo $path."app/"; ?>js/bootstrap.min.js"></script> 
        <!---Owl Carousel.js--> 
        <script type="text/javascript" src="<?php echo $path."app/"; ?>js/owl.carousel.min.js"></script> 
        <!---Modernizr Script.js--> 
        <script type="text/javascript" src="<?php echo $path."app/"; ?>js/modernizr.custom.js"></script> 
        <!---Search Script.js--> 
        <script type="text/javascript" src="<?php echo $path."app/"; ?>js/search_script.js"></script>
        <!---PrettyPhoto.js--> 
        <script type="text/javascript" src="<?php echo $path."app/"; ?>js/jquery.prettyPhoto.js"></script> 
        <!--COUNTER EVENT--> 
        <script type="text/javascript" src="<?php echo $path."app/"; ?>js/jquery.countdown.min.js"></script> 
        
<!--        <script type="text/javascript" src="<?php echo $path."app/"; ?>plugins/tooltipster-master/dist/js/tooltipster.bundle.min.js"></script>  -->

        <!---Custom Script.js--> 
        <script src="<?php echo $path."app/"; ?>js/custom_script.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
            $("#basic").modal('show');
            });
        </script>
        <script>
        $(document).ready(function() {
            $('.tooltip').tooltipster();
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
        WrapperBegin();
        PageHeader($path, $current);
        PageTitle($path, $page_title);
        MainBegin();
        //ContentBegin();
    }
//=============================================================================================================================================================================================//

    function CommonFooter($path, $sjs, $config){
        //ContentEnd();
        //Newsletter();
        MainEnd();
        Footer($path);
        WrapperEnd();
        ScriptsJS($path, $sjs);
        BodyEnd();
    }
//=============================================================================================================================================================================================//

    ?>
