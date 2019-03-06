<?php

    /********************************************************/
    /* Administrador Web SmartNova                            */
    /* Formularios                                          */
    /* Junio de 2016                                        */
    /********************************************************/

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    // Inicio de session
    session_start();
    session_name("loginAdmin");
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Ubicación del archivo
    $path = "";
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Inclusion de archivos necesarios
    require_once $path.'core/core.php';
    Core($path);
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
   
    // Seguridad
    Seguridad($path);
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
    // Control de errores
    $debug = DEBUG;
    
    // Crear la instancia y conectar a la BD
    $conec = new db();
    $conec->dbConexion();
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
    // Datos de las preferencias del sitio
    $sql_pref = "SELECT * FROM tbla_pref WHERE id = 1";
    $query_pref = $conec->dbQuery($sql_pref, $debug);
    $datos_pref = $conec->dbFetchObjet($query_pref);
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
    //Encabezado de la pagina
    $page_title = "Inicio de Sesi&oacute;n";
    $meta = "";
    $css = "";
    $js = "<link href=\"".$path."assets/pages/css/lock.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n";
    $config = "";
    HeaderHTML($path, $page_title, $meta, $css, $js, $config);
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
    if ((isset($_GET['session'])) && ($_GET['session'] == 'cerrar')){
        // Destruimos la session
        session_unset();
        session_destroy();
    }
    
    if ((isset($_POST['control'])) && ($_POST['control'] == "enviar")){
        
        // Recepcion de variables del formulario
        $prtp_mail = ReemSpecialChars($_POST['prtp_mail']); 		// Login de administrador
        $prtp_pass = md5($_POST['prtp_pass']);                          // Password encriptado con MD5
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

        // Comprobacion del administrador
        $sche = "";
        $tabla = "tbla_prtp";
        $campos = "id, prtp_nomb, prtp_apll, prtp_sexo, prtp_mail";
        $criterio = "prtp_mail = '".$prtp_mail."' AND prtp_pass = '".$prtp_pass."'";
        $orden = "";
        $clausula = "";
        $registro = $conec->dbConsulta($sche, $tabla, $campos, $criterio, $orden, $clausula, $debug);
        $rs_datos = $conec->dbFetchObjet($registro);
        $rs_existe_registro = $conec->dbNumRows($registro);		    
        //echo "***".$rs_existe_registro."***";
				    
        if ($rs_existe_registro == 1){           

            // Datos de la session
            $_SESSION['tokn'] = uniqid(md5(microtime()), true);         // Definimos un token de sesion
            $_SESSION['sson_agnt'] = $_SERVER['HTTP_USER_AGENT'];       // Agente del navegador web
            $_SESSION['sson_dcip'] = GetClientIP();                     // Direccion IP 
            $_SESSION['sson_fchi'] = date('Y/m/d H:i');                 // Fecha y hora de inicio de sesion
            $_SESSION['sson_ufch'] = date('Y/m/d H:i');                 // Ultima fecha y hora accedida

            // Datos del administrador
            $_SESSION['sson_idpr'] =  $rs_datos->id;                    // id de la persona
            $_SESSION['sson_nomb'] =  $rs_datos->prtp_nomb;             // nombre de la persona
            $_SESSION['sson_apll'] =  $rs_datos->prtp_apll;             // apellido de la persona
            $_SESSION['sson_sexo'] =  $rs_datos->prtp_sexo;             // sexo de la persona
            $_SESSION['sson_mail'] =  $rs_datos->prtp_mail;             // email de la persona
            $_SESSION['sson_tipo'] = "prtp";
            
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
            echo "<script type=\"text/javascript\">window.location=\"".$path."app/prtp/prtp_panel_control.php\"</script> \n";
        } 

        else{
            $operacion = "login";
            $nombre_tabla = "";
            $mensaje = "error";
            $opcion= "logueado";
        }
    }
    
    // Fix del inicio del body
    echo "<body class=\"\"> \n";
    
    // Contenedor
    echo "<div class=\"page-lock\"> \n"
        ."<div class=\"page-logo\"> \n"
        ."<a class=\"brand\" href=\"index.html\"> \n"
        ."<img height=\"100\" src=\"uploads/imagenes/logo/".$datos_pref->pref_loga."\" alt=\"logo\" /> </a> \n"
        ."</div> \n"
        ."<div class=\"page-body\"> \n"
        ."<div class=\"lock-head\">Autentificaci&oacute;n de Administradores</div> \n"
        ."<div class=\"lock-body\"> \n";

    // Formulario
    $action = basename($_SERVER['PHP_SELF']);
    echo "<form id=\"form_login\" name=\"form_login\" class=\"lock-form lock-form-custom\" action=\"".$action."\" method=\"post\"> \n"
        ."<h4>Inicio de Sesi&oacute;n</h4> \n"
        ."<div class=\"form-group\"> \n"
        ."<input id=\"prtp_mail\" name=\"prtp_mail\" class=\"form-control placeholder-no-fix form-control-custom\" type=\"email\" autocomplete=\"off\" placeholder=\"Direcci&oacute;n Email\"  />  \n"
        ."</div> \n"
        ."<div class=\"form-group\"> \n"
        ."<input id=\"prtp_pass\" name=\"prtp_pass\" class=\"form-control placeholder-no-fix form-control-custom\" type=\"password\" autocomplete=\"off\" placeholder=\"Contrase&ntilde;a\" name=\"password\" />  \n"
        ."</div> \n"
        ."<div class=\"form-actions\"> \n"
        ."<button type=\"submit\" value=\"enviar\" name=\"control\" class=\"btn green uppercase form-control-custom\">Iniciar Sesi&oacute;n</button> \n"
        ."</div> \n";
    
    if (isset($mensaje) && ($mensaje == "error")){
        
        echo "<div class=\"form-group\"> \n"
            ."<div class=\"alert alert-danger \"> \n"
            ."<i class=\"fa fa-exclamation-circle\"></i> \n"
            ."<strong>&iexcl;Error!</strong> Los datos no son correctos. </div> \n"
            ."</div> \n";
    }
    if (isset($mensaje) && ($mensaje == "success")){
        
        echo "<div class=\"form-group\"> \n"
            ."<div class=\"alert alert-success \"> \n"
            ."<i class=\"fa fa-check\"></i> \n"
            ."<strong>&iexcl;Exito!</strong> Los datos son correctos. </div> \n"
            ."</div> \n";
    }
    echo "</form> \n";
    
    
    
    // Contenedor
    echo "</div> \n"
        ."<div class=\"lock-bottom\"> \n"
        ."<a href=\"".$path."login.php\">Volver al inicio</a> \n"
        ."</div> \n"
        ."</div> \n"
        ."<div class=\"page-footer-custom\"> 2016 &copy; SmartNova. Admin Dashboard. </div> \n"
        ."</div> \n";

    $sjs = "<script src=\"".$path."assets/pages/scripts/lock.min.js\" type=\"text/javascript\"></script> \n";
    ScriptsJS($path, $sjs);
            
    EndBody($path);
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    ?>