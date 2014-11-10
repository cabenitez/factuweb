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
<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="document.frm.nombre.focus();" > 
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Seccion: Alta de Direccion Sistema Preventa  
      <hr>
    </div></td>
    <td width="50%" align="right" valign="top" class="seccion">
	<!-- <img src="../imagenes/lupa.jpg" width="18" height="18" border="0" class='iconos'  title="Buscar" onClick=" window.opener.document.getElementById('principal').src ='buscar_pais.php'" />buscar &nbsp;&nbsp;<img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_pais.php')" /> pdf  &nbsp;&nbsp;<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_pais.php')" /> imprimir -->
      <hr></td>
	  
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:50%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#BFBFBF">
          <tr>
            <td width="32" height="19" rowspan="4" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
            <td colspan="2" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="18" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
          </tr>
          <tr>
            <td width="437" align="left" valign="bottom">Dirección URL :</td>
            <td width="778" align="left"valign="bottom">http://
              <input name="nombre" id="nombre" type="text" class="caja_min" size="80" title="ejemplo: http://www.sistema-preventa.com"onKeyUp="pasar_foco_pais_registrar(event)" ></td>
            <td width="18" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="bottom"><input name="textfield" type="text"  disabled="disabled" class="caja" style="visibility:hidden" size="5" maxlength="1"></td>
            <td valign="bottom">&nbsp;</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: registrar_url_sis_preventa()"  value="Registrar">
            </div></td>
            <td width="18" valign="top">&nbsp;</td>
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
		<div id="msg"></div>
	</td>
  </tr>
</table>
</body>
</center>
</html>