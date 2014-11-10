<? 
if($codigo){
	include("conexion.php");
	include ("conexion_ftp.php");     // Incluiye biblioteca de funcion de conexion por ftp

	$consulta = "SELECT foto,descripcion FROM producto where cod_prod = $codigo and cod_variedad = $variedad and cod_marca = $marca and cod_grupo = $grupo"; // consulta sql  
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$foto=$registro[0];
	$nombre=$registro[1];
	if ( $foto == 'S'){
			$lista = ftp_nlist ($id_con, "fotos_articulos/$codigo/");
			$arch = substr($lista[0], 0);
			echo "<img src='../imagenes/fotos_articulos/$codigo/$arch' class='caja' title='$nombre' name='imagen' width='100' height='100'>";
	}
}
?>