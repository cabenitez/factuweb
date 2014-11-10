<? 
$listar = $_POST["listar"]; 							// toma la variable de la url q vino de ajax.js
include("conexion.php");

if ($listar == 1){
	$ruta = "./pdf/presupuestos/";						// variable con la cadena q indica la ruta
	$dir = opendir($ruta);						// abre el directorio de pedidos

	$cant_archivos;
	while ( $archivo=readdir($dir)) {			// lee el directorio y obtiene los nombres de los archivos
		if ($archivo != "." && $archivo != "..") { 
			$cant_archivos++;
		}
	}
	if($cant_archivos > 0 ){
		echo "<form  name='frm_restaurar'>";
			echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
			echo "<tr class='top'>";
				echo "<td width='65%'><div align='center' class='seccion'>Archivo</div></td>";
				echo "<td width='15%'><div align='center' class='seccion'>Creado</div></td>";
				echo "<td width='10%'><div align='center' class='seccion'>Tama&ntilde;o</div></td>";				
				echo "<td width='10%'><div align='center' class='seccion'>Descargar</div></td>";
			echo "</tr>";
			$clase="class='filas'"; 							//defino la clase para las filas
			
			$dir = opendir($ruta);						// abre el directorio de pedidos
			
				while ( $archivo=readdir($dir)) {			// lee el directorio y obtiene los nombres de los archivos
					//$ok = substr($archivo,0,1); 			// en caso de q el nombre empiese con OK_ no lo muestra, porque q ya se guardo en la base de datos anteriormente
					if ($archivo != "." && $archivo != "..") { 
						
						echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
							echo "<td $clase align='left'>";
									echo $espacio_izq.$archivo;
							echo"</td>";
							echo "<td $clase align='center'>";
									echo date("d/m/Y H:i:s", filectime($ruta.$archivo));
							echo"</td>";
							echo "<td $clase align='right'>";
									echo number_format(filesize($ruta.$archivo)/1024,2,'.','') . ' KB' . $espacio_izq;
							echo"</td>";
							echo "<td $clase align='center'>";
									
									
									echo "<a href=\"descargar_archivo.php?archivo=$ruta$archivo\"><img src='../imagenes/pdf.png' width='18' height='18' border='0'/></a>";
									//echo "<input name='enviar' type='button' class='botones' id='enviar' onclick='javascript: descargar_presupuesto_servidor(\"$ruta$archivo\")'  value='Descargar'>";
							echo"</td>";						
							
						echo"</tr>";
					}
				}
		echo "</form>";
	}	
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia

	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="utilidades";
	$plantilla = "descargar_presupuesto_vta.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>