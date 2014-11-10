/*
 * Static Class VentanaModal
 * 
 * Creado por Victor Manuel Merino Martinez
 * Version: 1.1.1
 *
 *
 * Metodos "publicos":
 *		- getInstancia()
 *		- setSize(Number: ancho, Number: alto)
 *		- setClaseVentana(String: nombreClase)
 *		- setSombra(Boolean: sombra)
 *		- setSombraSize(Number: sombraSize)
 *		- setClaseSombra(String: nombreClase)
 *		- setIdVentana(String: idVentana)
 *		- setClaseFondo(String: nombreClase)
 *		- setContenido(String: contenidoHtml)
 *		- mostrar()
 *		- cerrar()
 *
 * Metodos "privados":
 *		- inicializar()
 *		- redimensionar()
 *		- crear()
 *
 * Metodos de utilidades:
 *		- medio()
 *      - getAnchoAlto()
 *
 *
 *
 */

var VentanaModal = {
	
	inicializado	: false,
	creado			: false,
	ancho			: 0,
	alto			: 0,
	sombra			: false,
	csombra			: null,
	tsombra			: 0,
	claseSombra		: "",
	ventana			: null,
	idVentana		: "",
	claseVentana	: "",
	MSIE			: false,
	fondo			: null,
	iframe			: null, 
	claseFondo		: "",
	
	getInstancia: function() {
		this.inicializar();
		this.crear();
		return this;
	},
	
	setSize: function(ancho, alto) {
		this.alto = parseInt(alto);
		this.ancho = parseInt(ancho);
		this.ventana.style.width = this.ancho + "px";
		this.ventana.style.height = this.alto + "px";
		this.csombra.style.width = this.ancho + "px";
		this.csombra.style.height = this.alto + "px";
		this.redimensionar();
		
	},
	
	setClaseVentana: function(nombreClaseVentana) {
		this.claseVentana = nombreClaseVentana;
		this.ventana.className = this.claseVentana;
	},
	
	setSombra: function(sombra) {
		if (sombra == true) {
			this.sombra = true;
			this.csombra.style.display = "inline";
		}
		else {
			this.sombra = false;
			this.csombra.style.display = "none";
		}
	},
	
	setSombraSize: function(tsombra) {
		this.tsombra = tsombra;
		this.redimensionar();
	},
	
	setClaseSombra: function(claseSombra) {
		this.claseSombra = claseSombra;
		this.csombra.className = this.claseSombra;
	},
	
	setIdVentana: function(id) {
		this.idVentana = id;
		this.ventana.id = this.idVentana;
	},
	
	setClaseFondo: function(claseFondo) {
		this.claseFondo = claseFondo;
		this.fondo.className = this.claseFondo;
		if (this.MSIE)
			this.iframe.className = this.claseFondo;
	},
	
	setContenido: function(html) {
		this.ventana.innerHTML = html;
	},
	
	mostrar: function() {
		this.fondo.style.display = "inline";
		this.ventana.style.display = "inline";
		if (this.sombra)
			this.csombra.style.display = "inline";
	},

	cerrar: function() {
		this.ventana.style.display = "none";
		this.csombra.style.display = "none";
		this.fondo.style.display = "none";
	},
	
	medio: function(v1, v2) {
		if (isNaN(v1) && v1.indexOf("px") != -1)
			v1 = v1.replace("px", "");
		if (isNaN(v2) && v2.indexOf("px") != -1)
			v2 = v2.replace("px", "");
		var aux = parseInt(v1) / 2;
		aux = aux - (parseInt(v2) / 2);
		return parseInt(aux) * (+1);
	},
	
	inicializar: function() {
		if (this.inicializado) 
			return;
		window.onresize = function() {
			VentanaModal.redimensionar();
		};
		
		this.ancho = 300;
		this.alto = 200;
		this.sombra = true;
		this.tsombra = 5;
		this.claseSombra = "ventana-modal-sombra";
		this.claseFondo = "ventana-modal-fondo";
		this.claseVentana = "ventana-modal-ventana";
		
		if (navigator.userAgent.indexOf('MSIE') >= 0) 
			this.MSIE = true;
			
		this.inicializado = true;
		this.crear();
	},
	
	redimensionar: function() {
		var top = 0;
		var left = 0;
		var alto = 0;
		var ancho = 0;
		var array = this.getAnchoAlto();
		var anchoVentana = array[0];
		var anchoDocumento = array[2];
		var altoVentana = array[1];
		var altoDocumento = array[3];
		
		if (this.MSIE) ancho = anchoVentana + "px";
		else ancho = "100%";
		
		alto = altoVentana + "px";

		if (this.MSIE) {
			this.fondo.style.width = ancho;
			this.fondo.style.height = alto;
			this.iframe.style.width = ancho;
			this.iframe.style.height = alto;
		}
		else {
			this.fondo.style.width = ancho;
			this.fondo.style.height = alto;
		}
		if (this.MSIE) {
			top = this.medio(altoDocumento, this.alto);
			left = this.medio(anchoVentana, this.ancho);
		}
		else {
			top = this.medio(altoDocumento, this.alto);
			left = this.medio(anchoVentana, this.ancho);
		}
		
		// TOP define a que altura se muestra la ventana, la siguiente linea es por defecto, donde toma la mitad de la ventana para mostrar
		//top = top + this.getScrollAlto();
		
		top = 30;
		
		this.ventana.style.top = top + "px";
		this.ventana.style.left = left + "px";
		this.csombra.style.top = (parseInt(top) + this.tsombra) + "px";
		this.csombra.style.left = (parseInt(left) + this.tsombra) + "px";
	},
	
	crear: function() {
		if (this.creado) 
			return;
		this.fondo = document.createElement("DIV");
		this.fondo.style.position = "absolute";
		this.fondo.style.left = "0px";
		this.fondo.style.top = "0px";
		this.fondo.style.display = "none";
		this.fondo.className = this.claseFondo;
		this.fondo.style.zIndex = 90000;
		this.fondo.style.textAlign = "center";
		document.body.appendChild(this.fondo);
		
		if (this.MSIE) {
			this.iframe = document.createElement("IFRAME");
			this.fondo.appendChild(this.iframe);
			this.iframe.src = "about:blank";
			this.iframe.frameBorder = "0";
			this.iframe.className = this.claseFondo;
		}
		
		this.ventana = document.createElement("DIV");
		document.body.appendChild(this.ventana);
		this.ventana.style.display = "none";
		this.ventana.style.position = "absolute";
		this.ventana.style.zIndex = 100000;
		this.ventana.style.width = this.ancho + "px";
		this.ventana.style.height = this.alto + "px";
		this.ventana.className = this.claseVentana;
		
		this.csombra = document.createElement("DIV");
		document.body.appendChild(this.csombra);
		this.csombra.style.display = "none";
		this.csombra.style.position = "absolute";
		this.csombra.style.zIndex = 95000;
		this.csombra.style.width = this.ancho + "px";
		this.csombra.style.height = this.alto + "px";
		this.csombra.className = this.claseSombra;
		
		this.creado = true;
		this.redimensionar();
	}, 
	
	getScrollAlto: function() {
		var scrollAlto;

		if (self.pageYOffset) {
			scrollAlto = self.pageYOffset;
		} else if (document.documentElement && document.documentElement.scrollTop) {
			scrollAlto = document.documentElement.scrollTop;
		} else if (document.body) {
			scrollAlto = document.body.scrollTop;
		}
	
		return scrollAlto;
	}, 
	
	getAnchoAlto: function() {
		var xScroll, yScroll;
		
		if (window.innerHeight && window.scrollMaxY) {	
			xScroll = document.body.scrollWidth;
			yScroll = window.innerHeight + window.scrollMaxY;
		} else if (document.body.scrollHeight > document.body.offsetHeight){
			xScroll = document.body.scrollWidth;
			yScroll = document.body.scrollHeight;
		} else {
			xScroll = document.body.offsetWidth;
			yScroll = document.body.offsetHeight;
		}
		
		var ventanaAncho, ventanaAlto;
		if (self.innerHeight) {
			ventanaAncho = self.innerWidth;
			ventanaAlto = self.innerHeight;
		} else if (document.documentElement && document.documentElement.clientHeight) {
			ventanaAncho = document.documentElement.clientWidth;
			ventanaAlto = document.documentElement.clientHeight;
		} else if (document.body) {
			ventanaAncho = document.body.clientWidth;
			ventanaAlto = document.body.clientHeight;
		}	
		
		if(yScroll < ventanaAlto){
			paginaAlto = ventanaAlto;
		} else { 
			paginaAlto = yScroll;
		}
	
		if(xScroll < ventanaAncho){	
			paginaAncho = ventanaAncho;
		} else {
			paginaAncho = xScroll;
		}
	
	
		arrayAnchoAltoPagina = new Array(paginaAncho, paginaAlto, ventanaAncho, ventanaAlto);
		return arrayAnchoAltoPagina;
	}
};