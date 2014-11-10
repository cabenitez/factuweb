<? 
//variables="nombre="+txtnombre.value+"&usuario="+txtusuario.value+"&clave="+txtclave.value+"&clave2="+txtclave2.value+
//"&abm_zonas_geo="+abm_zonas_geo+"&abm_alicuotas="+abm_alicuotas+"&abm_comprobante="+abm_comprobante+"&abm_cond_iva="+abm_cond_iva+
//"&abm_talonario="+abm_talonario+"&abm_proveedor="+abm_proveedor+"&abm_vehiculo="+abm_vehiculo+"&abm_repartidor="+abm_repartidor+							
//"&abm_vendedor="+abm_vendedor+"&abm_categoria="+abm_categoria+"&abm_forma_pago="+abm_forma_pago+"&abm_cliente="+abm_cliente+							
//"&abm_articulo="+abm_articulo+"&datos_empresa="+datos_empresa+"&conf_listados="+conf_listados+"&abm_usuarios="+abm_usuarios+								
//"&stock="+stock+"&factura_compra="+factura_compra+"&remito_vta="+remito_vta+"&factura_vta="+factura_vta+							
//"&nota_credito="+nota_credito+"&comisiones="+comisiones+"&devoluciones="+devoluciones+"&finalizar_carga="+finalizar_carga+	 							
//"&informes="+informes+"&estadisticas="+estadisticas+"&utilidades="+utilidades;

$nombre = $_POST["nombre"]; 							// toma la variable de la url q vino de ajax.js
$usuario_reg = $_POST["usuario"]; 							// toma la variable de la url q vino de ajax.js
$clave_reg = $_POST["clave"]; 								// toma la variable de la url q vino de ajax.js
$abm_zonas_geo = $_POST["abm_zonas_geo"]; 	 			// toma la variable de la url q vino de ajax.js
$abm_alicuotas = $_POST["abm_alicuotas"]; 				// toma la variable de la url q vino de ajax.js
$abm_comprobante = $_POST["abm_comprobante"]; 			// toma la variable de la url q vino de ajax.js
$abm_cond_iva = $_POST["abm_cond_iva"]; 				// toma la variable de la url q vino de ajax.js
$abm_talonario = $_POST["abm_talonario"]; 				// toma la variable de la url q vino de ajax.js
$abm_proveedor = $_POST["abm_proveedor"]; 				// toma la variable de la url q vino de ajax.js
$abm_vehiculo = $_POST["abm_vehiculo"]; 				// toma la variable de la url q vino de ajax.js
$abm_repartidor = $_POST["abm_repartidor"]; 			// toma la variable de la url q vino de ajax.js
$abm_vendedor = $_POST["abm_vendedor"]; 				// toma la variable de la url q vino de ajax.js
$abm_categoria = $_POST["abm_categoria"]; 				// toma la variable de la url q vino de ajax.js
$abm_forma_pago = $_POST["abm_forma_pago"]; 			// toma la variable de la url q vino de ajax.js
$abm_cliente = $_POST["abm_cliente"]; 					// toma la variable de la url q vino de ajax.js
$abm_articulo = $_POST["abm_articulo"]; 				// toma la variable de la url q vino de ajax.js
$datos_empresa = $_POST["datos_empresa"]; 				// toma la variable de la url q vino de ajax.js
$conf_listados = $_POST["conf_listados"]; 				// toma la variable de la url q vino de ajax.js
$abm_usuarios = $_POST["abm_usuarios"]; 				// toma la variable de la url q vino de ajax.js
$stock = $_POST["stock"]; 								// toma la variable de la url q vino de ajax.js
$factura_compra = $_POST["factura_compra"]; 			// toma la variable de la url q vino de ajax.js
$remito_vta = $_POST["remito_vta"]; 					// toma la variable de la url q vino de ajax.js
$factura_vta = $_POST["factura_vta"]; 					// toma la variable de la url q vino de ajax.js
$nota_credito = $_POST["nota_credito"]; 				// toma la variable de la url q vino de ajax.js
$cta_cte = $_POST["cta_cte"]; 				// toma la variable de la url q vino de ajax.js
$comisiones = $_POST["comisiones"]; 					// toma la variable de la url q vino de ajax.js
$devoluciones = $_POST["devoluciones"]; 				// toma la variable de la url q vino de ajax.js
$finalizar_carga = $_POST["finalizar_carga"]; 			// toma la variable de la url q vino de ajax.js
$informes = $_POST["informes"]; 						// toma la variable de la url q vino de ajax.js
$estadisticas = $_POST["estadisticas"]; 				// toma la variable de la url q vino de ajax.js
$utilidades = $_POST["utilidades"]; 					// toma la variable de la url q vino de ajax.js

if($nombre && $usuario_reg && $clave){
	include("conexion.php"); 
	$nombre = strtoupper($nombre);
	$consulta = "SELECT * FROM usuario where usuario = '$usuario_reg'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_usuario('$usuario_reg','$clave_reg','$nombre','$abm_zonas_geo','$abm_alicuotas','$abm_comprobante','$abm_cond_iva','$abm_talonario','$abm_proveedor','$abm_vehiculo','$abm_repartidor','$abm_vendedor','$abm_categoria','$abm_forma_pago','$abm_cliente','$abm_articulo','$datos_empresa','$conf_listados','$abm_usuarios','$stock','$factura_compra','$remito_vta','$factura_vta','$nota_credito','$cta_cte','$comisiones','$devoluciones','$finalizar_carga','$informes','$estadisticas','$utilidades')"; // llama al procedimiento almacecnado
		if($result == mysql_query($consulta)){;        // hace la consulta
			$consulta = "grant all on *.* to $usuario_reg@localhost identified by '$clave_reg'";				// crea y otorga los permisos a la BD del sistema
			if ($abm_usuarios == 'S'){
				$consulta .= "  with grant option;";  												// otorga el permiso de crear nuevos usuarios
			}
			if($result = mysql_query($consulta)){;        // hace la consulta 
				echo "ok"; 
			}
		}else{
			echo "error" ;
		}	
	}else{
		echo "ERROR: El Usuario ya existe";
	}
}else{
	
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_grupo.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_usuarios"; 
	$plantilla = "alta_usuarios.tpl";
	include("validar_permiso.php");	  
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>