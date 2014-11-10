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
	
	$consulta = "call alta_asignar_tal_recibo_cliente($cod_cliente,$cod_zona,$cod_localidad,$cod_prov,$cod_pais,$n_talonario,'$cod_tal')"; // consulta sql
	if($result = mysql_query($consulta)){            // hace la consulta
		echo "ok";
	}
}
?>