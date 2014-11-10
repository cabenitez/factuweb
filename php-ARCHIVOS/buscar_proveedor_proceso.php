<?
		$razon = strtoupper($razon);
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM proveedor order by razon_social"; 									// consulta sql
		}else{
			$consulta = "Select * from proveedor";
     		$consulta2 = "where";
			include ("cascada_proveedores.php");
	 		
			$pag_consulta = $consulta . " " . "order by razon_social";
	 	}
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
        	echo "<td width='7%'><div align='center' class='seccion'>Codigo</div></td>";
        	echo "<td width='11%'><div align='center' class='seccion'>CUIT</div></td>";
        	echo "<td width='27%'><div align='center' class='seccion'>Razon Social</div></td>";
			echo "<td width='23%'><div align='center' class='seccion'>Direccion</div></td>";
			echo "<td width='13%'><div align='center' class='seccion'>Localidad</div></td>";
        	echo "<td width='10%'><div align='center' class='seccion'>Telefono</div></td>";
			echo "<td width='5%'><div align='center' class='seccion'>Modificar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[0];		
				$cuit=$registro[2];
					$cuit1=substr($cuit,0,2);
					$cuit2=substr($cuit,2,-1);
					$cuit3=substr($cuit,-1);
				$cuit=$cuit1.'-'.$cuit2.'-'.$cuit3;
							
				$razon=$registro[1];
				$cod_localidad=$registro[14];
				
				$consulta ="select * from localidad where cod_localidad = $cod_localidad";
				$result = mysql_query($consulta);            // hace la consulta
				$reg = mysql_fetch_row($result);        // toma el registro
				
				$localidad= $reg[3];
				$dir=$registro[4];		
				$tel=$registro[5];
				$contacto=$registro[8];		

				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='center'>";
							echo $codigo;     
					echo"</td>";
					echo "<td $clase align='center'>";
							echo $cuit;     
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
							echo $espacio_izq.$tel;     
					echo"</td>";
					
					$consulta_proveedor = "select cod_prod from producto where cod_proveedor = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_proveedor = mysql_query($consulta_proveedor);             // hace la consulta
					$nfilas_proveedor = mysql_num_rows ($result_proveedor);           //indica la cantidad de resultados
					
					$consulta_factura_compra = "select n_factura from factura_compra where cod_proveedor = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_factura_compra = mysql_query($consulta_factura_compra);            		// hace la consulta
					$nfilas_factura_compra = mysql_num_rows ($result_factura_compra);          		//indica la cantidad de resultados
					
					echo"<td $clase align='center'>";	
							if ($nfilas_proveedor == 0 && $nfilas_factura_compra == 0){     						 // si existe el usuario inicia la sesion
									echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_proveedor($codigo)'>"; 
							}else{
									echo "<img  src='../imagenes/modificar_no.png' border='0'>";
							}
					echo"</td>"; 
					/*
					echo"<td $clase align='center'>"; 
							echo "<img class='iconos' src='../imagenes/eliminar.png' border='0' title='Eliminar' onClick='javascript: eliminar_pais($codigo)'>"; //onClick='javascript: abreventanaprecio($codigo)'
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
