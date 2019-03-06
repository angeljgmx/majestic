<?php

    /********************************************************/
    /* Administrador Web SmartNova                            */
    /* Funciones del administrador                          */
    /* Junio de 2016                                        */
    /********************************************************/

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    
    function ProfileSidebar($path){
        
        // Inclusion de librerias       
        require_once $path.'core/db.class.core.php';
         
        // Control de errores
        $debug = DEBUG;
        
        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion();
        
        // Consulta de los datos del administrador
        $sql_adms = "SELECT * FROM tbla_adms WHERE id = '".$_SESSION['sson_idpr']."'";
        $query_adms = $conec->dbQuery($sql_adms, $debug);
        $datos_adms = $conec->dbFetchObjet($query_adms);
        
        
        
        echo "<div class=\"col-md-3\"> \n"
            ."<!-- BEGIN PROFILE SIDEBAR --> \n"
            ."<div class=\"\"> \n"
            ."<!-- PORTLET MAIN --> \n"
            ."<div class=\"portlet light profile-sidebar-portlet \"> \n";
            
        echo "<!-- SIDEBAR USERPIC --> \n"
            ."<div class=\"profile-userpic\"> \n";
        
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
            ."<div class=\"profile-usertitle-name\"> ".$datos_adms->adms_nomb." ".$datos_adms->adms_apll."</div> \n"
            ."<div class=\"profile-usertitle-job\"> Administrador </div> \n"
            ."</div> \n"
            ."<!-- END SIDEBAR USER TITLE --> \n"
//            ."<!-- SIDEBAR BUTTONS --> \n"
//            ."<div class=\"profile-userbuttons\"> \n"
//            ."<button type=\"button\" class=\"btn btn-circle green btn-sm\">Follow</button> \n"
//            ."<button type=\"button\" class=\"btn btn-circle red btn-sm\">Message</button> \n"
//            ."</div> \n"
//            ."<!-- END SIDEBAR BUTTONS --> \n"
//            ."<!-- SIDEBAR MENU --> \n"
//            ."<div class=\"profile-usermenu\"> \n"
//            ."<ul class=\"nav\"> \n"
//            ."<li class=\"active\"> \n"
//            ."<a href=\"page_user_profile_1.html\"> \n"
//            ."<i class=\"icon-home\"></i> Overview </a> \n"
//            ."</li> \n"
//            ."<li> \n"
//            ."<a href=\"page_user_profile_1_account.html\"> \n"
//            ."<i class=\"icon-settings\"></i> Account Settings </a> \n"
//            ."</li> \n"
//            ."<li> \n"
//            ."<a href=\"page_user_profile_1_help.html\"> \n"
//            ."<i class=\"icon-info\"></i> Help </a> \n"
//            ."</li> \n"
//            ."</ul> \n"
//            ."</div> \n"
//            ."<!-- END MENU --> \n"
            ."</div> \n"
            ."<!-- END PORTLET MAIN --> \n"
            ."<!-- PORTLET MAIN --> \n"
            ."<div class=\"portlet light \"> \n"
//            ."<!-- STAT --> \n"
//            ."<div class=\"row list-separated profile-stat\"> \n"
//            ."<div class=\"col-md-4 col-sm-4 col-xs-6\"> \n"
//            ."<div class=\"uppercase profile-stat-title\"> 37 </div> \n"
//            ."<div class=\"uppercase profile-stat-text\"> Projects </div> \n"
//            ."</div> \n"
//            ."<div class=\"col-md-4 col-sm-4 col-xs-6\"> \n"
//            ."<div class=\"uppercase profile-stat-title\"> 51 </div> \n"
//            ."<div class=\"uppercase profile-stat-text\"> Tasks </div> \n"
//            ."</div> \n"
//            ."<div class=\"col-md-4 col-sm-4 col-xs-6\"> \n"
//            ."<div class=\"uppercase profile-stat-title\"> 61 </div> \n"
//            ."<div class=\"uppercase profile-stat-text\"> Uploads </div> \n"
//            ."</div> \n"
//            ."</div> \n"
//            ."<!-- END STAT --> \n"
            ."<div> \n"
//            ."<h4 class=\"profile-desc-title\">About Marcus Doe</h4> \n"
//            ."<span class=\"profile-desc-text\"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span> \n"
            ."<div class=\"margin-top-20 profile-desc-link\"> \n"
            ."<i class=\"fa fa-envelope\"></i> \n"
            ."<a href=\"mailto:".$datos_adms->adms_mail."\">".$datos_adms->adms_mail."</a> \n"
            ."</div> \n"
//            ."<div class=\"margin-top-20 profile-desc-link\"> \n"
//            ."<i class=\"fa fa-twitter\"></i> \n"
//            ."<a href=\"http://www.twitter.com/keenthemes/\">@keenthemes</a> \n"
//            ."</div> \n"
//            ."<div class=\"margin-top-20 profile-desc-link\"> \n"
//            ."<i class=\"fa fa-facebook\"></i> \n"
//            ."<a href=\"http://www.facebook.com/keenthemes/\">keenthemes</a> \n"
//            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."<!-- END PORTLET MAIN --> \n"
            ."</div> \n"
            ."<!-- END BEGIN PROFILE SIDEBAR --> \n"
            ."</div> \n";
    }
                        
        
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

?>