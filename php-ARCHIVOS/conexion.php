<?php 
// muestro todos los errores exepto los notices
ini_set ('error_reporting', E_ALL ^ E_DEPRECATED);


// Iniciar sesion
if(!isset($_SESSION)) { 
    session_start(); 
} 

//fecha actual
$dia=date("d",time());  //asigna una cadena a la variable "dia"
$mes=date("m",time());  //asigna una cadena a la variable "mes"
$ano=date("Y",time());  //asigna una cadena a la variable "a�o"
$fecha="$dia/$mes/$ano";

//$fecha_hora = date(Y.'-'.m.'-'.d.' '.h.':'.i.':'.s); 

// ================================= parametros de conexion con la db ============================================//
$host="localhost";
$db="factuweb"; 
$usuario="root";
$clave="";

// nombre se sesion 
$nombre_sesion="factuweb";

// ================================= parametros de conexion con la db ============================================//
$conexion = mysqli_connect($host, $usuario, $clave, $db)or die ("No se puede conectar con el Servidor"); 

// echo mysql_errno().": ".mysql_error()."<BR>";

//================================ tamanio de las paginas en paginador ============================================//				
$consulta_lineas = "SELECT lineas FROM conf_listados"; // consulta sql                  
$result_lineas = mysqli_query($conexion, $consulta_lineas);            // hace la consulta
$nfilas_lineas = mysqli_num_rows ($result_lineas);          //indica la cantidad de resultados
$registro_lineas = mysqli_fetch_row($result_lineas);        // toma el registro
if ($nfilas_lineas > 0){     						 // si existe el usuario inicia la sesion
	$pag_tamano = $registro_lineas[0];   
}
//===================================================================================================================//				

$espacio_izq = '&nbsp;&nbsp;';				// espacio para mostrar los listados con margen izquierdo

include("sql_calculo_importe.php");

?>
