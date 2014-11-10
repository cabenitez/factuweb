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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: document.frm_mod.codigo_mod.focus();"> <!-- listar_paises();listar_provincias();listar_localidades_clie();listar_zonas();listar_iva_cliente();listar_cat_cliente();listar_ven_cliente();listar_rep_cliente();buscar_cliente(); -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" colspan="3" valign="top" class="seccion">
	<div align="left">Seccion: Modificar Cliente <hr></div></td> <!-- <div align="right" >Buscar | Imprimir | PDF   </div> -->
  
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top">
	
<form name="frm_mod"  id="frm_mod">	
<fieldset style="width:53%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="22" height="19" rowspan="13" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="5" valign="top"><div id="mensaje_mod" class="advertencia"></div></td>
            <td width="19" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="110" align="left"valign="top">
			C&oacute;digo:
		  </td>
            <td width="190" align="left" valign="top">

          <input name="codigo_mod" type="text" class="caja" id="codigo_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_clie_1_mod(event)" size="12" maxlength="9" value="{$codigo}">             </td>
            <td width="35" align="left" valign="top">&nbsp;</td>
            <td width="110" align="left" valign="top">Razon Social:</td>
            <td width="152" align="left" valign="top"><input name="razon_mod"  id="razon_mod"type="text" class="caja"  onKeyUp="pasar_foco_clie_2_mod(event)" size="30"value="{$razon}">
		  </td>
            <td width="19" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="top" align="left">Condici&oacute;n de IVA:</td>
            <td   valign="bottom"align="left"><div  id="iva_mod"></div>
			</td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">CUIT: </td>
            <td   valign="bottom"align="left"><input name="cuit1_mod" id="cuit1_mod" type="text" class="caja"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_clie_3_mod(event)" size="2" maxlength="2"value="{$cuit1}" >
-
  <input name="cuit2_mod" type="text" class="caja" id="cuit2_mod"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_clie_4_mod(event)" size="8" maxlength="8"value="{$cuit2}">
-
<input name="cuit3_mod" type="text" class="caja" id="cuit3_mod"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_clie_5_mod(event)" size="1" maxlength="1"value="{$cuit3}">
<img src="../imagenes/validar2.gif" width="13" height="11" title="Validar" class='iconos' onClick="javascript: validar_cuit_cliente_mod()" /></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Direcci&oacute;n: </td>
            <td align="left" valign="bottom"><input  name="direccion_mod"  id="direccion_mod"type="text" onKeyUp="pasar_foco_clie_8_mod(event)"class="caja" size="29"value="{$direccion}"></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Pais:</td>
            <td align="left" valign="bottom"><div  id="paises_mod"></div></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Provincia:</td>
            <td align="left" valign="bottom"><div  id="provincias_mod"></div></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Localidad:</td>
            <td align="left" valign="bottom"><div  id="localidades_mod"></div></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Zona:</td>
            <td align="left" valign="bottom"><div  id="zonas_mod"></div></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Telefono:</td>
            <td align="left" valign="bottom"><input name="tel_mod"  id="tel_mod" onKeyUp="pasar_foco_clie_10_mod(event)" type="text" class="caja"value="{$tel}"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom"> Fax:</td>
            <td align="left" valign="bottom"><input name="fax_mod"  id="fax_mod" onKeyUp="pasar_foco_clie_11_mod(event)" type="text" class="caja"value="{$fax}"></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Celular:</td>
            <td align="left" valign="bottom"><input name="cel_mod"  id="cel_mod" onKeyUp="pasar_foco_clie_12_mod(event)" type="text" class="caja"value="{$movil}"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Web:</td>
            <td align="left" valign="bottom"><input name="web_mod"  id="web_mod" onKeyUp="pasar_foco_clie_13_mod(event)" type="text" class="caja"value="{$web}"></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">E-mail:</td>
            <td align="left" valign="bottom">
			<input name="mail_mod"  id="mail_mod" onKeyUp="pasar_foco_clie_14_mod(event)" type="text" class="caja" value="{$mail}">
			</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Contacto:</td>
            <td align="left" valign="bottom"><input name="contacto_mod"  id="contacto_mod" onKeyUp="pasar_foco_clie_15_mod(event)" type="text" class="caja"value="{$contacto}"></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Limite cr&eacute;dito:</td>
            <td align="left" valign="bottom"><input name="lim_cred_mod"  id="lim_cred_mod" onKeyUp="pasar_foco_clie_16_mod(event)" type="text" class="caja"value="{$lim_cred}"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td  align="left"valign="bottom">Categor&iacute;a:</td>
            <td  align="left"valign="bottom"><div  id="categoria_mod"></div></td>
            <td  valign="bottom">&nbsp;</td>
            <td  align="left"valign="bottom">Vendedor: </td>
            <td  align="left"valign="bottom"><div  id="vendedores_mod"></div></td>
            <td  valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Repartidor : </td>
            <td align="left" valign="bottom"><div  id="repartidores_mod"></div></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Condici&oacute;n de Venta: </td>
            <td align="left" valign="bottom"><div  id="forma_pago_mod"></div></td>
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
                <input name="enviar_mod" type="button" class="botones" id="enviar_mod" onclick="javascript: modificar_cliente_db()"  value="Modificar">
            	<input name="cancelar_mod" type="button" class="botones" id="cancelar_mod" onclick="javascript: buscar_cliente()"  value="Cancelar">
			
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
    <td width="36%" align="center" valign="top">
		<div id="listado_mod" class="CFilas"></div>
		<div id="msg_mod"  class="nota">{#nota_modificacion#} </div>
	</td>
    <td width="15%" align="center" valign="top"></td>   </tr>

</table>
</body>
</center>
</html>

