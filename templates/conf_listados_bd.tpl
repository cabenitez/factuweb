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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: document.frm.filas.focus();listar_impr_conf_listados();">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Seccion: Configurar Listados
      <hr>
    </div></td>
    <td width="50%" align="right" valign="top" class="seccion"><!-- <img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_provincia.php')" /> pdf  &nbsp;&nbsp;<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_provincia.php')" /> imprimir--><hr> </td>
  </tr>
  <tr>
    <td height="84" colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:30%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="1" bordercolor="#BFBFBF">
          <tr>
            <td width="21" height="19" rowspan="5" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="2" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="36" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="456" align="left" valign="bottom"><div align="left"> Filas por p&aacute;gina:<br>
			</div>			</td>
            <td width="725" align="left" valign="bottom">

                <input name="filas" type="text" class="caja" id="filas" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_conf_listados_1(event)" size="3" maxlength="3" value="{$lineas}">             </td>
            <td width="36" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="bottom" align="left"><div align="left">Destino impresi&oacute;n:</div></td>
            <td   valign="bottom"align="left">
			<div id="impresoras"></div>
			</td>
            <td valign="top"><input name="textfield" type="text" disabled="disabled" size="1" maxlength="1" style="visibility:hidden"></td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom">&nbsp;</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: actualizar_conf_listados()"  value="Actualizar">
            </div></td>
            <td width="36" valign="top">

			</td>
          </tr>
        </table></td>
      </tr>
    </table>
		</fieldset>
</form>	</td>
  </tr>
   <tr>
    <td colspan="2" align="center" valign="top">
		<div id="listado" class="CFilas"></div>
		<div id="msg"> </div>	</td>
  </tr>

</table>
</body>
</center>
</html>
