<? 
session_start();   // Iniciar sesión
$usuario_sesion = $_SESSION['user_usuario']; //usuario conectado

//---------------------------------PAIS---------------------------------------------------------------------------------------//
$codigo_pais_bus = $_POST["codigo_pais_bus"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_pais_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM pais where cod_pais = $codigo_pais_bus"; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia

		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[1]);  //asigna una cadena a la variable "nombre"

		$modulo="abm_zonas_geo";
		$plantilla = "modificar_pais.tpl";
		include("validar_permiso.php");	
	}	
}

$codigo_pais_mod = $_POST["codigo_pais_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_pais_mod = $_POST["nombre_pais_mod"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_pais_mod){
		include("conexion.php");
		$nombre_pais_mod = strtoupper($nombre_pais_mod);
		$consulta = "SELECT * FROM pais where nombre ='$nombre_pais_mod' and cod_pais <> $codigo_pais_mod" ; // consulta sql                  where nombre = '$nombre'		
		$result = mysql_query($consulta);            // hace la consulta
   		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call modificar_pais($codigo_pais_mod,'$nombre_pais_mod')";
			$result = mysql_query($consulta);            // hace la consulta
			echo "ok";
		}
}
//---------------------------------PROVINCIA-------------------------------------------------------------------------------//
$codigo_prov_bus = $_POST["codigo_prov_bus"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_prov_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM provincia where cod_prov =$codigo_prov_bus"; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[2]);  //asigna una cadena a la variable "nombre"
		
		$modulo="abm_zonas_geo";
		$plantilla = "modificar_prov.tpl";
		include("validar_permiso.php");	
	}	
}

$codigo_prov_mod = $_POST["codigo_prov_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_prov_mod = $_POST["nombre_prov_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_pais_mod_prov = $_POST["nombre_pais_mod_prov"]; 		// toma la variable de la url q vino de ajax.js

if($codigo_prov_mod){
		include("conexion.php");
		$consulta = "SELECT * FROM pais where nombre = '$nombre_pais_mod_prov'"; // consulta sql
		
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_pais= $registro[0];
		$nombre_prov_mod = strtoupper($nombre_prov_mod);

		$consulta = "SELECT * FROM provincia where nombre ='$nombre_prov_mod' and cod_prov <> $codigo_prov_mod and cod_pais = $cod_pais" ; // consulta sql                  where nombre = '$nombre'		
		$result = mysql_query($consulta);            // hace la consulta
   		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion

				$consulta = "call modificar_provincia($codigo_prov_mod,'$nombre_prov_mod', $cod_pais)";
				$result = mysql_query($consulta);            // hace la consulta
				echo "ok";								//echo "Provincia Modificada!!";
		}
}
//---------------------------------LOCALIDAD-------------------------------------------------------------------------------//
$codigo_loca_bus = $_POST["codigo_loca_bus"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_loca_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM localidad where cod_localidad = $codigo_loca_bus"; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[3]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('cp',$registro[4]);  //asigna una cadena a la variable "nombre"
		//$smarty->display('modificar_localidad.tpl');  //define la plantilla que utilizara
		
		$modulo="abm_zonas_geo";
		$plantilla = "modificar_localidad.tpl";
		include("validar_permiso.php");	
	}	
}

$codigo_loca_mod = $_POST["codigo_loca_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_loca_mod = $_POST["nombre_loca_mod"]; 					// toma la variable de la url q vino de ajax.js
$cp_loca_mod = $_POST["cp_loca_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_prov_mod_prov = $_POST["nombre_prov_mod_prov"]; 		// toma la variable de la url q vino de ajax.js

if($codigo_loca_mod){
		include("conexion.php");
		$consulta = "SELECT * FROM provincia where nombre = '$nombre_prov_mod_prov'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_prov= $registro[0];
		$cod_pais= $registro[1];
		$nombre_loca_mod = strtoupper($nombre_loca_mod);
		
		$consulta = "SELECT * FROM localidad where nombre ='$nombre_loca_mod' and cod_localidad <> $codigo_loca_mod and cod_prov = $cod_prov" ; // consulta sql                  where nombre = '$nombre'		
		$result = mysql_query($consulta);            // hace la consulta
   		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
				
				$consulta = "call modificar_localidad($codigo_loca_mod,'$nombre_loca_mod', $cp_loca_mod, $cod_prov,$cod_pais)";
				$result = mysql_query($consulta);            // hace la consulta
				//echo $consulta;
				echo "ok";								//echo "Provincia Modificada!!";
		}
}
//---------------------------------ZONA-------------------------------------------------------------------------------//
$codigo_zona_bus = $_POST["codigo_zona_bus"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_zona_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM zona where cod_zona = $codigo_zona_bus"; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[4]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('porc_vta',$registro[5]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('porc_trans',$registro[6]);  //asigna una cadena a la variable "nombre"
		
		$modulo="abm_zonas_geo";
		$plantilla = "modificar_zona.tpl";
		include("validar_permiso.php");	
	}	
}

$codigo_zona_mod = $_POST["codigo_zona_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_zona_mod = $_POST["nombre_zona_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_loca_mod_zona = $_POST["nombre_loca_mod_zona"]; 		// toma la variable de la url q vino de ajax.js
$porc_vta_mod = $_POST["porc_vta_mod"]; 		// toma la variable de la url q vino de ajax.js
$porc_trans_mod = $_POST["porc_trans_mod"]; 		// toma la variable de la url q vino de ajax.js

if($codigo_zona_mod){
		include("conexion.php");
		$consulta = "SELECT * FROM localidad where nombre = '$nombre_loca_mod_zona'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_loca= $registro[0];		
		$cod_prov= $registro[1];
		$cod_pais= $registro[2];

		$consulta = "SELECT * FROM zona where nombre ='$nombre_zona_mod' and cod_zona <> $codigo_zona_mod and cod_localidad = $cod_loca and cod_prov = $cod_prov" ; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
   		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
				$nombre_zona_mod = strtoupper($nombre_zona_mod);
				$consulta = "call modificar_zona($codigo_zona_mod,$cod_loca,$cod_prov,$cod_pais,'$nombre_zona_mod', $porc_vta_mod,$porc_trans_mod)";
				$result = mysql_query($consulta);            // hace la consulta
				//echo $consulta;
				echo "ok";								//echo "Provincia Modificada!!";
		}
}
//---------------------------------IVA---------------------------------------------------------------------------------------//
$codigo_iva_bus = $_POST["codigo_iva_bus"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_iva_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM alicuota_iva where cod_iva = $codigo_iva_bus"; // consulta sql                  where nombre = '$nombre'		
	//echo $consulta;
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[1]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('tasa',$registro[2]);  //asigna una cadena a la variable "nombre"
		//$smarty->display('modificar_iva.tpl');  //define la plantilla que utilizara

		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_alicuotas";
		$plantilla = "modificar_iva.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}

$codigo_iva_mod = $_POST["codigo_iva_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_iva_mod = $_POST["nombre_iva_mod"]; 					// toma la variable de la url q vino de ajax.js
$tasa_iva_mod = $_POST["tasa_iva_mod"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_iva_mod){
		include("conexion.php");
		$nombre_iva_mod = strtoupper($nombre_iva_mod);
		$consulta = "SELECT * FROM alicuota_iva where nombre ='$nombre_iva_mod' and cod_iva <> $codigo_iva_mod" ; // consulta sql                  where nombre = '$nombre'		
		
		$result = mysql_query($consulta);            // hace la consulta
   		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call modificar_iva($codigo_iva_mod,'$nombre_iva_mod',$tasa_iva_mod)";
			$result = mysql_query($consulta);            // hace la consulta
			echo "ok";
		}
}
//---------------------------------IMPUESTO INTERNO--------------------------------------------------------------------------//
$codigo_ii_bus = $_POST["codigo_ii_bus"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_ii_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM imp_interno where cod_imp_interno =$codigo_ii_bus"; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[1]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('tasa',$registro[2]);  //asigna una cadena a la variable "nombre"
		//$smarty->display('modificar_ii.tpl');  //define la plantilla que utilizara

		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_alicuotas";
		$plantilla = "modificar_ii.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}

$codigo_ii_mod = $_POST["codigo_ii_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_ii_mod = $_POST["nombre_ii_mod"]; 					// toma la variable de la url q vino de ajax.js
$tasa_ii_mod = $_POST["tasa_ii_mod"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_ii_mod){
		include("conexion.php");
		$nombre_ii_mod = strtoupper($nombre_ii_mod);
		$consulta = "SELECT * FROM imp_interno where nombre ='$nombre_ii_mod' and cod_imp_interno <> $codigo_ii_mod" ; // consulta sql                  where nombre = '$nombre'		
		$result = mysql_query($consulta);            // hace la consulta
   		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call modificar_ii($codigo_ii_mod,'$nombre_ii_mod',$tasa_ii_mod)";
			$result = mysql_query($consulta);            // hace la consulta
			echo "ok";
		}
}
//---------------------------------PERCECPCION IVA--------------------------------------------------------------------------//
$codigo_pi_bus = $_POST["codigo_pi_bus"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_pi_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM perc_iva where cod_perc_iva = $codigo_pi_bus"; // consulta sql     
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[1]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('tasa',$registro[2]);  //asigna una cadena a la variable "nombre"
		//$smarty->display('modificar_pi.tpl');  //define la plantilla que utilizara
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_alicuotas";
		$plantilla = "modificar_pi.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}

$codigo_pi_mod = $_POST["codigo_pi_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_pi_mod = $_POST["nombre_pi_mod"]; 					// toma la variable de la url q vino de ajax.js
$tasa_pi_mod = $_POST["tasa_pi_mod"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_pi_mod){
		include("conexion.php");
		$nombre_pi_mod = strtoupper($nombre_pi_mod);
		$consulta = "SELECT * FROM perc_iva where nombre ='$nombre_pi_mod' and cod_perc_iva <> $codigo_pi_mod" ; // consulta sql                  where nombre = '$nombre'		
		$result = mysql_query($consulta);            // hace la consulta
   		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call modificar_pi($codigo_pi_mod,'$nombre_pi_mod',$tasa_pi_mod)";
			$result = mysql_query($consulta);            // hace la consulta
			echo "ok";
		}
}
//---------------------------------INGRESO BRUTO--------------------------------------------------------------------------//
$codigo_ib_bus = $_POST["codigo_ib_bus"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_ib_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM ing_bruto where cod_ing_bruto = $codigo_ib_bus"; // consulta sql    
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[1]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('tasa',$registro[2]);  //asigna una cadena a la variable "nombre"
		//$smarty->display('modificar_ib.tpl');  //define la plantilla que utilizara
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_alicuotas";
		$plantilla = "modificar_ib.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}

$codigo_ib_mod = $_POST["codigo_ib_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_ib_mod = $_POST["nombre_ib_mod"]; 					// toma la variable de la url q vino de ajax.js
$tasa_ib_mod = $_POST["tasa_ib_mod"]; 					// toma la variable de la url q vino de ajax.js
$prov_ib_mod = $_POST["prov_ib_mod"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_ib_mod){
		include("conexion.php");
		$nombre_ib_mod = strtoupper($nombre_ib_mod);
		
		$consulta_p = "SELECT cod_pais FROM provincia where cod_prov = $prov_ib_mod"; // consulta sql                  where nombre = '$nombre'
		$result_p = mysql_query($consulta_p);            // hace la consulta
		$registro_p = mysql_fetch_row($result_p);        // toma el registro
		$cod_pais=$registro_p[0];

		$consulta = "SELECT * FROM ing_bruto where nombre ='$nombre_ib_mod' and cod_prov = $prov_ib_mod and cod_pais = $cod_pais and cod_ing_bruto <> $codigo_ib_mod" ; // consulta sql                  where nombre = '$nombre'		
		$result = mysql_query($consulta);            // hace la consulta
   		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call modificar_ib($codigo_ib_mod,'$nombre_ib_mod',$tasa_ib_mod, $prov_ib_mod, $cod_pais)";
			$result = mysql_query($consulta);            // hace la consulta
			echo "ok";
		}
}
//--------------------------------- CONDICION IVA----------------------------------------------------------------------------//
$codigo_cond_iva_bus = $_POST["codigo_cond_iva_bus"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_cond_iva_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM iva where cod_iva = $codigo_cond_iva_bus"; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		//$smarty->assign('comp',$registro[1]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[2]);  //asigna una cadena a la variable "nombre"
		//$smarty->display('modificar_cond_iva.tpl');  //define la plantilla que utilizara
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_cond_iva";
		$plantilla = "modificar_cond_iva.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	
	}	
}
$codigo_cond_iva_mod = $_POST["codigo_cond_iva_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_cond_iva_mod = $_POST["nombre_cond_iva_mod"]; 					// toma la variable de la url q vino de ajax.js
$cod_comp_mod = $_POST["cod_comp_mod"]; 								// toma la variable de la url q vino de ajax.js
$requiere_cuit = $_POST["requiere_cuit"]; 								// toma la variable de la url q vino de ajax.js
$idnombre = $_POST["idnombre"]; 										// toma la variable de la url q vino de ajax.js

if($codigo_cond_iva_mod){
		include("conexion.php");
		$nombre_cond_iva_mod = strtoupper($nombre_cond_iva_mod);
		$consulta = "SELECT * FROM iva where nombre ='$nombre_cond_iva_mod' and cod_iva <> $codigo_cond_iva_mod" ; // consulta sql                  where nombre = '$nombre'		
		$result = mysql_query($consulta);            // hace la consulta
   		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call modificar_cond_iva($codigo_cond_iva_mod,$idnombre,'$nombre_cond_iva_mod','$cod_comp_mod','$requiere_cuit')";
			$result = mysql_query($consulta);            // hace la consulta
			//echo $consulta;
			echo "ok";
		}
}
//---------------------------------PROVEEDOR---------------------------------------------------------------------------------//
$codigo_proveedor = $_POST["codigo_proveedor"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_proveedor){
	include("conexion.php");
	$consulta = "SELECT * FROM proveedor where cod_proveedor = $codigo_proveedor"; // consulta sql  
	$result = mysql_query($consulta);            		// hace la consulta
   	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        		// toma el registro
	if ($nfilas > 0){     						 		// si existe el usuario inicia la sesion
		require("smarty.php");  				 		// requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 		//crea una instancia
		$smarty->assign('codigo',$registro[0]);  		//asigna una cadena a la variable
		$smarty->assign('razon',$registro[1]);  		//asigna una cadena a la variable
		
		$cuit=$registro[2];
		$cuit1=substr($cuit,0,2);
		$cuit2=substr($cuit,2,-1);
		$cuit3=substr($cuit,-1);
		
		$smarty->assign('cuit1',$cuit1);  			//asigna una cadena a la variable
		$smarty->assign('cuit2',$cuit2);  			//asigna una cadena a la variable
		$smarty->assign('cuit3',$cuit3);  			//asigna una cadena a la variable
		
		$smarty->assign('ingreso_bruto',$registro[3]);  //asigna una cadena a la variable
		$smarty->assign('direccion',$registro[4]);  	//asigna una cadena a la variable
		$smarty->assign('tel',$registro[5]);  			//asigna una cadena a la variable
		$smarty->assign('fax',$registro[6]);  			//asigna una cadena a la variable
		$smarty->assign('movil',$registro[7]);  		//asigna una cadena a la variable
		$smarty->assign('contacto',$registro[8]);  		//asigna una cadena a la variable
		$smarty->assign('web',$registro[9]);  			//asigna una cadena a la variable
		$smarty->assign('mail',$registro[10]);  		//asigna una cadena a la variable
		$smarty->assign('limite_cred',$registro[11]);   //asigna una cadena a la variable
		$agente=$registro[12];
		if ($agente == "S"){
			$smarty->assign('agente','checked');  		//asigna una cadena a la variable
		}else{
			$smarty->assign('agente','');  		//asigna una cadena a la variable
		}
		//$smarty->display('modificar_proveedor.tpl');  //define la plantilla que utilizara
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_proveedor";
		$plantilla = "modificar_proveedor.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}
								
$codigo_original = $_POST["codigo_original"]; 			// toma la variable de la url q vino de ajax.js
$codigo_proveedor_mod = $_POST["codigo_proveedor_mod"]; 			// toma la variable de la url q vino de ajax.js
$razon_proveedor_mod = $_POST["razon_proveedor_mod"]; 				// toma la variable de la url q vino de ajax.js
$cuit_proveedor_mod = $_POST["cuit_proveedor_mod"]; 				// toma la variable de la url q vino de ajax.js
$ing_bruto_proveedor_mod = $_POST["ing_bruto_proveedor_mod"]; 		// toma la variable de la url q vino de ajax.js
$iva_proveedor_mod = $_POST["iva_proveedor_mod"]; 					// toma la variable de la url q vino de ajax.js
$dir_proveedor_mod = $_POST["dir_proveedor_mod"]; 					// toma la variable de la url q vino de ajax.js
$pais_proveedor_mod = $_POST["pais_proveedor_mod"]; 				// toma la variable de la url q vino de ajax.js
$prov_proveedor_mod = $_POST["prov_proveedor_mod"]; 				// toma la variable de la url q vino de ajax.js
$localidad_proveedor_mod = $_POST["localidad_proveedor_mod"]; 		// toma la variable de la url q vino de ajax.js
$tel_proveedor_mod = $_POST["tel_proveedor_mod"]; 					// toma la variable de la url q vino de ajax.js
$fax_proveedor_mod = $_POST["fax_proveedor_mod"]; 					// toma la variable de la url q vino de ajax.js
$cel_proveedor_mod = $_POST["cel_proveedor_mod"]; 					// toma la variable de la url q vino de ajax.js
$web_proveedor_mod = $_POST["web_proveedor_mod"]; 					// toma la variable de la url q vino de ajax.js
$mail_proveedor_mod = $_POST["mail_proveedor_mod"]; 				// toma la variable de la url q vino de ajax.js
$contacto_proveedor_mod = $_POST["contacto_proveedor_mod"]; 		// toma la variable de la url q vino de ajax.js
$lim_cred_proveedor_mod = $_POST["lim_cred_proveedor_mod"];			// toma la variable de la url q vino de ajax.js
$agente_proveedor_mod = $_POST["agente_proveedor_mod"]; 			// toma la variable de la url q vino de ajax.js

if($codigo_proveedor_mod){
		include("conexion.php");
		$razon_proveedor_mod = strtoupper($razon_proveedor_mod);
		$dir_proveedor_mod = strtoupper($dir_proveedor_mod);	
		$web_proveedor_mod = strtoupper($web_proveedor_mod);	
		$mail_proveedor_mod = strtoupper($mail_proveedor_mod);		
		$contacto_proveedor_mod = strtoupper($contacto_proveedor_mod);	
		
		$consulta = "SELECT cod_pais FROM pais where pais.nombre = '$pais_proveedor_mod'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_pais_proveedor_mod= $registro[0];
		
		$consulta = "SELECT cod_prov FROM provincia where provincia.nombre = '$prov_proveedor_mod'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_prov_proveedor_mod= $registro[0];
		
		$consulta = "SELECT cod_localidad FROM localidad where localidad.nombre = '$localidad_proveedor_mod'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_loca_proveedor_mod= $registro[0];
		
		$consulta = "call modificar_proveedor($codigo_original,$codigo_proveedor_mod,'$razon_proveedor_mod','$cuit_proveedor_mod','$ing_bruto_proveedor_mod','$dir_proveedor_mod','$tel_proveedor_mod','$fax_proveedor_mod','$cel_proveedor_mod','$contacto_proveedor_mod','$web_proveedor_mod','$mail_proveedor_mod','$lim_cred_proveedor_mod','$agente_proveedor_mod','$iva_proveedor_mod',$cod_loca_proveedor_mod,$cod_prov_proveedor_mod,$cod_pais_proveedor_mod)"; // llama al procedimiento almacecnado
		//echo $consulta;
		if($result = mysql_query($consulta)){        // hace la consulta
			echo "ok";
		}
}
//---------------------------------VEHICULO---------------------------------------------------------------------------------//
$codigo_vehiculo = $_POST["codigo_vehiculo"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_vehiculo){
	include("conexion.php");
	$consulta = "SELECT * FROM vehiculo where cod_vehiculo = $codigo_vehiculo"; // consulta sql 
	$result = mysql_query($consulta);            		// hace la consulta
   	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        		// toma el registro
	if ($nfilas > 0){     						 		// si existe el usuario inicia la sesion
		require("smarty.php");  				 		// requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 		//crea una instancia
		$smarty->assign('codigo',$registro[0]);  		//asigna una cadena a la variable
		$smarty->assign('patente',$registro[1]);  		//asigna una cadena a la variable
		$smarty->assign('patente_a',$registro[2]);  		//asigna una cadena a la variable
		$smarty->assign('marca',$registro[3]);  		//asigna una cadena a la variable
		$smarty->assign('modelo',$registro[4]);  		//asigna una cadena a la variable
		$propiedad=$registro[5];
		if ($propiedad == "S"){
			$smarty->assign('propiedad','checked');  		//asigna una cadena a la variable
		}else{
			$smarty->assign('propiedad','');  		//asigna una cadena a la variable
		}
		//$smarty->display('modificar_vehiculo.tpl');  //define la plantilla que utilizara

		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_vehiculo";
		$plantilla = "modificar_vehiculo.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}

$cod_vehiculo_mod = $_POST["cod_vehiculo_mod"]; 			// toma la variable de la url q vino de ajax.js
if($cod_vehiculo_mod){
		$cod_vehiculo_mod_original = $_POST["cod_vehiculo_mod_original"]; 			// toma la variable de la url q vino de ajax.js
		$patente_mod = $_POST["patente_mod"]; 			// toma la variable de la url q vino de ajax.js
		$patente_a_mod = $_POST["patente_a_mod"]; 				// toma la variable de la url q vino de ajax.js
		$marca_mod = $_POST["marca_mod"]; 				// toma la variable de la url q vino de ajax.js
		$modelo_mod = $_POST["modelo_mod"]; 		// toma la variable de la url q vino de ajax.js
		$propio_mod = $_POST["propio_mod"]; 					// toma la variable de la url q vino de ajax.js
		
		include("conexion.php");
		$patente_mod = strtoupper($patente_mod);
		$patente_a_mod = strtoupper($patente_a_mod);	
		$marca_mod = strtoupper($marca_mod);	
		$modelo_mod = strtoupper($modelo_mod);		
		$propio_mod = strtoupper($propio_mod);	
		
		$nfilas = 0;
		if ($cod_vehiculo_mod_original != $cod_vehiculo_mod){
				$consulta = "SELECT * FROM vehiculo where cod_vehiculo = $cod_vehiculo_mod"; // consulta sql
				$result = mysql_query($consulta);            // hace la consulta
				$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		}else{
				$consulta = "SELECT * FROM vehiculo where cod_vehiculo <> $cod_vehiculo_mod_original and patente = '$patente_mod'"; // consulta sql
				$result = mysql_query($consulta);            // hace la consulta
				$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		}
				
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call modificar_vehiculo($cod_vehiculo_mod_original,$cod_vehiculo_mod,'$patente_mod','$patente_a_mod','$marca_mod','$modelo_mod','$propio_mod')"; // llama al procedimiento almacecnado
			//echo $consulta;
			$result = mysql_query($consulta);        // hace la consulta
			echo "ok";
		}
}
//---------------------------------REPARTIDOR---------------------------------------------------------------------------------//
$codigo_repartidor = $_POST["codigo_repartidor"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_repartidor){
	include("conexion.php");
	$consulta = "SELECT * FROM fletero where cod_flero = $codigo_repartidor"; // consulta sql 
	$result = mysql_query($consulta);            		// hace la consulta
   	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        		// toma el registro
	if ($nfilas > 0){     						 		// si existe el usuario inicia la sesion
		require("smarty.php");  				 		// requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 		//crea una instancia
		
		$smarty->assign('codigo',$registro[0]);  		//asigna una cadena a la variable
		$smarty->assign('dni',$registro[1]);  		//asigna una cadena a la variable
		$smarty->assign('nombre',$registro[2]);  		//asigna una cadena a la variable
		$smarty->assign('dir',$registro[3]);  		//asigna una cadena a la variable
		$smarty->assign('tel',$registro[4]);  		//asigna una cadena a la variable
		
		$cuit=$registro[5];
		$cuit1=substr($cuit,0,2);
		$cuit2=substr($cuit,2,-1);
		$cuit3=substr($cuit,-1);
		
		$smarty->assign('cuit1',$cuit1);  			//asigna una cadena a la variable
		$smarty->assign('cuit2',$cuit2);  			//asigna una cadena a la variable
		$smarty->assign('cuit3',$cuit3);  			//asigna una cadena a la variable
		
		//$smarty->display('modificar_repartidor.tpl');  //define la plantilla que utilizara
	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_repartidor";
		$plantilla = "modificar_repartidor.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}

$codigo_rep_orig_mod= $_POST["codigo_rep_orig_mod"]; 			// toma la variable de la url q vino de ajax.js
if($codigo_rep_orig_mod){
		$codigo = $_POST["codigo"]; 			// toma la variable de la url q vino de ajax.js
		$dni = $_POST["dni"]; 					// toma la variable de la url q vino de ajax.js
		$nombre = $_POST["nombre"]; 			// toma la variable de la url q vino de ajax.js
		$dir = $_POST["dir"]; 					// toma la variable de la url q vino de ajax.js
		$tel = $_POST["tel"]; 					// toma la variable de la url q vino de ajax.js
		$cuit = $_POST["cuit"]; 				// toma la variable de la url q vino de ajax.js
		$localidad = $_POST["localidad"]; 		// toma la variable de la url q vino de ajax.js
		$prov = $_POST["prov"]; 				// toma la variable de la url q vino de ajax.js
		$pais = $_POST["pais"]; 				// toma la variable de la url q vino de ajax.js
		$iva = $_POST["iva"]; 					// toma la variable de la url q vino de ajax.js
		$vehiculo = $_POST["vehiculo"]; 		// toma la variable de la url q vino de ajax.js
		
		include("conexion.php");
		$nombre = strtoupper($nombre);
		$dir = strtoupper($dir);	
		
		$consulta = "SELECT cod_pais FROM pais where pais.nombre = '$pais'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_pais= $registro[0];
			
		$consulta = "SELECT cod_prov FROM provincia where provincia.nombre = '$prov'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_prov= $registro[0];
			
		$consulta = "SELECT cod_localidad FROM localidad where localidad.nombre = '$localidad'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_loca= $registro[0];
			
		$consulta = "SELECT cod_talonario FROM iva where cod_iva = '$iva'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_talonario = $registro[0];
			
		$consulta = "call modificar_repartidor($codigo_rep_orig_mod,$codigo,$dni,'$nombre','$dir','$tel','$cuit',$cod_loca,$cod_prov,$cod_pais,$iva,'$cod_talonario')"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
			//echo $consulta;
			
		$consulta = "call modificar_repartidor_x_vehi($codigo,$vehiculo)"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		if(	$result = mysql_query($consulta)){            					// hace la consulta
			echo "ok";
		}
}
//---------------------------------VENDEDOR---------------------------------------------------------------------------------//
$codigo_vendedor = $_POST["codigo_vendedor"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_vendedor){
	include("conexion.php");
	$consulta = "SELECT * FROM vendedor where cod_vendedor = $codigo_vendedor"; // consulta sql
	$result = mysql_query($consulta);            		// hace la consulta
   	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        		// toma el registro
	if ($nfilas > 0){     						 		// si existe el usuario inicia la sesion
		require("smarty.php");  				 		// requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 		//crea una instancia
		
		$smarty->assign('codigo',$registro[0]);  		//asigna una cadena a la variable
		$smarty->assign('dni',$registro[1]);  		//asigna una cadena a la variable
		$smarty->assign('nombre',$registro[2]);  		//asigna una cadena a la variable
		$smarty->assign('dir',$registro[3]);  		//asigna una cadena a la variable
		$smarty->assign('tel',$registro[4]);  		//asigna una cadena a la variable
		
		//$smarty->display('modificar_vendedor.tpl');  //define la plantilla que utilizara

		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_vendedor";
		$plantilla = "modificar_vendedor.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}

$codigo_ven_orig_mod= $_POST["codigo_ven_orig_mod"]; 			// toma la variable de la url q vino de ajax.js
if($codigo_ven_orig_mod){
		$codigo = $_POST["codigo"]; 			// toma la variable de la url q vino de ajax.js
		$dni = $_POST["dni"]; 					// toma la variable de la url q vino de ajax.js
		$nombre = $_POST["nombre"]; 			// toma la variable de la url q vino de ajax.js
		$dir = $_POST["dir"]; 					// toma la variable de la url q vino de ajax.js
		$tel = $_POST["tel"]; 					// toma la variable de la url q vino de ajax.js
		$localidad = $_POST["localidad"]; 		// toma la variable de la url q vino de ajax.js
		$prov = $_POST["prov"]; 				// toma la variable de la url q vino de ajax.js
		$pais = $_POST["pais"]; 				// toma la variable de la url q vino de ajax.js
		
		include("conexion.php");
		$nombre = strtoupper($nombre);
		$dir = strtoupper($dir);	
		

		$consulta = "SELECT cod_pais FROM pais where pais.nombre = '$pais'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_pais= $registro[0];
			
		$consulta = "SELECT cod_prov FROM provincia where provincia.nombre = '$prov'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_prov= $registro[0];
			
		$consulta = "SELECT cod_localidad FROM localidad where localidad.nombre = '$localidad'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_loca= $registro[0];
			
		$consulta = "call modificar_vendedor($codigo_ven_orig_mod,$codigo,$dni,'$nombre','$dir','$tel',$cod_loca,$cod_prov,$cod_pais)"; // llama al procedimiento almacecnado
		if(	$result = mysql_query($consulta)){            					// hace la consulta
			echo "ok";
		}
}
//---------------------------------CATEGORIA-----------------------------------------------------------------------------------//
$codigo_cat_bus = $_POST["codigo_cat_bus"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_cat_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM categoria where cod_categoria =$codigo_cat_bus"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[1]);  //asigna una cadena a la variable "nombre"
		//$smarty->display('modificar_categoria.tpl');  //define la plantilla que utilizara
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_categoria";
		$plantilla = "modificar_categoria.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}
$codigo_cat_mod = $_POST["codigo_cat_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_cat_mod = $_POST["nombre_cat_mod"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_cat_mod){
		include("conexion.php");
		$nombre_cat_mod = strtoupper($nombre_cat_mod);
		$consulta = "SELECT * FROM categoria where descripcion = '$nombre_cat_mod'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		$registro = mysql_fetch_row($result);        // toma el registro
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call modificar_categoria($codigo_cat_mod,'$nombre_cat_mod')";
			if(	$result = mysql_query($consulta)){            					// hace la consulta
				echo "ok";
			}
		}
}
//---------------------------------CLIENTE---------------------------------------------------------------------------------//
$codigo_cliente = $_POST["codigo_cliente"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_cliente){
	include("conexion.php");
	$consulta = "SELECT * FROM cliente where cod_cliente = $codigo_cliente"; // consulta sql  
	$result = mysql_query($consulta);            		// hace la consulta
   	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        		// toma el registro
	if ($nfilas > 0){     						 		// si existe el usuario inicia la sesion
		require("smarty.php");  				 		// requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 		//crea una instancia
		$smarty->assign('codigo',$registro[0]);  		//asigna una cadena a la variable
		$smarty->assign('contacto',$registro[5]);  		//asigna una cadena a la variable
		$smarty->assign('razon',$registro[6]);  		//asigna una cadena a la variable
		$smarty->assign('tel',$registro[7]);  			//asigna una cadena a la variable
		$smarty->assign('fax',$registro[8]);  			//asigna una cadena a la variable		
		$smarty->assign('movil',$registro[9]);  		//asigna una cadena a la variable
		$smarty->assign('direccion',$registro[10]);  	//asigna una cadena a la variable		
		$smarty->assign('lim_cred',$registro[12]);   //asigna una cadena a la variable		
		$smarty->assign('web',$registro[13]);  			//asigna una cadena a la variable
		$smarty->assign('mail',$registro[14]);  		//asigna una cadena a la variable		
		
		$cuit=$registro[11];
		$cuit1=substr($cuit,0,2);
		$cuit2=substr($cuit,2,-1);
		$cuit3=substr($cuit,-1);
		$smarty->assign('cuit1',$cuit1);  			//asigna una cadena a la variable
		$smarty->assign('cuit2',$cuit2);  			//asigna una cadena a la variable
		$smarty->assign('cuit3',$cuit3);  			//asigna una cadena a la variable
		//$smarty->display('modificar_cliente.tpl');  //define la plantilla que utilizara
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_cliente";
		$plantilla = "modificar_cliente.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}
$codigo_original = $_POST["codigo_orig"]; 			// toma la variable de la url q vino de ajax.js

if($codigo_original){
		$codigo = $_POST["codigo"]; 			// toma la variable de la url q vino de ajax.js
		$razon = $_POST["razon"]; 				// toma la variable de la url q vino de ajax.js
		$cuit = $_POST["cuit"]; 				// toma la variable de la url q vino de ajax.js
		$iva = $_POST["iva"]; 					// toma la variable de la url q vino de ajax.js
		$dir = $_POST["dir"]; 					// toma la variable de la url q vino de ajax.js
		$pais = $_POST["pais"]; 				// toma la variable de la url q vino de ajax.js
		$prov = $_POST["prov"]; 				// toma la variable de la url q vino de ajax.js
		$localidad = $_POST["localidad"]; 		// toma la variable de la url q vino de ajax.js
		$zona = $_POST["zona"]; 				// toma la variable de la url q vino de ajax.js
		$tel = $_POST["tel"]; 					// toma la variable de la url q vino de ajax.js
		$fax = $_POST["fax"]; 					// toma la variable de la url q vino de ajax.js
		$cel = $_POST["cel"]; 					// toma la variable de la url q vino de ajax.js
		$web = $_POST["web"]; 					// toma la variable de la url q vino de ajax.js
		$mail = $_POST["mail"]; 				// toma la variable de la url q vino de ajax.js
		$contacto = $_POST["contacto"]; 		// toma la variable de la url q vino de ajax.js
		$lim_cred = $_POST["lim_cred"];			// toma la variable de la url q vino de ajax.js
		$categoria = $_POST["categoria"]; 		// toma la variable de la url q vino de ajax.js
		$vendedor = $_POST["vendedor"]; 		// toma la variable de la url q vino de ajax.js
		$repartidor = $_POST["repartidor"]; 	// toma la variable de la url q vino de ajax.js
		$fp = $_POST["fp"]; 	// toma la variable de la url q vino de ajax.js
		
		include("conexion.php");
		$razon = strtoupper($razon);
		$dir = strtoupper($dir);	
		$web = strtoupper($web);	
		$mail = strtoupper($mail);		
		$contacto = strtoupper($contacto);	
		
		$consulta = "SELECT cod_pais FROM pais where nombre = '$pais'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_pais= $registro[0];
		
		$consulta = "SELECT cod_prov FROM provincia where nombre = '$prov'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_prov= $registro[0];
		
		$consulta = "SELECT cod_localidad FROM localidad where nombre = '$localidad'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_loca= $registro[0];
		
		$consulta = "SELECT cod_zona FROM zona where nombre = '$zona'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_zona= $registro[0];
				
		$consulta = "SELECT cod_categoria FROM categoria where descripcion  = '$categoria'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_cat= $registro[0];

		$consulta = "SELECT cod_talonario FROM iva where cod_iva = '$iva'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_tal= $registro[0];


		$consulta = "call modificar_cliente($codigo_original,$codigo,'$razon','$cuit',$iva,'$dir',$cod_pais,$cod_prov,$cod_loca,$cod_zona,'$tel','$fax','$cel','$web','$mail','$contacto','$lim_cred',$cod_cat,$vendedor,$repartidor,'$cod_tal',$fp)"; // llama al procedimiento almacecnado
		if(	$result = mysql_query($consulta)){            					// hace la consulta
			echo "ok";
		}
}
//---------------------------------GRUPO---------------------------------------------------------------------------------------//
$codigo_grupo_bus = $_POST["codigo_grupo_bus"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_grupo_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM grupo where cod_grupo =$codigo_grupo_bus"; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[1]);  //asigna una cadena a la variable "nombre"
		//$smarty->display('modificar_grupo.tpl');  //define la plantilla que utilizara
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_articulo";
		$plantilla = "modificar_grupo.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}
$codigo_grupo_orig = $_POST["codigo_grupo_orig"]; 					// toma la variable de la url q vino de ajax.js
if($codigo_grupo_orig){
		$codigo_grupo_mod = $_POST["codigo_grupo_mod"]; 					// toma la variable de la url q vino de ajax.js
		$nombre_grupo_mod = $_POST["nombre_grupo_mod"]; 					// toma la variable de la url q vino de ajax.js
		
		include("conexion.php");
		$nombre_grupo_mod = strtoupper($nombre_grupo_mod);
		
		$consulta = "call modificar_grupo($codigo_grupo_orig, $codigo_grupo_mod,'$nombre_grupo_mod')";
		if(	$result = mysql_query($consulta)){            					// hace la consulta
			echo "ok";
		}
}
//---------------------------------MARCA---------------------------------------------------------------------------------------//
$codigo_marca_bus = $_POST["codigo_marca_bus"]; 					// toma la variable de la url q vino de ajax.js
$grupo = $_POST["grupo"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_marca_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM marca where cod_marca = $codigo_marca_bus and cod_grupo = $grupo"; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[2]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('grupo',$grupo[0]);  //asigna una cadena a la variable "nombre"
		//$smarty->display('modificar_marca.tpl');  //define la plantilla que utilizara
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_articulo";
		$plantilla = "modificar_marca.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}
$codigo_marca_orig = $_POST["codigo_marca_orig"]; 							// toma la variable de la url q vino de ajax.js
if($codigo_marca_orig){
		$codigo_marca_mod = $_POST["codigo_marca_mod"]; 					// toma la variable de la url q vino de ajax.js
		$nombre_marca_mod = $_POST["nombre_marca_mod"]; 					// toma la variable de la url q vino de ajax.js
		$cod_grupo_mod = $_POST["cod_grupo_mod"]; 							// toma la variable de la url q vino de ajax.js
		$cod_grupo_orig = $_POST["cod_grupo_orig"]; 						// toma la variable de la url q vino de ajax.js
	
		include("conexion.php");
		$nombre_marca_mod = strtoupper($nombre_marca_mod);
		$consulta = "call modificar_marca($codigo_marca_orig,$codigo_marca_mod,'$nombre_marca_mod',$cod_grupo_mod,$cod_grupo_orig)";
		//echo $consulta;
		if(	$result = mysql_query($consulta)){            					// hace la consulta
			echo "ok";
		}
}
//---------------------------------VARIEDAD------------------------------------------------------------------------------------//
$codigo_vari_bus = $_POST["codigo_vari_bus"]; 					// toma la variable de la url q vino de ajax.js
$marca = $_POST["marca"]; 					// toma la variable de la url q vino de ajax.js
$grupo = $_POST["grupo"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_vari_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM variedad where cod_variedad = $codigo_vari_bus and cod_marca=$marca and cod_grupo=$grupo"; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('marca',$registro[1]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('grupo',$registro[2]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[3]);  //asigna una cadena a la variable "nombre"

		//$smarty->display('modificar_variedad.tpl');  //define la plantilla que utilizara
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_articulo";
		$plantilla = "modificar_variedad.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}
$codigo_variedad_orig = $_POST["codigo_variedad_orig"]; 						// toma la variable de la url q vino de ajax.js
if($codigo_variedad_orig){
		$codigo_variedad_mod = $_POST["codigo_variedad_mod"]; 					// toma la variable de la url q vino de ajax.js
		$nombre_variedad_mod = $_POST["nombre_variedad_mod"]; 					// toma la variable de la url q vino de ajax.js
		$cod_grupo_mod = $_POST["cod_grupo_mod"]; 								// toma la variable de la url q vino de ajax.js
		$cod_marca_mod = $_POST["cod_marca_mod"]; 								// toma la variable de la url q vino de ajax.js
		$cod_grupo_orig = $_POST["cod_grupo_orig"]; 								// toma la variable de la url q vino de ajax.js
		$cod_marca_orig = $_POST["cod_marca_orig"]; 								// toma la variable de la url q vino de ajax.js
		include("conexion.php");
		$nombre_variedad_mod = strtoupper($nombre_variedad_mod);
		$consulta = "call modificar_variedad($codigo_variedad_orig,$codigo_variedad_mod,'$nombre_variedad_mod',$cod_grupo_mod,$cod_marca_mod,$cod_grupo_orig,$cod_marca_orig)";
		if($result = mysql_query($consulta)){ ;            // hace la consulta
			echo "ok";
		}
		//echo $consulta;
}
//---------------------------------MEDIDA-----------------------------------------------------------------------------------//
$codigo_med_bus = $_POST["codigo_med_bus"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_med_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM medida where cod_medida = $codigo_med_bus"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[1]);  //asigna una cadena a la variable "nombre"
		//$smarty->display('modificar_medida.tpl');  //define la plantilla que utilizara
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_articulo";
		$plantilla = "modificar_medida.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}
$codigo_med_mod = $_POST["codigo_med_mod"]; 					// toma la variable de la url q vino de ajax.js
$nombre_med_mod = $_POST["nombre_med_mod"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_med_mod){
		include("conexion.php");
		$nombre_med_mod = strtoupper($nombre_med_mod);
		$consulta = "SELECT * FROM medida where unidad_de_medida ='$nombre_med_mod' and cod_medida  <> $codigo_med_mod" ; // consulta sql 
		$result = mysql_query($consulta);            // hace la consulta
   		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call modificar_medida($codigo_med_mod,'$nombre_med_mod')";
			$result = mysql_query($consulta);            // hace la consulta
			echo "ok";
		}
}
//---------------------------------ARTICULO--------------------------------------------------------------------------------//
$codigo_art_bus = $_POST["codigo_art_bus"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_art_bus){
	$grupo = $_POST["grupo"]; 					// toma la variable de la url q vino de ajax.js
	$marca = $_POST["marca"]; 					// toma la variable de la url q vino de ajax.js
	$variedad = $_POST["variedad"]; 					// toma la variable de la url q vino de ajax.js
	include("conexion.php");
	$consulta = "SELECT * FROM producto where cod_prod = $codigo_art_bus and cod_variedad = $variedad and cod_marca = $marca and cod_grupo = $grupo"; // consulta sql 
	$result = mysql_query($consulta);           // hace la consulta
   	$nfilas = mysql_num_rows ($result);         //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);       // toma el registro
	if ($nfilas > 0){     						// si existe el usuario inicia la sesion
		require("smarty.php");  				// requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				//crea una instancia
		$smarty->assign('codigo',$registro[0]); //asigna una cadena a la variable "nombre"
		
		$smarty->assign('grupo',$grupo);  		//asigna una cadena a la variable "nombre"
		$smarty->assign('marca',$marca);  		//asigna una cadena a la variable "nombre"
		$smarty->assign('variedad',$variedad);  //asigna una cadena a la variable "nombre"
		
		$smarty->assign('desc',$registro[4]);   		//asigna una cadena a la variable "nombre"
		$smarty->assign('precio_costo',$registro[5]);   //asigna una cadena a la variable "nombre"
		$smarty->assign('stock_actual',$registro[7]);   //asigna una cadena a la variable "nombre"
		$smarty->assign('stock_min',$registro[8]);   	//asigna una cadena a la variable "nombre"
		$smarty->assign('stock_max',$registro[9]);   	//asigna una cadena a la variable "nombre"
		$smarty->assign('foto',$registro[10]);   		//asigna una cadena a la variable "nombre"
		$smarty->assign('medida',$registro[12]);   		//asigna una cadena a la variable "nombre"
		$smarty->assign('p_vta',$registro[14]);   		//asigna una cadena a la variable "nombre"
		$smarty->assign('p_trans',$registro[15]);   	//asigna una cadena a la variable "nombre"
		$smarty->assign('unidad_bulto',$registro[16]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('peso',$registro[17]);   		//asigna una cadena a la variable "nombre"
		
		//$smarty->display('modificar_articulo.tpl');  //define la plantilla que utilizara
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_articulo";
		$plantilla = "modificar_articulo.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}

$codigo_art_mod = $_POST["codigo_art_mod"]; 				// toma la variable de la url q vino de ajax.js

if($codigo_art_mod){
		include("conexion.php");
		include ("conexion_ftp.php");     // Incluiye biblioteca de funcion de conexion por ftp

		$codigo_art_mod_orig = $_POST["codigo_art_mod_orig"]; 					// toma la variable de la url q vino de ajax.js
		$grupo_orig = $_POST["grupo_orig"]; 				// toma la variable de la url q vino de ajax.js
		$marca_orig = $_POST["marca_orig"]; 				// toma la variable de la url q vino de ajax.js
		$variedad_orig = $_POST["variedad_orig"]; 			// toma la variable de la url q vino de ajax.js

		$variedad = $_POST["variedad"]; 					// toma la variable de la url q vino de ajax.js
		$marca = $_POST["marca"]; 							// toma la variable de la url q vino de ajax.js
		$grupo = $_POST["grupo"]; 							// toma la variable de la url q vino de ajax.js
		$desc = $_POST["desc"]; 							// toma la variable de la url q vino de ajax.js
		$precio_costo = $_POST["precio_costo"]; 			// toma la variable de la url q vino de ajax.js
		$envase = $_POST["envase"]; 						// toma la variable de la url q vino de ajax.js
		$stock_actual = $_POST["stock_actual"]; 			// toma la variable de la url q vino de ajax.js
		$stock_min = $_POST["stock_min"]; 					// toma la variable de la url q vino de ajax.js
		$stock_max = $_POST["stock_max"]; 					// toma la variable de la url q vino de ajax.js
		$foto = $_POST["foto"]; 							// toma la variable de la url q vino de ajax.js
		$proveedor = $_POST["proveedor"]; 					// toma la variable de la url q vino de ajax.js
		$medida = $_POST["medida"]; 						// toma la variable de la url q vino de ajax.js
		$cod_medida = $_POST["cod_medida"]; 				// toma la variable de la url q vino de ajax.js
		$porc_vta = $_POST["porc_vta"]; 					// toma la variable de la url q vino de ajax.js
		$porc_trans = $_POST["porc_trans"]; 				// toma la variable de la url q vino de ajax.js
		$unidad_bulto = $_POST["unidad_bulto"]; 			// toma la variable de la url q vino de ajax.js
		$peso = $_POST["peso"]; 							// toma la variable de la url q vino de ajax.js
		$iva = $_POST["iva"]; 							// toma la variable de la url q vino de ajax.js
		$desc = strtoupper($desc);
		
		$consulta = "call modificar_producto($codigo_art_mod_orig,$grupo_orig,$marca_orig,$variedad_orig,$codigo_art_mod,$variedad,$marca,$grupo,'$desc',$precio_costo,'$envase',$stock_actual,$stock_min,$stock_max,'$foto',$proveedor,$medida,$cod_medida,$porc_vta,$porc_trans,$unidad_bulto,$peso,$iva)";
		
		if($result = mysql_query($consulta)){            // hace la consulta
			//echo $consulta;
			//----------si tiene imagen renombra la carpeta en el servidor donde se ubica la imagen----//
			/*
			if($foto == 'S' && $codigo_art_mod_orig != $codigo_art_mod){
					$mydir = ftp_chdir($id_con, "fotos_articulos/"); 			  // Posicionarse en la carpeta personas".
					ftp_rename($id_con,$codigo_art_mod_orig,$codigo_art_mod); 	  // Renombro la carpeta en el servidor
					@ftp_site($id_con, "CHMOD 0777 ".$codigo_art_mod);            // Otorgo los permisos a la carpeta
					ftp_close($id_con);                                   		  // cierra la conexion FTP
			}
			*/
			echo "ok";	
		} // end if 
}
//---------------------------------FORMA DE PAGO------------------------------------------------------------------------------//
$codigo_fp_bus = $_POST["codigo_fp_bus"]; 					// toma la variable de la url q vino de ajax.js
if($codigo_fp_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM forma_pago where cod_fp=$codigo_fp_bus"; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('nombre',$registro[1]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('obs',$registro[2]);  //asigna una cadena a la variable "nombre"
		//$smarty->display('modificar_fp.tpl');  //define la plantilla que utilizara

		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_forma_pago";
		$plantilla = "modificar_fp.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}
$codigo_fp_mod = $_POST["codigo_fp_mod"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_fp_mod){
		include("conexion.php");
		$nombre_fp_mod = $_POST["nombre_fp_mod"]; 					// toma la variable de la url q vino de ajax.js
		$obs_fp_mod = $_POST["obs_fp_mod"]; 						// toma la variable de la url q vino de ajax.js

		$nombre_fp_mod = strtoupper($nombre_fp_mod);
		$obs_fp_mod = strtoupper($obs_fp_mod);
		$nfilas = 0;
		$consulta = "SELECT * FROM forma_pago where descripcion ='$nombre_fp_mod' and cod_fp <> $codigo_fp_mod" ; // consulta sql                  where nombre = '$nombre'		
		$result = mysql_query($consulta);            // hace la consulta
   		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call modificar_fp($codigo_fp_mod,'$nombre_fp_mod','$obs_fp_mod')";
			$result = mysql_query($consulta);            // hace la consulta
			echo "ok";
		}
}
//---------------------------------TIPO DE TALONARIO-------------------------------------------------------------------------//
$codigo_tt_bus = $_POST["codigo_tt_bus"]; 					// toma la variable de la url q vino de ajax.js
if($codigo_tt_bus){
	include("conexion.php");
	$codigo_tt_bus = strtoupper($codigo_tt_bus);
	$consulta = "SELECT * FROM tipo_talonario where cod_talonario = '$codigo_tt_bus'"; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('codigo',$registro[0]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('desc',$registro[1]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('cant',$registro[2]);  //asigna una cadena a la variable "nombre"
		//$smarty->display('modificar_tt.tpl');  //define la plantilla que utilizara

		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_comprobante";
		$plantilla = "modificar_tt.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}
$codigo_tt_orig_mod = $_POST["codigo_tt_orig_mod"]; 					// toma la variable de la url q vino de ajax.js
if($codigo_tt_orig_mod){

		include("conexion.php");
		$codigo_tt_mod = $_POST["codigo_tt_mod"]; 					// toma la variable de la url q vino de ajax.js
		$desc_tt_mod = $_POST["desc_tt_mod"]; 						// toma la variable de la url q vino de ajax.js
		$cant_tt_mod = $_POST["cant_tt_mod"]; 						// toma la variable de la url q vino de ajax.js		
		//$requiere_cuit_mod = $_POST["requiere_cuit_mod"]; 						// toma la variable de la url q vino de ajax.js		
		
		$codigo_tt_orig_mod = strtoupper($codigo_tt_orig_mod);
		$codigo_tt_mod = strtoupper($codigo_tt_mod);
		$desc_tt_mod = strtoupper($desc_tt_mod);
		//$requiere_cuit_mod = strtoupper($requiere_cuit_mod);
		
		$nfilas = 0;
		if($codigo_tt_orig_mod == $codigo_tt_mod){
				$consulta = "SELECT * FROM tipo_talonario where descripcion ='$desc_tt_mod' and cod_talonario <> '$codigo_tt_mod'" ; // consulta sql
		}else{
				$consulta = "SELECT * FROM tipo_talonario where (descripcion ='$desc_tt_mod' or cod_talonario = '$codigo_tt_mod') and cod_talonario <> '$codigo_tt_orig_mod'" ; // consulta sql
		}
		$result = mysql_query($consulta);            // hace la consulta
   		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call modificar_tipo_talonario('$codigo_tt_orig_mod','$codigo_tt_mod','$desc_tt_mod',$cant_tt_mod)"; //,'$requiere_cuit_mod'
			$result = mysql_query($consulta);            // hace la consulta
			echo "ok";
			//echo $consulta;
		}
}
//---------------------------------TALONARIO---------------------------------------------------------------------------------//
$codigo_tal_bus = $_POST["codigo_tal_bus"]; 					// toma la variable de la url q vino de ajax.js
$codigo_tt_bus_mod = $_POST["codigo_tt_bus_mod"]; 				// toma la variable de la url q vino de ajax.js	
if($codigo_tal_bus){
	include("conexion.php");
	$consulta = "SELECT * FROM talonario where cod_talonario = '$codigo_tt_bus_mod' and num_talonario = $codigo_tal_bus"; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia
		$smarty->assign('tipo',$codigo_tt_bus_mod);  //asigna una cadena a la variable "nombre"
		$smarty->assign('numero',$registro[1]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('sucursal',$registro[2]);  //asigna una cadena a la variable "nombre"
		
		//================================IMPRESORAS==================================================================================//
		$impresion=$registro[3];   									// obtiene el nombre y la info de la impresora
		$posicion_comodin = strrpos ($impresion, "#") + 1; 		
		$impresion = substr($impresion, $posicion_comodin); 		// obtiene solo la info de la impresora
		$smarty->assign('impresion',$impresion);  //asigna una cadena a la variable "nombre"
		//================================FIN DE IMPRESORAS============================================================================//
				
		$smarty->assign('iteracion',$registro[4]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('primer',$registro[5]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('ultimo',$registro[6]);  //asigna una cadena a la variable "nombre"
		$smarty->assign('sig',$registro[7]);  //asigna una cadena a la variable "nombre"
		$fecha=$registro[8];
		$dia=substr($fecha,0,2);
		$mes=substr($fecha,2,2);
		$ano=substr($fecha,-4);
		
		$smarty->assign('dia',$dia);  //asigna una cadena a la variable "nombre"
		$smarty->assign('mes',$mes);  //asigna una cadena a la variable "nombre"
		$smarty->assign('ano',$ano);  //asigna una cadena a la variable "nombre"
		$smarty->assign('cai',$registro[9]);  //asigna una cadena a la variable "nombre"
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_talonario";
		$plantilla = "modificar_talonario.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	}
}
$numero_tal_orig = $_POST["numero_tal_orig"]; 					// toma la variable de la url q vino de ajax.js
if($numero_tal_orig){
		$codigo_tt_orig = $_POST["codigo_tt_orig"]; 					// toma la variable de la url q vino de ajax.js
		$codigo_tt = $_POST["codigo_tt"]; 						// toma la variable de la url q vino de ajax.js
		$numero_tal = $_POST["numero_tal"]; 					// toma la variable de la url q vino de ajax.js
		$sucursal = $_POST["sucursal"]; 						// toma la variable de la url q vino de ajax.js
		$iteraciones = $_POST["iteraciones"]; 					// toma la variable de la url q vino de ajax.js
		$primer_num = $_POST["primer_num"]; 					// toma la variable de la url q vino de ajax.js
		$ultimo_num = $_POST["ultimo_num"]; 					// toma la variable de la url q vino de ajax.js
		$sig_num = $_POST["sig_num"]; 							// toma la variable de la url q vino de ajax.js
		$dia = $_POST["dia"]; 									// toma la variable de la url q vino de ajax.js
		$mes = $_POST["mes"]; 									// toma la variable de la url q vino de ajax.js
		$ano = $_POST["ano"]; 									// toma la variable de la url q vino de ajax.js
		$fecha_tal = $dia.$mes.$ano;
		$cai = $_POST["cai"]; 									// toma la variable de la url q vino de ajax.js
		$impr = $_POST["impr"]; 								// toma la variable de la url q vino de ajax.js
		include("conexion.php");
		$nfilas = 0;
		
		if($codigo_tt_orig  == $codigo_tt){
			if($numero_tal_orig != $numero_tal){
				$consulta = "SELECT * FROM talonario where num_talonario = $numero_tal and cod_talonario = '$codigo_tt'" ; // consulta sql
				$result = mysql_query($consulta);            // hace la consulta
				$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
			}
		}else{
			if($codigo_tt_orig == $codigo_tt){
				$consulta = "SELECT * FROM talonario where num_talonario = $numero_tal and cod_talonario = '$codigo_tt'" ; // consulta sql
				$result = mysql_query($consulta);            // hace la consulta
				$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
			}else{
				$consulta = "SELECT * FROM talonario where (num_talonario = $numero_tal and cod_talonario = '$codigo_tt') and cod_talonario <> '$codigo_tt_orig'" ; // consulta sql
				$result = mysql_query($consulta);            // hace la consulta
				$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
			}
		}
		//echo $consulta;
		
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call modificar_talonario('$codigo_tt_orig',$numero_tal_orig,'$codigo_tt',$numero_tal,$sucursal,$iteraciones,$primer_num,$ultimo_num,$sig_num,$fecha_tal,'$cai','$impr')";
			$result = mysql_query($consulta);            // hace la consulta
			echo "ok";
			//echo $consulta;
		}
}
//---------------------------------CANTIDAD ARTICULOS REMITO VENTA ** IN SITU ** ------------------------------------------------------------// 
$fila_art_rem_vta = $_POST["fila_art_rem_vta"]; 					// toma la variable de la url q vino de ajax.js

if($fila_art_rem_vta){
		$fila_art_rem_vta = substr($fila_art_rem_vta,2);
		$catidad = $_POST["catidad"]; 					// toma la variable de la url q vino de ajax.js
		include("conexion.php");
		$consulta = "call actualizar_cant_art_rem_vta('$usuario_sesion',$fila_art_rem_vta,$cantidad)";
		//echo $consulta;
		if($result = mysql_query($consulta)){            // hace la consulta
			echo "ok";
		}
}
//---------------------------------CANTIDAD ARTICULOS FACTURA VENTA ** IN SITU ** ------------------------------------------------------------// 
$fila_art_fact_vta = $_POST["fila_art_fact_vta"]; 					// toma la variable de la url q vino de ajax.js

if($fila_art_fact_vta){
		$fila_art_fact_vta = substr($fila_art_fact_vta,2);
		$catidad = $_POST["catidad"]; 					// toma la variable de la url q vino de ajax.js
		include("conexion.php");
		$consulta = "call actualizar_cant_art_fact_vta('$usuario_sesion',$fila_art_fact_vta,$cantidad)";
		//echo $consulta;
		if($result = mysql_query($consulta)){            // hace la consulta
		echo "ok";
		}
}
//--------------------------------- BONIFICACION ARTICULOS FACTURA VENTA ** IN SITU ** --------------------------------------------------------//
$fila_bonif_art_fact_vta = $_POST["fila_bonif_art_fact_vta"]; 					// toma la variable de la url q vino de ajax.js

if($fila_bonif_art_fact_vta){
		$fila_bonif_art_fact_vta = substr($fila_bonif_art_fact_vta,2);
		$bonif = $_POST["bonif"]; 					// toma la variable de la url q vino de ajax.js
		include("conexion.php");
		$consulta = "call actualizar_bonif_art_fact_vta('$usuario_sesion',$fila_bonif_art_fact_vta,$bonif)";
		//echo $consulta;
		if($result = mysql_query($consulta)){            // hace la consulta
		echo "ok";
		}
}
//---------------------------------CANTIDAD ARTICULOS DEVOLUCION ** IN SITU ** ------------------------------------------------------------//
$fila_art_dev = $_POST["fila_art_dev"]; 					// toma la variable de la url q vino de ajax.js

if($fila_art_dev){
		$vendedor_dev = $_POST["vendedor_dev"]; 					// toma la variable de la url q vino de ajax.js
		$fecha_carga_dev = $_POST["fecha_carga_dev"]; 					// toma la variable de la url q vino de ajax.js
		$catidad = $_POST["catidad"]; 					// toma la variable de la url q vino de ajax.js
		
		include("conexion.php");
		//=============================================== verifico qu la cantidad pedida sea menor a la facturada=======================//
		$consulta = "select sum(cantidad) from(
				SELECT sum(cantidad)as cantidad FROM factura_vta inner join factura_vta_detalle on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario where 
				concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca , factura_vta_detalle.cod_variedad , factura_vta_detalle.cod_prod) = 1111 and
				factura_vta.cod_vendedor = $vendedor_dev and fecha = $fecha_carga_dev and factura_vta.observacion <> 'anulado'
				UNION
				SELECT sum(cantidad)as cantidad FROM factura_vta_no_cliente inner join factura_vta_no_cliente_detalle on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario where 
				concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca , factura_vta_no_cliente_detalle.cod_variedad , factura_vta_no_cliente_detalle.cod_prod) = 1111 and
				factura_vta_no_cliente.cod_vendedor = $vendedor_dev and fecha = $fecha_carga_dev and factura_vta_no_cliente.observacion <> 'anulado'
				UNION
				SELECT sum(cantidad)as cantidad FROM remito_vta inner join remito_vta_detalle on remito_vta_detalle.num_remito = remito_vta.num_remito where 
				concat(remito_vta_detalle.cod_grupo, remito_vta_detalle.cod_marca , remito_vta_detalle.cod_variedad , remito_vta_detalle.cod_prod) = 1111 and
				remito_vta.cod_vendedor = $vendedor_dev and fecha = $fecha_carga_dev and remito_vta.observacion <> 'anulado'
				UNION
				SELECT sum(cantidad)as cantidad FROM remito_vta_no_cliente inner join remito_vta_detalle_no_cliente on remito_vta_detalle_no_cliente.num_remito = remito_vta_no_cliente.num_remito where 
				concat(remito_vta_detalle_no_cliente.cod_grupo, remito_vta_detalle_no_cliente.cod_marca , remito_vta_detalle_no_cliente.cod_variedad , remito_vta_detalle_no_cliente.cod_prod) = 1111 and
				remito_vta_no_cliente.cod_vendedor = $vendedor_dev and fecha = $fecha_carga_dev and remito_vta_no_cliente.observacion <> 'anulado') as cant_vta";  // obtiene el cod del remito
		$result = mysql_query($consulta);           														   
		$registro = mysql_fetch_row($result);        															
		$cant_vta = $registro[0]; 					// obtiene la letra que identifica al remito
		
		if($cant_vta >= $cantidad){			
			$consulta = "call actualizar_cant_art_devolucion('$usuario_sesion',$fila_art_dev,$cantidad)";
			//echo $consulta;
			if($result = mysql_query($consulta)){            // hace la consulta
				echo "ok";
			}
		}else{
				echo "maximo_superado"; 
		}		
	
}
//---------------------------------PRECIO ARTICULOS FACTURA COMPRA ** IN SITU ** ------------------------------------------------------------//
$fila_art_fact_compra = $_POST["fila_art_fact_compra"]; 					// toma la variable de la url q vino de ajax.js

if($fila_art_fact_compra){
		$precio = $_POST["precio"]; 					// toma la variable de la url q vino de ajax.js
		include("conexion.php");
		$consulta = "call actualizar_precio_art_fact_compra('$usuario_sesion',$fila_art_fact_compra,$precio)";
		//echo $consulta;
		if($result = mysql_query($consulta)){            // hace la consulta
			echo "ok";
		}
}
//--------------------------------- CANTIDAD ARTICULOS FACTURA VENTA ** IN SITU ** --------------------------------------------------------//
$fila_cant_art_fact_compra = $_POST["fila_cant_art_fact_compra"]; 					// toma la variable de la url q vino de ajax.js

if($fila_cant_art_fact_compra){
		$fila_cant_art_fact_compra = substr($fila_cant_art_fact_compra,2);
		$cant = $_POST["cant"]; 					// toma la variable de la url q vino de ajax.js
		include("conexion.php");
		$consulta = "call actualizar_cant_art_fact_compra('$usuario_sesion',$fila_cant_art_fact_compra,$cant)";
		//echo $consulta;
		if($result = mysql_query($consulta)){            // hace la consulta
			echo "ok";
		}
}
//--------------------------------- BONIFICACION ARTICULOS FACTURA VENTA ** IN SITU ** --------------------------------------------------------//
$fila_bonif_art_fact_compra = $_POST["fila_bonif_art_fact_compra"]; 					// toma la variable de la url q vino de ajax.js

if($fila_bonif_art_fact_compra){
		$fila_bonif_art_fact_compra = substr($fila_bonif_art_fact_compra,2);
		$bonif = $_POST["bonif"]; 					// toma la variable de la url q vino de ajax.js
		include("conexion.php");
		$consulta = "call actualizar_bonif_art_fact_compra('$usuario_sesion',$fila_bonif_art_fact_compra,$bonif)";
		//echo $consulta;
		if($result = mysql_query($consulta)){            // hace la consulta
			echo "ok";
		}
}
//--------------------------------- IMPORTE ARTICULOS FACTURA VENTA ** IN SITU ** --------------------------------------------------------//
$fila_importe_art_fact_compra = $_POST["fila_importe_art_fact_compra"]; 					// toma la variable de la url q vino de ajax.js

if($fila_importe_art_fact_compra){
		$fila_importe_art_fact_compra = substr($fila_importe_art_fact_compra,2);
		$importe = $_POST["importe"]; 					// toma la variable de la url q vino de ajax.js
		include("conexion.php");
		$consulta = "call actualizar_importe_art_fact_compra('$usuario_sesion',$fila_importe_art_fact_compra,$importe)";
		//echo $consulta;
		if($result = mysql_query($consulta)){            // hace la consulta
			echo "ok";
		}
}

//--------------------------------- ACTUALIZAR STOCK INICIAL --------------------------------------------------------//
$cod_art_stock_inicial = $_POST["cod_art_stock_inicial"]; 					// toma la variable de la url q vino de ajax.js

if($cod_art_stock_inicial){
		$cantidad = $_POST["cant_art_stock_inicial"]; 					// toma la variable de la url q vino de ajax.js
		include("conexion.php");
		$consulta = "call modificar_stock($cod_art_stock_inicial, $cantidad)";
		//echo $consulta;
		if($result = mysql_query($consulta)){            // hace la consulta
			echo "ok";
		}
}

//---------------------------------USUARIOS---------------------------------------------------------------------------------//
$codigo_usuario = $_POST["codigo_usuario"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_usuario){
	include("conexion.php");
	$consulta = "SELECT * FROM usuario where cod_usuario = $codigo_usuario"; // consulta sql  
	$result = mysql_query($consulta);            		// hace la consulta
   	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        		// toma el registro
	if ($nfilas > 0){     						 		// si existe el usuario inicia la sesion
		require("smarty.php");  				 		// requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 		//crea una instancia
		
		$smarty->assign('codigo',$registro[0]);  		//asigna una cadena a la variable
		$smarty->assign('usuario',$registro[1]);  		//asigna una cadena a la variable
		$smarty->assign('clave',$registro[2]);  		//asigna una cadena a la variable
		$smarty->assign('nombre',$registro[3]);  			//asigna una cadena a la variable
		//==============PERMISOS=============//
		$abm_zonas_geo=$registro[4];
		$abm_alicuotas=$registro[5];
		$abm_comprobante=$registro[6];
		
		$abm_cond_iva=$registro[7];
		$abm_talonario=$registro[8];
		$abm_proveedor=$registro[9];
		
		$abm_vehiculo=$registro[10];	
		$abm_repartidor=$registro[11];	
		$abm_vendedor=$registro[12];		
		
		$abm_categoria=$registro[13];		
		$abm_forma_pago=$registro[14];		
		$abm_cliente=$registro[15];		
		
		$abm_articulo=$registro[16];
		$datos_empresa=$registro[17];
		$conf_listados=$registro[18];				
		
		$abm_usuarios=$registro[19];
		$stock=$registro[20];
		$factura_compra=$registro[21];				
		
		$remito_vta=$registro[22];
		$factura_vta=$registro[23];		
		$nota_credito=$registro[24];

		$cta_cte=$registro[25];
		$comisiones=$registro[26];
		$devoluciones=$registro[27];				
		$finalizar_carga=$registro[28];

		$informes=$registro[29];
		$estadisticas=$registro[30];				
		$utilidades=$registro[31];

		$estado=$registro[32]; 

				if($abm_zonas_geo == 'S'){
						$smarty->assign('abm_zonas_geo','checked');  			//asigna una cadena a la variable		
				}
				if($abm_alicuotas == 'S'){
						$smarty->assign('abm_alicuotas','checked');  		//asigna una cadena a la variable
				}
				if($abm_comprobante == 'S'){
						$smarty->assign('abm_comprobante','checked');  	//asigna una cadena a la variable		
				}
				if($abm_cond_iva == 'S'){
						$smarty->assign('abm_cond_iva','checked');   //asigna una cadena a la variable		
				}
				if($abm_talonario == 'S'){
						$smarty->assign('abm_talonario','checked');  			//asigna una cadena a la variable
				}
				if($abm_proveedor == 'S'){
						$smarty->assign('abm_proveedor','checked');  		//asigna una cadena a la variable		
				}
				if($abm_vehiculo == 'S'){
						$smarty->assign('abm_vehiculo','checked');  			//asigna una cadena a la variable		
				}
				if($abm_repartidor == 'S'){
						$smarty->assign('abm_repartidor','checked');  		//asigna una cadena a la variable
				}
				if($abm_vendedor == 'S'){
						$smarty->assign('abm_vendedor','checked');  	//asigna una cadena a la variable		
				}
				if($abm_categoria == 'S'){
						$smarty->assign('abm_categoria','checked');   //asigna una cadena a la variable		
				}
				if($abm_forma_pago == 'S'){
						$smarty->assign('abm_forma_pago','checked');  			//asigna una cadena a la variable
				}
				if($abm_cliente == 'S'){
						$smarty->assign('abm_cliente','checked');  		//asigna una cadena a la variable		
				}
				if($abm_articulo == 'S'){
						$smarty->assign('abm_articulo','checked');  			//asigna una cadena a la variable		
				}
				if($datos_empresa == 'S'){
						$smarty->assign('datos_empresa','checked');  		//asigna una cadena a la variable
				}
				if($conf_listados == 'S'){
						$smarty->assign('conf_listados','checked');  	//asigna una cadena a la variable		
				}
				if($abm_usuarios == 'S'){
						$smarty->assign('abm_usuarios','checked');   //asigna una cadena a la variable		
				}
				if($stock == 'S'){
						$smarty->assign('stock','checked');  			//asigna una cadena a la variable
				}
				if($factura_compra == 'S'){
						$smarty->assign('factura_compra','checked');  		//asigna una cadena a la variable		
				}
				if($remito_vta == 'S'){
						$smarty->assign('remito_vta','checked');  			//asigna una cadena a la variable		
				}
				if($factura_vta == 'S'){
						$smarty->assign('factura_vta','checked');  		//asigna una cadena a la variable
				}
				if($nota_credito == 'S'){
						$smarty->assign('nota_credito','checked');  	//asigna una cadena a la variable		
				}
				
				if($cta_cte == 'S'){
						$smarty->assign('cta_cte','checked');  	//asigna una cadena a la variable		
				}
				
				if($comisiones == 'S'){
						$smarty->assign('comisiones','checked');   //asigna una cadena a la variable		
				}
				if($devoluciones == 'S'){
						$smarty->assign('devoluciones','checked');  			//asigna una cadena a la variable
				}
				if($finalizar_carga == 'S'){
						$smarty->assign('finalizar_carga','checked');  		//asigna una cadena a la variable		
				}
				if($informes == 'S'){
						$smarty->assign('informes','checked');   //asigna una cadena a la variable		
				}
				if($estadisticas == 'S'){
						$smarty->assign('estadisticas','checked');  			//asigna una cadena a la variable
				}
				if($utilidades == 'S'){
						$smarty->assign('utilidades','checked');  		//asigna una cadena a la variable		
				}

		$smarty->display('modificar_usuario.tpl');  //define la plantilla que utilizara 
	}	
}

$codigo_usuario_mod = $_POST["codigo_usuario_mod"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_usuario_mod){
	$nombre = $_POST["nombre"]; 					// toma la variable de la url q vino de ajax.js
	$usuario_reg = $_POST["usuario"]; 							// toma la variable de la url q vino de ajax.js
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

	include("conexion.php");
	$nombre = strtoupper($nombre);
	
	$consulta = "SELECT * FROM usuario where usuario = '$usuario_reg' and cod_usuario <> $codigo_usuario_mod" ; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	if ($nfilas == 0){     						 // si existe el usuario inicia la sesion 
		$consulta = "call modificar_usuario($codigo_usuario_mod, '$usuario_reg','$nombre','$abm_zonas_geo','$abm_alicuotas','$abm_comprobante','$abm_cond_iva','$abm_talonario','$abm_proveedor','$abm_vehiculo','$abm_repartidor','$abm_vendedor','$abm_categoria','$abm_forma_pago','$abm_cliente','$abm_articulo','$datos_empresa','$conf_listados','$abm_usuarios','$stock','$factura_compra','$remito_vta','$factura_vta','$nota_credito','$cta_cte','$comisiones','$devoluciones','$finalizar_carga','$informes','$estadisticas','$utilidades')"; // llama al procedimiento almacecnado
		if($result == mysql_query($consulta)){;        // hace la consulta
			echo "ok";
		}
	}
}
//---------------------------------AGENDA---------------------------------------------------------------------------------//
$codigo_persona_agenda = $_POST["codigo_persona_agenda"]; 					// toma la variable de la url q vino de ajax.js

if($codigo_persona_agenda){
	include("conexion.php");
	$consulta = "SELECT * FROM agenda where id = $codigo_persona_agenda"; // consulta sql 
	$result = mysql_query($consulta);            		// hace la consulta
   	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        		// toma el registro
	if ($nfilas > 0){     						 		// si existe el usuario inicia la sesion
		require("smarty.php");  				 		// requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 		//crea una instancia
		$smarty->assign('codigo',$registro[0]);  		//asigna una cadena a la variable
		$smarty->assign('nombre',$registro[1]);  		//asigna una cadena a la variable
		$smarty->assign('telefono',$registro[2]);  		//asigna una cadena a la variable
		$smarty->assign('correo',$registro[3]);  		//asigna una cadena a la variable
		//$smarty->display('modificar_vehiculo.tpl');  //define la plantilla que utilizara

		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="utilidades";
		$plantilla = "modificar_agenda.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}	
}

$codigo_persona_agenda_mod = $_POST["codigo_persona_agenda_mod"]; 			// toma la variable de la url q vino de ajax.js
if($codigo_persona_agenda_mod){
//variables="codigo_persona_agenda_mod="+txtcodigo.value+"&nombre_persona_agenda_mod="+txtnombre.value+"&tel_persona_agenda_mod="+txttel.value+"&correo_persona_agenda_mod="+txtcorreo.value;

		$nombre_persona_agenda_mod = $_POST["nombre_persona_agenda_mod"]; 			// toma la variable de la url q vino de ajax.js
		$tel_persona_agenda_mod = $_POST["tel_persona_agenda_mod"]; 			// toma la variable de la url q vino de ajax.js
		$correo_persona_agenda_mod = $_POST["correo_persona_agenda_mod"]; 				// toma la variable de la url q vino de ajax.js
		
		include("conexion.php");
		$nombre_persona_agenda_mod = strtoupper($nombre_persona_agenda_mod);
		
		$consulta = "call modificar_persona_agenda($codigo_persona_agenda_mod,'$nombre_persona_agenda_mod','$tel_persona_agenda_mod','$correo_persona_agenda_mod')"; // llama al procedimiento almacecnado
		//echo $consulta;
		$result = mysql_query($consulta);        // hace la consulta
		echo "ok";

}


//---------------------------------CANTIDAD ARTICULOS PRESUPUESTO VENTA ** IN SITU ** ------------------------------------------------------------// 
$fila_art_presu_vta = $_POST["fila_art_presu_vta"]; 					// toma la variable de la url q vino de ajax.js

if($fila_art_presu_vta){
		$fila_art_presu_vta = substr($fila_art_presu_vta,2);
		$catidad = $_POST["catidad"]; 					// toma la variable de la url q vino de ajax.js
		include("conexion.php");
		$consulta = "call actualizar_cant_art_presupuesto_vta('$usuario_sesion',$fila_art_presu_vta,$cantidad)";
		//echo $consulta;
		if($result = mysql_query($consulta)){            // hace la consulta
		echo "ok";
		}
}

//--------------------------------- BONIFICACION ARTICULOS PRESUPUESTO VENTA ** IN SITU ** --------------------------------------------------------//
$fila_bonif_art_presu_vta = $_POST["fila_bonif_art_presu_vta"]; 					// toma la variable de la url q vino de ajax.js

if($fila_bonif_art_presu_vta){
		$fila_bonif_art_presu_vta = substr($fila_bonif_art_presu_vta,2);
		$bonif = $_POST["bonif"]; 					// toma la variable de la url q vino de ajax.js
		include("conexion.php");
		$consulta = "call actualizar_bonif_art_presupuesto_vta('$usuario_sesion',$fila_bonif_art_presu_vta,$bonif)";
		//echo $consulta;
		if($result = mysql_query($consulta)){            // hace la consulta
		echo "ok";
		}
}

?>