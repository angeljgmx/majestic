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

    // Validacion de la session
    //if ($_SESSION['user_sson']){

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

        <section class="contact-section">
          <div class="map-row">
            <div class="container-fluid">
              <div class="col-md-6 col-sm-12 col-xs-12 ">
                <div class="map-box">
                  <?php echo $_SESSION['cont_gmap']; ?>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 col-xs-12 contact-info-contenedor">
                <div class="contact-info">
                  <div class="contact-info-box">
                    <h2>INFORMACI&Oacute;N DE CONTACTO</h2>
                    <address>
                    <ul>
                      <li> <strong class="title">Direcci&oacute;n:</strong>
                        <p><?php echo $_SESSION['cont_dirc']; ?></p>
                      </li>
                      <li> <strong class="title">Email:</strong>
                        <p><a href="mailto:<?php echo $_SESSION['cont_mail']; ?>"><?php echo $_SESSION['cont_mail']; ?></a></p>
                      </li>
                      <li> <strong class="title">Tel&eacute;fono:</strong>
                        <p><?php echo $_SESSION['cont_tlfn']; ?></p>
                      </li>
                    </ul>
                    </address>
                  </div>
                </div>
              </div>
            </div>
          </div>

    <!--        <div class="row">
                <div class="container">
                <div class="comment-box mt-80">
                    <h2>LEAVE A COMMENT</h2>
                    <form action="event-detail.html#">
                      <div class="row">
                        <div class="col-md-6">
                          <input required placeholder="Name *" type="text">
                        </div>
                        <div class="col-md-6">
                          <input required placeholder="Email *" type="text">
                        </div>
                        <div class="col-md-12">
                          <textarea required cols="10" rows="10" placeholder="Comment"></textarea>
                        </div>
                        <div class="col-md-12">
                          <input value="SUBMIT COMMENT" type="submit">
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
            </div>-->
        </section>

    
    <?php
    //} 
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    //Pie de pagina
    $sjs = "";
    $config['top-footer'] = TRUE;
    CommonFooter($path, $sjs, $config);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
?>