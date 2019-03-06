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
    $content_class = "";
    $config = [];
    HeaderHTML($path, $page_title, $meta, $css, $js, $config);
    BodyBegin($path);
    WrapperBegin();
    MainBegin();
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    
    if ((isset($_GET['session'])) && ($_GET['session'] == 'cerrar')){
        // Destruimos la session
        session_unset();
        session_destroy();
    }
    
    if ((isset($_POST['control'])) && ($_POST['control'] == "enviar")){
        
        // Recepcion de variables del formulario
        if (null !== filter_input(INPUT_POST, 'user_mail', FILTER_SANITIZE_EMAIL)){ 
           $logn_mail = filter_input(INPUT_POST, 'user_mail', FILTER_SANITIZE_EMAIL);
        }
        
        $logn_pass = $_POST['user_pass'];
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

        if ($logn_mail != "" && $logn_pass != ""){
        
            $sql_user = "SELECT * FROM tbla_user WHERE user_mail = '".$logn_mail."'";
            $query_user = $conec->dbQuery($sql_user, $debug);
            $datos_user = $conec->dbFetchObjet($query_user, $debug);

            // Verificacion del password
            if (password_verify($logn_pass, $datos_user->user_pass)) {
                // Correct password
                 // Datos de la session
                $_SESSION['tokn'] = uniqid(md5(microtime()), true);         // Definimos un token de sesion
                $_SESSION['sson_agnt'] = $_SERVER['HTTP_USER_AGENT'];       // Agente del navegador web
                $_SESSION['sson_dcip'] = GetClientIP();                     // Direccion IP 
                $_SESSION['sson_fchi'] = date('Y/m/d H:i');                 // Fecha y hora de inicio de sesion
                $_SESSION['sson_ufch'] = date('Y/m/d H:i');                 // Ultima fecha y hora accedida
                $_SESSION['sson_tipo'] = "user";

                $_SESSION['user_sson'] = TRUE;
                $_SESSION['sson_idpr'] = $datos_user->id;
                $_SESSION['user_nmap'] = $datos_user->user_nomb." ".$datos_user->user_apll;
                $_SESSION['user_mail'] = $datos_user->user_mail;
                
                // Usuario para las operaciones de la db
                $user = $_SESSION['sson_idpr'];          

                // recuperacion del ultimo
                $query_ultimo_id = "SELECT MAX(id) FROM tbla_sson";
                $ultimo_id_rc = $conec->dbQuery($query_ultimo_id, $debug);
                $ultimo_id = $conec->dbFetchArray($ultimo_id_rc);

                // consulta de los datos del ultimo registro
                $sche_ur = "";
                $tabla_ur = "tbla_sson";
                $campos_ur = "id, sson_fchi";
                $criterio_ur = "id = '".$ultimo_id[0]."'";
                $orden_ur = "";
                $clausula_ur = "";
                $registro_ur = $conec->dbConsulta($sche_ur, $tabla_ur, $campos_ur, $criterio_ur, $orden_ur, $clausula_ur, $debug);
                $rs_datos_ur = $conec->dbFetchObjet($registro_ur);

                // guardamos ultima session
                $_SESSION['sson_ussi'] = $rs_datos_ur->id;                  // fecha del id
                $_SESSION['sson_ussn'] = $rs_datos_ur->sson_fchi;           // fecha de la ultima session


                // Construccion de la consulta
                $into = " sson_usid, sson_tipo, sson_tokn, sson_agnt, sson_dcip, sson_fchi";
                $values = "'".$_SESSION['sson_idpr']."', '".$_SESSION['sson_tipo']."', '".$_SESSION['tokn']."', '".$_SESSION['sson_agnt']."', '".$_SESSION['sson_dcip']."', '".$_SESSION['sson_fchi']."'";		
                //echo $values;

                $sche = "";
                $tabla = "tbla_sson";
                $conec->dbInsertar($sche, $tabla, $into, $values, $debug);

                // gurdamos el id del registro en la tabla
                //$_SESSION['sson_id'] = mysql_insert_id();
                $sql_max = "SELECT MAX(id) AS id FROM ".$tabla;
                $consulta_max = $conec->dbQuery($sql_max, $debug);
                $max_id = $conec->dbFetchArray($consulta_max);
                $_SESSION['sson_id'] = $max_id['id'];

                $operacion = "login";
                $nombre_tabla = "";
                $mensaje = "success";
                
                
                
                echo "<script type=\"text/javascript\">window.location=\"".$path."app/inicio.php\"</script> \n";   
            } 
            else {
                echo "<script type=\"text/javascript\">window.location=\"".$path."app/index.php\"</script> \n";   
            }           
        }   
    }
    
    if ((isset($_GET['user'])) && (isset($_GET['scdg']))){
        
        echo $_GET['user'];
        echo $_GET['scdg'];
        
        // Recepcion de variables del formulario
        if (null !== filter_input(INPUT_GET, 'scdg', FILTER_SANITIZE_STRING)){ 
          echo  $logn_scdg = filter_input(INPUT_GET, 'scdg', FILTER_SANITIZE_STRING);
        }
        
        // Recepcion de variables del formulario
        if (null !== filter_input(INPUT_GET, 'user', FILTER_SANITIZE_NUMBER_INT)){ 
           echo $logn_user = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_NUMBER_INT);
        }
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

        if ($logn_scdg != "" && $logn_user != ""){
        
            $sql_user = "SELECT * FROM tbla_user WHERE id = '".$logn_user."' AND user_scdg = '".$logn_scdg."'";
            $query_user = $conec->dbQuery($sql_user, $debug);
            $nuser = $conec->dbNumRows($query_user);
            if ($nuser == 1){
                $datos_user = $conec->dbFetchObjet($query_user, $debug);

                // Correct password
                 // Datos de la session
                $_SESSION['tokn'] = uniqid(md5(microtime()), true);         // Definimos un token de sesion
                $_SESSION['sson_agnt'] = $_SERVER['HTTP_USER_AGENT'];       // Agente del navegador web
                $_SESSION['sson_dcip'] = GetClientIP();                     // Direccion IP 
                $_SESSION['sson_fchi'] = date('Y/m/d H:i');                 // Fecha y hora de inicio de sesion
                $_SESSION['sson_ufch'] = date('Y/m/d H:i');                 // Ultima fecha y hora accedida
                $_SESSION['sson_tipo'] = "user";

                $_SESSION['user_sson'] = TRUE;
                $_SESSION['sson_idpr'] = $datos_user->id;
                $_SESSION['user_nmap'] = $datos_user->user_nomb." ".$datos_user->user_apll;
                $_SESSION['user_mail'] = $datos_user->user_mail;
                
                // Usuario para las operaciones de la db
                $user = $_SESSION['sson_idpr'];          

                // recuperacion del ultimo
                $query_ultimo_id = "SELECT MAX(id) FROM tbla_sson";
                $ultimo_id_rc = $conec->dbQuery($query_ultimo_id, $debug);
                $ultimo_id = $conec->dbFetchArray($ultimo_id_rc);

                // consulta de los datos del ultimo registro
                $sche_ur = "";
                $tabla_ur = "tbla_sson";
                $campos_ur = "id, sson_fchi";
                $criterio_ur = "id = '".$ultimo_id[0]."'";
                $orden_ur = "";
                $clausula_ur = "";
                $registro_ur = $conec->dbConsulta($sche_ur, $tabla_ur, $campos_ur, $criterio_ur, $orden_ur, $clausula_ur, $debug);
                $rs_datos_ur = $conec->dbFetchObjet($registro_ur);

                // guardamos ultima session
                $_SESSION['sson_ussi'] = $rs_datos_ur->id;                  // fecha del id
                $_SESSION['sson_ussn'] = $rs_datos_ur->sson_fchi;           // fecha de la ultima session


                // Construccion de la consulta
                $into = " sson_usid, sson_tipo, sson_tokn, sson_agnt, sson_dcip, sson_fchi";
                $values = "'".$_SESSION['sson_idpr']."', '".$_SESSION['sson_tipo']."', '".$_SESSION['tokn']."', '".$_SESSION['sson_agnt']."', '".$_SESSION['sson_dcip']."', '".$_SESSION['sson_fchi']."'";		
                //echo $values;

                $sche = "";
                $tabla = "tbla_sson";
                $conec->dbInsertar($sche, $tabla, $into, $values, $debug);

                // gurdamos el id del registro en la tabla
                //$_SESSION['sson_id'] = mysql_insert_id();
                $sql_max = "SELECT MAX(id) AS id FROM ".$tabla;
                $consulta_max = $conec->dbQuery($sql_max, $debug);
                $max_id = $conec->dbFetchArray($consulta_max);
                $_SESSION['sson_id'] = $max_id['id'];

                $operacion = "login";
                $nombre_tabla = "";
                $mensaje = "success";
                
                
                
                echo "<script type=\"text/javascript\">window.location=\"".$path."app/inicio.php\"</script> \n";   
            } 
            else {
                echo "<script type=\"text/javascript\">window.location=\"".$path."app/index.php\"</script> \n";   
            }           
        }   
    
    }

    ?>
    <section class="login_index"> 
            <div class="container">
                <div class="row text-center pt-80">
                    <img width="360" src="<?php echo $path."uploads/imagenes/logo/".$_SESSION['pref_logh']; ?>" alt="<?php echo $_SESSION['cont_nomb']; ?>">
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 mb-200">
                        <form class ="login mt-80 mb-40" action="<?php echo $path."app/index.php"; ?>" method="post">
                            <div class="form-group mb-20">
                                <label for="login_email">Email:</label>
                                <input id="login_email" name="user_mail" placeholder="Ingrese su direcci&oacute;n de correo elctr&oacute;nico" type="email" class="form-control form-value" required="required">
                            </div>
                            <div class="form-group mb-40">
                                <label for="login_passw">Contrase&ntilde;a:</label>
                                <input id="login_passw" name="user_pass" placeholder="Ingrese su contrase&ntilde;a" type="password" class="form-control form-value" required="required">
                            </div>
                             <div class="form-group mb-80">
                                 <button id="login_enviar" name="control" type="submit" value="enviar" class="m-0 pt-20 pb-20"><i class="fa fa-paper-plane-o"></i> Enviar</button>
                            </div>
                        </form>
                        <div class="login_note pt-80">
                            <p>Recuerde que puede ingresar directamente escaneando el c&oacute;digo QR de su tarjeta de miembro asociado </p> 
                            <i class="font-48 flaticon-qr-code"></i>
                        </div>
                        
                    </div>
                </div>
                <div class="row footer_index">
                    <div class="col-md-4">
                        <address>
                            <p><span>Llamanos</span> <?php echo $_SESSION['cont_tlfn']; ?></p>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <address>
                            <p><span>Estamos ubicados en</span> <?php echo $_SESSION['cont_dirc']; ?></p>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <address>
                            <p><span>Email</span> <a href="mailto:<?php echo $_SESSION['cont_dirc']; ?>"><?php echo $_SESSION['cont_mail']; ?></a></p>
                        </address>
                    </div>
                </div>
<!--                <strong class="copyrights">Jz Pub &copy; 2016 All Rights Reserved <a href="bartender.html#">Terms of Use</a> and <a href="bartender.html#">Privacy Policy</a></strong>-->
                <div class="footer-social mb-40">
                    <ul>
                        <li><a href="<?php echo $_SESSION['fcbk_link']; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="<?php echo $_SESSION['inst_link']; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="<?php echo $_SESSION['twet_link']; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </section>

    <?php
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    //Pie de pagina
    $sjs = "";
    $config = [];
    MainEnd();
    WrapperEnd();
    ScriptsJS($path, $sjs);
    BodyEnd();
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
?>
