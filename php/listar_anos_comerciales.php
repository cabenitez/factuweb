<? 
	include("conexion.php"); 
	$consulta = "SELECT substr(fecha,1,4) FROM(
						select fecha from factura_vta where observacion <> 'ANULADO' and observacion <> 'N/C' 
						union 
						select fecha from factura_vta_no_cliente  where observacion <> 'ANULADO' and observacion <> 'N/C' 
				) AS anos group by substr(fecha,1,4)"; // consulta sql 

	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='ano_vta' id='ano_vta' size='3' class='caja'onKeyUp='pasar_foco_estad_2(event)'>";  //multiple
		do{
				$ano=$registro[0];
				echo "<option value=$ano title='$ano'>$ano $espacio_izq$espacio_izq$espacio_izq$espacio_izq$espacio_izq$espacio_izq$espacio_izq$espacio_izq$espacio_izq$espacio_izq$espacio_izq</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>