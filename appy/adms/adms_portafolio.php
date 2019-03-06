<?php 
    /********************************************************/
    /* Administrador Web SmartNova
    /* CRUD - tbla_fltr
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
    $_SESSION['mdlo_code'] = "MD-PRTF";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Objetivo para los formularios, los enlaces y las funciones 
    $objetivo = basename($_SERVER["PHP_SELF"]); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Permisos del modulo
    $permisos = PermisosModulo($path); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Encabezado de la pagina
    $page_title = "Portafolio ";
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

        $table = "tbla_prtf";
        $captcha ="off";
        $config['datatable_title'] = "Filtros ";
        $config['datatable_actions_path'] = $path."app/";
        $title = "Gesti&oacute;n de Datos";
        // Datos del formulario; 
        $form =  array(
            array ('campo' => 'prtf_ctgs', 'nombre' => 'Categor&iacute;a', 'tipo_objeto' => 'select', 'tipo_dato' => 'integer', 'tabla' => 'tbla_ctgs', 'orden' => 'ctgs_nomb', 'valor' => 'id', 'descripcion' => 'ctgs_nomb'), 
            array ('campo' => 'prtf_clnt', 'nombre' => 'Cliente', 'tipo_objeto' => 'select', 'tipo_dato' => 'integer', 'tabla' => 'tbla_clnt', 'orden' => 'clnt_nomb', 'valor' => 'id', 'descripcion' => 'clnt_nomb'), 
            array ('campo' => 'prtf_ttlo', 'nombre' => 'T&iacute;tulo', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'),
            array ('campo' => 'prtf_desc', 'nombre' => 'Descripci&oacute;n', 'tipo_objeto' => 'ckeditor', 'tipo_dato' => 'html'), 
            array ('campo' => 'prtf_year', 'nombre' => 'A&ntilde;o', 'tipo_objeto' => 'select_numerico', 'tipo_dato' => 'cleartext', 'inicio' => 2010, 'fin' => 2030), 
            array ('campo' => 'prtf_durl', 'nombre' => 'Direcci&oacute;n URL', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'url'),        
            array ('campo' => 'prtf_img1', 'nombre' => 'Im&aacute;gen 01', 'tipo_objeto' => 'file', 'tipo_dato' => 'file', 'type' => 1, 'folder' => 'imagenes/portafolio'),
            array ('campo' => 'prtf_img2', 'nombre' => 'Im&aacute;gen 02', 'tipo_objeto' => 'file', 'tipo_dato' => 'file', 'type' => 1, 'folder' => 'imagenes/portafolio'),
            array ('campo' => 'prtf_img3', 'nombre' => 'Im&aacute;gen 03', 'tipo_objeto' => 'file', 'tipo_dato' => 'file', 'type' => 1, 'folder' => 'imagenes/portafolio'),
            array ('campo' => 'prtf_estd', 'nombre' => 'Estado de la noticia', 'tipo_objeto' => 'input_radio', 'tipo_dato' => 'bool', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
        );

        // Switch para las opciones e lista, nuevo registro, eliminar, modificar, ver detalles
        switch ($op) {
//========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================// 

            // Opcion de lista
            case "listar":
                if ($permisos['cons'] == TRUE){
                    $id_tabla = FALSE;
                    $sql = "SELECT tbla_prtf.id, prtf_clnt, prtf_ttlo, prtf_desc, prtf_year, prtf_img1, prtf_estd, prtf_freg, "
                        ."tbla_ctgs.id AS ctgs_id, ctgs_nomb, "
                        ."tbla_clnt.id AS clnt_id, clnt_nomb, clnt_all, clnt_marc "
                        ."FROM tbla_prtf "
                        ."INNER JOIN tbla_ctgs ON (tbla_ctgs.id = prtf_ctgs) "
                        ."INNER JOIN tbla_clnt ON (tbla_clnt.id = prtf_clnt) ORDER BY prtf_freg DESC";
                    $legend = $page_title;
                    $dt_acciones = array('editar' => '', 'eliminar' => '', 'auditoria' => '');
                    $datatable = array(
                        array('nombre' => 'Estado', 'width' => '', 'campo' => 'prtf_estd', 'formato' => 'radio', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
                        array('nombre' => 'T&iacute;tulo', 'width' => '', 'campo' => 'prtf_ttlo', 'formato' => 'normal'), 
                        array('nombre' => 'Categor&iacute;a', 'width' => '', 'campo' => 'ctgs_nomb', 'formato' => 'normal'), 
                        array('nombre' => 'Cliente', 'width' => '', 'campo' => 'clnt_marc', 'formato' => 'normal'), 
                        array('nombre' => 'Im&aacute;gen', 'width' => '', 'campo' => 'prtf_img1', 'formato' => 'imagen', 'folder' => 'imagenes/portafolio/'), 
                        array('nombre' => 'Fecha de ingreso', 'width' => '', 'campo' => 'prtf_freg', 'formato' => 'datetime'), 
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