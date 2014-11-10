<?
//"nombre="+ "&obs="
if (!empty($nombre)){
    $consulta = $consulta. " " . $consulta2 . " " . "descripcion LIKE '%$nombre%'";
	$palabra.=$nombre;
	if (!empty($obs)){
		$consulta = $consulta. " " . "and observacion LIKE '%$obs%'"; 
		$palabra.=" + ".$obs; 
	}
}else{
	if (!empty($obs)){
		$consulta = $consulta. " " . $consulta2 . " " . "observacion LIKE '%$obs%'"; 
		$palabra.=$obs; 
	}
}	 
$nombre=$palabra; // variable para incluir en la consulta
?>