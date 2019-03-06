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
    <div class="maso-list">
                <div class="navbar navbar-inner">
                    <div class="navbar-toggle"><i class="fa fa-bars"></i><span>Menu</span><i class="fa fa-angle-down"></i></div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav over ms-minimal inner maso-filters">
                            <li class="current-active active"><a data-filter="maso-item">All</a></li>
                            <li><a data-filter="cat1">January</a></li>
                            <li><a data-filter="cat2">February</a></li>
                            <li><a data-filter="cat3">March</a></li>
                            <li><a data-filter="cat4">April</a></li>
                            <li><a data-filter="cat5">May</a></li>
                            <li><a data-filter="cat6">June</a></li>
                            <li><a data-filter="cat7">July</a></li>
                            <li><a data-filter="cat8">August</a></li>
                            <li><a data-filter="cat9">September</a></li>
                            <li><a data-filter="cat10">October</a></li>
                            <li><a data-filter="cat11">November</a></li>
                            <li><a data-filter="cat12">December</a></li>
                            <li><a data-filter="cat13">PAST EVENTS</a></li>
                        </ul>
                    </div>
                </div>
                <div class="maso-box row" data-options="anima:fade-in">
                    <div data-sort="1" class="maso-item col-md-4 cat1">
                        <div class="advs-box advs-box-multiple boxed" data-anima="scale-rotate" data-trigger="hover">
                            <a class="img-box" href="single-event.html"><img alt="" class="anima" src="images/events/image-7.jpg" /></a>
                            <div class="circle anima-rotate-20 anima">02 <span>JAN, 17</span></div>
                            <div class="advs-box-content">
                                <h3><a href="single-event.html">Neon Night and lights show</a></h3>
                                <p>
                                    L'orem ipsum dolor "sitamet", consectetur 'adipisicing' elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, q rem aperiam ...
                                </p>
                                <a class="anima-button circle-button btn-sm" href="single-event.html"><i class="fa fa-long-arrow-right"></i>Event details </a>
                            </div>
                        </div>
                    </div>
                    <div data-sort="2" class="maso-item col-md-4 cat1">
                        <div class="advs-box advs-box-multiple boxed" data-anima="scale-rotate" data-trigger="hover">
                            <a class="img-box" href="single-event.html"><img alt="" class="anima" src="images/events/image-8.jpg" /></a>
                            <div class="circle anima-rotate-20 anima">12 <span>JAN, 17</span></div>
                            <div class="advs-box-content">
                                <h3><a href="single-event.html">NYE Party of the yaer</a></h3>
                                <p>
                                    L'orem ipsum dolor "sitamet", consectetur 'adipisicing' elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, q rem aperiam ...
                                </p>
                                <a class="anima-button circle-button btn-sm" href="single-event.html"><i class="fa fa-long-arrow-right"></i>Event details </a>
                            </div>
                        </div>
                    </div>
                    <div data-sort="3" class="maso-item col-md-4 cat2">
                        <div class="advs-box advs-box-multiple boxed" data-anima="scale-rotate" data-trigger="hover">
                            <a class="img-box" href="single-event.html"><img alt="" class="anima" src="images/events/image-2.jpg" /></a>
                            <div class="circle anima-rotate-20 anima">22 <span>FEB, 17</span></div>
                            <div class="advs-box-content">
                                <h3><a href="single-event.html">Raven girls party</a></h3>
                                <p>
                                    L'orem ipsum dolor "sitamet", consectetur 'adipisicing' elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, q rem aperiam ...
                                </p>
                                <a class="anima-button circle-button btn-sm" href="single-event.html"><i class="fa fa-long-arrow-right"></i>Event details </a>
                            </div>
                        </div>
                    </div>
                    <div data-sort="4" class="maso-item col-md-4 cat3">
                        <div class="advs-box advs-box-multiple boxed" data-anima="scale-rotate" data-trigger="hover">
                            <a class="img-box" href="single-event.html"><img alt="" class="anima" src="images/events/image-3.jpg" /></a>
                            <div class="circle anima-rotate-20 anima">13 <span>MAR, 17</span></div>
                            <div class="advs-box-content">
                                <h3><a href="single-event.html">Valentine day - Love</a></h3>
                                <p>
                                    L'orem ipsum dolor "sitamet", consectetur 'adipisicing' elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, q rem aperiam ...
                                </p>
                                <a class="anima-button circle-button btn-sm" href="single-event.html"><i class="fa fa-long-arrow-right"></i>Event details </a>
                            </div>
                        </div>
                    </div>
                    <div data-sort="5" class="maso-item col-md-4 cat3">
                        <div class="advs-box advs-box-multiple boxed" data-anima="scale-rotate" data-trigger="hover">
                            <a class="img-box" href="single-event.html"><img alt="" class="anima" src="images/events/image-1.jpg" /></a>
                            <div class="circle anima-rotate-20 anima">15 <span>MAR, 17</span></div>
                            <div class="advs-box-content">
                                <h3><a href="single-event.html">Trance DJ Contest</a></h3>
                                <p>
                                    L'orem ipsum dolor "sitamet", consectetur 'adipisicing' elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, q rem aperiam ...
                                </p>
                                <a class="anima-button circle-button btn-sm" href="single-event.html"><i class="fa fa-long-arrow-right"></i>Event details </a>
                            </div>
                        </div>
                    </div>
                    <div data-sort="6" class="maso-item col-md-4 cat10">
                        <div class="advs-box advs-box-multiple boxed" data-anima="scale-rotate" data-trigger="hover">
                            <a class="img-box" href="single-event.html"><img alt="" class="anima" src="images/events/image-4.jpg" /></a>
                            <div class="circle anima-rotate-20 anima">19 <span>OCT, 17</span></div>
                            <div class="advs-box-content">
                                <h3><a href="single-event.html">Gold night with good drinks</a></h3>
                                <p>
                                    L'orem ipsum dolor "sitamet", consectetur 'adipisicing' elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, q rem aperiam ...
                                </p>
                                <a class="anima-button circle-button btn-sm" href="single-event.html"><i class="fa fa-long-arrow-right"></i>Event details </a>
                            </div>
                        </div>
                    </div>
                    <div data-sort="7" class="maso-item col-md-4 cat10">
                        <div class="advs-box advs-box-multiple boxed" data-anima="scale-rotate" data-trigger="hover">
                            <a class="img-box" href="single-event.html"><img alt="" class="anima" src="images/events/image-5.jpg" /></a>
                            <div class="circle anima-rotate-20 anima">20 <span>OCT, 17</span></div>
                            <div class="advs-box-content">
                                <h3><a href="single-event.html">No man party - only womans</a></h3>
                                <p>
                                    L'orem ipsum dolor "sitamet", consectetur 'adipisicing' elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, q rem aperiam ...
                                </p>
                                <a class="anima-button circle-button btn-sm" href="single-event.html"><i class="fa fa-long-arrow-right"></i>Event details </a>
                            </div>
                        </div>
                    </div>
                    <div data-sort="8" class="maso-item col-md-4 cat11">
                        <div class="advs-box advs-box-multiple boxed" data-anima="scale-rotate" data-trigger="hover">
                            <a class="img-box" href="single-event.html"><img alt="" class="anima" src="images/events/image-6.jpg" /></a>
                            <div class="circle anima-rotate-20 anima">10 <span>NOV, 17</span></div>
                            <div class="advs-box-content">
                                <h3><a href="single-event.html">Singles meeting - no couples</a></h3>
                                <p>
                                    L'orem ipsum dolor "sitamet", consectetur 'adipisicing' elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, q rem aperiam ...
                                </p>
                                <a class="anima-button circle-button btn-sm" href="single-event.html"><i class="fa fa-long-arrow-right"></i>Event details </a>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="list-nav">
                    <a href="events.html#" class="circle-button btn-sm btn load-more-maso" data-page-items="3">Load More <i class="fa fa-arrow-down"></i></a>
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