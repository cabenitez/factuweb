<?
	include("conexion.php");
	$consulta = "SELECT provincia FROM empresa"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$prov= $registro[0];
	
	$consulta = "SELECT * FROM provincia order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_provincia' id='lista_provincia' class='caja'  onKeyUp='listar_loca_de_prov(event,this.value)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[2];
				if ( $nombre == $prov){
					echo "<option selected value=$codigo>$nombre</option>";
				}else{
					echo "<option value=$codigo>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>