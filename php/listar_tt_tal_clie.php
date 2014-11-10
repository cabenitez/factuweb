<? 
	include("conexion.php");
	$consulta = "SELECT * FROM tipo_talonario where descripcion like '%fac%' or descripcion like '%FAC%' order by descripcion"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		echo"<select name='lista_tt' id='lista_tt' class='caja' onKeyUp='pasar_foco_clie_20_a(event)' >"; //
		do{
			$codigo=$registro[0];
			$nombre=$registro[1];
			echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
		echo"</select>";
	}	
?>