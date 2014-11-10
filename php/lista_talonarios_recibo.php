<? 
	include("conexion.php");
	$consulta ="SELECT * FROM tipo_talonario inner join talonario on tipo_talonario.cod_talonario = talonario.cod_talonario
				where descripcion LIKE '%recibo%' or descripcion like '%RECIBO%'";
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		echo"<select name=$codigo id=$codigo class='caja' onKeyUp='pasar_foco_clie_20_a(event)' >"; //
		do{
			$cod_tal=$registro[0];
			$num_tal=$registro[4];
			$primer=$registro[8];
			$ultimo=$registro[9];
			$sig=$registro[10];
			
			$descripcion= 'Desde: '.$primer.' Hasta: '.$ultimo; 
			if($num_tal > $num_tal_asignado){
				echo "<option value=$num_tal title='$descripcion' >$num_tal</option>"; 
			}
			
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
		echo"</select>";
	}	
?>