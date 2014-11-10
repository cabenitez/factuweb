document.onkeydown = onTecla2;

// FUNCION PARA CERRAR LA VENTANA MODAL CON LA TECLA ESC //
function onTecla2(e){
	var num = e?e.keyCode:event.keyCode;
	if ( num==27 ){ // ESC
		VentanaModal.cerrar();
	}
	if ( num==120 ){ // F9
		imprimir(); 		// llama a la funcion para imprmir un informe
	}

}

//  CONSTRUCTOR DE LA VENTANA MODAL  //
function abrirVentanaFija(pagina, ancho, alto, nombre, titulo) {
    VentanaModal.inicializar();
    VentanaModal.setSize(ancho, alto);
    VentanaModal.setClaseVentana("");
	VentanaModal.setIdVentana("ventana-modal-ventana");
	
	var src = 'class_modal/img/ventana/';
	var iframe = '<iframe src="' + pagina + '" name="' + nombre + '" style="width: ' + (ancho - 22) + 'px; height: ' + (alto - 75) + 'px;"  frameborder="0"></iframe>';
	var over = 'onMouseOver="this.src=\'' + src + 'cerrarover.gif\'"';
	var out = 'onMouseOut="this.src=\'' + src + 'cerrar.gif\'"';
	var onClick = 'onclick="VentanaModal.cerrar()"';
	var atributos = 'alt="Cerrar" title="Cerrar ventana" style="cursor: pointer;"';
	var cerrar = '<img src="' + src + 'cerrar.gif" ' + atributos + ' ' + onClick + ' ' + over + ' ' + out + ' />';
	var tabla = ' border="0" cellspacing="0" cellpadding="0"';
	var texto = 'font-family: Arial, Verdana, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #ffffff;';
	
	var superiorIzquierda = 'style="width: 15px; height: 35px; cursor: default; background-image: url(' + src + 'superior-izquierda.png);"';
	var superior = 'id="draggable" style="width: ' + (ancho - 51) + 'px; height: 35px; cursor: default; background-image: url(' + src + 'superior.png); ' + texto + '"';
	var celdaImagen = 'style="width: 15px; height: 35px; background-image: url(' + src + 'superior.png); ' + texto + '"';
	var superiorDerecha = 'style="width: 20px; height: 35px; cursor: default; background-image: url(' + src + 'superior-derecha.png);"';
	var izquierda = 'style="width: 7px; height: ' + (alto - 75) + 'px; cursor: default; background-image: url(' + src + 'izquierda.png);"';
	var centro = 'style="width: ' + (ancho - 22) + 'px; height: ' + (alto - 75) + 'px; background-color: #ffffff;"';
	var derecha = 'style="width: 15px; height: ' + (alto - 75) + 'px; cursor: default; background-image: url(' + src + 'derecha.png);"';
	var inferiorIzquierda = 'style="width: 15px; height: 40px; cursor: default; background-image: url(' + src + 'inferior-izquierda.png);"';
	var inferior = 'style="width: ' + (ancho - 36) + 'px; height: 40px; cursor: default; background-image: url(' + src + 'inferior.png);"';
	var inferiorDerecha = 'style="width: 20px; height: 40px; cursor: default; background-image: url(' + src + 'inferior-derecha.png);"';
	
	if (VentanaModal.MSIE) {
		superiorIzquierda = 'style="width: 15px; height: 35px; cursor: default; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'' + src + 'superior-izquierda.png\');"'
		superiorDerecha = 'style="width: 20px; height: 35px; cursor: default; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'' + src + 'superior-derecha.png\');"';
		derecha = 'style="width: 15px; height: ' + (alto - 75) + 'px; cursor: default; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'' + src + 'derecha.png\');"';
		inferiorIzquierda = 'style="width: 15px; height: 40px; cursor: default; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'' + src + 'inferior-izquierda.png\');"';
		inferior = 'style="width: ' + (ancho - 36) + 'px; height: 40px; cursor: default; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'' + src + 'inferior.png\');"';
		inferiorDerecha = 'style="width: 20px; height: 40px; cursor: default; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src=\'' + src + 'inferior-derecha.png\');"';
	}
	var html = ''
	+ '<table' + tabla + '>'
	+ '<tr><td><table' + tabla + '>'
	+ '<tr><td ' + superiorIzquierda + '>&nbsp;</td>'
	+ '<td ' + superior + '>' + titulo + '</td>'
	+ '<td ' + celdaImagen + '>' + cerrar + '</td>'
	+ '<td ' + superiorDerecha + '>&nbsp;</td>'
	+ '</tr></table></td></tr><tr><td>'
	+ '<table ' + tabla + '>'
	+ '<tr><td ' + izquierda + '>&nbsp;</td>'
	+ '<td ' + centro + '>' + iframe + '</td>'
	+ '<td ' + derecha + '>&nbsp;</td>'
	+ '</tr></table></td></tr><tr><td>'
	+ '<table ' + tabla + '>'
	+ '<tr><td ' + inferiorIzquierda +'>&nbsp;</td>'
	+ '<td ' + inferior + '>&nbsp;</td>'
	+ '<td ' + inferiorDerecha + '>&nbsp;</td>'
	+ '</tr></table></td></tr></table>';
	
    VentanaModal.setContenido(html);
    VentanaModal.mostrar();
}