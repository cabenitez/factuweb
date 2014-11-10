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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="document.frm.dia.focus();">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Seccion: Buscar Depositos 
        <hr>
    </div></td>
    <td width="50%" align="right" valign="top" class="seccion">
	<img src="../imagenes/nuevo2.gif" width="16" height="18" border="0" class='iconos'  title="Nuevo" onClick=" window.opener.document.getElementById('principal').src ='alta_deposito_compra.php'" /> nuevo &nbsp;&nbsp;
	<img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_depositos_compra.php')" /> pdf  &nbsp;&nbsp;
	<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_depositos_compra.php')" /> imprimir<hr></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:45%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center">
		
		<table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="18" height="19" rowspan="6" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="5" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="31" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="91" align="left" valign="bottom">
		   Fecha desde:	</td>
            <td width="87" align="left" valign="bottom">
				<input name="dia" type="text" class="caja"  id="dia" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_dep_buscar_1(event)" size="2" maxlength="2">
				/
				<input name="mes" type="text" class="caja"  id="mes" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_dep_buscar_2(event)" size="2" maxlength="2">
				/
				<input name="ano" type="text" class="caja"  id="ano" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_dep_buscar_3(event)" size="4" maxlength="4"></td>
            <td width="1" align="left" valign="bottom">&nbsp;</td>
            <td width="88" align="left" valign="bottom">Fecha hasta :</td>
            <td width="100" align="left" valign="bottom">
				<input name="dia2" type="text" class="caja"  id="dia2" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_dep_buscar_4(event)" size="2" maxlength="2">
				/
				<input name="mes2" type="text" class="caja"  id="mes2" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_dep_buscar_5(event)" size="2" maxlength="2">
				/
				<input name="ano2" type="text" class="caja"  id="ano2" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_dep_buscar_6(event)" size="4" maxlength="4"></td>
            <td width="31" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="bottom" align="left">Banco:</td>
            <td   valign="bottom"align="left"><input name="banco"type="text" class="caja"  id="banco"   onKeyUp="pasar_foco_dep_buscar_7(event)" ></td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">N&ordm; Transacci&oacute;n: </td>
            <td   valign="bottom"align="left"><input name="trans"type="text" class="caja"  id="trans"   onKeyUp="pasar_foco_dep_buscar_8(event)" ></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="bottom" align="left">N&ordm; Cuenta:</td>
            <td   valign="bottom"align="left"><input name="cta"type="text" class="caja"  id="cta"   onKeyUp="pasar_foco_dep_buscar_9(event)"  ></td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">Titular: </td>
            <td   valign="bottom"align="left"><input name="tiular"type="text" class="caja"  id="titular"   onKeyUp="pasar_foco_dep_buscar_10(event)"  ></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5" valign="bottom">&nbsp;</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="5" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: buscar_deposito_proceso()"  value="Buscar">
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