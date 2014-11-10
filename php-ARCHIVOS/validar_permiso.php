<?php
	session_start();   								// Iniciar sesión
	$usuario_activo = $_SESSION['user_usuario']; 	//usuario conectado

	include("conexion.php");
	$consulta = "SELECT $modulo FROM usuario where usuario = '$usuario_activo'"; // consulta sql
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$permiso= $registro[0];
	if ($permiso == 'S'){     				// si existe el usuario inicia la sesion
		$smarty->display($plantilla);   	//define la plantilla que utilizara
	}else{
		?>
		<script>
			alert('USUARIO SIN PERMISOS...');
			window.parent.location.href="index.php"; 
			//window.history.go(-1);
		</script>
		
		<?php
	}	

?>
