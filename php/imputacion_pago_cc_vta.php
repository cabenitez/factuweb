<? 
// "n_recibo="+numero_recibo+"&cod_tal="+cod_tal+"&num_tal="+num_tal+"&fecha="+fecha+"&vendedor="+vendedor+"&obs="+obs+"&importe="+importe+"&cod_cliente="+cod_cliente;

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
	
		//*********************************************************************************************************** //
		//                            DATOS DE LAS IMPUTACIONES
		//*********************************************************************************************************** //	
		$consulta = "SELECT * FROM cc_vta_tmp where usuario = '$usuario_cc'";
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		do{
			$usuario= $registro[0];
			$n_factura = $registro[1];
			$cod_talonario = $registro[2];
			$num_talonario = $registro[3];
			$importe  = $registro[4];
										//                 cod_tal_r='$cod_talonario'&num_tal_r=$num_talonario&n_recibo_r
			$consulta3 = "call alta_cc_vta_detalle($n_factura,'$cod_talonario',$num_talonario,$n_recibo_r,'$cod_tal_r',$num_tal_r,$importe,$fecha_cobro,'$obs','$usuario_cc')"; 
			$result3 = mysql_query($consulta3);
		 }while($registro = mysql_fetch_array($result)); 	// obtengo los resultados 

		//*********************************************************************************************************** //
		//                            VACIA TABLA DE ARTICULOS TEMPORAL
		//*********************************************************************************************************** //	
		$consulta = "call vaciar_tabla_cc_vta_tmp('$usuario_cc')";
		$result = mysql_query($consulta);            // hace la consulta
		echo 'ok';
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
	$plantilla = "imputacion_pago_cc_vta.tpl";
	require("validar_permiso.php");	 
}
?>
