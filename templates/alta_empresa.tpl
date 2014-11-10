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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" align="center" valign="top">
	<div id="cuerpo"></div>

<form name="frm"  id="frm">	
<fieldset  style="width:85%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="20" height="19" rowspan="7" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="8" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="28" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td width="64" height="19" valign="top">
			<div align="left">Razon Social:</div>
			</td>
            <td width="105" align="left" valign="top"><input name="razon"  id="razon"type="text" class="caja"  onKeyUp="pasar_foco_emp_1(event)" size="20"></td>
            <td width="63" align="left" valign="top">Propietario:</td>
            <td width="101" align="left" valign="top"><input name="dueno"  id="dueno"type="text" class="caja"  onKeyUp="pasar_foco_emp_2(event)" size="20"></td>
            <td width="52" align="left" valign="top">Cond. IVA:</td>
            <td width="100" align="left" valign="top"><div  id="iva"></div></td>
            <td width="53" align="left" valign="top">CUIT: </td>
            <td width="126" align="left" valign="top"><input name="cuit1" id="cuit1" type="text" class="caja"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_emp_3(event)" size="2" maxlength="2" >
-
  <input name="cuit2" type="text" class="caja" id="cuit2"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_emp_4(event)" size="8" maxlength="8">
-
<input name="cuit3" type="text" class="caja" id="cuit3"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_emp_5(event)" size="1" maxlength="1"></td>
            <td width="28" align="left"valign="top"></td>
          </tr>
          <tr>
            <td valign="top" align="left"><div align="left">Ing. Brutos : </div></td>
            <td   valign="bottom"align="left"><input name="ing_bruto" type="text" class="caja" id="ing_bruto"  onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_emp_6(event)" size="12" maxlength="12" ></td>
            <td   valign="bottom"align="left">Direcci&oacute;n: </td>
            <td align="left"   valign="bottom"><input  name="direccion"  id="direccion"type="text" onKeyUp="pasar_foco_emp_8(event)"class="caja" size="20"></td>
            <td align="left"   valign="bottom">Pais:</td>
            <td align="left"   valign="bottom"><div  id="paises"></div></td>
            <td align="left"   valign="bottom">Provincia:</td>
            <td align="left"   valign="bottom"><div  id="provincias"></div></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Localidad:</td>
            <td align="left" valign="bottom"><div  id="localidades"></div></td>
            <td align="left" valign="bottom">Telefono:</td>
            <td align="left" valign="bottom"><input name="tel" type="text" class="caja"  id="tel" onKeyUp="pasar_foco_emp_10(event)" size="20"></td>
            <td align="left" valign="bottom">Fax:</td>
            <td align="left" valign="bottom"><input name="fax" type="text" class="caja"  id="fax" onKeyUp="pasar_foco_emp_11(event)" size="20"></td>
            <td align="left" valign="bottom">Celular:</td>
            <td align="left" valign="bottom"><input name="cel"  id="cel" onKeyUp="pasar_foco_emp_12(event)" type="text" class="caja"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="bottom">Web:</td>
            <td align="left" valign="bottom"><input name="web" type="text" class="caja"  id="web" onKeyUp="pasar_foco_emp_13(event)" size="20"></td>
            <td align="left" valign="bottom">E-mail:</td>
            <td align="left" valign="bottom"><input name="mail" type="text" class="caja"  id="mail" onKeyUp="pasar_foco_emp_14(event)" size="20"></td>
            <td align="left" valign="bottom">Inicio  Act.:</td>
            <td colspan="3" align="left" valign="bottom"><input name="dia" type="text" class="caja"  id="dia" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_emp_15()" size="2" maxlength="2">
/
  <input name="mes" type="text" class="caja"  id="mes" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_emp_16()" size="2" maxlength="2">
/
<input name="ano" type="text" class="caja"  id="ano" onKeyPress="return solo_entero(event)" onKeyUp="pasar_foco_emp_17(event)" size="4" maxlength="4"></td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="8" valign="bottom">&nbsp;</td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td colspan="8" valign="bottom"><div align="center">
                <input type="hidden"  id="oculto" name= "oculto" >
				
                <!--  campo oculto-->
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: registrar_empresa()"  value="Registrar">
            </div></td>
            <td width="28" valign="top">

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
    <td align="center" valign="top">
		<div id="listado"></div>
		<div id="msg"  class="advertencia"></div>
	</td>
  </tr>

</table>
</body>
</center>
</html>
