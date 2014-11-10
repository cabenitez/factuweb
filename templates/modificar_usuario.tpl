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
	<script language="javascript" src="../js/md5.js"></script>
	<!-- FAVICON 16 x 16 -->
	<link rel="shortcut icon"  href="../imagenes/favicon.ico">

</head>
<center>
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0"> <!-- buscar_grupo(); -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" class="seccion" valign="top"><div align="left">Seccion: Modificar Usuarios <hr></div></td>
 </tr>
  <tr>
    <td height="84" colspan="2" align="center" valign="top">
	
<form name="frm_mod"  id="frm_mod">
<fieldset  style="width:55%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="18" height="19" rowspan="17" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="3" valign="top"><div id="mensaje_mod" class="advertencia"></div></td>
            <td width="18" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="bottom"><table width="440" border="0" cellpadding="0" cellspacing="2">
<tr>
<td align="left" valign="bottom" bordercolor="#BFBFBF">Nombre:</td>
<td width="371" colspan="3" align="left"valign="bottom" bordercolor="#BFBFBF"><input name="nombre_mod" id="nombre_mod" type="text" class="caja" size="27" onKeyUp="pasar_foco_modificar_usuario_1(event)" value="{$nombre}"></td>
</tr>
<tr>
<td width="63" align="left" valign="bottom" bordercolor="#BFBFBF">Usuario:</td>
<td colspan="3" align="left"valign="bottom" bordercolor="#BFBFBF"><input name="usuario_mod" type="text" class="caja" id="usuario_mod"  size="27" maxlength="15" value="{$usuario}"></td>
</tr>
</table></td>
            <td width="18" valign="top">&nbsp;</td> 
          </tr>
          

<tr>
<td colspan="3" valign="bottom">&nbsp;</td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><div class="seccion" align="left">Permisos:

</div></td>
<td colspan="2" valign="bottom">
<div class="seccion" align="right">
<input type="checkbox" name="marcatodos" onClick="todos_mod(this.form)">Marcar todos |

<input type="checkbox" name="desmarcatodos" onClick="ninguno_mod(this.form)">Desmarcar todos |

<input type="checkbox" name="invierte" onClick="invertir_mod(this.form)">Invertir selecci&oacute;n</div></td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td colspan="3" valign="bottom"><hr></td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td width="33%" valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_zonas_geo}>
ABM Zonas geogr&aacute;ficas </td>
<td width="33%" valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_alicuotas}>
ABM Al&iacute;cuotas </td>
<td width="33%" valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_comprobante}>
AM Comprobantes </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_cond_iva}>
AM Condici&oacute;n de IVA </td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_talonario}>
AM Talonarios </td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_proveedor}>
AM Proveedores </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_vehiculo}>
AM Veh&iacute;culos </td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_repartidor}>
AM Repartidores </td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_vendedor}>
AM Vendedores </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_categoria}>
AM Categor&iacute;as </td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_forma_pago}>
AM Formas de pago </td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_cliente}>
AM Clientes </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_articulo}>
AM Art&iacute;culos </td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$datos_empresa}>
AM Datos de Empresa </td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$conf_listados}>
Configurar Listados </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$abm_usuarios}>
ABM Usuarios </td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$stock}>
Ingreso Stock</td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$factura_compra}>
 Facturas Compra </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$remito_vta}>
Remitos Venta </td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$factura_vta}> 
Facturas Venta</td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$nota_credito}>
Notas de Cr&eacute;dito </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$cta_cte}>  
Cuenta Corriente
</td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$comisiones}>
Comisiones</td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$devoluciones}>
Devoluciones</td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$finalizar_carga}>
Finalizar Cargas </td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$informes}>
Informes</td>
<td valign="bottom"><input type="checkbox" name="casilla1_mod" {$estadisticas}>
Estad&iacute;sticas </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
  <td valign="bottom"><input type="checkbox" name="casilla1_mod" {$utilidades}>
Utilidades </td>
  <td valign="bottom">&nbsp;</td>
  <td valign="bottom">&nbsp;</td>
  <td valign="top">&nbsp;</td>
</tr>
<tr>
  <td colspan="3" valign="bottom">&nbsp;</td>
  <td valign="top">&nbsp;</td>
        </tr>
          <tr>
            <td colspan="3" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto_mod" name= "oculto_mod" value="{$codigo}">
                <!-- campo oculto-->
                <input name="enviar_mod" type="button" class="botones" id="enviar_mod" onclick="javascript: modificar_usuario_db()"  value="Modificar">
            	<input name="cancelar_mod" type="button" class="botones" id="cancelar_mod" onclick="javascript: buscar_usuarios()"  value="Cancelar">
            </div></td>
            <td width="18" valign="top">&nbsp;</td>
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
		<div id="listado_mod" class="CFilas"></div>
		
  </td>
  </tr>
</table>
</body>
</center>
</html>
