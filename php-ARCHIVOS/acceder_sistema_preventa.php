<?
	session_start();   																			// Iniciar sesión
	$usuario_activo = $_SESSION['user_usuario']; 										//usuario conectado

	include("conexion.php");
	$consulta = "SELECT factura_vta FROM usuario where usuario = '$usuario_activo'"; 
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$permiso= $registro[0];
	if ($permiso == 'S'){     						 											// si existe el usuario inicia la sesion
			$nombre_url = $_POST["nombre"]; 														// toma la variable de la url q vino de ajax.js
			if($nombre){ 																		// si se va a registrar una url
						$consulta = "call alta_url_sis_preventa('$nombre_url')"; 				// llama al procedimiento almacecnado
						$result = mysql_query($consulta);        							// hace la consulta
						if(	$result = mysql_query($consulta)){            					// hace la consulta
								echo $nombre_url;
						}else{
								echo 'no_db';
						}
			}else{
						include('conexion.php');
						$consulta = "select url from sis_preventa"; 							// verifica si se registro una url para acceder al sistema de preventa
						$result = mysql_query($consulta);            							// hace la consulta
						$registro = mysql_fetch_row($result);        							  		
						$nfilas = mysql_num_rows ($result);          							//indica la cantidad de resultados
						if($nfilas > 0){
							?>
							<input type="text"  id="url" name="url" value="<? echo $registro[0];?>">
							<script>  
								var var_url=document.getElementById("url"); 
								window.location.href= var_url.value;							  // redirecciona a la url del sistema
							</script>
							<?
						}else{
							require("smarty.php");  				 								// requiere la pag "include.php" para crear una instancia de Smarty
							$smarty = new ClaseSmarty; 				 								//crea una instancia
							$plantilla = "alta_url_sis_preventa.tpl";
							$smarty->display($plantilla);   										//define la plantilla que utilizara
						}
				}	
	}else{
		?><script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script><?
	}	
?>