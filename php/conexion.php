<?php 
// muestro todos los errores exepto los notices
ini_set ('error_reporting', E_ALL & ~E_NOTICE);

session_start();   // Iniciar sesi�n

//fecha actual
$dia=date("d",time());  //asigna una cadena a la variable "dia"
$mes=date("m",time());  //asigna una cadena a la variable "mes"
$ano=date("Y",time());  //asigna una cadena a la variable "a�o"
$fecha="$dia/$mes/$ano";

$fecha_hora = date(Y.'-'.m.'-'.d.' '.h.':'.i.':'.s); 

// ================================= parametros de conexion con la db ====================================================
$host="localhost";
$db="factuweb"; 
//$db=$_SESSION['base_datos'];

//if ($_SESSION['user_usuario'] != '' && $_SESSION['clave_usuario'] != ''){          // si ha iniciado sesion
//	$usuario= $_SESSION['user_usuario'];
//	$clave= $_SESSION['clave_usuario'];  
//}else{ 
	$usuario="root";
	$clave="";
//}	

// nombre se sesion 
$nombre_sesion="factuweb";

//echo $usuario;

// ================================= parametros de conexion con la db ====================================================
$coneccion = mysql_connect($host, $usuario,$clave)or die ("No se puede conectar con el Servidor"); 
mysql_select_db ($db,$coneccion)or die ("No se puede conectar con la Base de Datos");

// echo mysql_errno().": ".mysql_error()."<BR>";

//================================ tama�o de las paginas en paginador ==========================================================================//				
$consulta_lineas = "SELECT lineas FROM conf_listados"; // consulta sql                  
$result_lineas = mysql_query($consulta_lineas);            // hace la consulta
$nfilas_lineas = mysql_num_rows ($result_lineas);          //indica la cantidad de resultados
$registro_lineas = mysql_fetch_row($result_lineas);        // toma el registro
if ($nfilas_lineas > 0){     						 // si existe el usuario inicia la sesion
		$pag_tamano = $registro_lineas[0];   
}
//==============================================================================================================================================//				

$espacio_izq = '&nbsp;&nbsp;';				// espacio para mostrar los listados con margen izquierdo

include("sql_calculo_importe.php");

?>
