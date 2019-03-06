<?php

    /******************************/
    /* Administrador Web SmartNova                           
    /* Noticias                                                                                
    /******************************/

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
?>

    <div class="col-sm-4 col-md-3">
        
        <div class="block block-widget">
            <div class="block-head">
                 <h5 class="widget-title">BUSCADOR</h5>
            </div>
            <div class="block-inner">
                <div class="search-form">
                    <form id="form" name="form_cont" action="noticias.php" method="post">
                        <div class="input-group">
                            <input type="text" id="form" name="form_cont" placeholder="Buscar..." class="form-control search-input">
                            <input type="hidden" id="control" name="control" value="1">
                            <span class="input-group-btn">
                                <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php        
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
        // Categorias
        $sql_ctgn = "SELECT * FROM tbla_ctgn WHERE ctgn_estd = 1";
        $consulta_ctgn = $conec->dbQuery($sql_ctgn, $debug);
        ?>    
        
        <div class="block block-widget">
            <div class="block-head">
                 <h5 class="widget-title">CATEGOR&Iacute;AS</h5>
            </div>
            <div class="block-inner">
                <ul class="list-link">
                    
                    <?php    
                    while ($datos_ctgn = $conec->dbFetchObjet($consulta_ctgn)){

                        $sql_nctgn = "SELECT * FROM tbla_notc WHERE notc_ctgn = '".$datos_ctgn->id."'";
                        $query_nctgn = $conec->dbQuery($sql_nctgn, $debug);
                        $nctgn = $conec->dbNumRows($query_nctgn, $debug); 

                        if ($nctgn > 0){
                        ?>
                        <li><a href="<?php echo $path."app/noticias.php?ctgn=".$datos_ctgn->id; ?>"><?php echo $datos_ctgn->ctgn_nomb; ?></a><span class="pull-right">(<?php echo $nctgn; ?>)</span></li>
                        <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        
        <?php
        // Ultimos tweets
        echo $user = $_SESSION['twet_user'];
        $count = 6;
        $string = LastTweets($path, $user, $count);
        ?>
        
        <div class="block block-widget">
            <div class="block-head">
                <h5 class="widget-title">&Uacute;LTIMOS TWEETS</h5>
            </div>
            <div class="block-inner">
                <ul class="list-link">
                <?php    
                foreach ($string as $tweet){
                    $datetime = TimeAgo(strtotime($tweet['created_at']));
                    $text = StringURL($tweet['text']);
                    ?>
                    <li>
                        <p class="tw-item">
                            <i class="fa fa-twitter"></i>    
                            &nbsp;<?php echo $text; ?>&nbsp; - <a href="<?php echo $tweet['user']['url']; ?>" id="entry-date" class="entry-date"><?php echo $datetime; ?></a>
                        </p>
                    </li>
                    <?php
                }
                ?>    
                </ul>
            </div>
        </div>
        
        <?php
            // Noticias Recientes
            $sql_notc_rcnt = "SELECT id, notc_ttlo, notc_entr, notc_estd, notc_fech, notc_img1, notc_nott, notc_yutb FROM tbla_notc ORDER BY notc_fech DESC LIMIT 0,10";
            $consulta_notc_rcnt = $conec->dbQuery($sql_notc_rcnt, $debug);
        ?>
        
        <div class="block block-widget">
            <div class="block-head">
                <h5 class="widget-title">Noticias Recientes</h5>
            </div>
            <div class="block-inner">
                <ul class="list-posts-widget">
                
                    <?php
                    while ($datos_notc_rcnt = $conec->dbFetchObjet($consulta_notc_rcnt)){    
                        ?>
                        <li>
                            <div class="post-thumb">
                                <?php
                                if ($datos_notc_rcnt->notc_nott == 3){ 
                                    $codigo_video = getYoutubeID($datos_notc_rcnt->notc_yutb);
                                    ?>
                                    <a href="<?php $path."app/noticia.php?id=".$datos_notc_rcnt->id; ?>">
                                        <img src="http://img.youtube.com/vi/<?php echo $codigo_video; ?>/0.jpg" alt="<?php echo $datos_notc_rcnt->notc_ttlo; ?>">
                                    </a>
                                <?php
                                }
                                else {
                                    ?>
                                    <a href="<?php $path."app/noticia.php?id=".$datos_notc_rcnt->id; ?>">
                                        <img width="100%" src="<?php echo $path."thumbs/imagenes/noticias/".$datos_notc_rcnt->notc_img1; ?>" alt="<?php echo $datos_notc_rcnt->notc_ttlo; ?>">
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="post-info">
                                <h5 class="entry_title"><a href="<?php $path."app/noticia.php?id=".$datos_notc_rcnt->id; ?>"><?php echo $datos_notc_rcnt->notc_ttlo; ?></a></h5>
                                <div class="post-meta">
                                    <span class="date"><i class="fa fa-calendar"></i> <?php echo Fecha($datos_notc_rcnt->notc_fech, "fecha-corta"); ?></span>
                                    <span class="comment-count">
                                        <i class="fa fa-comment-o"></i> 3
                                    </span>
                                </div>
                            </div>
                        </li>
                        
                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
        
        <div class="block block-widget">
            <div class="block-head">
                <h5 class="widget-title">RECENT COMMENTS</h5>
            </div>
                        <div class="block-inner">
                                <ul class="recent-comment-list">
        <li>
            <h5><a href="blog.html#">Lorem ipsum dolor sit amet</a></h5>
            <div class="comment">
                "Consectetuer adipis. Mauris accumsan nulla vel diam. Sed in..."
            </div>
            <div class="author">Posted by <a href="blog.html#">Admin</a></div>
        </li>
        <li>
            <h5><a href="blog.html#">Lorem ipsum dolor sit amet</a></h5>
            <div class="comment">
                "Consectetuer adipis. Mauris accumsan nulla vel diam. Sed in..."
            </div>
            <div class="author">Posted by <a href="blog.html#">Admin</a></div>
        </li>
        <li>
            <h5><a href="blog.html#">Lorem ipsum dolor sit amet</a></h5>
            <div class="comment">
                "Consectetuer adipis. Mauris accumsan nulla vel diam. Sed in..."
            </div>
            <div class="author">Posted by <a href="blog.html#">Admin</a></div>
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
