<?
	include("conexion.php");
	$consulta = "SELECT DISTINCT codigo, nombre from(
					select provincia.cod_prov AS codigo ,provincia.nombre AS nombre from provincia inner join (localidad inner join (zona inner join (cliente inner join factura_vta 
					on factura_vta.cod_cliente =cliente.cod_cliente)on cliente.cod_zona = zona.cod_zona) on zona.cod_localidad = localidad.cod_localidad)
					on localidad.cod_prov =provincia.cod_prov
					UNION ALL
					select provincia.cod_prov AS codigo ,provincia.nombre AS nombre from provincia inner join (localidad inner join (zona inner join factura_vta_no_cliente 
					on factura_vta_no_cliente.cod_zona = zona.cod_zona) on zona.cod_localidad = localidad.cod_localidad)on localidad.cod_prov =provincia.cod_prov
				)as provincias order by nombre;"; // consulta sql  

	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_prov' id='lista_prov' class='caja' onKeyUp='pasar_foco_iva_ventas_0(event)' >";
		echo "<option value='TODOS'>TODOS</option>";
		do{
				$cod=$registro[0];
				$nombre=$registro[1];
				echo "<option value=$cod >$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>