<? 
	include("conexion.php");
	$consulta = "SELECT * FROM grupo order by cod_grupo"; // consulta sql                  where nombre = '$nombre'
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		echo"<select name='lista_grupo' id='lista_grupo' class='caja' onkeyup='listar_marca_de_grupo(event,this.value);listar_categorias_art_grupo(event,this.value);'>"; //onKeyUp='pasar_foco_loca_registrar_lista(event)'
		do{
			$nombre=$registro[1];
			$codigo=$registro[0];
			echo "<option value=$codigo title='$nombre'>$codigo</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
		echo"</select>";
	}	
?>