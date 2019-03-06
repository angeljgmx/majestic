<?php

    /********************************************************/
    /* Administrador Web SmartNova                            */
    /* Clase para el manejo de la base de datos             */
    /* Junio de 2016                                        */
    /********************************************************/

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//


    // clase para interaccion con BD 
    class db {

        // definir publiciables para la conexion
        var $db = "majestic";		// Nombre de la BD
        var $srv = "127.0.0.1";             // IP del servidor
        var $usr = "root";                  // Nombre de suario con que se conecta la BD
        var $pass = "123456";               // Clave de conexion a la BD
        var $audt = "tbla_audt";            // Tabla de auditoria
        var $sson = "tbla_sson";            // Tabla de sesiones

        // identificador de conexion y de consultas
        public $Conexion_ID = 0;
        public $Query_ID = 0;
        public $DConexion_ID = 0;
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	

        // Establece conexion a la base de datos
        public function dbConexion(){
            // Raiz del sitio
            $path = "";

            //echo "base de datos host ".$this->clv."<br>";
            $this->Conexion_ID = mysqli_connect($this->srv, $this->usr, $this->pass) or die("<script type=\"text/javascript\">window.location=\"".$path."falla_proveedor.php\"</script> ");        

            mysqli_select_db($this->Conexion_ID, $this->db);
            return $this->Conexion_ID; //devolver el identificador
        }
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	

        // Desconexion de la base de datos
        public function dbDesconexion() {
            $this->DConexion_ID = mysqli_close();
            return $this->DConexion_ID;
        }
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	

        // Liberar memoria en caso de ser necesario
        function dbFreeMemory() {
            $this->Conexion_ID = mysqli_free_result($this->Query_ID);
            return $this->Conexion_ID;
        }
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	

        function dbMensajeDebuger($funcion, $consulta){            
            $mensaje_debuger_db =  "<div class=\"col-md-12\"> \n"
                ."<div class=\"alert bg-grey bg-font-grey\"> \n"
                ."<i class=\"fa fa-bug\"></i> \n"
                ."<strong>Debug de ".$funcion.":</strong>&nbsp;&nbsp;&nbsp;&nbsp;".$consulta." \n"
                ."</div> \n"
                ."</div> \n";
            return $mensaje_debuger_db;
        }
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

        function dbMensajeError($operacion, $error){            
            $mensaje_debuger_db = "<div class=\"notification error\"> \n"
                ."<span></span>  \n"
                ."<div class=\"text\"> \n"
                ."<p>Ocurrieron errores al intentar ".$operacion." valores en la base de datos.
                analizar el mensaje enviado: <strong>$error</strong></p> \n"
                ."</div> \n"
                ."</div> \n";
            return $mensaje_debuger_db;
        } 
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//


        // Ejecutar una query
        function dbQuery($sql, $debug){
            // Imprimir la query para control de errores
            if ($debug == "on"){
                $funcion = "dbQuery";
                $consulta = $sql;

                echo $this->dbMensajeDebuger($funcion, $consulta);
            }
            if ($sql == "") {
                $this->Error = "No ha especificado una consulta SQL";
                return 0;
            } 
            else {
                $qcon=$sql;
                // echo "$qcon<br>"; /*imprimir la consulta*/
                $this->Query_ID = mysqli_query($this->Conexion_ID, $qcon) or die("Error en la consulta: $qcon ->".mysqli_error($this->Conexion_ID));
                return $this->Query_ID;
            }
        }
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	

        //==================================//
        // Funciones para consulta de datos //
        //==================================//

        // Consulta a la base de Datos:	
        // Parametros:  
        // $sche = nombre del esquema
        // $tabla = nombre de la tabla
        // $campos = campos a recuperar
        // $criterio = criterios de consulta
        // $orden = campos para ordenar la consulta
        // $clausula = ascendente o descentente
        // debug
        function dbConsulta($sche, $tabla, $campos, $criterio, $orden, $clausula, $debug) {

            // funciones de mensajes
            // require_once '../includes/funciones.php';

             if ($sche == "") {
                // $this->Error = "No ha especificado el esquema";
                // return 0;
            }
             if ($tabla == "") {
                 $this->Error = "No ha especificado la tabla";
                 return 0;
            }
             if ($campos == "") {
                 $this->Error = "No ha especificado campos";
                 return 0;
            }
             //$query = "SELECT $campos FROM $sche".'.'."$tabla";
             $query = "SELECT $campos FROM ".$tabla."";

             if (!empty($criterio)) $query .= " WHERE $criterio";
             if (!empty($orden)) $query .= " ORDER BY $orden";
             if (!empty($clausula)) $query .= " $clausula";

             // Imprimir la query para control de errores
             if ($debug == "on"){
                 $funcion = "dbConsulta";
                 $consulta = $query;

               echo $this->dbMensajeDebuger($funcion, $consulta);
             }

             // Ejecucion la consulta
             $this->Query_ID = mysqli_query($this->Conexion_ID, $query) or die("Error: $query ".mysqli_error($this->Conexion_ID));

             return $this->Query_ID;
        }
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	

        // Funcion para obtener el numero de registros devueltos por la consulta
        function dbNumRows() {
            $num_rows = mysqli_num_rows($this->Query_ID);
            return $num_rows;
        }
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	

        // Funcion para obtener un registro devuelto en forma de un arreglo
        function dbFetchArray($rs="") {
            //$array = array();
            if($rs==""){
                $rs=$this->Query_ID;
            }
            $array = mysqli_fetch_array($rs);
            return $array;
        }
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	

        // Funcion para obtener un registro devuelto en forma de un arreglo enumerado
        function dbFetchRow($rs="") {
            //$array = array();
            if($rs=="")
                $rs=$this->Query_ID;
            $array = mysqli_fetch_row($rs);
            return $array;
        }	
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	

        // Funcion para obtener un registro en forma de un objeto
        function dbFetchObjet($rs="") {
            if($rs=="")
                $rs=$this->Query_ID;
            $dobj = mysqli_fetch_object($rs);
            return $dobj;
        }
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	  				

        //====================================//
        // Funcion para la insercion de datos //
        //====================================//
        // Parametros:	$sche = nombre del esquema
        //		$tabla = nombre de la tabla de la base de datos
        //		$into = son los campos a los que se van a insertar valores
        //		$values = son los valores a ser insertados
        function dbInsertar($sche, $tabla, $into, $values, $debug){
            if ($sche == "") {
                // $this->Error = "No ha especificado el esquema";
                // return 0;
            }
            if ($tabla == "") {
                $this->Error = "No ha especificado la tabla";
                return 0;
            }
            if ($into == "") {
                $this->Error = "No ha especificado los campos";
                return 0;
            }
            if ($values == "") {
                $this->Error = "No ha especificado los valores";
                return 0;
            }

            //$qins = " INSERT INTO $sche.$tabla ($into) VALUES (".$values.") ";
            $qins = " INSERT INTO $tabla ($into) VALUES (".$values.") ";

            // Imprimir la query para control de errores
            if ($debug == "on"){
                $funcion = "dbInsertar";
                $consulta = $qins;
                echo $this->dbMensajeDebuger($funcion, $consulta);
            }

            //ejecutamos la consulta
            $this->Query_ID = mysqli_query($this->Conexion_ID, $qins);

            if (!$this->Query_ID) {
                $error = mysqli_error($this->Conexion_ID);
                $termino = "ROLLBACK";
                $operacion = "insertar";
                echo $this->dbMensajeError($operacion, $error);
            } 
            else {
                // Si la insercion es satisfactoria
                $termino = "COMMIT";
            }
            
            // Resultado de la insercion
            if ($debug == "on"){
                $funcion = "dbInsertar - Resultado";
                $consulta = $qins;
                echo $this->dbMensajeDebuger($funcion, $this->Query_ID);
            }
            
            /*
            // Insertamos registro en la tabla de auditoria
            if (($termino == "COMMIT") && ($tabla != $this->sson) && ($tabla != "pcet_ssna")){

                // Usuario de sesion
                if (isset($_SESSION)){
                    $sson_user = $_SESSION['sson_idpr'];
                }
                else{
                    $sson_user = 0;
                }

                // recuperacion del ultimo
                $query_ultimo_id = "SELECT MAX(id) FROM ".$tabla;
                $ultimo_id_rc = mysqli_query($query_ultimo_id);
                $ultimo_id = mysqli_fetch_array($ultimo_id_rc);

                $into_audt = "audt_tabl, audt_idrg, audt_adms, audt_oprc";

                $values_audt = "'".$tabla."', '".$ultimo_id[0]."', '".$sson_user."', 'I'";

                // query de la insercion
                $qaudi = "INSERT INTO ".$this->audt." (".$into_audt.") VALUES (".$values_audt.")";
                mysqli_query($qaudi);

            }*/

            // mysql_query($termino);

            return $this->Query_ID;

        }
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	

        //=======================================//
        // Funcion para la edicion de datos //
        //=======================================//
        // Parametros:	$sche = nombre del esquema
        //  $tabla = nombre de la tabla de la base de datos
        //  $set = los campos que se van a modificar con sus respectivos sus valores
        //  $where es el criterio que define cual es el registro a modificar 
        function dbEdicion($sche, $tabla, $set, $where, $debug){
            /*
             // funciones de mensajes
            require_once '../includes/funciones.php';
        */
            if ($sche == "") {
            /* $this->Error = "No ha especificado el esquema";
             return 0;*/
            }
            if ($tabla == "") {
                $this->Error = "No ha especificado  la tabla";
                return 0;
            }
            if ($set == "") {
                $this->Error = "No ha especificado las modificaciones";
                return 0;
            }
            if ($where == "") {
                $this->Error = "No ha especificado el registro a modificar";
                return 0;
            }

            //$qmod= "UPDATE $sche.$tabla SET $set where $where";
            $qmod = "UPDATE $tabla SET $set where $where";

            // Imprimir la query para control de errores
            if ($debug == "on"){
                $funcion = "dbEdicion";
                $consulta = $qmod;

                echo $this->dbMensajeDebuger($funcion, $consulta);
            }

            // Ejecutamos de la consulta
            $this->Query_ID = mysqli_query($this->Conexion_ID, $qmod);

            if (!$this->Query_ID) {
                $error = mysqli_error($this->Conexion_ID);
                $termino = "ROLLBACK";

                $operacion = "editar";
                echo $this->dbMensajeError($operacion, $error);
            } 
            else {
                $termino = "COMMIT";
            }

            mysqli_query($this->Conexion_ID, $termino);

            return $this->Query_ID;
        }
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	

        //===================================//
        // Funciones para Eliminacion de datos //
        //===================================//
        // Parametros:	$sche = nombre del esquema
        //		$tabla = nombre de la tabla de la base de datos
        // 		$criterio = criterio que define cual es el registro que sera eliminado
        function dbEliminar($sche, $tabla, $criterio, $debug) {
            if ($sche == "") {
           /* $this->Error = "No ha especificado el esquema";
            return 0;*/
            }
            if ($tabla == "") {
                $this->Error = "No ha especificado la tabla";
                return 0;
            }
            if ($criterio == "") {
                $this->Error = "No ha especificado el criterio para eliminar";
                return 0;
            }

            //$qdel = "delete from $sche.$tabla where $criterio";
            $qdel = "delete from $tabla where $criterio";

            // Control de errores
            if ($debug == "on"){
                echo "<div class=\"notification-box notification-box-debug\"> \n"
                ."<p><strong>Debug de dbEliminar:</strong>&nbsp;&nbsp;&nbsp;&nbsp;".$qdel."</p> \n"	
                ."<a href=\"#\" class=\"notification-close notification-close-warning\">x</a> \n"
                ."</div> \n";
            }

            $this->Query_ID = mysqli_query($this->Conexion_ID, $qdel);

            if (!$this->Query_ID) {
                $error = mysqli_error($this->Conexion_ID);
                $termino = "ROLLBACK";

                $operacion = "eliminar";
                echo $this->dbMensajeError($operacion, $error);
                return 0;
            }
            else {
                $termino = "COMMIT";
            }

                mysqli_query($this->Conexion_ID, $termino);

            return $this->Query_ID;
        }
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	

}
?>	
