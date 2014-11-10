<?
include("conexion.php");

$tabla = $_POST["tabla"];
$codigo = $_POST["codigo"];

session_register($tabla);
$_SESSION[$id] = $codigo;




/*
// ======================VERIFICO LA TABLA Y ASIGNO LA CONSULTA====================//
switch($tabla){
	case 'cliente':
		$consulta_sql = "select * from cliente where cod_cliente = $codigo";
	break;
}

// ======================OBTENGO LOS CAMPOS Y LOS REGISTROS========================//
if($consulta_sql){
	$result = mysql_query($consulta_sql); 
	
	$campos =  mysql_fetch_assoc($result);
	if(!is_array($campos))
		return;
		
	session_register($tabla);
	while(list($campo,$valor) = each($campos)){
		//$string .= $campo." ".$valor;
		//$_SESSION[$campo] = $valor;                 		// toma el campo nombre de la BD
		$_SESSION[$campo] = $valor;
	 }
}
*/
?>