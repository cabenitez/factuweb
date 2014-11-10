<?
session_start();   // Iniciar sesión
$tabla = $_POST["tabla"]; // toma la variable de la url q vino de ajax.js

if (session_is_registered ($tabla)){          // si ha iniciado sesion
	?>
		<img src="../imagenes/pegar.gif" class="iconos" title="Pegar Datos" onClick="pegar_datos('<? echo $tabla;?>')">
	<?
}else{
	?>
		<img src="../imagenes/pegar_no.gif"  >
	<?
}
?>


