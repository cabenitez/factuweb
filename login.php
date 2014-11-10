<?php

	include("conexion.php");

	$usuario = $_POST["usuario"];
	$clave   = md5($_POST["clave"]);
	 
	if($usuario & $clave){
	
		$consulta = sprintf("SELECT usuario.*, perfil.id_perfil, perfil.nombre as perfil_nombre FROM usuario INNER JOIN perfil ON perfil.id_perfil = usuario.id_perfil WHERE usuario = '%s' AND clave = '%s'", mysql_real_escape_string($usuario), mysql_real_escape_string($clave));
	    $result = mysqli_query($conexion,$consulta);      
	   	$nfilas = mysqli_num_rows ($result);    
	    $registro = mysqli_fetch_assoc($result);

	    if ($nfilas > 0){     	
			$registro['usuario'] = $registro['usuario'];           
			$nombre = $registro['nombre'];            
			$activo = $registro['activo'];            
			if($registro['activo'] == 'S'){

				$_SESSION["usr_id"]   	  	   = $registro['cod_usuario'];
				$_SESSION["usr_usuario"]  	   = $registro['usuario'];
				$_SESSION["usr_nombre"]   	   = $registro['nombre'];
				$_SESSION["usr_perfil"] 	   = $registro['id_perfil'];
				$_SESSION["usr_perfil_nombre"] = $registro['perfil_nombre'];
				$_SESSION["usr_hora_entrada"]  = date("h:i:s");
				
				$consulta = "SELECT * FROM permiso WHERE id_perfil = {$registro['id_perfil']}"; // consulta sql
			    $result = mysqli_query($conexion,$consulta);          

			    $permisos = array();
				while ($reg=mysqli_fetch_assoc($result)){
					if($reg['permiso'] == 1)
						array_push($permisos, $reg['id_modulo']);
				}
				$_SESSION["usr_permisos"] = $permisos;
				
				echo 200;

				//INSERT INTO auditoria VALUES(tabla,'cod_iva','',new.cod_iva,NOW(),USER(),'INSERT');
			}else{
		   		echo 'El Usuario fu&eacute; dado de Baja';     // si no existe el usuario
			}	
		}else{ 
		   	echo 'El Usuario no esta registrado';     // si no existe el usuario
		}
	}else{ 
	     echo 'Debe completar los campos';            // si los campos estan vacios} 
	}
?>