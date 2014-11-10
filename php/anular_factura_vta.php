<?
session_start();   															 // Iniciar sesión
$usuario_anular = $_SESSION['user_usuario']; 						 //usuario conectado

$cod_tal = $_POST["cod_tal"]; // toma la variable de la url q vino de ajax.js
$num_tal = $_POST["num_tal"]; 	// toma la variable de la url q vino de ajax.js
$num_fac = $_POST["num_fac"]; 	// toma la variable de la url q vino de ajax.js
if($cod_tal){
	include("conexion.php");
	$codigo = strtoupper($codigo);
	$nfilas = 0;
	$consulta = " SELECT * from (
								select factura_vta.cod_talonario, factura_vta.num_talonario, factura_vta.n_factura, concat(cliente.cod_cliente,' - ' ,razon_social)as razon_social, 
								
								(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
								round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) +
								round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
								round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as total_general,
								observacion,fecha
								
								from factura_vta_detalle inner join (factura_vta inner join cliente on cliente.cod_cliente = factura_vta.cod_cliente) 
								on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario where factura_vta.cod_talonario = '$cod_tal' and factura_vta.num_talonario = $num_tal and factura_vta.n_factura = $num_fac
								GROUP BY cliente.razon_social
								
								UNION 
								
								select factura_vta_no_cliente.cod_talonario,factura_vta_no_cliente.num_talonario,factura_vta_no_cliente.n_factura, factura_vta_no_cliente.razon_social,
								 
								(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
								round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) +
								round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
								round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as total_general,
								observacion,fecha
								
								from factura_vta_no_cliente_detalle  inner join factura_vta_no_cliente 
								on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario where factura_vta_no_cliente.cod_talonario = '$cod_tal' and factura_vta_no_cliente.num_talonario = $num_tal and factura_vta_no_cliente.n_factura = $num_fac
								
								GROUP BY factura_vta_no_cliente.razon_social
								
								) as comprobante";
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
			$estado=$registro[5];				// Estado contiene el campo observacion donde se registra si se anulo el comprobante
			if($estado == 'ANULADO'){
				echo"<div id='tabla' name = 'anulado' ></div>";
				echo"<table width='60%' border='0' ";
				echo"<tr>";
				echo"<td><strong>ERROR: LA FACTURA YA HA SIDO ANULADA</strong></td>";
				echo"</tr>";
				echo"</table>";
			}else{
						$consulta2 = "SELECT (n_factura)AS numero, cargas.fecha FROM cargas inner join factura_vta on factura_vta.fecha = cargas.fecha 
										and factura_vta.n_factura = $num_fac and cod_talonario= '$cod_tal' and num_talonario = $num_tal 
										and cargas.cod_flero = factura_vta.cod_repartidor
										UNION
										SELECT (n_factura)AS numero, cargas.fecha FROM cargas inner join factura_vta_no_cliente on factura_vta_no_cliente.fecha = cargas.fecha 
										and factura_vta_no_cliente.n_factura = $num_fac
										and cargas.cod_flero = factura_vta_no_cliente.cod_repartidor";
										
						$result2 = mysql_query($consulta2);            // hace la consulta
						$registro2 = mysql_fetch_row($result2);        // toma el registro
						$cerrado=  mysql_num_rows ($result2);          //indica la cantidad de resultados

						if(empty($cerrado)){
									
									$consulta = "call anular_factura_vta('$cod_tal',$num_tal,$num_fac,'$usuario_anular')"; // llama al procedimiento almacecnado
									if(	$result = mysql_query($consulta)){            					// hace la consulta
										//==========================================================================================//				
										$consulta = "SELECT concat(cod_grupo,cod_marca,cod_variedad,cod_prod)as codigo, cantidad FROM factura_vta_detalle where factura_vta_detalle.n_factura = $num_fac and  factura_vta_detalle.cod_talonario= '$cod_tal' and factura_vta_detalle.num_talonario = $num_tal"; // llama al procedimiento almacecnado
										$result = mysql_query($consulta);
										$registro = mysql_fetch_row($result);        // toma el registro
										do{ 	// obtengo los resultados 
											$codigo=$registro[0];		
											$cantidad=$registro[1];
											$consulta2 = "call anular_factura_vta_detalle($codigo,$cantidad)"; // VUELVE AL STOCK
											$result2 = mysql_query($consulta2);            					 
										}while($registro = mysql_fetch_row($result)); //end while
										//==========================================================================================//				
										$consulta = "SELECT concat(cod_grupo,cod_marca,cod_variedad,cod_prod)as codigo, cantidad FROM factura_vta_no_cliente_detalle where factura_vta_no_cliente_detalle.n_factura = $num_fac and  factura_vta_no_cliente_detalle.cod_talonario= '$cod_tal' and factura_vta_no_cliente_detalle.num_talonario = $num_tal"; // llama al procedimiento almacecnado
										$result = mysql_query($consulta);
										$registro = mysql_fetch_row($result);        // toma el registro
										do{ 	// obtengo los resultados 
											$codigo=$registro[0];		
											$cantidad=$registro[1];
											$consulta2 = "call anular_factura_vta_detalle($codigo,$cantidad)"; // VUELVE AL STOCK
											$result2 = mysql_query($consulta2);            					  
										}while($registro = mysql_fetch_row($result)); //end while
										
										echo"<table width='60%' border='0' ";
										echo"<tr>";
										echo"<td><strong>FACTURA ANULADA</strong></td>";
										echo"</tr>";
										echo"</table>";
									}else{
										echo"<table width='60%' border='0' ";
										echo"  <tr >";
										echo"    <td><strong>ERROR: LA FACTURA NO SE PUDO ANULAR</strong></td>";
										echo"  </tr>";
										echo"</table>";
									}
						}else{
									$fecha_carga=$registro2[1];
									
									$dia=date("d",time());  //asigna una cadena a la variable "dia"
									$mes=date("m",time());  //asigna una cadena a la variable "mes"
									$ano=date("Y",time());  //asigna una cadena a la variable "año"
									$fecha_actual="$ano$mes$dia";
									
									if($fecha_carga == $fecha_actual){
											echo"<table width='60%' border='0' ";
											echo"  <tr >";
											echo"    <td><strong>ERROR: LA FACTURA PERTENECE A UNA CARGA YA CERRADA</strong></td>";
											echo"  </tr>";
											echo"</table>";
									}else{
									
											$consulta = "call anular_factura_vta('$cod_tal',$num_tal,$num_fac,'$usuario_anular')"; // llama al procedimiento almacecnado
											if(	$result = mysql_query($consulta)){            					// hace la consulta
												//==========================================================================================//				
												$consulta = "SELECT concat(cod_grupo,cod_marca,cod_variedad,cod_prod)as codigo, cantidad FROM factura_vta_detalle where factura_vta_detalle.n_factura = $num_fac and  factura_vta_detalle.cod_talonario= '$cod_tal' and factura_vta_detalle.num_talonario = $num_tal"; // llama al procedimiento almacecnado
												$result = mysql_query($consulta);
												$registro = mysql_fetch_row($result);        // toma el registro
												do{ 	// obtengo los resultados 
													$codigo=$registro[0];		
													$cantidad=$registro[1];
													$consulta2 = "call anular_factura_vta_detalle($codigo,$cantidad)"; // llama al procedimiento almacecnado
													$result2 = mysql_query($consulta2);            					  // hace la consulta
												}while($registro = mysql_fetch_row($result)); //end while
												//==========================================================================================//				
												$consulta = "SELECT concat(cod_grupo,cod_marca,cod_variedad,cod_prod)as codigo, cantidad FROM factura_vta_no_cliente_detalle where factura_vta_no_cliente_detalle.n_factura = $num_fac and  factura_vta_no_cliente_detalle.cod_talonario= '$cod_tal' and factura_vta_no_cliente_detalle.num_talonario = $num_tal"; // llama al procedimiento almacecnado
												$result = mysql_query($consulta);
												$registro = mysql_fetch_row($result);        // toma el registro
												do{ 	// obtengo los resultados 
													$codigo=$registro[0];		
													$cantidad=$registro[1];
													$consulta2 = "call anular_factura_vta_detalle($codigo,$cantidad)"; // llama al procedimiento almacecnado
													$result2 = mysql_query($consulta2);            					  // hace la consulta
												}while($registro = mysql_fetch_row($result)); //end while
												
												echo"<table width='60%' border='0' ";
												echo"<tr>";
												echo"<td><strong>FACTURA ANULADA</strong></td>";
												echo"</tr>";
												echo"</table>";
											}else{
												echo"<table width='60%' border='0' ";
												echo"  <tr >";
												echo"    <td><strong>ERROR: LA FACTURA NO SE PUDO ANULAR</strong></td>";
												echo"  </tr>";
												echo"</table>";
											}
									}
						}		
			    }
			
	}else{
			echo"<table width='60%' border='0' ";
			echo"  <tr >";
			echo"    <td><strong>FACTURA INEXISTENTE</strong></td>";
			echo"  </tr>";
			echo"</table>";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('anular_factura_vta.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="factura_vta";
	$plantilla = "anular_factura_vta.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>