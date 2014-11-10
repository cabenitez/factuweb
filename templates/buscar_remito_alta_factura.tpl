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
	<script language="javascript" src="../js/paginador2.js"></script>
	<script language="javascript" src="../js/autocompletador.js" charset="utf-8"></script> 
	<script language="javascript" src="class_modal/js/ventana-modal-1.1.1.js"></script>
	<script language="javascript" src="class_modal/js/abrir-ventana-fija.js"></script>
	<script language="javascript" src="../js/tooltip.js"></script>
	
	<!-- FAVICON 16 x 16 -->
	<link rel="shortcut icon"  href="../imagenes/favicon.ico">

</head>
<center>
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript:document.frm.codigo.focus();listar_loca_buscar_alta_fact();">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" class="seccion" valign="top"><div align="left">Remitos Pendientes
        <hr>
    </div></td>
  </tr>
  <tr>
    <td align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:90%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="38" height="19" rowspan="6" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="2" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="68" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
            <td width="145" valign="top">&nbsp;</td>
            <td width="83" valign="top">&nbsp;</td>
            <td width="39" valign="top">&nbsp;</td>
            <td width="42" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="72" align="left" valign="bottom">
			<div align="left">N&uacute;mero:</div>			</td>
            <td width="269" align="left" valign="bottom">

                <input name="codigo" type="text" class="caja" id="codigo" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_fact_vta_bus_1(event)" size="12" maxlength="9" >             </td>
            <td width="68" align="left"valign="bottom">Cliente:</td>
            <td width="145" align="left"valign="bottom"><input name="razon" type="text" class="caja" id="razon" onKeyUp="pasar_foco_fact_vta_bus_2(event)" size="25" ></td>
            <td width="83" align="left"valign="bottom">&nbsp;</td>
            <td width="39" align="left"valign="bottom">&nbsp;</td>
            <td width="42" align="left"valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom"><div align="left">Localidad: </div></td>
            <td align="left" valign="bottom"><div id="localidades"></div></td>
            <td align="left" valign="bottom">Desde: </td>
            <td colspan="3" align="left" valign="bottom"><input name="dia_desde" type="text" class="caja" id="dia_desde" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_fact_vta_bus_4(event)" size="2" maxlength="2" >
/
  <input name="mes_desde" type="text" class="caja" id="mes_desde" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_fact_vta_bus_5(event)" size="2" maxlength="2" >
/
<input name="ano_desde" type="text" class="caja" id="ano_desde" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_fact_vta_bus_6(event)" size="4" maxlength="4" ></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Hasta:</td>
            <td colspan="3" align="left" valign="bottom"><input name="dia_hasta" type="text" class="caja" id="dia_hasta" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_fact_vta_bus_7(event)" size="2" maxlength="2" >
/
  <input name="mes_hasta" type="text" class="caja" id="mes_hasta" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_fact_vta_bus_8(event)" size="2" maxlength="2" >
/
<input name="ano_hasta" type="text" class="caja" id="ano_hasta" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_fact_vta_bus_9(event)" size="4" maxlength="4" ></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom">&nbsp;</td>
            <td valign="top"></td>
            <td valign="top"></td>
            <td valign="top"></td>
            <td valign="top"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="6" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: listar_loca_buscar_alta_fact2(); listar_loca_buscar_alta_fact2_2()"  value="Buscar">
            </div>			</td>
            <td width="42" valign="top"></td>
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
		<div id="listado_2"></div>
		<!-- <span class="botones"  style="cursor:pointer" onClick="javascript:window.close();">[Cerrar]</span> -->	
	</td>
  </tr>

</table>
</body>
</center>
</html>
