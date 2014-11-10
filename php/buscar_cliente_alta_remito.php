<? 
$codigo = $_GET["codigo"]; // toma la variable de la url q vino de ajax.js
if($codigo){
	include("conexion.php");
	$consulta = "SELECT * FROM cliente WHERE cod_cliente = $codigo and activo = 'S'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        		// toma el registro
	
	if ($nfilas > 0){     						 		// si existe el usuario inicia la sesion
		$razon= $registro[6];
		$dir= $registro[10];
		$cod_loca=$registro[2];
		$cod_prov=$registro[3]; 
		$cond_iva=$registro[15];
		$cuit=$registro[11];
			$cuit1=substr($cuit,0,2);
			$cuit2=substr($cuit,2,-1);
			$cuit3=substr($cuit,-1);
		$cod_categoria=$registro[16];
		$vendedor=$registro[17];
		$repartidor=$registro[18];
		
		$consulta = "SELECT nombre FROM localidad WHERE cod_localidad = $cod_loca"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$localidad = $registro[0];
		
		$consulta = "SELECT nombre FROM provincia WHERE cod_prov = $cod_prov"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$provincia = $registro[0];

		//***********************************************************************		
		header('Content-Type: text/xml'); 			// encabezado obligatorio XML
		echo "<clientes>\n"; 						// etiqueta superior
			echo '<razon>' . $razon . '</razon>';  
			echo '<dir>' . $dir . '</dir>';         
			echo '<localidad>' . $localidad . '</localidad>'; 
			echo '<provincia>' . $provincia . '</provincia>';
			echo '<cond_iva>' . $cond_iva . '</cond_iva>';
			if($cuit1 != ""){
				$cuit="con";
				echo '<cuit>' . $cuit . '</cuit>';
				//-----------------------------------				
				echo '<cuit1>' . $cuit1 . '</cuit1>';
				echo '<cuit2>' . $cuit2 . '</cuit2>';
				echo '<cuit3>' . $cuit3 . '</cuit3>';
			}else{
				$cuit="sin";
				echo '<cuit>' . $cuit . '</cuit>';
			}
			echo '<vendedor>' . $vendedor . '</vendedor>';    
			echo '<repartidor>' . $repartidor . '</repartidor>';
			echo '<cod_categoria>' . $cod_categoria . '</cod_categoria>';

			$error="0";
			echo '<error>' . $error . '</error>';
		echo "</clientes>";
	}else{
		header('Content-Type: text/xml'); 			// encabezado obligatorio XML
		echo "<clientes>\n"; 						// etiqueta superior
			$error="1";
			echo '<error>' . $error . '</error>';
		echo "</clientes>";	
	}
}else{
	require("smarty.php");  									// requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; 									//crea una instancia
	$smarty->display('buscar_cliente_alta_remito.tpl');     //define la plantilla que utilizara
}	
?>