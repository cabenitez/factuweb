///////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------FACTURA VENTA----------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function pasar_foco_fac_vta_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txt_iva = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].id;
	var cond_iva = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].value;
	buscar_num_fac_vta(cond_iva); // obtiene el tipo de factura y el numero (VER SI DEJAR ACA O DENTRO DE LACONDICION DE TECLA == 13)

	if ( tecla==13 ){
		document.getElementById("cuit1").value="";
		document.getElementById("cuit2").value="";
		document.getElementById("cuit3").value="";
		if(txt_iva == "S"){
				document.getElementById("cuit1").disabled=false;
				document.getElementById("cuit2").disabled=false;
				document.getElementById("cuit3").disabled=false;
				document.frm.cuit1.focus();
		}else{
				document.getElementById("cuit1").disabled=true;
				document.getElementById("cuit2").disabled=true;
				document.getElementById("cuit3").disabled=true;
				
				document.frm.vendedor.focus();
				return 0;
		}
	}
}

function pasar_foco_fac_vta_11(e){ //caja lugar
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.hora.focus()
			return 0;
	}
}
function pasar_foco_fac_vta_12(e){ //caja hora
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.obs.focus()
			return 0;
	}
}
function pasar_foco_fac_vta_14(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if(document.frm.bonif.value != ""){
				if(document.frm.bonif.value <= 100){
						document.frm_art.bonif_art.disabled=true; 
						document.frm.lista_forma_pago.focus()
						return 0;
				}
		}else{
				document.frm_art.bonif_art.disabled=false; 
				document.frm.lista_forma_pago.focus()
				return 0;
		}
	}
}

function pasar_foco_fac_vta_15(e){ //caja hora
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm_art.codigo_art.focus()
			return 0;
	}
}
//-------------------------------------------------------------------------------------------------//
function buscar_num_fac_vta(cond_iva){ 					// busca el numero de factura de acuerdo a la cond de iva
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var div_numero_tal = document.getElementById("numero_tal");
	var txt_numero_tal = document.getElementById("oculto_numero_tal");
	var txt_codigo_tal = document.getElementById("oculto_codigo_tal");
	var divnumero_fac = document.getElementById("numero_fac");
	var txt_numero_fac = document.getElementById("oculto_numero_fac");

	var ajax3=nuevoAjax();										  // creo una instancia de ajax
			metodo="GET";												  // asigno las variables de proceso
			url="buscar_num_fact_vta.php?";
			variables="cond_iva="+cond_iva;
			//alert(variables);
			ajax3.open(metodo, url + variables, true); // envia los datos a la pagina php y esta la procesa
			ajax3.onreadystatechange=function(){ 
				if (ajax3.readyState==4){
					divMensaje.innerHTML=" ";			
					var aux = ajax3.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
					
					var error = aux.getElementsByTagName('error').item(0).firstChild.data; 
					if(error != 3){
							// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
							var codigo_tal = aux.getElementsByTagName('codigo_tal').item(0).firstChild.data; 
							var numero_tal = aux.getElementsByTagName('numero_tal').item(0).firstChild.data;
							var numero_suc = aux.getElementsByTagName('num_sucursal').item(0).firstChild.data;
							var numero_fac = aux.getElementsByTagName('num_factura').item(0).firstChild.data;
								
							// asignamos el valor de las variables del XML a los objetos
							div_numero_tal.innerHTML = numero_tal;
							txt_numero_tal.value = numero_tal;
							txt_codigo_tal.value = codigo_tal;
							divnumero_fac.innerHTML = numero_suc+'-'+numero_fac+'-'+codigo_tal;
							txt_numero_fac.value = numero_fac;
					}else{
							divMensaje.innerHTML="ERROR: Nº de Comprobante exedido, Debe registrar un nuevo Talonario";
					}
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax3.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}
//---------------------------------------------------------------------------------------------------//
function listar_zona_presu(){
	var contenedor=document.getElementById("zonas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_zona_fac.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//---------------------------------------------------------------------------------------------------//
function listar_cond_iva_presu(){
	var contenedor=document.getElementById("cond_iva"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_cond_iva_fac.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//---------------------------------------------------------------------------------------------------//
function listar_cat_presu(){
	var contenedor=document.getElementById("categorias"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_cat_rem.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_forma_pago(){
	var contenedor=document.getElementById("cond_pago"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_forma_pago_fac_vta.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//

function seleccionar_cliente_fact_vta(){		// abre el pop up para seleccionar en cliente
	var win = window.open("buscar_cliente_alta_remito.php", "win",  "toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=500,top=100,left=200");
}
function buscar_cliente_fact_vta(){			// realiza la busqueda con XML para traer los datos del cliente
			var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
			var txtcodigo = document.getElementById("codigo");
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="GET";												  // asigno las variables de proceso
			url="buscar_cliente_alta_fac_vta.php?";
			variables="codigo="+txtcodigo.value;
			ajax.open(metodo, url + variables, true); // envia los datos a la pagina php y esta la procesa
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					divMensaje.innerHTML=" ";			
					var aux = ajax.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
					
					var error = aux.getElementsByTagName('error').item(0).firstChild.data;
					if (error  == 0){ //si encuentra el cliente buscado
								document.getElementById("mensaje").innerHTML=""; 
								document.getElementById("razon").value=""; // VUELVE A VACIO TODOS LOS CAMPOS DE LA CABEZERA
								document.getElementById("dir").value="";
								document.getElementById("localidad").value="";
								document.getElementById("provincia").value="";
								document.getElementById("cuit1").value="";
								document.getElementById("cuit2").value="";
								document.getElementById("cuit3").value="";
								document.getElementById("vendedor").value="";
								document.getElementById("repartidor").value="";
								document.getElementById("lugar").value="";
								document.getElementById("hora").value="";
								document.getElementById("obs").value="";
								document.getElementById("bonif").value="";
								
								document.getElementById("codigo_art").value="";// VUELVE A VACIO TODOS LOS CAMPOS DEL DETALLE
								document.getElementById("cant_art").value="";
								document.getElementById("bonif_art").value="";
							
								document.getElementById("mensaje_art").innerHTML=""; 
								document.getElementById("listado").innerHTML="";
								document.getElementById("desc_art").innerHTML="";
								document.getElementById("precio_art").innerHTML="0.00";										
								document.getElementById("importe_art").value="0.00";	
								document.getElementById("cant_art").value=""; 
								document.getElementById("oculto_precio_art").value="";
								document.getElementById("oculto_importe_art").value="";
								document.getElementById("listado").innerHTML=""; 
										
								// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
								var codigo_tal = aux.getElementsByTagName('codigo_tal').item(0).firstChild.data; // tipo de comprobante **
								var numero_tal = aux.getElementsByTagName('numero_tal').item(0).firstChild.data; 
								var num_sucursal = aux.getElementsByTagName('num_sucursal').item(0).firstChild.data; 
								var num_factura = aux.getElementsByTagName('num_factura').item(0).firstChild.data; 
								var descripcion_tt = aux.getElementsByTagName('descripcion_tt').item(0).firstChild.data; 
								var razon = aux.getElementsByTagName('razon').item(0).firstChild.data; 
								var dir = aux.getElementsByTagName('dir').item(0).firstChild.data; 
								var localidad = aux.getElementsByTagName('localidad').item(0).firstChild.data;
								var provincia = aux.getElementsByTagName('provincia').item(0).firstChild.data;
								var iva = aux.getElementsByTagName('cond_iva').item(0).firstChild.data; // cond de iva ** 
								if(aux.getElementsByTagName('cuit').item(0).firstChild.data == "con"){
										var cuit1 = aux.getElementsByTagName('cuit1').item(0).firstChild.data;
										var cuit2 = aux.getElementsByTagName('cuit2').item(0).firstChild.data;
										var cuit3 = aux.getElementsByTagName('cuit3').item(0).firstChild.data;
								}else{
										var cuit1 = "";
										var cuit2 = "";
										var cuit3 = "";
								}
								var vendedor = aux.getElementsByTagName('vendedor').item(0).firstChild.data; 
								var repartidor = aux.getElementsByTagName('repartidor').item(0).firstChild.data; 
								var cod_categoria = aux.getElementsByTagName('cod_categoria').item(0).firstChild.data; // cond de iva ** 															

								// referenciamos los objetos del template y lo almacenamos en variables
								div_numero_tal = document.getElementById("numero_tal");
								txt_numero_tal = document.getElementById("oculto_numero_tal");
								txt_codigo_tal = document.getElementById("oculto_codigo_tal");
								div_numero_fac = document.getElementById("numero_fac");
								txt_numero_fac = document.getElementById("oculto_numero_fac");

								txtrazon=document.getElementById("razon");
								txtdir=document.getElementById("dir");												
								txtlocalidad=document.getElementById("localidad");												
								txtprovincia=document.getElementById("provincia");												

								txtcuit1=document.getElementById("cuit1");												
								txtcuit2=document.getElementById("cuit2");												
								txtcuit3=document.getElementById("cuit3");												
								txtvendedor=document.getElementById("vendedor");												
								txtrepartidor=document.getElementById("repartidor");
										
								// asignamos el valor de las variables del XML a los objetos
								div_numero_tal.innerHTML = numero_tal;
								txt_numero_tal.value = numero_tal;
								txt_codigo_tal.value = codigo_tal;
								div_numero_fac.innerHTML = num_sucursal+'-'+num_factura+'-'+codigo_tal; //descripcion_tt;
								txt_numero_fac.value = num_factura;
												
								txtrazon.value = razon;
								txtdir.value = dir;
								txtlocalidad.value = localidad;
								txtprovincia.value = provincia;
								txtcuit1.value = cuit1;
								txtcuit2.value = cuit2;
								txtcuit3.value = cuit3;
								txtvendedor.value = vendedor;
								txtrepartidor.value = repartidor;

								listar_zona_cliente_fac(txtcodigo.value);
								listar_iva_cliente_fac_vta(txtcodigo.value); 	// funcion para crear el select de cond de iva
								listar_cat_cliente_fac(cod_categoria);		// funcion para crear el select de categorias	
								listar_forma_pago_fac(txtcodigo.value);
								
								for (i=8; i < 17; i++){			//deshabilito todos los elementos del formulario de cliente(ENCABEZADO)
									document.frm.elements[i].disabled= true;
								}

						document.getElementById("repartidor").focus();
						//listar_cat_cliente_rem(txtcodigo.value);
					}else{
						borrar_cajas_factura_vta();
						if(error == 3){
								divMensaje.innerHTML="ERROR: Nº de Comprobante exedido, Debe registrar un nuevo Talonario";
						}else{
								divMensaje.innerHTML="ERROR: EL Cliente no existe, F2 para buscar";	
						}
															
					}
					document.getElementById("lugar").value="";
					document.getElementById("hora").value="";
					document.getElementById("obs").value="";
					document.getElementById("bonif").value="";
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}
//--------------------------------------------------------------------------------------------------//
function borrar_cajas_factura_vta(){		
	document.getElementById("mensaje").innerHTML=""; 
	
	document.getElementById("numero_tal").innerHTML="0000"; 
	document.getElementById("oculto_numero_tal").value=""; 
	document.getElementById("oculto_codigo_tal").value=""; 
	
	document.getElementById("numero_fac").innerHTML="0000-00000000-A";
	document.getElementById("oculto_numero_fac").value=""; 
	document.getElementById("oculto_num_pedido").value="";

	document.getElementById("codigo").value=""; // VUELVE A VACIO TODOS LOS CAMPOS DE LA CABEZERA
	document.getElementById("razon").value=""; 
	document.getElementById("dir").value="";
	document.getElementById("localidad").value="";
	document.getElementById("provincia").value="";
	document.getElementById("cuit1").value="";
	document.getElementById("cuit2").value="";
	document.getElementById("cuit3").value="";
	document.getElementById("vendedor").value="";
	document.getElementById("repartidor").value="";
	document.getElementById("lugar").value="";
	document.getElementById("hora").value="";
	document.getElementById("obs").value="";
	document.getElementById("bonif").value="";
	
	document.getElementById("codigo_art").value="";// VUELVE A VACIO TODOS LOS CAMPOS DEL DETALLE
	document.getElementById("cant_art").value="";
	document.getElementById("bonif_art").value="";

	document.getElementById("mensaje_art").innerHTML=""; 
	document.getElementById("listado").innerHTML="";
	document.getElementById("desc_art").innerHTML="";
	document.getElementById("precio_art").innerHTML="0.00";										
	document.getElementById("importe_art").value="0.00";	
	document.getElementById("cant_art").value="";
	document.getElementById("oculto_precio_art").value="";
	document.getElementById("oculto_importe_art").value="";
	document.getElementById("listado").innerHTML=""; 

	var cant_objetos = document.frm.elements.length;
	for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
			document.frm.elements[i].disabled=false;
	}
	
	var cant_objetos = document.frm_art.elements.length;
	for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
			document.frm_art.elements[i].disabled=false;
	}
	listar_zona_fac();
	listar_cond_iva_fac();
	listar_cat_fac();
}
//--------------------------------------------------------------------------------------------------//
function buscar_cliente_alta_fact_vta(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var codigo=document.getElementById("codigo");
	if ( tecla==113 ){ 
		seleccionar_cliente_fact_vta();
	}
	if ( tecla==13 &&  codigo.value.length > 0 && codigo.value != "0" ){
		buscar_cliente_fact_vta();
	}
	if ( tecla==13 &&  codigo.value.length == 0){
		borrar_cajas_factura_vta();
		vaciar_tabla_fac_vta_tmp();
		document.getElementById("razon").focus();
	}
}
function vaciar_tabla_fac_vta_tmp(){
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="vaciar_tabla_fac_vta_tmp.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
}

//---------------------------------------------------------------------------------------------------------------------------------//
function listar_iva_cliente_fac_vta(codigo){					// crea el select con la cond de iva del cliente
	var contenedor=document.getElementById("cond_iva"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_iva_cliente_fac_vta.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.lista_iva.disabled= true;
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
function listar_iva_no_cliente_fac_vta(codigo){
	var contenedor=document.getElementById("cond_iva"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_iva_no_cliente_fac_vta.php?";
	variables = "cod_iva="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.lista_iva.disabled= true;
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//-----------------------------------------------------//
function listar_cat_cliente_fac(codigo){
	var contenedor=document.getElementById("categorias"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_cat_cliente_fac.php";
	variables="codigo="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.lista_cat.disabled= true;

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//------------------------------------------------------//
function listar_forma_pago_fac(codigo){
	var contenedor=document.getElementById("cond_pago"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_forma_pago_fac_vta.php";
	variables="codigo="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.lista_cat.disabled= true;

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//------------------------------------------------------//
function listar_cat_no_cliente_fac(codigo){
	var contenedor=document.getElementById("categorias"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_cat_no_cliente_fac.php";
	variables="codigo="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.lista_cat.disabled= true;

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//-----------------------------------------------------//
function listar_zona_cliente_fac(codigo){
	var contenedor=document.getElementById("zonas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_zona_fac.php";
	variables="codigo="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
function listar_zona_no_cliente_fac_vta(zona){
	var contenedor=document.getElementById("zonas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_zona_fac_no_cliente.php";
	variables="codigo="+zona;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//------------------------------------------------------------------------------//
function listar_art_remito_a_factura_vta(num_remito,codigo_tal,numero_tal){
	var contenedor=document.getElementById("listado"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_art_remito_a_factura_vta.php";
	variables="codigo="+num_remito+"&codigo_tal="+codigo_tal+"&numero_tal="+numero_tal;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					if(ajax.responseText != ""){	
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					}else{
						contenedor.innerHTML="ERROR: LOS ARTICULOS PEDIDOS EN EL REMITO NO EXISTEN"; 		// imprime la salida
					}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function seleccionar_remito_factura_vta(){		// abre el pop up para seleccionar en cliente
	var win = window.open("buscar_remito_alta_factura.php", "win",  "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=550,top=100,left=200");
	
	//abrirVentanaFija('buscar_remito_alta_factura.php', 500, 550, 'win', 'Buscar Remito');
}

function stock_negativo(){
document.getElementById('mensaje').innerHTML="asdasds";
}

function buscar_remito_factura_vta(){			// realiza la busqueda con XML para traer los datos del cliente
			var divListado=document.getElementById("listado");  // asigna los aobjetos a las variables
			var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
			var txtcodigo = document.getElementById("remito");
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="GET";												  // asigno las variables de proceso
			url="buscar_remito_alta_factura.php?";
			variables="codigo="+txtcodigo.value;
			ajax.open(metodo, url + variables, true); // envia los datos a la pagina php y esta la procesa
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							divMensaje.innerHTML=" ";			
							var aux = ajax.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
							
							var error = aux.getElementsByTagName('error').item(0).firstChild.data;
							if (error  == 0){ //si NO hay errores
										divMensaje.innerHTML="";  // asigna los aobjetos a las variables
										document.getElementById("codigo").value="";
										document.getElementById("lugar").value="";// VUELVE A VACIO TODOS LOS CAMPOS
										document.getElementById("hora").value="";
										document.getElementById("obs").value="";
										document.getElementById("bonif").value=""; 
										document.getElementById("razon").value=""; 
										document.getElementById("dir").value="";
										document.getElementById("localidad").value="";
										document.getElementById("provincia").value="";
										document.getElementById("cuit1").value="";
										document.getElementById("cuit2").value="";
										document.getElementById("cuit3").value="";
										document.getElementById("vendedor").value="";
										document.getElementById("repartidor").value="";
										
										document.getElementById("mensaje_art").innerHTML="";
										document.getElementById("codigo_art").value="";
										document.getElementById("cant_art").value="";
										document.getElementById("bonif_art").value="";
										
										var tipo = aux.getElementsByTagName('tipo').item(0).firstChild.data;
										//si el remito es de un CLIENTE.................................................................................										
										if (tipo  == 'cliente'){ 
												// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
												var codigo_tal = aux.getElementsByTagName('codigo_tal').item(0).firstChild.data; // tipo de comprobante **
												var numero_tal = aux.getElementsByTagName('numero_tal').item(0).firstChild.data; 
												var num_sucursal = aux.getElementsByTagName('num_sucursal').item(0).firstChild.data; 
												var num_factura = aux.getElementsByTagName('num_factura').item(0).firstChild.data; 
												var descripcion_tt = aux.getElementsByTagName('descripcion_tt').item(0).firstChild.data; 
												
												var cod_cliente = aux.getElementsByTagName('cod_cliente').item(0).firstChild.data; 
												if(aux.getElementsByTagName('lugar').item(0).firstChild.data == "no"){
													var lugar = "";
												}else{
													var lugar = aux.getElementsByTagName('lugar').item(0).firstChild.data; 
												}

												if(aux.getElementsByTagName('hora').item(0).firstChild.data == "no"){
													var hora = "";
												}else{
													var hora = aux.getElementsByTagName('hora').item(0).firstChild.data; 
												}
												
												var vendedor = aux.getElementsByTagName('vendedor').item(0).firstChild.data; 
												var repartidor = aux.getElementsByTagName('repartidor').item(0).firstChild.data; 
												if(aux.getElementsByTagName('obs').item(0).firstChild.data == "no"){
													var obs = "";
												}else{
													var obs = aux.getElementsByTagName('obs').item(0).firstChild.data;
												}
												var razon = aux.getElementsByTagName('razon').item(0).firstChild.data; 
												var dir = aux.getElementsByTagName('dir').item(0).firstChild.data; 
												if(aux.getElementsByTagName('cuit1').item(0).firstChild.data == "no"){
													var cuit1 = "";
													var cuit2 = "";
													var cuit3 = "";
												}else{
													var cuit1 = aux.getElementsByTagName('cuit1').item(0).firstChild.data;
													var cuit2 = aux.getElementsByTagName('cuit2').item(0).firstChild.data;
													var cuit3 = aux.getElementsByTagName('cuit3').item(0).firstChild.data;
												}
												var cod_categoria = aux.getElementsByTagName('cod_categoria').item(0).firstChild.data; // cond de iva ** 															
												var iva = aux.getElementsByTagName('iva').item(0).firstChild.data; // cond de iva ** 
												var localidad = aux.getElementsByTagName('localidad').item(0).firstChild.data;
												var provincia = aux.getElementsByTagName('provincia').item(0).firstChild.data;

												// referenciamos los objetos del template y lo almacenamos en variables
												div_numero_tal = document.getElementById("numero_tal");
												txt_numero_tal = document.getElementById("oculto_numero_tal");
												txt_codigo_tal = document.getElementById("oculto_codigo_tal");
												div_numero_fac = document.getElementById("numero_fac");
												txt_numero_fac = document.getElementById("oculto_numero_fac");

												txtcodigo=document.getElementById("codigo"); 
												txtrazon=document.getElementById("razon");
												txtdir=document.getElementById("dir");												
												txtlocalidad=document.getElementById("localidad");												
												txtprovincia=document.getElementById("provincia");												
												txtiva=document.getElementById("iva");												
												txtcuit1=document.getElementById("cuit1");												
												txtcuit2=document.getElementById("cuit2");												
												txtcuit3=document.getElementById("cuit3");												
												txtvendedor=document.getElementById("vendedor");												
												txtrepartidor=document.getElementById("repartidor");
												txtlugar=document.getElementById("lugar");												
												txthora=document.getElementById("hora");												
												txtobs=document.getElementById("obs");												
											
												// asignamos el valor de las variables del XML a los objetos
												div_numero_tal.innerHTML = numero_tal;
												txt_numero_tal.value = numero_tal;
												txt_codigo_tal.value = codigo_tal;
												div_numero_fac.innerHTML = num_sucursal+'-'+num_factura+'-'+codigo_tal; //descripcion_tt;
												txt_numero_fac.value = num_factura;
												
												txtcodigo.value = cod_cliente;
												txtrazon.value = razon;
												txtdir.value = dir;
												txtlocalidad.value = localidad;
												txtprovincia.value = provincia;
												txtcuit1.value = cuit1;
												txtcuit2.value = cuit2;
												txtcuit3.value = cuit3;
												txtvendedor.value = vendedor;
												txtrepartidor.value = repartidor;
												txtlugar.value = lugar;
												txthora.value = hora;
												txtobs.value = obs;

												listar_zona_cliente_fac(cod_cliente);
												listar_iva_cliente_fac_vta(cod_cliente); 	// funcion para crear el select de cond de iva
												listar_cat_cliente_fac(cod_categoria);		// funcion para crear el select de categorias	
												listar_forma_pago_fac(cod_cliente);
												
												var cant_objetos = document.frm.elements.length;
												for (i=7; i < cant_objetos; i++){			//deshabilito todos los elementos del formulario de cliente(ENCABEZADO)
													if(i != 17 && i != 18 && i != 27){
														document.frm.elements[i].disabled= true;
													}
												}
												//-----------------------------------------------//
												var cant_objetos = document.frm_art.elements.length;
												cant_objetos = cant_objetos -1
												for (i=0; i < cant_objetos; i++){			//deshabilito todos los elementos del formulario de articulo(DETALLE)
													document.frm_art.elements[i].disabled= true;
												}
												
												codigo_rem=document.getElementById("remito").value;
												listar_art_remito_a_factura_vta(codigo_rem,codigo_tal,numero_tal); // funcion para agregar los articulos de remito a faactura
												document.frm.lista_forma_pago.focus();
										}
										//si el remito es de un NO CLIENTE....................................................................
										if (tipo  == 'no_cliente'){ 
												// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
												var codigo_tal = aux.getElementsByTagName('codigo_tal').item(0).firstChild.data; // tipo de comprobante **
												var numero_tal = aux.getElementsByTagName('numero_tal').item(0).firstChild.data; 
												var num_sucursal = aux.getElementsByTagName('num_sucursal').item(0).firstChild.data; 
												var num_factura = aux.getElementsByTagName('num_factura').item(0).firstChild.data; 
												var descripcion_tt = aux.getElementsByTagName('descripcion_tt').item(0).firstChild.data; 
												
												//var cod_cliente = aux.getElementsByTagName('cod_cliente').item(0).firstChild.data; 
												var lugar = aux.getElementsByTagName('lugar').item(0).firstChild.data; 
												var hora = aux.getElementsByTagName('hora').item(0).firstChild.data; 
												var vendedor = aux.getElementsByTagName('vendedor').item(0).firstChild.data; 
												var repartidor = aux.getElementsByTagName('repartidor').item(0).firstChild.data; 
												if(aux.getElementsByTagName('obs').item(0).firstChild.data == "no"){
													var obs = "";
												}else{
													var obs = aux.getElementsByTagName('obs').item(0).firstChild.data;
												}
												var razon = aux.getElementsByTagName('razon').item(0).firstChild.data; 
												var dir = aux.getElementsByTagName('dir').item(0).firstChild.data; 
												if(aux.getElementsByTagName('cuit1').item(0).firstChild.data == "no"){
													var cuit1 = "";
													var cuit2 = "";
													var cuit3 = "";
												}else{
													var cuit1 = aux.getElementsByTagName('cuit1').item(0).firstChild.data;
													var cuit2 = aux.getElementsByTagName('cuit2').item(0).firstChild.data;
													var cuit3 = aux.getElementsByTagName('cuit3').item(0).firstChild.data;
												}
												var cod_categoria = aux.getElementsByTagName('cod_categoria').item(0).firstChild.data; // cond de iva ** 															
												var iva = aux.getElementsByTagName('iva').item(0).firstChild.data; // cond de iva ** 
												var localidad = aux.getElementsByTagName('localidad').item(0).firstChild.data;
												var provincia = aux.getElementsByTagName('provincia').item(0).firstChild.data;
												var zona = aux.getElementsByTagName('zona').item(0).firstChild.data;

												// referenciamos los objetos del template y lo almacenamos en variables
												div_numero_tal = document.getElementById("numero_tal");
												txt_numero_tal = document.getElementById("oculto_numero_tal");
												txt_codigo_tal = document.getElementById("oculto_codigo_tal");
												div_numero_fac = document.getElementById("numero_fac");
												txt_numero_fac = document.getElementById("oculto_numero_fac");

												txtcodigo=document.getElementById("codigo"); 
												txtrazon=document.getElementById("razon");
												txtdir=document.getElementById("dir");												
												txtlocalidad=document.getElementById("localidad");												
												txtprovincia=document.getElementById("provincia");												
												txtiva=document.getElementById("iva");												
												txtcuit1=document.getElementById("cuit1");												
												txtcuit2=document.getElementById("cuit2");												
												txtcuit3=document.getElementById("cuit3");												
												txtvendedor=document.getElementById("vendedor");												
												txtrepartidor=document.getElementById("repartidor");
												txtlugar=document.getElementById("lugar");												
												txthora=document.getElementById("hora");												
												txtobs=document.getElementById("obs");												
											
												// asignamos el valor de las variables del XML a los objetos
												div_numero_tal.innerHTML = numero_tal;
												txt_numero_tal.value = numero_tal;
												txt_codigo_tal.value = codigo_tal;
												div_numero_fac.innerHTML = num_sucursal+'-'+num_factura+'-'+codigo_tal; //descripcion_tt;
												txt_numero_fac.value = num_factura;
												
												txtcodigo.value = "";//= cod_cliente;
												txtrazon.value = razon;
												txtdir.value = dir;
												txtlocalidad.value = localidad;
												txtprovincia.value = provincia;
												txtcuit1.value = cuit1;
												txtcuit2.value = cuit2;
												txtcuit3.value = cuit3;
												txtvendedor.value = vendedor;
												txtrepartidor.value = repartidor;
												txtlugar.value = lugar;
												txthora.value = hora;
												txtobs.value = obs;

												listar_zona_no_cliente_fac_vta(zona);
												listar_iva_no_cliente_fac_vta(iva); 	// funcion para crear el select de cond de iva
												listar_cat_no_cliente_fac(cod_categoria);		// funcion para crear el select de categorias	

												var cant_objetos = document.frm.elements.length;
												for (i=7; i < cant_objetos; i++){			//deshabilito todos los elementos del formulario de cliente(ENCABEZADO)
													if(i != 17 && i != 18 && i != 27){
														document.frm.elements[i].disabled= true;
													}
												}
												//-----------------------------------------------//
												var cant_objetos = document.frm_art.elements.length;
												cant_objetos = cant_objetos -1
												for (i=0; i < cant_objetos; i++){			//deshabilito todos los elementos del formulario de articulo(DETALLE)
													document.frm_art.elements[i].disabled= true;
												}
												
												codigo_rem=document.getElementById("remito").value;
												listar_art_remito_a_factura_vta(codigo_rem,codigo_tal,numero_tal); // funcion para agregar los articulos de remito a faactura
												document.frm.lista_forma_pago.focus();
										}
							}else{ // si no oncuentra nungun remito con ese codigo
								borrar_cajas_factura_vta();
								if(error == 3){
										divMensaje.innerHTML="ERROR: Nº de Comprobante exedido, Debe registrar un nuevo Talonario";
								}else{
										divMensaje.innerHTML="ERROR: EL Remito no existe o ya fué facturado, F2 para buscar";						
								}
							}
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}
//--------------------------------------------------------------------------------------------------//
function buscar_remito_alta_factura_vta(e){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var remito=document.getElementById("remito");
	if ( tecla==113 ){ //F2 pop up
		seleccionar_remito_factura_vta();
	}
	if ( tecla==13 &&  remito.value.length > 0 && remito.value != "0" ){
		buscar_remito_factura_vta(); // el boton y la caja de texto llaman al mismo funcion
	}
	if ( tecla==13 &&  remito.value.length == 0){
		vaciar_tabla_fac_vta_tmp();
		borrar_cajas_factura_vta();
		document.frm.codigo.focus();
		
	}
}
//--------------------------------------------------------------------------------------------------//
function listar_loca_buscar_alta_fact(){
	var contenedor=document.getElementById("localidades"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_loca_buscar_alta_fact.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}


//--------------------------------------------------------------------------------------------------//
//--------------------BUSCAR REMITO EN POP UP -----------------------------------------------------//
function pasar_foco_fact_vta_bus_1(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if(document.frm.codigo.value == ""){
					document.frm.razon.focus()
			}else{
					document.frm.enviar.click()				
			}
			return 0;
	}
}
function pasar_foco_fact_vta_bus_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if(document.frm.razon.value == ""){
					document.frm.lista_loca.focus()
			}else{
					document.frm.enviar.click()				
			}
			return 0;
	}
}
function pasar_foco_fact_vta_bus_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txtloca = document.frm.lista_loca.options[document.frm.lista_loca.selectedIndex].text;
	if ( tecla==13){
			if(txtloca == "TODOS"){
				document.frm.dia_desde.focus()
			}else{
				document.frm.enviar.click()
	        	return 0;	
			}
	}
}

function pasar_foco_fact_vta_bus_4(e){ //dia desde
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if( document.frm.dia_desde.value.length == 2  ) {
			document.frm.mes_desde.focus();
	   }
	   if(tecla == 13 && document.frm.dia_desde.value.length == 0 && document.frm.mes_desde.value.length == 0 && document.frm.ano_desde.value.length == 0){		   
			document.frm.dia_hasta.focus();
	   }	
	   return 0;
}
function pasar_foco_fact_vta_bus_5(){   //mes desde
		if( document.frm.mes_desde.value.length == 2  ) {
			document.frm.ano_desde.focus();
			return 0;		 
	   }		
}
function pasar_foco_fact_vta_bus_6(){   // año desde
		if( document.frm.ano_desde.value.length == 4  ) {
			document.frm.dia_hasta.focus();
			return 0;		 
	   }		
}
function pasar_foco_fact_vta_bus_7(e){  // dia hasta
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if( document.frm.dia_hasta.value.length == 2  ) {
			document.frm.mes_hasta.focus();
	   }
	   if(tecla == 13 && document.frm.dia_desde.value.length == 0 && document.frm.mes_desde.value.length == 0 && document.frm.ano_desde.value.length == 0 && document.frm.dia_hasta.value.length == 0 && document.frm.mes_hasta.value.length == 0 && document.frm.ano_hasta.value.length == 0){
				document.frm.enviar.click()
	   }	
	   return 0;
}
function pasar_foco_fact_vta_bus_8(){   //mes hasta
		if( document.frm.mes_hasta.value.length == 2  ) {
			document.frm.ano_hasta.focus();
			return 0;		 
	   }		
}
function pasar_foco_fact_vta_bus_9(e){
	  tecla = (document.all) ? e.keyCode : e.which; // 2
	  if(tecla == 13 && document.frm.dia_desde.value.length == 2 && document.frm.mes_desde.value.length == 2 && document.frm.ano_desde.value.length == 4 && document.frm.dia_hasta.value.length == 2 && document.frm.mes_hasta.value.length == 2 && document.frm.ano_hasta.value.length == 4){
				document.frm.enviar.click()
	   }	
	   return 0;
}
//--------------------------------------------------------------------------------------------//
function listar_loca_buscar_alta_fact2(){
	var divlistado=document.getElementById("listado"); 
	var divMensaje=document.getElementById("mensaje"); 
 	
	var boton=document.getElementById("enviar");
	var txtcodigo = document.getElementById("codigo");
	var txtrazon = document.getElementById("razon");
	var txtloca = document.frm.lista_loca.options[document.frm.lista_loca.selectedIndex].value;
	var txtdia_desde = document.getElementById("dia_desde");
	var txtmes_desde = document.getElementById("mes_desde");
	var txtano_desde = document.getElementById("ano_desde");
	var txtdia_hasta = document.getElementById("dia_hasta");
	var txtmes_hasta = document.getElementById("mes_hasta");
	var txtano_hasta = document.getElementById("ano_hasta");
	

	if(txtdia_desde.value.length > 1 ){
		if(parseInt(txtdia_desde.value) < 0 || parseInt(txtdia_desde.value) > 31){
			divMensaje.innerHTML="Fecha Inválida: dia incorrecto";
			document.frm.dia_desde.focus()
			return 0;
		}
	}
	//-------------------------------//			
	if(txtmes_desde.value.length > 1 ){
		if(parseInt(txtmes_desde.value) < 0 || parseInt(txtmes_desde.value) > 12){
			divMensaje.innerHTML="Fecha Inválida: mes incorrecto";
			document.frm.mes_desde.focus()
			return 0;
		}
	}
	//-------------------------------//
	if(txtano_desde.value.length > 3 ){
		if(parseInt(txtano_desde.value) < 2000 || parseInt(txtano_desde.value) > 3000){
			divMensaje.innerHTML="Fecha Inválida: año incorrecto";
			document.frm.ano_desde.focus()
			return 0;
		}
	}	
	//--------------------------------------------------------------------------------//
	if(txtdia_hasta.value.length > 1 ){
		if(parseInt(txtdia_hasta.value) < 0 || parseInt(txtdia_hasta.value) > 31){
			divMensaje.innerHTML="Fecha Inválida: dia incorrecto";
			document.frm.dia_hasta.focus()
			return 0;
		}
	}
	//-------------------------------//			
	if(txtmes_hasta.value.length > 1 ){
		if(parseInt(txtmes_hasta.value) < 0 || parseInt(txtmes_hasta.value) > 12){
			divMensaje.innerHTML="Fecha Inválida: mes incorrecto";
			document.frm.mes_hasta.focus()
			return 0;
		}
	}
	//-------------------------------//
	if(txtano_hasta.value.length > 3 ){
		if(parseInt(txtano_hasta.value) < 2000 || parseInt(txtano_hasta.value) > 3000){
			divMensaje.innerHTML="Fecha Inválida: año incorrecto";
			document.frm.ano_hasta.focus()
			return 0;
		}
	}	
	
	url="buscar_remito_alta_factura_proceso.php?";
	var cant_objetos = document.frm.elements.length;
	for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
			document.frm.elements[i].disabled=true;
	}

	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	if(txtcodigo.value == "" && txtrazon.value == "" && txtdia_desde.value == "" && txtmes_desde.value == "" && txtano_desde.value == "" && txtdia_hasta.value == "" && txtmes_hasta.value == "" && txtano_hasta.value == "" && txtloca == "TODOS"){
		variables="nombre=TODOS";
	}else{
		variables="codigo="+txtcodigo.value+"&razon="+txtrazon.value+"&localidad="+txtloca+"&dia_desde="+txtdia_desde.value+"&mes_desde="+txtmes_desde.value+"&ano_desde="+txtano_desde.value+"&dia_hasta="+txtdia_hasta.value+"&mes_hasta="+txtmes_hasta.value+"&ano_hasta="+txtano_hasta.value;
	}
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				txtcodigo.value="";								// Borro el contenido del input
				txtrazon.value="";								// Borro el contenido del input
				txtdia_desde.value="";								// Borro el contenido del input
				txtmes_desde.value="";								// Borro el contenido del input
				txtano_desde.value="";								// Borro el contenido del input
				txtdia_hasta.value="";								// Borro el contenido del input
				txtmes_hasta.value="";								// Borro el contenido del input
				txtano_hasta.value="";								// Borro el contenido del input
				for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
						document.frm.elements[i].disabled=false;
				}
				listar_loca_buscar_alta_fact();
				document.frm.codigo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//-------------------------------------------------------------------------------------------------------------//
function listar_loca_buscar_alta_fact2_2(){
	var divlistado=document.getElementById("listado_2"); 
	var divMensaje=document.getElementById("mensaje"); 
 	
	var boton=document.getElementById("enviar");
	var txtcodigo = document.getElementById("codigo");
	var txtrazon = document.getElementById("razon");
	var txtloca = document.frm.lista_loca.options[document.frm.lista_loca.selectedIndex].value;
	var txtdia_desde = document.getElementById("dia_desde");
	var txtmes_desde = document.getElementById("mes_desde");
	var txtano_desde = document.getElementById("ano_desde");
	var txtdia_hasta = document.getElementById("dia_hasta");
	var txtmes_hasta = document.getElementById("mes_hasta");
	var txtano_hasta = document.getElementById("ano_hasta");
	

	if(txtdia_desde.value.length > 1 ){
		if(parseInt(txtdia_desde.value) < 0 || parseInt(txtdia_desde.value) > 31){
			divMensaje.innerHTML="Fecha Inválida: dia incorrecto";
			document.frm.dia_desde.focus()
			return 0;
		}
	}
	//-------------------------------//			
	if(txtmes_desde.value.length > 1 ){
		if(parseInt(txtmes_desde.value) < 0 || parseInt(txtmes_desde.value) > 12){
			divMensaje.innerHTML="Fecha Inválida: mes incorrecto";
			document.frm.mes_desde.focus()
			return 0;
		}
	}
	//-------------------------------//
	if(txtano_desde.value.length > 3 ){
		if(parseInt(txtano_desde.value) < 2000 || parseInt(txtano_desde.value) > 3000){
			divMensaje.innerHTML="Fecha Inválida: año incorrecto";
			document.frm.ano_desde.focus()
			return 0;
		}
	}	
	//--------------------------------------------------------------------------------//
	if(txtdia_hasta.value.length > 1 ){
		if(parseInt(txtdia_hasta.value) < 0 || parseInt(txtdia_hasta.value) > 31){
			divMensaje.innerHTML="Fecha Inválida: dia incorrecto";
			document.frm.dia_hasta.focus()
			return 0;
		}
	}
	//-------------------------------//			
	if(txtmes_hasta.value.length > 1 ){
		if(parseInt(txtmes_hasta.value) < 0 || parseInt(txtmes_hasta.value) > 12){
			divMensaje.innerHTML="Fecha Inválida: mes incorrecto";
			document.frm.mes_hasta.focus()
			return 0;
		}
	}
	//-------------------------------//
	if(txtano_hasta.value.length > 3 ){
		if(parseInt(txtano_hasta.value) < 2000 || parseInt(txtano_hasta.value) > 3000){
			divMensaje.innerHTML="Fecha Inválida: año incorrecto";
			document.frm.ano_hasta.focus()
			return 0;
		}
	}	
	url="buscar_remito_alta_factura_proceso2.php?";
	var cant_objetos = document.frm.elements.length;
	for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
			document.frm.elements[i].disabled=true;
	}

	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	if(txtcodigo.value == "" && txtrazon.value == "" && txtdia_desde.value == "" && txtmes_desde.value == "" && txtano_desde.value == "" && txtdia_hasta.value == "" && txtmes_hasta.value == "" && txtano_hasta.value == "" && txtloca == "TODOS"){
		variables="nombre=TODOS";
	}else{
		variables="codigo="+txtcodigo.value+"&razon="+txtrazon.value+"&localidad="+txtloca+"&dia_desde="+txtdia_desde.value+"&mes_desde="+txtmes_desde.value+"&ano_desde="+txtano_desde.value+"&dia_hasta="+txtdia_hasta.value+"&mes_hasta="+txtmes_hasta.value+"&ano_hasta="+txtano_hasta.value;
	}
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				txtcodigo.value="";								// Borro el contenido del input
				txtrazon.value="";								// Borro el contenido del input
				txtdia_desde.value="";								// Borro el contenido del input
				txtmes_desde.value="";								// Borro el contenido del input
				txtano_desde.value="";								// Borro el contenido del input
				txtdia_hasta.value="";								// Borro el contenido del input
				txtmes_hasta.value="";								// Borro el contenido del input
				txtano_hasta.value="";								// Borro el contenido del input
				for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
						document.frm.elements[i].disabled=false;
				}
				listar_loca_buscar_alta_fact();
				document.frm.codigo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function eliminar_art_fac_vta_tmp(fila){
		var divMensaje=document.getElementById("mensaje"); 

	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="eliminar.php?";
	variables="fila_fac="+fila;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				mostrar_art_fac_vta_tmp()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function mostrar_art_fac_vta_tmp(){
	var divlistado=document.getElementById("listado"); 
	var provincia = document.getElementById("provincia").value;
	var cod_tal = document.getElementById("oculto_codigo_tal").value;
	//var cond_iva = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].text;


	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="mostrar_art_fac_vta_tmp.php?";

	// OBTENGO LA PROVINCIA PARA DETERMINAR LA TASA DE INGRSO BRUTO //
	var variables="provincia="+provincia+"&talonario="+cod_tal; //+"&cond_iva="+cond_iva
	//alert(variables);		

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				//document.getElementById("codigo_art").focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function actualizar_cant_art_fact_vta(e,id_Text){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			//cant_max=document.getElementById(id_Text).name;
			if(document.getElementById(id_Text).value != "0" && document.getElementById(id_Text).value.length > 0){ //&& document.getElementById(id_Text).value <= cant_max
					
					var cant=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_art_fact_vta="+id_Text+"&cantidad="+cant;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_fac_vta_tmp();
											document.frm_art.codigo_art.focus();

								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				mostrar_art_fac_vta_tmp();
			}
	}
}
function actualizar_cant_art_fact_vta_blur(id_Text){
			cant_max=document.getElementById(id_Text).name;
			if(document.getElementById(id_Text).value != "0" && document.getElementById(id_Text).value.length > 0){ //&& document.getElementById(id_Text).value <= cant_max
					var cant=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_art_fact_vta="+id_Text+"&cantidad="+cant;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_fac_vta_tmp();
											document.frm_art.codigo_art.focus();

								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				mostrar_art_fac_vta_tmp();
			}
}
//--------------------------------------------------------------------------------------------------//
function actualizar_bonif_art_fact_vta(e,id_Text){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			//cant_max=document.getElementById(id_Text).name;
			if(document.getElementById(id_Text).value.length > 0 && document.getElementById(id_Text).value <= 100){ //&& document.getElementById(id_Text).value <= cant_max
					
					var bonif=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_bonif_art_fact_vta="+id_Text+"&bonif="+bonif;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_fac_vta_tmp();
											document.frm_art.codigo_art.focus();
				
											
								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				mostrar_art_fac_vta_tmp();
			}
	}
}

function actualizar_bonif_art_fact_vta_blur(id_Text){
			//cant_max=document.getElementById(id_Text).name;
			if(document.getElementById(id_Text).value.length > 0 && document.getElementById(id_Text).value <= 100){ //&& document.getElementById(id_Text).value <= cant_max
					
					var bonif=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_bonif_art_fact_vta="+id_Text+"&bonif="+bonif;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_fac_vta_tmp();
											document.frm_art.codigo_art.focus();

								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				mostrar_art_fac_vta_tmp();
			}

}
//--------------------------------------------------------------------------------------------------//

function agregar_articulo_fac_vta(){
	var divMensaje = document.getElementById("mensaje_art");  // asigna los aobjetos a las variables
	var codigo_art = document.frm_art.codigo_art.value;
	var desc_art = document.frm_art.oculto_desc_art.value
	var cant_art = document.frm_art.cant_art.value;
	var precio_art = document.frm_art.oculto_precio_art.value;
	var importe_art = document.frm_art.oculto_importe_art.value;
	var codigo_tal = document.frm.oculto_codigo_tal.value;	
	var oculto_stock = document.frm_art.oculto_stock.value;	
		
	if(parseInt(oculto_stock) < parseInt(cant_art)){   // verifica que haya existencia disponible
		abrirVentanaFija('mensaje.php?msg=No hay existencia para este artículo, Stock actual: '+oculto_stock, 400, 115, 'ventana', 'Atencion!!');
		
		//alert("No hay existencia para este artículo, Stock actual: "+oculto_stock);	
	}

	if(document.frm_art.bonif_art.disabled == false){			  // pregunta si se definio un % de bonificacion global
		if(document.frm_art.bonif_art.value.length > 0 ){
			var bonif_art = document.frm_art.bonif_art.value;
		}else{
			var bonif_art = 0;
		}
	}else{
		if(document.frm.bonif.value.length > 0 ){
			var bonif_art = document.frm.bonif.value;
		}else{
			var bonif_art = 0;
		}
	}
	
	//divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
	url="alta_fac_vta_tmp.php?";
	variables="codigo_art="+codigo_art+"&desc_art="+desc_art+"&cant_art="+cant_art+"&precio_art="+precio_art+"&bonif_art="+bonif_art+"&importe_art="+importe_art+"&codigo_tal="+codigo_tal;

	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
		if (ajax.readyState==4){
			document.getElementById("codigo_art").value="";				// Borro el contenido del input
			document.getElementById("desc_art").innerHTML="";
			document.getElementById("cant_art").value="";
			document.getElementById("precio_art").innerHTML="0.00";										
			document.getElementById("bonif_art").value="";
			document.getElementById("importe_art").innerHTML="0.00";
			document.getElementById("oculto_importe_art").value="";
			divMensaje.innerHTML = ajax.responseText;
			mostrar_art_fac_vta_tmp();
			document.frm_art.codigo_art.focus();
			
		} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function calcular_importe_fac(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var divMensaje = document.getElementById("mensaje_art");  // asigna los aobjetos a las variables
	var divImporte = document.getElementById("importe_art");
	var cantidad = document.getElementById("cant_art").value;
	var desc = document.frm_art.oculto_desc_art.value;
	var precio = document.frm_art.oculto_precio_art.value;
	var oculto_importe = document.getElementById("oculto_importe_art");
	//alert(tecla);
	if ( tecla==13 ){
		if(parseFloat(document.frm_art.cant_art.value) > 0 ){
				if(document.frm_art.bonif_art.disabled == true){			  // pregunta si se definio un % de bonificacion global
						var bonificacion = document.getElementById("bonif").value;
						var importe = parseFloat (cantidad) * parseFloat (precio);
						var bonif = ((parseFloat (cantidad) * parseFloat (precio))* bonificacion)/100;
						var importe = parseFloat (importe) - parseFloat (bonif);
						oculto_importe.value= decimal_precio(importe);
						divImporte.innerHTML= decimal_precio (importe);
				}else{
					if(document.frm_art.bonif_art.value == ""){
						var importe = parseFloat (cantidad) * parseFloat (precio);
						divImporte.innerHTML= decimal_precio (importe);
						document.frm_art.bonif_art.focus();
							
					}else{
						var bonificacion = document.getElementById("bonif_art").value;
						if(parseFloat (bonificacion) == 100){
							var importe = 0;
						}else{
							var importe = parseFloat (cantidad) * parseFloat (precio);
							var bonif = ((parseFloat (cantidad) * parseFloat (precio))* bonificacion)/100;
							var importe = decimal_precio(parseFloat (importe)) - parseFloat (bonif);
						}
						oculto_importe.value= decimal_precio(importe);
						divImporte.innerHTML= decimal_precio(importe); 

					}
				}
		}
	}
	if ( tecla==107 ){ // teclas: 107= '+'         119= 'F8'
		if(document.frm.oculto_numero_tal.value != "ERROR" && document.frm_art.codigo_art.value > 0 && document.frm_art.oculto_desc_art.value != "" && document.frm_art.cant_art.value > 0 && document.frm_art.oculto_precio_art.value >= 0 && document.frm_art.oculto_importe_art.value >= 0 ){

					////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					//======================================== VALIDA NUEVAMENTE EL ARTICULO =================================================//
					
					var divMensaje=document.getElementById("mensaje_art");  // asigna los aobjetos a las variables
					var txtcodigo = document.getElementById("codigo_art");
					var categoria = document.frm.lista_cat.options[document.frm.lista_cat.selectedIndex].value;
					
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="GET";												  // asigno las variables de proceso
					url="buscar_articulo_alta_remito.php?";
					variables="codigo="+txtcodigo.value+"&categoria="+categoria;
					//alert(variables);
					ajax.open(metodo, url + variables, true); // envia los datos a la pagina php y esta la procesa
					ajax.onreadystatechange=function(){ 
						if (ajax.readyState==4){
							divMensaje.innerHTML=" ";			
							var aux = ajax.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
							
							var error = aux.getElementsByTagName('error').item(0).firstChild.data;
							if (error  == 0){ //si encuentra el cliente buscado
								agregar_articulo_fac_vta();
							}else{
								document.getElementById("codigo_art").value=""; // VUELVE A VACIO TODOS LOS CAMPOS
								document.getElementById("desc_art").innerHTML="";
								document.getElementById("cant_art").value="";
								document.getElementById("precio_art").innerHTML="0.00";
								document.getElementById("bonif_art").value="";
								document.getElementById("importe_art").innerHTML="0.00";
								document.getElementById("oculto_stock").value="";
								divMensaje.innerHTML="ERROR: EL Artículo no existe, F2 para buscar";	
								document.getElementById("codigo_art").focus();
							}
						} // fin de if (ajax.readyState==4)
					} // fin de funcion()
					ajax.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
					return;
					
					//======================================== FIN DE VALIDA NUEVAMENTE EL ARTICULO ==========================================//
					////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		}
	}
}
//------------------------------------REGISTRAR FACTURA VENTA-----------------------------------------//
function registrar_factura_vta(){
	var divMensaje = document.getElementById("mensaje");  				// asigna los aobjetos a las variables
	
	var txtnumero_tal = document.getElementById("oculto_numero_tal");  	// asigna los aobjetos a las variables
	var txtcodigo_tal = document.getElementById("oculto_codigo_tal");  	// asigna los aobjetos a las variables
	var txtnumero_fac = document.getElementById("oculto_numero_fac");  	// asigna los aobjetos a las variables
	var txtfecha = document.getElementById("oculto_fecha");  			// asigna los aobjetos a las variables
	var txthora = document.getElementById("hora_actual").innerHTML;  	// asigna los aobjetos a las variables

	//------------------------impuestos-----------------------//
	var txttasa_iva = document.getElementById("tasa_iva");  			// asigna los aobjetos a las variables
	var txttasa_perc_iva = document.getElementById("tasa_perc_iva");  	// asigna los aobjetos a las variables
	var txttasa_img_bruto = document.getElementById("tasa_img_bruto");  // asigna los aobjetos a las variables
	var txtmonto_imp_int = document.getElementById("monto_imp_int");  	// asigna los aobjetos a las variables
	//------------------------fin de impuestos----------------//

	if(document.frm.remito.value.length > 0 && document.frm.remito.value != "0"){
			var numero_rem = document.frm.remito.value;
	}else{
			var numero_rem = "0";
	}

	if(document.frm.codigo.value.length > 0 && document.frm.razon.disabled == true){
			var cod_cliente = document.frm.codigo.value;
	}else{
			var cod_cliente = "no_cliente";
	}

	var razon = document.frm.razon.value;
	var dir = document.frm.dir.value;
	var localidad = document.frm.localidad.value;
	var provincia = document.frm.provincia.value;
	var zona = document.frm.lista_zona.options[document.frm.lista_zona.selectedIndex].value;	
	var iva = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].value;
	var cuit1 = document.frm.cuit1.value;
	var cuit2 = document.frm.cuit2.value;
	var cuit3 = document.frm.cuit3.value;
	var lugar = document.frm.lugar.value;
	var hora = document.frm.hora.value;
	var vendedor = document.frm.vendedor.value;
	var repartidor = document.frm.repartidor.value;
	var categoria = document.frm.lista_cat.options[document.frm.lista_cat.selectedIndex].value;	
	var forma_pago = document.frm.lista_forma_pago.options[document.frm.lista_forma_pago.selectedIndex].value;	
	var obs = document.frm.obs.value;
	
	var requiere_cuit = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].id;
	//alert(zona);
	error = "";
	if(requiere_cuit == "S"){
		if(cuit1 != "" && cuit2 != "" && cuit3 != ""){
			var cuit=cuit1+cuit2+cuit3;
			validar_cuit(cuit);					// valida el CUIT ingrsado
		}else{
			divMensaje.innerHTML="Debe ingresar el Cuit del Cliente";
			document.frm.cuit1.focus()
			return 0;
		}
	}



	if(txtnumero_tal.value != " " && txtcodigo_tal.value != " " && txtnumero_fac.value != " "){
		if(razon != ""){
			if(dir != ""){
				if(localidad != ""){
					if(zona != ""){
					  if(error == ""){
						if(vendedor != ""){
							if(repartidor != ""){
								if(categoria != ""){
										if(forma_pago != ""){ 												// finaliza la validacion de la cabezera
													var ajax=nuevoAjax();										// creo una instancia de ajax
													metodo="POST";												// asigno las variables de proceso
													url="consultar_art_fac_vta_tmp.php";						// consulto si existen articulos en la tabla temporal
													ajax.open(metodo, url, true);
													ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
													ajax.send(null);
													ajax.onreadystatechange=function(){ 
															if (ajax.readyState==4){
																if(ajax.responseText == 'si'){									// si existen articulos sigo y guardo definitivamente
																			var ajax2=nuevoAjax();										// creo una instancia de ajax
																			metodo="POST";												// asigno las variables de proceso
																			url="alta_factura_vta.php";
																			variables="fecha="+txtfecha.value+"&lugar="+lugar+"&hora="+hora+"&numero_rem="+numero_rem+"&cod_cliente="+cod_cliente+"&categoria="+categoria+"&razon="+razon+"&dir="+dir+"&localidad="+localidad+"&provincia="+provincia+"&cond_iva="+iva+"&cuit="+cuit+"&vendedor="+vendedor+"&repartidor="+repartidor+"&obs="+obs+"&zona="+zona+"&forma_pago="+forma_pago+"&tasa_iva="+txttasa_iva.value+"&tasa_perc_iva="+txttasa_perc_iva.value+"&tasa_img_bruto="+txttasa_img_bruto.value+"&monto_imp_int="+txtmonto_imp_int.value+"&hora_actual="+txthora;
																			//alert(variables);
																			ajax2.open(metodo, url, true);
																			ajax2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
																			ajax2.send(variables);
																			ajax2.onreadystatechange=function(){ 
																					if (ajax2.readyState==4){
																						//alert(ajax2.responseText);
																						if(ajax2.responseText != 'ook'){	
																							marcar_pedido_como_facturado();
																							//divMensaje.innerHTML=ajax2.responseText;
																							mostrar_art_fac_vta_tmp();
																							borrar_cajas_factura_vta();
																							document.frm.remito.value="";
																							document.frm.codigo.focus();
																							//document.getElementById("codigo").focus()
																							
																						}else{
																							 if(document.frm.remito.value.length > 0 && document.frm.remito.value != "0"){
																									divMensaje.innerHTML = "ERROR: la factura no pudo registrarse, verifique el Nº de Remito"; //=  ajax2.responseText;
																							}else{
																								if(ajax2.responseText == 'existe_carga'){	
																									divMensaje.innerHTML  = "ERROR: la factura no pudo registrarse, La carga "+repartidor +" ya ha sido finalizada"; //= ajax2.responseText;
																								}
																							}
																						}
																					} // fin de if (ajax.readyState==4)
																				} // fin de funcion()
																}else{
																	divMensaje.innerHTML="Debe agregar almenos un artículo";
																	document.frm_art.codigo_art.focus()
																}
															} // fin de if (ajax.readyState==4)
														} // fin de funcion()
									}else{
										divMensaje.innerHTML="Debe ingresar la Forma de Pago";
										document.frm.lugar.focus()
									}	 
								}else{
									divMensaje.innerHTML="Debe seleccionar una Categoría";
									document.frm.lista_cat.focus()
								}		 
							}else{
								divMensaje.innerHTML="Debe ingresar el Repartidor";
								document.frm.repartidor.focus()
							}	
						}else{
							divMensaje.innerHTML="Debe ingresar el Vendedor";
							document.frm.vendedor.focus()
						}	
					}else{
						divMensaje.innerHTML=error;
						document.frm.cuit1.focus()
					}
				 }else{
					 divMensaje.innerHTML="Debe ingresar la Zona";
					 document.frm.lista_zona.focus()
				 }
				}else{
					divMensaje.innerHTML="Debe ingresar la Loaclidad";
					document.frm.localidad.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar la Dirección";
				document.frm.dir.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar el Nombre";
			document.frm.razon.focus()
		}
	 }else{
		divMensaje.innerHTML="ERROR: Verifique de que exista un Talonario de Factura";
	 }
}

function marcar_pedido_como_facturado(){
	//Verifico si se esta facturando un pedido a travez del sistema de telefonos
	if (document.getElementById("oculto_num_pedido").value != "") {
		// asigno el codigo del tree view a la variable oculta
		var n_pedido = document.getElementById("oculto_num_pedido").value;
		var ajax3=nuevoAjax();										  							// creo una instancia de ajax
		metodo="POST";												  							// asigno las variables de proceso
		url="marcar_pedido_como_facturado.php?";
		var sql="n_pedido="+n_pedido;
		ajax3.open(metodo, url, true);
		ajax3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax3.send(sql);
		ajax3.onreadystatechange=function(){ 
				if (ajax3.readyState==4){
					if(ajax3.responseText == 'ok'){ 
						window.parent.frames[0].document.getElementById(n_pedido).className = "nodecls_facturado";
					}
				} // fin de if (ajax.readyState==4)
		} // fin de funcion()
	}
}


//------------------------------------REGISTRAR FACTURA VENTA-----------------------------------------//
function registrar_nota_credito(){
	var divMensaje = document.getElementById("mensaje");  // asigna los aobjetos a las variables
	
	var txtnumero_tal = document.getElementById("oculto_numero_tal");  // asigna los aobjetos a las variables
	var txtcodigo_tal = document.getElementById("oculto_codigo_tal");  // asigna los aobjetos a las variables
	var txtnumero_fac = document.getElementById("oculto_numero_fac");  // asigna los aobjetos a las variables
	var txtfecha = document.getElementById("oculto_fecha");  // asigna los aobjetos a las variables
	var txthora = document.getElementById("hora_actual").innerHTML;  // asigna los aobjetos a las variables

	//------------------------impuestos-----------------------//
	var txttasa_iva = document.getElementById("tasa_iva");  // asigna los aobjetos a las variables
	var txttasa_perc_iva = document.getElementById("tasa_perc_iva");  // asigna los aobjetos a las variables
	var txttasa_img_bruto = document.getElementById("tasa_img_bruto");  // asigna los aobjetos a las variables
	var txtmonto_imp_int = document.getElementById("monto_imp_int");  // asigna los aobjetos a las variables
	//------------------------fin de impuestos----------------//

	if(document.frm.remito.value.length > 0 && document.frm.remito.value != "0"){
			var numero_rem = document.frm.remito.value;
	}else{
			var numero_rem = "0";
	}

	if(document.frm.codigo.value.length > 0 && document.frm.razon.disabled == true){
			var cod_cliente = document.frm.codigo.value;
	}else{
			var cod_cliente = "no_cliente";
	}

	var razon = document.frm.razon.value;
	var dir = document.frm.dir.value;
	var localidad = document.frm.localidad.value;
	var provincia = document.frm.provincia.value;
	var zona = document.frm.lista_zona.options[document.frm.lista_zona.selectedIndex].value;	
	var iva = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].value;
	var cuit1 = document.frm.cuit1.value;
	var cuit2 = document.frm.cuit2.value;
	var cuit3 = document.frm.cuit3.value;
	var lugar = document.frm.lugar.value;
	var hora = document.frm.hora.value;
	var vendedor = document.frm.vendedor.value;
	var repartidor = document.frm.repartidor.value;
	var categoria = document.frm.lista_cat.options[document.frm.lista_cat.selectedIndex].value;	
	var forma_pago = document.frm.lista_forma_pago.options[document.frm.lista_forma_pago.selectedIndex].value;	
	var obs = document.frm.obs.value;
	
	var requiere_cuit = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].id;
	//alert(zona);
	error = "";
	if(requiere_cuit == "S"){
		if(cuit1 != "" && cuit2 != "" && cuit3 != ""){
			var cuit=cuit1+cuit2+cuit3;
			validar_cuit(cuit);					// valida el CUIT ingrsado
		}else{
			divMensaje.innerHTML="Debe ingresar el Cuit del Cliente";
			document.frm.cuit1.focus()
			return 0;
		}
	}



	if(txtnumero_tal.value != " " && txtcodigo_tal.value != " " && txtnumero_fac.value != " "){
		if(razon != ""){
			if(dir != ""){
				if(localidad != ""){
					if(zona != ""){
					  if(error == ""){
						if(vendedor != ""){
							if(repartidor != ""){
								if(categoria != ""){
										if(forma_pago != ""){ 												// finaliza la validacion de la cabezera
													var ajax=nuevoAjax();										// creo una instancia de ajax
													metodo="POST";												// asigno las variables de proceso
													url="consultar_art_fac_vta_tmp.php";						// consulto si existen articulos en la tabla temporal
													ajax.open(metodo, url, true);
													ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
													ajax.send(null);
													ajax.onreadystatechange=function(){ 
															if (ajax.readyState==4){
																if(ajax.responseText == 'si'){									// si existen articulos sigo y guardo definitivamente
																			var ajax2=nuevoAjax();										// creo una instancia de ajax
																			metodo="POST";												// asigno las variables de proceso
																			url="alta_nota_credito.php";
																			variables="fecha="+txtfecha.value+"&lugar="+lugar+"&hora="+hora+"&numero_rem="+numero_rem+"&cod_cliente="+cod_cliente+"&categoria="+categoria+"&razon="+razon+"&dir="+dir+"&localidad="+localidad+"&provincia="+provincia+"&cond_iva="+iva+"&cuit="+cuit+"&vendedor="+vendedor+"&repartidor="+repartidor+"&obs="+obs+"&zona="+zona+"&forma_pago="+forma_pago+"&tasa_iva="+txttasa_iva.value+"&tasa_perc_iva="+txttasa_perc_iva.value+"&tasa_img_bruto="+txttasa_img_bruto.value+"&monto_imp_int="+txtmonto_imp_int.value+"&hora_actual="+txthora;
																			//alert(variables);
																			ajax2.open(metodo, url, true);
																			ajax2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
																			ajax2.send(variables);
																			ajax2.onreadystatechange=function(){ 
																					if (ajax2.readyState==4){
																						//alert(ajax2.responseText);
																						if(ajax2.responseText == 'ok'){	
																							
																							//divMensaje.innerHTML=ajax2.responseText;
																							mostrar_art_fac_vta_tmp();
																							borrar_cajas_factura_vta();
																							document.frm.remito.value="";
																							document.frm.codigo.focus();
																							//document.getElementById("codigo").focus()

																						}else{
																							 if(document.frm.remito.value.length > 0 && document.frm.remito.value != "0"){
																									divMensaje.innerHTML = "ERROR: la factura no pudo registrarse, verifique el Nº de Remito"; //=  ajax2.responseText;
																							}else{
																								if(ajax2.responseText == 'existe_carga'){	
																									divMensaje.innerHTML  = "ERROR: la factura no pudo registrarse, La carga "+repartidor +" ya ha sido finalizada"; //= ajax2.responseText;
																								}
																							}
																						}
																					} // fin de if (ajax.readyState==4)
																				} // fin de funcion()
																}else{
																	divMensaje.innerHTML="Debe agregar almenos un artículo";
																	document.frm_art.codigo_art.focus()
																}
															} // fin de if (ajax.readyState==4)
														} // fin de funcion()
									}else{
										divMensaje.innerHTML="Debe ingresar la Forma de Pago";
										document.frm.lugar.focus()
									}	 
								}else{
									divMensaje.innerHTML="Debe seleccionar una Categoría";
									document.frm.lista_cat.focus()
								}		 
							}else{
								divMensaje.innerHTML="Debe ingresar el Repartidor";
								document.frm.repartidor.focus()
							}	
						}else{
							divMensaje.innerHTML="Debe ingresar el Vendedor";
							document.frm.vendedor.focus()
						}	
					}else{
						divMensaje.innerHTML=error;
						document.frm.cuit1.focus()
					}
				 }else{
					 divMensaje.innerHTML="Debe ingresar la Zona";
					 document.frm.lista_zona.focus()
				 }
				}else{
					divMensaje.innerHTML="Debe ingresar la Loaclidad";
					document.frm.localidad.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar la Dirección";
				document.frm.dir.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar el Nombre";
			document.frm.razon.focus()
		}
	 }else{
		divMensaje.innerHTML="ERROR: Verifique de que exista un Talonario de Factura";
	 }
}
