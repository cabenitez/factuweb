<?
//		variables="codigo="+txtcodigo.value+"&desc="+txtdesc.value+"&grupo="+txtgrupo;

if (!empty($codigo)){
    $consulta = $consulta. " " . $consulta2 . " " . "concat(cod_grupo, cod_marca, cod_variedad, cod_prod) LIKE '%$codigo%'";
	$palabra.=$codigo;
	if (!empty($desc)){
		$consulta = $consulta. " " . "and descripcion LIKE '%$desc%'"; 
		$palabra.=" + ".$desc; 
	}
    if ($grupo != "TODOS"){
	 	$consulta = $consulta. " " . "and cod_grupo = $grupo"; 
		$palabra.=" + ".$grupo; 
	}
}else{
	if (!empty($desc)){
			$consulta = $consulta. " " . $consulta2 . " " . "descripcion LIKE '%$desc%'";
			$palabra.=" + ".$desc; 
			if ($grupo != "TODOS"){
				$consulta = $consulta. " " . "and cod_grupo = $grupo"; 
				$palabra.=" + ".$grupo; 
			}
	}else{
		if ($grupo != "TODOS"){ 
			$consulta = $consulta. " " . $consulta2 . " " . "cod_grupo = $grupo";
			$palabra.=$grupo; 
		}	
	}
} 
$nombre=$palabra; // variable para incluir en la consulta
?>
