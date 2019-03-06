<?php

    /********************************************************/
    /* Administrador Web SmartNova                            */
    /* Formularios                                          */
    /* Junio de 2016                                        */
    /********************************************************/

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
    
    function FormProcess($path, $opcion, $tabla, $criterio, $formulario, $captcha, $config){
        
        // Inclusion de archivos necesarios
        require_once $path.'core/db.class.core.php';
        require_once $path.'includes/config.inc.php';
        
        $debug = DEBUG;
        
        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion(); 
        
        // Determinar el serial de la tabla
        $sql_serial = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$tabla."' AND EXTRA like '%auto_increment%'";
        $query_serial = $conec->dbQuery($sql_serial, $debug);
        $datos_serial = $conec->dbFetchObjet($query_serial);

        $tbla_id = $datos_serial->COLUMN_NAME;
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
        
        // Mensajes opcionales 
        if (isset($config['mensaje_adicional_insertar'])){
            $mensaje_adicional_insertar = $config['mensaje_adicional_insertar'];
        }
        else {
            $mensaje_adicional_insertar = "";
        }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
        
        // Titulo del modal de los mensajes
        $modal_title = "Mensaje del Sistema";
        
        // Si esta activado el captcha
        if ($captcha == "on"){
            
            // Libreria recaptcha
            require_once $path."components/recaptcha-master/php/recaptchalib.php";
            
            //Llaves de la captcha
            $captcha_publickey = CAPTCHA_PUBLICKEY;
            $captcha_privatekey = CAPTCHA_PRIVATEKEY;

            // Respuesta vacia
            $response = null;

            // Comprueba la llave secreta
            $reCaptcha = new ReCaptcha($captcha_privatekey);
            
            // Si se detecta la respuesta como enviada
            if ($_POST["g-recaptcha-response"]) {
                $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
            
                if ($response != null && $response->success) {
                    $captcha_estado = TRUE;
                }
                else{
                    $captcha_estado = FALSE;
                    //echo  $error_captcha = $captcha_respuesta->error;
                    $modal_alert_type = "error";
                    $modal_message = "El CAPTCHA no fue seleccionado";
                    $modal_config = "";
                    ModalMessage($modal_title, $modal_alert_type, $modal_message, $modal_config);
                    return  $response->error;
                }
            }
        }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
        
        if (($captcha == "on" && $captcha_estado = TRUE) || ($captcha == "off")){
            // Inicializamos el array de los valores
            $valores = array();

            // Acumulador para el si existe del where del insertar 
            $acumulador = 0;
            $numero_campos = 0;
            $flag = FALSE;
            // array que me determina los campos con sus valores
            $campo_valor = array();
            
            // array para los campos unicos
            $campo_unico = array();

            // Ciclo para recorrer el array del post
            foreach ($_POST as $key => $valor) {
                //print_r($_POST);
                // Ciclo para comparar el tipo de dato del campo
                foreach ($formulario as $campos){

                    //print_r($campos);

                    // Default del tipo de elemento
                    if (!isset($campos['elemento'])){
                        $campos['elemento'] = "campo";
                    }

                    // Desicion que permite descartar los elementos que no son campos
                    if ($campos['elemento'] == 'campo'){ 

                        // Descarte de campos simulados en el formulario
                        if (!isset($campos['adicional']) || ($campos['adicional'] != TRUE) ){

                            // Acumulador para el si existe del where del insertar    
                            $acumulador++;

                            // En caso de que el valor actual del array del post sea igual al campo del array del formulario
                            if ($key == $campos['campo']){

                                $numero_campos++;

                                // Validacion de los distintos tipos de datos
                                switch ($campos['tipo_dato']) {
                                    case "bool":
                                        $valores[$campos['campo']] = ((bool)$valor);
                                    break;

                                    case "date":
                                        $valores[$campos['campo']] = (date("Y\-m\-d", strtotime($valor)));
                                    break;

                                    case "time":
                                        $valores[$campos['campo']] = (ReemSpecialChars($valor));
                                    break;
                                
                                    case "datetime":
                                        $valores[$campos['campo']] = (date("Y\-m\-d G:i:s", strtotime($valor)));
                                    break;

                                    case "html":
                                        $valores[$campos['campo']] = (strip_tags($valor, "<p><ul><ol><li><dl><dt><dd><figure><figcaption><img><a><em><strong><small><s><cite><q><dfn><abbr><time><code><var><samp><kbd><sup><sub><i><b><mark><blockquote><h1><h2><h3><h4><h5><h6><hr><pre><blockquote><span><iframe><embed><video><audio><source><canvas><map><area><br><wbr>"));
                                    break;    

                                    case "cleartext":
                                        $valores[$campos['campo']] = (ReemSpecialChars($valor));
                                    break;

                                    case "file":
                                        $valores[$campos['campo']] = (basename($valor));
                                    break;

                                    case "normal":
                                        $valores[$campos['campo']] = ($valor);
                                    break;

                                    case "password":
                                        $valores[$campos['campo']] = (MD5($valor));
                                    break;
                                
                                    case "php-password":
                                        $valores[$campos['campo']] = password_hash($valor, PASSWORD_BCRYPT);
                                    break;

                                    case "integer":
                                        $valores[$campos['campo']] = ((int)$valor);
                                    break;

                                    case "decimal":
                                        $decimal = str_replace(',' , '.' , $valor);
                                        $valores[$campos['campo']] = ((float)$decimal);
                                    break;

                                    case "float":
                                        $valores[$campos['campo']] = ((float)$valor);
                                    break;

                                    case "youtube":
                                        $valores[$campos['campo']] = str_replace("watch?v=" , "embed/" , $valor);
                                    break;

                                    case "soundcloud":
                                        $url = str_replace('height="450"' , 'height="410"' , $valor);
                                        $urls = str_replace('hide_related=false' , 'hide_related=true&show_comments=false' , $url); 
                                        $valores[$campos['campo']] = $urls;
                                    break;

                                    case "array":                           
                                        //deleteFromArray($_POST[$campos['campo']], "0", false);
                                        $lista_array = implode(',', $_POST[$campos['campo']]);
                                        //echo $lista_array;
                                        $valores[$campos['campo']] = $lista_array;
                                    break;
                                
                                    case "url":
                                        $valores[$campos['campo']] = filter_var($valor, FILTER_SANITIZE_URL);
                                    break;
                                }
                                $search = "{".$campos['campo']."}";
                                $replace = $valores[$campos['campo']];
                                //echo $valores[$campos['campo']]."<br>";
                                //echo "{".$campos['campo']."}"."<br>";
                                //echo $criterio;
                                // Armado del sql de "si existe" para el WHERE   
                                if ($flag == FALSE){                           
                                    $criterio_existe = str_replace($search, $replace, $criterio);
                                    $flag = TRUE;
                                    //echo $criterio_existe."<br><br>";
                                }
                                else{
                                    
                                    $criterio_existe = str_replace("{".$campos['campo']."}", "'".$valores[$campos['campo']]."'", "$criterio_existe");
                                    //echo $criterio_existe."<br><br>";
                                }                               

                                // Consulta si un campo es unico
                                $sql_unico = "SHOW FULL COLUMNS FROM ".$tabla." WHERE FIELD = '".$campos['campo']."'";
                                $query_unico = $conec->dbQuery($sql_unico, $debug);
                                $registro_unico = $conec->dbFetchArray($query_unico);
                                
                                if ($registro_unico['Key'] == 'UNI'){
                                    $campo_unico[$campos['campo']] = $valores[$campos['campo']];
                                }
                                
                                // array que me determina los campos con sus valores
                                $campo_valor[$campos['campo']] = $valores[$campos['campo']]; 
                            }
                        }
                    }
                }
            }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

            // ver el array de campos y valores 
            //print_r($campo_valor);
            //print_r($campo_unico);

            // Cantidad de campos afectados
            $cantidad_campos = count($campo_valor);
    
            //echo "**".$siexiste."**";
 
            // Criterio unico
            $cantidad_unico = count($campo_unico);
            
            if ($cantidad_unico > 0){
                $ccu = 0;
                $criterio_unico = "";
                foreach ($campo_unico as $criterio_unico_campo => $criterio_unico_valor){
                    $ccu++;
                    if ($ccu <= ($cantidad_unico -1)){
                        $criterio_unico .= $criterio_unico_campo." = '".$criterio_unico_valor."' AND ";
                    }
                    else {
                        $criterio_unico .= $criterio_unico_campo." = '".$criterio_unico_valor."'";
                    }                   
                }
            }
            else {
                $criterio_unico = "";
            }

            // Opcion Insertar
            if ($opcion == "insertar"){
                if ($criterio_unico != ""){
                    $sql_criterio = "SELECT * FROM ".$tabla." WHERE (".$criterio_unico.")";
                }
                else {
                    $sql_criterio = "SELECT * FROM ".$tabla." WHERE (".$criterio_existe.")";
                }
                $query_criterio = $conec->dbQuery($sql_criterio, $debug);        
                $existe_criterio = $conec->dbNumRows($query_criterio);
                if ($existe_criterio == 0){
                    // INTO de la consulta SQL           
                    $into = "";
                    $values = "";
                    $cin = 0;
                    foreach ($campo_valor as $campo_insert => $valor_insert){
                        $cin++;
                        if ($cin <= ($cantidad_campos -1)){
                            $into.= $campo_insert.", ";
                            $values.= "'".$valor_insert."', ";
                        }
                        else {
                            $into .= $campo_insert;
                            $values .= "'".$valor_insert."'";
                        }                   
                    }
                    $sql_insert = "INSERT INTO $tabla (".$into.") VALUES (".$values.")";
                    $query_insert = $conec->dbQuery($sql_insert, $debug);
                    $resultado =  $query_insert;
                    $op = "I";
                    if ($resultado == 1) {
                        $modal_alert_type = "success";
                        $modal_message = "El registro se ha podido ".$opcion." satisfactoriamente en la base de datos.".$mensaje_adicional_insertar;
                        $rs = 1;
                    }
                    else {
                        $modal_alert_type = "error"; 
                        $modal_message = "El registro no se ha podido ".$opcion." en la base de datos. Ha ocurrido un error al realizar la operaci&oacute;n";
                        $rs = 0;   
                    }                   
                }
                else {
                    $modal_alert_type= "warning";
                    $modal_message = "El registro no se ha podido ".$opcion." en la base de datos. El registro ya existe";
                    $rs = 2;
                }
                
            }
            
            if ($opcion == "editar"){
                // Recuperamos el id del registro
                $id = $_POST['id'];

                // Consulta SQL           
                $criterio_update = "";
                $cex = 0;
                foreach ($campo_valor as $campo_criterio => $valor_criterio){
                    $cex++;
                    if ($cex <= ($cantidad_campos -1)){
                        $criterio_update .= $campo_criterio." = '".$valor_criterio."' AND ";
                    }
                    else {
                        $criterio_update .= $campo_criterio." = '".$valor_criterio."'";
                    }                   
                }
                // Verificacion si el registro se puede editar
                $sql_criterio_update = "SELECT * FROM ".$tabla." WHERE (".$criterio_update.")";
                $query_criterio_update = $conec->dbQuery($sql_criterio_update, $debug);        
                $existe_criterio_update  = $conec->dbNumRows($query_criterio_update);

                // Si el registro no existe
                if ($existe_criterio_update == 0){
                    
//                    if ($criterio_unico != ""){
//                        $sql_criterio = "SELECT * FROM ".$tabla." WHERE (".$criterio_unico.")";
//                    }
//                    else {
//                        $sql_criterio = "SELECT * FROM ".$tabla." WHERE (".$criterio_existe.")";
//                    }
//                    $query_criterio = $conec->dbQuery($sql_criterio, $debug);        
//                    $existe_criterio = $conec->dbNumRows($query_criterio);
//                    
//                    if ($existe_criterio == 0){

                        // Consulta SQL           
                        $set = "";
                        $cup = 0;
                        foreach ($campo_valor as $campo_update => $valor_update){
                            $cup++;
                            if ($cup <= ($cantidad_campos -1)){
                                $set .= $campo_update." = '".$valor_update."', ";
                            }
                            else {
                                $set .= $campo_update." = '".$valor_update."'";
                            }                   
                        }
                        
                        //Consulta para editar el registro 
                        $sql_update = "UPDATE $tabla SET ".$set." WHERE (id = ".$id.")";
                        $query_update = $conec->dbQuery($sql_update, $debug);
                        $resultado =  $query_update;
                        $op = "E";

                        if ($resultado == 1) {
                            $modal_alert_type = "success";
                            $modal_message = "El registro se ha podido ".$opcion." satisfactoriamente en la base de datos.";
                            $rs = 3;
                        }
                        else {
                            $modal_alert_type = "error"; 
                            $modal_message = "El registro no se ha podido ".$opcion." en la base de datos. Ha ocurrido un error al realizar la operaci&oacute;n";
                            $rs = 4;
                        }
//                    }
//                    elseif(($existe_criterio > 0) && ($criterio_unico != "")){
//                        $tipo = "warning"; 
//                    $mensaje = "El registro no se ha podido ".$opcion." en la base de datos. El registro ya existe";
//                    }
//                    else{
//                        $tipo = "warning"; 
//                        $mensaje = "El registro no se ha podido ".$opcion." en la base de datos. Los datos introducidos no cumplen con los requisitos";
//                    }
                }
                else {
                    $modal_alert_type = "warning"; 
                    $modal_message = "El registro no se ha podido ".$opcion." en la base de datos. El registro ya existe";
                    $rs = 5;
                }
            }


//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

            // Insertamos registro en la tabla de auditoria
            if ((isset($resultado) && $resultado == 1) && ($tabla != "tbla_sson") && (isset($_SESSION['sson_tipo'])) && ($_SESSION['sson_tipo'] == "adms")){

                // Usuario de sesion
                if (isset($_SESSION)){
                    $sson_user = $_SESSION['sson_idpr'];
                }
                else{
                    $sson_user = 0;
                }

                // recuperacion del ultimo
                $query_ultimo_id = "SELECT MAX(".$tbla_id.") FROM ".$tabla;
                $ultimo_id_rc = $conec->dbQuery($query_ultimo_id, $debug);
                $ultimo_id = $conec->dbFetchArray($ultimo_id_rc);

                $into_audt = "audt_tabl, audt_idrg, audt_adms, audt_oprc";

                $values_audt = "'".$tabla."', '".$ultimo_id[0]."', '".$sson_user."', '".$op."'";

                // query de la insercion
                $qaudi = "INSERT INTO ".$conec->audt." (".$into_audt.") VALUES (".$values_audt.")";
                $conec->dbQuery($qaudi, $debug);
            }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

        }
        else {
            $modal_alert_type = "error";
            $modal_message = "El CAPTCHA no fue seleccionado";           
        }
        // Generacion del mensaje de error
        $modal_config = "";
        ModalMessage($modal_title, $modal_alert_type, $modal_message, $modal_config); 
        
        // retornamos el resultado
        return $modal_alert_type;
    }
                
//==========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================//

    // MOSTRAR FORMULARIO
    // $path - Referencia a la raiz del sitio
    // $op - Opciones de editar o insertar registros
    // $action - Objetivo del action del formulario
    // $table - tabla de la base de datos
    // $captcha - resolver google captcha para enviar formulario - valores "TRUE", "FALSE"
    // $config - array auxiliar con parametros extras de configuracion del formulario

    function FormShow($path, $op, $title, $objetivo, $form, $table, $captcha, $config){
        
        // Inclusion de librerias       
        require_once $path.'core/db.class.core.php';
        
        // Google Captcha
        if ($captcha == TRUE){

            //Llaves de la captcha
            $captcha_publickey = CAPTCHA_PUBLICKEY;
            $captcha_privatekey = CAPTCHA_PRIVATEKEY;
            //por ahora ponemos a null el error de la captcha
            $error_captcha=null;
        }
        
        // Control de errores
        $debug = DEBUG;
        

        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion();
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
        
        // Opcion Editar
        if ($op == "editar"){
                    
            // Captura del id por GET y POST
            if (isset($_GET['id'])){
                $id = $_GET['id'];
            }

            if (isset($_POST['id'])){
                $id = $_POST['id'];
            }
            
            if (!isset($_GET['id']) && (!isset($_POST['id']))){
                $id = 1;
            }
             
            // Consulta para mostrar los datos del registro en el formulario
            $sche = "";
            $campos = "*";
            $criterio = "id = '".$id."'";
            $orden = "";
            $clausula = "";
            $edit_registro = $conec->dbConsulta($sche, $table, $campos, $criterio, $orden, $clausula, $debug);
            $rs_datos = $conec->dbFetchArray($edit_registro);
        }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
        
        // PARAMETROS GENERALES
        
        // Ayuda  
        $help_show = (isset($config['help_show']) && ($config['help_show'] == FALSE)) ? FALSE : TRUE;
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
               
        // PARAMETROS DEL MARCO DEL FORMULARIO
    
        if (isset($config['bootstrap_only']) && $config['bootstrap_only'] == TRUE){
            
        }
        else {
            // Tipo de Portlet - valores: 'box_color', 'light', 'light_inverse'
            $portlet_type = (!isset($config['portlet_type'])) ? "box_color" : $config['portlet_type'];

            // Color de Portlet (Solo para portlet_type:box_color) - Colores: libreria de colores - Default: blue 
            $portlet_color = (!isset($config['portlet_color'])) ? "blue" : $config['portlet_color'];

            // Icono del formulario
            $portlet_icon = (!isset($config['portlet_icon'])) ? "fa fa-th-list" : $config['portlet_icon'];

            // Sutitulo del formulario
            $portlet_subtitle = (!isset($config['portlet_subtitle'])) ? "" : $config['portlet_subtitle'];

            // Habilitar remover el formulario (Solo para portlet color);
            $portlet_remove = (isset($config['portlet_remove']) && ($config['portlet_remove'] == TRUE)) ? "<a href=\"javascript:;\" class=\"remove\"> </a>" : "";
        }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
        
        // PARAMETROS DE LA ETIQUETA HTML DEL FORMULARIO
        
        // id del formulario
        $form_id = (!isset($config['form_id'])) ? "form" : $config['form_id'];
        
        // Nombre del formulario
        $form_name = (!isset($config['form_name'])) ? "form" : $config['form_name'];
        
        // Metodo de envio de variables - valores: 'post', 'get'
        $form_method = (!isset($config['form_method'])) ? "post" : $config['form_method'];
        
        // Codificacion de la data enviada - valores: 'application/x-www-form-urlencoded', 'multipart/form-data', 'text/plain'
        $form_enctype = (!isset($config['form_enctype'])) ? "application/x-www-form-urlencoded" : $config['form_enctype'];
        
        // Autocompletar - valores: 'on', 'off'
        $form_autocomplete = (isset($config['form_autocomplete']) && ($config['form_autocomplete'] == 'off')) ? 'off' : 'on';
        
        // Validacion HTML5 del formulario - valor: TRUE, FALSE
        $form_novalidate = (isset($config['form_novalidate']) && ($config['form_novalidate'] == TRUE)) ? "novalidate" : '';
        
        // Objetivo para mostrar resultados - valores: '_blank', '_self', '_parent', '_top, 'framename'
        $form_target = (!isset($config['form_target'])) ? "_self" : $config['form_target'];
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
        
        if (isset($config['bootstrap_only']) && $config['bootstrap_only'] == TRUE){ 
            $form_class = $config['form_class'];
        }
        else {
            // Tipo de formulario (color - light - light inverse)
            switch ($portlet_type ){

                case "box_color":
                    echo "<div class=\"portlet box ".$portlet_color."\"> \n"

                        ."<div class=\"portlet-title\"> \n"
                        ."<div class=\"caption\"> \n"
                        ."<i class=\"".$portlet_icon."\"></i>".$title." \n"
                        ."</div> \n"
                        ."<div class=\"tools\"> \n"
                        ."<a href=\"javascript:;\" class=\"collapse\"> </a> \n"
                        ."<a href=\"#portlet-config\" data-toggle=\"modal\" class=\"config\"> </a> \n"
                        ."<a href=\"javascript:;\" class=\"reload\"> </a> \n"
                        .$portlet_remove." \n"
                        ."</div> \n"
                        ."</div> \n";
                break;   

                case "light":
                    echo "<div class=\"portlet light bordered form-fit\"> \n"

                        ."<div class=\"portlet-title\"> \n"
                        ."<div class=\"caption\"> \n"
                        ."<i class=\"".$portlet_icon." font-green-haze\"></i> \n"
                        ."<span class=\"caption-subject font-green-haze bold uppercase\">".$title."</span> \n"
                        ."<span class=\"caption-helper\">".$portlet_subtitle."</span> \n"
                        ."</div> \n"
                        //."<div class=\"actions\"> \n"
                        //."<a href=\"javascript:;\" class=\"btn btn-circle btn-default btn-sm\"> \n"
                        //."<i class=\"fa fa-pencil\"></i> Edit </a> \n"
                        //."<a href=\"javascript:;\" class=\"btn btn-circle btn-default btn-sm\"> \n"
                        //."<i class=\"fa fa-plus\"></i> Add </a> \n"
                        //."</div> \n"
                        ."</div> \n";
                break;

                case "light_inverse":
                    echo "<div class=\"portlet light bg-inverse form-fit\"> \n"

                        ."<div class=\"portlet-title\"> \n"
                        ."<div class=\"caption\"> \n"
                        ."<i class=\"".$portlet_icon." font-green-haze\"></i> \n"
                        ."<span class=\"caption-subject font-green-haze bold uppercase\">".$title."</span> \n"
                        ."<span class=\"caption-helper\">".$portlet_subtitle."</span> \n"
                        ."</div> \n"
                        //."<div class=\"actions\"> \n"
                        //."<div class=\"portlet-input input-inline input-small\"> \n"
                        //."<div class=\"input-icon right\"> \n"
                        //."<i class=\"icon-magnifier\"></i> \n"
                        //."<input type=\"text\" class=\"form-control input-circle\" placeholder=\"search...\"> \n"
                        //."</div> \n"
                        //."</div> \n"
                        //."</div> \n"
                        ."</div> \n";
                break;
            }

            // Inicio del cuerpo del formulario
            echo "<div class=\"portlet-body form\"> \n"
                ."<!-- BEGIN FORM--> \n";
        
            // Clase por defecto para los formularios
            $form_class = "form-horizontal form-row-seperated";
        }
        
        // Tipos de formularios Bootstrap Default o Horizontales
        if (isset($config['form_type']) && ($config['form_type'] == "default")){
            $ftlabel = "";
            $ftcampoi = "";
            $ftcampof = "";
        }
        else {
            $ftlabel = "col-md-3";
            $ftcampoi = "<div class=\"col-md-9\"> \n";
            $ftcampof = "</div> \n";
        }
        // Inicio de la etiqueta del formulario
        echo "<form id=\"".$form_id."\" name=\"".$form_name."\" action=\"".$objetivo."\" enctype=\"".$form_enctype."\" method=\"".$form_method."\" autocomplete=\"".$form_autocomplete."\"  target=\"".$form_target."\" class=\"$form_class\" $form_novalidate data-parsley-excluded=\"input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden\" data-parsley-trigger=\"keyup\" data-parsley-validate> \n"           
            ."<div class=\"form-body\"> \n";        
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
        
        // ELEMENTOS DEL FORMULARIO
        
        // Contador para el tabindex
        $tabindex = 0;
        
        foreach ($form as $elemento){
            
            // Default del tipo de elemento  
            $elemento['elemento'] = (!isset($elemento['elemento'])) ? "campo" : $elemento['elemento'];

            // Default de la clase css
            $elemento['class'] = (!isset($elemento['class'])) ? "" : $elemento['class'];
            
            // Default del placeholder
            $elemento['placeholder'] = (!isset($elemento['placeholder'])) ? "" : $elemento['placeholder'];
            
            // Elelemento deshabilitado      
            $disabled = ((isset($elemento['disabled'])) && ($elemento['disabled'] == TRUE)) ? "disabled " : "";
            
            // Elemento de solo lectura
            $readonly = ((isset($elemento['readonly'])) && ($elemento['readonly'] == TRUE)) ? "readonly " : "";
            
            // Dimension de la altura del input - valores 'input-lg', 'input-sm'
            $input_height_size= (!isset($elemento['input_height_size'])) ? "" : $elemento['input_height_size']." ";
            
            // Dimension del ancho del input - valores 'input-xlarge', 'input-large', 'input-medium', 'input-small', 'input-xsmall'
            $input_width_size = (!isset($elemento['input_width_size'])) ? "" : $elemento['input_width_size']." ";
            
            // Consulta para determinar si un campo es obligatorio o no
            if ($elemento['elemento'] == "campo"){
                $sql = "SHOW FULL COLUMNS FROM ".$table." WHERE FIELD = '".$elemento['campo']."'";
                $query = $conec->dbQuery($sql, $debug);
                $elemento_full = $conec->dbFetchArray($query);

                if ($elemento_full['Null'] == "NO"){
                    $requerido = "<span>(*)</span>";
                    $elemento['requerido'] = "required ";
                }
                else{
                    $requerido = "";
                    $elemento['requerido'] = "";
                }
            }
   
            // Contador del salto de tabulador
            $tabindex++;
            
            if ($op == "insertar"){
                $rs_datos = array();
                @$rs_datos[$elemento['campo']] = "";
            }
            
            // Ayuda
            if (($elemento['elemento'] == "campo") && ($elemento['tipo_objeto'] != "input_hidden")){

                // Consulta para mostrar la ayuda a partir de los comentarios en la base de datos
                $sql = "SHOW FULL COLUMNS FROM ".$table." WHERE FIELD = '".$elemento['campo']."'";
                $query = $conec->dbQuery($sql, $debug);
                $ayuda_array = $conec->dbFetchArray($query);
                $ayuda = $ayuda_array['Comment'];
            }
            
            // Si el elemento es adicional en el formulario y no existe en la base de datos
            if (isset($elemento['adicional']) && ($elemento['adicional'] == TRUE )){
                $ayuda = $elemento['ayuda'];
                $rs_datos[$elemento['campo']] = "";
            }
            
            // Si existe un valor predefinido en el value del elemento
            if (isset($elemento['value'])){
                $rs_datos[$elemento['campo']] = $elemento['value'];
            }
            
            // Inicializacion de la variable de control de cierre de los iconos dentro de los input
            $input_icon = FALSE;
            
            // Switch para los tipos de elementos del formulario
            switch ($elemento['elemento']){

                case "campo":
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                    
                    // Tipo de objeto 
                    if (($elemento['tipo_objeto'] == "input_text") || ($elemento['tipo_objeto'] == "input_email") || ($elemento['tipo_objeto'] == "input_number") || ($elemento['tipo_objeto'] == "input_password") || ($elemento['tipo_objeto'] == "input_tel")){
 
                        // Variable para diferenciar el id del input en caso de que sea password
                        $id_dif = "";
                        
                        switch ($elemento['tipo_objeto']){
                            case "input_text":
                                $type = "text";
                            break;
                        
                            case "input_email":
                                $type = "email";
                            break;
                                
                            case "input_number":
                                $type = "number";
                            break;
                        
                            case "input_url":
                                $type = "url";
                            break;
                        
                            case "input_tel":
                                $type = "tel";
                            break;
                        
                            case "input_password":
                                $type = "password";
                                $id_dif = 1;
                            break;
                        }
                        
                        // Atributo step para los imput number
                        if (($elemento['tipo_objeto'] == "input_number") && (isset($elemento['step']))) {
                            $step = "step=\"".$elemento['step']."\"";
                        }
                        else {
                            $step = "";
                        }
                        
                        // Atributo minimo para los imput number
                        if (isset($elemento['min'])) {
                            $min = "min=\"".$elemento['min']." \"";
                        }
                        else {
                            $min = "";
                        }
                        
                        // Atributo maximo para los imput number
                        if (isset($elemento['max'])) {
                            $max = "max=\"".$elemento['max']." \"";
                        }
                        else {
                            $max = "";
                        }
                        
                        $n_inputs = ($elemento['tipo_objeto'] == "input_password") ? 2 : 1;

                        for ($i = 1; $i <= $n_inputs; $i++) {
                            
                            if ($i == 1){
                                $label_input = $elemento['nombre'];
                            }
                            else {
                                $label_input = "Repita su ".$elemento['nombre'];
                            }
                            
                            echo "<div class=\"form-group\"> \n"
                                ."<label for=\"".$elemento['campo']."\" class=\"control-label $ftlabel\">".$label_input.": ".$requerido."</label> \n"
                                .$ftcampoi;


                            // Icon box left
                            if ((isset($elemento['icon_box_left'])) && ($elemento['icon_box_left'] == TRUE)){
                                echo "<div class=\"input-group\"> \n"
                                    ."<span class=\"input-group-addon\"> \n"
                                    ."<i class=\"".$elemento['input_icon']."\"></i> \n"
                                    ."</span> \n";
                                $input_icon = TRUE;
                            }

                            // Text box left
                            if ((isset($elemento['text_box_left'])) && ($elemento['text_box_left'] == TRUE)){
                                echo "<div class=\"input-group\"> \n"
                                    ."<span class=\"input-group-addon\"> \n"
                                    .$elemento['text_box']." \n"
                                    ."</span> \n";
                                $input_icon = TRUE;
                            }

                            // Icon left
                            if ((isset($elemento['icon_left'])) && ($elemento['icon_left'] == TRUE)){
                                echo "<div class=\"input-icon\"> \n"
                                    ."<i class=\"".$elemento['input_icon']."\"></i> \n";
                                $input_icon = TRUE;
                            } 

                            // Icon right
                            if ((isset($elemento['icon_right'])) && ($elemento['icon_right'] == TRUE)){
                                echo "<div class=\"input-icon right\"> \n"
                                    ."<i class=\"".$elemento['input_icon']."\"></i> \n";
                                $input_icon = TRUE;
                            }

                            // Icon box right
                            if ((isset($elemento['icon_box_right'])) && ($elemento['icon_box_right'] == TRUE)){
                                 echo "<div class=\"input-group $input_width_size\"> \n";                                
                                 $input_icon = TRUE;
                            }

                            // Text box right
                            if ((isset($elemento['text_box_right'])) && ($elemento['text_box_right'] == TRUE)){
                                 echo "<div class=\"input-group $input_width_size\"> \n";                                
                                 $input_icon = TRUE;
                            }

                            // Etiqueta del input
                            echo "<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"".$type."\" class=\"form-control ".$input_height_size.$input_width_size.$elemento['class']."\" placeholder=\"".$elemento['placeholder']."\" value=\"".$rs_datos[$elemento['campo']]."\" tabindex=\"".$tabindex."\" ".$readonly.$disabled.$elemento['requerido'].$step.$min.$max."/> \n";

                            // Icon box right
                            if ((isset($elemento['icon_box_right'])) && ($elemento['icon_box_right'] == TRUE)){
                                echo "<span class=\"input-group-addon\"> \n"
                                    ."<i class=\"".$elemento['input_icon']."\"></i> \n"
                                    ."</span> \n";
                                $input_icon = TRUE;
                            }

                            // Caja de texto
                            if ((isset($elemento['text_box_right'])) && ($elemento['text_box_right'] == TRUE)){
                                echo "<span class=\"input-group-addon\"> \n"
                                    .$elemento['text_box']." \n"
                                    ."</span> \n";
                                $input_icon = TRUE;
                            }

                            // Cierre de los input icons
                            if ($input_icon == TRUE){
                                echo "</div> \n";
                            }

                            if ($help_show == TRUE){
                                echo "<span class=\"help-block\">".$ayuda."</span> \n";
                            }

                            echo  $ftcampof
                                ."</div> \n";
                            
                            if (($i == 1) && ($type = "password")){
                                $tabindex++;
                            }
                        
                        // Cierre del for    
                        }
                    }
                    elseif(($elemento['tipo_objeto'] == "nacionalidad") || ($elemento['tipo_objeto'] == "cedula")){
                        
                    }
                    elseif($elemento['tipo_objeto'] == "input_hidden"){
                        
                    }
                    else {
                        echo "<div class=\"form-group\"> \n"
                            ."<label for=\"".$elemento['campo']."\" class=\"control-label $ftlabel\">".$elemento['nombre'].": ".$requerido."</label> \n"
                            .$ftcampoi;
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                    
                    // Textarea
                    if ($elemento['tipo_objeto'] == "textarea"){
                        
                        // Default del las filas
                        $textarea_rows = (!isset($elemento['textarea_rows'])) ? "4" : $elemento['textarea_rows'];
                        
                        echo "<textarea id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" class=\" form-control ".$elemento['class']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" rows=\"".$textarea_rows."\">".$rs_datos[$elemento['campo']]."</textarea> \n";         
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                    
                    // CKEditor
                    if ($elemento['tipo_objeto'] == "ckeditor"){
                        
                        echo "<textarea id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" class=\"ckeditor form-control ".$elemento['class']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" rows=\"6\">".$rs_datos[$elemento['campo']]."</textarea> \n";          
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

                    // Input Date Picker
                    if ($elemento['tipo_objeto'] == "input_date_picker"){
                                               
                        // Default del date picker - valores 'default', 'disable_past_dates', 'input-medium', 'input-small', 'input-xsmall'
                        $date_picker_type = (!isset($elemento['date_picker_type'])) ? "default" : $elemento['date_picker_type'];
                        
                        // Value segun la opcion
                        if ($op == "editar"){
                            $value = date("d\-m\-Y", strtotime($rs_datos[$elemento['campo']]));
                        }
                        if ($op == "insertar"){
                            $value = "";
                        }

                        switch ($date_picker_type){
                                                       
                            case 'default':
                                echo "<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" class=\"form-control form-control-inline input-medium date-picker ".$elemento['class']."\" size=\"16\" type=\"text\" value=\"".$value."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\"/> \n";
                            break;
                            
                            case "disable_past_dates":
                                echo "<div class=\"input-group input-medium date date-picker\" data-date-format=\"dd-mm-yyyy\" data-date-start-date=\"+0d\"> \n"
                                    ."<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" class=\"form-control ".$elemento['class']."\" value=\"".$value."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" readonly /> \n"
                                    ."<span class=\"input-group-btn\"> \n"
                                    ."<button class=\"btn default\" type=\"button\"> \n"
                                    ."<i class=\"fa fa-calendar\"></i> \n"
                                    ."</button> \n"
                                    ."</span> \n"
                                    ."</div> \n";         
                            break;
                        
                            case "months_only":
                                echo "<div class=\"input-group input-medium date date-picker\"  data-date-format=\"mm/yyyy\" data-date-viewmode=\"years\" data-date-minviewmode=\"months\"> \n"
                                    ."<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" class=\"form-control ".$elemento['class']."\" value=\"".$value."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" readonly /> \n"
                                    ."<span class=\"input-group-btn\"> \n"
                                    ."<button class=\"btn default\" type=\"button\"> \n"
                                    ."<i class=\"fa fa-calendar\"></i> \n"
                                    ."</button> \n"
                                    ."</span> \n"
                                    ."</div> \n";
                            break;
                        } 
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
       
                    // Input Date Time Picker
                    if ($elemento['tipo_objeto'] == "input_datetime_picker"){
                                               
                        // Default del date picker - valores 'default', 'advance', 'meridian_format'
                        $datetime_picker_type = (!isset($elemento['datetime_picker_type'])) ? "default" : $elemento['datetime_picker_type'];
                        
                        // Value segun la opcion
                        if ($op == "editar"){
                            $value = date("d\-m\-Y G:i:s", strtotime($rs_datos[$elemento['campo']]));
                        }
                        if ($op == "insertar"){
                            $value = "";
                        }

                        switch ($datetime_picker_type){
                                                       
                            case 'default':
                                echo "<div class=\"input-group date form_datetime\"> \n"
                                    ."<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" class=\"form-control ".$elemento['class']."\" value=\"".$value."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" readonly /> \n"
                                    ."<span class=\"input-group-btn\"> \n"
                                    ."<button class=\"btn default date-set\" type=\"button\"> \n"
                                    ."<i class=\"fa fa-calendar\"></i> \n"
                                    ."</button> \n"
                                    ."</span> \n"
                                    ."</div> \n";                               
                            break;
                            
                            case "advance":
                                echo "<div class=\"input-group date form_datetime\" data-date=\"2012-12-21T15:25:00Z\"> \n"
                                    ."<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" size=\"16\" class=\"form-control ".$elemento['class']."\" value=\"".$value."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" readonly /> \n"
                                    ."<span class=\"input-group-btn\"> \n"
                                    ."<button class=\"btn default date-reset\" type=\"button\"> \n"
                                    ."<i class=\"fa fa-times\"></i> \n"
                                    ."</button> \n"
                                    ."<button class=\"btn default date-set\" type=\"button\"> \n"
                                    ."<i class=\"fa fa-calendar\"></i> \n"
                                    ."</button> \n"
                                    ."</span> \n"
                                    ."</div> \n";
                            break;
                        
                            case "meridian_format":
                                echo "<div class=\"input-group date form_meridian_datetime\" data-date=\"2012-12-21T15:25:00Z\"> \n"
                                    ."<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" size=\"16\" class=\"form-control ".$elemento['class']."\" value=\"".$value."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" readonly /> \n"
                                    ."<span class=\"input-group-btn\"> \n"
                                    ."<button class=\"btn default date-reset\" type=\"button\"> \n"
                                    ."<i class=\"fa fa-times\"></i> \n"
                                    ."</button> \n"
                                    ."<button class=\"btn default date-set\" type=\"button\"> \n"
                                    ."<i class=\"fa fa-calendar\"></i> \n"
                                    ."</button> \n"
                                    ."</span> \n"
                                    ."</div> \n";
                            break;                       
                        } 
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
       
                    // Input Time Picker
                    if ($elemento['tipo_objeto'] == "input_time_picker"){
                                               
                        // Default del time picker - valores 'default', 'without_seconds', '24hr_timepicker'
                        $time_picker_type = (!isset($elemento['time_picker_type'])) ? "default" : $elemento['time_picker_type'];
                        
                        // Value segun la opcion
                        if ($op == "editar"){
                            $value = date("d\-m\-Y", strtotime($rs_datos[$elemento['campo']]));
                        }
                        if ($op == "insertar"){
                            $value = "";
                        }

                        switch ($time_picker_type){
                                                       
                            case 'default':
                                echo "<div class=\"input-icon\"> \n"
                                    ."<i class=\"fa fa-clock-o\"></i> \n"
                                    ."<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" class=\"form-control timepicker timepicker-default ".$elemento['class']."\" value=\"".$value."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" readonly /> \n"                                   
                                    ."</div> \n";                          
                            break;
                            
                            case "without_seconds":
                                echo "<div class=\"input-group\"> \n"
                                    ."<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" class=\"form-control timepicker timepicker-no-seconds ".$elemento['class']."\" value=\"".$value."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" readonly /> \n"                                                                      
                                    ."<span class=\"input-group-btn\"> \n"
                                    ."<button class=\"btn default\" type=\"button\"> \n"
                                    ."<i class=\"fa fa-clock-o\"></i> \n"
                                    ."</button> \n"
                                    ."</span> \n"
                                    ."</div> \n";
                            break;
                        
                            case "24hrs":
                                echo "<div class=\"input-group\"> \n"
                                    ."<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" class=\"form-control timepicker timepicker-24 ".$elemento['class']."\" value=\"".$value."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" readonly /> \n"                                                                      
                                    ."<span class=\"input-group-btn\"> \n"
                                    ."<button class=\"btn default\" type=\"button\"> \n"
                                    ."<i class=\"fa fa-clock-o\"></i> \n"
                                    ."</button> \n"
                                    ."</span> \n"
                                    ."</div> \n";
                            break;                       
                        } 
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

                    // Input Date Range
                    if ($elemento['tipo_objeto'] == "input_date_range"){
                    
                        echo "<div class=\"input-group input-large date-picker input-daterange\" data-date-format=\"dd/mm/yyyy\"> \n"
                            ."<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" class=\"form-control ".$elemento['class']."\" value=\"".$value."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n"                  
                            ."<span class=\"input-group-addon\"> hasta </span> \n"
                            ."<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" class=\"form-control ".$elemento['class']."\" value=\"".$value."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n" 
                            ."</div> \n";
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

                    // Input Color Picker
                    if ($elemento['tipo_objeto'] == "input_color_picker"){
                        
                        // Default del color_picker - valores 'hue', 'saturation', 'brightness', 'wheel'
                        $color_picker_type = (!isset($elemento['color_picker_type'])) ? "hue" : $elemento['color_picker_type'];
                        
                        echo "<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" class=\"form-control demo ".$elemento['class']."\" data-control=\"".$color_picker_type ."\" value=\"".$rs_datos[$elemento['campo']]."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" data-position=\"bottom right\" /> \n";
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                    
                    // Color Picker RGBA
                    if ($elemento['tipo_objeto'] == "color_picker_rgba"){
                    
                        echo "<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" class=\"colorpicker-rgba form-control ".$elemento['class']."\" value=\"".$rs_datos[$elemento['campo']]."\" data-color-format=\"rgba\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n";                            
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                   
                    // Select
                    if ($elemento['tipo_objeto'] == "select"){
                        
                        // Default del tipo de select - valores 'default', 'search', 'brightness', 'wheel'
                        $select_type = (!isset($elemento['select_type'])) ? "default" : $elemento['select_type'];

                        // Default del ancho del select
                        $select_width = (!isset($elemento['select_width'])) ? "data-width=\"100%\" " : "data-width=\"".$elemento['select_width']."\" ";

                        $criterio = (isset($elemento['criterio'])) ? $elemento['criterio'] : "";

                        $option = "";
                        //$s = "SELECT * FROM $sche.$tabla";
                        $s = "SELECT * FROM ".$elemento['tabla'];
                        $s .= (!empty($criterio) ? " WHERE $criterio" : "");
                        $s .= (!empty($elemento['orden']) ? " ORDER BY ".$elemento['orden'] : "");
                        //echo $s;
                        $rs = $conec->dbQuery($s, $debug);
                        $nrows = $conec->dbNumRows($rs);
                        $vals = explode(',',$elemento['descripcion']);
                        if ($nrows > 0){
                            while ($row = $conec->dbFetchArray($rs)){
                                $option .= "<option value=\"".trim($row[$elemento['valor']])."\"".(trim($row[$elemento['valor']]) == $rs_datos[$elemento['campo']] ? " SELECTED":"").">";
                                foreach ($vals as $des_row){
                                    $option .= $row[$des_row]." ";
                                    }
                                $option .= "</option>\n";
                            }
                        }
                        else {
                            $option .= "<option value=''>No hay registros</option>";
                        }
                        
                        switch ($select_type){
                            
                            case "default":
 
                                echo "<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" ".$select_width." class=\"bs-select form-control ".$elemento['class']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n"
                                    ."<option value=\"\">--- Seleccione ---</option> \n";
                                echo $option;                             

                                echo "</select> \n";
                            break;
                        
                            case "search":
                                echo "<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" ".$select_width." class=\"bs-select form-control\" data-width=\"125px\" data-live-search=\"true\" ".$elemento['class']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n"
                                    ."<option value=\"\">--- Seleccione ---</option> \n";
                                
                                echo $option;

                                echo "</select> \n";
                            break;
                        }               
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                    
                    // Select SQL
                    if ($elemento['tipo_objeto'] == "select_sql"){
                        
                        // Default del tipo de select - valores 'default', 'search', 'brightness', 'wheel'
                        if (isset($elemento['select_type'])){
                            
                            if ($elemento['select_type'] == "search"){
                                $select_type = 'data-live-search=\"true\"';
                            }
                            else {
                                $select_type = "";
                            }
                        }

                        //$criterio = (isset($elemento['criterio'])) ? $elemento['criterio'] : "";
                        //echo $elemento['sql_select'];
                        $query_select = $conec->dbQuery($elemento['sql_select'], $debug);
                        $nrows = $conec->dbNumRows($query_select);

                        echo "<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" class=\"bs-select form-control\" data-width=\"100%\" $select_type ".$elemento['class']." \" ".$elemento['requerido']." tabindex=\"".$tabindex."\" > \n"
                            ."<option value=\"\">--- Seleccione ---</option> \n";

                        if ($nrows > 0){
                            while ($datos_select = $conec->dbFetchArray($query_select)){

                                echo "<option value=\"".$datos_select[$elemento['valor']]."\"";
                                if (($op == "editar") && (@$rs_datos[$elemento['campo']] == $datos_select[$elemento['valor']])){
                                echo "selected";
                                }
                                echo " > \n"
                                    .$datos_select[$elemento['descripcion']]." \n"
                                    ."</option> \n";
                            }
                        }
                        else {
                            echo "<option value=''>No hay registros</option>";
                        }

                        echo "</select> \n";
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

                    // Select Numerico
                    if ($elemento['tipo_objeto'] == "select_numerico"){
                    
                        echo "<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" class=\"input_largo ".$elemento['class']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" ".$elemento['validacion']."> \n"
                            ."<option value=\"\">--- Seleccione ---</option> \n";

                        for ($i = $elemento['inicio']; $i <= $elemento['fin']; $i++) {

                            echo "<option value=\"".$i."\" \n";

                            if (($op == "editar") && (@$rs_datos[$elemento['campo']] == $i)){
                                echo "selected";
                            }

                            echo ">".$i."</option> \n";
                        } 

                        echo "</select> \n";
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                    
                    // markup
                    if ($elemento['tipo_objeto'] == "marckup"){
                        echo "<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" class=\"input_largo ".$elemento['class']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" ".$elemento['validacion']."> \n"
                            ."<option value=\"\">--- Seleccione ---</option> \n";

                        for ($i = 1; $i >= 0; $i-= 0.05) {
                            //echo "***".$rs_datos[$elemento['campo']]."***".$i."***";
                            echo "<option value=\"".$i."\" \n";

                            if ($op == "editar")  { 

                                if (((string)$rs_datos[$elemento['campo']]) == ((string)$i)){
                                        echo "selected";
                                }
                            }

                            echo ">".number_format((float)$i, 2, '.', '')."</option> \n";
                        } 

                        echo "</select> \n";
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                        
                    // Porcentaje
                    if ($elemento['tipo_objeto'] == "porcentaje"){
                        echo "<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" class=\"input_largo ".$elemento['class']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" ".$elemento['validacion']."> \n"
                            ."<option value=\"\">--- Seleccione ---</option> \n";

                        for ($i = $elemento['minimo']; $i <= $elemento['maximo']; $i++){

                            echo "<option value=\"".$i."\" \n";

                            if ($op == "editar")  { 

                                if (((string)$rs_datos[$elemento['campo']]) == ((string)$i)){
                                        echo "selected";
                                }
                            }

                            echo ">".$i." &#37;</option> \n";
                        } 

                        echo "</select> \n";
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
              
                    // Select Folder
                    if ($elemento['tipo_objeto'] == "select_folder"){

                        echo "<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" class=\"bs-select form-control ".$elemento['class']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\"> \n"
                            ."<option value=\"\">--- Seleccione ---</option> \n";
                            
                        $directorio = opendir($path.$elemento['folder']);
                        while ($fila = readdir($directorio)) {
                            if (($fila != ".") && ($fila != "..")){
                                @$filalista .= "$fila ";
                            }
                        }
                        closedir($directorio);
                        $filalista = explode(" ", $filalista);
                        sort($filalista);
                        for ($i=0; $i < sizeof($filalista); $i++) {
                            if(!empty($filalista[$i])) {
                                echo "<option name=\"$filalista[$i]\" value=\"$filalista[$i]\" ";

                                if ($op == "editar"){
                                    if($filalista[$i] == $rs_datos[$elemento['campo']] ) echo "selected";
                                }
                                echo ">$filalista[$i]</option>\n";
                            }
                        }
			echo "</select> \n";
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

                    // Select Group
                    // ej: array ('campo' => 'sucr_dist', 'nombre' => 'Distribuidora', 'tipo_objeto' => 'select_group', 'tipo_dato' => 'integer', 'tabla_group' => 'tbla_pais', 'orden_group' => 'id', 'descripcion_group' => 'pais_nomb', 'tabla' => 'tbla_dist', 'orden' => 'id', 'valor' => 'id', 'descripcion' => 'dist_nomb', 'fk_select' => 'dist_pais', 'pk_group' => 'id' ), 
                    if ($elemento['tipo_objeto'] == "select_group"){
                        
                        // Default del tipo de select - valores 'default', 'search'
                        $select_type = (!isset($elemento['select_type'])) ? "default" : $elemento['select_type'];

                        // Default del ancho del select
                        $select_width = (!isset($elemento['select_width'])) ? "data-width=\"100%\" " : "data-width=\"".$elemento['select_width']."\" ";
                        
                        // Default si es tipo padre
                        $select_padre = ((isset($elemento['select_padre'])) && ($elemento['select_padre'] == TRUE)) ? 'onChange="cargaContenido(this.id)"' : "";
  
                        $criterio = (isset($elemento['criterio'])) ? $elemento['criterio'] : "";
                        $criterio_group = (isset($elemento['criterio_group'])) ? $elemento['criterio_grup'] : "";
                        
                        if (($op == "editar") && (isset($elemento['select_padre'])) && ($elemento['select_padre'] == "TRUE")){
                            $rs_datos[$elemento['campo']] = $elemento['edit_value'];
                        }

                        switch ($select_type){
                            
                            case "default":
 
                                echo "<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" ".$select_width." class=\"bs-select form-control ".$elemento['class']."\" ".$elemento['requerido']." ".$select_padre." tabindex=\"".$tabindex."\" /> \n"
                                    ."<option value=\"\">--- Seleccione ---</option> \n";
                                
                                //$s = "SELECT * FROM $sche.$tabla";
                                $sgroup = "SELECT * FROM ".$elemento['tabla_group'];
                                $sgroup .= (!empty($criterio_group) ? " WHERE criterio_group" : "");
                                $sgroup .= (!empty($elemento['orden_group']) ? " ORDER BY ".$elemento['orden_group'] : "");
                                //echo $s;
                                $rsgroup = $conec->dbQuery($sgroup, $debug);
                                $nrowsgroup = $conec->dbNumRows($rsgroup);
                                if ($nrowsgroup > 0){
                                    while ($rowgroup = $conec->dbFetchArray($rsgroup)){
                                       
                                        $option = "";
                                        //$s = "SELECT * FROM $sche.$tabla";
                                        $s = "SELECT * FROM ".$elemento['tabla']." WHERE (".$elemento['fk_select']." = '".$rowgroup[$elemento['pk_group']]."') ";
                                        $s .= (!empty($elemento['orden']) ? " ORDER BY ".$elemento['orden'] : "");
                                        //echo $s;
                                        $rs = $conec->dbQuery($s, $debug);
                                        $nrows = $conec->dbNumRows($rs);
                                        $vals = explode(',',$elemento['descripcion']);
                                        if ($nrows > 0){
                                            echo "<optgroup label=\"".$rowgroup[$elemento['descripcion_group']]."\"> \n";
                                            
                                            while ($row = $conec->dbFetchArray($rs)){
                                                echo  "<option value=\"".trim($row[$elemento['valor']])."\"".(trim($row[$elemento['valor']]) == $rs_datos[$elemento['campo']] ? " SELECTED":"")."> \n";
                                                foreach ($vals as $des_row){
                                                    echo $row[$des_row]." ";
                                                    }
                                                echo "</option>\n";
                                            }
                                            echo "</optgroup>\n";
                                        }                                       
                                    }
                                }
                                else {
                                    echo "<option value=''>No hay registros</option>";
                                }

                                echo "</select> \n";
                            break;
                        
                            case "search":
                                echo "<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" ".$select_width." class=\"bs-select form-control\" data-width=\"125px\" data-live-search=\"true\" ".$elemento['class']."\" ".$elemento['requerido']." ".$select_padre." tabindex=\"".$tabindex."\" /> \n"
                                    ."<option value=\"\">--- Seleccione ---</option> \n";
                                
                                //$s = "SELECT * FROM $sche.$tabla";
                                $sgroup = "SELECT * FROM ".$elemento['tabla_group'];
                                $sgroup .= (!empty($criterio_group) ? " WHERE criterio_group" : "");
                                $sgroup .= (!empty($elemento['orden_group']) ? " ORDER BY ".$elemento['orden_group'] : "");
                                //echo $s;
                                $rsgroup = $conec->dbQuery($sgroup, $debug);
                                $nrowsgroup = $conec->dbNumRows($rsgroup);
                                if ($nrowsgroup > 0){
                                    while ($rowgroup = $conec->dbFetchArray($rsgroup)){
                                        echo "<optgroup label=\"".$rowgroup[$elemento['descripcion_group']]."\"> \n";

                                        $option = "";
                                        //$s = "SELECT * FROM $sche.$tabla";
                                        $s = "SELECT * FROM ".$elemento['tabla']." WHERE (".$elemento['fk_select']." = '".$rowgroup[$elemento['pk_group']]."') ";
                                        $s .= (!empty($elemento['orden']) ? " ORDER BY ".$elemento['orden'] : "");
                                        //echo $s;
                                        $rs = $conec->dbQuery($s, $debug);
                                        $nrows = $conec->dbNumRows($rs);
                                        $vals = explode(',',$elemento['descripcion']);
                                        if ($nrows > 0){
                                            while ($row = $conec->dbFetchArray($rs)){
                                                echo  "<option value=\"".trim($row[$elemento['valor']])."\"".(trim($row[$elemento['valor']]) == $rs_datos[$elemento['campo']] ? " SELECTED":"")."> \n";
                                                foreach ($vals as $des_row){
                                                    echo $row[$des_row]." ";
                                                    }
                                                echo "</option>\n";
                                            }
                                        }
                                        else {
                                            echo "<option value=''>No hay registros</option>";
                                        }
                                        echo "</optgroup>\n";
                                    }
                                }
                                else {
                                    echo "<option value=''>No hay registros</option>";
                                }

                                echo "</select> \n";
                            break;
                        }
                        
                        $campo_padre = $rs_datos[$elemento['campo']];
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

                    // Select con Subtexto
                    if ($elemento['tipo_objeto'] == "select_subtext"){
                        
                        // Default del ancho del select
                        $select_width = (!isset($elemento['select_width'])) ? "data-width=\"100%\" " : "data-width=\"".$elemento['select_width']."\" ";
                        
                        
                        // Select hijo
                        if (isset($elemento['select_hijo']) && ($elemento['select_hijo'] == TRUE)){
                            $criterio = "".$elemento['campo_padre']." = '".$campo_padre."'";
                        }
                        else {
                            $criterio = (isset($elemento['criterio'])) ? $elemento['criterio'] : "";
                        }
                            
                        $option = "";
                        //$s = "SELECT * FROM $sche.$tabla";
                        $s = "SELECT * FROM ".$elemento['tabla'];
                        $s .= (!empty($criterio) ? " WHERE $criterio" : "");
                        $s .= (!empty($elemento['orden']) ? " ORDER BY ".$elemento['orden'] : "");
                        //echo $s;
                        $rs = $conec->dbQuery($s, $debug);
                        $nrows = $conec->dbNumRows($rs);
                        $vals = explode(',',$elemento['descripcion']);
                        if ($nrows > 0){
                            while ($row = $conec->dbFetchArray($rs)){
                                $option .= "<option  data-subtext=\"".$row[$elemento['subtext']]."\" value=\"".trim($row[$elemento['valor']])."\"".(trim($row[$elemento['valor']]) == $rs_datos[$elemento['campo']] ? " SELECTED":"")."> \n";
                                foreach ($vals as $des_row){
                                    $option .= $row[$des_row]." ";
                                    }
                                $option .= "</option>\n";
                            }
                        }
                        else {
                            $option .= "<option value=''>No hay registros</option>";
                        }
                        
                        echo "<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" data-show-subtext=\"true\" ".$select_width." class=\"bs-select form-control ".$elemento['class']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n"
                            ."<option value=\"\">--- Seleccione ---</option> \n";
                        echo $option;

                        echo "</select> \n";
                        
                        $campo_padre = $rs_datos[$elemento['campo']];
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                
                    // Select con Iconos de Font Awesome
                    if ($elemento['tipo_objeto'] == "select_icons"){
                        
                        // Default del ancho del select
                        $select_width = (!isset($elemento['select_width'])) ? "data-width=\"100%\" " : "data-width=\"".$elemento['select_width']."\" ";

                        $criterio = (isset($elemento['criterio'])) ? $elemento['criterio'] : "";

                        $option = "";
                        //$s = "SELECT * FROM $sche.$tabla";
                        $s = "SELECT * FROM ".$elemento['tabla'];
                        $s .= (!empty($criterio) ? " WHERE $criterio" : "");
                        $s .= (!empty($elemento['orden']) ? " ORDER BY ".$elemento['orden'] : "");
                        //echo $s;
                        $rs = $conec->dbQuery($s, $debug);
                        $nrows = $conec->dbNumRows($rs);
                        $vals = explode(',',$elemento['descripcion']);
                        if ($nrows > 0){
                            while ($row = $conec->dbFetchArray($rs)){
                                $option .= "<option  data-icon=\"".$row[$elemento['select_icon']]."\" value=\"".trim($row[$elemento['valor']])."\"".(trim($row[$elemento['valor']]) == $rs_datos[$elemento['campo']] ? " SELECTED":"")."> \n";
                                foreach ($vals as $des_row){
                                    $option .= $row[$des_row]." ";
                                    }
                                $option .= "</option>\n";
                            }
                        }
                        else {
                            $option .= "<option value=''>No hay registros</option>";
                        }
                        
                        echo "<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" data-show-subtext=\"true\" ".$select_width." class=\"bs-select form-control ".$elemento['class']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n"
                            ."<option value=\"\">--- Seleccione ---</option> \n";
                        echo $option;

                        echo "</select> \n";                      
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

                    // Select con html
                    if ($elemento['tipo_objeto'] == "select_html"){
                        
                        // Default del ancho del select
                        $select_width = (!isset($elemento['select_width'])) ? "data-width=\"100%\" " : "data-width=\"".$elemento['select_width']."\" ";

                        $criterio = (isset($elemento['criterio'])) ? $elemento['criterio'] : "";

                        $option = "";
                        //$s = "SELECT * FROM $sche.$tabla";
                        $s = "SELECT * FROM ".$elemento['tabla'];
                        $s .= (!empty($criterio) ? " WHERE $criterio" : "");
                        $s .= (!empty($elemento['orden']) ? " ORDER BY ".$elemento['orden'] : "");
                        //echo $s;
                        $rs = $conec->dbQuery($s, $debug);
                        $nrows = $conec->dbNumRows($rs);
                        $vals = explode(',',$elemento['descripcion']);
                        if ($nrows > 0){
                            while ($row = $conec->dbFetchArray($rs)){
                                $option .= "<option data-content=\"".$row[$elemento['select_html']]."\" value=\"".trim($row[$elemento['valor']])."\"".(trim($row[$elemento['valor']]) == $rs_datos[$elemento['campo']] ? " SELECTED":"")."> \n";
                                foreach ($vals as $des_row){
                                    $option .= $row[$des_row]." ";
                                    }
                                $option .= "</option>\n";
                            }
                        }
                        else {
                            $option .= "<option value=''>No hay registros</option>";
                        }
                        
                        echo "<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" data-show-subtext=\"true\" ".$select_width." class=\"bs-select form-control ".$elemento['class']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n"
                            ."<option value=\"\">--- Seleccione ---</option> \n";
                        echo $option;

                        echo "</select> \n";                      
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                    
                    // Select Pais
                    if ($elemento['tipo_objeto'] == "select_pais"){
                    // Ej: array ('campo' => 'dimp_pais', 'nombre' => 'Pa&iacute;s', 'tipo_objeto' => 'select_pais', 'tipo_dato' => 'integer', 'tabla' => 'tbla_pais', 'orden' => 'id', 'valor' => 'id', 'descripcion' => 'pais_nomb', 'flag' => 'pais_iso2'),  
                        
                        // Default del ancho del select
                        $select_width = (!isset($elemento['select_width'])) ? "data-width=\"100%\" " : "data-width=\"".$elemento['select_width']."\" ";

                        $criterio = (isset($elemento['criterio'])) ? $elemento['criterio'] : "";

                        $option = "";
                        //$s = "SELECT * FROM $sche.$tabla";
                        $s = "SELECT * FROM ".$elemento['tabla'];
                        $s .= (!empty($criterio) ? " WHERE $criterio" : "");
                        $s .= (!empty($elemento['orden']) ? " ORDER BY ".$elemento['orden'] : "");
                        //echo $s;
                        $rs = $conec->dbQuery($s, $debug);
                        $nrows = $conec->dbNumRows($rs);
                        $vals = explode(',',$elemento['descripcion']);
                        if ($nrows > 0){
                            while ($row = $conec->dbFetchArray($rs)){
                                
                                $file_flag = $path."assets/global/img/icons/flags-iso/shiny/16/".$row[$elemento['flag']].".png";
                                $e_flag = file_exists($file_flag);
                                
                                if ($e_flag == FALSE){
                                    $flag = $path."assets/global/img/icons/flags-iso/shiny/16/_unknown.png";
                                }
                                else {
                                    $flag = $file_flag;
                                }
                                
                                $option .= "<option data-content='<img src=\"".$flag."\" /> ".$row[$elemento['descripcion']]." '  value=\"".trim($row[$elemento['valor']])."\"".(trim($row[$elemento['valor']]) == $rs_datos[$elemento['campo']] ? " SELECTED":"").">".$row[$elemento['descripcion']]." \n";
                                foreach ($vals as $des_row){
                                    $option .= $row[$des_row]." ";
                                    }
                                $option .= "</option>\n";
                            }
                        }
                        else {
                            $option .= "<option value=''>No hay registros</option>";
                        }
                        
                        echo "<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" data-show-subtext=\"true\" ".$select_width." class=\"bs-select form-control ".$elemento['class']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n"
                            ."<option value=\"\">--- Seleccione ---</option> \n";
                        echo $option;

                        echo "</select> \n";                      
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                   
                    // Multiselect Select2 (chosen select)
                    if ($elemento['tipo_objeto'] == "select2_multi_select"){
                        // Value segun la opcion
                        if ($op == "editar"){
                            $values = $piezas = explode(",", $rs_datos[$elemento['campo']]);
                        }
                        
                    $criterio = (isset($elemento['criterio'])) ? $elemento['criterio'] : "";                 
                    echo "<select name=\"".$elemento['campo']."[]\" id=\"".$elemento['campo']."\" class=\"form-control select2-multiple ".$elemento['class']."\" multiple ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n";
  
                    $option = "";
                    //$s = "SELECT * FROM $sche.$tabla";
                    $s = "SELECT * FROM ".$elemento['tabla'];
                    $s .= (!empty($criterio) ? " WHERE $criterio" : "");
                    $s .= (!empty($elemento['orden']) ? " ORDER BY ".$elemento['orden'] : "");
                    //echo $s;
                    $rs = $conec->dbQuery($s, $debug);
                    $nrows = $conec->dbNumRows($rs);
                    $vals = explode(',',$elemento['descripcion']);
                    if ($nrows > 0){
                        while ($row = $conec->dbFetchArray($rs)){
                                echo  "<option value=\"".trim($row[$elemento['valor']])."\"";
                                    
                                if (in_array(($row[$elemento['valor']]), $values)){
                                    echo " selected";
                                }
                                echo ">";
                                foreach ($vals as $des_row){
                                    echo $row[$des_row]." ";
                                    }
                                echo "</option>\n";
                        }
                    }
                    else {
                        echo "<option value=''>No hay registros</option>";
                    }

                    echo "</select> \n";

                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
   
                    // Multiselect Select2 Group (chosen select)
                    if ($elemento['tipo_objeto'] == "select2_multi_select_group"){
                        
                        
                    $criterio = (isset($elemento['criterio'])) ? $elemento['criterio'] : "";
                    $criterio_group = (isset($elemento['criterio_group'])) ? $elemento['criterio_grup'] : "";

                    echo "<select name=\"".$elemento['campo']."[]\" id=\"".$elemento['campo']."\" class=\"form-control select2-multiple ".$elemento['class']."\" multiple ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n";

                        //$s = "SELECT * FROM $sche.$tabla";
                        $sgroup = "SELECT * FROM ".$elemento['tabla_group'];
                        $sgroup .= (!empty($criterio_group) ? " WHERE criterio_group" : "");
                        $sgroup .= (!empty($elemento['orden_group']) ? " ORDER BY ".$elemento['orden_group'] : "");
                        //echo $s;
                        $rsgroup = $conec->dbQuery($sgroup, $debug);
                        $nrowsgroup = $conec->dbNumRows($rsgroup);
                        if ($nrowsgroup > 0){
                            while ($rowgroup = $conec->dbFetchArray($rsgroup)){
                                echo "<optgroup label=\"".$rowgroup[$elemento['descripcion_group']]."\"> \n";
                        
                
                                $option = "";
                                //$s = "SELECT * FROM $sche.$tabla";
                                $s = "SELECT * FROM ".$elemento['tabla']." WHERE (".$elemento['fk_select']." = '".$rowgroup[$elemento['pk_group']]."') ";
                                $s .= (!empty($elemento['orden']) ? " ORDER BY ".$elemento['orden'] : "");
                                //echo $s;
                                $rs = $conec->dbQuery($s, $debug);
                                $nrows = $conec->dbNumRows($rs);
                                $vals = explode(',',$elemento['descripcion']);
                                if ($nrows > 0){
                                    while ($row = $conec->dbFetchArray($rs)){
                                        echo  "<option value=\"".trim($row[$elemento['valor']])."\"".(trim($row[$elemento['valor']]) == $rs_datos[$elemento['campo']] ? " SELECTED":"")."> \n";
                                        foreach ($vals as $des_row){
                                            echo $row[$des_row]." ";
                                            }
                                        echo "</option>\n";
                                    }
                                }
                                else {
                                    echo "<option value=''>No hay registros</option>";
                                }

                                echo "</optgroup>\n";
                            }
                        }
                        else {
                            echo "<option value=''>No hay registros</option>";
                        }
                        
                        echo "</select> \n";

                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                  
                    // Multi Select
                    if ($elemento['tipo_objeto'] == "multi_select"){
                        
                        $criterio = (isset($elemento['criterio'])) ? $elemento['criterio'] : "";                 
                        echo "<select name=\"".$elemento['campo']."[]\" id=\"".$elemento['campo']."\" class=\"multi-select ".$elemento['class']."\" multiple=\"multiple\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n";

                        $option = "";
                        //$s = "SELECT * FROM $sche.$tabla";
                        $s = "SELECT * FROM ".$elemento['tabla'];
                        $s .= (!empty($criterio) ? " WHERE $criterio" : "");
                        $s .= (!empty($elemento['orden']) ? " ORDER BY ".$elemento['orden'] : "");
                        //echo $s;
                        $rs = $conec->dbQuery($s, $debug);
                        $nrows = $conec->dbNumRows($rs);
                        $vals = explode(',',$elemento['descripcion']);
                        if ($nrows > 0){
                            while ($row = $conec->dbFetchArray($rs)){
                                echo  "<option value=\"".trim($row[$elemento['valor']])."\"".(trim($row[$elemento['valor']]) == $rs_datos[$elemento['campo']] ? " SELECTED":"")."> \n";
                                foreach ($vals as $des_row){
                                    echo $row[$des_row]." ";
                                    }
                                echo "</option>\n";
                            }
                        }
                        else {
                            echo "<option value=''>No hay registros</option>";
                        }


                        echo "</select> \n";
                    }                   
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
        
                    // Multi Select Group
                    if ($elemento['tipo_objeto'] == "multi_select_group"){  
                        
                        $criterio_group = (isset($elemento['criterio_group'])) ? $elemento['criterio_grup'] : "";  
                        $criterio = (isset($elemento['criterio'])) ? $elemento['criterio'] : "";                 
                        
                        echo "<select name=\"".$elemento['campo']."[]\" id=\"".$elemento['campo']."\" class=\"multi-select multi-select-group".$elemento['class']."\" multiple=\"multiple\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n";

                        //$s = "SELECT * FROM $sche.$tabla";
                        $sgroup = "SELECT * FROM ".$elemento['tabla_group'];
                        $sgroup .= (!empty($criterio_group) ? " WHERE criterio_group" : "");
                        $sgroup .= (!empty($elemento['orden_group']) ? " ORDER BY ".$elemento['orden_group'] : "");
                        //echo $s;
                        $rsgroup = $conec->dbQuery($sgroup, $debug);
                        $nrowsgroup = $conec->dbNumRows($rsgroup);
                        if ($nrowsgroup > 0){
                            while ($rowgroup = $conec->dbFetchArray($rsgroup)){
                                echo "<optgroup label=\"".$rowgroup[$elemento['descripcion_group']]."\"> \n";

                                $option = "";
                                //$s = "SELECT * FROM $sche.$tabla";
                                $s = "SELECT * FROM ".$elemento['tabla']." WHERE (".$elemento['fk_select']." = '".$rowgroup[$elemento['pk_group']]."') ";
                                $s .= (!empty($elemento['orden']) ? " ORDER BY ".$elemento['orden'] : "");
                                //echo $s;
                                $rs = $conec->dbQuery($s, $debug);
                                $nrows = $conec->dbNumRows($rs);
                                $vals = explode(',',$elemento['descripcion']);
                                if ($nrows > 0){
                                    while ($row = $conec->dbFetchArray($rs)){
                                        echo  "<option value=\"".trim($row[$elemento['valor']])."\"".(trim($row[$elemento['valor']]) == $rs_datos[$elemento['campo']] ? " SELECTED":"")."> \n";
                                        foreach ($vals as $des_row){
                                            echo $row[$des_row]." ";
                                            }
                                        echo "</option>\n";
                                    }
                                }
                                else {
                                    echo "<option value=''>No hay registros</option>";
                                }
                                echo "</optgroup>\n";
                            }
                        }
                        else {
                            echo "<option value=''>No hay registros</option>";
                        }
                        echo "</select> \n";
                    }                  
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
        
                    // File
                    if ($elemento['tipo_objeto'] == "file"){  
                        
                        $color_button = (isset($elemento['color_button'])) ? $elemento['color_button'] : "blue"; 
                     
                        echo "<div class=\"input-group\"> \n";
                        
                        // Icon box left
                        if ((isset($elemento['icon_box_left'])) && ($elemento['icon_box_left'] == TRUE)){
                            echo "<div class=\"input-group input-group\"> \n"
                                ."<span class=\"input-group-addon\"> \n"
                                ."<i class=\"".$elemento['input_icon']."\"></i> \n"
                                ."</span> \n";
                            $input_icon = TRUE;
                        }

                        // Text box left
                        if ((isset($elemento['text_box_left'])) && ($elemento['text_box_left'] == TRUE)){
                            echo "<div class=\"input-group input-group\"> \n"
                                ."<span class=\"input-group-addon\"> \n"
                                .$elemento['text_box']." \n"
                                ."</span> \n";
                            $input_icon = TRUE;
                        }

                        // Icon left
                        if ((isset($elemento['icon_left'])) && ($elemento['icon_left'] == TRUE)){
                            echo "<div class=\"input-icon input-group\"> \n"
                                ."<i class=\"".$elemento['input_icon']."\"></i> \n";
                            $input_icon = TRUE;
                        } 
                                
                        echo "<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" size=\"60\" class=\"form-control ".$elemento['class']."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." value=\"".$rs_datos[$elemento['campo']]."\" tabindex=\"".$tabindex."\" /> \n"
                            ."<span class=\"input-group-btn\"> \n"                          
                            ."<a  \n";
                        echo "href=\"javascript:open_popup('".$path."assets/global/plugins/responsive-filemanager/filemanager/dialog.php?type=".$elemento['type']."&editor=mce_0&fldr=".$elemento['folder']."&popup=1&field_id=".$elemento['campo']."')\" \n";
   
                        echo "class=\"btn ".$color_button." ".$elemento['class']."\" type=\"button\">Seleccione</a> \n"
                            ."</span> \n";
                        
                        // Cierre de los input icons
                        if ($input_icon == TRUE){
                            echo "</div> \n";
                        }
                                
                        echo "</div> \n";  

                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                    
                    // Input Radio
                    if ($elemento['tipo_objeto'] == "input_radio"){
                        
                        // Default de la alineacion de los radios - valores 'icheck-inline', 'icheck-list'
                        $input_radio_align = (isset($elemento['input_radio_align'])) ? $elemento['input_radio_align'] : "icheck-inline"; 

                        // Deafault del tipo de radio - valores 'minimal', 'iradio_square-{color}', 'iradio_flat-{color}', 'iradio_line-{color}'                        
                        $input_radio_type = (isset($elemento['input_radio_type'])) ? $elemento['input_radio_type'] : ""; 
                        
                        // Default del tipo de dato de radio
                        $input_radio_bool = ((isset($elemento['input_radio_bool'])) && ($elemento['input_radio_bool'] == FALSE)) ? FALSE : TRUE; 
                        
                        if ($op == "insertar"){
                            $checked_actv = "";
                            $checked_dact = "";
                        }
                        
                        if ($input_radio_bool == TRUE){
                            
                            $value0 = "0";
                            $value1 = "1";
                            
                            if ($op == "editar"){
                                $checked_actv = (($rs_datos[$elemento['campo']] == $value0) ? "checked" : "");
                                $checked_dact = (($rs_datos[$elemento['campo']] == $value1) ? "checked" : "");
                            }
                        }
                        else {
                            $value0 = $elemento['value0'];
                            $value1 = $elemento['value1'];
                            
                            if ($op == "editar"){
                                $checked_actv = (($rs_datos[$elemento['campo']] == $value0) ? "checked" : "");
                                $checked_dact = (($rs_datos[$elemento['campo']] == $value1) ? "checked" : "");
                            }
                        }
                                                
                        echo "<div class=\"input-group\"> \n"
                            ."<div class=\"".$input_radio_align."\"> \n"
                            ."<label> \n"
                            ."<input type=\"radio\" name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."1\" class=\"icheck\" data-radio=\"".$input_radio_type."\" value=\"".$value1."\" $checked_dact tabindex=\"".$tabindex."\"/> \n"
                            .$elemento['opcion1']." \n"
                            ."</label> \n"
                            ."<label> \n"
                            ."<input type=\"radio\" name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."0\" class=\"icheck\" data-radio=\"".$input_radio_type."\" value=\"".$value0."\" $checked_actv tabindex=\"".$tabindex."\" /> \n"
                            .$elemento['opcion0']." \n"
                            ."</label> \n"
                            ."</div> \n"
                            ."</div> \n";
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                    
                    // Input Hidden
                    if ($elemento['tipo_objeto'] == "input_hidden"){   
                        if ($op == "insertar"){
                            $value = $elemento['value'];
                        }
                        if ($op == "editar"){
                            $value = $elemento['value'];
                        }

                        echo "<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"hidden\" value=\"".$value."\" /> \n";
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                                        
                    // Bootstrap Switch
                    
                    if ($elemento['tipo_objeto'] == "bootstrap_switch"){
                        
                        // Default del la medida - valores 'small', 'large', 'normal'
                        $bs_size = (isset($elemento['bs_size'])) ? $elemento['bs_size'] : "normal"; 

                        // Deafault del color de los estados - valores 'primary', 'success', 'warning', 'info', 'danger'                        
                        $bs_on_color = (isset($elemento['$bs_on_color'])) ? "data-on-color=\"".$elemento['bs_on_color']."\"" : ""; 
                        $bs_off_color = (isset($elemento['$bs_off_color'])) ? "data-off-color=\"".$elemento['bs_off_color']."\"" : ""; 
                                                
                        if ($op == "insertar"){
                            $checked = "";
                        }
                        
                        if ($op == "editar"){
                            $checked = (($rs_datos[$elemento['campo']] == "1") ? "checked" : "");
                        }

                        echo "<div class=\"input-group\"> \n"                           
                            ."<label> \n"
                            ."<input type=\"checkbox\" name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\" ".$checked." class=\"make-switch\" ".$bs_on_color." ".$bs_off_color." data-size=\"".$bs_size." value=\"".$elemento['value']."\" ".$disabled." ".$readonly." tabindex=\"".$tabindex."\"\"> \n"
                            ."</label> \n"
                            ."</div> \n";
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                 
                    // Icon Picker
                    if ($elemento['tipo_objeto'] == "icon_picker"){
                        echo "<div class=\"input-group\"> \n"
                            ."<span class=\"input-group-addon icon_picker_icon\"></span> \n"
                            ."<input id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" data-placement=\"bottomRight\" class=\"form-control icp icp-auto my ".$elemento['class']."\" value=\"".$rs_datos[$elemento['campo']]."\" type=\"text\" tabindex=\"".$tabindex."\" ".$readonly." ".$disabled." ".$elemento['requerido']." /> \n"                               
                            ."</div> \n";                      
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                    
                    if ($elemento['tipo_objeto'] == "nacionalidad"){
                            if ($op == "editar"){
                                //echo $rs_datos[$elemento['campo']];
                                $selectedv = (($rs_datos[$elemento['campo']] == "V") ? "selected=\"selected\"" : "");
                                $selectede = (($rs_datos[$elemento['campo']] == "E") ? "selected=\"selected\"" : "");
                            }
                            if ($op == "insertar"){
                                $selectedv = "";
                                $selectede = "";
                            }
                            // Default del ancho del select
                            
                            echo "<div class=\"form-group\"> \n"
                            ."<label for=\"".$elemento['campo']."\" class=\"control-label $ftlabel\">Nacionalidad - C&eacute;dula: ".$requerido."</label> \n"
                            .$ftcampoi
                            ."<select name=\"".$elemento['campo']."\" id=\"".$elemento['campo']."\"  class=\"form-control nacionalidad ".$elemento['class']."\" ".$elemento['requerido']." tabindex=\"".$tabindex."\" /> \n"
                                ."<option value=\"V\" ".$selectedv.">V</option> \n" 
                                ."<option value=\"E\" ".$selectede.">E</option> \n" 
                            ."</select>\n";             
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                    
                    if ($elemento['tipo_objeto'] ==  "cedula"){
                        echo "<label class=\"separador\"> - </label><input width=\"85%\" id=\"".$elemento['campo']."\" name=\"".$elemento['campo']."\" type=\"text\" class=\"form-control cedula  ".$elemento['class']."\" placeholder=\"".$elemento['placeholder']."\" ".$elemento['requerido']." value=\"".$rs_datos[$elemento['campo']]."\" data-type=\"number\" /> \n";
                            
                        echo "<span class=\"help-block\">Seleccione la nacionalidad / ingrese el n&uacute;mero de c&eacute;dula</span> \n"
                            .$ftcampof
                            ."</div> \n";
                    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                
                if (($elemento['tipo_objeto'] == "input_text") || ($elemento['tipo_objeto'] == "input_email") || ($elemento['tipo_objeto'] == "input_number") || ($elemento['tipo_objeto'] == "input_password") || ($elemento['tipo_objeto'] == "input_tel")){
                    
                }
                elseif(($elemento['tipo_objeto'] == "nacionalidad") || ($elemento['tipo_objeto'] == "cedula")){
                        
                }
                elseif($elemento['tipo_objeto'] == "input_hidden"){
                        
                }
                else {
                    echo "<span class=\"help-block\">".$ayuda."</span> \n"
                        .$ftcampof
                        ."</div> \n";
                }
                    
                // Cierre de campo    
                break;
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                
                case "form_fieldset":
                    
                    if ($elemento['fieldset_type'] == "begin"){
                        // id del fieldset
                        $field_id = (isset($elemento['fieldset_id'])) ? $elemento['fieldset_id']." " : "";

                        // name del fieldset
                        $field_name = (isset($elemento['fieldset_name'])) ? $elemento['fieldset_name']." " : "";

                        // disabled fieldset
                        $field_disabled = ((isset($elemento['fieldset_disabled'])) && ($elemento['fieldset_disabled'] = TRUE)) ? "disabled " : "";

                        // class fieldset
                        $field_class = (isset($elemento['fieldset_class'])) ? $elemento['fieldset_class'] : "";

                        echo "<fieldset ".$field_id.$field_name.$field_disabled." class=\"form-group".$field_class."\"> \n";
                        if (isset($elemento['fieldset_legend'])){
                            echo "<legend>".$elemento['fieldset_legend']."</legend> \n";
                        }
                    }
                    if ($elemento['fieldset_type'] == "end"){
                        echo "</fieldset> \n";
                    }
                break;
                
                case "form_alert":
                    
                    echo "<div class=\"form-group\"> \n"
                        ."<div class=\"col-md-3\"> \n"
                        ."</div> \n"
                        ."<div class=\"col-md-9\"> \n"
                        ."<div class=\"alert ";
                    
                    switch ($elemento['form_alert_type']){
                    
                        case "success":
                            echo "alert-success\"> \n";  
                        break;    
                        case "info":
                            echo "alert-info\"> \n";  
                        break;
                        case "warning":
                            echo "alert-warning\"> \n";  
                        break;
                        case "danger":
                            echo "alert-danger\"> \n";  
                        break;                
                    }
                    echo $elemento['form_alert_text']." \n"
                        ."</div> \n"
                        ."</div> \n"
                        ."</div> \n";
                break;
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
                
                case "form_note":
                    
                    echo "<div class=\"form-group\"> \n"
                        ."<div class=\"col-md-3\"> \n"
                        ."</div> \n"
                        ."<div class=\"col-md-9\"> \n"
                        ."<div class=\"note ";
                    
                    switch ($elemento['form_note_type']){
                    
                        case "success":
                            echo "note-success\"> \n";  
                        break;    
                        case "info":
                            echo "note-info\"> \n";  
                        break;
                        case "warning":
                            echo "note-warning\"> \n";  
                        break;
                        case "danger":
                            echo "note-danger\"> \n";  
                        break;                
                    }
                    echo "<h4 class=\"block\">".$elemento['form_note_title']."</h4> \n"
                        .$elemento['form_note_text']." \n"
                        ."</div> \n"
                        ."</div> \n"
                        ."</div> \n";
                break;
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

                case "form_title":
                
                    echo "<div class=\"form-group\"> \n"
                        ."<div class=\"col-md-3\"> \n"
                        ."</div> \n"
                        .$ftcampoi;

                    switch ($elemento['form_title_type']){

                       case "h1":
                            echo "<h1 class=\"block\">".$elemento['form_title_text']."</h1> \n";
                        break;

                        case "h2":
                            echo "<h2>".$elemento['form_title_text']."</h2> \n";
                        break;

                         case "h3":
                            echo "<h3>".$elemento['form_title_text']."</h3> \n";
                        break;

                        case "h4":
                            echo "<h4>".$elemento['form_title_text']."</h4> \n";
                        break;

                        case "h5":
                            echo "<h5>".$elemento['form_title_text']."</h5> \n";
                        break;

                        case "h6":
                            echo "<h6>".$elemento['form_title_text']."</h6> \n";
                        break;
                    }
                
                    echo "</div> \n"
                        ."</div> \n";
                break;
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

                case "hr":
                    echo "<hr /> \n";     
                break;
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

            }   // switch si los campos son elementos

        } // cierre del foreach de los elementos del formulario 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
        
        if ($captcha == "on"){
            // Captcha
            echo "<div class=\"form-group\"> \n"
                ."<label class=\"control-label $ftlabel\">Marca la Captcha para continuar ".$requerido."</label> \n"
                ."<div class=\".$ftcampoi\"> \n"
                ."<div class=\"input-group\"> \n"
                ."<div class=\"g-recaptcha\" data-sitekey=\"".CAPTCHA_PUBLICKEY."\"> \n"
                ."</div> \n"
                ."<script src='https://www.google.com/recaptcha/api.js?hl=es'></script> \n"
                ."</div> \n"
                ."<span class=\"help-block\">Indicanos que eres un ser humano</span> \n"
                .$ftcampoi
                ."</div> \n";  
        }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
       
        if ($op == "insertar"){
            $button_icon = "fa fa-plus";
        }
        if ($op == "editar"){
            $button_icon = "fa fa-pencil";
        }
        
        // Acciones del formulario 
        $btn_disabled = (isset($config['form_btn_disabled']) && ($config['form_btn_disabled'] == TRUE)) ? " disabled" : ""; 
        
        echo "<div class=\"form-actions\"> \n"
            ."<div class=\"row\"> \n"
            ."<div class=\"col-md-offset-3 col-md-9\"> \n"
            ."<button type=\"submit\" class=\"btn green\" ".$btn_disabled."><i class=\"".$button_icon."\"></i> Enviar</button> \n"
            ."<button type=\"reset\" class=\"btn default\" ".$btn_disabled."><i class=\"fa fa-eraser\"></i> Cancelar</button> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n";
        
        // Variables ocultas de control
        echo "<input type=\"hidden\" id=\"control\" name=\"control\" value=\"1\"> \n";        
        echo "<input type=\"hidden\" id=\"op\" name=\"op\" value=\"".$op."\"> \n";
        
        if ($op == "editar"){
            echo "<input type=\"hidden\" id=\"id\" name=\"id\" value=\"".$id."\"> \n";           
        }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 
        
        // Cierre del formulario
        echo "</div><!-- form-body --> \n"
            ."</form> \n"
            ."<!-- END FORM--> \n";
        
        if (isset($config['bootstrap_only']) && $config['bootstrap_only'] == TRUE){
            
        }
        else {
            echo "</div><!-- end portlet> \n";
        }
    }
//=========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================// 
    
    function FormViewOnly($path, $form_title, $form, $table, $id, $form_action, $config){
            
            // Inclusion de librerias       
            require_once $path.'core/db.class.core.php';
            
            // Control de errores
            $debug = DEBUG;

            // Crear la instancia y conectar a la BD
            $conec = new db();
            $conec->dbConexion();

            // Consulta para mostrar los datos del registro en el formulario
            $sche = "";
            $campos = "*";
            $criterio = "id = '".$id."'";
            $orden = "";
            $clausula = "";
            $edit_registro = $conec->dbConsulta($sche, $table, $campos, $criterio, $orden, $clausula, $debug);
            $rs_datos = $conec->dbFetchArray($edit_registro);
            
            // Sutitulo del formulario
            $portlet_subtitle = (!isset($config['portlet_subtitle'])) ? "" : $config['portlet_subtitle'];
                      
            // Incio del portled
            echo "<div class=\"portlet light bordered\"> \n";
                
            // Titulo y subtitulo del portled
            echo "<div class=\"portlet-title\"> \n"
                ."<div class=\"caption\"> \n"
                ."<i class=\"icon-equalizer font-green-haze\"></i> \n"
                ."<span class=\"caption-subject font-green-haze bold uppercase\">".$form_title."</span> \n"
                ."<span class=\"caption-helper\">".$portlet_subtitle."</span> \n"
                ."</div> \n";
            
            // Herramientas del portled
            echo "<div class=\"tools\"> \n"
                ."<a href=\"\" class=\"collapse\"> </a> \n"
                //."<a href=\"#portlet-config\" data-toggle=\"modal\" class=\"config\"> </a> \n"
                ."<a href=\"\" class=\"reload\"> </a> \n"
                //."<a href=\"\" class=\"remove\"> </a> \n"
                ."</div> \n"
                ."</div> \n";
            
            // Cuerpo del formulario
            echo "<div class=\"portlet-body form\"> \n"
                ."<!-- BEGIN FORM--> \n"
                ."<form class=\"form-horizontal\" role=\"form\" action=\"".$path.$form_action."\"> \n"
                ."<div class=\"form-body\"> \n";
            
            // Elementos del formulario
            foreach ($form as $elemento){
                
                // Default del tipo de elemento  
                $elemento['elemento'] = (!isset($elemento['elemento'])) ? "campo" : $elemento['elemento'];
                
                // Default del formato del elemento  
                $format = (!isset($elemento['format'])) ? "normal" : $elemento['format'];
                
                if ($elemento['elemento'] == "campo"){
                                        
                    // Tratamiento de los datos
                    switch ($format) {

                        case "normal":
                            $valor =  $rs_datos[$elemento['campo']];
                        break;
                    
                        case "sexo":
                            if ($rs_datos[$elemento['campo']] == "F"){
                                $valor = "Femenino";
                            }    
                            else{
                                $valor = "Masculino";
                            }
                        break;
                        
                        case "date":
                            $valor = date("d\-m\-Y", strtotime($rs_datos[$elemento['campo']]));
                        break;
                
                        case "time":
                            $valor = date("h\:i\ a", strtotime($rs_datos[$elemento['campo']]));
                        break;
                        
                        case "date_time":
                            $valor = date("d\-m\-Y / h\:i\ a", strtotime($rs_datos[$elemento['campo']]));
                        break;
                    }
                }

                // Switch para los tipos de elementos del formulario
                switch ($elemento['elemento']){
                                    
                    case "form_title_section":
                        
                        switch ($elemento['form_title_section_type']){

                            case "h1":                               
                                echo "<h1 class=\"form-section\">".$elemento['form_title_section_text']."</h1> \n";
                            break;

                            case "h2":
                                echo "<h2 class=\"form-section\">".$elemento['form_title_section_text']."</h2> \n";
                            break;

                             case "h3":
                                echo "<h3 class=\"form-section\">".$elemento['form_title_section_text']."</h3> \n";
                            break;

                            case "h4":
                                echo "<h4 class=\"form-section\">".$elemento['form_title_section_text']."</h4> \n";
                            break;

                            case "h5":
                                echo "<h5 class=\"form-section\">".$elemento['form_title_section_text']."</h5> \n";
                            break;

                            case "h6":
                                echo "<h6 class=\"form-section\">".$elemento['form_title_section_text']."</h6> \n";
                            break;
                        }
                    break;
                
                    case "section_begin":
                        echo "<div class=\"row\"> \n";
                    break;
                
                    case "section_end":
                        echo "</div><!-- row-end --> \n";
                    break;
                
                    case "campo":
                        
                        echo "<div class=\"col-md-6\"> \n"
                            ."<div class=\"form-group\"> \n"
                            ."<label class=\"control-label $ftlabel\">".$elemento['nombre'].":</label> \n"
                            ."<div class=\"col-md-9\"> \n"
                            ."<p class=\"form-control-static\">".$valor."</p> \n"
                            ."</div> \n"
                            ."</div> \n"
                            ."</div> \n";
                    break;
                }
            }

            echo "</div> \n";
            
            if ($config['form_actions'] == TRUE){
                
                // Acciones del formulario
                echo "<div class=\"form-actions\"> \n"
                    ."<div class=\"row\"> \n"
                    ."<div class=\"col-md-6\"> \n"

                    ."<div class=\"row\"> \n"

                    ."<div class=\"col-md-offset-3 col-md-9\"> \n"
                    ."<button type=\"submit\" class=\"btn green\"> \n"
                    ."<i class=\"fa fa-pencil\"></i> Editar \n"
                    ."</button> \n"
                    ."<button type=\"button\" class=\"btn default\">Cancel</button> \n"
                    ."</div> \n"

                    ."</div><!-- row-end --> \n"

                    ."</div> \n"
                    ."<div class=\"col-md-6\"> </div> \n"
                    ."</div> \n"
                    ."</div><!-- form-actions-end --> \n";
                
                echo "<input name=\"id\" type=\"hidden\" value=\"".$id."\" /> \n";
            }       
            
            echo"</form> \n"
                ."<!-- END FORM--> \n"
                ."</div> \n"
                ."</div> \n";
        }