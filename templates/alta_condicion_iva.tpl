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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: document.frm.nombre.focus();listar_comp();buscar_cond_iva();">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Seccion: Alta de Condición de IVA 
        <hr>
    </div></td>
    <td width="50%" align="right" valign="top" class="seccion">
	<img src="../imagenes/lupa.jpg" width="16" height="18" border="0" class='iconos'  title="Nuevo" onClick=" window.opener.document.getElementById('principal').src ='buscar_cond_iva.php'" /> buscar &nbsp;&nbsp;
	<img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_cond_iva.php')" /> pdf  &nbsp;&nbsp;<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_cond_iva.php')" /> imprimir<hr></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:27%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="20" height="-4" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="2" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="27" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
          <td width="20" height="-1" valign="top" class="LLL"><div align="right"></div></td>
            <td width="128" valign="top">
			Nombre:			</td>
            <td width="152" align="left" valign="top">  
				<!-- <input name="nombre" id="nombre" type="text" class="caja" size="27" onKeyUp="pasar_foco_cond_iva_1(event)" > -->

				<!--
					6 = F = CONSUMIDOR FINAL
					5 = E = EXENTO
					7 = S = NO CATEGORIZADO
					4 = N = NO RESPONSABLE
					1 = I = IVA RESPONSABLE INSCRIPTO 
					2 = M = RESPONSABLE MONOTRIBUTO
					3 = R = IVA RESPONSABLE NO INSCRIPTO
				-->
				
				<select id="nombre" name="nombre" class="caja" onKeyUp="pasar_foco_cond_iva_1(event)">
				  <option value="6">CONSUMIDOR FINAL</option>
				  <option value="5">EXENTO</option>
				  <option value="7">NO CATEGORIZADO</option>			  
				  <option value="4">NO RESPONSABLE</option>
				  <option value="1">RESP. INSCRIPTO</option>
				  <option value="2">RESP. MONOTRIBUTO</option>
				  <option value="3">RESP. NO INSCRIPTO</option>
				  <option value="99">PRESUPUESTO</option>
				</select>
			</td>
            <td width="27" align="left"valign="top"></td>
          </tr>
          <tr>
          <td width="20" height="0" valign="top" class="LLL"><div align="right"></div></td>
            <td valign="top" align="left">Comprobante:</td>
            <td   valign="bottom"align="left"><div id="comp"></div></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td height="4" valign="top" class="LLL">&nbsp;</td>
            <td valign="bottom">Requiere N&ordm; CUIT: </td>
            <td valign="bottom">
			<select name="req_cuit" class="caja" id="req_cuit" onKeyUp="pasar_foco_cond_iva_3(event)">
              <option value="N">NO</option>
              <option value="S">SI</option>
            </select></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td width="20" height="4" valign="top" class="LLL">&nbsp;</td>
            <td colspan="2" valign="bottom"><input name="textfield" type="text" disabled="disabled" class="caja" style="visibility:hidden" size="5" maxlength="1"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td width="20" height="9" valign="top" class="LLL">&nbsp;</td>
            <td colspan="2" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: registrar_cond_iva()"  value="Registrar">
            </div></td>
            <td width="27" valign="top">			</td>
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
		<div id="listado" class="CFilas"></div>
		<div id="msg"></div>	</td>
  </tr>

</table>
</body>
</center>
</html>
