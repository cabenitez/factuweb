<? 
if($codigo){
	include("conexion.php");
	
	$consulta = "SELECT envase FROM producto where cod_prod = $codigo and cod_variedad = $variedad and cod_marca = $marca and cod_grupo = $grupo"; // consulta sql  
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nombre=$registro[0];
	echo"<select name='retornable_mod' id='retornable_mod' class='caja'  onKeyUp='pasar_foco_art_10_mod(event,this.value)'>"; 
				if ( $nombre == 'SI'){
					echo "<option selected value='SI'>SI</option>";
					echo "<option value='NO'>NO</option>";
				}else{
					echo "<option value='SI'>SI</option>";
					echo "<option selected value='NO'>NO</option>";
				}
	echo"</select>";
}
?>