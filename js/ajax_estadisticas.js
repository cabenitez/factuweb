//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ COMISION VENDEDORES -----------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////

/*********************** RANKING DE VENTAS POR VENDEDOR *********************************************/
function pasar_foco_estad_1(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.dia.focus();
	}
}
//--------------------------------------------------------------------------------------------------//
function listar_vendedores_estadisticas(){
	var contenedor=document.getElementById("vendedores"); 
	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_vendedores_estadisticas.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.vendedor.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_ranking_ventas_vendedor(){
 var cant_objetos = document.frm.elements.length;
 var contenedor =document.getElementById("grafico"); 
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables

 var buscar=document.getElementById("buscar");
 var vendedor = document.getElementById("vendedor");
 
	 var dia = document.getElementById("dia");
	 var mes = document.getElementById("mes");
	 var ano = document.getElementById("ano");
 var fecha_desde = ano.value+mes.value+dia.value;
 
	 var dia_h = document.getElementById("dia_h");
	 var mes_h = document.getElementById("mes_h");
	 var ano_h = document.getElementById("ano_h");
 var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
 
 if(document.frm.vendedor.value != ""){
		 if(fecha_desde.length == 8){
				if(fecha_hasta.length == 8){
							divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
							for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
									document.frm.elements[i].disabled=true;
							}	
							divMensaje.innerHTML="Buscando......."; // mensajes en el div
							
							url="ranking_ventas_vendedor.php?"; 
							variables="fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
							
							var cant_vendedor = 0;
							var vendedores=new Array();

							for(i=0;i<document.frm.vendedor.length ;i++){		//Obtengo la Lista de vendedores para hacer la consulta
								if(document.frm.vendedor.options[i].selected ){
									vendedores[i] = document.frm.vendedor.options[i].value;
									//variables = variables + '&vendedor_'+i+'='+document.frm.vendedor.options[i].value;
									cant_vendedor = cant_vendedor + 1;
								}
							}
							
							variables = variables + '&vendedores='+vendedores +'&cant_vendedor='+cant_vendedor;
							//alert(variables);
							contenedor.src = url + variables;				// Muestro el Grafico
							
							for (i=0; i < cant_objetos; i++){		        // Deshabilito el boton y los text
									document.frm.elements[i].disabled=false;
							}	
							divMensaje.innerHTML=""; // mensajes en el div
				 }else{
					divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
					document.frm.dia_h.focus() 
				 }
		 }else{
			divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
			document.frm.dia.focus() 
		 }
							
 }else{
	divMensaje.innerHTML="Debe seleccionar al menos un vendedor";
	document.frm.vendedor.focus() 
 }
}
/*********************** RANKING DE ARTICULOS MAS VENDIDOS *********************************************/
function listar_grupos_estadisticas(){
	var contenedor=document.getElementById("vendedores"); 
	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="lista_grupos_estadisticas.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.grupo.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_ranking_articulos_mas_vendidos(){
 var cant_objetos = document.frm.elements.length;
 var contenedor =document.getElementById("grafico"); 
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables

 var buscar=document.getElementById("buscar");
 var vendedor = document.getElementById("grupo");
 
	 var dia = document.getElementById("dia");
	 var mes = document.getElementById("mes");
	 var ano = document.getElementById("ano");
 var fecha_desde = ano.value+mes.value+dia.value;
 
	 var dia_h = document.getElementById("dia_h");
	 var mes_h = document.getElementById("mes_h");
	 var ano_h = document.getElementById("ano_h");
 var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
 
 if(document.frm.grupo.value != ""){
		 if(fecha_desde.length == 8){
				if(fecha_hasta.length == 8){
							divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
							for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
									document.frm.elements[i].disabled=true;
							}	
							divMensaje.innerHTML="Buscando......."; // mensajes en el div
							
							url="ranking_articulos_mas_vendidos.php?"; 
							variables="fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
							
							var cant_grupo = 0;
							var grupo=new Array();

							for(i=0;i<document.frm.grupo.length ;i++){		//Obtengo la Lista de vendedores para hacer la consulta
								if(document.frm.grupo.options[i].selected ){
									grupo[i] = document.frm.grupo.options[i].value;
									//variables = variables + '&vendedor_'+i+'='+document.frm.vendedor.options[i].value;
									cant_grupo = cant_grupo + 1;
								}
							}
							
							variables = variables + '&grupos='+grupo +'&cant_grupo='+cant_grupo;
							//alert(variables);
							
							contenedor.src = url + variables;				// Muestro el Grafico
							
							for (i=0; i < cant_objetos; i++){		        // Deshabilito el boton y los text
									document.frm.elements[i].disabled=false;
							}	
							divMensaje.innerHTML=""; // mensajes en el div
							
				 }else{
					divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
					document.frm.dia_h.focus() 
				 }
		 }else{
			divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
			document.frm.dia.focus() 
		 }
							
 }else{
	divMensaje.innerHTML="Debe seleccionar al menos un Grupo de Atrículos";
	document.frm.grupo.focus() 
 }
}
/*********************** RANKING DE VENTAS ANUALES *************************************************/
function listar_anos_comerciales(){
	var contenedor=document.getElementById("anos"); 
	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_anos_comerciales.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.ano_vta.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_estad_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.buscar.click();
	}
}

//--------------------------------------------------------------------------------------------------//
function buscar_ranking_ventas_anuales(){
 var cant_objetos = document.frm.elements.length;
 var contenedor =document.getElementById("grafico"); 
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables

 var buscar=document.getElementById("buscar");
 var ano_vta = document.getElementById("ano_vta");
 
 if(document.frm.ano_vta.value != ""){
		divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
		for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
				document.frm.elements[i].disabled=true;
		}	
		divMensaje.innerHTML="Buscando......."; // mensajes en el div
		url="ranking_ventas_anuales.php?"; 
		var cant_ano = 0;
		var ano_vta=new Array();
	
		for(i=0;i<document.frm.ano_vta.length ;i++){		//Obtengo la Lista de vendedores para hacer la consulta
			if(document.frm.ano_vta.options[i].selected ){
				ano_vta[i] = document.frm.ano_vta.options[i].value;
				cant_ano = cant_ano + 1;
			}
		}
		variables = 'anos='+ano_vta +'&cant_ano='+cant_ano;
		//alert(variables);
		
		contenedor.src = url + variables;				// Muestro el Grafico
		for (i=0; i < cant_objetos; i++){		        // Deshabilito el boton y los text
				document.frm.elements[i].disabled=false;
		}	
		divMensaje.innerHTML=""; // mensajes en el div
 }else{
	divMensaje.innerHTML="Debe seleccionar al menos un año";
	document.frm.ano_vta.focus() 
 }
}

