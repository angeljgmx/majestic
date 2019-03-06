<?php
/*
**----------------------------No Borrar esta seccion -------------------------
** Paginator
** Paginacion de resultados de consultas a PostGreSql con PHP
**
** Version 1.6.3
**
** Nombre de archivo :
**    paginator.inc.php
**
** Autor :
**    Jorge Pinedo Rosas (jpinedo)  <jorpinedo@yahoo.es>
**    Con la colaboracion de los usuarios del foro de PHP de www.forosdelweb.com
**    Especialmente de dooky que posteo el codigo en el que se basa este script.
**
** Descripcion :
**    Devuelve el resultado de una consulta sql por paginas, asi como los enlaces de navegacion respectivos.
**    Este script ha sido pensado con fines didacticos, por eso la gran cantidad de comentarios.
**
** Licencia :
**    GPL con las siguientes extensiones:
**        *Uselo con el fin que quiera (personal o lucrativo).
**       *Si encuentra el codigo de utilidad y lo usa, mandeme un mail si lo desea o deje un comentario en la pagina
**        de documentacion.
**       *Si mejora el codigo o encuentra errores, hagamelo saber al mail indicado o deje un comentario en la pagina
**        de documentacion.
**
** Documentacion y ejemplo de uso:
**    http://jpinedo.webcindario.com
**----------------------------------------------------------------------*/

/**
 * Variables que se pueden definir antes de incluir el script via include():
 * ------------------------------------------------------------------------
 * $_pagi_sql              OBLIGATORIA.   Cadena. Debe contener una sentencia sql valida (y sin la clausula "limit").

 * $_pagi_cuantos          OPCIONAL.      Entero. Cantidad de registros que contendra como maximo cada p�gina.
                        Por defecto esta en 20.

 * $_pagi_nav_num_enlaces     OPCIONAL    Entero. Cantidad de enlaces a los numeros de agina que se mostrar�n como
                        maximo en la barra de navegacion.
                        Por defecto se muestran todos.

 * $_pagi_mostrar_errores     OPCIONAL    Booleano. Define si se muestran o no los errores de MySQL que se puedan producir. Por defecto est� en "true";

 * $_pagi_propagar            OPCIONAL    Array de cadenas. Contiene los nombres de las variables que se quiere propagar por el url. Por defecto se propagar�n todas las que ya vengan por el url (GET).

 * $_pagi_conteo_alternativo  OPCIONAL    Booleano. Define si se utiliza mysql_num_rows() (true) o COUNT(*) (false).
                        Por defecto esta en false.
 * $_pagi_separador           OPCIONAL    Cadena. Cadena que separa los enlaces numericos en la barra de navegacion entre paginas.
                        Por defecto se utiliza la cadena " | ".
 * $_pagi_nav_estilo       OPCIONAL    Cadena. Contiene el nombre del estilo CSS para los enlaces de paginacion.
                        Por defecto no se especifica estilo.
 * $_pagi_nav_anterior        OPCIONAL    Cadena. Contiene lo que debe ir en el enlace a la pagina anterior. Puede ser un tag <img>.
                        Por defecto se utiliza la cadena "&laquo; Anterior".
 * $_pagi_nav_siguiente       OPCIONAL    Cadena. Contiene lo que debe ir en el enlace a la pagina siguiente. Puede ser un tag <img>.
                        Por defecto se utiliza la cadena "Siguiente &raquo;"
 * $_pagi_nav_primera         OPCIONAL    Cadena. Contiene lo que debe ir en el enlace a la primera pagina. Puede ser un tag <img>.
                        Por defecto se utiliza la cadena "&laquo;&laquo; Primera".
 * $_pagi_nav_ultima       OPCIONAL    Cadena. Contiene lo que debe ir en el enlace a la pagina siguiente. Puede ser un tag <img>.
                        Por defecto se utiliza la cadena "&Uacute;ltima &raquo;&raquo;"
--------------------------------------------------------------------------
*/

// Funcion equivalente en mysqli a mysqlresult
function mysqli_result($res, $row, $field=0) { 
        $res->data_seek($row); 
        $datarow = $res->fetch_array(); 
        return $datarow[$field]; 
    }

/*
 * Verificacion de los parametros obligatorios y opcionales.
 *------------------------------------------------------------------------
 */
 if(empty($_pagi_sql)){
   // Si no se definio $_pagi_sql... grave error!
   // Este error se muestra si o si (ya que no es un error de pg)
   die("<b>Error Paginator : </b>No se ha definido la variable \$_pagi_sql");
 }

 if(empty($_pagi_cuantos)){
   // Si no se ha especificado la cantidad de registros por pagina
   // $_pagi_cuantos sera por defecto 20
   $_pagi_cuantos = 20;
 }

 if(!isset($_pagi_mostrar_errores)){
   // Si no se ha elegido si se mostrara o no errores
   // $_pagi_errores sera por defecto true. (se muestran los errores)
   $_pagi_mostrar_errores = false; // modificado a false para CORPOANDES
 }

 if(!isset($_pagi_conteo_alternativo)){
   // Si no se ha elegido el tipo de conteo
   // Se realiza el conteo dese mySQL con COUNT(*)
   $_pagi_conteo_alternativo = false;
 }

 if(!isset($_pagi_separador)){
   // Si no se ha elegido un separador
   // Se toma el separador por defecto.
   $_pagi_separador = " ";
 }

  if(isset($_pagi_nav_estilo_center)){
   // Si se ha definido un estilo para los enlaces, se genera el atributo "class" para el enlace
   $_pagi_nav_estilo_center = "class=\"$_pagi_nav_estilo_center\"";
 }else{
   // Si no, se utiliza una cadena vacia.
   $_pagi_nav_estilo_center = "";
 }
 
   if(isset($_pagi_nav_estilo_actual)){
   // Si se ha definido un estilo para los enlaces, se genera el atributo "class" para el enlace
   $_pagi_nav_estilo_actual = "class=\"$_pagi_nav_estilo_actual\"";
 }else{
   // Si no, se utiliza una cadena vacia.
   $_pagi_nav_estilo_actual = "";
 }
 
   if(isset($_pagi_nav_estilo_inicio)){
   // Si se ha definido un estilo para los enlaces, se genera el atributo "class" para el enlace
   $_pagi_nav_estilo_inicio = "class=\"$_pagi_nav_estilo_inicio\"";
 }else{
   // Si no, se utiliza una cadena vacia.
   $_pagi_nav_estilo_inicio = "";
 }
 
   if(isset($_pagi_nav_estilo_anterior)){
   // Si se ha definido un estilo para los enlaces, se genera el atributo "class" para el enlace
   $_pagi_nav_estilo_anterior = "class=\"$_pagi_nav_estilo_anterior\"";
 }else{
   // Si no, se utiliza una cadena vacia.
   $_pagi_nav_estilo_anterior = "";
 }
 
    if(isset($_pagi_nav_estilo_siguiente)){
   // Si se ha definido un estilo para los enlaces, se genera el atributo "class" para el enlace
   $_pagi_nav_estilo_siguiente = "class=\"$_pagi_nav_estilo_siguiente\"";
 }else{
   // Si no, se utiliza una cadena vacia.
   $_pagi_nav_estilo_siguiente = "";
 }

    if(isset($_pagi_nav_estilo_ultimo)){
   // Si se ha definido un estilo para los enlaces, se genera el atributo "class" para el enlace
   $_pagi_nav_estilo_ultimo = "class=\"$_pagi_nav_estilo_ultimo\"";
 }else{
   // Si no, se utiliza una cadena vacia.
   $_pagi_nav_estilo_ultimo = "";
 }
 
 if(!isset($_pagi_nav_anterior)){
   // Si no se ha elegido una cadena para el enlace "siguiente"
   // Se toma la cadena por defecto.
   //$_pagi_nav_anterior = "&laquo; Anterior";
   $_pagi_nav_anterior = "";
 }

 if(!isset($_pagi_nav_siguiente)){
   // Si no se ha elegido una cadena para el enlace "siguiente"
   // Se toma la cadena por defecto.
   //$_pagi_nav_siguiente = "Siguiente &raquo;";
   $_pagi_nav_siguiente = "";
 }

 if(!isset($_pagi_nav_primera)){
   // Si no se ha elegido una cadena para el enlace "primera"
   // Se toma la cadena por defecto.
   $_pagi_nav_primera = "&laquo;&laquo; Primera";
   //$_pagi_nav_primera = "&laquo;&laquo; Primera";
 }

 if(!isset($_pagi_nav_ultima)){
   // Si no se ha elegido una cadena para el enlace "siguiente"
   // Se toma la cadena por defecto.
   $_pagi_nav_ultima = "&Uacute;ltima &raquo;&raquo;";
   //$_pagi_nav_ultima = "&Uacute;ltima &raquo;&raquo;";
 }

//------------------------------------------------------------------------


/*
 * Establecimiento de la pagina actual.
 *------------------------------------------------------------------------
 */
 if (empty($_GET['_pagi_pg'])){
   // Si no se ha hecho click a ninguna pagina especifica
   // O sea si es la primera vez que se ejecuta el script
      // $_pagi_actual es la pagina actual-->sera por defecto la primera.
   $_pagi_actual = 1;
 }else{
   // Si se "pidio" una pagina especifica:
   // La pagina actual sera la que se pidio.
      $_pagi_actual = $_GET['_pagi_pg'];
 }
//------------------------------------------------------------------------


/*
 * Establecimiento del numero de paginas y del total de registros.
 *------------------------------------------------------------------------
 */
 // Contamos el total de registros en la BD (para saber cuantas paginas seran)
 // La forma de hacer ese conteo dependera de la variable $_pagi_conteo_alternativo
 if($_pagi_conteo_alternativo == false){
   // funcion original con eregi_replace(), se cambio a preg_replace() para solventar la noticia de "deprecated" 
   //$_pagi_sqlConta = eregi_replace("select[[:space:]](.*)[[:space:]]from", "SELECT COUNT(*) FROM", $_pagi_sql);
   $_pagi_sqlConta = preg_replace("/select[[:space:]](.*)[[:space:]]from/i", "SELECT COUNT(*) FROM", $_pagi_sql);
   
   //echo $_pagi_sqlConta;
   
   $_pagi_result2 = mysqli_query($conec->dbConexion(), $_pagi_sqlConta);
   // Si ocurrio error y mostrar errores esta activado
   if($_pagi_result2 == false && $_pagi_mostrar_errores == true){
      die (" Error en la consulta de conteo de registros: $_pagi_sqlConta. Mysql dijo: <b>".mysqli_error()."</b>");
   }
   
   $_pagi_totalReg = mysqli_result($_pagi_result2,0,0);//total de registros
 }else{
   $_pagi_result3 = mysqli_query($conec->dbConexion(), $_pagi_sql);
   // Si ocurrio error y mostrar errores esta activado
   if($_pagi_result3 == false && $_pagi_mostrar_errores == true){
      die (" Error en la consulta de conteo alternativo de registros: $_pagi_sql. Postgresql dijo: <b>".mysqli_error()."</b>");
   }
   $_pagi_totalReg = mysqli_num_rows($_pagi_result3);
 }
 // Calculamos el numero de paginas (saldra un decimal)
 // con ceil() redondeamos y $_pagi_totalPags sera el numero total (entero) de paginas que tendremos
 $_pagi_totalPags = ceil($_pagi_totalReg / $_pagi_cuantos);

//------------------------------------------------------------------------

/*
 * Propagacion de variables por el URL.
 *------------------------------------------------------------------------
 */
 // La idea es pasar tambien en los enlaces las variables hayan llegado por url.
 $_pagi_enlace = $_SERVER['PHP_SELF'];
 $_pagi_query_string = "?";

 if(!isset($_pagi_propagar)){
   //Si no se definio que variables propagar, se propagara todo el $_GET (por compatibilidad con versiones anteriores)
   //Perdon... no todo el $_GET. Todo menos la variable _pagi_pg
   if (isset($_GET['_pagi_pg'])) unset($_GET['_pagi_pg']); // Eliminamos esa variable del $_GET
   $_pagi_propagar = array_keys($_GET);
 }elseif(!is_array($_pagi_propagar)){
   // si $_pagi_propagar no es un array... grave error!
   die("<b>Error Paginator : </b>La variable \$_pagi_propagar debe ser un array");
 }
 // Este foreach est� tomado de la Clase Paginado de webstudio
 // (http://www.forosdelweb.com/showthread.php?t=65528)
 foreach($_pagi_propagar as $var){
   if(isset($GLOBALS[$var])){
      // Si la variable es global al script
      $_pagi_query_string.= $var."=".$GLOBALS[$var]."&";
   }elseif(isset($_REQUEST[$var])){
      // Si no es global (o register globals est� en OFF)
      $_pagi_query_string.= $var."=".$_REQUEST[$var]."&";
   }
 }

 // Agnadimos el query string a la url.
 $_pagi_enlace .= $_pagi_query_string;

// Agnadimos si la consulta es un buscador
$_pagi_enlace .= $_pagi_buscador; 
//------------------------------------------------------------------------


/*
 * Generacion de los enlaces de paginacion.
 *------------------------------------------------------------------------
 */
 // La variable $_pagi_navegacion contendra los enlaces a las paginas.
 $_pagi_navegacion_temporal = array();
 if ($_pagi_actual != 1){
   // Si no estamos en la pagina 1. Ponemos el enlace "primera"
   $_pagi_url = 1; //sera el numero de pagina al que enlazamos
   $_pagi_navegacion_temporal[] = "<li><a ".$_pagi_nav_estilo_inicio." href='".$_pagi_enlace."_pagi_pg=".$_pagi_url."'>$_pagi_nav_primera</a></li>";

   // Si no estamos en la pagina 1. Ponemos el enlace "anterior"
   $_pagi_url = $_pagi_actual - 1; //sera el numero de pagina al que enlazamos
   $_pagi_navegacion_temporal[] = "<li><a ".$_pagi_nav_estilo_anterior." href='".$_pagi_enlace."_pagi_pg=".$_pagi_url."'>$_pagi_nav_anterior</a></li>";
	 }

 // La variable $_pagi_nav_num_enlaces sirve para definir cuantos enlaces con
 // numeros de pagina se mostraran comoaximo.
 // Ojo: siempre se mostrara un numero impar de enlaces. Mas info en la documentacion.

 if(!isset($_pagi_nav_num_enlaces)){
   // Si no se definio la variable $_pagi_nav_num_enlaces
   // Se asume que se mostraran todos los numeros de pagina en los enlaces.
   $_pagi_nav_desde = 1;//Desde la primera
   $_pagi_nav_hasta = $_pagi_totalPags;//hasta la ultima
 }else{
   // Si se definio la variable $_pagi_nav_num_enlaces
   // Calculamos el intervalo para restar y sumar a partir de la pagina actual
   $_pagi_nav_intervalo = ceil($_pagi_nav_num_enlaces/2) - 1;

   // Calculamos desde que numero de pagina se mostrara
   $_pagi_nav_desde = $_pagi_actual - $_pagi_nav_intervalo;
   // Calculamos hasta que numero de pagina se mostrara
   $_pagi_nav_hasta = $_pagi_actual + $_pagi_nav_intervalo;

   // Ajustamos los valores anteriores en caso sean resultados no validos

   // Si $_pagi_nav_desde es un numero negativo
   if($_pagi_nav_desde < 1){
      // Le sumamos la cantidad sobrante al final para mantener el numero de enlaces que se quiere mostrar.
      $_pagi_nav_hasta -= ($_pagi_nav_desde - 1);
      // Establecemos $_pagi_nav_desde como 1.
      $_pagi_nav_desde = 1;
   }
   // Si $_pagi_nav_hasta es un numero mayor que el total de paginas
   if($_pagi_nav_hasta > $_pagi_totalPags){
      // Le restamos la cantidad excedida al comienzo para mantener el numero de enlaces que se quiere mostrar.
      $_pagi_nav_desde -= ($_pagi_nav_hasta - $_pagi_totalPags);
      // Establecemos $_pagi_nav_hasta como el total de paginas.
      $_pagi_nav_hasta = $_pagi_totalPags;
      // Hacemos el ultimo ajuste verificando que al cambiar $_pagi_nav_desde no haya quedado con un valor no valido.
      if($_pagi_nav_desde < 1){
         $_pagi_nav_desde = 1;
      }
   }
 }

 for ($_pagi_i = $_pagi_nav_desde; $_pagi_i<=$_pagi_nav_hasta; $_pagi_i++){//Desde pagina 1 hasta ultima pagina ($_pagi_totalPags)
   if ($_pagi_i == $_pagi_actual) {
      // Si el numero de pagina es la actual ($_pagi_actual). Se escribe el numero, pero sin enlace y en negrita.
      //$_pagi_navegacion_temporal[] = "<span ".$_pagi_nav_estilo_actual.">$_pagi_i</span> \n";
      $_pagi_navegacion_temporal[] = "<li ".$_pagi_nav_estilo_actual."><a href=\"#\">".$_pagi_i."</a></li> \n";
   }else{
      // Si es cualquier otro. Se escibe el enlace a dicho numero de pagina.
      $_pagi_navegacion_temporal[] = "<li><a ".$_pagi_nav_estilo_center." href='".$_pagi_enlace."_pagi_pg=".$_pagi_i."'>".$_pagi_i."</a></li> \n";
   }
 }

 if ($_pagi_actual < $_pagi_totalPags){
    // Si no estamos en la ultima pagina. Ponemos el enlace "Siguiente"
    $_pagi_url = $_pagi_actual + 1; //sera el numero de pagina al que enlazamos
    $_pagi_navegacion_temporal[] = "<li><a ".$_pagi_nav_estilo_siguiente." href='".$_pagi_enlace."_pagi_pg=".$_pagi_url."'>$_pagi_nav_siguiente</span></a></li>";
    // Si no estamos en la ultima pagina. Ponemos el enlace "ultima"
    $_pagi_url = $_pagi_totalPags; //sera el numero de pagina al que enlazamos
    $_pagi_navegacion_temporal[] = "<li><a ".$_pagi_nav_estilo_ultimo." href='".$_pagi_enlace."_pagi_pg=".$_pagi_url."'>$_pagi_nav_ultima</a></li>";
    }
 $_pagi_navegacion = implode($_pagi_separador, $_pagi_navegacion_temporal);

//------------------------------------------------------------------------


/*
 * Obtencion de los registros que se mostraran en la pagina actual.
 *------------------------------------------------------------------------
 */
 // Calculamos desde que registro se mostrara en esta pagina
 // Recordemos que el conteo empieza desde CERO.
 $_pagi_inicial = ($_pagi_actual-1) * $_pagi_cuantos;

 // Consulta SQL. Devuelve $cantidad registros empezando desde $_pagi_inicial
//  $_pagi_sqlLim = $_pagi_sql." LIMIT $_pagi_inicial,$_pagi_cuantos";
 $_pagi_sqlLim = $_pagi_sql." ORDER BY ".$_pagi_order ." LIMIT $_pagi_cuantos"." OFFSET $_pagi_inicial";

 $_pagi_result = mysqli_query($conec->dbConexion(), $_pagi_sqlLim);
 // Si ocurrio error y mostrar errores esta activado
 if($_pagi_result == false && $_pagi_mostrar_errores == true){
   die ("Error en la consulta limitada: $_pagi_sqlLim. Mysql dijo: <b>".mysqli_error()."</b>");
 }

//------------------------------------------------------------------------


/*
 * Generacion de la informacion sobre los registros mostrados.
 *------------------------------------------------------------------------
 */
 // Numero del primer registro de la pagina actual
 $_pagi_desde = $_pagi_inicial + 1;

 // Numero del ultimo registro de la pagina actual
 $_pagi_hasta = $_pagi_inicial + $_pagi_cuantos;
 if($_pagi_hasta > $_pagi_totalReg){
   // Si estamos en la ultima pagina
   // El ultimo registro de la pagina actual sera igual al numero de registros.
   $_pagi_hasta = $_pagi_totalReg;
 }

 $_pagi_info = "Mostrando desde el $_pagi_desde hasta el $_pagi_hasta de un total de ".$_pagi_totalReg." registros";

//------------------------------------------------------------------------


/**
 * Variables que quedan disponibles despues de incluir el script via include():
 * ------------------------------------------------------------------------

 * $_pagi_result     Identificador del resultado de la consulta a la BD para los registros de la pagina actual.
            Listo para ser "pasado" por una funcion como mysql_fetch_row(), mysql_fetch_array(),
            mysql_fetch_assoc(), etc.

 * $_pagi_navegacion    Cadena que contiene la barra de navegacion con los enlaces a las diferentes paginas.
            Ejemplo: "<<primera | <anterior | 1 | 2 | 3 | 4 | siguiente> | ultima>>".

 * $_pagi_info       Cadena que contiene informacion sobre los registros de la pagina actual.
            Ejemplo: "desde el 16 hasta el 30 de un total de 123";

*/
?>