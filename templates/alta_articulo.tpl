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
<center>
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: listar_grupos_art();listar_marcas_art();listar_variedades_art();listar_proveedores_art();listar_medidas_art();listar_iva_art();listar_categorias_art();buscar_articulo();">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top">
	<div align="left">Seccion: Alta de Artículo <hr></div></td> 
    <td width="50%" align="right" valign="top" class="seccion"><img src="../imagenes/lupa.jpg" width="18" height="18" border="0" class='iconos'  title="Buscar" onClick=" window.opener.document.getElementById('principal').src ='buscar_articulo.php'" />buscar &nbsp;&nbsp;<img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_articulo.php')" /> pdf  &nbsp;&nbsp;<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_articulo.php')" /> imprimir<hr></td>
    <!-- <div align="right" >Buscar | Imprimir | PDF   </div> -->
  
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:55%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="26" height="19" rowspan="14" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="7" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="19" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Grupo:</td>
            <td colspan="3" align="left" valign="bottom"><div id="grupos"></div></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Marca:</td>
            <td align="left" valign="bottom"><div id="marcas"></div></td>
            <td align="left"valign="top"></td>
          </tr>
          <tr>
            <td width="120" align="left" valign="bottom">
			Variedad:			</td>
            <td colspan="3" align="left" valign="bottom"><div id="variedades"></div></td>
            <td width="9" align="left" valign="bottom">&nbsp;</td>
            <td width="174" align="left" valign="bottom">C&oacute;digo:</td>
            <td width="225" align="left" valign="bottom"><input name="codigo" type="text" class="caja" id="codigo" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_2(event)" size="12" maxlength="9" >
          <img src="../imagenes/seguiente.gif" width="14" height="14" class="iconos" title="Buscar Siguiente...     (F2)"onClick="buscar_cod_sig_art()"></td>
            <td width="19" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="bottom" align="left">Descripci&oacute;n:</td>
            <td colspan="3"align="left"   valign="bottom"><input name="desc" id="desc" type="text" class="caja"  onKeyUp="pasar_foco_art_3(event)" size="30"> </td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">Proveedor: </td>
            <td   valign="bottom"align="left"><div id="proveedores"></div></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="bottom" align="left">Precio de Costo:</td>
            <td colspan="3"align="left"   valign="bottom"><input name="precio_costo" type="text" class="caja" id="precio_costo" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_5(event)" size="12" maxlength="9" ></td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">Unidad por Bulto: </td>
            <td   valign="bottom"align="left"><input  name="unidad_bulto" type="text"class="caja"  id="unidad_bulto" onKeyUp="pasar_foco_art_6(event)" size="12" maxlength="9"></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Medida:</td>
            <td width="117" align="left" valign="bottom">
			<input name="medida" type="text" class="caja" id="medida" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_7(event)" size="7" maxlength="7" >		  </td>
            <td colspan="2" align="left" valign="bottom">
			<div  id="medidas"></div>			</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Peso:</td>
            <td align="left" valign="bottom">
              <input name="peso" type="text" class="caja" id="peso" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_9(event)" size="12" maxlength="9" >
Kg.</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Retornable:</td>
            <td colspan="3" align="left" valign="bottom">
			<select name="retornable"  id="retornable" onkeyup="pasar_foco_art_10(event)" class="caja">
              <option value="SI">SI</option>
              <option value="NO">NO</option>
            </select></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Stock actual:</td>
            <td align="left" valign="bottom"><input name="stock_actual" type="text" class="caja" id="stock_actual" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_11(event)" size="12" maxlength="9" >            </td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Stock m&iacute;nimo:</td>
            <td colspan="3" align="left" valign="bottom"><input name="stock_min" type="text" class="caja"  id="stock_min" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_12(event)" size="12" maxlength="9"></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Stock m&aacute;ximo:</td>
            <td align="left" valign="bottom"><input name="stock_max" type="text" class="caja"  id="stock_max" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_13(event)" size="12" maxlength="9"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Comisi&oacute;n Vta: </td>
            <td colspan="3" align="left" valign="bottom"><input name="vta" type="vta" class="caja"  id="vta" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_14(event)" size="12" maxlength="9">
            %</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Comisi&oacute;n Transporte:</td>
            <td align="left" valign="bottom"><input name="transporte" type="text" class="caja"  id="transporte" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_15(event)" size="12" maxlength="9">
            %</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom"  >IVA:</td>
            <td colspan="3" align="left" valign="bottom"  ><div id="iva"></div></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td colspan="2" align="center" valign="middle"></td>
            <td valign="top"></td>
          </tr>
          <tr>
<td colspan="4" align="left" valign="bottom"  >&nbsp;</td>
<td align="left" valign="bottom">&nbsp;</td>
<td colspan="2" align="center" valign="middle"></td>
<td valign="top"></td>
</tr>
<tr>
  <td colspan="7" align="left" valign="bottom"  >
  <div class="seccion" align="left">Precios de venta según categoría
    <hr>
  </div>
  <div id="categorias"></div>					  </td>
  <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="7" align="left" valign="bottom">&nbsp;			</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="7" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: registrar_articulo()"  value="Registrar">
            </div></td>
            <td width="19" valign="top">			</td>
          </tr>
        </table></td>
      </tr>
    </table>
	</fieldset>
</form>	
	</td>
  </tr>
   <tr>
    <td colspan="2" align="center" valign="top">
		<div id="listado"></div>
		<div id="msg"  class="advertencia"></div>
	</td>
  </tr>

</table>
</body>
</center>
</html>
