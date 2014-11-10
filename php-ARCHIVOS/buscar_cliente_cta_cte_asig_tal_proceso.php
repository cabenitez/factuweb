<?
	$pag_consulta = "SELECT cliente.cod_cliente, cliente.cod_zona, cliente.cod_localidad, cliente.cod_prov, cliente.cod_pais, cliente.razon_social FROM cliente inner join forma_pago on forma_pago.cod_fp = cliente.cod_fp 
								 WHERE activo = 'S' and (forma_pago.descripcion LIKE '%CTA%' or forma_pago.descripcion like '%CUENTA%' 
								 or forma_pago.descripcion LIKE '%CTE%' or forma_pago.descripcion like '%CORRIENTE%' 
								 or forma_pago.observacion LIKE '%CTA%' or forma_pago.observacion like '%CUENTA%' 
								 or forma_pago.observacion LIKE '%CTE%' or forma_pago.observacion like '%CORRIENTE%') 
								 GROUP BY cliente.cod_cliente
	UNION
	SELECT cliente.cod_cliente, cliente.cod_zona, cliente.cod_localidad, cliente.cod_prov, cliente.cod_pais, cliente.razon_social FROM cliente inner join (factura_vta inner join forma_pago on forma_pago.cod_fp = factura_vta.cod_fp)
	on factura_vta.cod_cliente = cliente.cod_cliente 
								 WHERE activo = 'S' and (forma_pago.descripcion LIKE '%CTA%' or forma_pago.descripcion like '%CUENTA%' 
								 or forma_pago.descripcion LIKE '%CTE%' or forma_pago.descripcion like '%CORRIENTE%' 
								 or forma_pago.observacion LIKE '%CTA%' or forma_pago.observacion like '%CUENTA%' 
								 or forma_pago.observacion LIKE '%CTE%' or forma_pago.observacion like '%CORRIENTE%') 
								 and factura_vta.observacion <> 'ANULADO' and factura_vta.observacion <> 'N/C' 
								 GROUP BY cliente.cod_cliente";
/*
	$pag_consulta = "SELECT * FROM cliente inner join forma_pago on forma_pago.cod_fp = cliente.cod_fp 
							 WHERE activo = 'S' and (forma_pago.descripcion LIKE '%CTA%' or forma_pago.descripcion like '%CUENTA%' 
							 or forma_pago.descripcion LIKE '%CTE%' or forma_pago.descripcion like '%CORRIENTE%' 
							 or forma_pago.observacion LIKE '%CTA%' or forma_pago.observacion like '%CUENTA%' 
							 or forma_pago.observacion LIKE '%CTE%' or forma_pago.observacion like '%CORRIENTE%') order by cod_cliente"; 									// consulta sql
*/
	//---------------------Paginacion----------------------------------------------------------------------------------------//
	$estilo_pag_nav = "barra_nav";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
	$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$estilo_pag_info = "caja";			//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	
	include("paginador.php");			//OBLIGATORIO Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
	//---------------------Fin Paginacion------------------------------------------------------------------------------------//
if($pag_filas > 0){
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>"; 
      	echo "<tr class='top'>";
        	echo "<td width='5%'><div align='center' class='seccion'>Codigo</div></td>";
        	echo "<td width='51%'><div align='center' class='seccion'>Razon Social</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Tal. asignados</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Tal. actual</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Talonarios</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>Asignar</div></td>";
			//echo "<td width='7%'><div align='center' class='seccion'>Modificar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		echo"<div ID='overDiv' STYLE='position:absolute; visibility:hide; z-index: 1;'>";   // Capa para el detalle tipo tooltip
		
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[0];		
				$cod_zona=$registro[1];
				$cod_localidad=$registro[2];
				$cod_prov=$registro[3];
				$cod_pais=$registro[4];
				$razon=$registro[5];

				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='center'>";
							echo $espacio_izq.$codigo;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$razon;     
					echo"</td>";
					
					
									$talonarios_asignados='';						     
									$consulta_t ="SELECT * FROM recibos_por_cliente where cod_cliente = $codigo and cod_zona=$cod_zona and cod_localidad= $cod_localidad and cod_prov=$cod_prov and cod_pais = $cod_pais";
									$result_t = mysql_query($consulta_t);            // hace la consulta
									$nfilas_t = mysql_num_rows ($result_t);          //indica la cantidad de resultados
									$registro_t = mysql_fetch_row($result_t);        // toma el registro
									if ($nfilas_t > 0){     						 // si existe el usuario inicia la sesion
										do{
											$talonarios_asignados.='-'.$registro_t[6];
										}while($registro_t = mysql_fetch_row($result_t)); // obtengo los resultados 
			
									}else{
											$talonarios_asignados='-';						
									}
									if($talonarios_asignados!='-'){
										$talonarios_asignados=substr($talonarios_asignados,1);
										$alineacion = 'left';
									}else{
										$alineacion = 'center';
									}
					echo "<td $clase align=$alineacion>";		
							echo $espacio_izq.$talonarios_asignados;
					echo"</td>";	
					
					echo "<td $clase align='center'>";										
									$consulta_t ="SELECT * FROM recibos_por_cliente where cod_cliente = $codigo and cod_zona=$cod_zona and cod_localidad= $cod_localidad and cod_prov=$cod_prov and cod_pais = $cod_pais order by num_talonario desc";
									$result_t = mysql_query($consulta_t);            // hace la consulta
									$nfilas_t = mysql_num_rows ($result_t);          //indica la cantidad de resultados
									$registro_t = mysql_fetch_row($result_t);        // toma el registro
									if ($nfilas_t > 0){     						 // si existe el usuario inicia la sesion
											$num_tal_asignado=$registro_t[6];
									}else{
											$num_tal_asignado='-';						
									}

							echo $espacio_izq.$num_tal_asignado;     
					echo"</td>";
					echo "<td $clase align='center'>";
							include("lista_talonarios_recibo.php");    
					echo"</td>";					
					echo"<td $clase align='center'>";	
							echo "<img  class='iconos' src='../imagenes/validar2.gif' border='0' title='Asignar' onClick='javascript: asignar_tal_recibo_cliente($codigo,$cod_zona,$cod_localidad,$cod_prov,$cod_pais)'>"; 
					echo"</td>"; 
					/*
					echo"<td $clase align='center'>";	
							if($num_tal_asignado != '-'){
								echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_tal_recibo_cliente($codigo,$cod_zona,$cod_localidad,$cod_prov,$cod_pais)'>"; 
							}else{
								echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' >"; 
							}
					echo"</td>"; 
					*/
				echo"</tr>";
		} //end while
		
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------//
	echo $pag_navegacion;
	
	//================================ OBTIENE LA CONSULTA PARA IMPRIMIR ==================================================================================//				
	$posicion_limit = strrpos ($pag_consulta, "limit"); 		
	$consulta_informe = substr($pag_consulta, 0,$posicion_limit); 		// obtiene solo la info de la impresora
	$consulta_informe = ereg_replace("'","@@",$consulta_informe);
	
	include('consulta_session.php');		// crea el div y el id de session del sql
	//================================ FIN DE OBTIENE LA CONSULTA PARA IMPRIMIR ===========================================================================//				

	
}else{
echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
}	
?>
