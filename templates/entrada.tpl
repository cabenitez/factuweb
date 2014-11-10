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
    <link rel="stylesheet" type="text/css" href="../css/tab-view.css" media="screen">

    <!-- JS -->
    <script language="javascript" src="../js/ajax.js"></script>
    <script language="javascript" src="../js/paginador.js"></script>
    <script language="javascript" src="../js/autocompletador.js" charset="utf-8"></script> 
    <script language="javascript" src="class_modal/js/ventana-modal-1.1.1.js"></script>
    <script language="javascript" src="class_modal/js/abrir-ventana-fija.js"></script>
    <script language="javascript" src="../js/tooltip.js"></script>
    <script language="javascript" src="../js/tab-view.js"></script>
    <script language="javascript" src="../js/ajax-tabs.js"></script>

    <!-- FAVICON 16 x 16 -->
    <link rel="shortcut icon"  href="../imagenes/favicon.ico">

    </head>
    
    <body leftmargin="0"  topmargin="0" marginwidth="0"  bgcolor="#FFFFFF" marginheight="0" class="nombreEmpresaOLD">

        <a href="#" onclick="createNewTab('tabs','Tab dinamica','','alta_pais.php',true);return false">Nuevo Tab</a><br>
        <br />
        <div id="tabs">
            <div class="tab">
                <img  src="../imagenes/fondo_oficina.png">
                <div  align="center" class="contentInfo"> &fnof;actuweb v2.0 - Sistema de Facturaci&oacute;n web</div>
            </div>
        </div>

        <script type="text/javascript">
            initTabs('tabs',Array('Inicio'),0,99,250,Array(false));
        </script>
    </body>
</html>
