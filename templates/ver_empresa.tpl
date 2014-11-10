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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" > <!-- onLoad="jabascript: mostrar_imagenes()" -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" align="center" valign="top">
	<div id="cuerpo"></div>

<form name="frm"  id="frm">	
<fieldset  style="width:85%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="37" height="19" rowspan="9" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td width="104" align="left" valign="bottom">
			<div align="left">Razon Social:</div>			</td>
            <td width="197" align="left" class="botones"valign="bottom">{$razon}</td>
            <td width="63" align="left" valign="bottom">Propietario:</td>
            <td width="222" align="left" class="botones"valign="bottom">{$dueno}</td>
            <td width="88" align="left" valign="bottom">CUIT: </td>
            <td width="217" align="left" class="botones"valign="bottom">{$cuit1}-{$cuit2}-{$cuit3}</td>
            <td width="63" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="bottom" align="left">Ing. Brutos : </td>
            <td  valign="bottom"class="botones"align="left">{$ing_bruto}</td>
            <td align="left"   valign="bottom">IVA:</td>
            <td align="left"   class="botones"valign="bottom">{$iva}</td>
            <td   valign="bottom"align="left">Direcci&oacute;n: </td>
            <td   valign="bottom"class="botones"align="left">{$dir}</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Pais:</td>
            <td align="left" valign="bottom"class="botones">{$pais}</td>
            <td align="left" valign="bottom">Provincia:</td>
            <td align="left" valign="bottom"class="botones">{$prov}</td>
            <td align="left" valign="bottom">Localidad:</td>
            <td align="left" valign="bottom"class="botones">{$loca}</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Telefono:</td>
            <td align="left" valign="bottom"class="botones">{$tel} </td>
            <td align="left" valign="bottom">Fax:</td>
            <td align="left" valign="bottom"class="botones">{$fax}</td>
            <td align="left" valign="bottom">Celular: </td>
            <td align="left" valign="bottom"class="botones">{$cel} </td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Web:</td>
            <td align="left" valign="bottom"class="botones">{$web}</td>
            <td align="left" valign="bottom">E-mail:</td>
            <td align="left" valign="bottom"class="botones">{$mail}</td>
            <td align="left" valign="bottom">Inicio de Act.:</td>
            <td align="left" valign="bottom"class="botones">{$dia}/{$mes}/{$ano} </td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="6" valign="bottom" align="left"><hr></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom" align="left"><div id="logo"></div></td>
            <td colspan="2" valign="bottom">&nbsp;</td>
            <td colspan="2" valign="bottom" align="center"><div id="fondo"></div></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="6" valign="bottom">&nbsp;</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="6" valign="bottom"align="center"><input name="enviar_mod" type="button" class="botones" id="enviar_mod" onclick="javascript: mostrar_datos_empresa()"  value="Modificar">
           </td>
            <td width="63" valign="top">

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
    <td align="center" valign="top">
		<div id="listado"></div>
		<div id="msg"  class="advertencia"></div>
	</td>
  </tr>

</table>
</body>
</center>
</html>
