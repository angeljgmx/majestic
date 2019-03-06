<?php

    /****************************************/
    /* Theme de la aplicacion                                          
    /* Febrero 2017
     * Aplicacion desarrollada por Angel Garcia
     * Email: angel.j.garcia.m@gmail.com                       
    /****************************************/

//=============================================================================================================================================================================================//

    // Definicion de la cabecera HTML de las paginas
    function HeaderHTML($path, $page_title, $meta, $css, $js, $config){
        
         // Librerias requeridas
        require_once $path.'core/db.class.core.php';
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
        
        $autor = "Centro de Estudios en Teleinform&aacute;tica - UNET";
        
        // Meta - description
        if ((isset($config['meta_description'])) && ($config['meta_description'] != "")){
            $description = $config['meta_description'];
        }
        else {
            $description = $_SESSION['pref_desc'];
        }    
        ?>

        <!DOCTYPE html>
        <html dir="ltr" lang="en">
            <head>

                <!-- Meta Tags -->
                <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
                <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
                <meta name="description" content="<?php echo $description; ?>" />
                <meta name="keywords" content="<?php echo $keywords; ?>" />
                <meta name="author" content="<?php echo $autor; ?>" />

                <!-- Page Title -->
                <title><?php echo $page_title; ?></title>

                <!-- Favicon and Touch Icons -->
                <link href="images/favicon.png" rel="shortcut icon" type="image/png">
                <link href="images/apple-touch-icon.png" rel="apple-touch-icon">
                <link href="images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
                <link href="images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
                <link href="images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

                <!-- Stylesheet -->
                <link href="<?php echo $path."app/"; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
                <link href="<?php echo $path."app/"; ?>css/jquery-ui.min.css" rel="stylesheet" type="text/css">
                <link href="<?php echo $path."app/"; ?>css/animate.css" rel="stylesheet" type="text/css">
                <link href="<?php echo $path."app/"; ?>css/css-plugin-collections.css" rel="stylesheet"/>
                <!-- CSS | menuzord megamenu skins -->
                <link href="<?php echo $path."app/"; ?>css/menuzord-megamenu.css" rel="stylesheet"/>
                <link id="menuzord-menu-skins" href="css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
                <!-- CSS | Main style file -->
                <link href="<?php echo $path."app/"; ?>css/style-main.css" rel="stylesheet" type="text/css">
                <!-- CSS | Preloader Styles -->
                <link href="<?php echo $path."app/"; ?>css/preloader.css" rel="stylesheet" type="text/css">
                <!-- CSS | Custom Margin Padding Collection -->
                <link href="<?php echo $path."app/"; ?>css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
                <!-- CSS | Responsive media queries -->
                <link href="<?php echo $path."app/"; ?>css/responsive.css" rel="stylesheet" type="text/css">
                <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
                <!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->

                <!-- Revolution Slider 5.x CSS settings -->
                <link  href="<?php echo $path."app/"; ?>js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css"/>
                <link  href="<?php echo $path."app/"; ?>js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css"/>
                <link  href="<?php echo $path."app/"; ?>js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css"/>

                <!-- CSS | Theme Color -->
                <link href="css/colors/theme-skin-color-set1.css" rel="stylesheet" type="text/css">

                <!-- external javascripts -->
                <script src="<?php echo $path."app/"; ?>js/jquery-2.2.4.min.js"></script>
                <script src="<?php echo $path."app/"; ?>js/jquery-ui.min.js"></script>
                <script src="<?php echo $path."app/"; ?>js/bootstrap.min.js"></script>
                <!-- JS | jquery plugin collection for this theme -->
                <script src="<?php echo $path."app/"; ?>js/jquery-plugin-collection.js"></script>

                <!-- Revolution Slider 5.x SCRIPTS -->
                <script src="<?php echo $path."app/"; ?>js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
                <script src="<?php echo $path."app/"; ?>js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

                <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
                <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->
            </head>
            
            
        <?php    
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//        
        
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
        <body class="">
        <?php
        include_once $path."app/includes/analyticstracking.php";
    }
//=============================================================================================================================================================================================//

    function WrapperBegin(){
        ?>
        <div id="wrapper" class="clearfix">
        <?php
    }
//=============================================================================================================================================================================================//

    function PageHeader($path){
        ?>
        <header id="header" class="header">
            <div class="header-top bg-theme-colored2 sm-text-center">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="widget text-white">
                      <ul class="list-inline xs-text-center text-white">
                        <li class="m-0 pl-10 pr-10"> <a href="#" class="text-white"><i class="fa fa-phone text-white"></i> 123-456-789</a> </li>
                        <li class="m-0 pl-10 pr-10"> 
                          <a href="#" class="text-white"><i class="fa fa-envelope-o text-white mr-5"></i> contact@yourdomain.com</a> 
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-4 pr-0">
                    <div class="widget">
                      <ul class="styled-icons icon-sm pull-right flip sm-pull-none sm-text-center mt-5">
                        <li><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus text-white"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram text-white"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <ul class="list-inline sm-pull-none sm-text-center text-right text-white mb-sm-20 mt-10">
                      <li class="m-0 pl-10"> <a href="ajax-load/login-form.html" class="text-white ajaxload-popup"><i class="fa fa-user-o mr-5 text-white"></i> Login /</a> </li>
                      <li class="m-0 pl-0 pr-10"> 
                        <a href="ajax-load/register-form.html" class="text-white ajaxload-popup"><i class="fa fa-edit mr-5"></i>Register</a> 
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="header-middle p-0 bg-lightest xs-text-center">
              <div class="container pt-20 pb-20">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-4">
                    <a class="menuzord-brand pull-left flip sm-pull-center mb-15" href="index-mp-layout1.html"><img src="images/logo-wide.png" alt=""></a>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="row">
                      <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="widget no-border sm-text-center mt-10 mb-10 m-0">
                          <i class="pe-7s-headphones text-theme-colored2 font-48 mt-0 mr-15 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>
                          <a href="#" class="font-12 text-gray text-uppercase">Call us for more details</a>
                          <h5 class="font-13 text-black m-0"> +(012) 345 6789</h5>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="widget no-border sm-text-center mt-10 mb-10 m-0">
                          <i class="pe-7s-mail-open text-theme-colored2 font-48 mt-0 mr-15 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>
                          <a href="#" class="font-12 text-gray text-uppercase">Call us for more details</a>
                          <h5 class="font-13 text-black m-0"> +(012) 345 6789</h5>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="widget no-border sm-text-center mt-10 mb-10 m-0">
                          <i class="pe-7s-map-marker text-theme-colored2 font-48 mt-0 mr-15 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>
                          <a href="#" class="font-12 text-gray text-uppercase">Company Location</a>
                          <h5 class="font-13 text-black m-0"> 121 King Street, Melbourne</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="header-nav">
              <div class="header-nav-wrapper navbar-scrolltofixed bg-white">
                <div class="container">
                  
                    <?php
                        include_once $path.'app/includes/navigation.php';
                    ?>
                </div>
              </div>
            </div>
          </header>    
        <?php
    }
//=============================================================================================================================================================================================//
  
    function MainContentBegin(){
        ?>
        <!-- Start main-content -->
        <div class="main-content">
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
        
        ?>
        <!-- Section: inner-header -->
        <section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="<?php echo $path."app/"; ?>images/bg/bg1.jpg">
          <div class="container pt-120 pb-60">
            <!-- Section Content -->
            <div class="section-content">
              <div class="row"> 
                <div class="col-md-6">
                  <h2 class="text-theme-colored2 font-36"><?php echo $page_title; ?></h2>
                  <ol class="breadcrumb text-left mt-10 white">
                    <?php echo $breadcrumb->show_breadcrumb(); ?>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </section>    
        <?php
    }
//=============================================================================================================================================================================================//
    
    
    
    function Footer($path){
        ?>
        <!-- Footer -->
        <footer id="footer" class="footer" data-bg-color="#212331">
          <div class="container pt-70 pb-40">
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                  <img class="mt-5 mb-20" alt="" src="images/logo-white-footer.png">
                  <p>203, Envato Labs, Behind Alis Steet, Melbourne, Australia.</p>
                  <ul class="list-inline mt-5">
                    <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">123-456-789</a> </li>
                    <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">contact@yourdomain.com</a> </li>
                    <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">www.yourdomain.com</a> </li>
                  </ul>            
                  <ul class="styled-icons icon-sm icon-bordered icon-circled clearfix mt-10">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-vk"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                  <h4 class="widget-title line-bottom-theme-colored-2">Useful Links</h4>
                  <ul class="angle-double-right list-border">
                    <li><a href="#">Home Page</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Our Mission</a></li>
                    <li><a href="#">Terms and Conditions</a></li>
                    <li><a href="#">FAQ</a></li>              
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                  <h4 class="widget-title line-bottom-theme-colored-2">Top News</h4>
                  <div class="latest-posts">
                    <article class="post media-post clearfix pb-0 mb-10">
                      <a class="post-thumb" href="#"><img src="https://placehold.it/80x55" alt=""></a>
                      <div class="post-right">
                        <h5 class="post-title mt-0 mb-5"><a href="#">PHP Learning</a></h5>
                        <p class="post-date mb-0 font-12">Mar 08, 2015</p>
                      </div>
                    </article>
                    <article class="post media-post clearfix pb-0 mb-10">
                      <a class="post-thumb" href="#"><img src="https://placehold.it/80x55" alt=""></a>
                      <div class="post-right">
                        <h5 class="post-title mt-0 mb-5"><a href="#">Web Development</a></h5>
                        <p class="post-date mb-0 font-12">Mar 08, 2015</p>
                      </div>
                    </article>
                    <article class="post media-post clearfix pb-0 mb-10">
                      <a class="post-thumb" href="#"><img src="https://placehold.it/80x55" alt=""></a>
                      <div class="post-right">
                        <h5 class="post-title mt-0 mb-5"><a href="#">Spoken English</a></h5>
                        <p class="post-date mb-0 font-12">Mar 08, 2015</p>
                      </div>
                    </article>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                  <h4 class="widget-title line-bottom-theme-colored-2">Opening Hours</h4>
                  <div class="opening-hours">
                    <ul class="list-border">
                      <li class="clearfix"> <span> Mon - Tues :  </span>
                        <div class="value pull-right"> 6.00 am - 10.00 pm </div>
                      </li>
                      <li class="clearfix"> <span> Wednes - Thurs :</span>
                        <div class="value pull-right"> 8.00 am - 6.00 pm </div>
                      </li>
                      <li class="clearfix"> <span> Fri : </span>
                        <div class="value pull-right"> 3.00 pm - 8.00 pm </div>
                      </li>
                      <li class="clearfix"> <span> Sun : </span>
                        <div class="value pull-right bg-theme-color-2 text-white closed"> Closed </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="footer-bottom" data-bg-color="#2b2d3b">
            <div class="container pt-20 pb-20">
              <div class="row">
                <div class="col-md-6">
                  <p class="font-12 text-black-777 m-0 sm-text-center">Copyright &copy;2017 ThemeMascot. All Rights Reserved</p>
                </div>
                <div class="col-md-6 text-right">
                  <div class="widget no-border m-0">
                    <ul class="list-inline sm-text-center mt-5 font-12">
                      <li>
                        <a href="#">FAQ</a>
                      </li>
                      <li>|</li>
                      <li>
                        <a href="#">Help Desk</a>
                      </li>
                      <li>|</li>
                      <li>
                        <a href="#">Support</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </footer>
        <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
        <?php
    }

//=============================================================================================================================================================================================//

    function WrapperEnd(){
        ?>
        </div>
        <!-- end wrapper -->
        <?php
    }
//=============================================================================================================================================================================================//
    
    function ScriptsJS($path, $sjs){
        ?>
        <!-- Footer Scripts -->
        <!-- JS | Custom script for all pages -->
        <script src="<?php echo $path."app/"; ?>js/custom.js"></script>
        <?php
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
        PageHeader($path);
        MainContentBegin();
        PageTitle($path, $page_title);
    }
//=============================================================================================================================================================================================//

    function CommonFooter($path, $sjs, $config){
        Footer($path);
        WrapperEnd();
        ScriptsJS($path, $sjs);
        BodyEnd();
    }
//=============================================================================================================================================================================================//
    