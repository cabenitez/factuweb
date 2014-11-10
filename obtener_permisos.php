<?php
	session_start();   								// Iniciar sesión
	$usuario_activo = $_SESSION['usr_usuario']; 	//usuario conectado

	include("conexion.php");
	$consulta = "SELECT * FROM permiso WHERE id_perfil = {$_SESSION['usr_perfil']}  AND permiso = 1"; // consulta sql
    $result = mysqli_query($conexion,$consulta);          

    $permisos = array();
	while ($reg=mysqli_fetch_assoc($result)){
		$permisos[$reg['id_modulo']] = $reg['permiso'];
	}

	header('Content-Type: application/json');
	echo json_encode($permisos);
?>
