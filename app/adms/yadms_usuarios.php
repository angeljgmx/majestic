<?php 
    /********************************************************/
    /* Administrador Web SmartNova
    /* CRUD - Administradores
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
    
    // Control de errores
    $debug = DEBUG;
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    // Crear la instancia y conectar a la BD
    $conec = new db();
    $conec->dbConexion(); 
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
    // Identificador del modulo
    $_SESSION['mdlo_code'] = "MD-USERS";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
    // Objetivo para los formularios, los enlaces y las funciones 
    $objetivo = basename($_SERVER["PHP_SELF"]); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
    // Permisos del modulo
    $permisos = PermisosModulo($path); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
    //Encabezado de la pagina
    $page_title = "Usuarios";
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
        $table = "tbla_user";
        $captcha ="off";
        $config['datatable_title'] = "Usuarios";
        $config['datatable_actions_path'] = $path."app/";
        $title = "Gesti&oacute;n de Datos";
        // Datos del formulario
        $form =  array(
            array ('campo' => 'user_nomb', 'nombre' => 'Nombre', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'user_apll', 'nombre' => 'Apellido', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'user_ndni', 'nombre' => 'C&eacute;dula', 'tipo_objeto' => 'input_text', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'user_sexo', 'nombre' => 'Sexo', 'tipo_objeto' => 'input_radio', 'tipo_dato' => 'cleartext', 'input_radio_bool' => FALSE, 'opcion0' => 'Femenino', 'value0' => 'F', 'opcion1' => 'Masculino', 'value1' => 'M'), 
            array ('campo' => 'user_dirc', 'nombre' => 'Direcci&oacute;n', 'tipo_objeto' => 'textarea', 'tipo_dato' => 'cleartext'),  
            array ('campo' => 'user_fnac', 'nombre' => 'Fecha de Nacimiento', 'tipo_objeto' => 'input_date_picker', 'tipo_dato' => 'date'), 
            array ('campo' => 'user_tlef', 'nombre' => 'Tel&eacute;fono', 'tipo_objeto' => 'input_tel', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'user_movl', 'nombre' => 'Tel&eacute;fono celular', 'tipo_objeto' => 'input_tel', 'tipo_dato' => 'cleartext'), 
            array ('campo' => 'user_mail', 'nombre' => 'Email', 'tipo_objeto' => 'input_email', 'tipo_dato' => 'cleartext'),
            array ('campo' => 'user_pass', 'nombre' => 'Contrase&ntilde;a', 'tipo_objeto' => 'input_password', 'tipo_dato' => 'php-password'), 
            array ('campo' => 'user_scdg', 'tipo_objeto' => 'input_hidden', 'tipo_dato' => 'normal', 'value' => sha1(uniqid())),
            array ('campo' => 'user_estd', 'nombre' => 'Estado', 'tipo_objeto' => 'input_radio', 'tipo_dato' => 'bool', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
        );
        // Switch para las opciones e lista, nuevo registro, eliminar, modificar, ver detalles
        switch ($op) {
//========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================// 
            // Opcion de lista
            case "listar":
                if ($permisos['cons'] == TRUE){
                    $id_tabla = FALSE;
                    $sql = "SELECT * FROM tbla_user ORDER BY id DESC";
                    $dt_acciones = array('editar' => '', 'eliminar' => '', 'auditoria' => '');
                    $datatable = array(
                        array('nombre' => 'Nombre', 'width' => '', 'campo' => 'user_nomb', 'formato' => 'normal'), 
                        array('nombre' => 'Apellido', 'width' => '', 'campo' => 'user_apll', 'formato' => 'normal'), 
                        array('nombre' => 'Sexo', 'width' => '', 'campo' => 'user_sexo', 'formato' => 'sexo'), 
                        array('nombre' => 'QR Code', 'width' => '', 'campo' => 'user_ndni', 'formato' => 'qrcode'), 
                        array('nombre' => 'Email', 'width' => '', 'campo' => 'user_mail', 'formato' => 'normal'), 
                        array('nombre' => 'Estado', 'width' => '', 'campo' => 'user_estd', 'formato' => 'radio', 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'), 
                        array('nombre' => 'Fecha de ingreso', 'width' => '', 'campo' => 'user_freg', 'formato' => 'datetime'), 
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
                        $insertar = FormProcess($path, $op, $table, $criterio, $form, $captcha, $config);
                        
                        if ($insertar == "success"){
                            
                            $sql_ultimo_id = "SELECT MAX(id) FROM tbla_user";
                            $query_id = $conec->dbQuery($sql_ultimo_id, $debug);
                            $ultimo_id = $conec->dbFetchArray($query_id);
                            $user_id = $ultimo_id[0];
                            
                            $sql_url = "SELECT pref_durl FROM tbla_pref WHERE id = 1";
                            $query_url = $conec->dbQuery($sql_url, $debug);
                            $datos_pref = $conec->dbFetchObjet($query_url);
                            
                            $contenido = $datos_pref->pref_durl."/app/index.php?user=".$user_id."&scdg=".$_POST["user_scdg"];
                            $directorio = $path."qrcode";
                            $nombre = $_POST["user_ndni"];
                            // Generacion del codigo qr
                            PHPCodigoQR($path, $contenido, $directorio, $nombre);
                        }
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