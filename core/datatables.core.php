<?php

    /********************************************************/
    /* Administrador Web SmartNova                            */
    /* Formularios                                          */
    /* Junio de 2016                                        */
    /********************************************************/

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    function DataTable($path, $sql, $objetivo, $acciones,  $datatable, $config){
        
        // Inclusion de archivos necesarios
        require_once $path.'core/db.class.core.php';
        require_once $path.'includes/config.inc.php';
        
        // Control de errores
        $debug = DEBUG;
        
        // Directorio actual
        $basedir = basename(getcwd());
        
        // Si exite un mensaje definido
        if (isset($_GET['tipo']) && isset($_GET['mnsj'])){
            Mensaje($_GET['tipo'], $_GET['mnsj']);
        }

//        // Prefijo de la tabla
//        $tabla_pref = substr($tabla , -4);
        
        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion(); 
               
        // Preferencias Generales
        $sql_pref = "SELECT pref_flgs FROM tbla_pref WHERE id = 1";
        $query_pref = $conec->dbQuery($sql_pref, $debug);
        $datos_pref = $conec->dbFetchObjet($query_pref);
        
        // Consulta de la tabla
        $query = $conec->dbQuery($sql, $debug);
        
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

        // Inicio de la seccion de la tabla
        echo "<div class=\"row\"> \n"
            ."<div class=\"col-md-12\"> \n";
        
        // Icono de la tabla
        $datatable_icon = (isset($config['datatable_icon'])) ? $config['datatable_icon'] : 'fa fa-th-list';
        
        // Tipo de portled
        $datatable_portled = (isset($config['datatable_portled'])) ? $config['datatable_portled'] : 'box_color';

        // Decision del tipo de portled       
        if ($datatable_portled == "light"){
        
            echo "<!-- BEGIN EXAMPLE TABLE PORTLET--> \n"
                ."<div class=\"portlet light bordered\"> \n"
                ."<div class=\"portlet-title\"> \n"
                ."<div class=\"caption font-dark\"> \n";
       
            // Titulo de la tabla
            echo "<i class=\"".$datatable_icon." font-dark\"></i> \n"
                ."<span class=\"caption-subject bold uppercase\">&nbsp;".$config['title']."</span> \n"
                ."</div> \n"
                ."<div class=\"tools\"></div> \n"
                ."</div> \n"
                ."<div class=\"portlet-body\"> \n"

            // Table
                ."<table class=\"table table-striped table-bordered table-hover\" id=\"sample_1\"> \n";
        }
        
        if ($datatable_portled == "box_color"){
            
            // Color del portled
            $datatable_portled_color = (isset($config['datatable_portled_color'])) ? $config['datatable_portled_color'] : 'green';
        
            echo "<!-- BEGIN EXAMPLE TABLE PORTLET--> \n"
                ."<div class=\"portlet box ".$datatable_portled_color."\"> \n"
                ."<div class=\"portlet-title\"> \n"
                ."<div class=\"caption\"> \n"
                ."<i class=\"fa fa-globe".$datatable_icon."\"></i>&nbsp;".$config['datatable_title']." ";
            if ((isset($config['datatable_portled_subtitle'])) && ($config['datatable_portled_subtitle'] != "")){
                echo "<small class=\"\">".$config['datatable_portled_subtitle']."</small> \n"; 
            }
            echo "</div> \n"
                ."<div class=\"tools\"> </div> \n"
                ."</div> \n"
                ."<div class=\"portlet-body\"> \n"
                ."<table class=\"table table-striped table-bordered table-hover\" id=\"sample_2\"> \n";
        }

        // Cabecera de la tabla
        echo "<thead> \n"
            ."<tr> \n";
              
        if ((isset($config['id_tabla'])) && ($config['id_tabla'] == "on")){
            // Id de los registros
            echo  "<th width=\"20\">Id</th> \n";
        }
         
        if ((!isset($config['acciones'])) || ($config['acciones'] != 'off')){
            echo "<th width=\"160\">Acciones</th> \n";
        }

        // Campos editables para la cabecera de la tabla
            
        foreach($datatable as $item){
            echo "<th width=\"".$item['width']."\"> ".$item['nombre']."</th> \n";              
        }

        echo "</thead> \n";
        
        // cuerpo de la tabla
        echo "<tbody> \n";
        
        // Bandera para la opcion eliminar
        $b_eliminar = FALSE;
        
        // ciclo para mostrar los registros
        while ($rs_datos = $conec->dbFetchArray($query)){

            if ((isset($config['id_tabla'])) && ($config['id_tabla'] == "on")){
                // Id de los registros
                echo "<td>".$rs_datos['id']."</td> \n ";
            }
           
            // Celda de acciones
            if ((!isset($config['acciones'])) || ($config['acciones'] != 'off')){
                echo "<td id=\"datatable_dp_acciones\"> \n";

                // Ciclo para mostrar las acciones
                foreach ($acciones as $accion => $accion_valor) {

                    $datatable_actions_path = (isset($config['datatable_actions_path'])) ? $config['datatable_actions_path'] : $path; 

                    switch ($accion) {
                        case ("editar"):
                            
                            $sql_edit = "SELECT admd_adms, admd_mdlo, admd_edit, tbla_mdlo.id, mdlo_code "
                                ."FROM tbla_admd "
                                ."INNER JOIN tbla_mdlo ON (tbla_mdlo.id = admd_mdlo) "
                                ."WHERE (admd_adms = '".$_SESSION['sson_idpr']."') AND (mdlo_code = '".$_SESSION['mdlo_code']."')";
                            $query_edit = $conec->dbQuery($sql_edit, $debug);
                            $datos_edit = $conec->dbFetchObjet($query_edit);
                            
                            if ($datos_edit->admd_edit == 1){ 
                                echo "<a class=\"label label-sm label-success datatable_action\" href=\"".$datatable_actions_path .$basedir."/".$objetivo."?op=editar&id=".$rs_datos['id']."\" title=\"Editar\"> \n"
                                    ."<i class=\"fa fa-pencil\"></i> \n"
                                    ."Editar \n" 
                                    ."</a> \n";   
                            }
                        break;

                        case ("eliminar"):
                            //echo "<a class=\"label label-sm label-danger\" data-href=\"".$path.$basedir."/".$objetivo."?op=eliminar&id=".$rs_datos['id']."\" href=\"".$path.$basedir."/".$objetivo."?op=eliminar&id=".$rs_datos['id']."\" title=\" Eliminar\" onclick=\"return confirmar('¿Está seguro que desea eliminar el registro?')\"> \n"
                            $sql_elim = "SELECT admd_adms, admd_mdlo, admd_elim, tbla_mdlo.id, mdlo_code "
                                ."FROM tbla_admd "
                                ."INNER JOIN tbla_mdlo ON (tbla_mdlo.id = admd_mdlo) "
                                ."WHERE (admd_adms = '".$_SESSION['sson_idpr']."') AND (mdlo_code = '".$_SESSION['mdlo_code']."')";
                            $query_elim = $conec->dbQuery($sql_elim, $debug);
                            $datos_elim = $conec->dbFetchObjet($query_elim);
                            
                            if ($datos_elim->admd_elim == 1){ 
                                echo "<a class=\"label label-sm label-danger datatable_action\" data-href=\"".$datatable_actions_path .$basedir."/".$objetivo."?op=eliminar&id=".$rs_datos['id']."\" href=\"#\" title=\" Eliminar\" data-toggle=\"modal\" data-target=\"#confirm-delete\" > \n"
                                    ."<i class=\"fa fa-minus-circle\"></i> \n"
                                    ."Eliminar \n" 
                                    ."</a> \n"; 
                                    $b_eliminar = TRUE;
                            }
                        break;

                        case ("auditoria"):
                            if (isset($rs_datos['id']) && ($rs_datos['id'] != "")){
                                //HistorialRegistro($path, $tabla, $rs_datos['id']);
                            }   
                        break;
                        
                        case ("tabla_detalle"):
                            if (isset($rs_datos['id']) && ($rs_datos['id'] != "")){
                                
                               //TablaDetalle($path, $accion_valor['titulo_modal'], $accion_valor['sql_td'], $accion_valor['post_where'], $accion_valor['tabla_detalle'], $rs_datos['id'], $accion_valor['table_width']);
                               DetalleRegistro($path, $accion_valor['titulo_modal'], $accion_valor['sql_td'], $accion_valor['post_where'], $accion_valor['tabla_detalle'], $rs_datos['id'], $accion_valor['table_width']);                               
                            }  
                        break;

                        case ("modulos"):
                            echo "<a class=\"label label-sm bg-yellow-gold bg-font-yellow-gold datatable_action\" href=\"".$datatable_actions_path."adms/".$accion_valor."?admsid=".$rs_datos['id']."\" title=\"M&oacute;dulos\"> \n"
                                ."<i class=\"fa fa-th-large\"></i> \n"
                                ."M&oacute;dulos \n" 
                                ."</a> \n";         
                        break;
                    
                        case ("imprimir"):
                            echo "<a id=\"datatable_print_link\" href=\"".$path.$accion_valor['ruta']."?id=".$rs_datos['id']."\" title=\"Imprimir\" target=\"_blank\"> \n"
                                ."Imprimir \n" 
                                ."</a> \n";
                        break;
                    
                        case ("pdf"):
                            echo "<a id=\"datatable_pdf_file_link\" href=\"".$path.$accion_valor['ruta']."?id=".$rs_datos['id']."\" title=\"Archivo PDF\" target=\"_blank\"> \n"
                                ."PDF \n" 
                                ."</a> \n";
                        break;
                    
                        case ("ponentes"):
                            echo "<a class=\"label label-sm bg-blue-steel bg-font-blue-steel datatable_action\" href=\"".$path.$accion_valor['ruta']."?evnt_id=".$rs_datos['id']."\" title=\"Ponentes\" target=\"_blank\"> \n"
                                ."<i class=\"fa fa-users\"></i> \n"
                                ."Ponentes \n" 
                                ."</a> \n";
                        break;
                    
                        case ("ponencias"):
                            echo "<a class=\"label label-sm bg-yellow-crusta bg-font-yellow-crusta datatable_action\" href=\"".$path.$accion_valor['ruta']."?evnt_id=".$rs_datos['id']."\" title=\"Ponentes\" target=\"_blank\"> \n"
                                ."<i class=\"fa fa-graduation-cap\"></i> \n"
                                ."Ponencias \n" 
                                ."</a> \n";
                        break;
                    }
                } 
            }
                    
            // Cierre de la celda de acciones        
            echo "</td> \n";

            // Otros campos de la tabla
            foreach ($datatable as $elemento => $valor){

                // Resaltar Nuevo Regsitro
                if ((isset($config['nuevo_campo_mostrar'])) && (isset($config['nuevo_campo_consultar'])) && ($rs_datos[$config['nuevo_campo_consultar']] == 1) && ($config['nuevo_campo_mostrar'] == $valor['campo'] )){
                    $nuevo = "<span id=\"illuminate\" class=\"label-sm bgcolor_yellow\">Nuevo</span> \n";                     
                }
                else {
                        $nuevo = "";
                }
                
                //echo $valor['formato']." \n";

                // Tratamiento de los datos
                switch ($valor['formato']) {
                    
                    case "admin":
                        $sql_admin = "SELECT * FROM tbla_adms WHERE id = '".$rs_datos[$valor['campo']]."'";
                        $query_admin = $conec->dbQuery($sql_admin, $debug);
                        $datos_admin = $conec->dbFetchObjet($query_admin);
                         
                        echo "<td>".$datos_admin->adms_nomb." ".$datos_admin->adms_apll."</td> \n";
                    break;
                    
                    case "normal":
                        echo "<td>".$rs_datos[$valor['campo']].$nuevo."</td> \n";
                    break;
                
                    case "concatenado":
                        echo "<td>".$valor['texto'].$rs_datos[$valor['campo']].$nuevo."</td> \n";
                    break;
                
                    case "sexo":

                        if ($rs_datos[$valor['campo']] == "M"){
                            $rs_datos[$valor['campo']] = "Masculino";
                        }    
                        else{
                            $rs_datos[$valor['campo']] = "Femenino";
                        }
                        echo "<td>".$rs_datos[$valor['campo']].$nuevo."</td> \n";
                    break;
                    
                    case "cuadro_color":
                        $sql_color = "SELECT * FROM tbla_colr WHERE id = '".$rs_datos[$valor['campo']]."'";
                        $query_color = $conec->dbQuery($sql_color, $debug);
                        $datos_color = $conec->dbFetchObjet($query_color);
                        echo "<td><a class=\"button btn-mini ".$datos_color->colr_scss." estatus\" title=\"".$datos_color->colr_nomb."\">&nbsp;</a></td> \n";
                        
                        //echo "<td>".$rs_datos[$valor['campo']]." <div style=\"background-color: ".$rs_datos[$valor['campo']]."; width: 20px; float: right;\">&nbsp;</div>".$nuevo."</td> \n";
                    break;
                
                    case "color":
                        $sql_color = "SELECT * FROM tbla_colr WHERE colr_html = '".$rs_datos[$valor['campo']]."'";
                        $query_color = $conec->dbQuery($sql_color, $debug);
                        $datos_color = $conec->dbFetchObjet($query_color);
                        echo "<td><label class=\"btn\" style=\"background-color: ".$datos_color->colr_html.";\">".$datos_color->colr_nomb."</label></td> \n";
                        
                        //echo "<td>".$rs_datos[$valor['campo']]." <div style=\"background-color: ".$rs_datos[$valor['campo']]."; width: 20px; float: right;\">&nbsp;</div>".$nuevo."</td> \n";
                    break; 
                
                    case "crud":
                        
                        switch ($rs_datos[$valor['campo']]){
                            case "I":
                                $crud = "Insertar";
                            break;
                            case "E":
                                $crud = "Editar";
                            break;
                            case "D":
                                $crud = "Eliminar";
                            break;
                        }
                        
                        echo "<td>".$crud."</td> \n";
                    break;
                
                    case "date":
                        echo "<td>".date("d\-m\-Y", strtotime($rs_datos[$valor['campo']])).$nuevo."</td> \n";
                    break;
                
                    case "time":
                        echo "<td>".date("h\:i\ a", strtotime($rs_datos[$valor['campo']])).$nuevo."</td> \n";
                    break;
                
                    case "datetime":
                        echo "<td>".date("d\-m\-Y / h\:i\ a", strtotime($rs_datos[$valor['campo']])).$nuevo."</td> \n";
                    break;
                                
                    case "imagen":
                        echo "<td> \n";
                        $imagen = $path."uploads/".$valor['folder']."/".$rs_datos[$valor['campo']];
                        if (file_exists($imagen)){
                            echo "<img id=\"datatable_img\" src=\"".$path."thumbs/".$valor['folder'].$rs_datos[$valor['campo']]."\" alt=\"".$rs_datos[$valor['campo']]."\" title=\"".$rs_datos[$valor['campo']]."\"> \n";
                        }
                        else {
                            echo "<img id=\"datatable_img\" src=\"".$path."assets/global/plugins/responsive-filemanager/filemanager/img/ico/quest.jpg\" title=\"".$rs_datos[$valor['campo']]."\"> \n";
                        }
                        echo $nuevo."</td> \n";
                    break;
                    
                     case "qrcode":
                        echo "<td> \n";
                        $imagen = $path."qrcode/".$rs_datos[$valor['campo']].".png";
                        if (file_exists($imagen)){
                            echo "<img width=\"150\" id=\"datatable_img\" src=\"".$imagen."\" alt=\"".$rs_datos[$valor['campo']]."\" title=\"".$rs_datos[$valor['campo']]."\"> \n";
                        }
                        else {
                            echo "<img width=\"150\" id=\"datatable_img\" src=\"".$path."assets/global/plugins/responsive-filemanager/filemanager/img/ico/quest.jpg\" title=\"".$rs_datos[$valor['campo']]."\"> \n";
                        }
                        echo $nuevo."</td> \n";
                    break;
                
                    case "icono":
                        echo "<td> \n"
                            ."<img id=\"datatable_img\" src=\"".$path.$valor['folder'].$rs_datos[$valor['campo']]."\" alt=\"".$rs_datos[$valor['campo']]."\" title=\"".$rs_datos[$valor['campo']]."\"> \n"
                            .$nuevo."</td> \n";
                    break;
                
                    case "fontawesome":
                        echo "<td class=\"icon_font data_table_td_iconfont\"> \n"
                            ."<i class=\"fa ".$rs_datos[$valor['campo']]."\"></i> \n"
                            .$nuevo."</td> \n";
                    break;
                
                    case "iconfont":
                        echo "<td class=\"icon_font data_flaticon\"> \n"
                            ."<i class=\"".$rs_datos[$valor['campo']]."\"></i> \n"
                            .$nuevo."</td> \n";
                    break;
                
                    case "pdf":
                        echo "<td> \n"
                            ."<a href=\"".$path."uploads/".$valor['folder'].$rs_datos[$valor['campo']]."\" alt=\"".$rs_datos[$valor['campo']]."\" > \n"                          
                            //."<img id=\"datatable_img\" src=\"".$path."img/icons/64x64/pdf_file.png\" alt=\"".$rs_datos[$valor['campo']]."\" title=\"".$rs_datos[$valor['campo']]."\"> \n"
                            ."<span class=\"icon-file-pdf\"> ".$rs_datos[$valor['campo']]."</span> \n"
                            ."</a> \n"
                            .$nuevo."</td> \n";
                    break;
                               
                    case "short":
                        if (strlen($rs_datos[$valor['campo']]) >= 150){
                            echo "<td>".substr($rs_datos[$valor['campo']],0,strrpos(substr($rs_datos[$valor['campo']],0,150)," "))." ...".$nuevo."</td> \n";
                        }
                        else {
                            echo "<td>".$rs_datos[$valor['campo']].$nuevo."</td> \n";
                        }
                    break;
                    
                    case "bool":
                        echo "<td> \n";
                        if ($rs_datos[$valor['campo']] == 1){
                            echo "s&iacute;";
                        }
                        else {
                            echo "no";
                        }
                        echo "</td> \n";
                    break;
                    
                    case "radio":
                        echo "<td> \n";
                        if ($rs_datos[$valor['campo']] == 1){
                            echo $valor['opcion1'];
                        }
                        else {
                            echo $valor['opcion0'];
                        }
                        echo "</td> \n";
                    break;
                    
                    case "estatus":

                        $sql_estatus = "SELECT tbla_rsts.id AS rsts_id, rsts_nomb, rsts_colr, tbla_colr.id, colr_scss FROM tbla_rsts INNER JOIN tbla_colr ON (rsts_colr = tbla_colr.id) WHERE tbla_rsts.id = '".$rs_datos[$valor['campo']]."'";
                        $query_estatus = $conec->dbQuery($sql_estatus, $debug);
                        $datos_estatus = $conec->dbFetchObjet($query_estatus);
                        echo "<td><a class=\"button btn-mini ".$datos_estatus->colr_scss." estatus\">".$datos_estatus->rsts_nomb."</a></td> \n";
                        
                    break;
                
                    case "pais":
                        echo "<td align=\"left\" width=\"120\"> \n"; 
                        
                        // Consulta
                        $sql_pais = "SELECT * FROM tbla_pais WHERE id = '".$rs_datos[$valor['campo']]."'";
                        $query_pais = $conec->dbQuery($sql_pais, $debug);
                        $datos_pais = $conec->dbFetchObjet($query_pais);
                            
                        echo "<img class=\"icon\" src=\"".$path."assets/global/img/icons/flags-iso/".$datos_pref->pref_flgs."/32/".$datos_pais->pais_iso2.".png\" />&nbsp; \n";
                        echo "<label class=\"btn-mini\">".$datos_pais->pais_nomb."</label> \n";
                        echo "</td> \n";
                    break;
                }   
            }
            
            // Final de la fila
            echo "</tr> \n";
            
        } // Fin del ciclo que muestra los registros
            
        echo "</tbody> \n"
            ."</table> \n"
            ."</div> \n"
            ."</div> \n"
            ."<!-- END EXAMPLE TABLE PORTLET--> \n";  
        
        echo "</div> \n"
            ."</div> \n";
        
        if ($b_eliminar == TRUE) {
            ModalConfirmDelete();
        }
        
        
    }
//==========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================//

    function Eliminar($path, $objetivo, $tabla){
        
        // Inclusion de archivos necesarios         
        require_once $path.'core/db.class.core.php';
        require_once $path.'includes/config.inc.php';

        $debug = DEBUG;

        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion();
            
        // Captura del id del registro a eliminar
        $id = $_GET['id'];
        $sche = "";
        $criterio = "id = '".$id."'";
        $tabla;
        $rs_elim = $conec->dbEliminar($sche, $tabla, $criterio, $debug);        
        $resultado = $rs_elim;
        
        // Insertamos registro en la tabla de auditoria
        if (( $resultado == 1) && ($tabla != "tbla_sson") && ($tabla != "tbla_ssna")){

            // Usuario de sesion
            if (isset($_SESSION)){
                $sson_user = $_SESSION['sson_idpr'];
            }
            else{
                $sson_user = 0;
            }

            // recuperacion del ultimo
            $into_audt = "audt_tabl, audt_idrg, audt_adms, audt_oprc";
            $values_audt = "'".$tabla."', '".$id."', '".$sson_user."', 'D'";

            // query de la insercion
            $qaudi = "INSERT INTO ".$conec->audt." (".$into_audt.") VALUES (".$values_audt.")";
            $conec->dbQuery($qaudi, $debug);
        }
        
        if ($rs_elim == 1) {
            $tipo = "success";
                      
            }
        else {
            $tipo = "error";
            }
        $operacion = "eliminar";
        
        $url_relativa = $objetivo."?op=listar&opc=".$operacion."&tipo=".$tipo;
        echo "<script type=\"text/javascript\">window.location=\"$url_relativa\"</script> \n";
    }
//==========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================//

