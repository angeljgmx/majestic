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
    if (isset($_SESSION['user_sson']) && ($_SESSION['user_sson'] == TRUE)){

        // recepcion del id del evento
        if (null !== filter_input(INPUT_GET, 'evnt', FILTER_SANITIZE_NUMBER_INT)){ 
            $_SESSION['evnt_id'] = filter_input(INPUT_GET, 'evnt', FILTER_SANITIZE_NUMBER_INT);
        }
        
        if (isset($_SESSION['evnt_id'])){
            
            // Verificar Reserva 
            $sql_vrsv = "SELECT * FROM tbla_rsrv WHERE (rsrv_user = ".$_SESSION['sson_idpr'].") AND (rsrv_evnt = ".$_SESSION['evnt_id'].") AND (rsrv_estd = 1)";
            $query_vrsv = $conec->dbQuery($sql_vrsv , $debug);
            $nvrsv = $conec->dbNumRows($sql_vrsv);
            
            if ($nvrsv > 0){
                $reserva = TRUE;
                $datos_vrsv = $conec->dbFetchObjet($query_vrsv );
            }
            else {
                $reserva = FALSE;
            }
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

            // Cancelar Reserva
            if (($reserva == TRUE) && (isset($_GET['op'])) && ($_GET['op'] == "cancelar_reserva")){

                if (null !== filter_input(INPUT_GET, 'rsrv', FILTER_SANITIZE_NUMBER_INT)){ 
                    $rsrv_id = filter_input(INPUT_GET, 'rsrv', FILTER_SANITIZE_NUMBER_INT);
                }
                
                // Coprobar permisos para cancelar la reserva
                $sql_crsr = "SELECT * FROM tbla_rsrv WHERE id = ".$rsrv_id;
                $query_crsr = $conec->dbQuery($sql_crsr, $debug);
                $datos_crsr = $conec->dbFetchObjet($query_crsr);
                
                if (($datos_crsr->rsrv_user == $_SESSION['sson_idpr']) && ($datos_crsr->rsrv_estd != 0)){
                    
                    // Reserva
                    echo $sql_rsrv_down = "UPDATE tbla_rsrv "
                        ."SET rsrv_estd = 0 "
                        ."WHERE (id = ".$rsrv_id.")";
                    $query_rsrv_down = $conec->dbQuery($sql_rsrv_down, $debug);

                    if ($query_rsrv_down == 1) {
                        $reserva = FALSE;
                        $mensaje = "La reservaci&oacute;n se ha cancelado con exito";
                    }
                    else {
                        $mensaje = "La reservaci&oacute;n no se ha podido cancelar. Intentelo m&aacute;s tarde o pongase en contacto con el administrador del sitio";
                    }
                    $titulo = "Cancelar Reserva";
                    ModalMensaje($path, $titulo, $mensaje);
                }
                else {
                    $titulo = "Cancelar Reserva";
                    $mensaje = "Usted no tiene permisos para cancelar esta reserva.<br />Pongase en contacto con nuestros Administradores";
                    ModalMensaje($path, $titulo, $mensaje);
                }
            }
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

            // Realizar Reserva
            if ((isset($_GET['op'])) && ($_GET['op'] == "reservar") && ($reserva == FALSE)){
                
                if (null !== filter_input(INPUT_GET, 'evnt', FILTER_SANITIZE_NUMBER_INT)){ 
                    $rsrv_evnt = filter_input(INPUT_GET, 'evnt', FILTER_SANITIZE_NUMBER_INT);
                }
                if (null !== filter_input(INPUT_GET, 'mesa', FILTER_SANITIZE_NUMBER_INT)){ 
                    $rsrv_mesa = filter_input(INPUT_GET, 'mesa', FILTER_SANITIZE_NUMBER_INT);
                }
                // Reserva
                echo $sql_rsrv_up = "UPDATE tbla_rsrv "
                    ."SET rsrv_user = ".$_SESSION['sson_idpr'].", rsrv_estd = 1 "
                    ."WHERE (rsrv_mesa = ".$rsrv_mesa.") AND (rsrv_evnt = ".$rsrv_evnt.")";
                $query_rsrv_up = $conec->dbQuery($sql_rsrv_up, $debug);
                
                if ($query_rsrv_up == 1) {
                    $reserva = TRUE;
                    $sql_vrsv = "SELECT * FROM tbla_rsrv WHERE (rsrv_user = ".$_SESSION['sson_idpr'].") AND (rsrv_evnt = ".$_SESSION['evnt_id'].") AND (rsrv_estd = 1)";
                    $query_vrsv = $conec->dbQuery($sql_vrsv , $debug);
                    $datos_vrsv = $conec->dbFetchObjet($query_vrsv );
                    $mensaje = "La reservaci&oacute;n se ha realizado satisfactoriamente";
                }
                else {
                    $mensaje = "La reservaci&oacute;n no se ha podido realizar. Intentelo m&aacute;s tarde o pongase en contacto con el administrador del sitio";
                }
                $titulo = "Reservar";
                ModalMensaje($path, $titulo, $mensaje);  
            }
            if ((isset($_GET['op'])) && ($_GET['op'] == "reservar") && ($reserva == TRUE)){
                $mensaje = "<h2>No puede reservar m&aacute;s de una mesa</h2><br /><br /> Para reservar una mesa diferente primero debe cancelar la reservaci&oacute;n realizada previamente";
                $titulo = "Reservar";
                ModalMensaje($path, $titulo, $mensaje);
            }
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
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
                                    <p>Selecciona la mesa que desees. Puedes asistir con un n&uacute;mero de acompa&ntilde;antes seg&uacute;n se indica en la reserva. Una vez hayas encontrado la mesa de tu agrado has clic sobre reservar y se te indicar&aacute; con un mensaje si la operaci&oacute;n se ha realizado con &eacute;xito. Las mesas que ya han sido reservadas con anterioridad, se muestran de color rojo y no se pueden seleccionar. Solo se puede reservar una sola y &uacute;nica mesa por miembro asociado.</p>
                                    <div class="event-box">
                  
                                        <div class="col-md-12 mb-40">
                                            <table class="plano_majestic color_gold col-md-12 col-xs-12 col-sm-12">
                                            <?php
                                            for ($i = 1; $i <= 12; $i++){
                                                ?>
                                                <tr height="70">
                                                    <?php
                                                    for ($j = 1; $j <= 12; $j++){
                                                        ?>
                                                        <td id="td-<?php echo $i."-".$j; ?>" class="col-md-1">
                                                            <?php
                                                            if ($j== 1){
                                                                //echo $i;
                                                            }
                                                            if ($i == 1){
                                                                //echo $j;
                                                            }
                                                            $sql_mesa = "SELECT tbla_mesa.id AS mesa_id, mesa_nmro, mesa_mstp, mesa_cpcd, mesa_cori, mesa_corj, mesa_msvp, mesa_estd, "
                                                                ."tbla_mstp.id AS mstp_id, mstp_nomb, mstp_icon, mstp_estd, "
                                                                ."tbla_msvp.id AS msvp_id, msvp_nomb, msvp_estd "
                                                                ."FROM tbla_mesa "
                                                                ."INNER JOIN tbla_mstp ON (mesa_mstp = tbla_mstp.id) "
                                                                ."INNER JOIN tbla_msvp ON (mesa_msvp = tbla_msvp.id) "
                                                                ."WHERE (mesa_cori = ".$i.") AND (mesa_corj = ".$j.") AND (mesa_estd = 1)";
                                                            $query_mesa = $conec->dbQuery($sql_mesa, $debug);
                                                            $n_mesa = $conec->dbNumRows($query_mesa);
                                                            if ($n_mesa > 0){
                                                                while( $datos_mesa = $conec->dbFetchObjet($query_mesa)){
                                                                    
                                                                    // Verificar si la mesa esta reservada
                                                                    $sql_mrsv = "SELECT * FROM tbla_rsrv WHERE (rsrv_evnt = ".$_SESSION['evnt_id'].") AND (rsrv_mesa = ".$datos_mesa->mesa_nmro.")";
                                                                    $query_mrsv = $conec->dbQuery($sql_mrsv , $debug);
                                                                    $datos_mrsv = $conec->dbFetchObjet($query_mrsv);
                                                                    
                                                                    if ($datos_mrsv->rsrv_estd == 0){
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
                                                                                    <form class="form-horizontal" id="catalogo-form" method="post" action="<?php echo $path."app/reservar.php"; ?>">
                                                                                        <div class="modal-body font_white bg_dark">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 text-left pl-40 font-16 font_gold">
                                                                                                    Mesa N&ordm; <?php echo $datos_mesa->mesa_nmro; ?>
                                                                                                </div>
                                                                                            </div>
                                                                                            <br />
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 text-left pl-40 font-16 font_gold">
                                                                                                    Tipo: <?php echo $datos_mesa->mstp_nomb; ?>
                                                                                                </div>
                                                                                            </div>
                                                                                            <br />
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 text-left pl-40 font-16 font_gold">
                                                                                                    Clase: <?php echo $datos_mesa->msvp_nomb; ?>
                                                                                                </div>
                                                                                            </div>
                                                                                            <br />
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 text-left pl-40 font-16 font_gold">
                                                                                                    Capacidad: <?php echo $datos_mesa->mesa_cpcd; ?> personas.
                                                                                                </div>
                                                                                            </div>
                                                                                            <br />
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 text-left pl-40 font-16 font_gold">
                                                                                                    N&ordm; de acompa&ntilde;antes: <?php echo $datos_mesa->mesa_cpcd - 1; ?> personas.
                                                                                                </div>
                                                                                            </div>
                                                                                            <br />
                                                                                        </div>

                                                                                        <div class="modal-footer bg_gold">
                                                                                            <a href="<?php echo $path."app/reservar.php?op=reservar&evnt=".$_SESSION['evnt_id']."&mesa=".$datos_mesa->mesa_nmro; ?>" class="btn button_dark button_rsrv pull-right pb-10">RESERVAR</a>
                                                                                            <button type="button" type="submit" class="btn btn-default pull-right mr-10" data-dismiss="modal">Cancelar</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>    
                                                                    <?php
                                                                    }
                                                                    else{
                                                                    ?>
                                                                    <button class="mesa-reservada">
                                                                        <i data-toggle="tooltip" title="Mesa N&ordm;<?php echo $datos_mesa->mesa_nmro; ?> / <?php echo $datos_mesa->mstp_nomb; ?> / Capacidad: <?php echo $datos_mesa->mesa_cpcd; ?> personas" class="<?php echo $datos_mesa->mstp_icon; ?>"></i>
                                                                        <span class="mesa_nmro">Mesa <?php echo $datos_mesa->mesa_nmro; ?></span>
                                                                    </button>

                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            else {
                                                                if(($i == 5) && ($j == 6)){
                                                                        echo "<i class=\"flaticon-disc-jockey\"></i><br /><span class=\"mesa_nmro\">DJ</span>";
                                                                }
                                                                if(($i == 9) && ($j == 6)){
                                                                        echo "<i class=\"flaticon-tetris-4\"></i>";
                                                                }
                                                                else{
                                                                ?>
                                                                <span>&nbsp;</span>
                                                                <?php
                                                                }
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
                                                        <h3 class="reservar_title font-32 color_gold"><?php echo $datos_evnt->evnt_ttlo; ?>
                                                        <?php
                                                        if ($reserva == TRUE){
                                                            $user = $_SESSION['sson_idpr'];
                                                            $evnt = $_SESSION['evnt_id'];
                                                            $rsrv = ComprobarReserva($path, $user, $evnt);
                                                            ?>
                                                            
                                                            <span class="rsrv_dtll">Usted a reservado para este evento: Mesa <span class="color_gold">N&ordm; <?php echo $rsrv['mesa_nmro']; ?></span> / Tipo: <span class="color_gold"><?php echo $rsrv['mstp_nomb']; ?></span> / Clase: <span class="color_gold"><?php echo $rsrv['msvp_nomb']; ?></span> / Capacidad: <span class="color_gold"><?php echo $rsrv['mesa_cpcd']; ?> personas.</span></span>
                                                            <?php
                                                        }
                                                        ?>
                                                        </h3>
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
                                                  <div class="col-md-7 col-sm-12 col-xs-12 pb-20">
                                                        <p class="p-0 font-12 m-0 nota">
                                                            <strong>NOTA:</strong> Recuerda que debes seleccionar una mesa de acuerdo a su capacidad, seg&uacute;n la cantidad real de acompa&ntilde;antes que disfrutar&aacute;n junto a ti del evento.<br /><br />
                                                            En caso de que no puedas asistir al evento, obligatoriamente deber&aacute;s cancelar la reservaci&oacute;n antes de la realizaci&oacute;n del evento.
                                                        </p>
                                                  </div>

                                                  <div class="col-md-5 col-sm-12 col-xs-12">
                                                      <?php
                                                        if ($reserva == TRUE){
                                                            ?>
                                                            <a href="<?php echo $path."app/reservar.php?evnt=".$evnt = $_SESSION['evnt_id']."&op=cancelar_reserva&rsrv=".$rsrv['rsrv_id']; ?>" class="col-sm-12 col-xs-12 col-md-12 btn-view-detail button_rsrv pull-right pb-10 text-center">Cancelar la Reserva</a>
                                                            <?php
                                                        }
                                                        ?>
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
<!--      <section class="home-gallery gallery">
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
      </section>-->
      <!--HOME GALLERY--> 
      
      <!--NEWSLETTER SECTION-->
<!--      <section class="newsletter">
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
      </section>-->
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
    MainEnd();
    Footer($path);
    WrapperEnd();
    ScriptsJS($path, $sjs);
    ?>
    <script>
        $('#myModal').modal('show');
    </script>
    <?php
    BodyEnd();
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
?>