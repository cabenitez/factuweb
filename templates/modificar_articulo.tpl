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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0"> <!-- onLoad="javascript: listar_grupos_art();listar_marcas_art();listar_variedades_art();listar_proveedores_art();listar_medidas_art();listar_categorias_art();buscar_articulo();" -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" colspan="3" valign="top" class="seccion">
	<div align="left">Modificar Articulo <hr></div></td> <!-- <div align="right" >Buscar | Imprimir | PDF   </div> -->
  
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top">
	
<form name="frm_mod"  id="frm_mod">	
<fieldset  style="width:55%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="27" height="19" rowspan="14" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="7" valign="top"><div id="mensaje_mod" class="advertencia"></div></td>
            <td width="99" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Grupo:</td>
            <td colspan="3" align="left" valign="bottom"><div id="grupos_mod"></div></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Marca:</td>
            <td align="left" valign="bottom"><div id="marcas_mod"></div></td>
            <td align="left"valign="top"></td>
          </tr>
          <tr>
            <td width="132" align="left" valign="bottom">
			<div align="left">Variedad:</div>			</td>
            <td colspan="3" align="left" valign="bottom"><div id="variedades_mod"></div></td>
            <td width="10" align="left" valign="bottom">&nbsp;</td>
            <td width="206" align="left" valign="bottom">C&oacute;digo:</td>
            <td width="148" align="left" valign="bottom"><input name="codigo_mod" type="text" class="caja" id="codigo_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_2_mod(event)" size="12" maxlength="9" value="{$codigo}"></td>
            <td width="99" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="bottom" align="left">Descripci&oacute;n:</td>
            <td colspan="3"align="left"   valign="bottom"><input name="desc_mod" id="desc_mod" type="text" class="caja"  onKeyUp="pasar_foco_art_3_mod(event)" size="30" value="{$desc}"> </td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">Proveedor: </td>
            <td   valign="bottom"align="left"><div id="proveedores_mod"></div></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="bottom" align="left"><div align="left">Precio de Costo:</div></td>
            <td colspan="3"align="left"   valign="bottom"><input name="precio_costo_mod" type="text" class="caja" id="precio_costo_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_5_mod(event)" size="12" maxlength="9" value="{$precio_costo}"></td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">Unidad por Bulto: </td>
            <td   valign="bottom"align="left"><input  name="unidad_bulto_mod" type="text"class="caja"  id="unidad_bulto_mod" onKeyUp="pasar_foco_art_6_mod(event)" size="12" maxlength="9" value="{$unidad_bulto}"> </td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Medida:</td>
            <td width="113" align="left" valign="bottom">
			<input name="medida_mod" type="text" class="caja" id="medida_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_7_mod(event)" size="7" maxlength="7" value="{$medida}">			</td>
            <td colspan="2" align="left" valign="bottom">
			<div  id="medidas_mod"></div>			</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Peso:</td>
            <td align="left" valign="bottom">
              <input name="peso_mod" type="text" class="caja" id="peso_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_9_mod(event)" size="12" maxlength="9" value="{$peso}">
Kg.</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Retornable:</td>
            <td colspan="3" align="left" valign="bottom">
			<div  id="envase"></div>			</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Stock actual:</td>
            <td align="left" valign="bottom"><input name="stock_actual_mod" type="text" class="caja" id="stock_actual_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_11_mod(event)" size="12" maxlength="9" ReadOnly value="{$stock_actual}">            </td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Stock m&iacute;nimo:</td>
            <td colspan="3" align="left" valign="bottom"><input name="stock_min_mod" type="text" class="caja"  id="stock_min_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_12_mod(event)" size="12" maxlength="9"value="{$stock_min}"></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Stock m&aacute;ximo:</td>
            <td align="left" valign="bottom"><input name="stock_max_mod" type="text" class="caja"  id="stock_max_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_13_mod(event)" size="12" maxlength="9"value="{$stock_max}"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Comisi&oacute;n Vta: </td>
            <td colspan="3" align="left" valign="bottom"><input name="vta_mod" type="vta" class="caja"  id="vta_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_14_mod(event)" size="12" maxlength="9"value="{$p_vta}">
            %</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Comisi&oacute;n Transporte:</td>
            <td align="left" valign="bottom"><input name="transporte_mod" type="text" class="caja"  id="transporte_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_art_15_mod(event)" size="12" maxlength="9"value="{$p_trans}">
            %</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom"  >IVA:</td>
            <td colspan="3" align="left" valign="bottom"  ><div id="iva_mod"></div></td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td colspan="2" align="center" valign="middle">&nbsp;</td>
            <td valign="top"></td>
          </tr>
          <tr>
<td colspan="4" align="left" valign="bottom"  >&nbsp;</td>
<td align="left" valign="bottom">&nbsp;</td>
<td colspan="2" align="center" valign="middle">&nbsp;</td>
<td valign="top"></td>
</tr>
<tr>
<td colspan="7" align="left" valign="bottom"  >
	<div class="seccion" align="left">Precios de venta seg&uacute;n categor&iacute;a
	  <hr>
	</div>
  <div id="categorias_mod"></div>			
			
  <!-- 			<div class="blur"> 
				<div class="shadow"> 
					<div class="content" id="foto_mod"></div> 
				</div> 
			</div> 
 -->			 </td>
  <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">&nbsp;</td>
            <td colspan="3" align="left" valign="bottom">			</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">&nbsp;</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="7" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto_mod" name= "oculto_mod" value="{$codigo}">
                <input type="hidden"  id="oculto_grupo_mod" name= "oculto_grupo_mod" value="{$grupo}">
				<input type="hidden"  id="oculto_marca_mod" name= "oculto_marca_mod" value="{$marca}">
				<input type="hidden"  id="oculto_variedad_mod" name= "oculto_variedad_mod" value="{$variedad}">
				
				<input type="hidden"  id="foto_mod" name= "foto_mod" value="{$foto}">
				<!-- campo oculto-->
                <input name="enviar_mod" type="button" class="botones" id="enviar_mod" onclick="javascript: modificar_articulo_db()"  value="Modificar">
                <input name="cancelar_mod" type="button" class="botones" id="cancelar_mod" onclick="javascript: buscar_articulo()"  value="Cancelar">

			</div></td>
            <td width="99" valign="top">			</td>
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
    <td width="39%" align="center" valign="top">
			<div id="listado_mod" class="CFilas"></div>
		<div id="msg_mod"  class="nota">{#nota_modificacion#} </div>
	</td>
    <td width="15%" align="center" valign="top"></td>
   </tr>

</table>
</body>
</center>
</html>
