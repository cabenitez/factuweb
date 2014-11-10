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
	<script language="javascript" src="../js/ajax_estadisticas.js"></script>
	<!-- FAVICON 16 x 16 -->
	<link rel="shortcut icon"  href="../imagenes/favicon.ico">

</head>
<center>
<body  leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" > <!-- -->
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" class="seccion" valign="top"><div align="left">Seccion: Ranking de Ventas por remito 
        <hr>
    </div></td>
  </tr>
  <tr>
    <td height="37" align="center" valign="top">
		<iframe  src="ranking_prueba_borrar_grafico.php" name="grafico"  id="grafico" title="grafico" width="100%" height="1000px" frameborder=0 scrolling="no" style="margin-left: 0px; margin-right: 0px; margin-top: 5px; margin-bottom: 0px;"></iframe>
	</td>
  </tr>
   <tr>
    <td align="center" valign="top">
		<div id="listado" class="CFilas"></div>
		<div id="msg"></div>	</td>
  </tr>

</table>
</body>
</center>
</html>
