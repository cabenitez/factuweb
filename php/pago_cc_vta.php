<? 
// "numero_recibo="+numero_recibo+"&cod_tal="+cod_tal+"&num_tal="+num_tal+"&fecha="+fecha+"&vendedor="+vendedor+"&obs="+obs+"&importe="+importe+"&cod_cliente="+cod_cliente;

session_start();   										// Iniciar sesión
$usuario_cc = $_SESSION['user_usuario']; 	//usuario conectado
//$usuario_fac = $usuario_rem;
include("conexion.php");

// SI SE VA A REGISTRAR UN RECIBO 			*********************************************** 
$cod_cliente = $_POST["cod_cliente"]; 		// toma la variable de la url q vino de ajax.js
if($cod_cliente){ 
	$obs = strtoupper($obs);

	$consulta = "SELECT * FROM cliente WHERE cod_cliente = $cod_cliente"; // consulta sql 
    $result = mysql_query($consulta);            // hace la consulta
	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        		// toma el registro
	
	if ($nfilas > 0){     						 		// si existe el usuario inicia la sesion
		$cod_zona=$registro[1];
		$cod_loca=$registro[2];
		$cod_prov=$registro[3]; 
		$cod_pais=$registro[4]; 
	
		$consulta_t ="SELECT * FROM recibos_por_cliente where cod_cliente = $cod_cliente and cod_zona=$cod_zona and cod_localidad= $cod_loca and cod_prov=$cod_prov and cod_pais = $cod_pais order by num_talonario desc";
		$result_t = mysql_query($consulta_t);            // hace la consulta
		$nfilas_t = mysql_num_rows ($result_t);          //indica la cantidad de resultados
		$registro_t = mysql_fetch_row($result_t);        // toma el registro
		if ($nfilas_t > 0){     						 // si existe el usuario inicia la sesion
				$codigo_tal=$registro_t[5];
				$numero_tal=$registro_t[6];
		
				//-----------------------------------Obtengo el numero -------------------------------// 
				$consulta = "SELECT n_sucursal,sig_num, ultimo_num, destino_impr FROM talonario where cod_talonario = '$codigo_tal' and num_talonario = $numero_tal"; // obtiene el numero de sucursal
				$result = mysql_query($consulta);            // hace la consulta
				$registro = mysql_fetch_row($result);        // toma el registro
				$num_sucursal = $registro[0]; 	// OK
				$num_recibo = $registro[1];
				$ultimo_num = $registro[2]; 
				$impresora= $registro[3]; 		// OK
				
				//================================ OBTIENE EL DESTINO DE IMPRESION==================================================================================//				
				$posicion_comodin = strrpos ($impresora, "#"); 		
				$impresora = substr($impresora, 0,$posicion_comodin); 		// obtiene solo la info de la impresora
				$impresora = "/printers/".$impresora;
				//================================FIN =============================================================================================================//				

				$nfilas = 0;
				$consulta = "SELECT num_recibo FROM cc_vta where cod_talonario = '$codigo_tal' and num_talonario = $numero_tal"; 				// verifica si se han hecho facturas a un cliente
				$result = mysql_query($consulta);            					
				$nfilas = mysql_num_rows ($result);          					
				//echo $consulta;
				if ($nfilas > 0){												// si existen facturas obtiene el mayor
					$consulta = "SELECT max(num_recibo) FROM cc_vta where cod_talonario = '$codigo_tal' and num_talonario = $numero_tal"; 
					$result = mysql_query($consulta);            
					$registro = mysql_fetch_row($result);         
					$num_recibo = $registro[0]+1;
				}
				$consulta = "call alta_pago_cc_vta($num_recibo,$cod_cliente,$cod_zona,$cod_loca,$cod_prov,$cod_pais,'$codigo_tal',$numero_tal,$importe,$vendedor,$fecha_cobro,'$obs','$usuario_cc')"; // llama al procedimiento almacecnado
				//echo $consulta;
				if($result = mysql_query($consulta)){        // hace la consulta
						//*********************************************************************************************************** //
						//                            DATOS DE LAS IMPUTACIONES
						//*********************************************************************************************************** //	
						
						if($imputar == 'si'){
							$consulta = "SELECT * FROM cc_vta_tmp where usuario = '$usuario_cc'";
							$result = mysql_query($consulta);            // hace la consulta
							$registro = mysql_fetch_row($result);        // toma el registro
							do{
								$usuario= $registro[0];
								$n_factura = $registro[1];
								$cod_talonario = $registro[2];
								$num_talonario = $registro[3];
								$importe  = $registro[4];
										
								$consulta3 = "call alta_cc_vta_detalle($n_factura,'$cod_talonario',$num_talonario,$num_recibo,'$codigo_tal',$numero_tal,$importe,$fecha_cobro,'$obs','$usuario_cc')"; 
								$result3 = mysql_query($consulta3);
							 }while($registro = mysql_fetch_array($result)); 	// obtengo los resultados 

							//*********************************************************************************************************** //
							//                            VACIA TABLA DE ARTICULOS TEMPORAL
							//*********************************************************************************************************** //	
							$consulta = "call vaciar_tabla_cc_vta_tmp('$usuario_cc')";
							$result = mysql_query($consulta);            // hace la consulta
						}
						echo "ok";
					}
				

		}else{
			echo "talonario_no_existe";
		}
	}else{
		echo "cliente_no_existe";
	}



					   
}else{
	//	vacia la tabla temporal
	$consulta = "call vaciar_tabla_cc_vta_tmp('$usuario_cc')";
	$result = mysql_query($consulta);            // hace la consulta

	require("smarty.php");  // requiere la pag "smarty.php" para crear una instancia de Smarty 
	$smarty = new ClaseSmarty; //crea una instancia
	$smarty->assign('dia',date("d",time())); //asigna la variable "dia"
	$smarty->assign('mes',date("m",time())); //asigna la variable "mes"
	$smarty->assign('ano',date("Y",time())); //asigna la variable "año"

	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============// 
	$modulo="cta_cte";
	$plantilla = "pago_cc_vta.tpl";
	require("validar_permiso.php");	 
}
?>
