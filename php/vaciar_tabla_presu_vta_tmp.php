<?
	session_start();   									// Iniciar sesi�n
	$usuario_presu = $_SESSION['user_usuario']; 	// usuario conectado
	//---------------------VACIA TABLA TEMPORAL DE ARTICULOS-----------------------------------------------------------------//
	include("conexion.php");
	$consulta = "call vaciar_tabla_presupuesto_vta_tmp('$usuario_presu')";
	$result = mysql_query($consulta);            // hace la consulta
?>