<?php

    /********************************************************/
    /* Administrador Web SmartNova                            */
    /* Nucleo del sistema                                   */
    /* Junio de 2016                                        */
    /********************************************************/

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    function Core($path){
        // Conjuncion de librerias
        include_once $path.'core/admin.core.php';
        include_once $path.'core/datatables.core.php';
        include_once $path.'core/dates.core.php';
        include_once $path.'core/db.class.core.php';
        include_once $path.'core/db_query.core.php';
        include_once $path.'core/email.core.php';
        include_once $path.'core/forms.core.php';
        include_once $path.'core/generic.core.php';
        include_once $path.'core/modals.core.php';
        include_once $path.'core/qr_code.core.php';
        include_once $path.'core/security.core.php';
        include_once $path.'core/sesions.core.php';
        include_once $path.'core/strings.core.php';
        include_once $path.'core/theme.core.php';
        include_once $path.'core/twitter.core.php';
        include_once $path.'core/youtube.core.php';
        include_once $path.'includes/config.inc.php';
    }
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
