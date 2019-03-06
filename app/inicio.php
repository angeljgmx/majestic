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
    $page_title = "Inicio";
    $meta = "";
    $css = "";
    $js = "";
    $current = "inicio";
    $config = [];
    HeaderHTML($path, $page_title, $meta, $css, $js, $config);
    BodyBegin($path, $config);
    WrapperBegin();
    PageHeader($path, $current);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
   
    // Validacion de la session
    if (SessionValidateUser($path, "user")){
        ?>

        <!-- Reservaciones -->

        <?php
        $fecha_actual = date("Y-m-d");
        $fecha_ini = $fecha_actual." 00:00:00";
        $fecha_fin = $fecha_actual." 23:59:59";
        $sql_evnt_hoy = "SELECT * FROM tbla_evnt WHERE evnt_fech BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";
        $query_evnt_hoy = $conec->dbQuery($sql_evnt_hoy, $debug);
        $nevnt_hoy = $conec->dbNumRows($query_evnt_hoy);
        
        if (($nevnt_hoy > 0 ) && ($_SESSION['modl_show'] != TRUE)){
            
            $datos_evnt = $conec->dbFetchObjet($query_evnt);
            
            $sql_rsrv = "SELECT tbla_rsrv.id AS rsrv_id, rsrv_mesa, rsrv_evnt, rsrv_user, rsrv_acmp, rsrv_estd, "
                ."tbla_mesa.id AS mesa_id, mesa_mstp, mesa_nmro, mesa_cpcd, mesa_cori, mesa_corj, mesa_msvp, mesa_estd, "
                ."tbla_mstp.id AS mstp_id, mstp_nomb, mstp_icon, "
                ."tbla_msvp.id AS msvp_id, msvp_nomb, "
                ."tbla_user.id AS user_id, user_nomb, user_apll, user_ndni, user_sexo, "
                ."tbla_evnt.id AS evnt_id, evnt_ttlo, evnt_fech, evnt_imgn "
                ."FROM tbla_rsrv "
                ."INNER JOIN tbla_mesa ON (tbla_mesa.id = rsrv_mesa) "
                ."INNER JOIN tbla_mstp ON (tbla_mstp.id = mesa_mstp) "
                ."INNER JOIN tbla_msvp ON (tbla_msvp.id = mesa_msvp) "
                ."INNER JOIN tbla_user ON (tbla_user.id = rsrv_user) "
                ."INNER JOIN tbla_evnt ON (tbla_evnt.id = rsrv_evnt) "
                ."WHERE (rsrv_user = ".$_SESSION['sson_idpr'].") AND (tbla_evnt.id = ".$datos_evnt->evnt_id.") AND (evnt_estd = 1) AND (rsrv_estd = 1)";
            $query_rsrv = $conec->dbQuery($sql_rsrv, $debug);
            $nrsrv = $conec->dbNumRows($query_rsrv);
            if ($nrsrv > 0){
                $datos_rsrv = $conec->dbFetchObjet($query_rsrv);
                $_SESSION['modl_show'] = TRUE;
                
                // Acompañantes
                $acomp = $datos_rsrv->mesa_cpcd -1;
                ?>
                <div id="myModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg_dark font_gold no_border_bottom md_hdft">
                                <div class="col-md-8">
                                    <h5 class="modal-title font-32">Reservaci&oacute;n</h5>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <img class="pull-right" width ="80" src="<?php echo $path."uploads/imagenes/logo/".$_SESSION['pref_logh']; ?>" />
                                </div>
                                <button type="button" class="close color_gold" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body bg_gold">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <img src="<?php echo $path."uploads/imagenes/eventos/".$datos_rsrv->evnt_imgn; ?>">
                                        </div>
                                        <div class="col-md-8">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <span class="font-24 color_dark"><?php echo $datos_rsrv->evnt_ttlo; ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pb-20">
                                                        <span class="font-12 color_dark"><?php echo fecha($datos_rsrv->evnt_fech, 'fecha-completa') ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pb-20">
                                                        <span class="font-20 color_dark"><?php echo $datos_rsrv->user_nomb; ?> <?php echo $datos_rsrv->user_apll; ?>.</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p class="font_color_dark font-16"> Mesa: N&ordm; <?php echo $datos_rsrv->mesa_nmro; ?>.</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p class="font_color_dark font-16">Tipo: <?php echo $datos_rsrv->mstp_nomb; ?>.</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p class="font_color_dark font-16">Clase: <?php echo $datos_rsrv->msvp_nomb; ?>.</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p class="font_color_dark font-16"> Acompa&ntilde;antes: <?php echo $acomp; ?>.</p>
                                                    </td>
                                                </tr>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg_dark font_gold no_border_top md_hdft">
                                <button type="button" class="btn btn-secondary pull-right button_rsrv" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            else {
                ?>
                <div id="myModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg_dark font_gold no_border_bottom md_hdft">
                                <div class="col-md-8">
                                    <h5 class="modal-title font-32">Reservaci&oacute;n</h5>
                                </div>
                                <div class="col-md-4 ">
                                    <img class="pull-right" width ="80" src="<?php echo $path."uploads/imagenes/logo/".$_SESSION['pref_logh']; ?>" />
                                </div>
                                <button type="button" class="close color_gold" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body bg_gold">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="<?php echo $path."uploads/imagenes/eventos/".$datos_evnt->evnt_imgn; ?>">
                                        </div>
                                        <div class="col-md-8">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <span class="font-24 color_dark"><?php echo $datos_evnt->evnt_ttlo; ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pb-40">
                                                        <span class="font-12 color_dark"><?php echo fecha($datos_evnt->evnt_fech, 'fecha-completa') ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="font-28 color_dark">Usted no tiene reservaci&oacute;n para el d&iacute;a de hoy.</span>
                                                    </td>
                                                </tr>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg_dark font_gold no_border_top md_hdft">
                                <button type="button" class="btn btn-secondary pull-right button_rsrv" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
        }
        ?>
        
        


        <div id="banner">
            <div id="home-slider" class="owl-carousel">
              <div class="item"> <img src="images/banner-img-1.jpg" alt="banner">
                <div class="caption">
                  <div class="holder"> <strong class="title">Orignal taste • since 1982</strong> <span>Premiucccxcvm Quality</span>
                    <h1>Treats, Fun Memories<b>&amp;</b>Love</h1>
                    <strong class="title-2">For Friends Saya</strong> </div>
                </div>
              </div>
              <div class="item"> <img src="images/banner-img-3.jpg" alt="banner">
                <div class="caption">
                  <div class="holder"> <strong class="title">Orignal taste • since 1982</strong> <span>Premiucccxcvm Quality</span>
                    <h1>Treats, Fun Memories<b>&amp;</b>Love</h1>
                    <strong class="title-2">For Friends Saya</strong> </div>
                </div>
              </div>
              <div class="item"> <img src="images/banner-img-2.jpg" alt="banner">
                <div class="caption">
                  <div class="holder"> <strong class="title">Orignal taste • since 1982</strong> <span>Premiucccxcvm Quality</span>
                    <h1>Treats, Fun Memories<b>&amp;</b>Love</h1>
                    <strong class="title-2">For Friends Saya</strong> </div>
                </div>
              </div>
            </div>
        </div>
      <!--BANNER--> 
  
        <?php
            MainBegin();
        ?>     
<!------------------------------------------------------------------------------------------------------------------------------------------------------------>    
        
        <!-- Seccion de bienvenida -->
        <section class="welcome-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="text-col">
                            <h2>Somos Majestic Members</h2>
                            <h3 class="font-24">¡Una disco con exclusividad y elegancia!</h3>
                            <p>Somos un sitio donde podrá pasar unas horas muy agradables con muy buena compañía y en un ambiente íntimo y relajado. Ven a Majestic Members para descubrir nuestros incomparables eventos en vivo y en directo. Te harán disfrutar de las mejores noches en San Cristóbal. Disfruta de todo lo que le pueda ofrecer Majestic Members, mientras tomas una copa con una atención inmejorable.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="thumb"><img class="floating" src="images/welcome-img.png" alt="img"></div>
                    </div>
                </div>
        </section>
 <!------------------------------------------------------------------------------------------------------------------------------------------------------------>    
  
        <?php    
        //Eventos

        // Fecha actual
        $fecha_actual = date("Y-m-d H:i:s");

        // Eventos
        $sql_evnt = "SELECT tbla_evnt.id AS evnt_id, evnt_ttlo, evnt_desc, evnt_fech, evnt_imgn, evnt_estd, evnt_freg, "
            ."tbla_evnc.id, evnc_nomb, evnc_estd "
            ."FROM tbla_evnt "
            ."INNER JOIN tbla_evnc ON (evnt_evnc = tbla_evnc.id) "
            ."WHERE evnt_fech >= '".$fecha_actual."' "
            ."ORDER BY evnt_fech ASC "
            ."LIMIT 0, 3";

        $query_evnt = $conec->dbQuery($sql_evnt, $debug);
        ?>
            
    
        <section class="about-section no-bg">
            <div class="container pt-80">
                <div class="holder pb-0"> 
                    <strong class="title">En esclusiva para ti</strong>
                    <h2>Nuestros Proximos Eventos</h2>
                    <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. </p>
                </div>
                <div class="bartenders-section">
                    <div class="row">
            
                        <?php
                        while ($datos_evnt = $conec->dbFetchObjet($query_evnt)){
                        ?>
                            <div class="col-md-4 col-sm-4">
                                <div class="box evnt_inicio">
                                    <div class="img-frame"><a href="<?php echo $path."app/eventos.php"; ?>"><img src="<?php echo $path."uploads/imagenes/eventos/".$datos_evnt->evnt_imgn; ?>" alt="<?php echo $datos_evnt->evnt_ttlo; ?>"></a></div>
                                    <div class="text-box">
                                        <a href="<?php echo $path."app/eventos.php"; ?>"><h2 class="font_gold"><?php echo $datos_evnt->evnt_ttlo; ?></h2></a>
                                        <p><?php echo AcortarTexto($datos_evnt->evnt_desc, 120); ?></p>
                                    </div>
                                    <div class="bartender-social text-center evnt_inicio_fech">
                                        <span><?php echo fecha ($datos_evnt->evnt_fech, 'fecha-completa'); ?></span>
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
 
<!------------------------------------------------------------------------------------------------------------------------------------------------------------>    
  
        <!--PARALLAX SECTION-->       
        <section class="parallax-section">
            <div class="container">
                <div class="holder"> <strong class="title font-62">Sorteos Diarios<br>
                    <span class="font-76">&iexcl;Participa y Gana!</span><br />
                    Botellas y Tragos
                    </strong>
                </div>
            </div>
        </section>
        <!--PARALLAX SECTION--> 
        
        
<!------------------------------------------------------------------------------------------------------------------------------------------------------------>    

        <!--Event Section-->
        <section class="event-section">
          <div class="container">
            <div class="holder"> <strong class="title">Jz Event</strong>
              <h2>Ucoming Events</h2>
              <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. </p>
              <p>Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. </p>
              <div class="center-block"><a href="event-detail.html" class="link">View Events</a><a href="event.html" class="link">Book Event</a></div>
            </div>
          </div>
        </section>
        <!--Event Section--> 

        <!--HOME GALLERY-->
        <section class="home-gallery gallery">
          <div class="img-frame"> <img src="images/gallery-home-img-1.jpg" alt="">
            <div class="caption">
              <div class="holder"> <a href="images/gallery-home-img-1.jpg" class="link" data-rel="prettyPhoto"><i class="fa fa-search" aria-hidden="true"></i></a> <a href="gallery-masonry.html" class="link"><i class="fa fa-link" aria-hidden="true"></i></a> </div>
            </div>
          </div>
          <div class="img-frame"> <img src="images/gallery-home-img-2.jpg" alt="">
            <div class="caption">
              <div class="holder"> <a href="images/gallery-home-img-2.jpg" class="link" data-rel="prettyPhoto"><i class="fa fa-search" aria-hidden="true"></i></a> <a href="gallery-masonry.html" class="link"><i class="fa fa-link" aria-hidden="true"></i></a> </div>
            </div>
          </div>
          <div class="img-frame"> <img src="images/gallery-home-img-3.jpg" alt="">
            <div class="caption">
              <div class="holder"> <a href="images/gallery-home-img-3.jpg" class="link" data-rel="prettyPhoto"><i class="fa fa-search" aria-hidden="true"></i></a> <a href="gallery-masonry.html" class="link"><i class="fa fa-link" aria-hidden="true"></i></a> </div>
            </div>
          </div>
          <div class="img-frame"> <img src="images/gallery-home-img-4.jpg" alt="">
            <div class="caption">
              <div class="holder"> <a href="images/gallery-home-img-4.jpg" class="link" data-rel="prettyPhoto"><i class="fa fa-search" aria-hidden="true"></i></a> <a href="gallery-masonry.html" class="link"><i class="fa fa-link" aria-hidden="true"></i></a> </div>
            </div>
          </div>
          <div class="img-frame"> <img src="images/gallery-home-img-5.jpg" alt="">
            <div class="caption">
              <div class="holder"> <a href="images/gallery-home-img-5.jpg" class="link" data-rel="prettyPhoto"><i class="fa fa-search" aria-hidden="true"></i></a> <a href="gallery-masonry.html" class="link"><i class="fa fa-link" aria-hidden="true"></i></a> </div>
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
                <form action="index.html#">
                  <input type="text" required>
                  <input type="submit" value="Subscribe">
                </form>
              </div>
            </div>
          </div>
        </section>
        <!--NEWSLETTER SECTION--> 
      </div>

        <?php
    }
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    //Pie de pagina
    $sjs = "";
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