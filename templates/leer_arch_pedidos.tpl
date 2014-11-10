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
	<script language="javascript" src="../js/tree_ajax.js"></script>
	<script language="javascript" src="../js/tree_tree.js"></script>

	<!-- FAVICON 16 x 16 -->
	<link rel="shortcut icon"  href="../imagenes/favicon.ico">

</head>
<center> <!-- background="../imagenes/fondo_cuadrito.gif" -->
<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="actualizar_lista_pedidos();"> 
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
     <td width="100%" height="21" class="seccion" valign="top">
		<div align="left">Lista de Pedidos 	<img src="../imagenes/nuevo.png" width="16" height="18" border="0" class='iconos'  title="Click para Actualizar la Lista" onClick="actualizar_lista_pedidos();"/> <hr></div></td> 
 </tr>
 
 <tr>
    <td align="left" valign="top">
	 	<fieldset  style="width:90%; height:10%;">
				<!-- DIV CONTENEDOR DEL TREEVIEW -->
				<div id="tree1" ></div> 
				<!-- DIV CONTENEDOR DEL TREEVIEW -->
		</fieldset>		
	 </td>
 </tr>
 </table>
 <!-- <div id="lista_pedidos"></div> -->
 <div id="loadingbox" style="visibility:hidden "></div>
</body>
</center>
</html>