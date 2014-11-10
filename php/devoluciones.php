<? 
session_start();   										// Iniciar sesión
$usuario_dev = $_SESSION['user_usuario']; 	//usuario conectado

$dia_actual=date("d",time());  //asigna una cadena a la variable "dia"
$mes_actual=date("m",time());  //asigna una cadena a la variable "mes"
$ano_actual=date("Y",time());  //asigna una cadena a la variable "año"
$fecha_rebote=$ano_actual.$mes_actual.$dia_actual;

$fecha_carga = $_POST["fecha_carga"]; 		// toma la variable de la url q vino de ajax.js
$vendedor = $_POST["vendedor"]; 		// toma la variable de la url q vino de ajax.js

include("conexion.php");
// devolucion para registrar 	*********************************************************************************************
if($vendedor){ 
	$consulta = "SELECT * FROM tipo_talonario where descripcion LIKE '%devol%' or descripcion like '%DEVOL%' or '%reb%' or descripcion like '%REB%' ";  // obtiene el cod del remito
    $result = mysql_query($consulta);           														   
   	$registro = mysql_fetch_row($result);        															
	$cod_tt= $registro[0]; 					// obtiene la letra que identifica al remito
	$cant_copias = $registro[2]; 			// OK
		
	$nfilas = 0;
	$consulta = "SELECT n_devolucion FROM devolucion"; 				// verifica si se han hecho remitos a un cliente
    $result = mysql_query($consulta);            					
	$nfilas = mysql_num_rows ($result);          					
	
	if ($nfilas > 0){												// si existen registros en la tabla remitos de clientes
		$consulta = "SELECT max(n_devolucion) FROM devolucion"; 
    	$result = mysql_query($consulta);            
		$registro = mysql_fetch_row($result);        
		$num_devolucion = $registro[0]+1;
	}
	
	$consulta = "SELECT max(num_talonario) FROM talonario where cod_talonario = '$cod_tt'"; // obtiene el numero del talonario
    $result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro
	$numero_tal= $registro[0];
		
	$consulta = "SELECT n_sucursal,sig_num, ultimo_num,destino_impr FROM talonario where num_talonario = $numero_tal and cod_talonario = '$cod_tt' "; // obtiene el numero de sucursal
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$num_sucursal = $registro[0];
	if(empty($num_devolucion)){
		$num_devolucion = $registro[1];
	}
	//================================ OBTIENE EL DESTINO DE IMPRESION==================================================================================//				
	$impresora= $registro[3]; 		// OK
	$posicion_comodin = strrpos ($impresora, "#"); 		
	$impresora = substr($impresora, 0,$posicion_comodin); 		// obtiene solo la info de la impresora
	$impresora = "/printers/".$impresora;
	//================================FIN =============================================================================================================//				
			
	$consulta = "call alta_devolucion($num_devolucion,$vendedor,'$cod_tt',$numero_tal,$fecha_rebote,$fecha_carga)";
	if($result = mysql_query($consulta)){        // hace la consulta
			//echo $consulta;
			//***********************************************************************************************************//
			//                            DATOS DEL DETALLE
			//***********************************************************************************************************//	
			$consulta = "SELECT cod_prod, cantidad, descripcion, round(sum(cantidad * precio),2)as total FROM devolucion_detalle_tmp  where usuario = '$usuario_dev' group by cod_prod";
			$result = mysql_query($consulta);            // hace la consulta
			$registro = mysql_fetch_row($result);        // toma el registro
			$detalle="";
			$total_linea=22;							// Total de lineas que se pueden imprimir en la factura 
			$cant_linea=0; 
			do{
					$cod_prod= $registro[0];
					$cantidad = $registro[1];
					$descripcion = $registro[2];
					$precio = $registro[3];
																						
					$consulta2 = "SELECT cod_prod,cod_variedad,cod_marca,cod_grupo,cod_prod FROM producto where concat(cod_grupo, cod_marca, cod_variedad, cod_prod) = $cod_prod";
					//echo $consulta2."<br>";
					$result2 = mysql_query($consulta2);            // hace la consulta
					$registro2 = mysql_fetch_row($result2);        // toma el registro
											
					$cod_producto = $registro2[0];
					$cod_variedad = $registro2[1];
					$cod_marca = $registro2[2];
					$cod_grupo  = $registro2[3];
											
					$consulta3 = "call alta_devolucion_detalle($num_devolucion,$cod_producto,$cod_variedad,$cod_marca,$cod_grupo,$cantidad,$precio)"; 
					$result3 = mysql_query($consulta3);        // hace la consulta
				   //***********************************************************************************************************//
				   //                           AUMENTA STOCK 
				   //***********************************************************************************************************//	
				   $consulta_stock = "call aumentar_stock($cod_producto,$cod_variedad,$cod_marca,$cod_grupo,$cantidad)"; 				
				   $result_stock = mysql_query($consulta_stock);        // hace la consulta
				   //echo $consulta_stock."<br>";
				
									   
				   //***********************************************************************************************************//
				   //                            CARGA LA VARIABLE PARA ENVIAR A IMRIMIR
				   //***********************************************************************************************************//	
				   $cant_linea++;
				   $precio_total=$precio_total+$precio;
				   $precio_total= number_format($precio_total,2,'.','');   
				   
				   $detalle.="$cod_prod \r ";												//  Codigo de Articulo
				   $detalle.="\t    $cantidad \r"; 											//  Cantidad de Articulo
				   $detalle.="\t\t  $descripcion \r\n"; 										//  Descripcion de Articulo  
			}while($registro = mysql_fetch_array($result)); 	// obtengo los resultados 
											   
			 while($cant_linea < $total_linea){
							$detalle.="\r\n";
							$cant_linea++;
			 }
								   
			//***********************************************************************************************************//
			//                            VACIAR TABLA DE ARTICULOS TEMPORAL
			//***********************************************************************************************************//	
			$consulta4 = "call vaciar_tabla_devolucion_tmp('$usuario_dev')";
			$result4 = mysql_query($consulta4);            // hace la consulta
								   
			//***********************************************************************************************************//
			//                            ENVIA A IMPRIMIR
			//***********************************************************************************************************//	
			$len_num_dev=strlen($num_devolucion); 						// completo el numero de factura con ceros
			while ($len_num_dev < 8){								// completo el numero de la factura con ceros
						$ceros.="0";
						$len_num_dev++;
			}
			$num_devolucion=$ceros.$num_devolucion;
									
			$len_num_sucursal=strlen($num_sucursal); 					// completo el numero de la sucursal con ceros
			while ($len_num_sucursal < 4){
						$ceros_2.="0";
						$len_num_sucursal++;
			}
			$num_sucursal=$ceros_2.$num_sucursal;
			//----------------------------------------------------------------------------------------------------------------//				  
			
			$ano = substr($fecha_carga,0,4); 
			$mes = substr($fecha_carga,4,2);
			$dia = substr($fecha_carga,-2);
			$fecha_carga = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
			
			//----------------------------------------------------------------------------------------------------------------//
			$consulta = "SELECT nombre FROM vendedor where cod_vendedor = $vendedor ";  // obtiene el cod del remito
			$result = mysql_query($consulta);           														   
			$registro = mysql_fetch_row($result);        															
			$nombre_vendedor = $registro[0]; 					// obtiene la letra que identifica al remito

			include("imprimir_devolucion.php");	 						// Incluye la pagina para imprimir las facturas
			echo "ok"; 
	}		 
						
}else{ // nueva factura - obtiene los parametros **************************************************************************************
	
	//	vacia la tabla temporal en caso de que haya quedado pendiente una factura en una sesion anterior o un caso externo
	$consulta = "call vaciar_tabla_dev_tmp('$usuario_dev')";
	$result = mysql_query($consulta);            // hace la consulta

	require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; 				 //crea una instancia
	$smarty->assign('dia',date("d",time()));  //asigna una cadena a la variable "dia"
	$smarty->assign('mes',date("m",time()));  //asigna una cadena a la variable "mes"
	$smarty->assign('ano',date("Y",time()));  //asigna una cadena a la variable "año"
	//$smarty->display('devoluciones.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="devoluciones";
	$plantilla = "devoluciones.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//


}
?>