{config_load file="conf.conf"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{#tituloPagina#}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- CSS -->
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<link href="css/estilo_header.css" rel="stylesheet" type="text/css">




<!-- JS -->
<script language="javascript" src="js/ajax.js"></script>

<link rel="shortcut icon"  href="imagenes/favicon.ico">
<!-- debe ser de 16 por 16 -->
</head>
<center>
<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0" onLoad="javascript: infoEmpresa();usuarioconectado();"> <!-- fecha_actual();hora_actual(); -->
	<div id="navigation"></div>
	
	<div id="wrapper">
		<div id="container" class="clear-block">
			<div id="header">
				<div id="logo-floater"> <div id="datosEmpresa" align="left"></div> </div> 
				<ul class="links primary-links">
					<li class="page_item page-item-34"><a onClick=" document.getElementById('principal').src ='alta_cliente.php'" class="iconos">Clientes</a></li>
					<li class="page_item page-item-11"><a onClick=" document.getElementById('principal').src ='alta_articulo.php'" class="iconos">Articulos</a></li>
					<li class="page_item page-item-16"><a onClick=" document.getElementById('principal').src ='alta_factura_vta.php'" class="iconos">Factura</a></li>
				</ul>
				
			</div>
			<div id="usuario" class="usuario_conectado" align="right"></div>                
		</div>

		<br>	
		<link type="text/css" media="screen" rel="stylesheet" href="css/menu-bar.css">
		<link type="text/css" media="screen" rel="stylesheet" href="css/tab-view.css">
		
		<script type="text/javascript" src="js/menu-bar.js"></script>
		<script type="text/javascript" src="js/menu-ajax.js"></script>
		<script type="text/javascript" src="js/tab-view.js"></script>
		
	
		<div id="menu" ></div> 
		<script type="text/javascript" src="js/menu-items.js"></script>
		

		<div id="tabs">
			<div class="tab">
				Principal...
			</div>
		</div>
		
		<script type="text/javascript">
			initTabs('tabs',Array('Principal'),0,'100%',400,Array(false));
		</script>

		
</body>
</center>
</html>


