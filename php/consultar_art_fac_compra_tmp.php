<?
session_start();   // Iniciar sesión
$usuario_fac = $_SESSION['user_usuario']; //usuario conectado

include("conexion.php");
$consulta = "SELECT * FROM factura_compra_tmp where usuario = '$usuario_fac'"; // consulta sql
$result = mysql_query($consulta);            // hace la consulta
$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
if ($nfilas > 0){ 
	echo "si";
}else{
	echo "no";
}
?>