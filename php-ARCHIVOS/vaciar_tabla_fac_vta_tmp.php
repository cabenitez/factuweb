<?
	session_start();   									// Iniciar sesión
	$usuario_fac = $_SESSION['user_usuario']; 	// usuario conectado
	//---------------------VACIA TABLA TEMPORAL DE ARTICULOS-----------------------------------------------------------------//
	include("conexion.php");
	$consulta = "call vaciar_tabla_fac_vta_tmp('$usuario_fac')";
	$result = mysql_query($consulta);            // hace la consulta
?>