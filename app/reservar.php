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
    $page_title = "Reservar";
    $meta = "";
    $css = "";
    $js = "";
    $current = "Reservar";
    $content_class = "";
    $config = [];
    CommonHeader($path, $page_title, $meta, $css, $js, $current, $content_class, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
    // Validacion de la session
    if (SessionValidate($path, "user")){

        // recepcion del id del evento
        if (null !== filter_input(INPUT_GET, 'evnt', FILTER_SANITIZE_NUMBER_INT)){ 
            $_SESSION['evnt_id'] = filter_input(INPUT_GET, 'evnt', FILTER_SANITIZE_NUMBER_INT);
        }
        
        if (isset($_SESSION['evnt_id'])){
            
            if ((isset($_POST['rsrv_ctrl'])) && ($_POST['rsrv_ctrl'] == "rsrv")){
                
                if (null !== filter_input(INPUT_POST, 'rsrv_mesa', FILTER_SANITIZE_NUMBER_INT)){ 
                    $rsrv_mesa = filter_input(INPUT_POST, 'rsrv_mesa', FILTER_SANITIZE_NUMBER_INT);
                }
                
                if (null !== filter_input(INPUT_POST, 'rsrv_acmp', FILTER_SANITIZE_NUMBER_INT)){ 
                    $rsrv_acmp = filter_input(INPUT_POST, 'rsrv_acmp', FILTER_SANITIZE_NUMBER_INT);
                }
                
                // Reserva
                $sql_rsrv_up = "UPDATE tbla_rsrv "
                    ."SET rsrv_user = ".$_SESSION['sson_idpr'].", rsrv_acmp = ".$rsrv_acmp.", rsrv_estd = 1 "
                    ."WHERE (rsrv_mesa = ".$rsrv_mesa.") AND (rsrv_evnt = ".$_SESSION['evnt_id'].")";
                $query_rsrv_up = $conec->dbQuery($sql_rsrv_up, $debug);
                
                if ($query_rsrv_up == 1) {
                    $modal_alert_type = "success";
                    echo $modal_message = "La reservaci&oacute;n se ha realizado satisfactoriamente";
                }
                else {
                    $modal_alert_type = "error"; 
                    echo $modal_message = "La reservaci&oacute;n no se ha podido realizar. Intentelo m&aacute;s tarde o pongase en contacto con el administrador del sitio";
                }
            }
    ?>

            <section class="event-section"> 
                <!--TAB STYLE 1-->
                <section class="tab-style-1 menu">
                    <div class="tab-row">
                        <div class="tab-content">
                            <div id="tab-style-1">
                                <div class="container">
                                    <h2>Nuestros Eventos</h2>
                                    <strong class="title">&iexcl;No te quedes sin reservar!</strong>
                                    <p>Selecciona la mesa que desees. Puedes asistir hasta con un m&aacute;ximo de tres(3) acompa&ntilde;antes. Es Necesario que indiques que asistiras por lo menos con un acompa&ntilde;ante, de los contrario la reserva no podr&aacute; resalizar.</p>
                                    <div class="event-box">
                  
                                        <div class="col-md-12 mb-40">
                                            <table border="1" class="plano_majestic color_gold col-md-12 col-xs-12 col-sm-12">
                                            <?php
                                            for ($i = 1; $i <= 20; $i++){
                                                ?>
                                                <tr>
                                                    <?php
                                                    for ($j = 1; $j <= 30; $j++){
                                                        ?>
                                                        <td>
                                                            <?php
                                                            if ($j== 1){
                                                                echo $i;
                                                            }
                                                            if ($i == 1){
                                                                echo $j;
                                                            }
                                                            $sql_mesa = "SELECT tbla_mesa.id AS mesa_id, mesa_nmro, mesa_mstp, mesa_cpcd, mesa_cori, mesa_corj, mesa_msvp, mesa_estd, "
                                                                ."tbla_mstp.id AS mstp_id, mstp_nomb, mstp_icon, mstp_estd, "
                                                                ."tbla_msvp.id AS msvp_id, msvp_nomb, msvp_estd "
                                                                ."FROM tbla_mesa "
                                                                ."INNER JOIN tbla_mstp ON (mesa_mstp = tbla_mstp.id) "
                                                                ."INNER JOIN tbla_msvp ON (mesa_msvp = tbla_msvp.id) "
                                                                ."WHERE (mesa_cori = ".$i.") AND (mesa_corj = ".$j.") AND (mesa_estd = 1)";
                                                            $query_mesa = $conec->dbQuery($sql_mesa, $debug);
                                                            while( $datos_mesa = $conec->dbFetchObjet($query_mesa)){
                                                                ?>
                                                            <button type="button" data-toggle="modal" data-target="#modal_mesa<?php echo $datos_mesa->mesa_id; ?>">
                                                                <i data-toggle="tooltip" title="Mesa N&ordm;<?php echo $datos_mesa->mesa_nmro; ?> / <?php echo $datos_mesa->mstp_nomb; ?> / Capacidad: <?php echo $datos_mesa->mesa_cpcd; ?> personas" class="<?php echo $datos_mesa->mstp_icon; ?>"></i>
                                                                <span class="mesa_nmro">Mesa <?php echo $datos_mesa->mesa_nmro; ?></span>
                                                            </button>    
                                                                    
                                                                <div id="modal_mesa<?php echo $datos_mesa->mesa_id; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">

                                                                        <!-- Modal content-->
                                                                        <div class="modal-content" style="">
                                                                            <div class="modal-header bg_gold font_gold_negative">
                                                                                <button type="button" class="close m-0" data-dismiss="modal">&times;</button>
                                                                                <h1 class=""><i class="fa fa-credit-card-alt"></i>&nbsp; Reservar Mesa </h1>
                                                                            </div>
                                                                            <form class="form-horizontal" id="catalogo-form" method="post" action="<?php echo $path."app/index.php"; ?>">
                                                                                <div class="modal-body font_dark">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 text-left pl-40">
                                                                                            Mesa N&ordm; <?php echo $datos_mesa->mesa_nmro; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br />
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 text-left pl-40">
                                                                                            Tipo: <?php echo $datos_mesa->mstp_nomb; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br />
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 text-left pl-40">
                                                                                            Clase: <?php echo $datos_mesa->msvp_nomb; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br />
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 text-left pl-40">
                                                                                            Capacidad: <?php echo $datos_mesa->mesa_cpcd; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br />
                                                                                    
                                                                                    </div>
                                                                                </form>
                                                                            <div class="modal-footer bg_gold">
                                                                                <button class=" btn button_dark pull-right" data-callback="onSubmit2"> Reservar</button>
                                                                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    <?php
                                                            }   
                                                            ?>
                                                        </td>
                                                    <?php
                                                    }
                                                    ?>
                                                </tr>
                                                <?php
                                            } 

                                            ?>
                                            </table>  
                                        </div>
                                        
                                        <?php
                                        // Datos del evento
                                        $sql_evnt = "SELECT tbla_evnt.id AS evnt_id, evnt_ttlo, evnt_desc, evnt_fech, evnt_estd "
                                            ."FROM tbla_evnt "
                                            ."WHERE tbla_evnt.id = ".$_SESSION['evnt_id'];
                                        $query_evnt = $conec->dbQuery($sql_evnt, $debug);
                                        $datos_evnt = $conec->dbFetchObjet($query_evnt);

                                        $evnt_act_year = date('Y',strtotime($datos_evnt->evnt_fech));
                                        $evnt_act_mes = date('n',strtotime($datos_evnt->evnt_fech));
                                        $evnt_act_day = date('j',strtotime($datos_evnt->evnt_fech));
                                        $evnt_act_hora = date('H',strtotime($datos_evnt->evnt_fech));
                                        ?>
                                        
                                        <div class="text-box">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="text-col">
                                                        <h3 class="reservar_title font-32 color_gold"><?php echo $datos_evnt->evnt_ttlo; ?></h3>
                                                        <strong class="reservar_fecha text"><?php echo fecha ($datos_evnt->evnt_fech, 'fecha-completa'); ?></strong>
                                                        <?php echo $datos_evnt->evnt_desc; ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="event-time-box">
                                                        <div class="defaultCountdown-event-1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="btm-row-2"> 
                                            <form class="reservar" action="<?php echo $path."app/reservar.php"; ?>" method="post">
                                                  <div class="col-md-3">
                                                      <select id="rsrv_mesa" name="rsrv_mesa" class=" btn-view-detail" required="required">
                                                          <option> Seleccione su mesa </option>
                                                            <?php
                                                            $sql_mesa = "SELECT rsrv_mesa, rsrv_evnt, rsrv_estd, "
                                                                ."tbla_mesa.id AS mesa_id, mesa_nmro, mesa_estd "
                                                                ."FROM tbla_rsrv "
                                                                ."INNER JOIN tbla_mesa ON (rsrv_mesa = tbla_mesa.id) "
                                                                ."WHERE (rsrv_evnt = ".$_SESSION['evnt_id'].") AND (mesa_estd = 1) AND (rsrv_estd = 0)";
                                                            $query_mesa = $conec->dbQuery($sql_mesa, $debug);

                                                            while ($datos_mesa = $conec->dbFetchObjet($query_mesa)){
                                                                ?>
                                                                <option class="text-center pl-20" value="<?php echo $datos_mesa->mesa_id; ?>">Mesa <?php echo $datos_mesa->mesa_nmro; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                  </div>

                                                  <div class="col-md-3">
                                                      <select id="rsrv_acmp" name="rsrv_acmp" class=" btn-view-detail" required="required">
                                                          <option> N&ordm; de Acompa&ntilde;antes </option>
                                                            <?php
                                                            for ($i = 1; $i <= 3; $i++) {
                                                                ?>
                                                                    <option class="text-center pl-20" value="<?php echo $i; ?>"><?php echo $i; ?> Acompa&ntilde;antes</option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                  </div>

                                                  <div class="col-md-6">
                                                      <input name="rsrv_ctrl" type="hidden" value="rsrv"/>
                                                      <button type="submit" class="btn-view-detail pull-right pb-20">Reservar</button> 
                                                  </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </section>
      <!--TAB STYLE 1-->
      
      
      
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
    
        } // Fin si existe el id del evento
        
    } // Fin de la validacion de la session
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    //Pie de pagina
    $sjs = "<script>
    if ($(\".defaultCountdown-event-1\").length) {
        var austDay = new Date();
        austDay = new Date(".$evnt_act_year.", ".$evnt_act_mes."-1, ".$evnt_act_day.", ".$evnt_act_hora.");
        jQuery('.defaultCountdown-event-1').countdown({
            labels: ['Years', 'Months', 'Weeks', 'Days', 'Hrs', 'Min', 'Sec'],
            until: austDay
        });
    }
    </script>";
    $config_footer = [];
    CommonFooter($path, $sjs, $config_footer);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
?>