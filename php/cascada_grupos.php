<?
if (!empty($codigo)){
    $consulta = $consulta. " " . $consulta2 . " " . "cod_grupo LIKE '%$codigo%'";
	$palabra.=$codigo;
	if (!empty($nombre)){
		$consulta = $consulta. " " . "and descripcion LIKE '%$nombre%'";
		$palabra.=" + ".$nombre; 
	}
}else{
	if (!empty($nombre)){ 
		$consulta = $consulta. " " . $consulta2 . " " . "descripcion LIKE '%$nombre%'";
		$palabra.=$nombre;
	}
} 
$nombre=$palabra; // variable para incluir en la consulta
?>
