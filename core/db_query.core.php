<?php

    /****************************************/
    /* Theme de la aplicacion               
    /* Grupo Macuro                              
    /* Febrero 2017
     * Aplicacion desarrollada por Angel Garcia
     * Email: angel.j.garcia.m@gmail.com                       
    /****************************************/

//=============================================================================================================================================================================================//

    function getPreferencias($path){
        
        // Inclusion de archivos necesarios
        require_once $path.'core/db.class.core.php';
        require_once $path.'includes/config.inc.php';
        
        // Control de errores
        $debug = DEBUG;
        
        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion(); 
    
        // Datos de las preferencias del sitio
        $sql_pref = "SELECT * FROM tbla_pref WHERE id = 1";
        $query_pref = $conec->dbQuery($sql_pref, $debug);
               
        $datos_pref = $conec->dbFetchArray($query_pref);

        return $datos_pref;        
    }
//=============================================================================================================================================================================================//

    function getAdministrador($path, $id){
        
        // Inclusion de archivos necesarios
        require_once $path.'core/db.class.core.php';
        require_once $path.'includes/config.inc.php';
        
        // Control de errores
        $debug = DEBUG;
        
        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion(); 
    
        // Datos del administrador
        $sql_adms = "SELECT * FROM tbla_adms WHERE id = $id";
        $query_adms = $conec->dbQuery($sql_adms, $debug);
               
        $datos_adms = $conec->dbFetchArray($query_adms);

        return $datos_adms;        
    }
//=============================================================================================================================================================================================//
    
    function getContacto($path){
        
        // Inclusion de archivos necesarios
        require_once $path.'core/db.class.core.php';
        require_once $path.'includes/config.inc.php';
        
        // Control de errores
        $debug = DEBUG;
        
        // Crear la instancia y conectar a la BD
        $conec = new db();
        $conec->dbConexion(); 
    
        // Datos del administrador
        $sql_cont = "SELECT * FROM tbla_cont WHERE id = 1";
        $query_cont = $conec->dbQuery($sql_cont, $debug);
               
        $datos_cont = $conec->dbFetchArray($query_cont);

        return $datos_cont;        
    }
//=============================================================================================================================================================================================//
?>