<?php 
    /********************************************************/
    /* Administrador Web SmartNova
    /* CRUD - tbla_fltc
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
    $_SESSION['mdlo_code'] = "MD-PROD-PTRN";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Objetivo para los formularios, los enlaces y las funciones 
    $objetivo = basename($_SERVER["PHP_SELF"]); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Permisos del modulo
    $permisos = PermisosModulo($path); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Encabezado de la pagina
    $page_title = "Patrones de estampado";
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

        $table = "tbla_ptrn";
        $captcha ="off";
        $config['datatable_title'] = "Patrones de estampado";
        $config['datatable_actions_path'] = $path."app/";
        $title = "Gesti&oacute;n de Datos";
        // Datos del formulario
        $form =  array(
            array ('campo' => 'ptrn_prln', 'nombre' => 'L&iacute;nea', 'tipo_objeto' => 'select', 'tipo_dato' => 'integer', 'tabla' => 'tbla_prln', 'orden' => 'prln_nomb', 'valor' => 'id', 'descripcion' => 'prln_nomb'),            
            array ('campo' => 'ptrn_nomb', 'nombre' => 'Nombre', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'ptrn_estd', 'nombre' => 'Estado', 'tipo_objeto' => 'input_radio', 'tipo_dato' => 'bool', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
        );

        // Switch para las opciones e lista, nuevo registro, eliminar, modificar, ver detalles
        switch ($op) {
//========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================// 

            // Opcion de lista
            case "listar":
                if ($permisos['cons'] == TRUE){
                    $id_tabla = FALSE;
                    $sql = "SELECT tbla_ptrn.id, ptrn_nomb, ptrn_estd, ptrn_freg "
                        ."tbla_prln.id, prln_nomb, "
                        ."tbla_prct.id AS prct_id, prct_nomb "
                        ."FROM tbla_prln "
                        ."INNER JOIN tbla_prct ON (prln_prct = tbla_prct.id) "    
                        ."ORDER BY id DESC";
                    $legend = $page_title;
                    $dt_acciones = array('editar' => '', 'eliminar' => '', 'auditoria' => '');
                    $datatable = array(
                        array('nombre' => 'Nombre', 'width' => '', 'campo' => 'ptrn_nomb', 'formato' => 'normal'), 
                        array('nombre' => 'Estado', 'width' => '', 'campo' => 'ptrn_estd', 'formato' => 'radio', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
                        array('nombre' => 'Fecha de ingreso del registro', 'width' => '', 'campo' => 'ptrn_freg', 'formato' => 'datetime'), 
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