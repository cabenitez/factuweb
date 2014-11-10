<?
if($codigo){
	include("conexion.php");
	$consulta = "SELECT * FROM iva where cod_iva = $codigo"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$id= $registro[0];
	
	echo"<select name='nombre_mod' id='nombre_mod' class='caja'  onKeyUp='pasar_foco_cond_iva_4(event)'>"; 
			switch ($id) {
				 case 6:
					 echo"<option value=6 selected >CONSUMIDOR FINAL</option>";
					 echo"<option value=5>EXENTO</option>";
					 echo"<option value=7>NO CATEGORIZADO</option>";			  
					 echo"<option value=4>NO RESPONSABLE</option>";
					 echo"<option value=1>RESP. INSCRIPTO</option>";
					 echo"<option value=2>RESP. MONOTRIBUTO</option>";
					 echo"<option value=3>RESP. NO INSCRIPTO</option>";
					 echo"<option value=99>PRESUPUESTO</option>";
					 break;
				 case 5:
					 echo"<option value=6>CONSUMIDOR FINAL</option>";
					 echo"<option value=5 selected >EXENTO</option>";
					 echo"<option value=7>NO CATEGORIZADO</option>";			  
					 echo"<option value=4>NO RESPONSABLE</option>";
					 echo"<option value=1>RESP. INSCRIPTO</option>";
					 echo"<option value=2>RESP. MONOTRIBUTO</option>";
					 echo"<option value=3>RESP. NO INSCRIPTO</option>";
					 echo"<option value=99>PRESUPUESTO</option>";
					 break;
				 case 7:
					 echo"<option value=6>CONSUMIDOR FINAL</option>";
					 echo"<option value=5>EXENTO</option>";
					 echo"<option value=7 selected >NO CATEGORIZADO</option>";			  
					 echo"<option value=4>NO RESPONSABLE</option>";
					 echo"<option value=1>RESP. INSCRIPTO</option>";
					 echo"<option value=2>RESP. MONOTRIBUTO</option>";
					 echo"<option value=3>RESP. NO INSCRIPTO</option>";
					 echo"<option value=99>PRESUPUESTO</option>";
					 break;
				 case 4:
					 echo"<option value=6>CONSUMIDOR FINAL</option>";
					 echo"<option value=5>EXENTO</option>";
					 echo"<option value=7>NO CATEGORIZADO</option>";			  
					 echo"<option value=4 selected >NO RESPONSABLE</option>";
					 echo"<option value=1>RESP. INSCRIPTO</option>";
					 echo"<option value=2>RESP. MONOTRIBUTO</option>";
					 echo"<option value=3>RESP. NO INSCRIPTO</option>";
					 echo"<option value=99>PRESUPUESTO</option>";
					 break;
				 case 1:
					 echo"<option value=6>CONSUMIDOR FINAL</option>";
					 echo"<option value=5>EXENTO</option>";
					 echo"<option value=7>NO CATEGORIZADO</option>";			  
					 echo"<option value=4>NO RESPONSABLE</option>";
					 echo"<option value=1 selected >RESP. INSCRIPTO</option>";
					 echo"<option value=2>RESP. MONOTRIBUTO</option>";
					 echo"<option value=3>RESP. NO INSCRIPTO</option>";
					 echo"<option value=99>PRESUPUESTO</option>";
					 break;
				 case 2:
					 echo"<option value=6>CONSUMIDOR FINAL</option>";
					 echo"<option value=5>EXENTO</option>";
					 echo"<option value=7>NO CATEGORIZADO</option>";			  
					 echo"<option value=4>NO RESPONSABLE</option>";
					 echo"<option value=1>RESP. INSCRIPTO</option>";
					 echo"<option value=2 selected >RESP. MONOTRIBUTO</option>";
					 echo"<option value=3>RESP. NO INSCRIPTO</option>";
					 echo"<option value=99>PRESUPUESTO</option>";
					 break;
				 case 3:
					 echo"<option value=6>CONSUMIDOR FINAL</option>";
					 echo"<option value=5>EXENTO</option>";
					 echo"<option value=7>NO CATEGORIZADO</option>";			  
					 echo"<option value=4>NO RESPONSABLE</option>";
					 echo"<option value=1>RESP. INSCRIPTO</option>";
					 echo"<option value=2>RESP. MONOTRIBUTO</option>";
					 echo"<option value=3 selected >RESP. NO INSCRIPTO</option>";
					 echo"<option value=99>PRESUPUESTO</option>";
					 break;
				 case 99:
					 echo"<option value=6>CONSUMIDOR FINAL</option>";
					 echo"<option value=5>EXENTO</option>";
					 echo"<option value=7>NO CATEGORIZADO</option>";			  
					 echo"<option value=4>NO RESPONSABLE</option>";
					 echo"<option value=1>RESP. INSCRIPTO</option>";
					 echo"<option value=2>RESP. MONOTRIBUTO</option>";
					 echo"<option value=3>RESP. NO INSCRIPTO</option>";
					 echo"<option value=99 selected>PRESUPUESTO</option>";
					 break;

			 }
	echo"</select>";
}
?>