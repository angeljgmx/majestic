<?php

    /****************************************/
    /* Theme de la aplicacion               
    /* Barbarie Producer                             
    /* Febrero 2017
     * Aplicacion desarrollada por Angel Garcia
     * Email: angel.j.garcia.m@gmail.com                       
    /****************************************/

//=============================================================================================================================================================================================//

    // Inicializar preferencias
    function InitCommon($path){
        
//        if (!isset($_SESSION['init_common'])){
//            
//            $_SESSION['common_init'] = TRUE;
    
            // Librerias requeridas
            require_once $path.'core/db.class.core.php';
            require_once $path.'includes/config.inc.php';

            // Control de errores
            $debug = DEBUG; 

            // Crear la instancia y conectar a la BD
            $conec = new db();
            $conec->dbConexion();
            
            
            $_SESSION['init_common'] = TRUE;

            // Inicializacion las preferencias del sitio
            $sql_pref = "SELECT * FROM tbla_pref WHERE id=1";
            $query_pref = $conec->dbQuery($sql_pref, $debug);
            $datos_pref = $conec->dbFetchObjet($query_pref);

            $_SESSION['pref_fvcn'] = $datos_pref->pref_fvcn;        // Favicon del sitio web
            $_SESSION['pref_durl'] = $datos_pref->pref_durl;        // Direccion URL
            $_SESSION['pref_hrtb'] = $datos_pref->pref_hrtb;        // Horario de trabajo
            $_SESSION['pref_logh'] = $datos_pref->pref_logh;        // Imagen del logotipo del encabezado
            $_SESSION['pref_logf'] = $datos_pref->pref_logf;        // Logo del footer
            $_SESSION['pref_loga'] = $datos_pref->pref_loga;        // Logo del administrador web
            $_SESSION['pref_copy'] = $datos_pref->pref_copy;        // Informaci&oacute;n de Copyright
            $_SESSION['pref_ftnn'] = $datos_pref->pref_ftnn;        // N&uacute;mero de noticias
            $_SESSION['pref_ftnt'] = $datos_pref->pref_ftnt;        // N&uacute;mero de Tweets

            $_SESSION['pref_char'] = $datos_pref->pref_char;        // Juego de caracteres por defecto del sitio
            $_SESSION['pref_desc'] = $datos_pref->pref_desc;        // Descripci&oacute;n del sitio Web para los buscadores
            $_SESSION['pref_keyw'] = $datos_pref->pref_keyw;        // Palabras clave
            $_SESSION['pref_flgs'] = $datos_pref->pref_flgs;        // Estilo de los iconos de las banderas de los paises
            $_SESSION['pref_geip'] = $datos_pref->pref_geip;        // Texto de Caronte en el pie de pagina

            // Inicializacion la informacion de contacto del sitio
            $sql_cont = "SELECT * FROM tbla_cont WHERE id=1";
            $query_cont = $conec->dbQuery($sql_cont, $debug);
            $datos_cont = $conec->dbFetchObjet($query_cont);

            $_SESSION['cont_nomb'] = $datos_cont->cont_nomb;        // Nombre de la Organizacion    
            $_SESSION['cont_gmap'] = $datos_cont->cont_gmap;        // Mapa de Google map con la direccion de Contacto
            $_SESSION['cont_dirc'] = $datos_cont->cont_dirc;        // Direccion fisica de contacto
            $_SESSION['cont_mail'] = $datos_cont->cont_mail;        // Direccion email
            $_SESSION['cont_tlfn'] = $datos_cont->cont_tlfn;        // Numero telefonico
            $_SESSION['cont_tfax'] = $datos_cont->cont_tfax;        // Numero de telefax
            $_SESSION['cont_movl'] = $datos_cont->cont_movl;        // Movil Celular
            $_SESSION['cont_riff'] = $datos_cont->cont_riff;        // Numero de registro fiscal
            $_SESSION['cont_post'] = $datos_cont->cont_post;        // C&oacute;digo Postal
            $_SESSION['cont_text'] = $datos_cont->cont_text;        // Texto del apartado de pongase en contacto con nosotros
            $_SESSION['cont_buzn'] = $datos_cont->cont_buzn;        // Cuenta del buzon de correo
            $_SESSION['cont_hrio'] = $datos_cont->cont_hrio;        // Horario de trabajo
            $_SESSION['cont_iorg'] = $datos_cont->cont_iorg;        // Informacio;n de la organizacion en el pie de pagina

            // Inicializacion las preferencias del sitio
            $sql_rdsc = "SELECT * FROM tbla_rdsc";
            $query_rdsc = $conec->dbQuery($sql_rdsc, $debug);
            // = $conec->dbFetchObjet($query_rdsc);

            while ($datos_rdsc = $conec->dbFetchObjet($query_rdsc)){
                switch ($datos_rdsc->rdsc_nomb){
                    case "facebook":
                        $_SESSION['fcbk_user'] = $datos_rdsc->rdsc_user;
                        $_SESSION['fcbk_link'] = $datos_rdsc->rdsc_durl;
                        $_SESSION['fcbk_icon'] = $datos_rdsc->rdsc_clas;
                    break;
                    case "twitter":
                        $_SESSION['twet_user'] = $datos_rdsc->rdsc_user;
                        $_SESSION['twet_link'] = $datos_rdsc->rdsc_durl;
                        $_SESSION['twet_icon'] = $datos_rdsc->rdsc_clas;
                    break;
                    case "youtube":
                        $_SESSION['ytbe_user'] = $datos_rdsc->rdsc_user;
                        $_SESSION['ytbe_link'] = $datos_rdsc->rdsc_durl;
                        $_SESSION['ytbe_icon'] = $datos_rdsc->rdsc_clas;
                    break;
                    case "skype":
                        $_SESSION['skyp_user'] = $datos_rdsc->rdsc_user;
                        $_SESSION['skyp_link'] = $datos_rdsc->rdsc_durl;
                        $_SESSION['skyp_icon'] = $datos_rdsc->rdsc_clas;
                    break;
                    case "instagram":
                        $_SESSION['inst_user'] = $datos_rdsc->rdsc_user;
                        $_SESSION['inst_link'] = $datos_rdsc->rdsc_durl;
                        $_SESSION['inst_icon'] = $datos_rdsc->rdsc_clas;
                    break;                
                }
            }
        //}
    }
    
//=============================================================================================================================================================================================//

    function getEvento($path, $id){
        
        // Inclusion de archivos necesarios
        require_once $path.'core/db.class.core.php';
        require_once $path.'includes/config.inc.php';
        
        // Control de errores
        $debug = DEBUG;
        
        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion(); 
    
        // Datos del administrador
        $sql_evnt = "SELECT * FROM tbla_evnt WHERE id = $id";
        $query_evnt = $conec->dbQuery($sql_evnt, $debug);
               
        $datos_evnt = $conec->dbFetchArray($query_evnt);

        return $datos_evnt;        
    }       
//=============================================================================================================================================================================================//
          
    
?>