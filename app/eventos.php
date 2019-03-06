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
    
    // Fecha actual
    $fecha_actual = date("Y-m-d H:i:s");
    
    // Evento actual
    $sql_evnt_base = "SELECT tbla_evnt.id AS evnt_id, evnt_ttlo, evnt_desc, evnt_fech, evnt_imgn, evnt_estd, evnt_freg, "
        ."tbla_evnc.id, evnc_nomb, evnc_estd "
        ."FROM tbla_evnt "
        ."INNER JOIN tbla_evnc ON (evnt_evnc = tbla_evnc.id) "
        ."WHERE evnt_fech >= '".$fecha_actual."' "
        ."ORDER BY evnt_fech ASC ";
    
    $sql_evnt_actual = $sql_evnt_base."LIMIT 0, 1";
    $query_evnt_actual = $conec->dbQuery($sql_evnt_actual, $debug);
    $datos_evnt_actual = $conec->dbFetchObjet($query_evnt_actual);
    
    $evnt_act_year = date('Y',strtotime($datos_evnt_actual->evnt_fech));
    $evnt_act_mes = date('n',strtotime($datos_evnt_actual->evnt_fech));
    $evnt_act_day = date('j',strtotime($datos_evnt_actual->evnt_fech));
    $evnt_act_hora = date('H',strtotime($datos_evnt_actual->evnt_fech));
    
    $user = $_SESSION['sson_idpr'];
    $evnt = $datos_evnt_actual->evnt_id;
    $rsrv = ComprobarReserva($path, $user, $evnt);
    ?>
    
    <section class="event-section"> 
      
        <section class="tab-style-1 menu">
            <div class="tab-row">
                <div class="tab-content">

                    <!-- Encabezado de la pagina-->
                    <div role="tabpanel" class="tab-pane active" id="tab-style-1">
                        <div class="container">
                            <h2>Nuestros Eventos</h2>
                            <strong class="title">Disfruta de todo lo que se viene</strong>
                            <p>Majestic cuenta con una amplia programaci&oacute;nn de eventos durante todo el a&ntilde;o. Lo que puedes ver a continuaci&uaucute;n es tan solo el principio de una larga lista de eventos y entretenimientos que tremos en exclusiva para ti. Lleva tu experiencia al m&aacute;ximo nivel </p>

                            <!-- Evento Principal -->
                            <div class="event-box">
                                <div class="col-md-4">
                                    <div class="img-frame">
                                        <a href="<?php echo $path."app/reservar.php?evnt=".$datos_evnt_actual->evnt_id; ?>">
                                            <img src="<?php echo $path."uploads/imagenes/eventos/".$datos_evnt_actual->evnt_imgn; ?>" alt="<?php echo $datos_evnt_actual->evnt_ttlo ?>">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-8 evnt_actual_info">
                                    <div class="text-box evnt_actual_text">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-col">
                                                    <h3 class="color_gold font-32 evnt_title"><?php echo $datos_evnt_actual->evnt_ttlo ?>
                                                    <?php
                                                    if ($rsrv['rsrv_estd'] == TRUE){
                                                        ?>
                                                    <span class="rsrv_dtll">Usted a reservado para este evento: Mesa N&ordm; <?php echo $rsrv['mesa_nmro']; ?> / Tipo: <?php echo $rsrv['mstp_nomb']; ?> / Clase: <?php echo $rsrv['msvp_nomb']; ?> / Acompa&ntilde;antes: <?php echo $rsrv['rsrv_acmp']; ?></span>
                                                        <?php
                                                    }
                                                    ?>
                                                    </h3>
                                                    <?php echo $datos_evnt_actual->evnt_desc ?>    
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="event-time-box mt-80">
                                                    <div class="defaultCountdown-event-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btm-row-2 mb-0"> 
                                        <strong class="text"><?php echo fecha ($datos_evnt_actual->evnt_fech, 'fecha-completa'); ?></strong> 
                                        <?php
                                        if ($rsrv['rsrv_estd'] == TRUE){
                                            ?>
                                            <a href="<?php echo $path."app/reservar.php?evnt=".$datos_evnt_actual->evnt_id; ?>" class="btn-view-detail">Cancelar Reserva</a> 
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <a href="<?php echo $path."app/reservar.php?evnt=".$datos_evnt_actual->evnt_id; ?>" class="btn-view-detail">Reservar</a> 
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <?php 
                // Categorias de eventos
                $sql_evnc = "SELECT * FROM tbla_evnc WHERE evnc_estd = 1";
                $query_evnc = $conec->dbQuery($sql_evnc, $debug);
                ?>
                    <ul class="nav nav-tabs" role="tablist">
                    <?php
                    while ($datos_evnc = $conec->dbFetchObjet($query_evnc)){ 
                        ?>                    
                         <li role="presentation"><a href="#"><?php echo $datos_evnc->evnc_nomb; ?></a></li>
                        <?php
                    }
                    ?>
                    </ul>

            </div>
        </section>
      
      
        <div class="event-row">
            <div class="container">
                <div class="row">

                    <?php 
                    $sql_evnts = $sql_evnt_base."LIMIT 1, 4";
                    $query_evnts = $conec->dbQuery($sql_evnts, $debug);


                    while ($datos_evnts = $conec->dbFetchObjet($query_evnts)){
                        ?>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="event-col">
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="thumb"><a href="<?php echo $path."app/reservar.php?evnt=".$datos_evnts->evnt_id; ?>"><img width="100%" src="<?php echo $path."uploads/imagenes/eventos/".$datos_evnts->evnt_imgn; ?>" alt="<?php echo $datos_evnts->evnt_nomb; ?>"></a></div>
                                </div>
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <div class="text-col pl-30"> <strong class="date"><?php echo fecha ($datos_evnts->evnt_fech, 'fecha-corta'); ?></strong>
                                    <h2 class="mt-40 evnt_title"><?php echo $datos_evnts->evnt_ttlo; ?></h2>
                                    <?php echo $datos_evnts->evnt_desc; ?>
                                    <div class="share ml-20 mb-30"> <strong class="title">Comparte</strong>
                                        <ul>
                                            <li><a href="event.html#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            <li><a href="event.html#"><i class="fa fa-tripadvisor" aria-hidden="true"></i></a></li>
                                            <li><a href="event.html#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                    <a href="<?php echo $path."app/reservar.php?evnt=".$datos_evnt_actual->evnt_id; ?>" class="btn-book">Reservar</a>  </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
      
        <!--HOME GALLERY-->
            <section class="home-gallery gallery">
              <div class="img-frame"> <img src="images/gallery-home-img-1.jpg" alt="">
                <div class="caption">
                  <div class="holder"> <a href="images/gallery-home-img-1.jpg" class="link" data-rel="prettyPhoto"><i class="fa fa-search" aria-hidden="true"></i></a> <a href="event.html#" class="link"><i class="fa fa-link" aria-hidden="true"></i></a> </div>
                </div>
              </div>
              <div class="img-frame"> <img src="images/gallery-home-img-2.jpg" alt="">
                <div class="caption">
                  <div class="holder"> <a href="images/gallery-home-img-2.jpg" class="link" data-rel="prettyPhoto"><i class="fa fa-search" aria-hidden="true"></i></a> <a href="event.html#" class="link"><i class="fa fa-link" aria-hidden="true"></i></a> </div>
                </div>
              </div>
              <div class="img-frame"> <img src="images/gallery-home-img-3.jpg" alt="">
                <div class="caption">
                  <div class="holder"> <a href="images/gallery-home-img-3.jpg" class="link" data-rel="prettyPhoto"><i class="fa fa-search" aria-hidden="true"></i></a> <a href="event.html#" class="link"><i class="fa fa-link" aria-hidden="true"></i></a> </div>
                </div>
              </div>
              <div class="img-frame"> <img src="images/gallery-home-img-4.jpg" alt="">
                <div class="caption">
                  <div class="holder"> <a href="images/gallery-home-img-4.jpg" class="link" data-rel="prettyPhoto"><i class="fa fa-search" aria-hidden="true"></i></a> <a href="event.html#" class="link"><i class="fa fa-link" aria-hidden="true"></i></a> </div>
                </div>
              </div>
              <div class="img-frame"> <img src="images/gallery-home-img-5.jpg" alt="">
                <div class="caption">
                  <div class="holder"> <a href="images/gallery-home-img-5.jpg" class="link" data-rel="prettyPhoto"><i class="fa fa-search" aria-hidden="true"></i></a> <a href="event.html#" class="link"><i class="fa fa-link" aria-hidden="true"></i></a> </div>
                </div>
              </div>
            </section>
      <!--HOME GALLERY--> 
      
      <!--NEWSLETTER SECTION-->
      <section class="newsletter">
        <div class="container">
          <div class="row">
            <div class="col-md-6"> <strong class="title">Get Updates </strong>
              <h2>Stay In Touch With Updates</h2>
            </div>
            <div class="col-md-6">
              <form action="event.html#">
                <input type="text" required>
                <input type="submit" value="Subscribe">
              </form>
            </div>
          </div>
        </div>
      </section>
      <!--NEWSLETTER SECTION--> 
    </section>
    <?php
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