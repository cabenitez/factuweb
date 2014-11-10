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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: document.frm.nombre.focus(); MM_preloadImages('../imagenes/ver_clave2.gif') ; buscar_usuarios();"> <!-- buscar_grupo(); -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" class="seccion" valign="top"><div align="left">Seccion: Alta de Usuarios
      <hr>
    </div></td>
   <!-- 
	<td width="50%" align="right" valign="top" class="seccion"> 

 	<img src="../imagenes/lupa.jpg" width="16" height="18" border="0" class='iconos'  title="Nuevo" onClick=" window.opener.document.getElementById('principal').src ='buscar_grupo.php'" /> buscar &nbsp;&nbsp;
	<img src="../imagenes/pdf.gif" width="18" height="18" border="0" class='iconos'  title="Exportar" onClick="javascript: exportar_listado('exportar_grupo.php')" /> pdf  &nbsp;&nbsp;<img src="../imagenes/imprimir.png" width="18" height="18" title="Imprimir" class='iconos' onClick="javascript: imprimir_listado('exportar_grupo.php')" /> imprimir<hr></td>
 -->  

 </tr>
  <tr>
    <td height="84" colspan="2" align="center" valign="top">
	
<form name="frm"  id="frm">	
<fieldset  style="width:55%; height:10%;">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
          <tr>
            <td width="18" height="19" rowspan="17" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            <td colspan="3" valign="top"><div id="mensaje" class="advertencia"></div></td>
            <td width="18" valign="top"><span class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></span></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="bottom"><table width="440" border="0" cellpadding="0" cellspacing="2">
<tr>
<td align="left" valign="bottom" bordercolor="#BFBFBF">Nombre:</td>
<td width="344" colspan="3" align="left"valign="bottom" bordercolor="#BFBFBF"><input name="nombre" id="nombre" type="text" class="caja" size="27" onKeyUp="pasar_foco_alta_usuario_1(event)" ></td>
</tr>
<tr>
<td width="90" align="left" valign="bottom" bordercolor="#BFBFBF">Usuario:</td>
<td colspan="3" align="left"valign="bottom" bordercolor="#BFBFBF"><input name="usuario" type="text" class="caja" id="usuario" onKeyUp="pasar_foco_alta_usuario_2(event)" size="27" maxlength="15" ></td>
</tr>
<tr>
<td valign="bottom" bordercolor="#BFBFBF">Clave:</td>
<td colspan="3"  valign="bottom" bordercolor="#BFBFBF"><input name="clave" id="clave" type="password" class="caja" size="27" onKeyUp="pasar_foco_alta_usuario_3(event)" >
<a href="#" onMouseOut="MM_swapImgRestore();ocultar_clave_usuario('clave','clave2')"  onMouseOver="MM_swapImage('ver_clave','','../imagenes/ver_clave2.gif',1);mostrar_clave_usuario('clave','clave2')"><img src="../imagenes/ver_clave.gif" name="ver_clave" width="17" height="17" border="0" ></a></td> 
</tr>
<tr>
<td valign="bottom" bordercolor="#BFBFBF">Repetir Clave: </td>
<td colspan="3" valign="bottom" bordercolor="#BFBFBF"><input name="clave2" id="clave2" type="password" class="caja" size="27"  ></td> <!-- onKeyUp="pasar_foco_alta_usuario_4(event)" -->
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
<input type="checkbox" name="marcatodos" onClick="todos(this.form)">Marcar todos |

<input type="checkbox" name="desmarcatodos" onClick="ninguno(this.form)">Desmarcar todos |

<input type="checkbox" name="invierte" onClick="invertir(this.form)">Invertir selección</div></td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td colspan="3" valign="bottom"><hr></td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td width="33%" valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
ABM Zonas geogr&aacute;ficas </td>
<td width="33%" valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
ABM Al&iacute;cuotas </td>
<td width="33%" valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
AM Comprobantes </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
AM Condici&oacute;n de IVA </td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
AM Talonarios </td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
AM Proveedores </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
AM Veh&iacute;culos </td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
AM Repartidores </td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
AM Vendedores </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
AM Categor&iacute;as </td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
AM Formas de pago</td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
AM Clientes </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
AM Art&iacute;culos </td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
AM Datos de Empresa </td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
Configurar Listados </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
ABM Usuarios </td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
Ingreso Stock</td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
 Facturas Compra </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
Remitos Venta </td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox"> 
Facturas Venta</td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
Notas de Cr&eacute;dito </td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox"> 
  Cuenta Corriente
</td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
Comisiones</td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
Devoluciones</td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
Finalizar Cargas </td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox"> 
Informes</td>
<td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
Estad&iacute;sticas</td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
  <td valign="bottom"><input type="checkbox" name="casilla1" value="checkbox">
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
                <input type="hidden"  id="oculto" name= "oculto" >
                <!-- campo oculto-->
                <input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: registrar_usuario()"  value="Registrar">
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
		<div id="msg"  class="advertencia"></div>
  </td>
  </tr>
</table>
</body>
</center>
</html>
