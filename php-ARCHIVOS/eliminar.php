<? 
session_start();   // Iniciar sesión
$usuario_sesion = $_SESSION['user_usuario']; //usuario conectado

//---------------------------------PAIS---------------------------------------------------------------------------------------//
$codigo_pais = $_POST["codigo_pais"]; 					// toma la variable de la url q vino de ajax.js
if($codigo_pais){
	include("conexion.php");
	
	$consulta = "SELECT abm_zonas_geo FROM usuario where usuario = '$usuario_sesion'"; // consulta sql
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$permiso= $registro[0];
	if ($permiso == 'S'){     						 // si existe el usuario inicia la sesion
		$consulta = "call eliminar_pais($codigo_pais)";
		$result = mysql_query($consulta);            // hace la consulta
		echo "Registro Eliminado!!";
	}else{
		echo "sin_permiso";
	}	
}
//---------------------------------PROVINCIA-------------------------------------------------------------------------------//
$codigo_prov = $_POST["codigo_prov"]; 					// toma la variable de la url q vino de ajax.js
if($codigo_prov){
	include("conexion.php");
	
	$consulta = "SELECT abm_zonas_geo FROM usuario where usuario = '$usuario_sesion'"; // consulta sql
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$permiso= $registro[0];
	if ($permiso == 'S'){     						 // si existe el usuario inicia la sesion
		$consulta = "call eliminar_provincia($codigo_prov)";
		$result = mysql_query($consulta);            // hace la consulta
		echo "Registro Eliminado!!";
	}else{
		echo "sin_permiso";
	}	
}
//---------------------------------LOCALIDAD-------------------------------------------------------------------------------//
$codigo_loca = $_POST["codigo_loca"]; 					// toma la variable de la url q vino de ajax.js
if($codigo_loca){
	include("conexion.php");
	
	$consulta = "SELECT abm_zonas_geo FROM usuario where usuario = '$usuario_sesion'"; // consulta sql
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$permiso= $registro[0];
	if ($permiso == 'S'){     						 // si existe el usuario inicia la sesion
		$consulta = "call eliminar_localidad($codigo_loca)";
		$result = mysql_query($consulta);            // hace la consulta
		echo "Registro Eliminado!!";
	}else{
		echo "sin_permiso";
	}	
}
//---------------------------------TIPO ASOCIADO-----------------------------------------------------------------------------------//
$letra_tipo_asoc = $_POST["letra_tipo_asoc"]; 					// toma la variable de la url q vino de ajax.js
if($letra_tipo_asoc){
	include("conexion.php");
	$consulta = "call eliminar_tipo_asociado('$letra_tipo_asoc')";
	$result = mysql_query($consulta);            // hace la consulta
 	echo "Registro Eliminado!!";
}
//---------------------------------ZONA-------------------------------------------------------------------------------------//
$codigo_zona = $_POST["codigo_zona"]; 					// toma la variable de la url q vino de ajax.js
if($codigo_zona){
	include("conexion.php");
	
	$consulta = "SELECT abm_zonas_geo FROM usuario where usuario = '$usuario_sesion'"; // consulta sql
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$permiso= $registro[0];
	if ($permiso == 'S'){     						 // si existe el usuario inicia la sesion
		$consulta = "call eliminar_zona($codigo_zona)";
		$result = mysql_query($consulta);            // hace la consulta
		echo "Registro Eliminado!!";
	}else{
		echo "sin_permiso";
	}	
}
//---------------------------------IVA-------------------------------------------------------------------------------------//
$codigo_iva = $_POST["codigo_iva"]; 					// toma la variable de la url q vino de ajax.js
if($codigo_iva){
	include("conexion.php");
	
	$consulta = "SELECT abm_alicuotas FROM usuario where usuario = '$usuario_sesion'"; // consulta sql
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$permiso= $registro[0];
	if ($permiso == 'S'){     						 // si existe el usuario inicia la sesion
		$consulta = "call eliminar_iva($codigo_iva)";
		$result = mysql_query($consulta);            // hace la consulta
		echo "Registro Eliminado!!";
	}else{
		echo "sin_permiso";
	}	

}
//---------------------------------IMPUESTO INTERNO-------------------------------------------------------------------------//
$codigo_ii = $_POST["codigo_ii"]; 					// toma la variable de la url q vino de ajax.js
if($codigo_ii){
	include("conexion.php");
	
	$consulta = "SELECT abm_alicuotas FROM usuario where usuario = '$usuario_sesion'"; // consulta sql
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$permiso= $registro[0];
	if ($permiso == 'S'){     						 // si existe el usuario inicia la sesion
		$consulta = "call eliminar_ii($codigo_ii)";
		$result = mysql_query($consulta);            // hace la consulta
		echo "Registro Eliminado!!";
	}else{
		echo "sin_permiso";
	}	

}
//---------------------------------PERCEPCION DE IVA------------------------------------------------------------------------//
$codigo_pi = $_POST["codigo_pi"]; 					// toma la variable de la url q vino de ajax.js
if($codigo_pi){
	include("conexion.php");
	
	$consulta = "SELECT abm_alicuotas FROM usuario where usuario = '$usuario_sesion'"; // consulta sql
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$permiso= $registro[0];
	if ($permiso == 'S'){     						 // si existe el usuario inicia la sesion
		$consulta = "call eliminar_pi($codigo_pi)";
		$result = mysql_query($consulta);            // hace la consulta
		echo "Registro Eliminado!!";
	}else{
		echo "sin_permiso";
	}	

}
//---------------------------------INGRESO BRUTO----------------------------------------------------------------------------//
$codigo_ib = $_POST["codigo_ib"]; 					// toma la variable de la url q vino de ajax.js
if($codigo_ib){
	include("conexion.php");
	
	$consulta = "SELECT abm_alicuotas FROM usuario where usuario = '$usuario_sesion'"; // consulta sql
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$permiso= $registro[0];
	if ($permiso == 'S'){     						 // si existe el usuario inicia la sesion
		$consulta = "call eliminar_ib($codigo_ib)";
		$result = mysql_query($consulta);            // hace la consulta
		echo "Registro Eliminado!!";
	}else{
		echo "sin_permiso";
	}	

}
//---------------------------------LINEA DE REMITO VTA----------------------------------------------------------------------//
$fila = $_POST["fila"]; 					// toma la variable de la url q vino de ajax.js
if($fila){
	include("conexion.php");
	$consulta = "call eliminar_linea_remito_vta('$usuario_sesion',$fila)";
	$result = mysql_query($consulta);            // hace la consulta
 	//echo $consulta;
}
//---------------------------------LINEA DE FACTURA VTA----------------------------------------------------------------------//
$fila_fac = $_POST["fila_fac"]; 					// toma la variable de la url q vino de ajax.js
if($fila_fac){
	include("conexion.php");
	$consulta = "call eliminar_linea_factura_vta('$usuario_sesion',$fila_fac)";
	$result = mysql_query($consulta);            // hace la consulta
 	//echo $consulta;
}
//---------------------------------LINEA DE DEVOLUCION ----------------------------------------------------------------------//
$fila_dev = $_POST["fila_dev"]; 					// toma la variable de la url q vino de ajax.js
if($fila_dev){
	include("conexion.php");
	$consulta = "call eliminar_linea_devolucion('$usuario_sesion',$fila_dev)"; 
	$result = mysql_query($consulta);            // hace la consulta
 	//echo $consulta;
}
//---------------------------------LINEA DE FACTURA COMPRA----------------------------------------------------------------------//
$fila_fac_compra = $_POST["fila_fac_compra"]; 					// toma la variable de la url q vino de ajax.js
if($fila_fac_compra){
	include("conexion.php");
	$consulta = "call eliminar_linea_factura_compra('$usuario_sesion',$fila_fac_compra)";
	$result = mysql_query($consulta);            // hace la consulta
 	//echo $consulta;
}

//---------------------------------USUARIO---------------------------------------------------------------------------------------//
$codigo_usuario = $_POST["codigo_usuario"]; 					// toma la variable de la url q vino de ajax.js 
if($codigo_usuario){
	include("conexion.php");

	$consulta = "call eliminar_usuario($codigo_usuario)"; 					// cambia el estado acivo a N
	$result = mysql_query($consulta);            // hace la consulta 
	
	$consulta = "select usuario from usuario where cod_usuario = $codigo_usuario";
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$usuario_borrar = $registro[0];   

	$consulta2 = "DROP USER $usuario_borrar;";
	$result2 = mysql_query($consulta2);            // hace la consulta
	
	echo "Registro Eliminado!!";
}

//---------------------------------ART ASOCIADO-----------------------------------------------------------------------------------//
$codigo_art_asociado = $_POST["codigo_art_asociado"]; 					// toma la variable de la url q vino de ajax.js 
if($codigo_art_asociado){
	include("conexion.php");
	$consulta = "call eliminar_art_asociado($codigo_art_asociado)";
	$result = mysql_query($consulta);            // hace la consulta
	echo "Registro Eliminado!!";
}
//---------------------------------AGENDA---------------------------------------------------------------------------------------//
$codigo_persona_agenda = $_POST["codigo_codigo_persona_agenda"]; 					// toma la variable de la url q vino de ajax.js
if($codigo_persona_agenda){
	include("conexion.php");
	
	$consulta = "SELECT utilidades FROM usuario where usuario = '$usuario_sesion'"; // consulta sql
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$permiso= $registro[0];
	if ($permiso == 'S'){     						 // si existe el usuario inicia la sesion
		$consulta = "call eliminar_persona_agenda($codigo_persona_agenda)";
		$result = mysql_query($consulta);            // hace la consulta
		echo "Registro Eliminado!!";
	}else{
		echo "sin_permiso"; 
	}	
}


?>