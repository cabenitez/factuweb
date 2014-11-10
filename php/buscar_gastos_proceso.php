<?
		include ("conexion.php");
		$nombre = strtoupper($nombre);
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM gastos order by id"; 									// consulta sql
		}else{
			$consulta = "SELECT * FROM gastos where";
			include ("cascada_gastos.php");
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
        	echo "<td width='15%'><div align='center' class='seccion'>Fecha - Hora</div></td>";
        	echo "<td width='20%'><div align='center' class='seccion'>Descripcion</div></td>";
			echo "<td width='25%'><div align='center' class='seccion'>Observacion</div></td>";
        	echo "<td width='10%'><div align='center' class='seccion'>Importe</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>IVA</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Otros Imp.</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Total</div></td>";

		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$id=$registro[0];		
				$fecha_gasto=$registro[1];
			    $fecha_gasto_dia=substr($fecha_gasto,-2);
				$fecha_gasto_mes=substr($fecha_gasto,4,2);
				$fecha_gasto_ano=substr($fecha_gasto,0,4);
				$fecha_gasto = $fecha_gasto_dia.'/'.$fecha_gasto_mes.'/'.$fecha_gasto_ano;
				$hora=$registro[2];
				$desc=strtoupper($registro[3]);
				$importe=number_format($registro[4],2,'.','');
				$iva=number_format($registro[5],2,'.','');
				$otros_imp=number_format($registro[6],2,'.','');
				$total=number_format($registro[7],2,'.','');
				$obs=strtoupper($registro[8]);

				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$fecha_gasto.' - '.$hora;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$desc;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$obs;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $importe.$espacio_izq;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $iva.$espacio_izq;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $otros_imp.$espacio_izq;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $total.$espacio_izq;     
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
