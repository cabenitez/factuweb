<?
//variables="cond_iva="+con_iva.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
if($fecha_desde){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$pag_consulta ="select descripcion,n_sucursal, n_factura, razon_social, sum(round(total_sin_impuesto,2)) as neto_gravado, tasa_iva, sum(round(iva,2)) as importe_iva, sum(round(otros_impuestos,2)) as otros_imp, sum(round(total_general,2)) as total_general, observacion,fecha,cond_iva,cuit, cod_talonario FROM	(
							select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta_no_cliente.n_factura, factura_vta_no_cliente.razon_social,
								$importe_no_cliente_total_sin_impuesto, factura_vta_no_cliente_detalle.iva as tasa_iva, $importe_no_cliente_iva, $importe_no_cliente_otros_impuestos, $importe_no_cliente_total_general,
								observacion, fecha,cond_iva,factura_vta_no_cliente.cuit, factura_vta_no_cliente.cod_talonario
						
								$from_no_cliente
								
								where fecha >= $fecha_desde and fecha <= $fecha_hasta and factura_vta_no_cliente.cod_talonario <> 'X'";

								if ($nombre_prov != 'TODOS'){
									$pag_consulta .=" and factura_vta_no_cliente.provincia = '$nombre_prov'";
								}
								$pag_consulta .=" GROUP BY factura_vta_no_cliente_detalle.iva, factura_vta_no_cliente.cod_talonario, factura_vta_no_cliente.num_talonario, factura_vta_no_cliente.n_factura";																
	$pag_consulta .=" UNION
							select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta.n_factura, cliente.razon_social, 
								$importe_cliente_total_sin_impuesto, factura_vta_detalle.iva as tasa_iva, $importe_cliente_iva, $importe_cliente_otros_impuestos, $importe_cliente_total_general , 
								observacion, fecha,cliente.cod_iva as cond_iva,cliente.cuit, factura_vta.cod_talonario
							
								$from_cliente
										
								where fecha >= $fecha_desde and fecha <= $fecha_hasta  and factura_vta.cod_talonario  <> 'X'";
								
								if ($cod_prov != 'TODOS'){
									$pag_consulta .=" and factura_vta.cod_prov = $cod_prov";
								}
								$pag_consulta .=" GROUP BY factura_vta_detalle.iva, factura_vta.cod_talonario, factura_vta.num_talonario, factura_vta.n_factura";								
								
	$pag_consulta .=") AS ventas_repartidor GROUP BY cod_talonario,n_factura ORDER BY fecha,cod_talonario,n_factura,descripcion;";
	
	//echo $pag_consulta;			
	//   undefined
	//---------------------Paginacion----------------------------------------------------------------------------------------//
	//$estilo_pag_nav = "barra_nav";					//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
	//$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	//$estilo_pag_info = "caja";						//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	//$pag_tamano_extra = 1000;
	//include("paginador.php");						//OBLIGATORIO Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
	
	//---------------------Fin Paginacion------------------------------------------------------------------------------------//
	$result = mysql_query($pag_consulta);            // hace la consulta
	//$registro = mysql_fetch_row($result);        // toma el registro
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados

	if($nfilas > 0){

//if($pag_filas > 0){
	$registro = mysql_fetch_row($result);        // toma el registro
	echo "<br>";
	
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
		echo "<tr class='top'>";
        	echo "<td width='20%' ><div align='center' class='seccion'>COMPROBANTE</div></td>";
			echo "<td width='20%' ><div align='center' class='seccion'>CLIENTE</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>CAT.</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>CUIT</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>NETO GRAVADO</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>IVA</div></td>";
        	echo "<td width='10%' ><div align='center' class='seccion'>OTROS IMP.</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>TOTAL COMP.</div></td>";
		echo "</tr>";
		
		$clase="class='filas'"; 							//defino la clase para las filas
		echo"<tr bgcolor='#E0E0E0' >";			
			echo "<td colspan='8' class = 'content' align='left'>";
				$ano = substr($registro[10],0,4); 
				$mes = substr($registro[10],4,2);
				$dia = substr($registro[10],-2);
				echo "FECHA: $dia/$mes/$ano";										// maqueta la fecha para imprimir
			echo"</td>";
		echo "<tr>";

		do{ 					// obtengo los resultados 
				$desc_fac = $registro[0];
				$suc = $registro[1];
				$len_num_sucursal=strlen($suc); 					// completo el numero de la sucursal con ceros
				$ceros_2 = '';
				while ($len_num_sucursal < 4){
						$ceros_2.="0";
						$len_num_sucursal++;
				}
				$suc=$ceros_2.$suc;
		
				$n_fact = $registro[2];
				$n_factura=$n_fact;
				
				$len_num_factura=strlen($n_fact); 						// completo el numero de factura con ceros
				$ceros= '';
				while ($len_num_factura < 8){								// completo el numero de la factura con ceros
						$ceros.="0";
						$len_num_factura++;
				}
				$n_fact=$ceros.$n_fact;
				
				$observacion = $registro[9];
				$cod_talonario = $registro[13];
				
				if($observacion == 'ANULADO'){
					$razon='COMPROBANTE ANULADO';					
					$cond_iva=" ";
					$cuit=" ";
					$total_sin_imp=" ";
					$tasa_iva= " ";
					$total_iva=" ";
					$total_otros_imp=" ";
					$total_factura=" ";
				}else{
					
				    if($observacion == 'N/C'){
						$razon=$registro[3];
						$total_sin_imp=-$registro[4];
						$tasa_iva=$registro[5];
						$total_iva=-$registro[6];
						$total_factura=-$registro[8];
						$desc_fac = "NC ".$cod_talonario;
						
						$total_otros_imp=$registro[7];
						if($registro[7] > 0){
							$total_otros_imp=-$registro[7];
						}
					}else{
						$razon=$registro[3];
						$total_sin_imp=$registro[4];
						$tasa_iva=$registro[5];
						$total_iva=$registro[6];
						$total_otros_imp=$registro[7];
						$total_factura=$registro[8];
					}
					$total_carga_sin_imp= $total_carga_sin_imp + $total_sin_imp;
					$total_carga_iva = $total_carga_iva + $total_iva;
					$total_carga_otros_imp= $total_carga_otros_imp + $total_otros_imp;
					$total_carga_factura =$total_carga_factura + $total_factura;


 					$fecha=$registro[10];
					  $ano = substr($fecha,0,4); 
					  $mes = substr($fecha,4,2);
					  $dia = substr($fecha,-2);
					$fecha_mostrar = "$dia/$mes/$ano";										// maqueta la fecha para imprimir

					$cond_iva=$registro[11];
						$consulta_iva = "select * from iva where cod_iva = $cond_iva"; // consulta sql 
						$result_iva = mysql_query($consulta_iva);            // hace la consulta
						$registro_iva = mysql_fetch_row($result_iva);        // toma el registro
						$cond_iva=$registro_iva[2];

					$cuit=$registro[12];
					if($cuit != "undefined"){
						if($cuit != ""){
							$cuit1=substr($cuit,0,2);
							$cuit2=substr($cuit,2,-1);
							$cuit3=substr($cuit,-1);
							$cuit = "$cuit1-$cuit2-$cuit3"; 								// maqueta el cuit para imprimir
						}
					}else{
						$cuit = "";
					}	

				}
				
				//=======================================================================================================================================//
				
				if($fecha_anterior == ''){
					$fecha_anterior = $fecha;
					echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
							echo "<td $clase align='left'>";
									echo $espacio_izq.$desc_fac.' '.$suc.' '.$n_fact;     
							echo"</td>";
							echo "<td $clase align='left'>";
									echo $espacio_izq.$razon;     
							echo"</td>";
							echo "<td $clase align='left'>";
									echo $espacio_izq.$cond_iva;     
							echo"</td>";
							echo "<td $clase align='left'>";
									echo $espacio_izq.$cuit;     
							echo"</td>";
							echo "<td $clase align='right'>";
									echo $total_sin_imp.$espacio_izq;     
							echo"</td>";
							/*
							echo "<td $clase align='right'>";
									echo $tasa_iva.$espacio_izq;     
							echo"</td>";
							*/
							echo "<td $clase align='right'>";
									echo $total_iva.$espacio_izq;     
							echo"</td>";
							echo "<td $clase align='right'>";
									echo $total_otros_imp.$espacio_izq; 
							echo"</td>";
							echo "<td $clase align='right'>";
									echo $total_factura.$espacio_izq; 
							echo"</td>";
			
							//$total_carga_sin_imp= $total_carga_sin_imp + $total_sin_imp;
							//$total_carga_iva = $total_carga_iva + $total_iva;
							//$total_carga_otros_imp= $total_carga_otros_imp + $total_otros_imp;
							//$total_carga_factura = $total_carga_factura + $total_factura;
							
					echo"</tr>";
				}else{
						if($fecha_anterior != $fecha){
							$fecha_anterior = $fecha;
							echo"<tr bgcolor='#E0E0E0' >";			
								echo "<td colspan='9' class = 'content' align='left'>";
										echo "FECHA: ".$fecha_mostrar;     
								echo"</td>";
							echo "<tr>";
						}	
							echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
									echo "<td $clase align='left'>";
											echo $espacio_izq.$desc_fac.' '.$suc.' '.$n_fact;     
									echo"</td>";
									echo "<td $clase align='left'>";
											echo $espacio_izq.$razon;     
									echo"</td>";
									echo "<td $clase align='left'>";
											echo $espacio_izq.$cond_iva;     
									echo"</td>";
									echo "<td $clase align='left'>";
											echo $espacio_izq.$cuit;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo $total_sin_imp.$espacio_izq;     
									echo"</td>";
									/*
									echo "<td $clase align='right'>";
											echo $tasa_iva.$espacio_izq;     
									echo"</td>";
									*/
									echo "<td $clase align='right'>";
											echo $total_iva.$espacio_izq;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo $total_otros_imp.$espacio_izq; 
									echo"</td>";
									echo "<td $clase align='right'>";
											echo $total_factura.$espacio_izq; 
									echo"</td>";
				
									//$total_carga_sin_imp= $total_carga_sin_imp + $total_sin_imp;
									//$total_carga_iva = $total_carga_iva + $total_iva;
									//$total_carga_otros_imp= $total_carga_otros_imp + $total_otros_imp;
									//$total_carga_factura = $total_carga_factura + $total_factura;
							echo"</tr>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		
				echo"<tr bgcolor='#E0E0E0' >";			
					echo"<td colspan='4' align='left'>&nbsp;&nbsp;TOTALES	</td>";
					
					$total_carga_sin_imp= number_format($total_carga_sin_imp,2,'.','');
					$total_carga_iva = number_format($total_carga_iva,2,'.','');
					$total_carga_otros_imp= number_format($total_carga_otros_imp,2,'.','');
					$total_carga_factura = number_format($total_carga_factura,2,'.','');
					
					echo"<td align='right'>$total_carga_sin_imp$espacio_izq</td>";
					//echo"<td align='right'></td>";
					echo"<td align='right'>$total_carga_iva$espacio_izq</td>";
					echo"<td align='right'>$total_carga_otros_imp$espacio_izq</td>";
					echo"<td align='right'>$total_carga_factura$espacio_izq</td>";
					echo"<td align='center'></td>";
				echo"</tr>";
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------//
	//echo $pag_navegacion;


/*
		//===========================================================================================================================================================//
		//===================== CREO LA ULTIMA HOJA DEL INFORME IVA VENTAS ==========================================================================================//
		
		$pdf->AddPage();
		$n++;
		$pdf->Hoja($n);
		$pdf->Titulo($titulo);
													
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(1,3, 'DESDE '.$fecha_desde_mostrar.' HASTA '.$fecha_hasta_mostrar ,0,1);
		$pdf->Ln(5);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(1,3, 'IVA POR CATEGORIA DE CLIENTE' ,0,1);
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		
		// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
		$consulta ="select round(sum(total_sin_impuesto),2) as neto_gravado, tasa_iva, round(sum(iva),2) as importe_iva, round(sum(otros_impuestos),2) as otros_imp,round(sum(total_general),2), cond_iva FROM
						(
						select factura_vta_no_cliente.n_factura, round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) as total_sin_impuesto , 
						iva as tasa_iva,
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) as iva,
						
						(round(imp_interno,2)  + 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as otros_impuestos,
						
			
						(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) +
						round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as total_general,
						cond_iva
						
						from tipo_talonario inner join(talonario inner join (factura_vta_no_cliente inner join factura_vta_no_cliente_detalle  
						on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario)
						on factura_vta_no_cliente.cod_talonario = talonario.cod_talonario  and factura_vta_no_cliente.num_talonario = talonario.num_talonario)
						on talonario.cod_talonario = tipo_talonario.cod_talonario 
						where fecha >= $fecha_desde and fecha <= $fecha_hasta and factura_vta_no_cliente.cod_talonario <> 'X' and factura_vta_no_cliente.observacion <> 'ANULADO' GROUP BY factura_vta_no_cliente.n_factura 
						
					UNION
						select factura_vta.n_factura, round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) as total_sin_impuesto , 
						iva as tasa_iva,
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) as iva,
						
						(round(imp_interno,2)  + 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as otros_impuestos,
						
						(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) +
						round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as total_general,
						cod_iva as cond_iva
						
						from talonario inner join(tipo_talonario inner join(cliente inner join (factura_vta inner join factura_vta_detalle  on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario)
						on factura_vta.cod_cliente = cliente.cod_cliente) on cliente.cod_talonario = tipo_talonario.cod_talonario) on tipo_talonario.cod_talonario = talonario.cod_talonario  and talonario.num_talonario = factura_vta.num_talonario 
						where fecha >= $fecha_desde and fecha <= $fecha_hasta  and factura_vta.cod_talonario  <> 'X' and factura_vta.observacion <> 'ANULADO' GROUP BY factura_vta.n_factura 
				) AS ventas_repartidor  GROUP BY cond_iva,tasa_iva";
	
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro


		//---------------------- creo los titulos de las columnas-----------------------------------//
		$pdf->SetFont('Arial','',8);
		$pdf->SetX(6);
		$pdf->Cell(1,8,'CATEGORIA');
		$pdf->SetX(120);
		$pdf->Cell(1,8,'NETO GRAV.');
		$pdf->SetX(140);
		$pdf->Cell(1,8,'IVA');
		$pdf->SetX(148);
		$pdf->Cell(1,8,'IMPORTE');
		$pdf->SetX(165);
		$pdf->Cell(1,8,'OTROS IMP.');
		$pdf->SetX(184);
		$pdf->Cell(1,8,'TOTAL COMP.',0,1);
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de línea
		$pdf->SetFont('Arial','',8); 

		do{
			$total_sin_imp=$registro[0];
			$tasa_iva=$registro[1];
			$total_iva=$registro[2];
			$total_otros_imp=$registro[3];
			$total_factura=$registro[4];

			$cond_iva=$registro[5];
			$consulta_iva = "select * from iva where cod_iva = $cond_iva"; // consulta sql 
			$result_iva = mysql_query($consulta_iva);            // hace la consulta
			$registro_iva = mysql_fetch_row($result_iva);        // toma el registro
			$cond_iva=$registro_iva[2];

			$pdf->SetX(7);
			$pdf->Cell(1,3,$cond_iva,0,0);
			$pdf->SetX(-75);
			$pdf->Cell(1,3,$total_sin_imp,0,0,'R');
			$pdf->SetX(-68);
			$pdf->Cell(1,3,$tasa_iva,0,0);
			$pdf->SetX(-50);
			$pdf->Cell(1,3,$total_iva,0,0,'R');
			$pdf->SetX(-35);
			$pdf->Cell(1,3,$total_otros_imp,0,0,'R');
			$pdf->SetX(-7);
			$pdf->Cell(1,3,$total_factura,0,1,'R');
			$pdf->Cell(1,3,'',0,1);
			
			//$total_carga_sin_imp = $total_carga_sin_imp + $total_sin_imp;
			//$total_carga_iva = $total_carga_iva + $total_iva;
			//$total_carga_otros_imp = $total_carga_otros_imp + $total_otros_imp;
			//$total_carga_factura = $total_carga_factura + $total_factura;

		
		}while($registro = mysql_fetch_array($result)); //end while

*/


	}else{
		echo "NO se han encontrado Repartos para este d&iacute;a";
	}	
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->assign('dia',date("d",time()));  //asigna una cadena a la variable "nombre"
	//$smarty->assign('mes',date("m",time()));  //asigna una cadena a la variable "nombre"
	//$smarty->assign('ano',date("Y",time()));  //asigna una cadena a la variable "nombre"
	$smarty->display('informe_iva_ventas.tpl');   //define la plantilla que utilizara
}
?>
