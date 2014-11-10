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
<center> <!-- background="../imagenes/fondo_cuadrito.gif" -->
<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0"> 
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0"><!--DWLayoutTable-->
  <tr>
    <td width="100%" height="21" class="seccion" valign="top">
	<div align="left">Seccion: Restaurar Copia de Seguridad<hr></div></td>

   <tr>
    <td colspan="2" align="center" valign="top">
		<div style="width:41%; " id="msg_mod"  class="nota">
			<img src="../imagenes/advertencia.gif" width="16" height="16"> Seleccione el archivo y pulse el bot&oacute;n &quot;Restaurar&quot;.</div>

		<br>
		<fieldset style="width:40%; height:300px;">
				<div id="mensage" class="advertencia"></div>
				<br>
				<form  name="frm_restaurar" method="post" enctype="multipart/form-data" action="backup_restaurar.php"  target="listado" > <!-- action="restaurar_base_datos.php" -->
					<input  id="archivo" name="archivo" type="file" class="botones"  title="Seleccionar Archivo" size="50">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
					<input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: restaurar_base_datos()"  value="Restaurar">
					<input type="hidden" name= "valido" > <!-- campo oculto-->
				</form>	 
				<br>
				<div id="listado2" align="center"></div>
				<iframe name="listado" height="80%" width="100%" frameborder=0 scrolling="no" ></iframe>
				
		</fieldset>
		
		
	</td>
  </tr>
</table>
</body>
</center>
</html>