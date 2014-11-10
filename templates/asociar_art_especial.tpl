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
<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0"onLoad="javascript: document.frm_art.codigo_art.focus();buscar_art_esp_asociado();" > <!-- onLoad="javascript: document.frm.remito.focus();listar_zona_fac(); listar_cond_iva_fac();listar_cat_fac();listar_forma_pago();hora_actual();" buscar_num_fac_vta(); -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0"><!--DWLayoutTable-->
  <tr>
    <td width="100%" height="21" class="seccion" valign="top">
	<div align="left">Seccion: Asociar Art&iacute;culos especiales <hr></div></td>
  </tr>
  <tr>
       <td height="47" colspan="2" align="center"  valign="top">
			<form name="frm_art"  id="frm_art">	
			<fieldset  style="width:70%; height:10%;">
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td align="center">
					<table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
					  <tr>
						<td height="19" colspan="7" valign="top"><div id="mensaje_art" class="advertencia"></div></td>
						<td width="50" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
					  </tr>
					  <tr>
						
						<td width="46" height="19" align="left" valign="bottom"><div align="left"> C&oacute;digo: </div></td>
						<td width="108"align="left"   valign="bottom"><input  name="codigo_art"type="text" class="caja"  id="codigo_art" onKeyPress="return solo_entero(event)" onKeyUp="buscar_articulo_asoc_art_especial(event)" size="9" maxlength="9">
					    <img src="../imagenes/seguiente.gif" width="14" height="14" class="iconos" title="Buscar Art&iacute;culo...     (F2)"onClick="seleccionar_articulo_asoc_art()"> </td>
						<td width="69"align="left"   valign="bottom"> Descripción:</td>
						<td width="583"align="left"   valign="bottom"><div id="desc_art" class="seccion"></div><input type="hidden"  id="oculto_desc_art"  name="oculto_desc_art">						  </td> 
						<td width="103" align="left" valign="bottom">	
						<select name="lista_casos" id="lista_casos" onkeyup="mostrar_ocultar_div_desc(event)" class="caja">
                          <!-- <option value="DE" selected>DESCUENTO</option> -->
                          <option value="NC"selected>NO COMPRA</option>
                          <!-- <option value="SC">SIN CARGO</option> -->
                          <option value="SF">SIN FACTURA</option>
                        </select>
						</td>
						<td width="75" align="right" valign="bottom">Valor</td>
						<td width="75" align="right" valign="bottom">
							  <input name="caja_desc"type="text" class="caja"  id="caja_desc" onKeyUp="alta_art_especial(event)" size="15" maxlength="15">
							  </td>
						<td valign="top"><input name="busca_pop_up2" type="button" class="botones" id="busca_pop_up2"  style="visibility:hidden" onClick="javascript: buscar_articulo_asoc_art()"  value="a"></td>
					  </tr>
					  <tr>
					    <td height="19" align="left" valign="bottom">&nbsp;</td>
					    <td align="left"   valign="bottom">&nbsp;</td>
					    <td align="left"   valign="bottom">&nbsp;</td>
					    <td align="left"   valign="bottom">&nbsp;</td>
					    <td align="left" valign="bottom">&nbsp;</td>
					    <td align="right" valign="bottom">&nbsp;</td>
					    <td align="right" valign="bottom">&nbsp;</td>
					    <td valign="top">&nbsp;</td>
				      </tr>
					  <tr>
					    <td height="19" colspan="8" align="left" valign="bottom"><div align="center">
					      <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: alta_art_especial_btn()"  value="Registrar">
				        </div></td>
				      </tr>
					</table>
					</td>
				  </tr>
			</table>
			</fieldset>
			</form>	 
	 </td>
   </tr>
   <tr>
    <td colspan="2" align="center" valign="top">
		<div id="listado"></div>
		<!-- <div id="msg"  class="advertencia"></div>-->
	</td>
  </tr>
</table>
</body>
</center>
</html>