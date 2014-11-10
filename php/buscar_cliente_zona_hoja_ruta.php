<?
	include("conexion.php"); 

	$pag_consulta = " SELECT cliente.cod_cliente, cliente.cod_localidad, razon_social, cliente.direccion, orden, activo, concat(vendedor.cod_vendedor,'-',vendedor.nombre) FROM cliente inner join vendedor on vendedor.cod_vendedor = cliente.cod_vendedor where cod_zona = $zona AND activo = 'S' order by orden,cod_cliente ";
 
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
      	echo "<tr>";
        	echo "<td colspan = 5>";
				?>
				 <div id="msg_mod"  class="nota">
					 <img src="../imagenes/advertencia.gif" width="16" height="16"> El valor 0 (cero) indica que NO existe un orden para ese cliente - En caso de no existir correlatividad haga click en el Icono de la derecha -->
				 </div>
				<?
			echo"</td>";

        	echo "<td >";
				?>
				 <div id="msg_mod" align="center" class="nota_azul">
					 <img  class="iconos" title="Ordenar correlatividad"  onClick="ordenar_hoja_ruta( document.frm.lista_zona_bus.value)" src="../imagenes/ordenar_asc.gif" > Ordenar <!-- src="../imagenes/ordenar.gif" width="18" height="18" -->
				 </div>
				<?
			echo"</td>";

		echo "</tr>";
		echo "<tr class='top'>";
        	echo "<td width='5%'><div align='center' class='seccion'>Codigo</div></td>";
        	echo "<td width='25%'><div align='center' class='seccion'>Razon Social</div></td>";
			echo "<td width='25%'><div align='center' class='seccion'>Direccion</div></td>";
			echo "<td width='15%'><div align='center' class='seccion'>Localidad</div></td>";
			echo "<td width='20%'><div align='center' class='seccion'>Vendedor</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Orden</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		echo"<div ID='overDiv' STYLE='position:absolute; visibility:hide; z-index: 1;'>";   // Capa para el detalle tipo tooltip
		
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[0];		
				$cod_localidad=$registro[1];
				$razon=$registro[2];
				$dir=$registro[3];	
				$orden=$registro[4]; 
				$activo=$registro[5]; 
				$vendedor=$registro[6]; 
				
				$consulta ="select * from localidad where cod_localidad = $cod_localidad";
				$result = mysql_query($consulta);            // hace la consulta
				$reg = mysql_fetch_row($result);        	// toma el registro
				$localidad= $reg[3];
				
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='center'>";
							echo $espacio_izq.$codigo;     
					echo"</td>";

					echo "<td $clase align='left'>";
							echo $espacio_izq.$razon;     
					echo"</td>";

					echo "<td $clase align='left'>"; 
							echo $espacio_izq.$dir;     
					echo"</td>";

					echo "<td $clase align='left'>";
							echo $espacio_izq.$localidad;      
					echo"</td>";
					
					echo "<td $clase align='left'>";
							echo $espacio_izq.$vendedor;      
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='center'>"; // 
							?>
							<img src='../imagenes/seguiente.gif' width='14' height='14' class='iconos' title='Asignar Orden'  onClick="actualizar_orden_hoja_ruta_max(<? echo $codigo ?>)">
							<?
							echo "&nbsp;&nbsp;&nbsp;"; 
							echo "<input name=$codigo type='text' class='caja'  id=$codigo  onKeyPress='return solo_entero(event)' onKeyUp='actualizar_orden_hoja_ruta(event,$codigo)' onBlur='actualizar_orden_hoja_ruta_blur($codigo)' size='5' maxlength='5' style='text-align:right'  value='$orden'>";
					echo"</td>";
					
				echo"</tr>";
		} //end while
		
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------//
	echo $pag_navegacion;
	//================================ OBTIENE LA CONSULTA PARA IMPRIMIR ==================================================================================//				
	 $posicion_order = strrpos ($pag_consulta, "AND"); 		
	 $consulta_order = substr($pag_consulta, 0,$posicion_order); 		// obtiene solo la info de la impresora 
	 
	 
	 //$consulta_informe = $consulta_order .$palabra." activo = 'S' order by cod_cliente";
	 $consulta_informe = ereg_replace("'","@@",$consulta_order);
/*
	
	$consulta_informe = "SELECT * FROM cliente where cod_zona = $zona "; 	 													// consulta sql
	$consulta_informe = ereg_replace("'","@@",$consulta_informe);
	*/
	//echo $consulta_informe;
	include('consulta_session.php');		// crea el div y el id de session del sql
	//================================ FIN DE OBTIENE LA CONSULTA PARA IMPRIMIR ===========================================================================//				

}else{
	echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
}	
?>
