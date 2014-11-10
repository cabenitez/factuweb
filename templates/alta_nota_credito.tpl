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
<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: document.frm.remito.focus();listar_zona_fac(); listar_cond_iva_fac();listar_cat_fac();listar_forma_pago();hora_actual();"> <!-- buscar_num_fac_vta(); -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0"><!--DWLayoutTable-->
  <tr>
    <td width="50%" height="21" class="seccion" valign="top">
	<div align="left">Seccion: Alta de Nota de Crédito<hr></div></td>
	 
    <td width="50%" align="right" valign="top" class="seccion">
<!-- 	<img src="../imagenes/nuevo2.gif" width="16" height="18" border="0" class='iconos'  title="Nuevo... (ESC)" onClick="javascript: window.opener.document.getElementById('principal').src ='alta_factura_vta.php';" /> nuevo &nbsp;&nbsp; -->	
 <img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir Factura... (F9)" class='iconos' onClick="javascript: registrar_nota_credito();" /> imprimir<hr></td>
	
	
    
    <!-- <td width="496" class="seccion" valign="top"></td> <div align="right" >Buscar | Imprimir | PDF   </div> -->
  </tr>
  <tr>
    <td height="127" colspan="2" align="center" valign="top">
<form name="frm"  id="frm">	
<fieldset  style="width:98%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center">
		<table width="100%" border="0" align="left" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="23" rowspan="5" valign="top" >
			<img src="../imagenes/18.jpg" width="18" height="18"/>
			</td>
            <td height="18" colspan="12" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="36" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
          </tr>
          <tr>
            <td width="75" align="left" valign="bottom">Talonario:</td>
            <td width="127"  align="left" valign="bottom" class="seccion"><div id="numero_tal"> 0000</div> <input type="hidden"  id="oculto_numero_tal"  name="oculto_numero_tal" >
              <input type="hidden"  id="oculto_codigo_tal"  name="oculto_codigo_tal" value="{$codigo_tal}">
              <input type="hidden"  id="oculto_num_pedido"  name="oculto_num_pedido"></td>
            <td  align="left" valign="bottom">Factura: </td>
            <td  align="left" valign="bottom" class="seccion"><div id="numero_fac">0000-00000000-A</div><input type="hidden"  id="oculto_numero_fac"  name="oculto_numero_fac" ></td>
            <td width="57"  align="left" valign="bottom" >Fecha:</td>
            <td width="120"  align="left" valign="bottom"class="seccion" >{$dia}/{$mes}/{$ano}
              <input type="hidden"  id="oculto_fecha"  name="oculto_fecha" value="{$ano}{$mes}{$dia}"></td>
            <td width="56"  align="left"valign="bottom">Hora:</td>
            <td width="75"  align="left"valign="bottom" class="seccion"><div id="hora_actual" ></div></td>
            <td width="61"  align="left"valign="bottom" >Remito:</td>
            <td width="109"  align="left"valign="bottom"><input  name="remito" type="text"class="select_1"  id="remito" onKeyPress="return solo_entero(event)" onKeyUp="buscar_remito_alta_factura_vta(event)" size="8" maxlength="8">
              <img src="../imagenes/seguiente.gif" width="14" height="14" class="iconos" title="Buscar Remito pendiente...     (F2)"onClick=" javascript: seleccionar_remito_factura_vta()"></td>
            <td width="45" align="left"valign="bottom"> Cliente: </td>
            <td width="197" align="left"valign="bottom"><input  name="codigo"type="text"class="select_1"  id="codigo" onKeyPress="return solo_entero(event)" onKeyUp="buscar_cliente_alta_fact_vta(event)" value="" size="5" maxlength="5">
              <img src="../imagenes/seguiente.gif" width="14" height="14" class="iconos" title="Buscar Cliente...     (F2)"onClick=" javascript: seleccionar_cliente_fact_vta()"></td>
            <td width="36" align="left"valign="bottom"></td>
          </tr>
          <tr>
            
			<td align="left" valign="bottom"><div align="left"> Nombre:</div></td>
            <td valign="bottom"><input name="razon"  id="razon"type="text" class="caja"  onKeyUp="pasar_foco_rem_vta_1(event)" size="20"></td>
            <td align="left"   valign="bottom">Direcci&oacute;n:</td>
            <td align="left"   valign="bottom"><input name="dir"  id="dir"type="text" class="caja"  onKeyUp="pasar_foco_rem_vta_2(event)" size="20"></td>
            <td align="left"   valign="bottom">Localidad:</td>
            <td align="left"   valign="bottom"><input name="localidad"  id="localidad"type="text" class="caja"  onKeyUp="pasar_foco_rem_vta_3(event)" size="15"></td>
            <td align="left"   valign="bottom">Provincia:</td>
            <td align="left"   valign="bottom"><input name="provincia"  id="provincia"type="text" class="caja"  onKeyUp="pasar_foco_rem_vta_4(event)" size="15"></td>
            <td align="left"   valign="bottom">Zona:</td>
            <td colspan="3"align="left"   valign="bottom"><div id="zonas"></div></td>
            <td align="left" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Cond. IVA: </td>
            <td align="left" valign="bottom"><div id="cond_iva"></div></td>
            <td width="70" align="left" valign="bottom">CUIT:</td>
            <td colspan="2" align="left" valign="bottom">
			<input name="cuit1" id="cuit1" type="text" class="caja"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rem_vta_6(event)" size="2" maxlength="2" >
			-
			<input name="cuit2" type="text" class="caja" id="cuit2"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rem_vta_7(event)" size="8" maxlength="8">
			-
			<input name="cuit3" type="text" class="caja" id="cuit3"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rem_vta_8(event)" size="1" maxlength="1">			</td>
            <td align="left" valign="bottom"><input name="busca_pop_up" type="button" class="botones" id="busca_pop_up"  style="visibility:hidden" onClick="javascript: buscar_cliente_fact_vta()"  value="c">
              <input name="busca_pop_up3" type="button" class="botones" id="busca_pop_up3"  style="visibility:hidden" onClick="javascript: buscar_remito_factura_vta()"  value="r"></td>
            <td align="left" valign="bottom">Vendedor:</td>
            <td align="left" valign="bottom"><input name="vendedor" type="text" class="caja"  id="vendedor"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rem_vta_9(event)" size="3" maxlength="3"></td>
            <td align="left" valign="bottom">Repartidor:</td>
            <td align="left" valign="bottom"><input name="repartidor" type="text" class="caja" id="repartidor"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rem_vta_10(event)" size="3" maxlength="3"></td>
            <td colspan="2" align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Categor&iacute;a:</td>
            <td align="left" valign="bottom"><div id="categorias"></div></td>
            <td align="left" valign="bottom">Lugar:</td>
            <td width="184" align="left" valign="bottom"><input name="lugar" type="text" class="caja"  id="lugar"  onKeyUp="pasar_foco_fac_vta_11(event)" size="20" maxlength="20"></td>
            <td align="left" valign="bottom">Hora: </td>
            <td align="left" valign="bottom"><input name="hora"type="text" class="caja"  id="hora"  onKeyUp="pasar_foco_fac_vta_12(event)" size="10" maxlength="20"></td>
            <td align="left" valign="bottom">Observ:</td>
            <td align="left" valign="bottom"><input name="obs" type="text" class="caja" id="obs" onKeyUp="pasar_foco_rem_vta_13(event)" value="" size="15" maxlength="20"></td>
            <td align="left" valign="bottom">Bonif.:</td>
            <td align="left" valign="bottom"><input name="bonif" type="text" class="caja" id="bonif"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_fac_vta_14(event)" size="5" maxlength="5">
%  </td>
            <td colspan="2" align="left" valign="bottom">&nbsp;</td>
            </tr>
          <tr>
            <td valign="top" >&nbsp;</td>
            <td align="left" valign="bottom">F. Pago:</td>
            <td colspan="3" align="left" valign="bottom"><div id="cond_pago"></div></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td colspan="2" align="left" valign="bottom">&nbsp;</td>
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
						<td width="26" height="19" rowspan="2" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
						<td colspan="12" valign="top"><div id="mensaje_art" class="advertencia"></div></td>
						<td width="43" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
					  </tr>
					  <tr>
						
						<td width="46" align="left" valign="bottom"><div align="left"> C&oacute;digo: </div></td>
						<td width="109"align="left"   valign="bottom"><input  name="codigo_art"type="text" class="caja"  id="codigo_art" onKeyPress="return solo_entero(event)" onKeyUp="buscar_articulo_alta_remito(event)" size="9" maxlength="9">
					    <img src="../imagenes/seguiente.gif" width="14" height="14" class="iconos" title="Buscar Art&iacute;culo...     (F2)"onClick="seleccionar_articulo_remito_vta()"> </td>
						<td width="69"align="left"   valign="bottom"> Descripción:</td>
						<td width="416"align="left"   valign="bottom"><div id="desc_art" class="seccion"></div><input type="hidden"  id="oculto_desc_art"  name="oculto_desc_art">
						  <input type="hidden"  id="oculto_stock"  name="oculto_stock"></td> 
						<td width="49" align="left" valign="bottom">Precio:</td>
						<td width="82" align="left" valign="bottom"><div id="precio_art" class="seccion">0.00</div>
						  <input type="hidden"  id="oculto_precio_art"  name="oculto_precio_art">						</td>
						<td width="53" align="left" valign="bottom">Cantidad:</td>
						<td width="25" align="left" valign="bottom"><input name="cant_art"type="text" class="caja"  id="cant_art"  onKeyPress="return solo_entero(event)" onKeyUp="calcular_importe_fac(event)" size="5" maxlength="5"></td>
						<td width="34" align="left" valign="bottom">Bonif.:</td>
						<td width="94" align="left" valign="bottom"><input name="bonif_art"type="text" class="caja"  id="bonif_art"  onKeyPress="return solo_entero(event)" onKeyUp="calcular_importe_fac(event)" size="5" maxlength="5">
						  %</td>
						<td width="45" align="left" valign="bottom">Importe:</td>
						<td width="144" align="left" valign="bottom"><div id="importe_art" class="seccion">0.00</div>
						  <input type="hidden"  id="oculto_importe_art"  name="oculto_importe_art"></td>
						<td valign="top"><input name="busca_pop_up2" type="button" class="botones" id="busca_pop_up2"  style="visibility:hidden" onClick="javascript: buscar_articulo_remito_vta()"  value="a"></td>
					  </tr>
					</table>
					</td>
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