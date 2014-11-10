<?
		$nombre = $_POST['nombre'];
		$razon = $_POST['razon'];
		
		
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM cliente order by cod_cliente"; 	 													// consulta sql
		}else{
			$razon = strtoupper($razon);
			$consulta = "Select * from cliente";
     		$consulta2 = "where";
			include ("cascada_clientes.php");
	 		
			echo $pag_consulta = $consulta . " " . "order by cod_cliente";
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
        	echo "<td width='5%'><div align='center' class='seccion'>Codigo</div></td>";
        	echo "<td width='20%'><div align='center' class='seccion'>Razon Social</div></td>";
			echo "<td width='20%'><div align='center' class='seccion'>Direccion</div></td>";
			echo "<td width='15%'><div align='center' class='seccion'>Zona</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Localidad</div></td>";
			#echo "<td width='10%'><div align='center' class='seccion'>Categoria</div></td>";
			echo "<td width='5%'><div align='center' class='seccion'>Vend.</div></td>";
			echo "<td width='5%'><div align='center' class='seccion'>Rep.</div></td>";
			echo "<td width='5%'><div align='center' class='seccion'>Estado</div></td>";
			echo "<td width='5%'><div align='center' class='seccion'>Modificar</div></td>";
			echo "<td width='5%'><div align='center' class='seccion'>Detalle</div></td>";
			echo "<td width='5%'><div align='center' class='seccion'>Copiar</div></td>";
			
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		echo"<div ID='overDiv' STYLE='position:absolute; visibility:hide; z-index: 1;'>";   // Capa para el detalle tipo tooltip
		
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[0];		
				$cod_zona=$registro[1];
				$cod_localidad=$registro[2];
				$cod_prov=$registro[3];
				$cod_pais=$registro[4];
				$contacto=$registro[5];
				$razon=$registro[6];
				$tel=$registro[7];
				$fax=$registro[8];
				$movil=$registro[9];
				$dir=$registro[10];	
				$cuit=$registro[11];	
				if($cuit != ""){	
					$cuit1=substr($cuit,0,2);
					$cuit2=substr($cuit,2,-1);
					$cuit3=substr($cuit,-1);
				$cuit=$cuit1.'-'.$cuit2.'-'.$cuit3;
				}
				$lim_cred=$registro[12];		
				$web=$registro[13];		
				$mail=$registro[14];		
				$cod_iva=$registro[15];		
				$cod_cat=$registro[16];
				$cod_ven=$registro[17];
				$cod_rep=$registro[18];				
				$cod_vta=$registro[20];
				$activo=$registro[22]; 
				
				$consulta ="select nombre from iva where cod_iva = $cod_iva";
				$result = mysql_query($consulta);            // hace la consulta
				$reg = mysql_fetch_row($result);
				$iva= $reg[0];

				$consulta ="select descripcion from forma_pago where cod_fp = $cod_vta";
				$result = mysql_query($consulta);            // hace la consulta
				$reg = mysql_fetch_row($result);
				$cond_vta= $reg[0];

				$consulta ="select nombre from zona where cod_zona = $cod_zona";
				$result = mysql_query($consulta);            // hace la consulta
				$reg = mysql_fetch_row($result);
				$zona= $reg[0];
				
				$consulta ="select nombre from localidad where cod_localidad = $cod_localidad";
				$result = mysql_query($consulta);            // hace la consulta
				$reg = mysql_fetch_row($result);        	// toma el registro
				$localidad= $reg[0];
				
				$consulta ="select nombre from provincia where cod_prov = $cod_prov";
				$result = mysql_query($consulta);            // hace la consulta
				$reg = mysql_fetch_row($result);
				$provincia= $reg[0];
				
				$consulta ="select nombre from pais where cod_pais = $cod_pais";
				$result = mysql_query($consulta);            // hace la consulta
				$reg = mysql_fetch_row($result);        	// toma el registro
				$pais= $reg[0];

				$consulta ="select descripcion from categoria where cod_categoria = $cod_cat ";
				$result = mysql_query($consulta);            // hace la consulta
				$reg = mysql_fetch_row($result);        	// toma el registro
				$categoria= $reg[0];
				
				$consulta ="select nombre from vendedor where cod_vendedor  = $cod_ven ";
				$result = mysql_query($consulta);            // hace la consulta
				$reg = mysql_fetch_row($result);        	// toma el registro
				$vendedor= $reg[0];
				
				$consulta ="select nombre from fletero where cod_flero = $cod_rep ";
				$result = mysql_query($consulta);            // hace la consulta
				$reg = mysql_fetch_row($result);        	// toma el registro
				$repartidor= $reg[0];
				
				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
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
							echo $espacio_izq.$zona;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$localidad;     
					echo"</td>";
					/*
					echo "<td $clase align='left'>";
							echo $espacio_izq.$categoria;     
					echo"</td>";
					*/
					echo "<td $clase align='center'>";
							echo $espacio_izq.$cod_ven;//." - ".$vendedor;     
					echo"</td>";
					echo "<td $clase align='center'>";
							echo $espacio_izq.$cod_rep;//." - ".$repartidor;     
					echo"</td>";

					echo "<td $clase align='center'>";
							if($activo == 'S'){
								?>
								 <img  id="<? echo 'id'.$codigo ?>" name="N" src="../imagenes/activo.gif"  class='iconos'  title="Activo - Click para Desactivar" onClick="activar_desactivar_cliente(<? echo $codigo ?>,this.name,this.id)"> 
								<?
							}else{
								?>
								 <img id="<? echo 'id'.$codigo ?>"  name="S" src="../imagenes/activo_no.gif"  class='iconos' title="Inactivo - Click para Activar" onClick="activar_desactivar_cliente(<? echo $codigo ?>,this.name,this.id)"> 
								<?
							}
					echo"</td>";
					
					$consulta_factura_vta =  "select n_factura from factura_vta where cod_cliente = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_factura_vta = mysql_query($consulta_factura_vta);            // hace la consulta
					$nfilas_factura_vta = mysql_num_rows ($result_factura_vta);          //indica la cantidad de resultados

					$consulta_recibos_por_cliente =  "select cod_cliente from recibos_por_cliente where cod_cliente = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_recibos_por_cliente = mysql_query($consulta_recibos_por_cliente);            // hace la consulta
					$nfilas_recibos_por_cliente = mysql_num_rows ($result_recibos_por_cliente);          //indica la cantidad de resultados

					$consulta_remito_vta =  "select num_remito from remito_vta where cod_cliente = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_remito_vta = mysql_query($consulta_remito_vta);            // hace la consulta
					$nfilas_remito_vta = mysql_num_rows ($result_remito_vta);          //indica la cantidad de resultados


					echo"<td $clase align='center'>";	
							if ( $nfilas_factura_vta == 0 && $nfilas_recibos_por_cliente == 0 && $nfilas_remito_vta == 0){     						 // si existe el usuario inicia la sesion
									echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_cliente($codigo)'>"; 
							}else{
									echo "<img  src='../imagenes/modificar_no.png' border='0'>";
							}
					echo"</td>"; 
					
					echo "<td  $clase align='center'>";
							$detelle_tooltip = "<U>Razon Social:</U> ".$razon;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Condici&oacute;n de IVA:</U> ".$iva;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>CUIT:</U> ".$cuit;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Direcci&oacute;n:</U> ".$dir;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Pais:</U> ".$pais;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Provincia:</U> ".$provincia;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Localidad:</U> ".$localidad;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Zona:</U> ".$zona;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Telefono:</U> ".$tel;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Fax:</U> ".$fax;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Celular:</U> ".$cel;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Web:</U> ".$web;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>E-mail:</U> ".$mail;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Contacto:</U> ".$contacto;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>L&iacute;mite cr&eacute;dito:</U> ".$lim_cred;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Categor&iacute;a:</U> ".$categoria;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Vendedor:</U> ".$vendedor;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Repartidor:</U> ".$repartidor;
							$detelle_tooltip .= "<br>";
							$detelle_tooltip .= "<U>Condici&oacute;n de Venta:</U> ".$cond_vta;
							?>
							 <img src="../imagenes/ver_cliente.gif"  class='iconos' onmouseover="dlc(' <? echo $detelle_tooltip  ?> ', ' <? echo 'CODIGO: '.$cod_grupo.$cod_marca.$cod_variedad.$codigo ?> '); return true;" onmouseout="nd(); return true;"> 
							<?
					echo"</td>";
					echo "<td $clase align='center'>";
							?>
							<img  id="<? echo 'id_c_'.$codigo ?>" name="C" src="../imagenes/copiar.gif"  class='iconos'  title="Copiar Datos de: <? echo $codigo; ?>" onClick="copiar_datos(<? echo $codigo; ?>,'cliente');mostrar_imagen_portapeles('cliente');"> 
							<?
					echo"</td>";
					
					
				echo"</tr>";
		} //end while
		
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------// 
	echo $pag_navegacion;

	//================================ OBTIENE LA CONSULTA PARA IMPRIMIR ==================================================================================//				
	 $posicion_order = strrpos ($pag_consulta, "order by"); 		
	 $consulta_order = substr($pag_consulta, 0,$posicion_order); 		// obtiene solo la info de la impresora 
	 
	 $posicion_where = strrpos ($pag_consulta, "where");
	 if($posicion_where > 0){
	 	$palabra = ' and ';
	 }else{
		 $palabra = ' where ';
	 }
	 
	 $consulta_informe = $consulta_order .$palabra." activo = 'S' order by cod_cliente";
	 $consulta_informe = ereg_replace("'","@@",$consulta_informe);
	
	include('consulta_session.php');		// crea el div y el id de session del sql
	//================================ FIN DE OBTIENE LA CONSULTA PARA IMPRIMIR ===========================================================================//				

	
}else{
echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
}	
?>
