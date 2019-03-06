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
    $page_title = "Reservaci&oacute;n";
    $meta = "";
    $css = "";
    $js = "";
    $current = "evento";
    $content_class = "";
    $config = [];
    CommonHeader($path, $page_title, $meta, $css, $js, $current, $content_class, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    ?>
    <div class="row">
        <div class="col-md-12 text-left">
            <p>DETAILS</p>
            <h2>NYE PARTY OF THE YEAR</h2>
            <hr class="h" />
            <ul class="list-inline">
                <li><b>Date:</b>   12/01/2017</li>
                <li><b>Time:</b>  19:00</li>
                <li><b>Address:</b> 2 Elizabeth St, Melbourne, 3000 Australia</li>
                <li><b>Tickets:</b> <a href="single-event.html#">contact@eprom.com</a></li>
                <li><b>Tel:</b> (123) 563-9899-234</li>
                <li><b>Categories:</b> Festivals</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="container">
            <ul class="mesas list-inline mt-40 mb-40 pt-20 pb-40">
                <?php
                for ($i = 1; $i <= 30; $i++) {
                    if ($i == 20){
                        ?>
                        <li class="mesa-reservada pt-20 pr-100">
                        <?php
                    }
                    else {
                    ?>
                    <li class="pt-20 pr-100">
                    <?php
                    }
                    ?>
                        <i class="flaticon-020-meeting font-68"></i>
                        <p class="text-center pl-20"><?php echo $i; ?></p>
                    </li>
                <?php
                }
                ?>
            </ul>
            
            
            <div class="col-md-12">
                <form action="http://www.framework-y.com/scripts/php/contact-form.php" class="form-box form-ajax" method="post">
                    <h3>RESERVACI&Oacute;N</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <p>Mesa</p>
                            <select class="form-control form-value">
                                <?php
                                for ($i = 1; $i <= 30; $i++) {
                                    ?>
                                        <option><p class="text-center pl-20"><?php echo $i; ?></p></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <p>Acompa&ntilde;antes</p>
                            <select class="form-control form-value">
                                <?php
                                for ($i = 1; $i <= 3; $i++) {
                                    ?>
                                        <option><p class="text-center pl-20"><?php echo $i; ?></p></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <p>&nbsp;</p>
                            <button class="form-control form-value" type="submit">Reservar</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    <?php
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    //Pie de pagina
    $sjs = "";
    $config = [];
    CommonFooter($path, $sjs, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
?>