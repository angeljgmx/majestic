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

    // Identificador del modulo
    $_SESSION['mdlo_code'] = "MD-ADMIN";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Control de errores
    $debug = DEBUG;
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Crear la instancia y conectar a la BD
    $conec = new db();
    $conec->dbConexion(); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            

    // Objetivo para los formularios, los enlaces y las funciones 
    $objetivo = basename($_SERVER["PHP_SELF"]); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Encabezado de la pagina
    $page_title = "Asignaci&oacute;n de M&oacute;dulos";
    $meta = "";
    $css = "<link href=\"".$path."assets/pages/css/profile.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n";
    $js = "";
    $actions_pagebar = "";
    $config = [];
    CommonHeader($path, $page_title, $meta, $css, $js, $objetivo, $actions_pagebar, $config);
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    // Validacion de la session
    if (SessionValidate($path, "adms")){
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

        // Reecepcion del id del administrador
        if (null !== filter_input(INPUT_GET, 'admsid', FILTER_SANITIZE_NUMBER_INT)){ 
            $_SESSION['admsid'] = filter_input(INPUT_GET, 'admsid', FILTER_SANITIZE_NUMBER_INT);
        }
        if (null !== filter_input(INPUT_POST, 'admsid', FILTER_SANITIZE_NUMBER_INT)){ 
            $_SESSION['admsid'] = filter_input(INPUT_POST, 'admsid', FILTER_SANITIZE_NUMBER_INT);
        }
        
        // Reecepcion de la varible de control de envio del formulario
        if (null !== filter_input(INPUT_GET, 'control', FILTER_SANITIZE_NUMBER_INT)){ 
            $control = filter_input(INPUT_GET, 'control', FILTER_SANITIZE_NUMBER_INT);
        }
        elseif (null !== filter_input(INPUT_POST, 'control', FILTER_SANITIZE_NUMBER_INT)){ 
            $control = filter_input(INPUT_POST, 'control', FILTER_SANITIZE_NUMBER_INT);
        }
        else {
            $control = "";
        }
        
        if (isset($_SESSION['admsid'])){
        
        
            // Consulta de los datos del administrador
            $sql_adms = "SELECT * FROM tbla_adms WHERE id = '".$_SESSION['sson_idpr']."'";
            $query_adms = $conec->dbQuery($sql_adms, $debug);
            $datos_adms = $conec->dbFetchObjet($query_adms);

            $estado = ($datos_adms->adms_estd == 1) ? "Activo" : "Inactivo";


            echo "<div class=\"row\"> \n"
                ."<div class=\"col-md-12 \"> \n"
                ."<div class=\"col-md-12 portlet light bordered\"> \n";

            echo "<div class=\"col-md-2\"> \n";
    //            ."<!-- BEGIN PROFILE SIDEBAR --> \n"
    //            ."<div class=\"profile-sidebar\"> \n"
    //            ."<!-- PORTLET MAIN --> \n"
    //            ."<div class=\"portlet light user_pickture_asmod\"> \n";

            echo "<!-- SIDEBAR USERPIC --> \n"
                ."<div class=\"profile-userpic user_pick_umas\"> \n";

            if ($datos_adms == "F"){
                $avatar = "flat-faces-icons-circle-woman-128x128.png";
            }
            else{
                $avatar = "flat-faces-icons-circle-man-128x128.png";
            }
            echo "<img src=\"".$path."assets/global/img/icons/128x128/".$avatar."\" class=\"img-responsive\" alt=\"\"> "
                . "</div> \n";

            echo "<!-- END SIDEBAR USERPIC --> \n"
                ."<!-- SIDEBAR USER TITLE --> \n"
                ."<div class=\"profile-usertitle\"> \n"
                //."<div class=\"profile-usertitle-name\"> ".$datos_adms->adms_nomb." ".$datos_adms->adms_apll."</div> \n"
                //."<div class=\"profile-usertitle-job\"> Administrador </div> \n"
                ."</div> \n"
                ."<!-- END SIDEBAR USER TITLE --> \n";

    //            ."</div><!-- END PORTLET MAIN --> \n";
    //
    //            ."</div> \n"
    //            ."<!-- END BEGIN PROFILE SIDEBAR --> \n"
            echo "</div> \n";

            echo "<div class=\"col-md-3\"> \n"            
                ."<!-- PORTLET MAIN --> \n"
                ."<div class=\"portlet light\"> \n"        
                ."<div> \n"

                ."<div class=\"profile-usertitle-job\"> Administrador </div> \n"
                ."<div class=\"margin-top-20 profile-desc-link\"> \n"
                ."<i class=\"fa fa-user\"></i> \n"
                ."Nombre: ".$datos_adms->adms_nomb." ".$datos_adms->adms_apll." \n"
                ."</div> \n"

                ."<div class=\"margin-top-20 profile-desc-link\"> \n"
                ."<i class=\"fa fa-envelope\"></i> \n"
                ."Email: <a href=\"mailto:".$datos_adms->adms_mail."\">".$datos_adms->adms_mail."</a> \n"
                ."</div> \n"

                ."<div class=\"margin-top-20 profile-desc-link\"> \n"
                ."<i class=\"fa fa-check\"></i> \n"
                ."Estado: ".$estado." \n"
                ."</div> \n"

                ."</div> \n"
                ."</div> \n"
                ."<!-- END PORTLET MAIN --> \n"
                ."</div> \n"; 

        echo "<div class=\"col-md-7\"> \n" 
            ."<div class=\"note note-warning\"> \n" 
            ."<h4 class=\"block\">Importante</h4> \n" 
            ."<p> Para poder contar con el acceso inicial al m&oacute;dulo, la opci&oacute;n de consultar datos debe estar activa, de lo contrario no estar&aacute; disponible el m&oacute;dulo en el men&uacute; de navegaci&oacute;n</p> \n" 
            ."<br /> \n"
            ."<p> Para acceder a las funciones de insertar datos, editar o eliminar registros es necesario que la opci&oacute;n de consultar datos est&eacute; ectiva</p>"
            ."</div> \n" 
            ."</div> \n";

            echo "</div> \n"
                ."</div> \n"
                ."</div> \n";
    //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

            if ($control == "1"){

                // Inicializacion de los mensajes de error
                $rs_ins_error = FALSE;
                $rs_edit_error = FALSE;

                // Recepcion de variables del formulario
                $nfilas = $_POST['f']; // numero de filas
                $admd_adms = $_SESSION['admsid']; 	// identificador del usuario

                for ($i = 1; $i <= $nfilas; $i++) {
                //  while ($xdatos = $conec->cet_dbFetchObjet($datos_usuario)) {

                    $sche = "public";
                    $tabla = "tbla_admd";
                    $campos = "*";
                    $criterio = "admd_adms = '".$admd_adms."' AND admd_mdlo = '".$_POST['admd_mdlo'.$i]."' \n";
                    $orden = "";
                    $clausula = "";
                    $existe_registro = $conec->dbConsulta($sche, $tabla, $campos, $criterio, $orden, $clausula, $debug);
                    $rs_existe_registro = $conec->dbNumRows($existe_registro);		    

                    $admd_cons = (isset($_POST['admd_cons'.$i])) ? 1: 0;
                    $admd_insr = (isset($_POST['admd_insr'.$i])) ? 1: 0;
                    $admd_edit = (isset($_POST['admd_edit'.$i])) ? 1: 0;
                    $admd_elim = (isset($_POST['admd_elim'.$i])) ? 1: 0;

                    if ($rs_existe_registro == 0){  

                        $into = "admd_adms, admd_mdlo, admd_cons, admd_insr, admd_edit, admd_elim";
                        $values = "'".$_SESSION['admsid']."', '".$_POST['admd_mdlo'.$i]."', '".$admd_cons."', '".$admd_insr."', '".$admd_edit."', '".$admd_elim."'";

                        // Parametros ($sche, $tabla, $into, $values)
                        $rs_ins = $conec->dbInsertar("public", "tbla_admd", $into, $values, $debug);
                        if ($rs_ins != 1){
                            $rs_ins_error = TRUE;
                        }
                    }	

                    if ($rs_existe_registro != 0){ 

                        // actualizacion de registros
                        $sche = "public";
                        $tabla = "tbla_admd";
                        $set = "admd_adms = '$admd_adms', admd_mdlo = '".$_POST['admd_mdlo'.$i]."', admd_cons = '".$admd_cons."', admd_insr = '".$admd_insr."', admd_edit = '".$admd_edit."', admd_elim = '".$admd_elim."'";
                        $where = "id = ".$_POST['admd_id'.$i]."";
                        $rs_edit = $conec->dbEdicion($sche, $tabla, $set, $where, $debug);
                        if ($rs_edit != 1){
                            $rs_edit_error = TRUE;
                        }
                    }
                }	// fin del while
                $modal_title = "Asignaci&oacute;n de M&oacute;dulos";
                if ($rs_ins_error == FALSE && $rs_edit_error == FALSE) {
                    $modal_alert_type = "success";
                    $modal_config = "";
                    $modal_message = "Las modificaciones fueron realizadas con &eacute;xito";
                    ModalMessage($modal_title, $modal_alert_type, $modal_message, $modal_config);
                }
                else {
                    $modal_alert_type = "error";
                    $modal_config = "";
                    $modal_message = "Se presentaron errores mientras se efectuaban las modificaciones. Intente nuevamente";
                    ModalMessage($modal_title, $modal_alert_type, $modal_message, $modal_config);
                }

            } // fin del if
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

            echo "<div class=\"row\"> \n"              
                ."<div class=\"col-md-12\"> \n"

                ."<!-- BEGIN SAMPLE TABLE PORTLET--> \n"
                ."<div class=\"portlet box blue\"> \n"
                ."<div class=\"portlet-title\"> \n"
                ."<div class=\"caption\"> \n"
                ."<i class=\"fa fa-th-large\"></i> Asignaci&oacute;n de M&oacute;dulos \n"
                ."</div> \n"
                ."<div class=\"tools\"> \n"
                ."<a href=\"javascript:;\" class=\"collapse\"> </a> \n"
                ."<a href=\"#portlet-config\" data-toggle=\"modal\" class=\"config\"> </a> \n"
                ."<a href=\"javascript:;\" class=\"reload\"> </a> \n"
                ."<a href=\"javascript:;\" class=\"remove\"> </a> \n"
                ."</div> \n"
                ."</div> \n";

            // Inicio del cuerpo del formulario
            echo "<div class=\"portlet-body form\"> \n"
                ."<!-- BEGIN FORM--> \n";

            // Inicio del formulario
            echo "<form action=\"".$objetivo."\" method=\"POST\" enctype=\"multipart/form-data\" id=\"formID\"> \n";

            echo "<div class=\"form-body\"> \n"

                ."<div class=\"table-scrollable\"> \n"
                ."<table class=\"table table-bordered table-hover\"> \n"
                ."<thead> \n"
                ."<tr> \n"
                ."<th>Identificador</th> \n"
                ."<th>Icono</th> \n"
                ."<th>M&oacute;dulo</th> \n"
                ."<th>Consultar</th> \n"
                ."<th>Insertar</th> \n"
                ."<th>Editar</th> \n"
                ."<th>Eliminar</th> \n"
                ."</tr> \n"
                ."</thead> \n"
                ."<tbody> \n";

            $f = 0;    

            // Consulta de los modulos disponibles
            $sql_mdlo = "SELECT * FROM tbla_mdlo WHERE mdlo_estd = 1";
            $query_mdlo = $conec->dbQuery($sql_mdlo, $debug);

            while ($datos_mdlo = $conec->dbFetchObjet($query_mdlo)){

                // contador de las filas
                $f++; 

                $sql_chk = "SELECT * FROM tbla_admd WHERE admd_adms = '".$_SESSION['admsid']."' AND admd_mdlo = '".$datos_mdlo->id."'";
                $query_chk = $conec->dbQuery($sql_chk, $debug);
                $datos_chk = $conec->dbFetchObjet($query_chk);

                $chk_cons = (@$datos_chk->admd_cons == "1") ? "checked=\"checked\"" : ""; 
                $chk_insr = (@$datos_chk->admd_insr == "1") ? "checked=\"checked\"" : ""; 
                $chk_edit = (@$datos_chk->admd_edit == "1") ? "checked=\"checked\"" : ""; 
                $chk_elim = (@$datos_chk->admd_elim == "1") ? "checked=\"checked\"" : ""; 

                echo "<tr> \n"
                    ."<input type=\"hidden\" id=\"admd_mdlo\" name=\"admd_mdlo".$f."\" value=\"".$datos_mdlo->id."\"/> \n"
                    ."<input type=\"hidden\" id=\"admd_id\" name=\"admd_id".$f."\" value=\"".@$datos_chk->id."\"/> \n"
                    ."<td>".$datos_mdlo->mdlo_code."</td> \n"
                    ."<td><i class=\"fa ".$datos_mdlo->mdlo_icon."\"></i></td> \n"
                    ."<td>".$datos_mdlo->mdlo_nomb."</td> \n"
                    ."<td><input id=\"admd_cons".$f."\" name=\"admd_cons".$f."\" type=\"checkbox\"  value=\"1\" class=\"make-switch\" data-size=\"small\" data-on-color=\"warning\" ".$chk_cons."></td> \n"               
                    ."<td><input id=\"admd_insr".$f."\" name=\"admd_insr".$f."\" type=\"checkbox\"  value=\"".@$datos_chk->admd_insr."\" class=\"make-switch\" data-size=\"small\" data-on-color=\"success\" ".$chk_insr."></td> \n"
                    ."<td><input id=\"admd_edit".$f."\" name=\"admd_edit".$f."\" type=\"checkbox\"  value=\"".@$datos_chk->admd_edit."\" class=\"make-switch\" data-size=\"small\" data-on-color=\"primary\" ".$chk_edit."></td> \n"
                    ."<td><input id=\"admd_elim".$f."\" name=\"admd_elim".$f."\" type=\"checkbox\"  value=\"".@$datos_chk->admd_elim."\" class=\"make-switch\" data-size=\"small\" data-on-color=\"danger\" ".$chk_elim."></td> \n"
                    ."</tr> \n";
            }

            echo "</tbody> \n"
                ."</table> \n"
                ."</div><!-- /table-scrollable --> \n";

            echo "<input type=\"hidden\" id=\"control\" name=\"control\" value=\"1\"> \n"
                ."<input type=\"hidden\" id=\"op\" name=\"op\" value=\"admd\"> \n"
                ."<input type=\"hidden\" id=\"admsid\" name=\"admsid\" value=\"".$_SESSION['admsid']."\"> \n"
                ."<input type=\"hidden\" id=\"f\" name=\"f\" value=\"".$f."\"> \n";

             // Cierre del formulario
            echo "</div><!-- form-body --> \n";


            // Acciones del formulario 
            echo "<div class=\"form-actions\"> \n"
                ."<div class=\"row\"> \n"
                ."<div class=\"col-md-12\"> \n"
                ."<button type=\"submit\" class=\"btn blue\"><i class=\"fa fa-th-large\"></i> Enviar</button> \n"
                ."</div> \n"
                ."</div> \n"
                ."</div> \n";    

            echo "</form> \n"
                ."<!-- END FORM--> \n";

            echo "</div><!-- end portlet> \n";

            // Cierre del row y el col
            echo "</div> \n"
                ."</div> \n";
        }
        else {
            $modal_title = "Mensaje de Error";
            $modal_alert_type = "error";
            $modal_message = "No se ha definido ningun administrador";
            $modal_config = "";
            ModalMessage($modal_title, $modal_alert_type, $modal_message, $modal_config);
        }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    } // Fin de la validacion de la session
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    //Pie de pagina
    $sjs =  "";
    CommonFooter($path, $sjs, $config);
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

?>