<?
$array_fiscal = array();
$i_fiscal = 1;
$serie_fiscal = "27-0163848-435";
$puerto_fiscal = "/dev/ttyS0"; // COM1	/dev/ttyS0
$velocidad_fiscal = 9600;					
$array_fiscal[$i_fiscal++] = "@ESTADO|A"; 
/*
$array_fiscal[$i_fiscal++] = "@PONEENCABEZADO|5|SFyCSOL FACTURA A";
$array_fiscal[$i_fiscal++] = "@FACTABRE|F|C|A|1|P|12|I|I|JUAN PEREZ||CUIT|27141670641|N|BELGRANO 970|certificado 21/11/2000|sin fiscalizar|Remito 1||C";
$array_fiscal[$i_fiscal++] = "@FACTITEM|Producto A|1.000|0.001|0.2100|M|1|0.154412||||0.0000|0";
$array_fiscal[$i_fiscal++] = "@FACTITEM|Producto A|1.000|0.001|0.2100|M|1|0.154412||||0.0000|0";
$array_fiscal[$i_fiscal++] = "@FACTITEM|Producto A|1.000|0.001|0.2100|M|1|0.154412||||0.0000|0";
$array_fiscal[$i_fiscal++] = "@FACTCIERRA|F|A|TOTAL";
*/

include("fiscal_set_comando.php");
	fiscal_set_comando($array_fiscal,$serie_fiscal,$puerto_fiscal,$velocidad_fiscal);

include("fiscal_get_estado.php");
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',1);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',2);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',3);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',4);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',5);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',6);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',6);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',7);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',7);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',8);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',9);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',10);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',11);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',12);
	echo "<BR>".fiscal_get_estado('estado',$serie_fiscal,$puerto_fiscal,$velocidad_fiscal,'A',13);
?>