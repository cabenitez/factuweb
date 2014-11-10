<?

$cod_cliente = $_POST["cod_cliente"]; // toma la variable de la url q vino de ajax.js
$cod_zona = $_POST["cod_zona"]; // toma la variable de la url q vino de ajax.js
$cod_localidad = $_POST["cod_localidad"]; // toma la variable de la url q vino de ajax.js
$cod_prov = $_POST["cod_prov"]; // toma la variable de la url q vino de ajax.js
$cod_pais = $_POST["cod_pais"]; // toma la variable de la url q vino de ajax.js
$n_talonario = $_POST["n_talonario"]; // toma la variable de la url q vino de ajax.js

if($cod_cliente){
	include("conexion.php");
	$nombre = strtoupper($nombre); 
		
	$consulta ="SELECT tipo_talonario.cod_talonario FROM tipo_talonario inner join talonario on tipo_talonario.cod_talonario = talonario.cod_talonario and talonario.num_talonario = $n_talonario where descripcion LIKE '%recibo%' or descripcion like '%RECIBO%'";
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_tal=$registro[0];		

	$consulta_t ="SELECT * FROM recibos_por_cliente where cod_cliente = $codigo and cod_zona=$cod_zona and cod_localidad= $cod_localidad and cod_prov=$cod_prov and cod_pais = $cod_pais order by num_talonario desc";
	$result_t = mysql_query($consulta_t);            // hace la consulta
	$nfilas_t = mysql_num_rows ($result_t);          //indica la cantidad de resultados
	$registro_t = mysql_fetch_row($result_t);        // toma el registro
	$num_tal_anterior=$registro_t[6];
	
	echo $consulta = "call modificar_asignar_tal_recibo_cliente($cod_cliente,$cod_zona,$cod_localidad,$cod_prov,$cod_pais,$n_talonario,'$cod_tal',$num_tal_anterior)"; // consulta sql
	if($result = mysql_query($consulta)){            // hace la consulta
		echo "ok";
	}
}
?>