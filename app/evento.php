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
        
    // Validacion de la session
    if (SessionValidate($path, "user")){
        ?>
    
        <section class="blog-section">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-sm-8">
                <div class="post-box">
                  <div class="img-frame">
                      <a href="event-detail.html#">
                          <img src="images/blog-img-4.jpg" alt="">
                      </a>
                  </div>
                  <div class="text-box">
                    <div class="heading-row"> <strong class="date">06<span>July</span></strong>
                      <h2><a href="event-detail.html#">LOREM RUTRUM FEUGIAT</a></h2>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non laoreet dui. Morbi lacus massa, euismod ut turpis molestie, tristique sodales est. Integer sit amet mi id sapien tempor molestie in nec massa.</p>
                    <p>Fusce non ante sed lorem rutrum feugiat. Vestibulum pellentesque, purus ut dignissim consectetur, nulla erat ultrices purus, ut consequat sem elit non sem. Morbi lacus massa, euismod ut turpis molestie, tristique sodales est. Integer sit amet mi id sapien tempor molestie in nec massa. Fusce non ante sed lorem rutrum feugiat.</p>
                     <div class="comment-box">
                      <form action="event-detail.html#">
                        <div class="row">

                          <div class="col-md-12">
                            <input value="Reservar" type="submit">
                          </div>
                        </div>
                      </form>
                    </div>


                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-4">
                <aside>
                  <div class="sidebar">

                    <div class="widget-box">
                      <div class="popular-post-widget">
                        <h3>POPULAR POST</h3>
                        <ul>
                          <li>
                            <div class="thumb"><a href="event-detail.html#"><img src="images/popular-post-img-1.jpg" alt=""></a></div>
                            <div class="text-col"> <a href="event-detail.html#">FUSCE NON ANTE SED LOREM RUTRUM FEUGIAT</a> <span class="date">21 Jul, 2016</span> </div>
                          </li>
                          <li>
                            <div class="thumb"><a href="event-detail.html#"><img src="images/popular-post-img-2.jpg" alt=""></a></div>
                            <div class="text-col"> <a href="event-detail.html#">EXCEPTEUR SLINT OCCAECAT CUPLDATAT</a> <span class="date">19 Jul, 2016</span> </div>
                          </li>
                          <li>
                            <div class="thumb"><a href="event-detail.html#"><img src="images/popular-post-img-3.jpg" alt=""></a></div>
                            <div class="text-col"> <a href="event-detail.html#">SUNT IN CULPA QUI OFFICIA DESERUNT</a> <span class="date">16 Jul, 2016</span> </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="widget-box">
                      <div class="categories-widget">
                        <h3>CATEGORIES</h3>
                        <ul>
                          <li><a href="event-detail.html#">Wishky<span>(04)</span></a></li>
                          <li><a href="event-detail.html#">Beer<span>(12)</span></a></li>
                          <li><a href="event-detail.html#">Wine<span>(08)</span></a></li>
                          <li><a href="event-detail.html#">Foods<span>(03)</span></a></li>
                        </ul>
                      </div>
                    </div>

                  </div>
                </aside>
              </div>
            </div>
          </div>
        </section>
        
    <?php
    }
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    //Pie de pagina
    $sjs = "";
    $config_footer = [];
    CommonFooter($path, $sjs, $config_footer);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
?>