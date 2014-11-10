{config_load file="conf.conf"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{#tituloPagina#}</title>
</head>



<frameset cols="20%,80%"  frameborder=1 framespacing=0>
	<!-- Links, deberíamos colocar el atributo target a los enlaces, tal como sigue.	<a href="pagina2.html" target="principal">Portada</a> | -->
	
	<frame src="leer_arch_pedidos.php"  scrolling="no"  frameborder="yes"  bordercolor="#b6c7e5">
	<frame src="alta_factura_vta.php" scrolling="no" frameborder="0">
	
	<noframes>
        <body>
            <p>su navegador <b> NO reconoce frames</b></p>
        </body>
    </noframes>

</frameset>


</html>