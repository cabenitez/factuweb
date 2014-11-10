<?php
//USAR EN LISTADO DE ARTICULOS

//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "LISTA DE PRECIOS";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'CODIGO');
$pdf->SetX(20);
$pdf->Cell(10,8,'DESCRIPCION');
$pdf->SetX(115);
$pdf->Cell(10,8,'CATEGORIA');
$pdf->SetX(150);
$pdf->Cell(10,8,'PRECIO NETO');
$pdf->SetX(174);
$pdf->Cell(6,8,'IVA');
$pdf->SetX(184);
$pdf->Cell(10,8,'PRECIO FINAL');

//$pdf->Cell(10,8,'STOCK');

//---------------------- creo la linea -----------------------------------------------------//
$pdf->Line(7,31,205,31);																// linea
$pdf->Ln(7);																			//Salto de l�nea

//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
include("conexion.php");

$consulta = ereg_replace("@@","'",$consulta);

$result = mysql_query($consulta);            					// hace la consulta
$filas = mysql_num_rows($result);

$pdf->SetFont('Arial','',7);
$i=0;
while($registro = mysql_fetch_array($result)){ 					// obtengo los resultados 
				$codigo=$registro[0];
				$cod_variedad = $registro[1];
				$cod_marca = $registro[2];	
				$cod_grupo = $registro[3];
				$desc=$registro[4];
				$stock=$registro[16];
				$prod_cod_iva=$registro[18];

				$consulta_iva_p ="select nombre, tasa from alicuota_iva where cod_iva = $prod_cod_iva";
				$result_iva_p = mysql_query($consulta_iva_p);            // hace la consulta
				$reg_iva_p = mysql_fetch_row($result_iva_p);
				$nombre_iva_p = $reg_iva_p[0];
				$tasa_iva_p = $reg_iva_p[1];

				$consulta2 ="select categoria.descripcion, prod_por_categ.precio_vta from categoria inner join prod_por_categ on prod_por_categ.cod_categoria = categoria.cod_categoria where cod_prod = $codigo and prod_por_categ.cod_grupo = $cod_grupo and prod_por_categ.cod_marca = $cod_marca and prod_por_categ.cod_variedad = $cod_variedad ORDER BY categoria.descripcion";
				$result2 = mysql_query($consulta2);            // hace la consulta
				$reg2 = mysql_fetch_row($result2);
				$cant = mysql_num_rows($result);        	 // toma el registro
				$categoria= $reg2[0];
				$precio_categoria= $reg2[1];

				$precio_categoria_mas_iva = $precio_categoria+($precio_categoria * $tasa_iva_p /100);
				$precio_categoria_mas_iva= number_format($precio_categoria_mas_iva,2,'.','');
				
				$pdf->Cell(1,3 ,$cod_grupo.$cod_marca.$cod_variedad.$codigo,0,0); 				
				$pdf->SetX(20);
				$pdf->Cell(1,3 ,$desc,0,0); 				
				$pdf->SetX(115);
				$pdf->Cell(1,3 ,$categoria,0,0);
				$pdf->SetX(-45);
				$pdf->Cell(1,3 ,$precio_categoria,0,0,'R');
				$pdf->SetX(-28);
				$pdf->Cell(1,3 ,$tasa_iva_p.' %',0,0,'R'); 				
				$pdf->SetX(-7);
				$pdf->Cell(1,3 ,$precio_categoria_mas_iva,0,1,'R');
				
				$consulta2 ="select categoria.descripcion, prod_por_categ.precio_vta from categoria inner join prod_por_categ on prod_por_categ.cod_categoria = categoria.cod_categoria where cod_prod = $codigo and prod_por_categ.cod_grupo = $cod_grupo and prod_por_categ.cod_marca = $cod_marca and prod_por_categ.cod_variedad = $cod_variedad ORDER BY categoria.descripcion LIMIT 1,$cant";
				//echo $consulta;
				$result2 = mysql_query($consulta2);            // hace la consulta
				
				while($regi = mysql_fetch_array($result2)){ 	 // obtengo los resultados 
						$categoria2= $regi[0];
						$precio_categoria2= number_format($regi[1],2,'.','');

						$precio_categoria_mas_iva2 = $precio_categoria2+($precio_categoria2 * $tasa_iva_p /100);
						$precio_categoria_mas_iva2= number_format($precio_categoria_mas_iva2,2,'.','');

						$pdf->SetX(115);
						$pdf->Cell(1,3 ,$categoria2,0,0);
						$pdf->SetX(-45);
						$pdf->Cell(1,3 ,$precio_categoria2,0,0,'R');
						$pdf->SetX(-28);
						$pdf->Cell(1,3 ,$tasa_iva_p.' %',0,0,'R'); 				
						$pdf->SetX(-7);
						$pdf->Cell(1,3 ,$precio_categoria_mas_iva2,0,1,'R');
				} //end while 

				

}

//---------------------- creo el resumen de total de filas------------------------------//
$pdf->SetFont('Arial','',10); 
$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
$pdf->Ln(1);																			//Salto de l�nea
$pdf->SetFont('Arial','',8); 
$pdf->SetX(-16);
$pdf->Cell(10,10,"Total de Registros: $filas",0,1,'R');

//---------------------- creo el archivo PDF------------------------------------------------//
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}
?>