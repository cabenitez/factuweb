<?
include("conexion.php");

 $tabla = $_GET["tabla"]; // toma la variable de la url q vino de ajax.js

if (session_is_registered ($tabla)){          // si ha iniciado sesion
	switch($tabla){
		case 'cliente':
						
						$codigo = $_SESSION[$id];		
						$consulta = "SELECT * FROM cliente WHERE cod_cliente = $codigo"; // consulta sql
						$result = mysql_query($consulta);            // hace la consulta
						$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
						$registro = mysql_fetch_row($result);        		// toma el registro
						
						if ($nfilas > 0){     						 		// si existen Usuarios
								#$cod_zona=$registro[1];
								#$cod_localidad=$registro[2];
								#$cod_prov=$registro[3];
								#$cod_pais=$registro[4];
								$contacto=$registro[5];
								$razon=$registro[6];
								$tel=$registro[7];
								$fax=$registro[8];
								$movil=$registro[9];
								$dir=$registro[10];	
								$cuit=$registro[11];	
								if($cuit != ""){	
									$cuit1=substr($cuit,0,2);
									$cuit2=substr($cuit,2,-1);
									$cuit3=substr($cuit,-1);
								$cuit=$cuit1.'-'.$cuit2.'-'.$cuit3;
								}
								$lim_cred=$registro[12];		
								$web=$registro[13];		
								$mail=$registro[14];		
								#$cod_iva=$registro[15];		
								#$cod_cat=$registro[16];
								#$cod_ven=$registro[17];
								#$cod_rep=$registro[18];				
								#$cod_vta=$registro[20];
								#$activo=$registro[22]; 
								
								/*
								$consulta ="select nombre from iva where cod_iva = $cod_iva";
								$result = mysql_query($consulta);            // hace la consulta
								$reg = mysql_fetch_row($result);
								$iva= $reg[0];
				
								$consulta ="select descripcion from forma_pago where cod_fp = $cod_vta";
								$result = mysql_query($consulta);            // hace la consulta
								$reg = mysql_fetch_row($result);
								$cond_vta= $reg[0];
				
								$consulta ="select nombre from zona where cod_zona = $cod_zona";
								$result = mysql_query($consulta);            // hace la consulta
								$reg = mysql_fetch_row($result);
								$zona= $reg[0];
								
								$consulta ="select nombre from localidad where cod_localidad = $cod_localidad";
								$result = mysql_query($consulta);            // hace la consulta
								$reg = mysql_fetch_row($result);        	// toma el registro
								$localidad= $reg[0];
								
								$consulta ="select nombre from provincia where cod_prov = $cod_prov";
								$result = mysql_query($consulta);            // hace la consulta
								$reg = mysql_fetch_row($result);
								$provincia= $reg[0];
								
								$consulta ="select nombre from pais where cod_pais = $cod_pais";
								$result = mysql_query($consulta);            // hace la consulta
								$reg = mysql_fetch_row($result);        	// toma el registro
								$pais= $reg[0];
				
								$consulta ="select descripcion from categoria where cod_categoria = $cod_cat ";
								$result = mysql_query($consulta);            // hace la consulta
								$reg = mysql_fetch_row($result);        	// toma el registro
								$categoria= $reg[0];
								
								$consulta ="select nombre from vendedor where cod_vendedor  = $cod_ven ";
								$result = mysql_query($consulta);            // hace la consulta
								$reg = mysql_fetch_row($result);        	// toma el registro
								$vendedor= $reg[0];
								
								$consulta ="select nombre from fletero where cod_flero = $cod_rep ";
								$result = mysql_query($consulta);            // hace la consulta
								$reg = mysql_fetch_row($result);        	// toma el registro
								$repartidor= $reg[0];
								*/
								if($contacto == ""){
									$contacto = "no";
								}			
								if($tel == ""){
									$tel = "no";
								}			
								if($fax == ""){
									$fax = "no";
								}			
								if($movil == ""){
									$movil = "no";
								}			
								if($lim_cred == ""){
									$lim_cred = "no";
								}			
								if($web == ""){
									$web = "no";
								}			
								if($mail == ""){
									$mail = "no";
								}			
													
								//***********************************************************************		
								header('Content-Type: text/xml'); 			// encabezado obligatorio XML
								echo "<clientes>\n"; 						// etiqueta superior
									echo '<codigo>' . $codigo . '</codigo>';
									echo '<contacto>' . $contacto . '</contacto>';  
									echo '<razon>' . $razon . '</razon>';  
									echo '<tel>' . $tel . '</tel>';  
									echo '<fax>' . $fax . '</fax>';
									echo '<movil>' . $movil . '</movil>';  
									echo '<dir>' . $dir . '</dir>';         
									#echo '<localidad>' . $localidad . '</localidad>'; 
									#echo '<provincia>' . $provincia . '</provincia>';
									#echo '<cond_iva>' . $cond_iva . '</cond_iva>';
									if($cuit1 != ""){
										$cuit="con";
										echo '<cuit>' . $cuit . '</cuit>';
										//-----------------------------------				
										echo '<cuit1>' . $cuit1 . '</cuit1>';
										echo '<cuit2>' . $cuit2 . '</cuit2>';
										echo '<cuit3>' . $cuit3 . '</cuit3>';
									}else{
										$cuit="sin";
										echo '<cuit>' . $cuit . '</cuit>';
									}
									echo '<lim_cred>' . $lim_cred . '</lim_cred>';    
									echo '<web>' . $web . '</web>';    
									echo '<mail>' . $mail . '</mail>';    
									
									#echo '<vendedor>' . $vendedor . '</vendedor>';    
									#echo '<repartidor>' . $repartidor . '</repartidor>';
									#echo '<cod_categoria>' . $cod_categoria . '</cod_categoria>';
									$error="0";								// el cliente existe
									echo '<error>' . $error . '</error>';
								echo "</clientes>";
						
						}else{
							header('Content-Type: text/xml'); 			// encabezado obligatorio XML
							echo "<clientes>\n"; 						// etiqueta superior
								$error="1";								// el cliente no existe
								echo '<error>' . $error . '</error>';
							echo "</clientes>";	
						}
						break;
	}
}
?>