<? 
include("conexion.php");
		
$consulta = "select * from stock_inicial";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
$result = mysql_query($consulta);            // hace la consulta
$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
	echo "ok";
}else{
	echo "error_existe";
}

?>