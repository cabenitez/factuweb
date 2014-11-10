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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: poner_foco_vehiculo();buscar_vehiculo()">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Seccion: Alta de Vehículo 
        <hr>
    </div></td>
    <td width="50%" align="right" valign="top" class="seccion">
	<img src="../imagenes/lupa.jpg" width="16" height="18" border="0" class='iconos'  title="Nuevo" onClick=" window.opener.document.getElementById('principal').src ='buscar_vehiculo.php'" /> buscar &nbsp;&nbsp;
	<img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_vehiculo.php')" /> pdf  &nbsp;&nbsp;<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_vehiculo.php')" /> imprimir<hr></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:47%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="19" height="19" rowspan="6" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="5" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="33" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="118" align="left"valign="top">
			Codigo:		  </td>
          <td width="187" align="left" valign="top"><input name="codigo"type="text" class="caja"  id="codigo"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_vehi_0(event)" size="10" maxlength="7"></td>
            <td width="1" align="left" valign="top">&nbsp;</td>
            <td width="53" align="left" valign="top">Patente:</td>
          <td width="152" align="left" valign="top"><input name="patente" type="text" class="caja" id="patente" onKeyUp="pasar_foco_vehi_1(event)" size="10" maxlength="7" ></td>
            <td width="33" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="top" align="left">Patente acoplado :</td>
            <td   valign="bottom"align="left"><input name="patente_a"type="text" class="caja"  id="patente_a" onKeyUp="pasar_foco_vehi_2(event)" size="10" maxlength="7"></td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">Marca: </td>
            <td   valign="bottom"align="left"><input name="marca"  id="marca"type="text" class="caja" size="30" onKeyUp="pasar_foco_vehi_3(event)"> </td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="bottom"align="left">Modelo:</td>
            <td valign="bottom"align="left">
              <input name="modelo"  id="modelo"type="text" class="caja" size="30" onKeyUp="pasar_foco_vehi_4(event)">
            </td>
            <td valign="bottom">&nbsp;</td>
            <td valign="bottom">Propio:</td>
            <td  align="left"valign="bottom"><input type="checkbox" name="propio" id="propio" value="checkbox" onKeyUp="pasar_foco_vehi_5(event)"></td>
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
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: registrar_vehiculo()"  value="Registrar">
            </div></td>
            <td width="33" valign="top">			</td>
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
