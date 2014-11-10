<?php
//session_start();   // Iniciar sesión
include("conexion.php");

if (isset($_POST["usuario"])){
	echo "<b>Usuario:</b> ".$_SESSION['nombre_usuario'];
}else{
	$consulta = "SELECT * FROM empresa"; // consulta sql
	$result = mysqli_query($conexion, $consulta);            // hace la consulta
	$nfilas = mysqli_num_rows($result);          //indica la cantidad de resultados
	$registro = mysqli_fetch_row($result);        // toma el registro

	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		//$dueno = $registro[1];                 
		$razon_social = $registro[2];                  
		$cuit = $registro[3];                  
		$iva = $registro[5];
		$tel = $registro[7];                  
		$fax = $registro[8];                  
		$movil = $registro[9];                 
		$dir = $registro[10];                  
		//$web = $registro[8];                
		//$email = $registro[9];                 
		//$logo = $registro[10];                  
		//$imagen = $registro[11]; 
		$cuit1=substr($cuit,0,2);
		$cuit2=substr($cuit,2,-1);
		$cuit3=substr($cuit,-1);
		$cuit=$cuit1.'-'.$cuit2.'-'.$cuit3;

			                
		echo "<div id='nombre_empresa' class='nombreEmpresa'> $razon_social</div>";
		echo "<div id='nombre_empresa' class='datosEmpresa'> $dir </div>";
		echo "<div id='nombre_empresa' class='datosEmpresa'> ";
		if ($tel != ""){
			echo "TEL: $tel";
		}
		if ($fax != ""){
			echo " FAX: $fax";
		}
		if ($movil != ""){
			echo " CEL: $movil";
		}
		echo "</div>";
		
		echo "<div id='nombre_empresa' class='datosEmpresa'> CUIT: $cuit  - IVA: $iva</div>";
			
	}else{
		echo "<div id='nombre_empresa' class='nombreEmpresa'> Sistema de Facturacion</div>";
		echo "<div id='nombre_empresa' class='datosEmpresa'> Calle Volz s/n - Montecarlo - Misiones - Argentina </div>";
		echo "<div id='nombre_empresa' class='datosEmpresa'> Cel: +54 03752 15601432 -- IVA: MONOTRIBUTO</div>";
	//	echo "<div id='nombre_empresa' class='datosEmpresa'> CUIT: 23-29840214-9  - IVA: RESPONSABLE MONOTRIBUTO</div>";
	}

}
?>