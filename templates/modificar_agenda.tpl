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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td height="21" valign="top" class="seccion"><div align="left">Seccion: Modificar agenda Telefónica <hr> </div>        
	  <!-- <img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_vehiculo.php')" /> pdf  &nbsp;&nbsp;<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_vehiculo.php')" /> imprimir -->	</td>
    </tr>
  <tr>
    <td align="center" valign="top">
	
<form name="frm_mod"  id="frm_mod">	
<fieldset  style="width:24%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="68" height="19" rowspan="6" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="2" valign="top"><div id="mensaje_mod" class="advertencia"></div></td>
            <td width="19" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="968" align="left"valign="top">
			Nombre:		  </td>
            <td width="200" align="left" valign="top"><input name="nombre_mod" type="text" class="caja"  id="nombre_mod"  onkeypress="return tabular(event,this)" size="30" maxlength="50"value="{$nombre}"></td>
            <td width="19" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="top" align="left">Telefono:</td>
            <td   valign="bottom"align="left"><input name="tel_mod" type="text" class="caja"  id="tel_mod" onkeypress="return tabular(event,this)" size="30" maxlength="50"value="{$telefono}"></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="bottom"align="left">e-mail:</td>
            <td valign="bottom"align="left">
              <input name="mail_mod"  id="mail_mod"type="text" class="caja" size="40" onkeypress="return tabular(event,this)" value="{$correo}">
            </td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom">&nbsp;</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom"><div align="center">
                <!-- campo oculto-->
                <input name="enviar_mod" type="button" class="botones" id="enviar_mod" onclick="javascript: modificar_agenda_db()"  value="Modificar">
            	<input name="cancelar_mod" type="button" class="botones" id="cancelar_mod" onclick="javascript: buscar_agenda()"  value="Cancelar">
            	<input type="hidden"  id="oculto_mod" name= "oculto_mod" value="{$codigo}">
            </div></td>
            <td width="19" valign="top">			</td>
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
		<div id="listado_mod" class="CFilas"></div>
		<div id="msg"  class="advertencia"></div>
	</td>

  </tr>

</table>
</body>
</center>
</html>
