<?
	include('conexion.php');
	$consulta = "show databases like 'sys_fact%'"; 	// consulta sql   
	$result = mysql_query($consulta);            	// hace la consulta
   	$registro = mysql_fetch_row($result);        	// toma el registro
	
	echo "<br><br>";
	echo "<table width='40%'  border='0' cellspacing='1' cellpadding='0'>";
		do{
			$nombre=$registro[0];    // ejemplo:  sys_fact_20071101_20080731

			$ano_d=substr($nombre,9,4);
		    $mes_d=substr($nombre,13,2);
		    $dia_d=substr($nombre,15,2);
			
			$ano_h=substr($nombre,18,4);
		    $mes_h=substr($nombre,22,2);
		    $dia_h=substr($nombre,24,2);
			
		    $nombre_mostrar = "$dia_d/$mes_d/$ano_d - $dia_h/$mes_h/$ano_h"; 								// maqueta el cuit para imprimir
			
			echo "<tr>";
				echo "<td class='caja'>". $nombre_mostrar . "</td>";
				echo "<td>";
					echo "<input type='button' id='seleccionar' name = 'seleccionar' value = 'seleccionar' class='botones' alt='$nombre'  onclick= 'seleccionar_db(this.alt)'>";
				echo "</td>";
			echo"</tr>";
				
			
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo "</table>"; 
?>