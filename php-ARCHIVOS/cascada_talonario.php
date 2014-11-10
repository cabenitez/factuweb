<?
//variables="numero="+txtnumero.value+"&tipo_talonario="+txt_tt;

if (!empty($numero)){
    $consulta = $consulta. " " . $consulta2 . " " . "num_talonario = $numero";
	$palabra.=$numero;
	if ($tipo_talonario != "TODOS"){
		$consulta = $consulta. " " . "and descripcion = '$tipo_talonario'"; 
		$palabra.=" + ".$tipo_talonario; 
	}
}else{
	if ($tipo_talonario != "TODOS"){
		$consulta = $consulta. " " . $consulta2 . " " . "descripcion = '$tipo_talonario'"; 
		$palabra.=$tipo_talonario; 
	}
}	 
$nombre=$palabra; // variable para incluir en la consulta
?>