<?php

	include("conexion.php");

	$usuario = $_POST["usuario"];
	$clave   = md5($_POST["clave"]);
	 
	if($usuario & $clave){
	
		$consulta = "SELECT * FROM usuario where usuario = '$usuario' and clave = '$clave'"; // consulta sql
	    $result = mysqli_query($conexion,$consulta);      
	   	$nfilas = mysqli_num_rows ($result);    
	    $registro = mysqli_fetch_assoc($result);

	    if ($nfilas > 0){     	
			$registro['usuario'] = $registro['usuario'];           
			$nombre = $registro['nombre'];            
			$activo = $registro['activo'];            
			if($registro['activo'] == 'S'){
				//session_name($nombre_sesion);
				$_SESSION["user_usuario"]   = $registro['usuario'];             
				$_SESSION["clave_usuario"]  = $registro['clave'];             
				$_SESSION["nombre_usuario"] = $registro['nombre'];               
				$_SESSION["hora_entrada"]   = date("h:i:s");
				
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