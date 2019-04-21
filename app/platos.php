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
    $page_title = "Platos";
    $meta = "";
    $css = "";
    $js = "";
    $current = "platos";
    $content_class = "";
    $config = [];
    CommonHeader($path, $page_title, $meta, $css, $js, $current, $content_class, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Validacion de la session
    if (SessionValidateUser($path, "user")){
    ?>
        <section class="about-section">
            <div class="container">

              <div class="bartenders-section">
                <h2>Platos</h2>
                <strong class="title">Degusta nuestras especialidades</strong>
                <div class="row">

                    <?php
                    // Consulta de los platos
                    $sql_plts = "SELECT tbla_plts.id,  plts_nomb, plts_pltp, plts_imgn, plts_desc, plts_prec, plts_estd, plts_freg, "
                            ."tbla_pltp.id AS pltp_id, pltp_nomb "
                            ."FROM tbla_plts "
                            ."INNER JOIN tbla_pltp ON (plts_pltp = tbla_pltp.id) "
                            ."WHERE plts_estd = 1";
                    $query_plts = $conec->dbQuery($sql_plts, $debug);

                    while ($datos_plts = $conec->dbFetchObjet($query_plts)){
                        ?>
                        <div class="col-md-4 col-sm-4">
                            <div class="box">
                                <div class="img-frame"><img src="<?php echo $path."app/images/platos/".$datos_plts->plts_imgn; ?>" alt="<?php $datos_plts->plts_nomb; ?>"></div>
                                <div class="text-box">
                                    <h2><?php echo $datos_plts->plts_nomb; ?><br /><small><?php echo $datos_plts->pltp_nomb; ?></small></h2>
                                    <?php echo $datos_plts->plts_desc; ?>
                                </div>
                                <div class="bartender-social text-center precio">
                                    <span class="font-20">Por tan solo: <?php echo TasaDeCambio($path, $datos_plts->plts_prec, $_SESSION['tasa_cdgo']) ?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
              </div>
            </div>
        </section>

    <?php
    } // Cierre de validacion de la sesion
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    //Pie de pagina
    $sjs = "<script>
    if ($(\".defaultCountdown-event-1\").length) {
        var austDay = new Date();
        austDay = new Date(".$evnt_act_year.", ".$evnt_act_mes."-1, ".$evnt_act_day.", ".$evnt_act_hora.");
        jQuery('.defaultCountdown-event-1').countdown({
            labels: ['Years', 'Months', 'Weeks', 'D&iacute;as', 'Hrs', 'Min', 'Seg'],
            until: austDay
        });
    }
    </script>";
    $config_footer = [];
    CommonFooter($path, $sjs, $config_footer);
    ?>
    
    <?php
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
?>