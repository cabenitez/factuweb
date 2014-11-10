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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0"> <!-- poner_foco_pais_mod() -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" class="seccion" valign="top">
	<div align="left"> Modificar Ingreso Bruto <hr width="100%"> </div></td>
  </tr>
  <tr>
    <td height="102" align="center" valign="top">
	
<form name="frm_mod"  id="frm_mod">	
<fieldset  style="width:20%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="18" height="19" rowspan="6" valign="top"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="2" valign="top"><div id="mensaje_mod" class="advertencia"></div></td>
            <td width="18" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
          </tr>
          <tr>
            <td width="12" valign="top"><div align="left">Nombre:
            </div></td>
            <td width="151" align="left"valign="top">
              <input name="nombre_mod" id="nombre_mod" type="text" class="caja" size="27" onKeyUp="pasar_foco_ib_4(event)" value="{$nombre}" >              </td>
            <td width="18" rowspan="2" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="12" valign="top">Tasa:</td>
            <td align="left"valign="top"><input name="tasa_mod" type="text" class="caja" id="tasa_mod"  onKeyPress="return solo_entero(event)" value="{$tasa}"onKeyUp="pasar_foco_ib_5(event)" size="5" maxlength="5" >
              %</td>
          </tr>
          <tr>
            <td valign="bottom">Provincia:</td>
            <td valign="bottom"><div id="localidades"></div></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom">&nbsp;</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto_mod" name= "oculto_mod" value="{$codigo}">
                <!-- campo oculto-->
                <input name="enviar_mod" type="button" class="botones" id="enviar_mod" onclick="javascript: modificar_ib_db()"  value="Modificar">
                <input name="cancelar_mod" type="button" class="botones" id="cancelar_mod" onclick="javascript: buscar_ib()"  value="Cancelar">
            </div></td>
            <td width="18" valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
		</fieldset>
</form>	</td>
  </tr>
  <tr>
    <td align="center" valign="top">
		<div id="msg"  class="advertencia"></div>
	</td>
  </tr>
</table>
</body>
</center>
</html>
