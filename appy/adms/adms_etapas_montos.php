<?php 
    /********************************************************/
    /* Administrador Web SmartNova
    /* CRUD - tbla_mdet
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
    $_SESSION['mdlo_code'] = "MD-MTSETPS";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Objetivo para los formularios, los enlaces y las funciones 
    $objetivo = basename($_SERVER["PHP_SELF"]); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Permisos del modulo
    $permisos = PermisosModulo($path); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Encabezado de la pagina
    $page_title = "Preventas - Montos ";
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

        $table = "tbla_mdet";
        $captcha ="off";
        $config['datatable_title'] = "Montos de las Etapas ";
        $config['datatable_actions_path'] = $path."app/";
        $title = "Gesti&oacute;n de Datos";
        // Datos del formulario
        $form =  array(
            array ('campo' => 'mdet_etpa', 'nombre' => 'Etapa', 'tipo_objeto' => 'select', 'tipo_dato' => 'integer', 'tabla' => 'tbla_etpa', 'orden' => 'id', 'valor' => 'id', 'descripcion' => 'etpa_nomb'),                       
            array ('campo' => 'mdet_desc', 'nombre' => 'Descripci&oacute;n', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'),            
            array ('campo' => 'mdet_mone', 'nombre' => 'Moneda', 'tipo_objeto' => 'select', 'tipo_dato' => 'integer', 'tabla' => 'tbla_mone', 'orden' => 'id', 'valor' => 'id', 'descripcion' => 'mone_nomb'),                       
            array ('campo' => 'mdet_mont', 'nombre' => 'Monto', 'tipo_objeto' => 'input_number', 'tipo_dato' => 'decimal'),            
            array ('campo' => 'mdet_estd', 'nombre' => 'Estado', 'tipo_objeto' => 'input_radio', 'tipo_dato' => 'bool', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
        );

        // Switch para las opciones e lista, nuevo registro, eliminar, modificar, ver detalles
        switch ($op) {
//========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================// 

            // Opcion de lista
            case "listar":
                if ($permisos['cons'] == TRUE){
                    $id_tabla = FALSE;
                    $sql = "SELECT tbla_mdet.id, mdet_desc, mdet_mone, mdet_mont, mdet_estd, mdet_freg, "
                        ."tbla_mone.id AS mone_id, mone_nomb, mone_simb "
                        ."FROM tbla_mdet "
                        ."INNER JOIN tbla_mone ON (mdet_mone = tbla_mone.id)"
                        ."ORDER BY mdet_freg DESC";
                    $legend = $page_title;
                    $dt_acciones = array('editar' => '', 'eliminar' => '', 'auditoria' => '');
                    $datatable = array(
                        array('nombre' => 'Descripci&oacute;n', 'width' => '', 'campo' => 'mdet_desc', 'formato' => 'normal'), 
                        array('nombre' => 'Moneda', 'width' => '', 'campo' => 'mone_simb', 'formato' => 'normal'), 
                        array('nombre' => 'Monto', 'width' => '', 'campo' => 'mdet_mont', 'formato' => 'normal'), 
                        array('nombre' => 'Estado', 'width' => '', 'campo' => 'mdet_estd', 'formato' => 'radio', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
                        array('nombre' => 'Fecha de registro', 'width' => '', 'campo' => 'mdet_freg', 'formato' => 'datetime'), 
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
                        $criterio = "mdet_etpa = {mdet_etpa} AND mdet_desc = {mdet_desc} AND mdet_mone = {mdet_mone}";
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