<?php

    /****************************************
    Kamila          
    Aplicacion desarrollada por Angel Garcia
    Email: angel.j.garcia.m@gmail.com                       
    /****************************************/

//=============================================================================================================================================================================================//

    // Inicio de sesion
    session_start();
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Ubicación del archivo
    $path = "../";
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Inclusion de archivos necesarios
    require_once $path.'app/includes/core.app.php';
    CoreApp($path);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
   
    // Seguridad
    Seguridad($path);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
    // Control de errores
    $debug = DEBUG;
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Crear la instancia y conectar a la BD
    $conec = new db();
    $conec->dbConexion(); 
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
  
    // Objetivo para los formularios, los enlaces y las funciones
    $objetivo = basename($_SERVER['PHP_SELF']);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    //Encabezado de la pagina
    $page_title = "Majestic";
    $meta = "";
    $css = "";
    $js = "";
    $config = [];
    HeaderHTML($path, $page_title, $meta, $css, $js, $config);
    BodyBegin($path);
    ContentBegin();
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
   
    ?>
         
    <div class="row">
        <div class="container">
            <a class="navbar-brand center m-0" href="<?php echo $path."app/index.php"; ?>">
                <img width="250" src="<?php echo $path."uploads/imagenes/logo/".$_SESSION['pref_logh']; ?>" alt="logo" />
            </a>
        </div>
    </div>

    <?php
        ContentEnd();
    ?>
    <div class="footer-section section-bg-animation header-animation">
            <div id="anima-layer-a" class="anima-layer fog-1"></div>
            <div id="anima-layer-b" class="anima-layer fog-2"></div>
            <div class="container content overlay-content text-center">
                <hr class="space" />
                <hr class="h" />
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?php echo $path."index.php"; ?>" class="form-box form-ajax" method="post">
                        <h3>Iniciar Sesi&oacute;n</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <p>Usuario</p>
                                <input id="name" name="name" placeholder="" type="text" class="form-control form-value" required>
                                <hr class="space xs" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>Contase&ntilde;a</p>
                                <input id="email" name="email" placeholder="" type="email" class="form-control form-value" required>
                                <hr class="space xs" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="space s" />
                                <button class="anima-button circle-button btn-sm btn" type="submit"><i class="fa fa-envelope-o"></i>Send messagge</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="space s" />
            </div>
        </div>

    <?php
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    //Pie de pagina
    $sjs = "";
    
    ScriptsJS($path, $sjs);
    BodyEnd();
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
?>