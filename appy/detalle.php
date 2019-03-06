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
    $page_title = "Producto";
    $meta = "";
    $css = "";
    $js = "";
    $current = "coleccion";
    $content_class = "contact-page";
    $config['body-option'] = 9;
    CommonHeader($path, $page_title, $meta, $css, $js, $current, $content_class, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
   
    ?>
    
    <div class="row">
        
            <div class="col-xs-12 col-sm-8 col-md-9">
                
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <div class="block block-product-image">
                                <div class="product-image easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                        <a href="data/zoom/full.jpg">
                                                <img src="data/cholas/flip-flop6.jpg" alt="Product" width="100%" height="450" />
                                        </a>
                                </div>
                                
                        </div>
                    </div>
                
                    <div class="col-md-5 col-sm-5">

                        

                        <div class="block-product-info">
                            <h2 class="product-name">Sandalia Femenina BARU</h2>
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
                            <div class="desc">Top zipper closure, two pockets in the front, Slit patch pocket in the back. Detachable, adjustable shoulder strap. Interior</div>
                                <div class="variations-box">
                                        <table class="variations-table">
                                                <tr>
                                                        <td class="table-label">Color</td>
                                                        <td class="table-value">
                                                                <ul class="list-check-box color">
                                                                        <li><a class="selected" href="detail.html#"><span style="background:#4d6dbd;">Blue</span></a></li>
                                                                        <li><a href="detail.html#"><span style="background:#fb5d5d;">Blue</span></a></li>
                                                                        <li><a href="detail.html#"><span style="background:#2fbcda;">Blue</span></a></li>
                                                                        <li><a href="detail.html#"><span style="background:#ffe00c;">Blue</span></a></li>
                                                                        <li><a href="detail.html#"><span style="background:#72b226;">Blue</span></a></li>
                                                                </ul>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td class="table-label">Size</td>
                                                        <td class="table-value">
                                                                <ul class="list-check-box">
                                                                        <li><a href="detail.html#">XL</a></li>
                                                                        <li><a href="detail.html#">X</a></li>
                                                                        <li><a href="detail.html#">S</a></li>
                                                                        <li><a href="detail.html#">XS</a></li>
                                                                </ul>
                                                        </td>
                                                </tr>
<!--                                                <tr>
                                                        <td class="table-label">Qty</td>
                                                        <td class="table-value">
                                                                <div class="box-qty">
                                                                        <a href="detail.html#" class="quantity-minus">-</a>
                                                                        <input type="text" class="quantity" value="1">
                                                                        <a href="detail.html#" class="quantity-plus">+</a>
                                                                </div>
                                                                <a href="detail.html#" class="button-radius btn-add-cart">Buy<span class="icon"></span></a>
                                                        </td>
                                                </tr>-->
                                        </table>
                                </div>
                            <div class="box-control-button">
                                    <a class="link-wishlist" href="detail.html#">wishlist</a>
                                    <a class="link-compare" href="detail.html#">Compare</a>
                                    <a class="link-sendmail" href="detail.html#">Email to a Friend</a>
                                    <a class="link-print" href="detail.html#">Print</a>
                            </div>
                        </div>

                    </div>    
                </div>
                
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="block block-category-list">
                                <div class="block-inner clearfix">
                                        <a href="detail.html#">
                                                <img class="icon1" src="data/icons/1.png" alt="Icon">
                                                <img class="icon2" src="data/icons/1-1.png" alt="Icon">
                                                <span>Bar&uacute;</span>
                                        </a>
                                        <a href="detail.html#">
                                                <img class="icon1" src="data/icons/2.png" alt="Icon">
                                                <img class="icon2" src="data/icons/2-1.png" alt="Icon">
                                                <span>Providencia</span>
                                        </a>
                                        <a href="detail.html#">
                                                <img class="icon1" src="data/icons/3.png" alt="Icon">
                                                <img class="icon2" src="data/icons/3-1.png" alt="Icon">
                                                <span>Tyrona</span>
                                        </a>
                                </div>
                        </div>
                    </div>
                </div>
                
                
            <!-- Product tab -->
			<div class="block block-tabs tab-left">
				<div class="block-head">
					<ul class="nav-tab clearfix">                                   
                        <li class="active"><a data-toggle="tab" href="detail.html#tab-1">Descripci&oacute;n</a></li>
                        <li><a data-toggle="tab" href="detail.html#tab-2">Carateristicas</a></li>
                        <!-- <li><a data-toggle="tab" href="detail.html#tab-3">Reviews</a></li> -->
                  	</ul>
				</div>
				<div class="block-inner">
					<div class="tab-container">
						<div id="tab-1" class="tab-panel active">
							<p>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
							</p>
						</div>
						<div id="tab-2" class="tab-panel">
							<table>
                                <tbody>
	                                <tr>
	                                    <td>Compositions</td>
	                                    <td>Cotton</td>
	                                </tr>
	                                <tr>
	                                    <td>Styles</td>
	                                    <td>Girly</td>
	                                </tr>
	                                <tr>
	                                    <td>Properties</td>
	                                    <td>Colorful Dress</td>
	                                </tr>
	                            </tbody>
                            </table>
						</div>
						<div id="tab-3" class="tab-panel">
							<div id="reviews">
								<h4 class="comments-title">1 review for "Sandalia Femenina Bar&uacute;u"</h4>
								<ol class="comment-list">
									<li class="comment">
										<div class="comment-avatar">
											<img src="data/avatar.jpg" alt="Avatar">
										</div>
										<div class="comment-content">
											<div class="comment-meta">
												<a href="detail.html#" class="comment-author">jon Conner</a>
												<span class="comment-date">March 14, 2013 at 8:03 am</span>
												<div class="review-rating">
						                            <i class="fa fa-star"></i>
						                            <i class="fa fa-star"></i>
						                            <i class="fa fa-star"></i>
						                            <i class="fa fa-star"></i>
						                            <i class="fa fa-star-half-o"></i>
						                        </div>
											</div>
											<div class="comment-entry">
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
											</div>
											<div class="comment-actions">
												<a class="comment-reply-link" href="detail.html#"><i class="fa fa-share"></i> Reply</a>
											</div>
										</div>
									</li>
									<li class="comment">
										<div class="comment-avatar">
											<img src="data/avatar.jpg" alt="Avatar">
										</div>
										<div class="comment-content">
											<div class="comment-meta">
												<a href="detail.html#" class="comment-author">jon Conner</a>
												<span class="comment-date">March 14, 2013 at 8:03 am</span>
												<div class="review-rating">
						                            <i class="fa fa-star"></i>
						                            <i class="fa fa-star"></i>
						                            <i class="fa fa-star"></i>
						                            <i class="fa fa-star"></i>
						                            <i class="fa fa-star-half-o"></i>
						                        </div>
											</div>
											<div class="comment-entry">
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
											</div>
											<div class="comment-actions">
												<a class="comment-reply-link" href="detail.html#"><i class="fa fa-share"></i> Reply</a>
											</div>
										</div>
									</li>
								</ol>
								<div class="comment-form">
									<h3 class="comment-reply-title">Leave a Review</h3>
									<small>Your email address will not be published. Required fields are marked *</small>
									<div class="rating">
										<label class="required">Your rating</label>
										<div class="form-rating">
											<label class="radio-inline">
											  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 1
											</label>
											<label class="radio-inline">
											  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 2
											</label>
											<label class="radio-inline">
											  <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 3
											</label>
											<label class="radio-inline">
											  <input type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4"> 4
											</label>
											<label class="radio-inline">
											  <input type="radio" name="inlineRadioOptions" id="inlineRadio5" value="option5"> 5
											</label>
										</div>
									</div>
									<p>
										<label class="required">Name</label>
										<input type="text">
									</p>
									<p>
										<label class="required">Email</label>
										<input type="text">
									</p>
									<p>
										<label>Website</label>
										<input type="text">
									</p>
									<p>
										<label class="required">Comment</label>
										<textarea rows="5"></textarea>	
									</p>
									<p>
										<button class="button">Post review</button>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Product tab -->    
            
                <!-- Related Products -->
			<div class="block block-products-owl">
				<div class="block-head">
					<div class="block-title">
						<div class="block-title-text text-lg">Productos Relacionados</div>
					</div>
				</div>
				<div class="block-inner">
						<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
							<li class="product">
								<div class="product-container">
									<div class="product-left">
										<div class="product-thumb">
											<a class="product-img" href="detail.html#"><img src="data/cholas/flip-flop7.jpg" alt=""></a>
											<a title="Quick View" href="detail.html#" class="btn-quick-view">Quick View</a>
										</div>
									</div>
									<div class="product-right">
										<div class="product-name">
											<a href="detail.html#">Sandalia Femenina Bar&uacute;u</a>
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
	                                    	<a class="btn-add-wishlist" title="Add to Wishlist" href="detail.html#">Add Wishlist</a>
	                                    	<a class="btn-add-comparre" title="Add to Compare" href="detail.html#">Add Compare</a>
	                                    	<a class="button-radius btn-add-cart" title="Add to Cart" href="detail.html#">Buy<span class="icon"></span></a>
	                                    </div>
									</div>
								</div>
							</li>
							<li class="product">
								<div class="product-container">
									<div class="product-left">
										<div class="product-thumb">
											<a class="product-img" href="detail.html#"><img src="data/cholas/flip-flop8.jpg" alt=""></a>
											<a title="Quick View" href="detail.html#" class="btn-quick-view">Quick View</a>
										</div>
									</div>
									<div class="product-right">
										<div class="product-name">
											<a href="detail.html#">Sandalia Femenina Bar&uacute;u</a>
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
	                                    	<a class="btn-add-wishlist" title="Add to Wishlist" href="detail.html#">Add Wishlist</a>
	                                    	<a class="btn-add-comparre" title="Add to Compare" href="detail.html#">Add Compare</a>
	                                    	<a class="button-radius btn-add-cart" title="Add to Cart" href="detail.html#">Buy<span class="icon"></span></a>
	                                    </div>
									</div>
								</div>
							</li>
							<li class="product">
								<div class="product-container">
									<div class="product-left">
										<div class="product-thumb">
											<a class="product-img" href="detail.html#"><img src="data/cholas/flip-flop9.jpg" alt=""></a>
											<a title="Quick View" href="detail.html#" class="btn-quick-view">Quick View</a>
										</div>
									</div>
									<div class="product-right">
										<div class="product-name">
											<a href="detail.html#">Sandalia Femenina Bar&uacute;u</a>
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
	                                    	<a class="btn-add-wishlist" title="Add to Wishlist" href="detail.html#">Add Wishlist</a>
	                                    	<a class="btn-add-comparre" title="Add to Compare" href="detail.html#">Add Compare</a>
	                                    	<a class="button-radius btn-add-cart" title="Add to Cart" href="detail.html#">Buy<span class="icon"></span></a>
	                                    </div>
									</div>
								</div>
							</li>
							<li class="product">
								<div class="product-container">
									<div class="product-left">
										<div class="product-thumb">
											<a class="product-img" href="detail.html#"><img src="data/cholas/flip-flop9.jpg" alt=""></a>
											<a title="Quick View" href="detail.html#" class="btn-quick-view">Quick View</a>
										</div>
									</div>
									<div class="product-right">
										<div class="product-name">
											<a href="detail.html#">Sandalia Femenina Bar&uacute;u</a>
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
	                                    	<a class="btn-add-wishlist" title="Add to Wishlist" href="detail.html#">Add Wishlist</a>
	                                    	<a class="btn-add-comparre" title="Add to Compare" href="detail.html#">Add Compare</a>
	                                    	<a class="button-radius btn-add-cart" title="Add to Cart" href="detail.html#">Buy<span class="icon"></span></a>
	                                    </div>
									</div>
								</div>
							</li>
							<li class="product">
								<div class="product-container">
									<div class="product-left">
										<div class="product-thumb">
											<a class="product-img" href="detail.html#"><img src="data/cholas/flip-flop16.jpg" alt=""></a>
											<a title="Quick View" href="detail.html#" class="btn-quick-view">Quick View</a>
										</div>
									</div>
									<div class="product-right">
										<div class="product-name">
											<a href="detail.html#">Sandalia Femenina Bar&uacute;u</a>
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
	                                    	<a class="btn-add-wishlist" title="Add to Wishlist" href="detail.html#">Add Wishlist</a>
	                                    	<a class="btn-add-comparre" title="Add to Compare" href="detail.html#">Add Compare</a>
	                                    	<a class="button-radius btn-add-cart" title="Add to Cart" href="detail.html#">Buy<span class="icon"></span></a>
	                                    </div>
									</div>
								</div>
							</li>
						</ul>
					</div>
			</div>
			<!-- ./Related Products -->
                        
                        
            
            
            </div>
        
        <div class="col-xs-12 col-sm-4 col-md-3">
		<!-- block  top sellers -->
                        <div class="block block-top-sellers">
                                <div class="block-head">
                                        <div class="block-title">
                                                <div class="block-icon">
                                                        <img src="data/cholas/flip-flop22.jpg" alt="store icon">
                                                </div>
                                                <div class="block-text">
                                                        <div class="block-title-text text-sm">top</div>
                                                        <div class="block-title-text text-lg">SELLERS</div>
                                                </div>
                                        </div>
                                </div>
                                <div class="block-inner">
                                        <ul class="products kt-owl-carousel" data-margin="10" data-items="1" data-autoplay="true" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":1}}'>
                                                <li class="product">
                                                        <div class="product-container">
                                                                <div class="product-left">
                                                                        <div class="product-thumb">
                                                                                <a class="product-img" href="detail.html#"><img src="data/cholas/flip-flop21.jpg" alt=""></a>
                                                                                <a title="Quick View" href="detail.html#" class="btn-quick-view">Quick View</a>
                                                                        </div>
                                                                </div>
                                                                <div class="product-right">
                                                                        <div class="product-name">
                                                                                <a href="detail.html#">Sandalia Bar&uacute;</a>
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
                                <a class="btn-add-wishlist" title="Add to Wishlist" href="detail.html#">Add Wishlist</a>
                                <a class="btn-add-comparre" title="Add to Compare" href="detail.html#">Add Compare</a>
                                <a class="button-radius btn-add-cart" title="Add to Cart" href="detail.html#">Buy<span class="icon"></span></a>
                            </div>
                                                                </div>
                                                        </div>
                                                </li>
                                                <li class="product">
                                                        <div class="product-container">
                                                                <div class="product-left">
                                                                        <div class="product-thumb">
                                                                                <a class="product-img" href="detail.html#"><img src="data/cholas/flip-flop17.jpg" alt=""></a>
                                                                                <a title="Quick View" href="detail.html#" class="btn-quick-view">Quick View</a>
                                                                        </div>
                                                                </div>
                                                                <div class="product-right">
                                                                        <div class="product-name">
                                                                                <a href="detail.html#">Sandalia Femenina Bar&uacute;u</a>
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
                                <a class="btn-add-wishlist" title="Add to Wishlist" href="detail.html#">Add Wishlist</a>
                                <a class="btn-add-comparre" title="Add to Compare" href="detail.html#">Add Compare</a>
                                <a class="button-radius btn-add-cart" title="Add to Cart" href="detail.html#">Buy<span class="icon"></span></a>
                            </div>
                                                                </div>
                                                        </div>
                                                </li>
                                        </ul>
                                </div>
                        </div>
	
	
            
            
            
            
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