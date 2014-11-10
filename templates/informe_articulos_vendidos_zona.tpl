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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: listar_zona_informe_art_zona();listar_grupo_informe_ranking_art();listar_marca_informe_ranking_art();listar_variedad_informe_ranking_art();">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Seccion: Ranking de Artículos Vendidos 
        <hr>
    </div></td>
    <td width="50%" align="right" valign="top" class="seccion">	<hr></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:45%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="24" height="19" rowspan="7" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="4" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="31" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="307" align="left" valign="bottom">
			<div align="left">Zona:</div>			</td>
            <td width="494" align="left" valign="top"><div id="zonas"></div></td>
            <td width="250" align="left" valign="top">&nbsp;</td>
            <td width="145" align="left" valign="top">&nbsp;</td>
            <td width="31" align="left"valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom"><div align="left">Fecha desde: </div></td>
            <td align="left" valign="bottom"><input name="dia" type="text" class="caja" id="dia"onKeyUp="informe_compras_cliente_3(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
/
  <input name="mes" type="text" class="caja" id="mes"onKeyUp="pasar_foco_iva_ventas_2(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
/
<input name="ano" type="text" class="caja" id="ano"onKeyUp="pasar_foco_iva_ventas_3(event)" onKeyPress="return solo_entero(event)"value="" size="4" maxlength="4"></td>
            <td align="left" valign="bottom"> Fecha hasta:</td>
            <td align="left" valign="bottom"><input name="dia_h" type="text" class="caja" id="dia_h"onKeyUp="informe_articulos_cliente_3(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
/
  <input name="mes_h" type="text" class="caja" id="mes_h"onKeyUp="pasar_foco_iva_ventas_5(event)" onKeyPress="return solo_entero(event)"value="" size="2" maxlength="2">
/
<input name="ano_h" type="text" class="caja" id="ano_h"onKeyUp="pasar_foco_iva_ventas_7(event)" onKeyPress="return solo_entero(event)"value="" size="4" maxlength="4"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td width="307" align="left" valign="bottom">C&oacute;d. art&iacute;culo:</td>
            <td width="494"align="left"   valign="bottom"><input name="codigo_art" type="text" class="caja" id="codigo_art"  onKeyPress="return solo_entero(event)" onKeyUp="informe_articulos_cliente_4(event)" size="12" maxlength="9" >
            </td>
            <td width="250"align="left"   valign="bottom">Grupo:</td>
            <td width="145"align="left"   valign="bottom"><div id="grupos"></div></td> 
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Marca:</td>
            <td align="left" valign="bottom"><div id="marcas"></div>
            <td align="left" valign="bottom">Variedad:            
            <td align="left" valign="bottom"><div id="variedades"></div>            
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="4" valign="bottom"><input name="busca_pop_up" type="button" class="botones" id="busca_pop_up"  style="visibility:hidden" onClick="javascript: buscar_cliente_informe()"  value="c"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="4" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="buscar" type="button" class="botones" id="buscar" onClick="javascript: buscar_informe_articulos_zona()"  value="Buscar"> 
</div></td>
            <td width="31" valign="top">

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