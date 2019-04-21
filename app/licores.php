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
    $page_title = "Licores";
    $meta = "";
    $css = "";
    $js = "";
    $current = "licores";
    $content_class = "";
    $config = [];
    CommonHeader($path, $page_title, $meta, $css, $js, $current, $content_class, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
    // Validacion de la session
    if (SessionValidateUser($path, "user")){
    ?>
        <section class="about-section">
            <div class="container">

                <section class="tab-style-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="menu.html#tab-1" role="tab" data-toggle="tab">scotch rares</a></li>
                                    <li role="presentation"><a href="menu.html#tab-2" role="tab" data-toggle="tab">Jack Daniels</a></li>
                                    <li role="presentation"><a href="menu.html#tab-3" role="tab" data-toggle="tab">Civas Regal</a></li>
                                    <li role="presentation"><a href="menu.html#tab-4" role="tab" data-toggle="tab">Blue Lable</a></li>
                                    <li role="presentation"><a href="menu.html#tab-5" role="tab" data-toggle="tab">Bowmore</a></li>
                                </ul>
                            </div>
                            <div class="col-md-9 col-sm-8">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="tab-1">
                                        <div class="menu-box">
                                            <div class="text-col"> <strong class="title">Wytrawna Whisky</strong>
                                                <h2>Chivas Regal</h2>
                                                <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                                                <div class="text-box-outer">
                                                  <div class="text-box"> <span>Civas Regal ---------- 100 ml</span>
                                                    <p>Includes dry vermouth and olive brine 
                                                      shaken with ice and served with an olive</p>
                                                  </div>
                                                  <strong class="amount">$ 15.00</strong> 
                                                </div>
                                                <div class="text-box-outer">
                                                  <div class="text-box"> <span>Civas Regal ---------- 200 ml</span>
                                                    <p>Includes dry vermouth and olive brine 
                                                      shaken with ice and served with an olive</p>
                                                  </div>
                                                  <strong class="amount">$ 35.00</strong> 
                                                </div>
                                              <div class="text-box-outer">
                                                <div class="text-box"> <span>Civas Regal ---------- 350 ml</span>
                                                  <p>Includes dry vermouth and olive brine 
                                                    shaken with ice and served with an olive</p>
                                                </div>
                                                <strong class="amount">$ 65.00</strong> </div>
                                            </div>
                                          <div class="img-frame"><img src="images/tab-style-2-img-1.png" alt=""></div>
                                        </div>
                                        <div class="menu-box">
                                          <div class="text-col"> <strong class="title">Wytrawna Whisky</strong>
                                            <h2>Glengoyne 35 Years</h2>
                                            <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                                            <div class="text-box-outer">
                                              <div class="text-box"> <span>Civas Regal ---------- 100 ml</span>
                                                <p>Includes dry vermouth and olive brine 
                                                  shaken with ice and served with an olive</p>
                                              </div>
                                              <strong class="amount">$ 15.00</strong> </div>
                                            <div class="text-box-outer">
                                              <div class="text-box"> <span>Civas Regal ---------- 200 ml</span>
                                                <p>Includes dry vermouth and olive brine 
                                                  shaken with ice and served with an olive</p>
                                              </div>
                                              <strong class="amount">$ 35.00</strong> </div>
                                            <div class="text-box-outer">
                                              <div class="text-box"> <span>Civas Regal ---------- 350 ml</span>
                                                <p>Includes dry vermouth and olive brine 
                                                  shaken with ice and served with an olive</p>
                                              </div>
                                              <strong class="amount">$ 65.00</strong> </div>
                                          </div>
                                          <div class="img-frame"><img src="images/tab-style-2.png" alt=""></div>
                                        </div>
                                    </div>
                                  <div role="tabpanel" class="tab-pane" id="tab-2">
                                    <div class="menu-box">
                                      <div class="text-col"> <strong class="title">Wytrawna Whisky</strong>
                                        <h2>Chivas Regal</h2>
                                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 100 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 15.00</strong> </div>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 200 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 35.00</strong> </div>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 350 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 65.00</strong> </div>
                                      </div>
                                      <div class="img-frame"><img src="images/tab-style-2-img-1.png" alt=""></div>
                                    </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane" id="tab-3">
                                    <div class="menu-box">
                                      <div class="text-col"> <strong class="title">Wytrawna Whisky</strong>
                                        <h2>Glengoyne 35 Years</h2>
                                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 100 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 15.00</strong> </div>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 200 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 35.00</strong> </div>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 350 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 65.00</strong> </div>
                                      </div>
                                      <div class="img-frame"><img src="images/tab-style-2.png" alt=""></div>
                                    </div>
                                    <div class="menu-box">
                                      <div class="text-col"> <strong class="title">Wytrawna Whisky</strong>
                                        <h2>Chivas Regal</h2>
                                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 100 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 15.00</strong> </div>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 200 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 35.00</strong> </div>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 350 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 65.00</strong> </div>
                                      </div>
                                      <div class="img-frame"><img src="images/tab-style-2-img-1.png" alt=""></div>
                                    </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane" id="tab-4">
                                    <div class="menu-box">
                                      <div class="text-col"> <strong class="title">Wytrawna Whisky</strong>
                                        <h2>Chivas Regal</h2>
                                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 100 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 15.00</strong> </div>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 200 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 35.00</strong> </div>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 350 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 65.00</strong> </div>
                                      </div>
                                      <div class="img-frame"><img src="images/tab-style-2-img-1.png" alt=""></div>
                                    </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane" id="tab-5">
                                    <div class="menu-box">
                                      <div class="text-col"> <strong class="title">Wytrawna Whisky</strong>
                                        <h2>Chivas Regal</h2>
                                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 100 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 15.00</strong> </div>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 200 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 35.00</strong> </div>
                                        <div class="text-box-outer">
                                          <div class="text-box"> <span>Civas Regal ---------- 350 ml</span>
                                            <p>Includes dry vermouth and olive brine 
                                              shaken with ice and served with an olive</p>
                                          </div>
                                          <strong class="amount">$ 65.00</strong> </div>
                                      </div>
                                      <div class="img-frame"><img src="images/tab-style-2-img-1.png" alt=""></div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
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