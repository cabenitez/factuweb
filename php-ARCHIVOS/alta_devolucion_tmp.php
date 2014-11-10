<? 
session_start();   // Iniciar sesión
$usuario_dev = $_SESSION['user_usuario']; //usuario conectado

$codigo_art = $_POST["codigo_art"]; 	// toma la variable de la url q vino de ajax.js
if($codigo_art){
	include("conexion.php");
	$cant_art = $_POST["cant_art"]; 	// toma la variable de la url q vino de ajax.js
	$vendedor = $_POST["vendedor"]; 	// toma la variable de la url q vino de ajax.js
	$fecha_carga = $_POST["fecha_carga"]; 	// toma la variable de la url q vino de ajax.js

	$consulta = "select sum(cantidad) from(
				SELECT sum(cantidad)as cantidad FROM factura_vta inner join factura_vta_detalle on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario where 
				concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca , factura_vta_detalle.cod_variedad , factura_vta_detalle.cod_prod) = $codigo_art and
				factura_vta.cod_vendedor = $vendedor and fecha = $fecha_carga and factura_vta.observacion <> 'anulado' and observacion <> 'N/C'
				UNION
				SELECT sum(cantidad)as cantidad FROM factura_vta_no_cliente inner join factura_vta_no_cliente_detalle on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario where 
				concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca , factura_vta_no_cliente_detalle.cod_variedad , factura_vta_no_cliente_detalle.cod_prod) = $codigo_art and
				factura_vta_no_cliente.cod_vendedor = $vendedor and fecha = $fecha_carga and factura_vta_no_cliente.observacion <> 'anulado' and observacion <> 'N/C'
				UNION
				SELECT sum(cantidad)as cantidad FROM remito_vta inner join remito_vta_detalle on remito_vta_detalle.num_remito = remito_vta.num_remito where 
				concat(remito_vta_detalle.cod_grupo, remito_vta_detalle.cod_marca , remito_vta_detalle.cod_variedad , remito_vta_detalle.cod_prod) = $codigo_art and
				remito_vta.cod_vendedor = $vendedor and fecha = $fecha_carga and remito_vta.observacion <> 'anulado'
				UNION
				SELECT sum(cantidad)as cantidad FROM remito_vta_no_cliente inner join remito_vta_detalle_no_cliente on remito_vta_detalle_no_cliente.num_remito = remito_vta_no_cliente.num_remito where 
				concat(remito_vta_detalle_no_cliente.cod_grupo, remito_vta_detalle_no_cliente.cod_marca , remito_vta_detalle_no_cliente.cod_variedad , remito_vta_detalle_no_cliente.cod_prod) = $codigo_art and
				remito_vta_no_cliente.cod_vendedor = $vendedor and fecha = $fecha_carga and remito_vta_no_cliente.observacion <> 'anulado' ) as cant_vta";  // obtiene el cod del remito
    $result = mysql_query($consulta);           														   
   	$registro = mysql_fetch_row($result);        															
	$cant_vta = $registro[0]; 					



	$consulta = "SELECT * FROM tipo_talonario where descripcion LIKE '%devol%' or descripcion like '%DEVOL%' or '%reb%' or descripcion like '%REB%' ";  // obtiene el cod del remito
    $result = mysql_query($consulta);           														   
   	$registro = mysql_fetch_row($result);        															
	$cod_tt= $registro[0]; 					// obtiene la letra que identifica al remito
		
	$consulta = "SELECT max(num_talonario) FROM talonario where cod_talonario = '$cod_tt'"; 		// obtiene el numero del remito
    $result = mysql_query($consulta);            
   	$registro = mysql_fetch_row($result);       
	$max_num_tal= $registro[0];
	
	$consulta = "SELECT max_iter FROM talonario where num_talonario = $max_num_tal AND cod_talonario = '$cod_tt'"; 			// obtiene el numero max de iteraciones
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$max_iter= $registro[0];

	$consulta = "SELECT count(linea) FROM devolucion_detalle_tmp where usuario = '$usuario_rem'";		// obtiene la cantidad de articulos
	$result = mysql_query($consulta);            
	$registro = mysql_fetch_row($result);        
	$num_iter = $registro[0];		

	$consulta = "SELECT * FROM devolucion_detalle_tmp where usuario = '$usuario_dev' and cod_prod = $codigo_art";		// obtiene la cantidad de articulos
	$result = mysql_query($consulta);            
	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	if ($nfilas > 0){     						 		// si ya existe el articulo
			echo "ERROR: El aticulo ya ha sido agregado";
	}else{
		if($num_iter < $max_iter){																	// verifica que las lineas sean menor al max	
			if($cant_vta > 0){				
				if($cant_vta >= $cant_art){			
						$consulta = "SELECT max(linea) FROM devolucion_detalle_tmp where usuario = '$usuario_dev'"; 	// asigna el numero siguiente al mayor
						$result = mysql_query($consulta);          
						$registro = mysql_fetch_row($result);       
						$linea = $registro[0] + 1;		
						
						$consulta = "select descripcion, precio_vta from producto inner join prod_por_categ on 
									 concat(prod_por_categ.cod_grupo, prod_por_categ.cod_marca , prod_por_categ.cod_variedad , prod_por_categ.cod_prod) =
									 concat(producto.cod_grupo, producto.cod_marca , producto.cod_variedad , producto.cod_prod) where
									 concat(producto.cod_grupo, producto.cod_marca , producto.cod_variedad , producto.cod_prod) = $codigo_art";		// obtiene la cantidad de articulos
						$result = mysql_query($consulta);            
						$registro = mysql_fetch_row($result);        
						$descripcion = $registro[0];		
						$precio_vta = $registro[1];		
						
						$consulta = "call alta_devolucion_tmp('$usuario_dev', $codigo_art,'$descripcion',$precio_vta,$cant_art,$linea)"; // llama al procedimiento almacecnado
						$result = mysql_query($consulta);        
						echo 'ok';
				}else{
					echo "maximo_superado"; 
				}
			}else{
				echo "no_existe";
			}	
		}else{
			echo "limite_exedido";
		}	
	}	
}
?>