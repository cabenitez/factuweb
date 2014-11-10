<? 
	include("conexion.php");
	$consulta = "SELECT * FROM pais order by nombre"; // consulta sql                  where nombre = '$nombre'
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		echo"<select name='lista_pais' id='lista_pais' class='caja' onkeyup='listar_prov_de_pais(event,this.value)'>"; //onKeyUp='pasar_foco_loca_registrar_lista(event)'
		do{
			$nombre=$registro[1];
			$codigo=$registro[0];
			echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
		echo"</select>";
	}	
?>