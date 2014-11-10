<?
session_start();   															 // Iniciar sesión
$usuario_anular = $_SESSION['user_usuario']; 						 //usuario conectado

$cod_tal = $_POST["cod_tal"]; // toma la variable de la url q vino de ajax.js
$num_tal = $_POST["num_tal"]; 	// toma la variable de la url q vino de ajax.js
$num_fac = $_POST["num_fac"]; 	// toma la variable de la url q vino de ajax.js

$cod_tal = strtoupper($cod_tal);

if($cod_tal){
	include("conexion.php");
	$nfilas = 0;
	$consulta = "select n_factura from factura_vta where cod_talonario = '$cod_tal' and num_talonario = $num_tal and n_factura = $num_fac 
				 union 
				 select n_factura from factura_vta_no_cliente where cod_talonario = '$cod_tal' and num_talonario = $num_tal  and n_factura = $num_fac";
				  
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
				
				$dia=date("d",time());  //asigna una cadena a la variable "dia"
				$mes=date("m",time());  //asigna una cadena a la variable "mes"
				$ano=date("Y",time());  //asigna una cadena a la variable "año"
				$fecha="$ano$mes$dia";

				$consulta = "SELECT n_sucursal FROM talonario where num_talonario = $num_tal and cod_talonario = '$cod_tal'"; // obtiene el numero de sucursal
				$result = mysql_query($consulta);            // hace la consulta
				$registro = mysql_fetch_row($result);        // toma el registro
				$num_sucursal = $registro[0]; 	// OK
				
				if(!empty($num_sucursal)){	
					//----------------------------si no existen facturas todavia------------------------------------------------//
					$consulta = "SELECT primer_num, ultimo_num FROM talonario where cod_talonario = '$cod_tal' AND  num_talonario = $num_tal AND n_sucursal = $num_sucursal"; // obtiene el numero del talonario
					$result = mysql_query($consulta);            // hace la consulta
					$registro = mysql_fetch_row($result);        // toma el registro
					$primer_num = $registro[0];
					$ultimo_num = $registro[1];
				}
				
				if($num_fac >= $primer_num && $num_fac <= $ultimo_num){
							$consulta = "call anular_factura_vta_numeracion('$cod_tal',$num_tal,$num_sucursal,$num_fac,'$usuario_anular',$fecha)"; // llama al procedimiento almacecnado
							if(	$result = mysql_query($consulta)){            					// hace la consulta										
								echo"<table width='60%' border='0' ";
									echo"<tr>";
											echo"<td><strong>NUMERACION ANULADA</strong></td>";
									echo"</tr>";
								echo"</table>";
							}else{
								echo"<table width='60%' border='0' ";
									echo"  <tr >";
											echo"    <td><strong>ERROR: LA NUMERACION NO SE PUDO ANULAR</strong></td>";
									echo"  </tr>";
								echo"</table>";
							}
				}else{
					echo"<table width='60%' border='0' ";
						echo"  <tr >";
								echo"    <td><strong>ERROR: LA NUMERACION NO CORRESPONDE A ESTE TALONARIO</strong></td>";
						echo"  </tr>";
					echo"</table>";
				}
	}else{
			echo"<table width='60%' border='0' ";
			echo"  <tr >";
			echo"    <td><strong>ERROR: LA NUMERACION CORRESPONDE A UNA FACTURA YA GENERADA</strong></td>";
			echo"  </tr>";
			echo"</table>";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('anular_factura_vta_numeracion.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="factura_vta";
	$plantilla = "anular_factura_vta_numeracion.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>