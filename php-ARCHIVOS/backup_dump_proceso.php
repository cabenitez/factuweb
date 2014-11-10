<?php
	//  Conexión con la Base de Datos.
	include('conexion.php');
	
	$db_server			= $host; 
	$db_name			= $db; 
	$db_username		= $usuario; 
	$db_password		= $clave; 
	
	//  Nombre del archivo.
	$filename 			= "back_up/generados/".date("d\-m\-Y") . "--backup_sistema_facturacion.sql";	//nombre de archivo con la extensión
	$icono = "<img src='../imagenes/flecha_der_azul.gif' >";

	//  Funciones
	//error_reporting( E_ALL & ~E_NOTICE );

	function fetch_table_dump_sql($table, $fp = 0) {
		$tabledump = "--\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "-- Table structure for table `$table`\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "--\n\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$tabledump = query_first("SHOW CREATE TABLE $table");
		strip_backticks($tabledump['Create Table']);
		$tabledump = "DROP TABLE IF EXISTS $table;\n" . $tabledump['Create Table'] . ";\n\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$tabledump = "--\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "-- Dumping data for table `$table`\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "--\n\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$tabledump = "LOCK TABLES $table WRITE;\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$rows = query("SELECT * FROM $table");
		$numfields=mysql_num_fields($rows);
		while ($row = fetch_array($rows, DBARRAY_NUM)) {
			$tabledump = "INSERT INTO $table VALUES(";
			$fieldcounter = -1;
			$firstfield = 1;
			// campos
			while (++$fieldcounter < $numfields) {
				if( !$firstfield) {
					$tabledump .= ', ';
				}
				else {
					$firstfield = 0;
				}
				if( !isset($row["$fieldcounter"])) {
					$tabledump .= 'NULL';
				}
				else {
					$tabledump .= "'" . mysql_escape_string($row["$fieldcounter"]) . "'";
				}
			}
			$tabledump .= ");\n";
			if( !$hay_Zlib ) 
				fwrite($fp, $tabledump);
			else
				gzwrite($fp, $tabledump);	
		}
		free_result($rows);
		$tabledump = "UNLOCK TABLES;\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
	}

	function strip_backticks(&$text) {
		return $text;
	}

	function fetch_array($query_id=-1) {
		if( $query_id!=-1) {
			$query_id=$query_id;
		}
		$record = mysql_fetch_array($query_id);
		return $record;
	}

	function problemas($msg) {
		$errdesc = mysql_error();
		$errno = mysql_errno();
		$message  = "<br>";
		$message .= "$icono Ha habido un problema accediendo a la Base de Datos<br>";
		$message .= "$icono Error $appname: $msg<br>";
		$message .= "$icono Error mysql: $errdesc<br>";
		//$message .= "$icono Error número mysql: $errno<br>";
		//$message .= "$icono Script: ".getenv("REQUEST_URI")."<br>";
		//$message .= "$icono Referer: ".getenv("HTTP_REFERER")."<br>";
		die("");
  }

	function free_result($query_id=-1) {
    if( $query_id!=-1) {
      $query_id=$query_id;
    }
    return @mysql_free_result($query_id);
  }

  function query_first($query_string) {
    $res = query($query_string);
    $returnarray = fetch_array($res);
    free_result($res);
    return $returnarray;
  }

	function query($query_string) {
    $query_id = mysql_query($query_string);
    if( !$query_id) {
      problemas("Invalid SQL: ".$query_string);
    }
    return $query_id;
  }


	//------------------------------------------------------------------------------------------

	@set_time_limit( 0 );

	//echo( "- Base de Datos: '$db_name' en '$db_server'.<br>" );
	$error = false;
	$tablas = 0;
	
	echo "<br>";
	if( !@function_exists( 'gzopen' ) ) {
		$hay_Zlib = false;
		echo( "$icono Se ha realizado la Copia de seguridad de la Base de Datos, (sin comprimir). <br>" ); // , como '$filename'
	}
	else {
		$filename = $filename . ".gz";
		$hay_Zlib = true;
		echo( "$icono Se ha realizado la Copia de seguridad de la Base de Datos, (comprimida con Zlib). <br>" ); //, como '$filename'
	}
	
	if( !$error ) { 
	    $dbconnection = @mysql_connect( $db_server, $db_username, $db_password ); 
	    if( $dbconnection) 
	        $db = mysql_select_db( $db_name );
	    if( !$dbconnection || !$db ) { 
	        echo( "<br>" );
	        echo( "$icono La conexion con la Base de datos ha fallado: ".mysql_error()."<br>" );
	        $error = true;
	    }
	    else {
	        echo( "<br>" );
	        //echo( "- He establecido conexion con la Base de datos.<br>" );
	    }
	}

	if( !$error ) { 
		//  MySQL versión
		$result = mysql_query( 'SELECT VERSION() AS version' );
		if( $result != FALSE && @mysql_num_rows($result) > 0 ) {
			$row   = mysql_fetch_array($result);
		} else {
			$result = @mysql_query( 'SHOW VARIABLES LIKE \'version\'' );
			if( $result != FALSE && @mysql_num_rows($result) > 0 ){
				$row   = mysql_fetch_row( $result );
			}
		}
		if(! isset($row) ) {
			$row['version'] = '3.21.0';
		}
	}

	if( !$error ) { 
		$el_path = getenv("REQUEST_URI");
		$el_path = substr($el_path, strpos($el_path, "/"), strrpos($el_path, "/"));

		$result = mysql_list_tables( $db_name );
		if( !$result ) {
			print "$icono Error, no se puede obtener la lista de las tablas.<br>";
			print '$icono MySQL Error: ' . mysql_error(). '<br><br>';
			$error = true;
		}
		else {
			$t_start = time();
			
			if( !$hay_Zlib ) 
				$filehandle = fopen( $filename, 'w' );
			else
				$filehandle = gzopen( $filename, 'w6' );	//  nivel de compresión
				
			if( !$filehandle ) {
				$el_path = getenv("REQUEST_URI");
				$el_path = substr($el_path, strpos($el_path, "/"), strrpos($el_path, "/"));
				echo( "<br>" );
				echo( "$icono No he podido crear '$filename' en '$el_path/'. Por favor, asegúrese de<br>" );
				echo( "&nbsp;&nbsp;que dispone de privilegios de escritura.<br>" );
			}
			else {					
				$tabledump = "-- Dump de la Base de Datos\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				setlocale( LC_TIME,"spanish" );
				$tabledump = "-- Fecha: " . strftime( "%A %d %B %Y - %H:%M:%S", time() ) . "\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "--\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- SISTEMA DE FACTURACION WEB\n";
				$tabledump = "-- BENITEZ CARLOS ALBERTO, cabenitez83@gmail.com\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Soporte: http://www.cabenitez.com.ar\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "--\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Host: `$db_server`    Database: `$db_name`\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- ------------------------------------------------------\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Server version	". $row['version'] . "\n\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	

				$result = query( 'SHOW tables' );
				while( $currow = fetch_array($result, DBARRAY_NUM) ) {
					fetch_table_dump_sql( $currow[0], $filehandle );
					fwrite( $filehandle, "\n" );
					if( !$hay_Zlib ) 
						fwrite( $filehandle, "\n" );
					else
						gzwrite( $filehandle, "\n" );
						$tablas++;
				}
				$tabledump = "\n-- Dump de la Base de Datos Completo.";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				if( !$hay_Zlib ) 
					fclose( $filehandle );
				else
					gzclose( $filehandle );
	
				$t_now = time();
				$t_delta = $t_now - $t_start;
				if( !$t_delta )
					$t_delta = 1;
				$t_delta = floor(($t_delta-(floor($t_delta/3600)*3600))/60)." minutos y "
				.floor($t_delta-(floor($t_delta/60))*60)." segundos.";
				echo( "$icono Se han Salvado $tablas tablas en $t_delta<br>" );
				//echo( "<br>" );
				//echo( "- Copia de Seguridad de la Base de Datos completo.<br>" );
				//echo( "- He salvado la Base de Datos en: $el_path/$filename<br>" );
				echo( "<br>" );
				
				$nombre_arch = substr ($filename,18);
				echo( "$icono <b>Descargar:</b> <a href=\"$filename\" class='seccion'>$nombre_arch</a>" );
				$size = filesize($filename);
				$size = number_format( $size );
				$size = str_replace( ",",".",$size );
				echo( "&nbsp;&nbsp;&nbsp;<small>($size bytes)</small><br>" );
			}
		}
	}

	if( $dbconnection )
	    mysql_close();
?>
	