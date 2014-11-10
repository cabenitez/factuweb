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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript:listar_grupo();buscar_marca();"> <!--buscar_prov(); -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" colspan="3" valign="top" class="seccion"><div align="left">Seccion: Modificar Variedad
      <hr>
    </div></td>
  </tr>
  <tr>
    <td height="84" colspan="3" align="center" valign="top">
	
<form name="frm_mod"  id="frm_mod">	
<fieldset  style="width:30%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="26" height="19" rowspan="5" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="5" valign="top"><div id="mensaje_mod" class="advertencia"></div></td>
            <td width="31" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Codigo:</td>
            <td align="left" valign="bottom"><input name="codigo_mod" type="text" class="caja" id="codigo_mod" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_vari_5(event)" size="12" maxlength="9" value="{$codigo}"></td>
            <td align="left"valign="bottom"></td>
            <td align="left"valign="bottom">Descripcion:</td>
            <td align="left"valign="bottom"><input name="nombre_mod" id="nombre_mod" type="text" class="caja" size="27" onKeyUp="pasar_foco_vari_6(event)" value="{$nombre}"></td>
            <td width="31" rowspan="4" align="left"valign="top">			</td>
          </tr>
          <tr>
            <td width="125" align="left" valign="bottom">
			Grupo:	</td>
            <td width="135" align="left" valign="bottom"><div id="grupos_mod"></div>

                             </td>
            <td width="31" align="left"valign="bottom"></td>
            <td width="31" align="left"valign="bottom">Marca:</td>
            <td width="31" align="left"valign="bottom"><div id="marcas_mod"></div></td>
            </tr>
          <tr>
            <td colspan="2" valign="bottom">&nbsp;</td>
            <td valign="top"></td>
            <td valign="top"></td>
            <td valign="top"></td>
            </tr>
          <tr>
            <td colspan="5" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto_mod" name= "oculto_mod"value="{$codigo}" >
				<input type="hidden"  id="oculto_marca_mod" name= "oculto_marca_mod"value="{$marca}" >
				<input type="hidden"  id="oculto_grupo_mod" name= "oculto_grupo_mod"value="{$grupo}" >
				
                <!-- campo oculto-->
                <input name="enviar_mod" type="button" class="botones" id="enviar_mod" onclick="javascript: modificar_variedad_db()"  value="Modificar">
                <input name="cancelar_mod" type="button" class="botones" id="cancelar_mod" onclick="javascript: buscar_variedad()"  value="Cancelar">
            </div></td>
            </tr>
        </table></td>
      </tr>
    </table>
		</fieldset>
</form>	</td>
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
