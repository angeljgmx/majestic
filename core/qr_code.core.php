<?php

    /********************************************************/
    /* Administrador Web SmartNova                            */
    /* Funciones de cadenas de caracteres                   */
    /* Junio de 2016                                        */
    /********************************************************/

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

function PHPCodigoQR($path, $contenido, $directorio, $nombre){
            
    // Inclusion de archivos necesarios
    include_once $path.'assets/global/plugins/phpqrcode/qrlib.php';

    // Directorio donde guardar la imagen
    $tempDir = $directorio."/"; 
    
    $elemId = false;

    $pngAbsoluteFilePath = $tempDir.$nombre.".png"; 
    
    $level = QR_ECLEVEL_L;
    
    $width = 1024;
    
    $size = 10;

    // generating 
    if (!file_exists($pngAbsoluteFilePath)) { 
        QRcode::png($contenido, $pngAbsoluteFilePath, $level, $width); 
    } 
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

?>