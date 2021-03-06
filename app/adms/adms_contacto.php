<?php 
    /********************************************************/
    /* Administrador Web SmartNova
    /* CRUD - tbla_cont
    /* 25-7-2016
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
    $_SESSION['mdlo_code'] = "MD-CONTACTO";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Objetivo para los formularios, los enlaces y las funciones 
    $objetivo = basename($_SERVER["PHP_SELF"]); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Permisos del modulo
    $permisos = PermisosModulo($path); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Encabezado de la pagina
    $page_title = "Contacto";
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

        $table = "tbla_cont";
        $captcha ="off";
        $title = "Gesti&oacute;n de Datos";
        
        // Datos del formulario
        $form =  array(
            array ('campo' => 'cont_nomb', 'nombre' => 'Nombre', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'),
            array ('campo' => 'cont_iorg', 'nombre' => 'Informaci&oacute;n de la Organizaci&oacute;n', 'tipo_objeto' => 'ckeditor', 'tipo_dato' => 'html'),
            array ('campo' => 'cont_gmap', 'nombre' => 'Google map', 'tipo_objeto' => 'textarea', 'tipo_dato' => 'html'),
            array ('campo' => 'cont_text', 'nombre' => 'Texto Formulario de Email', 'tipo_objeto' => 'ckeditor', 'tipo_dato' => 'html'),
            array ('campo' => 'cont_dirc', 'nombre' => 'Direci&oacute;n', 'tipo_objeto' => 'textarea', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'cont_mail', 'nombre' => 'Email', 'tipo_objeto' => 'input_email', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'cont_tlfn', 'nombre' => 'Tel&eacute;fono', 'tipo_objeto' => 'input_tel', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'cont_tfax', 'nombre' => 'Tel&eacute;fono', 'tipo_objeto' => 'input_tel', 'tipo_dato' => 'cleartext'),
            array ('campo' => 'cont_movl', 'nombre' => 'M&oacute;vil Celular', 'tipo_objeto' => 'input_tel', 'tipo_dato' => 'cleartext'),
            array ('campo' => 'cont_hrio', 'nombre' => 'Horario.', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'),
            array ('campo' => 'cont_riff', 'nombre' => 'R.I.F.', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'),
            array ('campo' => 'cont_post', 'nombre' => 'C&oacute;digo Postal', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'cont_buzn', 'nombre' => 'Buz&oacute;n de Contacto', 'tipo_objeto' => 'input_email', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'cont_estd', 'nombre' => 'Estado', 'tipo_objeto' => 'input_radio', 'tipo_dato' => 'bool', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
        );

        // Opcion de lista
        if ($permisos['edit'] == TRUE){
                if (isset($_POST["control"]) && ($_POST["control"] == 1)){
                    $criterio = "";
                    FormProcess($path, $op, $table, $criterio, $form, $captcha, $config);
                }

                FormShow($path, $op, $title, $objetivo, $form, $table, $captcha, $config);
        }
        else {
            PermisosMensajeError($path, FALSE);
        }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    } // Fin de la validacion de la session
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Pie de pagina
    $sjs = "";
    CommonFooter($path, $sjs, $config);
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

?>