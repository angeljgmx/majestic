<?php

    /****************************************/
    /* Entorno Administrativo               */
    /* www.it-labs.com.ve                   */
    /* info@it-labs.com.ve                  */
    /* Mayo 2016                            */
    /****************************************/

//==============================================================================================================================================================================================================================================================================================================================//

    // Definicion de la cabecera HTML de las paginas
    function HeaderHTML($path, $page_title, $meta, $css, $js, $config){
        
        // Definicion del documento
        echo "<!DOCTYPE html> \n"
        
            //Idioma del sitio - Compatibilidad con Internet Explorer
            ."<!--[if IE 8]> <html lang=\"en\" class=\"ie8 no-js\"> <![endif]--> \n"
            ."<!--[if IE 9]> <html lang=\"en\" class=\"ie9 no-js\"> <![endif]--> \n"
            ."<!--[if !IE]><!--> \n"
            ."<html lang=\"en\"> \n"
            ."<!--<![endif]--> \n"
                
            // Inicio del encabezado    
            ."<!-- BEGIN HEAD --> \n"
            ."<head> \n"
        
            // Juego de caracteres
            ."<meta charset=\"utf-8\" /> \n"
                
            // Titulo de la pagina
            ."<title>".$page_title."</title> \n"
                
            // Metadatos
            ."<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> \n"
            ."<meta content=\"width=device-width, initial-scale=1\" name=\"viewport\" /> \n"
            ."<meta content=\"\" name=\"description\" /> \n"
            ."<meta content=\"\" name=\"author\" /> \n"
            .$meta." \n"
                
            // Estilos CSS globales de cumplimiento obligatorio
            ."<!-- BEGIN GLOBAL MANDATORY STYLES --> \n"
            ."<link href=\"http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/simple-line-icons/simple-line-icons.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/uniform/css/uniform.default.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"           
            ."<!-- END GLOBAL MANDATORY STYLES --> \n"

            // Estilos de los plugins
            ."<!-- BEGIN PAGE LEVEL PLUGINS --> \n"
            ."<link href=\"".$path."assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/jquery-minicolors/jquery.minicolors.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/jquery-multi-select/css/multi-select.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/select2/css/select2.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/select2/css/select2-bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/datatables/datatables.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/icheck/skins/all.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/plugins/parsley/dist/parsley.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<!-- END PAGE LEVEL PLUGINS --> \n"
                
            // Estilos adicionales
            ."<!-- BEGIN THEME ADICIONAL STYLES --> \n"
            .$css." \n"
            ."<!-- END THEME ADICIONAL STYLES --> \n"
                
            // Estilos CSS globales
            ."<!-- BEGIN THEME GLOBAL STYLES --> \n"
            ."<link href=\"".$path."assets/global/css/components.min.css\" rel=\"stylesheet\" id=\"style_components\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/global/css/plugins.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<!-- END THEME GLOBAL STYLES --> \n"
                
            // Estilos CSS de la pagina
            ."<!-- BEGIN THEME LAYOUT STYLES --> \n"
            ."<link href=\"".$path."assets/layouts/layout/css/layout.min.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<link href=\"".$path."assets/layouts/layout/css/themes/darkblue.min.css\" rel=\"stylesheet\" type=\"text/css\" id=\"style_color\" /> \n"
            ."<link href=\"".$path."assets/layouts/layout/css/custom.css\" rel=\"stylesheet\" type=\"text/css\" /> \n"
            ."<!-- END THEME LAYOUT STYLES --> \n"
                
            ."<link href=\"".$path."app/fonts/flaticons/flaticon.css\" rel=\"stylesheet\" type=\"text/css\" id=\"style_color\" /> \n"
            
            
            // Librerias JavaScript de inclusion obligatoria en el header
            .$js." \n"
                
            // Favicon
            ."<link rel=\"shortcut icon\" href=\"".$path."uploads/favicon/favicon.png\" /> \n"
                
            // Finalizacion del encabezado HTML
            ."</head> \n"
            ."<!-- END HEAD --> \n";
    }
//==============================================================================================================================================================================================================================================================================================================================//
    
    function BeginBody($path, $body_class){
        echo "<body class=\"page-header-fixed page-sidebar-closed-hide-logo ".$body_class."\"> \n";
    }
//==============================================================================================================================================================================================================================================================================================================================//
         
    function PageHeader($path){  
        
        // Inclusion de archivos necesarios
        require_once $path.'core/db.class.core.php';
        require_once $path.'includes/config.inc.php';
        
        // Control de errores
        $debug = DEBUG;
        
        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion(); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
        
        // Datos de las preferencias del sitio
        $sql_pref = "SELECT * FROM tbla_pref WHERE id = 1";
        $query_pref = $conec->dbQuery($sql_pref, $debug);
        $datos_pref = $conec->dbFetchObjet($query_pref);
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

        // Inicio del encabezado de la pagina
        echo "<!-- BEGIN HEADER --> \n"
            ."<div class=\"page-header navbar navbar-fixed-top\"> \n"
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
               
            ."<!-- BEGIN HEADER INNER --> \n"
            ."<div class=\"page-header-inner \"> \n"
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
                
            // Logo
            ."<!-- BEGIN LOGO --> \n"
            ."<div class=\"page-logo\"> \n"
            //."<a href=\"index.html\"> \n"
            //."<img height=\"30\" src=\"".$path."uploads/imagenes/logo/".$datos_pref->pref_logo."\" alt=\"logo\" class=\"logo-default\" /> \n"
            //."</a> \n"
            //."<div class=\"menu-toggler sidebar-toggler\"> </div> \n"
            ."</div> \n"
            ."<!-- END LOGO --> \n"
                
            // Menu Responsivo    
            ."<!-- BEGIN RESPONSIVE MENU TOGGLER --> \n"
            ."<a href=\"javascript:;\" class=\"menu-toggler responsive-toggler\" data-toggle=\"collapse\" data-target=\".navbar-collapse\"> </a> \n"
            ."<!-- END RESPONSIVE MENU TOGGLER --> \n"
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
                    
            // Inicio del Menu de navegacion superior    
            ."<!-- BEGIN TOP NAVIGATION MENU --> \n"
            ."<div class=\"top-menu\"> \n"
            ."<ul class=\"nav navbar-nav pull-right\"> \n";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
                
            // Notificaciones            
//            ."<!-- BEGIN NOTIFICATION DROPDOWN --> \n"
//            ."<!-- DOC: Apply \"dropdown-dark\" class after below \"dropdown-extended\" to change the dropdown styte --> \n"
//            ."<li class=\"dropdown dropdown-extended dropdown-notification\" id=\"header_notification_bar\"> \n"
//            ."<a href=\"javascript:;\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-close-others=\"true\"> \n"
//            ."<i class=\"icon-bell\"></i> \n"
//            ."<span class=\"badge badge-default\"> 7 </span> \n"
//            ."</a> \n"
//            ."<ul class=\"dropdown-menu\"> \n"
//                
//            ."<li class=\"external\"> \n"
//            ."<h3> \n"
//            ."<span class=\"bold\">12 pending</span> notifications</h3> \n"
//            ."<a href=\"page_user_profile_1.html\">view all</a> \n"
//            ."</li> \n"
//
//            ."<li> \n"
//            ."<ul class=\"dropdown-menu-list scroller\" style=\"height: 250px;\" data-handle-color=\"#637283\"> \n"
//
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"time\">just now</span> \n"
//            ."<span class=\"details\"> \n"
//            ."<span class=\"label label-sm label-icon label-success\"> \n"
//            ."<i class=\"fa fa-plus\"></i> \n"
//            ."</span> New user registered. </span> \n"
//            ."</a> \n"
//            ."</li> \n"
//
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"time\">3 mins</span> \n"
//            ."<span class=\"details\"> \n"
//            ."<span class=\"label label-sm label-icon label-danger\"> \n"
//            ."<i class=\"fa fa-bolt\"></i> \n"
//            ."</span> Server #12 overloaded. </span> \n"
//            ."</a> \n"
//            ."</li> \n"
//
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"time\">10 mins</span> \n"
//            ."<span class=\"details\"> \n"
//            ."<span class=\"label label-sm label-icon label-warning\"> \n"
//            ."<i class=\"fa fa-bell-o\"></i> \n"
//            ."</span> Server #2 not responding. </span> \n"
//            ."</a> \n"
//            ."</li> \n"
//
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"time\">14 hrs</span> \n"
//            ."<span class=\"details\"> \n"
//            ."<span class=\"label label-sm label-icon label-info\"> \n"
//            ."<i class=\"fa fa-bullhorn\"></i> \n"
//            ."</span> Application error. </span> \n"
//            ."</a> \n"
//            ."</li> \n"
//                                    
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"time\">2 days</span> \n"
//            ."<span class=\"details\"> \n"
//            ."<span class=\"label label-sm label-icon label-danger\"> \n"
//            ."<i class=\"fa fa-bolt\"></i> \n"
//            ."</span> Database overloaded 68%. </span> \n"
//            ."</a> \n"
//            ."</li> \n"
//                
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"time\">3 days</span> \n"
//            ."<span class=\"details\"> \n"
//            ."<span class=\"label label-sm label-icon label-danger\"> \n"
//            ."<i class=\"fa fa-bolt\"></i> \n"
//            ."</span> A user IP blocked. </span> \n"
//            ."</a> \n"
//            ."</li> \n"
//                
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"time\">4 days</span> \n"
//            ."<span class=\"details\"> \n"
//            ."<span class=\"label label-sm label-icon label-warning\"> \n"
//            ."<i class=\"fa fa-bell-o\"></i> \n"
//            ."</span> Storage Server #4 not responding dfdfdfd. </span> \n"
//            ."</a> \n"
//            ."</li> \n"
//                
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"time\">5 days</span> \n"
//            ."<span class=\"details\"> \n"
//            ."<span class=\"label label-sm label-icon label-info\"> \n"
//            ."<i class=\"fa fa-bullhorn\"></i> \n"
//            ."</span> System Error. </span> \n"
//            ."</a> \n"
//            ."</li> \n"
//                
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"time\">9 days</span> \n"
//            ."<span class=\"details\"> \n"
//            ."<span class=\"label label-sm label-icon label-danger\"> \n"
//            ."<i class=\"fa fa-bolt\"></i> \n"
//            ."</span> Storage server failed. </span> \n"
//            ."</a> \n"
//            ."</li> \n"
//                
//            // Fin de las notificaciones    
//            ."</ul> \n"
//            ."</li> \n"
//            ."</ul> \n"
//            ."</li> \n"
//            ."<!-- END NOTIFICATION DROPDOWN --> \n"
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
                                 
//            // Inbox    
//            ."<!-- BEGIN INBOX DROPDOWN --> \n"
//            ."<!-- DOC: Apply \"dropdown-dark\" class after below \"dropdown-extended\" to change the dropdown styte --> \n"
//            ."<li class=\"dropdown dropdown-extended dropdown-inbox\" id=\"header_inbox_bar\"> \n"
//            ."<a href=\"javascript:;\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-close-others=\"true\"> \n"
//            ."<i class=\"icon-envelope-open\"></i> \n"
//            ."<span class=\"badge badge-default\"> 4 </span> \n"
//            ."</a> \n"
//            ."<ul class=\"dropdown-menu\"> \n"
//            ."<li class=\"external\"> \n"
//            ."<h3>You have \n"
//            ."<span class=\"bold\">7 New</span> Messages</h3> \n"
//            ."<a href=\"app_inbox.html\">view all</a> \n"
//            ."</li> \n"
//            ."<li> \n"
//            ."<ul class=\"dropdown-menu-list scroller\" style=\"height: 275px;\" data-handle-color=\"#637283\"> \n"
//                                        
//                
//            ."<li> \n"
//            ."<a href=\"#\"> \n"
//            ."<span class=\"photo\"> \n"
//            ."<img src=\"".$path."assets/layouts/layout3/img/avatar2.jpg\" class=\"img-circle\" alt=\"\"> </span> \n"
//            ."<span class=\"subject\"> \n"
//            ."<span class=\"from\"> Lisa Wong </span> \n"
//            ."<span class=\"time\">Just Now </span> \n"
//            ."</span> \n"
//            ."<span class=\"message\"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span> \n"
//            ."</a> \n"
//            ."</li> \n"
//                
//            ."<li> \n"
//            ."<a href=\"#\"> \n"
//            ."<span class=\"photo\"> \n"
//            ."<img src=\"".$path."assets/layouts/layout3/img/avatar3.jpg\" class=\"img-circle\" alt=\"\"> </span> \n"
//            ."<span class=\"subject\"> \n"
//            ."<span class=\"from\"> Richard Doe </span> \n"
//            ."<span class=\"time\">16 mins </span> \n"
//            ."</span> \n"
//            ."<span class=\"message\"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span> \n"
//            ."</a> \n"
//            ."</li> \n"
//                
//            ."<li> \n"
//            ."<a href=\"#\"> \n"
//            ."<span class=\"photo\"> \n"
//            ."<img src=\"".$path."assets/layouts/layout3/img/avatar1.jpg\" class=\"img-circle\" alt=\"\"> </span> \n"
//            ."<span class=\"subject\"> \n"
//            ."<span class=\"from\"> Bob Nilson </span> \n"
//            ."<span class=\"time\">2 hrs </span> \n"
//            ."</span> \n"
//            ."<span class=\"message\"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span> \n"
//            ."</a> \n"
//            ."</li> \n"
//
//            ."<li> \n"
//            ."<a href=\"#\"> \n"
//            ."<span class=\"photo\"> \n"
//            ."<img src=\"".$path."assets/layouts/layout3/img/avatar2.jpg\" class=\"img-circle\" alt=\"\"> </span> \n"
//            ."<span class=\"subject\"> \n"
//            ."<span class=\"from\"> Lisa Wong </span> \n"
//            ."<span class=\"time\">40 mins </span> \n"
//            ."</span> \n"
//            ."<span class=\"message\"> Vivamus sed auctor 40% nibh congue nibh... </span> \n"
//            ."</a> \n"
//            ."</li> \n"
//
//            ."<li> \n"
//            ."<a href=\"#\"> \n"
//            ."<span class=\"photo\"> \n"
//            ."<img src=\"".$path."assets/layouts/layout3/img/avatar3.jpg\" class=\"img-circle\" alt=\"\"> </span> \n"
//            ."<span class=\"subject\"> \n"
//            ."<span class=\"from\"> Richard Doe </span> \n"
//            ."<span class=\"time\">46 mins </span> \n"
//            ."</span> \n"
//            ."<span class=\"message\"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span> \n"
//            ."</a> \n"
//            ."</li> \n"
// 
//            ."</ul> \n"
//            ."</li> \n"
//            ."</ul> \n"
//            ."</li> \n"
//            ."<!-- END INBOX DROPDOWN --> \n"
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
                            
            // Todo           
//            ."<!-- BEGIN TODO DROPDOWN --> \n"
//            ."<!-- DOC: Apply \"dropdown-dark\" class after below \"dropdown-extended\" to change the dropdown styte --> \n"
//            ."<li class=\"dropdown dropdown-extended dropdown-tasks\" id=\"header_task_bar\"> \n"
//            ."<a href=\"javascript:;\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-close-others=\"true\"> \n"
//            ."<i class=\"icon-calendar\"></i> \n"
//            ."<span class=\"badge badge-default\"> 3 </span> \n"
//            ."</a> \n"
//            ."<ul class=\"dropdown-menu extended tasks\"> \n"
//                                
//            ."<li class=\"external\"> \n"
//            ."<h3>You have <span class=\"bold\">12 pending</span> tasks</h3> \n"
//            ."<a href=\"app_todo.html\">view all</a> \n"
//            ."</li> \n"
//            
//            ."<li> \n"
//            ."<ul class=\"dropdown-menu-list scroller\" style=\"height: 275px;\" data-handle-color=\"#637283\"> \n"
//            
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"task\"> \n"
//            ."<span class=\"desc\">New release v1.2 </span> \n"
//            ."<span class=\"percent\">30%</span> \n"
//            ."</span> \n"
//            ."<span class=\"progress\"> \n"
//            ."<span style=\"width: 40%;\" class=\"progress-bar progress-bar-success\" aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\"> \n"
//            ."<span class=\"sr-only\">40% Complete</span> \n"
//            ."</span> \n"
//            ."</span> \n"
//            ."</a> \n"
//            ."</li> \n"
//            
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"task\"> \n"
//            ."<span class=\"desc\">Application deployment</span> \n"
//            ."<span class=\"percent\">65%</span> \n"
//            ."</span> \n"
//            ."<span class=\"progress\"> \n"
//            ."<span style=\"width: 65%;\" class=\"progress-bar progress-bar-danger\" aria-valuenow=\"65\" aria-valuemin=\"0\" aria-valuemax=\"100\"> \n"
//            ."<span class=\"sr-only\">65% Complete</span> \n"
//            ."</span> \n"
//            ."</span> \n"
//            ."</a> \n"
//            ."</li> \n"
//            
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"task\"> \n"
//            ."<span class=\"desc\">Mobile app release</span> \n"
//            ."<span class=\"percent\">98%</span> \n"
//            ."</span> \n"
//            ."<span class=\"progress\"> \n"
//            ."<span style=\"width: 98%;\" class=\"progress-bar progress-bar-success\" aria-valuenow=\"98\" aria-valuemin=\"0\" aria-valuemax=\"100\"> \n"
//            ."<span class=\"sr-only\">98% Complete</span> \n"
//            ."</span> \n"
//            ."</span> \n"
//            ."</a> \n"
//            ."</li> \n"
//            
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"task\"> \n"
//            ."<span class=\"desc\">Database migration</span> \n"
//            ."<span class=\"percent\">10%</span> \n"
//            ."</span> \n"
//            ."<span class=\"progress\"> \n"
//            ."<span style=\"width: 10%;\" class=\"progress-bar progress-bar-warning\" aria-valuenow=\"10\" aria-valuemin=\"0\" aria-valuemax=\"100\"> \n"
//            ."<span class=\"sr-only\">10% Complete</span> \n"
//            ."</span> \n"
//            ."</span> \n"
//            ."</a> \n"
//            ."</li> \n"
//            
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"task\"> \n"
//            ."<span class=\"desc\">Web server upgrade</span> \n"
//            ."<span class=\"percent\">58%</span> \n"
//            ."</span> \n"
//            ."<span class=\"progress\"> \n"
//            ."<span style=\"width: 58%;\" class=\"progress-bar progress-bar-info\" aria-valuenow=\"58\" aria-valuemin=\"0\" aria-valuemax=\"100\"> \n"
//            ."<span class=\"sr-only\">58% Complete</span> \n"
//            ."</span> \n"
//            ."</span> \n"
//            ."</a> \n"
//            ."</li> \n"
//            
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"task\"> \n"
//            ."<span class=\"desc\">Mobile development</span> \n"
//            ."<span class=\"percent\">85%</span> \n"
//            ."</span> \n"
//            ."<span class=\"progress\"> \n"
//            ."<span style=\"width: 85%;\" class=\"progress-bar progress-bar-success\" aria-valuenow=\"85\" aria-valuemin=\"0\" aria-valuemax=\"100\"> \n"
//            ."<span class=\"sr-only\">85% Complete</span> \n"
//            ."</span> \n"
//            ."</span> \n"
//            ."</a> \n"
//            ."</li> \n"
//                                        
//            ."<li> \n"
//            ."<a href=\"javascript:;\"> \n"
//            ."<span class=\"task\"> \n"
//            ."<span class=\"desc\">New UI release</span> \n"
//            ."<span class=\"percent\">38%</span> \n"
//            ."</span> \n"
//            ."<span class=\"progress progress-striped\"> \n"
//            ."<span style=\"width: 38%;\" class=\"progress-bar progress-bar-important\" aria-valuenow=\"18\" aria-valuemin=\"0\" aria-valuemax=\"100\"> \n"
//            ."<span class=\"sr-only\">38% Complete</span> \n"
//            ."</span> \n"
//            ."</span> \n"
//            ."</a> \n"
//            ."</li> \n"
//                                    
//            ."</ul> \n"
//            ."</li> \n"
//            ."</ul> \n"
//            ."</li> \n"
//            ."<!-- END TODO DROPDOWN --> \n"
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
            
        // Acceso del administrador 
                
        $sql_menu_adms = "SELECT * FROM tbla_adms WHERE id = '".$_SESSION['sson_idpr']."'";   
        $query_menu_adms = $conec->dbQuery($sql_menu_adms, $debug);
        $datos_menu_adms = $conec->dbFetchObjet($query_menu_adms);
        
        echo "<!-- BEGIN USER LOGIN DROPDOWN --> \n"
            ."<!-- DOC: Apply \"dropdown-dark\" class after below \"dropdown-extended\" to change the dropdown styte --> \n"
            ."<li class=\"dropdown dropdown-user\"> \n"
            ."<a href=\"javascript:;\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-close-others=\"true\"> \n";
        
        // Avatar del administrador
        if ($datos_menu_adms->adms_sexo == "F"){        
            echo "<img alt=\"\" class=\"img-circle\" src=\"".$path."assets/global/img/icons/29x29/flat-faces-icons-circle-woman-29x29.png\" /> \n";
        }
        else {
            echo "<img alt=\"\" class=\"img-circle\" src=\"".$path."assets/global/img/icons/29x29/flat-faces-icons-circle-man-29x29.png\" /> \n";
        }
        
        // Nombre y apellido del administrador
        echo "<span class=\"username username-hide-on-mobile\">".$datos_menu_adms->adms_nomb." ".$datos_menu_adms->adms_apll."</span> \n"
                ."<i class=\"fa fa-angle-down\"></i> \n"
                ."</a> \n";

        // Menu desplegable
        echo "<ul class=\"dropdown-menu dropdown-menu-default\"> \n";
            
        // Mi perfil
        echo "<li> \n"
            ."<a href=\"".$path."adms/adms_perfil.php\"><i class=\"fa fa-user\"></i> Mi Perfil </a> \n"
            ."</li> \n";
        
        // Editar datos
        echo "<li> \n"
            ."<a href=\"".$path."adms/adms_editar_perfil.php\"><i class=\"fa fa-pencil\"></i> Editar Datos</a> \n"
            ."</li> \n";
        
         // Cambiar clave
        echo "<li> \n"
            ."<a href=\"".$path."adms/adms_cambiar_clave.php\"><i class=\"fa fa-key\"></i> Cambiar Contrase&ntilde;a</a> \n"
            ."</li> \n";
        
//        // Calendario
//        echo "<li> \n"
//            ."<a href=\"app_calendar.html\"><i class=\"icon-calendar\"></i> My Calendar </a> \n"
//            ."</li> \n";
//                
//        // Inbox
//        echo "<li> \n"
//            ."<a href=\"app_inbox.html\"><i class=\"icon-envelope-open\"></i> My Inbox <span class=\"badge badge-danger\"> 3 </span></a> \n"
//            ."</li> \n";
//                
//        // Task
//        echo "<li> \n"
//            ."<a href=\"app_todo.html\"><i class=\"icon-rocket\"></i> My Tasks <span class=\"badge badge-success\"> 7 </span></a> \n"
//            ."</li> \n";
        
        echo "<li class=\"divider\"> </li> \n"
            ."<li> \n"
            ."<a href=\"".$path."lock_screen.php\"><i class=\"fa fa-lock\"></i> Bloquear Pantalla </a> \n"
            ."</li> \n"
            ."<li> \n"
            ."<a href=\"".$path."login_administrador.php?session=cerrar\"><i class=\"fa fa-sign-out\"></i> Cerrar Sesi&oacute;n </a> \n"
            ."</li> \n"
            ."</ul> \n"

            ."</li> \n"
            ."<!-- END USER LOGIN DROPDOWN --> \n"
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
                        
            // Sidebar Toggler
//            ."<!-- BEGIN QUICK SIDEBAR TOGGLER --> \n"
//            ."<!-- DOC: Apply \"dropdown-dark\" class after below \"dropdown-extended\" to change the dropdown styte --> \n"
//            ."<li class=\"dropdown dropdown-quick-sidebar-toggler\"> \n"
//            ."<a href=\"javascript:;\" class=\"dropdown-toggle\"> \n"
//            ."<i class=\"icon-logout\"></i> \n"
//            ."</a> \n"
//            ."</li> \n"
//            ."<!-- END QUICK SIDEBAR TOGGLER --> \n"
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
                        
            ."</ul> \n"
            ."</div> \n"
            ."<!-- END TOP NAVIGATION MENU --> \n"
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
                
            ."</div> \n"
            ."<!-- END HEADER INNER --> \n"
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//            
            
            // Cirre del encabezado de la pagina
            ."</div> \n"
            ."<!-- END HEADER --> \n";
    }
//==============================================================================================================================================================================================================================================================================================================================//
        
    function HeaderContentDivider($path){
        echo "<!-- BEGIN HEADER & CONTENT DIVIDER --> \n"
            ."<div class=\"clearfix\"> </div> \n"
            ."<!-- END HEADER & CONTENT DIVIDER --> \n";
    }
//==============================================================================================================================================================================================================================================================================================================================//

    function BeginContainer($path){
        echo "<!-- BEGIN CONTAINER --> \n"
            ."<div class=\"page-container\"> \n";
    }            
//==============================================================================================================================================================================================================================================================================================================================//
                       
    function Sidebar($path){ 
        
        // Control de errores
        $debug = DEBUG;

        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion();
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

        // Datos de las preferencias del sitio
        $sql_pref = "SELECT * FROM tbla_pref WHERE id = 1";
        $query_pref = $conec->dbQuery($sql_pref, $debug);
        $datos_pref = $conec->dbFetchObjet($query_pref);
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

        
        echo "<!-- BEGIN SIDEBAR --> \n"
            ."<div class=\"page-sidebar-wrapper\"> \n"
            ."<!-- BEGIN SIDEBAR --> \n"
            ."<!-- DOC: Set data-auto-scroll=\"false\" to disable the sidebar from auto scrolling/focusing --> \n"
            ."<!-- DOC: Change data-auto-speed=\"200\" to adjust the sub menu slide up/down speed --> \n"
            ."<div class=\"page-sidebar navbar-collapse collapse\"> \n"
            
            ."<!-- BEGIN SIDEBAR MENU --> \n"
            ."<ul class=\"page-sidebar-menu  page-header-fixed \" data-keep-expanded=\"false\" data-auto-scroll=\"true\" data-slide-speed=\"200\" style=\"padding-top: 20px\"> \n"
            
            ."<li class=\"sidebar-toggler-wrapper hide\"> \n"
            ."<!-- BEGIN SIDEBAR TOGGLER BUTTON --> \n"
            ."<div class=\"sidebar-toggler\"> </div> \n"
            ."<!-- END SIDEBAR TOGGLER BUTTON --> \n"
            ."</li> \n";
        
        echo "<li class=\"heading\" align=\"center\"> \n"
            ."<a href=\"".$path."app/index.php\" target=\"_blank\"> \n"
            ."<img width=\"180\" src=\"".$path."uploads/imagenes/logo/".$datos_pref->pref_loga."\" alt=\"logo\" class=\"logo-default\" /> \n"
            ."</a> \n"
            ."</li> \n";
        
//        echo "<li class=\"heading\"> \n"
//            ."<h3 class=\"uppercase\">M&oacute;dulos</h3> \n"
//            ."</li> \n";
                
        // Menu
        include_once $path.'core/menu.core.php';

        echo "</ul> \n"
            ."<!-- END SIDEBAR MENU --> \n"
                
            ."</div> \n"
            ."<!-- END SIDEBAR --> \n"
            ."</div> \n"
            ."<!-- END SIDEBAR --> \n";
    }
//==============================================================================================================================================================================================================================================================================================================================//
            
    function BeginContent($path){        
        echo "<!-- BEGIN CONTENT --> \n"
            ."<div class=\"page-content-wrapper\"> \n"
                    
            ."<!-- BEGIN CONTENT BODY --> \n"
            ."<div class=\"page-content\"> \n";
    }                
//==============================================================================================================================================================================================================================================================================================================================//

    function ThemePanel($path){
        echo "<!-- BEGIN PAGE HEADER--> \n"
            ."<!-- BEGIN THEME PANEL --> \n"
            ."<div class=\"theme-panel hidden-xs hidden-sm\"> \n"
            ."<div class=\"toggler\"> </div> \n"
            ."<div class=\"toggler-close\"> </div> \n"
            ."<div class=\"theme-options\"> \n"
            ."<div class=\"theme-option theme-colors clearfix\"> \n"
            ."<span> THEME COLOR </span> \n"
            ."<ul> \n"
            ."<li class=\"color-default current tooltips\" data-style=\"default\" data-container=\"body\" data-original-title=\"Default\"> </li> \n"
            ."<li class=\"color-darkblue tooltips\" data-style=\"darkblue\" data-container=\"body\" data-original-title=\"Dark Blue\"> </li> \n"
            ."<li class=\"color-blue tooltips\" data-style=\"blue\" data-container=\"body\" data-original-title=\"Blue\"> </li> \n"
            ."<li class=\"color-grey tooltips\" data-style=\"grey\" data-container=\"body\" data-original-title=\"Grey\"> </li> \n"
            ."<li class=\"color-light tooltips\" data-style=\"light\" data-container=\"body\" data-original-title=\"Light\"> </li> \n"
            ."<li class=\"color-light2 tooltips\" data-style=\"light2\" data-container=\"body\" data-html=\"true\" data-original-title=\"Light 2\"> </li> \n"
            ."</ul> \n"
            ."</div> \n"
            ."<div class=\"theme-option\"> \n"
            ."<span> Theme Style </span> \n"
            ."<select class=\"layout-style-option form-control input-sm\"> \n"
            ."<option value=\"square\" selected=\"selected\">Square corners</option> \n"
            ."<option value=\"rounded\">Rounded corners</option> \n"
            ."</select> \n"
            ."</div> \n"
            ."<div class=\"theme-option\"> \n"
            ."<span> Layout </span> \n"
            ."<select class=\"layout-option form-control input-sm\"> \n"
            ."<option value=\"fluid\" selected=\"selected\">Fluid</option> \n"
            ."<option value=\"boxed\">Boxed</option> \n"
            ."</select> \n"
            ."</div> \n"
            ."<div class=\"theme-option\"> \n"
            ."<span> Header </span> \n"
            ."<select class=\"page-header-option form-control input-sm\"> \n"
            ."<option value=\"fixed\" selected=\"selected\">Fixed</option> \n"
            ."<option value=\"default\">Default</option> \n"
            ."</select> \n"
            ."</div> \n"
            ."<div class=\"theme-option\"> \n"
            ."<span> Top Menu Dropdown</span> \n"
            ."<select class=\"page-header-top-dropdown-style-option form-control input-sm\"> \n"
            ."<option value=\"light\" selected=\"selected\">Light</option> \n"
            ."<option value=\"dark\">Dark</option> \n"
            ."</select> \n"
            ."</div> \n"
            ."<div class=\"theme-option\"> \n"
            ."<span> Sidebar Mode</span> \n"
            ."<select class=\"sidebar-option form-control input-sm\"> \n"
            ."<option value=\"fixed\">Fixed</option> \n"
            ."<option value=\"default\" selected=\"selected\">Default</option> \n"
            ."</select> \n"
            ."</div> \n"
            ."<div class=\"theme-option\"> \n"
            ."<span> Sidebar Menu </span> \n"
            ."<select class=\"sidebar-menu-option form-control input-sm\"> \n"
            ."<option value=\"accordion\" selected=\"selected\">Accordion</option> \n"
            ."<option value=\"hover\">Hover</option> \n"
            ."</select> \n"
            ."</div> \n"
            ."<div class=\"theme-option\"> \n"
            ."<span> Sidebar Style </span> \n"
            ."<select class=\"sidebar-style-option form-control input-sm\"> \n"
            ."<option value=\"default\" selected=\"selected\">Default</option> \n"
            ."<option value=\"light\">Light</option> \n"
            ."</select> \n"
            ."</div> \n"
            ."<div class=\"theme-option\"> \n"
            ."<span> Sidebar Position </span> \n"
            ."<select class=\"sidebar-pos-option form-control input-sm\"> \n"
            ."<option value=\"left\" selected=\"selected\">Left</option> \n"
            ."<option value=\"right\">Right</option> \n"
            ."</select> \n"
            ."</div> \n"
            ."<div class=\"theme-option\"> \n"
            ."<span> Footer </span> \n"
            ."<select class=\"page-footer-option form-control input-sm\"> \n"
            ."<option value=\"fixed\">Fixed</option> \n"
            ."<option value=\"default\" selected=\"selected\">Default</option> \n"
            ."</select> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<!-- END THEME PANEL --> \n";
    }
//==============================================================================================================================================================================================================================================================================================================================//
    
    function PageTitle($path, $page_title, $page_subtitle){
        echo "<!-- BEGIN PAGE TITLE--> \n"
            ."<h3 class=\"page-title\"> \n"
            .$page_title." \n"
            ."<small> \n"
            .$page_subtitle." \n"
            ."</small> \n"
            ."</h3> \n"
            ."<!-- END PAGE TITLE--> \n";
    }
//==============================================================================================================================================================================================================================================================================================================================//

    function PageBar($path, $objetivo, $actions_pagebar){ 
        
        // Inclusion de la clase para el breadcrumbs
        include $path.'core/breadcrumbs.class.core.php';
        require_once $path.'core/security.core.php';
        
        // Permisos del modulo
        $permisos = PermisosModulo($path); 

        // Inicializacion de la clase
        $breadcrumb = new breadcrumb;

        // Removemos el directorio para que no se muestre
        $breadcrumb->removeDirs = array ("adms", "public", "user", "app");

        // No mostramos la extencion del archivo
        $breadcrumb->hideFileExt = TRUE;

        // Primera letra en mayusculas para los elementos del breadcrumbs
        $breadcrumb->dirformat='ucfirst';

        // Cambiamos "_" por "" en los nombres de los elementos
        $breadcrumb->_toSpace = TRUE;
        
        echo "<!-- BEGIN PAGE BAR --> \n"
            ."<div class=\"page-bar\"> \n"
                
            // Breadcrumbs
            ."<ul class=\"page-breadcrumb breadcrumb\"> \n"
            ."<li> \n"
            .$breadcrumb->show_breadcrumb()." \n"
            ."</li> \n"            
            ."</ul> \n";

        // Acciones
        if ($actions_pagebar != ""){
            echo "<div class=\"page-toolbar\"> \n"
                ."<div class=\"btn-group pull-right\"> \n"

                // Boton de la accion
                ."<button type=\"button\" class=\"btn btn-fit-height default dropdown-toggle\" data-toggle=\"dropdown\"> \n"
                ."<i class=\"fa fa-gear\"></i> \n"
                ."Acciones \n"
                ."<i class=\"fa fa-angle-down\"></i> \n"
                ."</button> \n"

                ."<ul class=\"dropdown-menu pull-right\" role=\"menu\"> \n";
                
            foreach ($actions_pagebar as $accion => $accion_valor){

                switch ($accion) {

                    // Nuevo registro
                    case ("nuevo_registro"):
                        if ($permisos['insr'] == TRUE){
                            echo "<li> \n"
                                ."<a href=\"".$objetivo."?op=insertar\"> \n"
                                ."<i class=\"fa fa-plus\"></i> \n"
                                ."Nuevo Registro  \n"
                                ."</a> \n"
                                ."</li> \n"
                                ."<li class=\"divider\"> </li> \n";
                        }
                    break;

                    // Tabla de consulta
                    case ("tabla_consulta"):
                        echo "<li> \n"
                            ."<a href=\"".$objetivo."?op=listar\"> \n"
                            ."<i class=\"fa fa-th-list\"></i> \n"
                            ."Tabla de Consulta \n"
                            ."</a> \n"
                            ."</li> \n";
                    break;

                    // Panel de control
                    case ("panel_control"):
                        echo "<li class=\"divider\"> </li> \n"
                            ."<li> \n"
                            ."<a href=\"".$path."app/adms/adms_panel_control.php\"> \n"
                            ."<i class=\"fa fa-gears\"></i> \n"
                            ."Panel de Control \n"
                            ."</a> \n"
                            ."</li> \n";
                    break;              
                }
            }

            echo "</ul> \n"
                ."</div> \n"
                ."</div> \n";
        }
        
        echo "</div> \n"
            ."<!-- END PAGE BAR --> \n"
            ."<!-- END PAGE HEADER--> \n";
    }                
//==============================================================================================================================================================================================================================================================================================================================//
                   
    function EndContent($path){                
        echo "</div> \n"
            ."<!-- END CONTENT BODY --> \n"
            ."</div> \n"
            ."<!-- END CONTENT --> \n";
    }        
//==============================================================================================================================================================================================================================================================================================================================//
               
    function QuickSidebar($path){
        echo "<!-- BEGIN QUICK SIDEBAR --> \n"
            ."<a href=\"javascript:;\" class=\"page-quick-sidebar-toggler\"> \n"
            ."<i class=\"icon-login\"></i> \n"
            ."</a> \n"
            ."<div class=\"page-quick-sidebar-wrapper\" data-close-on-body-click=\"false\"> \n"
            ."<div class=\"page-quick-sidebar\"> \n"
            ."<ul class=\"nav nav-tabs\"> \n"
            ."<li class=\"active\"> \n"
            ."<a href=\"javascript:;\" data-target=\"#quick_sidebar_tab_1\" data-toggle=\"tab\"> Users \n"
            ."<span class=\"badge badge-danger\">2</span> \n"
            ."</a> \n"
            ."</li> \n"
            ."<li> \n"
            ."<a href=\"javascript:;\" data-target=\"#quick_sidebar_tab_2\" data-toggle=\"tab\"> Alerts \n"
            ."<span class=\"badge badge-success\">7</span> \n"
            ."</a> \n"
            ."</li> \n"
            ."<li class=\"dropdown\"> \n"
            ."<a href=\"javascript:;\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"> More \n"
            ."<i class=\"fa fa-angle-down\"></i> \n"
            ."</a> \n"
            ."<ul class=\"dropdown-menu pull-right\"> \n"
            ."<li> \n"
            ."<a href=\"javascript:;\" data-target=\"#quick_sidebar_tab_3\" data-toggle=\"tab\"> \n"
            ."<i class=\"icon-bell\"></i> Alerts </a> \n"
            ."</li> \n"
            ."<li> \n"
            ."<a href=\"javascript:;\" data-target=\"#quick_sidebar_tab_3\" data-toggle=\"tab\"> \n"
            ."<i class=\"icon-info\"></i> Notifications </a> \n"
            ."</li> \n"
            ."<li> \n"
            ."<a href=\"javascript:;\" data-target=\"#quick_sidebar_tab_3\" data-toggle=\"tab\"> \n"
            ."<i class=\"icon-speech\"></i> Activities </a> \n"
            ."</li> \n"
            ."<li class=\"divider\"></li> \n"
            ."<li> \n"
            ."<a href=\"javascript:;\" data-target=\"#quick_sidebar_tab_3\" data-toggle=\"tab\"> \n"
            ."<i class=\"icon-settings\"></i> Settings </a> \n"
            ."</li> \n"
            ."</ul> \n"
            ."</li> \n"
            ."</ul> \n"
            ."<div class=\"tab-content\"> \n"
            ."<div class=\"tab-pane active page-quick-sidebar-chat\" id=\"quick_sidebar_tab_1\"> \n"
            ."<div class=\"page-quick-sidebar-chat-users\" data-rail-color=\"#ddd\" data-wrapper-class=\"page-quick-sidebar-list\"> \n"
            ."<h3 class=\"list-heading\">Staff</h3> \n"
            ."<ul class=\"media-list list-items\"> \n"
            ."<li class=\"media\"> \n"
            ."<div class=\"media-status\"> \n"
            ."<span class=\"badge badge-success\">8</span> \n"
            ."</div> \n"
            ."<img class=\"media-object\" src=\"".$path."assets/layouts/layout/img/avatar3.jpg\" alt=\"...\"> \n"
            ."<div class=\"media-body\"> \n"
            ."<h4 class=\"media-heading\">Bob Nilson</h4> \n"
            ."<div class=\"media-heading-sub\"> Project Manager </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li class=\"media\"> \n"
            ."<img class=\"media-object\" src=\"".$path."assets/layouts/layout/img/avatar1.jpg\" alt=\"...\"> \n"
            ."<div class=\"media-body\"> \n"
            ."<h4 class=\"media-heading\">Nick Larson</h4> \n"
            ."<div class=\"media-heading-sub\"> Art Director </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li class=\"media\"> \n"
            ."<div class=\"media-status\"> \n"
            ."<span class=\"badge badge-danger\">3</span> \n"
            ."</div> \n"
            ."<img class=\"media-object\" src=\"".$path."assets/layouts/layout/img/avatar4.jpg\" alt=\"...\"> \n"
            ."<div class=\"media-body\"> \n"
            ."<h4 class=\"media-heading\">Deon Hubert</h4> \n"
            ."<div class=\"media-heading-sub\"> CTO </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li class=\"media\"> \n"
            ."<img class=\"media-object\" src=\"".$path."assets/layouts/layout/img/avatar2.jpg\" alt=\"...\"> \n"
            ."<div class=\"media-body\"> \n"
            ."<h4 class=\"media-heading\">Ella Wong</h4> \n"
            ."<div class=\"media-heading-sub\"> CEO </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."</ul> \n"
            ."<h3 class=\"list-heading\">Customers</h3> \n"
            ."<ul class=\"media-list list-items\"> \n"
            ."<li class=\"media\"> \n"
            ."<div class=\"media-status\"> \n"
            ."<span class=\"badge badge-warning\">2</span> \n"
            ."</div> \n"
            ."<img class=\"media-object\" src=\"".$path."assets/layouts/layout/img/avatar6.jpg\" alt=\"...\"> \n"
            ."<div class=\"media-body\"> \n"
            ."<h4 class=\"media-heading\">Lara Kunis</h4> \n"
            ."<div class=\"media-heading-sub\"> CEO, Loop Inc </div> \n"
            ."<div class=\"media-heading-small\"> Last seen 03:10 AM </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li class=\"media\"> \n"
            ."<div class=\"media-status\"> \n"
            ."<span class=\"label label-sm label-success\">new</span> \n"
            ."</div> \n"
            ."<img class=\"media-object\" src=\"".$path."assets/layouts/layout/img/avatar7.jpg\" alt=\"...\"> \n"
            ."<div class=\"media-body\"> \n"
            ."<h4 class=\"media-heading\">Ernie Kyllonen</h4> \n"
            ."<div class=\"media-heading-sub\"> Project Manager, \n"
            ."<br> SmartBizz PTL </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li class=\"media\"> \n"
            ."<img class=\"media-object\" src=\"".$path."assets/layouts/layout/img/avatar8.jpg\" alt=\"...\"> \n"
            ."<div class=\"media-body\"> \n"
            ."<h4 class=\"media-heading\">Lisa Stone</h4> \n"
            ."<div class=\"media-heading-sub\"> CTO, Keort Inc </div> \n"
            ."<div class=\"media-heading-small\"> Last seen 13:10 PM </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li class=\"media\"> \n"
            ."<div class=\"media-status\"> \n"
            ."<span class=\"badge badge-success\">7</span> \n"
            ."</div> \n"
            ."<img class=\"media-object\" src=\"".$path."assets/layouts/layout/img/avatar9.jpg\" alt=\"...\"> \n"
            ."<div class=\"media-body\"> \n"
            ."<h4 class=\"media-heading\">Deon Portalatin</h4> \n"
            ."<div class=\"media-heading-sub\"> CFO, H&D LTD </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li class=\"media\"> \n"
            ."<img class=\"media-object\" src=\"".$path."assets/layouts/layout/img/avatar10.jpg\" alt=\"...\"> \n"
            ."<div class=\"media-body\"> \n"
            ."<h4 class=\"media-heading\">Irina Savikova</h4> \n"
            ."<div class=\"media-heading-sub\"> CEO, Tizda Motors Inc </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li class=\"media\"> \n"
            ."<div class=\"media-status\"> \n"
            ."<span class=\"badge badge-danger\">4</span> \n"
            ."</div> \n"
            ."<img class=\"media-object\" src=\"".$path."assets/layouts/layout/img/avatar11.jpg\" alt=\"...\"> \n"
            ."<div class=\"media-body\"> \n"
            ."<h4 class=\"media-heading\">Maria Gomez</h4> \n"
            ."<div class=\"media-heading-sub\"> Manager, Infomatic Inc </div> \n"
            ."<div class=\"media-heading-small\"> Last seen 03:10 AM </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."</ul> \n"
            ."</div> \n"
            ."<div class=\"page-quick-sidebar-item\"> \n"
            ."<div class=\"page-quick-sidebar-chat-user\"> \n"
            ."<div class=\"page-quick-sidebar-nav\"> \n"
            ."<a href=\"javascript:;\" class=\"page-quick-sidebar-back-to-list\"> \n"
            ."<i class=\"icon-arrow-left\"></i>Back</a> \n"
            ."</div> \n"
            ."<div class=\"page-quick-sidebar-chat-user-messages\"> \n"
            ."<div class=\"post out\"> \n"
            ."<img class=\"avatar\" alt=\"\" src=\"".$path."assets/layouts/layout/img/avatar3.jpg\" /> \n"
            ."<div class=\"message\"> \n"
            ."<span class=\"arrow\"></span> \n"
            ."<a href=\"javascript:;\" class=\"name\">Bob Nilson</a> \n"
            ."<span class=\"datetime\">20:15</span> \n"
            ."<span class=\"body\"> When could you send me the report ? </span> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"post in\"> \n"
            ."<img class=\"avatar\" alt=\"\" src=\"".$path."assets/layouts/layout/img/avatar2.jpg\" /> \n"
            ."<div class=\"message\"> \n"
            ."<span class=\"arrow\"></span> \n"
            ."<a href=\"javascript:;\" class=\"name\">Ella Wong</a> \n"
            ."<span class=\"datetime\">20:15</span> \n"
            ."<span class=\"body\"> Its almost done. I will be sending it shortly </span> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"post out\"> \n"
            ."<img class=\"avatar\" alt=\"\" src=\"".$path."assets/layouts/layout/img/avatar3.jpg\" /> \n"
            ."<div class=\"message\"> \n"
            ."<span class=\"arrow\"></span> \n"
            ."<a href=\"javascript:;\" class=\"name\">Bob Nilson</a> \n"
            ."<span class=\"datetime\">20:15</span> \n"
            ."<span class=\"body\"> Alright. Thanks! :) </span> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"post in\"> \n"
            ."<img class=\"avatar\" alt=\"\" src=\"".$path."assets/layouts/layout/img/avatar2.jpg\" /> \n"
            ."<div class=\"message\"> \n"
            ."<span class=\"arrow\"></span> \n"
            ."<a href=\"javascript:;\" class=\"name\">Ella Wong</a> \n"
            ."<span class=\"datetime\">20:16</span> \n"
            ."<span class=\"body\"> You are most welcome. Sorry for the delay. </span> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"post out\"> \n"
            ."<img class=\"avatar\" alt=\"\" src=\"".$path."assets/layouts/layout/img/avatar3.jpg\" /> \n"
            ."<div class=\"message\"> \n"
            ."<span class=\"arrow\"></span> \n"
            ."<a href=\"javascript:;\" class=\"name\">Bob Nilson</a> \n"
            ."<span class=\"datetime\">20:17</span> \n"
            ."<span class=\"body\"> No probs. Just take your time :) </span> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"post in\"> \n"
            ."<img class=\"avatar\" alt=\"\" src=\"".$path."assets/layouts/layout/img/avatar2.jpg\" /> \n"
            ."<div class=\"message\"> \n"
            ."<span class=\"arrow\"></span> \n"
            ."<a href=\"javascript:;\" class=\"name\">Ella Wong</a> \n"
            ."<span class=\"datetime\">20:40</span> \n"
            ."<span class=\"body\"> Alright. I just emailed it to you. </span> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"post out\"> \n"
            ."<img class=\"avatar\" alt=\"\" src=\"".$path."assets/layouts/layout/img/avatar3.jpg\" /> \n"
            ."<div class=\"message\"> \n"
            ."<span class=\"arrow\"></span> \n"
            ."<a href=\"javascript:;\" class=\"name\">Bob Nilson</a> \n"
            ."<span class=\"datetime\">20:17</span> \n"
            ."<span class=\"body\"> Great! Thanks. Will check it right away. </span> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"post in\"> \n"
            ."<img class=\"avatar\" alt=\"\" src=\"".$path."assets/layouts/layout/img/avatar2.jpg\" /> \n"
            ."<div class=\"message\"> \n"
            ."<span class=\"arrow\"></span> \n"
            ."<a href=\"javascript:;\" class=\"name\">Ella Wong</a> \n"
            ."<span class=\"datetime\">20:40</span> \n"
            ."<span class=\"body\"> Please let me know if you have any comment. </span> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"post out\"> \n"
            ."<img class=\"avatar\" alt=\"\" src=\"".$path."assets/layouts/layout/img/avatar3.jpg\" /> \n"
            ."<div class=\"message\"> \n"
            ."<span class=\"arrow\"></span> \n"
            ."<a href=\"javascript:;\" class=\"name\">Bob Nilson</a> \n"
            ."<span class=\"datetime\">20:17</span> \n"
            ."<span class=\"body\"> Sure. I will check and buzz you if anything needs to be corrected. </span> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"page-quick-sidebar-chat-user-form\"> \n"
            ."<div class=\"input-group\"> \n"
            ."<input type=\"text\" class=\"form-control\" placeholder=\"Type a message here...\"> \n"
            ."<div class=\"input-group-btn\"> \n"
            ."<button type=\"button\" class=\"btn green\"> \n"
            ."<i class=\"icon-paper-clip\"></i> \n"
            ."</button> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"tab-pane page-quick-sidebar-alerts\" id=\"quick_sidebar_tab_2\"> \n"
            ."<div class=\"page-quick-sidebar-alerts-list\"> \n"
            ."<h3 class=\"list-heading\">General</h3> \n"
            ."<ul class=\"feeds list-items\"> \n"
            ."<li> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-info\"> \n"
            ."<i class=\"fa fa-check\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> You have 4 pending tasks. \n"
            ."<span class=\"label label-sm label-warning \"> Take action \n"
            ."<i class=\"fa fa-share\"></i> \n"
            ."</span> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> Just now </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li> \n"
            ."<a href=\"javascript:;\"> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-success\"> \n"
            ."<i class=\"fa fa-bar-chart-o\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> Finance Report for year 2013 has been released. </div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> 20 mins </div> \n"
            ."</div> \n"
            ."</a> \n"
            ."</li> \n"
            ."<li> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-danger\"> \n"
            ."<i class=\"fa fa-user\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> You have 5 pending membership that requires a quick review. </div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> 24 mins </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-info\"> \n"
            ."<i class=\"fa fa-shopping-cart\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> New order received with \n"
            ."<span class=\"label label-sm label-success\"> Reference Number: DR23923 </span> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> 30 mins </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-success\"> \n"
            ."<i class=\"fa fa-user\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> You have 5 pending membership that requires a quick review. </div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> 24 mins </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-info\"> \n"
            ."<i class=\"fa fa-bell-o\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> Web server hardware needs to be upgraded. \n"
            ."<span class=\"label label-sm label-warning\"> Overdue </span> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> 2 hours </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li> \n"
            ."<a href=\"javascript:;\"> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-default\"> \n"
            ."<i class=\"fa fa-briefcase\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> IPO Report for year 2013 has been released. </div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> 20 mins </div> \n"
            ."</div> \n"
            ."</a> \n"
            ."</li> \n"
            ."</ul> \n"
            ."<h3 class=\"list-heading\">System</h3> \n"
            ."<ul class=\"feeds list-items\"> \n"
            ."<li> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-info\"> \n"
            ."<i class=\"fa fa-check\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> You have 4 pending tasks. \n"
            ."<span class=\"label label-sm label-warning \"> Take action \n"
            ."<i class=\"fa fa-share\"></i> \n"
            ."</span> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> Just now </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li> \n"
            ."<a href=\"javascript:;\"> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-danger\"> \n"
            ."<i class=\"fa fa-bar-chart-o\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> Finance Report for year 2013 has been released. </div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> 20 mins </div> \n"
            ."</div> \n"
            ."</a> \n"
            ."</li> \n"
            ."<li> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-default\"> \n"
            ."<i class=\"fa fa-user\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> You have 5 pending membership that requires a quick review. </div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> 24 mins </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-info\"> \n"
            ."<i class=\"fa fa-shopping-cart\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> New order received with \n"
            ."<span class=\"label label-sm label-success\"> Reference Number: DR23923 </span> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> 30 mins </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-success\"> \n"
            ."<i class=\"fa fa-user\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> You have 5 pending membership that requires a quick review. </div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> 24 mins </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-warning\"> \n"
            ."<i class=\"fa fa-bell-o\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> Web server hardware needs to be upgraded. \n"
            ."<span class=\"label label-sm label-default \"> Overdue </span> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> 2 hours </div> \n"
            ."</div> \n"
            ."</li> \n"
            ."<li> \n"
            ."<a href=\"javascript:;\"> \n"
            ."<div class=\"col1\"> \n"
            ."<div class=\"cont\"> \n"
            ."<div class=\"cont-col1\"> \n"
            ."<div class=\"label label-sm label-info\"> \n"
            ."<i class=\"fa fa-briefcase\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"cont-col2\"> \n"
            ."<div class=\"desc\"> IPO Report for year 2013 has been released. </div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"col2\"> \n"
            ."<div class=\"date\"> 20 mins </div> \n"
            ."</div> \n"
            ."</a> \n"
            ."</li> \n"
            ."</ul> \n"
            ."</div> \n"
            ."</div> \n"
            ."<div class=\"tab-pane page-quick-sidebar-settings\" id=\"quick_sidebar_tab_3\"> \n"
            ."<div class=\"page-quick-sidebar-settings-list\"> \n"
            ."<h3 class=\"list-heading\">General Settings</h3> \n"
            ."<ul class=\"list-items borderless\"> \n"
            ."<li> Enable Notifications \n"
            ."<input type=\"checkbox\" class=\"make-switch\" checked data-size=\"small\" data-on-color=\"success\" data-on-text=\"ON\" data-off-color=\"default\" data-off-text=\"OFF\"> </li> \n"
            ."<li> Allow Tracking \n"
            ."<input type=\"checkbox\" class=\"make-switch\" data-size=\"small\" data-on-color=\"info\" data-on-text=\"ON\" data-off-color=\"default\" data-off-text=\"OFF\"> </li> \n"
            ."<li> Log Errors \n"
            ."<input type=\"checkbox\" class=\"make-switch\" checked data-size=\"small\" data-on-color=\"danger\" data-on-text=\"ON\" data-off-color=\"default\" data-off-text=\"OFF\"> </li> \n"
            ."<li> Auto Sumbit Issues \n"
            ."<input type=\"checkbox\" class=\"make-switch\" data-size=\"small\" data-on-color=\"warning\" data-on-text=\"ON\" data-off-color=\"default\" data-off-text=\"OFF\"> </li> \n"
            ."<li> Enable SMS Alerts \n"
            ."<input type=\"checkbox\" class=\"make-switch\" checked data-size=\"small\" data-on-color=\"success\" data-on-text=\"ON\" data-off-color=\"default\" data-off-text=\"OFF\"> </li> \n"
            ."</ul> \n"
            ."<h3 class=\"list-heading\">System Settings</h3> \n"
            ."<ul class=\"list-items borderless\"> \n"
            ."<li> Security Level \n"
            ."<select class=\"form-control input-inline input-sm input-small\"> \n"
            ."<option value=\"1\">Normal</option> \n"
            ."<option value=\"2\" selected>Medium</option> \n"
            ."<option value=\"e\">High</option> \n"
            ."</select> \n"
            ."</li> \n"
            ."<li> Failed Email Attempts \n"
            ."<input class=\"form-control input-inline input-sm input-small\" value=\"5\" /> </li> \n"
            ."<li> Secondary SMTP Port \n"
            ."<input class=\"form-control input-inline input-sm input-small\" value=\"3560\" /> </li> \n"
            ."<li> Notify On System Error \n"
            ."<input type=\"checkbox\" class=\"make-switch\" checked data-size=\"small\" data-on-color=\"danger\" data-on-text=\"ON\" data-off-color=\"default\" data-off-text=\"OFF\"> </li> \n"
            ."<li> Notify On SMTP Error \n"
            ."<input type=\"checkbox\" class=\"make-switch\" checked data-size=\"small\" data-on-color=\"warning\" data-on-text=\"ON\" data-off-color=\"default\" data-off-text=\"OFF\"> </li> \n"
            ."</ul> \n"
            ."<div class=\"inner-content\"> \n"
            ."<button class=\"btn btn-success\"> \n"
            ."<i class=\"icon-settings\"></i> Save Changes</button> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<!-- END QUICK SIDEBAR --> \n";

    }
//==============================================================================================================================================================================================================================================================================================================================//
    
    function EndContainer($path){
        echo "</div> \n"
            ."<!-- END CONTAINER --> \n";
    }
//==============================================================================================================================================================================================================================================================================================================================//
        
    function Footer($path){    
        
        echo "<!-- BEGIN FOOTER --> \n"
            ."<div class=\"page-footer\"> \n"
            ."<div class=\"page-footer-inner\"> 2016 &copy; SmartNova Admin Dashboard. \n"
            //."<a href=\"http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes\" title=\"Purchase Metronic just for 27$ and get lifetime updates for free\" target=\"_blank\">Purchase Metronic!</a> \n"
            ."</div> \n"
            ."<div class=\"scroll-to-top\"> \n"
            ."<i class=\"icon-arrow-up\"></i> \n"
            ."</div> \n"
            ."</div> \n"
            ."<!-- END FOOTER --> \n";
        
        // Compatibilidad con Internet Explorer
        echo "<!--[if lt IE 9]> \n"
            ."<script src=\"".$path."assets/global/plugins/respond.min.js\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/excanvas.min.js\"></script> \n"
            ."<![endif]--> \n";
    }
//==============================================================================================================================================================================================================================================================================================================================//
        
    function ScriptsJS($path, $sjs){    
        echo "<!--[if lt IE 9]> \n"
            ."<script src=\"".$path."assets/global/plugins/respond.min.js\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/excanvas.min.js\"></script>  \n"
            ."<![endif]--> \n"
            ."<!-- BEGIN CORE PLUGINS --> \n"
            ."<script src=\"".$path."assets/global/plugins/jquery.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/bootstrap/js/bootstrap.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/js.cookie.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/jquery.blockui.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/uniform/jquery.uniform.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js\" type=\"text/javascript\"></script> \n"
            ."<!-- END CORE PLUGINS --> \n"
            ."<!-- BEGIN THEME GLOBAL SCRIPTS --> \n"
            ."<script src=\"".$path."assets/global/scripts/app.min.js\" type=\"text/javascript\"></script> \n"
            ."<!-- END THEME GLOBAL SCRIPTS --> \n"
            ."<!-- BEGIN THEME LAYOUT SCRIPTS --> \n"
            ."<script src=\"".$path."assets/layouts/layout/scripts/layout.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/layouts/layout/scripts/demo.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/layouts/global/scripts/quick-sidebar.min.js\" type=\"text/javascript\"></script> \n"
            ."<!-- END THEME LAYOUT SCRIPTS --> \n"
            ."<!-- BEGIN PAGE LEVEL PLUGINS --> \n"
            ."<script src=\"".$path."assets/global/plugins/ckeditor/ckeditor.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js\" type=\"text/javascript\"></script> \n"       
            ."<script src=\"".$path."assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js\" type=\"text/javascript\"></script> \n"            
            ."<script src=\"".$path."assets/global/plugins/select2/js/select2.full.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/responsive-filemanager/filemanager/popup.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/icheck/icheck.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/scripts/datatable.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/datatables/datatables.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/icheck/icheck.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/global/plugins/jquery.foggle.min.js\" type=\"text/javascript\"></script> \n"    
            ."<script src=\"".$path."assets/global/plugins/parsley/dist/parsley.js\" type=\"text/javascript\"></script> \n"    
            ."<script src=\"".$path."assets/global/plugins/parsley/dist/i18n/es.js\" type=\"text/javascript\"></script> \n"    
            
            ."<script src=\"".$path."assets/pages/scripts/components-select2.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/pages/scripts/components-date-time-pickers.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/pages/scripts/components-color-pickers.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/pages/scripts/components-bootstrap-select.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/pages/scripts/components-multi-select.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/pages/scripts/form-icheck.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/pages/scripts/table-datatables-buttons.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/pages/scripts/form-icheck.min.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/pages/scripts/custom.js\" type=\"text/javascript\"></script> \n"
            ."<script src=\"".$path."assets/pages/scripts/components-bootstrap-switch.min.js\" type=\"text/javascript\"></script> \n"            
            //."<script src=\"".$path."assets/pages/scripts/ui-modals.min.js\" type=\"text/javascript\"></script> \n"
            ."<!-- END PAGE LEVEL PLUGINS --> \n";
            echo "<script type=\"text/javascript\"> \n"
                ."$(document).ready(function(){ \n"
                ."$(\"#basic\").modal('show'); \n"
                ."}); \n"
                ."</script> \n";
            echo "<script type=\"text/javascript\"> \n"
                ."$('.my').iconpicker({ \n"
                ."placement: 'bottomLeft', \n"  
                    
                ."}); \n"
                ."</script> \n";
            
        // Scripts adicionales
        echo $sjs." \n";
    }
//==============================================================================================================================================================================================================================================================================================================================//
       
    function EndBody($path){    
        echo "</body> \n"
            ."</html> \n";
    }
//==============================================================================================================================================================================================================================================================================================================================//

    function CommonHeader($path, $page_title, $meta, $css, $js, $objetivo, $actions_pagebar, $config){
        
        // Default del subtitulo de la pagina de la pagina
        $page_subtitle = (isset($config['page_subtitle'])) ? $config['page_subtitle'] : "";
        
        // Default de la clase del cuerpo de la pagina
        $body_class = (isset($config['body_class'])) ? $config['body_class'] : '';
        
        // Default de la clase del cuerpo de la pagina
        $invert_pagebar = (isset($config['invert_pagebar']) && ($config['invert_pagebar'] == TRUE)) ? TRUE : FALSE;
        
        HeaderHTML($path, $page_title, $meta, $css, $js, $config);
        BeginBody($path, $body_class);
        PageHeader($path);
        HeaderContentDivider($path);
        BeginContainer($path);
        Sidebar($path);
        BeginContent($path);
        //ThemePanel($path);
        
        if ($invert_pagebar == FALSE){
            PageTitle($path, $page_title, $page_subtitle);
            PageBar($path, $objetivo, $actions_pagebar);
        }
        else{
            PageBar($path, $objetivo, $actions_pagebar);
            PageTitle($path, $page_title, $page_subtitle);
        }
    }
//==============================================================================================================================================================================================================================================================================================================================//

    function CommonFooter($path, $sjs, $config){
        EndContent($path);
        //QuickSidebar($path);
        EndContainer($path);
        Footer($path);
        ScriptsJS($path, $sjs);
        EndBody($path);
    }
//==============================================================================================================================================================================================================================================================================================================================//

?>    