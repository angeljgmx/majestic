<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//--------------------------------------------------------------------------------------------------------------------------------------//

// Comprobar reserva
    function ComprobarReserva($path, $user, $evnt){
       
        // Librerias requeridas
        require_once $path.'app/includes/core.app.php';
        CoreApp($path);
        require_once $path.'includes/config.inc.php';

        // Control de errores
        $debug = DEBUG; 

        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion(); 
        
        // Consulta de la reserva
        $sql_rsrv = "SELECT tbla_rsrv.id AS rsrv_id, rsrv_mesa, rsrv_evnt, rsrv_user, rsrv_estd, "
            ."tbla_mesa.id AS mesa_id, mesa_mstp, mesa_nmro, mesa_cpcd, mesa_cori, mesa_corj, mesa_msvp, mesa_estd, "
            ."tbla_mstp.id AS mstp_id, mstp_nomb, mstp_icon, "
            ."tbla_msvp.id AS msvp_id, msvp_nomb, "
            ."tbla_user.id AS user_id, user_nomb, user_nom2, user_apll, user_apl2, user_ndni, user_sexo, user_tlef, "
            ."tbla_evnt.id AS evnt_id, evnt_ttlo, evnt_fech, evnt_imgn "
            ."FROM tbla_rsrv "
            ."INNER JOIN tbla_mesa ON (tbla_mesa.id = rsrv_mesa) "
            ."INNER JOIN tbla_mstp ON (tbla_mstp.id = mesa_mstp) "
            ."INNER JOIN tbla_msvp ON (tbla_msvp.id = mesa_msvp) "
            ."INNER JOIN tbla_user ON (tbla_user.id = rsrv_user) "
            ."INNER JOIN tbla_evnt ON (tbla_evnt.id = rsrv_evnt) "
                ."WHERE (rsrv_user = ".$user.") AND (tbla_evnt.id = ".$evnt.") AND (evnt_estd = 1) AND (rsrv_estd = 1)";
        $query_rsrv = $conec->dbQuery($sql_rsrv, $debug);
        $nrsrv = $conec->dbNumRows($query_rsrv);
        
        if ($nrsrv > 0){
            $datos_rsrv = $conec->dbFetchObjet($query_rsrv);
            $rsrv['rsrv_id'] = $datos_rsrv->rsrv_id;
            $rsrv['rsrv_user'] = $datos_rsrv->rsrv_user;
            $rsrv['rsrv_evnt'] = $datos_rsrv->rsrv_evnt;
            $rsrv['rsrv_mesa'] = $datos_rsrv->rsrv_mesa;
            $rsrv['rsrv_estd'] = TRUE;
            $rsrv['mesa_nmro'] = $datos_rsrv->mesa_nmro;
            $rsrv['mesa_cpcd'] = $datos_rsrv->mesa_cpcd;
            $rsrv['mstp_nomb'] = $datos_rsrv->mstp_nomb;
            $rsrv['mstp_icon'] = $datos_rsrv->mstp_icon;
            $rsrv['msvp_nomb'] = $datos_rsrv->msvp_nomb;
            $rsrv['user_nomb'] = $datos_rsrv->user_nomb;
            $rsrv['user_nom2'] = $datos_rsrv->user_nom2;
            $rsrv['user_apll'] = $datos_rsrv->user_apll;
            $rsrv['user_apl2'] = $datos_rsrv->user_apl2;
            $rsrv['user_ndni'] = $datos_rsrv->user_ndni;
            $rsrv['user_tlef'] = $datos_rsrv->user_tlef;
            $rsrv['user_sexo'] = $datos_rsrv->user_sexo;
            $rsrv['evnt_ttlo'] = $datos_rsrv->evnt_ttlo;
            $rsrv['evnt_fech'] = $datos_rsrv->evnt_fech;
            $rsrv['evnt_imgn'] = $datos_rsrv->evnt_imgn;
        }
        else {
            $rsrv['rsrv_estd'] = FALSE;
        }
        
        return $rsrv;
    }
//--------------------------------------------------------------------------------------------------------------------------------------//
    
    function TasaDeCambio($path, $valor, $tasa_cdgo){
        
            // Librerias requeridas
            require_once $path.'app/includes/core.app.php';
            CoreApp($path);
            require_once $path.'includes/config.inc.php';

            // Control de errores
            $debug = DEBUG; 

            // Crear la instancia y conectar a la BD
            $conec = new db();
            $conec->dbConexion(); 

            $sql_tasa = "SELECT * FROM tbla_tasa WHERE tasa_cdgo = '".$tasa_cdgo."' AND tasa_estd = 1";
            $query_tasa = $conec->dbQuery($sql_tasa, $debug);
            $datos_tasa = $conec->dbFetchObjet($query_tasa);
                    
            $tarifa_bruta = ceil($valor * $datos_tasa->tasa_fctr);
            $tarifa = number_format($tarifa_bruta, 0, ',', '.');
            $tarifa .= " ".$datos_tasa->tasa_mnda;
            
            return $tarifa;
        }
    //--------------------------------------------------------------------------------------------------------------------------------------//
