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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: buscar_zona();poner_foco_zona()">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Seccion: Alta de Zona 
        <hr>
    </div></td>
    <td width="50%" align="right" valign="top" class="seccion">
	<img src="../imagenes/lupa.jpg" width="16" height="18" border="0" class='iconos'  title="Buscar" onClick=" window.opener.document.getElementById('principal').src ='buscar_zona.php'" /> buscar &nbsp;&nbsp;
	<img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_zona.php')" /> pdf  &nbsp;&nbsp;<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_zona.php')" /> imprimir<hr></td>
  </tr>
  <tr>
    <td height="102" colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:42%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="18" height="19" rowspan="5" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="5" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="25" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
          <td width="54" align="left" valign="bottom">Zona:		</td>
            <td width="127" align="left" valign="bottom">

          <input name="nombre" id="nombre" type="text" class="caja" size="25" onKeyUp="pasar_foco_zona_loca(event)" >             </td>
            <td width="1" align="left" valign="bottom">&nbsp;</td>
            <td width="78" align="left" valign="bottom">Localidad:</td>
            <td width="113" align="left" valign="bottom">
		  <div  id="localidades"></div>			</td>
            <td width="25" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="bottom" align="left">% Venta:</td>
            <td   valign="bottom"align="left"><input name="porc_vta" type="text" class="caja" id="porc_vta"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_zona_por_trans(event)" size="7" maxlength="5" >
			
			</td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">% Transporte: </td>
            <td   valign="bottom"align="left"><input name="porc_trans" type="text" class="caja" id="porc_trans"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_zona_enviar(event)" size="7" maxlength="5" ></td>
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
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: registrar_zona()"  value="Registrar">
            </div></td>
            <td width="25" valign="top">			</td>
          </tr>
        </table></td>
      </tr>
    </table>
	</fieldset>
</form>	</td>
  </tr>
   <tr>
    <td colspan="2" align="center" valign="top">
		<div id="listado"></div>
		<div id="msg"></div>	</td>
  </tr>

</table>
</body>
</center>
</html>
