function abrirVentanaVariable(pagina, nombre, titulo) {
    VentanaModal.inicializar();
    
    if (titulo == null) 
    	titulo = "";
    	
    var array = VentanaModal.getAnchoAlto();
    ancho = parseInt(array[2]) - 50;
    alto = parseInt(array[3]) - 50;
    
    var izquierda = 'class="ventana-modal-izquierda" background="img/ventana-modal/izquierda.png"';
	var derecha = 'class="ventana-modal-derecha" background="img/ventana-modal/derecha.png"';
    var superior = 'class="ventana-modal-superior" background="img/ventana-modal/superior.png"';
    var inferior = 'class="ventana-modal-inferior" background="img/ventana-modal/inferior.png"';
    var superiorIzquierda = 'class="ventana-modal-izquierda-superior" background="img/ventana-modal/izquierda-superior.png"';
    var superiorDerecha = 'class="ventana-modal-derecha-superior" background="img/ventana-modal/derecha-superior.png"';
    var inferiorIzquierda = 'class="ventana-modal-izquierda-inferior" background="img/ventana-modal/izquierda-inferior.png"';
    var inferiorDerecha = 'class="ventana-modal-derecha-inferior" background="img/ventana-modal/derecha-inferior.png"';
	
	if (VentanaModal.MSIE) 
	{
		izquierda = 'class="ventana-modal-izquierda" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'img/ventana-modal/izquierda.png\');"';
		derecha = 'class="ventana-modal-derecha" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'img/ventana-modal/derecha.png\');"';
    	superior = 'class="ventana-modal-superior" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'img/ventana-modal/superior.png\');"';
		inferior = 'class="ventana-modal-inferior" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'img/ventana-modal/inferior.png\');"';
    	superiorIzquierda = 'class="ventana-modal-izquierda-superior" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'img/ventana-modal/izquierda-superior.png\');"';
    	superiorDerecha = 'class="ventana-modal-derecha-superior" onclick="VentanaModal.cerrar()" title="Cerrar ventana" style="cursor: pointer; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'img/ventana-modal/derecha-superior.png\');"';
    	inferiorIzquierda = 'class="ventana-modal-izquierda-inferior" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'img/ventana-modal/izquierda-inferior.png\');"';
    	inferiorDerecha = 'class="ventana-modal-derecha-inferior" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'img/ventana-modal/derecha-inferior.png\');"';
	}
	
    var img = 'src="img/ventana-modal/cerrar.gif" onclick="VentanaModal.cerrar()" style="cursor: pointer;" alt="cerrar" title="Cerrar ventana"';
    var tabla = ' border="0" cellspacing="0" cellpadding="0" align="center"';
    
    var html = ''
    + '<table style="width: ' + ancho + 'px; height: ' + alto + 'px;"' + tabla + '>'
	+ '<tr><td><table width="100%"' + tabla + '><tr>'
	+ '<td ' + superiorIzquierda + '>&nbsp;</td>'
	+ '<td ' + superior + '>' + titulo + '</td>'
	+ '<td ' + superiorDerecha + '><img ' + img + '>'
	+ '</td></tr></table></td>'
	+ '</tr><tr><td>'
	+ '<table style="width: ' + ancho + 'px; height: ' + (alto - 52) + 'px;"' + tabla + '>'
	+ '<tr><td ' + izquierda + '></td><td>'
	+ '<iframe name="' + nombre + '" style="width: ' + (ancho - 4) + 'px; height: ' + (alto - 52) + 'px; background-color: #FFFFFF;" src="' + pagina + '" frameborder="0">'
	+ '</iframe></td><td ' + derecha + '></td></tr></table></td></tr><tr><td>'
	+ '<table width="100%"' + tabla + '><tr>'
	+ '<td ' + inferiorIzquierda + '>&nbsp;</td><td ' + inferior + '>&nbsp;</td>'
	+ '<td ' + inferiorDerecha + '>&nbsp;</td></tr></table></td></tr></table>';
    
    VentanaModal.setSize(ancho, alto);
    VentanaModal.setClaseVentana("");
    VentanaModal.setContenido(html);
    VentanaModal.mostrar();
}