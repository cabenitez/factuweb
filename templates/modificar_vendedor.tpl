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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: document.frm.codigo.focus();"><!-- listar_paises();listar_provincias();listar_localidades();listar_iva_rep();listar_vehiculo_rep();buscar_repartidor() -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" colspan="3" valign="top" class="seccion"><div align="left">Seccion: Modificar Vendedor 
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
            <td width="31" height="19" rowspan="7" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="5" valign="top"><div id="mensaje_mod" class="advertencia"></div></td>
            <td width="48" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="203" align="left"valign="bottom">
			C&oacute;digo:			</td>
            <td width="239" align="left" valign="bottom">

                <input name="codigo_mod" type="text" class="caja" id="codigo_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_ven_1_mod(event)" size="7" maxlength="11" value="{$codigo}" ></td>
            <td width="1" align="left" valign="top">&nbsp;</td>
            <td width="93" align="left" valign="bottom">DNI:</td>
            <td width="163" align="left" valign="bottom"><input name="dni_mod"type="text" class="caja"  id="dni_mod"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_ven_2_mod(event)" maxlength="8"value="{$dni}"></td>
            <td width="48" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="bottom" align="left">Nombre y Apellido:</td>
            <td   valign="bottom"align="left"><input  name="nombre_mod"  id="nombre_mod"type="text" onKeyUp="pasar_foco_ven_3_mod(event)"class="caja" size="30"value="{$nombre}"></td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">Direcci&oacute;n: </td>
            <td   valign="bottom"align="left"><input  name="direccion_mod"  id="direccion_mod"type="text" onKeyUp="pasar_foco_ven_4_mod(event)"class="caja" size="30"value="{$dir}"></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="bottom" align="left">Pais:</td>
            <td   valign="bottom"align="left"><div  id="paises_mod"></div></td>
            <td   valign="bottom"align="left">&nbsp;</td>
            <td   valign="bottom"align="left">Provincia:</td>
            <td   valign="bottom"align="left"><div  id="provincias_mod"></div></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Localidad:</td>
            <td align="left" valign="bottom"><div  id="localidades_mod"></div></td>
            <td valign="bottom">&nbsp;</td>
            <td align="left" valign="bottom">Telefono:</td>
            <td align="left" valign="bottom"><input name="tel_mod"  id="tel_mod" onKeyUp="pasar_foco_ven_7_mod(event)" type="text" class="caja" value="{$tel}"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="5" valign="bottom">&nbsp;</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="5" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto_mod" name= "oculto" value="{$codigo}">
                <input name="enviar_mod" type="button" class="botones" id="enviar_mod" onclick="javascript: modificar_vendedor_db()"  value="Modificar">
                <input name="cancelar_mod" type="button" class="botones" id="cancelar_mod" onclick="javascript: buscar_vendedor()"  value="Cancelar">
                <!-- campo oculto-->
            </div></td>
            <td width="48" valign="top">

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
