<?
session_start();   // Iniciar sesión
$usuario_presu = $_SESSION['user_usuario']; //usuario conectado

include("conexion.php");
$consulta = "SELECT * FROM presupuesto_vta_tmp where usuario = '$usuario_presu'"; // consulta sql
$result = mysql_query($consulta);            // hace la consulta
$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
if ($nfilas > 0){ 
	echo "si";
}else{
	echo "no";
}
?>