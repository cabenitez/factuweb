<?
//variables="codigo="+txtcodigo.value+"&desc="+txtdesc.value;

if (!empty($codigo)){
    $consulta = $consulta. " " . $consulta2 . " " . "cod_talonario = '$codigo'";
	$palabra.=$codigo;
	if (!empty($desc)){
		$consulta = $consulta. " " . "and descripcion LIKE '%$desc%'"; 
		$palabra.=" + ".$desc; 
	}
}else{
	if (!empty($desc)){
		$consulta = $consulta. " " . $consulta2 . " " . "descripcion LIKE '%$desc%'"; 
		$palabra.=$desc; 
	}
}	 
$nombre=$palabra; // variable para incluir en la consulta
?>