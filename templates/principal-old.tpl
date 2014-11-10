{config_load file="conf.conf"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{#tituloPagina#}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

		  <link rel="stylesheet" href="menu/theme.css" type="text/css">
		  
		  <script type="text/javascript" language="JavaScript" src="menu/JSCookMenu.js"></script>
		  <script type="text/javascript" language="JavaScript" src="menu/theme.js"></script>
		  <script type="text/javascript" language="JavaScript" src="menu/items.js"></script>

		  
<!-- CSS -->
<link href="../css/estilos.css" rel="stylesheet" type="text/css">
<link href="../css/estilo_header.css" rel="stylesheet" type="text/css">
<!-- JS -->
<script language="javascript" src="../js/ajax.js"></script>

<link rel="shortcut icon"  href="../imagenes/favicon.ico">
<!-- debe ser de 16 por 16 -->
</head>
<center>
<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: infoEmpresa();usuarioconectado();"> <!-- fecha_actual();hora_actual(); -->
	<div id="navigation"></div>
	
	<div id="wrapper">
		<div id="container" class="clear-block">
			<div id="header">
				<div id="logo-floater"> <div id="datosEmpresa" align="left"></div> </div> 
				<!--
                                <ul class="links primary-links">
					<li><a onClick=" document.getElementById('principal').src ='alta_cliente.php'" class="iconos">Clientes</a></li>
					<li><a onClick=" document.getElementById('principal').src ='alta_articulo.php'" class="iconos">Articulos</a></li>
					<li><a onClick=" document.getElementById('principal').src ='alta_remito_vta.php'" class="iconos">Remitos</a></li>
                    <li><a onClick=" document.getElementById('principal').src ='alta_presupuesto_vta.php'" class="iconos">Presupuestos</a></li>
                    <li><a onClick=" document.getElementById('principal').src ='alta_factura_vta.php'" class="iconos">Facturas</a></li>
				</ul>
				-->
			</div>
			<div id="usuario" class="usuario_conectado" align="right"></div>                
		</div>
		<div align="left" id="MenuAplicacion"></div>
			<script language="JavaScript">
				cmDraw ('MenuAplicacion', MenuPrincipal, 'hbr', cmThemeOffice, 'ThemeOffice');
			</script>
			<hr>
		<iframe  src="entrada.php" name="principal"  id="principal" title="principal" width="100%" height="10000px" frameborder=0 scrolling="no" style="margin-left: 0px; margin-right: 0px; margin-top: -6px; margin-bottom: 0px;"></iframe>
  </div>
</body>
</center>
</html>
