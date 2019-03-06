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
    $content_class = "contact-page";
    $config = [];
    CommonHeader($path, $page_title, $meta, $css, $js, $current, $content_class, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
   
    ?>
    
    <div class="row">

        <div class="col-sm-8 col-md-9">
            <div class="main-page">
                <div class="page-content clearfix">
                    <article class="entry-detail">
                
                <div class="entry-photo">
                    <img src="data/blogs/blog-full.jpg" alt="Blog">
                </div>
                <h1 class="page-title">Sed ut perspiciatis unde omnis iste natus error</h1>
                <div class="entry-meta-data">
                    <span class="author">
                    <i class="fa fa-user"></i> 
                    by: <a href="post.html#">Admin</a></span>
                    <span class="cat">
                        <i class="fa fa-folder-o"></i>
                        <a href="post.html#">News, </a>
                        <a href="post.html#">Promotions</a>
                    </span>
                    <span class="comment-count">
                        <i class="fa fa-comment-o"></i> 3
                    </span>
                    <span class="date"><i class="fa fa-calendar"></i> 2014-08-05 07:01:49</span>
                    <span class="post-star">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(7 votes)</span>
                    </span>
                </div>
                <div class="entry-content clearfix">
                    <p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consecvtetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel.</p>

                    <p>Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>

                    <p>Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, <a href="post.html#">malesuada at</a>, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. </p>

                    <p>Nam elit agna,endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae,dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl. </p>
                    <p>Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>

                    <p>Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, <a href="post.html#">malesuada at</a>, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. </p>
                </div>
            </article>

    </div>
            </div>
        </div>
        
        <div class="col-sm-4 col-md-3">
                <div class="block block-widget mt-0">
                        <div class="block-head">
                                <h5 class="widget-title">BLOG CATEGORIES</h5>
                        </div>
                        <div class="block-inner">
                                <ul class="list-link">
                                        <li><a href="blog.html#">News</a></li>
                                        <li><a href="blog.html#">About Beauty</a></li>
                                        <li><a href="blog.html#">Baby & Mom</a></li>
                                        <li><a href="blog.html#">Diet & Fitness</a></li>
                                        <li><a href="blog.html#">Media</a></li>
                                        <li><a href="blog.html#">Makeup</a></li>
                                        <li><a href="blog.html#">Design</a></li>
                                        <li><a href="blog.html#">Fashion</a></li>
                                        <li><a href="blog.html#">Templates</a></li>
                                        <li><a href="blog.html#">Other</a></li>

                                </ul>
                        </div>
                </div>
                <div class="block block-widget">
                        <div class="block-head">
                                <h5 class="widget-title">POPULAR POSTS</h5>
                        </div>
                        <div class="block-inner">
                                <ul class="list-posts-widget">
                                        <li>
                                                <div class="post-thumb">
                                                        <a href="post.html"><img src="data/blogs/1.jpg" alt="Blog"></a>
                                                </div>
                                                <div class="post-info">
                                                        <h5 class="entry_title"><a href="post.html">Lorem ipsum dolor sit amet</a></h5>
                                                        <div class="post-meta">
                    <span class="date"><i class="fa fa-calendar"></i> 2014-08-05</span>
                    <span class="comment-count">
                        <i class="fa fa-comment-o"></i> 3
                    </span>
                </div>
                                                </div>
                                        </li>
                                        <li>
                                                <div class="post-thumb">
                                                        <a href="post.html"><img src="data/blogs/2.jpg" alt="Blog"></a>
                                                </div>
                                                <div class="post-info">
                                                        <h5 class="entry_title"><a href="post.html">Lorem ipsum dolor sit amet</a></h5>
                                                        <div class="post-meta">
                    <span class="date"><i class="fa fa-calendar"></i> 2014-08-05</span>
                    <span class="comment-count">
                        <i class="fa fa-comment-o"></i> 3
                    </span>
                </div>
                                                </div>
                                        </li>
                                        <li>
                                                <div class="post-thumb">
                                                        <a href="post.html"><img src="data/blogs/3.jpg" alt="Blog"></a>
                                                </div>
                                                <div class="post-info">
                                                        <h5 class="entry_title"><a href="post.html">Lorem ipsum dolor sit amet</a></h5>
                                                        <div class="post-meta">
                    <span class="date"><i class="fa fa-calendar"></i> 2014-08-05</span>
                    <span class="comment-count">
                        <i class="fa fa-comment-o"></i> 3
                    </span>
                </div>
                                                </div>
                                        </li>
                                </ul>
                        </div>
                </div>
                
                <div class="block block-widget">
                        <div class="block-head">
                                <h5 class="widget-title">Tags</h5>
                        </div>
                        <div class="block-inner">
                                <div class="tagcloud">
                                        <a href="blog.html#">actual</a>
                                        <a href="blog.html#">adorable</a>
                                        <a href="blog.html#">change</a>
                                        <a href="blog.html#">consider</a>
                                        <a href="blog.html#">phenomeno</a>
                                        <a href="blog.html#">span</a>
                                        <a href="blog.html#">spanegs</a>
                                        <a href="blog.html#">change</a>
                                        <a href="blog.html#">gives</a>
                                        <a href="blog.html#">good</a>
                                        <a href="blog.html#">spanegs</a>
                                        <a href="blog.html#">change</a>
                                        <a href="blog.html#">consider</a>
                                        <a href="blog.html#">gives</a>
                                        <a href="blog.html#">good</a>
                                </div>
                        </div>
                </div>
                <div class="block-sidebar-img banner-hover">
                        <a href="blog.html#"><img src="data/banner/2.jpg" alt="Banner"></a>
                </div>
        </div>
        
    </div>
    
    <?php
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    //Pie de pagina
    $sjs = "";
    $config['top-footer'] = TRUE;
    CommonFooter($path, $sjs, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
?>