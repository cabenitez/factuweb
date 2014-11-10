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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript:document.frm.codigo.focus();listar_grupo_buscar_alta_rem();">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" class="seccion" valign="top"><div align="left">Buscar Artículo
        <hr>
    </div></td>
  </tr>
  <tr>
    <td align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset style="width:70%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="77" height="19" rowspan="6" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="2" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="115" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="459" align="left" valign="bottom">
			<div align="left">Codigo:</div>			</td>
            <td width="331" align="left" valign="bottom">

                <input name="codigo" type="text" class="caja" id="codigo" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rem_vta_bus_4(event)" size="12" maxlength="9" >             </td>
            <td width="115" align="left"valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom"><div align="left"> Descripci&oacute;n:</div></td>
            <td align="left" valign="bottom">
			<input name="desc" type="text" class="caja" id="desc" onKeyUp="pasar_foco_rem_vta_bus_5(event)" size="29" ></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Grupo: </td>
            <td align="left" valign="bottom"><div id="grupos"></div></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom">&nbsp;</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: listar_grupo_buscar_alta_rem2()"  value="Buscar">
            </div></td>
            <td width="115" valign="top">

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
		<span class="botones"  style="cursor:pointer" onClick="javascript:window.close();">[Cerrar]</span>	
	</td>
  </tr>

</table>
</body>
</center>
</html>
