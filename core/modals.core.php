<?php

    /********************************************************/
    /* Administrador Web SmartNova                            */
    /* Funciones de cadenas de caracteres                   */
    /* Junio de 2016                                        */
    /********************************************************/

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//


//function ModalMessage($modal_type, $modal_message){
//        
//        // Apertura del div del modal
//        echo "<div id=\"modal_mensaje\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\"> \n"
//            ."<div class=\"modal-dialog\"> \n"
//            ."<div class=\"modal-content\"> \n"
//            ."<div class=\"modal-header\"> \n"
//            ."<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button> \n"
//            ."<h3 id=\"myModalLabel\">Mensaje de la Operaci&oacute;n</h3> \n"
//            ."</div> \n"
//            ."<div class=\"modal-body\"> \n";
//        
//        if (isset($_SESSION['mesg_adic_insr'])){
//            $mensaje_adicional = $_SESSION['mesg_adic_insr'];
//        }
//        else {
//            $mensaje_adicional = "";
//        }
//        
//        switch ($modal_type) {
//            case "success": 
//                 echo "<p class=\"mensaje_success\"><strong>&iexcl;Exito!</strong> ".$modal_message.$mensaje_adicional."</p> \n"; 
//            break;
//        
//            case "warning": 
//                 echo "<p class=\"mensaje_warning\"><strong>&iexcl;Alerta!</strong> ".$modal_message."</p> \n"; 
//            break;
//        
//            case "error": 
//                 echo "<p class=\"mensaje_error\"><strong>&iexcl;Error!</strong> ".$modal_message."</p> \n"; 
//            break;
//       
//        }
//        
//        // Conclusion del Modal
//        echo "</div> \n"
//            ."<div class=\"modal-footer\"> \n"
//            ."<button class=\"button blue button-modal\" data-dismiss=\"modal\" aria-hidden=\"true\">Cerrar</button> \n"         
//            ."</div> \n"
//            ."</div><!-- /.modal-content --> \n"
//            ."</div><!-- /.modal-dialog --> \n"
//            ."</div> \n";
//    }
//==========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================//

    // $modal_type valores: basic | full |
    function ModalMessage($modal_title, $modal_alert_type, $modal_message, $modal_config){
        
        // Default para el tipo de modal
//        $modal_config['modal_type'] = (isset($modal_config['modal_type'])) ? $modal_config['modal_type'] : "basic";
        
        switch ($modal_alert_type) {
            case "success": 
                $mensaje = "<p> \n"                   
                    ."<i class=\"fa fa-check font-green-meadow\"></i> \n"
                    ."<strong class=\"font-green-meadow\">&iexcl;&Eacute;xito!</strong> \n"
                    .$modal_message." \n"
                    ."</p> \n"; 
                $class = "alert-success"; 
                $buton = "green";
            break;
        
            case "warning": 
                $mensaje = "<p> \n"                   
                    ."<i class=\"fa fa-warning font-yellow-crusta\"></i> \n"
                    ."<strong class=\"font-yellow-crusta\">&iexcl;Alerta!</strong> \n"
                    .$modal_message." \n"
                    ."</p> \n"; 
                $class = "alert-warning";
                $buton = "yellow";
            break;
        
            case "error": 
                $mensaje = "<p> \n"                   
                    ."<i class=\"fa fa-exclamation-circle font-red\"></i> \n"
                    ."<strong class=\"font-red\">&iexcl;Error!</strong> \n"
                    .$modal_message." \n"
                    ."</p> \n"; 
                $class = "alert-danger";
                $buton = "red";
            break;
        
            case "info": 
                $mensaje = "<p> \n"                   
                    ."<i class=\"fa fa-info-circle font-blue\"></i> \n"
                    ."<strong class=\"font-blue\">&iexcl;Informaci&oacute;n!</strong> \n"
                    .$modal_message." \n"
                    ."</p> \n"; 
                $class = "alert-info";
                $buton = "blue";
            break;
        }
        
        echo "<div class=\"modal fade\" id=\"basic\" tabindex=\"-1\" role=\"basic\" aria-hidden=\"true\"> \n"
            ."<div class=\"modal-dialog\"> \n"
            ."<div class=\"modal-content\"> \n"
            ."<div class=\"modal-header ".$class."\"> \n"
            ."<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"></button> \n"
            ."<h4 class=\"modal-title\"><strong>".$modal_title."</strong></h4> \n"
            ."</div> \n"
            ."<div class=\"modal-body\"> \n";
                
        echo $mensaje;
                
        echo " </div> \n"
            ."<div class=\"modal-footer ".$class."\"> \n"
            ."<button type=\"button\" class=\"btn ".$buton."\" data-dismiss=\"modal\">Cerrar</button> \n"
            ."</div> \n"
            ."</div> \n"
            ."<!-- /.modal-content --> \n"
            ."</div> \n"
            ."<!-- /.modal-dialog --> \n"
            ."</div> \n";
    }
//==========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================//

    function ModalConfirmDelete(){
    
        echo "<div class=\"modal fade\" id=\"confirm-delete\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\"> \n"
            ."<div class=\"modal-dialog\"> \n"
            ."<div class=\"modal-content\"> \n"
                
            ."<div class=\"modal-header alert-danger\"> \n"
            ."<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"></button> \n"
            ."<h4 class=\"modal-title\">Eliminar el Registro</h4> \n"
            ."</div> \n"
                
            // Cuerpo del modal
            ."<div class=\"modal-body\"> \n"               
            ."<p> \n"                   
            ."<i class=\"fa fa-warning font-red\"></i> \n"
            ."<strong class=\"font-red\">&iexcl;Advertencia!</strong> \n"
            ."&iquest;Est&aacute; completamente seguro de eliminar el registro?. Luego de realizada la operaci&oacute;n no se podr&aacute; recuperar"." \n"
            ."</p> \n"               
            ."</div> \n"
                
            // Botones de accion
            ."<div class=\"modal-footer alert-danger\"> \n"
            ."<button type=\"button\" class=\"btn btn-default \" data-dismiss=\"modal\"> \n"
            ."<i class=\"fa fa-times-circle\"></i> \n"
            ."Cancelar \n"
            ."</button> \n"
                
            ."<a class=\"btn btn-danger btn-ok\"> \n"
            ."<i class=\"fa fa-minus-circle\"></i> \n"
            ."Eliminar \n"
            ."</a> \n"
                
            ."</div> \n"
            ."</div> \n"
            ."</div> \n"
            ."</div> \n";
    }
//==========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================//

    
    function PermisosMensajeError(){
        
        echo "<div class=\"modal fade\" id=\"basic\" tabindex=\"-1\" role=\"basic\" aria-hidden=\"true\"> \n"
            ."<div class=\"modal-dialog\"> \n"
            ."<div class=\"modal-content\"> \n"
            ."<div class=\"modal-header alert-danger\"> \n"
            ."<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"></button> \n"
            ."<h4 class=\"modal-title\"><strong>Permisos de Ejecusi&oacute;n</strong></h4> \n"
            ."</div> \n"
            ."<div class=\"modal-body\"> \n";
                
        echo "<p> \n"                   
            ."<i class=\"fa fa-exclamation-circle font-red\"></i> \n"
            ."<strong class=\"font-red\">&iexcl;Error!</strong> \n"
            ."La opci&oacute;n de a la que intenta acceder no est&aacute; habilitada para esta cuenta de administrador"." \n"
            ."</p> \n"; 
          
        echo " </div> \n"
            ."<div class=\"modal-footer alert-danger\"> \n"
            ."<button type=\"button\" class=\"btn red\" data-dismiss=\"modal\">Cerrar</button> \n"
            ."</div> \n"
            ."</div> \n"
            ."<!-- /.modal-content --> \n"
            ."</div> \n"
            ."<!-- /.modal-dialog --> \n"
            ."</div> \n";
    }
//==========================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================//