<? 
session_start();   															 // Iniciar sesión
$usuario_carga = $_SESSION['user_usuario']; 						 //usuario conectado
$nombre_usuario_carga = $_SESSION["nombre_usuario"];                 // toma el campo nombre de la BD

$repartidor = $_POST["repartidor"]; // toma la variable de la url q vino de ajax.js
$hora_actual = $_POST["hora_actual"]; // toma la variable de la url q vino de ajax.js

$cierre = $_POST["cierre"]; // toma la variable de la url q vino de ajax.js
if($cierre){

	//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
	//\\//\\//\\//\\//\\//\\//\\ FISCAL //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
	//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
	
	$impresora_fiscal = 1; // OBTENER PARAMETRO DE TABLA TALONARIO 
	
	if($impresora_fiscal == 1){
		$array_fiscal = array();
		$array_fiscal_desc = array();
		$i_fiscal = 1;
		$serie_fiscal = "27-0163848-435";
		$puerto_fiscal = "/dev/ttyS0";
		$velocidad_fiscal = 9600;
		$array_fiscal[$i_fiscal++] = "@CIERRE|Z";
		
		include("conexion.php");
		include("fiscal_get_estado.php");
		include("fiscal_set_comando.php");
		fiscal_set_comando($array_fiscal,$serie_fiscal,$puerto_fiscal,$velocidad_fiscal);
		
		$array_fiscal_desc[1] = "estado del impresor fiscal - [0080 = CORRECTO]";
		$array_fiscal_desc[2] = "estado del controlador fiscal - [0600 = CORRECTO]";
		$array_fiscal_desc[3] = "Nro de Z";
		$array_fiscal_desc[4] = "Documentos Fiscales Cancelados";
		$array_fiscal_desc[5] = "Documentos No Fiscales Homologados (D.N.F.H)";
		$array_fiscal_desc[6] = "Documentos No Fiscales no homologados (D.N.F.)";
		$array_fiscal_desc[7] = "Comprobantes Factura B o C emitidos";
		$array_fiscal_desc[8] = "Comprobantes de Facturas A emitidos";
		$array_fiscal_desc[9] = "Nro de &uacute;ltimo comprobante de Factura B o C emitido";
		$array_fiscal_desc[10] = "Monto total Facturado";
		$array_fiscal_desc[11] = "Monto total de IVA Cobrado";
		$array_fiscal_desc[12] = "Importe Total de las percepciones";
		$array_fiscal_desc[13] = "Nro de &uacute;ltimo comprobante Factura A emitido";
		$array_fiscal_desc[14] = "Nro de la &uacute;ltima Nota de cr&eacute;dito tipo A emitida";
		$array_fiscal_desc[15] = "Nro de la &uacute;ltima Nota de cr&eacute;dito tipo B-C emitida";
		$array_fiscal_desc[16] = "Nro del último remito emitido";
		$array_fiscal_desc[17] = "Total de Nota de cr&eacute;dito";
		$array_fiscal_desc[18] = "Total de IVA de Nota de cr&eacute;dito";

		echo "<table width='100%' border='0'cellspacing='1' cellpadding='0'>";
			echo "<tr class='top'>";
				echo "<td width='72%'><div align='center' class='seccion'>Descripcion</div></td>";
				echo "<td width='14%'><div align='center' class='seccion'>Valor</div></td>";
				
			echo "</tr>";
			$clase="class='filas'"; 							//defino la clase para las filas
	
			for ($i = 1; $i <= 18; $i++) {
					echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
						echo "<td $clase align='left'>";
								echo $espacio_izq.$array_fiscal_desc[$i];   
						echo"</td>"; 
						echo"<td $clase align='right'>";	
								echo fiscal_get_estado('CIERREZ',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'P',$i).$espacio_izq;
						echo"</td>";  
					echo"</tr>";
			} //end for
			
		echo "</table>";   
   }
  //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
  //\\//\\//\\//\\//\\//\\//\\ FISCAL //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
  //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
	
	/*
		include("conexion.php");
		$fecha_actual=date("Y",time()).date("m",time()).date("d",time());
		
		$consulta = "SELECT * FROM cargas where cod_flero = $repartidor and fecha = $fecha_actual"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		$registro = mysql_fetch_row($result);        // toma el registro
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call finalizar_carga($repartidor,$fecha_actual,'$hora_actual','$usuario_carga')"; // llama al procedimiento almacecnado
			if($result = mysql_query($consulta)){        // hace la consulta
				$consulta = "SELECT nombre FROM fletero where cod_flero = $repartidor"; // consulta sql
				$result = mysql_query($consulta);            // hace la consulta
				$registro = mysql_fetch_row($result);        // toma el registro
				$nombre_fletero = $registro[0];
				
				// ================= Imprimir el Informe =========================== //
				include('imprimir_carga_articulos.php');
				include('imprimir_carga_caja.php');
				
				//$destino = 1;
				//include('exportar_carga_articulos.php');
				//include('exportar_carga_caja.php');
				
				echo "Carga Finalizada!!";
			}else{
				echo "ERROR: La Carga ya ha sido Finalizada";
			}	
		}else{
			echo "ERROR: La Carga ya ha sido Finalizada";
		}
	*/
}else{
	//fecha actual
	$dia=date("d",time());  //asigna una cadena a la variable "dia"
	$mes=date("m",time());  //asigna una cadena a la variable "mes"
	$ano=date("Y",time());  //asigna una cadena a la variable "año"
	$fecha="$dia / $mes / $ano";
	
	$fecha_hora = date(Y.'-'.m.'-'.d.' '.h.':'.i.':'.s); 

	require("smarty.php");  						// requiere la pag "smarty.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; 						//crea una instancia
	//$smarty->display('finalizar_carga.tpl');   	//define la plantilla que utilizara  
	$smarty->assign('fecha',$fecha);  				//asigna una cadena a la variable "nombre"
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="finalizar_carga";
	$plantilla = "cierre_z.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>