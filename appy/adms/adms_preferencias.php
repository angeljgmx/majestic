<?php 
    /********************************************************/
    /* Administrador Web SmartNova
    /* CRUD - tbla_pref
    /* 02-7-2016
    /********************************************************/

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Inicio de sesion
    session_start(); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Ubicación del archivo 
    $path = "../../"; 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Inclusion de archivos necesarios 
    require_once $path."core/core.php"; 
    Core($path);
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Seguridad 
    Seguridad($path);
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Identificador del modulo
    $_SESSION['mdlo_code'] = "MD-PREF";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Objetivo para los formularios, los enlaces y las funciones 
    $objetivo = basename($_SERVER["PHP_SELF"]); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Encabezado de la pagina
    $page_title = "Preferencias";
    $meta = "";
    $css = "";
    $js = "";
    $actions_pagebar = array('nuevo_registro' => '', 'tabla_consulta' => '', 'panel_control' => '');
    $config = [];
    CommonHeader($path, $page_title, $meta, $css, $js, $objetivo, $actions_pagebar, $config);
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Validacion de la session
    if (SessionValidate($path, "adms")){
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

        // Recepcion  de variable de opcion por GET
        $op = "editar";

        $table = "tbla_pref";
        $captcha ="off";
        $config['datatable_title'] = "Preferencias";
        $config['datatable_actions_path'] = $path."app/";
        $title = "Gesti&oacute;n de Datos";
        // Datos del formulario
        $form =  array(
            array ('campo' => 'pref_durl', 'nombre' => 'Direccion URL', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'normal'), 
            array ('campo' => 'pref_hrtb', 'nombre' => 'Horario de trabajo', 'tipo_objeto' => 'textarea', 'tipo_dato' => 'cleartext'),
            
            array ('elemento' => 'form_title', 'form_title_type' => 'h2', 'form_title_text' => 'Logotipos'), 
            array ('campo' => 'pref_logh', 'nombre' => 'Logotipo en el encabezado', 'tipo_objeto' => 'file', 'tipo_dato' => 'file', 'type' => 1, 'folder' => 'imagenes/logo'), 
            array ('campo' => 'pref_logf', 'nombre' => 'Logotipo en el pie de p&aacute;gina', 'tipo_objeto' => 'file', 'tipo_dato' => 'file', 'type' => 1, 'folder' => 'imagenes/logo'), 
            array ('campo' => 'pref_loga', 'nombre' => 'Logotipo en el administrador web', 'tipo_objeto' => 'file', 'tipo_dato' => 'file', 'type' => 1, 'folder' => 'imagenes/logo'), 
            
            array ('elemento' => 'form_title', 'form_title_type' => 'h2', 'form_title_text' => 'Pie de P&aacute;gina'), 
            array ('campo' => 'pref_copy', 'nombre' => 'Informaci&oacute;n de Copyright', 'tipo_objeto' => 'textarea', 'tipo_dato' => 'cleartext'),
            array ('campo' => 'pref_ftnn', 'nombre' => 'N&uacute;mero de Noticias', 'tipo_objeto' => 'textarea', 'tipo_dato' => 'cleartext'),
            array ('campo' => 'pref_ftnt', 'nombre' => 'N&uacute;mero de Tweets', 'tipo_objeto' => 'textarea', 'tipo_dato' => 'cleartext'),
             
            array ('campo' => 'pref_char', 'nombre' => 'Juego de caracteres por defecto del sitio', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'pref_desc', 'nombre' => 'Descripci&oacute;n del sitio Web para los buscadores', 'tipo_objeto' => 'textarea', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'pref_keyw', 'nombre' => 'Palabras clave', 'tipo_objeto' => 'textarea', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'pref_flgs', 'nombre' => 'Estilo de los iconos de las banderas de los paises', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'pref_geip', 'nombre' => 'Activar geolocalizaci&oacute;n IP', 'tipo_objeto' => 'input_radio', 'tipo_dato' => 'bool', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'),
            array ('campo' => 'pref_fvcn', 'nombre' => 'Favicon', 'tipo_objeto' => 'file', 'tipo_dato' => 'file', 'type' => 1, 'folder' => 'imagenes/favicon'),
        );


        if (isset($_POST["control"]) && ($_POST["control"] == 1)){
            $criterio = "";
            FormProcess($path, $op, $table, $criterio, $form, $captcha, $config);
        }

        FormShow($path, $op, $title, $objetivo, $form, $table, $captcha, $config);

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    } // Fin de la validacion de la session
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Pie de pagina
    $sjs = "";
    CommonFooter($path, $sjs, $config);
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

?>