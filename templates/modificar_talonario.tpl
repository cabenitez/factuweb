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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0"> <!-- onLoad="javascript: listar_tt_tal_reg();buscar_talonario();"-->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" colspan="3" valign="top" class="seccion"><div align="left">Modificar Talonario 
        <hr>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top">
	
<form name="frm_mod"  id="frm_mod">	
<fieldset  style="width:50%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center">
		
		<table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="19" height="19" rowspan="8" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="5" valign="top"><div id="mensaje_mod" class="advertencia"></div></td>
            <td width="19" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="113" align="left" valign="bottom">
		  Comprobante:		</td>
          <td width="150" align="left" valign="bottom"><div  id="tt_mod"></div></td>
            <td width="51" align="left" valign="bottom">&nbsp;</td>
            <td width="110" align="left" valign="bottom">N&ordm; Talonario:</td>
            <td width="139" align="left" valign="bottom"><input name="numero_mod" type="text" class="caja"  id="numero_mod"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_2_mod(event)" size="12"value="{$numero}">
		  </td>
            <td width="19" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="bottom" align="left">N&ordm; Sucursal:</td>
            <td   valign="bottom"align="left"><input name="sucursal_mod"type="text" class="caja"  id="sucursal_mod"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_3_mod(event)" size="12" maxlength="9"value="{$sucursal}"></td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">N&ordm; Iteraciones: </td>
            <td   valign="bottom"align="left"><input name="iteraciones_mod"type="text" class="caja"  id="iteraciones_mod"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_4_mod(event)" size="12" maxlength="9"value="{$iteracion}"></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="bottom" align="left">Primer N&uacute;mero:</td>
            <td   valign="bottom"align="left"><input name="primer_num_mod"type="text" class="caja"  id="primer_num_mod"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_5_mod(event)" size="12" maxlength="9"value="{$primer}"></td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">Ultimo N&uacute;mero: </td>
            <td   valign="bottom"align="left"><input name="ultimo_num_mod"type="text" class="caja"  id="ultimo_num_mod"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_6_mod(event)" size="12" maxlength="9"value="{$ultimo}"></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Siguiente Numero:</td>
            <td align="left" valign="bottom"><input name="sig_num_mod"type="text" class="caja"  id="sig_num_mod"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_7_mod(event)" size="12" maxlength="9"value="{$sig}"></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Fecha Vto:</td>
            <td align="left" valign="bottom"><input name="dia_mod" type="text" class="caja"  id="dia_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_8_mod()" size="2" maxlength="2"value="{$dia}">
              /
                <input name="mes_mod" type="text" class="caja"  id="mes_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_9_mod()" size="2" maxlength="2"value="{$mes}">
                /
                <input name="ano_mod" type="text" class="caja"  id="ano_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_10_mod()" size="4" maxlength="4"value="{$ano}"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">N&ordm; CAI:</td>
            <td align="left" valign="bottom"><input name="cai_mod"type="text" class="caja"  id="cai_mod"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_tal_11_mod(event)" size="12"value="{$cai}"></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom"> Impresora: </td>
            <td align="left" valign="bottom"> <div id="impresoras_mod"></div> <!-- <input name="impresora_mod"type="text" class="caja"  id="impresora_mod" onKeyUp="pasar_foco_tal_12_mod(event)" size="25"value="{$impresion}"> --></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="5" valign="bottom">&nbsp;</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="5" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto_mod2" name= "oculto_mod2" value="{$tipo}">
				<input type="hidden"  id="oculto_mod" name= "oculto_mod" value="{$numero}">
				<!-- campo oculto-->
                <input name="enviar_mod" type="button" class="botones" id="enviar_mod" onclick="javascript: modificar_talonario_db()"  value="Modificar">
                <input name="cancelar_mod" type="button" class="botones" id="cancelar_mod" onclick="javascript: buscar_talonario()"  value="Cancelar">
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
    <td width="15%" align="center" valign="top"></td>
    <td width="50%" align="center" valign="top">
			<div id="listado_mod" class="CFilas"></div>
		<div id="msg_mod"  class="nota">{#nota_modificacion#} </div>
	</td>
    <td width="15%" align="center" valign="top"></td>
   </tr>

</table>
</body>
</center>
</html>