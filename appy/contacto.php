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
    $page_title = "Contacto";
    $meta = "";
    $css = "";
    $js = "";
    $current = "contacto";
    $content_class = "contact-page";
    $config['body-option'] = 9;
    CommonHeader($path, $page_title, $meta, $css, $js, $current, $content_class, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    //Llaves de la captcha
    $captcha_publickey = CAPTCHA_PUBLICKEY;
    $captcha_privatekey = CAPTCHA_PRIVATEKEY;

    // Respuesta vacia
    $response = null;
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Consulta de los datos de contacto 
    $sql_cont = "SELECT * FROM tbla_cont WHERE id = 1";
    $query_cont = $conec->dbQuery($sql_cont, $debug);
    $datos_cont = $conec->dbFetchObjet($query_cont);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Verificar si se ha enviado el formulario
    //echo $_POST['control'];
    if (null !== filter_input(INPUT_POST, 'control', FILTER_SANITIZE_NUMBER_INT)){ 

        // Consulta de preferencias
        $sql_pref = "SELECT cont_buzn FROM tbla_cont";
        $query_pref = $conec->dbQuery($sql_pref, $debug);
        $datos_pref = $conec->dbFetchObjet($query_pref);
        
        // Titulo del aviso
        $modal_title = "Env&iacute;o de Correos";

        // Comprueba la llave secreta
        $reCaptcha = new ReCaptcha($captcha_privatekey);
        
        $modal_config = "";

        // Si se detecta la respuesta como enviada
        if ($_POST["g-recaptcha-response"]) {
            $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);

            if ($response != null && $response->success) {
                $captcha_estado = TRUE;

                // Recepcion de variables del formulario
                $mserror = "";
                
                $nombre = ReemSpecialChars($_POST['cntc_name']);                        // Nombre
                $email = ReemSpecialChars($_POST['cntc_mail']);                         // Email
                $asunto = ReemSpecialChars($_POST['cntc_asnt']);                     // Asunto
                $mssg = ReemSpecialChars($_POST['cntc_mssg']);                       // Mensaje
                $address = $_SESSION['cont_buzn'];

                $mensaje = "Email de Contacto del sitio Web de Caronte <br />";
                $mensaje .= "Nombre: ".$nombre."<br />";
                $mensaje .= "Email: ".$email."<br />";
                $mensaje .= "Mensaje: ".$mssg;
                
                // Enviar correo al administrador
                $mail_mnsj = itl_MailContact($path, $nombre, $email, $asunto, $mensaje, $address, $mserror, $debug);
                if ($mail_mnsj == "success"){
                    $modal_alert_type = "success";
                    $modal_message = "El Mensaje ha sido enviado satisfactoriamente.";
                }
                else {
                    $modal_alert_type = "error";
                    $modal_message = "El Mensaje no se ha podido enviar satisfactoriamente. Ha ocurrido un error al realizar la operaci&oacute;n";
                }
                $operacion = "correo";                
                ModalMessage($modal_title, $modal_alert_type, $modal_message, $modal_config);
            }
        }
        else{
            $captcha_estado = FALSE;
            //echo  $error_captcha = $captcha_respuesta->error;
            $modal_alert_type = "error";
            $modal_message = "El CAPTCHA no fue seleccionado";
            ModalMessage($modal_title, $modal_alert_type, $modal_message, $modal_config);
            //return  $response->error;
        }
    }
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    ?>
    
    <div class="row">
        <div class="col-sm-12 col-md-12 mb-40">
            <?php echo $_SESSION['cont_gmap']; ?>
        </div>

        <div class="col-sm-12 col-md-8">
            <h4>CONTACTENOS</h4>
            <?php echo $_SESSION['cont_text'] ?>
            <div class="mt-20">
                <form name="contactform" id="contactForm" method="post" action="<?php echo $path."app/contacto.php"; ?>">
                <p>
<!--                    <label>Su nombre:</label>-->
                     <input id="cntc_name" name="cntc_name" type="text" placeholder="Nombre *" required="required">
                </p>
                <p>
<!--                    <label>Su direcci&oacute;n de correo electr&oacute;nico</label>-->
                    <input id="cntc_mail" name="cntc_mail" type="email" placeholder="Email *" required>
                </p>
                <p>
<!--                    <label>Asunto</label>-->
                    <input id="cntc_asnt" name="cntc_asnt" type="text" placeholder="Asunto *" required>
                </p>
                <p>
<!--                    <label>Tel&eacute;fono</label>-->
                    <input id="cntc_tlfn" name="cntc_tlfn" type="text" placeholder="Tel&eacute;fono *" required>
                </p>
                <p>
<!--                    <label>Mensaje</label>-->
                    <textarea id="cntc_mssg" name="cntc_mssg" class="" rows="7" placeholder="Mensaje" required></textarea>
                </p>
                <p>
                    <input name="form_botcheck" class="form-control" type="hidden" value=\"\" />
                    <input name="control" type="hidden" value="1" />
                    <button type="submit" class="button mr-5" data-loading-text="Please wait..."><i class="fa fa-envelope"></i> Enviar</button>
                    <button type="reset" class="button">Reset</button>
                </p>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <h4>INFORMACI&Oacute;N DE CONTACTO</h4>
            <div>
                <p>Estamos para servirle. Si crees que podemos ayudarte, no dudes en ponerte en contacto con nosotros a trav&eacute;s de los siguientes medios</p>
                
                <ul class="store_info">
                    <li class="mb-10"><i class="fa fa-map-marker"></i> <strong>Direcci&oacute;n:</strong> <?php echo $_SESSION['cont_dirc']; ?></li>
                    <li class="mb-10"><i class="fa fa-phone"></i> <strong>Tel&eacute;fono:</strong> <?php echo $_SESSION['cont_tlfn']; ?></li>
                    <li class="mb-10"><i class="fa fa-fax"></i> <strong>Tel&eacute;fax:</strong> <?php echo $_SESSION['cont_tfax']; ?></li>
                    <li class="mb-10"><i class="fa fa-mobile"></i> <strong>Movil / Celular:</strong> <?php echo $_SESSION['cont_movl']; ?></li>
                    <li class="mb-10"><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:<?php echo $_SESSION['cont_mail']; ?>"><?php echo $_SESSION['cont_mail'] ?></a></li>
                    <li class="mb-10"><i class="fa fa-envelope-o"></i> <strong>C&oacute;digo postal:</strong> <?php echo $_SESSION['cont_post']; ?></li>
                    <li class="mb-10"><i class="fa fa-clock-o"></i> <strong>Horario:</strong> <?php echo $_SESSION['cont_hrio']; ?></li>
                </ul>
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