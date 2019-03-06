<?php

    /****************************************/
    /* EliteTravel                          */
    /* Desarrollado por IT Labs             */
    /* www.it-labs.com.ve                   */
    /* info@it-labs.com.ve                  */
    /* Noviembre de 2015                    */
    /****************************************/

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            

    // Inicio de sesion
    session_start();
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Ubicación del archivo
    $path = "../";
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Inclusion de archivos necesarios
    require_once $path.'core/core.php';
    Core($path);
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
   
    // Seguridad
    Seguridad($path);
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
    // Control de errores
    $debug = DEBUG;

    // Crear la instancia y conectar a la BD
    $conec = new db();
    $conec->dbConexion(); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            

    // Objetivo para los formularios, los enlaces y las funciones
    $objetivo = basename($_SERVER['PHP_SELF']);
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    //Encabezado de la pagina
    $page_title = "Pagina de Prueba";
    $page_subtitle = "Prueba";
    $meta = "";
    $css = "";
    $js = "";
    $actions = array('nuevo_registro' => '', 'tabla_consulta' => '', 'panel_control' => '');
    $config = "";
    CommonHeader($path, $page_title, $page_subtitle, $meta, $css, $js, $objetivo, $actions, $config);
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Validacion de la session
    if (SessionValidate($path, "adms")){
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
     
        $db_name = $conec->db;

        $separador = "//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// \n\n";
        $separador_doble = "//========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================// \n\n";
        $t1 = "    "; 
        $t2 = "        ";
        $t3 = "            ";
        $t4 = "                ";
        $t5 = "                    ";

        // Fecha actual 
        $fecha_actual = date('d-n-Y');

        // Leer tablas de la base de datos
        $sql_tables = "SHOW FULL TABLES";
        $query_tables = $conec->dbQuery($sql_tables, $debug);
        
        // Inicializacion del menu
        $menu = "";

        while ($tables = $conec->dbFetchArray($query_tables)){

            // Leer campos de las tablas 
            //echo $tables['Tables_in_'.$db_name]."<br/>";
            $sql_cols = "SHOW FULL COLUMNS FROM ".$tables['Tables_in_'.$db_name];
            $query_cols = $conec->dbQuery($sql_cols, $debug);

            // Nombre de la tabla
            $table_name = $tables['Tables_in_'.$db_name];

            // Otros datos de la tabla
            $sql_od_table = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = '".$table_name."' and table_schema = '".$db_name."'";
            $query_od_table = $conec->dbQuery($sql_od_table, $debug);
            $datos_od_table = $conec->dbFetchArray($query_od_table);


            // Determinar el pk de la tabla
            $sql_pk = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'sag' AND TABLE_NAME = '".$table_name."' AND COLUMN_KEY = 'PRI'";
            $query_pk = $conec->dbQuery($sql_pk, $debug);
            $datos_pk = $conec->dbFetchArray($query_pk);
            $pk = $datos_pk['COLUMN_NAME'];

            $form = "";
            $list = "";

            while ($cols = $conec->dbFetchArray($query_cols)){

                // Bandera para los elementos
                $to_flag = FALSE;

                $dafault_null = (is_null($cols['Default'])) ? TRUE : FALSE;

                if ($cols['Extra'] != 'auto_increment'){    

                    // Determinar el tipo de datos
                    $varchar = ((stristr($cols['Type'], 'varchar')) === FALSE) ? FALSE : TRUE;
                    $bool = ((stristr($cols['Type'], 'tinyint(1)')) === FALSE) ? FALSE : TRUE;
                    $text = ((stristr($cols['Type'], 'text')) === FALSE) ? FALSE : TRUE;
                    $mediumtext = ((stristr($cols['Type'], 'mediumtext')) === FALSE) ? FALSE : TRUE;
                    $longtext = ((stristr($cols['Type'], 'longtext')) === FALSE) ? FALSE : TRUE;
                    $date = ((stristr($cols['Type'], 'date')) === FALSE) ? FALSE : TRUE;
                    $datetime= ((stristr($cols['Type'], 'datetime')) === FALSE) ? FALSE : TRUE;
                    $time = ((stristr($cols['Type'], 'time')) === FALSE) ? FALSE : TRUE;
                    $decimal = ((stristr($cols['Type'], 'decimal')) === FALSE) ? FALSE : TRUE;
                    $float = ((stristr($cols['Type'], 'float')) === FALSE) ? FALSE : TRUE;              


                    // si el campo es referencia de otra tabla (fk)

                    $sql_fk = "SELECT * FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_SCHEMA = '".$db_name."' AND COLUMN_NAME = '".$cols['Field']."'";
                    $query_fk = $conec->dbQuery($sql_fk, $debug);
                    $n_fk = $conec->dbNumRows($query_fk);

                    if ($n_fk == 1){
                        $datos_fk = $conec->dbFetchArray($query_fk);
                        $tipo_dato = "integer";
                        $tipo_objeto = "select";
                        $adicional = ", 'tabla' => '".$datos_fk['REFERENCED_TABLE_NAME']."', 'orden' => '".$datos_fk['REFERENCED_COLUMN_NAME']."', 'valor' => '".$datos_fk['REFERENCED_COLUMN_NAME']."', 'descripcion' => '".$datos_fk['REFERENCED_COLUMN_NAME']."'";
                        $formato = "normal";
                        $to_flag = TRUE;
                    }
                    elseif (($to_flag == FALSE) && ($varchar == TRUE)){
                        $tipo_dato = "cleartext";
                        $tipo_objeto = "input_text";
                        $adicional = "";
                        $formato = "normal";
                        $to_flag = TRUE;
                    }
                    elseif (($to_flag == FALSE) && ($bool == TRUE)){
                        $tipo_dato = "bool";
                        $tipo_objeto = "input_radio";
                        $adicional = ", 'opcion0' => 'Inactivo', 'opcion1' => 'Activo'";
                        $formato = "normal";
                        $to_flag = TRUE;
                    }
                    elseif (($to_flag == FALSE) && (($text == TRUE) OR ($mediumtext == TRUE) OR ($longtext == TRUE))){
                        $tipo_dato = "cleartext";
                        $tipo_objeto = "textarea";
                        $adicional = "";
                        $formato = "normal";
                        $to_flag = TRUE;
                    }
                    elseif (($to_flag == FALSE) && ($date == TRUE)){
                        $tipo_dato = "date";
                        $tipo_objeto = "input_date_picker";
                        $adicional = "";
                        $formato = "date";
                        $to_flag = TRUE;
                    }
                    elseif (($to_flag == FALSE) && ($datetime == TRUE)){
                        $tipo_dato = "datetime";
                        $tipo_objeto = "input_datetime_picker";
                        $adicional = "";
                        $formato = "datetime";
                        $to_flag = TRUE;
                    }
                    elseif (($to_flag == FALSE) && ($time == TRUE)){
                        $tipo_dato = "time";
                        $tipo_objeto = "input_time_picker";
                        $adicional = "";
                        $formato = "time";
                        $to_flag = TRUE;
                    }
                    elseif (($to_flag == FALSE) && ($decimal == TRUE)){
                        $tipo_dato = "decimal";
                        $tipo_objeto = "input_number";
                        $adicional = "";
                        $formato = "normal";
                        $to_flag = TRUE;
                    }
                    elseif (($to_flag == FALSE) && ($float == TRUE)){
                        $tipo_dato = "float";
                        $tipo_objeto = "input_number";
                        $adicional = "";
                        $formato = "normal";
                        $to_flag = TRUE;
                    }
                    else {
                        $adicional = "";
                    }

                    if ($dafault_null == TRUE){
                        $form .= $t3."array ('campo' => '".$cols['Field']."', 'nombre' => '".$cols['Comment']."', 'tipo_objeto' => '".$tipo_objeto."', 'tipo_dato' => '".$tipo_dato."'".$adicional."), \n";
                        echo "array ('campo' => '".$cols['Field']."', 'nombre' => '".$cols['Comment']."', 'tipo_objeto' => '".$tipo_objeto."', 'tipo_dato' => '".$tipo_dato."'".$adicional."), <br />";   
                    }

                    $list .= $t5."array('nombre' => '".$cols['Comment']."', 'width' => '', 'campo' => '".$cols['Field']."', 'formato' => '".$formato."'), \n";
                }
            }

            $content = "<?php \n"
                .$t1."/********************************************************/"."\n"
                .$t1."/* Administrador Web SmartNova"."\n"
                .$t1."/* CRUD - ".$table_name.""."\n"
                .$t1."/* ".$fecha_actual.""."\n"
                .$t1."/********************************************************/"."\n\n"

                .$separador

                ."\t"."// Inicio de sesion"."\n"
                .$t1."session_start(); "."\n"
                .$separador
                .$t1."// Ubicación del archivo "."\n"
                .$t1.'$path'." = \"../\"; "."\n"
                .$separador
                .$t1."// Inclusion de archivos necesarios "."\n"
                .$t1."require_once ".'$path'.".\"core/core.php\"; "."\n"
                .$t1.'Core($path);'."\n"
                .$separador
                .$t1."// Seguridad \n"
                .$t1.'Seguridad($path);'."\n"
                .$separador
                .$t1."// Objetivo para los formularios, los enlaces y las funciones \n"
                .$t1.'$objetivo = basename($_SERVER["PHP_SELF"]); '."\n"
                .$separador
                .$t1."//Encabezado de la pagina"."\n"
                .$t1.'$page_title = "'.$datos_od_table['TABLE_COMMENT'].'";'."\n"
                .$t1.'$page_subtitle = "Administrador";'."\n"
                .$t1.'$meta = "";'."\n"
                .$t1.'$css = "";'."\n"
                .$t1.'$js = "";'."\n"
                .$t1.'$actions'." = array('nuevo_registro' => '', 'tabla_consulta' => '', 'panel_control' => '');"."\n"
                .$t1.'$config = "";'."\n"
                .$t1.'CommonHeader($path, $page_title, $page_subtitle, $meta, $css, $js, $objetivo, $actions, $config);'."\n"
                .$separador
                .$t1."// Validacion de la session"."\n"
                .$t1.'if (SessionValidate($path, "adms")){'."\n"
                .$separador

                .$t2."// Recepcion  de variable de opcion por GET"."\n"
                .$t2.'$op = OptionGetPost($path);'."\n\n"

                .$t2.'$table'." = \"".$table_name."\";"."\n"
                .$t2.'$captcha ="off";'."\n"
                .$t2.'$config'."['datatable_title'] = \"".$table_name."\";"."\n"
                .$t2.'$title = "Gesti&oacute;n de Datos";'."\n"

                .$t2."// Datos del formulario"."\n"
                .$t2.'$form =  array('."\n"
                .$form
                .$t2.");"."\n\n"

                .$t2."// Switche para las opciones e lista, nuevo registro, eliminar, modificar, ver detalles"."\n"
                .$t2.'switch ($op) {'."\n"
                .$separador_doble

                .$t3."// Opcion de lista"."\n"
                .$t3.'case "listar":'."\n"

                .$t4.'$id_tabla = FALSE;'."\n"
                .$t4.'$sql = "SELECT * FROM '.$table_name.' ORDER BY '.$pk.' DESC";'."\n"
                .$t4.'$legend = $page_title;'."\n"
                .$t4.'$dt_acciones'." = array('editar' => '', 'eliminar' => '', 'auditoria' => '');"."\n" 

                .$t4.'$datatable = array(' ."\n" 
                .$list    

                .$t4.');'."\n"

                .$t4.'DataTable($path, $sql, $objetivo, $dt_acciones,  $datatable, $config);'."\n"

                .$t3."break;"."\n"
                .$separador_doble

                .$t3."// Opcion de insertar registros"."\n" 	
                .$t3.'case "insertar":'."\n\n" 

                .$t4.'if (isset($_POST["control"]) && ($_POST["control"] == 1)){'."\n"

                .$t5.'$criterio = "";'."\n"
                .$t5.'FormProcess($path, $op, $table, $criterio, $form, $captcha, $config);'."\n"
                .$t4.'}'."\n\n"

                .$t4.'FormShow($path, $op, $title, $objetivo, $form, $table, $captcha, $config);'."\n"
                .$t3.'break;'."\n"
                .$separador_doble

                .$t3."// Opcion de editar registros"."\n" 	
                .$t3.'case "editar":'."\n\n" 

                .$t4.'if (isset($_POST["control"]) && ($_POST["control"] == 1)){'."\n"

                .$t5.'$criterio = "";'."\n"
                .$t5.'FormProcess($path, $op, $table, $criterio, $form, $captcha, $config);'."\n"
                .$t4.'}'."\n\n"

                .$t4.'FormShow($path, $op, $title, $objetivo, $form, $table, $captcha, $config);'."\n"
                .$t3.'break;'."\n"
                .$separador_doble

                .$t3."// Opcion de eliminar registros"."\n"
                .$t3.'case "eliminar":'."\n"
                .$t4.'Eliminar($path, $objetivo, $table);'."\n"
                .$t3."break;"."\n"
                .$separador_doble    

                .$t2."} // Fin del switch "."\n"
                .$separador

                .$t1."} // Fin de la validacion de la session"."\n"
                .$separador
                .$t1."//Pie de pagina"."\n"
                .$t1.'$sjs = "";'."\n"
                .$t1.'CommonFooter($path, $sjs, $config);'."\n"
                .$separador
                .'?>';

                $file_name = strtolower(ReemAcuteChars(ReemHTMLChars($datos_od_table['TABLE_COMMENT']))).".php";
                $fp = fopen($path."prueba/adms_".$file_name, "w+");
                fwrite($fp, $content);
                fclose($fp);
                
            
            $menu .=  $t3.'."<li class=\"nav-item start \"> \n"'."\n"
                .$t3.'."<a href=\"javascript:;\" class=\"nav-link nav-toggle\"> \n"'."\n"
                .$t3.'."<i class=\"icon-home\"></i> \n"'."\n"
                .$t3.'."<span class=\"title\">'.$datos_od_table["TABLE_COMMENT"].'</span> \n"'."\n"
                .$t3.'."<span class=\"arrow\"></span> \n"'."\n"
                .$t3.'."</a> \n"'."\n"
                
                .$t3.'."<ul class=\"sub-menu\"> \n"'."\n"

                .$t3.'."<li class=\"nav-item start \"> \n"'."\n"
                .$t3.'."<a href=\"".$path."app/adms/'.$file_name.'\" class=\"nav-link \"> \n"'."\n"
                .$t3.'."<i class=\"fa fa-table\"></i> \n"'."\n"
                .$t3.'."<span class=\"title\">Consulta de datos</span> \n"'."\n"
                .$t3.'."</a> \n"'."\n"
                .$t3.'."</li> \n"'."\n"

                .$t3.'."<li class=\"nav-item start \"> \n"'."\n"
                .$t3.'."<a href=\"".$path."app/adms/'.$file_name.'?op=insertar\" class=\"nav-link \"> \n"'."\n"
                .$t3.'."<i class=\"fa fa-plus\"></i> \n"'."\n"
                .$t3.'."<span class=\"title\">Agregar Registros</span> \n"'."\n"
                .$t3.'."</a> \n"'."\n"
                .$t3.'."</li> \n"'."\n"

                .$t3.'."</ul> \n"'."\n"
                .$t3.'."</li> \n"'."\n"
                .$separador;
            
            echo "<hr>";
        }
        
        $content_menu .= "<?php \n"
            .$t1."/********************************************************/"."\n"
            .$t1."/* Administrador Web SmartNova"."\n"
            .$t1."/* Menu \n"
            .$t1."/* ".$fecha_actual.""."\n"
            .$t1."/********************************************************/"."\n\n"

            .$separador

            .$t1.'function Menu($path){'."\n\n"

            .$t2.'$menu = "<!-- BEGIN SIDEBAR MENU --> \n"'."\n"
            .$t3.'."<ul class=\"page-sidebar-menu  page-header-fixed \" data-keep-expanded=\"false\" data-auto-scroll=\"true\" data-slide-speed=\"200\" style=\"padding-top: 20px\"> \n"'."\n"

            .$t3.'."<li class=\"sidebar-toggler-wrapper hide\"> \n"'."\n"
            .$t3.'."<!-- BEGIN SIDEBAR TOGGLER BUTTON --> \n"'."\n"
            .$t3.'."<div class=\"sidebar-toggler\"> </div> \n"'."\n"
            .$t3.'."<!-- END SIDEBAR TOGGLER BUTTON --> \n"'."\n"
            .$t3.'."</li> \n"'."\n"

            .$t3.'//."<li class=\"sidebar-search-wrapper\"> \n"'."\n"
            .$t3.'//."<!-- BEGIN RESPONSIVE QUICK SEARCH FORM --> \n"'."\n"
            .$t3.'//."<form class=\"sidebar-search  \" action=\"page_general_search_3.html\" method=\"POST\"> \n"'."\n"
            .$t3.'//."<a href=\"javascript:;\" class=\"remove\"> \n"'."\n"
            .$t3.'//."<i class=\"icon-close\"></i> \n"'."\n"
            .$t3.'//."</a> \n"'."\n"
            .$t3.'//."<div class=\"input-group\"> \n"'."\n"
            .$t3.'//."<input type=\"text\" class=\"form-control\" placeholder=\"Search...\"> \n"'."\n"
            .$t3.'//."<span class=\"input-group-btn\"> \n"'."\n"
            .$t3.'//."<a href=\"javascript:;\" class=\"btn submit\"> \n"'."\n"
            .$t3.'//."<i class=\"icon-magnifier\"></i> \n"'."\n"
            .$t3.'//."</a> \n"'."\n"
            .$t3.'//."</span> \n"'."\n"
            .$t3.'//."</div> \n"'."\n"
            .$t3.'//."</form> \n"'."\n"
            .$t3.'//."<!-- END RESPONSIVE QUICK SEARCH FORM --> \n"'."\n"
            .$t3.'//."</li> \n"'."\n"
        
            .$menu
        
            .$t3.'."</ul> \n"'."\n"
            .$t3.'."</li> \n"'."\n"
            .$t3.'."<li class=\"heading\"> \n"'."\n"
            .$t3.'."<h3 class=\"uppercase\">Features</h3> \n"'."\n"
            .$t3.'."</li> \n"'."\n"

            .$t3.'."</ul> \n"'."\n"
            .$t3.'."<!-- END SIDEBAR MENU --> \n";'."\n"
            .$t2.'return $menu;'."\n"
            .$t1.'}'."\n"
            .$separador
            .'?>';
        
        $file_menu_name = "menu.php";
        $fp = fopen($path."prueba/".$file_menu_name, "w+");
        fwrite($fp, $content_menu);
        fclose($fp);
        
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
     
    }   // Fin de la validacion de la session
      
    //Pie de pagina
    $sjs = "";
    CommonFooter($path, $sjs, $config);
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
?>