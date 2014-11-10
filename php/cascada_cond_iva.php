<?
//variables="nombre="+txtnombre.value+"&comp="+lista_comp;

if (!empty($nombre)){
    $consulta = $consulta. " " . $consulta2 . " " . "iva.nombre LIKE '%$nombre%'";
	$palabra=$nombre;
	if ($comp != "TODOS"){
		$consulta = $consulta. " " . "and tipo_talonario.cod_talonario = '$comp'"; 
		$palabra.=" + ".$comp;
	}
}else{
	if ($comp != "TODOS"){
			$consulta = $consulta. " " . $consulta2 . " " . "tipo_talonario.cod_talonario = '$comp'";
			$palabra=$comp;
		} 
}
$nombre=$palabra; // variable para incluir en la consulta 
?>