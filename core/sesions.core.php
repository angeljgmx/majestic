<?php

    /********************************************************/
    /* Administrador Web SmartNova                            */
    /* Gestion de Sesiones                                  */
    /* Junio de 2016                                        */
    /********************************************************/

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    function SessionValidate($path, $tipo) {
        
        // inclusion de las funciones de bases de datos
        require_once $path."core/db.class.core.php";
        require_once $path."includes/config.inc.php";
        
        $debug = DEBUG;
        
        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion();
                         
        // Comprobacion del registro de la session del usuario
        $sql = "SELECT * FROM tbla_sson WHERE (id = '".@$_SESSION['sson_id']."' AND  sson_tipo = '".@$_SESSION['sson_tipo']."' AND sson_tokn = '".@$_SESSION['tokn']."' AND  sson_agnt = '".@$_SESSION['sson_agnt']."' AND sson_dcip = '".@$_SESSION['sson_dcip']."')";
        $query = $conec->dbQuery($sql, $debug);
        $registro = $conec->dbFetchObjet($query);
        $rs_existe_registro = $conec->dbNumRows($registro);
        
        if (($rs_existe_registro == 1) AND ($registro->sson_tipo == $tipo)){
            $session_validate = TRUE;
            
            // Calculamos el tiempo transcurrido
            $fecha_hora_inicio = $_SESSION['sson_ufch']; 
            $ahora = date("Y-n-j H:i:s"); 
            $tiempo_transcurrido = (strtotime($ahora)-strtotime($fecha_hora_inicio));
                
            //comparacion del tiempo transcurrido 
            if($tiempo_transcurrido >= 8000) { 
               // echo $tiempo_transcurrido;
                session_unset();
                session_destroy();
                echo "<script type=\"text/javascript\">window.location=\"".$path."app/index.php\"</script> \n";
                
            //sino, actualizo la fecha de la sesión 
                }
            else {
                    $_SESSION['sson_ufch'] = $ahora; 
            }
            return $session_validate;
        }
        else{
            $session_validate = FALSE;
            session_unset();
            session_destroy();
            echo "<script type=\"text/javascript\">window.location=\"".$path."app/index.php\"</script> \n";

        }       
    }
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    function SessionValidateUser($path, $tipo) {
        
        // inclusion de las funciones de bases de datos
        require_once $path."core/db.class.core.php";
        require_once $path."includes/config.inc.php";
        
        $debug = DEBUG;
        
        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion();
                         
        // Comprobacion del registro de la session del usuario
        $sql = "SELECT * FROM tbla_sson WHERE (id = '".@$_SESSION['sson_id']."' AND  sson_tipo = '".@$_SESSION['sson_tipo']."' AND sson_tokn = '".@$_SESSION['tokn']."')";
        $query = $conec->dbQuery($sql, $debug);
        $registro = $conec->dbFetchObjet($query);
        $rs_existe_registro = $conec->dbNumRows($registro);
        
        if (($rs_existe_registro == 1) AND ($registro->sson_tipo == $tipo)){
            $session_validate = TRUE;
            
            // Calculamos el tiempo transcurrido
            $fecha_hora_inicio = $_SESSION['sson_ufch']; 
            $ahora = date("Y-n-j H:i:s"); 
            $tiempo_transcurrido = (strtotime($ahora)-strtotime($fecha_hora_inicio));
                
            //comparacion del tiempo transcurrido 
            if($tiempo_transcurrido >= 98000) { 
               // echo $tiempo_transcurrido;
                session_unset();
                session_destroy();
                echo "<script type=\"text/javascript\">window.location=\"".$path."app/index.php\"</script> \n";
                
            //sino, actualizo la fecha de la sesión 
                }
            else {
                    $_SESSION['sson_ufch'] = $ahora; 
            }
            return $session_validate;
        }
        else{
            $session_validate = FALSE;
            session_unset();
            session_destroy();
            echo "<script type=\"text/javascript\">window.location=\"".$path."app/index.php\"</script> \n";

        }       
    }