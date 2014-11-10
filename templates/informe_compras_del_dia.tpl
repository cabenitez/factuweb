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
<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: document.frm.dia.focus();">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Seccion: Compras del Día
      <hr>
    </div></td>
    <td width="50%" align="right" valign="top" class="seccion">
      <hr></td>
	  
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:20%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#BFBFBF">
          <tr>
            <td width="18" height="19" rowspan="4" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
            <td colspan="2" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="18" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
          </tr>
          <tr>
            <td width="12" align="left" valign="bottom">Fecha:</td>
            <td width="151" align="left"valign="bottom">
             	<input name="dia" type="text" class="caja" id="dia"onKeyUp="pasar_foco_informe_vta_dia_1(event)" size="2" maxlength="2" value="{$dia}">
				/
				<input name="mes" type="text" class="caja" id="mes"onKeyUp="pasar_foco_informe_vta_dia_2(event)" size="2" maxlength="2" value="{$mes}">
				/
				<input name="ano" type="text" class="caja" id="ano" onKeyUp="pasar_foco_informe_vta_dia_3(event)" size="4" maxlength="4" value="{$ano}">
			 </td>
            <td width="18" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom">&nbsp;</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="buscar" type="button" class="botones" id="buscar" onclick="javascript: buscar_compra_dia()"  value="Buscar">
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
		<div id="listado_detalle_repartidor"></div>
		<div id="listado_detalle_comprobante"></div>
	</td>
  </tr>
</table>
</body>
</center>
</html>