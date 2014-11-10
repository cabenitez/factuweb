<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////// VENTAS ////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//-------------------------------------------------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------CLIENTES----------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------------------------------------------------//
$importe_cliente_total_sin_impuesto = " -- CASE factura_vta.cod_talonario
									   	-- 	WHEN 'B' THEN
										-- 		if(iva.nombre <> 'MONOTRIBUTO'
										-- 			,
										-- 			(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  
										-- 			round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) +  
										-- 			round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
										-- 					round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) 
										-- 				  )* ing_bruto/100,2))/ (1+(factura_vta_detalle.iva/100))
										-- 			,
										-- 			round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2)
										-- 		)
										-- 	WHEN 'X' THEN
										-- 			(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  
										-- 			round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) +  
										-- 			round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
										-- 					round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) 
										-- 				  )* ing_bruto/100,2))/ (1+(factura_vta_detalle.iva/100))
			
										-- 	ELSE
												round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2)
									   	-- END as total_sin_impuesto
									   
									   as total_sin_impuesto";
//-------------------------------------------------------------------------------------------------------------------------------------------------------//
$importe_cliente_iva = "-- CASE factura_vta.cod_talonario
						-- 		WHEN 'B' THEN
						-- 			if(iva.nombre <> 'MONOTRIBUTO'
						-- 				,
						-- 				((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  
						-- 				round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) +  
						-- 				round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
						-- 						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) 
						-- 					  )* ing_bruto/100,2))/ (1+(factura_vta_detalle.iva/100)) *factura_vta_detalle.iva)/100
						-- 				,
						-- 				round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2)
						-- 			)
						-- 		WHEN 'X' THEN
						-- 				((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  
						-- 				round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) +  
						-- 				round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
						-- 						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) 
						-- 					  )* ing_bruto/100,2))/ (1+(factura_vta_detalle.iva/100)) *factura_vta_detalle.iva)/100
						-- 		ELSE
									round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2)
						-- 	END as iva
						
						as iva";
//-------------------------------------------------------------------------------------------------------------------------------------------------------//
$importe_cliente_otros_impuestos = "-- CASE factura_vta.cod_talonario
									-- 	WHEN 'A' THEN 
											 (round(imp_interno,2)  + 
											  round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
											  round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) 
									-- 	WHEN 'B' THEN 
									-- 		  CASE iva.nombre
									-- 			WHEN 'MONOTRIBUTO' THEN
									-- 				round(imp_interno,2)  + 
									-- 				round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
									-- 				round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
									-- 				round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2)) * ing_bruto/100,2)
									-- 			ELSE 0
									-- 		  END
									-- 	WHEN 'X' THEN 
									-- 		  0
									-- END as otros_impuestos
									
									as otros_impuestos";
//-------------------------------------------------------------------------------------------------------------------------------------------------------//
$importe_cliente_total_general = "-- CASE factura_vta.cod_talonario
									-- 	WHEN 'B' THEN
									-- 		if(iva.nombre <> 'MONOTRIBUTO'
									-- 			,
									-- 			round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
									-- 			round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) +  
									-- 			round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
									-- 					round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) 
									-- 				  )* ing_bruto/100,2)
									-- 			,
									-- 			round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
									-- 			round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) +
									-- 			round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
									-- 			round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
									-- 			round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2)) * ing_bruto/100,2)
									-- 		)
									-- 	WHEN 'X' THEN
									-- 			round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  
									-- 			round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) +  
									-- 			round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
									-- 					round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) 
									-- 				  )* ing_bruto/100,2)
									-- 	ELSE
											round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
											round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_detalle.iva)/100,2) +
											round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
											round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)
		
								-- END as total_general
									
								as total_general";
//-------------------------------------------------------------------------------------------------------------------------------------------------------//
$calculo_importe_cliente =" $importe_cliente_total_sin_impuesto , $importe_cliente_iva, $importe_cliente_otros_impuestos, $importe_cliente_total_general, ";

$from_cliente = " from talonario inner join(tipo_talonario inner join(iva inner join(cliente inner join (factura_vta inner join factura_vta_detalle  
				  on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario)
				  on factura_vta.cod_cliente = cliente.cod_cliente)on cliente.cod_iva = iva.cod_iva )
				  on iva.cod_talonario = tipo_talonario.cod_talonario) 
				  on tipo_talonario.cod_talonario = talonario.cod_talonario  and talonario.num_talonario = factura_vta.num_talonario ";

//-------------------------------------------------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------NO CLIENTES-------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------------------------------------------------//

$importe_no_cliente_total_sin_impuesto = "-- CASE factura_vta_no_cliente.cod_talonario
											-- 	WHEN 'B' THEN
											-- 		if(iva.nombre <> 'MONOTRIBUTO'
											-- 			,
											-- 			(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  
											-- 			round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) +  
											-- 			round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
											-- 					round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) 
											-- 				  )* ing_bruto/100,2))/ (1+(factura_vta_no_cliente_detalle.iva/100))
					
											-- 			,
											-- 			round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2)
											-- 		)
											-- 	WHEN 'X' THEN
											-- 			(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
											-- 			round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) +  
											-- 			round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
											-- 					round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) 
											-- 				  )* ing_bruto/100,2))/ (1+(factura_vta_no_cliente_detalle.iva/100))
											-- 	ELSE
													round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2)
										  -- END as total_sin_impuesto
										  
										  as total_sin_impuesto";
//-------------------------------------------------------------------------------------------------------------------------------------------------------//
$importe_no_cliente_iva = "-- CASE factura_vta_no_cliente.cod_talonario
							-- 					WHEN 'B' THEN
							-- 						if(iva.nombre <> 'MONOTRIBUTO'
							-- 							,
							-- 							((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  
							-- 							round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) + 
							-- 							round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
							-- 									round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) 
							-- 								  )* ing_bruto/100,2))/ (1+(factura_vta_no_cliente_detalle.iva/100)) *factura_vta_no_cliente_detalle.iva)/100
					
							-- 							,
							-- 							round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2)
							-- 						)
							-- 					WHEN 'X' THEN
							-- 							((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  
							-- 							round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) +  
							-- 							round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
							-- 									round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) 
							-- 								  )* ing_bruto/100,2))/ (1+(factura_vta_no_cliente_detalle.iva/100)) *factura_vta_no_cliente_detalle.iva)/100
							-- 					ELSE
							 						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2)
							-- 			 END as iva
							
							as iva";
//-------------------------------------------------------------------------------------------------------------------------------------------------------//
$importe_no_cliente_otros_impuestos = " -- CASE factura_vta_no_cliente.cod_talonario
										-- 	WHEN 'A' THEN 
									              (round(imp_interno,2)  + 
										 		  round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
										 		  round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) 
										-- 	WHEN 'B' THEN 
										-- 		  CASE iva.nombre
										-- 			WHEN 'MONOTRIBUTO' THEN
										-- 				round(imp_interno,2)  + 
										-- 				round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
										-- 				round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
										-- 				round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2)) * ing_bruto/100,2)
										-- 			ELSE 0
										-- 		  END
										-- 	WHEN 'X' THEN 
										-- 		  0
										-- END as otros_impuestos
										
										as otros_impuestos";
//-------------------------------------------------------------------------------------------------------------------------------------------------------//
$importe_no_cliente_total_general = "-- CASE factura_vta_no_cliente.cod_talonario
										-- 	WHEN 'B' THEN
										-- 		if(iva.nombre <> 'MONOTRIBUTO'
										-- 			,
										-- 			round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  
										-- 			round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) +  
										-- 			round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
										-- 					round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) 
										-- 				  )* ing_bruto/100,2)
										-- 			,
										-- 			round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
										-- 			round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) +
										-- 			round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
										-- 			round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
										-- 			round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2)) * ing_bruto/100,2)
										-- 		)
										-- 	WHEN 'X' THEN
										-- 			round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +  
										-- 			round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) +  
										-- 			round((round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) + 
										-- 					round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) 
										-- 				  )* ing_bruto/100,2)
										-- 	ELSE
												round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
												round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*factura_vta_no_cliente_detalle.iva)/100,2) +
												round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
												round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)
									 -- END as total_general
									 
									 as total_general";
//-------------------------------------------------------------------------------------------------------------------------------------------------------//
$calculo_importe_no_cliente = "$importe_no_cliente_total_sin_impuesto, $importe_no_cliente_iva, $importe_no_cliente_otros_impuestos, $importe_no_cliente_total_general, ";
								
$from_no_cliente = " from iva inner join (tipo_talonario inner join(talonario inner join (factura_vta_no_cliente inner join factura_vta_no_cliente_detalle  
					 on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario)
					 on factura_vta_no_cliente.cod_talonario = talonario.cod_talonario  and factura_vta_no_cliente.num_talonario = talonario.num_talonario)
					 on talonario.cod_talonario = tipo_talonario.cod_talonario)
					 on tipo_talonario.cod_talonario = iva.cod_talonario and iva.cod_iva =  factura_vta_no_cliente.cond_iva ";
//-------------------------------------------------------------------------------------------------------------------------------------------------------//
/*
round(imp_interno,2) as imp_int, 
round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) as perc_iva,
round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2) as ing_bruto,
*/ 

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////// COMPRAS ///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$factura_compra_otros_impuestos = " imp_interno_monto + perc_iva_monto + pib_monto + otros_monto ";


?>