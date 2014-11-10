<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//	Paginaci�n de resultados de consultas a MySql con PHP y AJAX								  //
//																								  //
//	Versi�n : 1.0.0	(29/04/2007) - Versi�n inicial												  //
//																								  //
//	Nombre de los archivos : paginador.php - js paginador.js									  //
//																								  // 
//	Autor : Benitez Carlos Alberto	<cabenitez@gmail.com>  										  //	
//																								  //
//	Descripci�n :																				  //
//		Devuelve el resultado de una consulta sql por p�ginas, 									  //
//		as� como los enlaces de navegaci�n respectivos. Este script ha sido pensado				  //
//		con fines did�cticos, por eso la gran cantidad de comentarios.							  //
//																								  //
//	Licencia : 												  									  //
//		GPL con las siguientes extensiones:														  //
// 			*Uselo con el fin personal o lucrativo												  //
//			*Si mejora el c�digo o encuentra errores, envieme un mail							  //
//																								  //
//	Documentaci�n y ejemplo de uso:		http://www.cabenitez.com.ar								  //
////////////////////////////////////////////////////////////////////////////////////////////////////

include("conexion.php");



//-----------------------Cuando se navega por el paginador este ya captura la consulta sql--------------------//
$pag_consulta = isset($_POST["pag_consulta_ajax"])?$_POST["pag_consulta_ajax"]:$pag_consulta;

//echo "<br>".$pag_consulta."<br>";

//----------------------- Establece unn patron para la consulta sql-------------------------------------------//
$pag_consulta = str_replace("@@","'",$pag_consulta);

//$pag_consulta = str_replace("##","+",$pag_consulta);

//----------------------- Establece de donde viene la consulta------------------------------------------------//
$pag_origen = $_SERVER['PHP_SELF'];				// obtiene la ruta del archivo que incluye la paginacion
$posicion_barra = strrpos ($pag_origen, "/") + 1; 		
$pag_origen = substr($pag_origen, $posicion_barra); 		// obtiene solo el nombre de la pagina

//----------------------- Verificaci�n de los par�metros------------------------------------------------------//
if(empty($pag_consulta)){						// Si no se defini� la consulta sql 	
	die("<b>Error de Paginacion : </b>No se ha definido la consulta sql: 'pag_consulta'");	
}
if(!empty($pag_tamano_extra)){							// Si no se ha especificado la cantidad de registros por p�gina por defecto ser� de 10
	$pag_tamano = $pag_tamano_extra; 						 	
}

//-----------------------Establece de la p�gina inicial------------------------------------------------------//
if (empty($_POST['limit'])){
	$pag_inicial = 0; 					     	// Si no se ha hecho click a ninguna p�gina espec�fica
 }else{
   	$pag_inicial = $_POST['limit'];		     	// Si se "pidi�" una p�gina espec�fica
 }

//-----------------------Establece del separador-------------------------------------------------------------//
if(!isset($pag_separador)){
	$pag_separador = " | ";						// Si no se ha elegido un separador se toma el separador por defecto.
}
 
//----------------------Ejecuta la senetencia SQL-------------------------------------------------------------//
//echo "<br>".$pag_consulta."<br>";
$pag_result = mysql_query($pag_consulta);    	// hace la consulta
$pag_filas = mysql_num_rows($pag_result);   	//indica la cantidad de resultados

//----------------------Obtiene el numero de paginas----------------------------------------------------------//
$total_paginas = ceil($pag_filas/$pag_tamano);

//----------------------Obtiene la pagina actual--------------------------------------------------------------//
if ($pag_inicial > 0){
	$pag_actual = ceil($pag_inicial/$pag_tamano)+1;
}else{
	$pag_actual = 1;
}
//----------------------info de paginas----------------------------------------------------------------------//
$pag_desde = $pag_tamano * ($pag_actual-1) + 1;			// N�mero del primer registro de la p�gina actual
$pag_hasta = $pag_desde + $pag_tamano -1; 				// N�mero del �ltimo registro de la p�gina actual

if($pag_hasta > $pag_filas){							// Si estamos en la �ltima p�gina
 	$pag_hasta = $pag_filas;							// El ultimo registro de la p�gina actual ser� igual al n�mero de registros.
}
//<img src='../imagenes/flecha_abajo.gif'>       imagen flecha abajo 

$pag_info = "Resultado de la Busqueda: <b>$nombre</b> <img src='../imagenes/flecha_abajo.gif'> Total <b> $pag_filas </b> Registros - Desde el <b>$pag_desde</b> hasta el <b>$pag_hasta</b>"; 
$pag_info = "<div class='$estilo_pag_info'>$pag_info</div>"."<br>";  //info de paginacion

//----------------------crea la barra de navegacion----------------------------------------------------------//

if ($total_paginas > 1){ 						// si la cantidad de registros es menor a la cantidad q se debe mostrar
	
	$pag_navegacion ="<br>"."<div class='$estilo_pag_nav'>"; 
		$comdbl='"';
		//$pag_consulta = "select * from cliente where cod_cliente > 5+1";
		 //echo "<br>".$pag_consulta."<br>";
		 $pag_consulta = str_replace("'","@@",$pag_consulta);
		 //$pag_consulta = str_replace("+","##",$pag_consulta);
		
		 //echo "<br>".$pag_inicio."<br>";
		//$pag_navegacion .=" "."<span  onClick=$comdbl paginar('$pag_origen','$pag_consulta','$pag_inicio','$nombre')$comdbl> >>| </span>";
		
		$pag_navegacion .=" "."<span  class='botones' onClick=$comdbl paginar('$pag_origen','$pag_consulta','0','$nombre')$comdbl> |<< </span>";	// PRIMER PAGINA

		$anterior=(($pag_actual-1)*$pag_tamano) - $pag_tamano;// PAGINA SIGUIENTE
		if($anterior > -$pag_tamano){
				$pag_navegacion .=" "."<span  class='botones' onClick=$comdbl paginar('$pag_origen','$pag_consulta','$anterior','$nombre')$comdbl> << </span>";	
		}else{
				$pag_navegacion .=" "."<span  class='botones'> << </span>";																					
		}

		for ($pagina = 1; $pagina <= $total_paginas; $pagina++) {
				if ($pagina > 1){ 
						$pag_inicio= $pag_tamano * ($pagina-1);
				}else{ 
						$pag_inicio= "0";
				}
	 				
				if ($pagina == $pag_actual){
						$pag_navegacion .=" "."<span class='$estilo_pag_actual' onClick=$comdbl paginar('$pag_origen','$pag_consulta','$pag_inicio','$nombre')$comdbl>$pagina</span>";
						//echo "<br>".$pag_actual.' pag_actual'."<br>".$pag_inicio.' pag_inicio'.'<br>'.$pag_tamano.' pag_tamano';
				}else{
						$pag_navegacion .=" "."<span  onClick=$comdbl paginar('$pag_origen','$pag_consulta','$pag_inicio','$nombre')$comdbl>$pagina</span>";
				}	
		}

		$sig=(($pag_actual-1)*$pag_tamano) + $pag_tamano;// PAGINA SIGUIENTE
		if($sig < $pag_inicio+$pag_tamano){
				$pag_navegacion .=" "."<span  class='botones' onClick=$comdbl paginar('$pag_origen','$pag_consulta','$sig','$nombre')$comdbl> >> </span>";	
		}else{
				$pag_navegacion .=" "."<span  class='botones'> >> </span>";																					
		}
	
		$pag_navegacion .=" "."<span  class='botones' onClick=$comdbl paginar('$pag_origen','$pag_consulta','$pag_inicio','$nombre')$comdbl> >>| </span>";	// ULTIMA PAGINA



	$pag_consulta = str_replace("@@","'",$pag_consulta);
	//$pag_consulta = str_replace("##","+",$pag_consulta);
	
	$pag_navegacion .="</div>"."<br>";
}

//----------------------Ejecuta la senetencia SQL paginada---------------------------------------------------//
 $pag_consulta = $pag_consulta." limit $pag_inicial , $pag_tamano";
 //echo "<br>".$pag_consulta."<br>";			
$pag_result = mysql_query($pag_consulta);    	// devuelve los resultados en la variable  $pag_result
?>