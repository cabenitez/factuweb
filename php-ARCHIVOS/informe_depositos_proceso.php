<?
	include ("conexion.php");
	$nombre = strtoupper($nombre);
	if($nombre == "TODOS"){
		$pag_consulta = "SELECT * FROM deposito order by id"; 									// consulta sql
	}else{
		$consulta = "SELECT * FROM deposito where";
		include ("cascada_depositos_compra.php");
		$pag_consulta = $consulta . " " . "order by id";
	}
	
	$result = mysql_query($pag_consulta);           // hace la consulta
	$registro = mysql_fetch_row($result);        	// toma el registro
	$filas = mysql_num_rows ($result);          	//indica la cantidad de resultados
	if($filas > 0){
			echo "<div  align='right' class='seccion'>";
			echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_listado('exportar_depositos_compra.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_listado('exportar_depositos_compra.php')\" /> imprimir";
			echo "</div>";
			echo "<br>";
		
			//---------------------abre la tabla--------------------------------------------------------------------------------------//
			echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
				echo "<tr class='top'>";
					echo "<td width='10%'><div align='center' class='seccion'>Fecha - Hora</div></td>";
					echo "<td width='20%'><div align='center' class='seccion'>Banco</div></td>";
					echo "<td width='7%'><div align='center' class='seccion'>N&ordm; Transacci&oacute;n</div></td>";
					echo "<td width='7%'><div align='center' class='seccion'>N&ordm; Cuenta</div></td>";
					echo "<td width='20%'><div align='center' class='seccion'>Titular</div></td>";
					echo "<td width='7%'><div align='center' class='seccion'>Importe</div></td>";
					echo "<td width='20%'><div align='center' class='seccion'>Observacion</div></td>";
					echo "<td width='7%'><div align='center' class='seccion'>Detalle</div></td>";
				echo "</tr>";
				$clase="class='filas'"; 							//defino la clase para las filas
		
				do{ 	// obtengo los resultados 
						$id=$registro[0];		
						$fecha_deposito=$registro[1];
						$fecha_deposito_dia=substr($fecha_deposito,-2);
						$fecha_deposito_mes=substr($fecha_deposito,4,2);
						$fecha_deposito_ano=substr($fecha_deposito,0,4);
						$fecha_deposito= $fecha_deposito_dia.'/'.$fecha_deposito_mes.'/'.$fecha_deposito_ano;
						$hora=strtoupper($registro[2]);
						
						$banco=strtoupper($registro[3]);
						$trans=strtoupper($registro[4]);
						$cta=strtoupper($registro[5]);
						$titular=strtoupper($registro[6]);
						$importe=number_format($registro[7],2,'.','');
						$obs=strtoupper($registro[8]);
		
						echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
							echo "<td $clase align='left'>";
									echo $espacio_izq.$fecha_deposito.' - '.$hora;     
							echo"</td>";
							echo "<td $clase align='left'>";
									echo $espacio_izq.$banco;     
							echo"</td>";
							echo "<td $clase align='right'>";
									echo $trans.$espacio_izq;     
							echo"</td>";
							echo "<td $clase align='right'>";
									echo $cta.$espacio_izq;     
							echo"</td>";
							echo "<td $clase align='left'>";
									echo $espacio_izq.$titular;     
							echo"</td>";
							echo "<td $clase align='right'>";
									echo $importe.$espacio_izq;     
							echo"</td>";
							echo "<td $clase align='left'>";
									echo $espacio_izq.$obs;     
							echo"</td>";
							echo "<td $clase align='center'>";
								// busca si esta asociado a una factura de compra
								$consulta2 = "SELECT * from factura_compra where id_deposito = $id"; 	// consulta sql 
								$result2 = mysql_query($consulta2);            					// hace la consulta
								$nfilas2 = mysql_num_rows ($result2);          //indica la cantidad de resultados
								if ($nfilas2 > 0){ 
										$registro2 = mysql_fetch_row($result2);        					// toma el registro
										$n_factura=$registro2[0];
										$n_sucursal=$registro2[1];
		
										echo "<img  class='iconos' src='../imagenes/detalle.gif' border='0' title='Ver detalle' onClick='javascript: buscar_detalle_deposito_compra($n_factura,$n_sucursal)'>"; 
								}
							echo"</td>";
						echo"</tr>";
				}while($registro = mysql_fetch_row($result)); 		// end while
				
			echo "</table>";   
			//---------------------cierra tabla--------------------------------------------------------------------------------------//
			
			//================================ OBTIENE LA CONSULTA PARA IMPRIMIR ==================================================================================//				
			//$posicion_limit = strrpos ($pag_consulta, "limit"); 		
			//$consulta_informe = substr($pag_consulta, 0,$posicion_limit); 		// obtiene solo la info de la impresora
			//$consulta_informe = ereg_replace("'","@@",$consulta_informe);
			
			echo "<div id='capa_impresion' style='visibility: hidden'>$pag_consulta</div>"; // consulta en una capa oculta par imprimir    
			//================================ FIN DE OBTIENE LA CONSULTA PARA IMPRIMIR ===========================================================================//				

	}else{
		echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
	}	
?>
