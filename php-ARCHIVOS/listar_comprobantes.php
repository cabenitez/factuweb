<? 
	include("conexion.php");
	$consulta = "SELECT * FROM tipo_talonario order by cod_talonario"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		echo"<select name='lista_comp' id='lista_comp' class='caja' onKeyUp='pasar_foco_cond_iva_2(event)' >"; //
		do{
			$codigo=$registro[0];
			$nombre=$registro[1];
			echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
		echo"</select>";
	}	
?>