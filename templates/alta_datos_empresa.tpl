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
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: buscar_empresa();"> <!--buscar_proveedor() -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="21" class="seccion" valign="top"><div align="left">Datos de Empresa <hr></div></td> 
    <td width="50%" align="right" valign="top" class="seccion"><img src="../imagenes/imprimir.png" width="18" height="18" class='iconos' onClick="javascript: imprimir_listado('imprimir_datos_empresa.php')" /> imprimir<hr></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
		<div id="cuerpo"></div>
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
