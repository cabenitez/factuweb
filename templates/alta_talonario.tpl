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
<body  leftmargin="0" topmargin="0"  marginheight="0" onLoad="javascript: listar_tt_tal_reg();buscar_talonario(); listar_impr_alta_talonario();" marginwidth="0"> <!--  -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Seccion: Alta de Talonario 
        <hr>
    </div></td>
    <td width="50%" align="right" valign="top" class="seccion">
	<img src="../imagenes/lupa.jpg" width="16" height="18" border="0" class='iconos'  title="Nuevo" onClick=" window.opener.document.getElementById('principal').src ='buscar_talonario.php'" /> buscar &nbsp;&nbsp;
	<img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_talonario.php')" /> pdf  &nbsp;&nbsp;<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_talonario.php')" /> imprimir<hr></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:50%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center">
		
		<table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="18" height="19" rowspan="8" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="5" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="31" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="91" align="left" valign="bottom">
		   Comprobante:	</td>
          <td width="87" align="left" valign="bottom"><div  id="tt"></div></td>
            <td width="1" align="left" valign="bottom">&nbsp;</td>
            <td width="88" align="left" valign="bottom">N&ordm; Talonario:</td>
            <td width="100" align="left" valign="bottom"><input name="numero" type="text" class="caja"  id="numero"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_2(event)" size="12">
		  </td>
            <td width="31" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="bottom" align="left">N&ordm; Sucursal:</td>
            <td   valign="bottom"align="left"><input name="sucursal"type="text" class="caja"  id="sucursal"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_3(event)" size="12" maxlength="9"></td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">N&ordm; Iteraciones: </td>
            <td   valign="bottom"align="left"><input name="iteraciones"type="text" class="caja"  id="iteraciones"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_4(event)" size="12" maxlength="9"></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="bottom" align="left">Primer N&uacute;mero:</td>
            <td   valign="bottom"align="left"><input name="primer_num"type="text" class="caja"  id="primer_num"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_5(event)" size="12" maxlength="9"></td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">Ultimo N&uacute;mero: </td>
            <td   valign="bottom"align="left"><input name="ultimo_num"type="text" class="caja"  id="ultimo_num"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_6(event)" size="12" maxlength="9"></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Siguiente N&uacute;mero:</td>
            <td align="left" valign="bottom"><input name="sig_num"type="text" class="caja"  id="sig_num"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_7(event)" size="12" maxlength="9"></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Fecha Vto:</td>
            <td align="left" valign="bottom"><input name="dia" type="text" class="caja"  id="dia" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_8()" size="2" maxlength="2">
              /
                <input name="mes" type="text" class="caja"  id="mes" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_9()" size="2" maxlength="2">
                /
                <input name="ano" type="text" class="caja"  id="ano" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_10()" size="4" maxlength="4"><!-- {#calendario#} --></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">N&ordm; CAI:</td>
            <td align="left" valign="bottom"><input name="cai"type="text" class="caja"  id="cai"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_11(event)" size="12"></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Impresora: </td>
            <td align="left" valign="bottom"><div id="impresoras"></div></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="5" valign="bottom">&nbsp;</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="5" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: registrar_talonario()"  value="Registrar">
            </div></td>
            <td width="31" valign="top">			</td>
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