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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: document.frm.cod_tal.focus();">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Seccion: Buscar Factura Venta
        <hr>
    </div></td>
    <td width="50%" align="right" valign="top" class="seccion"><!-- <img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_tipo_tal.php')" /> pdf  &nbsp;&nbsp;<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_tipo_tal.php')" /> imprimir --><hr></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:25%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center">
		<table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="18" height="-4" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="2" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="118" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="18" height="-1" valign="top" class="LLL"><div align="right"></div></td>
            <td width="805" align="left" valign="bottom">
			<div align="left">C&oacute;digo Talonario:</div>			</td>
            <td width="169" align="left" valign="bottom">

                <input name="cod_tal" type="text" class="caja" id="cod_tal" onKeyPress="return solo_letra(event)" onKeyUp="pasar_anular_f_1(event)" size="1" maxlength="1" >                </td>
            <td width="118" align="left"valign="top"></td>
          </tr>
          <tr>
            <td width="18" height="0" valign="top" class="LLL"><div align="right">
            </div></td>
            <td valign="bottom" align="left">N&uacute;mero Talonario :              </td>
            <td   valign="bottom"align="left">
				<input name="num_tal" type="text" class="caja" id="num_tal" onKeyPress="return solo_entero(event)" onKeyUp="pasar_anular_f_2(event)" value="" size="4" maxlength="4">
				</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td height="4" valign="top" class="LLL">&nbsp;</td>
            <td align="left" valign="bottom">N&uacute;mero Factura :</td>
            <td align="left" valign="bottom"><input name="num_fac" type="text" class="caja" id="num_fac" onKeyPress="return solo_entero(event)" onKeyUp="pasar_anular_f_3(event)" size="8" maxlength="8" ></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td width="18" height="4" valign="top" class="LLL">&nbsp;</td>
            <td colspan="2" valign="bottom">&nbsp;</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td width="18" height="9" valign="top" class="LLL">&nbsp;</td>
            <td colspan="2" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="buscar" type="button" class="botones" id="buscar" onclick="javascript: buscar_factura_vta()"  value="Buscar">

            </div></td>
            <td width="118" valign="top">

			</td>
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

		<div id="listado" class="CFilas"></div>
		<div id="listado_detalle_comprobante"  class="CFilas"></div>
	</td>
  </tr>

</table>
</body>
</center>
</html>
