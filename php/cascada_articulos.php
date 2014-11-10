<?
//variables="grupo="+txtgrupo+"&marca="+txtmarca+"&variedad="+txtvariedad+"&codigo="+txtcodigo.value+"&desc="+txtdesc.value+"&proveedor="+txtprov; 

if (!empty($codigo)){
		$consulta = $consulta. " " . $consulta2 . " concat(producto.cod_grupo,producto.cod_marca,producto.cod_variedad, producto.cod_prod) = $codigo"; 

		if (!empty($desc)){
			$consulta = $consulta. " " . "and producto.descripcion LIKE '%$desc%'"; 
		}
		if ($grupo != 'TODOS'){
			$consulta = $consulta. " " . "and producto.cod_grupo = $grupo";
		}
		if ($marca != 'TODOS'){
			$consulta = $consulta. " " . "and producto.cod_marca = $marca"; 
		}
		if ($variedad != 'TODOS'){
			$consulta = $consulta. " " . "and producto.cod_variedad = $variedad"; 
		}
		if ($proveedor != 'TODOS'){
			$consulta = $consulta. " " . "and proveedor.cod_proveedor = $proveedor"; 
		}
}else{
		if (!empty($desc)){
				$consulta = $consulta. " " . $consulta2 . " producto.descripcion LIKE '%$desc%'"; 

				if ($grupo != 'TODOS'){
					$consulta = $consulta. " " . "and producto.cod_grupo = $grupo";
				}
				if ($marca != 'TODOS'){
					$consulta = $consulta. " " . "and producto.cod_marca = $marca"; 
				}
				if ($variedad != 'TODOS'){
					$consulta = $consulta. " " . "and producto.cod_variedad = $variedad"; 
				}
				if ($proveedor != 'TODOS'){
					$consulta = $consulta. " " . "and proveedor.cod_proveedor = $proveedor"; 
				}
		}else{
				if ($grupo != 'TODOS'){
						$consulta = $consulta. " " . $consulta2 . " producto.cod_grupo = $grupo"; 
		
						if ($marca != 'TODOS'){
							$consulta = $consulta. " " . "and producto.cod_marca = $marca"; 
						}
						if ($variedad != 'TODOS'){
							$consulta = $consulta. " " . "and producto.cod_variedad = $variedad"; 
						}
						
						if ($proveedor != 'TODOS'){
							$consulta = $consulta. " " . "and proveedor.cod_proveedor = $proveedor"; 
						}
				}else{
						if ($marca != 'TODOS'){
							$consulta = $consulta. " " . $consulta2 . " producto.cod_marca = $marca"; 
						
							if ($variedad != 'TODOS'){
								$consulta = $consulta. " " . "and producto.cod_variedad = $variedad"; 
							}
							
							if ($proveedor != 'TODOS'){
								$consulta = $consulta. " " . $consulta2 . " proveedor.cod_proveedor = $proveedor"; 
							}	
						}else{
							if ($variedad != 'TODOS'){
								$consulta = $consulta. " " . $consulta2 . " producto.cod_variedad = $variedad"; 
							
								if ($proveedor != 'TODOS'){
									$consulta = $consulta. " " . $consulta2 . " proveedor.cod_proveedor = $proveedor"; 
								}	
							}else{
								if ($proveedor != 'TODOS'){
									$consulta = $consulta. " " . $consulta2 . " proveedor.cod_proveedor = $proveedor"; 
								}	
							}
						
						}	
				}
		}
} 
//echo $consulta;
//$nombre=$palabra; // variable para incluir en la consulta
?>
