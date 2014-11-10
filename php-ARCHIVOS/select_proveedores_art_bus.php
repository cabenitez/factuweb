<? 
	include("conexion.php");
	$consulta = "SELECT * FROM proveedor order by razon_social"; // consulta sql                  where nombre = '$nombre'
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		echo"<select name='lista_prov' id='lista_prov' class='caja' onkeyup='pasar_foco_art_6_bus(event)'>"; //onKeyUp='pasar_foco_loca_registrar_lista(event)'
		echo "<option value='TODOS'>TODOS</option>";
		do{
			$codigo=$registro[0];
			$nombre=$registro[1];
			echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
		echo"</select>";
	}	
?>