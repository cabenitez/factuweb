<?  
	$usuario_audit = $_POST["usuario_audit"]; 		// toma la variable de la url q vino de ajax.js
	$fecha_desde = $_POST["fecha_desde"]; 		// toma la variable de la url q vino de ajax.js
	$fecha_hasta = $_POST["fecha_hasta"]; 		// toma la variable de la url q vino de ajax.js

	include("conexion.php");
	$consulta = "select * from auditoria "; // consulta sql 
	 
	if($usuario_audit != 'TODOS'){
		$consulta .="where usuario like '$usuario_audit%' ";
		if(!empty($fecha_desde)){
			$consulta .= "and concat(substr(fecha_hora,1,4),substr(fecha_hora,6,2),substr(fecha_hora,9,2)) >= $fecha_desde "; // consulta sql 
		}
		if(!empty($fecha_hasta)){
			$consulta .= "and concat(substr(fecha_hora,1,4),substr(fecha_hora,6,2),substr(fecha_hora,9,2)) <= $fecha_hasta "; // consulta sql 
		}
	}else{
		if(!empty($fecha_desde)){
			$consulta .= "where concat(substr(fecha_hora,1,4),substr(fecha_hora,6,2),substr(fecha_hora,9,2)) >= $fecha_desde "; // consulta sql 
			
			if(!empty($fecha_hasta)){
				$consulta .= "and concat(substr(fecha_hora,1,4),substr(fecha_hora,6,2),substr(fecha_hora,9,2)) <= $fecha_hasta "; // consulta sql 
			}
		}
		if(!empty($fecha_hasta)){
			$consulta .= "and concat(substr(fecha_hora,1,4),substr(fecha_hora,6,2),substr(fecha_hora,9,2)) <= $fecha_hasta "; // consulta sql 
		}
	}	
	$consulta .= " order by fecha_hora";

	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	//---------------------Fin Paginacion------------------------------------------------------------------------------------//
if($nfilas > 0){
		echo "<table width='100%'  border='0' cellspacing='1' cellpadding='1'>";
				echo "<tr bgcolor='#E0E0E0' class='top'>"; //fila
					echo "<td width='11%'><div align='center' class='seccion' >FECHA</div></td>"; //columna
					echo "<td width='12%'><div align='center' class='seccion'>USUARIO</div></td>";
					echo "<td width='15%'><div align='center' class='seccion'>TABLA</div></td>";
					echo "<td width='12%'><div align='center' class='seccion'>CAMPO</div></td>";
					echo "<td width='23%'><div align='center' class='seccion'>VALOR ANTERIOR</div></td>"; //columna
					echo "<td width='22%'><div align='center' class='seccion'>VALOR NUEVO</div></td>";
					echo "<td width='7%'><div align='center' class='seccion'>ACCION</div></td>";
				echo "</tr>";
		echo"</table>";

		$clase="class='filas'"; 							//defino la clase para las filas
		echo"<table width='100%'  border='0' cellspacing='0' cellpadding='0' class='tabla_scroll'>"; 
				$color='F7F7F7';
				while($registro = mysql_fetch_array($result)){ 	// obtengo los resultados 
						$tabla=$registro[0];
						$campo=$registro[1];
						$v_ant=$registro[2];
						$v_act=$registro[3];
						$fecha_hora=$registro[4];
						$usuario=$registro[5];
						$posicion_arroba = strrpos ($usuario, "@"); 		
						$usuario = substr($usuario, 0,$posicion_arroba); 		// obtiene solo la info de la impresora
	
						$accion=$registro[6]; //selected
						/*
						if($accion == 'LOGIN' ){
							$color = 'FFFFC1';
						}
						if($accion == 'LOGOUT' ){
							$color = 'E6E6E6';
						}
						if($accion == 'INSERT' ){
							$color = 'D7FFD7';
						}
						if($accion == 'UPDATE' ){
							$color = 'CACAFF';
						}
	
						if($accion == 'DELETE' ){
							$color = 'FF9191';
						}
						*/
						echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'$color'); bgcolor='#$color'>"; //efecto ded color en las filas
							echo "<td width='12,5%' $clase align='center'>";
									echo $fecha_hora;     
							echo"</td>";
							echo "<td width='12%' $clase align='left'>";
									echo $usuario;     
							echo"</td>"; 
							echo "<td width='16%' $clase align='left'>";
									echo $espacio_izq.$tabla;     
							echo"</td>";
							echo "<td width='13%' $clase align='left'>";
									echo $espacio_izq.$campo;     
							echo"</td>"; 
							echo "<td width='24%' $clase align='left'>";
									echo $espacio_izq.$v_ant;     
							echo"</td>";
							echo "<td width='23%' $clase align='left'>";
									echo $espacio_izq.$v_act;     
							echo"</td>"; 
							echo "<td width='19%' $clase  align='left'>"; //bgcolor='#$color'
									echo $espacio_izq.$accion;     
							echo"</td>";
						echo"</tr>";
						if($color != 'E6E6E6'){
							$color = 'E6E6E6';
						}else{
							$color ='F7F7F7';
						}

				}
		echo "</table>";   
		//---------------------cierra tabla--------------------------------------------------------------------------------------//
		echo $pag_navegacion;
		
		//================================ OBTIENE LA CONSULTA PARA IMPRIMIR ==================================================================================//				
		//$posicion_limit = strrpos ($consulta, "limit"); 		
		//$consulta_informe = substr($consulta, 0,$posicion_limit); 		// obtiene solo la info de la impresora
		//$consulta_informe = ereg_replace("'","@@",$consulta_informe);
		
		echo "<div id='capa_impresion' style='visibility: hidden'>$consulta</div>"; // consulta en una capa oculta par imprimir    
		//================================ FIN DE OBTIENE LA CONSULTA PARA IMPRIMIR ===========================================================================//				
		/*
		$ip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
		$nombredeip= gethostbyaddr($ip).'-'.$ip;
		echo $nombredeip;
		*/
	}else{
		echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
	}	
?>