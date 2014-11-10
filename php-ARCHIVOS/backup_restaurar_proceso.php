<?php
 include("conexion.php");
 
 if($generados == 1){
	$inicio = 20;
	echo "<fieldset style='width:40%; height:200px;'>";
	echo "<div align='left'>";
 }else{
	$inicio = 22;
 }

		//  Conexión con la Base de Datos.
		$db_server			= $host; 
		$db_name			= $db; 
		$db_username		= $usuario; 
		$db_password		= $clave; 
	
		//  Nombre del archivo.
		$filename 			= $uploadfile;
		$nombre_arch = substr ($filename,$inicio);
		$icono = "<img src='../imagenes/flecha_der_azul.gif' >";
		//------------------------------------------------------------------------------------------------------//
		@set_time_limit( 0 );
	
		//echo( "- Base de Datos: '$db_name' en '$db_server'.<br>" );
		$error = false;
	
		if ( !@function_exists( 'gzopen' ) ) {
			$hay_Zlib = false;
			echo( "$icono <b>Archivo:</b>$nombre_arch<br>" );
		}
		else {
			$hay_Zlib = true;
			//$filename = $filename . ".gz";
			echo( "$icono <b>Archivo:</b> '$nombre_arch'<br>" );
		}
	
		if( !$file = @fopen( $filename,"r" ) ) { 
			echo ("<br>$icono ERROR: No se puede abrir: '$nombre_arch'.<br>");
			$error = true;
		}
		else { 
			if( fseek($file, 0, SEEK_END)==0 )
				$filesize_comprimido = ftell( $file );
			else { 
			   echo ("<br>$icono ERROR:, No se puede obtener las dimensiones de '$nombre_arch'.<br>");
			   $error = true;
			}
			  fclose( $file );
		}
	
		if ( !$error ) {
			if( $hay_Zlib ) {
				if ( !$file = @gzopen( $filename, "rb" ) ) { 
					echo( "<br>$icono ERROR:, No se puede abrir: '$nombre_arch'.<br>" );
					$error = true;
				}
				else {
					gzrewind( $file );
				}
			}
			else {
				if ( !$file = @fopen( $filename, "rb" ) ) { 
					echo( "<br>$icono ERROR:, No se puede abrir: '$nombre_arch'.<br>" );
					$error = true;
				}
				else {
					rewind( $file );
				}
			}
		}
	
		if (!$error) { 
			$dbconnection = @mysql_connect( $db_server, $db_username, $db_password ); 
			if ($dbconnection) 
				$db = mysql_select_db( $db_name );
			if ( !$dbconnection || !$db ) { 
				echo( "<br>" );
				echo( "$icono ERROR: La conexion con la Base de datos ha fallado: ".mysql_error()."<br>" );
				$error = true;
			}
			else {
				echo( "<br>" );
				//echo( "$icono Se he establecido la conexion con la Base de datos.<br>" );
			}
		}
	
		if (!$error) { 
			$result = mysql_list_tables( $db_name );
				if (!$result) {
						print "<br>$icono ERROR: No se puede obtener la lista de tablas.<br>";
						//print '<br>$icono MySQL Error: ' . mysql_error(). '<br>';
						$error = true;
				}
				else {
						// $count es el número de tablas en la base de datos
						$count = mysql_num_rows($result);
						if( !$count ) {
								echo "$icono No ha sido necesario borrar la estructura de la Base de datos.<br>";
						}
						else {
								while ($row = mysql_fetch_row($result)) {
										$deleteIt = mysql_query("DROP TABLE $row[0]");
										if( !$deleteIt ) {
										echo( "<br>" );
												print "$icono error al borrar la tabla $row[0].<br>";
												$error = true;
												break;
										}
								}
								echo "$icono Se ha borrado la estructura de la Base de Datos.<br>";
						}
						mysql_free_result($result);
				}
		}
	
		if( !$error ) { 
			$query = "";
			$last_query = "";
			$total_queries = 0;
			$total_lineas = 0;
		
				$t_start = time();
	
				while( 1 ) {
					if( $hay_Zlib )
						$seacabo = gzeof( $file ) OR $error;
					else
						$seacabo = feof( $file ) OR $error;
					if( $seacabo )
						break;
					if( $hay_Zlib )
						$statement = gzgets( $file );
					else
						$statement = fgets( $file );
						
				$statement = trim( $statement );
				$total_lineas++;
				// no se procesan comentarios ni lineas en blanco
				if ( $statement=="--" || $statement=="" || strpos ($statement, "#") === 0) { 
					continue;
				}
				// pasa a query
				$query .= $statement;
				// ejecuta query si esta completo
				if( ereg( ";$", $statement ) ) { 
					if ( !mysql_query( $query, $dbconnection) ) { 
						echo(" <br>" );
						echo("$icono Error en Sentencia: $statement<br>" );
						//echo("$icono Query: $query<br>");
						//echo("$icono MySQL: ".mysql_error()."<br>" );
						$error = true;
						break;
					}
					$last_query = $query;
					$query = "";
					$total_queries++;
				}
			}
	
				if( $hay_Zlib )
					$file_offset = gztell($file);
			else
				$file_offset = ftell($file);
		
			echo( "<pre>" );
			echo( "$icono L&iacute;neas procesadas......................... $total_lineas<br>" );
			echo( "$icono Consultas procesadas...................... $total_queries<br>" );
			echo( "$icono &Uacute;ltima Consulta procesada................. '$last_query'<br>" );
				if( $hay_Zlib ) {
				echo( "$icono Base de Datos comprimida.................. $filesize_comprimido bytes<br>");
				echo( "$icono Base de Datos descomprimida y procesada... $file_offset bytes<br>" );
			}
			else {
				echo( "$icono Base de Datos procesada................... $file_offset bytes<br>" );
			}
			echo( "</pre>" );
				$t_now = time();
				$t_delta = $t_now - $t_start;
				if( !$t_delta )
					$t_delta = 1;
				$t_delta = floor(($t_delta-(floor($t_delta/3600)*3600))/60)." minutos y "
				.floor($t_delta-(floor($t_delta/60))*60)." segundos.";
				echo( "$icono Se ha finalizado la restauraci&oacute;n en $t_delta<br>" );
		}
	
		if ( $dbconnection )
			mysql_close();
		if ( $file )
			if( $hay_Zlib )
				gzclose($file);
		   else
			fclose($file);
 if($generados == 1){
	echo "</div>";
	echo "</fieldset";
}
?>