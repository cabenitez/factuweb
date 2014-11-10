<?
if (!empty($codigo)){
    $consulta = $consulta. " " . $consulta2 . " " . "cod_marca LIKE '%$codigo%'";
	$palabra=$codigo;
	if (!empty($nombre)){
		$consulta = $consulta. " " . "and marca.descripcion LIKE '%$nombre%'"; 
		$palabra.=" + ".$nombre;
	}
    if ($cod_grupo != "TODOS"){
	 	$consulta = $consulta. " " . "and marca.cod_grupo = $cod_grupo"; 
		$palabra.=" + ".$cod_grupo;
	}
}else{
	if (!empty($nombre)){ 
		$consulta = $consulta. " " . $consulta2 . " " . "marca.descripcion LIKE '%$nombre%'"; 
		$palabra=$nombre;
		if ($cod_grupo != "TODOS"){
			$consulta = $consulta. " " . "and marca.cod_grupo = $cod_grupo"; 
			$palabra.=" + ".$codg_grupo;
		}
	}else{
		if ($cod_grupo != "TODOS"){
			$consulta = $consulta. " " . $consulta2 . " " . "marca.cod_grupo = $cod_grupo";
			$palabra=$cod_grupo;
		} 
	}
}
$nombre=$palabra; // variable para incluir en la consulta 
?>