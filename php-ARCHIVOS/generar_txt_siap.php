<?
$tabla = $_POST["tabla"]; 									 // toma la variable de la url q vino de ajax.js
if($tabla){
	//===================== TOMA LAS VARIABLES DE JS============================//
	/*
	$ano_desde = substr($fecha_desde,0,4); 
	$mes_desde = substr($fecha_desde,4,2);
	$dia_desde = substr($fecha_desde,-2);
	$fecha_desde_mostrar = "$dia_desde$mes_desde$ano_desde";										// maqueta la fecha para imprimir

	$ano_hasta = substr($fecha_hasta,0,4); 
	$mes_hasta = substr($fecha_hasta,4,2);
	$dia_hasta = substr($fecha_hasta,-2);
	$fecha_hasta_mostrar = "$dia_hasta$mes_hasta$ano_hasta";										// maqueta la fecha para imprimir
	$fecha_hasta_sep_mostrar = "$dia_hasta/$mes_hasta/$ano_hasta";										// maqueta la fecha para imprimir
	
	$fecha_actual_mostrar=date(dmY);
	*/
	
	require_once('class_txt/inc.crear_txt.php');  		 // clase CVS
	include("conexion.php"); 			    				 // conexion DB
	
	// crea una instancia
	$CrearTXT = new CrearTXT($host, $db, $usuario, $clave); 		 
	
	// asigna el directorio de destino, la clase 1º crea el directorio y escribe el archivo *.CSV dentro de este
	$CrearTXT->path = './txt/';
	
	// asigna el directorio de destino, la clase 1º crea el directorio y escribe el archivo *.CSV dentro de este
	$CrearTXT->separador = ',';
	
	//**************************************************************//
	if($tabla == 'F129'){ 
		// asigna el nombre del archivo
		$CrearTXT->nombre_arch = $tabla.'.txt';	
	
		// asigna la consulta
		$CrearTXT->consulta = "
								SELECT FECHA, TIPO, COMPROBANTE, RAZON_SOCIAL, CUIT, NETO, TASA FROM (
									-- CLIENTES
										select 		concat( SUBSTRING(fecha,7,2),'-',SUBSTRING(fecha,5,2),'-',SUBSTRING(fecha,1,4)) as FECHA,
												if( observacion = 'N/C','NC_A','FA_A') as TIPO,
													concat(talonario.n_sucursal ,factura_vta.n_factura) as COMPROBANTE,
													cliente.razon_social as RAZON_SOCIAL,
													concat( SUBSTRING(cuit,1,2),'-',SUBSTRING(cuit,3,8),'-',SUBSTRING(cuit,11,1)) as CUIT,
												if( observacion = 'N/C',-round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2),round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2)) as NETO,
													factura_vta.ing_bruto AS TASA
								
										from talonario inner join (tipo_talonario inner join (cliente inner join (factura_vta inner join factura_vta_detalle on factura_vta_detalle.n_factura = factura_vta.n_factura 
										and factura_vta_detalle.cod_talonario = factura_vta.cod_talonario and factura_vta_detalle.num_talonario = factura_vta.num_talonario)
										on factura_vta.cod_cliente = cliente.cod_cliente) on cliente.cod_talonario = tipo_talonario.cod_talonario)
										on tipo_talonario.cod_talonario = talonario.cod_talonario and talonario.num_talonario = factura_vta.num_talonario
										where fecha >= $fecha_desde and fecha <= $fecha_hasta and ing_bruto > 0 and observacion <> 'ANULADO' 
										and factura_vta.cod_talonario = 'A' GROUP BY COMPROBANTE
									UNION
										select 		concat( SUBSTRING(fecha,7,2),'-',SUBSTRING(fecha,5,2),'-',SUBSTRING(fecha,1,4)) as FECHA,
												if( observacion = 'N/C','NC_B','FA_B') as TIPO,
													concat(talonario.n_sucursal ,factura_vta.n_factura) as COMPROBANTE,
													cliente.razon_social as RAZON_SOCIAL,
													concat( SUBSTRING(cuit,1,2),'-',SUBSTRING(cuit,3,8),'-',SUBSTRING(cuit,11,1)) as CUIT,
												if( observacion = 'N/C', -round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  /*NETO*/
													round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2),
													 
													round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  /*NETO*/
													round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2)
												  ) as NETO,
															
												factura_vta.ing_bruto AS TASA
								
										from talonario inner join (tipo_talonario inner join (cliente inner join (factura_vta inner join factura_vta_detalle on factura_vta_detalle.n_factura = factura_vta.n_factura 
										and factura_vta_detalle.cod_talonario = factura_vta.cod_talonario and factura_vta_detalle.num_talonario = factura_vta.num_talonario)
										on factura_vta.cod_cliente = cliente.cod_cliente) on cliente.cod_talonario = tipo_talonario.cod_talonario)
										on tipo_talonario.cod_talonario = talonario.cod_talonario and talonario.num_talonario = factura_vta.num_talonario
										where fecha >= $fecha_desde and fecha <= $fecha_hasta and ing_bruto > 0 and observacion <> 'ANULADO' 
										and factura_vta.cod_talonario = 'B' and cod_iva = 2 GROUP BY COMPROBANTE
								UNION 
								
									-- NO CLIENTES
										select  	concat( SUBSTRING(fecha,7,2),'-',SUBSTRING(fecha,5,2),'-',SUBSTRING(fecha,1,4)) as FECHA,
											   if( observacion = 'N/C','NC_A','FA_A') as TIPO,
													concat(talonario.n_sucursal ,factura_vta_no_cliente.n_factura) as COMPROBANTE,
													razon_social as RAZON_SOCIAL,
													concat( SUBSTRING(cuit,1,2),'-',SUBSTRING(cuit,3,8),'-',SUBSTRING(cuit,11,1)) as CUIT,
											   if( observacion = 'N/C',-round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2),round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2)) as NETO,				
								
												
												factura_vta_no_cliente.ing_bruto AS TASA
												
								
										from tipo_talonario inner join (talonario inner join(factura_vta_no_cliente inner join factura_vta_no_cliente_detalle on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura 
										and factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario and factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario)
										on factura_vta_no_cliente.cod_talonario = talonario.cod_talonario and factura_vta_no_cliente.num_talonario = talonario.num_talonario)
										on talonario.cod_talonario = tipo_talonario.cod_talonario  and talonario.num_talonario = factura_vta_no_cliente.num_talonario
										where fecha >= $fecha_desde and fecha <= $fecha_hasta and ing_bruto > 0  and observacion <> 'ANULADO' 
										and factura_vta_no_cliente.cod_talonario = 'A' GROUP BY COMPROBANTE
									union
										select 	concat( SUBSTRING(fecha,7,2),'-',SUBSTRING(fecha,5,2),'-',SUBSTRING(fecha,1,4)) as FECHA,
											   if( observacion = 'N/C','NC_B','FA_B') as TIPO,
												concat(talonario.n_sucursal ,factura_vta_no_cliente.n_factura) as COMPROBANTE,
												razon_social as RAZON_SOCIAL,
												concat( SUBSTRING(cuit,1,2),'-',SUBSTRING(cuit,3,8),'-',SUBSTRING(cuit,11,1)) as CUIT,
												if( observacion = 'N/C',-round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  /*NETO*/
													round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2),
													round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  /*NETO*/
													round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2)
												) as NETO,
												
												factura_vta_no_cliente.ing_bruto AS TASA
								
										from tipo_talonario inner join (talonario inner join(factura_vta_no_cliente inner join factura_vta_no_cliente_detalle on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura 
										and factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario and factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario)
										on factura_vta_no_cliente.cod_talonario = talonario.cod_talonario and factura_vta_no_cliente.num_talonario = talonario.num_talonario)
										on talonario.cod_talonario = tipo_talonario.cod_talonario and talonario.num_talonario = factura_vta_no_cliente.num_talonario
										where fecha >= $fecha_desde and fecha <= $fecha_hasta and ing_bruto > 0  and observacion <> 'ANULADO'
										and factura_vta_no_cliente.cod_talonario = 'B' and cond_iva = 2 GROUP BY COMPROBANTE
										
								) AS IIBB_DIARIO ORDER BY COMPROBANTE;

								";
	
	//**************************************************************//
	}

	// 1 define que se va a obligar a la descarga, si se omite solo se guarda en el directorio indicado antes
	//$csvcreate->descarga = 1;
	
	// llama al metodo de creacion de CSV				  
	$CrearTXT->crear();
	
	// crea el link de descarga
	echo "El archivo <a href='descargar_archivo.php?dir=$CrearTXT->path&arch=$CrearTXT->nombre_arch' class='seccion' title ='Click para abrir el archivo' > $CrearTXT->nombre_arch </a> se ha creado satisfactoriamente";


}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_cliente.tpl');   //define la plantilla que utilizara

	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="informes";
	$plantilla = "generar_txt_siap.tpl"; 
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>