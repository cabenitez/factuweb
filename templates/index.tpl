{config_load file="conf.conf"}
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>{#nombreSys#} {#versionSys#}</title>
		
		<!-- CHARSET -->		
		<meta charset="UTF-8">
		
		<!-- FAVICON -->		
		<link rel="shortcut icon"  href="../imagenes/favicon.ico">

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="../css/estilos.css" />
		<link rel="stylesheet" type="text/css" href="../css/login.css" />
		
		<!-- JS -->
		<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>	
		<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="../js/additional-methods.min.js"></script>
		<script type="text/javascript" src="../js/messages_es.js"></script>
		<script type="text/javascript" src="../js/script.js"></script>
		<!--<script type="text/javascript" src="../js/ajax.js"></script>-->
	</head>
	<center>
		<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0">
		  <div id="navigation"></div>

		  <div id="wrapper">
			<div id="container" class="clear-block">
				<div id="header">
					<div id="logo-floater">
						<div id="datosEmpresa" align="left">
							<div id="nombre_empresa" class="nombreEmpresa">{#nombreSys#}</div>
							<div id="nombre_empresa" class="datosEmpresa">{#sloganSys#}</div>
							<div id="nombre_empresa" class="datosEmpresa"></div>
							<div id="nombre_empresa" class="datosEmpresa"></div>							
						</div>
					</div> 
				</div>
				<div class="usuario_conectado" align="right">
					<h1><strong>{#versionSys#}</strong></h1>
					<p>&nbsp;</p>
					<p>INGRESO AL SISTEMA </p>
				</div>                
			</div>
			<div id="login-main"> 
				<div id="login-form-container">

				    <div class="user-icon"></div>
				    <div class="pass-icon"></div>

					<form name="login-form" class="login-form">
					    <div class="header">
					    	<h1>Ingrese su usuario y clave</h1>
					    	<span class="mensaje"></span>
					    </div>
					    <div class="content">
							<input name="usuario" id="usuario" type="text" class="input username required" value=""  />
						    <input name="clave" id="clave" type="password" class="input password required" value=""  />
					    </div>
					    <div class="footer">
							<input type="submit" name="login-btn" id="login-btn" class="button" value="Entrar">
					    </div>
					</form>

				</div>
			</div>
						
			<p class="herramientas">{#Herramientas_Sistema#}</p>
		 </div>
		</body>
	</center>
</html>
