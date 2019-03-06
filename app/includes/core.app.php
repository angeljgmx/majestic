<?php

    /****************************************/
    /* Theme de la aplicacion               
    /* Centro Astronomico Caronte                  
    /* Universidad Experimental del Tachira                 
    /* Diciembre de 2016                            
    /****************************************/

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    function CoreApp($path){
        // Conjuncion de librerias
        include_once $path.'core/admin.core.php';
        include_once $path.'core/dates.core.php';
        include_once $path.'core/db.class.core.php';
        include_once $path.'core/email.core.php';
        include_once $path.'core/generic.core.php';
        include_once $path.'core/security.core.php';
        include_once $path.'core/sesions.core.php';
        include_once $path.'core/strings.core.php';
        include_once $path.'core/twitter.core.php';
        include_once $path.'core/youtube.core.php';
        include_once $path.'app/includes/theme.inc.php';
        include_once $path.'includes/config.inc.php';
        include_once $path.'app/includes/majestic_functions.inc.php';
    }
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

?>