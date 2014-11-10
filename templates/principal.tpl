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
        {include file="_css_includes.tpl"}

    </head>
        <body onLoad=""> <!-- javascript: usuarioconectado(); -->
            <div id="navigation"></div>
            
            <div id="wrapper">
                <!-- HEADER -->                
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
                    <div id="usuario_conectado" class="usuario_conectado" align="right"></div>                
                </div>
                
                <!-- OLD MENU-->
                <script language="JavaScript" src="php/menu/JSCookMenu.js"></script>
                <script language="JavaScript" src="php/menu/theme.js"></script>
                <script language="JavaScript" src="php/menu/items.js"></script>
                <div align="left" id="MenuAplicacion"></div>
                <script language="JavaScript">
                    //cmDraw ('MenuAplicacion', MenuPrincipal, 'hbr', cmThemeOffice, 'ThemeOffice');
                </script>
                <!-- OLD MENU-->
                
                <!-- MENU -->
                <div id="top-menu"></div>
            
                <!-- TABS -->
                <div id="tabs">
                    <div class="tab" style="text-align:center">
                        <img  src="imagenes/fondo_oficina.png">
                        <div  align="center" class="contentInfo"> &fnof;actuweb v2.0 - Sistema de Facturaci&oacute;n web</div>
                        <div id="Pie" align="center" class="nota_azul">DESARROLLADO POR: BENITEZ CARLOS ALBERTO [2014] </div>
                    </div>
                </div>
            </div>


        </body>

        <!-- JS -->
        <script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
        {include file="_js_includes.tpl"}

</html>
