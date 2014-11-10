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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: document.frm.codigo.focus();">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Seccion: Estado de Deudas
        <hr>
    </div></td>
    <td width="50%" align="right" valign="top" class="seccion">	<hr></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:25%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="30" height="19" rowspan="7" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="2" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="35" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="837" align="left" valign="bottom">
			<div align="left">C&oacute;d. Cliente:</div>			</td>
            <td width="145" align="left" valign="top">

                <input name="codigo" type="text" class="caja" id="codigo" onKeyPress="return solo_entero(event)" onKeyUp="informe_compras_cliente_1(event)" size="12" maxlength="9" >
                <img src="../imagenes/seguiente.gif" width="14" height="14" class="iconos" title="Buscar Cliente...     (F2)"onClick=" javascript: seleccionar_cliente_informe()"> </td>
            <td width="35" align="left"valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom"><div align="left"> Razon Social:</div></td>
            <td align="left" valign="bottom">
			<input name="razon" type="text" class="caja" id="razon" onKeyUp="informe_composocion_saldo_1(event)" size="29" ></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td width="837" align="left" valign="bottom">Fecha desde: </td>
            <td width="145"align="left"   valign="bottom">
  <input name="dia" type="text" class="caja" id="dia"onKeyUp="informe_compras_cliente_3(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
  /
  <input name="mes" type="text" class="caja" id="mes"onKeyUp="pasar_foco_iva_ventas_2(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
  /
  <input name="ano" type="text" class="caja" id="ano"onKeyUp="pasar_foco_iva_ventas_3(event)" onKeyPress="return solo_entero(event)"value="" size="4" maxlength="4">
            </td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom"> Fecha hasta:</td>
            <td align="left" valign="bottom">
  <input name="dia_h" type="text" class="caja" id="dia_h"onKeyUp="informe_compras_cliente_4(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
  /
  <input name="mes_h" type="text" class="caja" id="mes_h"onKeyUp="pasar_foco_iva_ventas_5(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
  /
  <input name="ano_h" type="text" class="caja" id="ano_h"onKeyUp="pasar_foco_iva_ventas_6(event)" onKeyPress="return solo_entero(event)"value="" size="4" maxlength="4">
            
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom"><input name="busca_pop_up" type="button" class="botones" id="busca_pop_up"  style="visibility:hidden" onClick="javascript: buscar_cliente_informe()"  value="c"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="buscar" type="button" class="botones" id="buscar" onClick="javascript: buscar_saldo_cliente()"  value="Buscar">
</div></td>
            <td width="35" valign="top">

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
		<div id="listado_detalle"></div>
		<div id="listado_detalle_comprobante"></div>
	</td>
  </tr>
</table>
</body>
</center>
</html>