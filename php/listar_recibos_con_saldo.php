<?
include("conexion.php");
if($codigo){
	// busca la zona, loc, prov y pais del cliente
	$consulta = "SELECT * from cliente where cod_cliente = $codigo"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        		// toma el registro
	
	$cod_zona=$registro[1];
	$cod_localidad=$registro[2];
	$cod_prov=$registro[3];
	$cod_pais=$registro[4];

	//busca los recibos del cliente y obtiene el importe
	$consulta = "SELECT * FROM cc_vta where cod_cliente = $codigo and  cod_pais = $cod_pais and cod_prov = $cod_prov and cod_localidad = $cod_localidad and cod_zona = $cod_zona"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	

	echo"<select name='lista_recibo' id='lista_recibo' class='select_1' onKeyUp='calcular_importe_imputacion_cta_cte(event)'>"; 
		if($nfilas > 0){
			do{
					$num_recibo=$registro[0];
					$cod_talonario=$registro[6];
					$num_talonario=$registro[7];
					$importe=$registro[8];
	
					//busca el detalle de los recibos para comparar si quedan saldos
					$consulta_d = "SELECT sum(importe) FROM cc_vta_detalle where num_recibo = $num_recibo and cod_talonario_recibo = '$cod_talonario' and num_talonario_recibo = $num_talonario"; // consulta sql 
					$result_d = mysql_query($consulta_d);            // hace la consulta
					$registro_d = mysql_fetch_row($result_d);        // toma el registro
					$importe_d=$registro_d[0];
					if($importe > $importe_d){
						
						//====================OBTENGO LA DESCRIPCION DEL RECIBO==========================//
						$consulta2 = "select * from tipo_talonario inner join talonario on tipo_talonario.cod_talonario = talonario.cod_talonario 
										where talonario.cod_talonario = '$cod_talonario' and talonario.num_talonario = $num_talonario"; 
						$result2 = mysql_query($consulta2);            
						$registro2 = mysql_fetch_row($result2);        
						$desc_recibo=$registro2[1];
						$suc_recibo=$registro2[5];
	
						//-------------------------//
						$len_num_tal_recibo=strlen($num_talonario); 					// completo el numero de la sucursal con ceros
						$ceros_3 = '';
						while ($len_num_tal_recibo < 4){
								$ceros_3.="0";
								$len_num_tal_recibo++;
						}
						$num_talonario=$ceros_3.$num_talonario;
						//-------------------------//
						$len_num_sucursal_recibo=strlen($suc_recibo); 					// completo el numero de la sucursal con ceros
						$ceros_2 = '';
						while ($len_num_sucursal_recibo < 4){
								$ceros_2.="0";
								$len_num_sucursal_recibo++;
						}
						$suc_recibo=$ceros_2.$suc_recibo;
						//-------------------------//
						$len_num_recibo=strlen($num_recibo); 						// completo el numero de factura con ceros
						$ceros= '';
						while ($len_num_recibo < 8){								// completo el numero de la factura con ceros
								$ceros.="0";
								$len_num_recibo++;
						}
						$num_recibo=$ceros.$num_recibo;
						
						$saldo =$importe - $importe_d;
						$saldo = number_format($saldo,2,'.','');
						
						echo "<option  value=$saldo id='cod_tal_r=$cod_talonario&num_tal_r=$num_talonario&n_recibo_r=$num_recibo'  title='TALONARIO N&deg;: $num_talonario' >$suc_recibo-$num_recibo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saldo: $saldo</option>";
					}
			}while($registro = mysql_fetch_row($result)); // obtengo los resultados  
		}else{
						echo "<option  id='ERROR' value='ningun_recibo'  >NO EXISTEN RECIBOS</option>";
		}	
	echo"</select>";
}else{
	echo"<select name='lista_recibo' id='lista_recibo' class='select_1' onKeyUp='calcular_importe_imputacion_cta_cte(event)'>"; 
			echo "<option id='ERROR' value='seleccione_cliente'>SELECCIONE CLIENTE</option>";
	echo"</select>";
}
?>