<?
$tabla = $_POST["tabla"]; 									 // toma la variable de la url q vino de ajax.js
if($tabla){
	//===================== TOMA LAS VARIABLES DE JS============================//
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

	
	require_once('class_txt/inc.crear_txt.php');  		 // clase CVS
	include("conexion.php"); 			    				 // conexion DB
	
	// crea una instancia
	$CrearTXT = new CrearTXT($host, $db, $usuario, $clave); 		
	
	// asigna el directorio de destino, la clase 1º crea el directorio y escribe el archivo *.CSV dentro de este
	$CrearTXT->path = './txt/';
	
	//**************************************************************//
	if($tabla == 'referencia'){ 
		// asigna el nombre del archivo
		$CrearTXT->nombre_arch = 'D00005546001REFE'.$fecha_desde_mostrar.'.txt';	
	
		// asigna la consulta
		$CrearTXT->consulta = "select concat('REFE','$fecha_desde_mostrar','$fecha_hasta_mostrar','$fecha_actual_mostrar'),'00005546', '001', cod_cliente ,'$fecha_hasta_sep_mostrar', 'A', cuit, razon_social, razon_social as razon, cod_talonario, 1, 0, direccion, localidad.nombre, cod_vendedor as vendedor, tel as telefono, cliente.cod_pais as lista, orden, cliente.cod_pais as ramo, localidad.nombre as localidad 
								from cliente inner join (zona inner join localidad on localidad.cod_localidad = zona.cod_localidad) on zona.cod_zona = cliente.cod_zona
								where cliente.activo = 'S' and orden > 0 order by vendedor, orden";
	
	//**************************************************************//
	}elseif($tabla == 'ventas'){
		// asigna el nombre del archivo
		$CrearTXT->nombre_arch = 'Articulos.csv';	
	
		// asigna la consulta
		$CrearTXT->consulta = "select concat(producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod)as codigo, 
								producto.descripcion, precio_vta as lista1, precio_vta as lista2, precio_vta as lista3, precio_vta as lista4, 
								precio_vta as lista5, marca.descripcion as linea,  producto.cod_grupo as rubro,
								' ' as capacidad ,unidad_bulto as pack
								from prod_por_categ  inner join (producto inner join (variedad inner join marca 
								on marca.cod_marca = variedad. cod_marca and marca.cod_grupo = variedad.cod_grupo)
								on variedad.cod_variedad = producto.cod_variedad and  variedad.cod_marca = producto. cod_marca and variedad.cod_grupo = producto.cod_grupo)
								on concat(producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod) = concat(prod_por_categ.cod_grupo,prod_por_categ.cod_marca,prod_por_categ.cod_variedad,prod_por_categ.cod_prod)
								where producto.activo = 'S'";
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
	$plantilla = "generar_txt.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>