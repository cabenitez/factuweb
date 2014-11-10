<?
require_once('inc.csvcreation.php');  		 // clase CVS
include("../conexion.php"); 			    // conexion DB

// crea una instancia
$csvcreate = new CSVCreation($host, $db, $usuario, $clave); 		

// asigna el directorio de destino
$csvcreate->path = '../csv/';

// asigna el nombre del archivo
$csvcreate->nombre_arch = 'Clientes';

// asigna la consulta
$csvcreate->consulta = "select concat(producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod)as codigo, 
producto.descripcion, precio_vta as lista1, precio_vta as lista2, precio_vta as lista3, precio_vta as lista4, 
precio_vta as lista5, marca.descripcion as linea,  producto.cod_grupo as rubro,
' ' as capacidad ,unidad_bulto as pack
from prod_por_categ  inner join (producto inner join (variedad inner join marca 
on marca.cod_marca = variedad. cod_marca and marca.cod_grupo = variedad.cod_grupo)
on variedad.cod_variedad = producto.cod_variedad and  variedad.cod_marca = producto. cod_marca and variedad.cod_grupo = producto.cod_grupo)
on concat(producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod) = concat(prod_por_categ.cod_grupo,prod_por_categ.cod_marca,prod_por_categ.cod_variedad,prod_por_categ.cod_prod)
where producto.activo = 'S'";

// define que se va a obligar a la descarga, si se omite solo se guarda en el directorio indicado antes
$csvcreate->descarga = 1;

// llama al metodo de creacion de CSV				  
$csvcreate->createcsv();



?>