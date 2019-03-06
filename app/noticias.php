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
    $page_title = "Novedades";
    $meta = "";
    $css = "";
    $js = "";
    $current = "novedades";
    $content_class = "";
    $config = [];
    CommonHeader($path, $page_title, $meta, $css, $js, $current, $content_class, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
   
    // Fecha actual
    $fecha_actual = date("Y-m-d H:i:s");
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
 
    // Consultas de las busquedas 
    if ((isset($_POST['control'])) && ($_POST['control'] = 1)){

                
        $buscador = ReemSpecialChars(strip_tags($_POST['buscador']));

        $query = "SELECT tbla_notc.id AS id_notc, notc_nott, notc_ctgn, notc_adms, notc_ttlo, notc_entr, notc_cuer, notc_fech, notc_fpub, notc_fnte, notc_img1, notc_cpt1, notc_img2, notc_cpt2, notc_img3, notc_cpt3, notc_yutb, notc_estd, notc_freg, tbla_ctgn.id AS id_ctgn, ctgn_nomb "
            ."FROM tbla_notc INNER JOIN tbla_ctgn ON (notc_ctgn = tbla_ctgn.id) WHERE (notc_ttlo LIKE '%".$buscador."%' "
            ."OR notc_entr LIKE '%".$buscador."%' OR notc_cuer LIKE '%".$buscador."%') "
            ."AND (notc_estd = '1') AND (notc_fpub <= '".date("Y\-m\-d", strtotime($fecha_actual))."')";	
    }
    
    // Busqueda por categorias
    elseif (isset ($_GET['ctgn'])) {
        $query = "SELECT tbla_notc.id AS id_notc, notc_nott, notc_ctgn, notc_adms, notc_ttlo, notc_entr, notc_cuer, notc_fech, notc_fpub, notc_fnte, notc_img1, notc_cpt1, notc_img2, notc_cpt2, notc_img3, notc_cpt3, notc_yutb, notc_estd, notc_freg, tbla_ctgn.id AS id_ctgn, ctgn_nomb "
            ."FROM tbla_notc INNER JOIN tbla_ctgn ON (notc_ctgn = tbla_ctgn.id) WHERE notc_ctgn = '".$_GET['ctgn']."'";   
    }
    
    // Busqueda por fuente
    elseif (isset ($_GET['fnte'])) {
        
        $fnte = ReemSpecialChars(strip_tags($_GET['fnte']));
        
        $query = "SELECT tbla_notc.id AS id_notc, notc_nott, notc_ctgn, notc_adms, notc_ttlo, notc_entr, notc_cuer, notc_fech, notc_fpub, notc_fnte, notc_img1, notc_cpt1, notc_img2, notc_cpt2, notc_img3, notc_cpt3, notc_yutb, notc_estd, notc_freg, tbla_ctgn.id AS id_ctgn, ctgn_nomb "
            ."FROM tbla_notc INNER JOIN tbla_ctgn ON (notc_ctgn = tbla_ctgn.id) WHERE notc_fnte LIKE '%".$fnte."%'";   
    }
    
    // Busqueda por administrador
    elseif (isset ($_GET['adms'])) {
        $query = "SELECT tbla_notc.id AS id_notc, notc_nott, notc_ctgn, notc_adms, notc_ttlo, notc_entr, notc_cuer, notc_fech, notc_fpub, notc_fnte, notc_img1, notc_cpt1, notc_img2, notc_cpt2, notc_img3, notc_cpt3, notc_yutb, notc_estd, notc_freg, tbla_ctgn.id AS id_ctgn, ctgn_nomb "
            ."FROM tbla_notc INNER JOIN tbla_ctgn ON (notc_ctgn = tbla_ctgn.id) WHERE notc_adms = '".$_GET['adms']."'";       
    }
    
    // Busqueda por archivo (mes y agno)
    elseif ((isset($_GET['month'])) && (isset($_GET['year']))) {
        $query = "SELECT tbla_notc.id AS id_notc, notc_nott, notc_ctgn, notc_adms, notc_ttlo, notc_entr, notc_cuer, notc_fech, notc_fpub, notc_fnte, notc_img1, notc_cpt1, notc_img2, notc_cpt2, notc_img3, notc_cpt3, notc_yutb, notc_estd, notc_freg, tbla_ctgn.id AS id_ctgn, ctgn_nomb FROM tbla_notc INNER JOIN tbla_ctgn ON (notc_ctgn = tbla_ctgn.id) WHERE (MONTH(notc_fech) = ".$_GET['month'].") AND (YEAR(notc_fech) = ".$_GET['year'].") AND notc_estd = 1";
    }
    
    // Busqueda por defecto
    else {
        $query = "SELECT tbla_notc.id AS id_notc, notc_nott, notc_ctgn, notc_adms, notc_ttlo, notc_entr, notc_cuer, notc_fech, notc_fpub, notc_fnte, notc_img1, notc_cpt1, notc_img2, notc_cpt2, notc_img3, notc_cpt3, notc_yutb, notc_estd, notc_freg, tbla_ctgn.id AS id_ctgn, ctgn_nomb "
            ."FROM tbla_notc INNER JOIN tbla_ctgn ON (notc_ctgn = tbla_ctgn.id) WHERE (notc_estd = '1') AND (notc_fpub <= '".date("Y\-m\-d H:i:s", strtotime($fecha_actual))."') ";
    }
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
  
    // Paginacion - variables para el manejo de la paginacion

    $varurl = "";
    $orden = "notc_fech DESC";

    // Numero de registros por pagina // por defecto son 10
    $ndr = 5;

    $_pagi_sql = $query;	
    $_pagi_cuantos	= $ndr;
    $_pagi_nav_num_enlaces = 5;
    $_pagi_mostrar_errores = "false";
    $_pagi_buscador = $varurl;
    // $_pagi_propagar
    // $_pagi_conteo_alternativo
    // $_pagi_separador	
    $_pagi_nav_estilo_center = "";
    $_pagi_nav_estilo_actual = "active";
    $_pagi_nav_estilo_inicio = "";
    $_pagi_nav_estilo_anterior = "";
    $_pagi_nav_estilo_siguiente = "";
    $_pagi_nav_estilo_ultimo = "";
    $_pagi_nav_anterior = "< \n";
    $_pagi_nav_siguiente = "> \n";
    $_pagi_nav_primera  = "<< \n";
    $_pagi_nav_ultima  = ">> \n";
    $_pagi_fondo_boton = "";
    $_pagi_order = $orden;

    include $path.'app/includes/paginator.my.inc.php';     
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
    ?>
    
    <div class="row">
        <div class="col-sm-8 col-md-9">
            <div class="main-page">
                <div class="page-content clearfix">
            
                    <ul class="blog-posts">
                        
                        <?php
                        // Ciclo para mostrar los registros de las noticias
                        while ($datos_notc = $conec->dbFetchObjet($_pagi_result)) { 

                            // Consulta del administrador que publico la noticia
                            $sql_adms = "SELECT id, adms_nomb, adms_apll FROM tbla_adms WHERE id = '".$datos_notc->notc_adms."'";
                            $query_adms = $conec->dbQuery($sql_adms, $debug);
                            $datos_adms = $conec->dbFetchObjet($query_adms); 
                            ?>    
                        
                            <li class="post-item">
                                <article class="entry">
                                    <div class="entry-ci">
                                        <div class="entry-thumb image-hover2">
                                            <a href="<?php echo $path."app/noticia.php?id=".$datos_notc->id_notc; ?>">
                                                <?php
                                                switch ($datos_notc->notc_nott){
                                                    case 1:
                                                        ?>
                                                        <img src="<?php echo $path."uploads/imagenes/noticias/".$datos_notc->notc_img1; ?>" alt="<?php $datos_notc->notc_img1; ?>" class="img-responsive img-fullwidth"> 
                                                        <?php
                                                    break;
                                                    case 2:
                                                        ?>
                                                        <div class="owl-carousel-1col" data-nav="true">
                                                            <div class="item">
                                                                <img width="100%" src="<?php echo $path."uploads/imagenes/noticias/".$datos_notc->notc_img1; ?>" alt="<?php $datos_notc->notc_ttlo; ?>" class="img-responsive img-fullwidth">
                                                            </div>
                                                            <div class="item">
                                                                <img width="100%" src="<?php echo $path."uploads/imagenes/noticias/".$datos_notc->notc_img2; ?>" alt="<?php $datos_notc->notc_ttlo; ?>" class="img-responsive img-fullwidth">
                                                            </div>
                                                            <div class="item">
                                                                <img width="100%" src="<?php echo $path."uploads/imagenes/noticias/".$datos_notc->notc_img3; ?>" alt="<?php $datos_notc->notc_ttlo; ?>" class="img-responsive img-fullwidth">
                                                            </div>
                                                        </div>
                                                        <?php
                                                    break;
                                                    case 3:
                                                        $codigo_video = getYoutubeID($datos_notc->notc_yutb);
                                                        $imagen = "http://img.youtube.com/vi/".$codigo_video."/mqdefault.jpg";
                                                        ?>
                                                        <iframe width="100%" height="460" src="https://www.youtube.com/embed/<?php echo $codigo_video; ?>" allowfullscreen></iframe>
                                                        <?php
                                                    break;
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <h3 class="entry-title"><a href="<?php echo $path."app/noticia.php?id=".$datos_notc->id_notc; ?>"><?php echo $datos_notc->notc_ttlo; ?></a></h3>
                                        <div class="entry-meta-data">
                                            <span class="author">
                                            <i class="fa fa-user"></i> 
                                            por: <a href="<?php echo $path."app/noticias.php?adms=".$datos_notc->notc_adms; ?>"><?php echo $datos_adms->adms_nomb." ".$datos_adms->adms_apll; ?></a></span>
                                            <span class="cat">
                                                <i class="fa fa-folder-o"></i>
                                                <a href="<?php $path."app/noticias.php?ctgn=".$datos_notc->notc_ctgn; ?>"><?php echo $datos_notc->ctgn_nomb; ?></a>
                                            </span>
                                            <span class="date"><i class="fa fa-calendar"></i> <?php echo Fecha($datos_notc->notc_fech, "fecha"); ?></span>
                                        </div>
                                        <div class="entry-excerpt">
                                            <?php echo $datos_notc->notc_entr; ?>
                                        </div>
                                        <div class="entry-more">
                                            <a class="button" href="<?php echo $path."app/noticia.php?id=".$datos_notc->id_notc; ?>">Leer M&aacute;s</a>
                                        </div>
                                    </div>
                                </article>
                            </li>
                    
                        <?php
                        }
                        ?>
                    </ul>
                    <div class="sortPagiBar">
                        <div class="sortPagiBar-inner">
                            <nav>
                              <ul class="pagination">
                                <?php echo $_pagi_navegacion; ?>
                              </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            include_once $path.'app/noticias_sidebar.php';
        ?>
    </div>
    
    <?php
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    //Pie de pagina
    $sjs = "";
    $config['top-footer'] = TRUE;
    CommonFooter($path, $sjs, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
?>