

<!-- <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/estilos_tabla_scroll.css" rel="stylesheet" type="text/css">

</head>

<body>
<div id="tableContainer" class="tableContainer">
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="scrollTable">
<thead class="fixedHeader">
	<tr>
		<th><a href="#">Header 1</a></th>
		<th><a href="#">Header 2</a></th>
		<th><a href="#">Header 3</a></th>
	</tr>
</thead>
<tbody class="scrollContent">
	<tr>
		<td>Cell Content 1</td>
		<td>Cell Content 2</td>
		<td>Cell Content 3</td>
	</tr>
	<tr>
		<td>More Cell Content 1</td>
		<td>More Cell Content 2</td>
		<td>More Cell Content 3</td>
	</tr>
	<tr>
		<td>Even More Cell Content 1</td>
		<td>Even More Cell Content 2</td>
		<td>Even More Cell Content 3</td>
	</tr>
	<tr>
		<td>And Repeat 1</td>
		<td>And Repeat 2</td>
		<td>And Repeat 3</td>
	</tr>
</tbody>
</table>

</div>

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
</body>
</html>
 -->
<?
/*
$tabla = "articulos"; 									 // toma la variable de la url q vino de ajax.js

if($tabla){
	require_once('class_txt/inc.crear_txt.php');  		 // clase CVS
	
	$host="localhost";
	$db="db_ele_2"; 
	$usuario="root";
	$clave="gmo285coreduo";

	
	//include("conexion.php"); 			    				 // conexion DB
	
	// crea una instancia
	$CrearTXT = new CrearTXT($host, $db, $usuario, $clave); 		
	
	// asigna el directorio de destino, la clase 1º crea el directorio y escribe el archivo *.CSV dentro de este
	$CrearTXT->path = './txt/';
	
	//************************************************************** //
	if($tabla == 'clientes'){ 
		// asigna el nombre del archivo
		$CrearTXT->nombre_arch = 'Clientes.csv';	
	
		// asigna la consulta
		$CrearTXT->consulta = "select cod_cliente as codigo, razon_social, direccion, cliente.cod_zona as zona, cod_vendedor as vendedor, tel as telefono, cliente.cod_pais as lista, orden, cliente.cod_pais as ramo, localidad.nombre as localidad 
								from cliente inner join (zona inner join localidad on localidad.cod_localidad = zona.cod_localidad) on zona.cod_zona = cliente.cod_zona
								where cliente.activo = 'S'and orden > 0 order by vendedor, orden";
	
	//************************************************************** //
	}elseif($tabla == 'articulos'){
		// asigna el nombre del archivo
		$CrearTXT->nombre_arch = 'Articulos.txt';	
	
		// asigna la consulta
		$CrearTXT->consulta = "select concat(producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod)as codigo, 
								producto.descripcion, precio_vta as lista1, precio_vta as lista2, precio_vta as lista3, precio_vta as lista4, 
								precio_vta as lista5, marca.descripcion as linea,  producto.cod_grupo as rubro,
								' ' as capacidad ,unidad_bulto as pack
								from prod_por_categ  inner join (producto inner join (variedad inner join marca 
								on marca.cod_marca = variedad. cod_marca and marca.cod_grupo = variedad.cod_grupo)
								on variedad.cod_variedad = producto.cod_variedad and  variedad.cod_marca = producto. cod_marca and variedad.cod_grupo = producto.cod_grupo)
								on concat(producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod) = concat(prod_por_categ.cod_grupo,prod_por_categ.cod_marca,prod_por_categ.cod_variedad,prod_por_categ.cod_prod)
								where producto.activo = 'S'";
	}


	// 1 define que se va a obligar a la descarga, si se omite solo se guarda en el directorio indicado antes
	//$csvcreate->descarga = 1;
	
	// llama al metodo de creacion de CSV				  
	$CrearTXT->crear();
	
// a href="download.php?variable=mi_mp3.mp3"&gtdescargar</a>	 csv/$csvcreate->nombre_arch

	echo "El archivo <a href='descargar_csv.php?dir=$csvcreate->path&arch=$csvcreate->nombre_arch' class='seccion' title ='Click para abrir el archivo' > $csvcreate->nombre_arch </a> se ha creado satisfactoriamente";
}
//00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000
//include("conexion.php");
$path = './txt/';
if (!file_exists($path)) {
	mkdir($path,0777);
}
$archivo= "miarchivo.txt";			

			// crea el archivo CSV =================================================================
			$fp = fopen($path.$archivo,'w');
            fwrite($fp,"casdsadsadsa");
            fclose($fp);

//0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000

$consulta = "select distinct fecha, cod_repartidor from factura_vta"; // consulta sql 
$result = mysql_query($consulta);            // hace la consulta
$registro = mysql_fetch_row($result);        // toma el registro

do{
	$fecha=$registro[0];
	$rep=$registro[1];
	$consulta_i = "insert into cargas values($fecha,$rep,'11:37:34','admin');"; // consulta sql 
	mysql_query($consulta_i);            // hace la consulta
}while($registro = mysql_fetch_row($result)); // obtengo los resultados 



 $cc = 'my secret text';
$encrypted = mcrypt_cbc(MCRYPT_BLOWFISH,'my secret key',$cc,MCRYPT_ENCRYPT,'12345678');
$decrypted = mcrypt_cbc(MCRYPT_BLOWFISH, 'my secret key', $encrypted, MCRYPT_DECRYPT,'12345678');
echo "encrypted : ".$encrypted;
echo "<br>";
echo "decrypted : ".$decrypted;
 

	session_start();   								// Iniciar sesión
	$usuario_activo = $_SESSION['user_usuario']; 	//usuario conectado
	$nombre_activo = $_SESSION['nombre_usuario']; 	//usuario conectado

/*
class ejemplo{
	var $a;
	var $b;
	var $r;
	function ejemplo($var1, $var2){
		$this->a = $var1;
		$this->b = $var2;
	}
	
	function sumar(){
		$this->r = 	$this->a + 	$this->b;
		return $this->r;
	}
}
$sumar = new ejemplo(1,1);
$resultado = $sumar->sumar();
echo $resultado

/*
$host = 'localhost';

$usuario = 'root';

$password = 'gmo285coreduo';

$db=mysql_connect($host,$usuario,$password);
mysql_select_db ('db_ele_2',$db)or die ("No se puede conectar con la Base de Datos");


//aqui se saca la informacion y la separamos por coma
		$query = "select cod_cliente as codigo, razon_social, direccion, cliente.cod_zona as zona, cod_vendedor as vendedor, tel as telefono, cliente.cod_pais as lista, orden, cliente.cod_pais as ramo, localidad.nombre as localidad 
				  from cliente inner join (zona inner join localidad on localidad.cod_localidad = zona.cod_localidad) on zona.cod_zona = cliente.cod_zona";

$sacar=mysql_query($query, $db);

while ($reg = mysql_fetch_array($sacar)){
$csv = $csv.	$reg["codigo"].',"'.$reg["razon_social"].'","'.$reg["direccion"].'","'.$reg["zona"]              ."\n";
}
//aqui le decimos al navegador que vamos a mandar un archivo del tipo CSV
header("Content-Description: File Transfer");
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=pedidos.csv");
echo $csv;



include("conexion.php");
 
$consulta = 'set @a = 123; select @a; ';
$result = mysql_query($consulta);            // hace la consulta
$registro = mysql_fetch_row($result);        // toma el registro
echo $registro[0];

 /*
// Nombre del archivo de con el cual queremos que se guarde la base de datos
$filename = "db_ele22.sql"; 
// Cabezeras para forzar al navegador a guardar el archivo
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Transfer-Encoding: binary");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=$filename");

// Funciones para exportar la base de datos
$executa = "C:\AppServ\MySQL\bin\mysqldump.exe -u $usuario --password=$clave --opt $db";
system($executa, $resultado);

// Comprobar si se a realizado bien, si no es asi, mostrará un mensaje de error
if ($resultado) { echo "<H1>Error ejecutando comando: $executa</H1>\n"; }



 /*
 $result = mysql_query('SHOW DATABASES');

  while ($row = mysql_fetch_row($result)) {
      echo "Realizando backup de ".$row[0]." ... ";
      exec("mysqldump -h localhost -u root --password=gmo285 --opt --default-character-set=latin1 --flush-logs ".$row[0]." | bzip2 -c > back_up/".$row[0]."-".date('Y.m.d').".sql.bz2");
      echo "terminado.\n";
   }



$bdd = "--all-databases";
$opt = "";
  
echo $backupFile = date("Y-m-d-H-i-s") . '.gz';
 $command = "mysqldump -h localhost -u root --password=gmo285 --opt $opt $bdd | gzip > $backupFile";

exec($command,$backupFile);
// Mantiene los ultimos 3 backups
 $days=3;
$archivos = scandir("./");
 foreach ($archivos as $key => $val)
 {
 if(substr($val,-2) != "gz")
 unset($archivos[$key]);
}
  
 $i=count($archivos);
 foreach ($archivos as $key => $val) {
	if($i<=$days)
 		break;
 	unlink($val);
	$i--;
}


//echo "Verson de PHP: ".phpversion();
//echo phpinfo();
*/
//mail("betos_05@hotmail.com","php","mensaje","FROM: server-dos");

/*
// ver propaga el SID.
ini_set("session.cache_expire", 360);
ini_set("session.cookie_lifetime", 10800);
ini_set("session.gc_maxlifetime", 10800);

//imprimimos la duracion de las sesiones actual que por default es 1440
echo "<br>".ini_get("session.gc_maxlifetime");
//fijamos la nueva duracion de la sesion
ini_set("session.gc_maxlifetime", "18000"); // 5 hs
//imprimimos el resultado
echo "<br>".ini_get("session.gc_maxlifetime");
*/
?>


<?php
$cadena = "Resp. Inscripto";
$patron = "/NO/";
$encontrado = preg_match_all($patron, $cadena, $coincidencias, PREG_OFFSET_CAPTURE);

if ($encontrado) {
    print "<pre>"; print_r($coincidencias); print "</pre>\n";
    print "<p>Se han encontrado $encontrado coincidencias.</p>\n";
    foreach ($coincidencias[0] as $coincide) {
        print "<p>Cadena: '$coincide[0]' - Posición: $coincide[1]</p>\n";
    }
} else {
    print "<p>No se han encontrado coincidencias.</p>\n";
}
?>