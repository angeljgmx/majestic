<?php 
    /********************************************************/
    /* Administrador Web CETI
    /* CRUD - tbla_pagos
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
    $_SESSION['mdlo_code'] = "MD-CNTAS";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Objetivo para los formularios, los enlaces y las funciones 
    $objetivo = basename($_SERVER["PHP_SELF"]); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Permisos del modulo
    $permisos = PermisosModulo($path); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Encabezado de la pagina
    $page_title = "Cuentas Bancarias ";
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

        $table = "tbla_cnts";
        $captcha ="off";
        $config['datatable_title'] = "Cuentas ";
        $config['datatable_actions_path'] = $path."app/";
        $title = "Gesti&oacute;n de Datos";
        // Datos del formulario
        $form =  array(
            array ('campo' => 'cnts_nmro', 'nombre' => 'N&uacute;mero', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'cnts_tcta', 'nombre' => 'Tipo', 'tipo_objeto' => 'select', 'tipo_dato' => 'integer', 'tabla' => 'tbla_tcta', 'orden' => 'id', 'valor' => 'id', 'descripcion' => 'tcta_nomb'),  
            array ('campo' => 'cnts_bncs', 'nombre' => 'Banco', 'tipo_objeto' => 'select', 'tipo_dato' => 'integer', 'tabla' => 'tbla_bncs', 'orden' => 'id', 'valor' => 'id', 'descripcion' => 'bncs_nomb'),  
            array ('campo' => 'cnts_bnfr', 'nombre' => 'Beneficiario', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'cnts_didn', 'nombre' => 'Documento de Identidad', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'cnts_mail', 'nombre' => 'Email', 'tipo_objeto' => 'input_email', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'cnts_estd', 'nombre' => 'Estado', 'tipo_objeto' => 'input_radio', 'tipo_dato' => 'bool', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
        );

        // Switch para las opciones e lista, nuevo registro, eliminar, modificar, ver detalles
        switch ($op) {
//========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================// 

            // Opcion de lista
            case "listar":
                if ($permisos['cons'] == TRUE){
                    $id_tabla = FALSE;
                    $sql = "SELECT tbla_cnts.id, cnts_nmro, cnts_tcta, cnts_bncs, cnts_bnfr, cnts_didn, cnts_freg, "
                        ."tbla_bncs.id, bncs_nomb, "
                        ."tbla_tcta.id, tcta_nomb "
                        ."FROM tbla_cnts "
                        ."INNER JOIN tbla_bncs ON (tbla_bncs.id = cnts_bncs)"
                        ."INNER JOIN tbla_tcta ON (tbla_tcta.id = cnts_tcta) "                        
                        ."ORDER BY cnts_freg DESC";
                    $legend = $page_title;
                    $dt_acciones = array('editar' => '', 'eliminar' => '', 'auditoria' => '');
                    $datatable = array(
                        array('nombre' => 'Banco', 'width' => '', 'campo' => 'bncs_nomb', 'formato' => 'normal'), 
                        array('nombre' => 'N&uacute;mero', 'width' => '', 'campo' => 'cnts_nmro', 'formato' => 'normal'),                       
                        array('nombre' => 'Tipo', 'width' => '', 'campo' => 'tcta_nomb', 'formato' => 'normal'),
                        array('nombre' => 'Fecha de ingreso', 'width' => '', 'campo' => 'cnts_freg', 'formato' => 'datetime'), 
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