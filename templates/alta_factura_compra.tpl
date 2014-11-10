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
<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: listar_proveedores_fact_compra(); hora_actual();"> <!-- listar_zona_fac(); listar_cond_iva_fac();listar_cat_fac();listar_forma_pago(); -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0"><!--DWLayoutTable-->
  <tr>
    <td width="50%" height="21" class="seccion" valign="top">
	<div align="left">Seccion: Alta de Factura Compra<hr></div></td>
	 
    <td width="50%" align="right" valign="top" class="seccion">
	<!-- <img src="../imagenes/nuevo2.gif" width="16" height="18" border="0" class='iconos'  title="Nuevo" onClick=" window.opener.document.getElementById('principal').src ='alta_articulo.php'" /> nuevo &nbsp;&nbsp; -->
	
	<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir Factura... (F9)" class='iconos' onClick="javascript: registrar_factura_compra();" /> imprimir<hr></td>
	
	
    <td width="496" class="seccion" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <!-- <div align="right" >Buscar | Imprimir | PDF   </div> -->
  </tr>
  <tr>
    <td height="60" colspan="2" align="center" valign="top">
<form name="frm"  id="frm">	
<fieldset  style="width:98%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="60" align="center">
		<table width="100%" border="0" align="left" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="18" rowspan="2" valign="top" >
			<img src="../imagenes/18.jpg" width="18" height="18"/>
			</td>
            <td height="18" colspan="11" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="46" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
          </tr>
          <tr>
            <td width="37" align="left" valign="bottom">Fecha:</td>
            <td width="80"  align="left" valign="bottom" class="seccion">{$dia}/{$mes}/{$ano}
              <input type="hidden"  id="oculto_fecha"  name="oculto_fecha" value="{$ano}{$mes}{$dia}"></td>
            <td width="30"  align="left" valign="bottom">Hora:</td>
            <td width="62"  align="left" valign="bottom" class="seccion"><div id="hora_actual" ></div></td>
            <td width="62"  align="left"valign="bottom"> Proveedor: </td>
            <td colspan="2"  align="left"valign="bottom" class="seccion"><div id="proveedores"></div></td>
            <td width="94" align="left"valign="bottom">Fecha Compra: </td>
            <td width="149" align="left"valign="bottom">
<input name="dia" type="text" class="caja" id="dia"onKeyUp="pasar_foco_fac_compra_2(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
/
<input name="mes" type="text" class="caja" id="mes"onKeyUp="pasar_foco_fac_compra_3(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
/
<input name="ano" type="text" class="caja" id="ano"onKeyUp="pasar_foco_fac_compra_4(event)" onKeyPress="return solo_entero(event)"value="" size="4" maxlength="4"></td>
            <td width="47" align="left"valign="bottom"> Factura: </td>
            <td width="141" align="left"valign="bottom">
				<input name="num_suc" type="text" class="caja" id="num_suc"onKeyUp="pasar_foco_fac_compra_5(event)" onKeyPress="return solo_entero(event)"value="" size="4" maxlength="4"> 
              -
                <input name="num_fac" type="text" class="caja" id="num_fac" onKeyUp="pasar_foco_fac_compra_6(event)" onKeyPress="return solo_entero(event)"value="" size="8" maxlength="8">
                <img src="../imagenes/validar2.gif" width="13" height="11" title="Validar" class='iconos' onClick="javascript: validar_factura_compra()" /> </td>
            <td width="46" align="left"valign="bottom"></td>
          </tr>
        </table></td>
      </tr>
    </table>
</fieldset>
</form>	</td>
  </tr>
  <tr>
       <td height="47" colspan="2" align="center" valign="top">
			<form name="frm_art"  id="frm_art">	
			<fieldset  style="width:98%; height:10%;">
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td align="center">
					<table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
					  <tr>
						<td width="23" height="19" rowspan="2" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
						<td colspan="12" valign="top"><div id="mensaje_art" class="advertencia"></div></td>
						<td width="58" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
					  </tr>
					  <tr>
						
						<td width="46" align="left" valign="bottom"><div align="left"> C&oacute;digo: </div></td>
						<td width="105"align="left"   valign="bottom"><input  name="codigo_art"type="text" class="caja"  id="codigo_art" onKeyPress="return solo_entero(event)" onKeyUp="buscar_articulo_alta_factura_compra(event)" size="9" maxlength="9">
					    <img src="../imagenes/seguiente.gif" width="14" height="14" class="iconos" title="Buscar Artículo...     (F2)"onClick="seleccionar_articulo_factura_compra()"> </td>
						<td width="69"align="left"   valign="bottom"> Descripción:</td>
						<td width="503"align="left"   valign="bottom"><div id="desc_art" class="seccion"></div> <input type="hidden" id="oculto_desc_art" name="oculto_desc_art"> </td> 
						<td width="38" align="left" valign="bottom">Precio:</td>
						<td width="56" align="left" valign="bottom"><input name="precio_art"type="text" class="caja"  id="precio_art"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_fac_compra_7(event)" size="7" maxlength="7"></td>
						<td width="53" align="left" valign="bottom">Cantidad:</td>
						<td width="45" align="left" valign="bottom"><input name="cant_art"type="text" class="caja"  id="cant_art"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_fac_compra_8(event)" size="5" maxlength="5"></td>
						<td width="34" align="left" valign="bottom">Bonif.:</td>
						<td width="67" align="left" valign="bottom"><input name="bonif_art"type="text" class="caja"  id="bonif_art"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_fac_compra_9(event)" size="5" maxlength="5">
						  %</td>
						<td width="45" align="left" valign="bottom">Importe:</td>
						<td width="72" align="left" valign="bottom"><input name="importe_art"type="text" class="caja"  id="importe_art"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_fac_compra_10(event)" size="7" maxlength="7"></td>
						<td valign="top"><input name="busca_pop_up2" type="button" class="botones" id="busca_pop_up2"  style="visibility:hidden" onClick="javascript: buscar_articulo_factura_compra()"  value="a"></td>
					  </tr>
					</table>
					</td>
				  </tr>
				  <tr>
				    <td align="center">&nbsp;</td>
			      </tr>
			</table>
			</fieldset>
			</form>	 </td>
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