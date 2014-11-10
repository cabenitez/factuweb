<? 
	include("conexion.php");
	$consulta = "SELECT * FROM grupo order by descripcion"; // consulta sql                  where nombre = '$nombre'
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		echo"<select name='lista_grupo' id='lista_grupo' class='caja' onKeyUp='pasar_foco_vari_11(event,this.value)' >"; //
		echo "<option value='TODOS'>TODOS</option>";
		do{
			$codigo=$registro[0];
			$nombre=$registro[1];
			echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
		echo"</select>";
	}	
?>