<? 
session_start();   										// Iniciar sesión
$usuario_activo = $_SESSION['user_usuario']; 	//usuario conectado
$valido = $_POST["valido"]; 							// toma la variable de la url q vino de ajax.js

if ($valido == "ok"){
	//include("conexion.php");
	//--------------prepara el directorio y renombra los archivos viejos------------------//
	$hora = date(dmYhis);
	
	$ruta = "./back_up/restaurados/";						// variable con la cadena q indica la ruta
	$dir = opendir($ruta);						// abre el directorio de pedidos
	/*
	while ( $archivo=readdir($dir)) {			// lee el directorio y obtiene los nombres de los archivos
		$ok = substr($archivo,0,1); 			// en caso de q el nombre empiese con OK_ no lo muestra, porque q ya se guardo en la base de datos anteriormente
		if ($archivo != "." && $archivo != ".." && $ok != '_') { 
			rename($ruta.$archivo,$ruta."_".$hora."_".$archivo); 							  // renombra el archivo
		}
	}
	*/
  	//-------------- sube el archivo sql------------------------------------------------//
	$uploadfile = $ruta.$_FILES['archivo']['name'];
	if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
		if (move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadfile)) {
			chmod($uploadfile,0777);
			/* echo "<script>restaurar_base_datos_proceso($uploadfile)</script>";*/
			
			//echo '<div align=\"center\"><img src="../imagenes/progress10.gif"></div>'; // width="30" height="30"
			include("backup_restaurar_proceso.php");
			
			//$consulta_audit = "SELECT count(tabla) from auditoria";  // consulta sql
			//$result_audit = mysql_query($consulta_audit);            								// hace la consulta
			//$registro_audit = mysql_fetch_row($result_audit);        // toma el registro
			//$num_reg_ = $registro_audit[0];   
			
			//$consulta_audit = "INSERT INTO auditoria VALUES('RESTAURACION','$num_reg_ FILAS','-','-','$fecha_hora','$usuario@localhost','BACK-UP')";  // consulta sql
			//$result_audit = mysql_query($consulta_audit);            								// hace la consulta
		}
	}else{
			echo 'ERROR: NO SE PUDO RESTAURAR LA BASE DE DATOS';
	}
	closedir($dir);	
	?>
	  <script>
			window.parent.document.getElementById("listado2").innerHTML= '';
			window.parent.document.getElementById("enviar").disabled= false;
	  </script>
	<?
	
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="utilidades";
	$plantilla = "backup_restaurar.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>