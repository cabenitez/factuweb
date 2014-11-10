<?
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta1 ="SELECT codigo, cantidad FROM
						(
						SELECT 
						concat(cod_grupo,cod_marca,cod_variedad,cod_prod) AS codigo, cantidad 
						FROM factura_vta_no_cliente INNER JOIN factura_vta_no_cliente_detalle  
						ON factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario 
						
						WHERE factura_vta_no_cliente.cod_talonario = '$cod_tal'
						AND  factura_vta_no_cliente.num_talonario = $num_tal
						AND  factura_vta_no_cliente.n_factura = $num_fact
					UNION
						SELECT 
						concat(cod_grupo,cod_marca,cod_variedad,cod_prod)AS codigo, cantidad
						FROM factura_vta INNER JOIN factura_vta_detalle 
						ON factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario 
						
						WHERE factura_vta.cod_talonario = '$cod_tal'
						AND factura_vta.num_talonario = $num_tal
						AND factura_vta.n_factura = $num_fact
				) AS detalle_factura ";
	
	$result1 = mysql_query($consulta1);            // hace la consulta
	$registro1 = mysql_fetch_row($result1);        // toma el registro
	$nfilas1 = mysql_num_rows ($result1);          //indica la cantidad de resultados

	if($nfilas1 > 0){
		//----------------------------------- PDF --------------------------------------------------------------------------------------------//
		//-------------------------//
		$len_n_talonario=strlen($num_tal); 					// completo el numero de la sucursal con ceros
		$ceros_3 = '';
		while ($len_n_talonario < 4){
				$ceros_3.="0";
				$len_n_talonario++;
		}
		$num_tal=$ceros_3.$num_tal;
		//-------------------------//
		$len_num_sucursal=strlen($suc); 					// completo el numero de la sucursal con ceros
		$ceros_2 = '';
		while ($len_num_sucursal < 4){
				$ceros_2.="0";
				$len_num_sucursal++;
		}
		$suc=$ceros_2.$suc;
		//-------------------------//
		$len_num_factura=strlen($num_fac); 						// completo el numero de factura con ceros
		$ceros= '';
		while ($len_num_factura < 8){								// completo el numero de la factura con ceros
				$ceros.="0";
				$len_num_factura++;
		}
		$num_fac=$ceros.$num_fac;

		echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
		echo"<tr class='totales'>";			
			echo"<td colspan='2' align='left'>&nbsp;&nbsp;$num_tal - $desc_fac $suc  $num_fac";
			echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CLIENTE: $razon";
			echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; REPARTIDOR: $observacion </td>";
		echo"</tr>";

		echo "<tr class='top'>";
			echo "<td width='5%'><div align='center' class='seccion'>CODIGO</div></td>";
			echo "<td width='30%'><div align='center' class='seccion'>DESCRIPCION</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>BULTOS</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>ENVASES</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>CAJONES</div></td>";
		echo "</tr>";

		$clase="class='filas'"; 							//defino la clase para las filas

		do{ 		// obtengo los resultados					
					$codigo=$registro1[0];		
					$cantidad=$registro1[1];
					
					$consulta2 = "SELECT descripcion, peso, envase, unidad_bulto FROM producto where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo"; // % DE IVA
					$result2 = mysql_query($consulta2);            
					$registro2 = mysql_fetch_row($result2);        
					$descripcion=$registro2[0];
					$peso=$registro2[1];
					$envase=$registro2[2];
					$unidad_bulto=$registro2[3];
							

					$envases= 0;
					if($envase == "SI"){
						$envases= $cantidad * $unidad_bulto;
						
						$cajon = round($cantidad);
						if($cantidad > $cajon){
								$cajon++;
						}
						
						echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
							echo "<td $clase align='left'>";
									echo $espacio_izq.$codigo;     
							echo"</td>";
							echo "<td $clase align='left'>";
									echo $espacio_izq.$descripcion;     
							echo"</td>";
							echo "<td $clase align='right'>";
									echo $cantidad.$espacio_izq;     
							echo"</td>";
							echo "<td $clase align='right'>";
									echo $envases.$espacio_izq;     
							echo"</td>";
							echo "<td $clase align='right'>";
									echo $cajon.$espacio_izq;     
							echo"</td>";
						echo"</tr>";
						$total_cantidad= $total_cantidad + $cantidad;
						$total_cajon= $total_cajon + $cajon;
						$total_envases= $total_envases+$envases;
					}
		}while($registro1 = mysql_fetch_array($result1)); //end while

		echo"<tr bgcolor='#E0E0E0' >";			
			echo"<td colspan='2' align='left'>&nbsp;&nbsp;TOTALES	</td>";
					
			$total_precio= number_format($total_precio,2,'.','');
			$total_importe = number_format($total_importe,2,'.','');
			$total_fila= number_format($total_fila,2,'.','');
					
			echo"<td align='right'>$total_cantidad$espacio_izq</td>";
			echo"<td align='right'>$total_envases$espacio_izq</td>";
			echo"<td align='right'>$total_cajon$espacio_izq</td>";
		$total_cantidad= 0;
		$total_cajon = 0;
		$total_envases = 0;

		echo"</tr>";
		echo "<br>";
	}
?>