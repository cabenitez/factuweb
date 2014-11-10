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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: poner_foco_prove();"><!--listar_paises();listar_provincias();listar_localidades();listar_iva();buscar_proveedor() -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" colspan="3" valign="top" class="seccion"><div align="left">Modificar Proveedor 
        <hr>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top">
	
<form name="frm_mod"  id="frm_mod">	
<fieldset  style="width:50%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="24" height="19" rowspan="12" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="5" valign="top"><div id="mensaje_mod" class="advertencia"></div></td>
            <td width="36" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="114" valign="top">
			C&oacute;digo:			</td>
            <td width="186" align="left" valign="top">

          <input name="codigo_mod" type="text" class="caja" id="codigo_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_prove_23(event)" size="12" maxlength="9" value="{$codigo}">             </td>
            <td width="1" align="left" valign="top">&nbsp;</td>
            <td width="88" align="left" valign="top">Razon Social:</td>
            <td width="152" align="left" valign="top"><input name="razon_mod"  id="razon_mod" type="text" class="caja"  onKeyUp="pasar_foco_prove_24(event)" size="30"value="{$razon}">
		  </td>
            <td width="36" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="top" align="left">Condici&oacute;n de IVA:</td>
            <td   valign="bottom"align="left"><div  id="iva_mod"></div>
			</td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">CUIT: </td>
            <td   valign="bottom"align="left"><input name="cuit1_mod" id="cuit1_mod" type="text" class="caja"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_prove_25(event)" size="2" maxlength="2" value="{$cuit1}">
-
  <input name="cuit2_mod" id="cuit2_mod" type="text" class="caja"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_prove_26(event)" size="8" maxlength="8" value="{$cuit2}">
-
<input name="cuit3_mod" id="cuit3_mod" type="text" class="caja"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_prove_27(event)" size="1" maxlength="1" value="{$cuit3}"></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Ing. Brutos : </td>
            <td align="left" valign="bottom"><input name="ing_bruto_mod" type="text" class="caja" id="ing_bruto_mod"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_prove_28(event)" size="12" maxlength="12" value="{$ingreso_bruto}"></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Direcci&oacute;n:              </td>
            <td align="left" valign="bottom"><input  name="direccion_mod"  id="direccion_mod" type="text" onKeyUp="pasar_foco_prove_30(event)"class="caja" size="30" value="{$direccion}"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Pais:</td>
            <td align="left" valign="bottom"><div  id="paises_mod"></div></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Provincia:</td>
            <td align="left" valign="bottom"><div  id="provincias_mod"></div></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Localidad:</td>
            <td align="left" valign="bottom"><div  id="localidades_mod"></div></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Telefono:</td>
            <td align="left" valign="bottom">
			<input name="tel_mod"  id="tel_mod" onKeyUp="pasar_foco_prove_34(event)" type="text" class="caja" value="{$tel}">
			</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Fax:</td>
            <td align="left" valign="bottom"><input name="fax_mod"  id="fax_mod" onKeyUp="pasar_foco_prove_35(event)" type="text" class="caja" value="{$fax}"></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Celular:              </td>
            <td align="left" valign="bottom"><input name="cel_mod"  id="cel_mod" onKeyUp="pasar_foco_prove_36(event)" type="text" class="caja" value="{$movil}"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Web:</td>
            <td align="left" valign="bottom"><input name="web_mod"  id="web_mod" onKeyUp="pasar_foco_prove_37(event)" type="text" class="caja"value="{$web}"></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">E-mail:</td>
            <td align="left" valign="bottom"><input name="mail_mod"  id="mail_mod" onKeyUp="pasar_foco_prove_38(event)" type="text" class="caja" value="{$mail}"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Contacto:</td>
            <td align="left" valign="bottom"><input name="contacto_mod"  id="contacto_mod" onKeyUp="pasar_foco_prove_39(event)" type="text" class="caja" value="{$contacto}"></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Limite cr&eacute;dito:</td>
            <td align="left" valign="bottom"><input name="lim_cred_mod"  id="lim_cred_mod" onKeyUp="pasar_foco_prove_40(event)" type="text" class="caja" value="{$limite_cred}"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Agente Retenci&oacute;n:</td>
            <td align="left" valign="bottom">
              <input name="agente_mod" type="checkbox"  id="agente"  onKeyUp="pasar_foco_prove_41(event)" value="checkbox" {$agente}>
            </td>
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
                <input type="hidden"  id="oculto_mod" name= "oculto_mod" value="{$codigo}">
                <!-- campo oculto-->
                <input name="enviar_mod" type="button" class="botones" id="enviar_mod" onclick="javascript: modificar_proveedor_db()"  value="Modificar">
            	<input name="cancelar_mod" type="button" class="botones" id="cancelar_mod" onclick="javascript: buscar_proveedor()"  value="Cancelar">
			</div></td>
            <td width="36" valign="top">			</td>
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
    <td width="15%" align="center" valign="top"></td>   </tr>

</table>
</body>
</center>
</html>
