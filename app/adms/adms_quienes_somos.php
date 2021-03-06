<?php 
    /********************************************************/
    /* Administrador Web SmartNova
    /* CRUD - tbla_qmos
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

    // Identificador del modulo
    $_SESSION['mdlo_code'] = "MD-QMOS";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Seguridad 
    Seguridad($path);
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Permisos del modulo
    $permisos = PermisosModulo($path); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Objetivo para los formularios, los enlaces y las funciones 
    $objetivo = basename($_SERVER["PHP_SELF"]); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Encabezado de la pagina
    $page_title = "Quienes Somos";
    $meta = "";
    $css = "";
    $js = "";
    $actions_pagebar = array('panel_control' => '');
    $config = [];
    CommonHeader($path, $page_title, $meta, $css, $js, $objetivo, $actions_pagebar, $config);
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Validacion de la session
    if (SessionValidate($path, "adms")){
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

        if ($permisos['edit'] == TRUE){
            // Recepcion  de variable de opcion por GET
            $op = "editar";

            $table = "tbla_qmos";
            $captcha ="off";
            $config['datatable_title'] = "Quienes Somos";
            $config['datatable_actions_path'] = $path."app/";
            $title = "Gesti&oacute;n de Datos";
            // Datos del formulario
            $form =  array(
                array ('campo' => 'qmos_intr', 'nombre' => 'Introducci&oacute;n', 'tipo_objeto' => 'textarea', 'tipo_dato' => 'cleartext'), 
                array ('campo' => 'qmos_qsms', 'nombre' => 'Descripci&oacute;n de quienes somos', 'tipo_objeto' => 'ckeditor', 'tipo_dato' => 'html'), 
                array ('campo' => 'qmos_misn', 'nombre' => 'Misi&oacute;n', 'tipo_objeto' => 'ckeditor', 'tipo_dato' => 'html'), 
                array ('campo' => 'qmos_visn', 'nombre' => 'Visi&oacute;n', 'tipo_objeto' => 'ckeditor', 'tipo_dato' => 'html'), 
                array ('campo' => 'qmos_flfa', 'nombre' => 'Filosof&iacute;a', 'tipo_objeto' => 'ckeditor', 'tipo_dato' => 'html'), 
                array ('campo' => 'qmos_srv1', 'nombre' => 'Servicio 1', 'tipo_objeto' => 'textarea', 'tipo_dato' => 'cleartext'), 
                array ('campo' => 'qmos_icn1', 'nombre' => 'Icono 1', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'),
                array ('campo' => 'qmos_srv2', 'nombre' => 'Servicio 2', 'tipo_objeto' => 'textarea', 'tipo_dato' => 'cleartext'), 
                array ('campo' => 'qmos_icn2', 'nombre' => 'Icono 2', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'),
                array ('campo' => 'qmos_estd', 'nombre' => 'Estado del registro', 'tipo_objeto' => 'input_radio', 'tipo_dato' => 'bool', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
            );

            if (isset($_POST["control"]) && ($_POST["control"] == 1)){
                $criterio = "qmos_qsms = {qmos_qsms} OR qmos_misn = {qmos_misn} OR qmos_visn = {qmos_visn} OR qmos_pltc = {qmos_pltc} OR qmos_objs = {qmos_objs}";
                FormProcess($path, $op, $table, $criterio, $form, $captcha, $config);
            }

            FormShow($path, $op, $title, $objetivo, $form, $table, $captcha, $config);
        }
        else {
            PermisosMensajeError($path, FALSE);
        }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    } // Fin de la validacion de la session
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Pie de pagina
    $sjs = "";
    CommonFooter($path, $sjs, $config);
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

?>