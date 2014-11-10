<?
session_start();   // Iniciar sesión
$usuario_cc = $_SESSION['user_usuario']; //usuario conectado 

include("conexion.php");
$consulta = "SELECT * FROM cc_vta_tmp where usuario = '$usuario_cc'"; // consulta sql
$result = mysql_query($consulta);            // hace la consulta
$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
if ($nfilas > 0){ 
	echo "1";
}else{
	echo "0";
}
?>  