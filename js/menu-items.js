$(document).ready(function() {



	// get permisos from SESSION for set menu access.
	$.get("get_menu.php",function(data) {

		//console.log(data);
		

		var menuModel = new DHTMLSuite.menuModel();
		DHTMLSuite.commonObj.setCssCacheStatus(false);


		menuModel.addSeparator();
		menuModel.addItem(2,'Archivos','','',false);
		menuModel.setSubMenuWidth(2,'160'); //auto
/*
		menuModel.addItem(21,'Zonas Geogr&aacute;ficas','','',2,'','');
		menuModel.setSubMenuWidth(21,'auto');

				menuModel.addItem(211,'Paises','','',21,'','');		
					menuModel.setSubMenuWidth(211,'auto');
					menuModel.addItem(2111,'Alta de Paises','','',211,'','crearTab("Alta de Paises","alta_pais.php")');		
					menuModel.addItem(2112,'Buscar...','','',211,'','crearTab("Buscar Paises","buscar_pais.php")');
					*/
		$.each(data, function(index, item) { 
			console.log(item);
			var link = item.link != 'false' ? 'crearTab("'+item.titulo+'","'+item.link+'")' : '';
			menuModel.addItem(item.id, item.titulo, '', '', item.pid, '', link);		
			//menuModel.setSubMenuWidth(item.id, item.width); //auto
		});
			
	/*	
		if (data.hasOwnProperty("2")) {
			console.log('SI');  
		}

		this.a = 'hola';
		


	*/

/*
		var menuModel = new DHTMLSuite.menuModel();
		DHTMLSuite.commonObj.setCssCacheStatus(false);


		//menuModel.addItem(1,'Inicio','','',false,'','crearTab("A dynamic tab","externalfile.html")');
		menuModel.addSeparator();

		menuModel.addItem(2,'Archivos','','',false);
		menuModel.setSubMenuWidth(2,'160'); //auto

			menuModel.addItem(21,'Zonas Geogr&aacute;ficas','','',2,'','');
			menuModel.setSubMenuWidth(21,'auto');
				menuModel.addItem(211,'Paises','','',21,'','');		
					menuModel.setSubMenuWidth(211,'auto');
					menuModel.addItem(2111,'Alta de Paises','','',211,'','crearTab("Alta de Paises","alta_pais.php")');		
					menuModel.addItem(2112,'Buscar...','','',211,'','crearTab("Buscar Paises","buscar_pais.php")');
				
				menuModel.addItem(212,'Provincias','','',21,'','');		
					menuModel.setSubMenuWidth(212,'auto');
					menuModel.addItem(2121,'Alta de Provincias','','',212,'','crearTab("Alta de Provincias","alta_provincia.php")');		
					menuModel.addItem(2122,'Buscar...','','',212,'','crearTab("Buscar Provincias","buscar_provincia.php")');
				
				menuModel.addItem(213,'Localidades','','',21,'','');		
					menuModel.setSubMenuWidth(213,'auto');
					menuModel.addItem(2131,'Alta de Localidades','','',213,'','crearTab("Alta de Localidades","alta_localidad.php")');		
					menuModel.addItem(2132,'Buscar...','','',213,'','crearTab("Buscar Localidades","buscar_localidad.php")');

				menuModel.addItem(214,'Zonas','','',21,'','');		
					menuModel.setSubMenuWidth(214,'auto');
					menuModel.addItem(2141,'Alta de Zonas','','',214,'','crearTab("Alta de Zonas","alta_zona.php")');		
					menuModel.addItem(2142,'Buscar...','','',214,'','crearTab("Buscar Zonas","buscar_zona.php")');
			
			menuModel.addItem(22,'Alícuotas','','',2,'','');
			menuModel.setSubMenuWidth(22,'auto');
				menuModel.addItem(221,'IVA','','',22,'','');		
					menuModel.setSubMenuWidth(221,'auto');
					menuModel.addItem(2211,'Alta de IVA','','',221,'','crearTab("Alta de IVA","alta_iva.php")');		
					menuModel.addItem(2212,'Buscar...','','',221,'','crearTab("Buscar IVA","buscar_iva.php")');
				
				menuModel.addItem(222,'Impuestos internos','','',22,'','');		
					menuModel.setSubMenuWidth(222,'auto');
					menuModel.addItem(2221,'Alta de Impuestos internos','','',222,'','crearTab("Alta de Imp. internos","alta_imp_int.php")');		
					menuModel.addItem(2222,'Buscar...','','',222,'','crearTab("Buscar Imp. internos","buscar_imp_int.php")');
				
				menuModel.addItem(223,'Percepción de IVA','','',22,'','');		
					menuModel.setSubMenuWidth(223,'auto');
					menuModel.addItem(2231,'Alta de Percepción de IVA','','',223,'','crearTab("Alta de Perc. de IVA","alta_perc_iva.php")');		
					menuModel.addItem(2232,'Buscar...','','',223,'','crearTab("Buscar Perc. de IVA","buscar_perc_iva.php")');

				menuModel.addItem(224,'Ingresos brutos','','',22,'','');		
					menuModel.setSubMenuWidth(224,'auto');
					menuModel.addItem(2241,'Alta de Ingresos brutos','','',224,'','crearTab("Alta de Ing. brutos","alta_ing_bruto.php")');		
					menuModel.addItem(2242,'Buscar...','','',224,'','crearTab("Buscar Ing. brutos","buscar_ing_bruto.php")');

			menuModel.addItem(23,'Comprobantes','','',2,'','');
			menuModel.setSubMenuWidth(23,'auto');
					menuModel.addItem(231,'Alta de Comprobantes','','',23,'','crearTab("Alta de Comprobantes","alta_tipo_talonario.php")');		
					menuModel.addItem(232,'Buscar...','','',23,'','crearTab("Buscar Comprobantes","buscar_tipo_talonario.php")');
				
			menuModel.addItem(24,'Condición de IVA','','',2,'','');
			menuModel.setSubMenuWidth(24,'auto');
					menuModel.addItem(241,'Alta de Condición de IVA','','',24,'','crearTab("Alta de Cond. de IVA","alta_condicion_iva.php")');		
					menuModel.addItem(242,'Buscar...','','',24,'','crearTab("Buscar Cond. de IVA","buscar_cond_iva.php")');
			
			menuModel.addItem(25,'Talonarios','','',2,'','');
			menuModel.setSubMenuWidth(25,'auto');
					menuModel.addItem(251,'Alta de Talonarios','','',25,'','crearTab("Alta de Talonarios","alta_talonario.php")');		
					menuModel.addItem(252,'Buscar...','','',25,'','crearTab("Buscar Talonario","buscar_talonario.php")');	
			
			menuModel.addItem(26,'Vehículos','','',2,'','');
			menuModel.setSubMenuWidth(26,'auto');
					menuModel.addItem(261,'Alta de Vehículos','','',26,'','crearTab("Alta de Vehículos","alta_talonario.php")');		
					menuModel.addItem(262,'Buscar...','','',26,'','crearTab("Buscar Vehículo","buscar_talonario.php")');	
			
			menuModel.addItem(27,'Repartidores','','',2,'','');
			menuModel.setSubMenuWidth(27,'auto');
					menuModel.addItem(271,'Alta de Repartidores','','',27,'','crearTab("Alta de Repartidores","alta_talonario.php")');		
					menuModel.addItem(272,'Buscar...','','',27,'','crearTab("Buscar Repartidor","buscar_talonario.php")');	
			
			menuModel.addItem(28,'Vendedores','','',2,'','');
			menuModel.setSubMenuWidth(28,'auto');
					menuModel.addItem(281,'Alta de Vendedores','','',28,'','crearTab("Alta de Vendedores","alta_talonario.php")');		
					menuModel.addItem(282,'Buscar...','','',28,'','crearTab("Buscar Vendedor","buscar_talonario.php")');	
			
			menuModel.addItem(29,'Categorías','','',2,'','');
			menuModel.setSubMenuWidth(29,'auto');
					menuModel.addItem(291,'Alta de Categorías','','',29,'','crearTab("Alta de Categorías","alta_talonario.php")');		
					menuModel.addItem(292,'Buscar...','','',29,'','crearTab("Buscar Categoría","buscar_talonario.php")');	
			
			menuModel.addItem(210,'Formas de Pago','','',2,'','');
			menuModel.setSubMenuWidth(210,'auto');
					menuModel.addItem(2101,'Alta de Formas de Pago','','',210,'','crearTab("Alta de Formas de Pago","alta_talonario.php")');		
					menuModel.addItem(2102,'Buscar...','','',210,'','crearTab("Buscar Forma de Pago","buscar_talonario.php")');	
			
			menuModel.addItem(0211,'Clientes','','',2,'','');
			menuModel.setSubMenuWidth(0211,'auto');
					menuModel.addItem(02111,'Alta de Clientes','','',0211,'','crearTab("Alta de Clientes","alta_cliente.php")');		
					menuModel.addItem(02112,'Buscar...','','',0211,'','crearTab("Buscar Cliente","buscar_cliente.php")');
					menuModel.addItem(02113,'Hoja de Ruta','','',0211,'','crearTab("Hoja de Ruta","alta_hoja_ruta.php")');
					menuModel.addItem(02114,'Constancia de Inscripción','','',0211,'','crearTab("Constancia de Inscripción","buscar_talonario.php")');

			menuModel.addItem(32,'Artículos','','',2,'','');
			menuModel.setSubMenuWidth(32,'auto');
				menuModel.addItem(321,'Grupos','','',32,'','');		
					menuModel.setSubMenuWidth(321,'auto');
					menuModel.addItem(3211,'Alta de Grupos','','',321,'','crearTab("Alta de Grupos","alta_pais.php")');		
					menuModel.addItem(3212,'Buscar...','','',321,'','crearTab("Buscar Grupos","buscar_pais.php")');
				
				menuModel.addItem(322,'Marcas','','',32,'','');		
					menuModel.setSubMenuWidth(322,'auto');
					menuModel.addItem(3221,'Alta de Marcas','','',322,'','crearTab("Alta de Marcas","alta_provincia.php")');		
					menuModel.addItem(3222,'Buscar...','','',322,'','crearTab("Buscar Marcas","buscar_provincia.php")');
				
				menuModel.addItem(323,'Variedad','','',32,'','');		
					menuModel.setSubMenuWidth(323,'auto');
					menuModel.addItem(3231,'Alta de Variedad','','',323,'','crearTab("Alta de Variedad","alta_localidad.php")');		
					menuModel.addItem(3232,'Buscar...','','',323,'','crearTab("Buscar Variedad","buscar_localidad.php")');

				menuModel.addItem(324,'Medidas','','',32,'','');		
					menuModel.setSubMenuWidth(324,'auto');
					menuModel.addItem(3241,'Alta de Medidas','','',324,'','crearTab("Alta de Medidas","alta_zona.php")');		
					menuModel.addItem(3242,'Buscar...','','',324,'','crearTab("Buscar Medidas","buscar_zona.php")');

				menuModel.addItem(325,'Ajuste de Precios','','',32,'','crearTab("Alta de Medidas","alta_zona.php")');		
				menuModel.setSubMenuWidth(25,'auto');


		menuModel.addItem(3,'Configuraciones','','',false);
		menuModel.setSubMenuWidth(3,'auto');
			menuModel.addItem(31,'Datos de la Empresa','','',3,'','crearTab("Datos de la Empresa","alta_datos_empresa.php")');		
			menuModel.addItem(32,'Alta de Paises','','',3,'','crearTab("Alta de Paises","alta_pais.php")');		
			menuModel.addItem(33,'Alta de Paises','','',3,'','crearTab("Alta de Paises","alta_pais.php")');		

		menuModel.addItem(4,'Movimientos','','',false);
		menuModel.addItem(5,'Informes','','',false);
		*/
		
		menuModel.init();

		var menuBar = new DHTMLSuite.menuBar();
		menuBar.addMenuItems(menuModel);
		menuBar.setTarget('top-menu');
		menuBar.init();

	});




});

function crearTab(titulo, file) {
	createNewTab('tabs',titulo,'',file,true);
	return false;
}