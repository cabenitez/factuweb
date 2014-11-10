<? 
session_start();   										// Iniciar sesión
$usuario_fac = $_SESSION['user_usuario']; 	//usuario conectado
												
include("conexion.php");
		
// factura para registrar 	*********************************************************************************************
$proveedor = $_POST["proveedor"]; 				// toma la variable de la url q vino de ajax.js
if($proveedor){ 
	$fecha_factura = $_POST["fecha_factura"]; 	// toma la variable de la url q vino de ajax.js
	$sucursal = $_POST["sucursal"]; 			// toma la variable de la url q vino de ajax.js
	$factura = $_POST["factura"]; 				// toma la variable de la url q vino de ajax.js
	$hora_actual = $_POST["hora_actual"]; 		// toma la variable de la url q vino de ajax.js
	$subtotal = $_POST["subtotal"]; 			// toma la variable de la url q vino de ajax.js
	$imp_int_ali = $_POST["imp_int_ali"]; 		// toma la variable de la url q vino de ajax.js     puede ser: "sin_remito = 0";
	$imp_int_imp = $_POST["imp_int_imp"]; 		// toma la variable de la url q vino de ajax.js
	$iva_ali = $_POST["iva_ali"]; 				// toma la variable de la url q vino de ajax.js
	$iva_imp = $_POST["iva_imp"]; 				// toma la variable de la url q vino de ajax.js
	$perc_iva_ali = $_POST["perc_iva_ali"]; 	// toma la variable de la url q vino de ajax.js
	$perc_iva_imp = $_POST["perc_iva_imp"]; 	// toma la variable de la url q vino de ajax.js
	$pib_ali = $_POST["pib_ali"]; 				// toma la variable de la url q vino de ajax.js
	$pib_imp = $_POST["pib_imp"]; 				// toma la variable de la url q vino de ajax.js
	$otros_ali = $_POST["otros_ali"]; 			// toma la variable de la url q vino de ajax.js
	$otros_imp = $_POST["otros_imp"]; 			// toma la variable de la url q vino de ajax.js
	$total = $_POST["total"]; 					// toma la variable de la url q vino de ajax.js
	$deposito = $_POST["deposito"];				// toma la variable de la url q vino de ajax.js			
	
	$consulta = "SELECT * FROM factura_compra where n_factura = $factura and n_sucursal =  $sucursal and cod_proveedor = $proveedor"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
   
   if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		//**********************************************************************************************************//
		//                            DATOS DEL CLIENTE Y DEL REMITO
		//***********************************************************************************************************//	
		$dia_fac=date("d",time());  //asigna una cadena a la variable "dia"
		$mes_fac=date("m",time());  //asigna una cadena a la variable "mes"
		$ano_fac=date("Y",time());  //asigna una cadena a la variable "año"
		$fecha_fac="$ano_fac$mes_fac$dia_fac";

		$consulta = "call alta_factura_compra($factura,$sucursal,$proveedor,$fecha_factura,'$subtotal','$imp_int_ali','$imp_int_imp','$iva_ali','$iva_imp','$perc_iva_ali','$perc_iva_imp','$pib_ali','$pib_imp','$otros_ali','$otros_imp','$total','$fecha_fac' ,'','$usuario_fac',$deposito)";
		if($result = mysql_query($consulta)){        // hace la consulta

				// *********************************************************************************************************** //
				//                            DATOS DEL DETALLE
				// *********************************************************************************************************** //	
				$consulta = "SELECT * FROM factura_compra_tmp where usuario = '$usuario_fac' ORDER BY linea";
				$result = mysql_query($consulta);            // hace la consulta
				$registro = mysql_fetch_row($result);        // toma el registro
				$detalle="";
				$total_linea=52;							// Total de lineas que se pueden imprimir en la factura 
				$cant_linea=0; 
							do{
								$cod_prod= $registro[1];
								$descripcion = $registro[2];
								$cantidad = $registro[3];
								$precio = $registro[4];
								$bonificacion  = $registro[5];
								$importe  = $registro[6];
										
								$consulta2 = "SELECT cod_prod,cod_variedad,cod_marca,cod_grupo FROM producto where concat(cod_grupo, cod_marca, cod_variedad, cod_prod) = $cod_prod";
								//echo $consulta2."<br>";
								$result2 = mysql_query($consulta2);            // hace la consulta
								$registro2 = mysql_fetch_row($result2);        // toma el registro
									
								$cod_producto = $registro2[0];
								$cod_variedad = $registro2[1];
								$cod_marca = $registro2[2];
								$cod_grupo  = $registro2[3];

								$consulta3 = "call alta_factura_compra_detalle($factura,$sucursal,$cod_producto,$cod_variedad,$cod_marca,$cod_grupo,$proveedor,$precio,$cantidad,$bonificacion,$importe)"; 
								$result3 = mysql_query($consulta3);        // hace la consulta
							   // *********************************************************************************************************** //
							   //                           AUMENTA STOCK DE LA TABLA PRODUCTO
							   // *********************************************************************************************************** //	
								
								$consulta_stock = "call aumentar_stock($cod_producto,$cod_variedad,$cod_marca,$cod_grupo,$cantidad)";  				
								$result_stock = mysql_query($consulta_stock);        // hace la consulta
								//echo $consulta_stock."<br>";
		
   							   // *********************************************************************************************************** //
							   //                           MODIFICA EL PRECIO DEL PRODUCTO
							   // *********************************************************************************************************** //	
								
								$consulta_precio = "call modificar_precio($cod_producto,$cod_variedad,$cod_marca,$cod_grupo,$precio)"; 				
								$result_precio = mysql_query($consulta_precio);        // hace la consulta
								//echo $consulta_stock."<br>";

							   
							   
							   
							   // *********************************************************************************************************** //
							   //                            CARGA LA VARIABLE PARA ENVIAR A IMRIMIR
							   // *********************************************************************************************************** //	
							   $cant_linea++;
							   							   
							   $detalle.="$cod_prod\r";												//  Codigo de Articulo
							   $detalle.="\t    $cantidad \r"; 												//  Cantidad de Articulo
							   $detalle.="\t\t  $descripcion \r"; 						//  Descripcion de Articulo  
							   $detalle.="\t\t\t\t\t     $precio \r";										//  % Bonificacion 
							   $detalle.="\t\t\t\t\t\t    $bonificacion\r";									//  importe  Bonificacion 
							   $detalle.="\t\t\t\t\t\t\t\t      $importe\r\n ";						//  Precio total  
						   }while($registro = mysql_fetch_array($result)); 	// obtengo los resultados 
						   	
						   
						   
						   // *********************************************************************************************************** //
						   //                            VACIAR TABLA DE ARTICULOS TEMPORAL
						   // *********************************************************************************************************** //	
						   $consulta4 = "call vaciar_tabla_fac_compra_tmp('$usuario_fac')";
						   $result4 = mysql_query($consulta4);            // hace la consulta
						   
						  
						   // *********************************************************************************************************** //
						   //                            ENVIA A IMPRIMIR
						   // *********************************************************************************************************** //	
						   
						   $fecha_factura_dia=substr($fecha_factura,0,2);
						   $fecha_factura_mes=substr($fecha_factura,2,2);
						   $fecha_factura_ano=substr($fecha_factura,-4);

						   $fecha_factura = "$fecha_factura_dia/$fecha_factura_mes/$fecha_factura_ano";										// maqueta la fecha para imprimir

						   
						   $hora_actual = date("H:i:s");

						   $dia = date("d",time());  //asigna una cadena a la variable "dia"
						   $mes = date("m",time());  //asigna una cadena a la variable "mes"
						   $ano = date("Y",time());  //asigna una cadena a la variable "año"

						   $fecha = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
						  //----------------------------------------------------------------------------------------------------------------//
						  										
						  $consulta5 = "SELECT * from proveedor where cod_proveedor = $proveedor";
						  $result5 = mysql_query($consulta5);            // hace la consulta
						  $registro5 = mysql_fetch_row($result5);        // toma el registro
									
						  $razon_social = $registro5[1];
						  $cuit = $registro5[2];

						  $cuit1=substr($cuit,0,2);
						  $cuit2=substr($cuit,2,-1);
						  $cuit3=substr($cuit,-1);
						  $cuit = "$cuit1-$cuit2-$cuit3"; 								// maqueta el cuit para imprimir
						  
						  $consulta_impr = "SELECT impresora FROM conf_listados"; // consulta sql                  where nombre = '$nombre'		
					      $result_impr = mysql_query($consulta_impr);            // hace la consulta
						  $nfilas_impr = mysql_num_rows ($result_impr);          //indica la cantidad de resultados
						  $registro_impr = mysql_fetch_row($result_impr);        // toma el registro
						  if ($nfilas_impr > 0){     						 // si existe el usuario inicia la sesion
									$impresora= $registro_impr[0]; 		// OK
									$posicion_comodin = strrpos ($impresora, "#"); 		
									$impresora = substr($impresora, 0,$posicion_comodin); 		// obtiene solo la info de la impresora
									$impresora = "/printers/".$impresora;
						  }
						  //================================FIN =============================================================================================================//		 		
			  			  $cant_copias = 1;				  										// indica la cantidad de copias

						  
  						   while($cant_linea < $total_linea){
								$detalle.="\r\n";
								$cant_linea++;
						   }

						  include("imprimir_factura_compra.php");	 						// Incluye la pagina para imprimir las facturas
						  
						  echo "ok";  
			}	
	}else{
		echo "error_existe";
	}
				
}else{ // nueva factura - obtiene los parametros **************************************************************************************
	
	//	vacia la tabla temporal en caso de que haya quedado pendiente una factura en una sesion anterior o un caso externo
	$consulta = "call vaciar_tabla_fac_compra_tmp('$usuario_fac')";
	$result = mysql_query($consulta);            // hace la consulta

	require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; 				 //crea una instancia
	$smarty->assign('dia',date("d",time()));  //asigna una cadena a la variable "dia"
	$smarty->assign('mes',date("m",time()));  //asigna una cadena a la variable "mes"
	$smarty->assign('ano',date("Y",time()));  //asigna una cadena a la variable "año"
	//$smarty->display('alta_factura_compra.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="factura_compra";
	$plantilla = "alta_factura_compra.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>