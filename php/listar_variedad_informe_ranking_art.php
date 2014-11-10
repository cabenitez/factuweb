<?
if($cod_marca){
  if( $cod_marca != "TODOS" && $cod_grupo != "TODOS" ) {
		include("conexion.php");
		if($cod_marca != "TODOS" && $cod_grupo != "TODOS"){
				$consulta ="SELECT * FROM variedad where cod_marca = $cod_marca and cod_grupo = $cod_grupo ORDER BY descripcion";
				$result = mysql_query($consulta);            // hace la consulta
				$registro = mysql_fetch_row($result);        // toma el registro
		}
		echo"<select name='lista_variedad' id='lista_variedad' class='caja' onkeyup='informe_articulos_cliente_7(event)'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
			echo "<option value='TODOS'>TODOS</option>";
			do{ 
					$codigo=$registro[0];
					$nombre=$registro[3];
						if($cod_marca != "TODOS" && $cod_grupo != "TODOS"){
								echo "<option value=$codigo>$nombre</option>";
						}		
			}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
		echo"</select>";
	}else{
		echo"<select name='lista_variedad' id='lista_variedad' class='caja' onkeyup='informe_articulos_cliente_7(event)'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
			echo "<option value='TODOS'>TODOS</option>";
		echo"</select>";
	}	
}else{
	echo"<select name='lista_variedad' id='lista_variedad' class='caja'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		echo "<option value='TODOS'>TODOS</option>";
	echo"</select>";
}
?>





