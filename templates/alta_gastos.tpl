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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: document.frm.dia.focus();buscar_gasto();" >
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top">
	<div align="left">Seccion: Alta de Gastos <hr></div></td> 
    <td width="50%" align="right" valign="top" class="seccion">
	<img src="../imagenes/lupa.jpg" width="16" height="18" border="0" class='iconos'  title="Nuevo" onClick=" window.opener.document.getElementById('principal').src ='buscar_gastos.php'" /> buscar &nbsp;&nbsp;
	<img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_gastos.php')" /> pdf  &nbsp;&nbsp;
	<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_gastos.php')" /> imprimir<hr></td>
    <!-- <div align="right" >Buscar | Imprimir | PDF   </div> -->
  
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:40%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="22" height="19" rowspan="7" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="5" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="30" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="113" align="left" valign="bottom"> Fecha:</td>
            <td width="389" align="left" valign="bottom">
             	<input name="dia" type="text" class="caja" id="dia"onKeyUp="pasar_foco_gastos_dia(event)" onKeyPress="return solo_entero(event)"size="2" maxlength="2">
				/
				<input name="mes" type="text" class="caja" id="mes"onKeyUp="pasar_foco_gastos_mes(event)" onKeyPress="return solo_entero(event)"size="2" maxlength="2">
				/
				<input name="ano" type="text" class="caja" id="ano" onKeyUp="pasar_foco_gastos_ano(event)" onKeyPress="return solo_entero(event)"size="4" maxlength="4">

			</td>
            <td width="5" valign="bottom">&nbsp;</td>
            <td width="413" align="left" valign="bottom">Hora:</td>
            <td width="277" align="left" valign="bottom"><input name="hora"  id="hora" onKeyUp="pasar_foco_gastos_2(event)" type="text" class="caja"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Descripcion:</td>
            <td align="left" valign="bottom"><input name="desc"  id="desc" onKeyUp="pasar_foco_gastos_3(event)" type="text" class="caja"></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Importe Neto:</td>
            <td align="left" valign="bottom"><input name="importe"  id="importe" onKeyUp="pasar_foco_gastos_4(event)" onKeyPress="return solo_entero(event)"type="text" class="caja"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">IVA:</td>
            <td align="left" valign="bottom"><input name="iva"  id="iva" onKeyUp="pasar_foco_gastos_5(event)" onKeyPress="return solo_entero(event)"type="text" class="caja"></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Otros Imp. </td>
            <td align="left" valign="bottom"><input name="otros_imp"  id="otros_imp" onKeyUp="pasar_foco_gastos_6(event)" onKeyPress="return solo_entero(event)"type="text" class="caja"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Total:</td>
            <td align="left" valign="bottom"><input name="total"  id="total" onKeyUp="pasar_foco_gastos_7(event)" onKeyPress="return solo_entero(event)"type="text" class="caja"></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Observacion:</td>
            <td align="left" valign="bottom"><input name="obs" id="obs" type="text" class="caja"   onKeyUp="pasar_foco_gastos_8(event)"></td>
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
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: registrar_gasto()"  value="Registrar">
            </div></td>
            <td width="30" valign="top">			</td>
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