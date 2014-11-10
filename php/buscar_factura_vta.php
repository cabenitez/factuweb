<?
session_start();   															 // Iniciar sesión
$usuario_anular = $_SESSION['user_usuario']; 						 //usuario conectado

$cod_tal = $_POST["cod_tal"]; // toma la variable de la url q vino de ajax.js
$num_tal = $_POST["num_tal"]; 	// toma la variable de la url q vino de ajax.js
$num_fac = $_POST["num_fac"]; 	// toma la variable de la url q vino de ajax.js
if($cod_tal){
	include("conexion.php");
	$cod_tal = strtoupper($cod_tal);
	$nfilas = 0;

	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
/*
	$consulta ="select descripcion,n_sucursal, n_factura, razon_social, round(total_sin_impuesto,2), round(iva,2),round(otros_impuestos,2),round(total_general,2), talonario, observacion, cod_talonario, fecha, usuario  FROM
						(
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta_no_cliente.n_factura, factura_vta_no_cliente.razon_social,
						
						round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) as total_sin_impuesto , 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) as iva,
						
						/*
						round(imp_interno,2) as imp_int, 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) as perc_iva,
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2) as ing_bruto,
						* /
						(round(imp_interno,2)  + 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as otros_impuestos,
						
			
						(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) +
						round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as total_general,
						(factura_vta_no_cliente.num_talonario)talonario, observacion, factura_vta_no_cliente.cod_talonario,factura_vta_no_cliente.fecha, factura_vta_no_cliente.usuario
						
						from tipo_talonario inner join(talonario inner join (factura_vta_no_cliente inner join factura_vta_no_cliente_detalle  
						on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario)
						on factura_vta_no_cliente.cod_talonario = talonario.cod_talonario  and factura_vta_no_cliente.num_talonario = talonario.num_talonario)
						on talonario.cod_talonario = tipo_talonario.cod_talonario 
						where factura_vta_no_cliente.n_factura = $num_fac and factura_vta_no_cliente.cod_talonario = '$cod_tal' and factura_vta_no_cliente.num_talonario = $num_tal  GROUP BY factura_vta_no_cliente.n_factura 
						
					UNION
						
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta.n_factura, cliente.razon_social, 
						round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) as total_sin_impuesto , 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) as iva,
						
						/*
						round(imp_interno,2) as imp_int, 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) as perc_iva,
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2) as ing_bruto,
						* /
						(round(imp_interno,2)  + 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as otros_impuestos,
						
						(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) +
						round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as total_general,
						(factura_vta.num_talonario)as talonario, observacion, factura_vta.cod_talonario,factura_vta.fecha,  factura_vta.usuario
						
						from talonario inner join(tipo_talonario inner join(cliente inner join (factura_vta inner join factura_vta_detalle  on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario)
						on factura_vta.cod_cliente = cliente.cod_cliente) on cliente.cod_talonario = tipo_talonario.cod_talonario) on tipo_talonario.cod_talonario = talonario.cod_talonario  and talonario.num_talonario = factura_vta.num_talonario 
						where factura_vta.n_factura = $num_fac and factura_vta.cod_talonario = '$cod_tal' and factura_vta.num_talonario = $num_tal GROUP BY factura_vta.n_factura
				) AS ventas_repartidor ORDER BY descripcion,n_factura";
*/

	$consulta ="select descripcion,n_sucursal, n_factura, razon_social, round(total_sin_impuesto,2), round(iva,2),round(otros_impuestos,2),round(total_general,2), talonario, observacion, cod_talonario, fecha, usuario  FROM
						(
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta_no_cliente.n_factura, factura_vta_no_cliente.razon_social,
						
						$calculo_importe_no_cliente
						
						(factura_vta_no_cliente.num_talonario)talonario, observacion, factura_vta_no_cliente.cod_talonario,factura_vta_no_cliente.fecha, factura_vta_no_cliente.usuario
						
						$from_no_cliente
						
						where factura_vta_no_cliente.n_factura = $num_fac and factura_vta_no_cliente.cod_talonario = '$cod_tal' and factura_vta_no_cliente.num_talonario = $num_tal  GROUP BY factura_vta_no_cliente.n_factura 
						
					UNION
						
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta.n_factura, cliente.razon_social, 

						$calculo_importe_cliente
						
						(factura_vta.num_talonario)as talonario, observacion, factura_vta.cod_talonario,factura_vta.fecha,  factura_vta.usuario
						
						$from_cliente 
						
						where factura_vta.n_factura = $num_fac and factura_vta.cod_talonario = '$cod_tal' and factura_vta.num_talonario = $num_tal GROUP BY factura_vta.n_factura
				) AS ventas_repartidor ORDER BY descripcion,n_factura";

	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	if($filas > 0){
			echo "<div  align='right' class='seccion'>";
				echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_informe_buscar_factura_vta('exportar_informe_buscar_factura_vta.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_informe_buscar_factura_vta('exportar_informe_buscar_factura_vta.php')\" /> imprimir";
			echo "</div>";
			echo "<br>";
	
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
		echo "<tr class='top'>";
        	echo "<td width='5%' ><div align='center' class='seccion'>Nº TAL.</div></td>";
        	echo "<td width='15%' ><div align='center' class='seccion'>COMPROBANTE</div></td>";
			echo "<td width='5%' ><div align='center' class='seccion'>FECHA</div></td>";
			echo "<td width='23%' ><div align='center' class='seccion'>CLIENTE</div></td>";
			echo "<td width='12%' ><div align='center' class='seccion'>TOTAL SIN IMPUESTOS</div></td>";
			echo "<td width='5%' ><div align='center' class='seccion'>IVA</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>OTROS IMPUESTOS</div></td>";
        	echo "<td width='10%' ><div align='center' class='seccion'>TOTAL</div></td>";
			echo "<td width='5%' ><div align='center' class='seccion'>DETALLE</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas
		do{ 					// obtengo los resultados 
				$n_talonario = $registro[8];
				
				$len_n_talonario=strlen($n_talonario); 					// completo el numero de la sucursal con ceros
				$ceros_3 = '';
				while ($len_n_talonario < 4){
						$ceros_3.="0";
						$len_n_talonario++;
				}
				$n_talonario=$ceros_3.$n_talonario;
		
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
				$cod_talonario = $registro[10];
				
				$fecha_emision = $registro[11];
			    $fecha_emision_ano=substr($fecha_emision,0,4);
			    $fecha_emision_mes=substr($fecha_emision,4,2);
			    $fecha_emision_dia=substr($fecha_emision,-2);
				$fecha_emision = $fecha_emision_dia."/".$fecha_emision_mes."/".$fecha_emision_ano;

				$facturador = $registro[12];
				$consulta_facturador = "SELECT nombre FROM usuario where usuario = '$facturador'"; // consulta sql
				$result_facturador = mysql_query($consulta_facturador);            // hace la consulta
				$registro_facturador = mysql_fetch_row($result_facturador);        // toma el registro
				$facturador = $registro_facturador[0];
				

				if($observacion == 'ANULADO'){
					$razon='COMPROBANTE ANULADO';					
					$total_sin_imp=" ";
					$total_iva=" ";
					$total_otros_imp=" ";
					$total_factura=" ";
				}else{
					if($observacion == 'N/C'){
						$razon=$registro[3];
						$total_sin_imp=-$registro[4];
						$total_iva=-$registro[5];
						$total_otros_imp=$registro[6];
						if($registro[6] > 0){
							$total_otros_imp=-$registro[6];
						}
						$total_factura=-$registro[7];
						$desc_fac = "NC ".$cod_talonario;
					}else{
						$razon=$registro[3];
						$total_sin_imp=$registro[4];
						$total_iva=$registro[5];
						$total_otros_imp=$registro[6];
						$total_factura=$registro[7];
					}	
				}
				
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $n_talonario;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$desc_fac.' '.$suc.' '.$n_fact;     
					echo"</td>";
					echo "<td $clase align='center'>";
							echo $fecha_emision;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$razon;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $total_sin_imp.$espacio_izq;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $total_iva.$espacio_izq;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $total_otros_imp.$espacio_izq; 
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $total_factura.$espacio_izq; 
					echo"</td>";
					echo "<td $clase align='center'>";
							if($observacion != 'ANULADO'){
									echo "<img  class='iconos' src='../imagenes/detalle.gif' border='0' title='Ver detalle' onClick='javascript: buscar_factura_vta_detalle_comprobante(\"$cod_talonario\",$n_talonario,$n_factura,\"$desc_fac\",$suc)'>"; 
							}
					echo"</td>";
				echo"</tr>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------//

	echo "<br>";
	echo "<div  align='LEFT' class='seccion'><b><u>FACTURADO POR:</u> $facturador</b></div>";
			
	}else{
			echo"<table width='60%' border='0' ";
			echo"  <tr >";
			echo"    <td><strong>FACTURA INEXISTENTE</strong></td>";
			echo"  </tr>";
			echo"</table>";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('buscar_factura_vta.tpl');   //define la plantilla que utilizara

	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="factura_vta";
	$plantilla = "buscar_factura_vta.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>