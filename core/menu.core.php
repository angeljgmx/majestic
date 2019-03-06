<?php 
    /********************************************************/
    /* Administrador Web SmartNova
    /* Menu 
    /* 25-7-2016
    /********************************************************/

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------// 

    
    // id del administrador
    $admsid = $_SESSION['sson_idpr'];    

     // Consulta de las secciones
    $sql_secc = "SELECT tbla_secc.id AS secc_id, secc_nomb, secc_estd, "
        ."tbla_mdlo.id AS mdlo_id, mdlo_secc, tbla_admd.id, admd_adms, admd_mdlo "
        ."FROM tbla_secc "
        ."INNER JOIN tbla_mdlo ON (tbla_secc.id = mdlo_secc) "
        ."INNER JOIN tbla_admd ON (tbla_mdlo.id = admd_mdlo) "
        ."WHERE (admd_adms = '".$admsid."' AND admd_cons = '1') "
        ."GROUP BY secc_nomb ORDER BY secc_ordn";
    $consulta_secc = $conec->dbQuery($sql_secc, $debug);

    while ($secciones = $conec->dbFetchObjet($consulta_secc, $debug)){
        echo "<li class=\"heading\"> \n"
            ."<h3 class=\"uppercase\">".$secciones->secc_nomb."</h3> \n"
            ."</li> \n";

        // Consulta de los modulos asignados        
        $sql_mdlo = "SELECT tbla_admd.id, admd_adms, admd_mdlo, admd_cons, admd_insr, admd_edit, admd_elim, "
            ."mdlo_nomb, mdlo_estd, mdlo_icon, mdlo_arch, mdlo_code, mdlo_oper, tbla_mdlo.id AS mdlo_id, tbla_adms.id AS adms_id "
            ."FROM tbla_admd "
            ."INNER JOIN tbla_mdlo ON (admd_mdlo = tbla_mdlo.id) "
            ."INNER JOIN tbla_adms ON (admd_adms = tbla_adms.id) "
            ."WHERE admd_adms = '".$admsid."' AND mdlo_secc = '".$secciones->secc_id."' AND admd_cons = '1' AND mdlo_estd = '1' ORDER BY mdlo_nomb";
        $consulta_mdlo = $conec->dbQuery($sql_mdlo, $debug);

        while ($datos_mdlo = $conec->dbFetchObjet($consulta_mdlo)){

            $activo = ($_SESSION['mdlo_code'] == $datos_mdlo->mdlo_code) ? "active open" : "";


            if ($datos_mdlo->mdlo_oper == TRUE){

                echo "<li class=\"nav-item ".$activo."\"> \n"
                    ."<a href=\"javascript:;\" class=\"nav-link nav-toggle\"> \n"
                    ."<i class=\"fa ".$datos_mdlo->mdlo_icon."\"></i> \n"
                    ."<span class=\"title\">".$datos_mdlo->mdlo_nomb."</span> \n"
                    ."<span class=\"arrow\"></span> \n"
                    ."</a> \n"
                    ."<ul class=\"sub-menu\"> \n"
                    ."<li class=\"nav-item start \"> \n"
                    ."<a href=\"".$path."app/adms/".$datos_mdlo->mdlo_arch."\" class=\"nav-link \"> \n"
                    ."<i class=\"fa fa-table\"></i> \n"
                    ."<span class=\"title\">Consulta de datos</span> \n"
                    ."</a> \n"
                    ."</li> \n";

                if ($datos_mdlo->admd_insr == 1){
                    echo "<li class=\"nav-item start\"> \n"
                        ."<a href=\"".$path."app/adms/".$datos_mdlo->mdlo_arch."?op=insertar\" class=\"nav-link \"> \n"
                        ."<i class=\"fa fa-plus\"></i> \n"
                        ."<span class=\"title\">Agregar Registros</span> \n"
                        ."</a> \n"
                        ."</li> \n";
                }
                echo "</ul> \n"
                    ."</li> \n";
            }
            else {
                echo "<li class=\"nav-item ".$activo."\"> \n"
                    ."<a href=\"".$path."app/adms/".$datos_mdlo->mdlo_arch."\" class=\"nav-link nav-toggle\"> \n"
                    ."<i class=\"fa ".$datos_mdlo->mdlo_icon."\"></i> \n"
                    ."<span class=\"title\">".$datos_mdlo->mdlo_nomb."</span> \n"
                    ."<span class=\"arrow\"></span> \n"
                    ."</a> \n"
                    ."</li> \n";
            }                
        }
    }
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//   


?>
