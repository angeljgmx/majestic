<?php

    /********************************************************/
    /* Administrador Web SmartNova                            */
    /* Funciones de fechas                                  */
    /* Junio de 2016                                        */
    /********************************************************/

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    function FechaActual($FechaStamp){ 
        $ano = date('Y',$FechaStamp);
        $mes = date('n',$FechaStamp);
        $dia = date('d',$FechaStamp);
        $diasemana = date('w',$FechaStamp);

        $diassemanaN = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","Sábado");
        $mesesN = array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return $diassemanaN[$diasemana].", $dia de ". $mesesN[$mes] ." de $ano";
    }
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    function Fecha($fecha, $tipo){
        $agno = date("Y",strtotime($fecha)); //<-- Año
        $mes = date("m",strtotime($fecha)); //<-- número de mes (01-31)
        $dia = date("d",strtotime($fecha)); //<-- Día del mes (1-31)
        $nombre_dia = date('l',strtotime($fecha));  //<-- Día de la semana(Lunes - Domingo)
        $nombre_mes = date('F',strtotime($fecha));	

        // Obtenemos y traducimos el nombre del día
        if ($nombre_dia=="Monday") $nombre_dia="Lunes";
        if ($nombre_dia=="Tuesday") $nombre_dia="Martes";
        if ($nombre_dia=="Wednesday") $nombre_dia="Mi&eacute;rcoles";
        if ($nombre_dia=="Thursday") $nombre_dia="Jueves";
        if ($nombre_dia=="Friday") $nombre_dia="Viernes";
        if ($nombre_dia=="Saturday") $nombre_dia="Sabado";
        if ($nombre_dia=="Sunday") $nombre_dia="Domingo";

        // Obtenemos y traducimos el nombre del mes
        if ($nombre_mes=="January"){
            $nombre_mes="Enero";
            $nombre_mesc="Ene";
        }
        if ($nombre_mes=="February"){
            $nombre_mes="Febrero";
            $nombre_mesc="Feb";
        }
        if ($nombre_mes=="March"){
            $nombre_mes="Marzo";
            $nombre_mesc="Mar";
        }
        if ($nombre_mes=="April"){
            $nombre_mes="Abril";
            $nombre_mesc="Abr";
        }
        if ($nombre_mes=="May"){
            $nombre_mes="Mayo";
            $nombre_mesc="May";
        }
        if ($nombre_mes=="June"){
            $nombre_mes="Junio";
            $nombre_mesc="Jun";
        }
        if ($nombre_mes=="July"){
            $nombre_mes="Julio";
            $nombre_mesc="Jul";
        }
        if ($nombre_mes=="August"){
            $nombre_mes="Agosto";
            $nombre_mesc="Ago";
        }
        if ($nombre_mes=="September"){
            $nombre_mes="Septiembre";
            $nombre_mesc="Sep";
        }
        if ($nombre_mes=="October"){
            $nombre_mes="Octubre";
            $nombre_mesc="Oct";
        }
        if ($nombre_mes=="November"){
            $nombre_mes="Noviembre";
            $nombre_mesc="Nov";
        }
        if ($nombre_mes=="December"){
            $nombre_mes="Diciembre";
            $nombre_mesc="Dic";
        }

        if ($tipo == "fecha-completa"){
            // obtenemos la fecha completa
            $fechan = $nombre_dia." ".$dia." de ".$nombre_mes." de ".$agno.".";
        }
        
        if ($tipo == "mesc"){
            $fechan = $nombre_mesc;
        }
        if ($tipo == "fecha-corta"){
            $fechan = $nombre_mesc." ".date("d, Y",strtotime($fecha));
        } 

        if ($tipo == "mesy"){
            $fechan = $nombre_mesc." ".date("Y",strtotime($fecha));
        }

        if ($tipo == "mes"){
            $fechan = $nombre_mes;
        }

        if ($tipo == "mesc-dia"){
            $fechan = $nombre_mesc." ".date("d",strtotime($fecha));
        }

        if ($tipo == "dia"){
            $fechan = date("d",strtotime($fecha));
        }
        
        if ($tipo == "year"){
            $fechan = date("Y",strtotime($fecha));
        }
        
        if ($tipo == "fecha-hora"){
            
            $fechan = $nombre_mesc." ".date("d, Y, g:i a",strtotime($fecha));
        }
        
        if ($tipo == "fecha"){
            $fechan = date("d-m-Y",strtotime($fecha));
        }

        return $fechan;
    }
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    function TimeAgo($time_ago){
        $cur_time 	= time();
        $time_elapsed 	= $cur_time - $time_ago;
        $seconds 	= $time_elapsed ;
        $minutes 	= round($time_elapsed / 60 );
        $hours 		= round($time_elapsed / 3600);
        $days 		= round($time_elapsed / 86400 );
        $weeks 		= round($time_elapsed / 604800);
        $months 	= round($time_elapsed / 2600640 );
        $years 		= round($time_elapsed / 31207680 );
        
        // Seconds
        if($seconds <= 60){
            $time_ago = "$seconds segundos antes";
        }
        
        //Minutos
        else if($minutes <=60){
            if($minutes==1){
                $time_ago = "un minuto antes";
            }
            else{
                $time_ago = "$minutes minutos antes";
            }
        }
        
        //Hours
        else if($hours <=24){
            if($hours==1){
                $time_ago = "una hora antes";
            }
            else{
                $time_ago = "$hours horas antes";
            }
        }
        
        //Days
        else if($days <= 7){
            if($days==1){
                $time_ago = "ayer";
            }
            else{
                $time_ago = "$days d&iacute;as atr&aacute;s";
            }
        }
        
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                $time_ago = "una semana atr&aacute;s";
            }
            else{
                $time_ago = "$weeks semanas atr&aacute;s";
            }
        }
        
        //Months
        else if($months <=12){
            if($months==1){
                    $time_ago = "un mes atr&aacute;s";
            }
            else{
                    $time_ago = "$months meses atr&aacute;s";
            }
        }
        
        //Years
        else{
            if($years==1){
                    $time_ago = "un a&ntilde;o atr&aacute;s";
            }else{
                    $time_ago = "$years a&ntilde;os atr&aacute;s";
            }
        }
        
        return $time_ago;
    }
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
