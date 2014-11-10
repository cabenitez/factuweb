{config_load file="conf.conf"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{#tituloPagina#}</title>

	<!-- META -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/autocompletador.css" charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/autocompletador2.css" charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="class_modal/css/ventana-modal.css">
	<link rel="stylesheet" type="text/css" href="class_modal/css/style.css">

	<!-- JS -->
	<script language="javascript" src="../js/ajax.js"></script>
	<script language="javascript" src="../js/paginador.js"></script>
	<script language="javascript" src="../js/autocompletador.js" charset="utf-8"></script> 
	<script language="javascript" src="class_modal/js/ventana-modal-1.1.1.js"></script>
	<script language="javascript" src="class_modal/js/abrir-ventana-fija.js"></script>
	<script language="javascript" src="../js/tooltip.js"></script>
	
	<!-- FAVICON 16 x 16 -->
	<link rel="shortcut icon"  href="../imagenes/favicon.ico">

</head>
<center> <!-- background="../imagenes/fondo_cuadrito.gif" -->
<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: document.frm.dia.focus();"> 
<table width="100%" height="100%"   border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" class="seccion" valign="top"><div align="left">Seccion: Informe Cervecería<hr></div></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="top">
		<div style="width:52%; " id="msg_mod"  class="nota">
			<img src="../imagenes/advertencia.gif" width="16" height="16"> Se generaran los archivos <b>TXT</b>, Los nombres <b>NO</b> deben ser modificados 
		</div>
	</td>
  </tr>
  
  <tr>
	<td align="center">	
		<br>
		
		
<form name="frm"  id="frm">	
	<fieldset  style="width:25%; height:10%;">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
			  <tr>
				<td width="35" height="19" rowspan="3" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
				<td colspan="2" valign="top"><div id="mensaje" class="advertencia"></div></td>
				<td width="44" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
			  </tr>
			  <tr>
				<td width="461" align="left" valign="bottom">Fecha desde: </td>
				<td width="698"align="left"   valign="bottom">
					  <input name="dia" type="text" class="caja" id="dia"onKeyUp="informe_compras_cliente_3(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
					  /
					  <input name="mes" type="text" class="caja" id="mes"onKeyUp="pasar_foco_iva_ventas_2(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
					  /
					  <input name="ano" type="text" class="caja" id="ano"onKeyUp="pasar_foco_iva_ventas_3(event)" onKeyPress="return solo_entero(event)"value="" size="4" maxlength="4">
				</td>
				<td valign="top"></td>
			  </tr>
			  <tr>
				<td align="left" valign="bottom"> Fecha hasta:</td>
				<td align="left" valign="bottom">
					  <input name="dia_h" type="text" class="caja" id="dia_h"onKeyUp="informe_compras_cliente_4(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
					  /
					  <input name="mes_h" type="text" class="caja" id="mes_h"onKeyUp="pasar_foco_iva_ventas_5(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
					  /
					  <input name="ano_h" type="text" class="caja" id="ano_h"  onKeyPress="return solo_entero(event)"value="" size="4" maxlength="4"> <!-- onKeyUp="pasar_foco_iva_ventas_6(event)" -->
				<td valign="top"></td>
			  </tr>
        </table></td>
      </tr>
    </table>
	</fieldset>
</form>	
<br>		
	<fieldset  style="width:49%; height:100%;">
			<div id="mensage" class="advertencia"></div>
				 <table align="left" width="100%"    border="0" cellpadding="0" cellspacing="0"> 
					<tr>
						<td width="25%">
							<input name="enviar1"  align="left" type="button" class="botones" id="enviar1" onclick="javascript: generar_archivos_txt('referencia')"  value="Generar REFERENCIA" >
						</td>
						<td><div id="div_referencia"></div></td>
					</tr>
					<tr>
					  <td height="22">
					  		<input name="enviar2"  align="left" type="button" class="botones" id="enviar2" onclick="javascript: generar_archivos_txt('stock')"  value="Generar STOCK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ></td>
					  <td><div id="div_stock"></div></td>
				  </tr>
					<tr>
					  <td height="22">
					  		<input name="enviar3"  align="left" type="button" class="botones" id="enviar3" onclick="javascript: generar_archivos_txt('total')"  value="Generar TOTALES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ></td>
					  <td><div id="div_total"></div></td>
				  </tr>
					<tr>
						<td width="20%">
							<input name="enviar4"  align="left" type="button" class="botones" id="enviar4" onclick="javascript: generar_archivos_txt('ventas')"  value="Generar VENTAS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" >
						</td>
						<td><div id="div_venta"></div></td>
					</tr>
		</table>
	</fieldset>
	</td>
  </tr>
 </table>
</body>
</center>
</html>