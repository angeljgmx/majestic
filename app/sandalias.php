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
    $page_title = "Colecci&oacute;n";
    $meta = "";
    $css = "";
    $js = "";
    $current = "coleccion";
    $content_class = "";
    $config['body-option'] = 9;
    CommonHeader($path, $page_title, $meta, $css, $js, $current, $content_class, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
   
    $query_base = "SELECT tbla_prod.id AS prod_id, prod_ptrn, prod_nomb, prod_img1, prod_prts, prod_prtt, prod_estd, prod_freg, "
            ."tbla_ptrn.id AS ptrn_id, ptrn_nomb, ptrn_prln, ptrn_estd, "
            ."tbla_prln.id AS prln_id, prln_nomb, prln_prct, prln_estd, "
            ."tbla_prct.id AS prct_id, prct_nomb, prct_estd, "
            ."tbla_prts.id AS prts_id, prts_nomb, prts_estd, "
            ."tbla_prtt.id AS prtt_id, prtt_nomb, prtt_estd "
            ."FROM tbla_prod "
            ."INNER JOIN tbla_ptrn ON (tbla_ptrn.id = prod_ptrn) "
            ."INNER JOIN tbla_prln ON (tbla_prln.id = ptrn_prln) "
            ."INNER JOIN tbla_prct ON (tbla_prct.id = prln_prct) "
            ."INNER JOIN tbla_prts ON (tbla_prts.id = prod_prts) "
            ."INNER JOIN tbla_prtt ON (tbla_prtt.id = prod_prtt) ";

    // Busqueda por patron
    if (null !== filter_input(INPUT_GET, 'ptrn', FILTER_SANITIZE_NUMBER_INT)){        
        $ptrn = filter_input(INPUT_GET, 'ptrn', FILTER_SANITIZE_NUMBER_INT);        
        $query_esp = "WHERE (tbla_prtn.id = '".$ptrn."') AND (prod_estd = 1) AND (ptrn_estd = 1) ";   
    }
    
    // Busqueda por categorias
    if (null !== filter_input(INPUT_GET, 'ctgr', FILTER_SANITIZE_NUMBER_INT)){        
        $ctgr = filter_input(INPUT_GET, 'ctgr', FILTER_SANITIZE_NUMBER_INT);        
        $query_esp = "WHERE (tbla_prct.id = '".$ctgr."') AND (prod_estd = 1)";      
    }

    // Busqueda por lineas
    elseif (null !== filter_input(INPUT_GET, 'lnea', FILTER_SANITIZE_NUMBER_INT)){         
        $lnea = filter_input(INPUT_GET, 'lnea', FILTER_SANITIZE_NUMBER_INT);        
        $query_esp = "WHERE (tbla_prln.id = '".$lnea."') AND (prod_estd = 1)";      
    }
    
    // Busqueda por tipo
    elseif (null !== filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_NUMBER_INT)){         
        $tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_NUMBER_INT);        
        $query_esp = "WHERE (tbla_prtp.id = '".$tipo."') AND (prtp_estd = 1)";      
    }
    
    // Buscador nombre
    elseif (null !== filter_input(INPUT_POST, 'busc_nomb', FILTER_SANITIZE_STRING)){        
        $busc_nomb = filter_input(INPUT_POST, 'busc_nomb', FILTER_SANITIZE_STRING);
        $query_esp = "WHERE (prod_nomb LIKE '%".$busc_nomb."%') AND (prod_estd = 1)";;
    }

    // Busqueda por defecto
    else {
        $query_esp = "WHERE (prod_estd = 1)";
    }
    
    echo $query = $query_base.$query_esp;
 //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
   
    // Paginacion - variables para el manejo de la paginacion
    $varurl = "";
    $orden = "prod_nomb DESC";

    // Numero de registros por pagina // por defecto son 10
    $ndr = 12;

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
    $_pagi_nav_estilo_siguiente = "next";
    $_pagi_nav_estilo_ultimo = "";
    $_pagi_nav_anterior = "< \n";
    $_pagi_nav_siguiente = "> \n";
    $_pagi_nav_primera  = "<< \n";
    $_pagi_nav_ultima  = ">> \n";
    $_pagi_fondo_boton = "";
    $_pagi_order = $orden;

    include $path.'app/includes/paginator.my.inc.php';  
    
    // Numero de resultados por consulta
    $nquery = $conec->dbQuery($query, $debug);
    $nrsult = $conec->dbNumRows($nquery);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    
?>
    





    <div class="row">
        
        <div class="col-xs-12 col-sm-8 col-md-9">
            <div class="block block-categories-slider">
                <div class="list kt-owl-carousel" data-animateout="fadeOut" data-animateIn="fadeIn" data-items="1" data-autoplay="true" data-margin="0" data-loop="true" data-nav="true">
                    <a href="category-grid2.html#"><img src="data/option1/slider-cat.jpg" alt="slider-cat.jpg"></a>
                    <a href="category-grid2.html#"><img src="data/option1/slider-cat2.jpg" alt="slider-cat2.jpg"></a>
                </div>
            </div>
            <h3 class="page-title">
                <span class="font-30 text-raleway">Sandalias Disponibles</span>

            </h3>
                    
            <?php // Condicion para pmostrar resultados
            if ($nrsult > 0){  
            ?>
                <div class="category-products bg-color-white pl-20 pr-20">
                    <ul class="products row ">


                        <?php
                        // Ciclo para mostrar los productos                
                        while ($datos_prod = $conec->dbFetchObjet($_pagi_result)) {  ?>
                            <li class="product col-xs-12 col-sm-6 col-md-4">
                                <div class="product-container">
                                    <div class="inner">
                                        <div class="product-left">
                                            <div class="product-thumb">
                                                <a class="product-img" href="<?php echo $path."app/sandalia.php?prod=".$datos_prod->prod_id; ?>">
                                                    <img src="<?php echo $path."uploads/imagenes/productos/".$datos_prod->prod_img1; ?>" alt="<?php echo $datos_prod->prod_nomb; ?>" />
                                                </a>
                                                <a title="Quick View" href="quick-view.html" class="btn-quick-view  fancybox.iframe">Quick View</a>
                                            </div>
                                        </div>
                                        <div class="product-right">
                                            <div class="product-name">
                                                <a href="<?php echo $path."app/sandalia.php?prod=".$datos_prod->prod_id; ?>"><?php echo $datos_prod->prod_nomb; ?></a>
                                            </div>
                                            <div class="price-box">
                                                <span class="product-price">$139.98</span>
                                                <span class="product-price-old">$169.00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                            <div class="product-button">
                                                <a class="btn-add-wishlist" title="Add to Wishlist" href="category-grid2.html#">Add Wishlist</a>
                                                <a class="btn-add-comparre" title="Add to Compare" href="category-grid2.html#">Add Compare</a>
                                                <a class="button-radius btn-add-cart" title="Add to Cart" href="<?php echo $path."app/sandalia.php?prod=".$datos_prod->prod_id; ?>">Ver detalles<span class="icon"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php
                        } ?> 
                    </ul>
                </div>
            
                <div class="sortPagiBar bg-color-white pb-20 pt-20 pl-20 pr-20">
                    <ul class="display-product-option">
                        <li class="view-as-grid selected">
                            <span>grid</span>
                        </li>
                        <li class="view-as-list">
                            <span>list</span>
                        </li>
                    </ul>
                    <div class="sortPagiBar-inner">
                        <nav>
                            <ul class="pagination">
                                <li class="active"><a href="category-grid2.html#">1</a></li>
                                <li><a href="category-grid2.html#">2</a></li>
                                <li><a href="category-grid2.html#">3</a></li>
                                <li><a href="category-grid2.html#">4</a></li>
                                <li><a href="category-grid2.html#">5</a></li>
                                <li>
                                    <a href="category-grid2.html#" aria-label="Next">
                                        <span aria-hidden="true">Next »</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="show-product-item">
                            <select class="">
                                <option value="1">Show 6</option>
                                <option value="1">Show 12</option>
                            </select>
                        </div>

                        <div class="sort-product">
                            <select>
                                <option value="1">Postion</option>
                                <option value="1">Product name</option>
                            </select>
                            <div class="icon"><i class="fa fa-sort-alpha-asc"></i></div>
                        </div>
                    </div>
                </div>
            <?php
            } // Cierre de la condicion de mostrar resultados
            else {
                ?>
                <div class="col-md-8 col-md-offset-2">
                    <div class="text-center">
                        <h5 class="sub-title">&iexcl;No hemos encontrado lo que busca!</h5>
                        <h2 class="title">Su consulta no arroj&oacute; resultados</h2>
                        <p>Pruebe con otro criterio de busqueda o directamente desde las opciones en el men&uacute; de su derecha</p>
                    </div>
                </div>
            <?php
            }
            ?>
            
            
        </div>
        
        <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="block block-sidebar">
                    <div class="block-head">
                        <h5 class="widget-title">beauty & perfumes</h5>
                    </div>
                    <div class="block-inner">
                        <div class="block-list-category">
                            <ul class="tree-menu">
                                <li class="active">
                                    <a href="category-grid2.html#">Women</a>
                                    <ul>
                                        <li><span></span><a href="category-grid2.html#">Jeans & Trousers</a></li>
                                        <li><span></span><a href="category-grid2.html#">Blouses & Shirts</a></li>
                                        <li><span></span><a href="category-grid2.html#">Tops & T-Shirts</a></li>
                                        <li><span></span><a href="category-grid2.html#">Jackets & Coats</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="category-grid2.html#">Men</a>
                                    <ul style="display: none;">
                                        <li><span></span><a href="category-grid2.html#">Trousers</a></li>
                                        <li><span></span><a href="category-grid2.html#">Shirts</a></li>
                                        <li><span></span><a href="category-grid2.html#">T-Shirts</a></li>
                                        <li><span></span><a href="category-grid2.html#">Coats</a></li>
                                    </ul>
                                </li>
                            </ul>
                                </div>
                        </div>
                    </div>
                    <div class="block block-sidebar">
                        <div class="block-head">
                            <h5 class="widget-title">Catalog</h5>
                        </div>
                        <div class="block-inner">
                            <div class="block-filter">
                                <div class="block-sub-title">Categories</div>
                                    <div class="block-filter-inner">
                                        <ul class="check-box-list">
                                            <li>
                                                <input type="checkbox" id="c1" name="cc">
                                                <label for="c1">
                                                <span class="button"></span>
                                                Tops<span class="count">(10)</span>
                                                </label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="c2" name="cc">
                                                <label for="c2">
                                                <span class="button"></span>
                                                T-shirts<span class="count">(10)</span>
                                                </label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="c3" name="cc">
                                                <label for="c3">
                                                <span class="button"></span>
                                                Dresses<span class="count">(10)</span>
                                                </label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="c4" name="cc">
                                                <label for="c4">
                                                <span class="button"></span>
                                                Jackets and coats<span class="count">(10)</span>
                                                </label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="c5" name="cc">
                                                <label for="c5">
                                                <span class="button"></span>
                                                Knitted<span class="count">(10)</span>
                                                </label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="c6" name="cc">
                                                <label for="c6">
                                                <span class="button"></span>
                                                Pants<span class="count">(10)</span>
                                                </label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="c7" name="cc">
                                                <label for="c7">
                                                <span class="button"></span>
                                                Bags &amp; Shoes<span class="count">(10)</span>
                                                </label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="c8" name="cc">
                                                <label for="c8">
                                                <span class="button"></span>
                                                Best selling<span class="count">(10)</span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="block-filter">
                                    <div class="block-sub-title">Price</div>
                                    <div class="block-filter-inner">
                                    <div class="amount-range-price">Range: $50 - $350</div>
                                    <div data-label-reasult="Range:" data-min="0" data-max="500" data-unit="$" class="slider-range-price" data-value-min="50" data-value-max="350"></div>
                                    </div>
                                </div>
                                <div class="block-filter">
                                    <div class="block-sub-title">Color</div>
                                    <div class="block-filter-inner">
                                    <ul class="check-box-list corlor">
                                        <li>
                                            <input type="checkbox" id="corlor1" name="cc">
                                            <label for="corlor1">
                                            <span class="button" style=" background:#4d6dbd;"></span>
                                            Blue<span class="count">(20)</span>
                                            </label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="corlor2" name="cc">
                                            <label for="corlor2">
                                            <span class="button" style=" background:#2fbcda;"></span>
                                            Cyan<span class="count">(1)</span>
                                            </label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="corlor3" name="cc">
                                            <label for="corlor3">
                                            <span class="button" style=" background:#ffe00c;"></span>
                                            Yellow  <span class="count">(31)</span>
                                            </label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="corlor4" name="cc">
                                            <label for="corlor4">
                                            <span class="button" style=" background:#72b226;"></span>
                                            Green  <span class="count">(21)</span>
                                            </label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="corlor5" name="cc">
                                            <label for="corlor5">
                                            <span class="button" style=" background:#fb5d5d;"></span>
                                            Red  <span class="count">(12)</span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="block-filter">
                            <div class="block-sub-title">Manufacturer</div>
                            <div class="block-filter-inner">
                                <ul class="check-box-list">
                                    <li>
                                        <input type="checkbox" id="m1" name="cc">
                                        <label for="m1">
                                        <span class="button"></span>
                                        Fashion Manufacturer<span class="count">(10)</span>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="m2" name="cc">
                                        <label for="m2">
                                        <span class="button"></span>
                                        Electronis <span class="count">(10)</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="block-filter">
                            <div class="block-sub-title">Properties</div>
                            <div class="block-filter-inner">
                                <ul class="check-box-list">
                                    <li>
                                        <input type="checkbox" id="p1" name="cc">
                                        <label for="p1">
                                        <span class="button"></span>
                                        Midi Dress<span class="count">(10)</span>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="p2" name="cc">
                                        <label for="p2">
                                        <span class="button"></span>
                                        Short Dress <span class="count">(10)</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="block-filter">
                            <div class="block-sub-title">AVAILABILITY</div>
                            <div class="block-filter-inner">
                            <ul class="check-box-list">
                                <li>
                                    <input type="checkbox" id="a1" name="cc">
                                    <label for="a1">
                                    <span class="button"></span>
                                    In stock<span class="count">(10)</span>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="a2" name="cc">
                                    <label for="a2">
                                    <span class="button"></span>
                                    Not available <span class="count">(10)</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- block  top sellers -->
            <div class="block block-top-sellers">
                <div class="block-head">
                    <div class="block-title">
                        <div class="block-icon">
                            <img src="data/top-seller-icon.png" alt="store icon">
                        </div>
                        <div class="block-text">
                            <div class="block-title-text text-sm">top</div>
                            <div class="block-title-text text-lg">SELLERS</div>
                        </div>
                    </div>
                </div>
                <div class="block-inner">
                    <ul class="products kt-owl-carousel" data-items="1" data-autoplay="true" data-loop="true" data-nav="true">
                        <li class="product">
                            <div class="product-container">
                                <div class="product-left">
                                    <div class="product-thumb">
                                        <a class="product-img" href="category-grid2.html#"><img src="data/option1/p1.jpg" alt="Product"></a>
                                        <a title="Quick View" href="quick-view.html" class="btn-quick-view  fancybox.iframe">Quick View</a>
                                    </div>
                                </div>
                                <div class="product-right">
                                    <div class="product-name">
                                        <a href="category-grid2.html#">Cotton Lycra Leggings</a>
                                    </div>
                                    <div class="price-box">
                                        <span class="product-price">$139.98</span>
                                        <span class="product-price-old">$169.00</span>
                                    </div>
                                    <div class="product-star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                    <div class="product-button">
                                        <a class="btn-add-wishlist" title="Add to Wishlist" href="category-grid2.html#">Add Wishlist</a>
                                        <a class="btn-add-comparre" title="Add to Compare" href="category-grid2.html#">Add Compare</a>
                                        <a class="button-radius btn-add-cart" title="Add to Cart" href="category-grid2.html#">Buy<span class="icon"></span></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="product">
                            <div class="product-container">
                                <div class="product-left">
                                    <div class="product-thumb">
                                        <a class="product-img" href="category-grid2.html#"><img src="data/option1/p2.jpg" alt="Product"></a>
                                        <a title="Quick View" href="quick-view.html" class="btn-quick-view  fancybox.iframe">Quick View</a>
                                    </div>
                                </div>
                                <div class="product-right">
                                    <div class="product-name">
                                        <a href="category-grid2.html#">Cotton Lycra Leggings</a>
                                    </div>
                                    <div class="price-box">
                                        <span class="product-price">$139.98</span>
                                        <span class="product-price-old">$169.00</span>
                                    </div>
                                    <div class="product-star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                    <div class="product-button">
                                        <a class="btn-add-wishlist" title="Add to Wishlist" href="category-grid2.html#">Add Wishlist</a>
                                        <a class="btn-add-comparre" title="Add to Compare" href="category-grid2.html#">Add Compare</a>
                                        <a class="button-radius btn-add-cart" title="Add to Cart" href="category-grid2.html#">Buy<span class="icon"></span></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- block  top sellers -->
            <!-- block SPECIALS -->
            <div class="block block-specials">
                <div class="block-head">SPECIALS</div>
                <div class="block-inner">
                    <div class="product">
                        <div class="image">
                            <a href="category-grid2.html#"><img src="data/option1/p23.jpg" alt="p23.jpg"></a>
                        </div>
                        <div class="product-name">
                            <a href="category-grid2.html#">Cotton Lycra Leggings</a>
                        </div>
                        <div class="price-box">
                            <span class="product-price">$139.98</span>
                            <span class="product-price-old">$169.00</span>
                        </div>
                    </div>
                    <a href="category-grid2.html#" class="button-radius">All Specials<span class="icon"></span></a>
                </div>
            </div>
            <!-- ./block SPECIALS -->
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