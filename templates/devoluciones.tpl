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
<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: hora_actual();buscar_num_devolucion_vta();listar_vendedor_devolucion();"> <!-- buscar_num_fac_vta(); -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0"><!--DWLayoutTable-->
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Seccion: Alta de Devoluciones
      <hr></div></td> 
    <td width="50%" align="right" valign="top" class="seccion"><img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: registrar_devolucion();" /> imprimir<hr></td>
	  
	  
  </tr>
  <tr>
    <td height="60" colspan="2"  align="center" valign="top">
<form name="frm"  id="frm">	
<fieldset  style="width:98%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center">
		<table width="100%" border="0" align="left" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="28" rowspan="2" valign="top" >
			<img src="../imagenes/18.jpg" width="18" height="18"/>
			</td>
            <td height="18" colspan="12" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="55" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
          </tr>
          <tr>
            <td width="55"  align="left" valign="bottom">Talonario:</td>
            <td width="59"  align="left" valign="bottom" class="seccion"><div id="numero_tal"> 0000</div> <input type="hidden"  id="oculto_numero_tal"  name="oculto_numero_tal" >
              <input type="hidden"  id="oculto_codigo_tal"  name="oculto_codigo_tal" value="{$codigo_tal}"></td>
            <td width="47"  align="left" valign="bottom">Factura: </td>
            <td width="127"  align="left" valign="bottom" class="seccion"><div id="num_devolucion">0000-00000000-0</div><input type="hidden"  id="oculto_num_devolucion"  name="oculto_num_devolucion" ></td>
            <td width="37"  align="left" valign="bottom" >Fecha:</td>
            <td width="126"  align="left" valign="bottom"class="seccion" >{$dia}/{$mes}/{$ano}
              <input type="hidden"  id="oculto_fecha"  name="oculto_fecha" value="{$ano}{$mes}{$dia}"></td>
            <td width="30"  align="left"valign="bottom">Hora:</td>
            <td width="83"  align="left"valign="bottom" class="seccion"><div id="hora_actual" ></div></td>
            <td width="56"  align="left"valign="bottom" >Vendedor:</td>
            <td width="97"  align="left"valign="bottom"><div id="vendedores"></div></td> 
            <td width="100" align="left"valign="bottom"> Fecha de Carga: </td>
            <td width="335" align="left"valign="bottom">
			    <input  name="dia"type="text"class="caja"  id="dia" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_dev_2(event)" value="" size="2" maxlength="2">
              /
                <input  name="mes"type="text"class="caja"  id="mes" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_dev_3(event)" value="" size="2" maxlength="2">
              /
              <input  name="ano"type="text"class="caja"  id="ano" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_dev_4(event)" value="" size="4" maxlength="4">
              <img src="../imagenes/validar2.gif" width="13" height="11"  class="iconos"  title="Validar Carga"onClick="buscar_carga_devolucion()"></td>
            <td width="55" align="left"valign="bottom"></td>
          </tr>
        </table></td>
      </tr>
    </table>
</fieldset>
</form>	</td>
  </tr>
  <tr>
       <td height="47" colspan="2" align="center" valign="top">
			<form name="frm_art"  id="frm_art">	
			<fieldset  style="width:98%; height:10%;">
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td align="center">
					<table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
					  <tr>
						<td width="19" height="19" rowspan="2" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
						<td colspan="6" valign="top"><div id="mensaje_art" class="advertencia"></div></td>
						<td width="72" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
					  </tr>
					  <tr>
						
						<td width="46" align="left" valign="bottom"><div align="left"> C&oacute;digo: </div></td>
						<td width="105"align="left"   valign="bottom"><input  name="codigo_art"type="text" class="caja"  id="codigo_art" onKeyPress="return solo_entero(event)" onKeyUp="buscar_articulo_alta_devolucion(event)" size="12" maxlength="9">
					    <img src="../imagenes/seguiente.gif" width="14" height="14" class="iconos" title="Buscar Art&iacute;culo...     (F2)"onClick="seleccionar_articulo_devolucion()"> </td>
						<td width="69"align="left"   valign="bottom"> Descripción:</td>
						<td width="652"align="left"   valign="bottom"><div id="desc_art" class="seccion"></div><input type="hidden"  id="oculto_desc_art"  name="oculto_desc_art">
						  <input type="hidden"  id="oculto_stock"  name="oculto_stock"></td> 
						<td width="53" align="left" valign="bottom">Cantidad:</td>
						<td width="231" align="left" valign="bottom"><input name="cant_art"type="text" class="caja"  id="cant_art"  onKeyPress="return solo_entero(event)" onKeyUp="agregar_articulo_devolucion(event)" size="5" maxlength="5"></td>
						<td valign="top"><input name="busca_pop_up2" type="button" class="botones" id="busca_pop_up2"  style="visibility:hidden" onClick="javascript: buscar_articulo_devolucion()"  value="a"></td>
					  </tr>
					</table>
					</td>
				  </tr>
			</table>
			</fieldset>
			</form>	 </td>
   </tr>
   <tr>
    <td colspan="2" align="center" valign="top">
		<div id="listado"></div>
		<!-- <div id="msg"  class="advertencia"></div>-->
	</td>
  </tr>
</table>
</body>
</center>
</html>