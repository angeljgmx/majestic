<?php 
    /********************************************************/
    /* Administrador Web SmartNova
    /* CRUD - tbla_notc
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
    $_SESSION['mdlo_code'] = "MD-LCRS";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Objetivo para los formularios, los enlaces y las funciones 
    $objetivo = basename($_SERVER["PHP_SELF"]); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Permisos del modulo
    $permisos = PermisosModulo($path); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Encabezado de la pagina
    $page_title = "Licores ";
    $page_subtitle = "Administrador";
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
        $op = OptionGetPost($path);

        $table = "tbla_lcor";
        $captcha ="off";
        $config['datatable_title'] = "Licores ";
        $config['datatable_actions_path'] = $path."app/";
        $title = "Gesti&oacute;n de Datos";
        // Datos del formulario
        $form =  array(
            array ('campo' => 'lcor_lctp', 'nombre' => 'Tipo de licor', 'tipo_objeto' => 'select', 'tipo_dato' => 'integer', 'tabla' => 'tbla_lctp', 'orden' => 'id', 'valor' => 'id', 'descripcion' => 'lctp_nomb'), 
            array ('campo' => 'lcor_lcmc', 'nombre' => 'Marca del licor', 'tipo_objeto' => 'select', 'tipo_dato' => 'integer', 'tabla' => 'tbla_lcmc', 'orden' => 'id', 'valor' => 'id', 'descripcion' => 'lcmc_nomb'), 
            array ('campo' => 'lcor_lcct', 'nombre' => 'Categor&iacute;a del licor', 'tipo_objeto' => 'select', 'tipo_dato' => 'integer', 'tabla' => 'tbla_lcct', 'orden' => 'id', 'valor' => 'id', 'descripcion' => 'lcct_nomb'), 
            array ('campo' => 'lcor_nomb', 'nombre' => 'Nombre', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'),
            array ('campo' => 'lcor_desc', 'nombre' => 'Descripci&oacute;n', 'tipo_objeto' => 'ckeditor', 'tipo_dato' => 'html'), 
            array ('campo' => 'lcor_imgn', 'nombre' => 'Im&aacute;gen', 'tipo_objeto' => 'file', 'tipo_dato' => 'file', 'type' => 1, 'folder' => 'imagenes/licores'),  
            array ('campo' => 'lcor_prec', 'nombre' => 'Precio', 'tipo_objeto' => 'input_number', 'tipo_dato' => 'float'), 
            array ('campo' => 'lcor_estd', 'nombre' => 'Estado', 'tipo_objeto' => 'input_radio', 'tipo_dato' => 'bool', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
        );

        // Switch para las opciones e lista, nuevo registro, eliminar, modificar, ver detalles
        switch ($op) {
//========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================// 

            // Opcion de lista
            case "listar":
                if ($permisos['cons'] == TRUE){
                    $id_tabla = FALSE;
                    $sql = "SELECT tbla_lcor.id, lcor_lctp, lcor_nomb, lcor_lcct, lcor_lcmc, lcor_imgn, lcor_estd, lcor_freg, "
                        ."tbla_lctp.id AS lctp_id, lctp_nomb, "
                        ."tbla_lcmc.id AS lcmc_id, lcmc_nomb, "
                        ."tbla_lcct.id AS lcct_id, lcct_nomb "
                        ."FROM tbla_lcor "
                        ."INNER JOIN tbla_lctp ON (lcor_lctp = tbla_lctp.id) "
                        ."INNER JOIN tbla_lcmc ON (lcor_lcmc = tbla_lcmc.id) "
                        ."INNER JOIN tbla_lcct ON (lcor_lcct = tbla_lcct.id) "
                        ."ORDER BY lcor_freg DESC";
                    $legend = $page_title;
                    $dt_acciones = array('editar' => '', 'eliminar' => '', 'auditoria' => '');
                    $datatable = array(
                        array('nombre' => 'Nombre', 'width' => '', 'campo' => 'lcor_nomb', 'formato' => 'normal'), 
                        array('nombre' => 'Tipo', 'width' => '', 'campo' => 'lctp_nomb', 'formato' => 'normal'), 
                        array('nombre' => 'Categor&iacute;a', 'width' => '', 'campo' => 'lcor_lcct', 'formato' => 'normal'), 
                        array('nombre' => 'Marca', 'width' => '', 'campo' => 'lcmc_nomb', 'formato' => 'normal'), 
                        array('nombre' => 'Im&aacute;gen', 'width' => '', 'campo' => 'lcor_imgn', 'formato' => 'imagen', 'folder' => 'imagenes/licores/'), 
                        array('nombre' => 'Estado', 'width' => '', 'campo' => 'lcor_estd', 'formato' => 'radio', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
                        array('nombre' => 'Fecha de ingreso', 'width' => '', 'campo' => 'lcor_freg', 'formato' => 'datetime'), 
                    );
                    DataTable($path, $sql, $objetivo, $dt_acciones,  $datatable, $config);
                }
                else {
                    PermisosMensajeError($path, FALSE);
                }
            break;
//========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================// 

            // Opcion de insertar registros
            case "insertar":
                if ($permisos['insr'] == TRUE){
                    if (isset($_POST["control"]) && ($_POST["control"] == 1)){
                        $criterio = "";
                        FormProcess($path, $op, $table, $criterio, $form, $captcha, $config);
                    }

                    FormShow($path, $op, $title, $objetivo, $form, $table, $captcha, $config);
                }
                else {
                    PermisosMensajeError($path, FALSE);
                }
            break;
//========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================// 

            // Opcion de editar registros
            case "editar":
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
            break;
//========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================// 

            // Opcion de eliminar registros
            case "eliminar":
                if ($permisos['elim'] == TRUE){
                    Eliminar($path, $objetivo, $table);
                }
                else {
                    PermisosMensajeError($path, FALSE);
                }    
            break;
//========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================// 

        } // Fin del switch 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    } // Fin de la validacion de la session
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Pie de pagina
    $sjs = "";
    CommonFooter($path, $sjs, $config);
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

?>