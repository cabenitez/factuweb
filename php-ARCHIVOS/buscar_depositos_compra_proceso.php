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
		//echo $pag_consulta;
	//---------------------Paginacion----------------------------------------------------------------------------------------//
	$estilo_pag_nav = "barra_nav";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
	$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$estilo_pag_info = "caja";			//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	
	include("paginador.php");			//OBLIGATORIO Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
	//---------------------Fin Paginacion------------------------------------------------------------------------------------//
if($pag_filas > 0){
	echo $pag_info;  					//info de paginacion
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

		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
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
						$consulta = "SELECT * from factura_compra where id_deposito = $id"; 	// consulta sql 
						$result = mysql_query($consulta);            					// hace la consulta
						$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
						if ($nfilas > 0){ 
								$registro = mysql_fetch_row($result);        					// toma el registro
								$n_factura=$registro[0];
								$n_sucursal=$registro[1];

								echo "<img  class='iconos' src='../imagenes/detalle.gif' border='0' title='Ver detalle' onClick='javascript: buscar_detalle_deposito_compra($n_factura,$n_sucursal)'>"; 
						}
					echo"</td>";
	
					
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
