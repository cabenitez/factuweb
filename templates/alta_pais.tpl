<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" align="right" valign="top" class="seccion">
      <img src="../imagenes/lupa.jpg" width="18" height="18" border="0" class='iconos'  title="Buscar" onClick=" window.opener.document.getElementById('principal').src ='buscar_pais.php'" />buscar &nbsp;&nbsp;
      <img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_pais.php')" /> pdf  &nbsp;&nbsp;
      <img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_pais.php')" /> imprimir
      <hr>
    </td>
  </tr>

  <tr>
    <td colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:20%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#BFBFBF">
          <tr>
            <td width="18" height="19" rowspan="4" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
            <td colspan="2" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="18" valign="top"><img src="../imagenes/18.jpg" width="18" height="18" /></td>
          </tr>
          <tr>
            <td width="12" align="left" valign="bottom">Pais:</td>
            <td width="151" align="left"valign="bottom">
              <input name="nombre" id="nombre" type="text" class="caja" size="27" onKeyUp="pasar_foco_pais_registrar(event)" >       			    </td>
            <td width="18" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom"><input name="textfield" type="text" disabled="disabled" class="caja" style="visibility:hidden" size="5" maxlength="1"></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: registrar_pais()"  value="Registrar">
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
		<div id="listado"></div>
		<div id="msg"></div>
	</td>
  </tr>
</table>

<script type="text/javascript">
  buscar_pais();
</script>