<?
//		variables="codigo="+txtcodigo.value+"&cuit="+cuit+"&razon="+txtrazon.value  +"&vendedor="+txtvendedor+"&zona="+txtzona;

if (!empty($codigo)){
    $consulta = $consulta. " " . $consulta2 . " " . "cod_cliente = $codigo";
	$palabra.=$codigo;
	if (!empty($razon)){
		$consulta = $consulta. " " . "and razon_social LIKE '%$razon%'"; 
		$palabra.=" + ".$razon; 
	}
    if (!empty($cuit)){
	 	$consulta = $consulta. " " . "and cuit = $cuit"; 
		$palabra.=" + ".$cuit; 
	}
    if ($vendedor != 'TODOS'){
	 	$consulta = $consulta. " " . "and cod_vendedor = $vendedor"; 
		include("conexion.php");
		if(!empty($vendedor)){
			$consulta_pal = "SELECT * FROM vendedor where cod_vendedor = $vendedor"; // consulta sql 
			$result_pal = mysql_query($consulta_pal);            // hace la consulta
			$registro_pal = mysql_fetch_row($result_pal);        // toma el registro
			$palabra.=" + ".$registro_pal[2];
		}
	}
    if ($zona != 'TODOS'){
	 	$consulta = $consulta. " " . "and cod_zona = $zona"; 
		include("conexion.php");
		
		if(!empty($zona)){
			$consulta_pal = "SELECT * FROM zona where cod_zona = $zona"; // consulta sql 
			$result_pal = mysql_query($consulta_pal);            // hace la consulta
			$registro_pal = mysql_fetch_row($result_pal);        // toma el registro
			$palabra.=" + ".$registro_pal[4];
		}	
	}
}else{
		if (!empty($razon)){
			$consulta = $consulta. " " . $consulta2 . " " . "razon_social LIKE '%$razon%'";
			$palabra.=$razon; 
			
			if (!empty($cuit)){
				$consulta = $consulta. " " . "and cuit = $cuit"; 
				$palabra.=" + ".$cuit; 
			}
			if ($vendedor != 'TODOS'){
				$consulta = $consulta. " " . "and cod_vendedor = $vendedor"; 
				include("conexion.php");
				
				if(!empty($vendedor)){
					$consulta_pal = "SELECT * FROM vendedor where cod_vendedor = $vendedor"; // consulta sql 
					$result_pal = mysql_query($consulta_pal);            // hace la consulta
					$registro_pal = mysql_fetch_row($result_pal);        // toma el registro
					$palabra.=" + ".$registro_pal[2];
				}
			}
			if ($zona != 'TODOS'){
				$consulta = $consulta. " " . "and cod_zona = $zona"; 
				include("conexion.php");
				
				if(!empty($zona)){
					$consulta_pal = "SELECT * FROM zona where cod_zona = $zona"; // consulta sql 
					$result_pal = mysql_query($consulta_pal);            // hace la consulta
					$registro_pal = mysql_fetch_row($result_pal);        // toma el registro
					$palabra.=" + ".$registro_pal[4];
				}	
			}
		}else{
				if (!empty($cuit)){ 
				$consulta = $consulta. " " . $consulta2 . " " . "cuit = $cuit";
				$palabra.=$cuit; 
				if ($vendedor != 'TODOS'){
					$consulta = $consulta. " " . "and cod_vendedor = $vendedor"; 
				}
				if ($zona != 'TODOS'){
					$consulta = $consulta. " " . "and cod_zona = $zona"; 
					include("conexion.php");
					
					if(!empty($zona)){
						$consulta_pal = "SELECT * FROM zona where cod_zona = $zona"; // consulta sql 
						$result_pal = mysql_query($consulta_pal);            // hace la consulta
						$registro_pal = mysql_fetch_row($result_pal);        // toma el registro
						$palabra.=" + ".$registro_pal[4];
					}	
				}
				}else{
					if ($vendedor != 'TODOS'){
						$consulta = $consulta. " " . $consulta2 . " " . "cod_vendedor = $vendedor"; 
						include("conexion.php");
						
						if(!empty($vendedor)){
							$consulta_pal = "SELECT * FROM vendedor where cod_vendedor = $vendedor"; // consulta sql 
							$result_pal = mysql_query($consulta_pal);            // hace la consulta
							$registro_pal = mysql_fetch_row($result_pal);        // toma el registro
							$palabra.=$registro_pal[2];
						}
						
						if ($zona != 'TODOS'){
							$consulta = $consulta. " " . "and cod_zona = $zona"; 
							include("conexion.php");
							if(!empty($zona)){
								$consulta_pal = "SELECT * FROM zona where cod_zona = $zona"; // consulta sql 
								$result_pal = mysql_query($consulta_pal);            // hace la consulta
								$registro_pal = mysql_fetch_row($result_pal);        // toma el registro
								$palabra.=" + ".$registro_pal[4];
							}	
						}
					}else{
							if ($zona != 'TODOS'){
								$consulta = $consulta. " " . $consulta2 . " " . "cod_zona = $zona"; 
								include("conexion.php");
								if(!empty($zona)){
									$consulta_pal = "SELECT * FROM zona where cod_zona = $zona"; // consulta sql 
									$result_pal = mysql_query($consulta_pal);            // hace la consulta
									$registro_pal = mysql_fetch_row($result_pal);        // toma el registro
									$palabra.=$registro_pal[4];
								}
							}
					}
				}	
			}	
} 
$nombre=$palabra; // variable para incluir en la consulta
?>
