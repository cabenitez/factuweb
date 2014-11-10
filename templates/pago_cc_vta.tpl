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
<center> <!-- background="../imagenes/fondo_cuadrito.gif" -->
<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: document.frm.codigo.focus(); listar_zona_cta_cte(); listar_cond_iva_cta_cte();hora_actual();"> <!-- buscar_num_recibo(); -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="42" valign="top"  class="seccion"><div align="left">Seccion: Ingreso de Cobranzas <hr> </div></td>
    <td width="50%" align="right" valign="top" class="seccion">
	<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: registrar_pago_cc_vta();" /> imprimir  
        <hr></td>
    <!--  <div align="right" >Buscar | Imprimir | PDF   </div> -->
  </tr>
  <tr>
    <td height="112" colspan="2" align="center" valign="top">
      <form name="frm"  id="frm">
        <fieldset  style="width:98%; height:10%;">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">
              <table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
                <tr>
                  <td width="25" height="19" rowspan="4" valign="top" class="LLL"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
                  <td colspan="10" valign="top"><div id="mensaje" class="advertencia"></div></td>
                  <td width="64" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
                </tr>
                <tr>
                  <td width="87"  align="left" valign="bottom"><div align="left"> Talonario: </div></td>
                  <td width="124" align="left" valign="bottom" class="seccion">
                    <div id="numero_tal">0000</div>
                    <!--{$numero_tal}-->
                    <input type="hidden"  id="oculto_numero_tal"  name="oculto_numero_tal" >
                    <input type="hidden"  id="oculto_codigo_tal"  name="oculto_codigo_tal" ></td>
                  <td width="65" align="left" valign="bottom">Recibo: </td>
                  <td width="121" align="left" valign="bottom" class="seccion"><!-- <div id="numero_suc"> </div> - -->
                      <div id="numero_rem">0000-00000000</div>
                      <!-- {$numero_suc}{$numero_rem}-->
                      <input type="hidden"  id="oculto_numero_rem"  name="oculto_numero_rem" >
                      <!--value="{$numero_rem}" -->
                  </td>
                  <td width="68" align="left"valign="bottom">Fecha:</td>
                  <td width="120" align="left"valign="bottom" class="seccion">{$dia}/{$mes}/{$ano}
                      <input type="hidden"  id="oculto_fecha"  name="oculto_fecha" value="{$ano}{$mes}{$dia}"></td>
                  <td width="68" align="left"valign="bottom">Hora:</td>
                  <td width="100" align="left"valign="bottom"><div id="hora_actual" class="seccion"></div></td> 
                  <td width="103" align="left"valign="bottom">Cliente: </td>
                  <td width="294" align="left"valign="bottom"><input  name="codigo"type="text"class="select_1"  id="codigo" onKeyPress="return solo_entero(event)" onKeyUp="buscar_cliente_cta_cte(event)" size="5" maxlength="5">
                      <img src="../imagenes/seguiente.gif" width="14" height="14" class="iconos" title="Buscar Cliente...     (F2)"onClick=" javascript: seleccionar_cliente_fact_vta()"></td>
                  <td width="64" align="left"valign="top"></td>
                </tr>
                <tr>
                  <td valign="bottom" align="left"><div align="left"> Nombre: </div></td>
                  <td valign="bottom"align="left"><input name="razon"  id="razon"type="text" class="caja"  onKeyUp="pasar_foco_rem_vta_1(event)" size="20" disabled></td>
                  <td valign="bottom"align="left">Direcci&oacute;n:</td>
                  <td valign="bottom"align="left"><input name="dir"  id="dir"type="text" class="caja"  onKeyUp="pasar_foco_rem_vta_2(event)" size="20" disabled></td>
                  <td align="left" valign="bottom">Localidad:</td>
                  <td align="left" valign="bottom"><input name="localidad"  id="localidad"type="text" class="caja"  onKeyUp="pasar_foco_rem_vta_3(event)" size="15" disabled></td>
                  <td align="left" valign="bottom">Provincia:</td>
                  <td align="left" valign="bottom"><input name="provincia"  id="provincia"type="text" class="caja"  onKeyUp="pasar_foco_rem_vta_4(event)" size="15" disabled></td>
                  <td align="left" valign="bottom">Zona:</td>
                  <td align="left" valign="bottom"><div id="zonas"></div></td>
                  <td valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="bottom">Cond. IVA:</td>
                  <td align="left" valign="bottom"><div id="cond_iva"></div>
                      <!-- <input name="iva"type="text" class="caja"  id="iva"  style="visibility:hidden" onKeyUp="pasar_foco_rem_vta_5(event)" size="5">--></td>
                  <td align="left" valign="bottom">CUIT:</td>
                  <td colspan="2" align="left" valign="bottom">
                    <input name="cuit1" id="cuit1" type="text" class="caja"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rem_vta_6(event)" size="2" maxlength="2" disabled>
                    -
                    <input name="cuit2" type="text" class="caja" id="cuit2"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rem_vta_7(event)" size="8" maxlength="8" disabled>
                    -
                    <input name="cuit3" type="text" class="caja" id="cuit3"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_rem_vta_8(event)" size="1" maxlength="1" disabled></td>
                  <td align="left" valign="bottom">
                    <input name="busca_pop_up" type="button" class="botones" id="busca_pop_up"   style="visibility:hidden" onClick="javascript: buscar_cliente_cta_cte_proceso()"  value="c">
                    <input name="busca_pop_up2" type="button" class="botones" id="busca_pop_up2"  style="visibility:hidden" onClick="javascript: buscar_articulo_remito_vta()"  value="a">
                  </td>
                  <td align="left" valign="bottom">Vendedor:</td>
                  <td align="left" valign="bottom"><input name="vendedor" type="text" class="caja"  id="vendedor"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_cta_cte_9(event)" size="3" maxlength="3"></td>
                  <td align="left" valign="bottom">Observ:</td>
                  <td align="left" valign="bottom"> <span class="seccion">
                    <input name="obs" type="text" class="caja" id="obs" onKeyUp="pasar_foco_cta_cte_10(event)" value="" size="25">
                  </span></td>
                  <td valign="top"></td>
                </tr>
                <tr>
                  <td height="19" valign="top" class="LLL">&nbsp;</td>
                  <td align="left" valign="bottom">Saldo anterior:</td>
                  <td align="left" valign="bottom"><div id="saldo" class="seccion">0.00</div>
                      <input type="hidden"  id="oculto_saldo"  name="oculto_saldo"></td>
                  <td align="left" valign="bottom">Importe:</td>
                  <td align="left" valign="bottom"><input name="importe"type="text" class="caja"  id="importe"   onKeyUp="calcular_importe_cta_cte(event)" size="10" maxlength="10"></td>
                  <td colspan="3" align="right" valign="bottom">Total a Imputar :                    </td>
                  <td align="left" valign="bottom"><div id="total_imputar" class="seccion">0.00</div>
                      <input type="hidden"  id="oculto_total_imputar"  name="oculto_total_imputar"></td>
                  <td align="left" valign="bottom">Saldo a Imputar: 
                    </td>
                  <td align="left" valign="bottom"><div id="saldo_imputar" class="seccion">0.00</div>
                      <input type="hidden"  id="oculto_saldo_imputar"  name="oculto_saldo_imputar"></td>
                  <td valign="top"></td>
                </tr>
            </table></td>
          </tr>
        </table>
        </fieldset>
    </form></td>
  </tr>
  <tr>
    <td height="47" colspan="2" align="center" valign="top">
      <form name="frm_art"  id="frm_art">
        <div id="facturas"></div>
    </form></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
      <div id="composicion_saldo_detalle"></div>
     
	  <!-- <div id="msg"  class="advertencia"></div>-->
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</center>
</html>