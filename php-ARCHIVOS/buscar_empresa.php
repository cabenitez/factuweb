<?
$plantilla = $_POST["plantilla"];			 // muestra la plantilla de alta de empresa

if(empty($plantilla)){							 // determina si se ha registrado una empresa en el sistema
	include("conexion.php");
	$consulta = "SELECT * FROM empresa"; 		 // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	//$registro = mysql_fetch_row($result);        // toma el registro
	echo $nfilas;
}else{
	switch ($plantilla){
			case 'alta':
				require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
				$smarty = new ClaseSmarty; 				 //crea una instancia
				$smarty->display('alta_empresa.tpl');    //define la plantilla que utilizara
				break;
			case 'mostrar':							// muestra la info de la empresa ya registrada para modificarla
				include("conexion.php");
				$consulta = "SELECT * FROM empresa"; 	 // consulta sql
				$result = mysql_query($consulta);    	 // hace la consulta
				$registro = mysql_fetch_row($result);	 // toma el registro
				require("smarty.php");  			 	 // requiere la pag "include.php" para crear una instancia de Smarty
				$smarty = new ClaseSmarty; 				 //crea una instancia
				$smarty->assign('dueno',$registro[1]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('razon',$registro[2]);  //asigna una cadena a la variable "nombre"
				$cuit=$registro[3];
				$cuit1=substr($cuit,0,2);
				$cuit2=substr($cuit,2,-1);
				$cuit3=substr($cuit,-1);
				$smarty->assign('cuit1',$cuit1);  //asigna una cadena a la variable "nombre"
				$smarty->assign('cuit2',$cuit2);  //asigna una cadena a la variable "nombre"
				$smarty->assign('cuit3',$cuit3);  //asigna una cadena a la variable "nombre"
				$smarty->assign('ing_bruto',$registro[4]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('iva',$registro[5]);  //asigna una cadena a la variable "nombre"
				$fecha_empresa=$registro[6];
				$dia=substr($fecha_empresa,0,2);
				$mes=substr($fecha_empresa,2,2);
				$ano=substr($fecha_empresa,-4);
				$smarty->assign('dia',$dia);  //asigna una cadena a la variable "nombre"
				$smarty->assign('mes',$mes);  //asigna una cadena a la variable "nombre"
				$smarty->assign('ano',$ano);  //asigna una cadena a la variable "nombre"
				$smarty->assign('tel',$registro[7]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('fax',$registro[8]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('cel',$registro[9]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('dir',$registro[10]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('pais',$registro[11]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('prov',$registro[12]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('loca',$registro[13]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('web',$registro[14]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('mail',$registro[15]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('logo',$registro[16]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('fondo',$registro[17]);  //asigna una cadena a la variable "nombre"
				
				$smarty->display('mostrar_empresa.tpl');  //define la plantilla que utilizara
				break;
			case 'ver':
				include("conexion.php");
				$consulta = "SELECT * FROM empresa"; 	 // consulta sql
				$result = mysql_query($consulta);    	 // hace la consulta
				$registro = mysql_fetch_row($result);	 // toma el registro
				require("smarty.php");  			 	 // requiere la pag "include.php" para crear una instancia de Smarty
				$smarty = new ClaseSmarty; 				 //crea una instancia
				$smarty->assign('dueno',$registro[1]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('razon',$registro[2]);  //asigna una cadena a la variable "nombre"
				$cuit=$registro[3];
				$cuit1=substr($cuit,0,2);
				$cuit2=substr($cuit,2,-1);
				$cuit3=substr($cuit,-1);
				$smarty->assign('cuit1',$cuit1);  //asigna una cadena a la variable "nombre"
				$smarty->assign('cuit2',$cuit2);  //asigna una cadena a la variable "nombre"
				$smarty->assign('cuit3',$cuit3);  //asigna una cadena a la variable "nombre"
				$smarty->assign('ing_bruto',$registro[4]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('iva',$registro[5]);  //asigna una cadena a la variable "nombre"
				$fecha=$registro[6];
				$dia=substr($fecha,0,2);
				$mes=substr($fecha,2,2);
				$ano=substr($fecha,-4);
				$smarty->assign('dia',$dia);  //asigna una cadena a la variable "nombre"
				$smarty->assign('mes',$mes);  //asigna una cadena a la variable "nombre"
				$smarty->assign('ano',$ano);  //asigna una cadena a la variable "nombre"
				$smarty->assign('tel',$registro[7]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('fax',$registro[8]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('cel',$registro[9]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('dir',$registro[10]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('pais',$registro[11]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('prov',$registro[12]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('loca',$registro[13]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('web',$registro[14]);  //asigna una cadena a la variable "nombre"
				$smarty->assign('mail',$registro[15]);  //asigna una cadena a la variable "nombre"
				
				$smarty->display('ver_empresa.tpl');  //define la plantilla que utilizara
				break;
			case 'logo':	
				include("conexion.php");
				include ("conexion_ftp.php");     // Incluiye biblioteca de funcion de conexion por ftp
			
				$consulta = "SELECT logo FROM empresa"; // consulta sql  
				$result = mysql_query($consulta);            // hace la consulta
				$registro = mysql_fetch_row($result);        // toma el registro
				$logo=$registro[0];
				
				if ( $logo == 'S'){
						$lista = ftp_nlist ($id_con, "sistema_logo/");
						$arch = substr($lista[0], 0);
						//echo "<fieldset  style='width:10%; height:10%;'>";
							echo "logo: <img src='../imagenes/sistema_logo/$arch' class='caja' alt='Foto' name='imagen' width='50' height='50'>";
						//echo "</fieldset>";
				}
				break;
			case 'fondo':
				include("conexion.php");
				include ("conexion_ftp.php");     // Incluiye biblioteca de funcion de conexion por ftp
			
				$consulta = "SELECT imagen_fondo FROM empresa"; // consulta sql  
				$result = mysql_query($consulta);            // hace la consulta
				$registro = mysql_fetch_row($result);        // toma el registro
				$fondo=$registro[0];
				
				if ( $fondo == 'S'){
						$lista = ftp_nlist ($id_con, "sistema_fondo/");
						$arch = substr($lista[0], 0);
						//echo "<fieldset  style='width:10%; height:10%;'>";
							echo "Fondo: <img src='../imagenes/sistema_fondo/$arch' class='caja' alt='Foto' name='imagen' width='150' height='150'>";
						//echo "</fieldset>";
				}
				break;
		}
}
?>
