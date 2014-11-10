<?
		$nombre = strtoupper($nombre);
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM art_especial order by tipo"; 									// consulta sql
		}
	//---------------------Paginacion----------------------------------------------------------------------------------------//
	$estilo_pag_nav = "barra_nav";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
	$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$estilo_pag_info = "caja";			//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	
	include("paginador.php");			//OBLIGATORIO Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
	//---------------------Fin Paginacion------------------------------------------------------------------------------------//
if($pag_filas > 0){
	//echo $pag_info;  					//info de paginacion
	echo '<br>';
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
      	echo "<tr class='top'>";
        	echo "<td width='20%'><div align='center' class='seccion'>Codigo</div></td>";
        	echo "<td width='40%'><div align='center' class='seccion'>Descripcion</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Tipo</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Valor</div></td>";
        	//echo "<td width='10%'><div align='center' class='seccion'>Modificar</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Eliminar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[0];		

				$consulta_ = "SELECT descripcion FROM producto where concat(cod_grupo,cod_marca,cod_variedad, cod_prod)= $codigo"; // consulta sql                  where nombre = '$nombre'		
				$result_ = mysql_query($consulta_);            // hace la consulta
				$registro_ = mysql_fetch_row($result_);        // toma el registro
				$desc = $registro_[0];  					 //asigna una cadena a la variable "nombre"


				$tipo=$registro[1];
				if($tipo == 'DE'){
					$tipo = 'DESCUENTO';
				}elseif($tipo == 'NC'){
					$tipo = 'NO COMPRA';
				}elseif($tipo == 'SC'){
					$tipo = 'SIN CARGO';				
				}elseif($tipo == 'SF'){
					$tipo = 'SIN FACTURA';				
				}
				
				$valor=$registro[2];

				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='center'>";
							echo $codigo;     
					echo"</td>"; 
					echo"<td $clase align='left'>";	
							echo $espacio_izq.$desc;
					echo"</td>"; 
					echo"<td $clase align='left'>";	
							echo $espacio_izq.$tipo;
					echo"</td>"; 
					echo"<td $clase align='left'>";	
							echo $espacio_izq.$valor;
					echo"</td>"; 
					/*
					echo"<td $clase align='center'>"; 
							echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_art_asociado($codigo)'>"; 
					echo"</td>"; 		
					*/
					echo"<td $clase align='center'>"; 
							echo "<img class='iconos' src='../imagenes/eliminar.png' border='0' title='Eliminar' onClick='javascript: eliminar_art_asociado($codigo)'>"; //onClick='javascript: abreventanaprecio($codigo)'
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
