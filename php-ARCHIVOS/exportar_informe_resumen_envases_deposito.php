<?
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta ="select descripcion,n_sucursal, n_factura, razon_social, talonario, observacion, cod_talonario  FROM
						(
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta_no_cliente.n_factura, factura_vta_no_cliente.razon_social,
						(factura_vta_no_cliente.num_talonario)talonario, observacion, factura_vta_no_cliente.cod_talonario
						
						from tipo_talonario inner join(talonario inner join (factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto
						on concat(producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod) = concat(factura_vta_no_cliente_detalle.cod_grupo,factura_vta_no_cliente_detalle.cod_marca,factura_vta_no_cliente_detalle.cod_variedad,factura_vta_no_cliente_detalle.cod_prod) )
						on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario)
						on factura_vta_no_cliente.cod_talonario = talonario.cod_talonario  and factura_vta_no_cliente.num_talonario = talonario.num_talonario)
						on talonario.cod_talonario = tipo_talonario.cod_talonario 
						where fecha = $fecha_buscar and cod_repartidor = $repartidor and observacion <> 'ANULADO'  and observacion <> 'N/C' and producto.envase = 'SI' GROUP BY factura_vta_no_cliente.n_factura 
						
					UNION
						
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta.n_factura, cliente.razon_social as nombre, 
						(factura_vta.num_talonario)as talonario, observacion, factura_vta.cod_talonario
						
						from talonario inner join(tipo_talonario inner join(cliente inner join (factura_vta inner join (factura_vta_detalle inner join producto
						on concat(producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod) = concat(factura_vta_detalle.cod_grupo,factura_vta_detalle.cod_marca,factura_vta_detalle.cod_variedad,factura_vta_detalle.cod_prod) )  
						
						on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario)
						on factura_vta.cod_cliente = cliente.cod_cliente) 
						on cliente.cod_talonario = tipo_talonario.cod_talonario) 
						on tipo_talonario.cod_talonario = talonario.cod_talonario  and talonario.num_talonario = factura_vta.num_talonario 
						where fecha = $fecha_buscar and cod_repartidor = $repartidor and observacion <> 'ANULADO'   and observacion <> 'N/C' and producto.envase = 'SI' GROUP BY factura_vta.n_factura 
				) AS ventas_repartidor ORDER BY descripcion";
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados

	if($nfilas > 0){
		$consulta2 = "SELECT nombre FROM fletero where cod_flero = $repartidor"; // consulta sql
		$result2 = mysql_query($consulta2);            // hace la consulta
		$registro2 = mysql_fetch_row($result2);        // toma el registro
		$nombre_fletero = $registro2[0];
		
		//----------------------------------- PDF --------------------------------------------------------------------------------------------//
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(1,3, $repartidor.' - '.$nombre_fletero,0,1);
		$pdf->Ln(3);
		do{ 		// obtengo los resultados 
					$desc_fac = $registro[0];
					$suc = $registro[1];
					$n_fact = $registro[2];
					$razon = $registro[3];
					$n_talonario = $registro[4];
					$observacion = $registro[5];
					$cod_talonario = $registro[6];
					
					$cod_tal = $cod_talonario;
					$num_tal = $n_talonario;
					$num_fact = $n_fact;
					$num_fac = $n_fact;

					include("exportar_informe_resumen_envases_deposito2.php");
		}while($registro = mysql_fetch_array($result)); //end while
	}

?>
