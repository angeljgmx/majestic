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
    $_SESSION['mdlo_code'] = "MD-NOTICIAS";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Objetivo para los formularios, los enlaces y las funciones 
    $objetivo = basename($_SERVER["PHP_SELF"]); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Permisos del modulo
    $permisos = PermisosModulo($path); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Encabezado de la pagina
    $page_title = "Noticias ";
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

        $table = "tbla_notc";
        $captcha ="off";
        $config['datatable_title'] = "Noticias ";
        $config['datatable_actions_path'] = $path."app/";
        $title = "Gesti&oacute;n de Datos";
        // Datos del formulario
        $form =  array(
            array ('campo' => 'notc_nott', 'nombre' => 'Tipo de noticia', 'tipo_objeto' => 'select', 'tipo_dato' => 'integer', 'tabla' => 'tbla_nott', 'orden' => 'id', 'valor' => 'id', 'descripcion' => 'nott_nomb'), 
            array ('campo' => 'notc_ctgn', 'nombre' => 'Categor&iacute;a', 'tipo_objeto' => 'select', 'tipo_dato' => 'integer', 'tabla' => 'tbla_ctgn', 'orden' => 'id', 'valor' => 'id', 'descripcion' => 'ctgn_nomb'), 
            array ('campo' => 'notc_adms', 'nombre' => 'Administrador', 'tipo_objeto' => 'select', 'tipo_dato' => 'integer', 'tabla' => 'tbla_adms', 'orden' => 'id', 'valor' => 'id', 'descripcion' => 'adms_nomb'), 
            array ('campo' => 'notc_ttlo', 'nombre' => 'T&iacute;tulo', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'notc_entr', 'nombre' => 'Entrada', 'tipo_objeto' => 'ckeditor', 'tipo_dato' => 'html'), 
            array ('campo' => 'notc_cuer', 'nombre' => 'Cuerpo', 'tipo_objeto' => 'ckeditor', 'tipo_dato' => 'html'), 
            array ('campo' => 'notc_fech', 'nombre' => 'Fecha y hora de la noticia', 'tipo_objeto' => 'input_datetime_picker', 'tipo_dato' => 'datetime'), 
            array ('campo' => 'notc_fpub', 'nombre' => 'Fecha y hora de publicaci&oacute;n', 'tipo_objeto' => 'input_datetime_picker', 'tipo_dato' => 'datetime'), 
            array ('campo' => 'notc_fnte', 'nombre' => 'Fuente de la noticia', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'notc_img1', 'nombre' => 'Im&aacute;gen 01', 'tipo_objeto' => 'file', 'tipo_dato' => 'file', 'type' => 1, 'folder' => 'imagenes/noticias'),
            array ('campo' => 'notc_cpt1', 'nombre' => 'Leyenda de la im&aacute;gen 01', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'),
            array ('campo' => 'notc_img2', 'nombre' => 'Im&aacute;gen 02', 'tipo_objeto' => 'file', 'tipo_dato' => 'file', 'type' => 1, 'folder' => 'imagenes/noticias'), 
            array ('campo' => 'notc_cpt2', 'nombre' => 'Leyenda de la im&aacute;gen 02', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'),
            array ('campo' => 'notc_img3', 'nombre' => 'Im&aacute;gen 03', 'tipo_objeto' => 'file', 'tipo_dato' => 'file', 'type' => 1, 'folder' => 'imagenes/noticias'),
            array ('campo' => 'notc_cpt3', 'nombre' => 'Leyenda de la im&aacute;gen 03', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'),
            array ('campo' => 'notc_yutb', 'nombre' => 'Video de Youtube', 'tipo_objeto' => 'textarea', 'tipo_dato' => 'html'),
            array ('campo' => 'notc_estd', 'nombre' => 'Estado de la noticia', 'tipo_objeto' => 'input_radio', 'tipo_dato' => 'bool', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
        );

        // Switch para las opciones e lista, nuevo registro, eliminar, modificar, ver detalles
        switch ($op) {
//========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================// 

            // Opcion de lista
            case "listar":
                if ($permisos['cons'] == TRUE){
                    $id_tabla = FALSE;
                    $sql = "SELECT tbla_notc.id, notc_ctgn, notc_ttlo, notc_entr, notc_fech, notc_fnte, notc_img1, notc_img2, notc_img3, notc_yutb, notc_estd, notc_freg, "
                        ."tbla_ctgn.id AS ctgn_id, ctgn_nomb "
                        ."FROM tbla_notc INNER JOIN tbla_ctgn ON (notc_ctgn = tbla_ctgn.id) "
                        ."ORDER BY notc_freg DESC";
                    $legend = $page_title;
                    $dt_acciones = array('editar' => '', 'eliminar' => '', 'auditoria' => '');
                    $datatable = array(
                        array('nombre' => 'Categor&iacute;a', 'width' => '', 'campo' => 'ctgn_nomb', 'formato' => 'normal'), 
                        array('nombre' => 'T&iacute;tulo', 'width' => '', 'campo' => 'notc_ttlo', 'formato' => 'normal'), 
                        array('nombre' => 'Entrada', 'width' => '', 'campo' => 'notc_entr', 'formato' => 'normal'), 
                        array('nombre' => 'Fecha', 'width' => '', 'campo' => 'notc_fech', 'formato' => 'datetime'), 
                        array('nombre' => 'Fuente de la noticia', 'width' => '', 'campo' => 'notc_fnte', 'formato' => 'normal'), 
                        array('nombre' => 'Im&aacute;gen', 'width' => '', 'campo' => 'notc_img1', 'formato' => 'imagen', 'folder' => 'imagenes/noticias'), 
                        array('nombre' => 'Estado', 'width' => '', 'campo' => 'notc_estd', 'formato' => 'radio', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
                        array('nombre' => 'Fecha de ingreso', 'width' => '', 'campo' => 'notc_freg', 'formato' => 'datetime'), 
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