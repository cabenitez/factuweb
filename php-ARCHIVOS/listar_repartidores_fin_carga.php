<?
	// Obtiene todas las localidades de los remitos hechos
	$fecha_actual=date("Y",time()).date("m",time()).date("d",time());

	include("conexion.php");
	// OBTIENE EL COD DEL REPARTIDOR DE TODOS LOS COMPROBANTES
	$consulta = " select DISTINCT (cod_repartidor) FROM (
				  select DISTINCT cod_repartidor from factura_vta where fecha = $fecha_actual
				  UNION ALL
				  select DISTINCT cod_repartidor from factura_vta_no_cliente where fecha = $fecha_actual
				  UNION ALL
				  select DISTINCT cod_repartidor from remito_vta where fecha = $fecha_actual
				  UNION ALL
				  select DISTINCT cod_repartidor from remito_vta_no_cliente where fecha = $fecha_actual
				  ) as repartidores GROUP BY cod_repartidor ORDER BY cod_repartidor";				
				  
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados 

	echo"<select name='lista_rep' id='lista_rep' class='caja' onKeyUp='pasar_foco_fin_carga(event)'>"; 
		if($nfilas != 0 ){
				do{
					$codigo = $registro[0];
					echo "<option value=$codigo>$codigo</option>"; //	lista de localidades de remitos a NO CLIENTES		
				}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		
		}else{
				echo "<option value='error'>NO EXISTEN COMPROBANTES</option>"; //	lista de localidades de remitos a NO CLIENTES
		}
	echo"</select>";
	
	
?>