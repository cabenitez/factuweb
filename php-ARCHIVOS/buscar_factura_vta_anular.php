<? 
	$cod_tal = $_POST["cod_tal"]; 					// toma la variable de la url q vino de ajax.js
	$cod_tal = strtoupper($cod_tal);

	$num_tal = $_POST["num_tal"]; 					// toma la variable de la url q vino de ajax.js
	$num_fac = $_POST["num_fac"]; 					// toma la variable de la url q vino de ajax.js

	include("conexion.php");
	$consulta = " SELECT * from (
								select factura_vta.cod_talonario, factura_vta.num_talonario, factura_vta.n_factura, concat(cliente.cod_cliente,' - ' ,razon_social)as razon_social, 
								
								(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
								round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) +
								round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
								round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as total_general,
								observacion,fecha,factura_vta.cod_vendedor
								
								from factura_vta_detalle inner join (factura_vta inner join cliente on cliente.cod_cliente = factura_vta.cod_cliente) 
								on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario where factura_vta.cod_talonario = '$cod_tal' and factura_vta.num_talonario = $num_tal and factura_vta.n_factura = $num_fac
								GROUP BY cliente.razon_social
								
								UNION 
								
								select factura_vta_no_cliente.cod_talonario,factura_vta_no_cliente.num_talonario,factura_vta_no_cliente.n_factura, factura_vta_no_cliente.razon_social,
								 
								(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
								round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) +
								round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
								round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as total_general,
								observacion,fecha,factura_vta_no_cliente.cod_vendedor
								
								from factura_vta_no_cliente_detalle  inner join factura_vta_no_cliente 
								on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario where factura_vta_no_cliente.cod_talonario = '$cod_tal' and factura_vta_no_cliente.num_talonario = $num_tal and factura_vta_no_cliente.n_factura = $num_fac
								GROUP BY factura_vta_no_cliente.razon_social
								
								) as comprobante";
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
			$razon=$registro[3];
			$importe=$registro[4];
			$estado=$registro[5];				// Estado contiene el campo observacion donde se registra si se anulo el comprobante
			$importe= number_format($importe,2,'.',''); 
			
			$fecha_a = $registro[6];
			$cod_vendedor = $registro[7];
			//$ano_a = substr($fecha_a,0,4); 
			//$mes_a = substr($fecha_a,2,2);
			//$dia_a = substr($fecha_a,-2);
			//$fecha_a = "$dia_a/$mes_a/$ano_a";										// maqueta la fecha para imprimir
			
			
			
			if($estado == 'ANULADO'){
				echo "<input type='hidden' id='oculto_btn_anular'  name='oculto_btn_anular' value ='1'>";
				echo"<div id='tabla' name = 'anulado' ></div>";
				echo"<table width='60%' border='0' ";
				echo"<tr>";
				echo"<td><strong>ERROR: LA FACTURA YA HA SIDO ANULADA</strong></td>";
				echo"</tr>";
				echo"</table>";
			}else{
				echo"<div id='tabla' name = 'ok' ></div>";
				echo"<table width='60%' border='0' ";
					echo"<tr >";
						echo"<td width='13%'><strong>CLENTE:</strong></td>";
						echo"<td width='87%'>$razon</td>";
					echo"</tr>";
					echo"<tr >";
						echo"<td ><strong>TOTAL FACTURA:</strong> </td>";
						echo"<td>$importe</td>";
					echo"</tr>";
					
					//===========BUSCA SI NO PERTENECE A UNA CARGA CON DEVOLUCIONES======================//
					echo"<tr>";
						echo"<td align='left' colspan=2>";
							$consulta = "select * from devolucion WHERE cod_vendedor = $cod_vendedor and fecha_carga = $fecha_a"; // consulta sql 
							$result = mysql_query($consulta);            // hace la consulta
							$registro = mysql_fetch_row($result);        // toma el registro
							$nfilas_devolucion = mysql_num_rows ($result);          //indica la cantidad de resultados
							if($nfilas_devolucion > 0){
								$codigo=$registro[0];
								echo "<input type='hidden' id='oculto_btn_anular'  name='oculto_btn_anular' value ='1'>";
								echo " <div id='msg_mod'  class='nota'> &nbsp;&nbsp;<img src='../imagenes/advertencia.gif' width='16' height='16'> ADVERTENCIA: LA FACTURA PERTENECE A UNA CARGA QUE CONTIENE DEVOLUCIONES, IMPOSIBLE ANULAR &nbsp;&nbsp;</div>";
							}
						echo"</td>";
					echo"</tr>";
					//===========BUSCA SI NO PERTENECE A UNA CARGA CON DEVOLUCIONES======================//
										
				echo"</table>";
			}		
		
	}else{
			echo"<div id='tabla' name = 'inexistente' ></div>";
			echo "<input type='hidden' id='oculto_btn_anular'  name='oculto_btn_anular' value ='1'>";

			echo"<table  width='60%' border='0' ";
			echo"  <tr >";
			echo"    <td><strong>FACTURA INEXISTENTE</strong></td>";
			echo"  </tr>";
			echo"</table>";
	}					
?>