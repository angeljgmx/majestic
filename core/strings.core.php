<?php

    /********************************************************/
    /* Administrador Web SmartNova                            */
    /* Funciones de cadenas de caracteres                   */
    /* Junio de 2016                                        */
    /********************************************************/

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Funcion para reemplazar caracteres especiales
    function ReemSpecialChars($texto){
        $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ', '\"', '€', 'ü', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ', 'Ü', 'ç', 'Ç', '©', '°', 'º', '¿', '¡', '<', '>', '/', '*', '"');
        $repl = array('&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;', '&ntilde;', '&quot;', '&euro;', '&uuml;', '&Aacute;', '&Eacute;', '&Iacute;', '&Oacute;', '&Uacute;', '&Ntilde;', '&Uuml;', '&ccedil;', '&Ccedil;', '&copy;', '&deg;', '&ordm;', '&iquest;', '&iexcl;', '&lt;', '&gt;', '&#47;', '&#42;', '&quot;');
        $texto_01 = str_replace($find, $repl, $texto);
        $texto_02 = str_replace("'","\'",$texto_01);
        $texto_html = str_replace('"','\"',$texto_02);
        return $texto_html;	
    }
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Funcion para reemplazar caracteres especiales
    function ReemHTMLChars($texto){
        $find = array('&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;', '&ntilde;', '&quot;', '&euro;', '&uuml;', '&Aacute;', '&Eacute;', '&Iacute;', '&Oacute;', '&Uacute;', '&Ntilde;', '&Uuml;', '&ccedil;', '&Ccedil;', '&copy;', '&deg;', '&ordm;', '&iquest;', '&iexcl;', '&lt;', '&gt;', '&#47;', '&#42;', '&quot;');       
        $repl = array('á', 'é', 'í', 'ó', 'ú', 'ñ', '\"', '€', 'ü', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ', 'Ü', 'ç', 'Ç', '©', '°', 'º', '¿', '¡', '<', '>', '/', '*', '"');       
        $texto_01 = str_replace($find, $repl, $texto);
        $texto_02 = str_replace("'","\'",$texto_01);
        $texto_plano = str_replace('"','\"',$texto_02);
        return $texto_plano;	
    }
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // Funcion para reemplazar caracteres especiales a caracteres normales
    function ReemAcuteChars($texto){
        $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ', '\"', 'ü', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ', 'Ü', ' ');
        $repl = array('a', 'e', 'i', 'o', 'u', 'n', '\"', 'u', 'A', 'E', 'I', 'O', 'U', 'N', 'U', '_');       
        $texto_01 = str_replace($find, $repl, $texto);
        $texto_02 = str_replace("'","\'",$texto_01);
        $texto_plano = str_replace('"','\"',$texto_02);
        return $texto_plano;	
    }
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
    // Funcion que detecta y crea enlaces url dentro de una cadena   
    function StringURL($cadena_origen){
       
        //echo $cadena_origen;

        //filtro los enlaces normales
        $cadena_resultante= preg_replace("/((http|https|www)[^\s]+)/", '<a href="$1">$0</a>', $cadena_origen);
        //miro si hay enlaces con solamente www, si es así le añado el http://
        $cadena_resultante= preg_replace("/href=\"www/", 'href="http://www', $cadena_resultante);
        //echo '<h3>Cadena filtrada con enlaces normales:</h3>'.$cadena_resultante;

        //saco los enlaces de twitter
        $cadena_resultante = preg_replace("/(@[^\s]+)/", '<a target=\"_blank\"  href="http://twitter.com/intent/user?screen_name=$1">$0</a>', $cadena_resultante);
        $cadena_resultante = preg_replace("/(#[^\s]+)/", '<a target=\"_blank\"  href="http://twitter.com/search?q=$1">$0</a>', $cadena_resultante);
        //echo '<h3>Cadena filtrada con enlaces de Twitter:</h3>'.$cadena_resultante;
        
        return $cadena_resultante;
    }
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
    // Cortar texto en palabras enteras
    function AcortarTexto($texto, $largo){
        $texto_sin_tags = strip_tags($texto);
        $texto_crudo = substr($texto_sin_tags, 0, $largo);
        $index = strrpos($texto_crudo, " ");
        $texto_final = substr($texto_crudo, 0, $index); 
        $texto_final .="...";

        return $texto_final;
    }
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
   
    function TiempoDeLectura($content) {
        $word_count = str_word_count(strip_tags($content));
        $minutes = floor($word_count / 200);
        $seconds = floor($word_count % 200 / (200 / 60));

        $str_minutes = ($minutes == 1) ? "minuto" : "minutos";
        $str_seconds = ($seconds == 1) ? "segundo" : "segundos";

        if ($minutes == 0) {
            return "{$seconds} {$str_seconds}";
        }
        else {
            return "{$minutes} {$str_minutes}, {$seconds} {$str_seconds}";
        }
    }  
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

?>