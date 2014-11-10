<?php
	session_start();   								// Iniciar sesión
	$usuario_activo = $_SESSION['usr_usuario']; 	//usuario conectado

	include("conexion.php");
	$consulta = "SELECT * FROM permiso WHERE id_perfil = {$_SESSION['usr_perfil']} AND permiso = 1"; // consulta sql
    $result = mysqli_query($conexion,$consulta);          
	//$registros = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $permisos = array();
	while ($reg=mysqli_fetch_assoc($result)){
		$permisos[$reg['id_modulo']] = $reg['permiso'];
	}


	$menu = array();

	// zonas geograficas
	if(array_key_exists(1, $permisos)){

		$menu[] = array( 'id' => 21,   'pid' => 2,   'titulo'=> 'Zonas Geográficas', 'link' => 'false', 'width' => 'auto');

		$menu[] = array( 'id' => 211,  'pid' => 21,  'titulo'=> 'Paises', 		   'link' => 'false', 'width' => 'auto');
		$menu[] = array( 'id' => 2111, 'pid' => 211, 'titulo'=> 'Alta de Paises',    'link' => 'alta_pais.php', 'width' => 'auto');
		$menu[] = array( 'id' => 2112, 'pid' => 211, 'titulo'=> 'Buscar País',       'link' => 'buscar_pais.php', 'width' => 'auto');

		$menu[] = array( 'id' => 212,  'pid' => 21,  'titulo'=> 'Provincias', 		   'link' => 'false', 'width' => 'auto');
		$menu[] = array( 'id' => 2121, 'pid' => 212, 'titulo'=> 'Alta de Provincias',    'link' => 'alta_provincia.php', 'width' => 'auto');
		$menu[] = array( 'id' => 2122, 'pid' => 212, 'titulo'=> 'Buscar Provincia',       'link' => 'buscar_provincia.php', 'width' => 'auto');









	}

	header('Content-Type: application/json');
	echo json_encode($menu);

?>
