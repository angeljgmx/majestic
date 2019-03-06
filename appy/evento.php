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
    $page_title = "Eventos";
    $meta = "";
    $css = "";
    $js = "";
    $current = "eventos";
    $content_class = "";
    $config = [];
    CommonHeader($path, $page_title, $meta, $css, $js, $current, $content_class, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    ?>
    <div class="row">
        
        <div class="col-md-4">
            <img src="images/events/image-7.jpg" />
        </div>   
        
        <div class="col-md-8 text-left">
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
                <hr class="space s" />
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porttitor fermentum ullamcorper. Aliquam erat volutpat. Nullam purus metus, interdum ac lacinia non, sodales non arcu. In eleifend vestibulum eleifend. Maecenas ut felis mi, vitae pharetra justo. Ut lacus lacus, fermentum sed tincidunt eget, suscipit nec orci. Sed pellentesque dapibus tellus in semper. Aenean faucibus aliquet turpis, id fermentum sem consectetur id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus euismod nunc scelerisque tincidunt.
                    </p>
                <hr class="space s" />
                <a href="<?php echo $path."reservacion"; ?>" class="anima-button circle-button btn-sm btn pt-10 pb-10" ><i class="fa fa-envelope-o"></i>Reservar</a>
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