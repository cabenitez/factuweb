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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: document.frm.codigo.focus();listar_paises();listar_provincias();listar_localidades();listar_iva_rep();listar_vehiculo_rep();buscar_repartidor()">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Seccion: Alta de Repartidor 
        <hr>
    </div></td>
    <td width="50%" align="right" valign="top" class="seccion">
	<img src="../imagenes/lupa.jpg" width="16" height="18" border="0" class='iconos'  title="Nuevo" onClick=" window.opener.document.getElementById('principal').src ='buscar_repartidor.php'" /> buscar &nbsp;&nbsp;
	<img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_repartdor.php')" /> pdf  &nbsp;&nbsp;<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_repartdor.php')" /> imprimir<hr></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:50%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center">
		
		<table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="31" height="19" rowspan="9" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="5" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="48" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="203" align="left"valign="top">
			C&oacute;digo:
			</td>
            <td width="239" align="left" valign="top">

                <input name="codigo" type="text" class="caja" id="codigo" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rep_1(event)" size="7" maxlength="11" >             </td>
            <td width="1" align="left" valign="top">&nbsp;</td>
            <td width="93" align="left" valign="top">DNI:</td>
            <td width="163" align="left" valign="top"><input name="dni"type="text" class="caja"  id="dni"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rep_2(event)" size="8" maxlength="8">
				</td>
            <td width="48" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="top" align="left">Nombre y Apellido:</td>
            <td   valign="bottom"align="left"><input  name="nombre"  id="nombre"type="text" onKeyUp="pasar_foco_rep_3(event)"class="caja" size="30"></td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">Direcci&oacute;n: </td>
            <td   valign="bottom"align="left"><input  name="direccion"  id="direccion"type="text" onKeyUp="pasar_foco_rep_4(event)"class="caja" size="30"></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top" align="left">Pais:</td>
            <td   valign="bottom"align="left"><div  id="paises"></div></td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">Provincia:</td>
            <td   valign="bottom"align="left"><div  id="provincias"></div></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Localidad:</td>
            <td align="left" valign="bottom"><div  id="localidades"></div></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Telefono:</td>
            <td align="left" valign="bottom"><input name="tel"  id="tel" onKeyUp="pasar_foco_rep_5(event)" type="text" class="caja"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Condici&oacute;n de IVA: </td>
            <td align="left" valign="bottom"><div  id="iva"></div></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">CUIT:</td>
            <td align="left" valign="bottom"><input name="cuit1" id="cuit1" type="text" class="caja"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rep_6(event)" size="2" maxlength="2" >
-
  <input name="cuit2" type="text" class="caja" id="cuit2"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rep_7(event)" size="8" maxlength="8">
-
<input name="cuit3" type="text" class="caja" id="cuit3"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rep_8(event)" size="1" maxlength="1"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Veh&iacute;culo:</td>
            <td align="left" valign="bottom"><div  id="vehiculos"></div></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">&nbsp;</td>
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
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: registrar_repartidor()"  value="Registrar">
            </div></td>
            <td width="48" valign="top">

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
    <td colspan="2" align="center" valign="top">
		<div id="listado"></div>
		<div id="msg"  class="advertencia"></div>
	</td>
  </tr>

</table>
</body>
</center>
</html>
