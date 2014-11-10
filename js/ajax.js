//teclas  		ENTER = 13	 F1= 112	F2 = 113		F7 = 118 		F8 = 119	+ = 107  TAB = 9  ESC =27
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------AJAX-----------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function nuevoAjax(){     							//crea una instancia de AJAX
    var req;
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) { 					// para IE/Windows ActiveX 
        req = new ActiveXObject("Microsoft.XMLHTTP");  
      }
    return req;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------EFECTO EN CELDAS----------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function color_seleccion(src,color_entrada) { 
	src.bgColor="#"+color_entrada;
} 
function color_defecto(src,color_default) {  
    src.bgColor="#"+color_default;
}

function color_seleccion_hijo(color_entrada,n_fila,cant){
	for(i=n_fila; i < cant+n_fila; i++){
	 celda = document.getElementById('fila_'+i);
	 celda.style.backgroundColor="#"+color_entrada;
	}
}
function color_defecto_hijo(color_entrada,n_fila,cant){
	for(i=n_fila; i < cant+n_fila; i++){
	 celda = document.getElementById('fila_'+i);
	 celda.style.backgroundColor="#"+color_entrada;
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------HABILITA/DESHABILITA UN OBJETO---------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function habilitarDeshabilitar(id,accion){
	document.getElementById(id).disabled = accion;
	document.getElementById(id).focus();
	if(accion == true){
		document.getElementById(id).value = "";
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------SOLO NUMEROS---------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
var nav4 = window.Event ? true : false;
function solo_entero(evt){	
		// NOTE: Backspace = 8, TAB = 0, Enter = 13, '0' = 48, '9' = 57	, '46'= .
		var key = nav4 ? evt.which : evt.keyCode;	
		return (key == 0 || key == 8 || key == 46 || key == 13 || (key >= 48 && key <= 57));
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------SOLO NUMEROS---------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function solo_letra(evt){	
		// NOTE: Backspace = 8, TAB = 0, Enter = 13, '0' = 48, '9' = 57	, '46'= . 		A= 65 Z=90 a=97 z= 122 	  
		var key = nav4 ? evt.which : evt.keyCode;	
		return (key == 0 || key == 8 || key == 13 || (key >= 65 && key <= 122));
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------FECHA ACTUAL -----------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function fecha_actual(){
	var divMensaje=document.getElementById("fecha_actual"); // asigna los aobjetos a las variables
	var mydate=new Date();
	var year=mydate.getYear();
	if (year < 1000)
		year+=1900;
	var day=mydate.getDay();
	var month=mydate.getMonth();
	var daym=mydate.getDate();
	if (daym<10)
		daym="0"+daym;
	var dayarray=new Array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
	var montharray=new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	divMensaje.innerHTML=dayarray[day]+" "+daym+" de "+montharray[month]+" de "+year;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------HORA ACTUAL -----------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function hora_actual(){
	var divMensaje=document.getElementById("hora_actual"); // asigna los aobjetos a las variables
	momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()
	if(hora < 10){
		hora="0"+hora;
	}
	if(minuto < 10){
		minuto="0"+minuto;
	}
	if(segundo < 10){
		segundo="0"+segundo;
	}
    horaImprimible =hora + ":" + minuto + ":" + segundo
	divMensaje.innerHTML=horaImprimible; // imprime la salida
    setTimeout("hora_actual()",1000)
} 
///////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------MOSTRAR IMAGEN --------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function mostrar(){                          //Funcion para mostrar la imagen que selecciona el usuario 
        if (document.frm.foto.value != "") {
                document.frm.imagen.src = document.frm.foto.value;
        }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------VALIDAR CUIT-----------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function validar_cuit(cuit){ // Funcion para validar CUIT
    var vec=new Array(10);
    esCuit=false;
    cuit_rearmado="";
    error = '';
    for(i=0; i < cuit.length; i++){   
        caracter=cuit.charAt( i);
        if ( caracter.charCodeAt(0) >= 48 && caracter.charCodeAt(0) <= 57 ){
            cuit_rearmado +=caracter;
        }
    }
    cuit=cuit_rearmado;
    if( cuit.length != 11){  // si no estan todos los digitos
        esCuit=false;
        error = 'ERROR: el Cuit debe ser de 11 caracteres!!';
        //alert( "CUIT Menor a 11 Caracteres" );
    }else{
        x=i=dv=0;
        // Multiplico los dígitos.
        vec[0] = cuit.charAt(0) * 5;
        vec[1] = cuit.charAt(1) * 4;
        vec[2] = cuit.charAt(2) * 3;
        vec[3] = cuit.charAt(3) * 2;
        vec[4] = cuit.charAt(4) * 7;
        vec[5] = cuit.charAt(5) * 6;
        vec[6] = cuit.charAt(6) * 5;
        vec[7] = cuit.charAt(7) * 4;
        vec[8] = cuit.charAt(8) * 3;
        vec[9] = cuit.charAt(9) * 2;
        // Suma cada uno de los resultado.
        for( i = 0;i<=9; i++){
            x += vec[i];
        }
        dv = (11 - (x % 11)) % 11;
        if( dv == cuit.charAt(10)){
            esCuit=true;
        }
    }
    if( !esCuit ){
        //alert( "CUIT Invalido" );
        //document.frmClientes.cuit.focus();
        error = 'ERROR: Cuit Invalido!!';
    }
	return error;
    //document.MM_returnValue1 = (errors == '');
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------DECIMALES AL PRECIO -------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function decimal_precio(precio){
   string = "" + precio;
   number = string.length - string.indexOf('.');
   if (string.indexOf('.') == -1)
      return string + '.00';
   if (number == 1)
      return string + '00';
   if (number == 2)
      return string + '0';
   if (number > 3)
      return string.substring(0,string.length-number+3);
   return string;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------FUNCION PARA IMAGEN DE SUSTITUCION ----------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ TAB CON ENTER ------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function tabular(e,obj) {
  tecla=(document.all) ? e.keyCode : e.which;
  if(tecla!=13) 
  	return;
  frm=obj.form;
  for(i=0;i<frm.elements.length;i++)
    if(frm.elements[i]==obj) {
      if (i==frm.elements.length-1) 
	  	i=-1;
      break 
	  }
  frm.elements[i+1].focus();
  return false;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------USUARIO SESION-------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function usuarioconectado(){
    var divMensaje=document.getElementById("usuario"); // asigna los aobjetos a las variables
	divMensaje.innerHTML="";			// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();				// creo una instancia de ajax
	metodo="POST";						// asigno las variables de proceso
    url="php/info_empresa.php?";
	variables="usuario=si";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divMensaje.innerHTML=ajax.responseText; // imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
} // fin de la funcion usuarioconectado

///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------INFO EMPRESA---------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function infoEmpresa(){
    var divMensaje=document.getElementById("datosEmpresa"); // asigna los aobjetos a las variables
	divMensaje.innerHTML="";			// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();				// creo una instancia de ajax
	metodo="POST";						// asigno las variables de proceso
    url="info_empresa.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divMensaje.innerHTML=ajax.responseText; // imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
} // fin de la funcion infoEmpresa
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------LOGIN----------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function ponerFoco(){
	//document.login.usuario.focus();	
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------LOGOUT---------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function logout(){
	var ajax=nuevoAjax();				// creo una instancia de ajax
	metodo="POST";						// asigno las variables de proceso
    url="logout.php?";
	//variables="usuario=si";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				//divMensaje.innerHTML=ajax.responseText; // imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
} // fin de la funcion usuarioconectado

///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------LISTAR BASE DE DATOS-------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_db(){
    var divMensaje=document.getElementById("listado"); // asigna los aobjetos a las variables
	divMensaje.innerHTML="";			// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();				// creo una instancia de ajax
	metodo="POST";						// asigno las variables de proceso
    url="listar_db.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divMensaje.innerHTML=ajax.responseText; // imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
} // fin de la funcion usuarioconectado

///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------SELECCIONAR BASE DE DATOS--------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function seleccionar_db(db){
    var divMensaje=document.getElementById("listado"); // asigna los aobjetos a las variables
	divMensaje.innerHTML="";			// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();				// creo una instancia de ajax
	metodo="POST";						// asigno las variables de proceso
    url="cambiar_base_datos.php?";
	variables ="db="+db;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				//logout();
				//divMensaje.innerHTML=ajax.responseText; // imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
} // fin de la funcion usuarioconectado

//--------------------------------------------------------------------------------------------------//
function pasar_foco1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.login.usuario.value.length > 0  ) {
                document.login.clave.focus()
                return 0;		  
		   }	
     }
	
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco2(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.login.clave.value.length > 0  ) {
                document.login.enviar.click()
                return 0;		  
		   }	
     }
	
}
//--------------------------------------------------------------------------------------------------//
function login_usuario(){
	var divMensaje=document.getElementById("mensaje"); 		// asigna los aobjetos a las variables
    var boton=document.getElementById("enviar");
    var txtusuario = document.getElementById("usuario");
    var txtclave = document.getElementById("clave");

	divMensaje.innerHTML="";								// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 									// Deshabilito el boton y el input para evitar dobles ingresos
	txtusuario.disabled=true; 
	txtclave.disabled=true;
	divMensaje.innerHTML="Buscando......."; //'<img src="../imagenes/cargando8.gif">'; // width="30" height="30"  //
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="php/login.php?";
	clave = hex_md5(txtclave.value); /* envia la clave encriptada con MD5 */
	variables="usuario="+txtusuario.value+"&clave="+clave;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtusuario.value="";							// Borro el contenido del input
				txtclave.value="";
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtusuario.disabled=false; 
				txtclave.disabled=false;
				if (ajax.responseText == "usuario_valido"){
						window.location.href="/";   // redireccion
				}else{
						divMensaje.innerHTML=ajax.responseText; // imprime la salida
						document.login.usuario.focus()
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
} // fin de la funcion login_usuario
//--------------------------------------------------------------------------------------------------//
function logout_usuario(){
	var ajax=nuevoAjax();
	metodo="POST";// asigno las variables de proceso
    url="logout.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
		if (ajax.readyState==4){
				busca_sesion() // llama a la funcion busca_sesion() para ver si se inicio sesion
				window.location.href="index.php";
		} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------PAIS-----------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function poner_foco_pais(){
	document.frm.nombre.focus();	
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_pais_registrar(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.nombre.value.length > 0  ) {
                document.frm.enviar.click()
                return 0;		  
		   }	
     }
}
//--------------------------------------------------------------------------------------------------//
function poner_foco_pais_mod(){
document.frm_mod.nombre_mod.focus();	
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_pais_buscar(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_pais_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.enviar_mod.click()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function registrar_pais(){
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var boton=document.getElementById("enviar");
 var txtnombre = document.getElementById("nombre");
 if(document.frm.nombre.value != ""){
	divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	divMensaje.innerHTML="Buscando......."; // mensajes en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
    url="alta_pais.php?";
	variables="nombre="+txtnombre.value;

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";			// Borro el contenido del input
				boton.disabled=false; 		// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				divMensaje.innerHTML=ajax.responseText; // imprime la salida
				document.frm.nombre.focus()
				buscar_pais()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
 }else{
	divMensaje.innerHTML="Debe ingresar el nombre del Pais";
	document.frm.nombre.focus()
 }
}
//--------------------------------------------------------------------------------------------------//
function buscar_pais(){
	var divMensaje_mod=document.getElementById("msg");			// asigna los aobjetos a las variables
	//var divMensaje=document.getElementById("mensaje"); 
 	var divlistado=document.getElementById("listado"); 
	var boton=document.getElementById("enviar");
 	var txtnombre = document.getElementById("nombre");

	//divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	//divMensaje.innerHTML="Buscando.......";						// mensajes en el div
	divMensaje_mod.innerHTML="";
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_pais_proceso.php?";
	if(document.frm.nombre.value == ""){
		variables="nombre=todos";
	}
	else{
		variables="nombre="+txtnombre.value;
	}
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				//divMensaje.innerHTML="";
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_pais(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_pais_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					document.frm_mod.nombre_mod.focus();
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_pais_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
 	var txtcodigo = document.getElementById("oculto_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var ajax=nuevoAjax();										// creo una instancia de ajax
 if(document.frm_mod.nombre_mod.value != ""){	
 	divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	divMensaje.innerHTML="Modificando.......";					// mensajes en el div
	
	metodo="POST";												// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_pais_mod="+txtcodigo.value+"&nombre_pais_mod="+txtnombre.value;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if (ajax.responseText == "ok"){
					/*
					txtnombre.value="";								// Borro el contenido del input
					boton.disabled=false; 							// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					divlistado.innerHTML="<div class='advertencia'>Pais Modificado!!</div>";
					*/
					buscar_pais()
				}else{
					divMensaje.innerHTML = "ERROR: El pais ya existe!!";
					boton.disabled=false; 							// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					document.frm_mod.nombre_mod.focus()
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
 }else{
	divMensaje.innerHTML="Debe ingresar el nombre del Pais";
	document.frm_mod.nombre_mod.focus()
 }	
}
//--------------------------------------------------------------------------------------------------//
function eliminar_pais(codigo){
 if (confirm('¿Está seguro de eliminar este pais?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="eliminar.php?";
	variables="codigo_pais="+codigo;
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "sin_permiso"){
					buscar_pais()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------PROVINCIA------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function poner_foco_prov(){
	var contenedor=document.getElementById("paises"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_pais.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.nombre.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_prov_registrar(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.nombre.value.length > 0  ) {
                document.frm.lista_pais.focus()
                return 0;		  
		   }	
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_prov_registrar_lista(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function registrar_prov(){
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var boton=document.getElementById("enviar");
 var txtnombre = document.getElementById("nombre");
 var txtpais = document.frm.lista_pais.options[document.frm.lista_pais.selectedIndex].text

 if(document.frm.nombre.value != ""){
	divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	divMensaje.innerHTML="Buscando......."; // mensajes en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
    url="alta_provincia.php?";
	variables="nombre_prov="+txtnombre.value+"&nombre_pais="+txtpais;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";			// Borro el contenido del input
				boton.disabled=false; 		// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				divMensaje.innerHTML= ajax.responseText; // imprime la salida
				document.frm.nombre.focus()
				buscar_prov()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
 }else{
	divMensaje.innerHTML="Debe ingresar el nombre de la Provincia";
	document.frm.nombre.focus()
 }
}
//--------------------------------------------------------------------------------------------------//
function poner_foco_prov_buscar(){
document.frm.nombre.focus();	
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_prov_buscar(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function buscar_prov(){
	var divMensaje_mod=document.getElementById("msg");			// asigna los aobjetos a las variables
	//var divMensaje=document.getElementById("mensaje"); 
 	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
 	var txtnombre = document.getElementById("nombre");
	//divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	//divMensaje.innerHTML="Buscando.......";						// mensajes en el div
	divMensaje_mod.innerHTML="";
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_prov_proceso.php?";
	if(document.frm.nombre.value == ""){
		variables="nombre=todos";
	}
	else{
		variables="nombre="+txtnombre.value;
	}
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				//divMensaje.innerHTML="";
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_pais(cod_prov){
	var contenedor=document.getElementById("paisess"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_pais_de_prov.php?";
	variables = "cod_prov="+cod_prov;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_prov(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_prov_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					listar_pais(codigo);
					document.frm_mod.nombre_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_prov_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.lista_pais.focus()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_prov_mod_lista(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm_mod.enviar_mod.click()
                return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function modificar_prov_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
 	
	var txtcodigo = document.getElementById("oculto_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var txtpais = document.frm_mod.lista_pais.options[document.frm_mod.lista_pais.selectedIndex].text
	 
	var ajax=nuevoAjax();										// creo una instancia de ajax
 	if(document.frm_mod.nombre_mod.value != ""){	
 		divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
		boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
		txtnombre.disabled=true; 
		divMensaje.innerHTML="Modificando.......";					// mensajes en el div
	
		metodo="POST";												// asigno las variables de proceso
    	url="modificar.php?";
		variables="codigo_prov_mod="+txtcodigo.value+"&nombre_prov_mod="+txtnombre.value+"&nombre_pais_mod_prov="+txtpais;
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if (ajax.responseText == "ok"){
					/*
					txtnombre.value="";								// Borro el contenido del input
					boton.disabled=false; 							// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					divlistado.innerHTML="<div class='advertencia'>Provincia Modificada!!</div>";
					*/
					buscar_prov()
					//poner_foco_prov_buscar()
				}else{
					divMensaje.innerHTML = "ERROR: La provincia ya existe!!";
					boton.disabled=false; 							// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					document.frm_mod.nombre_mod.focus()
				}
				
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
   }else{
		divMensaje.innerHTML="Debe ingresar el nombre de la Provincia";
		document.frm_mod.nombre_mod.focus()
   }	
}
//--------------------------------------------------------------------------------------------------//
function eliminar_prov(codigo){
 if (confirm('¿Está seguro de eliminar esta provincia?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="eliminar.php?";
	variables="codigo_prov="+codigo;
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "sin_permiso"){
					buscar_prov()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------LOCALIDAD------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function poner_foco_loca(){
	var boton=document.getElementById("enviar");
	var contenedor=document.getElementById("provincias"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_provincias.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.nombre.focus();	
						buscar_loca();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_loca_cp(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.nombre.value.length > 0  ) {
                document.frm.cp.focus()
                return 0;		  
		   }	
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_loca_registrar(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.cp.value.length > 0  ) {
                document.frm.lista_prov.focus()
                return 0;		  
		   }	
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_loca_registrar_lista(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function registrar_loca(){
 	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 	var boton=document.getElementById("enviar");
 	var txtnombre = document.getElementById("nombre");
 	var txtcp = document.getElementById("cp");
	var txtprov = document.frm.lista_prov.options[document.frm.lista_prov.selectedIndex].text

    if(document.frm.nombre.value != ""){
	  if(document.frm.cp.value != ""){
		divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
		boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
		txtnombre.disabled=true; 
		txtcp.disabled=true; 
		divMensaje.innerHTML="Buscando......."; // mensajes en el div
		var ajax=nuevoAjax();					// creo una instancia de ajax
		metodo="POST";							// asigno las variables de proceso
    	url="alta_localidad.php?";
		variables="nombre_loca="+txtnombre.value+"&cp_loca="+txtcp.value+"&nombre_prov="+txtprov;
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";			// Borro el contenido del input
				txtcp.value="";			// Borro el contenido del input
				boton.disabled=false; 		// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				txtcp.disabled=false; 
				divMensaje.innerHTML=ajax.responseText; // imprime la salida
				document.frm.nombre.focus()
				buscar_loca();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
      }else{
		divMensaje.innerHTML="Debe ingresar el CP de la localidad";
		document.frm.nombre.focus()
 	  }
    }else{
		divMensaje.innerHTML="Debe ingresar el nombre de la localidad";
		document.frm.nombre.focus()
 	}
}
//--------------------------------------------------------------------------------------------------//
function poner_foco_loca_buscar(){
	document.frm.nombre.focus();	
}

//--------------------------------------------------------------------------------------------------//
function pasar_foco_loca_buscar(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function buscar_loca(){
	var divMensaje_mod=document.getElementById("msg");			// asigna los aobjetos a las variables
	//	var divMensaje=document.getElementById("mensaje"); 
 	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
 	var txtnombre = document.getElementById("nombre");
	
	//divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	//divMensaje.innerHTML="Buscando.......";						// mensajes en el div
	divMensaje_mod.innerHTML="";
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_loca_proceso.php?";
	if(document.frm.nombre.value == ""){
		variables="nombre=todos";
	}
	else{
		variables="nombre="+txtnombre.value;
	}
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				//divMensaje.innerHTML="";
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_prov(cod_loca){
	var contenedor=document.getElementById("localidades"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_prov_de_loca.php?";
	variables = "cod_loca="+cod_loca;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_loca(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_loca_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					listar_prov(codigo);
					document.frm_mod.nombre_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_loca_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.cp_mod.focus()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_loca_pro(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.cp_mod.value.length > 0  ) {
                document.frm_mod.lista_prov.focus()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_loca_mod_lista(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
          document.frm_mod.enviar_mod.click()
          return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function modificar_loca_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
 	
	var txtcodigo = document.getElementById("oculto_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var txtcp = document.getElementById("cp_mod");
	var txtprov = document.frm_mod.lista_prov.options[document.frm_mod.lista_prov.selectedIndex].text
	 
	var ajax=nuevoAjax();										// creo una instancia de ajax
 	if(document.frm_mod.nombre_mod.value != ""){	
 		divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
		boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
		txtnombre.disabled=true; 
		txtcp.disabled=true; 
		divMensaje.innerHTML="Modificando.......";					// mensajes en el div
	
		metodo="POST";												// asigno las variables de proceso
    	url="modificar.php?";
		variables="codigo_loca_mod="+txtcodigo.value+"&nombre_loca_mod="+txtnombre.value+"&cp_loca_mod="+txtcp.value+"&nombre_prov_mod_prov="+txtprov;
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if (ajax.responseText == "ok"){
					/*
					txtnombre.value="";								// Borro el contenido del input
					boton.disabled=false; 							// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					divlistado.innerHTML="<div class='advertencia'>Localidad Modificada!!</div>";
					poner_foco_prov_buscar()
					*/
					buscar_loca()
				}else{
					//divMensaje.innerHTML = ajax.responseText;
					divMensaje.innerHTML = "ERROR: La Localidad ya existe!!";
					boton.disabled=false; 							// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					txtcp.disabled=false; 
					document.frm_mod.nombre_mod.focus()
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
   }else{
		divMensaje.innerHTML="Debe ingresar el nombre de la Localidad";
		document.frm_mod.nombre_mod.focus()
   }	
}
//--------------------------------------------------------------------------------------------------//
function eliminar_loca(codigo){
 if (confirm('¿Está seguro de eliminar esta localidad?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="eliminar.php?";
	variables="codigo_loca="+codigo;
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "sin_permiso"){
					buscar_loca()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------ZONA------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function poner_foco_zona(){
	var boton=document.getElementById("enviar");
	var contenedor=document.getElementById("localidades"); 
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_localidades.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
//						document.frm.nombre.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_zona_loca(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.nombre.value.length > 0  ) {
                document.frm.lista_loca.focus()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_zona_por_vta(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.porc_vta.focus()
            return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_zona_por_trans(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.porc_vta.value.length > 0  ) {
                document.frm.porc_trans.focus()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_zona_enviar(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.porc_trans.value.length > 0  ) {
                document.frm.enviar.click()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function registrar_zona(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 	var boton=document.getElementById("enviar");
	var txtnombre = document.getElementById("nombre");
 	var txtloca = document.frm.lista_loca.options[document.frm.lista_loca.selectedIndex].text;
	var txtporc_vta = document.getElementById("porc_vta");
    var txtporc_trans = document.getElementById("porc_trans");
	if(document.frm.nombre.value != ""){
	  if(document.frm.porc_vta.value != ""){
		if(document.frm.porc_trans.value != ""){
			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
			boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
			txtnombre.disabled=true; 
			txtporc_vta.disabled=true; 
			txtporc_trans.disabled=true; 
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
    		url="alta_zona.php?";
			variables="nombre_zona="+txtnombre.value+"&nombre_loca="+txtloca+"&porc_vta="+txtporc_vta.value+"&porc_trans="+txtporc_trans.value;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					txtnombre.value="";				// Borro el contenido del input
					txtporc_vta.value="";			// Borro el contenido del input
					txtporc_trans.value="";			// Borro el contenido del input
					boton.disabled=false; 		// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					txtporc_vta.disabled=false; 
					txtporc_trans.disabled=false; 
					divMensaje.innerHTML=ajax.responseText; // imprime la salida
					buscar_zona()
					//document.frm.nombre.focus()
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
		}else{
			divMensaje.innerHTML="Debe ingresar el porcentaje de comisión de transporte";
			document.frm.porc_trans.focus()
 	  	}
      }else{
		divMensaje.innerHTML="Debe ingresar el porcentaje de comisión de venta";
		document.frm.porc_vta.focus()
 	  }
    }else{
		divMensaje.innerHTML="Debe ingresar el nombre de la zona";
		document.frm.nombre.focus()
 	}
}
//--------------------------------------------------------------------------------------------------//
function poner_foco_zona_buscar(){
	document.frm.nombre.focus();	
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_zona_buscar(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function buscar_zona(){
	var divMensaje_mod=document.getElementById("msg");			// asigna los aobjetos a las variables
	//var divMensaje=document.getElementById("mensaje"); 
 	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
 	var txtnombre = document.getElementById("nombre");
	
	//divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	//divMensaje.innerHTML="Buscando.......";						// mensajes en el div
	divMensaje_mod.innerHTML="";
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_zona_proceso.php?";
	if(document.frm.nombre.value == ""){
		variables="nombre=todos";
	}
	else{
		variables="nombre="+txtnombre.value;
	}
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				//divMensaje.innerHTML="";
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_loca(cod_zona){
	var contenedor=document.getElementById("localidades_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_loca_de_zona.php?";
	variables = "cod_zona="+cod_zona;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_zona(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_zona_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					listar_loca(codigo);
					document.frm_mod.nombre_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_zona_loca_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.lista_loca.focus()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_zona_mod_lista(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
          document.frm_mod.porc_vta_mod.focus()
          return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_zona_por_trans_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.porc_vta_mod.value.length > 0  ) {
                document.frm_mod.porc_trans_mod.focus()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_zona_enviar_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.porc_trans_mod.value.length > 0  ) {
                document.frm_mod.enviar.click()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function modificar_zona_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod"); 
	
 	var boton=document.getElementById("enviar");
	
	var txtcodigo = document.getElementById("oculto_mod");
	var txtnombre = document.getElementById("nombre_mod");
 	var txtloca = document.frm_mod.lista_loca.options[document.frm_mod.lista_loca.selectedIndex].text;
	var txtporc_vta = document.getElementById("porc_vta_mod");
    var txtporc_trans = document.getElementById("porc_trans_mod");
	
	if(document.frm_mod.nombre_mod.value != ""){
	  if(document.frm_mod.porc_vta_mod.value != ""){
		if(document.frm_mod.porc_trans_mod.value != ""){
			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
			boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
			txtnombre.disabled=true; 
			txtporc_vta.disabled=true; 
			txtporc_trans.disabled=true; 
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
    		url="modificar.php?";
			variables="codigo_zona_mod="+txtcodigo.value+"&nombre_zona_mod="+txtnombre.value+"&nombre_loca_mod_zona="+txtloca+"&porc_vta_mod="+txtporc_vta.value+"&porc_trans_mod="+txtporc_trans.value;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					if (ajax.responseText == "ok"){
							txtnombre.value="";				// Borro el contenido del input
							txtporc_vta.value="";			// Borro el contenido del input
							txtporc_trans.value="";			// Borro el contenido del input
							boton.disabled=false; 		// Habilito campos y boton nuevamente
							txtnombre.disabled=false; 
							txtporc_vta.disabled=false; 
							txtporc_trans.disabled=false; 
							divlistado.innerHTML="<div class='advertencia'>Zona Modificada!!</div>";
							buscar_zona()
							//poner_foco_zona_buscar()
					}else{
							boton.disabled=false; 		// Habilito campos y boton nuevamente
							txtnombre.disabled=false; 
							txtporc_vta.disabled=false; 
							txtporc_trans.disabled=false; 
							divMensaje.innerHTML = "ERROR: La Zona ya existe!!";
							document.frm_mod.nombre_mod.focus()
					}
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()

		}else{
			divMensaje.innerHTML="Debe ingresar el porcentaje de comisión de transporte";
			document.frm.porc_trans.focus()
 	  	}
      }else{
		divMensaje.innerHTML="Debe ingresar el porcentaje de comisión de venta";
		document.frm.porc_vta.focus()
 	  }
    }else{
		divMensaje.innerHTML="Debe ingresar el nombre de la zona";
		document.frm.nombre_mod.focus()
 	}
}
//--------------------------------------------------------------------------------------------------//
function eliminar_zona(codigo){
 if (confirm('¿Está seguro de eliminar esta Zona?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="eliminar.php?";
	variables="codigo_zona="+codigo;
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "sin_permiso"){
					buscar_zona()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------TIPOS ASOCIADOS------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function pasar_foco_tipo_asoc(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.nombre.value.length > 0  ) {
                document.frm.enviar.click()
                return 0;		  
		   }	
     }
}
/*
//--------------------------------------------------------------------------------------------------//
function poner_foco_pais_mod(){
document.frm_mod.nombre_mod.focus();	
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_pais_buscar(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_pais_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.enviar_mod.click()
                return 0;		  
			}
     }
}
*/
//--------------------------------------------------------------------------------------------------//
function registrar_tipo_asoc(){
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var boton=document.getElementById("enviar");
 var txtnombre = document.getElementById("nombre");
 if(document.frm.nombre.value != ""){
	divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	divMensaje.innerHTML="Buscando......."; // mensajes en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
    url="alta_tipo_asociado.php?";
	variables="nombre="+txtnombre.value;

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";			// Borro el contenido del input
				boton.disabled=false; 		// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				divMensaje.innerHTML=ajax.responseText; // imprime la salida
				document.frm.nombre.focus()
				buscar_tipo_asociado()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
 }else{
	divMensaje.innerHTML="Debe ingresar la letra del Tipo";
	document.frm.nombre.focus()
 }
}
//--------------------------------------------------------------------------------------------------//
function buscar_tipo_asociado(){
	var divMensaje_mod=document.getElementById("msg");			// asigna los aobjetos a las variables
	//var divMensaje=document.getElementById("mensaje"); 
 	var divlistado=document.getElementById("listado"); 
	var boton=document.getElementById("enviar");
 	var txtnombre = document.getElementById("nombre");

	//divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	//divMensaje.innerHTML="Buscando.......";						// mensajes en el div
	divMensaje_mod.innerHTML="";
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_tipo_asociado.php?";
	if(document.frm.nombre.value == ""){
		variables="nombre=todos";
	}
	else{
		variables="nombre="+txtnombre.value;
	}
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				//divMensaje.innerHTML="";
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function eliminar_tipo_asoc(letra){
 if (confirm('¿Está seguro de eliminar este pais?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="eliminar.php?";
	variables="letra_tipo_asoc="+letra;
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				buscar_tipo_asociado()
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------ALICUOTA IVA----------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function poner_foco_iva(){
	document.frm.nombre.focus();	
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_iva_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.nombre.value.length > 0  ) {
                document.frm.tasa.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_iva_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.tasa.value.length > 0  ) {
                document.frm.enviar.click()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function registrar_iva(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");
	var txtnombre = document.getElementById("nombre");
	var txttasa = document.getElementById("tasa");

	if(document.frm.nombre.value != ""){
	  if(document.frm.tasa.value != ""){
			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
			boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
			txtnombre.disabled=true; 
			txttasa.disabled=true; 
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
    		url="alta_iva.php?";
			variables="nombre="+txtnombre.value+"&tasa="+txttasa.value;
//			alert(variables);
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					txtnombre.value="";				// Borro el contenido del input
					txttasa.value="";			// Borro el contenido del input
					boton.disabled=false; 		// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					txttasa.disabled=false; 
					divMensaje.innerHTML=ajax.responseText; // imprime la salida
					buscar_iva()
					//document.frm.nombre.focus()
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
      }else{
		divMensaje.innerHTML="Debe ingresar la tasa del impuesto";
		document.frm.porc_vta.focus()
 	  }
    }else{
		divMensaje.innerHTML="Debe ingresar el nombre del impuesto";
		document.frm.nombre.focus()
 	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_iva_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function buscar_iva(){
	var divMensaje_mod=document.getElementById("msg");			// asigna los aobjetos a las variables
	//var divMensaje=document.getElementById("mensaje"); 
 	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
 	var txtnombre = document.getElementById("nombre");
	
	//divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	//divMensaje.innerHTML="Buscando.......";						// mensajes en el div
	divMensaje_mod.innerHTML="";
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_iva_proceso.php?";
	if(document.frm.nombre.value == ""){
		variables="nombre=todos";
	}
	else{
		variables="nombre="+txtnombre.value;
	}
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_iva(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_iva_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					document.frm_mod.nombre_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_iva_4(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.tasa_mod.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_iva_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.tasa_mod.value.length > 0  ) {
                document.frm_mod.enviar_mod.click()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function modificar_iva_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
 	var txtcodigo = document.getElementById("oculto_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var txttasa = document.getElementById("tasa_mod");
	var ajax=nuevoAjax();										// creo una instancia de ajax
 if(document.frm_mod.nombre_mod.value != ""){	
	 if(document.frm_mod.tasa_mod.value != ""){
			divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
			boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
			txtnombre.disabled=true; 
			txttasa.disabled=true; 
			divMensaje.innerHTML="Modificando.......";					// mensajes en el div
			
			metodo="POST";												// asigno las variables de proceso
			url="modificar.php?";
			variables="codigo_iva_mod="+txtcodigo.value+"&nombre_iva_mod="+txtnombre.value+"&tasa_iva_mod="+txttasa.value;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
						if (ajax.responseText == "ok"){
							txtnombre.value="";								// Borro el contenido del input
							boton.disabled=false; 							// Habilito campos y boton nuevamente
							txtnombre.disabled=false; 
							//divlistado.innerHTML="<div class='advertencia'>Impuesto Modificado!!</div>";
							buscar_iva()
						}else{
							divMensaje.innerHTML = "ERROR: El Impuesto ya existe!!";
							boton.disabled=false; 							// Habilito campos y boton nuevamente
							txtnombre.disabled=false; 
							txttasa.disabled=false;
							document.frm_mod.nombre_mod.focus()
						}
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
	 }else{
		divMensaje.innerHTML="Debe ingresar la tasa del Impuesto";
		document.frm_mod.nombre_mod.focus()
 	 }	
 }else{
	divMensaje.innerHTML="Debe ingresar el nombre del Impuesto";
	document.frm_mod.nombre_mod.focus()
 }	
}

//--------------------------------------------------------------------------------------------------//
function eliminar_iva(codigo){
 if (confirm('¿Está seguro de eliminar este impuesto?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="eliminar.php?";
	variables="codigo_iva="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "sin_permiso"){
					buscar_iva()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------IMPUESTO INTERNO------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function poner_foco_ii(){
	document.frm.nombre.focus();	
}

//--------------------------------------------------------------------------------------------------//
function pasar_foco_ii_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.nombre.value.length > 0  ) {
                document.frm.tasa.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_ii_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.tasa.value > 0  ) {
                document.frm.enviar.click()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function registrar_ii(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");
	var txtnombre = document.getElementById("nombre");
	var txttasa = document.getElementById("tasa");

	if(document.frm.nombre.value != ""){
	  if(document.frm.tasa.value != ""){
			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
			boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
			txtnombre.disabled=true; 
			txttasa.disabled=true; 
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
    		url="alta_imp_int.php?";
			variables="nombre="+txtnombre.value+"&tasa="+txttasa.value;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					txtnombre.value="";				// Borro el contenido del input
					txttasa.value="";			// Borro el contenido del input
					boton.disabled=false; 		// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					txttasa.disabled=false; 
					divMensaje.innerHTML=ajax.responseText; // imprime la salida
					buscar_ii()
					//document.frm.nombre.focus()
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
      }else{
		divMensaje.innerHTML="Debe ingresar la tasa del impuesto";
		document.frm.porc_vta.focus()
 	  }
    }else{
		divMensaje.innerHTML="Debe ingresar el nombre del impuesto";
		document.frm.nombre.focus()
 	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_ii_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function buscar_ii(){
	var divMensaje_mod=document.getElementById("msg");			// asigna los aobjetos a las variables
	//var divMensaje=document.getElementById("mensaje"); 
 	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
 	var txtnombre = document.getElementById("nombre");
	
	//divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	//divMensaje.innerHTML="Buscando.......";						// mensajes en el div
	divMensaje_mod.innerHTML="";
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_ii_proceso.php?";
	if(document.frm.nombre.value == ""){
		variables="nombre=todos";
	}
	else{
		variables="nombre="+txtnombre.value;
	}
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function modificar_ii(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_ii_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					document.frm_mod.nombre_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function pasar_foco_ii_4(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.tasa_mod.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_ii_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.tasa_mod.value > 0  ) {
                document.frm_mod.enviar_mod.click()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function modificar_ii_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
 	var txtcodigo = document.getElementById("oculto_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var txttasa = document.getElementById("tasa_mod");
	var ajax=nuevoAjax();										// creo una instancia de ajax
 if(document.frm_mod.nombre_mod.value != ""){	
	 if(document.frm_mod.tasa_mod.value != ""){
			divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
			boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
			txtnombre.disabled=true; 
			txttasa.disabled=true; 
			divMensaje.innerHTML="Modificando.......";					// mensajes en el div
			
			metodo="POST";												// asigno las variables de proceso
			url="modificar.php?";
			variables="codigo_ii_mod="+txtcodigo.value+"&nombre_ii_mod="+txtnombre.value+"&tasa_ii_mod="+txttasa.value;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
						if (ajax.responseText == "ok"){
							txtnombre.value="";								// Borro el contenido del input
							boton.disabled=false; 							// Habilito campos y boton nuevamente
							txtnombre.disabled=false; 
							//divlistado.innerHTML="<div class='advertencia'>Impuesto Modificado!!</div>";
							buscar_ii()
						}else{
							divMensaje.innerHTML = "ERROR: El Impuesto ya existe!!";
							boton.disabled=false; 							// Habilito campos y boton nuevamente
							txtnombre.disabled=false; 
							txttasa.disabled=false;
							document.frm_mod.nombre_mod.focus()
						}
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
	 }else{
		divMensaje.innerHTML="Debe ingresar la tasa del Impuesto";
		document.frm_mod.nombre_mod.focus()
 	 }	
 }else{
	divMensaje.innerHTML="Debe ingresar el nombre del Impuesto";
	document.frm_mod.nombre_mod.focus()
 }	
}
//--------------------------------------------------------------------------------------------------//
function eliminar_ii(codigo){
 if (confirm('¿Está seguro de eliminar este impuesto?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="eliminar.php?";
	variables="codigo_ii="+codigo;
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "sin_permiso"){
					buscar_ii()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------PERCECPCION IVA-------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function poner_foco_pi(){
	document.frm.nombre.focus();	
}

//--------------------------------------------------------------------------------------------------//
function pasar_foco_pi_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.nombre.value.length > 0  ) {
                document.frm.tasa.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_pi_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.tasa.value > 0  ) {
                document.frm.enviar.click()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function registrar_pi(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");
	var txtnombre = document.getElementById("nombre");
	var txttasa = document.getElementById("tasa");

	if(document.frm.nombre.value != ""){
	  if(document.frm.tasa.value != ""){
			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
			boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
			txtnombre.disabled=true; 
			txttasa.disabled=true; 
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
    		url="alta_perc_iva.php?";
			variables="nombre="+txtnombre.value+"&tasa="+txttasa.value;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					txtnombre.value="";				// Borro el contenido del input
					txttasa.value="";			// Borro el contenido del input
					boton.disabled=false; 		// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					txttasa.disabled=false; 
					divMensaje.innerHTML=ajax.responseText; // imprime la salida
					buscar_pi()
					//document.frm.nombre.focus()
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
      }else{
		divMensaje.innerHTML="Debe ingresar la tasa del impuesto";
		document.frm.porc_vta.focus()
 	  }
    }else{
		divMensaje.innerHTML="Debe ingresar el nombre del impuesto";
		document.frm.nombre.focus()
 	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_pi_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function buscar_pi(){
	var divMensaje_mod=document.getElementById("msg");			// asigna los aobjetos a las variables
	//var divMensaje=document.getElementById("mensaje"); 
 	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
 	var txtnombre = document.getElementById("nombre");
	
	//divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	//divMensaje.innerHTML="Buscando.......";						// mensajes en el div
	divMensaje_mod.innerHTML="";
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_pi_proceso.php?";
	if(document.frm.nombre.value == ""){
		variables="nombre=todos";
	}
	else{
		variables="nombre="+txtnombre.value;
	}
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_pi(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_pi_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					document.frm_mod.nombre_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function pasar_foco_pi_4(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.tasa_mod.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_pi_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.tasa_mod.value > 0  ) {
                document.frm_mod.enviar_mod.click()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function modificar_pi_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
 	var txtcodigo = document.getElementById("oculto_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var txttasa = document.getElementById("tasa_mod");
	var ajax=nuevoAjax();										// creo una instancia de ajax
 if(document.frm_mod.nombre_mod.value != ""){	
	 if(document.frm_mod.tasa_mod.value != ""){
			divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
			boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
			txtnombre.disabled=true; 
			txttasa.disabled=true; 
			divMensaje.innerHTML="Modificando.......";					// mensajes en el div
			
			metodo="POST";												// asigno las variables de proceso
			url="modificar.php?";
			variables="codigo_pi_mod="+txtcodigo.value+"&nombre_pi_mod="+txtnombre.value+"&tasa_pi_mod="+txttasa.value;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
						if (ajax.responseText == "ok"){
							txtnombre.value="";								// Borro el contenido del input
							boton.disabled=false; 							// Habilito campos y boton nuevamente
							txtnombre.disabled=false; 
							//divlistado.innerHTML="<div class='advertencia'>Impuesto Modificado!!</div>";
							buscar_pi()
						}else{
							divMensaje.innerHTML = "ERROR: El Impuesto ya existe!!";
							boton.disabled=false; 							// Habilito campos y boton nuevamente
							txtnombre.disabled=false; 
							txttasa.disabled=false;
							document.frm_mod.nombre_mod.focus()
						}
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
	 }else{
		divMensaje.innerHTML="Debe ingresar la tasa del Impuesto";
		document.frm_mod.nombre_mod.focus()
 	 }	
 }else{
	divMensaje.innerHTML="Debe ingresar el nombre del Impuesto";
	document.frm_mod.nombre_mod.focus()
 }	
}
//--------------------------------------------------------------------------------------------------//
function eliminar_pi(codigo){
 if (confirm('¿Está seguro de eliminar este impuesto?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="eliminar.php?";
	variables="codigo_pi="+codigo;
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "sin_permiso"){
					buscar_pi()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------INGRESO BRUTO---------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function poner_foco_ib(){
	var contenedor=document.getElementById("provincias"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_provincias.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.nombre.focus();	
						buscar_ib();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function pasar_foco_ib_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.nombre.value.length > 0  ) {
                document.frm.tasa.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_ib_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.tasa.value > 0  ) {
                document.frm.lista_prov.focus()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function registrar_ib(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");
	var txtnombre = document.getElementById("nombre");
	var txttasa = document.getElementById("tasa");
	var txtlistaprov = document.getElementById("lista_prov");

	if(document.frm.nombre.value != ""){
	  if(document.frm.tasa.value != ""){
			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
			boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
			txtnombre.disabled=true; 
			txttasa.disabled=true; 
			txtlistaprov.disabled=true; 
			
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
    		url="alta_ing_bruto.php?";
			variables="nombre="+txtnombre.value+"&tasa="+txttasa.value+"&provincia="+txtlistaprov.value;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					txtnombre.value="";				// Borro el contenido del input
					txttasa.value="";			// Borro el contenido del input
					boton.disabled=false; 		// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					txttasa.disabled=false; 
					txtlistaprov.disabled=false; 

					divMensaje.innerHTML=ajax.responseText; // imprime la salida
					buscar_ib()
					//document.frm.nombre.focus()
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
      }else{
		divMensaje.innerHTML="Debe ingresar la tasa del impuesto";
		document.frm.porc_vta.focus()
 	  }
    }else{
		divMensaje.innerHTML="Debe ingresar el nombre del impuesto";
		document.frm.nombre.focus()
 	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_ib_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function buscar_ib(){
	var divMensaje_mod=document.getElementById("msg");			// asigna los aobjetos a las variables
	//var divMensaje=document.getElementById("mensaje"); 
 	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
 	var txtnombre = document.getElementById("nombre");
	
	//divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	//divMensaje.innerHTML="Buscando.......";						// mensajes en el div
	divMensaje_mod.innerHTML="";
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_ib_proceso.php?";
	if(document.frm.nombre.value == ""){
		variables="nombre=todos";
	}
	else{
		variables="nombre="+txtnombre.value;
	}
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function listar_prov_ib(codigo){
	var contenedor=document.getElementById("localidades"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_prov_de_ib.php?";
	variables = "cod_ib="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function modificar_ib(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_ib_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					document.frm_mod.nombre_mod.focus();
					listar_prov_ib(codigo);
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function pasar_foco_ib_4(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.tasa_mod.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_ib_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.tasa_mod.value > 0  ) {
                document.frm_mod.lista_prov_mod.focus()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function modificar_ib_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
 	var txtcodigo = document.getElementById("oculto_mod"); 
	var txtnombre = document.getElementById("nombre_mod");
	var txttasa = document.getElementById("tasa_mod");
	var txtprovincia = document.getElementById("lista_prov_mod");
	
	if(document.frm_mod.nombre_mod.value != ""){	
		 if(document.frm_mod.tasa_mod.value != ""){
				var ajax=nuevoAjax();										// creo una instancia de ajax
	
				divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
				boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
				txtnombre.disabled=true; 
				txttasa.disabled=true; 
				txtprovincia.disabled=true; 
				
				divMensaje.innerHTML="Modificando.......";					// mensajes en el div
				
				metodo="POST";												// asigno las variables de proceso
				url="modificar.php?";
				variables="codigo_ib_mod="+txtcodigo.value+"&nombre_ib_mod="+txtnombre.value+"&tasa_ib_mod="+txttasa.value+"&prov_ib_mod="+txtprovincia.value;
				ajax.open(metodo, url, true);
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send(variables);
				ajax.onreadystatechange=function(){ 
						if (ajax.readyState==4){
							if (ajax.responseText == "ok"){
								txtnombre.value="";								// Borro el contenido del input
								boton.disabled=false; 							// Habilito campos y boton nuevamente
								txtnombre.disabled=false; 
								txtprovincia.disabled=false; 
								//divlistado.innerHTML="<div class='advertencia'>Impuesto Modificado!!</div>";
								buscar_ib()
							}else{
								divMensaje.innerHTML = "ERROR: El Impuesto ya existe!!";
								boton.disabled=false; 							// Habilito campos y boton nuevamente
								txtnombre.disabled=false; 
								txttasa.disabled=false;
								document.frm_mod.nombre_mod.focus()
							}
						} // fin de if (ajax.readyState==4)
					} // fin de funcion()
		 }else{
			divMensaje.innerHTML="Debe ingresar la tasa del Impuesto";
			document.frm_mod.nombre_mod.focus()
		 }	
	 }else{
		divMensaje.innerHTML="Debe ingresar el nombre del Impuesto";
		document.frm_mod.nombre_mod.focus()
	 }	
}
//--------------------------------------------------------------------------------------------------//
function eliminar_ib(codigo){
 if (confirm('¿Está seguro de eliminar este impuesto?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="eliminar.php?";
	variables="codigo_ib="+codigo;
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "sin_permiso"){
					buscar_ib()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//-------------------------------------CONDICION DE IVA----------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_comp(){
	var contenedor=document.getElementById("comp"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_comprobantes.php";
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
function pasar_foco_cond_iva_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.nombre.value.length > 0  ) {
                document.frm.lista_comp.focus()
                return 0;		  
			}	  
	}
}
function pasar_foco_cond_iva_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var lista_comp = document.frm.lista_comp.options[document.frm.lista_comp.selectedIndex].text;
	if ( tecla==13 && lista_comp != " "){
                document.frm.req_cuit.focus()
                return 0;		  
     }
}
function pasar_foco_cond_iva_3(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.req_cuit.value.length > 0  ) {
                document.frm.enviar.click()
                return 0;		  
			}	  
	}
}

//--------------------------------------------------------------------------------------------------//
function registrar_cond_iva(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");
	//var txtnombre = document.getElementById("nombre");
	
	var idnombre = document.frm.nombre.options[document.frm.nombre.selectedIndex].value;
	var txtnombre = document.frm.nombre.options[document.frm.nombre.selectedIndex].text
	var lista_comp = document.frm.lista_comp.options[document.frm.lista_comp.selectedIndex].value;
	var txtreq_cuit = document.frm.req_cuit.options[document.frm.req_cuit.selectedIndex].value;
	
	if(document.frm.nombre.value != ""){
	  if(lista_comp != " "){
			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
			boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
			document.frm.nombre.disabled=true; 
			document.frm.lista_comp.disabled=true; 
			document.frm.req_cuit.disabled=true; 
			
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
    		url="alta_condicion_iva.php?";
			variables="idnombre="+idnombre+"&nombre="+txtnombre+"&comp="+lista_comp+"&requiere_cuit="+txtreq_cuit;
			//alert(variables);
			
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					txtnombre.value="";						// Borro el contenido del input
					boton.disabled=false; 				    // habilito el boton y los input
					document.frm.nombre.disabled=false; 
					document.frm.lista_comp.disabled=false; 
					document.frm.req_cuit.disabled=false; 
					divMensaje.innerHTML=ajax.responseText; // imprime la salida
					document.frm.nombre.focus()
					listar_comp();
					buscar_cond_iva()
					//document.frm.nombre.focus()
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
			
      }else{
		divMensaje.innerHTML="Debe ingresar el Comprobante";
		document.frm.lista_comp.focus()
 	  }
    }else{
		divMensaje.innerHTML="Debe ingresar el nombre de la Condición de IVA";
		document.frm.nombre.focus()
 	}
}
//--------------------------------------------------------------------------------------------------//
function buscar_cond_iva(){
 	var divlistado=document.getElementById("listado"); 

	//divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_cond_iva_proceso.php?";
	variables="nombre=todos";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_cond_iva2(){
	var divMensaje=document.getElementById("mensaje"); 
 	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
 	var txtnombre = document.getElementById("nombre");
	var lista_comp = document.frm.lista_comp.options[document.frm.lista_comp.selectedIndex].value;

	//divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	//divMensaje.innerHTML="Buscando.......";						// mensajes en el div
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_cond_iva_proceso.php?";
	if(document.frm.nombre.value == "" && lista_comp == "TODOS"){
		variables="nombre=todos";
	}
	else{
		variables="nombre="+txtnombre.value+"&comp="+lista_comp;
	}
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				listar_comp_buscar();
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_comp_cond_iva(codigo){
	var contenedor=document.getElementById("comp_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_comp_cond_iva.php?";
	variables = "cod_cond_iva="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function mostrar_requiere_cuit(codigo){
	var contenedor=document.getElementById("req_cuit_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_cuit_cond_iva_mod.php?";
	variables = "codigo="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_nombre_cond_iva(codigo){
	var contenedor=document.getElementById("nomb_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_nombre_cond_iva.php?";
	variables = "codigo="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm_mod.nombre_mod.focus();
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//

function modificar_cond_iva(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_cond_iva_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					listar_nombre_cond_iva(codigo);
					listar_comp_cond_iva(codigo);
					mostrar_requiere_cuit(codigo);
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_cond_iva_4(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.lista_comp_mod.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_cond_iva_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var lista_comp_mod = document.frm_mod.lista_comp_mod.options[document.frm_mod.lista_comp_mod.selectedIndex].text;
	if ( tecla==13 && lista_comp_mod != " "){
                document.frm_mod.req_cuit_mod.focus()
                return 0;		  
     }
}
function pasar_foco_cond_iva_5a(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.req_cuit_mod.value.length > 0  ) {
                document.frm_mod.enviar_mod.click()
                return 0;		  
			}	  
	}
}
//-----------------------BUSCAR---------------------------------------------------------------------//
function pasar_foco_cond_iva_6(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.nombre.value.length == 0  ) {
                document.frm.lista_comp.focus()
			}else{
				document.frm.enviar.click()
			}
		    return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_cond_iva_7(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var lista_comp = document.frm.lista_comp.options[document.frm.lista_comp.selectedIndex].text;
	if ( tecla==13 && lista_comp != " "){
                document.frm.enviar.click()
                return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function modificar_cond_iva_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
 	var cancelar=document.getElementById("cancelar_mod");
	var txtcodigo = document.getElementById("oculto_mod");
	var txtnombre = document.getElementById("nombre_mod");

	var idnombre = document.frm_mod.nombre_mod.options[document.frm_mod.nombre_mod.selectedIndex].value;
	var txtnombre = document.frm_mod.nombre_mod.options[document.frm_mod.nombre_mod.selectedIndex].text
	var lista_comp_mod = document.frm_mod.lista_comp_mod.options[document.frm_mod.lista_comp_mod.selectedIndex].value;
	var txtreq_cuit = document.frm_mod.req_cuit_mod.options[document.frm_mod.req_cuit_mod.selectedIndex].value;

	
	var ajax=nuevoAjax();										// creo una instancia de ajax
 if(document.frm_mod.nombre_mod.value != ""){	
	 if(lista_comp_mod != " "){
			divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
			boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
			cancelar.disabled=true; 
			
			document.frm_mod.nombre_mod.disabled=true; 
			document.frm_mod.lista_comp_mod.disabled=true; 
			document.frm_mod.req_cuit_mod.disabled=true; 
			
			divMensaje.innerHTML="Modificando.......";					// mensajes en el div
			
			metodo="POST";												// asigno las variables de proceso
			url="modificar.php?";
			variables="codigo_cond_iva_mod="+txtcodigo.value+"&idnombre="+idnombre+"&nombre_cond_iva_mod="+txtnombre+"&cod_comp_mod="+lista_comp_mod+"&requiere_cuit="+txtreq_cuit;
			//alert(variables);
			
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
						if (ajax.responseText == "ok"){
							//divlistado.innerHTML="<div class='advertencia'>Impuesto Modificado!!</div>";
							buscar_cond_iva()
							
						}else{
							divlistado.innerHTML=ajax.responseText; 	// imprime la salida
							//divMensaje.innerHTML = "ERROR: La Condición de IVA ya existe!!";
							boton.disabled=false; 							// Habilito campos y boton nuevamente
							cancelar.disabled=false; 
							txtnombre.disabled=false; 
							document.frm_mod.lista_comp_mod.disabled=false;
							document.frm_mod.nombre_mod.focus()
						}
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
				
	 }else{
		divMensaje.innerHTML="Debe ingresar el Comprobante";
		document.frm_mod.lista_comp_mod.focus()
 	 }	
 }else{
	divMensaje.innerHTML="Debe ingresar el nombre de la Condición de IVA";
	document.frm_mod.nombre_mod.focus()
 }	
}
/*
//--------------------------------------------------------------------------------------------------//
function eliminar_cond_iva(codigo){
 if (confirm('¿Está seguro de eliminar este impuesto?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="eliminar.php?";
	variables="codigo_iva="+codigo;
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				buscar_iva()
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}
*/
//--------------------------------------------------------------------------------------------------//
function listar_comp_buscar(){
	var contenedor=document.getElementById("comp"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_comp_buscar.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.codigo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------PROVEEDORES-----------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------------------------------------------------------------//
function pasar_foco_prove_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.codigo.value.length > 0  ) {
                document.frm.razon.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_prove_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.razon.value.length > 0  ) {
                document.frm.lista_iva.focus()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_prove_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm.cuit1.value.length == 2  ) {
                document.frm.cuit2.focus()
                return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_prove_4(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm.cuit2.value.length == 8  ) {
                document.frm.cuit3.focus()
                return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_prove_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm.cuit3.value.length == 1  ) {
                document.frm.ing_bruto.focus()
                return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_prove_6(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
				document.frm.direccion.focus()
				return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_prove_7(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txtiva = document.forms[0].lista_iva.options[document.forms[0].lista_iva.selectedIndex].text;
	if ( tecla==13 && txtiva != " "){
					document.forms[0].cuit1.focus()
					return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_prove_8(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.direccion.value != "") {
					document.frm.lista_pais.focus()
					return 0;		  
		}
	}
}
function pasar_foco_prove_9(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.forms[0].tel.focus()
					return 0;		  
	}
}
function pasar_foco_prove_10(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.tel.value != "") {
					document.frm.fax.focus()
					return 0;
		}
	}
}
function pasar_foco_prove_11(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.cel.focus()
					return 0;
	}
}
function pasar_foco_prove_12(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.web.focus()
					return 0;
	}
}
function pasar_foco_prove_13(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.mail.focus()
					return 0;
	}
}
function pasar_foco_prove_14(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.contacto.focus()
					return 0;
	}
}
function pasar_foco_prove_15(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.lim_cred.focus()
					return 0;
	}
}
function pasar_foco_prove_16(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.agente.focus()
					return 0;
	}
}
function pasar_foco_prove_17(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.enviar.click()
					return 0;
	}
}
//--------------------buscar------------------------------//
function pasar_foco_prove_18(e){
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
function pasar_foco_prove_19(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13  && document.frm.cuit1.value == "" && document.frm.cuit2.value == "" && document.frm.cuit2.value == ""){
				document.frm.enviar.click()
                return 0;	
	}else{
				if( document.frm.cuit1.value.length == 2  ) {
                	document.frm.cuit2.focus()
                	return 0;		  
				}
	}
}
function pasar_foco_prove_20(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm.cuit2.value.length == 8  ) {
                document.frm.cuit3.focus()
                return 0;		  
	}
}
function pasar_foco_prove_21(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( tecla==13  && document.frm.cuit3.value.length == 1  ) {
                document.frm.enviar.click()
                return 0;		  
	}
}
function pasar_foco_prove_22(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( tecla==13 ) {
			if(document.frm.razon.value == ""){
					document.frm.cuit1.focus()
			}else{
					document.frm.enviar.click()				
			}
			return 0;
	}
}
//-------------------MODIFICAR--------------------------------//
function pasar_foco_prove_23(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.codigo_mod.value.length > 0  ) {
                document.frm_mod.razon_mod.focus()
                return 0;		  
			}	  
	}
}
function pasar_foco_prove_24(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.razon_mod.value.length > 0  ) {
                document.frm_mod.lista_iva_mod.focus()
                return 0;		  
			}
     }
}
function pasar_foco_prove_25(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm_mod.cuit1_mod.value.length == 2  ) {
                document.frm_mod.cuit2_mod.focus()
                return 0;		  
	}
}
function pasar_foco_prove_26(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm_mod.cuit2_mod.value.length == 8  ) {
                document.frm_mod.cuit3_mod.focus()
                return 0;		  
	}
}

function pasar_foco_prove_27(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm_mod.cuit3_mod.value.length == 1  ) {
                document.frm_mod.ing_bruto_mod.focus()
                return 0;		  
	}
}
function pasar_foco_prove_28(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
				document.frm_mod.direccion_mod.focus()
				return 0;		  
	}
}

function pasar_foco_prove_29(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.cuit1_mod.focus()
					return 0;		  
	}
}
function pasar_foco_prove_30(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm_mod.direccion_mod.value != "") {
					document.frm_mod.lista_pais_mod.focus()
					return 0;		  
		}
	}
}
function pasar_foco_prove_31(e,cod_pais){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){	
			var contenedor=document.getElementById("provincias_mod"); 
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="listar_prov_de_proveedor.php?";
			variables = "cod_pais="+cod_pais;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm_mod.lista_prov_mod.focus()
					} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
}
function pasar_foco_prove_32(e,cod_prov){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	
	if ( tecla==13 && cod_prov){	
			var contenedor=document.getElementById("localidades_mod"); 
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="listar_loca_de_proveedor.php?";
			variables = "cod_prov="+cod_prov;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm_mod.lista_loca_mod.focus()
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
	}
}
function pasar_foco_prove_33(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txtloca = document.frm_mod.lista_loca_mod.options[document.frm_mod.lista_loca_mod.selectedIndex].text;
	if ( tecla==13 && txtloca){
					document.frm_mod.tel_mod.focus()
					return 0;		  
	}
}

function pasar_foco_prove_34(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm_mod.tel_mod.value != "") {
					document.frm_mod.fax_mod.focus()
					return 0;
		}
	}
}
function pasar_foco_prove_35(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.cel_mod.focus()
					return 0;
	}
}
function pasar_foco_prove_36(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.web_mod.focus()
					return 0;
	}
}
function pasar_foco_prove_37(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.mail_mod.focus()
					return 0;
	}
}
function pasar_foco_prove_38(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.contacto_mod.focus()
					return 0;
	}
}
function pasar_foco_prove_39(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.lim_cred_mod.focus()
					return 0;
	}
}
function pasar_foco_prove_40(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.agente_mod.focus()
					return 0;
	}
}
function pasar_foco_prove_41(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.enviar_mod.click()
					return 0;
	}
}
//--------------------------------------------------------------------------------------------------//
function listar_iva(){
	var contenedor=document.getElementById("iva"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_iva.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
/*************************************************************************************************************************************/
//--------------------------PARA USAR EN LAS PAGINAS DONDE USAN PAISES PROVINCIAS Y LOCALIDADES--------------------------------------//
/*************************************************************************************************************************************/
function listar_paises(){
	var contenedor=document.getElementById("paises"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_pais.php";
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
function listar_provincias(){
	var contenedor=document.getElementById("provincias"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_provincia.php";
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
function listar_localidades(){
	var contenedor=document.getElementById("localidades"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_localidades.php";
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
function listar_zonas(){
	var contenedor=document.getElementById("zonas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_zonas.php";
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
function listar_prov_de_pais(e,cod_pais){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){	
			var contenedor=document.getElementById("provincias"); 
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="select_provincia.php?";
			variables = "cod_pais="+cod_pais;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.forms[0].lista_provincia.focus()
					} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
}
//--------------------------------------------------------------------------------------------------//
function listar_loca_de_prov(e,cod_prov){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){	
			var contenedor=document.getElementById("localidades"); 
			if (document.getElementById("zonas")){
					url="select_localidades_clie.php?";
			}else{
					url="select_localidades.php?";
			}
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			variables = "cod_prov="+cod_prov;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.forms[0].lista_loca.focus()
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
	}
}
//--------------------------------------------------------------------------------------------------//
function listar_zona_de_loca(e,cod_loca){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){	
			var contenedor=document.getElementById("zonas"); 
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="select_zonas.php?";
			variables = "cod_loca="+cod_loca;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm.lista_zona.focus()
					} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
}
/*************************************************************************************************************************************/
//--------------------------FIN DE PARA USAR EN LAS PAGINAS DONDE USAN PAISES PROVINCIAS Y LOCALIDADES-------------------------------//
/*************************************************************************************************************************************/

function registrar_proveedor(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");

	var txtcodigo = document.getElementById("codigo");
	var txtrazon = document.getElementById("razon");
	var txtcuit1 = document.getElementById("cuit1");
	var txtcuit2 = document.getElementById("cuit2");
	var txtcuit3 = document.getElementById("cuit3");
	var txting_bruto = document.getElementById("ing_bruto");
 	var txtiva = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].value;
	var txtdir = document.getElementById("direccion");
	var txtpais = document.frm.lista_pais.options[document.frm.lista_pais.selectedIndex].text;
 	var txtprov = document.frm.lista_provincia.options[document.frm.lista_provincia.selectedIndex].text;
 	var txtloca = document.frm.lista_loca.options[document.frm.lista_loca.selectedIndex].text;
	var txttel = document.getElementById("tel");
	var txtfax = document.getElementById("fax");
	var txtcel = document.getElementById("cel");
	var txtweb = document.getElementById("web");
	var txtmail = document.getElementById("mail");
	var txtcontacto = document.getElementById("contacto");
	var txtlim_cred = document.getElementById("lim_cred");
	if(	document.frm.agente.checked == true){
		var txtagente = "S";
	}else{
		var txtagente = "N";
	}
	if(txtcodigo.value != ""){
		if(txtrazon.value != ""){
			if(txtcuit1.value.length == 2){
				if(txtcuit2.value.length == 8){	
					if(txtcuit3.value.length == 1){
						cuit=txtcuit1.value+txtcuit2.value+txtcuit3.value;
						validar_cuit(cuit);					// valida el CUIT ingrsado
						if(error == ""){
							if(txtiva != ""){	
								if(txtdir.value != ""){
									if(txtprov != "-- seleccione pais --"){
										if(txtloca != "-- seleccione provincia --"){
											if(txttel.value != ""){
														divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
														boton.disabled=true; 				    // Deshabilito el boton y los input
														txtcodigo.disabled=true; 
														txtrazon.disabled=true; 
														txtcuit1.disabled=true; 
														txtcuit2.disabled=true; 
														txtcuit3.disabled=true; 
														txting_bruto.disabled=true; 
														txtiva.disabled=true; 
														txtdir.disabled=true; 
														txtpais.disabled=true; 
														txtprov.disabled=true; 
														txtloca.disabled=true; 
														txttel.disabled=true; 
														txtfax.disabled=true; 
														txtcel.disabled=true; 
														txtweb.disabled=true; 
														txtmail.disabled=true; 
														txtcontacto.disabled=true; 
														txtlim_cred.disabled=true; 
														document.frm.agente.disabled = true;
														divMensaje.innerHTML="Buscando......."; // mensajes en el div
														var ajax=nuevoAjax();					// creo una instancia de ajax
														metodo="POST";							// asigno las variables de proceso
														url="alta_proveedor.php?";
														var cuit = txtcuit1.value+txtcuit2.value+txtcuit3.value;
														variables="codigo="+txtcodigo.value+"&razon="+txtrazon.value+"&cuit="+cuit+"&ing_bruto="+txting_bruto.value+"&iva="+txtiva+"&dir="+txtdir.value+"&pais="+txtpais+"&prov="+txtprov+"&localidad="+txtloca+"&tel="+txttel.value+"&fax="+txtfax.value+"&cel="+txtcel.value+"&web="+txtweb.value+"&mail="+txtmail.value+"&contacto="+txtcontacto.value+"&lim_cred="+txtlim_cred.value+"&agente="+txtagente;
														ajax.open(metodo, url, true);
														ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
														ajax.send(variables);
														
														ajax.onreadystatechange=function(){ 
															if (ajax.readyState==4){
																txtcodigo.value="";				// Borro el contenido del input
																txtrazon.value="";				// Borro el contenido del input
																txtcuit1.value="";				// Borro el contenido del input
																txtcuit2.value="";				// Borro el contenido del input
																txtcuit3.value="";				// Borro el contenido del input
																txting_bruto.value="";			// Borro el contenido del input
																txtdir.value="";				// Borro el contenido del input
																txttel.value="";				// Borro el contenido del input
																txtfax.value="";				// Borro el contenido del input
																txtcel.value="";				// Borro el contenido del input
																txtweb.value="";				// Borro el contenido del input
																txtmail.value="";				// Borro el contenido del input
																txtcontacto.value="";			// Borro el contenido del input
																txtlim_cred.value="";			// Borro el contenido del input
																document.frm.agente.checked = false;
	
																txtcodigo.disabled=false; 		// habilito el boton y los input
																txtrazon.disabled=false; 
																txtcuit1.disabled=false; 
																txtcuit2.disabled=false; 
																txtcuit3.disabled=false; 
																txting_bruto.disabled=false; 
																txtiva.disabled=false; 
																txtdir.disabled=false; 
																txtpais.disabled=false; 
																txtprov.disabled=false; 
																txtloca.disabled=false; 
																txttel.disabled=false; 
																txtfax.disabled=false; 
																txtcel.disabled=false; 
																txtweb.disabled=false; 
																txtmail.disabled=false; 
																txtcontacto.disabled=false; 
																txtlim_cred.disabled=false; 
																document.frm.agente.disabled = false;
																boton.disabled=false; 				// Habilito boton nuevamente
																divMensaje.innerHTML=ajax.responseText; // imprime la salida
																document.frm.codigo.focus();
																listar_iva();
																listar_paises();
																listar_provincias();
																listar_localidades();
																buscar_proveedor()
																//document.frm.codigo.focus()
															} // fin de if (ajax.readyState==4)
														} // fin de funcion()
											}else{
												divMensaje.innerHTML="Debe ingresar el Telefono";
												document.frm.tel.focus()
											}
										}else{
											divMensaje.innerHTML="Debe seleccionar una Provincia";
											document.frm.lista_provincia.focus()
										}	 
									}else{
										divMensaje.innerHTML="Debe seleccionar un Pais";
										document.frm.lista_pais.focus()
									}		 
								}else{
									divMensaje.innerHTML="Debe ingresar la Dirección";
									document.frm.direccion.focus()
								}	
							}else{
									divMensaje.innerHTML="Debe ingresar la condición de IVA";
									document.frm.lista_iva.focus()
							}
						}else{
							divMensaje.innerHTML=error;
							document.frm.cuit1.focus()
						}
					}else{
						divMensaje.innerHTML="Debe ingresar el CUIT";
						document.frm.cuit3.focus()
					}
				}else{
					divMensaje.innerHTML="Debe ingresar el CUIT";
					document.frm.cuit2.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar el CUIT";
				document.frm.cuit1.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar la Razon Social";
			document.frm.razon.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo";
		document.frm.codigo.focus()
	}
}
//--------------------------------------------------------------------------------------------------//
function buscar_proveedor(){
	
	//var divMensaje_mod=document.getElementById("msg");			// asigna los aobjetos a las variables
	//var divMensaje=document.getElementById("mensaje"); 
 	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
 	var txtcodigo = document.getElementById("codigo");
	var txtcuit1 = document.getElementById("cuit1");
	var txtcuit2 = document.getElementById("cuit2");
	var txtcuit3 = document.getElementById("cuit3");
	var txtrazon = document.getElementById("razon");
		
	//divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtcodigo.disabled=true; 
	txtcuit1.disabled=true; 
	txtcuit2.disabled=true; 
	txtcuit3.disabled=true; 
	txtrazon.disabled=true; 
	
	//divMensaje.innerHTML="Buscando.......";						// mensajes en el div
	//divMensaje_mod.innerHTML="";
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_proveedor_proceso.php?";
	
	var cuit = txtcuit1.value+txtcuit2.value+txtcuit3.value;
	
	if((txtcodigo.value == "") && (cuit == "") && (txtrazon.value == "")){
		variables="nombre=TODOS";
	}else{
		variables="codigo="+txtcodigo.value+"&cuit="+cuit+"&razon="+txtrazon.value;
	}

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtcodigo.value="";								// Borro el contenido del input
				txtcuit1.value="";								// Borro el contenido del input
				txtcuit2.value="";								// Borro el contenido del input
				txtcuit3.value="";								// Borro el contenido del input
				txtrazon.value="";								// Borro el contenido del input
			
				boton.disabled=false; 										// Deshabilito el boton y el input para evitar dobles ingresos
				txtcodigo.disabled=false; 
				txtcuit1.disabled=false; 
				txtcuit2.disabled=false; 
				txtcuit3.disabled=false; 
				txtrazon.disabled=false; 

				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.codigo.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_iva_proveedor(codigo){
	var contenedor=document.getElementById("iva_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_iva_de_proveedor.php?";
	variables = "cod_proveedor="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_pais_proveedor(codigo){
	var contenedor=document.getElementById("paises_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_pais_de_proveedor.php?";
	variables = "cod_proveedor="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_prov_proveedor(codigo){
	var contenedor=document.getElementById("provincias_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_prov_de_proveedor.php?";
	variables = "cod_proveedor="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_loca_proveedor(codigo){
	var contenedor=document.getElementById("localidades_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_loca_de_proveedor.php?";
	variables = "cod_proveedor="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_proveedor(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_proveedor="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					listar_iva_proveedor(cod);
					listar_pais_proveedor(cod);
					listar_prov_proveedor(cod);
					listar_loca_proveedor(cod);
					document.frm_mod.codigo_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
				
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_proveedor_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
	var boton_cancel=document.getElementById("cancelar_mod");
	
	var txtcodigo_original = document.getElementById("oculto_mod");
	var txtcodigo = document.getElementById("codigo_mod");
	var txtrazon = document.getElementById("razon_mod");
	var txtcuit1 = document.getElementById("cuit1_mod");
	var txtcuit2 = document.getElementById("cuit2_mod");
	var txtcuit3 = document.getElementById("cuit3_mod");
	var txting_bruto = document.getElementById("ing_bruto_mod");
 	var txtiva = document.frm_mod.lista_iva_mod.options[document.frm_mod.lista_iva_mod.selectedIndex].value;
	var txtdir = document.getElementById("direccion_mod");
	var txtpais = document.frm_mod.lista_pais_mod.options[document.frm_mod.lista_pais_mod.selectedIndex].text;
 	var txtprov = document.frm_mod.lista_prov_mod.options[document.frm_mod.lista_prov_mod.selectedIndex].text;
 	var txtloca = document.frm_mod.lista_loca_mod.options[document.frm_mod.lista_loca_mod.selectedIndex].text;
	var txttel = document.getElementById("tel_mod");
	var txtfax = document.getElementById("fax_mod");
	var txtcel = document.getElementById("cel_mod");
	var txtweb = document.getElementById("web_mod");
	var txtmail = document.getElementById("mail_mod");
	var txtcontacto = document.getElementById("contacto_mod");
	var txtlim_cred = document.getElementById("lim_cred_mod");
	if(	document.frm_mod.agente_mod.checked == true){
		var txtagente = "S";
	}else{
		var txtagente = "N";
	}
	if(txtcodigo.value != ""){
		if(txtrazon.value != ""){
			if(txtcuit1.value.length == 2){
				if(txtcuit2.value.length == 8){	
					if(txtcuit3.value.length == 1){
						cuit=txtcuit1.value+txtcuit2.value+txtcuit3.value;
						validar_cuit(cuit);					// valida el CUIT ingrsado
						if(error == ""){
							if(txtiva != ""){	
								if(txtdir.value != ""){
									if(txtprov != ""){
										if(txtloca != ""){
											if(txttel.value != ""){
														divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
														boton.disabled=true; 				    // Deshabilito el boton y los input
														boton_cancel.disabled=true;
														txtcodigo.disabled=true; 
														txtrazon.disabled=true; 
														txtcuit1.disabled=true; 
														txtcuit2.disabled=true; 
														txtcuit3.disabled=true; 
														txting_bruto.disabled=true; 
														txtiva.disabled=true; 
														txtdir.disabled=true; 
														txtpais.disabled=true; 
														txtprov.disabled=true; 
														txtloca.disabled=true; 
														txttel.disabled=true; 
														txtfax.disabled=true; 
														txtcel.disabled=true; 
														txtweb.disabled=true; 
														txtmail.disabled=true; 
														txtcontacto.disabled=true; 
														txtlim_cred.disabled=true; 
														document.frm_mod.agente_mod.disabled = true;
														divMensaje.innerHTML="Modificando.......";					// mensajes en el div
														var ajax=nuevoAjax();					// creo una instancia de ajax
														metodo="POST";												// asigno las variables de proceso
														url="modificar.php?";
														var cuit = txtcuit1.value+txtcuit2.value+txtcuit3.value;
														variables="codigo_original="+txtcodigo_original.value+"&codigo_proveedor_mod="+txtcodigo.value+"&razon_proveedor_mod="+txtrazon.value+"&cuit_proveedor_mod="+cuit+"&ing_bruto_proveedor_mod="+txting_bruto.value+"&iva_proveedor_mod="+txtiva+"&dir_proveedor_mod="+txtdir.value+"&pais_proveedor_mod="+txtpais+"&prov_proveedor_mod="+txtprov+"&localidad_proveedor_mod="+txtloca+"&tel_proveedor_mod="+txttel.value+"&fax_proveedor_mod="+txtfax.value+"&cel_proveedor_mod="+txtcel.value+"&web_proveedor_mod="+txtweb.value+"&mail_proveedor_mod="+txtmail.value+"&contacto_proveedor_mod="+txtcontacto.value+"&lim_cred_proveedor_mod="+txtlim_cred.value+"&agente_proveedor_mod="+txtagente;
														ajax.open(metodo, url, true);
														ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
														ajax.send(variables);
														
														ajax.onreadystatechange=function(){ 
															if (ajax.readyState==4){
																if (ajax.responseText == "ok"){
																					buscar_proveedor()
																					
																		}else{
																					divMensaje.innerHTML = "ERROR: El Proveedor ya existe!!";
																					txtcodigo.disabled=false;
																					txtcuit1.disabled=false; 
																					txtcuit2.disabled=false; 
																					txtcuit3.disabled=false; 
																					txting_bruto.disabled=false; 
																					txtiva.disabled=false; 
																					txtdir.disabled=false; 
																					txtpais.disabled=false; 
																					txtprov.disabled=false; 
																					txtloca.disabled=false; 
																					txttel.disabled=false; 
																					txtfax.disabled=false; 
																					txtcel.disabled=false; 
																					txtweb.disabled=false; 
																					txtmail.disabled=false; 
																					txtcontacto.disabled=false; 
																					txtlim_cred.disabled=false; 
																					document.frm_mod.agente_mod.disabled = false;
																					boton.disabled=false; 				// Habilito boton nuevamente
																					boton_cancel.disabled=false;
	
																					document.frm_mod.codigo_mod.focus()
																		}
																//document.frm.codigo.focus()
															} // fin de if (ajax.readyState==4)
														} // fin de funcion()
											}else{
												divMensaje.innerHTML="Debe ingresar el Telefono";
												document.frm_mod.tel_mod.focus()
											}
										}else{
											divMensaje.innerHTML="No existen Localidades en esta Provincia";
											document.frm_mod.lista_provincia_mod.focus()
										}	 
									}else{
										divMensaje.innerHTML="No existen Provincias en este Pais";
										document.frm_mod.lista_pais_mod.focus()
									}		 
								}else{
									divMensaje.innerHTML="Debe ingresar la Dirección";
									document.frm_mod.direccion_mod.focus()
								}	
							}else{
									divMensaje.innerHTML="Debe ingresar la condición de IVA";
									document.frm_mod.lista_iva_mod.focus()
							}	
						}else{
							divMensaje.innerHTML=error;
							document.frm_mod.cuit1_mod.focus()
						}
					}else{
						divMensaje.innerHTML="Debe ingresar el CUIT";
						document.frm_mod.cuit3_mod.focus()
					}
				}else{
					divMensaje.innerHTML="Debe ingresar el CUIT";
					document.frm_mod.cuit2_mod.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar el CUIT";
				document.frm_mod.cuit1_mod.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar la Razon Social";
			document.frm_mod.razon_mod.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo";
		document.frm_mod.codigo_mod.focus()
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------VEHICULOS-------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function poner_foco_vehiculo(){
	document.frm.codigo.focus();	
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_vehi_0(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.codigo.value.length > 0  ) {
                document.frm.patente.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_vehi_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.patente.value.length > 0  ) {
                document.frm.patente_a.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_vehi_2(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.marca.focus()
                return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_vehi_3(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.marca.value.length > 0  ) {
                document.frm.modelo.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_vehi_4(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.modelo.value.length > 0  ) {
                document.frm.propio.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_vehi_5(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
	}
}
//-------------------------MODIFICAR--------------------------------------------------------------//
function pasar_foco_vehi_5a(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.codigo_mod.value.length > 0  ) {
                document.frm_mod.patente_mod.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_vehi_5b(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.patente_mod.value.length > 0  ) {
                document.frm_mod.patente_a_mod.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_vehi_6(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm_mod.marca_mod.focus()
                return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_vehi_7(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.marca_mod.value.length > 0  ) {
                document.frm_mod.modelo_mod.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_vehi_8(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.modelo_mod.value.length > 0  ) {
                document.frm_mod.propio_mod.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_vehi_9(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm_mod.enviar_mod.click()
                return 0;		  
	}
}
//--------------------------------BUSCAR-------------------------------------------------------//
function pasar_foco_vehi_10(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		 if(document.frm.marca.value.length > 0){
			document.frm.enviar.click()
		 }
		 else{
		    document.frm.chofer.focus()
		 }
             
                return 0;		  
	}
}
function pasar_foco_vehi_11(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function registrar_vehiculo(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");

	var txtcodigo = document.getElementById("codigo");
	var txtpatente = document.getElementById("patente");
	var txtpatente_a = document.getElementById("patente_a");
	var txtmarca = document.getElementById("marca");
	var txtmodelo = document.getElementById("modelo");
	if(	document.frm.propio.checked == true){
		var txtpropio = "S";
	}else{
		var txtpropio = "N";
	}
	if(txtcodigo.value != ""){
		if(txtpatente.value != ""){
				if(txtmarca.value.length  != ""){
					if(txtmodelo.value.length  != ""){	
							divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
							boton.disabled=true; 				    // Deshabilito el boton y los input
							txtcodigo.disabled=true; 
							txtpatente.disabled=true; 
							txtpatente_a.disabled=true; 
							txtmarca.disabled=true; 
							txtmodelo.disabled=true;
							document.frm.propio.disabled = true;
							
							divMensaje.innerHTML="Buscando......."; // mensajes en el div
							var ajax=nuevoAjax();					// creo una instancia de ajax
							metodo="POST";							// asigno las variables de proceso
							url="alta_vehiculo.php?";
							variables="codigo="+txtcodigo.value+"&patente="+txtpatente.value+"&patente_a="+txtpatente_a.value+"&marca="+txtmarca.value+"&modelo="+txtmodelo.value+"&propio="+txtpropio;
							
							ajax.open(metodo, url, true);
							ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							ajax.send(variables);
							ajax.onreadystatechange=function(){ 
									if (ajax.readyState==4){
												txtcodigo.value="";				// Borro el contenido del input
												txtpatente.value="";				// Borro el contenido del input
												txtpatente_a.value="";				// Borro el contenido del input
												txtmarca.value="";					// Borro el contenido del input
												txtmodelo.value="";					// Borro el contenido del input
												document.frm.propio.checked = false;
												txtcodigo.disabled=false; 		// habilito el boton y los input
												txtpatente.disabled=false; 		// habilito el boton y los input
												txtpatente_a.disabled=false; 
												txtmarca.disabled=false; 
												txtmodelo.disabled=false; 
												document.frm.propio.disabled = false;
												boton.disabled=false; 				// Habilito boton nuevamente
												divMensaje.innerHTML=ajax.responseText; // imprime la salida
												poner_foco_vehiculo();
												buscar_vehiculo();
										} // fin de if (ajax.readyState==4)
							} // fin de funcion()
				}else{
					divMensaje.innerHTML="Debe ingresar el Modelo";
					document.frm.modelo.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar la Marca";
				document.frm.marca.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar la Patente";
			document.frm.patente.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo";
		document.frm.codigo.focus()
	}	
}
//--------------------------------------------------------------------------------------------------//
function buscar_vehiculo(){
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_vehiculo_proceso.php?";
	variables="nombre=TODOS";

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				//document.frm.codigo.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_vehiculo2(){
	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
	var txtmarca = document.getElementById("marca");
	var txtchofer = document.getElementById("chofer");
		
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtmarca.disabled=true; 
	txtchofer.disabled=true; 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_vehiculo_proceso.php?";

	if((txtmarca.value == "") && (txtchofer.value == "")){
		variables="nombre=TODOS";
	}else{
		variables="marca="+txtmarca.value+"&chofer="+txtchofer.value;
	}

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtmarca.value="";								// Borro el contenido del input
				txtchofer.value="";								// Borro el contenido del input
		
				boton.disabled=false; 										// Deshabilito el boton y el input para evitar dobles ingresos
				txtmarca.disabled=false; 
				txtchofer.disabled=false; 
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.marca.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_vehiculo(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_vehiculo="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					document.frm_mod.codigo_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_vehiculo_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod");			// asigna los aobjetos a las variables
	var boton=document.getElementById("enviar_mod");
	var boton_cancel=document.getElementById("cancelar_mod");
	
	var txtcodigo_mod = document.getElementById("codigo_mod");
	var txtcodigo = document.getElementById("oculto_mod");
	var txtpatente = document.getElementById("patente_mod");
	var txtpatente_a = document.getElementById("patente_a_mod");
	var txtmarca = document.getElementById("marca_mod");
	var txtmodelo = document.getElementById("modelo_mod");
	if(	document.frm_mod.propio_mod.checked == true){
		var txtpropio = "S";
	}else{
		var txtpropio = "N";
	}
	if(txtcodigo_mod.value != ""){	
		if(txtpatente.value != ""){
			if(txtmarca.value.length  != ""){
				if(txtmodelo.value.length  != ""){	
							divMensaje.innerHTML="";						// Limpio posibles mensajes que haya en el div
							boton.disabled=true; 				    		// Deshabilito el boton y los input
							boton_cancel.disabled=true; 				    // Deshabilito el boton y los input
							txtcodigo_mod.disabled=true; 
							txtpatente.disabled=true; 
							txtpatente_a.disabled=true; 
							txtmarca.disabled=true; 
							txtmodelo.disabled=true;
							document.frm_mod.propio_mod.disabled = true;
							
							divMensaje.innerHTML="Modificando.......";					// mensajes en el div
							var ajax=nuevoAjax();										// creo una instancia de ajax
							metodo="POST";												// asigno las variables de proceso
							url="modificar.php?";
							variables="cod_vehiculo_mod_original="+txtcodigo.value+"&cod_vehiculo_mod="+txtcodigo_mod.value+"&patente_mod="+txtpatente.value+"&patente_a_mod="+txtpatente_a.value+"&marca_mod="+txtmarca.value+"&modelo_mod="+txtmodelo.value+"&propio_mod="+txtpropio;
							ajax.open(metodo, url, true);
							ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							ajax.send(variables);
							ajax.onreadystatechange=function(){ 
									if (ajax.readyState==4){
											if (ajax.responseText == "ok"){
													buscar_vehiculo();
													document.frm.codigo.focus();
											 }else{
													//divMensaje.innerHTML=ajax.responseText; // imprime la salida
													divMensaje.innerHTML = "ERROR: El Vehiculo ya existe!!";
													txtcodigo_mod.disabled=false;
													document.frm_mod.codigo_mod.focus()
											}
											boton.disabled=false; 				    // Deshabilito el boton y los input
											boton_cancel.disabled=false; 			// Deshabilito el boton y los input
											txtcodigo_mod.disabled=false; 
											txtpatente.disabled=false; 
											txtpatente_a.disabled=false; 
											txtmarca.disabled=false; 
											txtmodelo.disabled=false;
											document.frm_mod.propio_mod.disabled = false;
											boton.disabled=false; 				// Habilito boton nuevamente
											boton_cancel.disabled=false;
									} // fin de if (ajax.readyState==4)
								} // fin de funcion()
				}else{
					divMensaje.innerHTML="Debe ingresar el Modelo";
					document.frm_mod.modelo_mod.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar la Marca";
				document.frm_mod.marca_mod.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar la Patente";
			document.frm_mod.patente_mod.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo";
		document.frm_mod.codigo_mod.focus()
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------REPARTIDORES----------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_iva_rep(){
	var contenedor=document.getElementById("iva"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_iva_rep.php";
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
function listar_vehiculo_rep(){
	var contenedor=document.getElementById("vehiculos"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_vehiculo_rep.php";
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
function pasar_foco_rep_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.codigo.value.length > 0  ) {
                document.frm.dni.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_rep_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			//if( document.frm.dni.value.length > 0  ) {
                document.frm.nombre.focus()
                return 0;		  
			//}
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_rep_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.nombre.value.length > 0  ) {
                document.frm.direccion.focus()
                return 0;		  
			}
     }
}
function pasar_foco_rep_4(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.direccion.value.length > 0  ) {
                document.frm.lista_pais.focus()
                return 0;		  
			}
     }
}
function pasar_foco_rep_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		//if( document.frm.tel.value.length > 0  ) {
			document.frm.lista_iva.focus()
			return 0;		 
	   //}		
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_rep_6(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.cuit1.value.length == 0 && document.frm.cuit2.value.length == 0 && document.frm.cuit3.value.length == 0  ){
			document.frm.lista_vehiculo.focus();
		}
	}else{	
		if( document.frm.cuit1.value.length == 2  ) {
                document.frm.cuit2.focus()
                return 0;		  
		}
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_rep_7(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm.cuit2.value.length == 8  ) {
                document.frm.cuit3.focus()
                return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_rep_8(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm.cuit3.value.length == 1  ) {
                document.frm.lista_vehiculo.focus()
                return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_rep_9(e){
 	var txtiva = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].id;
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if(txtiva == "S"){	
			document.frm.cuit1.focus();
		}else{
			document.frm.lista_vehiculo.focus();
		}	
			return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_rep_10(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.enviar.click();
			return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_rep_11(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.nombre.value.length > 0  ) {
			document.frm.enviar.click();
		}else{
			document.frm.lista_vehiculo.focus();
		}	
		return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_rep_12(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.enviar.click();
			return 0;

	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_rep_1_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.codigo_mod.value.length > 0  ) {
                document.frm_mod.dni_mod.focus()
                return 0;		  
			}	  
	}
}
function pasar_foco_rep_2_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			//if( document.frm_mod.dni_mod.value.length > 0  ) {
                document.frm_mod.nombre_mod.focus()
                return 0;		  
			//}
     }
}
function pasar_foco_rep_3_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.direccion_mod.focus()
                return 0;		  
			}
     }
}
function pasar_foco_rep_4_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.direccion_mod.value.length > 0  ) {
                document.frm_mod.lista_pais_mod.focus()
                return 0;		  
			}
     }
}
function pasar_foco_rep_5_mod(e,cod_pais){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){	
			var contenedor=document.getElementById("provincias_mod"); 
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="listar_prov_repartidor.php?";
			variables = "cod_pais="+cod_pais;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm_mod.lista_prov_mod.focus()
					} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
}
function pasar_foco_rep_6_mod(e,cod_prov){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 && cod_prov){	
			var contenedor=document.getElementById("localidades_mod"); 
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="listar_loca_repartidor.php?";
			variables = "cod_prov="+cod_prov;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm_mod.lista_loca_mod.focus()
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
	}
}
function pasar_foco_rep_7_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		//if( document.frm_mod.tel_mod.value.length > 0  ) {
			document.frm_mod.lista_iva_mod.focus()
			return 0;		 
	   //}		
	}
}
function pasar_foco_rep_8_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm_mod.cuit1_mod.value.length == 0 && document.frm_mod.cuit2_mod.value.length == 0 && document.frm_mod.cuit3_mod.value.length == 0  ){
			document.frm_mod.lista_vehi_mod.focus();
		}
	}else{	
		if( document.frm_mod.cuit1_mod.value.length == 2  ) {
                document.frm_mod.cuit2_mod.focus()
                return 0;		  
		}
	}
}
function pasar_foco_rep_9_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm_mod.cuit2_mod.value.length == 8  ) {
                document.frm_mod.cuit3_mod.focus()
                return 0;		  
	}
}
function pasar_foco_rep_10_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm_mod.cuit3_mod.value.length == 1  ) {
				document.frm_mod.lista_vehi_mod.focus()
                return 0;		  
	}
}
function pasar_foco_rep_11_mod(e){
 	var txtiva = document.frm_mod.lista_iva_mod.options[document.frm_mod.lista_iva_mod.selectedIndex].id;
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){			
		if(document.frm_mod.cuit1_mod.value.length == 0 && document.frm_mod.cuit2_mod.value.length == 0 && document.frm_mod.cuit3_mod.value.length == 0){
			if(txtiva == "S"){	
				document.frm_mod.cuit1_mod.focus()
			}else{
				document.frm_mod.lista_vehi_mod.focus();
			}	
		}else{
			if(txtiva == "S"){	
				document.frm_mod.cuit1_mod.focus()
			}else{
				document.frm_mod.cuit1_mod.value= "";
				document.frm_mod.cuit2_mod.value= ""; 
				document.frm_mod.cuit3_mod.value= "";
				document.frm_mod.lista_vehi_mod.focus();
			}	
		}
		return 0;		  
	}	
}
function pasar_foco_rep_12_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){			
				document.frm_mod.enviar_mod.click()
                return 0;		  
	}			
}
//--------------------------------------------------------------------------------------------------//
function registrar_repartidor(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");

	var txtcodigo = document.getElementById("codigo");
	var txtdni = document.getElementById("dni");
	var txtnombre = document.getElementById("nombre");
	var txtdir = document.getElementById("direccion");
	var txtpais = document.frm.lista_pais.options[document.frm.lista_pais.selectedIndex].text;
 	var txtprov = document.frm.lista_provincia.options[document.frm.lista_provincia.selectedIndex].text;
 	var txtloca = document.frm.lista_loca.options[document.frm.lista_loca.selectedIndex].text;
	var txttel = document.getElementById("tel");
	var txtcuit1 = document.getElementById("cuit1");
	var txtcuit2 = document.getElementById("cuit2");
	var txtcuit3 = document.getElementById("cuit3");
	var txtiva = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].value;
	var txtvehiculo = document.frm.lista_vehiculo.options[document.frm.lista_vehiculo.selectedIndex].text;

	var iva = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].id;
	if(iva == "N"){	
		var cuit = "";
	}else{
		var cuit = txtcuit1.value+txtcuit2.value+txtcuit3.value;
	}
	
	if(txtcodigo.value != ""){
		if(txtdni.value != ""){
			if(txtnombre.value != ""){
				if(txtdir.value != ""){
					if(txtprov != "-- seleccione pais --"){
						if(txtloca != "-- seleccione provincia --"){
							if(txttel.value != ""){
									divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
									boton.disabled=true; 				    // Deshabilito el boton y los input
									
									txtcodigo.disabled=true; 
									txtdni.disabled=true;
									txtnombre.disabled=true;
									txtdir.disabled=true; 
									document.frm.lista_pais.disabled=true;
									document.frm.lista_provincia.disabled=true;
									document.frm.lista_loca.disabled=true;
									document.frm.lista_iva.disabled=true;
									document.frm.lista_vehiculo.disabled=true;
									txttel.disabled=true; 
									txtcuit1.disabled=true; 
									txtcuit2.disabled=true; 
									txtcuit3.disabled=true; 
																	
									divMensaje.innerHTML="Buscando......."; // mensajes en el div
									var ajax=nuevoAjax();					// creo una instancia de ajax
									metodo="POST";							// asigno las variables de proceso
									url="alta_repartidor.php?";
									variables="codigo="+txtcodigo.value+"&dni="+txtdni.value+"&nombre="+txtnombre.value+"&dir="+txtdir.value+"&pais="+txtpais+"&prov="+txtprov+"&localidad="+txtloca+"&tel="+txttel.value+"&cuit="+cuit+"&iva="+txtiva+"&vehiculo="+txtvehiculo;
									//alert(variables);
									
									ajax.open(metodo, url, true);
									ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
									ajax.send(variables);
									ajax.onreadystatechange=function(){ 
											if (ajax.readyState==4){
															txtcodigo.value="";				// Borro el contenido del input
															txtdni.value="";				// Borro el contenido del input
															txtnombre.value="";				// Borro el contenido del input
															txtdir.value="";				// Borro el contenido del input
															txttel.value="";				// Borro el contenido del input
															txtcuit1.value="";				// Borro el contenido del input
															txtcuit2.value="";				// Borro el contenido del input
															txtcuit3.value="";				// Borro el contenido del input

															txtcodigo.disabled=false; 
															txtdni.disabled=false;
															txtnombre.disabled=false;
															txtdir.disabled=false; 
															document.frm.lista_pais.disabled=false;
															document.frm.lista_provincia.disabled=false;
															document.frm.lista_loca.disabled=false;
															document.frm.lista_iva.disabled=false;
															document.frm.lista_vehiculo.disabled=false;
															txttel.disabled=false; 
															txtcuit1.disabled=false; 
															txtcuit2.disabled=false; 
															txtcuit3.disabled=false; 
															boton.disabled=false; 				// Habilito boton nuevamente

															divMensaje.innerHTML=ajax.responseText; // imprime la salida
															//document.frm.codigo.focus();
															listar_iva_rep();
															//listar_iva();
															listar_paises();
															listar_provincias();
															listar_localidades();
															buscar_repartidor();
															document.frm.codigo.focus();
															
														} // fin de if (ajax.readyState==4)
													} // fin de funcion()
							}else{
								divMensaje.innerHTML="Debe ingresar el Telefono del Repartidor";
								document.frm.tel.focus()
							}
						}else{
							divMensaje.innerHTML="Debe seleccionar una Provincia";
							document.frm.lista_provincia.focus()
						}	 
					}else{
						divMensaje.innerHTML="Debe seleccionar un Pais";
						document.frm.lista_pais.focus()
					}		 
				}else{
					divMensaje.innerHTML="Debe ingresar la Direccion del Repartidor";
					document.frm.dir.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar el Nombre del Repartidor";
				document.frm.nombre.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar el DNI del Repartidor";
			document.frm.dni.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo del Repartidor";
		document.frm.codigo.focus()
	}
}
//--------------------------------------------------------------------------------------------------//
function buscar_repartidor(){
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_repartidor_proceso.php?";
	variables="nombre=TODOS";

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.codigo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_vehiculo_rep_bus(){
	var contenedor=document.getElementById("vehiculos"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_vehiculo_rep_bus.php";
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
function buscar_repartidor2(){
	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
	var txtnombre = document.getElementById("nombre");
	var txtvehiculo = document.frm.lista_vehiculo.options[document.frm.lista_vehiculo.selectedIndex].text;
		
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	document.frm.lista_vehiculo.disabled=true;
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_repartidor_proceso.php?";
	
	if(txtnombre.value == "" && txtvehiculo == "TODOS"){
		variables="nombre=TODOS";
	}else{
		variables="nombre="+txtnombre.value+"&vehiculo="+txtvehiculo;
	}
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
		
				boton.disabled=false; 										// Deshabilito el boton y el input para evitar dobles ingresos
				txtnombre.disabled=false; 
				document.frm.lista_vehiculo.disabled=false;
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				listar_vehiculo_rep_bus();
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_pais_repartidor(codigo){
	var contenedor=document.getElementById("paises_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_pais_repartidor.php?";
	variables = "cod_repartidor="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_prov_repartidor(codigo){
	var contenedor=document.getElementById("provincias_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_prov_repartidor.php?";
	variables = "cod_repartidor="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_loca_repartidor(codigo){
	var contenedor=document.getElementById("localidades_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_loca_repartidor.php?";
	variables = "cod_repartidor="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_iva_repartidor(codigo){
	var contenedor=document.getElementById("iva_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_iva_repartidor.php?";
	variables = "cod_repartidor="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_vehiculo_repartidor(codigo){
	var contenedor=document.getElementById("vehiculos_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_vehiculo_repartidor.php?";
	variables = "cod_repartidor="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_repartidor(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_repartidor="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					listar_pais_repartidor(cod);
					listar_prov_repartidor(cod);
					listar_loca_repartidor(cod);
					listar_iva_repartidor(cod);
					listar_vehiculo_repartidor(cod);
					document.frm_mod.codigo_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_repartidor_db(){
	var divMensaje=document.getElementById("mensaje_mod");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar_mod");
	var boton_cancel=document.getElementById("cancelar_mod");
		
	var txtcodigo_orig = document.getElementById("oculto_mod");
	var txtcodigo = document.getElementById("codigo_mod");
	var txtdni = document.getElementById("dni_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var txtdir = document.getElementById("direccion_mod");
	var txtpais = document.frm_mod.lista_pais_mod.options[document.frm_mod.lista_pais_mod.selectedIndex].text;
 	var txtprov = document.frm_mod.lista_prov_mod.options[document.frm_mod.lista_prov_mod.selectedIndex].text;
 	var txtloca = document.frm_mod.lista_loca_mod.options[document.frm_mod.lista_loca_mod.selectedIndex].text;
	var txttel = document.getElementById("tel_mod");
	var txtcuit1 = document.getElementById("cuit1_mod");
	var txtcuit2 = document.getElementById("cuit2_mod");
	var txtcuit3 = document.getElementById("cuit3_mod");
	var txtiva = document.frm_mod.lista_iva_mod.options[document.frm_mod.lista_iva_mod.selectedIndex].value;
	var txtvehiculo = document.frm_mod.lista_vehi_mod.options[document.frm_mod.lista_vehi_mod.selectedIndex].text;
	
	var iva = document.frm_mod.lista_iva_mod.options[document.frm_mod.lista_iva_mod.selectedIndex].id;
	if(iva == "N"){	
		var cuit = "";
	}else{
		var cuit = txtcuit1.value+txtcuit2.value+txtcuit3.value;
	}
	
	if(txtcodigo.value != ""){
		if(txtdni.value != ""){
			if(txtnombre.value != ""){
				if(txtdir.value != ""){
					if(txtprov != ""){
						if(txtloca != ""){
							if(txttel.value != ""){
									divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
									boton.disabled=true; 				    // Deshabilito el boton y los input
									
									txtcodigo.disabled=true; 
									txtdni.disabled=true;
									txtnombre.disabled=true;
									txtdir.disabled=true; 
									document.frm_mod.lista_pais_mod.disabled=true;
									document.frm_mod.lista_prov_mod.disabled=true;
									document.frm_mod.lista_loca_mod.disabled=true;
									document.frm_mod.lista_iva_mod.disabled=true;
									document.frm_mod.lista_vehi_mod.disabled=true;
									txttel.disabled=true; 
									txtcuit1.disabled=true; 
									txtcuit2.disabled=true; 
									txtcuit3.disabled=true; 
																	
									divMensaje.innerHTML="Modificando......."; // mensajes en el div
									var ajax=nuevoAjax();					// creo una instancia de ajax
									metodo="POST";							// asigno las variables de proceso
									url="modificar.php?";
									//var cuit = txtcuit1.value+txtcuit2.value+txtcuit3.value;
									variables="codigo_rep_orig_mod="+txtcodigo_orig.value+"&codigo="+txtcodigo.value+"&dni="+txtdni.value+"&nombre="+txtnombre.value+"&dir="+txtdir.value+"&pais="+txtpais+"&prov="+txtprov+"&localidad="+txtloca+"&tel="+txttel.value+"&cuit="+cuit+"&iva="+txtiva+"&vehiculo="+txtvehiculo;
									//alert(variables);
						
									ajax.open(metodo, url, true);
									ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
									ajax.send(variables);
									ajax.onreadystatechange=function(){ 
										if (ajax.readyState==4){
												if (ajax.responseText == "ok"){		
															buscar_repartidor();
															document.frm.codigo.focus();	
															//poner_foco_prove();
												}else{
															divMensaje.innerHTML=ajax.responseText; // imprime la salida
															divMensaje.innerHTML = "ERROR: El Repartidor ya existe!!";
															txtcodigo.disabled=false; 
															txtdni.disabled=false;
															txtnombre.disabled=false;
															txtdir.disabled=false; 
															document.frm_mod.lista_pais_mod.disabled=false;
															document.frm_mod.lista_prov_mod.disabled=false;
															document.frm_mod.lista_loca_mod.disabled=false;
															document.frm_mod.lista_iva_mod.disabled=false;
															document.frm_mod.lista_vehi_mod.disabled=false;
															txttel.disabled=false; 
															txtcuit1.disabled=false; 
															txtcuit2.disabled=false; 
															txtcuit3.disabled=false; 
															boton.disabled=false; 						// Habilito boton nuevamente
															boton_cancel.disabled=false; 				// Habilito boton nuevamente
															document.frm_mod.codigo_mod.focus()
												}		
											} // fin de if (ajax.readyState==4)
										} // fin de funcion()
							}else{
								divMensaje.innerHTML="Debe ingresar el Telefono del Repartidor";
								document.frm.tel.focus()
							}
						}else{
							divMensaje.innerHTML="Debe seleccionar una Provincia";
							document.frm.lista_provincia.focus()
						}	 
					}else{
						divMensaje.innerHTML="Debe seleccionar un Pais";
						document.frm.lista_pais.focus()
					}		 
				}else{
					divMensaje.innerHTML="Debe ingresar la Direccion del Repartidor";
					document.frm.dir.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar el Nombre del Repartidor";
				document.frm.nombre.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar el DNI del Repartidor";
			document.frm.dni.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo del Repartidor";
		document.frm.codigo.focus()
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------VENDEDORES------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function pasar_foco_ven_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.codigo.value.length > 0  ) {
                document.frm.dni.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_ven_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.dni.value.length > 0  ) {
                document.frm.nombre.focus()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_ven_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.nombre.value.length > 0  ) {
                document.frm.direccion.focus()
                return 0;		  
			}
     }
}
function pasar_foco_ven_4(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.direccion.value.length > 0  ) {
                document.frm.lista_pais.focus()
                return 0;		  
			}
     }
}
function pasar_foco_ven_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.tel.value.length > 0  ) {
			document.frm.enviar.click();
			return 0;		 
	   }		
	}
}
//--------------------------------buscar------------------------------------------------------------// 
function pasar_foco_ven_6(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.nombre.value.length > 0  ) {
			document.frm.enviar.click();
		}else{
			document.frm.lista_cliente.focus();
		}	
		return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_ven_7(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.enviar.click();
			return 0;

	}
}
//-------------------------------modificar----------------------------------------------------------//
function pasar_foco_ven_1_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.codigo_mod.value.length > 0  ) {
                document.frm_mod.dni_mod.focus()
                return 0;		  
			}	  
	}
}
function pasar_foco_ven_2_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.dni_mod.value.length > 0  ) {
                document.frm_mod.nombre_mod.focus()
                return 0;		  
			}
     }
}
function pasar_foco_ven_3_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.direccion_mod.focus()
                return 0;		  
			}
     }
}
function pasar_foco_ven_4_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.direccion_mod.value.length > 0  ) {
                document.frm_mod.lista_pais_mod.focus()
                return 0;		  
			}
     }
}
function pasar_foco_ven_5_mod(e,cod_pais){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){	
			var contenedor=document.getElementById("provincias_mod"); 
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="listar_prov_vendedor.php?";
			variables = "cod_pais="+cod_pais;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm_mod.lista_prov_mod.focus()
					} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
}
function pasar_foco_ven_6_mod(e,cod_prov){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 && cod_prov){	
			var contenedor=document.getElementById("localidades_mod"); 
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="listar_loca_vendedor.php?";
			variables = "cod_prov="+cod_prov;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm_mod.lista_loca_mod.focus()
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
	}
}
function pasar_foco_ven_7_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm_mod.tel_mod.value.length > 0  ) {
			document.frm_mod.enviar_mod.click()
			return 0;		 
	   }		
	}
}

//--------------------------------------------------------------------------------------------------//
function registrar_vendedor(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");

	var txtcodigo = document.getElementById("codigo");
	var txtdni = document.getElementById("dni");
	var txtnombre = document.getElementById("nombre");
	var txtdir = document.getElementById("direccion");
	var txtpais = document.frm.lista_pais.options[document.frm.lista_pais.selectedIndex].text;
 	var txtprov = document.frm.lista_provincia.options[document.frm.lista_provincia.selectedIndex].text;
 	var txtloca = document.frm.lista_loca.options[document.frm.lista_loca.selectedIndex].text;
	var txttel = document.getElementById("tel");
	
	if(txtcodigo.value != ""){
		if(txtdni.value != ""){
			if(txtnombre.value != ""){
				if(txtdir.value != ""){
					if(txtprov != "-- seleccione pais --"){
						if(txtloca != "-- seleccione provincia --"){
							if(txttel.value != ""){
									divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
									boton.disabled=true; 				    // Deshabilito el boton y los input
									
									txtcodigo.disabled=true; 
									txtdni.disabled=true;
									txtnombre.disabled=true;
									txtdir.disabled=true; 
									document.frm.lista_pais.disabled=true;
									document.frm.lista_provincia.disabled=true;
									document.frm.lista_loca.disabled=true;
									txttel.disabled=true; 
																	
									divMensaje.innerHTML="Buscando......."; // mensajes en el div
									var ajax=nuevoAjax();					// creo una instancia de ajax
									metodo="POST";							// asigno las variables de proceso
									url="alta_vendedor.php?";
									variables="codigo="+txtcodigo.value+"&dni="+txtdni.value+"&nombre="+txtnombre.value+"&dir="+txtdir.value+"&pais="+txtpais+"&prov="+txtprov+"&localidad="+txtloca+"&tel="+txttel.value;
									//alert(variables);
									
									ajax.open(metodo, url, true);
									ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
									ajax.send(variables);
									ajax.onreadystatechange=function(){ 
											if (ajax.readyState==4){
															txtcodigo.value="";				// Borro el contenido del input
															txtdni.value="";				// Borro el contenido del input
															txtnombre.value="";				// Borro el contenido del input
															txtdir.value="";				// Borro el contenido del input
															txttel.value="";				// Borro el contenido del input

															txtcodigo.disabled=false; 
															txtdni.disabled=false;
															txtnombre.disabled=false;
															txtdir.disabled=false; 
															document.frm.lista_pais.disabled=false;
															document.frm.lista_provincia.disabled=false;
															document.frm.lista_loca.disabled=false;
															txttel.disabled=false; 
															boton.disabled=false; 				// Habilito boton nuevamente

															divMensaje.innerHTML=ajax.responseText; // imprime la salida
															listar_paises();
															listar_provincias();
															listar_localidades();
															document.frm.codigo.focus()
															buscar_vendedor();
														} // fin de if (ajax.readyState==4)
													} // fin de funcion()
							}else{
								divMensaje.innerHTML="Debe ingresar el Telefono del Vendedor";
								document.frm.tel.focus()
							}
						}else{
							divMensaje.innerHTML="Debe seleccionar una Provincia";
							document.frm.lista_provincia.focus()
						}	 
					}else{
						divMensaje.innerHTML="Debe seleccionar un Pais";
						document.frm.lista_pais.focus()
					}		 
				}else{
					divMensaje.innerHTML="Debe ingresar la Direccion del Vendedor";
					document.frm.dir.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar el Nombre del Vendedor";
				document.frm.nombre.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar el DNI del Vendedor";
			document.frm.dni.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo del Vendedor";
		document.frm.codigo.focus()
	}
}
//--------------------------------------------------------------------------------------------------//
function buscar_vendedor(){
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_vendedor_proceso.php?";
	variables="nombre=TODOS";

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.codigo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_cliente_ven_bus(){
	var contenedor=document.getElementById("clientes"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_cliente_ven_bus.php";
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
function buscar_vendedor2(){
	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
	var txtnombre = document.getElementById("nombre");
	var txtcliente = document.frm.lista_cliente.options[document.frm.lista_cliente.selectedIndex].text;
		
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	document.frm.lista_cliente.disabled=true;
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_vendedor_proceso.php?";
	
	if(txtnombre.value == "" && txtcliente == "TODOS"){
		variables="nombre=TODOS";
	}else{
		variables="nombre="+txtnombre.value+"&cliente="+txtcliente;
	}
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false;
				txtnombre.disabled=false; 
				document.frm.lista_cliente.disabled=false;
				listar_cliente_ven_bus();
				document.frm.nombre.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_pais_vendedor(codigo){
	var contenedor=document.getElementById("paises_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_pais_vendedor.php?";
	variables = "cod_vendedor="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_prov_vendedor(codigo){
	var contenedor=document.getElementById("provincias_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_prov_vendedor.php?";
	variables = "cod_vendedor="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_loca_vendedor(codigo){
	var contenedor=document.getElementById("localidades_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_loca_vendedor.php?";
	variables = "cod_vendedor="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_vendedor(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_vendedor="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					listar_pais_vendedor(cod);
					listar_prov_vendedor(cod);
					listar_loca_vendedor(cod);
					document.frm_mod.codigo_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_vendedor_db(){
	var divMensaje=document.getElementById("mensaje_mod");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar_mod");
	var boton_cancel=document.getElementById("cancelar_mod");
		
	var txtcodigo_orig = document.getElementById("oculto_mod");
	var txtcodigo = document.getElementById("codigo_mod");
	var txtdni = document.getElementById("dni_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var txtdir = document.getElementById("direccion_mod");
	var txtpais = document.frm_mod.lista_pais_mod.options[document.frm_mod.lista_pais_mod.selectedIndex].text;
 	var txtprov = document.frm_mod.lista_prov_mod.options[document.frm_mod.lista_prov_mod.selectedIndex].text;
 	var txtloca = document.frm_mod.lista_loca_mod.options[document.frm_mod.lista_loca_mod.selectedIndex].text;
	var txttel = document.getElementById("tel_mod");

	if(txtcodigo.value != ""){
		if(txtdni.value != ""){
			if(txtnombre.value != ""){
				if(txtdir.value != ""){
					if(txtprov != ""){
						if(txtloca != ""){
							if(txttel.value != ""){
									divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
									boton.disabled=true; 				    // Deshabilito el boton y los input
									
									txtcodigo.disabled=true; 
									txtdni.disabled=true;
									txtnombre.disabled=true;
									txtdir.disabled=true; 
									document.frm_mod.lista_pais_mod.disabled=true;
									document.frm_mod.lista_prov_mod.disabled=true;
									document.frm_mod.lista_loca_mod.disabled=true;
									txttel.disabled=true; 
																	
									divMensaje.innerHTML="Modificando......."; // mensajes en el div
									var ajax=nuevoAjax();					// creo una instancia de ajax
									metodo="POST";							// asigno las variables de proceso
									url="modificar.php?";
									variables="codigo_ven_orig_mod="+txtcodigo_orig.value+"&codigo="+txtcodigo.value+"&dni="+txtdni.value+"&nombre="+txtnombre.value+"&dir="+txtdir.value+"&pais="+txtpais+"&prov="+txtprov+"&localidad="+txtloca+"&tel="+txttel.value;
									//alert(variables);
						
									ajax.open(metodo, url, true);
									ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
									ajax.send(variables);
									ajax.onreadystatechange=function(){ 
										if (ajax.readyState==4){
												if (ajax.responseText == "ok"){		
															buscar_vendedor();
															document.frm.codigo.focus();	
															//poner_foco_prove();
												}else{
															//divMensaje.innerHTML=ajax.responseText; // imprime la salida
															divMensaje.innerHTML = "ERROR: El Vendedor ya existe!!";
															txtcodigo.disabled=false; 
															txtdni.disabled=false;
															txtnombre.disabled=false;
															txtdir.disabled=false; 
															document.frm_mod.lista_pais_mod.disabled=false;
															document.frm_mod.lista_prov_mod.disabled=false;
															document.frm_mod.lista_loca_mod.disabled=false;
															txttel.disabled=false; 
															boton.disabled=false; 						// Habilito boton nuevamente
															boton_cancel.disabled=false; 				// Habilito boton nuevamente
															document.frm_mod.codigo_mod.focus()
												}		
											} // fin de if (ajax.readyState==4)
										} // fin de funcion()
							}else{
								divMensaje.innerHTML="Debe ingresar el Telefono del Vendedor";
								document.frm.tel.focus()
							}
						}else{
							divMensaje.innerHTML="Debe seleccionar una Provincia";
							document.frm.lista_provincia.focus()
						}	 
					}else{
						divMensaje.innerHTML="Debe seleccionar un Pais";
						document.frm.lista_pais.focus()
					}		 
				}else{
					divMensaje.innerHTML="Debe ingresar la Direccion del Vendedor";
					document.frm.dir.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar el Nombre del Vendedor";
				document.frm.nombre.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar el DNI del Vendedor";
			document.frm.dni.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo del Vendedor";
		document.frm.codigo.focus()
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------CATEGORIA------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function pasar_foco_cat_registrar(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.nombre.value.length > 0  ) {
                document.frm.enviar.click()
                return 0;		  
		   }	
     }
}
//------------------------------------------buscar--------------------------------------------------//
function pasar_foco_cat_buscar(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.nombre.value.length > 0  ) {
                document.frm.enviar.click()
           }else{
		       document.frm.lista_articulo.focus()
		   }
		   return 0;
	  
     }
}
function pasar_foco_cat_buscar2(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       var txtarticulo = document.frm.lista_articulo.options[document.frm.lista_articulo.selectedIndex].text;
		   if (txtarticulo == "TODOS"){
				document.frm.lista_cliente.focus()
           }else{
				document.frm.enviar.click()		       
		   }
		   return 0;
     }
}
function pasar_foco_cat_buscar3(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
           document.frm.enviar.click()
		   return 0;
     }
}
//---------------------------------------modificar-----------------------------------------------------//
function pasar_foco_cat_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.enviar_mod.click()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function registrar_categoria(){
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var boton=document.getElementById("enviar");
 var txtnombre = document.getElementById("nombre");
 if(document.frm.nombre.value != ""){
	divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	divMensaje.innerHTML="Buscando......."; // mensajes en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
    url="alta_categoria.php?";
	variables="nombre="+txtnombre.value;

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";			// Borro el contenido del input
				boton.disabled=false; 		// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				divMensaje.innerHTML=ajax.responseText; // imprime la salida
				document.frm.nombre.focus()
				buscar_categoria()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
 }else{
	divMensaje.innerHTML="Debe ingresar el nombre de la Categoria";
	document.frm.nombre.focus()
 }
}
//--------------------------------------------------------------------------------------------------//
function buscar_categoria(){
 	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_categoria_proceso.php?";
	variables="nombre=todos";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function modificar_categoria(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_cat_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					document.frm_mod.nombre_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_categoria_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
 	var txtcodigo = document.getElementById("oculto_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var ajax=nuevoAjax();										// creo una instancia de ajax
 if(document.frm_mod.nombre_mod.value != ""){	
 	divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	divMensaje.innerHTML="Modificando.......";					// mensajes en el div
	
	metodo="POST";												// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_cat_mod="+txtcodigo.value+"&nombre_cat_mod="+txtnombre.value;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if (ajax.responseText == "ok"){
					/*
					txtnombre.value="";								// Borro el contenido del input
					boton.disabled=false; 							// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					divlistado.innerHTML="<div class='advertencia'>Categoria Modificada!!</div>";
					*/
					buscar_categoria()
					document.frm.nombre.focus();	
				}else{
					divMensaje.innerHTML = "ERROR: La Categoria ya existe!!";
					boton.disabled=false; 							// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					document.frm_mod.nombre_mod.focus()
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
 }else{
	divMensaje.innerHTML="Debe ingresar el nombre de la Categoria";
	document.frm_mod.nombre_mod.focus()
 }	
}
//--------------------------------------------------------------------------------------------------//
function listar_cliente_cat_bus(){
	var contenedor=document.getElementById("clientes"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_cliente_cat_bus.php";
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
function listar_articulo_cat_bus(){
	var contenedor=document.getElementById("articulos"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_articulo_cat_bus.php";
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
function buscar_categoria2(){
 	var divlistado=document.getElementById("listado"); 
	var boton=document.getElementById("enviar");
 	var txtnombre = document.getElementById("nombre");
	var txtarticulo = document.frm.lista_articulo.options[document.frm.lista_articulo.selectedIndex].text;
	var txtcliente = document.frm.lista_cliente.options[document.frm.lista_cliente.selectedIndex].text;
	
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_categoria_proceso.php?";
	if(document.frm.nombre.value == "" && txtarticulo == "TODOS" && txtcliente == "TODOS" ){
		variables="nombre=todos";
	}
	else{
		variables="nombre="+txtnombre.value+"&articulo="+txtarticulo+"&cliente="+txtcliente;
	}
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------CLIENTES--------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////

function buscar_cod_sig_cliente(){					
		var contenedor=document.getElementById("codigo"); 
		url="buscar_max_cliente.php?";			
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		//variables = "&cod_vari="+variedad+"&cod_marca="+marca+"&cod_grupo="+grupo;
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(null);
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							document.frm.codigo.value=ajax.responseText; 		// imprime la salida
							document.frm.codigo.focus()
				} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//============================================================================================//
function pasar_foco_clie_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.codigo.value.length > 0  ) {
                document.frm.razon.focus()
                return 0;		  
			}	  
	}
	
	if ( tecla==113 ){    
	 	buscar_cod_sig_cliente();
	 }

}
function pasar_foco_clie_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.razon.value.length > 0  ) {
                document.frm.lista_iva.focus()
                return 0;		  
			}
     }
}
function pasar_foco_clie_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.cuit1.value.length != 2  || document.frm.cuit2.value.length != 8 || document.frm.cuit3.value.length != 1) {
				document.frm.direccion.focus()
		}
	}else{
		if( document.frm.cuit1.value.length == 2  ) {	
				document.frm.cuit2.focus()
                return 0;	
		}
	}
}
function pasar_foco_clie_4(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm.cuit2.value.length == 8  ) {
                document.frm.cuit3.focus()
                return 0;		  
	}
}
function validar_cuit_cliente(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var cuit=document.frm.cuit1.value+document.frm.cuit2.value+document.frm.cuit3.value;
	if( document.frm.cuit1.value.length == 2 && document.frm.cuit2.value.length == 8 && document.frm.cuit3.value.length == 1  ) {
				validar_cuit(cuit)
				if(error != ""){
					divMensaje.innerHTML=error;
					document.frm.cuit1.focus()
					return error;
				}else{
					divMensaje.innerHTML=' ';
					document.frm.direccion.focus();
				}
	}
}

function pasar_foco_clie_5(e){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm.cuit1.value.length == 2 && document.frm.cuit2.value.length == 8 && document.frm.cuit3.value.length == 1  ) {
				var cuit=document.frm.cuit1.value+document.frm.cuit2.value+document.frm.cuit3.value;
				validar_cuit(cuit)
				if(error != ""){
					divMensaje.innerHTML=error;
					document.frm.cuit1.focus()
					return error;
				}else{
					divMensaje.innerHTML=' ';
				}
				document.frm.direccion.focus()			
                return 0;		  
	}
}
function pasar_foco_clie_6(e){
	var cuit = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].id;
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if(cuit == "S"){
					document.frm.cuit1.focus()
			}else{
					document.frm.direccion.focus()
			}
					return 0;		  
	}
}
function pasar_foco_clie_8(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.direccion.value != "") {
					document.frm.lista_pais.focus()
					return 0;		  
		}
	}
}
function pasar_foco_clie_9(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.tel.focus()
					return 0;		  
	}
}
function pasar_foco_clie_10(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		//if( document.frm.tel.value != "") {
					document.frm.fax.focus()
					return 0;
		//}
	}
}

function pasar_foco_clie_11(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.cel.focus()
					return 0;
	}
}
function pasar_foco_clie_12(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.web.focus()
					return 0;
	}
}
function pasar_foco_clie_13(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.mail.focus()
					return 0;
	}
}
function pasar_foco_clie_14(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.contacto.focus()
					return 0;
	}
}
function pasar_foco_clie_15(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.lim_cred.focus()
					return 0;
	}
}
function pasar_foco_clie_16(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.lista_cat.focus()
					return 0;
	}
}
function pasar_foco_clie_17(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.lista_ven.focus()
					return 0;
	}
}
function pasar_foco_clie_18(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.lista_rep.focus()
					return 0;
	}
}
function pasar_foco_clie_19(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.lista_forma_pago.focus();
					return 0;
	}
}
function pasar_foco_clie_19a(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm.enviar.click()
					return 0;
	}
}
//--------------------BUSCAR------------------------------//
function pasar_foco_clie_20(e){
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
function pasar_foco_clie_21(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if(document.frm.razon.value == ""){
					document.frm.cuit1.focus()
			}else{
					document.frm.enviar.click()				
			}
			return 0;
	}
}
function pasar_foco_clie_22(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13  && document.frm.cuit1.value == "" && document.frm.cuit2.value == "" && document.frm.cuit3.value == ""){
            document.frm.lista_ven_bus.focus()
	}else{
			if( document.frm.cuit1.value.length == 2  ) {
               	document.frm.cuit2.focus()
			}
	}
	return 0;	
}
function pasar_foco_clie_23(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm.cuit2.value.length == 8  ) {
                document.frm.cuit3.focus()
                return 0;		  
	}
}
function pasar_foco_clie_24(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( tecla==13  && document.frm.cuit1.value.length == 2  && document.frm.cuit2.value.length == 8 && document.frm.cuit3.value.length == 1) {
                document.frm.enviar.click()
	}else{
                document.frm.lista_ven_bus.focus()
	}
    return 0;		  
	
}
function pasar_foco_clie_25(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( tecla==13 ) {
			if(document.frm.lista_ven_bus.value == "TODOS"){
					document.frm.lista_zona_bus.focus()
			}else{
					document.frm.enviar.click()				
			}
			return 0;
	}
}
function pasar_foco_clie_26(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( tecla==13 ) {
			document.frm.enviar.click()				
			return 0;
	}
}


//-------------------MODIFICAR--------------------------------//
function pasar_foco_clie_1_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.codigo_mod.value.length > 0  ) {
                document.frm_mod.razon_mod.focus()
                return 0;		  
			}	  
	}
}
function pasar_foco_clie_2_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.razon_mod.value.length > 0  ) {
                if(document.frm_mod.lista_iva_mod.disabled==false){
					document.frm_mod.lista_iva_mod.focus();
				}else{
					document.frm_mod.direccion_mod.focus();
				}
                return 0;		  
			}
     }
}

function pasar_foco_clie_2_a_mod(e){
 	var txtiva = document.frm_mod.lista_iva_mod.options[document.frm_mod.lista_iva_mod.selectedIndex].id;
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){			
		if(document.frm_mod.cuit1_mod.value.length == 0 && document.frm_mod.cuit2_mod.value.length == 0 && document.frm_mod.cuit3_mod.value.length == 0){
			if(txtiva == "S"){	
				document.frm_mod.cuit1_mod.focus()
			}else{
				document.frm_mod.direccion_mod.focus();
			}	
		}else{
			if(txtiva == "S"){	
				document.frm_mod.cuit1_mod.focus()
			}else{
				document.frm_mod.cuit1_mod.value= "";
				document.frm_mod.cuit2_mod.value= ""; 
				document.frm_mod.cuit3_mod.value= "";
				document.frm_mod.direccion_mod.focus();
			}	
		}
		return 0;		  
	}	
}
function pasar_foco_clie_3_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm_mod.cuit1_mod.value.length != 2  || document.frm_mod.cuit2_mod.value.length != 8 || document.frm_mod.cuit3_mod.value.length != 1) {
				document.frm_mod.direccion_mod.focus()
		}
	}else{
		if( document.frm_mod.cuit1_mod.value.length == 2  ) {	
				document.frm_mod.cuit2_mod.focus()
                return 0;	
		}
	}
}

function pasar_foco_clie_4_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm_mod.cuit2_mod.value.length == 8  ) {
                document.frm_mod.cuit3_mod.focus()
                return 0;		  
	}
}



function validar_cuit_cliente_mod(){
	var divMensaje=document.getElementById("mensaje_mod");  // asigna los aobjetos a las variables
	var cuit=document.frm_mod.cuit1_mod.value+document.frm_mod.cuit2_mod.value+document.frm_mod.cuit3_mod.value;
	if( document.frm_mod.cuit1_mod.value.length == 2 && document.frm_mod.cuit2_mod.value.length == 8 && document.frm_mod.cuit3_mod.value.length == 1  ) {
				validar_cuit(cuit)
				if(error != ""){
					divMensaje.innerHTML=error;
					document.frm_mod.cuit1_mod.focus()
					return error;
				}else{
					divMensaje.innerHTML=' ';
					document.frm_mod.direccion_mod.focus()			

				}
	}
}

function pasar_foco_clie_5_mod(e){
	var divMensaje=document.getElementById("mensaje_mod");  // asigna los aobjetos a las variables
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm_mod.cuit1_mod.value.length == 2 && document.frm_mod.cuit2_mod.value.length == 8 && document.frm_mod.cuit3_mod.value.length == 1  ) {
				var cuit=document.frm_mod.cuit1_mod.value+document.frm_mod.cuit2_mod.value+document.frm_mod.cuit3_mod.value;
				validar_cuit(cuit)
				if(error != ""){
					divMensaje.innerHTML=error;
					document.frm_mod.cuit1_mod.focus()
					return error;
				}else{
					divMensaje.innerHTML=' ';
				}
				document.frm_mod.direccion_mod.focus()			
                return 0;		  
	}
}
function pasar_foco_clie_6_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.direccion_mod.focus()
					return 0;		  
	}
}
function pasar_foco_clie_8_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm_mod.direccion_mod.value != "") {
					document.frm_mod.lista_pais_mod.focus()
					return 0;		  
		}
	}
}
function pasar_foco_clie_9_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.tel_mod.focus()
					return 0;		  
	}
}
function pasar_foco_clie_10_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		//if( document.frm_mod.tel_mod.value != "") {
					document.frm_mod.fax_mod.focus()
					return 0;
		//}
	}
}

function pasar_foco_clie_11_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.cel_mod.focus()
					return 0;
	}
}
function pasar_foco_clie_12_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.web_mod.focus()
					return 0;
	}
}
function pasar_foco_clie_13_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.mail_mod.focus()
					return 0;
	}
}
function pasar_foco_clie_14_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.contacto_mod.focus()
					return 0;
	}
}
function pasar_foco_clie_15_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.lim_cred_mod.focus()
					return 0;
	}
}
function pasar_foco_clie_16_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.frm_mod.lista_cat_mod.focus()
					return 0;
	}
}
function pasar_foco_clie_20_mod(e,cod_pais){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){	
			var contenedor=document.getElementById("provincias_mod"); 
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="listar_prov_de_cliente.php?";
			variables = "cod_pais="+cod_pais;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm_mod.lista_prov_mod.focus()
					} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
}
function pasar_foco_clie_21_mod(e,cod_prov){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 && cod_prov){	
			var contenedor=document.getElementById("localidades_mod"); 
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="listar_loca_de_cliente.php?";
			variables = "cod_prov="+cod_prov;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm_mod.lista_loca_mod.focus()
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
	}
}
function pasar_foco_clie_22_mod(e,cod_loca){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 && cod_loca){	
			//alert(cod_loca);
			var contenedor=document.getElementById("zonas_mod"); 
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="listar_zona_de_cliente.php?";
			variables = "cod_loca="+cod_loca;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm_mod.lista_zona_mod.focus()
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
	}
}
function pasar_foco_clie_23_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txtzona = document.frm_mod.lista_zona_mod.options[document.frm_mod.lista_zona_mod.selectedIndex].text;
	if ( tecla==13 && txtzona != ""){
					document.frm_mod.tel_mod.focus()
					return 0;		  
	}
}
function pasar_foco_clie_24_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txtcat = document.frm_mod.lista_cat_mod.options[document.frm_mod.lista_cat_mod.selectedIndex].text;
	if ( tecla==13 && txtcat != ""){
					document.frm_mod.lista_ven_mod.focus()
					return 0;		  
	}
}
function pasar_foco_clie_25_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txtven = document.frm_mod.lista_ven_mod.options[document.frm_mod.lista_ven_mod.selectedIndex].text;
	if ( tecla==13 && txtven != ""){
					document.frm_mod.lista_rep_mod.focus()
					return 0;		  
	}
}
function pasar_foco_clie_26_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txtrep = document.frm_mod.lista_rep_mod.options[document.frm_mod.lista_rep_mod.selectedIndex].text;
	if ( tecla==13 && txtrep != ""){
					document.frm_mod.lista_forma_pago_mod.focus()
					return 0;		  
	}
}
function pasar_foco_clie_27_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txtfp = document.frm_mod.lista_forma_pago_mod.options[document.frm_mod.lista_forma_pago_mod.selectedIndex].text;
	if ( tecla==13 && txtfp != ""){
					document.frm_mod.enviar_mod.click()
					return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function listar_iva_cliente(){
	var contenedor=document.getElementById("iva"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_iva_cliente.php";
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
function listar_cat_cliente(){
	var contenedor=document.getElementById("categoria"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_cat_cliente.php";
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
function listar_ven_cliente(){
	var contenedor=document.getElementById("vendedores"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_ven_cliente.php";
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
function listar_rep_cliente(){
	var contenedor=document.getElementById("repartidores"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_rep_cliente.php";
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
function listar_forma_pago_cliente(){
	var contenedor=document.getElementById("forma_pago"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_forma_pago_cliente.php";
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
function listar_localidades_clie(){
	var contenedor=document.getElementById("localidades"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_localidades_clie.php";
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
function registrar_cliente(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");

	var txtcodigo = document.getElementById("codigo");
	var txtrazon = document.getElementById("razon");
	var txtcuit1 = document.getElementById("cuit1");
	var txtcuit2 = document.getElementById("cuit2");
	var txtcuit3 = document.getElementById("cuit3");
 	var txtiva = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].value;
	var txtdir = document.getElementById("direccion");
	var txtpais = document.frm.lista_pais.options[document.frm.lista_pais.selectedIndex].text;
 	var txtprov = document.frm.lista_provincia.options[document.frm.lista_provincia.selectedIndex].text;
 	var txtloca = document.frm.lista_loca.options[document.frm.lista_loca.selectedIndex].text;
	var txtzona = document.frm.lista_zona.options[document.frm.lista_zona.selectedIndex].text;
	var txttel = document.getElementById("tel");
	var txtfax = document.getElementById("fax");
	var txtcel = document.getElementById("cel");
	var txtweb = document.getElementById("web");
	var txtmail = document.getElementById("mail");
	var txtcontacto = document.getElementById("contacto");
	var txtlim_cred = document.getElementById("lim_cred");
	var txtcategoria = document.frm.lista_cat.options[document.frm.lista_cat.selectedIndex].text;
	var txtvendedor = document.frm.lista_ven.options[document.frm.lista_ven.selectedIndex].text;
	var txtrepartidor = document.frm.lista_rep.options[document.frm.lista_rep.selectedIndex].text;
	var tiene_cuit = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].id; // (*)
	var txtforma_pago = document.frm.lista_forma_pago.options[document.frm.lista_forma_pago.selectedIndex].value; // (*)lista_forma_pago

	if(tiene_cuit == "N"){ //(*)
		cuit="";
	}else{
		var cuit=txtcuit1.value+txtcuit2.value+txtcuit3.value;
	}

	if(txtcodigo.value.length > 0 && txtcodigo.value != "0"){
		if(txtrazon.value != ""){
			if(cuit != "" ){
				validar_cuit(cuit);					// valida el CUIT ingrsado
				if(error != ""){
					divMensaje.innerHTML=error;
					document.frm.cuit1.focus()
					return error;
				}
			}
			if(txtdir.value != ""){
				if(txtprov != "-- seleccione pais --"){
					if(txtloca != "-- seleccione provincia --"){
						if(txtzona != "-- seleccione localidad --"){						
							//if(txttel.value != ""){
													divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
													boton.disabled=true; 				    // Deshabilito el boton y los input
													txtcodigo.disabled=true; 
													txtrazon.disabled=true; 
													txtcuit1.disabled=true; 
													txtcuit2.disabled=true; 
													txtcuit3.disabled=true; 
													document.frm.lista_iva.disabled=true; 
													txtdir.disabled=true; 
													document.frm.lista_pais.disabled=true; 
													document.frm.lista_provincia.disabled=true; 
													document.frm.lista_loca.disabled=true; 
													document.frm.lista_zona.disabled=true; 
													txttel.disabled=true; 
													txtfax.disabled=true; 
													txtcel.disabled=true; 
													txtweb.disabled=true; 
													txtmail.disabled=true; 
													txtcontacto.disabled=true; 
													txtlim_cred.disabled=true; 
													document.frm.lista_cat.disabled=true;
													document.frm.lista_ven.disabled=true;
													document.frm.lista_rep.disabled=true;
													document.frm.lista_forma_pago.disabled=true;
													
													divMensaje.innerHTML="Buscando......."; // mensajes en el div
													var ajax=nuevoAjax();					// creo una instancia de ajax
													metodo="POST";							// asigno las variables de proceso
													url="alta_cliente.php?";
													//var cuit = txtcuit1.value+txtcuit2.value+txtcuit3.value;
													variables="codigo="+txtcodigo.value+"&razon="+txtrazon.value+"&cuit="+cuit+"&iva="+txtiva+"&dir="+txtdir.value+"&pais="+txtpais+"&prov="+txtprov+"&localidad="+txtloca+"&zona="+txtzona+"&tel="+txttel.value+"&fax="+txtfax.value+"&cel="+txtcel.value+"&web="+txtweb.value+"&mail="+txtmail.value+"&contacto="+txtcontacto.value+"&lim_cred="+txtlim_cred.value+"&categoria="+txtcategoria+"&vendedor="+txtvendedor+"&repartidor="+txtrepartidor+"&fp="+txtforma_pago;
													//alert(variables);
													ajax.open(metodo, url, true);
													ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
													ajax.send(variables);
													ajax.onreadystatechange=function(){ 
														if (ajax.readyState==4){
															txtcodigo.value="";				// Borro el contenido del input
															txtrazon.value="";				// Borro el contenido del input
															txtcuit1.value="";				// Borro el contenido del input
															txtcuit2.value="";				// Borro el contenido del input
															txtcuit3.value="";				// Borro el contenido del input
															txtdir.value="";				// Borro el contenido del input
															txttel.value="";				// Borro el contenido del input
															txtfax.value="";				// Borro el contenido del input
															txtcel.value="";				// Borro el contenido del input
															txtweb.value="";				// Borro el contenido del input
															txtmail.value="";				// Borro el contenido del input
															txtcontacto.value="";			// Borro el contenido del input
															txtlim_cred.value="";			// Borro el contenido del input

															txtcodigo.disabled=false; 		// habilito el boton y los input
															txtrazon.disabled=false; 
															txtcuit1.disabled=false; 
															txtcuit2.disabled=false; 
															txtcuit3.disabled=false; 
															document.frm.lista_iva.disabled=false; 
															txtdir.disabled=false; 
															document.frm.lista_pais.disabled=false; 
															document.frm.lista_provincia.disabled=false; 
															document.frm.lista_loca.disabled=false; 
															txttel.disabled=false; 
															txtfax.disabled=false; 
															txtcel.disabled=false; 
															txtweb.disabled=false; 
															txtmail.disabled=false; 
															txtcontacto.disabled=false; 
															txtlim_cred.disabled=false; 
															document.frm.lista_cat.disabled=false;
															document.frm.lista_ven.disabled=false;
															document.frm.lista_rep.disabled=false;	
															document.frm.lista_forma_pago.disabled=false;
															
															boton.disabled=false; 				// Habilito boton nuevamente
															divMensaje.innerHTML=ajax.responseText; // imprime la salida
															document.frm.codigo.focus();
															listar_paises();
															listar_provincias();
															listar_localidades_clie();
															listar_zonas();
															listar_iva_cliente();
															listar_cat_cliente();
															listar_ven_cliente();
															listar_rep_cliente();
															buscar_cliente()
															//document.frm.codigo.focus()
														} // fin de if (ajax.readyState==4)
													} // fin de funcion()
							/*}else{
								divMensaje.innerHTML="Debe ingresar el Telefono del Cliente";
								document.frm.tel.focus()
							}*/
						}else{
							divMensaje.innerHTML="Debe seleccionar una Localidad";
							document.frm.lista_provincia.focus()
						}	
					}else{
						divMensaje.innerHTML="Debe seleccionar una Provincia";
						document.frm.lista_provincia.focus()
					}	 
				}else{
					divMensaje.innerHTML="Debe seleccionar un Pais";
					document.frm.lista_pais.focus()
				}		 
			}else{
				divMensaje.innerHTML="Debe ingresar la Dirección del Cliente";
				document.frm.direccion.focus()
			}	
		}else{
			divMensaje.innerHTML="Debe ingresar la Razon Social del Cliente";
			document.frm.razon.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo del Cliente";
		document.frm.codigo.focus()
	}
}
//--------------------------------------------------------------------------------------------------//
function listar_vendedor_cliente_bus(){
	var contenedor=document.getElementById("vendedores"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_vendedor_cliente_bus.php?";
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
function listar_zona_cliente_bus(){
	var contenedor=document.getElementById("zonas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_zona_cliente_bus.php?";
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
function buscar_cliente(){
 	var divlistado=document.getElementById("listado"); 
	divlistado.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"

	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_cliente_proceso.php?";
	variables="nombre=TODOS";

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.codigo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_iva_cliente_mod(codigo){
	var contenedor=document.getElementById("iva_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_iva_de_cliente.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_pais_cliente_mod(codigo){
	var contenedor=document.getElementById("paises_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_pais_de_cliente.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_prov_cliente_mod(codigo){
	var contenedor=document.getElementById("provincias_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_prov_de_cliente.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_loca_cliente_mod(codigo){
	var contenedor=document.getElementById("localidades_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_loca_de_cliente.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_zona_cliente_mod(codigo){
	var contenedor=document.getElementById("zonas_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_zona_de_cliente.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_cat_cliente_mod(codigo){
	var contenedor=document.getElementById("categoria_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_cat_de_cliente.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_ven_cliente_mod(codigo){
	var contenedor=document.getElementById("vendedores_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_ven_de_cliente.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_rep_cliente_mod(codigo){
	var contenedor=document.getElementById("repartidores_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_rep_de_cliente.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_forma_pago_cliente_mod(codigo){
	var contenedor=document.getElementById("forma_pago_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_forma_pago_de_cliente.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_cliente(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_cliente="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					listar_iva_cliente_mod(cod);
					listar_pais_cliente_mod(cod);
					listar_prov_cliente_mod(cod);
					listar_loca_cliente_mod(cod);
					listar_zona_cliente_mod(cod);
					listar_cat_cliente_mod(cod);
					listar_ven_cliente_mod(cod);
					listar_rep_cliente_mod(cod);
					listar_forma_pago_cliente_mod(cod);
					document.frm_mod.codigo_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_cliente_db(){
	var divMensaje=document.getElementById("mensaje_mod");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar_mod");
	var cancelar=document.getElementById("cancelar_mod");
	
	var txtcodigo_orig = document.getElementById("oculto_mod");		
	var txtcodigo = document.getElementById("codigo_mod");
	var txtrazon = document.getElementById("razon_mod");
	var txtcuit1 = document.getElementById("cuit1_mod");
	var txtcuit2 = document.getElementById("cuit2_mod");
	var txtcuit3 = document.getElementById("cuit3_mod");
 	var txtiva = document.frm_mod.lista_iva_mod.options[document.frm_mod.lista_iva_mod.selectedIndex].value;
	var txtdir = document.getElementById("direccion_mod");
	var txtpais = document.frm_mod.lista_pais_mod.options[document.frm_mod.lista_pais_mod.selectedIndex].text;
 	var txtprov = document.frm_mod.lista_prov_mod.options[document.frm_mod.lista_prov_mod.selectedIndex].text;
 	var txtloca = document.frm_mod.lista_loca_mod.options[document.frm_mod.lista_loca_mod.selectedIndex].text;
	var txtzona = document.frm_mod.lista_zona_mod.options[document.frm_mod.lista_zona_mod.selectedIndex].text;
	var txttel = document.getElementById("tel_mod");
	var txtfax = document.getElementById("fax_mod");
	var txtcel = document.getElementById("cel_mod");
	var txtweb = document.getElementById("web_mod");
	var txtmail = document.getElementById("mail_mod");
	var txtcontacto = document.getElementById("contacto_mod");
	var txtlim_cred = document.getElementById("lim_cred_mod");
	var txtcategoria = document.frm_mod.lista_cat_mod.options[document.frm_mod.lista_cat_mod.selectedIndex].text;
	var txtvendedor = document.frm_mod.lista_ven_mod.options[document.frm_mod.lista_ven_mod.selectedIndex].text;
	var txtrepartidor = document.frm_mod.lista_rep_mod.options[document.frm_mod.lista_rep_mod.selectedIndex].text;
	var tiene_cuit = document.frm_mod.lista_iva_mod.options[document.frm_mod.lista_iva_mod.selectedIndex].id; // (*)
	var txtfp = document.frm_mod.lista_forma_pago_mod.options[document.frm_mod.lista_forma_pago_mod.selectedIndex].value;

	var cuit=txtcuit1.value+txtcuit2.value+txtcuit3.value;
	if(tiene_cuit == "N"){	
		var cuit = "";
	}else{
		var cuit = txtcuit1.value+txtcuit2.value+txtcuit3.value;
	}
	
	if(txtcodigo.value.length > 0 && txtcodigo.value != "0"){
		if(txtrazon.value != ""){

			if(cuit != "" ){
				validar_cuit(cuit);					// valida el CUIT ingrsado
				if(error != ""){
					divMensaje.innerHTML=error;
					document.frm_mod.cuit1_mod.focus()
					return error;
				}
			}
			if(txtdir.value != ""){
				if(txtprov != "-- seleccione pais --"){
					if(txtloca != "-- seleccione provincia --"){
						if(txtzona != "-- seleccione localidad --"){						
							//if(txttel.value != ""){
													divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
													boton.disabled=true; 				    // Deshabilito el boton y los input
													cancelar.disabled=true; 				    // Deshabilito el boton y los input
													txtcodigo.disabled=true; 
													txtrazon.disabled=true; 
													txtcuit1.disabled=true; 
													txtcuit2.disabled=true; 
													txtcuit3.disabled=true; 
													document.frm_mod.lista_iva_mod.disabled=true; 
													txtdir.disabled=true; 
													document.frm_mod.lista_pais_mod.disabled=true; 
													document.frm_mod.lista_prov_mod.disabled=true; 
													document.frm_mod.lista_loca_mod.disabled=true; 
													document.frm_mod.lista_zona_mod.disabled=true; 
													txttel.disabled=true; 
													txtfax.disabled=true; 
													txtcel.disabled=true; 
													txtweb.disabled=true; 
													txtmail.disabled=true; 
													txtcontacto.disabled=true; 
													txtlim_cred.disabled=true; 
													document.frm_mod.lista_cat_mod.disabled=true;
													document.frm_mod.lista_ven_mod.disabled=true;
													document.frm_mod.lista_rep_mod.disabled=true;
													document.frm_mod.lista_forma_pago_mod.disabled=true;
													
													divMensaje.innerHTML="Modificando......."; 	// mensajes en el div
													var ajax=nuevoAjax();						// creo una instancia de ajax
													metodo="POST";								// asigno las variables de proceso
													url="modificar.php?";
													//var cuit = txtcuit1.value+txtcuit2.value+txtcuit3.value;
													
													variables="codigo_orig="+txtcodigo_orig.value+"&codigo="+txtcodigo.value+"&razon="+txtrazon.value+"&cuit="+cuit+"&iva="+txtiva+"&dir="+txtdir.value+"&pais="+txtpais+"&prov="+txtprov+"&localidad="+txtloca+"&zona="+txtzona+"&tel="+txttel.value+"&fax="+txtfax.value+"&cel="+txtcel.value+"&web="+txtweb.value+"&mail="+txtmail.value+"&contacto="+txtcontacto.value+"&lim_cred="+txtlim_cred.value+"&categoria="+txtcategoria+"&vendedor="+txtvendedor+"&repartidor="+txtrepartidor+"&fp="+txtfp;
													//alert(variables);
													ajax.open(metodo, url, true);
													ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
													ajax.send(variables);
													ajax.onreadystatechange=function(){ 
														if (ajax.readyState==4){
																if (ajax.responseText == "ok"){
																		buscar_cliente();
																		document.frm.codigo.focus();															
																}else{
																		divMensaje.innerHTML = ajax.responseText;
																		//divMensaje.innerHTML = "ERROR: El Cliente ya existe!!";
																		txtcodigo.disabled=false; 		// habilito el boton y los input
																		txtrazon.disabled=false; 
																		txtcuit1.disabled=false; 
																		txtcuit2.disabled=false; 
																		txtcuit3.disabled=false; 
																		document.frm_mod.lista_iva_mod.disabled=false; 
																		txtdir.disabled=false; 
																		document.frm_mod.lista_pais_mod.disabled=false; 
																		document.frm_mod.lista_prov_mod.disabled=false; 
																		document.frm_mod.lista_loca_mod.disabled=false;
																		document.frm_mod.lista_zona_mod.disabled=false;
																		txttel.disabled=false; 
																		txtfax.disabled=false; 
																		txtcel.disabled=false; 
																		txtweb.disabled=false; 
																		txtmail.disabled=false; 
																		txtcontacto.disabled=false; 
																		txtlim_cred.disabled=false; 
																		document.frm_mod.lista_cat_mod.disabled=false;
																		document.frm_mod.lista_ven_mod.disabled=false;
																		document.frm_mod.lista_rep_mod.disabled=false;	
																		document.frm_mod.lista_forma_pago_mod.disabled=false;
																		boton.disabled=false; 				// Habilito boton nuevamente
																		cancelar.disabled=false; 				// Habilito boton nuevamente
																		document.frm_mod.codigo_mod.focus()
																}
														} // fin de if (ajax.readyState==4)
													} // fin de funcion()
							/*}else{
								divMensaje.innerHTML="Debe ingresar el Telefono del Cliente";
								document.frm_mod.tel_mod.focus()
							}*/
						}else{
							divMensaje.innerHTML="Debe seleccionar una Localidad";
							document.frm_mod.lista_provincia_mod.focus()
						}	
					}else{
						divMensaje.innerHTML="Debe seleccionar una Provincia";
						document.frm_mod.lista_provincia_mod.focus()
					}	 
				}else{
					divMensaje.innerHTML="Debe seleccionar un Pais";
					document.frm_mod.lista_pais_mod.focus()
				}		 
			}else{
				divMensaje.innerHTML="Debe ingresar la Dirección del Cliente";
				document.frm_mod.direccion_mod.focus()
			}	
		}else{
			divMensaje.innerHTML="Debe ingresar la Razon Social del Cliente";
			document.frm_mod.razon_mod.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo del Cliente";
		document.frm_mod.codigo_mod.focus()
	}
}
//--------------------------------------------------------------------------------------------------//
function buscar_cliente2(){
 	var divlistado=document.getElementById("listado"); 
	var boton=document.getElementById("enviar");
 	var txtcodigo = document.getElementById("codigo"); 			//codigo
	var txtrazon = document.getElementById("razon");			//razon
	var txtcuit1 = document.getElementById("cuit1");			//cuit
	var txtcuit2 = document.getElementById("cuit2");
	var txtcuit3 = document.getElementById("cuit3");
	var txtvendedor = document.frm.lista_ven_bus.value;
	var txtzona = document.frm.lista_zona_bus.value;

	divlistado.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"

	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtcodigo.disabled=true; 
	txtcuit1.disabled=true; 
	txtcuit2.disabled=true; 
	txtcuit3.disabled=true; 
	txtrazon.disabled=true; 
	document.frm.lista_ven_bus.disabled=true; 
	document.frm.lista_zona_bus.disabled=true; 

	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_cliente_proceso.php?";
	var cuit = txtcuit1.value+txtcuit2.value+txtcuit3.value;
	if(txtcodigo.value == "" && cuit == "" && txtrazon.value == "" && txtvendedor == "TODOS" && txtzona == "TODOS" ){
		variables="nombre=TODOS";
	}else{
		variables="codigo="+txtcodigo.value+"&cuit="+cuit+"&razon="+txtrazon.value  +"&vendedor="+txtvendedor+"&zona="+txtzona;
	}

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtcodigo.value="";								// Borro el contenido del input
				txtcuit1.value="";								// Borro el contenido del input
				txtcuit2.value="";								// Borro el contenido del input
				txtcuit3.value="";								// Borro el contenido del input
				txtrazon.value="";								// Borro el contenido del input
			
				boton.disabled=false; 										// Deshabilito el boton y el input para evitar dobles ingresos
				txtcodigo.disabled=false; 
				txtcuit1.disabled=false; 
				txtcuit2.disabled=false; 
				txtcuit3.disabled=false; 
				txtrazon.disabled=false; 
				document.frm.lista_ven_bus.disabled=false; 
				document.frm.lista_zona_bus.disabled=false; 
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.codigo.focus()
				listar_vendedor_cliente_bus();
				listar_zona_cliente_bus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function activar_desactivar_cliente(codigo,valor,id){
 if(valor == 'N'){
	var palabra = 'Desactivar';
 }else{
	var palabra = 'Activar';
 }
 
 if (confirm('¿Está seguro que desea ' + palabra + ' este Cliente?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="activar_desactivar_cliente.php?";
	variables="codigo="+codigo+"&valor="+valor;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "sin_permiso"){
					if(valor == 'N'){
						var imagen = '../imagenes/activo_no.gif';
						var nuevo_valor = 'S';
					}else{
						var imagen = '../imagenes/activo.gif';
						var nuevo_valor = 'N';
					}
					
					document.getElementById(id).src = imagen;	
					document.getElementById(id).name = nuevo_valor;	
					
					//alert(ajax.responseText);
					//buscar_pais()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------GRUPO----------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function pasar_foco_grupo_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.codigo.value.length > 0  ) {
                document.frm.nombre.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_grupo_2(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.nombre.value.length > 0  ) {
                document.frm.enviar.click()
                return 0;		  
		   }	
     }
}
//-----------------------MODIFICAR------------------------------//
function pasar_foco_grupo_3(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.codigo_mod.value.length > 0  ) {
                document.frm_mod.nombre_mod.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_grupo_4(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.enviar_mod.click()
                return 0;		  
		   }	
     }
}
//-----------------------BUSCAR------------------------------//
function pasar_foco_grupo_5(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.codigo.value.length > 0  ) {
               document.frm.enviar.click()
		   }else{
			    document.frm.nombre.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_grupo_6(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm.enviar.click()
                return 0;		  
     }
}
//--------------------------------------------------------------------------------------------------//
function registrar_grupo(){
	 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	 var boton=document.getElementById("enviar");
	
	 var txtcodigo = document.getElementById("codigo");
	 var txtnombre = document.getElementById("nombre");
		 if(document.frm.codigo.value != ""){ 
				 if(document.frm.nombre.value != ""){
						divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
						boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
						txtcodigo.disabled=true; 
						txtnombre.disabled=true; 
						divMensaje.innerHTML="Buscando......."; // mensajes en el div
						var ajax=nuevoAjax();					// creo una instancia de ajax
						metodo="POST";							// asigno las variables de proceso
						url="alta_grupo.php?";
						variables="codigo="+txtcodigo.value+"&nombre="+txtnombre.value;
					
						ajax.open(metodo, url, true);
						ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						ajax.send(variables);
						ajax.onreadystatechange=function(){ 
								if (ajax.readyState==4){
									txtcodigo.value="";			// Borro el contenido del input
									txtnombre.value="";			// Borro el contenido del input
									boton.disabled=false; 		// Habilito campos y boton nuevamente
									txtcodigo.disabled=false;
									txtnombre.disabled=false; 
									divMensaje.innerHTML=ajax.responseText; // imprime la salida
									buscar_grupo();
								} // fin de if (ajax.readyState==4)
							} // fin de funcion()
				 }else{
					divMensaje.innerHTML="Debe ingresar el nombre del Grupo";
					document.frm.nombre.focus()
				 }
 			}else{
				divMensaje.innerHTML="Debe ingresar el Codigo del Grupo";
				document.frm.codigo.focus()
			}				 
}
//--------------------------------------------------------------------------------------------------//
function buscar_grupo(){
 	var divlistado=document.getElementById("listado"); 

	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_grupo_proceso.php?";
	variables="nombre=todos";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.codigo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
function buscar_grupo2(){
 	var divlistado=document.getElementById("listado"); 
	var boton=document.getElementById("enviar");
 	var txtcodigo = document.getElementById("codigo");
	var txtnombre = document.getElementById("nombre");

	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtcodigo.disabled=true; 
	txtnombre.disabled=true; 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_grupo_proceso.php?";
	if(document.frm.codigo.value == "" && document.frm.nombre.value == ""){
		variables="nombre=todos";
	}
	else{
		variables="codigo="+txtcodigo.value+"&nombre="+txtnombre.value;
	}
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtcodigo.value="";								// Borro el contenido del input
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtcodigo.disabled=false; 
				txtnombre.disabled=false; 
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.codigo.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_grupo(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_grupo_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					document.frm_mod.codigo_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_grupo_db(){
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
	var cancelar=document.getElementById("cancelar_mod");
 	var txtcodigo_orig = document.getElementById("oculto_mod");
	var txtcodigo = document.getElementById("codigo_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var ajax=nuevoAjax();										// creo una instancia de ajax
	if(document.frm_mod.codigo_mod.value != ""){	
		if(document.frm_mod.nombre_mod.value != ""){	
				divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
				boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
				cancelar.disabled=true; 
				txtcodigo.disabled=true; 
				txtnombre.disabled=true; 
				divMensaje.innerHTML="Modificando.......";					// mensajes en el div
				
				metodo="POST";												// asigno las variables de proceso
				url="modificar.php?";
				variables="codigo_grupo_orig="+txtcodigo_orig.value+"&codigo_grupo_mod="+txtcodigo.value+"&nombre_grupo_mod="+txtnombre.value;
				//alert(variables);
				ajax.open(metodo, url, true);
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send(variables);
				ajax.onreadystatechange=function(){ 
						if (ajax.readyState==4){
							if (ajax.responseText == "ok"){
								buscar_grupo()
							}else{
								//divMensaje.innerHTML = ajax.responseText;
								divMensaje.innerHTML = "ERROR: El Grupo ya existe!!";
								cancelar.disabled=false;						// Habilito campos y boton nuevamente
								boton.disabled=false; 							
								document.frm_mod.codigo_mod.disabled=false;
								document.frm_mod.nombre_mod.disabled=false; 
								document.frm_mod.codigo_mod.focus()
							}
						} // fin de if (ajax.readyState==4)
					} // fin de funcion()
		 }else{
			divMensaje.innerHTML="Debe ingresar el nombre del Grupo";
			document.frm_mod.nombre_mod.focus()
		 }	
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo del Grupo";
		document.frm_mod.codigo_mod.focus()
	}	 
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------MARCA----------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_grupo(){		
	var contenedor=document.getElementById("grupos"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
    url="listar_grupo.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.nombre.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//------------------------------------------------------------------------------------------------------//
function pasar_foco_marca_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.codigo.value.length > 0  ) {
                document.frm.nombre.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_marca_2(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.nombre.value.length > 0  ) {
                document.frm.lista_grupo.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_marca_3(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	     var txtgrupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].text
		  if( txtgrupo != "" ) {
               document.frm.enviar.click()
                return 0;		  
		   }	
     }
}
//-----------------------MODIFICAR------------------------------//
function pasar_foco_marca_4(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.codigo_mod.value.length > 0  ) {
                document.frm_mod.nombre_mod.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_marca_5(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.lista_grupo_mod.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_marca_6(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
                document.frm_mod.enviar_mod.click()
                return 0;		  
     }
}
//-----------------------BUSCAR------------------------------//
function pasar_foco_marca_7(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.codigo.value.length > 0  ) {
               document.frm.enviar.click()
		   }else{
			    document.frm.nombre.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_marca_8(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.nombre.value.length > 0  ) {
               document.frm.enviar.click()
		   }else{
			    document.frm.lista_grupo.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_marca_9(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
               document.frm.enviar.click()
     }
}
//--------------------------------------------------------------------------------------------------//
function registrar_marca(){
	 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	 var boton=document.getElementById("enviar");
	
	 var txtcodigo = document.getElementById("codigo");
	 var txtnombre = document.getElementById("nombre");
     var txtgrupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].value;
		 if(document.frm.codigo.value != ""){ 
				 if(document.frm.nombre.value != ""){
						divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
						boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
						txtcodigo.disabled=true; 
						txtnombre.disabled=true; 
						document.frm.lista_grupo.disabled=true;
						
						divMensaje.innerHTML="Modificando......."; // mensajes en el div
						var ajax=nuevoAjax();					// creo una instancia de ajax
						metodo="POST";							// asigno las variables de proceso
						url="alta_marca.php?";
						variables="codigo="+txtcodigo.value+"&nombre="+txtnombre.value+"&grupo="+txtgrupo;
						//alert(variables);
						ajax.open(metodo, url, true);
						ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						ajax.send(variables);
						ajax.onreadystatechange=function(){ 
								if (ajax.readyState==4){
									txtcodigo.value="";			// Borro el contenido del input
									txtnombre.value="";			// Borro el contenido del input
									boton.disabled=false; 		// Habilito campos y boton nuevamente
									txtcodigo.disabled=false;
									txtnombre.disabled=false; 
									document.frm.lista_grupo.disabled=false;
									divMensaje.innerHTML=ajax.responseText; // imprime la salida
									buscar_marca();
									document.frm.codigo.focus();
								} // fin de if (ajax.readyState==4)
							} // fin de funcion()

				 }else{
					divMensaje.innerHTML="Debe ingresar el nombre de la Marca";
					document.frm.nombre.focus()
				 }
 			}else{
				divMensaje.innerHTML="Debe ingresar el Codigo de la Marca";
				document.frm.codigo.focus()
			}				 
}
//--------------------------------------------------------------------------------------------------//
function buscar_marca(){
 	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_marca_proceso.php?";
	variables="nombre=todos";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.codigo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

function listar_grupo_buscar(){
	var contenedor=document.getElementById("grupos"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_grupo_buscar.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.codigo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
function buscar_marca2(){
 	var divlistado=document.getElementById("listado"); 
	var boton=document.getElementById("enviar");
 	var txtcodigo = document.getElementById("codigo");
    var txtnombre = document.getElementById("nombre");
	var txtgrupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].value;
	

	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtcodigo.disabled=true; 
	txtnombre.disabled=true; 
	document.frm.lista_grupo.disabled=true;
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_marca_proceso.php?";
	if(document.frm.codigo.value == "" && document.frm.nombre.value == "" && txtgrupo == 'TODOS'){
		variables="nombre=todos";
	}
	else{
		variables="codigo="+txtcodigo.value+"&nombre="+txtnombre.value+"&cod_grupo="+txtgrupo;
	}
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtcodigo.value="";								// Borro el contenido del input
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtcodigo.disabled=false; 
				txtnombre.disabled=false; 
				document.frm.lista_grupo.disabled=false;
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.codigo.focus();
				listar_grupo_buscar();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_grupo_marca_mod(codigo,grupo){
	var contenedor=document.getElementById("grupos_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_grupo_marca_mod.php?";
	variables = "codigo="+codigo+"&grupo="+grupo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_marca(codigo,grupo){
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_marca_bus="+codigo+"&grupo="+grupo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					listar_grupo_marca_mod(codigo,grupo);
					document.frm_mod.codigo_mod.focus();
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_marca_db(){
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
	var cancelar=document.getElementById("cancelar_mod");
 	
	var txtcodigo_orig = document.getElementById("oculto_mod");
	var txtcodigo = document.getElementById("codigo_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var txtgrupo_orig = document.getElementById("oculto_grupo_mod");
	var txtgrupo = document.frm_mod.lista_grupo_mod.options[document.frm_mod.lista_grupo_mod.selectedIndex].value;
	
	var ajax=nuevoAjax();										// creo una instancia de ajax
	if(document.frm_mod.codigo_mod.value != ""){	
		if(document.frm_mod.nombre_mod.value != ""){	
				divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
				boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
				cancelar.disabled=true; 
				txtcodigo.disabled=true; 
				txtnombre.disabled=true; 
				document.frm_mod.lista_grupo_mod.disabled=true;
				
				divMensaje.innerHTML="Modificando.......";					// mensajes en el div
				
				metodo="POST";												// asigno las variables de proceso
				url="modificar.php?";
				variables="codigo_marca_orig="+txtcodigo_orig.value+"&codigo_marca_mod="+txtcodigo.value+"&nombre_marca_mod="+txtnombre.value+"&cod_grupo_mod="+txtgrupo+"&cod_grupo_orig="+txtgrupo_orig.value;
				//alert(variables);
				ajax.open(metodo, url, true);
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send(variables);
				ajax.onreadystatechange=function(){ 
						if (ajax.readyState==4){
							if (ajax.responseText == "ok"){
								buscar_marca();
								document.frm.codigo.focus();
							}else{
								//divMensaje.innerHTML = ajax.responseText;
								divMensaje.innerHTML = "ERROR: La Marca ya existe!!";
								cancelar.disabled=false;						// Habilito campos y boton nuevamente
								boton.disabled=false; 							
								document.frm_mod.codigo_mod.disabled=false;
								document.frm_mod.nombre_mod.disabled=false; 
								document.frm_mod.lista_grupo_mod.disabled=false;
								document.frm_mod.codigo_mod.focus();
							}
						} // fin de if (ajax.readyState==4)
					} // fin de funcion()
		 }else{
			divMensaje.innerHTML="Debe ingresar el nombre de la Marca";
			document.frm_mod.nombre_mod.focus()
		 }	
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo de la Marca";
		document.frm_mod.codigo_mod.focus()
	}	 
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------VARIEDAD-------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_grupo_variedad(){
	var contenedor=document.getElementById("grupos"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
    url="listar_grupo_variedad.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.nombre.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_marca_variedad(){
	var contenedor=document.getElementById("marcas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
    url="listar_marca_variedad.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.nombre.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//------------------------------------------------------------------------------------------------------//
function pasar_foco_vari_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.codigo.value.length > 0  ) {
                document.frm.nombre.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_vari_2(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.nombre.value.length > 0  ) {
                document.frm.lista_grupo.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_vari_3(e,cod_grupo){
tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	     var txtgrupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].value;
		  if( txtgrupo != "" ) {
					var contenedor=document.getElementById("marcas"); 
					var ajax=nuevoAjax();										  // creo una instancia de ajax
						metodo="POST";												  // asigno las variables de proceso
					url="listar_marca_variedad.php?";
					variables="cod_grupo="+cod_grupo;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
									contenedor.innerHTML=ajax.responseText; 		// imprime la salida
									document.frm.lista_marca.focus()
									return 0;									
									//document.frm.nombre.focus();	
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
		   }	
     }
}
function pasar_foco_vari_4(e,cod_grupo){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	     var txtmarca = document.frm.lista_marca.options[document.frm.lista_marca.selectedIndex].text
		  if( txtmarca != "" ) {
				document.frm.enviar.click()
				return 0;									
		   }	
     }
}
//-----------------------MODIFICAR------------------------------//
function pasar_foco_vari_5(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.codigo_mod.value.length > 0  ) {
                document.frm_mod.nombre_mod.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_vari_6(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.lista_grupo_mod.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_vari_7(e,cod_grupo){
tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	     var txtgrupo = document.frm_mod.lista_grupo_mod.options[document.frm_mod.lista_grupo_mod.selectedIndex].text
		  if( txtgrupo != "" ) {
					var contenedor=document.getElementById("marcas_mod"); 
					var ajax=nuevoAjax();										  // creo una instancia de ajax
						metodo="POST";												  // asigno las variables de proceso
					url="listar_marca_vari_mod.php?";
					variables="cod_grupo="+cod_grupo;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
									contenedor.innerHTML=ajax.responseText; 		// imprime la salida
									document.frm_mod.lista_marca_mod.focus()
									return 0;									
									//document.frm.nombre.focus();	
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
		   }	
     }
}
function pasar_foco_vari_8(e,cod_grupo){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	     var txtmarca = document.frm_mod.lista_marca_mod.options[document.frm_mod.lista_marca_mod.selectedIndex].text
		  if( txtmarca != "" ) {
				document.frm_mod.enviar_mod.click()
				return 0;									
		   }	
     }
}
//-----------------------BUSCAR------------------------------//
function pasar_foco_vari_9(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.codigo.value.length > 0  ) {
               document.frm.enviar.click()
		   }else{
			    document.frm.nombre.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_vari_10(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.nombre.value.length > 0  ) {
               document.frm.enviar.click()
		   }else{
			    document.frm.lista_grupo.focus()
                return 0;		  
		   }	
     }
}

function pasar_foco_vari_11(e,cod_grupo){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	     var txtgrupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].text
		  if( txtgrupo != "" ) {
					var contenedor=document.getElementById("marcas"); 
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="listar_marca_buscar_vari.php?";
					variables="cod_grupo="+cod_grupo;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
									contenedor.innerHTML=ajax.responseText; 		// imprime la salida
									document.frm.lista_marca.focus()
									return 0;									
									//document.frm.nombre.focus();	
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
		   }	
     }
}

//--------------------------------------------------------------------------------------------------//
function registrar_variedad(){
	 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	 var boton=document.getElementById("enviar");
	
	 var txtcodigo = document.getElementById("codigo");
	 var txtnombre = document.getElementById("nombre");
     var txtgrupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].value;
	 var txtmarca = document.frm.lista_marca.options[document.frm.lista_marca.selectedIndex].value;
		 if(document.frm.codigo.value != ""){ 
				 if(document.frm.nombre.value != ""){
									divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
									boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
									txtcodigo.disabled=true; 
									txtnombre.disabled=true; 
									document.frm.lista_grupo.disabled=true;
									document.frm.lista_marca.disabled=true;
									
									divMensaje.innerHTML="Modificando......."; // mensajes en el div
									var ajax=nuevoAjax();					// creo una instancia de ajax
									metodo="POST";							// asigno las variables de proceso
									url="alta_variedad.php?";
									variables="codigo="+txtcodigo.value+"&nombre="+txtnombre.value+"&grupo="+txtgrupo+"&marca="+txtmarca;
									//alert(variables);
									
									ajax.open(metodo, url, true);
									ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
									ajax.send(variables);
									ajax.onreadystatechange=function(){ 
											if (ajax.readyState==4){
												txtcodigo.value="";			// Borro el contenido del input
												txtnombre.value="";			// Borro el contenido del input
												boton.disabled=false; 		// Habilito campos y boton nuevamente
												txtcodigo.disabled=false;
												txtnombre.disabled=false; 
												document.frm.lista_grupo.disabled=false;
												document.frm.lista_marca.disabled=false;
												divMensaje.innerHTML=ajax.responseText; // imprime la salida
												buscar_variedad();
												document.frm.codigo.focus();
											} // fin de if (ajax.readyState==4)
										} // fin de funcion()

				 }else{
					divMensaje.innerHTML="Debe ingresar el nombre de la Variedad";
					document.frm.nombre.focus()
				 }
 			}else{
				divMensaje.innerHTML="Debe ingresar el Codigo de la Variedad";
				document.frm.codigo.focus()
			}				 
}
//--------------------------------------------------------------------------------------------------//
function buscar_variedad(){
 	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_variedad_proceso.php?";
	variables="nombre=todos";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.codigo.focus();
				return 0;
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_grupo_buscar_vari(){
	var contenedor=document.getElementById("grupos"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
    url="listar_grupo_buscar_vari.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.nombre.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_marca_buscar_vari(){
	var contenedor=document.getElementById("marcas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
    url="listar_marca_buscar_vari.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.nombre.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//------------------------------------------------------------------------------------------------------//
function buscar_variedad2(){
 	var divlistado=document.getElementById("listado"); 
	var boton=document.getElementById("enviar");
 	var txtcodigo = document.getElementById("codigo");
    var txtnombre = document.getElementById("nombre");
	var txtgrupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].value;
	var txtmarca = document.frm.lista_marca.options[document.frm.lista_marca.selectedIndex].value;

	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtcodigo.disabled=true; 
	txtnombre.disabled=true; 
	document.frm.lista_grupo.disabled=true;
	document.frm.lista_marca.disabled=true;	
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_variedad_proceso.php?";
	if((document.frm.codigo.value == "") && (document.frm.nombre.value == "") && (txtgrupo == 'TODOS') && (txtmarca == 'TODOS')){
		//variables="codigo="+txtcodigo.value+"&nombre="+txtnombre.value+"&cod_grupo="+txtgrupo+"&cod_marca="+txtmarca;
		variables="nombre=todos";
	}
	else{
		variables="codigo="+txtcodigo.value+"&nombre="+txtnombre.value+"&cod_grupo="+txtgrupo+"&cod_marca="+txtmarca;
	}
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtcodigo.value="";								// Borro el contenido del input
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtcodigo.disabled=false; 
				txtnombre.disabled=false; 
				document.frm.lista_grupo.disabled=false;
				document.frm.lista_marca.disabled=false;
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				listar_grupo_buscar_vari();
				listar_marca_buscar_vari();
				document.frm.codigo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_grupo_vari_mod(codigo,marca,grupo){
	var contenedor=document.getElementById("grupos_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_grupo_vari_mod.php?";
	variables = "codigo="+codigo+"&marca="+marca+"&grupo="+grupo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
function listar_marca_vari_mod(codigo,marca,grupo){
	var contenedor=document.getElementById("marcas_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_marca_vari_mod.php?";
	variables = "codigo="+codigo+"&marca="+marca+"&grupo="+grupo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_variedad(codigo,marca,grupo){
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_vari_bus="+codigo+"&marca="+marca+"&grupo="+grupo;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					listar_grupo_vari_mod(codigo,marca,grupo)
					listar_marca_vari_mod(codigo,marca,grupo)
					document.frm_mod.codigo_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_variedad_db(){
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
	var cancelar=document.getElementById("cancelar_mod");
 	
	var txtcodigo_orig = document.getElementById("oculto_mod");
	var txtmarca_orig = document.getElementById("oculto_marca_mod");
	var txtgrupo_orig = document.getElementById("oculto_grupo_mod");
	
	var txtcodigo = document.getElementById("codigo_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var txtgrupo = document.frm_mod.lista_grupo_mod.options[document.frm_mod.lista_grupo_mod.selectedIndex].value;
	var txtmarca = document.frm_mod.lista_marca_mod.options[document.frm_mod.lista_marca_mod.selectedIndex].value;
	
	var ajax=nuevoAjax();										// creo una instancia de ajax
	if(document.frm_mod.codigo_mod.value != ""){	
		if(document.frm_mod.nombre_mod.value != ""){	
				divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
				boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
				cancelar.disabled=true; 
				txtcodigo.disabled=true; 
				txtnombre.disabled=true; 
				document.frm_mod.lista_grupo_mod.disabled=true;
				document.frm_mod.lista_marca_mod.disabled=true;
				
				divMensaje.innerHTML="Modificando.......";					// mensajes en el div
				
				metodo="POST";												// asigno las variables de proceso
				url="modificar.php?";
				variables="codigo_variedad_orig="+txtcodigo_orig.value+"&codigo_variedad_mod="+txtcodigo.value+"&nombre_variedad_mod="+txtnombre.value+"&cod_grupo_mod="+txtgrupo+"&cod_marca_mod="+txtmarca+"&cod_grupo_orig="+txtgrupo_orig.value+"&cod_marca_orig="+txtmarca_orig.value;
				//alert(variables);
				ajax.open(metodo, url, true);
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send(variables);

				ajax.onreadystatechange=function(){ 
						if (ajax.readyState==4){
							if (ajax.responseText == "ok"){
								buscar_variedad()
							}else{
								//divMensaje.innerHTML = ajax.responseText;
								divMensaje.innerHTML = "ERROR: La Variedad ya existe!!";
								cancelar.disabled=false;						// Habilito campos y boton nuevamente
								boton.disabled=false; 							
								document.frm_mod.codigo_mod.disabled=false;
								document.frm_mod.nombre_mod.disabled=false; 
								document.frm_mod.lista_grupo_mod.disabled=false;
								document.frm_mod.lista_marca_mod.disabled=false;
								document.frm_mod.codigo_mod.focus()
							}
						} // fin de if (ajax.readyState==4)
					} // fin de funcion()
		 }else{
			divMensaje.innerHTML="Debe ingresar el nombre de la Variedad";
			document.frm_mod.nombre_mod.focus()
		 }	
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo de la Variedad";
		document.frm_mod.codigo_mod.focus()
	}	 
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------MEDIDA---------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function pasar_foco_med_registrar(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.nombre.value.length > 0  ) {
                document.frm.enviar.click()
                return 0;		  
		   }	
     }
}
//------------------------------------------buscar--------------------------------------------------//
function pasar_foco_med_buscar(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.nombre.value.length > 0  ) {
                document.frm.enviar.click()
           }else{
		        document.frm.enviar.click()
			   //document.frm.lista_articulo.focus()
		   }
		   return 0;
	  
     }
}
//---------------------------------------modificar-----------------------------------------------------//
function pasar_foco_med_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.enviar_mod.click()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function registrar_medida(){
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var boton=document.getElementById("enviar");
 var txtnombre = document.getElementById("nombre");
 if(document.frm.nombre.value != ""){
	divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	divMensaje.innerHTML="Buscando......."; // mensajes en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
    url="alta_medida.php?";
	variables="nombre="+txtnombre.value;

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";			// Borro el contenido del input
				boton.disabled=false; 		// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				divMensaje.innerHTML=ajax.responseText; // imprime la salida
				document.frm.nombre.focus()
				buscar_medida()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
 }else{
	divMensaje.innerHTML="Debe ingresar el nombre de la Medida";
	document.frm.nombre.focus()
 }
}
//--------------------------------------------------------------------------------------------------//
function buscar_medida(){
 	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_medida_proceso.php?";
	variables="nombre=todos";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_medida(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_med_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					document.frm_mod.nombre_mod.focus();
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_medida_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod"); 
 	var boton=document.getElementById("enviar_mod");
 	var txtcodigo = document.getElementById("oculto_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var ajax=nuevoAjax();										// creo una instancia de ajax
 if(document.frm_mod.nombre_mod.value != ""){	
 	divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	divMensaje.innerHTML="Modificando.......";					// mensajes en el div
	
	metodo="POST";												// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_med_mod="+txtcodigo.value+"&nombre_med_mod="+txtnombre.value;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if (ajax.responseText == "ok"){
					divlistado.innerHTML="<div class='advertencia'>Medida Modificada!!</div>";
					buscar_medida()
				}else{
					divMensaje.innerHTML = "ERROR: La Medida ya existe!!";
					boton.disabled=false; 							// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					document.frm_mod.nombre_mod.focus()
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
 }else{
	divMensaje.innerHTML="Debe ingresar el nombre de la Medida";
	document.frm_mod.nombre_mod.focus()
 }	
}
//--------------------------------------------------------------------------------------------------//
function buscar_medida2(){
 	var divlistado=document.getElementById("listado"); 
	var boton=document.getElementById("enviar");
 	var txtnombre = document.getElementById("nombre");
	//var txtarticulo = document.frm.lista_articulo.options[document.frm.lista_articulo.selectedIndex].text;
	//var txtcliente = document.frm.lista_cliente.options[document.frm.lista_cliente.selectedIndex].text;
	
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_medida_proceso.php?";
	if(document.frm.nombre.value == ""){ //  && txtarticulo == "TODOS" && txtcliente == "TODOS" ){
		variables="nombre=todos";
	}
	else{
		variables="nombre="+txtnombre.value; //+"&articulo="+txtarticulo+"&cliente="+txtcliente;
	}
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
				boton.disabled=false; 							// Habilito campos y boton nuevamente
				txtnombre.disabled=false; 
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ARTICULO-------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////


/********************************************************************************/
//-----PARA USAR EN LAS PAGINAS DONDE USAN GRUPOS MARCAS VARIEDADES-------------//
/********************************************************************************/
function listar_grupos_art(){
	var contenedor=document.getElementById("grupos"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_grupos_art.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.lista_grupo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_marcas_art(){
	var contenedor=document.getElementById("marcas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_marcas_art.php";
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
function listar_variedades_art(){
	var contenedor=document.getElementById("variedades"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_variedades_art.php";
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
function listar_marca_de_grupo(e,cod_grupo){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){	
			var contenedor=document.getElementById("marcas"); 
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="select_marcas_art.php?";
			variables = "cod_grupo="+cod_grupo;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm.lista_marca.focus()
					} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
}
//--------------------------------------------------------------------------------------------------//
function listar_vari_de_marca(e,cod_marca){
	var grupo = document.frm.lista_marca.options[document.frm.lista_marca.selectedIndex].id;
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){	
			var contenedor=document.getElementById("variedades"); 
			url="select_variedades_art.php?";			
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			variables = "cod_marca="+cod_marca+"&grupo="+grupo;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm.lista_variedad.focus()
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
	}
}
/********************************************************************************/
//-----FIN DE PARA USAR EN LAS PAGINAS DONDE USAN GRUPOS MARCAS VARIEDADES------//
/********************************************************************************/
function listar_iva_art(){
	var contenedor=document.getElementById("iva"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_iva_articulo.php";
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


function pasar_foco_art_1(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txtvari = document.frm.lista_variedad.options[document.frm.lista_variedad.selectedIndex].text;
	if ( tecla==13){
			if ( txtvari != "-- seleccione marca --" && txtvari != ""){			
					document.frm.codigo.focus()
					return 0;
			}
	}
}
//============================================================================================//
function buscar_cod_sig_art(){
		var grupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].text;
		var marca = document.frm.lista_marca.options[document.frm.lista_marca.selectedIndex].text;
		var variedad = document.frm.lista_variedad.options[document.frm.lista_variedad.selectedIndex].text;
					
		var contenedor=document.getElementById("codigo"); 
		url="buscar_max_articulo.php?";			
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		variables = "&cod_vari="+variedad+"&cod_marca="+marca+"&cod_grupo="+grupo;
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							document.frm.codigo.value=ajax.responseText; 		// imprime la salida
							document.frm.codigo.focus()
				} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}



function pasar_foco_art_2(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.codigo.value.length > 0  ) {
				document.frm.desc.focus()
                return 0;		  
		   }	
     }
	 if ( tecla==113 ){    
	 	buscar_cod_sig_art();
	 }
	 
}
function pasar_foco_art_3(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.desc.value.length > 0  ) {
                document.frm.lista_prov.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_art_4(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.lista_prov.value.length > 0  ) {
                document.frm.precio_costo.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_art_5(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.precio_costo.value.length > 0  ) {
                document.frm.unidad_bulto.focus();
				calcular_utilidad_alta_articulo();
                return 0;		 
		   }	
     }
}

function calcular_utilidad_alta_articulo(){
	var cant_cajas = document.frm.elements.length - 2;			
	for (i=19; i < cant_cajas; i++){ 	// verifico que todas las categorias tengan un precio
		//var txt_nombre_cat = document.frm.elements[i].name;
		if(document.frm.elements[i].title != ""){
			document.frm.elements[i].value =  decimal_precio(parseFloat( document.frm.precio_costo.value) + (parseFloat (document.frm.precio_costo.value) * parseFloat (document.frm.elements[i].alt)/100)); 
			//return 0;
		}
	}	
}

function pasar_foco_art_6(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.unidad_bulto.value.length > 0  ) {
                document.frm.medida.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_7(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.medida.value.length > 0  ) {
                document.frm.lista_medida.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_8(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.lista_medida.value.length > 0  ) {
                document.frm.peso.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_9(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.peso.value.length > 0  ) {
                document.frm.retornable.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_10(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	            document.frm.stock_actual.focus()
                return 0;		 
     }
}
function pasar_foco_art_11(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.stock_actual.value.length > 0  ) {
                document.frm.stock_min.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_12(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.stock_min.value.length > 0  ) {
                document.frm.stock_max.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_13(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.stock_max.value.length > 0  ) {
                document.frm.vta.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_14(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.vta.value.length > 0  ) {
                document.frm.transporte.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_15(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.transporte.value.length > 0  ) {
				document.frm.lista_iva.focus();
                return 0;		 
		   }	
     }
}

function pasar_foco_art_16(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
            i=19;
			document.frm.elements[i].focus();
            return 0;		 
     }
}

function pasar_foco_art_17(e,i,fin){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			i=i+19;
			fin=fin+19;
			//alert(i-1+","+fin);
			if(document.frm.elements[i-1].value.length > 0){	 
					 if(i < fin){
							document.frm.elements[i].focus()
					 }else{
							 document.frm.enviar.click();
					 }
					 return 0;		 
			}
     }
}
//------------------------modificar-----------------------//
function listar_marca_de_grupo_mod(e,cod_grupo){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){	
			var contenedor=document.getElementById("marcas_mod"); 
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="select_marcas_art_mod.php?";
			variables = "cod_grupo="+cod_grupo;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm_mod.lista_marca_mod.focus()
					} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
}
//--------------------------------------------------------------------------------------------------//
function listar_vari_de_marca_mod(e,cod_marca){
	var grupo = document.frm_mod.lista_grupo_mod.options[document.frm_mod.lista_grupo_mod.selectedIndex].value;
	//alert(grupo);
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){	
			var contenedor=document.getElementById("variedades_mod"); 
			url="select_variedades_art_mod.php?";			
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			variables = "cod_marca="+cod_marca+"&grupo="+grupo;
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
								contenedor.innerHTML=ajax.responseText; 		// imprime la salida
								document.frm_mod.lista_vari_mod.focus()
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
	}
}
//---------------------------------------------------------------------------------------------------------//
function pasar_foco_art_1_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txtvari = document.frm_mod.lista_vari_mod.options[document.frm_mod.lista_vari_mod.selectedIndex].text;
	if ( tecla==13){
			if ( txtvari != ""){			
					document.frm_mod.codigo_mod.focus()
					return 0;
			}
	}
}
function pasar_foco_art_2_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.codigo_mod.value.length > 0  ) {
                document.frm_mod.desc_mod.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_art_3_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.desc_mod.value.length > 0  ) {
                document.frm_mod.lista_prov_mod.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_art_4_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.lista_prov_mod.value.length > 0  ) {
                document.frm_mod.precio_costo_mod.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_art_5_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.precio_costo_mod.value.length > 0  ) {
                document.frm_mod.unidad_bulto_mod.focus();
				calcular_utilidad_alta_articulo_mod();
                return 0;		 
		   }	
     }
}
function calcular_utilidad_alta_articulo_mod(){
	var cant_cajas = document.frm_mod.elements.length - 4;			
	for (i=19; i < cant_cajas; i++){ 	// verifico que todas las categorias tengan un precio
		//var txt_nombre_cat = document.frm.elements[i].name;
		if(document.frm_mod.elements[i].title != ""){
			document.frm_mod.elements[i].value =  decimal_precio(parseFloat( document.frm_mod.precio_costo_mod.value) + (parseFloat (document.frm_mod.precio_costo_mod.value) * parseFloat (document.frm_mod.elements[i].alt)/100)); 
			//return 0;
		}
	}	
}
function pasar_foco_art_6_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.unidad_bulto_mod.value.length > 0  ) {
                document.frm_mod.medida_mod.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_7_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.medida_mod.value.length > 0  ) {
                document.frm_mod.lista_medida_mod.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_8_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.lista_medida_mod.value.length > 0  ) {
                document.frm_mod.peso_mod.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_9_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.peso_mod.value.length > 0  ) {
                document.frm_mod.retornable_mod.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_10_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.retornable_mod.value.length > 0  ) {
                document.frm_mod.stock_actual_mod.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_11_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.stock_actual_mod.value.length > 0  ) {
                document.frm_mod.stock_min_mod.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_12_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.stock_min_mod.value.length > 0  ) {
                document.frm_mod.stock_max_mod.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_13_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.stock_max_mod.value.length > 0  ) {
                document.frm_mod.vta_mod.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_14_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.vta_mod.value.length > 0  ) {
                document.frm_mod.transporte_mod.focus()
                return 0;		 
		   }	
     }
}
function pasar_foco_art_15_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.transporte_mod.value.length > 0  ) {
				//i=18;
				document.frm_mod.elements[18].focus()
                return 0;		 
		   }	
     }
}

function pasar_foco_art_16_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm_mod.transporte_mod.value.length > 0  ) {
				//i=19;
				document.frm_mod.elements[19].focus()
                return 0;		 
		   }	
     }
}

function pasar_foco_art_17_mod(e,i,fin){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			i=i+19;
			fin=fin+19;
			if(document.frm_mod.elements[i-1].value.length > 0){	 
					 if(i < fin){
							document.frm_mod.elements[i].focus()
					 }else{
							 document.frm_mod.enviar_mod.click();
					 }
					 return 0;		 
			}
     }
}
//-----------------------BUSCAR------------------------------//
function pasar_foco_art_1_bus(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.codigo.value.length > 0  ) {
               document.frm.enviar.click()
		   }else{
			    document.frm.desc.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_art_2_bus(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.desc.value.length > 0  ) {
               document.frm.enviar.click()
		   }else{
			    document.frm.lista_grupo.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_art_3_bus(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	    var txtgrupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].value
		var contenedor=document.getElementById("marcas"); 
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="listar_marca_buscar_art.php?";
		variables="cod_grupo="+txtgrupo;
		//alert(variables);
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.lista_marca.focus()
						return 0;									
						//document.frm.nombre.focus();	
				} // fin de if (ajax.readyState==4)
		} // fin de funcion()		
     }
}
function pasar_foco_art_4_bus(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	     var cod_marca = document.frm.lista_marca.options[document.frm.lista_marca.selectedIndex].value
	     var cod_grupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].value
		 var contenedor=document.getElementById("variedades"); 
		 var ajax=nuevoAjax();										  // creo una instancia de ajax
		 metodo="POST";												  // asigno las variables de proceso
		 url="listar_variedad_buscar_art.php?";
		 variables="cod_grupo="+cod_grupo+"&cod_marca="+cod_marca;
		 //alert(variables);
		 ajax.open(metodo, url, true);
		 ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		 ajax.send(variables);
		 ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							contenedor.innerHTML=ajax.responseText; 		// imprime la salida
							document.frm.lista_variedad.focus()
							return 0;									
							//document.frm.nombre.focus();	
					} // fin de if (ajax.readyState==4)
		} // fin de funcion()
     }
}

function pasar_foco_art_5_bus(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.lista_grupo.value != 'TODOS' && document.frm.lista_marca.value != 'TODOS' && document.frm.lista_variedad.value != 'TODOS') {
               document.frm.enviar.click()
		   }else{
			    document.frm.lista_prov.focus()
                return 0;		  
		   }	
     }
}

function pasar_foco_art_6_bus(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
               document.frm.enviar.click()
	}
}






//---------------------------------------------------------------------------------------------------//
function listar_grupo_buscar_art(){
	var contenedor=document.getElementById("grupos"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
    url="listar_grupo_buscar_art.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.nombre.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_marca_buscar_art(){
	var contenedor=document.getElementById("marcas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
    url="listar_marca_buscar_art.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.nombre.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//------------------------------------------------------------------------------------------------------//
function listar_variedad_buscar_art(){
	var contenedor=document.getElementById("variedades"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
    url="listar_variedad_buscar_art.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.nombre.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_proveedores_art(){
	var contenedor=document.getElementById("proveedores"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_proveedores_art.php";
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
function listar_medidas_art(){
	var contenedor=document.getElementById("medidas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_medidas_art.php";
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
function listar_categorias_art(){
	var contenedor=document.getElementById("categorias"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_categorias_art.php";
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
function listar_categorias_art_grupo(e,cod_grupo){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){	
		var contenedor=document.getElementById("categorias"); 
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="select_categorias_art.php";
		variables="codigo_grupo="+cod_grupo;
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							contenedor.innerHTML=ajax.responseText; 		// imprime la salida
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
}
//--------------------------------------------------------------------------------------------------//
function buscar_articulo(){
	var divlistado=document.getElementById("listado"); 
	divlistado.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_articulo_proceso.php?";
	variables="nombre=TODOS";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function registrar_art_por_cat(cant_cajas,cod_prod,variedad,marca,grupo){
	for (i=19; i < cant_cajas; i++){ 				// verifico que todas las categorias tengan un precio
		var txtcodigo_cat = document.frm.elements[i].id;
		var txtprecio_cat = document.frm.elements[i].value;
		//alert(txtcodigo_cat+","+cod_prod+","+variedad+","+marca+","+grupo+","+txtprecio_cat);
		var ajax=nuevoAjax();					// creo una instancia de ajax
		metodo="POST";							// asigno las variables de proceso
		url="alta_articulo_por_cat.php?";
		variables="codigo_cat="+txtcodigo_cat+"&codigo_prod="+cod_prod+"&variedad="+variedad+"&marca="+marca+"&grupo="+grupo+"&precio_cat="+txtprecio_cat;
		//alert(variables);
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
				//if (ajax.readyState==4){
					//alert(ajax.responseText);				
				//}
		}
	}
}
//--------------------------------------------------------------------------------------------------//
function registrar_articulo(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");
	var cant_cajas = document.frm.elements.length - 2;
	var cant_objetos = document.frm.elements.length;
	
 	var txtgrupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].text;
 	var txtmarca = document.frm.lista_marca.options[document.frm.lista_marca.selectedIndex].text;
 	var txtvari = document.frm.lista_variedad.options[document.frm.lista_variedad.selectedIndex].text;
	var txtcodigo = document.getElementById("codigo");
	var txtdesc = document.getElementById("desc");
	var txtprov = document.frm.lista_prov.options[document.frm.lista_prov.selectedIndex].value;
	var txtprecio_costo = document.getElementById("precio_costo");
	var txtunidad_bulto = document.getElementById("unidad_bulto");
	var txtmedida = document.getElementById("medida");
	var txtlista_medida = document.frm.lista_medida.options[document.frm.lista_medida.selectedIndex].value;
	var txtpeso = document.getElementById("peso");
	var txtretornable = document.frm.retornable.options[document.frm.retornable.selectedIndex].text;
	var txtstock_actual = document.getElementById("stock_actual");
	var txtstock_min = document.getElementById("stock_min");
	var txtstock_max = document.getElementById("stock_max");
	var txtvta = document.getElementById("vta");
	var txttransporte = document.getElementById("transporte");
	var txtlista_iva = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].value;
	
	var foto = "document.frm.foto.value";
	//alert(document.frm.foto.value);   // ruta completa + el nombre del archivo
	//alert(document.frm.foto.name);	// nombre del objeto
			if(txtgrupo != ""){
				if(txtmarca != "-- seleccione grupo --"){
					if(txtvari != "-- seleccione marca --"){
						if(txtcodigo.value != ""){
							if(txtdesc.value != ""){
								if(txtprov != ""){
									if(txtprecio_costo.value != ""){
										if(txtunidad_bulto.value != ""){
											if(txtmedida.value != ""){
												if(txtlista_medida != ""){
													if(txtpeso.value != ""){
														if(txtstock_actual.value != ""){
															if(txtstock_min.value != ""){
																if(txtstock_max.value != ""){
																	if(txtvta.value != ""){
																		if(txttransporte.value != ""){
																			for (i=19; i < cant_cajas; i++){ 	// verifico que todas las categorias tengan un precio
																				var txt_nombre_cat = document.frm.elements[i].name;
																				if(document.frm.elements[i].value == ""){
																					divMensaje.innerHTML="Debe ingresar un Precio para la categoria '"+txt_nombre_cat+"'";
																					document.frm.elements[i].focus()
																					return 0;
																				}
																			}	
																			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
																			for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
																				document.frm.elements[i].disabled=true;
																			}	
																			divMensaje.innerHTML="Buscando......."; // mensajes en el div
																			var ajax=nuevoAjax();					// creo una instancia de ajax
																			metodo="POST";							// asigno las variables de proceso
																			url="alta_articulo.php?";
																			variables="codigo="+txtcodigo.value+"&variedad="+txtvari+"&marca="+txtmarca+"&grupo="+txtgrupo+"&desc="+txtdesc.value+"&precio_costo="+txtprecio_costo.value+"&envase="+txtretornable+"&stock_actual="+txtstock_actual.value+"&stock_min="+txtstock_min.value+"&stock_max="+txtstock_max.value+"&foto="+foto+"&proveedor="+txtprov+"&medida="+txtmedida.value+"&cod_medida="+txtlista_medida+"&porc_vta="+txtvta.value+"&porc_trans="+txttransporte.value+"&unidad_bulto="+txtunidad_bulto.value+"&peso="+txtpeso.value+"&iva="+txtlista_iva
																			//alert(variables);
																																					
																			ajax.open(metodo, url, true);
																			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
																			ajax.send(variables);
																			ajax.onreadystatechange=function(){ 
																					if (ajax.readyState==4){
																						for (i=0; i < cant_objetos; i++){		//habilito todos los elementos
																							document.frm.elements[i].disabled=false;
																						}
																						var cod = txtcodigo.value;
																						if (ajax.responseText == "ok"){
																							registrar_art_por_cat(cant_cajas,cod,txtvari,txtmarca,txtgrupo);	//funcion para registrar los precios en las categorias																						
																							
																							txtcodigo.value="";						// Borro el contenido del input
																							txtdesc.value="";						// Borro el contenido del input
																							txtprecio_costo.value="";				// Borro el contenido del input
																							txtunidad_bulto.value="";				// Borro el contenido del input
																							txtmedida.value="";						// Borro el contenido del input
																							txtpeso.value="";						// Borro el contenido del input
																							txtstock_actual.value="";				// Borro el contenido del input
																							txtstock_min.value="";					// Borro el contenido del input
																							txtstock_max.value="";					// Borro el contenido del input
																							txtvta.value="";						// Borro el contenido del input
																							txttransporte.value="";					// Borro el contenido del input
																							
																							for (i=19; i < cant_cajas; i++){ 		// Borro el contenido del input de las categorias
																								document.frm.elements[i].value="";
																							}																						
																							
																							listar_grupos_art();
																							listar_marcas_art();
																							listar_variedades_art();
																							listar_proveedores_art();
																							listar_medidas_art();
																							listar_categorias_art();
																							listar_iva_art();
																							//if (confirm('¿Desea adjuntar la foto del Artículo?')){ 						// pregunta si desea adjuntar una foto
																							//	var win = window.open("upload_foto.php?codigo="+cod, "win",  "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=300,height=200,top=180,left=400");
																							//}
																							divMensaje.innerHTML="Aticulo Registrado!!"; // imprime la salida
																							buscar_articulo();
																						}else{
																							divMensaje.innerHTML="ERROR: El Aticulo ya existe";
																																														txtcodigo.value="";						// Borro el contenido del input
																							txtdesc.value="";						// Borro el contenido del input
																							txtprecio_costo.value="";				// Borro el contenido del input
																							txtunidad_bulto.value="";				// Borro el contenido del input
																							txtmedida.value="";						// Borro el contenido del input
																							txtpeso.value="";						// Borro el contenido del input
																							txtstock_actual.value="";				// Borro el contenido del input
																							txtstock_min.value="";					// Borro el contenido del input
																							txtstock_max.value="";					// Borro el contenido del input
																							txtvta.value="";						// Borro el contenido del input
																							txttransporte.value="";					// Borro el contenido del input
																							for (i=19; i < cant_cajas; i++){ 		// Borro el contenido del input de las categorias
																								document.frm.elements[i].value="";
																							}																						
																							listar_grupos_art();
																							listar_marcas_art();
																							listar_variedades_art();
																							listar_proveedores_art();
																							listar_medidas_art();
																							listar_categorias_art();
																							listar_iva_art();
																							document.frm.lista_grupo.focus();
																						}
																						//buscar_articulo()	
																					} // fin de if (ajax.readyState==4)
																				} // fin de funcion()
																		}else{
																			divMensaje.innerHTML="Debe ingresar un porcentaje comisión de Transporte";
																			document.frm.transporte.focus()
																		}
																	}else{
																		divMensaje.innerHTML="Debe ingresar un porcentaje comisión de Venta";
																		document.frm.vta.focus()
																	}	
																}else{
																	divMensaje.innerHTML="Debe ingresar el Stock Máximo";
																	document.frm.stock_max.focus()
																}	 
															}else{
																divMensaje.innerHTML="Debe ingresar el Stock Mínimo";
																document.frm.stock_min.focus()
															}		 
														}else{
															divMensaje.innerHTML="Debe ingresar el Stock Actual";
															document.frm.stock_actual.focus()
														}	
													}else{	
														divMensaje.innerHTML="Debe ingresar un Peso";
														document.frm.peso.focus()
													}
												}else{
													divMensaje.innerHTML="Antes debe Registrar una Unidad de Medida";
													document.frm.lista_medida.focus()
												}
											}else{
												divMensaje.innerHTML="Debe ingresar una Medida";
												document.frm.medida.focus()
											}
										}else{
											divMensaje.innerHTML="Debe ingresar cuantas unidades contiene el bulto";
											document.frm.unidad_bulto.focus()
										}
									}else{
										divMensaje.innerHTML="Debe ingresar un precio de costo";
										document.frm.precio_costo.focus()
									}	
								}else{
									divMensaje.innerHTML="Debe seleccionar una Proveedor";
									document.frm.lista_prov.focus()
								}	 
							}else{
								divMensaje.innerHTML="Debe ingresar una Descripción";
								document.frm.desc.focus()
							}		 
						}else{
							divMensaje.innerHTML="Debe ingresar un Código";
							document.frm.codigo.focus()
						}	
					}else{
						divMensaje.innerHTML="Debe seleccionar una Marca";
						document.frm.lista_marca.focus()
					}
				}else{
					divMensaje.innerHTML="Debe seleccionar un Grupo";
					document.frm.lista_grupo.focus()
				}
			}else{
				divMensaje.innerHTML="Antes debe Registrar un Grupo";
				document.frm.lista_grupo.focus()
			}
}
//--------------------------------------------------------------------------------------------------//
function listar_grupo_art_mod(codigo,grupo,marca,variedad){
	var contenedor=document.getElementById("grupos_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_grupo_art_mod.php?";
	variables="codigo="+codigo+"&grupo="+grupo+"&marca="+marca+"&variedad="+variedad;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm_mod.lista_grupo_mod.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_marca_art_mod(codigo,grupo,marca,variedad){
	var contenedor=document.getElementById("marcas_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_marca_art_mod.php?";
	variables="codigo="+codigo+"&grupo="+grupo+"&marca="+marca+"&variedad="+variedad;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_vari_art_mod(codigo,grupo,marca,variedad){
	var contenedor=document.getElementById("variedades_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_variedad_art_mod.php?";
	variables="codigo="+codigo+"&grupo="+grupo+"&marca="+marca+"&variedad="+variedad;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_prov_art_mod(codigo,grupo,marca,variedad){
	var contenedor=document.getElementById("proveedores_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_proveedor_art_mod.php?";
	variables="codigo="+codigo+"&grupo="+grupo+"&marca="+marca+"&variedad="+variedad;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_medidas_art_mod(codigo,grupo,marca,variedad){
	var contenedor=document.getElementById("medidas_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_medidas_art_mod.php";
	variables="codigo="+codigo+"&grupo="+grupo+"&marca="+marca+"&variedad="+variedad;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_retornable_art_mod(codigo,grupo,marca,variedad){
	var contenedor=document.getElementById("envase"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_envase_art_mod.php";
	variables="codigo="+codigo+"&grupo="+grupo+"&marca="+marca+"&variedad="+variedad;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_categorias_art_mod(codigo,grupo,marca,variedad){
	var contenedor=document.getElementById("categorias_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_categorias_art_mod.php";
	variables="codigo="+codigo+"&grupo="+grupo+"&marca="+marca+"&variedad="+variedad;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_iva_art_mod(codigo,grupo,marca,variedad){
	var contenedor=document.getElementById("iva_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_iva_art_mod.php";
	variables="codigo="+codigo+"&grupo="+grupo+"&marca="+marca+"&variedad="+variedad;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function mostrar_foto_art_mod(codigo,grupo,marca,variedad){
	var contenedor=document.getElementById("foto_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_foto_art_mod.php";
	variables="codigo="+codigo+"&grupo="+grupo+"&marca="+marca+"&variedad="+variedad;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
function verificar_uso_articulo(codigo,grupo,marca,variedad){
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="verificar_uso_articulo.php";
	variables="codigo_articulo="+grupo+marca+variedad+codigo;
	//alert(variables);
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText == 'SI'){
					document.frm_mod.lista_grupo_mod.disabled=true;
					document.frm_mod.lista_marca_mod.disabled=true;
					document.frm_mod.lista_vari_mod.disabled=true;
					document.frm_mod.codigo_mod.disabled=true;
					document.frm_mod.desc_mod.disabled=true;
					document.frm_mod.lista_prov_mod.disabled=true;
					document.frm_mod.precio_costo_mod.focus();
				}
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function modificar_articulo(codigo,grupo,marca,variedad){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_art_bus="+cod+"&grupo="+grupo+"&marca="+marca+"&variedad="+variedad;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					listar_grupo_art_mod(cod,grupo,marca,variedad);
					listar_marca_art_mod(cod,grupo,marca,variedad);
					listar_vari_art_mod(cod,grupo,marca,variedad);
					listar_prov_art_mod(cod,grupo,marca,variedad);
					listar_medidas_art_mod(cod,grupo,marca,variedad);
					listar_retornable_art_mod(cod,grupo,marca,variedad);
					listar_categorias_art_mod(cod,grupo,marca,variedad);
					listar_iva_art_mod(cod,grupo,marca,variedad);
					//verificar_uso_articulo(cod,grupo,marca,variedad);
					//mostrar_foto_art_mod(cod,grupo,marca,variedad);
					//document.frm_mod.lista_grupo_mod.focus();
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_art_por_cat(cant_cajas,cod_prod,variedad,marca,grupo){
	var txtcodigo_orig = document.getElementById("oculto_mod");
	var txtgrupo_orig = document.getElementById("oculto_grupo_mod");
	var txtmarca_orig = document.getElementById("oculto_marca_mod");
	var txtvariedad_orig = document.getElementById("oculto_variedad_mod");
	
	for (i=19; i < cant_cajas; i++){ 				// verifico que todas las categorias tengan un precio
		var txtcodigo_cat = document.frm_mod.elements[i].id;
		var txtprecio_cat = document.frm_mod.elements[i].value;
		//alert(txtcodigo_cat+","+cod_prod+","+variedad+","+marca+","+grupo+","+txtprecio_cat);
		var ajax=nuevoAjax();					// creo una instancia de ajax
		metodo="POST";							// asigno las variables de proceso
		url="modificar_articulo_por_cat.php?";
		//variables="codigo_prod_orig="+txtcodigo_orig.value+"&variedad_orig="+txtvariedad_orig.value+"&marca_orig="+txtmarca_orig.value+"&grupo_orig="+txtgrupo_orig.value;		
		variables="codigo_prod_orig="+txtcodigo_orig.value+"&variedad_orig="+txtvariedad_orig.value+"&marca_orig="+txtmarca_orig.value+"&grupo_orig="+txtgrupo_orig.value+"&codigo_cat="+txtcodigo_cat+"&codigo_prod="+cod_prod+"&variedad="+variedad+"&marca="+marca+"&grupo="+grupo+"&precio_cat="+txtprecio_cat;
		//alert(variables);
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
	}
}
//--------------------------------------------------------------------------------------------------//
function modificar_articulo_db(){
	var divMensaje=document.getElementById("mensaje_mod");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar_mod");
	var cant_cajas = document.frm_mod.elements.length - 4;
	var cant_objetos = document.frm_mod.elements.length;
	//alert (cant_objetos); //31
 	var txtgrupo = document.frm_mod.lista_grupo_mod.options[document.frm_mod.lista_grupo_mod.selectedIndex].text;
 	var txtmarca = document.frm_mod.lista_marca_mod.options[document.frm_mod.lista_marca_mod.selectedIndex].text;
 	var txtvari = document.frm_mod.lista_vari_mod.options[document.frm_mod.lista_vari_mod.selectedIndex].text;
	var txtcodigo = document.getElementById("codigo_mod");
	var txtcodigo_orig = document.getElementById("oculto_mod");
	var txtgrupo_orig = document.getElementById("oculto_grupo_mod");
	var txtmarca_orig = document.getElementById("oculto_marca_mod");
	var txtvariedad_orig = document.getElementById("oculto_variedad_mod");
	
	var txtdesc = document.getElementById("desc_mod");
	var txtprov = document.frm_mod.lista_prov_mod.options[document.frm_mod.lista_prov_mod.selectedIndex].value;
	var txtprecio_costo = document.getElementById("precio_costo_mod");
	var txtunidad_bulto = document.getElementById("unidad_bulto_mod");
	var txtmedida = document.getElementById("medida_mod");
	var txtlista_medida = document.frm_mod.lista_medida_mod.options[document.frm_mod.lista_medida_mod.selectedIndex].value;
	var txtpeso = document.getElementById("peso_mod");
	var txtretornable = document.frm_mod.retornable_mod.options[document.frm_mod.retornable_mod.selectedIndex].text;
	var txtstock_actual = document.getElementById("stock_actual_mod");
	var txtstock_min = document.getElementById("stock_min_mod");
	var txtstock_max = document.getElementById("stock_max_mod");
	var txtvta = document.getElementById("vta_mod");
	var txttransporte = document.getElementById("transporte_mod");
	var foto = document.frm_mod.foto_mod.value;
	var txtlista_iva_mod = document.frm_mod.lista_iva_mod.options[document.frm_mod.lista_iva_mod.selectedIndex].value;
			if(txtgrupo != ""){
				if(txtmarca != ""){
					if(txtvari != ""){
						if(txtcodigo.value != ""){
							if(txtdesc.value != ""){
								if(txtprov != ""){
									if(txtprecio_costo.value != ""){
										if(txtunidad_bulto.value != ""){
											if(txtmedida.value != ""){
												if(txtlista_medida != ""){
													if(txtpeso.value != ""){
														if(txtstock_actual.value != ""){
															if(txtstock_min.value != ""){
																if(txtstock_max.value != ""){
																	if(txtvta.value != ""){
																		if(txttransporte.value != ""){
																			for (i=19; i < cant_cajas; i++){ 	// verifico que todas las categorias tengan un precio
																				var txt_nombre_cat = document.frm_mod.elements[i].name;
																				if(document.frm_mod.elements[i].value == ""){
																					divMensaje.innerHTML="Debe ingresar un Precio para la categoria '"+txt_nombre_cat+"'";
																					document.frm_mod.elements[i].focus()
																					return 0;
																				}
																			}	
																			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
																			for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
																				document.frm_mod.elements[i].disabled=true;
																			}	
																			
																			divMensaje.innerHTML="Buscando......."; // mensajes en el div
																			var ajax=nuevoAjax();					// creo una instancia de ajax
																			metodo="POST";							// asigno las variables de proceso
																			url="modificar.php?";  
																			variables="codigo_art_mod_orig="+txtcodigo_orig.value+"&grupo_orig="+txtgrupo_orig.value+"&marca_orig="+txtmarca_orig.value+"&variedad_orig="+txtvariedad_orig.value+"&codigo_art_mod="+txtcodigo.value+"&variedad="+txtvari+"&marca="+txtmarca+"&grupo="+txtgrupo+"&desc="+txtdesc.value+"&precio_costo="+txtprecio_costo.value+"&envase="+txtretornable+"&stock_actual="+txtstock_actual.value+"&stock_min="+txtstock_min.value+"&stock_max="+txtstock_max.value+"&foto="+foto+"&proveedor="+txtprov+"&medida="+txtmedida.value+"&cod_medida="+txtlista_medida+"&porc_vta="+txtvta.value+"&porc_trans="+txttransporte.value+"&unidad_bulto="+txtunidad_bulto.value+"&peso="+txtpeso.value+"&iva="+txtlista_iva_mod																			
																			//alert(variables);
																																				
																			ajax.open(metodo, url, true);
																			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
																			ajax.send(variables);
																			var cod = txtcodigo.value;
																			ajax.onreadystatechange=function(){ 
																					if (ajax.readyState==4){
																							if (ajax.responseText == "ok"){
																									modificar_art_por_cat(cant_cajas,cod,txtvari,txtmarca,txtgrupo);	//funcion para modificar los precios en las categorias																						
																									/*if(foto == "S"){
																										var pregunta = '¿Desea modificar la foto del Artículo?'
																									}else{
																										var pregunta= '¿Desea adjuntar la foto del Artículo?';
																									}
																									if (confirm(pregunta)){	// pregunta si desea adjuntar una foto
																										var win = window.open("upload_foto.php?codigo="+cod, "win",  "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=300,height=200,top=180,left=400");
																									}
																									*/
																									divMensaje.innerHTML="<div class='advertencia'>Artículo Modificado!!</div>";
																									buscar_articulo();
																									document.frm.lista_grupo.focus();
																							}else{
																									//divMensaje.innerHTML = ajax.responseText;
																									divMensaje.innerHTML = "ERROR: El Artículo ya existe!!";
																									for (i=0; i < cant_objetos; i++){		//habilito todos los elementos
																										document.frm_mod.elements[i].disabled=false;
																									}
																									document.frm_mod.lista_grupo_mod.focus();
																							}
																					} // fin de if (ajax.readyState==4)
																				} // fin de funcion()
																		}else{
																			divMensaje.innerHTML="Debe ingresar un porcentaje comisión de Transporte";
																			document.frm_mod.transporte_mod.focus()
																		}
																	}else{
																		divMensaje.innerHTML="Debe ingresar un porcentaje comisión de Venta";
																		document.frm_mod.vta_mod.focus()
																	}	
																}else{
																	divMensaje.innerHTML="Debe ingresar el Stock Máximo";
																	document.frm_mod.stock_max_mod.focus()
																}	 
															}else{
																divMensaje.innerHTML="Debe ingresar el Stock Mínimo";
																document.frm_mod.stock_min_mod.focus()
															}		 
														}else{
															divMensaje.innerHTML="Debe ingresar el Stock Actual";
															document.frm_mod.stock_actual_mod.focus()
														}	
													}else{
														divMensaje.innerHTML="Debe ingresar un Peso";
														document.frm_mod.peso_mod.focus()
													}
												}else{
													divMensaje.innerHTML="Antes debe Registrar una Unidad de Medida";
													document.frm_mod.lista_medida_mod.focus()
												}
											}else{
												divMensaje.innerHTML="Debe ingresar una Medida";
												document.frm_mod.medida_mod.focus()
											}
										}else{
											divMensaje.innerHTML="Debe ingresar cuantas unidades contiene el bulto";
											document.frm_mod.unidad_bulto_mod.focus()
										}
									}else{
										divMensaje.innerHTML="Debe ingresar un precio de costo";
										document.frm_mod.precio_costo_mod.focus()
									}	
								}else{
									divMensaje.innerHTML="Debe seleccionar una Proveedor";
									document.frm_mod.lista_prov_mod.focus()
								}	 
							}else{
								divMensaje.innerHTML="Debe ingresar una Descripción";
								document.frm_mod.desc_mod.focus()
							}		 
						}else{
							divMensaje.innerHTML="Debe ingresar un Código";
							document.frm_mod.codigo_mod.focus()
						}	
					}else{
						divMensaje.innerHTML="Debe seleccionar una Marca";
						document.frm_mod.lista_marca_mod.focus()
					}
				}else{
					divMensaje.innerHTML="Debe seleccionar un Grupo";
					document.frm_mod.lista_grupo_mod.focus()
				}
			}else{
				divMensaje.innerHTML="Antes debe Registrar un Grupo";
				document.frm_mod.lista_grupo_mod.focus()
			}
}
//----------------------------------------------------------------------------------------------------------------------//
function listar_proveedores_art_bus(){
	var contenedor=document.getElementById("proveedores"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="select_proveedores_art_bus.php";
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

function buscar_articulo2(url){
 	var divlistado=document.getElementById("listado"); 
	divlistado.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"

	var boton=document.getElementById("enviar");
	var cant_objetos = document.frm.elements.length;

	var txtcodigo = document.getElementById("codigo");
	var txtdesc = document.getElementById("desc");
	var txtgrupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].value;
	var txtmarca = document.frm.lista_marca.options[document.frm.lista_marca.selectedIndex].value;
	var txtvariedad = document.frm.lista_variedad.options[document.frm.lista_variedad.selectedIndex].value;
	var txtprov = document.frm.lista_prov.options[document.frm.lista_prov.selectedIndex].value;

	for (i=0; i < cant_objetos; i++){								//deshabilito todos los elementos
		document.frm.elements[i].disabled=true;
	}
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_articulo_proceso_lista_precios.php?";
	if(txtgrupo == "TODOS" && txtmarca == "TODOS" && txtvariedad == "TODOS" && txtcodigo.value == "" && txtdesc.value == "" && txtprov == "TODOS"){
		variables="nombre=TODOS";
	}
	else{
		variables="grupo="+txtgrupo+"&marca="+txtmarca+"&variedad="+txtvariedad+"&codigo="+txtcodigo.value+"&desc="+txtdesc.value+"&proveedor="+txtprov; 
	}
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtgrupo.value="";								// Borro el contenido del input
				txtmarca.value="";								// Borro el contenido del input
				txtvariedad.value="";								// Borro el contenido del input
				txtcodigo.value="";								// Borro el contenido del input
				txtdesc.value="";								// Borro el contenido del input
				for (i=0; i < cant_objetos; i++){								//habilito todos los elementos
					document.frm.elements[i].disabled=false;
				}
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				listar_proveedores_art_bus();
				listar_grupo_buscar_art();
				listar_marca_buscar_art();
				listar_variedad_buscar_art();
				document.frm.codigo.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//

function activar_desactivar_articulo(codigo,valor,id){
 if(valor == 'N'){
	var palabra = 'Desactivar';
 }else{
	var palabra = 'Activar';
 }
 
 if (confirm('¿Está seguro que desea ' + palabra + ' este Artículo?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="activar_desactivar_articulo.php?";
	variables="codigo="+codigo+"&valor="+valor;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "sin_permiso"){
					if(valor == 'N'){
						var imagen = '../imagenes/activo_no.gif';
						var nuevo_valor = 'S';
					}else{
						var imagen = '../imagenes/activo.gif';
						var nuevo_valor = 'N';
					}
					
					document.getElementById(id).src = imagen;	
					document.getElementById(id).name = nuevo_valor;	
					
					//alert(ajax.responseText);
					//buscar_pais()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}


///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------FORMA DE PAGO---------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function pasar_foco_fp_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.nombre.value.length > 0  ) {
                document.frm.obs.focus()
                return 0;		  
			}	  
	}
}
//-------------------modificar----------------------------------//
function pasar_foco_fp_1_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.obs_mod.focus()
                return 0;		  
			}	  
	}
}
//-------------------buscar----------------------------------//
function pasar_foco_fp_1_bus(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.nombre.value.length > 0  ) {
				document.frm.enviar.click()                		  
			}else{
				document.frm.obs.focus()
                return 0;
			}
	}
}
function pasar_foco_fp_2_bus(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.enviar.click()                		  
	}
}
//--------------------------------------------------------------------------------------------------//
function registrar_fp(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var cant_objetos = document.frm.elements.length;
	var boton=document.getElementById("enviar");
	var txtnombre = document.getElementById("nombre");
	var txtobs = document.frm.obs.value;

	if(document.frm.nombre.value != ""){
			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
			for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
				document.frm.elements[i].disabled=true;
			}
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
    		url="alta_forma_pago.php?";
			variables="nombre="+txtnombre.value+"&obs="+txtobs;
			//alert(variables);
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					txtnombre.value="";					// Borro el contenido del input
					document.frm.obs.value="";			// Borro el contenido del input
					for (i=0; i < cant_objetos; i++){	//deshabilito todos los elementos
						document.frm.elements[i].disabled=false;
					}
					divMensaje.innerHTML=ajax.responseText; // imprime la salida
					buscar_fp();
					document.frm.nombre.focus();
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
    }else{
		divMensaje.innerHTML="Debe ingresar el nombre de la Forma de Pago";
		document.frm.nombre.focus()
 	}
}
//--------------------------------------------------------------------------------------------------//
function buscar_fp(){
 	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_fp_proceso.php?";
	variables="nombre=todos";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_fp2(){
 	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
	var cant_objetos = document.frm.elements.length;
	var txtnombre = document.getElementById("nombre");
	var txtobs = document.getElementById("obs");

	for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
		document.frm.elements[i].disabled=true;
	}
	
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_fp_proceso.php?";
	if(document.frm.nombre.value == "" && document.frm.obs.value == ""){
		variables="nombre=todos";
	}
	else{
		variables="nombre="+txtnombre.value+"&obs="+txtobs.value;
	}
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtnombre.value="";								// Borro el contenido del input
				txtobs.value="";								// Borro el contenido del input
				for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
					document.frm.elements[i].disabled=false;
				}				
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_fp(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_fp_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					document.frm_mod.nombre_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_fp_db(){
	var divMensaje=document.getElementById("mensaje_mod"); 
	var cant_objetos = document.frm_mod.elements.length;

	var boton=document.getElementById("enviar_mod");
 	var txtcodigo = document.getElementById("oculto_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var txtobs = document.getElementById("obs_mod");
	var ajax=nuevoAjax();										// creo una instancia de ajax
 if(document.frm_mod.nombre_mod.value != ""){	
			divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
			for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
				document.frm_mod.elements[i].disabled=true;
			}
			divMensaje.innerHTML="Modificando.......";					// mensajes en el div
			metodo="POST";												// asigno las variables de proceso
			url="modificar.php?";
			variables="codigo_fp_mod="+txtcodigo.value+"&nombre_fp_mod="+txtnombre.value+"&obs_fp_mod="+txtobs.value;
			//alert(variables);
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
						if (ajax.responseText == "ok"){
							//divlistado.innerHTML="<div class='advertencia'>Impuesto Modificado!!</div>";
							buscar_fp()
						}else{
							divMensaje.innerHTML = "ERROR: El Impuesto ya existe!!";
							txtnombre.value="";								// Borro el contenido del input
							document.frm_mod.obs_mod.value="";
							for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
								document.frm_mod.elements[i].disabled=false;
							}
							document.frm_mod.nombre_mod.focus()
						}
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
 }else{
	divMensaje.innerHTML="Debe ingresar el nombre de la Forma de Pago";
	document.frm_mod.nombre_mod.focus()
 }	
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------TIPO DE TALONARIO-----------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function pasar_foco_tt_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.codigo.value.length > 0  ) {
                document.frm.desc.focus()
                return 0;		  
			}	  
	}
}
function pasar_foco_tt_2(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.desc.value.length > 0  ) {
                document.frm.cant.focus()
                return 0;		  
			}	  
	}
}
function pasar_foco_tt_3(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.cant.value.length > 0  ) {
                document.frm.enviar.click()
                return 0;		  
			}	  
	}
}




//-------------------modificar----------------------------------//
function pasar_foco_tt_1_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.codigo_mod.value.length > 0  ) {
                document.frm_mod.desc_mod.focus()
                return 0;		  
			}	  
	}
}
function pasar_foco_tt_2_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.desc_mod.value.length > 0  ) {
                document.frm_mod.cant_mod.focus()
                return 0;		  
			}	  
	}
}
function pasar_foco_tt_3_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.cant_mod.value.length > 0  ) {
                document.frm_mod.enviar_mod.click()
                return 0;		  
			}	  
	}
}
//-------------------buscar----------------------------------//
function pasar_foco_tt_1_bus(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.codigo.value.length > 0  ) {
				document.frm.enviar.click()                		  
			}else{
				document.frm.desc.focus()
                return 0;
			}
	}
}
function pasar_foco_tt_2_bus(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.enviar.click()                		  
	}
}

//--------------------------------------------------------------------------------------------------//
function registrar_tt(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var cant_objetos = document.frm.elements.length;
	var boton=document.getElementById("enviar");
	var txtcodigo = document.getElementById("codigo");
	var txtdesc = document.getElementById("desc");
	var txtcant = document.getElementById("cant");

	if(document.frm.codigo.value != ""){
		if(document.frm.desc.value != ""){	
			if(document.frm.cant.value != ""){	
					divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
					for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
						document.frm.elements[i].disabled=true;
					}
					divMensaje.innerHTML="Buscando......."; // mensajes en el div
					var ajax=nuevoAjax();					// creo una instancia de ajax
					metodo="POST";							// asigno las variables de proceso
					url="alta_tipo_talonario.php?";
					variables="codigo="+txtcodigo.value+"&desc="+txtdesc.value+"&cant="+txtcant.value;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
						if (ajax.readyState==4){
							txtcodigo.value="";					// Borro el contenido del input
							txtdesc.value="";					// Borro el contenido del input
							txtcant.value="";					// Borro el contenido del input
							for (i=0; i < cant_objetos; i++){	//deshabilito todos los elementos
								document.frm.elements[i].disabled=false;
							}
							divMensaje.innerHTML=ajax.responseText; // imprime la salida
							buscar_tt();
							document.frm.codigo.focus();
						} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				divMensaje.innerHTML="Debe ingresar la cantidad de Copias";
				document.frm.cant.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar la descripción del Comprobante";
			document.frm.desc.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el código del Comprobante";
		document.frm.codigo.focus()
 	}
}
//--------------------------------------------------------------------------------------------------//
function buscar_tt(){
 	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_tt_proceso.php?";
	variables="nombre=todos";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.codigo.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_tt2(){
 	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
	var cant_objetos = document.frm.elements.length;
	var txtcodigo = document.getElementById("codigo");
	var txtdesc = document.getElementById("desc");

	for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
		document.frm.elements[i].disabled=true;
	}
	
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_tt_proceso.php?";
	if(document.frm.codigo.value == "" && document.frm.desc.value == ""){
		variables="nombre=todos";
	}
	else{
		variables="codigo="+txtcodigo.value+"&desc="+txtdesc.value;
	}
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtcodigo.value="";								// Borro el contenido del input
				txtdesc.value="";								// Borro el contenido del input
				for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
					document.frm.elements[i].disabled=false;
				}				
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.codigo.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_tt(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_tt_bus="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
				divlistado.innerHTML=ajax.responseText; 	// imprime la salida
				document.frm_mod.codigo_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_tt_db(){
 var divMensaje=document.getElementById("mensaje_mod"); 
 var cant_objetos = document.frm_mod.elements.length;

 var boton=document.getElementById("enviar_mod");
 var txtcodigo_orig = document.getElementById("oculto_mod");
 var txtcodigo = document.getElementById("codigo_mod");
 var txtdesc = document.getElementById("desc_mod");
 var txtcant = document.getElementById("cant_mod");
 //var txtreq_cuit_mod = document.frm_mod.req_cuit_mod.options[document.frm_mod.req_cuit_mod.selectedIndex].value;

 var ajax=nuevoAjax();										// creo una instancia de ajax
 if(document.frm_mod.codigo_mod.value != ""){	
	 if(document.frm_mod.desc_mod.value != ""){
		 if(document.frm_mod.cant_mod.value != ""){
			
			divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
			for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
				document.frm_mod.elements[i].disabled=true;
			}
			divMensaje.innerHTML="Modificando.......";					// mensajes en el div
			metodo="POST";												// asigno las variables de proceso
			url="modificar.php?";
			variables="codigo_tt_orig_mod="+txtcodigo_orig.value+"&codigo_tt_mod="+txtcodigo.value+"&desc_tt_mod="+txtdesc.value+"&cant_tt_mod="+txtcant.value;
			//alert(variables);
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
						if (ajax.responseText == "ok"){
							//divlistado.innerHTML="<div class='advertencia'>Impuesto Modificado!!</div>";
							buscar_tt()
						}else{
							//divMensaje.innerHTML =ajax.responseText;
							divMensaje.innerHTML = "ERROR: El Tipo de Talonario ya existe!!";
							for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
								document.frm_mod.elements[i].disabled=false;
							}
							document.frm_mod.codigo_mod.focus()
						}
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
		  }else{
			divMensaje.innerHTML="Debe ingresar la cantidad de Copias";
			document.frm_mod.cant_mod.focus()
		 }
	  }else{
		divMensaje.innerHTML="Debe ingresar la descripción del Comprobante";
		document.frm_mod.nombre_mod.focus()
	 }
 }else{
	divMensaje.innerHTML="Debe ingresar el Código del Comprobante";
	document.frm_mod.nombre_mod.focus()
 }	
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------TALONARIOS------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_tt_tal_reg(){
	var contenedor=document.getElementById("tt"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_tt_tal_reg.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.lista_tt.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_impr_alta_talonario(){
	var contenedor=document.getElementById("impresoras"); 
	contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	//contenedor.innerHTML="Buscando Impresoras......";
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_impr_alta_talonario.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.lista_tt.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_tal_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.lista_tt.value.length > 0  ) {
                document.frm.numero.focus()
                return 0;		  
			}	  
	}
}
function pasar_foco_tal_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.numero.value.length > 0  ) {
                document.frm.sucursal.focus()
                return 0;		  
			}
     }
}
function pasar_foco_tal_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.sucursal.value.length > 0  ) {
                document.frm.iteraciones.focus()
                return 0;		  
			}
     }
}
function pasar_foco_tal_4(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.iteraciones.value.length > 0  ) {
                document.frm.primer_num.focus()
                return 0;		  
			}
     }
}
function pasar_foco_tal_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.primer_num.value.length > 0  ) {
			document.frm.ultimo_num.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_tal_6(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.ultimo_num.value.length > 0  ) {
			document.frm.sig_num.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_tal_7(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.sig_num.value.length > 0  ) {
			document.frm.dia.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_tal_8(){
		if( document.frm.dia.value.length == 2  ) {
			document.frm.mes.focus();
			return 0;		 
	   }		
}
function pasar_foco_tal_9(){
		if( document.frm.mes.value.length == 2  ) {
			document.frm.ano.focus();
			return 0;		 
	   }		
}
function pasar_foco_tal_10(){
		if( document.frm.ano.value.length == 4  ) {
			document.frm.cai.focus();
			return 0;		 
	   }		
}
function pasar_foco_tal_11(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.cai.value.length > 0  ) {
			document.frm.impresora.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_tal_12(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.impresora.value.length > 0  ) {
			document.frm.enviar.click();
			return 0;		 
	   }		
	}
}
//-------------------------------modificar----------------------------------------------------------//
function pasar_foco_tal_1_mod(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.lista_tt_mod.value.length > 0  ) {
                document.frm_mod.numero_mod.focus()
                return 0;		  
			}	  
	}
}
function pasar_foco_tal_2_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.numero_mod.value.length > 0  ) {
                document.frm_mod.sucursal_mod.focus()
                return 0;		  
			}
     }
}
function pasar_foco_tal_3_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.sucursal_mod.value.length > 0  ) {
                document.frm_mod.iteraciones_mod.focus()
                return 0;		  
			}
     }
}
function pasar_foco_tal_4_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.iteraciones_mod.value.length > 0  ) {
                document.frm_mod.primer_num_mod.focus()
                return 0;		  
			}
     }
}
function pasar_foco_tal_5_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm_mod.primer_num_mod.value.length > 0  ) {
			document.frm_mod.ultimo_num_mod.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_tal_6_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm_mod.ultimo_num_mod.value.length > 0  ) {
			document.frm_mod.sig_num_mod.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_tal_7_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm_mod.sig_num_mod.value.length > 0  ) {
			document.frm_mod.dia_mod.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_tal_8_mod(){
		if( document.frm_mod.dia_mod.value.length == 2  ) {
			document.frm_mod.mes_mod.focus();
			return 0;		 
	   }		
}
function pasar_foco_tal_9_mod(){
		if( document.frm_mod.mes_mod.value.length == 2  ) {
			document.frm_mod.ano_mod.focus();
			return 0;		 
	   }		
}
function pasar_foco_tal_10_mod(){
		if( document.frm_mod.ano_mod.value.length == 4  ) {
			document.frm_mod.cai_mod.focus();
			return 0;		 
	   }		
}
function pasar_foco_tal_11_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm_mod.cai_mod.value.length > 0  ) {
			document.frm_mod.impresora_mod.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_tal_12_mod(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm_mod.impresora_mod.value.length > 0  ) {
			document.frm_mod.enviar_mod.click();
			return 0;		 
	   }		
	}
}
//--------------------------------buscar------------------------------------------------------------// 
function pasar_foco_tal_1_bus(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.numero.value.length == 0  ) {
			document.frm.lista_tt.focus();
			return 0;		 
	   }else{
		   document.frm.enviar.click();
	   }		
	}
}
function pasar_foco_tal_2_bus(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txt_tt = document.frm.lista_tt.options[document.frm.lista_tt.selectedIndex].text;
	if ( tecla==13){
		if ( txt_tt != ""){			
				document.frm.enviar.click();
		}
	}
}
//--------------------------------------------------------------------------------------------------//
function registrar_talonario(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");
	var cant_objetos = document.frm.elements.length;

	var txttt = document.frm.lista_tt.options[document.frm.lista_tt.selectedIndex].value;
	var txtnumero = document.getElementById("numero");
	var txtsucursal = document.getElementById("sucursal");
	var txtiteraciones = document.getElementById("iteraciones");
	var txtprimer_num = document.getElementById("primer_num");
	var txtultimo_num = document.getElementById("ultimo_num");
	var txtsig_num = document.getElementById("sig_num");
	var txtdia = document.getElementById("dia");
	var txtmes = document.getElementById("mes");
	var txtano = document.getElementById("ano");
	var txtcai = document.getElementById("cai");
	var txtimpresora = document.getElementById("impresora");

	if(txttt != ""){
		if(txtnumero.value != ""){
			if(txtsucursal.value != ""){
				if(txtiteraciones.value != ""){
					if(txtprimer_num.value != ""){
						if(txtultimo_num.value != ""){
							if( parseInt(txtultimo_num.value) > parseInt(txtprimer_num.value)){
								if(txtsig_num.value != ""){
									if(parseInt(txtsig_num.value) >= parseInt(txtprimer_num.value) && parseInt(txtsig_num.value) < parseInt(txtultimo_num.value)){
										if(txtdia.value.length > 1 ){
											if(parseInt(txtdia.value) > 0 && parseInt(txtdia.value) < 32){
												if(txtmes.value.length > 1 ){
													if(parseInt(txtmes.value) > 0 && parseInt(txtmes.value) < 13){
														if(txtano.value.length > 3 ){
															FechaActual = new Date()
															anoActual = FechaActual.getFullYear()
															ano=anoActual-1
															if(parseInt(txtano.value) > ano && parseInt(txtano.value) < 3000){
																if(txtcai.value != ""){
																	if(txtimpresora.value != ""){
																		divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
																		for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
																				document.frm.elements[i].disabled=true;
																		}
																		divMensaje.innerHTML="Buscando......."; // mensajes en el div
																		var ajax=nuevoAjax();					// creo una instancia de ajax
																		metodo="POST";							// asigno las variables de proceso
																		url="alta_talonario.php?";
																		variables="codigo_tt="+txttt+"&numero="+txtnumero.value+"&sucursal="+txtsucursal.value+"&iteraciones="+txtiteraciones.value+"&primer_num="+txtprimer_num.value+"&ultimo_num="+txtultimo_num.value+"&sig_num="+txtsig_num.value+"&dia="+txtdia.value+"&mes="+txtmes.value+"&ano="+txtano.value+"&cai="+txtcai.value+"&impr="+txtimpresora.value;
																		//alert(variables);
																		
																		ajax.open(metodo, url, true);
																		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
																		ajax.send(variables);
																		ajax.onreadystatechange=function(){ 
																				if (ajax.readyState==4){
																								txtnumero.value="";				// Borro el contenido del input
																								txtsucursal.value="";			// Borro el contenido del input
																								txtiteraciones.value="";		// Borro el contenido del input
																								txtprimer_num.value="";			// Borro el contenido del input
																								txtultimo_num.value="";			// Borro el contenido del input
																								txtsig_num.value="";			// Borro el contenido del input
																								txtdia.value="";				// Borro el contenido del input
																								txtmes.value="";				// Borro el contenido del input
																								txtano.value="";				// Borro el contenido del input
																								txtcai.value="";				// Borro el contenido del i
																								txtimpresora.value="";			// Borro el contenido del i
																								for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
																										document.frm.elements[i].disabled=false;
																								}
																								divMensaje.innerHTML=ajax.responseText; // imprime la salida
																								listar_tt_tal_reg();
																								buscar_talonario();
																								//document.frm.listatt.focus()
																					} // fin de if (ajax.readyState==4)
																		} // fin de funcion()
																	}else{
																		divMensaje.innerHTML="Debe ingresar el destino de impresión del Talonario";
																		document.frm.impresora.focus()
																	}
																}else{
																	divMensaje.innerHTML="Debe ingresar el Nº de CAI del Talonario";
																	document.frm.cai.focus()
																}
															}else{
																divMensaje.innerHTML="Fecha Inválida: año incorrecto";
																document.frm.ano.focus()
															}
														}else{
															divMensaje.innerHTML="Debe ingresar el año de Vencimiento, Formato: dd/mm/aaaa";
															document.frm.ano.focus()
														}
													}else{
														divMensaje.innerHTML="Fecha Inválida: mes incorrecto";
														document.frm.mes.focus()
													}	
												}else{
													divMensaje.innerHTML="Debe ingresar el mes de Vencimiento, Formato: dd/mm/aaaa";
													document.frm.mes.focus()
												}
											}else{
												divMensaje.innerHTML="Fecha Inválida: día incorrecto";
												document.frm.dia.focus()
											}
										}else{
											divMensaje.innerHTML="Debe ingresar el día de Vencimiento, Formato: dd/mm/aaaa";
											document.frm.dia.focus()
										}
									}else{
										divMensaje.innerHTML="El siguiente número debe ser mayor que el primero y menor que el último";
										document.frm.sig_num.focus()
									}
								}else{
									divMensaje.innerHTML="Debe ingresar el siguiente Nº del Talonario";
									document.frm.sig_num.focus()
								}
							}else{
								divMensaje.innerHTML="El último número debe ser mayor que el primero";
								document.frm.ultimo_num.focus()
							}
						}else{
							divMensaje.innerHTML="Debe ingresar el último Nº del Talonario";
							document.frm.ultimo_num.focus()
						}	 
					}else{
						divMensaje.innerHTML="Debe ingresar el primer Nº del Talonario";
						document.frm.primer_num.focus()
					}		 
				}else{
					divMensaje.innerHTML="Debe ingresar el Nº de Iteraciones del Talonario";
					document.frm.iteraciones.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar el Nº de Sucursal";
				document.frm.sucursal.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar el Nº del Talonario";
			document.frm.numero.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Tipo de Talonario";
		document.frm.lista_tt.focus()
	}
}
//--------------------------------------------------------------------------------------------------//
function buscar_talonario(){
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_talonario_proceso.php?";
	variables="nombre=TODOS";

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				//listar_tt_tal_reg();
				//document.frm.lista_tt.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
function listar_tt_tal_bus(){
	var contenedor=document.getElementById("tt"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_tt_tal_bus.php";
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
function buscar_talonario2(){
	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
	var txtnumero = document.getElementById("numero");
	var txt_tt = document.frm.lista_tt.options[document.frm.lista_tt.selectedIndex].text;
		
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtnumero.disabled=true; 
	document.frm.lista_tt.disabled=true;
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_talonario_proceso.php?";
	if(txtnumero.value == "" && txt_tt == "TODOS"){
		variables="nombre=TODOS";
	}else{
		variables="numero="+txtnumero.value+"&tipo_talonario="+txt_tt;
	}
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				txtnumero.value="";								// Borro el contenido del input
				boton.disabled=false;
				txtnumero.disabled=false; 
				document.frm.lista_tt.disabled=false;
				listar_tt_tal_bus();
				document.frm.numero.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function listar_tt_talonario(codigo_tt,codigo_t){
	var contenedor=document.getElementById("tt_mod"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_tt_tal_mod.php?";
	variables = "cod_tipo_talonario="+codigo_tt+"&cod_talonario="+codigo_t;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm_mod.lista_tt_mod.focus();
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function listar_impr_alta_talonario_mod(cod_tt,cod_t){
	var contenedor=document.getElementById("impresoras_mod"); 
	contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	//contenedor.innerHTML="Buscando Impresoras......";
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_impr_alta_talonario_mod.php";
	variables="codigo_tt_bus_mod="+cod_tt+"&codigo_tal_bus="+cod_t;

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.lista_tt.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function modificar_talonario(cod_tt,cod_t){
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_tt_bus_mod="+cod_tt+"&codigo_tal_bus="+cod_t;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					listar_tt_talonario(cod_tt,cod_t);
					listar_impr_alta_talonario_mod(cod_tt,cod_t)
					//document.frm_mod.codigo_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_talonario_db(){
	var divMensaje=document.getElementById("mensaje_mod");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar_mod");
	var boton_cancel=document.getElementById("cancelar_mod");
	var cant_objetos = document.frm_mod.elements.length;
	var txttt_orig = document.getElementById("oculto_mod2");
	var txttt = document.frm_mod.lista_tt_mod.options[document.frm_mod.lista_tt_mod.selectedIndex].value;
	var txtnumero_orig = document.getElementById("oculto_mod");
	var txtnumero = document.getElementById("numero_mod");
	var txtsucursal = document.getElementById("sucursal_mod");
	var txtiteraciones = document.getElementById("iteraciones_mod");
	var txtprimer_num = document.getElementById("primer_num_mod");
	var txtultimo_num = document.getElementById("ultimo_num_mod");
	var txtsig_num = document.getElementById("sig_num_mod");
	var txtdia = document.getElementById("dia_mod");
	var txtmes = document.getElementById("mes_mod");
	var txtano = document.getElementById("ano_mod");
	var txtcai = document.getElementById("cai_mod");
	var txtimpresora = document.getElementById("impresora_mod");

	if(txttt != ""){
		if(txtnumero.value != ""){
			if(txtsucursal.value != ""){
				if(txtiteraciones.value != ""){
					if(txtprimer_num.value != ""){
						if(txtultimo_num.value != ""){
							if( parseInt(txtultimo_num.value) > parseInt(txtprimer_num.value)){
								if(txtsig_num.value != ""){
									if(parseInt(txtsig_num.value) >= parseInt(txtprimer_num.value) && parseInt(txtsig_num.value) < parseInt(txtultimo_num.value)){
										if(txtdia.value.length > 1 ){
											if(parseInt(txtdia.value) > 0 && parseInt(txtdia.value) < 32){
												if(txtmes.value.length > 1 ){
													if(parseInt(txtmes.value) > 0 && parseInt(txtmes.value) < 13){
														if(txtano.value.length > 3 ){
															FechaActual = new Date()
															anoActual = FechaActual.getFullYear()
															ano=anoActual-1
															if(parseInt(txtano.value) > ano && parseInt(txtano.value) < 3000){
																if(txtcai.value != ""){
																	if(txtimpresora.value != ""){
																		divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
																		for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
																				document.frm_mod.elements[i].disabled=true;
																		}
																		divMensaje.innerHTML="Buscando......."; // mensajes en el div
																		var ajax=nuevoAjax();					// creo una instancia de ajax
																		metodo="POST";							// asigno las variables de proceso
																		url="modificar.php?";
																		variables="numero_tal_orig="+txtnumero_orig.value+"&codigo_tt_orig="+txttt_orig.value+"&codigo_tt="+txttt+"&numero_tal="+txtnumero.value+"&sucursal="+txtsucursal.value+"&iteraciones="+txtiteraciones.value+"&primer_num="+txtprimer_num.value+"&ultimo_num="+txtultimo_num.value+"&sig_num="+txtsig_num.value+"&dia="+txtdia.value+"&mes="+txtmes.value+"&ano="+txtano.value+"&cai="+txtcai.value+"&impr="+txtimpresora.value;
																		//alert(variables);
																		
																		ajax.open(metodo, url, true);
																		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
																		ajax.send(variables);
																		ajax.onreadystatechange=function(){ 
																				if (ajax.readyState==4){
																						if(ajax.responseText == "ok"){
																							divMensaje.innerHTML = "Talonario Modificado";
																							buscar_talonario();
																						}else{
																							//divMensaje.innerHTML=ajax.responseText; // imprime la salida
																							divMensaje.innerHTML = "ERROR: El Talonario ya existe!!";
																							for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
																									document.frm_mod.elements[i].disabled=false;
																							}
																							document.frm_mod.lista_tt_mod.focus()
																						}
																				} // fin de if (ajax.readyState==4)
																		} // fin de funcion()
																	}else{
																		divMensaje.innerHTML="Debe ingresar el destino de impresión del Talonario";
																		document.frm_mod.impresora_mod.focus()
																	}
																}else{
																	divMensaje.innerHTML="Debe ingresar el Nº de CAI del Talonario";
																	document.frm_mod.cai_mod.focus()
																}
															}else{
																divMensaje.innerHTML="Fecha Inválida: año incorrecto";
																document.frm_mod.ano_mod.focus()
															}
														}else{
															divMensaje.innerHTML="Debe ingresar el año de Vencimiento, Formato: dd/mm/aaaa";
															document.frm_mod.ano_mod.focus()
														}
													}else{
														divMensaje.innerHTML="Fecha Inválida: mes incorrecto";
														document.frm_mod.mes_mod.focus()
													}	
												}else{
													divMensaje.innerHTML="Debe ingresar el mes de Vencimiento, Formato: dd/mm/aaaa";
													document.frm_mod.mes_mod.focus()
												}
											}else{
												divMensaje.innerHTML="Fecha Inválida: día incorrecto";
												document.frm_mod.dia_mod.focus()
											}
										}else{
											divMensaje.innerHTML="Debe ingresar el día de Vencimiento, Formato: dd/mm/aaaa";
											document.frm_mod.dia_mod.focus()
										}
									}else{
										divMensaje.innerHTML="El siguiente número debe ser mayor que el primero y menor que el último";
										document.frm_mod.sig_num_mod.focus()
									}
								}else{
									divMensaje.innerHTML="Debe ingresar el siguiente Nº del Talonario";
									document.frm_mod.sig_num_mod.focus()
								}
							}else{
								divMensaje.innerHTML="El último número debe ser mayor que el primero";
								document.frm_mod.ultimo_num_mod.focus()
							}
						}else{
							divMensaje.innerHTML="Debe ingresar el último Nº del Talonario";
							document.frm_mod.ultimo_num_mod.focus()
						}	 
					}else{
						divMensaje.innerHTML="Debe ingresar el primer Nº del Talonario";
						document.frm_mod.primer_num_mod.focus()
					}		 
				}else{
					divMensaje.innerHTML="Debe ingresar el Nº de Iteraciones del Talonario";
					document.frm_mod.iteraciones_mod.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar el Nº de Sucursal";
				document.frm_mod.sucursal_mod.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar el Nº del Talonario";
			document.frm_mod.numero_mod.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Tipo de Talonario";
		document.frm_modlista_tt_mod.focus()
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------DATOS DE EMPRESA------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function buscar_empresa(){
	var ajax=nuevoAjax();				// creo una instancia de ajax
	metodo="POST";						// asigno las variables de proceso
    url="buscar_empresa.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if (ajax.responseText != 0){
					ver_ficha_empresa();
				}else{
					alta_datos_empresa();
				}
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function alta_datos_empresa(){
	var divMensaje=document.getElementById("cuerpo"); // asigna los aobjetos a las variables
	divMensaje.innerHTML="";			// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();				// creo una instancia de ajax
	metodo="POST";						// asigno las variables de proceso
    url="buscar_empresa.php?";
	variables="plantilla=alta";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						divMensaje.innerHTML=ajax.responseText; // imprime la salida
						document.forms[0].razon.focus();
						listar_paises();
						listar_provincias();
						listar_localidades();
						listar_iva();
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function mostrar_datos_empresa(){
	var divMensaje=document.getElementById("cuerpo"); // asigna los aobjetos a las variables
	divMensaje.innerHTML="";			// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();				// creo una instancia de ajax
	metodo="POST";						// asigno las variables de proceso
    url="buscar_empresa.php?";
	variables="plantilla=mostrar";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						divMensaje.innerHTML=ajax.responseText; // imprime la salida
						listar_paises_emp();
						listar_provincias_emp();
						listar_localidades_emp();
						listar_iva_emp();
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function ver_ficha_empresa(){
	var divMensaje=document.getElementById("cuerpo"); // asigna los aobjetos a las variables
	divMensaje.innerHTML="";			// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();				// creo una instancia de ajax
	metodo="POST";						// asigno las variables de proceso
    url="buscar_empresa.php?";
	variables="plantilla=ver";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						divMensaje.innerHTML=ajax.responseText; // imprime la salida
						//mostrar_logo();
						//mostrar_fondo();
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
function mostrar_logo(){
	var divMensaje=document.getElementById("logo"); // asigna los aobjetos a las variables
	divMensaje.innerHTML="";			// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();				// creo una instancia de ajax
	metodo="POST";						// asigno las variables de proceso
    url="buscar_empresa.php?";
	variables="plantilla=logo";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						divMensaje.innerHTML=ajax.responseText; // imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
function mostrar_fondo(){
	var divMensaje=document.getElementById("fondo"); // asigna los aobjetos a las variables
	divMensaje.innerHTML="";			// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();				// creo una instancia de ajax
	metodo="POST";						// asigno las variables de proceso
    url="buscar_empresa.php?";
	variables="plantilla=fondo";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						divMensaje.innerHTML=ajax.responseText; // imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.forms[0].razon.value.length > 0  ) {
                document.forms[0].dueno.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.forms[0].dueno.value.length > 0  ) {
                document.forms[0].lista_iva.focus()
                return 0;		  
			}
     }
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.forms[0].cuit1.value.length == 2  ) {
                document.forms[0].cuit2.focus()
                return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_4(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.forms[0].cuit2.value.length == 8  ) {
                document.forms[0].cuit3.focus()
                return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.forms[0].cuit3.value.length == 1  ) {
                document.forms[0].ing_bruto.focus()
                return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_6(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.forms[0].ing_bruto.value.length > 0 ) {
				document.forms[0].direccion.focus()
				return 0;		  
		}
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_8(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.forms[0].direccion.value != "") {
					document.forms[0].lista_pais.focus()
					return 0;		  
		}
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_10(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.forms[0].tel.value != "") {
					document.forms[0].fax.focus()
					return 0;
		}
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_11(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.forms[0].cel.focus()
					return 0;
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_12(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.forms[0].web.focus()
					return 0;
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_13(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.forms[0].mail.focus()
					return 0;
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_14(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
					document.forms[0].dia.focus()
					return 0;
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_15(){
		if( document.forms[0].dia.value.length == 2  ) {
			document.forms[0].mes.focus();
			return 0;		 
	   }		
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_16(){
		if( document.forms[0].mes.value.length == 2  ) {
			document.forms[0].ano.focus();
			return 0;		 
	   }		
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_emp_17(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
			if( document.forms[0].ano.value.length == 4  ) {
				document.forms[0].enviar.click();
				return 0;		 
	        }
		}
}
//--------------------------------------------------------------------------------------------------//
function registrar_empresa(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");
	var cant_objetos = document.forms[0].elements.length;

	var txtrazon = document.getElementById("razon");
	var txtdueno = document.getElementById("dueno");	
	var txtcuit1 = document.getElementById("cuit1");
	var txtcuit2 = document.getElementById("cuit2");
	var txtcuit3 = document.getElementById("cuit3");
	var txting_bruto = document.getElementById("ing_bruto");
 	var txtiva = document.forms[0].lista_iva.options[document.forms[0].lista_iva.selectedIndex].text;
	var txtdir = document.getElementById("direccion");
	var txtpais = document.forms[0].lista_pais.options[document.forms[0].lista_pais.selectedIndex].text;
 	var txtprov = document.forms[0].lista_provincia.options[document.forms[0].lista_provincia.selectedIndex].text;
 	var txtloca = document.forms[0].lista_loca.options[document.forms[0].lista_loca.selectedIndex].text;
	var txttel = document.getElementById("tel");
	var txtfax = document.getElementById("fax");
	var txtcel = document.getElementById("cel");
	var txtweb = document.getElementById("web");
	var txtmail = document.getElementById("mail");
	var txtdia = document.getElementById("dia");
	var txtmes = document.getElementById("mes");
	var txtano = document.getElementById("ano");

	if(txtrazon.value != ""){
		if(txtdueno.value != ""){
			if(txtcuit1.value.length == 2){
				if(txtcuit2.value.length == 8){	
					if(txtcuit3.value.length == 1){
						cuit=txtcuit1.value+txtcuit2.value+txtcuit3.value;
						validar_cuit(cuit);					// valida el CUIT ingrsado
						if(error == ""){
							if(txting_bruto.value != ""){
								if(txtiva != ""){	
									if(txtdir.value != ""){
										if(txtprov != "nulo"){
											if(txtloca != "nulo"){
												if(txttel.value != ""){
													if(txtdia.value.length > 1 ){
														if(parseInt(txtdia.value) > 0 && parseInt(txtdia.value) < 32){
															if(txtmes.value.length > 1 ){
																if(parseInt(txtmes.value) > 0 && parseInt(txtmes.value) < 13){
																	if(txtano.value.length > 3 ){
																		if(parseInt(txtano.value) > 1000 && parseInt(txtano.value) < 3000){
																					divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
																					for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
																						document.forms[0].elements[i].disabled=true;
																					}
																					divMensaje.innerHTML="Buscando......."; // mensajes en el div
																					var ajax=nuevoAjax();					// creo una instancia de ajax
																					metodo="POST";							// asigno las variables de proceso
																					url="alta_datos_empresa.php?";
																					fecha = txtdia.value+txtmes.value+txtano.value;
																					variables="razon="+txtrazon.value+"&dueno="+txtdueno.value+"&cuit="+cuit+"&ing_bruto="+txting_bruto.value+"&iva="+txtiva+"&dir="+txtdir.value+"&pais="+txtpais+"&prov="+txtprov+"&localidad="+txtloca+"&tel="+txttel.value+"&fax="+txtfax.value+"&cel="+txtcel.value+"&web="+txtweb.value+"&mail="+txtmail.value+"&fecha="+fecha;
																					//alert(variables);
																					ajax.open(metodo, url, true);
																					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
																					ajax.send(variables);
																					ajax.onreadystatechange=function(){ 
																						if (ajax.readyState==4){
																							/*
																							if (confirm('¿Desea adjuntar el Logo de la Empresa o una imagen de fondo?')){ 						// pregunta si desea adjuntar una foto
																								var win = window.open("upload_foto_empresa.php", "win",  "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=300,height=220,top=180,left=400");
																							}
																							*/
																							ver_ficha_empresa()
																							//document.forms[0].codigo.focus()
																						} // fin de if (ajax.readyState==4)
																					} // fin de funcion()
																		}else{
																			divMensaje.innerHTML="Fecha Inválida: año incorrecto";
																			document.forms[0].ano.focus()
																		}
																	}else{
																		divMensaje.innerHTML="Debe ingresar el año de Inicio de Act. Formato: dd/mm/aaaa";
																		document.forms[0].ano.focus()
																	}
																}else{
																	divMensaje.innerHTML="Fecha Inválida: mes incorrecto";
																	document.forms[0].mes.focus()
																}	
															}else{
																divMensaje.innerHTML="Debe ingresar el mes de Inicio de Act. Formato: dd/mm/aaaa";
																document.forms[0].mes.focus()
															}
														}else{
															divMensaje.innerHTML="Fecha Inválida: día incorrecto";
															document.forms[0].dia.focus()
														}
													}else{
														divMensaje.innerHTML="Debe ingresar el día de Inicio de Act. Formato: dd/mm/aaaa";
														document.forms[0].dia.focus()
													}
												}else{
													divMensaje.innerHTML="Debe ingresar el Telefono";
													document.forms[0].tel.focus()
												}
											}else{
												divMensaje.innerHTML="Debe seleccionar una Provincia";
												document.forms[0].lista_provincia.focus()
											}	 
										}else{
											divMensaje.innerHTML="Debe seleccionar un Pais";
											document.forms[0].lista_pais.focus()
										}		 
									}else{
										divMensaje.innerHTML="Debe ingresar la Dirección";
										document.forms[0].direccion.focus()
									}	
								}else{
									divMensaje.innerHTML="Debe ingresar la condición de IVA";
									document.forms[0].lista_iva.focus()
								}	
							}else{
								divMensaje.innerHTML="Debe ingresar el Ingreso Bruto";
								document.forms[0].ing_bruto.focus()
							}	
						}else{
							divMensaje.innerHTML=error;
							document.forms[0].cuit1.focus()
						}
					}else{
						divMensaje.innerHTML="Debe ingresar el CUIT";
						document.forms[0].cuit3.focus()
					}
				}else{
					divMensaje.innerHTML="Debe ingresar el CUIT";
					document.forms[0].cuit2.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar el CUIT";
				document.forms[0].cuit1.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar el Propietario";
			document.forms[0].dueno.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar la Razon Social";
		document.forms[0].razon.focus()
	}
}
//--------------------------------------------------------------------------------------------------//
function listar_paises_emp(){
	var contenedor=document.getElementById("paises"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_paises_emp.php";
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
function listar_provincias_emp(){
	var contenedor=document.getElementById("provincias"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_provincias_emp.php";
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
function listar_localidades_emp(){
	var contenedor=document.getElementById("localidades"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_localidades_emp.php";
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
function listar_iva_emp(){
	var contenedor=document.getElementById("iva"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_iva_emp.php?";
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
function modificar_empresa(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");
	
	var cant_objetos = document.forms[0].elements.length;

	var txtrazon = document.getElementById("razon");
	var txtdueno = document.getElementById("dueno");	
	var txtcuit1 = document.getElementById("cuit1");
	var txtcuit2 = document.getElementById("cuit2");
	var txtcuit3 = document.getElementById("cuit3");
	var txting_bruto = document.getElementById("ing_bruto");
 	var txtiva = document.forms[0].lista_iva.options[document.forms[0].lista_iva.selectedIndex].text;
	var txtdir = document.getElementById("direccion");
	var txtpais = document.forms[0].lista_pais.options[document.forms[0].lista_pais.selectedIndex].text;
 	var txtprov = document.forms[0].lista_provincia.options[document.forms[0].lista_provincia.selectedIndex].text;
 	var txtloca = document.forms[0].lista_loca.options[document.forms[0].lista_loca.selectedIndex].text;
	var txttel = document.getElementById("tel");
	var txtfax = document.getElementById("fax");
	var txtcel = document.getElementById("cel");
	var txtweb = document.getElementById("web");
	var txtmail = document.getElementById("mail");
	var txtdia = document.getElementById("dia");
	var txtmes = document.getElementById("mes");
	var txtano = document.getElementById("ano");
	var txtlogo = document.getElementById("logo");
	var txtfondo = document.getElementById("fondo");

	if(txtrazon.value != ""){
		if(txtdueno.value != ""){
			if(txtcuit1.value.length == 2){
				if(txtcuit2.value.length == 8){	
					if(txtcuit3.value.length == 1){
						cuit=txtcuit1.value+txtcuit2.value+txtcuit3.value;
						validar_cuit(cuit);					// valida el CUIT ingrsado
						if(error == ""){
							if(txting_bruto.value != ""){
								if(txtiva != ""){	
									if(txtdir.value != ""){
										if(txtprov != "nulo"){
											if(txtloca != "nulo"){
												if(txttel.value != ""){
													if(txtdia.value.length > 1 ){
														if(parseInt(txtdia.value) > 0 && parseInt(txtdia.value) < 32){
															if(txtmes.value.length > 1 ){
																if(parseInt(txtmes.value) > 0 && parseInt(txtmes.value) < 13){
																	if(txtano.value.length > 3 ){
																		if(parseInt(txtano.value) > 1000 && parseInt(txtano.value) < 3000){
																					divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
																					for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
																						document.forms[0].elements[i].disabled=true;
																					}
																					divMensaje.innerHTML="Modificando......."; // mensajes en el div
																					var ajax=nuevoAjax();					// creo una instancia de ajax
																					metodo="POST";							// asigno las variables de proceso
																					url="alta_datos_empresa.php?";
																					fecha = txtdia.value+txtmes.value+txtano.value;
																					variables="razon="+txtrazon.value+"&dueno="+txtdueno.value+"&cuit="+cuit+"&ing_bruto="+txting_bruto.value+"&iva="+txtiva+"&dir="+txtdir.value+"&pais="+txtpais+"&prov="+txtprov+"&localidad="+txtloca+"&tel="+txttel.value+"&fax="+txtfax.value+"&cel="+txtcel.value+"&web="+txtweb.value+"&mail="+txtmail.value+"&fecha="+fecha;
																					//alert(variables);
																					ajax.open(metodo, url, true);
																					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
																					ajax.send(variables);
																					ajax.onreadystatechange=function(){ 
																						if (ajax.readyState==4){
																							/*
																							if(txtlogo.value == "N" || txtfondo.value== "N"){
																									if (confirm('¿Desea adjuntar el Logo de la Empresa o una imagen de fondo?')){ 						// pregunta si desea adjuntar una foto
																										var win = window.open("upload_foto_empresa.php", "win",  "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=300,height=220,top=180,left=400");
																									}
																							}else{																					
																									if (confirm('¿Desea modificar el Logo de la Empresa o la imagen de fondo?')){ 						// pregunta si desea adjuntar una foto
																										var win = window.open("upload_foto_empresa.php", "win",  "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=300,height=220,top=180,left=400");
																									}
																							}
																							*/
																							ver_ficha_empresa()
																							//document.forms[0].codigo.focus()
																						} // fin de if (ajax.readyState==4)
																					} // fin de funcion()
																		}else{
																			divMensaje.innerHTML="Fecha Inválida: año incorrecto";
																			document.forms[0].ano.focus()
																		}
																	}else{
																		divMensaje.innerHTML="Debe ingresar el año de Inicio de Act. Formato: dd/mm/aaaa";
																		document.forms[0].ano.focus()
																	}
																}else{
																	divMensaje.innerHTML="Fecha Inválida: mes incorrecto";
																	document.forms[0].mes.focus()
																}	
															}else{
																divMensaje.innerHTML="Debe ingresar el mes de Inicio de Act. Formato: dd/mm/aaaa";
																document.forms[0].mes.focus()
															}
														}else{
															divMensaje.innerHTML="Fecha Inválida: día incorrecto";
															document.forms[0].dia.focus()
														}
													}else{
														divMensaje.innerHTML="Debe ingresar el día de Inicio de Act. Formato: dd/mm/aaaa";
														document.forms[0].dia.focus()
													}
												}else{
													divMensaje.innerHTML="Debe ingresar el Telefono";
													document.forms[0].tel.focus()
												}
											}else{
												divMensaje.innerHTML="Debe seleccionar una Provincia";
												document.forms[0].lista_provincia.focus()
											}	 
										}else{
											divMensaje.innerHTML="Debe seleccionar un Pais";
											document.forms[0].lista_pais.focus()
										}		 
									}else{
										divMensaje.innerHTML="Debe ingresar la Dirección";
										document.forms[0].direccion.focus()
									}	
								}else{
									divMensaje.innerHTML="Debe ingresar la condición de IVA";
									document.forms[0].lista_iva.focus()
								}	
							}else{
								divMensaje.innerHTML="Debe ingresar el Ingreso Bruto";
								document.forms[0].ing_bruto.focus()
							}	
						}else{
							divMensaje.innerHTML=error;
							document.forms[0].cuit1.focus()
						}
					}else{
						divMensaje.innerHTML="Debe ingresar el CUIT";
						document.forms[0].cuit3.focus()
					}
				}else{
					divMensaje.innerHTML="Debe ingresar el CUIT";
					document.forms[0].cuit2.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar el CUIT";
				document.forms[0].cuit1.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar el Propietario";
			document.forms[0].dueno.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar la Razon Social";
		document.forms[0].razon.focus()
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------REMITO VENTA-----------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function buscar_num_rem_vta(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var div_numero_tal = document.getElementById("numero_tal");
	var txt_numero_tal = document.getElementById("oculto_numero_tal");
	var txt_codigo_tal = document.getElementById("oculto_codigo_tal");
	var divnumero_rem = document.getElementById("numero_rem");
	var txt_numero_rem = document.getElementById("oculto_numero_rem");

	var ajax3=nuevoAjax();										  // creo una instancia de ajax
			metodo="GET";												  // asigno las variables de proceso
			url="buscar_num_rem_vta.php?";
			//variables="codigo="+txtcodigo.value;
			ajax3.open(metodo, url , true); // envia los datos a la pagina php y esta la procesa
			ajax3.onreadystatechange=function(){ 
				if (ajax3.readyState==4){
					divMensaje.innerHTML=" ";			
					var aux = ajax3.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
					
					var error = aux.getElementsByTagName('error').item(0).firstChild.data;
					if (error  == 0){ //si encuentra el cliente buscado
						
						// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
						var codigo_tal = aux.getElementsByTagName('codigo_tal').item(0).firstChild.data; 
						var numero_tal = aux.getElementsByTagName('numero_tal').item(0).firstChild.data;
						var numero_suc = aux.getElementsByTagName('numero_suc').item(0).firstChild.data;
						var numero_rem = aux.getElementsByTagName('numero_rem').item(0).firstChild.data;
						
						// asignamos el valor de las variables del XML a los objetos
						div_numero_tal.innerHTML = numero_tal;
						txt_numero_tal.value = numero_tal;
						txt_codigo_tal.value = codigo_tal;
						divnumero_rem.innerHTML = numero_suc+'-'+numero_rem;
						txt_numero_rem.value = numero_rem;
					}else{
						// asignamos el valor de las variables del XML a los objetos
						div_numero_tal.innerHTML = '0000';
						txt_numero_tal.value = 'ERROR';
						txt_codigo_tal.value = 'ERROR';
						divnumero_rem.innerHTML = '00000000';
						txt_numero_rem.value = 'ERROR';
						divMensaje.innerHTML="ERROR: Nº de Comprobante exedido, Debe registrar un nuevo Talonario";						
					}

				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax3.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}
//---------------------------------------------------------------------------------------------------//
function listar_zona_rem(){
	var contenedor=document.getElementById("zonas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_zonas_rem.php";
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
function listar_cond_iva_rem(){
	var contenedor=document.getElementById("cond_iva"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_cond_iva_rem.php";
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
function listar_cat_rem(){
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
function listar_cat_cliente_rem(codigo){
	var contenedor=document.getElementById("categorias"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_cat_rem.php";
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
function listar_zona_cliente_rem(codigo){
	var contenedor=document.getElementById("zonas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_zonas_rem.php";
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
//--------------------------------------------------------------------------------------------------//
function buscar_cond_iva_cliente_rem(codigo){
	var contenedor=document.getElementById("cond_iva"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_cond_iva_rem.php";
	variables="cod_iva="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}


//--------------------------------------------------------------------------------------------------//
function seleccionar_cliente_remito_vta(){		// abre el pop up para seleccionar en cliente
	var win = window.open("buscar_cliente_alta_remito.php", "win",  "toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=500,top=100,left=200");
}
function buscar_cliente_remito_vta(){			// realiza la busqueda con XML para traer los datos del cliente
			var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
			var txtcodigo = document.getElementById("codigo");
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="GET";												  // asigno las variables de proceso
			url="buscar_cliente_alta_remito.php?";
			variables="codigo="+txtcodigo.value;
			ajax.open(metodo, url + variables, true); // envia los datos a la pagina php y esta la procesa
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					divMensaje.innerHTML=" ";			
					var aux = ajax.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
					
					var error = aux.getElementsByTagName('error').item(0).firstChild.data;
					if (error  == 0){ //si encuentra el cliente buscado
						document.getElementById("razon").value=""; // VUELVE A VACIO TODOS LOS CAMPOS
						document.getElementById("dir").value="";
						document.getElementById("localidad").value="";
						document.getElementById("provincia").value="";
						document.getElementById("cuit1").value="";
						document.getElementById("cuit2").value="";
						document.getElementById("cuit3").value="";
						document.getElementById("vendedor").value="";
						document.getElementById("repartidor").value="";
						
						document.getElementById("razon").disabled= true; 
						document.getElementById("dir").disabled= true;
						document.getElementById("localidad").disabled= true;
						document.getElementById("provincia").disabled= true;
						document.getElementById("cuit1").disabled= true;
						document.getElementById("cuit2").disabled= true;
						document.getElementById("cuit3").disabled= true;
						
						// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
						var razon = aux.getElementsByTagName('razon').item(0).firstChild.data; 
						var dir = aux.getElementsByTagName('dir').item(0).firstChild.data;
						var localidad = aux.getElementsByTagName('localidad').item(0).firstChild.data;
						var provincia = aux.getElementsByTagName('provincia').item(0).firstChild.data;
						
						if(aux.getElementsByTagName('cuit').item(0).firstChild.data == "con"){
								var cuit1 = aux.getElementsByTagName('cuit1').item(0).firstChild.data;
								var cuit2 = aux.getElementsByTagName('cuit2').item(0).firstChild.data;
								var cuit3 = aux.getElementsByTagName('cuit3').item(0).firstChild.data;
						}
						var cond_iva = aux.getElementsByTagName('cond_iva').item(0).firstChild.data;
						var vendedor = aux.getElementsByTagName('vendedor').item(0).firstChild.data;
						var repartidor = aux.getElementsByTagName('repartidor').item(0).firstChild.data;

						// referenciamos los objetos del template y lo almacenamos en variables
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
						txtrazon.value = razon;
						txtdir.value = dir;
						txtlocalidad.value = localidad;
						txtprovincia.value = provincia;
						if(aux.getElementsByTagName('cuit').item(0).firstChild.data == "con"){
							txtcuit1.value = cuit1;
							txtcuit2.value = cuit2;
							txtcuit3.value = cuit3;
						}else{
							txtcuit1.value = "";
							txtcuit2.value = "";
							txtcuit3.value = "";
						}
						txtvendedor.value = vendedor;
						txtrepartidor.value = repartidor;
						buscar_cond_iva_cliente_rem(cond_iva); 				//llama a la funcion para crear la lista de cond de iva
						listar_cat_cliente_rem(txtcodigo.value);
						listar_zona_cliente_rem(txtcodigo.value);
						document.getElementById("lugar").focus();
					}else{
						borrar_cajas_remito_vta();
						divMensaje.innerHTML="ERROR: EL Cliente no existe, F2 para buscar";						
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
function borrar_cajas_remito_vta(){		
	document.getElementById("mensaje").innerHTML=""; 
	document.getElementById("codigo").value=""; 
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
	
	document.getElementById("mensaje_art").innerHTML="";
	document.getElementById("codigo_art").value="";				// Borro el contenido del input
	document.getElementById("desc_art").innerHTML="";
	document.getElementById("cant_art").value="";
	document.getElementById("precio_art").innerHTML="0.00";
	document.getElementById("bonif_art").value="";
	document.getElementById("importe_art").innerHTML="0.00";
	document.getElementById("oculto_importe_art").value="";
	
	var cant_objetos = document.frm.elements.length;
	for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
			document.frm.elements[i].disabled=false;
	}
	
	var cant_objetos = document.frm_art.elements.length;
	for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
			document.frm_art.elements[i].disabled=false;
	}

	listar_zona_rem();
	listar_cat_rem();
	listar_cond_iva_rem();

}

//--------------------------------------------------------------------------------------------------//
function buscar_cliente_alta_remito(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var codigo=document.getElementById("codigo");
	if ( tecla==113 ){ //F2
		seleccionar_cliente_remito_vta();
	}
	if ( tecla==13 &&  codigo.value.length > 0 && codigo.value != "0" ){
		buscar_cliente_remito_vta();
	}
	if ( tecla==13 &&  codigo.value.length == 0){
		borrar_cajas_remito_vta();
		document.getElementById("razon").focus();
	}
}
//--------------------------------------------------------------------------------------------------//
function listar_loca_buscar_alta_rem(){
	var contenedor=document.getElementById("localidades"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_loca_buscar_alta_rem.php";
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
//--------------------BUSCAR CLIENTE EN POP UP -----------------------------------------------------//
function pasar_foco_rem_vta_bus_1(e){
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
function pasar_foco_rem_vta_bus_2(e){
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
function pasar_foco_rem_vta_bus_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13){
			document.frm.enviar.click()
        	return 0;	
	}
}
//--------------------------------------------------------------------------------------------//
function listar_loca_buscar_alta_rem2(){
	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
	var txtcodigo = document.getElementById("codigo");
	var txtrazon = document.getElementById("razon");
	var txtloca = document.frm.lista_loca.options[document.frm.lista_loca.selectedIndex].value;
		
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtcodigo.disabled=true; 
	txtrazon.disabled=true; 
	document.frm.lista_loca.disabled=true;
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_cliente_alta_remito_proceso.php?";
	if(txtcodigo.value == "" && txtrazon.value == "" && txtloca == "TODOS"){
		variables="nombre=TODOS";
	}else{
		variables="codigo="+txtcodigo.value+"&razon="+txtrazon.value+"&localidad="+txtloca;
	}
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				txtcodigo.value="";								// Borro el contenido del input
				txtrazon.value="";								// Borro el contenido del input
				boton.disabled=false;
				txtcodigo.disabled=false; 
				txtrazon.disabled=false; 
				document.frm.lista_loca.disabled=false;
				listar_loca_buscar_alta_rem();
				document.frm.codigo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//-------------------------------------------------------------------------------------------------------------//
function pasar_foco_rem_vta_1(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if(document.frm.razon.value != ""){
				document.frm.dir.focus()
				return 0;
		}
	}
}
function pasar_foco_rem_vta_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if(document.frm.dir.value != ""){
				document.frm.localidad.focus()
				return 0;
		}
	}
}
function pasar_foco_rem_vta_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if(document.frm.localidad.value != ""){
				document.frm.provincia.focus()
				return 0;
		}
	}
}
function pasar_foco_rem_vta_4(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		//if(document.frm.provincia.value != ""){
				document.frm.lista_zona.focus()
				return 0;
		//}
	}
}
function pasar_foco_rem_vta_4a(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		//if(document.frm.provincia.value != ""){
				document.frm.lista_iva.focus()
				return 0;
		//}
	}
}
function pasar_foco_rem_vta_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txt_iva = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].id;
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
function pasar_foco_rem_vta_6(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.cuit1.value.length != 2  || document.frm.cuit2.value.length != 8 || document.frm.cuit3.value.length != 1) {
				document.frm.vendedor.focus()
		}
	}else{
		if( document.frm.cuit1.value.length == 2  ) {	
				document.frm.cuit2.focus()
                return 0;	
		}
	}
}
function pasar_foco_rem_vta_7(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm.cuit2.value.length == 8  ) {
                document.frm.cuit3.focus()
                return 0;		  
	}
}
function pasar_foco_rem_vta_8(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if( document.frm.cuit3.value.length == 1  ) {
                document.frm.vendedor.focus()			
                return 0;		  
	}
}
function pasar_foco_rem_vta_9(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if(document.frm.vendedor.value != ""){
				document.frm.repartidor.focus()
				return 0;
		}
	}
}
function pasar_foco_rem_vta_10(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if(document.frm.repartidor.value != ""){
				if(document.frm.lista_cat.disabled==true ){
					document.frm.lugar.focus();
				}else{
					document.frm.lista_cat.focus();
				}
					return 0;
		}
	}
}
function pasar_foco_rem_vta_10a(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var txt_cat = document.frm.lista_cat.options[document.frm.lista_cat.selectedIndex].text;
	if ( tecla==13){
		if ( txt_cat != ""){			
				document.frm.lugar.focus()
				return 0;
		}
	}

}
function pasar_foco_rem_vta_11(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		//if(document.frm.lugar.value != ""){
				document.frm.hora.focus()
				return 0;
		//}
	}
}
function pasar_foco_rem_vta_12(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		//if(document.frm.hora.value != ""){
				document.frm.obs.focus()
				return 0;
		//}
	}
}
function pasar_foco_rem_vta_13(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		//if(document.frm.repartidor.value != ""){
				document.frm.bonif.focus()
				return 0;
		//}
	}
}
function pasar_foco_rem_vta_14(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if(document.frm.bonif.value != ""){
				if(document.frm.bonif.value <= 100){
						document.frm_art.bonif_art.disabled=true; 
						document.frm_art.codigo_art.focus()
						return 0;
				}
		}else{
				document.frm_art.bonif_art.disabled=false; 
				document.frm_art.codigo_art.focus()
				return 0;
		}
		
	}
}
//--------------------------------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------------------------------//
function listar_grupo_buscar_alta_rem(){
	var contenedor=document.getElementById("grupos"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_grupo_buscar_alta_rem.php";
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
//--------------------BUSCAR ARTICULO EN POP UP ----------------------------------------------------//
function pasar_foco_rem_vta_bus_4(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if(document.frm.codigo.value == ""){
					document.frm.desc.focus()
			}else{
					document.frm.enviar.click()				
			}
			return 0;
	}
}
function pasar_foco_rem_vta_bus_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if(document.frm.desc.value == ""){
					document.frm.lista_grupo.focus()
			}else{
					document.frm.enviar.click()				
			}
			return 0;
	}
}
function pasar_foco_rem_vta_bus_6(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13){
			document.frm.enviar.click()
        	return 0;	
	}
}
//--------------------------------------------------------------------------------------------//
function listar_grupo_buscar_alta_rem2(){
	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
	var txtcodigo = document.getElementById("codigo");
	var txtdesc = document.getElementById("desc");
	var txtgrupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].value;
		
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtcodigo.disabled=true; 
	txtdesc.disabled=true; 
	document.frm.lista_grupo.disabled=true;
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_articulo_alta_remito_proceso.php?";
	if(txtcodigo.value == "" && txtdesc.value == "" && txtgrupo == "TODOS"){
		variables="nombre=TODOS";
	}else{
		variables="codigo="+txtcodigo.value+"&desc="+txtdesc.value+"&grupo="+txtgrupo;
	}
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				txtcodigo.value="";								// Borro el contenido del input
				txtdesc.value="";								// Borro el contenido del input
				boton.disabled=false;
				txtcodigo.disabled=false; 
				txtdesc.disabled=false; 
				document.frm.lista_grupo.disabled=false;
				listar_grupo_buscar_alta_rem();
				document.frm.codigo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//-------------------------------------------------------------------------------------------------------------//
function seleccionar_articulo_remito_vta(){		// abre el pop up para seleccionar en cliente
	var win = window.open("buscar_articulo_alta_remito.php", "win",  "toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=500,top=100,left=200");
	//win.focus()
}
function buscar_articulo_remito_vta(){			// realiza la busqueda con XML para traer los datos del cliente
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
						// limpia todas las cajas y objetos
						document.getElementById("desc_art").innerHTML="";
						document.getElementById("cant_art").value="";
						document.getElementById("precio_art").innerHTML="0.00";
						document.getElementById("bonif_art").value="";
						document.getElementById("importe_art").innerHTML="0.00";
						document.getElementById("oculto_precio_art").value="";
						document.getElementById("oculto_stock").value="";
						
						// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
						var desc_art = aux.getElementsByTagName('desc_art').item(0).firstChild.data; 
						var precio_art = aux.getElementsByTagName('precio_art').item(0).firstChild.data;
						var stock = aux.getElementsByTagName('stock').item(0).firstChild.data;
						
						// referenciamos los objetos del template y lo almacenamos en variables
						desc=document.getElementById("desc_art");  // asigna los aobjetos a las variables
						oculto_desc_art=document.getElementById("oculto_desc_art");  // asigna los aobjetos a las variables
						precio=document.getElementById("precio_art");  // asigna los aobjetos a las variables
						oculto_precio=document.getElementById("oculto_precio_art");  // asigna los aobjetos a las variables
						oculto_stock=document.getElementById("oculto_stock");  // asigna los aobjetos a las variables
						
						// asignamos el valor de las variables del XML a los objetos
						desc.innerHTML = desc_art;
						oculto_desc_art.value=desc_art;
						precio.innerHTML = precio_art;
						oculto_precio.value=precio_art;
						oculto_stock.value=stock;
						document.getElementById("cant_art").value="";
						document.getElementById("cant_art").focus();
					}else{
						document.getElementById("codigo_art").value=""; // VUELVE A VACIO TODOS LOS CAMPOS
						document.getElementById("desc_art").innerHTML="";
						document.getElementById("cant_art").value="";
						document.getElementById("precio_art").innerHTML="0.00";
						document.getElementById("bonif_art").value="";
						document.getElementById("importe_art").innerHTML="0.00";
						document.getElementById("oculto_stock").value="";
						divMensaje.innerHTML="ERROR: EL Artículo no existe, F2 para buscar";						
					}
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}
//--------------------------------------------------------------------------------------------------//
function buscar_articulo_alta_remito(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var codigo=document.getElementById("codigo_art");
	if ( tecla==113 ){  //F2	buscar en pop up
		seleccionar_articulo_remito_vta();
	}
	if ( tecla==13 &&  codigo.value.length > 0 && codigo.value != "0" ){
		buscar_articulo_remito_vta(); // buscar en ajax y xml
	}
	/*
		if ( tecla==118){  //abrir ventana de registrar articulo
			var win = window.open("alta_articulo.php", "win",  "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=500,top=100,left=200");
		}
		
	*/
}
//--------------------------------------------------------------------------------------------------//
function eliminar_art_rem_vta_tmp(fila){
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="eliminar.php?";
	variables="fila="+fila;
//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				mostrar_art_rem_vta_tmp()
				document.getElementById("codigo_art").focus()
				//divlistado.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function mostrar_art_rem_vta_tmp(){
	var divlistado=document.getElementById("listado"); 
	var provincia = document.getElementById("provincia").value;	
	//var numero_rem = document.frm.oculto_numero_rem.value;
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="mostrar_art_rem_vta_tmp.php?";
	var variables="provincia="+provincia
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
/* NO SE USA PERO DEJASR POR LAS DUDAS
function vaciar_tabla_rem_vta_tmp(){
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="vaciar_tabla_rem_vta_tmp.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
}
*/
//--------------------------------------------------------------------------------------------------//
function agregar_articulo_remito_vta(){
	var divMensaje = document.getElementById("mensaje_art");  // asigna los aobjetos a las variables
	//var numero_rem = document.getElementById("oculto_numero_rem").value;  // asigna los aobjetos a las variables
	var codigo_art = document.frm_art.codigo_art.value;
	var desc_art = document.frm_art.oculto_desc_art.value
	var cant_art = document.frm_art.cant_art.value;
	var precio_art = document.frm_art.oculto_precio_art.value;
	var importe_art = document.frm_art.oculto_importe_art.value;

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
	/*
	if(document.frm_art.bonif_art.value >= 100){
		divMensaje.innerHTML = 'Bonificacion exedida';
		document.frm_art.bonif_art.focus()
		//return 0;
	}
	*/
	//divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
    url="alta_remito_vta_tmp.php?";
	//variables="numero_rem="+numero_rem+"&codigo_art="+codigo_art+"&desc_art="+desc_art+"&cant_art="+cant_art+"&precio_art="+precio_art+"&bonif_art="+bonif_art+"&importe_art="+importe_art;
	variables="codigo_art="+codigo_art+"&desc_art="+desc_art+"&cant_art="+cant_art+"&precio_art="+precio_art+"&bonif_art="+bonif_art+"&importe_art="+importe_art;

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
			mostrar_art_rem_vta_tmp()
			document.getElementById("codigo_art").focus()
		} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function calcular_importe(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var divMensaje = document.getElementById("mensaje_art");  // asigna los aobjetos a las variables
	var divImporte = document.getElementById("importe_art");
	var cantidad = document.getElementById("cant_art").value;
	var desc = document.frm_art.oculto_desc_art.value;
	var precio = document.frm_art.oculto_precio_art.value;
	var oculto_importe = document.getElementById("oculto_importe_art");
	//alert(tecla);
	if ( tecla==13 ){
		if(parseFloat(document.frm_art.cant_art.value) > 0){
				if(document.frm_art.bonif_art.disabled == true){			  // pregunta si se definio un % de bonificacion global
						var bonificacion = document.getElementById("bonif").value;
						var importe = parseFloat (cantidad) * parseFloat (precio);
						var bonif = ((parseFloat (cantidad) * parseFloat (precio))* bonificacion)/100;
						var importe = parseFloat (importe) - parseFloat (bonif);
						oculto_importe.value= decimal_precio(importe);
						divImporte.innerHTML= decimal_precio(importe);
				}else{
					if(document.frm_art.bonif_art.value == ""){
							var importe = parseFloat (cantidad) * parseFloat (precio);
							divImporte.innerHTML= decimal_precio(importe);
							document.frm_art.bonif_art.focus();
					}else{
						var bonificacion = document.getElementById("bonif_art").value;
						
						if(parseFloat (bonificacion) == 100){
							var importe = 0;
						}else{
							var importe = parseFloat (cantidad) * parseFloat (precio);
							var bonif = ((parseFloat (cantidad) * parseFloat (precio))* bonificacion)/100;
							var importe = parseFloat (importe) - parseFloat (bonif);
						}

						
						
						
						oculto_importe.value= decimal_precio(importe);
						divImporte.innerHTML= decimal_precio(importe); 
						/*          REALIZAR PROCESO DE AGREGO A LISTA			********************************/						
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
								agregar_articulo_remito_vta();
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
//------------------------------------REGISTRAR REMITO VENTA-----------------------------------------//
function registrar_remito_vta(){
	var divMensaje = document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var numero_rem = document.frm.oculto_numero_rem.value;
	var fecha = document.frm.oculto_fecha.value;
	var hora = document.getElementById("hora_actual");  // asigna los aobjetos a las variables

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

	var obs = document.frm.obs.value;
	
	var requiere_cuit = document.frm.lista_iva.options[document.frm.lista_iva.selectedIndex].id;
	//alert(requiere_cuit);
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
	
 if(numero_rem != 'ERROR'){
	if(razon != ""){
		if(dir != ""){
			if(localidad != ""){
				if(error == ""){
					if(vendedor != ""){
						if(repartidor != ""){
							if(categoria != ""){
								//if(lugar != ""){
									//if(hora != ""){ 												// finaliza la validacion de la cabezera
												var ajax=nuevoAjax();										// creo una instancia de ajax
												metodo="POST";												// asigno las variables de proceso
												url="consultar_art_rem_vta_tmp.php";						// consulto si existen articulos en la tabla temporal
												ajax.open(metodo, url, true);
												ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
												ajax.send(null);
												ajax.onreadystatechange=function(){ 
														if (ajax.readyState==4){
															if(ajax.responseText == 'si'){									// si existen articulos sigo y guardo definitivamente
																		var ajax2=nuevoAjax();										// creo una instancia de ajax
																		metodo="POST";												// asigno las variables de proceso
																		url="alta_remito_vta.php";
																		variables="fecha="+fecha+"&lugar="+lugar+"&hora="+hora+"&cod_cliente="+cod_cliente+"&categoria="+categoria+"&razon="+razon+"&dir="+dir+"&localidad="+localidad+"&provincia="+provincia+"&iva="+iva+"&cuit="+cuit+"&vendedor="+vendedor+"&repartidor="+repartidor+"&obs="+obs+"&zona="+zona;
																		//alert(variables);
																		ajax2.open(metodo, url, true);
																		ajax2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
																		ajax2.send(variables);
																		ajax2.onreadystatechange=function(){ 
																				if (ajax2.readyState==4){
																						buscar_num_rem_vta();
																						borrar_cajas_remito_vta();
																						mostrar_art_rem_vta_tmp();
																						document.frm.codigo.focus();
																						//alert(ajax2.responseText);
																				} // fin de if (ajax.readyState==4)
																			} // fin de funcion()
															}else{
																divMensaje.innerHTML="Debe agregar almenos un artículo";
																document.frm_art.codigo_art.focus()
															}
														} // fin de if (ajax.readyState==4)
													} // fin de funcion()
								/*	}else{
										divMensaje.innerHTML="Debe ingresar la hora de entrega";
										document.frm.hora.focus()
									}
								}else{
									divMensaje.innerHTML="Debe ingresar el lugar de entrega";
									document.frm.lugar.focus()
								}	*/ 
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
	divMensaje.innerHTML="ERROR: Verifique de que exista un Talonario de Remito";
 }
}
//--------------------------------------------------------------------------------------------------//
function actualizar_cant_art_rem_vta(e,id_Text){ 
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if(document.getElementById(id_Text).value != ""){
					var cant=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_art_rem_vta="+id_Text+"&cantidad="+cant;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_rem_vta_tmp();
								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}
	}
}
function actualizar_cant_art_rem_vta_blur(id_Text){
			if(document.getElementById(id_Text).value != ""){ 
					var cant=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_art_rem_vta="+id_Text+"&cantidad="+cant;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_rem_vta_tmp();
								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}
}

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
function listar_zona_fac(){
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
function listar_cond_iva_fac(){
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
function listar_cat_fac(){
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
										divMensaje.innerHTML="ERROR: EL Remito no existe o ya fu&eacute; facturado, F2 para buscar";						
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




///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------CONF LISTADOS -------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_impr_conf_listados(){
	var contenedor=document.getElementById("impresoras"); 
	contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	//contenedor.innerHTML="Buscando Impresoras......";
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_impr_conf_listados.php";

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.lista_tt.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//---------------------------------------------------------------------------------------------------//
function pasar_foco_conf_listados_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	       if( document.frm.filas.value.length > 0  && document.frm.impresora_mod) {
                document.frm.impresora_mod.focus()
                return 0;		  
		   }	
     }
}
function pasar_foco_conf_listados_2(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
           document.frm.enviar.click()
		   return 0;
	  
     }
}
//--------------------------------------------------------------------------------------------------//
function actualizar_conf_listados(){
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var boton=document.getElementById("enviar");
 var txtfilas = document.getElementById("filas");
 var txtimpresora = document.getElementById("impresora_mod");
 if(document.frm.filas.value != ""){
	divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
	txtfilas.disabled=true; 
	txtimpresora.disabled=true; 
	
	divMensaje.innerHTML="Actualizando......."; // mensajes en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
    url="conf_listados_bd.php?";
	variables="filas="+txtfilas.value+"&impresora="+txtimpresora.value;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				//txtfilas.value="";			// Borro el contenido del input
				boton.disabled=false; 		// Habilito campos y boton nuevamente
				txtfilas.disabled=false; 
				txtimpresora.disabled=false; 
				divMensaje.innerHTML=ajax.responseText; // imprime la salida
				document.frm.filas.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
 }else{
	divMensaje.innerHTML="Debe ingresar la cantidad de Filas por página";
	document.frm.fias.focus() 
 }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------FINALIZAR CARGA -----------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function pasar_foco_fin_carga(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
			if( document.frm.lista_rep.value != 'error'  ) {
				document.frm.enviar.click();
				return 0;		 
	        }
		}
}
//--------------------------------------------------------------------------------------------------//
function listar_repartidores_fin_carga(cod_prov){
	var contenedor=document.getElementById("repartidores"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_repartidores_fin_carga.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.lista_rep.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function finalizar_carga(){
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var txtrep = document.getElementById("lista_rep");
 var boton=document.getElementById("enviar");
 
 if(txtrep.value != "error"){
	divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
	txtrep.disabled=true; 
	
	// ================= Obtiene la hora actual =============
	momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()
	if(hora < 10){
		hora="0"+hora;
	}
	if(minuto < 10){
		minuto="0"+minuto;
	}
	if(segundo < 10){
		segundo="0"+segundo;
	}
    hora_actual =hora + ":" + minuto + ":" + segundo

	//=======================================================
	
	divMensaje.innerHTML="Finalizando......."; // mensajes en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
    url="finalizar_carga.php?";
	variables="repartidor="+txtrep.value+"&hora_actual="+hora_actual;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				boton.disabled=false; 		// Habilito campos y boton nuevamente
				txtrep.disabled=false; 
				divMensaje.innerHTML=ajax.responseText; // imprime la salida
				txtrep.focus();
				
				//window.open(url_php+"?consulta="+consulta, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
 }else{
	divMensaje.innerHTML="ERROR: No existen Cargas";
	txtrep.focus() ;
 }
}

//--------------------------------------------------------------------------------------------------//
function exportar_carga_del_dia(url_php){	
	//alert(url_php);
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	window.open(url_php+"?fecha_buscar="+fecha_buscar, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

/*
//--------------------------------------------------------------------------------------------------//
function exportar_carga(){
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var txtrep = document.getElementById("lista_rep");
 var boton=document.getElementById("enviar");
 
 if(txtrep.value != "error"){
	divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
	txtrep.disabled=true; 
	
	// ================= Obtiene la hora actual =============
	momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()
	if(hora < 10){
		hora="0"+hora;
	}
	if(minuto < 10){
		minuto="0"+minuto;
	}
	if(segundo < 10){
		segundo="0"+segundo;
	}
    hora_actual =hora + ":" + minuto + ":" + segundo

	//=======================================================
	
	divMensaje.innerHTML="Finalizando......."; // mensajes en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
    url="finalizar_carga.php?";
	variables="repartidor="+txtrep.value+"&hora_actual="+hora_actual;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				boton.disabled=false; 		// Habilito campos y boton nuevamente
				txtrep.disabled=false; 
				divMensaje.innerHTML=ajax.responseText; // imprime la salida
				txtrep.focus();
				
				//window.open(url_php+"?consulta="+consulta, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
 }else{
	divMensaje.innerHTML="ERROR: No existen Cargas";
	txtrep.focus() ;
 }
}
*/
///////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------- ANULAR FACTURA VTA --------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function pasar_anular_f_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.cod_tal.value.length > 0  ) {
                document.frm.num_tal.focus()
                return 0;		  
			}	  
	}
}
function pasar_anular_f_2(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.num_tal.value.length > 0  ) {
                document.frm.num_fac.focus()
                return 0;		  
			}	  
	}
}
function pasar_anular_f_3(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.num_fac.value.length > 0  ) {
                document.frm.buscar.click()
                return 0;		  
			}	  
	}
}
//==================================================================================================//
function buscar_factura_vta_anular(){
 var divListado=document.getElementById("listado");  // asigna los aobjetos a las variables
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var boton_buscar=document.getElementById("buscar");
 var boton_anular=document.getElementById("anular");
 var txtcod_tal = document.getElementById("cod_tal");
 var txtnum_tal = document.getElementById("num_tal");
 var txtnum_fac = document.getElementById("num_fac");
 
 if(document.frm.cod_tal.value != ""){
	 if(document.frm.num_tal.value != ""){
		  if(document.frm.num_fac.value != ""){
			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
			boton_buscar.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
			boton_anular.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
			txtcod_tal.disabled=true; 
			txtnum_tal.disabled=true; 
			txtnum_fac.disabled=true; 
			
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
			url="buscar_factura_vta_anular.php?";
			variables="cod_tal="+document.frm.cod_tal.value+"&num_tal="+document.frm.num_tal.value+"&num_fac="+document.frm.num_fac.value;
			//alert(variables);
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
						boton_buscar.disabled=false; 				    // Deshabilito el boton y el input para evitar dobles ingresos
						boton_anular.disabled=false; 				    // Deshabilito el boton y el input para evitar dobles ingresos
						txtcod_tal.disabled=false; 
						txtnum_tal.disabled=false; 
						txtnum_fac.disabled=false; 
						divMensaje.innerHTML=""; // imprime la salida
						divListado.innerHTML=ajax.responseText; // imprime la salida
						
						if (document.getElementById("oculto_btn_anular")){
							var oculto_btn_anular = document.getElementById("oculto_btn_anular");
							if( oculto_btn_anular.value == 1 ){
								document.frm.anular.disabled = true;
								//document.frm.anular.focus();
							}else{
								document.frm.anular.disabled = false;
								document.frm.anular.focus();
							}
						}
						
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
		   }else{
			divMensaje.innerHTML="Debe ingresar el Número de la factura";
			document.frm.num_fac.focus() 
		 }
	  }else{
		divMensaje.innerHTML="Debe ingresar el Número del talonario";
		document.frm.num_tal.focus() 
	 }
 }else{
	divMensaje.innerHTML="Debe ingresar el Código del talonario";
	document.frm.cod_tal.focus() 
 }
}
//==================================================================================================//
function anular_factura_vta(){
 var divListado=document.getElementById("listado");  // asigna los aobjetos a las variables
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var boton_buscar=document.getElementById("buscar");
 var boton_anular=document.getElementById("anular");
 var txtcod_tal = document.getElementById("cod_tal");
 var txtnum_tal = document.getElementById("num_tal");
 var txtnum_fac = document.getElementById("num_fac");
 
 if(document.frm.cod_tal.value != ""){
	 if(document.frm.num_tal.value != ""){
		  if(document.frm.num_fac.value != ""){
			 	//buscar_factura_vta_anular();
								if (confirm('¿Está seguro de anular esta factura?')){
										divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
										boton_buscar.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
										boton_anular.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
										txtcod_tal.disabled=true; 
										txtnum_tal.disabled=true; 
										txtnum_fac.disabled=true; 
				
										divMensaje.innerHTML="Buscando......."; // mensajes en el div
										var ajax=nuevoAjax();					// creo una instancia de ajax
										metodo="POST";							// asigno las variables de proceso
										url="anular_factura_vta.php?";
										variables="cod_tal="+document.frm.cod_tal.value+"&num_tal="+document.frm.num_tal.value+"&num_fac="+document.frm.num_fac.value;
										//alert(variables);
										ajax.open(metodo, url, true);
										ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
										ajax.send(variables);
										ajax.onreadystatechange=function(){ 
												if (ajax.readyState==4){
													boton_buscar.disabled=false; 				    // Deshabilito el boton y el input para evitar dobles ingresos
													boton_anular.disabled=false; 				    // Deshabilito el boton y el input para evitar dobles ingresos
													txtcod_tal.disabled=false; 
													txtnum_tal.disabled=false; 
													txtnum_fac.disabled=false; 
													divMensaje.innerHTML=""; // imprime la salida
													divListado.innerHTML=ajax.responseText; // imprime la salida
													document.frm.cod_tal.focus()
												} // fin de if (ajax.readyState==4)
										} // fin de funcion()
								}
		   }else{
			divMensaje.innerHTML="Debe ingresar el Número de la factura";
			document.frm.num_fac.focus() 
		 }
	  }else{
		divMensaje.innerHTML="Debe ingresar el Número del talonario";
		document.frm.num_tal.focus() 
	 }
 }else{
	divMensaje.innerHTML="Debe ingresar el Código del talonario";
	document.frm.cod_tal.focus() 
 }

}

///////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------- BUSCAR FACTURA VTA --------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function buscar_factura_vta(){
 var divListado=document.getElementById("listado");  // asigna los aobjetos a las variables
 var divListado_detalle=document.getElementById("listado_detalle_comprobante");  // asigna los aobjetos a las variables
 
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var boton_buscar=document.getElementById("buscar");
 var txtcod_tal = document.getElementById("cod_tal");
 var txtnum_tal = document.getElementById("num_tal");
 var txtnum_fac = document.getElementById("num_fac");
 
 if(document.frm.cod_tal.value != ""){
	 if(document.frm.num_tal.value != ""){
		  if(document.frm.num_fac.value != ""){
			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
			boton_buscar.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
			txtcod_tal.disabled=true; 
			txtnum_tal.disabled=true; 
			txtnum_fac.disabled=true; 
			
			
			divListado.innerHTML = ""; // imprime la salida
			divListado_detalle.innerHTML = ""; // imprime la salida
						
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
			url="buscar_factura_vta.php?";
			variables="cod_tal="+document.frm.cod_tal.value+"&num_tal="+document.frm.num_tal.value+"&num_fac="+document.frm.num_fac.value;
			//alert(variables);
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
						boton_buscar.disabled=false; 				    // Deshabilito el boton y el input para evitar dobles ingresos
						txtcod_tal.disabled=false; 
						txtnum_tal.disabled=false; 
						txtnum_fac.disabled=false; 
						divMensaje.innerHTML=""; // imprime la salida
						divListado.innerHTML=ajax.responseText; // imprime la salida
						document.frm.cod_tal.focus()
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
		   }else{
			divMensaje.innerHTML="Debe ingresar el Número de la factura";
			document.frm.num_fac.focus() 
		 }
	  }else{
		divMensaje.innerHTML="Debe ingresar el Número del talonario";
		document.frm.num_tal.focus() 
	 }
 }else{
	divMensaje.innerHTML="Debe ingresar el Código del talonario";
	document.frm.cod_tal.focus() 
 }
}

//--------------------------------------------------------------------------------------------------//
function exportar_informe_buscar_factura_vta(url_php){	
	//alert(url_php);
	var cod_tal = document.getElementById("cod_tal");
 	var num_tal = document.getElementById("num_tal");
	var num_fac = document.getElementById("num_fac");
	window.open(url_php+"?cod_tal="+cod_tal.value+"&num_tal="+num_tal.value+"&num_fac="+num_fac.value , '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

//--------------------------------------------------------------------------------------------------//
function imprimir_informe_buscar_factura_vta(pag_exp){
	var cod_tal = document.getElementById("cod_tal");
 	var num_tal = document.getElementById("num_tal");
	var num_fac = document.getElementById("num_fac");
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="cod_tal="+cod_tal.value+"&num_tal="+num_tal.value+"&num_fac="+num_fac.value+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=IMPRIMIENDO FACTURA...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------------------------//
function buscar_factura_vta_detalle_comprobante(cod_tal,num_tal,num_fac,desc_fac,suc){
	var contenedor=document.getElementById("listado_detalle_comprobante"); 

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_factura_vta_detalle_comprobante.php";
	variables = "cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function exportar_factura_vta_detalle_comprobante(url_php){	
	//alert(url_php);	
	var cod_tal = document.getElementById("oculto_cod_talonario").value
	var num_tal = document.getElementById("oculto_n_talonario").value
	var num_fac = document.getElementById("oculto_n_factura").value
	var desc_fac = document.getElementById("oculto_desc_fac").value
	var suc = document.getElementById("oculto_suc").value
	
	window.open(url_php+"?cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

//--------------------------------------------------------------------------------------------------//
function imprimir_factura_vta_detalle_comprobante(pag_exp){
	var cod_tal = document.getElementById("oculto_cod_talonario").value
	var num_tal = document.getElementById("oculto_n_talonario").value
	var num_fac = document.getElementById("oculto_n_factura").value
	var desc_fac = document.getElementById("oculto_desc_fac").value
	var suc = document.getElementById("oculto_suc").value

	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
/*
*/
///////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------- ANULAR FACTURA VTA NUMERACION ---------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function pasar_anular_f_3_numeracion(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.num_fac.value.length > 0  ) {
                document.frm.anular.click()
                return 0;		  
			}	  
	}
}

//==================================================================================================//
function anular_factura_vta_numeracion(){
 var divListado=document.getElementById("listado");  // asigna los aobjetos a las variables
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var boton_anular=document.getElementById("anular");
 var txtcod_tal = document.getElementById("cod_tal");
 var txtnum_tal = document.getElementById("num_tal");
 var txtnum_fac = document.getElementById("num_fac");

if(document.frm.cod_tal.value != ""){
	 if(document.frm.num_tal.value != ""){
		  if(document.frm.num_fac.value != ""){
				//buscar_factura_vta_anular();
								if (confirm('¿Está seguro de anular esta numeración?')){
										divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
										boton_anular.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
										txtcod_tal.disabled=true; 
										txtnum_tal.disabled=true; 
										txtnum_fac.disabled=true; 
				
										divMensaje.innerHTML="Buscando......."; // mensajes en el div
										var ajax=nuevoAjax();					// creo una instancia de ajax
										metodo="POST";							// asigno las variables de proceso
										url="anular_factura_vta_numeracion.php?";
										variables="cod_tal="+document.frm.cod_tal.value+"&num_tal="+document.frm.num_tal.value+"&num_fac="+document.frm.num_fac.value;
										//alert(variables);
										ajax.open(metodo, url, true);
										ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
										ajax.send(variables);
										ajax.onreadystatechange=function(){ 
												if (ajax.readyState==4){
													boton_anular.disabled=false; 				    // Deshabilito el boton y el input para evitar dobles ingresos
													txtcod_tal.disabled=false; 
													txtnum_tal.disabled=false; 
													txtnum_fac.disabled=false; 
													
													divMensaje.innerHTML=""; // imprime la salida
													divListado.innerHTML=ajax.responseText; // imprime la salida
													document.frm.cod_tal.focus()
												} // fin de if (ajax.readyState==4)
										} // fin de funcion()
								}
		   }else{
			divMensaje.innerHTML="Debe ingresar el Número de la factura";
			document.frm.num_fac.focus() 
		 }
	  }else{
		divMensaje.innerHTML="Debe ingresar el Número del talonario";
		document.frm.num_tal.focus() 
	 }
 }else{
	divMensaje.innerHTML="Debe ingresar el Código del talonario";
	document.frm.cod_tal.focus() 
 }

}

///////////////////////////////////////////////////////////////////////////////////////////////////////
//---------------------------------- DEVOLUCIONES ---------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function buscar_num_devolucion_vta(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var div_numero_tal = document.getElementById("numero_tal");
	var txt_numero_tal = document.getElementById("oculto_numero_tal");
	var txt_codigo_tal = document.getElementById("oculto_codigo_tal");
	var div_num_devolucion = document.getElementById("num_devolucion");
	var txt_num_devolucion = document.getElementById("oculto_num_devolucion");

			var ajax3=nuevoAjax();										  // creo una instancia de ajax
			metodo="GET";												  // asigno las variables de proceso
			url="buscar_num_devolucion_vta.php?";
			//variables="codigo="+txtcodigo.value;
			ajax3.open(metodo, url , true); // envia los datos a la pagina php y esta la procesa
			ajax3.onreadystatechange=function(){ 
				if (ajax3.readyState==4){
					divMensaje.innerHTML=" ";			
					var aux = ajax3.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
					
					var error = aux.getElementsByTagName('error').item(0).firstChild.data;
					if (error  == 0){ //si encuentra el cliente buscado
						
						// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
						var codigo_tal = aux.getElementsByTagName('codigo_tal').item(0).firstChild.data; 
						var numero_tal = aux.getElementsByTagName('numero_tal').item(0).firstChild.data;
						var numero_suc = aux.getElementsByTagName('numero_suc').item(0).firstChild.data;
						var num_devolucion = aux.getElementsByTagName('num_devolucion').item(0).firstChild.data;
						
						// asignamos el valor de las variables del XML a los objetos
						div_numero_tal.innerHTML = numero_tal;
						txt_numero_tal.value = numero_tal;
						txt_codigo_tal.value = codigo_tal;
						div_num_devolucion.innerHTML = numero_suc+'-'+num_devolucion;
						txt_num_devolucion.value = num_devolucion;
					}else{
						// asignamos el valor de las variables del XML a los objetos
						div_numero_tal.innerHTML = '0000';
						txt_numero_tal.value = 'ERROR';
						txt_codigo_tal.value = 'ERROR';
						div_num_devolucion.innerHTML = '00000000';
						txt_num_devolucion.value = 'ERROR';
						divMensaje.innerHTML="ERROR: Nº de Comprobante inexistente o exedido, Debe registrar un nuevo Talonario";						
					}

				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax3.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}
//---------------------------------------------------------------------------------------------------//
function listar_vendedor_devolucion(){
	var contenedor=document.getElementById("vendedores"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_vendedor_devolucion.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.vendedor.focus();
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_dev_1(e){ //caja lugar
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.dia.focus()
			return 0;
	}
}
function pasar_foco_dev_2(e){ //caja hora
	tecla = (document.all) ? e.keyCode : e.which; // 2
		if(document.frm.dia.value.length == 2){
			document.frm.mes.focus()
			return 0;
		}
}
function pasar_foco_dev_3(e){ //caja hora
	tecla = (document.all) ? e.keyCode : e.which; // 2
		if(document.frm.mes.value.length == 2){
			document.frm.ano.focus()
			return 0;
		}
}
//=================================================================================================//
function buscar_carga_devolucion(){ //caja hora
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var txt_dia = document.getElementById("dia");
	var txt_mes = document.getElementById("mes");
	var txt_ano = document.getElementById("ano")
	var txt_vendedor = document.getElementById("vendedor");
	fecha= txt_ano.value+txt_mes.value+txt_dia.value;
	fecha_msg = txt_dia.value+'/'+txt_mes.value+'/'+txt_ano.value;
	
	if(fecha_msg.length == 10){
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
			url="buscar_carga_devolucion.php?";
			variables="fecha_carga="+fecha+"&vendedor="+txt_vendedor.value;
			//alert(variables);
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
							if(ajax.responseText == 'existe'){		
									divMensaje.innerHTML=""; 
									document.frm_art.codigo_art.focus()
							}else{
									divMensaje.innerHTML="El vendedor "+txt_vendedor.value+' no ha registrado Movimientos en la fecha '+fecha_msg ; // imprime la salida
									document.frm.vendedor.focus()
							}
							return 0;
					} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
	
}
	
function pasar_foco_dev_4(e){ //caja hora
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if(document.frm.ano.value != ""){
			buscar_carga_devolucion();
		}
	}
}

//--------------------------------------------------------------------------------------------//
function buscar_articulo_devolucion_pop_up(){
	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
	var txtcodigo = document.getElementById("codigo");
	var txtdesc = document.getElementById("desc");
	var txtgrupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].value;
		
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtcodigo.disabled=true; 
	txtdesc.disabled=true; 
	document.frm.lista_grupo.disabled=true;
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_articulo_devolucion_pop_up_proceso.php?";
	if(txtcodigo.value == "" && txtdesc.value == "" && txtgrupo == "TODOS"){
		variables="nombre=TODOS";
	}else{
		variables="codigo="+txtcodigo.value+"&desc="+txtdesc.value+"&grupo="+txtgrupo;
	}
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				txtcodigo.value="";								// Borro el contenido del input
				txtdesc.value="";								// Borro el contenido del input
				boton.disabled=false;
				txtcodigo.disabled=false; 
				txtdesc.disabled=false; 
				document.frm.lista_grupo.disabled=false;
				listar_grupo_buscar_alta_rem();
				document.frm.codigo.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//----------------------------------------------------------------------------------------------------------------//
function seleccionar_articulo_devolucion(){		// abre el pop up para seleccionar en cliente
	var win = window.open("buscar_articulo_devolucion.php", "win",  "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=500,top=100,left=200");
	//win.focus()
}
function buscar_articulo_devolucion(){			// realiza la busqueda con XML para traer los datos del cliente
			var divMensaje=document.getElementById("mensaje_art");  // asigna los aobjetos a las variables
			var txtcodigo = document.getElementById("codigo_art");
			
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="GET";												  // asigno las variables de proceso
			url="buscar_articulo_devolucion.php?";
			variables="codigo="+txtcodigo.value;
			//alert(variables);
			ajax.open(metodo, url + variables, true); // envia los datos a la pagina php y esta la procesa
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					divMensaje.innerHTML=" ";			
					var aux = ajax.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
					
					var error = aux.getElementsByTagName('error').item(0).firstChild.data;
					if (error  == 0){ //si encuentra el cliente buscado
						// limpia todas las cajas y objetos
						document.getElementById("desc_art").innerHTML="";
						
						// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
						var desc_art = aux.getElementsByTagName('desc_art').item(0).firstChild.data; 
						
						// referenciamos los objetos del template y lo almacenamos en variables
						desc=document.getElementById("desc_art");  // asigna los aobjetos a las variables
						oculto_desc_art=document.getElementById("oculto_desc_art");  // asigna los aobjetos a las variables
						
						// asignamos el valor de las variables del XML a los objetos
						desc.innerHTML = desc_art;
						oculto_desc_art.value=desc_art;
						document.getElementById("cant_art").focus();
					}else{
						document.getElementById("codigo_art").value=""; // VUELVE A VACIO TODOS LOS CAMPOS
						document.getElementById("desc_art").innerHTML="";
						document.getElementById("cant_art").value="";
						divMensaje.innerHTML="ERROR: EL Artículo no existe, F2 para buscar";						
					}
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}


//----------------------------------------------------------------------------------------------------------------//
function buscar_articulo_alta_devolucion(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var codigo=document.getElementById("codigo_art");
	if ( tecla==113 ){  //F2	buscar en pop up
		seleccionar_articulo_devolucion();
	}
	if ( tecla==13 &&  codigo.value.length > 0 && codigo.value != "0" ){
		buscar_articulo_devolucion(); // buscar en ajax y xml
	}
	/*
		if ( tecla==118){  //abrir ventana de registrar articulo
			var win = window.open("alta_articulo.php", "win",  "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=500,top=100,left=200");
		}
	*/
}
//--------------------------------------------------------------------------------------------------//
function agregar_articulo_devolucion_proc(){
	var divMensaje = document.getElementById("mensaje_art");  // asigna los aobjetos a las variables
	var codigo_art = document.frm_art.codigo_art.value;
	var desc_art = document.frm_art.oculto_desc_art.value
	var cant_art = document.frm_art.cant_art.value;
	
	var txt_dia = document.getElementById("dia");
	var txt_mes = document.getElementById("mes");
	var txt_ano = document.getElementById("ano")
	var txt_vendedor = document.getElementById("vendedor");
	var fecha = txt_ano.value+txt_mes.value+txt_dia.value;

	if(document.frm_art.cant_art.value != 0 && document.frm_art.cant_art.value.length > 0 && fecha.length != ""){
			//divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
			url="alta_devolucion_tmp.php?";
			variables="codigo_art="+codigo_art+"&cant_art="+cant_art+"&vendedor="+txt_vendedor.value+"&fecha_carga="+fecha;
			//alert(variables);
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
						if(ajax.responseText == "maximo_superado"){			
										divMensaje.innerHTML="ERROR: Limite exedido, la cantidad a devolver supera la facturada";
										document.getElementById("cant_art").focus()
						}
						if(ajax.responseText == "limite_exedido"){			
										divMensaje.innerHTML="ERROR: Limite exedido, Maximo $max_iter iteracones por Devolucion";
										document.getElementById("codigo_art").value="";				// Borro el contenido del input
										document.getElementById("desc_art").innerHTML="";
										document.getElementById("cant_art").value="";
										document.getElementById("codigo_art").focus()
						}
						if(ajax.responseText == "no_existe"){			
										divMensaje.innerHTML="ERROR: El atículo no ha sido Pedido en esta Carga";
										document.getElementById("codigo_art").value="";				// Borro el contenido del input
										document.getElementById("desc_art").innerHTML="";
										document.getElementById("cant_art").value="";
										document.getElementById("codigo_art").focus()
						}

						if(ajax.responseText == "ok"){			
							document.getElementById("codigo_art").value="";				// Borro el contenido del input
							document.getElementById("desc_art").innerHTML="";
							document.getElementById("cant_art").value="";
							document.getElementById("codigo_art").focus()
							divMensaje.innerHTML = "";
							mostrar_art_devolucion_tmp()
						}
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
}
//--------------------------------------------------------------------------------------------------//
function agregar_articulo_devolucion(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==107 ){ // teclas: 107= '+'         119= 'F8'
		if(document.frm.oculto_numero_tal.value != "ERROR" && document.frm_art.codigo_art.value > 0 && document.frm_art.oculto_desc_art.value != "" && document.frm_art.cant_art.value > 0 ){
				agregar_articulo_devolucion_proc();
		}
	}
}
//--------------------------------------------------------------------------------------------------//
function mostrar_art_devolucion_tmp(){
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="mostrar_art_devolucion_tmp.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function eliminar_art_devolucion_tmp(fila){
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="eliminar.php?";
	variables="fila_dev="+fila;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				mostrar_art_devolucion_tmp()
				document.getElementById("codigo_art").focus()
				//divlistado.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function actualizar_cant_art_devolucion(e,id_Text){
	var divMensaje = document.getElementById("mensaje_art");  // asigna los aobjetos a las variables

	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			var txt_dia = document.getElementById("dia");
			var txt_mes = document.getElementById("mes");
			var txt_ano = document.getElementById("ano")
			var txt_vendedor = document.getElementById("vendedor");
			var fecha = txt_ano.value+txt_mes.value+txt_dia.value;

			if(document.getElementById(id_Text).value != ""){
					var cant=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_art_dev="+id_Text+"&cantidad="+cant+"&vendedor_dev="+txt_vendedor.value+"&fecha_carga_dev="+fecha;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "maximo_superado"){			
											divMensaje.innerHTML="ERROR: Limite exedido, la cantidad devuelta supera la facturada";
								}
								mostrar_art_devolucion_tmp();

							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}
	}
}
function actualizar_cant_art_devolucion_blur(id_Text){
			var divMensaje = document.getElementById("mensaje_art");  // asigna los aobjetos a las variables			
			if(document.getElementById(id_Text).value != ""){
					var txt_dia = document.getElementById("dia");
					var txt_mes = document.getElementById("mes");
					var txt_ano = document.getElementById("ano")
					var txt_vendedor = document.getElementById("vendedor");
					var fecha = txt_ano.value+txt_mes.value+txt_dia.value;

					var cant=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_art_dev="+id_Text+"&cantidad="+cant+"&vendedor_dev="+txt_vendedor.value+"&fecha_carga_dev="+fecha;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){  
							if (ajax.readyState==4){
								if(ajax.responseText == "maximo_superado"){			
											divMensaje.innerHTML="ERROR: Limite exedido, la cantidad devuelta supera la facturada";
								}
								mostrar_art_devolucion_tmp();
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}
}
//------------------------------------REGISTRAR DEVOLUCION ----------------------------------------//
function registrar_devolucion(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var txt_numero_tal = document.getElementById("oculto_numero_tal");
	
	var txt_dia = document.getElementById("dia");
	var txt_mes = document.getElementById("mes");
	var txt_ano = document.getElementById("ano")
	var txt_vendedor = document.getElementById("vendedor");
	fecha= txt_ano.value+txt_mes.value+txt_dia.value;
	fecha_msg = txt_dia.value+'/'+txt_mes.value+'/'+txt_ano.value;

	if(txt_numero_tal.value != "ERROR"){
		if(txt_vendedor.value != ""){
			if(txt_dia.value.length == 2 && txt_mes.value.length == 2 && txt_ano.value.length == 4){
						var ajax=nuevoAjax();										// creo una instancia de ajax
						metodo="POST";												// asigno las variables de proceso
						url="consultar_art_devolucion_tmp.php";						// consulto si existen articulos en la tabla temporal
						ajax.open(metodo, url, true);
						ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						ajax.send(null);
						ajax.onreadystatechange=function(){ 
						if (ajax.readyState==4){
								if(ajax.responseText == 'si'){									// si existen articulos sigo y guardo definitivamente
											var ajax2=nuevoAjax();										// creo una instancia de ajax
											metodo="POST";												// asigno las variables de proceso
											url="devoluciones.php";
											variables="fecha_carga="+fecha+"&vendedor="+txt_vendedor.value;
											//alert(variables);
											ajax2.open(metodo, url, true);
											ajax2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
											ajax2.send(variables);
											ajax2.onreadystatechange=function(){ 
														if (ajax2.readyState==4){
																if(ajax2.responseText == 'ok'){	
																	divMensaje.innerHTML="";
																	//mostrar_art_devolucion_tmp();
																	document.frm.dia.value="";
																	document.frm.mes.value="";
																	document.frm.ano.value="";
																	document.frm.vendedor.focus();
																	document.getElementById("codigo_art").value="";				// Borro el contenido del input
																	document.getElementById("desc_art").innerHTML="";
																	document.getElementById("cant_art").value="";
																	//document.getElementById("codigo_art").focus()
																	
																	buscar_num_devolucion_vta();
																	mostrar_art_devolucion_tmp();
																	document.frm.vendedor.focus();
																}else{
																	//if(document.frm.remito.value.length > 0 && document.frm.remito.value != "0"){
																		divMensaje.innerHTML = "ERROR: la factura no pudo registrarse, verifique el Nº del Talonario"; //=  ajax2.responseText;
																	//}
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
				divMensaje.innerHTML="Formato de fecha incorrecto dd/mm/aaaa";
				document.frm.dia.focus()
			}
		}else{
			divMensaje.innerHTML="Debe seleccionar un vendedor";
			document.frm.vendedor.focus()
		}
	 }else{
		divMensaje.innerHTML="ERROR: Verifique de que exista un Talonario de Devolucion";
	 }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ REGULAR COMISIONES ------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------------------------------------------------------------//
function regular_comision(){
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var boton=document.getElementById("enviar");
 var txtdescuento = document.getElementById("descuento");
 var txtminimo = document.getElementById("minimo");
 
 if(document.frm.descuento.value != ""){
	divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
	txtdescuento.disabled=true; 
	txtminimo.disabled=true;  
	
	divMensaje.innerHTML="Actualizando......."; // mensajes en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
    url="regular_comision.php?";
	
	if(txtdescuento.value == 0){
		variables="descuento=cero&minimo=cero";
	}else{	
		variables="descuento="+txtdescuento.value+"&minimo="+txtminimo.value;;
	}
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				//txtfilas.value="";			// Borro el contenido del input
				boton.disabled=false; 		// Habilito campos y boton nuevamente
				txtdescuento.disabled=false; 
				txtminimo.disabled=false; 
				divMensaje.innerHTML=ajax.responseText; // imprime la salida
				document.frm.descuento.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
 }else{
	divMensaje.innerHTML="Debe ingresar el porcentaje de descuento en comisión";
	document.frm.descuento.focus() 
 }
}
function pasar_foco_reg1(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if(document.frm.descuento.value != ""){
			document.frm.minimo.focus();
		}
	}
}
function pasar_foco_reg2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if(document.frm.minimo.value != ""){
			regular_comision();
		}
	}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ COMISION VENDEDORES -----------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_vendedor_comision(){
	var contenedor=document.getElementById("vendedores"); 
	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_vendedor_comision.php";
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
function pasar_foco_comision_1(e){ //caja hora
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if(document.frm.vendedor.value != ""){
				
				var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
				var txtcodigo = document.getElementById("vendedor");
				//var categoria = document.frm.lista_cat.options[document.frm.lista_cat.selectedIndex].value;
				
				var ajax=nuevoAjax();										  // creo una instancia de ajax
				metodo="GET";												  // asigno las variables de proceso
				url="buscar_ultima_comision_vendedor.php?";
				variables="codigo="+txtcodigo.value;
				//alert(variables);
				ajax.open(metodo, url + variables, true); // envia los datos a la pagina php y esta la procesa
				ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
						divMensaje.innerHTML=" ";			
						var aux = ajax.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 

						// limpia todas las cajas y objetos
						document.getElementById("dia").value="";
						document.getElementById("mes").value="";
						document.getElementById("ano").value="";

						var error = aux.getElementsByTagName('error').item(0).firstChild.data;
						if (error  == 0){ //si encuentra el cliente buscado
							
							// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
							var dia = aux.getElementsByTagName('dia').item(0).firstChild.data; 
							var mes = aux.getElementsByTagName('mes').item(0).firstChild.data;
							var ano = aux.getElementsByTagName('ano').item(0).firstChild.data;
							
							// referenciamos los objetos del template y lo almacenamos en variables
							txt_dia=document.getElementById("dia");  // asigna los aobjetos a las variables
							txt_mes=document.getElementById("mes");  // asigna los aobjetos a las variables
							txt_ano=document.getElementById("ano");  // asigna los aobjetos a las variables
							
							// asignamos el valor de las variables del XML a los objetos
							txt_dia.value = dia;
							txt_mes.value = mes;
							txt_ano.value = ano;
							
							document.getElementById("dia_h").focus();
						}else{
							/*
							document.getElementById("desc_art").innerHTML="";
							document.getElementById("oculto_desc_art").value="";
							document.getElementById("cant_art").value="";
							document.getElementById("precio_art").value="";
							document.getElementById("bonif_art").value="";
							document.getElementById("importe_art").value="";
							*/
							divMensaje.innerHTML="ERROR: NO se han realizado ventas para este vendedor";						
							
						}
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
		ajax.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
		return;

				
				
				
				
				
				
				
				
				
				
				
				//document.frm.dia.focus()
		}
	}
}
function pasar_foco_comision_2(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.dia.value.length == 2  ) {
			document.frm.mes.focus();
			return 0;		 
	   }		
}
function pasar_foco_comision_3(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.mes.value.length == 2  ) {
			document.frm.ano.focus();
			return 0;		 
	   }		
}
function pasar_foco_comision_4(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==13 ){
			if( document.frm.ano.value.length == 4  ) {
				document.frm.dia_h.focus();
				return 0;		 
		   }		
		}
}
function pasar_foco_comision_5(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.dia_h.value.length == 2  ) {
			document.frm.mes_h.focus();
			return 0;		 
	   }		
}
function pasar_foco_comision_6(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.mes_h.value.length == 2  ) {
			document.frm.ano_h.focus();
			return 0;		 
	   }		
}
function pasar_foco_comision_7(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==13 ){
			if( document.frm.ano_h.value.length == 4  ) {
				document.frm.buscar.click();
				return 0;		 
		   }		
		}
}
//----------------------------------------------------------------------------------------------------//
function buscar_comision_vendedor(){
 var cant_objetos = document.frm.elements.length;
 
 var contenedor=document.getElementById("listado"); 
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var buscar=document.getElementById("buscar");
 var liquidar=document.getElementById("liquidar");
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
							for (i=5; i < cant_objetos; i++){		//Deshabilito el boton y los text
									document.frm.elements[i].disabled=true;
							}	
							divMensaje.innerHTML="Buscando......."; // mensajes en el div
							var ajax=nuevoAjax();					// creo una instancia de ajax
							metodo="POST";							// asigno las variables de proceso
							url="buscar_comision_vendedor.php?";
							variables="vendedor="+vendedor.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
							//alert(variables);
							ajax.open(metodo, url, true);
							ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							ajax.send(variables);
							ajax.onreadystatechange=function(){ 
									if (ajax.readyState==4){
										for (i=5; i < cant_objetos; i++){		//Deshabilito el boton y los text
												document.frm.elements[i].disabled=false;
										}	
										contenedor.innerHTML=ajax.responseText; // imprime la salida
										divMensaje.innerHTML=""; // mensajes en el div

										document.frm.vendedor.focus()
									} // fin de if (ajax.readyState==4)
							} // fin de funcion()
				 }else{
					divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
					document.frm.dia_h.focus() 
				 }
		 }else{
			divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
			document.frm.dia.focus() 
		 }
							
 }else{
	divMensaje.innerHTML="Debe registrar un vendedor";
	document.frm.descuento.focus() 
 }
}
//--------------------------------------------------------------------------------------------------//
function exportar_listado_comision(url_php){	
 var contenedor=document.getElementById("listado"); 
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables

 var vendedor = document.getElementById("vendedor");
 var nombre_vendedor = document.getElementById("nombre"); 
 
 var total_importe = document.getElementById("total_importe"); 
 var total_comision = document.getElementById("total_comision"); 
 var total_importe2 = document.getElementById("total_importe2"); 
 var total_comision2 = document.getElementById("total_comision2"); 
 
 var total_devolucion = document.getElementById("total_devolucion");
 
 var total_importe_fact = document.getElementById("total_importe_fact"); 
 var total_percibir = document.getElementById("total_percibir"); 

 var dia = document.getElementById("dia");
 var mes = document.getElementById("mes");
 var ano = document.getElementById("ano");
 var fecha_desde = ano.value+mes.value+dia.value;
 
 var dia_h = document.getElementById("dia_h");
 var mes_h = document.getElementById("mes_h");
 var ano_h = document.getElementById("ano_h");
 var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;


 //alert(url_php);
 if (document.getElementById("nombre_vendedor")){
		window.open(url_php+"?cod="+vendedor.value+"&nombre="+nombre_vendedor.value+"&desde="+fecha_desde+"&hasta="+fecha_hasta+"&fa="+total_importe_fact.value+"&per="+total_percibir.value+"&t_i="+total_importe.value+"&t_c="+total_comision.value +"&t_i2="+total_importe2.value+"&t_c2="+total_comision2.value+"&t_d="+total_devolucion.value, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
		if (confirm('¿Desea exportar el informe detallado?')){
				window.open("exportar_listado_comision_detalle.php?vendedor="+vendedor.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta,'_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
		}
 }
}

//--------------------------------------------------------------------------------------------------//
function imprimir_listado_comision(pag_exp){
 var contenedor=document.getElementById("listado"); 
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables

 var vendedor = document.getElementById("vendedor");
 var nombre_vendedor = document.getElementById("nombre"); 
 
 var total_importe = document.getElementById("total_importe"); 
 var total_comision = document.getElementById("total_comision"); 
 var total_importe2 = document.getElementById("total_importe2"); 
 var total_comision2 = document.getElementById("total_comision2"); 
 
 var total_devolucion = document.getElementById("total_devolucion");
 
 var total_importe_fact = document.getElementById("total_importe_fact"); 
 var total_percibir = document.getElementById("total_percibir"); 

 var dia = document.getElementById("dia");
 var mes = document.getElementById("mes");
 var ano = document.getElementById("ano");
 var fecha_desde = ano.value+mes.value+dia.value;
 
 var dia_h = document.getElementById("dia_h");
 var mes_h = document.getElementById("mes_h");
 var ano_h = document.getElementById("ano_h");
 var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;

 if (document.getElementById("nombre_vendedor")){
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="imprimir_listado.php";
		var variables ="cod="+vendedor.value+"&nombre="+nombre_vendedor.value+"&desde="+fecha_desde+"&hasta="+fecha_hasta+"&fa="+total_importe_fact.value+"&per="+total_percibir.value+"&t_i="+total_importe.value+"&t_c="+total_comision.value +"&t_i2="+total_importe2.value+"&t_c2="+total_comision2.value+"&pag_exp="+pag_exp+"&t_d="+total_devolucion.value;
		alert(variables);
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							if (confirm('Imprimiendo informe, ¿Desea imprimir el informe detallado?')){
										var ajax2=nuevoAjax();										  // creo una instancia de ajax
										metodo="POST";												  // asigno las variables de proceso
										url="imprimir_listado.php";
										pag_exp = "exportar_listado_comision_detalle.php";
										var variables ="vendedor="+vendedor.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&pag_exp="+pag_exp;
										//alert(sql+","+url);
										ajax2.open(metodo, url, true);
										ajax2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
										ajax2.send(variables);
										ajax2.onreadystatechange=function(){ 
												if (ajax2.readyState==4){
												}
										}
							}
							//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida

				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
 }
}
//----------------------------------------------------------------------------------------------------//
function liquidar_comision_vendedor(){
 var cant_objetos = document.frm.elements.length;
 
 var contenedor=document.getElementById("listado"); 
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var buscar=document.getElementById("buscar");
 var liquidar=document.getElementById("liquidar");
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
							for (i=5; i < cant_objetos; i++){		//Deshabilito el boton y los text
									document.frm.elements[i].disabled=true;
							}	
							divMensaje.innerHTML="Buscando......."; // mensajes en el div
							var ajax=nuevoAjax();					// creo una instancia de ajax
							metodo="POST";							// asigno las variables de proceso
							url="comision_vendedor.php?";
							variables="vendedor="+vendedor.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
							//alert(variables);
							ajax.open(metodo, url, true);
							ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							ajax.send(variables);
							ajax.onreadystatechange=function(){ 
									if (ajax.readyState==4){
										for (i=5; i < cant_objetos; i++){		//Deshabilito el boton y los text
												document.frm.elements[i].disabled=false;
										}	
										if(ajax.responseText == 'ok'){
											imprimir_listado_comision('exportar_listado_comision.php');  // envia a imprimir 

											dia.value = "";
											mes.value = "";
											ano.value = "";
											dia_h.value = "";
											mes_h.value = "";
											ano_h.value = "";
											contenedor.innerHTML=""; // imprime la salida
											divMensaje.innerHTML='Comision Liquidada'; // imprime la salida
										}else{
											divMensaje.innerHTML='ERROR: La Comision ya ha sido liquidada'; // imprime la salida
										}
										
										//divMensaje.innerHTML=""; // mensajes en el div

										document.frm.vendedor.focus()
									} // fin de if (ajax.readyState==4)
							} // fin de funcion()
				 }else{
					divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
					document.frm.dia_h.focus() 
				 }
		 }else{
			divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
			document.frm.dia.focus() 
		 }
							
 }else{
	divMensaje.innerHTML="Debe registrar un vendedor";
	document.frm.descuento.focus() 
 }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ INFORME VENTA DEL DIA ---------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function pasar_foco_informe_vta_dia_1(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if( document.frm.dia.value.length == 2  ) {
			document.frm.mes.focus();
			return 0;		 
	   }		
}
function pasar_foco_informe_vta_dia_2(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if( document.frm.mes.value.length == 2  ) {
			document.frm.ano.focus();
			return 0;		 
	   }		
}
function pasar_foco_informe_vta_dia_3(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
			if( document.frm.ano.value.length == 4  ) {
				document.frm.buscar.click();
				return 0;		 
		   }		
		}
}
//----------------------------------------------------------------------------------------------------//
function buscar_venta_dia(){
	var contenedor=document.getElementById("listado"); 
	var contenedor2=document.getElementById("listado_detalle_repartidor"); 
	var contenedor3=document.getElementById("listado_detalle_comprobante"); 

	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_ventas_del_dia.php";
	variables = "fecha_buscar="+fecha_buscar;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						contenedor2.innerHTML=""; 		// imprime la salida
						contenedor3.innerHTML=""; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function exportar_listado_venta_del_dia(url_php){	
	//alert(url_php);
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	window.open(url_php+"?fecha_buscar="+fecha_buscar, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

//--------------------------------------------------------------------------------------------------//
function imprimir_listado_venta_del_dia(pag_exp){
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="fecha_buscar="+fecha_buscar+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_venta_dia_detalle(repartidor){
	var contenedor=document.getElementById("listado_detalle_repartidor"); 
	var contenedor2=document.getElementById("listado_detalle_comprobante"); 

	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_ventas_del_dia_detalle.php";
	variables = "fecha_buscar="+fecha_buscar+"&repartidor="+repartidor;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						contenedor2.innerHTML=""; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function exportar_listado_venta_del_dia_detalle(url_php){	
	//alert(url_php);
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	var repartidor = document.getElementById("oculto_repartidor").value
	window.open(url_php+"?fecha_buscar="+fecha_buscar+"&repartidor="+repartidor, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

//--------------------------------------------------------------------------------------------------//
function imprimir_listado_venta_del_dia_detalle(pag_exp){
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	var repartidor = document.getElementById("oculto_repartidor").value
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="fecha_buscar="+fecha_buscar+"&repartidor="+repartidor+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}


//--------------------------------------------------------------------------------------------------//
function buscar_venta_dia_detalle_comprobante(cod_tal,num_tal,num_fac,desc_fac,suc){
	var contenedor=document.getElementById("listado_detalle_comprobante"); 

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_ventas_del_dia_detalle_comprobante.php";
	variables = "cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function exportar_listado_venta_del_dia_detalle_comprobante(url_php){	
	//alert(url_php);
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	
	var cod_tal = document.getElementById("oculto_cod_talonario").value
	var num_tal = document.getElementById("oculto_n_talonario").value
	var num_fac = document.getElementById("oculto_n_factura").value
	var desc_fac = document.getElementById("oculto_desc_fac").value
	var suc = document.getElementById("oculto_suc").value
	
	window.open(url_php+"?fecha_buscar="+fecha_buscar+"&cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

//--------------------------------------------------------------------------------------------------//
function imprimir_listado_venta_del_dia_detalle_comprobante(pag_exp){
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	
	var cod_tal = document.getElementById("oculto_cod_talonario").value
	var num_tal = document.getElementById("oculto_n_talonario").value
	var num_fac = document.getElementById("oculto_n_factura").value
	var desc_fac = document.getElementById("oculto_desc_fac").value
	var suc = document.getElementById("oculto_suc").value

	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="fecha_buscar="+fecha_buscar+"&cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------INFORME DETALLE COMPROBANTE ----------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function buscar_detalle_comprobante(){
	var contenedor=document.getElementById("listado"); 
	var contenedor2=document.getElementById("listado_detalle_repartidor"); 
	var contenedor3=document.getElementById("listado_detalle_comprobante"); 

	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_detalle_comprobante.php";
	variables = "fecha_buscar="+fecha_buscar;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						contenedor2.innerHTML=""; 		// imprime la salida
						contenedor3.innerHTML=""; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function exportar_informe_detalle_comprobante(url_php){	
	//alert(url_php);
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	window.open(url_php+"?fecha_buscar="+fecha_buscar, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

//--------------------------------------------------------------------------------------------------//
function imprimir_informe_detalle_comprobante(pag_exp){
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="fecha_buscar="+fecha_buscar+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_detalle_comprobante_detalle(cod_tal,num_tal,num_fac,desc_fac,suc){
	var contenedor=document.getElementById("listado_detalle_comprobante"); 

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_detalle_comprobante_detalle.php";
	variables = "cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function exportar_detalle_comprobante_detalle(url_php){	
	//alert(url_php);
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	
	var cod_tal = document.getElementById("oculto_cod_talonario").value
	var num_tal = document.getElementById("oculto_n_talonario").value
	var num_fac = document.getElementById("oculto_n_factura").value
	var desc_fac = document.getElementById("oculto_desc_fac").value
	var suc = document.getElementById("oculto_suc").value
	
	window.open(url_php+"?fecha_buscar="+fecha_buscar+"&cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

//--------------------------------------------------------------------------------------------------//
function imprimir_detalle_comprobante_detalle(pag_exp){
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	
	var cod_tal = document.getElementById("oculto_cod_talonario").value
	var num_tal = document.getElementById("oculto_n_talonario").value
	var num_fac = document.getElementById("oculto_n_factura").value
	var desc_fac = document.getElementById("oculto_desc_fac").value
	var suc = document.getElementById("oculto_suc").value

	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="fecha_buscar="+fecha_buscar+"&cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}



//----------------------------------------------------------------------------------------------------//
function buscar_cargas_dia(){
	var contenedor=document.getElementById("listado"); 
	var contenedor2=document.getElementById("listado_detalle_repartidor"); 
	var contenedor3=document.getElementById("listado_detalle_comprobante"); 

	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_cargas_finalizadas.php";
	variables = "fecha_buscar="+fecha_buscar;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						contenedor2.innerHTML=""; 		// imprime la salida
						contenedor3.innerHTML=""; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_carga_dia_detalle(repartidor){
	var contenedor=document.getElementById("listado_detalle_repartidor"); 
	var contenedor2=document.getElementById("listado_detalle_comprobante"); 

	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;

	contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_cargas_finalizadas_detalle.php";
	variables = "fecha_buscar="+fecha_buscar+"&repartidor="+repartidor;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						contenedor2.innerHTML=""; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function exportar_informe_cargas_finalizadas_detalle_bultos(url_php){	
	//alert(url_php);
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	var repartidor = document.getElementById("oculto_repartidor").value
	window.open(url_php+"?fecha_actual="+fecha_buscar+"&repartidor="+repartidor, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

//--------------------------------------------------------------------------------------------------//
function imprimir_informe_cargas_finalizadas_detalle_bultos(pag_exp){
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	var repartidor = document.getElementById("oculto_repartidor").value
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="fecha_actual="+fecha_buscar+"&repartidor="+repartidor+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------IVA VENTAS ---------------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_prov_iva_ventas(){
	var contenedor=document.getElementById("provincias"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_prov_iva_vtas.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.lista_prov.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
function listar_cond_iva_iva_ventas(){
	var contenedor=document.getElementById("cond_iva"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_cond_iva_iva_ventas.php";
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
function pasar_foco_iva_ventas_0(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
          document.frm.dia.focus()
          return 0;		  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_iva_ventas_1(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.dia.value.length == 2  ) {
			document.frm.mes.focus();
			return 0;		 
	   }		
}
function pasar_foco_iva_ventas_2(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.mes.value.length == 2  ) {
			document.frm.ano.focus();
			return 0;		 
	   }		
}
function pasar_foco_iva_ventas_3(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==13 ){
			if( document.frm.ano.value.length == 4  ) {
				document.frm.dia_h.focus();
				return 0;		 
		   }		
		}
}
function pasar_foco_iva_ventas_4(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.dia_h.value.length == 2  ) {
			document.frm.mes_h.focus();
			return 0;		 
	   }		
}
function pasar_foco_iva_ventas_5(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.mes_h.value.length == 2  ) {
			document.frm.ano_h.focus();
			return 0;		 
	   }		
}
function pasar_foco_iva_ventas_6(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==13 ){
			if( document.frm.ano_h.value.length == 4  ) {
				document.frm.buscar.click();
		   }		
		}
}
function pasar_foco_iva_ventas_7(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==13 ){
			if( document.frm.ano_h.value.length == 4  ) {
				document.frm.codigo_art.focus();
		   }		
		}
}
//----------------------------------------------------------------------------------------------------//
function buscar_iva_ventas(){
 var cant_objetos = document.frm.elements.length;
 
 var contenedor=document.getElementById("listado"); 
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var buscar=document.getElementById("buscar");
 var lista_prov_cod = document.getElementById("lista_prov").value;
 var lista_prov_nombre = document.frm.lista_prov.options[document.frm.lista_prov.selectedIndex].text
 
 var dia = document.getElementById("dia");
 var mes = document.getElementById("mes");
 var ano = document.getElementById("ano");
 var fecha_desde = ano.value+mes.value+dia.value;
 
 var dia_h = document.getElementById("dia_h");
 var mes_h = document.getElementById("mes_h");
 var ano_h = document.getElementById("ano_h");
 var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
 
		 if(fecha_desde.length == 8){
				if(fecha_hasta.length == 8){
							contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"

							divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
							for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
									document.frm.elements[i].disabled=true;
							}	
							divMensaje.innerHTML="Buscando......."; // mensajes en el div
							var ajax=nuevoAjax();					// creo una instancia de ajax
							metodo="POST";							// asigno las variables de proceso
							url="informe_iva_ventas.php?";
							variables="&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&cod_prov="+lista_prov_cod+"&nombre_prov="+lista_prov_nombre;
							//alert(variables);
							ajax.open(metodo, url, true);
							ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							ajax.send(variables);
							ajax.onreadystatechange=function(){ 
									if (ajax.readyState==4){
										for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
												document.frm.elements[i].disabled=false;
										}	
										contenedor.innerHTML=ajax.responseText; // imprime la salida
										divMensaje.innerHTML=""; // mensajes en el div

										document.frm.lista_prov.focus()
									} // fin de if (ajax.readyState==4)
							} // fin de funcion()
				 }else{
					divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
					document.frm.dia_h.focus() 
				 }
		 }else{
			divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
			document.frm.dia.focus() 
		 }
							
}
//--------------------------------------------------------------------------------------------------//
function exportar_informe_iva_ventas(url_php){	
 var lista_prov_cod = document.getElementById("lista_prov").value;
 var lista_prov_nombre = document.frm.lista_prov.options[document.frm.lista_prov.selectedIndex].text

 var dia = document.getElementById("dia");
 var mes = document.getElementById("mes");
 var ano = document.getElementById("ano");
 var fecha_desde = ano.value+mes.value+dia.value;
 
 var dia_h = document.getElementById("dia_h");
 var mes_h = document.getElementById("mes_h");
 var ano_h = document.getElementById("ano_h");
 var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;

 //alert(url_php);
 if (document.getElementById("listado").innerHTML != ""){
		//var numero = null;
		var numero = prompt("Escriba el Primer Número de Hoja","");
		if(numero == null || numero == ''){
			if(numero == ''){
				alert(numero+'ERROR: Debe escribir un Número');
				return 0;
			  }
			
		}else{
				window.open(url_php+"?fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&n="+numero+"&cod_prov="+lista_prov_cod+"&nombre_prov="+lista_prov_nombre, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
		}
 }
}

//--------------------------------------------------------------------------------------------------//
function imprimir_informe_iva_ventas(pag_exp){
 var lista_prov_cod = document.getElementById("lista_prov").value;
 var lista_prov_nombre = document.frm.lista_prov.options[document.frm.lista_prov.selectedIndex].text

 var dia = document.getElementById("dia");
 var mes = document.getElementById("mes");
 var ano = document.getElementById("ano");
 var fecha_desde = ano.value+mes.value+dia.value;
 
 var dia_h = document.getElementById("dia_h");
 var mes_h = document.getElementById("mes_h");
 var ano_h = document.getElementById("ano_h");
 var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;

 //alert(url_php);
 if (document.getElementById("listado").innerHTML != ""){
		var numero = prompt("Escriba el Primer Número de Hoja","");
		if(numero == null || numero == ''){
				if(numero == ''){
						alert(numero+'ERROR: Debe escribir un Número');
						return 0;
				}
								
		}else{
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="imprimir_listado.php";
			var variables ="fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&n="+numero+"&pag_exp="+pag_exp+"&cod_prov="+lista_prov_cod+"&nombre_prov="+lista_prov_nombre;
			//alert(sql+","+url);
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
							abrirVentanaFija('mensaje.php?msg=Imprimiendo Informe...', 400, 115, 'ventana', 'Atencion!!');
							//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
					} // fin de if (ajax.readyState==4)
			} // fin de funcion()
		}
 }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------FACTURA COMPRA----------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////

function listar_proveedores_fact_compra(){
	var contenedor=document.getElementById("proveedores"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_proveedores_fact_compra.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.lista_prov.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

/*
function buscar_remito_alta_factura_compra(e){
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
		//vaciar_tabla_fac_vta_tmp();
		//borrar_cajas_factura_vta();
		document.frm.lista_prov.focus();
		
	}
}
*/
//=================================================================================================//
function validar_factura_compra(){ //caja hora
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var txt_num_suc = document.getElementById("num_suc");
	var txt_num_fac = document.getElementById("num_fac");
	
	if(document.frm.num_suc.value.length == 4 && document.frm.num_fac.value.length == 8){
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
			url="validar_factura_compra.php?";
			
			variables="sucursal="+txt_num_suc.value+"&factura="+txt_num_fac.value;
			//alert(variables);
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
							if(ajax.responseText == 'no_existe'){		
									divMensaje.innerHTML=""; 
									document.frm_art.codigo_art.focus()
							}else{
									divMensaje.innerHTML="El número de Factura ya esta registrado" ; // imprime la salida
									document.frm.num_suc.focus()
							}
							return 0;
					} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
}




function pasar_foco_fac_compra_1(e){ //caja lugar
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if(document.frm.lista_prov.value != ""){	
			document.frm.dia.focus()
			return 0;
		}else{
			divMensaje.innerHTML="ERROR: Debe registar un proveedor";
		}
	}
}
function pasar_foco_fac_compra_2(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.dia.value.length == 2  ) {
			document.frm.mes.focus();
			return 0;		 
	   }		
}
function pasar_foco_fac_compra_3(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.mes.value.length == 2  ) {
			document.frm.ano.focus();
			return 0;		 
	   }		
}
function pasar_foco_fac_compra_4(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==13 ){
			if( document.frm.ano.value.length == 4  ) {
				document.frm.num_suc.focus();
				return 0;		 
		   }		
		}
}
function pasar_foco_fac_compra_5(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==13 ){
			if( document.frm.num_suc.value.length == 4  ) {
				document.frm.num_fac.focus();
				return 0;		 
		   }		
		}
}
function pasar_foco_fac_compra_6(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==13 ){
			if( document.frm.num_fac.value.length == 8  ) {
				validar_factura_compra();
				//document.frm_art.codigo_art.focus();
				//return 0;		 
		   }		
		}
}
function pasar_foco_fac_compra_7(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==13 ){
			if( document.frm_art.precio_art.value.length > 0  ) {
				document.frm_art.cant_art.focus();
				return 0;		 
		   }		
		}
}
function pasar_foco_fac_compra_8(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==13 ){
			if( document.frm_art.cant_art.value.length > 0  ) {
				document.frm_art.bonif_art.focus();
				return 0;		 
		   }		
		}
}

function pasar_foco_fac_compra_9(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==13 ){
				document.frm_art.importe_art.focus();
				return 0;		 
		   }		
}


function pasar_foco_fac_compra_10(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==107 ){ // teclas: 107= '+'         119= 'F8'
			if(document.frm_art.codigo_art.value > 0 && document.frm_art.precio_art.value > 0 &&  document.frm_art.cant_art.value >= 0 && document.frm_art.importe_art.value >= 0){
				agregar_articulo_fac_compra();
			}
		}
}

function pasar_foco_fac_compra_13(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
			if( document.getElementById("subtotal_imp").value.length > 0  ) {
				document.getElementById("imp_int_ali").focus();
				return 0;		 
		   }		
		}
}
function pasar_foco_fac_compra_14(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
				document.getElementById("imp_int_imp").focus();
				return 0;		 
		}
}
function pasar_foco_fac_compra_15(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
				document.getElementById("iva_ali").focus();
				return 0;		 
		}
}
function pasar_foco_fac_compra_16(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
			if( document.getElementById("iva_ali").value.length > 0  ) {
				document.getElementById("iva_imp").focus();
				return 0;		 
			}
		}
}
function pasar_foco_fac_compra_17(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
			if( document.getElementById("iva_imp").value.length > 0  ) {
				document.getElementById("perc_iva_ali").focus();
				return 0;		 
			}
		}
}
function pasar_foco_fac_compra_18(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
				document.getElementById("perc_iva_imp").focus();
				return 0;	
		}
}
function pasar_foco_fac_compra_19(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
				document.getElementById("pib_ali").focus();
				return 0;	
		}
}
function pasar_foco_fac_compra_20(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
				document.getElementById("pib_imp").focus();
				return 0;	
		}
}

function pasar_foco_fac_compra_21(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
				document.getElementById("otros_ali").focus();
				return 0;	
		}
}
function pasar_foco_fac_compra_22(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
				document.getElementById("otros_imp").focus();
				return 0;	
		}
}
function pasar_foco_fac_compra_23(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
				document.getElementById("total").focus();
				return 0;	
		}
}
function pasar_foco_fac_compra_24(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
			if( document.getElementById("total").value.length > 0  ) {
				document.getElementById("deposito").focus();
				return 0;	
			}
		}
}


//-------------------------------------------------------------------------------------------------------------//
function seleccionar_articulo_factura_compra(){		// abre el pop up para seleccionar en cliente
	var win = window.open("buscar_articulo_factura_compra.php", "win",  "toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=500,top=100,left=200");
	//win.focus()
}
function buscar_articulo_factura_compra(){			// realiza la busqueda con XML para traer los datos del cliente
			var divMensaje=document.getElementById("mensaje_art");  // asigna los aobjetos a las variables
			var txtcodigo = document.getElementById("codigo_art");
			//var categoria = document.frm.lista_cat.options[document.frm.lista_cat.selectedIndex].value;
			
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="GET";												  // asigno las variables de proceso
			url="buscar_articulo_factura_compra.php?";
			variables="codigo="+txtcodigo.value;
			//alert(variables);
			ajax.open(metodo, url + variables, true); // envia los datos a la pagina php y esta la procesa
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					divMensaje.innerHTML=" ";			
					var aux = ajax.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
					
					var error = aux.getElementsByTagName('error').item(0).firstChild.data;
					if (error  == 0){ //si encuentra el cliente buscado
						// limpia todas las cajas y objetos
						document.getElementById("desc_art").innerHTML="";
						document.getElementById("oculto_desc_art").value="";
						
						document.getElementById("cant_art").value="";
						document.getElementById("precio_art").value="";
						document.getElementById("bonif_art").value="";
						document.getElementById("importe_art").value="";
						
						// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
						var desc_art = aux.getElementsByTagName('desc_art').item(0).firstChild.data; 
						var precio_art = aux.getElementsByTagName('precio_art').item(0).firstChild.data;
						
						// referenciamos los objetos del template y lo almacenamos en variables
						desc=document.getElementById("desc_art");  // asigna los aobjetos a las variables
						oculto_desc=document.getElementById("oculto_desc_art");  // asigna los aobjetos a las variables
						precio=document.getElementById("precio_art");  // asigna los aobjetos a las variables
						
						// asignamos el valor de las variables del XML a los objetos
						desc.innerHTML = desc_art;
						oculto_desc.value = desc_art;
						precio.value = precio_art;
						document.getElementById("cant_art").value="";
						document.getElementById("precio_art").focus();
					}else{
						document.getElementById("desc_art").innerHTML="";
						document.getElementById("oculto_desc_art").value="";
						document.getElementById("cant_art").value="";
						document.getElementById("precio_art").value="";
						document.getElementById("bonif_art").value="";
						document.getElementById("importe_art").value="";
						divMensaje.innerHTML="ERROR: EL Artículo no existe, F2 para buscar o F8 para registrarlo";						
					}
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}
//--------------------------------------------------------------------------------------------------//
function buscar_articulo_alta_factura_compra(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var codigo=document.getElementById("codigo_art");
	if ( tecla==113 ){  //F2	buscar en pop up
		seleccionar_articulo_factura_compra();
	}
	if ( tecla==13 &&  codigo.value.length > 0 && codigo.value != "0" ){
		buscar_articulo_factura_compra(); // buscar en ajax y xml
	}
	
	if ( tecla ==13 &&  codigo.value.length == 0 ){
			document.getElementById("subtotal_imp").focus();
	}

	/*
		if ( tecla==118){  //abrir ventana de registrar articulo
			var win = window.open("alta_articulo.php", "win",  "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=500,top=100,left=200");
		}
		
	*/
}
//--------------------------------------------------------------------------------------------------//
function agregar_articulo_fac_compra(){
	var divMensaje = document.getElementById("mensaje_art");  // asigna los aobjetos a las variables
	var codigo_art = document.frm_art.codigo_art.value;
	var desc_art = document.frm_art.oculto_desc_art.value;
	var precio_art = document.frm_art.precio_art.value;
	var cant_art = document.frm_art.cant_art.value;
	var bonif_art = document.frm_art.bonif_art.value;
	var importe_art = document.frm_art.importe_art.value;
		
	if(document.frm_art.bonif_art.value.length == 0 ){
			var bonif_art = 0;
	}
	
	
	//divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
	url="alta_fac_compra_tmp.php?";
	variables="codigo_art="+codigo_art+"&desc_art="+desc_art+"&cant_art="+cant_art+"&precio_art="+precio_art+"&bonif_art="+bonif_art+"&importe_art="+importe_art;

	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
		if (ajax.readyState==4){
			document.getElementById("codigo_art").value="";				// Borro el contenido del input
			document.getElementById("desc_art").innerHTML="";
			document.getElementById("cant_art").value="";
			document.getElementById("precio_art").value="";										
			document.getElementById("bonif_art").value="";
			document.getElementById("importe_art").value="";
			divMensaje.innerHTML = ajax.responseText;
			mostrar_art_fac_compra_tmp();
			document.frm_art.codigo_art.focus();
			
		} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function mostrar_art_fac_compra_tmp(){
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="mostrar_art_fac_compra_tmp.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				//document.getElementById("codigo_art").focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function actualizar_precio_art_fact_compra(e,id_Text){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if(document.getElementById(id_Text).value != "0" && document.getElementById(id_Text).value.length > 0){ //&& document.getElementById(id_Text).value <= cant_max
					
					var precio=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_art_fact_compra="+id_Text+"&precio="+precio;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_fac_compra_tmp();
											document.frm_art.codigo_art.focus();

								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				mostrar_art_fac_compra_tmp();
			}
	}
}
function actualizar_precio_art_fact_compra_blur(id_Text){
			cant_max=document.getElementById(id_Text).name;
			if(document.getElementById(id_Text).value != "0" && document.getElementById(id_Text).value.length > 0){ //&& document.getElementById(id_Text).value <= cant_max
					var precio=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_art_fact_compra="+id_Text+"&precio="+precio;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_fac_compra_tmp();
											document.frm_art.codigo_art.focus();

								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				mostrar_art_fac_compra_tmp();
			}
}
//--------------------------------------------------------------------------------------------------//
function actualizar_cant_art_fact_compra(e,id_Text){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			//cant_max=document.getElementById(id_Text).name;
			if(document.getElementById(id_Text).value.length > 0 && document.getElementById(id_Text).value > 0){ //&& document.getElementById(id_Text).value <= cant_max
					
					var cant=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_cant_art_fact_compra="+id_Text+"&cant="+cant;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_fac_compra_tmp();
											document.frm_art.codigo_art.focus();
				
											
								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				mostrar_art_fac_compra_tmp();
			}
	}
}

function actualizar_cant_art_fact_compra_blur(id_Text){
			//cant_max=document.getElementById(id_Text).name;
			if(document.getElementById(id_Text).value.length > 0 && document.getElementById(id_Text).value > 0){ //&& document.getElementById(id_Text).value <= cant_max
					
					var cant=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_cant_art_fact_compra="+id_Text+"&cant="+cant;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_fac_compra_tmp();
											document.frm_art.codigo_art.focus();

								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				mostrar_art_fac_compra_tmp();
			}
}
//--------------------------------------------------------------------------------------------------//
function actualizar_bonif_art_fact_compra(e,id_Text){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			//cant_max=document.getElementById(id_Text).name;
			if(document.getElementById(id_Text).value.length > 0 && document.getElementById(id_Text).value > 0){ //&& document.getElementById(id_Text).value <= cant_max
					
					var bonif=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_bonif_art_fact_compra="+id_Text+"&bonif="+bonif;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_fac_compra_tmp();
											document.frm_art.codigo_art.focus();
				
											
								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				mostrar_art_fac_compra_tmp();
			}
	}
}

function actualizar_bonif_art_fact_compra_blur(id_Text){
			//cant_max=document.getElementById(id_Text).name;
			if(document.getElementById(id_Text).value.length > 0 && document.getElementById(id_Text).value > 0){ //&& document.getElementById(id_Text).value <= cant_max
					
					var bonif=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_bonif_art_fact_compra="+id_Text+"&bonif="+bonif;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_fac_compra_tmp();
											document.frm_art.codigo_art.focus();

								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				mostrar_art_fac_compra_tmp();
			}

}
//--------------------------------------------------------------------------------------------------//
function actualizar_importe_art_fact_compra(e,id_Text){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			//cant_max=document.getElementById(id_Text).name;
			if(document.getElementById(id_Text).value.length > 0 && document.getElementById(id_Text).value > 0){ //&& document.getElementById(id_Text).value <= cant_max
					
					var importe=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_importe_art_fact_compra="+id_Text+"&importe="+importe;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_fac_compra_tmp();
											document.frm_art.codigo_art.focus();
				
											
								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				mostrar_art_fac_compra_tmp();
			}
	}
}

function actualizar_importe_art_fact_compra_blur(id_Text){
			//cant_max=document.getElementById(id_Text).name;
			if(document.getElementById(id_Text).value.length > 0 && document.getElementById(id_Text).value > 0){ //&& document.getElementById(id_Text).value <= cant_max
					
					var importe=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="fila_importe_art_fact_compra="+id_Text+"&importe="+importe;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											mostrar_art_fac_compra_tmp();
											document.frm_art.codigo_art.focus();

								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				mostrar_art_fac_compra_tmp();
			}

}
//--------------------------------------------------------------------------------------------------//
function eliminar_art_fac_compra_tmp(fila){
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="eliminar.php?";
	variables="fila_fac_compra="+fila;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				mostrar_art_fac_compra_tmp()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}


//--------------------------------------------------------------------------------------------------//
function borrar_cajas_factura_compra(){		
	document.getElementById("mensaje").innerHTML=""; 
	
	document.getElementById("dia").value=""; // VUELVE A VACIO TODOS LOS CAMPOS DE LA CABEZERA
	document.getElementById("mes").value=""; 
	document.getElementById("ano").value="";
	document.getElementById("num_suc").value="";
	document.getElementById("num_fac").value="";
	
	document.getElementById("codigo_art").value="";
	document.getElementById("precio_art").value="";
	document.getElementById("cant_art").value="";
	document.getElementById("bonif_art").value="";
	document.getElementById("importe_art").value="";
	
	

}
//--------------------------------------------------------------------------------------------------//
//------------------------------------REGISTRAR FACTURA COMPRA -------------------------------------//
//--------------------------------------------------------------------------------------------------//
function actualizar_id_deposito(id){
	document.getElementById("id_deposito").value = id;
}

function registrar_factura_compra(){
	var divMensaje = document.getElementById("mensaje");  				// asigna los aobjetos a las variables
	
	var txthora = document.getElementById("hora_actual").innerHTML;  	// asigna los aobjetos a las variables
	var proveedor = document.getElementById("lista_prov").value;  		// asigna los aobjetos a las variables
	var dia = document.getElementById("dia");  							// asigna los aobjetos a las variables
	var mes = document.getElementById("mes");  							// asigna los aobjetos a las variables
	var ano = document.getElementById("ano");  							// asigna los aobjetos a las variables
	var fecha_factura = ano.value+mes.value+dia.value;
	var sucursal = document.getElementById("num_suc");  				// asigna los aobjetos a las variables
	var factura = document.getElementById("num_fac");  					// asigna los aobjetos a las variables

	//------------------------impuestos-----------------------//
	var subtotal = document.getElementById("subtotal_imp");  			// asigna los aobjetos a las variables
	var imp_int_ali = document.getElementById("imp_int_ali");    		// asigna los aobjetos a las variables
	var imp_int_imp = document.getElementById("imp_int_imp");  			// asigna los aobjetos a las variables
	var iva_ali = document.getElementById("iva_ali");  					// asigna los aobjetos a las variables
	var iva_imp = document.getElementById("iva_imp");  					// asigna los aobjetos a las variables
	var perc_iva_ali = document.getElementById("perc_iva_ali");  		// asigna los aobjetos a las variables
	var perc_iva_imp = document.getElementById("perc_iva_imp"); 		// asigna los aobjetos a las variables
	var pib_ali = document.getElementById("pib_ali");  					// asigna los aobjetos a las variables
	var pib_imp = document.getElementById("pib_imp");  					// asigna los aobjetos a las variables
	var otros_ali = document.getElementById("otros_ali");  				// asigna los aobjetos a las variables
	var otros_imp = document.getElementById("otros_imp");  				// asigna los aobjetos a las variables
	var total = document.getElementById("total");  						// asigna los aobjetos a las variables
	
	var deposito = document.getElementById("id_deposito")				// asigna los aobjetos a las variables
	
	if(proveedor.value != ""){
		if(fecha_factura.length == 8){
			if(document.frm.num_suc.value.length == 4){
				if(document.frm.num_fac.value.length == 8){
						var ajax=nuevoAjax();										// creo una instancia de ajax
						metodo="POST";												// asigno las variables de proceso
						url="consultar_art_fac_compra_tmp.php";						// consulto si existen articulos en la tabla temporal
						ajax.open(metodo, url, true);
						ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						ajax.send(null);
						ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == 'si'){									// si existen articulos sigo y guardo definitivamente
										if(subtotal.value != ""){
										  if(iva_ali.value != ""){
											if(iva_imp.value != ""){
												if(total.value != ""){
															var ajax2=nuevoAjax();										// creo una instancia de ajax
															metodo="POST";												// asigno las variables de proceso
															url="alta_factura_compra.php";
															variables="proveedor="+proveedor+"&fecha_factura="+fecha_factura+"&sucursal="+sucursal.value+"&factura="+factura.value+"&hora_actual="+txthora+"&subtotal="+subtotal.value+"&imp_int_ali="+imp_int_ali.value+"&imp_int_imp="+imp_int_imp.value+"&iva_ali="+iva_ali.value+"&iva_imp="+iva_imp.value+"&perc_iva_ali="+perc_iva_ali.value+"&perc_iva_imp="+perc_iva_imp.value+"&pib_ali="+pib_ali.value+"&pib_imp="+pib_imp.value+"&otros_ali="+otros_ali.value+"&otros_imp="+otros_imp.value+"&total="+total.value+"&deposito="+deposito.value;
															//alert(variables);
															
															ajax2.open(metodo, url, true);
															ajax2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
															ajax2.send(variables);
															ajax2.onreadystatechange=function(){ 
																if (ajax2.readyState==4){
																	//alert(ajax2.responseText);
																	if(ajax2.responseText == 'ok'){	
																		mostrar_art_fac_compra_tmp();
																		borrar_cajas_factura_compra();
																		document.frm.lista_prov.focus();
																		
																	}else{
																		//divMensaje.innerHTML = ajax2.responseText;
																		
																		if( ajax2.responseText == 'error_existe'){
																			divMensaje.innerHTML = "ERROR: la numeración de la factura ya fue registrada"; //=  ajax2.responseText;
																		}else{
																			divMensaje.innerHTML = "ERROR: la factura no pudo registrarse, verifique el Nº Comprobante"; //=  ajax2.responseText;
																		}
																		
																	}
																} // fin de if (ajax.readyState==4)
															} // fin de funcion()
															
													}else{
														divMensaje.innerHTML="Debe ingresar el Total";
														total.focus()
													}	
												}else{
													divMensaje.innerHTML="Debe ingresar importe de IVA";
													iva_imp.focus()
												}	
											}else{
													divMensaje.innerHTML="Debe ingresar la alicuota de IVA";
													iva_ali.focus()
											}
										 }else{
											 divMensaje.innerHTML="Debe ingresar el Subtotal";
											 subtotal.focus()
										 }
								
									}else{
												divMensaje.innerHTML="Debe agregar almenos un artículo";
												document.frm_art.codigo_art.focus()
									}
							} // fin de if (ajax.readyState==4)
						} // fin de funcion()
				}else{
					divMensaje.innerHTML="Debe ingresar el número de Factura";
					document.frm.num_fac.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar el número de Sucursal";
				document.frm.num_suc.focus()
			}
		}else{
			divMensaje.innerHTML="Formato de fecha Invalido dd/mm/aaaa";
			document.frm.dia.focus()
		}
	 }else{
		divMensaje.innerHTML="ERROR: Verifique de que existan Proveedores Registrados";
	 }

}

//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ STOCK INICIAL -----------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_articulos_stock_inicial(){
 	var divlistado=document.getElementById("listado"); 
	divlistado.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_articulos_stock_inicial.php?";
	//variables="nombre=TODOS";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function actualizar_cant_art_stock_inicial(e,id_Text){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if(document.getElementById(id_Text).value.length > 0 ){ //&& document.getElementById(id_Text).value <= cant_max
					var cantidad=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="cod_art_stock_inicial="+id_Text+"&cant_art_stock_inicial="+cantidad;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											document.getElementById(id_Text).focus();
								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}
	}
}

function actualizar_cant_art_stock_inicial_blur(id_Text){
			//cant_max=document.getElementById(id_Text).name;
			if(document.getElementById(id_Text).value.length > 0 ){ //&& document.getElementById(id_Text).value <= cant_max
					var cantidad=document.getElementById(id_Text).value;
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="modificar.php";
					variables="cod_art_stock_inicial="+id_Text+"&cant_art_stock_inicial="+cantidad;
					//alert(variables);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
								if(ajax.responseText == "ok"){			
											//document.getElementById(id_Text).focus();
								}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}

}
//--------------------------------------------------------------------------------------------//
function registar_stock_inicial(){
 	var divmensage=document.getElementById("mensage"); 
	divmensage.innerHTML= ''; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    variables="registrar=ok";
	url="ingreso_stock.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText == 'error_existe'){
					divmensage.innerHTML='ERROR: El Stock inicial ya se ha realizado, para modificar el stock debe registrar una factura de compra'; 		// imprime la salida
				}else{
					if(ajax.responseText == 'ok'){
							divmensage.innerHTML='Stock inicial realizado!!, para modificar el stock debe registrar una factura de compra'; 		// imprime la salida
							imprimir_listado('exportar_stock_inicial.php'); 
					}else{
						divmensage.innerHTML='ERROR: NO se ha podido registrar el Stock inicial'; 		// imprime la salida
					}
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ REINICIAR STOCK ---------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function reiniciar_stock(){
if (confirm('¿Está seguro de reiniciar el Stock?')){
	var divmensage=document.getElementById("mensage"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="reiniciar_stock.php?";
	variables="reiniciar=ok";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divmensage.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
 }
}


//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ RESUMEN DE ENVASES ------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------------------------------------------------------------------------//
function buscar_resumen_envases(){
	var contenedor=document.getElementById("listado"); 
	var contenedor2=document.getElementById("listado_detalle_repartidor"); 
	var contenedor3=document.getElementById("listado_detalle_comprobante"); 

	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;

	contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
	contenedor2.innerHTML=""; 		// imprime la salida
	contenedor3.innerHTML=""; 		// imprime la salida

	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_resumen_envases.php";
	variables = "fecha_buscar="+fecha_buscar;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						contenedor2.innerHTML=""; 		// imprime la salida
						contenedor3.innerHTML=""; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function exportar_listado_venta_del_dia(url_php){	
	//alert(url_php);
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	window.open(url_php+"?fecha_buscar="+fecha_buscar, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

//--------------------------------------------------------------------------------------------------//
function imprimir_listado_venta_del_dia(pag_exp){
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="fecha_buscar="+fecha_buscar+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ INFORME COMPRAS POR CLIENTE ---------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function informe_compras_cliente_1(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2

	if ( tecla==113 ){ 
		seleccionar_cliente_informe();
	}
	if ( tecla==13 ){
			if(document.frm.codigo.value == ""){
					document.frm.razon.focus()
			}else{
					document.frm.dia.focus()
			}
			return 0;
	}
}
function informe_compras_cliente_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if(document.frm.razon.value != ""){
					document.frm.dia.focus()
			}
			return 0;
	}
}
function informe_compras_cliente_3(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
			if (document.frm.dia.value.length == 0 && document.frm.mes.value.length == 0 && document.frm.ano.value.length == 0){
				document.frm.dia_h.focus();
			}
		}else{
			if( document.frm.dia.value.length == 2  ) {
				document.frm.mes.focus();
		    }
	   }
	   return 0;		 
}
function informe_compras_cliente_4(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
			if (document.frm.dia_h.value.length == 0 && document.frm.mes_h.value.length == 0 && document.frm.ano_h.value.length == 0){
				document.frm.buscar.click();
			}
		}else{
			if( document.frm.dia_h.value.length == 2  ) {
				document.frm.mes_h.focus();
		    }
	   }
	   return 0;		 
}

//----------------------------------------------------------------------------------------------------//
function buscar_compras_cliente(){
 	var divMensaje=document.getElementById("mensaje"); 

	var contenedor=document.getElementById("listado"); 
	var contenedor2=document.getElementById("listado_detalle"); 
	var contenedor3=document.getElementById("listado_detalle_comprobante"); 

	var codigo = document.getElementById("codigo");
 	var razon = document.getElementById("razon");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
	if(codigo.value != "" || razon.value != ""){
		//contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="informe_comprascliente_proceso.php";
		variables = "codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
		//alert(variables); 
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							contenedor.innerHTML=ajax.responseText; 		// imprime la salida
							contenedor2.innerHTML=""; 		// imprime la salida
							contenedor3.innerHTML=""; 		// imprime la salida
							document.frm.codigo.focus()
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
    }else{
		divMensaje.innerHTML="Debe ingresar el Codigo del cliente o la Razon Social";
		document.frm.codigo.focus();
	}
		
}
//--------------------------------------------------------------------------------------------------//
function exportar_informe_compras_por_cliente(url_php){	
	//alert(url_php);
	var codigo = document.getElementById("codigo");
 	var razon = document.getElementById("razon");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
	window.open(url_php+"?codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}



//--------------------------------------------------------------------------------------------------//
function imprimir_informe_compras_por_cliente(pag_exp){
	var codigo = document.getElementById("codigo");
 	var razon = document.getElementById("razon");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Informe...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ BACKUP BASE DE DATOS -------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function backupBD(){
	var boton=document.getElementById("enviar");
	var contenedor=document.getElementById("listado"); 
	contenedor.innerHTML= '<div align=\"center\"><img src="../imagenes/progress10.gif"></div>'; // width="30" height="30"
	boton.disabled=true;
	url="backup_dump_proceso.php";			
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						boton.disabled=false;
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}


//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ RESTAURAR BASE DE DATOS -------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function restaurar_base_datos(){
	var boton=document.getElementById("enviar");
	var arch=document.getElementById("archivo");

	nombre = document.frm_restaurar.archivo.value;
	// divido el nombre en un array separado por '\'
	nombre = nombre.split('\\');
  	//obtengo el ultimo elemento del array q es el nombre del archivo
	nombre = nombre[nombre.length-1];
	nombre = nombre.substr(10);
	//alert(nombre);
	if(nombre == "--backup_sistema_facturacion.sql.gz"){ //nombre == "--backup_sistema_facturacion.sql" ||
		if (nombre != ""){ 
			document.frm_restaurar.valido.value="ok";                    //asigno OK al campo oculto
			var contenedor=document.getElementById("listado2"); 
			contenedor.innerHTML= '<img src="../imagenes/progress10.gif">'; // width="30" height="30"
			boton.disabled=true;	
			document.frm_restaurar.submit();  							//el formulario se envia
		}
	}else{
		alert('ERROR: El archivo seleccionado NO corresponde');	 	
	}

}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ RESTAURAR BASE DE DATOS SERVIDOR ----------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_copias_seguridad_servidor(){
	var contenedor=document.getElementById("listado"); 
	contenedor.innerHTML= '<img src="../imagenes/progress10.gif">'; // width="30" height="30"
	url="backup_restaurar_servidor.php";			
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	variables="listar=1";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}

function restaurar_base_datos_servidor(archivo){
	var cant_objetos = document.frm_restaurar.elements.length;
	var contenedor=document.getElementById("listado2"); 

	for (i=0; i < cant_objetos; i++){						// Deshabilito los botones
		document.frm_restaurar.elements[i].disabled=true;
	}	

	contenedor.innerHTML= '<img src="../imagenes/progress10.gif">'; // width="30" height="30"
	url="backup_restaurar_proceso.php";			
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	variables="uploadfile="+archivo+"&generados=1";
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					for (i=0; i < cant_objetos; i++){						// Deshabilito los botones
						document.frm_restaurar.elements[i].disabled=false;
					}	

			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------EDICION IN SITU DE CAMPOS ------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function editar_in_situ(id_Div,id_Text){		  // Cantidades
	var id_Div = document.getElementById(id_Div); // paso el id a una variable para que se combierta en un objeto
	var id_Text = document.getElementById(id_Text);
	
	//alert(id_Div.id+'-'+id_Text.id);
	
	id_Div.style.display="none"; 
	id_Text.type="text";
	id_Text.focus();
}

function editar_in_situ2(id_Div,id_Text){		// 	Bonificaciones
	var id_Div = document.getElementById(id_Div); // paso el id a una variable para que se combierta en un objeto
	var id_Text = document.getElementById(id_Text);
	
	id_Div.style.display="none"; 
	id_Text.type="text";
	id_Text.focus();
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------CAPTURO LA TECLA PARA IMPRIMIR---------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function onTecla(e){
	var num = e?e.keyCode:event.keyCode;
	if ( num==120 ){ // F9
		imprimir(); 		// llama a la funcion para imprmir un informe
	}
	if ( num==27 ){ // ESC
		limpiar_cajas();  // llama a la funcion para limpiar todas las cajas
	}
	if ( num==112 ){ // F1  AYUDA
		
		var win = window.open('../ayuda/index.htm', "win",  "toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=700,height=500,top=100,left=200");
	}
}
document.onkeydown = onTecla;
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------OBTENGO EL NOMBRE DE LAS PAGINAS-------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function obtener_nombre_pagina(){  
	if (location.href.lastIndexOf('/') !=-1){ 			// verifica de que existe "/"
		primer_pos=location.href.lastIndexOf('/')+1;	// devuelve la posicion donde comiensa el nombre
		ultima_pos=location.href.length;				// devuelve la longitud de la URL
		nombre=location.href.substring(primer_pos,ultima_pos); // extrae el nombre de la pagina 
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------FUNCION IMPRIMIR-----------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function imprimir(){
	obtener_nombre_pagina(); 		// llama a la funcion para saber que pagina es para imprimir
	switch (nombre){ 				// pregunta por cada pagina para saber que imprimir
	   case "alta_remito_vta.php":
		  registrar_remito_vta();	// registro de remito venta
		  break;
	   case "alta_factura_vta.php":
		  registrar_factura_vta();	// registro de factura venta
		  break;
	   case "alta_cliente.php":
		  registrar_cliente();		// registro de CLIENTE
		  break;
	   case "devoluciones.php":		  
		  registrar_devolucion();
		  break;
		case "alta_factura_compra.php":  
		  registrar_factura_compra();
		  break;
		case "alta_nota_credito.php":
		  registrar_nota_credito();	// registro de factura venta
		  break;
		case "pago_cc_vta.php":
		  registrar_pago_cc_vta();	// registro de factura venta
		  break;
		case "imputacion_pago_cc_vta.php":
		  registrar_imputacion_pago_cc_vta();	// registro de factura venta
		  break;
	    case "alta_presupuesto_vta.php":
		  registrar_presupuesto_vta();	// registro de factura venta
		  break;
  
	  //document.write("pagina por defecto");
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------FUNCION LIMPIAR CAJAS -----------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function limpiar_cajas(){
	obtener_nombre_pagina(); 		// llama a la funcion para saber que pagina es para imprimir
	//alert(nombre);
	switch (nombre){ 				// pregunta por cada pagina para saber que imprimir
	   case "alta_remito_vta.php":
		  //alert(1234);
		  //registrar_remito_vta();	// registro de remito venta
		  break;
	   case "alta_factura_vta.php":
			//mostrar_art_fac_vta_tmp();
			//borrar_cajas_factura_vta();
			//document.frm.remito.value="";
			//document.frm.codigo.value="";
			//document.frm.codigo.focus();


		  break;
	   case "alta_cliente.php":
		  //alert(1234);
		  break;
	   case "devoluciones.php":		  
		  //alert(1234);
		  break;
	   default:	  
		  window.close(); // F9
	  //document.write("pagina por defecto"); 
	}
}

//--------------------------------------------------------------------------------------------------//
function exportar_listado(url_php){	
	//alert(url_php);
	if (document.getElementById("capa_impresion")){
			var consulta=document.getElementById("capa_impresion").innerHTML; 
			window.open(url_php+"?consulta="+consulta, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
	}
}

//--------------------------------------------------------------------------------------------------//
function imprimir_listado(pag_exp){
	if (document.getElementById("capa_impresion")){
		var consulta=document.getElementById("capa_impresion").innerHTML; 
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="imprimir_listado.php";
		var sql="consulta="+consulta+"&pag_exp="+pag_exp;
		//alert(sql+","+url);
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(sql);
	
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
							//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------FUNCION PARA CHECKBOX -----------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function todos(form){
    for (i = 0; i < form.casilla1.length; i++)
		form.casilla1[i].checked = true;
		form.desmarcatodos.checked = false;
		form.invierte.checked = false;
}
//--------------------------------------------------------------------------------------------------//
function ninguno(form){
    for (i = 0; i < form.casilla1.length; i++)
		form.casilla1[i].checked = false;
		form.marcatodos.checked = false;
		form.invierte.checked = false;
}
//--------------------------------------------------------------------------------------------------//
function invertir(form){
    for (i = 0; i < form.casilla1.length; i++)
		form.casilla1[i].checked = !form.casilla1[i].checked;
		form.marcatodos.checked = false;
		form.desmarcatodos.checked = false;
}
//====================================================================================================//
function todos_mod(form){
    for (i = 0; i < form.casilla1_mod.length; i++)
		form.casilla1_mod[i].checked = true;
		form.desmarcatodos.checked = false;
		form.invierte.checked = false;
}
//--------------------------------------------------------------------------------------------------//
function ninguno_mod(form){
    for (i = 0; i < form.casilla1_mod.length; i++)
		form.casilla1_mod[i].checked = false;
		form.marcatodos.checked = false;
		form.invierte.checked = false;
}
//--------------------------------------------------------------------------------------------------//
function invertir_mod(form){
    for (i = 0; i < form.casilla1_mod.length; i++)
		form.casilla1_mod[i].checked = !form.casilla1_mod[i].checked;
		form.marcatodos.checked = false;
		form.desmarcatodos.checked = false;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ ALTA DE USUARIOS ---------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function mostrar_clave_usuario(id_Text,id_Text2){		// 	Bonificaciones
	var id_Text = document.getElementById(id_Text);
	id_Text.type="text";

	var id_Text2 = document.getElementById(id_Text2);
	id_Text2.type="text";
}
function ocultar_clave_usuario(id_Text,id_Text2){		// 	Bonificaciones
	var id_Text = document.getElementById(id_Text);
	id_Text.type="password";
	
	var id_Text2 = document.getElementById(id_Text2);
	id_Text2.type="password";
}

//--------------------------------------------------------------------------------------------------//
function pasar_foco_alta_usuario_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.nombre.value.length > 0  ) {
                document.frm.usuario.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_alta_usuario_2(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.usuario.value.length > 0  ) {
                document.frm.clave.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_alta_usuario_3(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.clave.value.length > 0  ) {
                document.frm.clave2.focus()
                return 0;		
			}
	}
}

//-------------------------MODIFICAR--------------------------------------------------------------//
function pasar_foco_modificar_usuario_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm_mod.nombre_mod.value.length > 0  ) {
                document.frm_mod.usuario_mod.focus()
                return 0;		  
			}	  
	}
}
//------------------------------REGISTRAR USUARIO---------------------------------------------------//
//--------------------------------------------------------------------------------------------------//
function registrar_usuario(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var cant_objetos = document.frm.elements.length;
	var boton=document.getElementById("enviar");
	var txtnombre = document.getElementById("nombre");
	var txtusuario = document.getElementById("usuario");
	var txtclave = document.getElementById("clave");
	var txtclave2 = document.getElementById("clave2");


	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[0].checked == true){
		var abm_zonas_geo = 'S';
	}else{
		var abm_zonas_geo = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[1].checked == true){
		var abm_alicuotas = 'S';
	}else{
		var abm_alicuotas = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[2].checked == true){
		var abm_comprobante = 'S';
	}else{
		var abm_comprobante = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[3].checked == true){
		var abm_cond_iva = 'S';
	}else{
		var abm_cond_iva = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[4].checked == true){
		var abm_talonario = 'S';
	}else{
		var abm_talonario = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[5].checked == true){
		var abm_proveedor = 'S';
	}else{
		var abm_proveedor = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[6].checked == true){
		var abm_vehiculo = 'S';
	}else{
		var abm_vehiculo = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[7].checked == true){
		var abm_repartidor = 'S';
	}else{
		var abm_repartidor = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[8].checked == true){
		var abm_vendedor = 'S';
	}else{
		var abm_vendedor = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[9].checked == true){
		var abm_categoria = 'S';
	}else{
		var abm_categoria = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[10].checked == true){
		var abm_forma_pago = 'S';
	}else{
		var abm_forma_pago = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[11].checked == true){
		var abm_cliente = 'S';
	}else{
		var abm_cliente = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[12].checked == true){
		var abm_articulo = 'S';
	}else{
		var abm_articulo = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[13].checked == true){
		var datos_empresa = 'S';
	}else{
		var datos_empresa = 'N';
	}
	///////////////////////////////////////////////////////////
	if(document.frm.casilla1[14].checked == true){
		var conf_listados = 'S';
	}else{
		var conf_listados = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[15].checked == true){
		var abm_usuarios = 'S';
	}else{
		var abm_usuarios = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[16].checked == true){
		var stock = 'S';
	}else{
		var stock = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[17].checked == true){
		var factura_compra = 'S';
	}else{
		var factura_compra = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[18].checked == true){
		var remito_vta = 'S';
	}else{
		var remito_vta = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[19].checked == true){
		var factura_vta = 'S';
	}else{
		var factura_vta = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[20].checked == true){
		var nota_credito = 'S';
	}else{
		var nota_credito = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[21].checked == true){
		var cta_cte = 'S';
	}else{
		var cta_cte = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[22].checked == true){
		var comisiones = 'S';
	}else{
		var comisiones = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[23].checked == true){
		var devoluciones = 'S';
	}else{
		var devoluciones = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[24].checked == true){
		var finalizar_carga = 'S';
	}else{
		var finalizar_carga = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[25].checked == true){
		var informes = 'S';
	}else{
		var informes = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[26].checked == true){
		var estadisticas = 'S';
	}else{
		var estadisticas = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm.casilla1[27].checked == true){
		var utilidades = 'S';
	}else{
		var utilidades = 'N';
	}
	////////////////////////////////////////////////////////////
	var persmisos_marcados = 0;
	for (i = 0; i < document.frm.casilla1.length; i++){
		if(document.frm.casilla1[i].checked == true){
				persmisos_marcados = persmisos_marcados + 1;
		}
	}

	if(txtnombre.value != ""){
		if(txtusuario.value != ""){
			if(txtclave.value  != ""){
				if(txtclave2.value  != ""){	
					if(txtclave.value == txtclave2.value){		
						if(persmisos_marcados > 0){	
							
							divMensaje.innerHTML="";					// Limpio posibles mensajes que haya en el div
							for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
									document.frm.elements[i].disabled=true;
							}	
							divMensaje.innerHTML="Buscando......."; // mensajes en el div
							var ajax=nuevoAjax();					// creo una instancia de ajax
							metodo="POST";							// asigno las variables de proceso
							url="alta_usuarios.php?";
							clave = hex_md5(txtclave.value); /* envia la clave encriptada con MD5 */
							clave2 = hex_md5(txtclave2.value); /* envia la clave encriptada con MD5 */
							
							variables="nombre="+txtnombre.value+"&usuario="+txtusuario.value+"&clave="+clave+ 
										"&abm_zonas_geo="+abm_zonas_geo+"&abm_alicuotas="+abm_alicuotas+"&abm_comprobante="+abm_comprobante+"&abm_cond_iva="+abm_cond_iva+
										"&abm_talonario="+abm_talonario+"&abm_proveedor="+abm_proveedor+"&abm_vehiculo="+abm_vehiculo+"&abm_repartidor="+abm_repartidor+							
										"&abm_vendedor="+abm_vendedor+"&abm_categoria="+abm_categoria+"&abm_forma_pago="+abm_forma_pago+"&abm_cliente="+abm_cliente+							
										"&abm_articulo="+abm_articulo+"&datos_empresa="+datos_empresa+"&conf_listados="+conf_listados+"&abm_usuarios="+abm_usuarios+								
										"&stock="+stock+"&factura_compra="+factura_compra+"&remito_vta="+remito_vta+"&factura_vta="+factura_vta+							
										"&nota_credito="+nota_credito+"&cta_cte="+cta_cte+"&comisiones="+comisiones+"&devoluciones="+devoluciones+"&finalizar_carga="+finalizar_carga+								
										"&informes="+informes+"&estadisticas="+estadisticas+"&utilidades="+utilidades;
							
							//alert(variables);
							ajax.open(metodo, url, true);
							ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							ajax.send(variables);
							ajax.onreadystatechange=function(){ 
									if (ajax.readyState==4){
											if(ajax.responseText == 'ok'){	
												txtnombre.value="";				// Borro el contenido del input
												txtusuario.value="";				// Borro el contenido del input
												txtclave.value="";				// Borro el contenido del input
												txtclave2.value="";					// Borro el contenido del input
												for (i = 0; i < document.frm.casilla1.length; i++){
														document.frm.casilla1[i].checked = false;
														document.frm.marcatodos.checked = false;
														document.frm.desmarcatodos.checked = false;
														document.frm.invierte.checked = false;
												}
												divMensaje.innerHTML="Usuario Registrado!!"; // imprime la salida
											}else{
												if(ajax.responseText == 'error'){
													divMensaje.innerHTML="ERROR: NO se pudo registrar el usuario"; // imprime la salida
												}else{
													divMensaje.innerHTML=ajax.responseText; // imprime la salida
												}
											}
											
											for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
														document.frm.elements[i].disabled=false;
											}	
											document.frm.nombre.focus();
											buscar_usuarios();
											
										} // fin de if (ajax.readyState==4)
							} // fin de funcion()

						}else{
							divMensaje.innerHTML="Debe Marcar por lo menos un permiso";
							document.frm.casilla1[0].focus()
						}
					}else{
						divMensaje.innerHTML="La Clave y su confirmación deben ser iguales, Utilice la lupa del costado para verificarlas";
						document.frm.clave2.focus()
					}
				}else{
					divMensaje.innerHTML="Debe repetir la Clave";
					document.frm.clave2.focus()
				}
			}else{
				divMensaje.innerHTML="Debe ingresar la Clave";
				document.frm.clave.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar el Usuario";
			document.frm.usuario.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Nombre";
		document.frm.nombre.focus()
	}	
}

//--------------------------------------------------------------------------------------------------//
function buscar_usuarios(){
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_usuarios_proceso.php?";
	variables="nombre=TODOS";

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				//document.frm.codigo.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function modificar_usuario(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_usuario="+cod;  
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					document.frm_mod.nombre_mod.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function modificar_usuario_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var cant_objetos = document.frm_mod.elements.length;
	var divMensaje=document.getElementById("mensaje_mod");			// asigna los aobjetos a las variables
	var boton=document.getElementById("enviar_mod");
	var boton_cancel=document.getElementById("cancelar_mod");
	var txtcodigo = document.getElementById("oculto_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var txtusuario = document.getElementById("usuario_mod");

	/////////////////////PERMISOS///////////////////////////////
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[0].checked == true){
		var abm_zonas_geo = 'S';
	}else{
		var abm_zonas_geo = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[1].checked == true){
		var abm_alicuotas = 'S';
	}else{
		var abm_alicuotas = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[2].checked == true){
		var abm_comprobante = 'S';
	}else{
		var abm_comprobante = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[3].checked == true){
		var abm_cond_iva = 'S';
	}else{
		var abm_cond_iva = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[4].checked == true){
		var abm_talonario = 'S';
	}else{
		var abm_talonario = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[5].checked == true){
		var abm_proveedor = 'S';
	}else{
		var abm_proveedor = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[6].checked == true){
		var abm_vehiculo = 'S';
	}else{
		var abm_vehiculo = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[7].checked == true){
		var abm_repartidor = 'S';
	}else{
		var abm_repartidor = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[8].checked == true){
		var abm_vendedor = 'S';
	}else{
		var abm_vendedor = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[9].checked == true){
		var abm_categoria = 'S';
	}else{
		var abm_categoria = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[10].checked == true){
		var abm_forma_pago = 'S';
	}else{
		var abm_forma_pago = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[11].checked == true){
		var abm_cliente = 'S';
	}else{
		var abm_cliente = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[12].checked == true){
		var abm_articulo = 'S';
	}else{
		var abm_articulo = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[13].checked == true){
		var datos_empresa = 'S';
	}else{
		var datos_empresa = 'N';
	}
	///////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[14].checked == true){
		var conf_listados = 'S';
	}else{
		var conf_listados = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[15].checked == true){
		var abm_usuarios = 'S';
	}else{
		var abm_usuarios = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[16].checked == true){
		var stock = 'S';
	}else{
		var stock = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[17].checked == true){
		var factura_compra = 'S';
	}else{
		var factura_compra = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[18].checked == true){
		var remito_vta = 'S';
	}else{
		var remito_vta = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[19].checked == true){
		var factura_vta = 'S';
	}else{
		var factura_vta = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[20].checked == true){
		var nota_credito = 'S';
	}else{
		var nota_credito = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[21].checked == true){
		var cta_cte = 'S';
	}else{
		var cta_cte = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[22].checked == true){
		var comisiones = 'S';
	}else{
		var comisiones = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[23].checked == true){
		var devoluciones = 'S';
	}else{
		var devoluciones = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[24].checked == true){
		var finalizar_carga = 'S';
	}else{
		var finalizar_carga = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[25].checked == true){
		var informes = 'S';
	}else{
		var informes = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[26].checked == true){
		var estadisticas = 'S';
	}else{
		var estadisticas = 'N';
	}
	////////////////////////////////////////////////////////////
	if(document.frm_mod.casilla1_mod[27].checked == true){
		var utilidades = 'S';
	}else{
		var utilidades = 'N';
	}
	////////////////////////////////////////////////////////////
	var persmisos_marcados = 0;
	for (i = 0; i < document.frm_mod.casilla1_mod.length; i++){
		if(document.frm_mod.casilla1_mod[i].checked == true){
				persmisos_marcados = persmisos_marcados + 1;
		}
	}

	if(txtnombre.value != ""){
		if(txtusuario.value != ""){
			if(persmisos_marcados > 0){	
					divMensaje.innerHTML="";					// Limpio posibles mensajes que haya en el div
					for (i=0; i < cant_objetos; i++){			//Deshabilito el boton y los text
							document.frm_mod.elements[i].disabled=true;
					}	
					
					divMensaje.innerHTML="Modificando.......";					// mensajes en el div
					var ajax=nuevoAjax();										// creo una instancia de ajax
					metodo="POST";												// asigno las variables de proceso
					url="modificar.php?";
					variables="nombre="+txtnombre.value+"&usuario="+txtusuario.value+"&codigo_usuario_mod="+txtcodigo.value+
								"&abm_zonas_geo="+abm_zonas_geo+"&abm_alicuotas="+abm_alicuotas+"&abm_comprobante="+abm_comprobante+"&abm_cond_iva="+abm_cond_iva+
								"&abm_talonario="+abm_talonario+"&abm_proveedor="+abm_proveedor+"&abm_vehiculo="+abm_vehiculo+"&abm_repartidor="+abm_repartidor+							
								"&abm_vendedor="+abm_vendedor+"&abm_categoria="+abm_categoria+"&abm_forma_pago="+abm_forma_pago+"&abm_cliente="+abm_cliente+							
								"&abm_articulo="+abm_articulo+"&datos_empresa="+datos_empresa+"&conf_listados="+conf_listados+"&abm_usuarios="+abm_usuarios+								
								"&stock="+stock+"&factura_compra="+factura_compra+"&remito_vta="+remito_vta+"&factura_vta="+factura_vta+							
								"&nota_credito="+nota_credito+"&cta_cte="+cta_cte+"&comisiones="+comisiones+"&devoluciones="+devoluciones+"&finalizar_carga="+finalizar_carga+								
								"&informes="+informes+"&estadisticas="+estadisticas+"&utilidades="+utilidades;
					//alert(variables);		
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
									if (ajax.responseText == "ok"){
											buscar_usuarios();
											document.frm.nombre.focus();
									}else{
											divMensaje.innerHTML = ajax.responseText; //= "ERROR: El Usuario ya existe!!";
											txtnombre.value="";								// Borro el contenido del input
											txtusuario.value="";							// Borro el contenido del input
											for (i=0; i < cant_objetos; i++){					//Deshabilito el boton y los text
													document.frm_mod.elements[i].disabled=false;
											}	

											for (i = 0; i < document.frm_mod.casilla1_mod.length; i++){
													document.frm_mod.casilla1_mod[i].checked = false;
													document.frm_mod.marcatodos.checked = false;
													document.frm_mod.desmarcatodos.checked = false;
													document.frm_mod.invierte.checked = false;
											}
											document.frm_mod.nombre_mod.focus()
									}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}else{
				divMensaje.innerHTML="Debe Marcar por lo menos un permiso";
				document.frm_mod.casilla1_mod[0].focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar el Usuario";
			document.frm_mod.usuario_mod.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Nombre";
		document.frm_mod.nombre_mod.focus()
	}	
}


//--------------------------------------------------------------------------------------------------//
function eliminar_usuario(codigo){  
 if (confirm('¿Está seguro de eliminar este Usuario?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="eliminar.php?";
	variables="codigo_usuario="+codigo;
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					buscar_usuarios();
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}












//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ CUENTA CORRIENTE  ASIG. TALONARIO ---------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function buscar_cliente_cta_cte_asig_tal(){
 	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"

	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_cliente_cta_cte_asig_tal_proceso.php?";

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function asignar_tal_recibo_cliente(id_select,cod_zona,cod_localidad,cod_prov,cod_pais){
 	var divmsg=document.getElementById("msg"); 
	var n_talonario=document.getElementById(id_select).value;
	if(n_talonario != ''){
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="asignar_tal_recibo_cliente.php";
			variables="cod_cliente="+id_select+"&cod_zona="+cod_zona+"&cod_localidad="+cod_localidad+"&cod_prov="+cod_prov+"&cod_pais="+cod_pais+"&n_talonario="+n_talonario;
			//alert(variables);
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					if(ajax.responseText == "ok"){			
						divmsg.innerHTML="";
						buscar_cliente_cta_cte_asig_tal();			
					}else{
						divmsg.innerHTML="ERROR: No se ha podido asignar el talonario";
					}
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}else{
		divmsg.innerHTML="ERROR: No existen mas talonarios para asignar";
	}
}
//--------------------------------------------------------------------------------------------------//
/*
function modificar_tal_recibo_cliente(id_select,cod_zona,cod_localidad,cod_prov,cod_pais){
 	var divmsg=document.getElementById("msg"); 
	var n_talonario=document.getElementById(id_select).value;
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="modificar_tal_recibo_cliente.php";
	variables="cod_cliente="+id_select+"&cod_zona="+cod_zona+"&cod_localidad="+cod_localidad+"&cod_prov="+cod_prov+"&cod_pais="+cod_pais+"&n_talonario="+n_talonario;
	alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
		if (ajax.readyState==4){
			if(ajax.responseText == "ok"){			
				divmsg.innerHTML="";
				buscar_cliente_cta_cte_asig_tal();			
			}else{
				divmsg.innerHTML=ajax.responseText;
			}
		} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
*/


//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ ALTA CUENTA CORRIENTE ---------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_zona_cta_cte(){
	var contenedor=document.getElementById("zonas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_zona_cta_cte.php";
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
function listar_cond_iva_cta_cte(){
	var contenedor=document.getElementById("cond_iva"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_cond_iva_cta_cte.php";
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

function buscar_num_recibo(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var div_numero_tal = document.getElementById("numero_tal");
	var txt_numero_tal = document.getElementById("oculto_numero_tal");
	var txt_codigo_tal = document.getElementById("oculto_codigo_tal");
	var divnumero_rem = document.getElementById("numero_rem");
	var txt_numero_rem = document.getElementById("oculto_numero_rem");

	var ajax3=nuevoAjax();										  // creo una instancia de ajax
			metodo="GET";												  // asigno las variables de proceso
			url="buscar_num_recibo.php?";
			//variables="codigo="+txtcodigo.value;
			ajax3.open(metodo, url , true); // envia los datos a la pagina php y esta la procesa
			ajax3.onreadystatechange=function(){ 
				if (ajax3.readyState==4){
					divMensaje.innerHTML=" ";			
					var aux = ajax3.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
					
					var error = aux.getElementsByTagName('error').item(0).firstChild.data;
					if (error  == 0){ //si encuentra el cliente buscado
						
						// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
						var codigo_tal = aux.getElementsByTagName('codigo_tal').item(0).firstChild.data; 
						var numero_tal = aux.getElementsByTagName('numero_tal').item(0).firstChild.data;
						var numero_suc = aux.getElementsByTagName('numero_suc').item(0).firstChild.data;
						var numero_rem = aux.getElementsByTagName('numero_rem').item(0).firstChild.data;
						
						// asignamos el valor de las variables del XML a los objetos
						div_numero_tal.innerHTML = numero_tal;
						txt_numero_tal.value = numero_tal;
						txt_codigo_tal.value = codigo_tal;
						divnumero_rem.innerHTML = numero_suc+'-'+numero_rem;
						txt_numero_rem.value = numero_rem;
					}else{
						// asignamos el valor de las variables del XML a los objetos
						div_numero_tal.innerHTML = '0000';
						txt_numero_tal.value = 'ERROR';
						txt_codigo_tal.value = 'ERROR';
						divnumero_rem.innerHTML = '00000000';
						txt_numero_rem.value = 'ERROR';
						divMensaje.innerHTML="ERROR: Nº de Comprobante exedido, Debe registrar un nuevo Talonario";						
					}

				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax3.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}
//--------------------------------------------------------------------------------------------------//
function buscar_cliente_cta_cte_proceso(){			// realiza la busqueda con XML para traer los datos del cliente
			var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
			var txtcodigo = document.getElementById("codigo");
			var div_numero_tal = document.getElementById("numero_tal");
			var txt_numero_tal = document.getElementById("oculto_numero_tal");
			var txt_codigo_tal = document.getElementById("oculto_codigo_tal");
			var divnumero_rem = document.getElementById("numero_rem");
			var txt_numero_rem = document.getElementById("oculto_numero_rem");
			var div_saldo = document.getElementById("saldo");
			var txt_saldo = document.getElementById("oculto_saldo");
			var listado=document.getElementById("facturas");

			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="GET";												  // asigno las variables de proceso
			url="buscar_cliente_cta_cte_proceso.php?";
			variables="codigo="+txtcodigo.value;
			ajax.open(metodo, url + variables, true); // envia los datos a la pagina php y esta la procesa
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					divMensaje.innerHTML=" ";			
					var aux = ajax.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
					
					var error = aux.getElementsByTagName('error').item(0).firstChild.data;
					if (error  == 0){ //si encuentra el cliente buscado
						document.getElementById("razon").value=""; // VUELVE A VACIO TODOS LOS CAMPOS
						document.getElementById("dir").value="";
						document.getElementById("localidad").value="";
						document.getElementById("provincia").value="";
						document.getElementById("cuit1").value="";
						document.getElementById("cuit2").value="";
						document.getElementById("cuit3").value="";
						document.getElementById("vendedor").value="";
						document.getElementById("importe").value="";
						document.getElementById("total_imputar").innerHTML="0.00";
						document.getElementById("oculto_total_imputar").value="";
						document.getElementById("saldo_imputar").innerHTML="0.00";
						document.getElementById("oculto_saldo_imputar").value="";
						document.getElementById("composicion_saldo_detalle").innerHTML="";

						document.getElementById("razon").disabled= true; 
						document.getElementById("dir").disabled= true;
						document.getElementById("localidad").disabled= true;
						document.getElementById("provincia").disabled= true;
						document.getElementById("cuit1").disabled= true;
						document.getElementById("cuit2").disabled= true;
						document.getElementById("cuit3").disabled= true;
						
						// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
						var codigo_tal = aux.getElementsByTagName('codigo_tal').item(0).firstChild.data; // tipo de comprobante **
						var numero_tal = aux.getElementsByTagName('numero_tal').item(0).firstChild.data; 
						var num_sucursal = aux.getElementsByTagName('num_sucursal').item(0).firstChild.data; 
						var num_factura = aux.getElementsByTagName('num_factura').item(0).firstChild.data; 
						var saldo = aux.getElementsByTagName('saldo').item(0).firstChild.data; 

						var razon = aux.getElementsByTagName('razon').item(0).firstChild.data; 
						var dir = aux.getElementsByTagName('dir').item(0).firstChild.data;
						var localidad = aux.getElementsByTagName('localidad').item(0).firstChild.data;
						var provincia = aux.getElementsByTagName('provincia').item(0).firstChild.data;
						
						if(aux.getElementsByTagName('cuit').item(0).firstChild.data == "con"){
								var cuit1 = aux.getElementsByTagName('cuit1').item(0).firstChild.data;
								var cuit2 = aux.getElementsByTagName('cuit2').item(0).firstChild.data;
								var cuit3 = aux.getElementsByTagName('cuit3').item(0).firstChild.data;
						}
						var cond_iva = aux.getElementsByTagName('cond_iva').item(0).firstChild.data;
						var vendedor = aux.getElementsByTagName('vendedor').item(0).firstChild.data;
						//var repartidor = aux.getElementsByTagName('repartidor').item(0).firstChild.data;

						// referenciamos los objetos del template y lo almacenamos en variables
						div_numero_tal = document.getElementById("numero_tal");
						txt_numero_tal = document.getElementById("oculto_numero_tal");
						txt_codigo_tal = document.getElementById("oculto_codigo_tal");

						txtrazon=document.getElementById("razon"); 
						txtdir=document.getElementById("dir");
						txtlocalidad=document.getElementById("localidad");
						txtprovincia=document.getElementById("provincia");
						txtcuit1=document.getElementById("cuit1");
						txtcuit2=document.getElementById("cuit2");
						txtcuit3=document.getElementById("cuit3");
						txtvendedor=document.getElementById("vendedor");
						//txtrepartidor=document.getElementById("repartidor");
						
						// asignamos el valor de las variables del XML a los objetos
						div_numero_tal.innerHTML = numero_tal;
						txt_numero_tal.value = numero_tal;
						txt_codigo_tal.value = codigo_tal;
						divnumero_rem.innerHTML = num_sucursal+'-'+num_factura+'-'+codigo_tal; //descripcion_tt;
						txt_numero_rem.value = num_factura;
						div_saldo.innerHTML = saldo;
						txt_saldo.value = saldo;

						txtrazon.value = razon;
						txtdir.value = dir;
						txtlocalidad.value = localidad;
						txtprovincia.value = provincia;
						if(aux.getElementsByTagName('cuit').item(0).firstChild.data == "con"){
							txtcuit1.value = cuit1;
							txtcuit2.value = cuit2;
							txtcuit3.value = cuit3;
						}else{
							txtcuit1.value = "";
							txtcuit2.value = "";
							txtcuit3.value = "";
						}
						txtvendedor.value = vendedor;
						//txtrepartidor.value = repartidor;
						buscar_cond_iva_cliente_rem(cond_iva); 				//llama a la funcion para crear la lista de cond de iva
						//listar_cat_cliente_rem(txtcodigo.value);
						listar_zona_cliente_rem(txtcodigo.value);
						document.getElementById("vendedor").focus();
						listar_facturas_adeudadas_cte_cte();
					}else{
						borrar_cajas_cta_cte();
						div_numero_tal.innerHTML = '0000';
						txt_numero_tal.value = 'ERROR';
						txt_codigo_tal.value = 'ERROR';
						divnumero_rem.innerHTML = '000-00000000';
						txt_numero_rem.value = 'ERROR';
						
						if(error == 4){
								divMensaje.innerHTML="ERROR: EL Cliente no tiene un Talonario asignado";						
						}
						if(error == 3){
								divMensaje.innerHTML="ERROR: Nº de Comprobante exedido, Debe registrar un nuevo Talonario";						
						}
						if(error == 1){
								divMensaje.innerHTML="ERROR: EL Cliente no existe, F2 para buscar";	
						}
					}
					//document.getElementById("lugar").value=""; 
					//document.getElementById("hora").value="";
					document.getElementById("obs").value="";
					//document.getElementById("bonif").value="";
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}
//--------------------------------------------------------------------------------------------------//
function listar_facturas_adeudadas_cte_cte(){
	var contenedor=document.getElementById("facturas"); 
	var txtcodigo = document.getElementById("codigo");

	contenedor.innerHTML=' '; 	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_facturas_adeudadas_cte_cte.php";
	variables="codigo="+txtcodigo.value;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function calcular_importe_cta_cte(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	//var divMensaje = document.getElementById("mensaje_art");  // asigna los aobjetos a las variables
	var saldo_ant = document.getElementById("oculto_saldo");
	var importe = document.getElementById("importe");
	
	var div_total_imputar = document.getElementById("total_imputar");
	var oculto_total_imputar = document.getElementById("oculto_total_imputar");

	var div_saldo_imputar = document.getElementById("saldo_imputar");
	var oculto_saldo_imputar = document.getElementById("oculto_saldo_imputar");

	if ( tecla==13 ){
		if(parseFloat(importe.value) > 0){
				importe.value= decimal_precio(parseFloat(importe.value));
				var importe = parseFloat (saldo_ant.value) + parseFloat (importe.value);
				oculto_total_imputar.value= decimal_precio(importe);
				div_total_imputar.innerHTML= decimal_precio(importe);
						
				oculto_saldo_imputar.value= decimal_precio(importe);
				div_saldo_imputar.innerHTML= decimal_precio(importe);

				var cant_cajas = document.frm_art.elements.length - 1; // verifica si hay una lista de facturas adeudadas para darle el foco
				if(cant_cajas > -1){ 				
					document.frm_art.elements[0].focus();
					return 0;		 
				}
		}
	}
}
//--------------------------------------------------------------------------------------------------//
//------------------------------CUANDO SE HACE CLICK EN EL ICONO------------------------------------//
function imputar_pago_cta_cte(id_Text,saldo) {  
	var oculto_saldo_imputar = document.getElementById("oculto_saldo_imputar"); 	// del total del ingreso de la cobranza
	var div_saldo_imputar = document.getElementById("saldo_imputar");
	var div_total_imputado = document.getElementById("total_imputado");
	
	if(parseFloat(oculto_saldo_imputar.value) > 0){
		if(document.getElementById(id_Text).value.length == 0 ){
				if( parseFloat(saldo)  < parseFloat(oculto_saldo_imputar.value)){
					document.getElementById(id_Text).value = decimal_precio(parseFloat(saldo));
				}else{
						document.getElementById(id_Text).value = decimal_precio(parseFloat(oculto_saldo_imputar.value));
				}
				sumar_importe_imputado();
				
				// obtengo los parametros para enviarlos a la funcion
				var parametros = document.getElementById(id_Text).name +"&importe_imp="+document.getElementById(id_Text).value;
				// funcion de abm de importes
				abm_imputacion_tmp(parametros); 

		}
	}	
}
//--------------------------------------------------------------------------------------------------//
//------------------------------SUMA EL IMPORTE IMPUTADO-------------------------------------------//

function sumar_importe_imputado(){
	var oculto_total_imputar = document.getElementById("oculto_total_imputar"); 	// del total del ingreso de la cobranza
	var oculto_saldo_imputar = document.getElementById("oculto_saldo_imputar"); 	// del total del ingreso de la cobranza
	
	var div_saldo_imputar = document.getElementById("saldo_imputar");				// para mostrar el saldo q queda para imputar
	var div_total_imputado = document.getElementById("total_imputado");
	
	var cant_cajas = document.frm_art.elements.length - 1;
	var importe = 0;
				
	for (i=0; i < cant_cajas; i++){ 				// verifico que todas las categorias tengan un precio
		if(document.frm_art.elements[i].value != ''){
				importe = parseFloat(importe) + parseFloat(document.frm_art.elements[i].value);
		}
		
	}
		
	div_total_imputado.innerHTML = decimal_precio(parseFloat(importe));
	div_saldo_imputar.innerHTML = decimal_precio(parseFloat(decimal_precio(oculto_total_imputar.value))-parseFloat(decimal_precio(importe))); //div de arriba
	oculto_saldo_imputar.value  = decimal_precio(parseFloat(decimal_precio(oculto_total_imputar.value))-parseFloat(decimal_precio(importe))); //oculto de arriba
	
}
//--------------------------------------------------------------------------------------------------//
//------------------------------CUANDO SE INGRESA EL IMPORTE MANUALMENTE----------------------------//

function calcular_importe_a_imputar(e,id_Text,valor,saldo,i,fin) { 
	tecla = (document.all) ? e.keyCode : e.which; // 2	
	var oculto_saldo_imputar = document.getElementById("oculto_saldo_imputar"); 	// del total del ingreso de la cobranza
	var div_saldo_imputar = document.getElementById("saldo_imputar");
	var div_total_imputado = document.getElementById("total_imputado");
	
	if ( tecla==13 ){
			//alert(parseFloat(oculto_saldo_imputar.value));
			
			if(document.getElementById(id_Text).value.length != 0 && decimal_precio(parseFloat(oculto_saldo_imputar.value)) > decimal_precio(parseFloat(0)) ){
					if( parseFloat(valor)  <= parseFloat(oculto_saldo_imputar.value)){							// si el valor a ingresar es menor al saldo imputable
						if( parseFloat(valor)  <= parseFloat(saldo)){											// si el valor a ingresar es menor al saldo de la factura
									document.getElementById(id_Text).value = decimal_precio(parseFloat(valor));					
						}else{																					// si el valor a ingresar es mayor al saldo de la factura
									document.getElementById(id_Text).value = decimal_precio(parseFloat(saldo));					
						}
					}else{																						// si el valor a ingresar es mayor al saldo imputable
						if( parseFloat(valor)  <= parseFloat(saldo)){											// si el valor a ingresar es menor al saldo de la factura
									document.getElementById(id_Text).value = decimal_precio(parseFloat(oculto_saldo_imputar.value));					
						}else{																					// si el valor a ingresar es mayor al saldo de la factura
								if( parseFloat(saldo)  <= parseFloat(oculto_saldo_imputar.value)){	
									document.getElementById(id_Text).value = decimal_precio(parseFloat(saldo));					
								}else{
									document.getElementById(id_Text).value = decimal_precio(parseFloat(oculto_saldo_imputar.value));
								}
						}
					}
			}else{
				document.getElementById(id_Text).value = '';
			}
			
			// obtengo los parametros para enviarlos a la funcion
			var parametros = document.getElementById(id_Text).name +"&importe_imp="+document.getElementById(id_Text).value;
			// funcion de abm de importes
			abm_imputacion_tmp(parametros); 
			
			sumar_importe_imputado();
			// control para pasar el foco
			if(i < fin){													 
					document.frm_art.elements[i].focus()
			}else{
							 //document.frm_art.enviar.click();
			}
			return 0;	
			

	}
}

//--------------------------------------------------------------------------------------------------//
function abm_imputacion_tmp(variables){
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
	url="abm_imputacion_tmp.php?";
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
}
//--------------------------------------------------------------------------------------------------//
function borrar_cajas_cta_cte(){		
	document.getElementById("mensaje").innerHTML=""; 
	document.getElementById("codigo").value=""; 
	document.getElementById("razon").value=""; 
	document.getElementById("dir").value="";
	document.getElementById("localidad").value="";
	document.getElementById("provincia").value="";
	document.getElementById("cuit1").value="";
	document.getElementById("cuit2").value="";
	document.getElementById("cuit3").value="";
	document.getElementById("vendedor").value="";
	//document.getElementById("repartidor").value="";
	//document.getElementById("lugar").value="";
	//document.getElementById("hora").value="";
	document.getElementById("obs").value="";
	document.getElementById("importe").value="";
	
	document.getElementById("total_imputar").innerHTML="0.00"; 
	document.getElementById("oculto_total_imputar").value="";

	document.getElementById("saldo_imputar").innerHTML="0.00";
	document.getElementById("oculto_saldo_imputar").value="";
	document.getElementById("facturas").innerHTML="";
	document.getElementById("composicion_saldo_detalle").innerHTML="";

/*	
	var cant_objetos = document.frm.elements.length;
	for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
			document.frm.elements[i].disabled=false;
	}
	
	var cant_objetos = document.frm_art.elements.length;
	for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
			document.frm_art.elements[i].disabled=false;
	}
*/
	listar_zona_cta_cte();
	listar_cond_iva_cta_cte();

}

//--------------------------------------------------------------------------------------------------//
function buscar_cliente_cta_cte(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var codigo=document.getElementById("codigo");
	if ( tecla==113 ){ //F2
		seleccionar_cliente_remito_vta();
	}
	if ( tecla==13 &&  codigo.value.length > 0 && codigo.value != "0" ){
		buscar_cliente_cta_cte_proceso();
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_cta_cte_9(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		//if(document.frm.vendedor.value != ""){
				document.frm.obs.focus()
				return 0;
		//}
	}
}
//-----------------------------------//
function pasar_foco_cta_cte_10(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
				document.frm.importe.focus()
				return 0;
	}
}
//------------------------------------REGISTRAR PAGO CTA CTE-----------------------------------------//
function registrar_pago_cc_vta(){
	var divMensaje = document.getElementById("mensaje");  // asigna los aobjetos a las variables
	
	var cod_cliente = document.frm.codigo.value;
	var numero_recibo = document.frm.oculto_numero_rem.value;
	var fecha = document.frm.oculto_fecha.value;
	var vendedor = document.frm.vendedor.value;
	var obs = document.frm.obs.value;
	var importe = document.frm.importe.value;

	 if(numero_recibo != 'ERROR'){
		if(cod_cliente != ''){
			if(importe != 0){
					// busca si se hicieron imputaciones en la tabla temporal
					var ajax=nuevoAjax();										// creo una instancia de ajax
					metodo="POST";												// asigno las variables de proceso
					url="consultar_imput_cc_tmp.php";						// consulto si existen articulos en la tabla temporal
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(null);
					ajax.onreadystatechange=function(){ 
						if (ajax.readyState==4){
								if( ajax.responseText == 1){
										if (confirm('¿Desea imputar los comprobantes?')){
											variables="fecha_cobro="+fecha+"&vendedor="+vendedor+"&obs="+obs+"&importe="+importe+"&cod_cliente="+cod_cliente+'&imputar=si';
										}else{
											variables="fecha_cobro="+fecha+"&vendedor="+vendedor+"&obs="+obs+"&importe="+importe+"&cod_cliente="+cod_cliente+'&imputar=no';							
										}
								}else{
										variables="fecha_cobro="+fecha+"&vendedor="+vendedor+"&obs="+obs+"&importe="+importe+"&cod_cliente="+cod_cliente+'&imputar=no';							
								}
								//alert(variables);
								// guardo en la base de datos
								var ajax2=nuevoAjax();										// creo una instancia de ajax
							    metodo="POST";												// asigno las variables de proceso
					            url="pago_cc_vta.php";						
								ajax2.open(metodo, url, true);
								ajax2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
								ajax2.send(variables);
								ajax2.onreadystatechange=function(){ 
										if (ajax2.readyState==4){
												//alert(ajax2.responseText);
												if(ajax2.responseText == "ok"){			
															borrar_cajas_cta_cte();
															document.frm.codigo.focus();
															
															
															
															//alert('ok');
												}
										}
								}
						}
					}
			}else{
				divMensaje.innerHTML="Debe ingresar un Importe";
				document.frm.razon.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar un Codigo de Cliente";
			document.frm.razon.focus()
		}
	 }else{
		divMensaje.innerHTML="ERROR: Verifique de que exista un Talonario de Recibo";
	 }
}
//--------------------------------------------------------------------------------------------------//
function buscar_composicion_saldo_detalle(cod_tal,num_tal,num_fac,desc_fac,suc){
	var contenedor=document.getElementById("composicion_saldo_detalle"); 

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_composicion_saldo_detalle.php";
	variables = "cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}


//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------ IMPUTACION CUENTA CORRIENTE ---------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////

//--------------------------------------------------------------------------------------------------//
function select_recibos_imputacion_cta_cte(){
	var contenedor=document.getElementById("lista_recibos"); 

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_recibos_con_saldo.php";
	//variables = "codigo="+cliente;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()

}
//--------------------------------------------------------------------------------------------------//
function buscar_cliente_imputacion_cta_cte(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var codigo=document.getElementById("codigo");
	if ( tecla==113 ){ //F2
		seleccionar_cliente_remito_vta();
	}
	if ( tecla==13 &&  codigo.value.length > 0 && codigo.value != "0" ){
		buscar_cliente_imputacion_cta_cte_proceso();
	}
}
//--------------------------------------------------------------------------------------------------//
function buscar_cliente_imputacion_cta_cte_proceso(){			// realiza la busqueda con XML para traer los datos del cliente
			var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
			var txtcodigo = document.getElementById("codigo");
			//var div_numero_tal = document.getElementById("numero_tal");
			//var txt_numero_tal = document.getElementById("oculto_numero_tal");
			//var txt_codigo_tal = document.getElementById("oculto_codigo_tal");
			//var divnumero_rem = document.getElementById("numero_rem");
			//var txt_numero_rem = document.getElementById("oculto_numero_rem");
			//var div_saldo = document.getElementById("saldo");
			//var txt_saldo = document.getElementById("oculto_saldo");
			var listado=document.getElementById("facturas");

			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="GET";												  // asigno las variables de proceso
			url="buscar_cliente_imputacion_cta_cte_proceso.php?";
			variables="codigo="+txtcodigo.value;
			ajax.open(metodo, url + variables, true); // envia los datos a la pagina php y esta la procesa
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					divMensaje.innerHTML=" ";			
					var aux = ajax.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
					
					var error = aux.getElementsByTagName('error').item(0).firstChild.data;
					if (error  == 0){ //si encuentra el cliente buscado
						document.getElementById("razon").value=""; // VUELVE A VACIO TODOS LOS CAMPOS
						document.getElementById("dir").value="";
						document.getElementById("localidad").value="";
						document.getElementById("provincia").value="";
						document.getElementById("cuit1").value="";
						document.getElementById("cuit2").value="";
						document.getElementById("cuit3").value="";
						//document.getElementById("vendedor").value="";
						//document.getElementById("importe").value="";
						document.getElementById("total_imputar").innerHTML="0.00";
						document.getElementById("oculto_total_imputar").value="";
						document.getElementById("saldo_imputar").innerHTML="0.00";
						document.getElementById("oculto_saldo_imputar").value="";
						document.getElementById("composicion_saldo_detalle").innerHTML="";

						document.getElementById("razon").disabled= true; 
						document.getElementById("dir").disabled= true;
						document.getElementById("localidad").disabled= true;
						document.getElementById("provincia").disabled= true;
						document.getElementById("cuit1").disabled= true;
						document.getElementById("cuit2").disabled= true;
						document.getElementById("cuit3").disabled= true;
						
						// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
						//var codigo_tal = aux.getElementsByTagName('codigo_tal').item(0).firstChild.data; // tipo de comprobante **
						//var numero_tal = aux.getElementsByTagName('numero_tal').item(0).firstChild.data; 
						//var num_sucursal = aux.getElementsByTagName('num_sucursal').item(0).firstChild.data; 
						//var num_factura = aux.getElementsByTagName('num_factura').item(0).firstChild.data; 
						//var saldo = aux.getElementsByTagName('saldo').item(0).firstChild.data; 

						var razon = aux.getElementsByTagName('razon').item(0).firstChild.data; 
						var dir = aux.getElementsByTagName('dir').item(0).firstChild.data;
						var localidad = aux.getElementsByTagName('localidad').item(0).firstChild.data;
						var provincia = aux.getElementsByTagName('provincia').item(0).firstChild.data;
						
						if(aux.getElementsByTagName('cuit').item(0).firstChild.data == "con"){
								var cuit1 = aux.getElementsByTagName('cuit1').item(0).firstChild.data;
								var cuit2 = aux.getElementsByTagName('cuit2').item(0).firstChild.data;
								var cuit3 = aux.getElementsByTagName('cuit3').item(0).firstChild.data;
						}
						var cond_iva = aux.getElementsByTagName('cond_iva').item(0).firstChild.data;
						//var vendedor = aux.getElementsByTagName('vendedor').item(0).firstChild.data;
						//var repartidor = aux.getElementsByTagName('repartidor').item(0).firstChild.data;

						// referenciamos los objetos del template y lo almacenamos en variables
						//div_numero_tal = document.getElementById("numero_tal");
						//txt_numero_tal = document.getElementById("oculto_numero_tal");
						//txt_codigo_tal = document.getElementById("oculto_codigo_tal");

						txtrazon=document.getElementById("razon"); 
						txtdir=document.getElementById("dir");
						txtlocalidad=document.getElementById("localidad");
						txtprovincia=document.getElementById("provincia");
						txtcuit1=document.getElementById("cuit1");
						txtcuit2=document.getElementById("cuit2");
						txtcuit3=document.getElementById("cuit3");
						//txtvendedor=document.getElementById("vendedor");
						//txtrepartidor=document.getElementById("repartidor");
						
						// asignamos el valor de las variables del XML a los objetos
						//div_numero_tal.innerHTML = numero_tal;
						//txt_numero_tal.value = numero_tal;
						//txt_codigo_tal.value = codigo_tal;
						//divnumero_rem.innerHTML = num_sucursal+'-'+num_factura+'-'+codigo_tal; //descripcion_tt;
						//txt_numero_rem.value = num_factura;
						//div_saldo.innerHTML = saldo;
						//txt_saldo.value = saldo;

						txtrazon.value = razon;
						txtdir.value = dir;
						txtlocalidad.value = localidad;
						txtprovincia.value = provincia;
						if(aux.getElementsByTagName('cuit').item(0).firstChild.data == "con"){
							txtcuit1.value = cuit1;
							txtcuit2.value = cuit2;
							txtcuit3.value = cuit3;
						}else{
							txtcuit1.value = "";
							txtcuit2.value = "";
							txtcuit3.value = "";
						}
						//txtvendedor.value = vendedor;
						//txtrepartidor.value = repartidor;
						buscar_cond_iva_cliente_rem(cond_iva); 				//llama a la funcion para crear la lista de cond de iva
						//listar_cat_cliente_rem(txtcodigo.value);
						listar_zona_cliente_rem(txtcodigo.value);
						listar_recibos_con_saldo(txtcodigo.value);
						listar_facturas_adeudadas_cte_cte();
						
						document.getElementById("obs").focus();
					}else{
						borrar_cajas_imputacion_cta_cte();
						//div_numero_tal.innerHTML = '0000';
						//txt_numero_tal.value = 'ERROR';
						//txt_codigo_tal.value = 'ERROR';
						//divnumero_rem.innerHTML = '000-00000000';
						//txt_numero_rem.value = 'ERROR';
						
						if(error == 1){
								divMensaje.innerHTML="ERROR: EL Cliente no existe, F2 para buscar";	
						}
					}
					//document.getElementById("lugar").value=""; 
					//document.getElementById("hora").value="";
					document.getElementById("obs").value="";
					//document.getElementById("bonif").value="";
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}
//--------------------------------------------------------------------------------------------------//
function listar_recibos_con_saldo(cliente){
	var contenedor=document.getElementById("lista_recibos"); 

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_recibos_con_saldo.php";
	variables = "codigo="+cliente;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()

}
//--------------------------------------------------------------------------------------------------//
function borrar_cajas_imputacion_cta_cte(){		
	document.getElementById("mensaje").innerHTML=""; 
	document.getElementById("codigo").value=""; 
	document.getElementById("razon").value=""; 
	document.getElementById("dir").value="";
	document.getElementById("localidad").value="";
	document.getElementById("provincia").value="";
	document.getElementById("cuit1").value="";
	document.getElementById("cuit2").value="";
	document.getElementById("cuit3").value="";
	//document.getElementById("vendedor").value="";
	//document.getElementById("repartidor").value="";
	//document.getElementById("lugar").value="";
	//document.getElementById("hora").value="";
	document.getElementById("obs").value="";
	//document.getElementById("importe").value="";
	
	document.getElementById("total_imputar").innerHTML="0.00"; 
	document.getElementById("oculto_total_imputar").value="";

	document.getElementById("saldo_imputar").innerHTML="0.00";
	document.getElementById("oculto_saldo_imputar").value="";
	document.getElementById("facturas").innerHTML="";
	document.getElementById("composicion_saldo_detalle").innerHTML="";

/*	
	var cant_objetos = document.frm.elements.length;
	for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
			document.frm.elements[i].disabled=false;
	}
	
	var cant_objetos = document.frm_art.elements.length;
	for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
			document.frm_art.elements[i].disabled=false;
	}
*/

	select_recibos_imputacion_cta_cte();
	listar_zona_cta_cte();
	listar_cond_iva_cta_cte();

}

//--------------------------------------------------------------------------------------------------//
function pasar_foco_imputacion_cta_cte_1(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		//if(document.frm.vendedor.value != ""){
				document.frm.lista_recibo.focus()
				return 0;
		//}
	}
}
//--------------------------------------------------------------------------------------------------//
function calcular_importe_imputacion_cta_cte(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	
	var importe = document.getElementById("lista_recibo");
	var div_total_imputar = document.getElementById("total_imputar");
	var oculto_total_imputar = document.getElementById("oculto_total_imputar");

	var div_saldo_imputar = document.getElementById("saldo_imputar");
	var oculto_saldo_imputar = document.getElementById("oculto_saldo_imputar");

	if ( tecla==13 ){
		if(importe.value != 'seleccione_cliente' && importe.value != 'ningun_recibo'){
			
			if(parseFloat(importe.value) > 0){
					importe.value= decimal_precio(parseFloat(importe.value));
					oculto_total_imputar.value= decimal_precio(importe.value);
					div_total_imputar.innerHTML= decimal_precio(importe.value);
							
					oculto_saldo_imputar.value= decimal_precio(importe.value);
					div_saldo_imputar.innerHTML= decimal_precio(importe.value);
	
					var cant_cajas = document.frm_art.elements.length - 1; // verifica si hay una lista de facturas adeudadas para darle el foco
					if(cant_cajas > -1){ 				
						document.frm_art.elements[0].focus();
						return 0;		 
					}
			}
		}else{
			if(importe.value == 'seleccione_cliente'){
					divMensaje.innerHTML="ERROR: Seleccione el Cliente";	
			}
			if(importe.value == 'ningun_recibo'){
					divMensaje.innerHTML="ERROR: No existen recibos para este Cliente";	
			}

			document.frm.codigo.focus()
			return 0;

		}
	}
}
//--------------------------------------------------------------------------------------------------//
//-------------------------------REGISTRAR IMPUTACION PAGO CTA CTE----------------------------------//
function registrar_imputacion_pago_cc_vta(){
	var divMensaje = document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var cod_cliente = document.frm.codigo.value;
	var numero_recibo = document.frm.lista_recibo.options[document.frm.lista_recibo.selectedIndex].id;
	var fecha = document.frm.oculto_fecha.value;
	//var vendedor = document.frm.vendedor.value;
	var obs = document.frm.obs.value;
	var importe = document.getElementById("lista_recibo").value;
	//alert(numero_recibo); 
	 
	 if(numero_recibo != 'ERROR'){
		if(cod_cliente != ''){
			if(importe != 0){
					// busca si se hicieron imputaciones en la tabla temporal
					var ajax=nuevoAjax();										// creo una instancia de ajax
					metodo="POST";												// asigno las variables de proceso
					url="consultar_imput_cc_tmp.php";						// consulto si existen articulos en la tabla temporal
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(null);
					ajax.onreadystatechange=function(){ 
						if (ajax.readyState==4){
								if( ajax.responseText == 1){
											variables=numero_recibo+"&fecha_cobro="+fecha+"&obs="+obs+"&cod_cliente="+cod_cliente;
											//alert(variables);
											// guardo en la base de datos
											
											var ajax2=nuevoAjax();										// creo una instancia de ajax
											metodo="POST";												// asigno las variables de proceso
											url="imputacion_pago_cc_vta.php";						
											ajax2.open(metodo, url, true);
											ajax2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
											ajax2.send(variables);
											ajax2.onreadystatechange=function(){ 
													if (ajax2.readyState==4){
															//alert(ajax2.responseText);
															if(ajax2.responseText == "ok"){			
																		borrar_cajas_imputacion_cta_cte();
																		document.frm.codigo.focus();
																		
																		//alert('ok');
															}else{
																divMensaje.innerHTML = ajax2.responseText;
															}
													}
											}
											
								}else{
										alert('No se han realizado imputaciones, debe realizar al menos una');
								}
						}
					}
			}else{
				divMensaje.innerHTML="Debe ingresar un Importe";
				document.frm.razon.focus()
			}
		}else{
			divMensaje.innerHTML="Debe ingresar un Codigo de Cliente";
			document.frm.codigo.focus()
		}
	 }else{
		divMensaje.innerHTML="ERROR: Verifique de que exista un Talonario de Recibo";
		 document.frm.codigo.focus();
	 }
}
//--------------------------------------------------------------------------------------------------//
/*
//--------------------------------------------------------------------------------------------------//
function listar_facturas_adeudadas_cte_cte(){
	var contenedor=document.getElementById("facturas"); 
	var txtcodigo = document.getElementById("codigo");

	contenedor.innerHTML=' '; 	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_facturas_adeudadas_cte_cte.php";
	variables="codigo="+txtcodigo.value;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
*/
//--------------------------------------INFORME COMPOSICION DE SALDOS-------------------------------//
//--------------------------------------------------------------------------------------------------//
function informe_composocion_saldo_1(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.dia.focus()
			return 0;
	}
}

//--------------------------------------------------------------------------------------------------//
function buscar_composicion_saldo_cliente(){
 	var divMensaje=document.getElementById("mensaje"); 

	var contenedor=document.getElementById("listado"); 
	var contenedor2=document.getElementById("listado_detalle"); 
	var contenedor3=document.getElementById("listado_detalle_comprobante"); 

	var codigo = document.getElementById("codigo");
 	var razon = document.getElementById("razon");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
	//if(codigo.value != "" || razon.value != ""){
		//contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
		divMensaje.innerHTML= ' '; 
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="informe_composicion_saldo_cliente.php";
		variables = "codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
		//alert(variables); 
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							contenedor.innerHTML=ajax.responseText; 		// imprime la salida
							contenedor2.innerHTML=""; 		// imprime la salida
							contenedor3.innerHTML=""; 		// imprime la salida
							document.frm.codigo.focus()
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
    /*
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo del cliente o la Razon Social";
		document.frm.codigo.focus();
	}
	*/	
}
//--------------------------------------------------------------------------------------------------//
function exportar_composicion_saldo_cliente(url_php){	
	//alert(url_php);
	var codigo = document.getElementById("codigo");
 	var razon = document.getElementById("razon");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
	window.open(url_php+"?codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}
//--------------------------------------------------------------------------------------------------//
function imprimir_composicion_saldo_cliente(pag_exp){
	var codigo = document.getElementById("codigo");
 	var razon = document.getElementById("razon");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function buscar_composicion_saldo_cliente_detalle(cod_tal,num_tal,num_fac,desc_fac,suc){
	var contenedor=document.getElementById("listado_detalle"); 

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_composicion_saldo_cliente_detalle.php";
	variables = "cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function exportar_composicion_saldo_cliente_detalle(url_php){	
	
	var cod_tal = document.getElementById("oculto_cod_talonario").value
	var num_tal = document.getElementById("oculto_n_talonario").value
	var num_fac = document.getElementById("oculto_n_factura").value
	var desc_fac = document.getElementById("oculto_desc_fac").value
	var suc = document.getElementById("oculto_suc").value
	
	window.open(url_php+"?cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

//--------------------------------------------------------------------------------------------------//
function imprimir_composicion_saldo_cliente_detalle(pag_exp){
	
	var cod_tal = document.getElementById("oculto_cod_talonario").value
	var num_tal = document.getElementById("oculto_n_talonario").value
	var num_fac = document.getElementById("oculto_n_factura").value
	var desc_fac = document.getElementById("oculto_desc_fac").value
	var suc = document.getElementById("oculto_suc").value

	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}

//--------------------------------------INFORME ESTADO DE DEUDAS-------------------------------------//
//--------------------------------------------------------------------------------------------------//
function buscar_saldo_cliente(){
 	var divMensaje=document.getElementById("mensaje"); 

	var contenedor=document.getElementById("listado"); 
	var contenedor2=document.getElementById("listado_detalle"); 
	var contenedor3=document.getElementById("listado_detalle_comprobante"); 

	var codigo = document.getElementById("codigo");
 	var razon = document.getElementById("razon");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value; 
	
	//if(codigo.value != "" || razon.value != ""){
		//contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
		divMensaje.innerHTML= ' '; 
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="informe_saldo_cliente_proceso.php";
		variables = "codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
		//alert(variables); 
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							contenedor.innerHTML=ajax.responseText; 		// imprime la salida
							contenedor2.innerHTML=""; 		// imprime la salida
							contenedor3.innerHTML=""; 		// imprime la salida
							document.frm.codigo.focus()
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
    /*
	}else{
		divMensaje.innerHTML="Debe ingresar el Codigo del cliente o la Razon Social";
		document.frm.codigo.focus();
	}
		*/
}

//--------------------------------------------------------------------------------------------------//
function exportar_informe_saldo_cliente(url_php){	
	//alert(url_php);
	var codigo = document.getElementById("codigo");
 	var razon = document.getElementById("razon");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
	window.open(url_php+"?codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}
//--------------------------------------------------------------------------------------------------//
function imprimir_informe_saldo_cliente(pag_exp){
	var codigo = document.getElementById("codigo");
 	var razon = document.getElementById("razon");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Informe...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}


//--------------------------------------------------------------------------------------------------//
function buscar_imputacion_cobranza_cliente(cod_tal,num_tal,num_fac,desc_fac,suc){
	var contenedor=document.getElementById("listado_detalle"); 

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_imputacion_cobranza_cliente.php";
	variables = "cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function exportar_imputacion_cobranza_cliente(url_php){	
	
	var cod_tal = document.getElementById("oculto_cod_talonario").value
	var num_tal = document.getElementById("oculto_n_talonario").value
	var num_fac = document.getElementById("oculto_n_factura").value
	var desc_fac = document.getElementById("oculto_desc_fac").value
	var suc = document.getElementById("oculto_suc").value
	
	window.open(url_php+"?cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}
//--------------------------------------------------------------------------------------------------//
function imprimir_imputacion_cobranza_cliente(pag_exp){
	
	var cod_tal = document.getElementById("oculto_cod_talonario").value
	var num_tal = document.getElementById("oculto_n_talonario").value
	var num_fac = document.getElementById("oculto_n_factura").value
	var desc_fac = document.getElementById("oculto_desc_fac").value
	var suc = document.getElementById("oculto_suc").value

	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida 
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}


//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ INFORME RANKING ARTICULOS POR CLIENTE -----------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_grupo_informe_ranking_art(){
	var contenedor=document.getElementById("grupos"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
    url="listar_grupo_informe_ranking_art.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.nombre.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_marca_informe_ranking_art(){
	var contenedor=document.getElementById("marcas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
    url="listar_marca_informe_ranking_art.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.nombre.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//------------------------------------------------------------------------------------------------------//

function listar_variedad_informe_ranking_art(){
	var contenedor=document.getElementById("variedades"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
    url="listar_variedad_informe_ranking_art.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					//document.frm.nombre.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function informe_articulos_cliente_1(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if(document.frm.codigo.value == ""){
					document.frm.razon.focus()
			}else{
					document.frm.dia.focus()
			}
			return 0;
	}
	if ( tecla==113 ){ 
		seleccionar_cliente_informe();
	}

}
function informe_articulos_cliente_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.dia.focus()
			return 0;
	}
}

function informe_articulos_cliente_3(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
			if (document.frm.dia_h.value.length == 0 && document.frm.mes_h.value.length == 0 && document.frm.ano_h.value.length == 0){
				document.frm.codigo_art.focus();
			}
		}else{
			if( document.frm.dia_h.value.length == 2  ) {
				document.frm.mes_h.focus();
		    }
	   }
	   return 0;		 
}

function informe_articulos_cliente_4(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
			if (document.frm.codigo_art.value.length == 0 ){
				document.frm.lista_grupo.focus();
			}else{
				document.frm.buscar.click();
			}
		}
	   return 0;		 
}

function informe_articulos_cliente_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	    var txtgrupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].value
		var contenedor=document.getElementById("marcas"); 
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="listar_marca_informe_ranking_art.php?";
		variables="cod_grupo="+txtgrupo;
		//alert(variables);
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.lista_marca.focus()
						return 0;									
						//document.frm.nombre.focus();	
				} // fin de if (ajax.readyState==4)
		} // fin de funcion()		
     }
}

function informe_articulos_cliente_6(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
	     var cod_marca = document.frm.lista_marca.options[document.frm.lista_marca.selectedIndex].value
	     var cod_grupo = document.frm.lista_grupo.options[document.frm.lista_grupo.selectedIndex].value
		 var contenedor=document.getElementById("variedades"); 
		 var ajax=nuevoAjax();										  // creo una instancia de ajax
		 metodo="POST";												  // asigno las variables de proceso
		 url="listar_variedad_informe_ranking_art.php?";
		 variables="cod_grupo="+cod_grupo+"&cod_marca="+cod_marca;
		 //alert(variables);
		 ajax.open(metodo, url, true);
		 ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		 ajax.send(variables);
		 ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							contenedor.innerHTML=ajax.responseText; 		// imprime la salida 
							document.frm.lista_variedad.focus()
							return 0;									
							//document.frm.nombre.focus();	
					} // fin de if (ajax.readyState==4)
		} // fin de funcion()
     }
}
function informe_articulos_cliente_7(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
          document.frm.buscar.click()
     }
}

//----------------------------------------------------------------------------------------------------//
function buscar_informe_articulos_cliente(){
 	var divMensaje=document.getElementById("mensaje"); 

	var contenedor=document.getElementById("listado"); 
	var contenedor2=document.getElementById("listado_detalle"); 
	var contenedor3=document.getElementById("listado_detalle_comprobante"); 

	var codigo = document.getElementById("codigo");
 	var razon = document.getElementById("razon");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
	var cod_art = document.getElementById("codigo_art").value;	
	var cod_grupo = document.getElementById("lista_grupo").value;	
	var cod_marca = document.getElementById("lista_marca").value;	
	var cod_variedad = document.getElementById("lista_variedad").value;	
	
	
	contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="informe_articulos_cliente_proceso.php";

	variables = "codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&cod_art="+cod_art+"&cod_grupo="+cod_grupo+"&cod_marca="+cod_marca+"&cod_variedad="+cod_variedad; 
	
	//alert(variables); 
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
		if (ajax.readyState==4){
				contenedor.innerHTML=ajax.responseText; 		// imprime la salida
				contenedor2.innerHTML=""; 		// imprime la salida
				contenedor3.innerHTML=""; 		// imprime la salida
				document.frm.codigo.focus()
		} // fin de if (ajax.readyState==4)
	} // fin de funcion()

}

//--------------------------------------------------------------------------------------------------//
function exportar_informe_ranking_articulos_vendidos(url_php){ 	
	//alert(url_php);
	var codigo = document.getElementById("codigo"); 
 	var razon = document.getElementById("razon");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;

	var cod_art = document.getElementById("codigo_art").value;	
	var cod_grupo = document.getElementById("lista_grupo").value;	
	var cod_marca = document.getElementById("lista_marca").value;	
	var cod_variedad = document.getElementById("lista_variedad").value; 	

	window.open(url_php+"?codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&cod_art="+cod_art+"&cod_grupo="+cod_grupo+"&cod_marca="+cod_marca+"&cod_variedad="+cod_variedad, '_blank'); 
}

//--------------------------------------------------------------------------------------------------//
function imprimir_informe_ranking_art_vendidos(pag_exp){
	var codigo = document.getElementById("codigo"); 
 	var razon = document.getElementById("razon");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;

	var cod_art = document.getElementById("codigo_art").value;	
	var cod_grupo = document.getElementById("lista_grupo").value;	
	var cod_marca = document.getElementById("lista_marca").value;	
	var cod_variedad = document.getElementById("lista_variedad").value; 	
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&cod_art="+cod_art+"&cod_grupo="+cod_grupo+"&cod_marca="+cod_marca+"&cod_variedad="+cod_variedad+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}


//----------------------------------------------------------------------------------------------------//
function buscar_informe_articulos_bonificados(){
 	var divMensaje=document.getElementById("mensaje"); 

	var contenedor=document.getElementById("listado"); 
	var contenedor2=document.getElementById("listado_detalle"); 
	var contenedor3=document.getElementById("listado_detalle_comprobante"); 

	var codigo = document.getElementById("codigo");
 	var razon = document.getElementById("razon");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
	var cod_art = document.getElementById("codigo_art").value;	
	var cod_grupo = document.getElementById("lista_grupo").value;	
	var cod_marca = document.getElementById("lista_marca").value;	
	var cod_variedad = document.getElementById("lista_variedad").value;	
	
	
	contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="informe_articulos_bonificacion_proceso.php";

	variables = "codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&cod_art="+cod_art+"&cod_grupo="+cod_grupo+"&cod_marca="+cod_marca+"&cod_variedad="+cod_variedad; 
	
	//alert(variables); 
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
		if (ajax.readyState==4){
				contenedor.innerHTML=ajax.responseText; 		// imprime la salida
				contenedor2.innerHTML=""; 		// imprime la salida
				contenedor3.innerHTML=""; 		// imprime la salida
				document.frm.codigo.focus()
		} // fin de if (ajax.readyState==4)
	} // fin de funcion()

}

//--------------------------------------------------------------------------------------------------//
function exportar_informe_ranking_articulos_bonificados(url_php){ 	
	//alert(url_php);
	if(document.getElementById("filas") || document.getElementById("filas2") ){
		var codigo = document.getElementById("codigo"); 
		var razon = document.getElementById("razon");
		
		var dia = document.getElementById("dia");
		var mes = document.getElementById("mes");
		var ano = document.getElementById("ano");
		var fecha_desde = ano.value+mes.value+dia.value;
	
		var dia_h = document.getElementById("dia_h");
		var mes_h = document.getElementById("mes_h");
		var ano_h = document.getElementById("ano_h");
		var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
		var cod_art = document.getElementById("codigo_art").value;	
		var cod_grupo = document.getElementById("lista_grupo").value;	
		var cod_marca = document.getElementById("lista_marca").value;	
		var cod_variedad = document.getElementById("lista_variedad").value; 	
	
		window.open(url_php+"?codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&cod_art="+cod_art+"&cod_grupo="+cod_grupo+"&cod_marca="+cod_marca+"&cod_variedad="+cod_variedad, '_blank'); 
	}
}

//--------------------------------------------------------------------------------------------------//
function imprimir_informe_ranking_art_bonificados(pag_exp){
	if(document.getElementById("filas") || document.getElementById("filas2") ){
		var codigo = document.getElementById("codigo"); 
		var razon = document.getElementById("razon");
		
		var dia = document.getElementById("dia");
		var mes = document.getElementById("mes");
		var ano = document.getElementById("ano");
		var fecha_desde = ano.value+mes.value+dia.value;
	
		var dia_h = document.getElementById("dia_h");
		var mes_h = document.getElementById("mes_h");
		var ano_h = document.getElementById("ano_h");
		var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
		var cod_art = document.getElementById("codigo_art").value;	
		var cod_grupo = document.getElementById("lista_grupo").value;	
		var cod_marca = document.getElementById("lista_marca").value;	
		var cod_variedad = document.getElementById("lista_variedad").value; 	
		
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="imprimir_listado.php";
		var sql="codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&cod_art="+cod_art+"&cod_grupo="+cod_grupo+"&cod_marca="+cod_marca+"&cod_variedad="+cod_variedad+"&pag_exp="+pag_exp;
		//alert(sql+","+url);
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(sql);
		
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
							//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
				} // fin de if (ajax.readyState==4)
		} // fin de funcion()
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ INFORME RANKING ARTICULOS POR ZONA --------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_zona_informe_art_zona(){
	var contenedor=document.getElementById("zonas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_zona_informe_art_zona.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.lista_zona_bus.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//----------------------------------------------------------------------------------------------------//
function buscar_informe_articulos_zona(){
 	var divMensaje=document.getElementById("mensaje"); 

	var contenedor=document.getElementById("listado"); 
	var contenedor2=document.getElementById("listado_detalle"); 
	var contenedor3=document.getElementById("listado_detalle_comprobante"); 
	var codigo = document.getElementById("lista_zona_bus");
	
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
	var cod_art = document.getElementById("codigo_art").value;	
	var cod_grupo = document.getElementById("lista_grupo").value;	
	var cod_marca = document.getElementById("lista_marca").value;	
	var cod_variedad = document.getElementById("lista_variedad").value;	
	
	contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="informe_articulos_vendidos_zona.php";
	variables = "codigo="+codigo.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&cod_art="+cod_art+"&cod_grupo="+cod_grupo+"&cod_marca="+cod_marca+"&cod_variedad="+cod_variedad; 
	//alert(variables); 
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
		if (ajax.readyState==4){
				contenedor.innerHTML=ajax.responseText; 		// imprime la salida
				contenedor2.innerHTML=""; 		// imprime la salida
				contenedor3.innerHTML=""; 		// imprime la salida
				document.frm.lista_zona_bus.focus()
		} // fin de if (ajax.readyState==4)
	} // fin de funcion()

}
//--------------------------------------------------------------------------------------------------//
function exportar_informe_ranking_articulos_zona(url_php){ 	
	//alert(url_php);
		var codigo = document.getElementById("lista_zona_bus");
		
		var dia = document.getElementById("dia");
		var mes = document.getElementById("mes");
		var ano = document.getElementById("ano");
		var fecha_desde = ano.value+mes.value+dia.value;
	
		var dia_h = document.getElementById("dia_h");
		var mes_h = document.getElementById("mes_h");
		var ano_h = document.getElementById("ano_h");
		var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
		
		var cod_art = document.getElementById("codigo_art").value;	
		var cod_grupo = document.getElementById("lista_grupo").value;	
		var cod_marca = document.getElementById("lista_marca").value;	
		var cod_variedad = document.getElementById("lista_variedad").value;	
	
		window.open(url_php+"?codigo="+codigo.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&cod_art="+cod_art+"&cod_grupo="+cod_grupo+"&cod_marca="+cod_marca+"&cod_variedad="+cod_variedad, '_blank'); 
}

//--------------------------------------------------------------------------------------------------//
function imprimir_informe_ranking_art_zona(pag_exp){
		var codigo = document.getElementById("lista_zona_bus");
		
		var dia = document.getElementById("dia");
		var mes = document.getElementById("mes");
		var ano = document.getElementById("ano");
		var fecha_desde = ano.value+mes.value+dia.value;
	
		var dia_h = document.getElementById("dia_h");
		var mes_h = document.getElementById("mes_h");
		var ano_h = document.getElementById("ano_h");
		var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
		
		var cod_art = document.getElementById("codigo_art").value;	
		var cod_grupo = document.getElementById("lista_grupo").value;	
		var cod_marca = document.getElementById("lista_marca").value;	
		var cod_variedad = document.getElementById("lista_variedad").value;	
		
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="imprimir_listado.php";
		var sql="codigo="+codigo.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&cod_art="+cod_art+"&cod_grupo="+cod_grupo+"&cod_marca="+cod_marca+"&cod_variedad="+cod_variedad+"&pag_exp="+pag_exp;
		//alert(sql+","+url);
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(sql);
		
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
							//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
				} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}



//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ HOJA DE RUTA ------------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_zona_cliente_ruta(){
	var contenedor=document.getElementById("zonas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_zona_cliente_ruta.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.lista_zona_bus.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_cliente_zona(){
 	var divlistado=document.getElementById("listado"); 
	var boton=document.getElementById("enviar");
	var txtzona = document.frm.lista_zona_bus.value;

	//divlistado.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"

	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	document.frm.lista_zona_bus.disabled=true; 

	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_cliente_zona_hoja_ruta.php?";
	variables="zona="+txtzona;

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
			
				boton.disabled=false; 										// Deshabilito el boton y el input para evitar dobles ingresos
				document.frm.lista_zona_bus.disabled=false; 
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.lista_zona_bus.focus()
				//listar_zona_cliente_ruta();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function actualizar_orden_hoja_ruta(e,id_Text){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if(document.getElementById(id_Text).value.length > 0 && document.getElementById(id_Text).value != 0 ){ 
					var orden=document.getElementById(id_Text).value;
				 	var cod_zona = document.frm.lista_zona_bus.options[document.frm.lista_zona_bus.selectedIndex].value;

					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="verificar_orden.php";
					variables="cod_cliente="+id_Text+"&orden="+orden+"&cod_zona="+cod_zona;
					//alert(variables);
					
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
									if(ajax.responseText == "ok"){			
											//buscar_cliente_zona();
											//document.frm.lista_zona_bus.focus()
									}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}
	}
}

function actualizar_orden_hoja_ruta_blur(id_Text){
			//cant_max=document.getElementById(id_Text).name;
			if(document.getElementById(id_Text).value.length > 0 && document.getElementById(id_Text).value != 0 ){ 
					var orden=document.getElementById(id_Text).value;
				 	var cod_zona = document.frm.lista_zona_bus.options[document.frm.lista_zona_bus.selectedIndex].value;

					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="verificar_orden.php";
					variables="cod_cliente="+id_Text+"&orden="+orden+"&cod_zona="+cod_zona;
					//alert(variables);
					
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
									if(ajax.responseText == "ok"){			
											//buscar_cliente_zona();
											//document.frm.lista_zona_bus.focus()
									}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
			}
}
function actualizar_orden_hoja_ruta_max(id_Text){
					var orden=document.getElementById(id_Text).value;
				 	var cod_zona = document.frm.lista_zona_bus.options[document.frm.lista_zona_bus.selectedIndex].value;

					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="verificar_orden.php";
					variables="cod_cliente="+id_Text+"&orden="+orden+"&cod_zona="+cod_zona+"&max=1";
					//alert(variables);
					
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
									if(ajax.responseText != " "){			
											document.getElementById(id_Text).value = ajax.responseText;
											//buscar_cliente_zona();
											//document.frm.lista_zona_bus.focus()
									}
							} // fin de if (ajax.readyState==4)
					} // fin de funcion()
}
function ordenar_hoja_ruta(cod_zona){ 
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="ordenar_hoja_ruta.php";
		variables="cod_zona="+cod_zona;
		//alert(variables);
					
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				//alert (ajax.responseText);
				if(ajax.responseText == "ok"){	 		
						//alert(ajax.responseText);
						buscar_cliente_zona();
						//document.frm.lista_zona_bus.focus()
				}
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
} 
//--------------------------------------------------------------------------------------------------//
function exportar_listado_hoja_ruta(url_php){	
	//alert(url_php);
	if (document.getElementById("capa_impresion")){
			var zona = document.frm.lista_zona_bus.options[document.frm.lista_zona_bus.selectedIndex].value;
			var consulta=document.getElementById("capa_impresion").innerHTML; 
			window.open(url_php+"?consulta="+consulta+"&zona="+zona, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
	}
}

//--------------------------------------------------------------------------------------------------//
function imprimir_listado_hoja_ruta(pag_exp){
	if (document.getElementById("capa_impresion")){
		var zona = document.frm.lista_zona_bus.options[document.frm.lista_zona_bus.selectedIndex].value;
		var consulta=document.getElementById("capa_impresion").innerHTML; 

		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="imprimir_listado.php";
		var sql="consulta="+consulta+"&zona="+zona +"&pag_exp="+pag_exp;
		//alert(sql+","+url);
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(sql);
	
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
							abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
							//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ SISTEMA PREVENTA --------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
//-------------------------------------------------------------------------------------------------------------//
function mostrar_ocultar_div_desc(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	document.frm_art.caja_desc.value="";
	if ( tecla==13 ){
			document.frm_art.caja_desc.focus();
	}

}

function seleccionar_articulo_asoc_art(){		// abre el pop up para seleccionar en cliente
	var win = window.open("buscar_articulo_alta_remito.php", "win",  "toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=500,top=100,left=200");
	//win.focus()
}
function buscar_articulo_asoc_art(){			// realiza la busqueda con XML para traer los datos del cliente
			var divMensaje=document.getElementById("mensaje_art");  // asigna los aobjetos a las variables
			var txtcodigo = document.getElementById("codigo_art");
			//var categoria = document.frm.lista_cat.options[document.frm.lista_cat.selectedIndex].value;
			
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="GET";												  // asigno las variables de proceso
			url="buscar_articulo_alta_remito.php?";
			variables="codigo="+txtcodigo.value+"&categoria=1";
			//alert(variables);
			ajax.open(metodo, url + variables, true); // envia los datos a la pagina php y esta la procesa
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					divMensaje.innerHTML=" ";			
					var aux = ajax.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
					
					var error = aux.getElementsByTagName('error').item(0).firstChild.data;
					if (error  == 0){ //si encuentra el cliente buscado
						// limpia todas las cajas y objetos
						document.getElementById("desc_art").innerHTML="";
						
						// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
						var desc_art = aux.getElementsByTagName('desc_art').item(0).firstChild.data; 
						
						// referenciamos los objetos del template y lo almacenamos en variables
						desc=document.getElementById("desc_art");  // asigna los aobjetos a las variables
						oculto_desc_art=document.getElementById("oculto_desc_art");  // asigna los aobjetos a las variables
						
						// asignamos el valor de las variables del XML a los objetos
						desc.innerHTML = desc_art;
						oculto_desc_art.value=desc_art;
						document.getElementById("lista_casos").focus();
					}else{
						document.getElementById("codigo_art").value=""; // VUELVE A VACIO TODOS LOS CAMPOS
						document.getElementById("desc_art").innerHTML="";
						divMensaje.innerHTML="ERROR: EL Artículo no existe, F2 para buscar";						
					}
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}
//--------------------------------------------------------------------------------------------------//
function buscar_articulo_asoc_art_especial(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var codigo=document.getElementById("codigo_art");
	if ( tecla==113 ){  //F2	buscar en pop up
		seleccionar_articulo_asoc_art();
	}
	if ( tecla==13 &&  codigo.value.length > 0 && codigo.value != "0" ){
		buscar_articulo_asoc_art(); // buscar en ajax y xml
	}
	/*
		if ( tecla==118){  //abrir ventana de registrar articulo
			var win = window.open("alta_articulo.php", "win",  "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=500,top=100,left=200");
		}
		
	*/
}
//--------------------------------------------------------------------------------------------------//
function alta_art_especial(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	var divMensaje = document.getElementById('mensaje_art');

	if ( tecla==13 ){  
			alta_art_especial_btn();
	} // end if(tecla == 13)
} // end function
//-------------------------------------------------------------------------------------------------//
function alta_art_especial_btn(){
	var divMensaje = document.getElementById('mensaje_art');

	var codigo=document.getElementById("codigo_art").value;
	var tipo = document.frm_art.lista_casos.options[document.frm_art.lista_casos.selectedIndex].value;
	var valor=document.getElementById("caja_desc").value;

	if (codigo != ''){
		if( valor != ''){
			divMensaje.innerHTML="";									// Limpio posibles mensajes que haya en el div
			document.getElementById("codigo_art").disabled=true; 		// Deshabilito el boton y el input para evitar dobles ingresos
			document.frm_art.lista_casos.disabled=true; 
			document.getElementById("caja_desc").disabled=true; 

			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="POST";												  // asigno las variables de proceso
			url="asociar_art_especial.php";
			var sql="codigo="+codigo+"&tipo="+tipo +"&valor="+valor;
			//alert(sql);
			
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(sql);
					
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					if(ajax.responseText == 'OK'){
						divMensaje.innerHTML = 'Artículo especial Asociado!!';
						buscar_art_esp_asociado();				
					}else{
						divMensaje.innerHTML = 'ERROR: El Artículo ya existe';
					}
					document.getElementById("codigo_art").disabled=false; 	// Deshabilito el boton y el input para evitar dobles ingresos
					document.frm_art.lista_casos.disabled=false; 
					document.getElementById("caja_desc").disabled=false; 
					document.getElementById("codigo_art").value=''; 	// Deshabilito el boton y el input para evitar dobles ingresos
					document.getElementById("caja_desc").value=''; 
					document.getElementById("codigo_art").focus()
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
			
		}else{
			divMensaje.innerHTML="Debe ingresar el valor";
			document.getElementById("caja_desc").focus();
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el código del Artículo";
		document.getElementById("codigo_art").focus();
	}
}



//--------------------------------------------------------------------------------------------------//
function buscar_art_esp_asociado(){
 	var divlistado=document.getElementById("listado"); 

	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_art_esp_asociado.php?";
	variables="nombre=todos";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm_art.codigo_art.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function eliminar_art_asociado(codigo){
 if (confirm('¿Está seguro de eliminar este Artículo?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="eliminar.php?";
	variables="codigo_art_asociado="+codigo;
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "sin_permiso"){
					buscar_art_esp_asociado()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}















//--------------------------------------------------------------------------------------------------//
function generar_archivos_csv(tabla){
		var div=document.getElementById("div_"+tabla); 
		div.innerHTML= '<img src="../imagenes/cargando2.gif">'; // width="30" height="30"
		
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="generar_csv.php";
		var sql="tabla="+tabla;
		//alert(sql+","+url);
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(sql);
	
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
						div.innerHTML = ajax.responseText;
							
							//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
}
//****************************** GENERA TREEVIEW **************************************************************//

function actualizar_lista_pedidos(){
		var div=document.getElementById("tree1"); 
		div.innerHTML= '<img src="../imagenes/cargando2.gif">'; // width="30" height="30"
		
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="leer_arch_pedidos.php";
		var variables="actualizar=si";
		//alert(sql+","+url);
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
	
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
						//div.innerHTML = ajax.responseText;
						loadChild('tree1',0);
						//div.innerHTML = ajax.responseText;
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
}
//****************************** REGISTRAR URL SIST. PREVENTA *****************************************************//

function registrar_url_sis_preventa(){
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var boton=document.getElementById("enviar");
 var txtnombre = document.getElementById("nombre");
 if(document.frm.nombre.value != ""){
	divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
	txtnombre.disabled=true; 
	//divMensaje.innerHTML="Buscando......."; // mensajes en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
    url="acceder_sistema_preventa.php";
	variables="nombre=http://"+txtnombre.value;
	//alert(variables);
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				// error en BD
				if(ajax.responseText == 'no_db'){
					divMensaje.innerHTML="ERROR: La Dirección URL no se pudo registrar";				// Limpio posibles mensajes que haya en el div
					txtnombre.value="";																			// Borro el contenido del input
					boton.disabled=false; 																		// Habilito campos y boton nuevamente
					txtnombre.disabled=false; 
					document.frm.nombre.focus();
				}else{
					var var_url=ajax.responseText;
					window.location.href= var_url;							  // redirecciona a la url del sistema
				}
				
				//divMensaje.innerHTML=ajax.responseText; // imprime la salida
				//buscar_pais()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
	
 }else{
	divMensaje.innerHTML="Debe ingresar la dirección URL del Sistema de Preventa";
	document.frm.nombre.focus()
 }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ MODIFICAR DATOS DE USUARIO ----------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function validar_clave(){
		var clave = prompt("Escriba su Clave de Acceso","");
		if(clave != null && clave != ''){
				var ajax=nuevoAjax();									// creo una instancia de ajax
				metodo="POST";											// asigno las variables de proceso
				url="validar_clave.php?";
				clave = hex_md5(clave); /* envia la clave encriptada con MD5 */
				variables="clave_usuario="+clave;
				ajax.open(metodo, url, true);
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send(variables);
				ajax.onreadystatechange=function(){ 
						if (ajax.readyState==4){
							if (ajax.responseText == "OK"){
									document.frm.usuario.focus();
									
							}else{
									window.location.href="acceso_denegado.php";   // redireccion
							}
						} // fin de if (ajax.readyState==4)
				} // fin de funcion()
	}else{
		window.location.href="entrada.php";   // redireccion
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_modificar_datos_usuario_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.usuario.value.length > 0  ) {
                document.frm.clave.focus()
                return 0;		  
			}	  
	}
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_modificar_datos_usuario_2(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.clave.value.length > 0  ) {
					document.frm.clave2.focus();
			}else{
					document.frm.enviar.click();
			}
	}
} 
//--------------------------------------------------------------------------------------------------//
function pasar_foco_modificar_datos_usuario_3(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			if( document.frm.clave.value.length > 0 &&  document.frm.clave2.value.length > 0) {
					document.frm.enviar.click();
			}
	}
} 

//--------------------------------------------------------------------------------------------------//
function modificar_datos_usuario(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var cant_objetos = document.frm.elements.length;
	var boton=document.getElementById("enviar");
	var txtusuario = document.getElementById("usuario");
	var txtclave = document.getElementById("clave");
	var txtclave2 = document.getElementById("clave2");

	if(txtclave.value  != "" && txtclave2.value  != "" && txtclave.value != txtclave2.value){
		divMensaje.innerHTML="La Clave y su confirmación son distintas, Utilice la lupa para verificarlas";
		document.frm.clave2.focus()
    	return 0;
	}
	if(txtusuario.value != ""){
		divMensaje.innerHTML="";					// Limpio posibles mensajes que haya en el div
		for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
				document.frm.elements[i].disabled=true;
		}	
		divMensaje.innerHTML="Buscando......."; // mensajes en el div
		var ajax=nuevoAjax();					// creo una instancia de ajax
		metodo="POST";							// asigno las variables de proceso
		url="modificar_datos_usuario.php?";
		clave = hex_md5(txtclave.value); /* envia la clave encriptada con MD5 */
		variables="usuario_mod="+txtusuario.value+"&clave_mod="+clave;
		//alert(variables);
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					if(ajax.responseText == 'ok'){	
						window.opener.location.href="../php";   // redireccion
					}else{
						if(ajax.responseText == 'error'){
							divMensaje.innerHTML="ERROR: No se pudo modificar sus datos"; // imprime la salida
						}
						if(ajax.responseText == 'existe'){
							divMensaje.innerHTML="ERROR: El Usuario ya existe"; // imprime la salida
						}else{
							divMensaje.innerHTML = ajax.responseText;
						}

					}
					for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
						document.frm.elements[i].disabled=false;
					}	
					document.frm.usuario.focus();
			}
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Usuario";
		document.frm.usuario.focus()
	}
	
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ AUDITORIA ---------------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function mostrar_usuarios(){
	var contenedor=document.getElementById("usuarios"); 
	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_usuarios.php";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						document.frm.usuario.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function pasar_foco_auditoria_1(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
			if( document.frm.usuario.options[document.frm.usuario.selectedIndex].value != '') {
				document.frm.dia.focus();
				return 0;		 
		   }		
		}
}

function pasar_foco_auditoria_2(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.dia.value.length == 2  ) {
			document.frm.mes.focus();
					 
	   }else{
			if ( tecla==13 ){
		   		if( document.frm.dia.value.length == '' && document.frm.mes.value.length == '' && document.frm.ano.value.length == '' ) {
					document.frm.dia_h.focus();
				}
			}
	   }
	   return 0;
}
function pasar_foco_auditoria_3(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.mes.value.length == 2  ) {
			document.frm.ano.focus();
			return 0;		 
	   }		
}
function pasar_foco_auditoria_4(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==13 ){
			if( document.frm.ano.value.length == 4  ) {
				document.frm.dia_h.focus();
				return 0;		 
		   }		
		}
}

function pasar_foco_auditoria_5(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.dia_h.value.length == 2  ) {
			document.frm.mes_h.focus();
			return 0;		 
	   }else{
		   if ( tecla==13 ){
		   		if( document.frm.dia_h.value.length == '' && document.frm.mes_h.value.length == '' && document.frm.ano_h.value.length == '' ) {
					document.frm.buscar.click();
				}
			}
	   }
}
function pasar_foco_auditoria_6(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2

		if( document.frm.mes_h.value.length == 2  ) {
			document.frm.ano_h.focus();
			return 0;		 
	   }		
}
function pasar_foco_auditoria_7(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if ( tecla==13 ){
			if( document.frm.ano_h.value.length == 4  ) {
				document.frm.buscar.click();
				return 0;		 
		   }		
		}
}

//----------------------------------------------------------------------------------------------------//
function buscar_auditoria(){
 var cant_objetos = document.frm.elements.length;
 
 var contenedor=document.getElementById("listado"); 
 var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
 var buscar=document.getElementById("buscar");
 var usuario_audit = document.frm.usuario.options[document.frm.usuario.selectedIndex].text; 
 
 var dia = document.getElementById("dia");
 var mes = document.getElementById("mes");
 var ano = document.getElementById("ano");
 var fecha_desde = ano.value+mes.value+dia.value;
 
 var dia_h = document.getElementById("dia_h");
 var mes_h = document.getElementById("mes_h");
 var ano_h = document.getElementById("ano_h");
 var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
 
 if(usuario_audit != ""){
		 if(fecha_desde.length == 8 || fecha_desde.length == 0){
				if(fecha_hasta.length == 8 || fecha_hasta.length == 0){
							divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
							for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
									document.frm.elements[i].disabled=true;
							}	
							divMensaje.innerHTML="Buscando......."; // mensajes en el div
							contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"

							var ajax=nuevoAjax();					// creo una instancia de ajax
							metodo="POST";							// asigno las variables de proceso
							url="auditoria_proceso.php?";
							variables="usuario_audit="+usuario_audit+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
							//alert(variables);
							ajax.open(metodo, url, true);
							ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							ajax.send(variables);
							ajax.onreadystatechange=function(){ 
									if (ajax.readyState==4){
										for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
												document.frm.elements[i].disabled=false;
										}	
										contenedor.innerHTML=ajax.responseText; // imprime la salida
										divMensaje.innerHTML=""; // mensajes en el div
										document.frm.usuario.focus()
									} // fin de if (ajax.readyState==4)
							} // fin de funcion()
				 }else{
					divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
					document.frm.dia_h.focus() 
				 }
		 }else{
			divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
			document.frm.vendedor.focus() 
		 }
							
 }else{
	divMensaje.innerHTML="No hay usuarios registrados";
	document.frm.usuario.focus() 
 }
}
//window.titlebar = "asdsad";

/***************************************************************************************************************************/

//--------------------------------------------------------------------------------------------------//
function seleccionar_cliente_informe(){		// abre el pop up para seleccionar en cliente
	var win = window.open("buscar_cliente_alta_remito.php", "win",  "toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=500,top=100,left=200");
}
 
function buscar_cliente_informe(){			// realiza la busqueda con XML para traer los datos del cliente
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
								document.getElementById("listado").innerHTML=""; 
					}
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}


//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ GENERAR ARCHIVOS TXT CERVECERIA -----------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////

function generar_archivos_txt(tabla){
		var div=document.getElementById("div_"+tabla); 
		var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables

		var dia = document.getElementById("dia");
		var mes = document.getElementById("mes");
		var ano = document.getElementById("ano");
		var fecha_desde = ano.value+mes.value+dia.value;
		 
		var dia_h = document.getElementById("dia_h");
		var mes_h = document.getElementById("mes_h");
		var ano_h = document.getElementById("ano_h");
		var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;

		 if(fecha_desde.length == 8 ){
				if(fecha_hasta.length == 8 ){
					div.innerHTML= '<img src="../imagenes/cargando2.gif">'; // width="30" height="30"
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="generar_txt.php";
					var sql="tabla="+tabla+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
					//alert(sql+","+url);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(sql);
				
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
									div.innerHTML = ajax.responseText;
										
										//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
							} // fin de if (ajax.readyState==4)
						} // fin de funcion()
				 }else{
					divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
					document.frm.dia_h.focus() 
				 }
		 }else{
			divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
			document.frm.dia.focus() 
		 }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ GENERAR ARCHIVOS TXT SIAP -----------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////

function generar_archivos_txt_DGR(tabla){
		var div=document.getElementById("div_"+tabla); 
		var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables

		var dia = document.getElementById("dia");
		var mes = document.getElementById("mes");
		var ano = document.getElementById("ano");
		var fecha_desde = ano.value+mes.value+dia.value;
		 
		var dia_h = document.getElementById("dia_h");
		var mes_h = document.getElementById("mes_h");
		var ano_h = document.getElementById("ano_h");
		var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;

		 if(fecha_desde.length == 8 ){
				if(fecha_hasta.length == 8 ){
					div.innerHTML= '<img src="../imagenes/cargando2.gif">'; // width="30" height="30"
					var ajax=nuevoAjax();										  // creo una instancia de ajax
					metodo="POST";												  // asigno las variables de proceso
					url="generar_txt_siap.php";
					var sql="tabla="+tabla+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
					//alert(sql+","+url);
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(sql);
				
					ajax.onreadystatechange=function(){ 
							if (ajax.readyState==4){
									div.innerHTML = ajax.responseText;
										
										//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
							} // fin de if (ajax.readyState==4)
						} // fin de funcion()
				 }else{
					divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
					document.frm.dia_h.focus() 
				 }
		 }else{
			divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
			document.frm.dia.focus() 
		 }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ COPIAR DATOS DE CLIENTE -------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function copiar_datos(codigo,tabla){
    //var divMensaje=document.getElementById("usuario"); // asigna los aobjetos a las variables
	//divMensaje.innerHTML="";			// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();				// creo una instancia de ajax
	metodo="POST";						// asigno las variables de proceso
    url="copiar_datos.php?";
	variables="codigo="+codigo+"&tabla="+tabla;
	//alert(variables)
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				//alert(ajax.responseText); // imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//------------------------------------ MOSTRAR IMAGEN DE PORTAPAPELES -------------------------------------//
function mostrar_imagen_portapeles(tabla){
   	var contenedor=document.getElementById("imagen_pegar");
		//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	
		var ajax=nuevoAjax();				// creo una instancia de ajax
		metodo="POST";						// asigno las variables de proceso
		url="mostrar_imagen_portapeles.php?";
		variables="tabla="+tabla;
		//alert(variables)
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					contenedor.innerHTML = ajax.responseText; // imprime la salida
				} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//------------------------------------ PEGAR DATOS -----------------------------------------------------//




//--------------------------------------------------------------------------------------------------//
function listar_iva_cliente_pegar(codigo){
	var contenedor=document.getElementById("iva"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_iva_de_cliente_pegar.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_pais_cliente_pegar(codigo){
	var contenedor=document.getElementById("paises"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_pais_de_cliente_pegar.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_prov_cliente_pegar(codigo){
	var contenedor=document.getElementById("provincias"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_prov_de_cliente.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_loca_cliente_pegar(codigo){
	var contenedor=document.getElementById("localidades"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_loca_de_cliente.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_zona_cliente_pegar(codigo){
	var contenedor=document.getElementById("zonas"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_zona_de_cliente.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_cat_cliente_pegar(codigo){
	var contenedor=document.getElementById("categoria"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_cat_de_cliente_pegar.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_ven_cliente_pegar(codigo){
	var contenedor=document.getElementById("vendedores"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_ven_de_cliente_pegar.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_rep_cliente_pegar(codigo){
	var contenedor=document.getElementById("repartidores"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_rep_de_cliente_pegar.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_forma_pago_cliente_pegar(codigo){
	var contenedor=document.getElementById("forma_pago"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_forma_pago_de_cliente_pegar.php?";
	variables = "cod_cliente="+codigo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//

function pegar_datos(tabla){
			var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
			var txtcodigo = document.getElementById("codigo");
			var ajax=nuevoAjax();										  // creo una instancia de ajax
			metodo="GET";												  // asigno las variables de proceso
			url="pegar_datos.php?";
			variables="tabla="+tabla;
			ajax.open(metodo, url + variables, true); // envia los datos a la pagina php y esta la procesa
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					divMensaje.innerHTML=" ";			
					var aux = ajax.responseXML;		 //	responseXML : Datos devueltos por el servidor en forma de documento XML 
					
					var error = aux.getElementsByTagName('error').item(0).firstChild.data;
					if (error  == 0){ //si encuentra el cliente buscado VUELVE A VACIO TODOS LOS CAMPOS
										
								// referenciamos los campos del XML y lo almacenamos en variables con -- getElementsByTagName('nombre del Campo')
								var codigo = aux.getElementsByTagName('codigo').item(0).firstChild.data; 
								var razon = aux.getElementsByTagName('razon').item(0).firstChild.data; 
								if(aux.getElementsByTagName('cuit').item(0).firstChild.data == "con"){
										var cuit1 = aux.getElementsByTagName('cuit1').item(0).firstChild.data;
										var cuit2 = aux.getElementsByTagName('cuit2').item(0).firstChild.data;
										var cuit3 = aux.getElementsByTagName('cuit3').item(0).firstChild.data;
								}else{
										var cuit1 = "";
										var cuit2 = "";
										var cuit3 = "";
								}
								var dir = aux.getElementsByTagName('dir').item(0).firstChild.data; 
								if(aux.getElementsByTagName('tel').item(0).firstChild.data != "no"){
										var tel = aux.getElementsByTagName('tel').item(0).firstChild.data; 
								}else{
									var tel = "";
								}
								if(aux.getElementsByTagName('fax').item(0).firstChild.data != "no"){
										var fax = aux.getElementsByTagName('fax').item(0).firstChild.data; 
								}else{
									var fax = "";
								}
								if(aux.getElementsByTagName('movil').item(0).firstChild.data != "no"){
										var cel = aux.getElementsByTagName('movil').item(0).firstChild.data; 
								}else{
									var cel = "";
								}
								if(aux.getElementsByTagName('web').item(0).firstChild.data != "no"){
										var web = aux.getElementsByTagName('web').item(0).firstChild.data; 
								}else{
									var web = "";
								}
								if(aux.getElementsByTagName('mail').item(0).firstChild.data != "no"){
										var mail = aux.getElementsByTagName('mail').item(0).firstChild.data; 
								}else{
									var mail = "";
								}
								
								if(aux.getElementsByTagName('contacto').item(0).firstChild.data != "no"){
										var contacto = aux.getElementsByTagName('contacto').item(0).firstChild.data; 
								}else{
									var contacto = "";
								}
								if(aux.getElementsByTagName('lim_cred').item(0).firstChild.data != "no"){
										var lim_cred = aux.getElementsByTagName('lim_cred').item(0).firstChild.data; 
								}else{
									var lim_cred = "";
								}


								// referenciamos los objetos del template y lo almacenamos en variables
								txtcodigo=document.getElementById("codigo");
								txtrazon=document.getElementById("razon");
								txtcuit1=document.getElementById("cuit1");												
								txtcuit2=document.getElementById("cuit2");												
								txtcuit3=document.getElementById("cuit3");												
								txtdir=document.getElementById("direccion");												
								txttel=document.getElementById("tel");												
								txtfax=document.getElementById("fax");												
								txtcel=document.getElementById("cel");												
								txtweb=document.getElementById("web");												
								txtmail=document.getElementById("mail");												
								txtcontacto=document.getElementById("contacto");												
								txtlim_cred=document.getElementById("lim_cred");												
										
								// asignamos el valor de las variables del XML a los objetos
								txtcodigo.value = codigo;
								txtrazon.value = razon;
								txtcuit1.value = cuit1;												
								txtcuit2.value = cuit2;
								txtcuit3.value = cuit3;
								txtdir.value = dir;
								txttel.value = tel;
								txtfax.value = fax;
								txtcel.value = cel;
								txtweb.value = web;
								txtmail.value = mail;
								txtcontacto.value = contacto;
								txtlim_cred.value = lim_cred;
								
								listar_iva_cliente_pegar(txtcodigo.value);
								listar_pais_cliente_pegar(txtcodigo.value);
								listar_prov_cliente_pegar(txtcodigo.value);
								listar_loca_cliente_pegar(txtcodigo.value);
								listar_zona_cliente_pegar(txtcodigo.value);
								listar_cat_cliente_pegar(txtcodigo.value);
								listar_ven_cliente_pegar(txtcodigo.value);
								listar_rep_cliente_pegar(txtcodigo.value);	
								listar_forma_pago_cliente_pegar(txtcodigo.value); 	// funcion para crear el select de cond de iva
															
								document.getElementById("codigo").focus();
					}else{
							divMensaje.innerHTML="ERROR: No se Pueden copiar los Datos";
					}
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	ajax.send(null); // Es obligatorio, si no se envia algo el proceso no funciona
    return;
}
 
//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ AGENDA TELEFONICA -------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function registrar_persona_agenda(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");

	var txtnombre = document.getElementById("nombre");
	var txttel = document.getElementById("tel");
	var txtmail = document.getElementById("mail");

	if(txtnombre.value != ""){
		if(txttel.value != ""){
			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
			boton.disabled=true; 				    // Deshabilito el boton y los input
			txtnombre.disabled=true; 
			txttel.disabled=true; 
			txtmail.disabled=true; 
			
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
			url="agenda.php?";
			variables="nombre="+txtnombre.value+"&tel="+txttel.value+"&mail="+txtmail.value;
			
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
						txtnombre.value="";				// Borro el contenido del input
						txttel.value="";				// Borro el contenido del input
						txtmail.value="";				// Borro el contenido del input
						txtnombre.disabled=false; 		// habilito el boton y los input
						txttel.disabled=false; 		// habilito el boton y los input
						txtmail.disabled=false; 
						boton.disabled=false; 				// Habilito boton nuevamente

						//divMensaje.innerHTML=ajax.responseText; // imprime la salida
						document.getElementById('nombre').focus(); 
						buscar_agenda();
						} // fin de if (ajax.readyState==4)
			} // fin de funcion()

		}else{
			divMensaje.innerHTML="Debe ingresar el Teléfono";
			document.frm.tel.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Nombre";
		document.frm.nombre.focus()
	}	
}

//--------------------------------------------------------------------------------------------------//
function buscar_agenda(){
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_agenda_proceso.php?";
	variables="nombre=TODOS";

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				//document.frm.codigo.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_agenda2(){
	var divlistado=document.getElementById("listado"); 
 	var boton=document.getElementById("enviar");
	var txtmarca = document.getElementById("marca");
	var txtchofer = document.getElementById("chofer");
		
	boton.disabled=true; 										// Deshabilito el boton y el input para evitar dobles ingresos
	txtmarca.disabled=true; 
	txtchofer.disabled=true; 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_vehiculo_proceso.php?";

	if((txtmarca.value == "") && (txtchofer.value == "")){
		variables="nombre=TODOS";
	}else{
		variables="marca="+txtmarca.value+"&chofer="+txtchofer.value;
	}

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				txtmarca.value="";								// Borro el contenido del input
				txtchofer.value="";								// Borro el contenido del input
		
				boton.disabled=false; 										// Deshabilito el boton y el input para evitar dobles ingresos
				txtmarca.disabled=false; 
				txtchofer.disabled=false; 
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.marca.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_agenda(codigo){
	var cod=codigo;											// asigna los aobjetos a las variables
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML="";								// Limpio posibles mensajes que haya en el div
	var ajax=nuevoAjax();									// creo una instancia de ajax
	metodo="POST";											// asigno las variables de proceso
    url="modificar.php?";
	variables="codigo_persona_agenda="+cod;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "<script>alert('USUARIO SIN PERMISOS...');window.history.go(-1);</script>"){
					divlistado.innerHTML=ajax.responseText; 	// imprime la salida
					document.frm_mod.nombre_mod.focus()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}

			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function modificar_agenda_db(){
	var divlistado=document.getElementById("listado");			// asigna los aobjetos a las variables
	var divMensaje=document.getElementById("mensaje_mod");			// asigna los aobjetos a las variables
	var boton=document.getElementById("enviar_mod");
	var boton_cancel=document.getElementById("cancelar_mod");
	
	var txtcodigo_mod = document.getElementById("oculto_mod");
	var txtnombre = document.getElementById("nombre_mod");
	var txttel = document.getElementById("tel_mod");
	var txtcorreo = document.getElementById("mail_mod");

	if(txtnombre.value != ""){	
		if(txttel.value != ""){
			divMensaje.innerHTML="";						// Limpio posibles mensajes que haya en el div
			boton.disabled=true; 				    		// Deshabilito el boton y los input
			boton_cancel.disabled=true; 				    // Deshabilito el boton y los input
			txtnombre.disabled=true; 
			txttel.disabled=true; 
			txtcorreo.disabled=true; 
			
			divMensaje.innerHTML="Modificando.......";					// mensajes en el div
			var ajax=nuevoAjax();										// creo una instancia de ajax
			metodo="POST";												// asigno las variables de proceso
			url="modificar.php?";
			variables="codigo_persona_agenda_mod="+txtcodigo_mod.value+"&nombre_persona_agenda_mod="+txtnombre.value+"&tel_persona_agenda_mod="+txttel.value+"&correo_persona_agenda_mod="+txtcorreo.value;
			//alert(variables);
			
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
					if (ajax.readyState==4){
							if (ajax.responseText == "ok"){
									buscar_agenda();
									document.frm.nombre.focus();
							}else{
									//divMensaje.innerHTML=ajax.responseText; // imprime la salida
									divMensaje.innerHTML = "ERROR: No se puede guardar el Contacto!!";
									document.frm_mod.nombre_mod.focus()
							}
							boton.disabled=false; 				    		// Deshabilito el boton y los input
							boton_cancel.disabled=false; 				    // Deshabilito el boton y los input
							txtnombre.disabled=false; 
							txttel.disabled=false; 
							txtcorreo.disabled=false; 
					} // fin de if (ajax.readyState==4)
				} // fin de funcion()
		}else{
			divMensaje.innerHTML="Debe ingresar el Telefono";
			document.frm_mod.tel_mod.focus()
		}
	}else{
		divMensaje.innerHTML="Debe ingresar el Nombre";
		document.frm_mod.nombre_mod.focus()
	}
}
//--------------------------------------------------------------------------------------------------//
function eliminar_agenda(codigo){
 if (confirm('¿Está seguro de eliminar este contacto?')){
	var ajax=nuevoAjax();										// creo una instancia de ajax
	metodo="POST";												// asigno las variables de proceso
    url="eliminar.php?";
	variables="codigo_persona_agenda="+codigo;
	
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText != "sin_permiso"){
					buscar_agenda()
				}else{
					alert('USUARIO SIN PERMISOS...');
				}
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
 }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ AJUSTE DE PRECIOS -------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function listar_grupo_ajuste_precios(){
	var contenedor=document.getElementById("grupos"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_grupo_ajuste_precios.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
					contenedor.innerHTML=ajax.responseText; 		// imprime la salida
					listar_categoria_ajuste_precios(document.frm.lista_grupo.value)
					document.frm.lista_grupo.focus();	
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function listar_categoria_ajuste_precios(id_grupo){
	var contenedor=document.getElementById("categorias"); 
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="listar_categoria_ajuste_precios.php";
	variables="id_grupo="+id_grupo;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//------------------------------------------------------------------------------------------------------//
function registrar_ajuste_precio(id_grupo,id_categoria,id_radio1,id_radio2,caja_nombre,id_boton){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById(id_boton);
    		
	if(document.getElementById(id_radio2).checked == true ){
		if (document.getElementById(caja_nombre).value == ''){
			divMensaje.innerHTML="Debe ingresar el porcentaje de Utilidad";
			document.getElementById(caja_nombre).focus();
			return 0;
		}else{		
			var accion = 'U';			
		}
	}else{
		var accion = 'M';
	}
	 
	if(id_grupo != ""){ 
		
		divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
		boton.disabled=true; 				    // Deshabilito el boton y el input para evitar dobles ingresos
		document.frm.lista_grupo.disabled=true;
		document.getElementById(id_radio1).disabled=true; 
		document.getElementById(id_radio2).disabled=true; 
		document.getElementById(caja_nombre).disabled=true; 
		
		divMensaje.innerHTML="Actualizando......."; // mensajes en el div
		var ajax=nuevoAjax();					// creo una instancia de ajax
		metodo="POST";							// asigno las variables de proceso
		url="ajuste_precios.php?";
		variables="accion="+accion+"&id_grupo="+id_grupo+"&id_categoria="+id_categoria+"&porcentaje="+document.getElementById(caja_nombre).value;
		//alert(variables);
		
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(variables);
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					if(ajax.responseText == 'ok'){
						divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
						buscar_ajuste_precios();
					}else{
						divMensaje.innerHTML="ERROR: No se pudieron Ajustar los Precios"; // imprime la salida						
					}
					boton.disabled=false; 				    // Deshabilito el boton y el input para evitar dobles ingresos
					document.frm.lista_grupo.disabled=false;
					document.getElementById(id_radio1).disabled=false; 
					document.getElementById(id_radio2).disabled=false; 
					document.getElementById(caja_nombre).disabled=false; 
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
	}else{
		divMensaje.innerHTML="Debe Seleccionar un Grupo";
		document.frm.lista_grupo.focus()
	}				 
}
//--------------------------------------------------------------------------------------------------//
function buscar_ajuste_precios(){
 	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_ajuste_precios.php?";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				//document.frm.nombre.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//

//////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------------- CIERRE Z -----------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////

function cierre_z(){
 	var divlistado=document.getElementById("listado"); 
	var boton=document.getElementById('enviar');
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	boton.disabled=false; 				    						// Deshabilito el boton
	var ajax=nuevoAjax();										    // creo una instancia de ajax
	metodo="POST";												    // asigno las variables de proceso
    url="cierre_z.php?";
	variables="cierre=1";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				if(ajax.responseText == '0'){
						divlistado.innerHTML='Cierre completado con exito!!'; 		// imprime la salida
				}else{
					divlistado.innerHTML=ajax.responseText; 						// imprime la salida
				}
				boton.disabled=false; 				    							// habilito el boton
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------------- GASTOS -------------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function pasar_foco_gastos_dia(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if( document.frm.dia.value.length == 2  ) {
			document.frm.mes.focus();
			return 0;		 
	   }		
}
function pasar_foco_gastos_mes(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if( document.frm.mes.value.length == 2  ) {
			document.frm.ano.focus();
			return 0;		 
	   }		
}
function pasar_foco_gastos_ano(e){
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if ( tecla==13 ){
			if( document.frm.ano.value.length == 4  ) {
				document.frm.hora.focus();
				return 0;		 
		   }		
		}
}

function pasar_foco_gastos_2(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.hora.value.length > 0  ) {
					document.frm.desc.focus();
		}
	}
}
function pasar_foco_gastos_3(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.desc.value.length > 0  ) {
					document.frm.importe.focus();
		}
	}
}
function pasar_foco_gastos_4(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.importe.value.length > 0  ) {
					document.frm.iva.focus();
		}
	}
}
function pasar_foco_gastos_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.iva.value.length > 0  ) {
					document.frm.otros_imp.focus();
		}
	}
}

function pasar_foco_gastos_6(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.otros_imp.value.length > 0  ) {
					document.frm.total.focus();
		}
	}
}
function pasar_foco_gastos_7(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.total.value.length > 0  ) {
					document.frm.obs.focus();
		}
	}
}
function pasar_foco_gastos_8(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.enviar.click();
	}
}

//--------------------------------------------------------------------------------------------------//
function registrar_gasto(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");

	var txtdia = document.getElementById("dia");
	var txtmes = document.getElementById("mes");
	var txtano = document.getElementById("ano");
	var txthora = document.getElementById("hora");
	var txtdesc = document.getElementById("desc");
	var txtimporte = document.getElementById("importe");
	var txtiva = document.getElementById("iva");
	var txtotros_imp = document.getElementById("otros_imp");
	var txttotal = document.getElementById("total");
	var txtobs = document.getElementById("obs");
	

	if(txtdia.value.length == 2 && txtmes.value.length == 2 && txtano.value.length == 4){
		if(txthora.value != ""){
			if(txtdesc.value != ""){
				if(txtimporte.value != ""){
					divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
					boton.disabled=true; 				    // Deshabilito el boton y los input
					txtdia.disabled=true; 
					txtmes.disabled=true; 
					txtano.disabled=true; 
					txthora.disabled=true; 
					txtdesc.disabled=true; 
					txtimporte.disabled=true; 
					txtiva.disabled=true; 
					txtotros_imp.disabled=true; 
					txttotal.disabled=true; 
					txtobs.disabled=true; 
					
					divMensaje.innerHTML="Registrando......."; // mensajes en el div
					var ajax=nuevoAjax();					// creo una instancia de ajax
					metodo="POST";							// asigno las variables de proceso
					url="alta_gastos.php?";
					variables="fecha="+txtano.value+txtmes.value+txtdia.value+"&hora="+txthora.value+"&desc="+txtdesc.value+"&importe="+txtimporte.value+"&obs="+txtobs.value+"&iva="+txtiva.value+"&otros_imp="+txtotros_imp.value+"&total="+txttotal.value;
					//alert(variables);
					
					ajax.open(metodo, url, true);
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(variables);
					ajax.onreadystatechange=function(){ 
						if (ajax.readyState==4){
							if(ajax.responseText == 'ok'){
								txtdia.value="";				// Borro el contenido del input
								txtmes.value="";				// Borro el contenido del input
								txtano.value="";				// Borro el contenido del input
								txthora.value="";				// Borro el contenido del input
								txtdesc.value="";				// Borro el contenido del input
								txtimporte.value="";			// Borro el contenido del input
								txtiva.value="";			// Borro el contenido del input
								txtotros_imp.value="";			// Borro el contenido del input
								txttotal.value="";			// Borro el contenido del input
								txtobs.value="";				// Borro el contenido del input
								divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
								buscar_gasto();
							}else{
								divMensaje.innerHTML='ERROR: El Gasto no se pudo registrar'; // imprime la salida
							}
							boton.disabled=false; 				    // Deshabilito el boton y los input
							txtdia.disabled=false; 
							txtmes.disabled=false; 
							txtano.disabled=false; 
							txthora.disabled=false; 
							txtdesc.disabled=false; 
							txtimporte.disabled=false 
							txtiva.disabled=false; 
							txtotros_imp.disabled=false; 
							txttotal.disabled=false; 
							txtobs.disabled=false; 
							boton.disabled=false; 				// Habilito boton nuevamente
							document.frm.dia.focus();
						} // fin de if (ajax.readyState==4)
					} // fin de funcion()
					
			}else{
				divMensaje.innerHTML="Debe ingresar el Importe";
				document.frm.importe.focus()
			}		 
		}else{
			divMensaje.innerHTML="Debe ingresar la Descripción";
			document.frm.desc.focus()
		}	
	}else{
		divMensaje.innerHTML="Debe ingresar la hora";
		document.frm.hora.focus()
	}
	}else{
		divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
		document.frm.dia.focus()
	}
}
//--------------------------------------------------------------------------------------------------//
function buscar_gasto(){
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_gastos_proceso.php?";
	variables="nombre=TODOS";

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.dia.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_gasto_proceso(){
	var cant_objetos = document.frm.elements.length;
	 
	var contenedor=document.getElementById("listado"); 
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var buscar=document.getElementById("buscar");
	 
	var dia = document.getElementById("dia");
	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;
	 
	var dia_h = document.getElementById("dia_h");
	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
 
	contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
	divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
			document.frm.elements[i].disabled=true;
	}	
	divMensaje.innerHTML="Buscando......."; // mensajes en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
	url="buscar_gastos_proceso.php?";
	if(fecha_desde.length != 0 || fecha_hasta.length != 0){
		variables="fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
	}else{
		variables="nombre=TODOS";
	}
	
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
						document.frm.elements[i].disabled=false;
				}	
				contenedor.innerHTML=ajax.responseText; // imprime la salida
				divMensaje.innerHTML=""; // mensajes en el div

				document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------------------- DEPOSITOS ----------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////

function pasar_foco_dep_1(){
		if( document.frm.dia.value.length == 2  ) {
			document.frm.mes.focus();
			return 0;		 
	   }		
}
function pasar_foco_dep_2(){
		if( document.frm.mes.value.length == 2  ) {
			document.frm.ano.focus();
			return 0;		 
	   }		
}
function pasar_foco_dep_3(){
		if( document.frm.ano.value.length == 4  ) {
			document.frm.hora.focus();
			return 0;		 
	   }		
}
function pasar_foco_dep_4(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.hora.value.length > 0  ) {
			document.frm.banco.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_dep_5(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.banco.value.length > 0  ) {
			document.frm.trans.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_dep_6(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.trans.value.length > 0  ) {
			document.frm.cta.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_dep_7(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.cta.value.length > 0  ) {
			document.frm.tiular.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_dep_8(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.tiular.value.length > 0  ) {
			document.frm.importe.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_dep_9(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.importe.value.length > 0  ) {
			document.frm.obs.focus();
			return 0;		 
	   }		
	}
}
function pasar_foco_dep_10(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		document.frm.enviar.click();
		return 0;		 
	}
}

function registrar_deposito_compra(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var boton=document.getElementById("enviar");

	var txtdia = document.getElementById("dia");
	var txtmes = document.getElementById("mes");
	var txtano = document.getElementById("ano");
	var txthora = document.getElementById("hora");
	var txtbanco = document.getElementById("banco");
	var txttrans = document.getElementById("trans");
	var txtcta = document.getElementById("cta");
	var txttitular = document.getElementById("titular");
	var txtimporte = document.getElementById("importe");
	var txtobs = document.getElementById("obs");
	

	if(txtdia.value.length == 2 && txtmes.value.length == 2 && txtano.value.length == 4){
		if(txthora.value != ""){
			if(txtbanco.value != ""){
				if(txttrans.value != ""){				
					if(txtcta.value != ""){				
						if(txttitular.value != ""){				
							if(txtimporte.value != ""){
								
								divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
								boton.disabled=true; 				    // Deshabilito el boton y los input
								txtdia.disabled=true; 
								txtmes.disabled=true; 
								txtano.disabled=true; 
								txthora.disabled=true; 
								txtbanco.disabled=true; 
								txttrans.disabled=true; 
								txtcta.disabled=true; 
								txttitular.disabled=true; 
								txtimporte.disabled=true; 
								txtobs.disabled=true; 
								
								divMensaje.innerHTML="Registrando......."; // mensajes en el div
								var ajax=nuevoAjax();					// creo una instancia de ajax
								metodo="POST";							// asigno las variables de proceso
								url="alta_deposito_compra.php?";
								variables="fecha_dep="+txtano.value+txtmes.value+txtdia.value+"&hora_dep="+txthora.value+"&banco="+txtbanco.value+"&trans="+txttrans.value+"&cta="+txtcta.value+"&titular="+txttitular.value+"&importe="+txtimporte.value+"&obs="+txtobs.value;
								//alert(variables);
								
								ajax.open(metodo, url, true);
								ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
								ajax.send(variables);
								ajax.onreadystatechange=function(){ 
									if (ajax.readyState==4){
										if(ajax.responseText == 'ok'){
											txtdia.value="";				// Borro el contenido del input
											txtmes.value="";				// Borro el contenido del input
											txtano.value="";				// Borro el contenido del input
											txthora.value="";				// Borro el contenido del input
											txtbanco.value="";				// Borro el contenido del input
											txttrans.value="";				// Borro el contenido del input
											txtcta.value="";				// Borro el contenido del input
											txttitular.value="";			// Borro el contenido del input
											txtimporte.value="";			// Borro el contenido del input
											txtobs.value="";				// Borro el contenido del input
											divMensaje.innerHTML="";		// Limpio posibles mensajes que haya en el div
											buscar_deposito();
										}else{
											divMensaje.innerHTML='ERROR: El Depósito no se pudo registrar'; // imprime la salida
										}
										
										boton.disabled=false; 				    // habilito el boton y los input
										txtdia.disabled=false; 
										txtmes.disabled=false; 
										txtano.disabled=false; 
										txthora.disabled=false; 
										txtbanco.disabled=false; 
										txttrans.disabled=false; 
										txtcta.disabled=false; 
										txttitular.disabled=false; 
										txtimporte.disabled=false; 
										txtobs.disabled=false; 
										document.frm.dia.focus();
									} // fin de if (ajax.readyState==4)
								} // fin de funcion()
								
						}else{
							divMensaje.innerHTML="Debe ingresar el Importe";
							document.frm.importe.focus()
						}		
					}else{
						divMensaje.innerHTML="Debe ingresar el Titular";
						document.frm.importe.focus()
					}		
				}else{
					divMensaje.innerHTML="Debe ingresar Nº de Cuenta";
					document.frm.importe.focus()
				}		
			}else{
				divMensaje.innerHTML="Debe ingresar el Nº de transacción";
				document.frm.desc.focus()
			}	
		}else{
			divMensaje.innerHTML="Debe ingresar el nombre del Banco";
			document.frm.desc.focus()
		}	
	}else{
		divMensaje.innerHTML="Debe ingresar la hora";
		document.frm.hora.focus()
	}
	}else{
		divMensaje.innerHTML="Formato de Fecha invalido, dd/mm/aaaa";
		document.frm.dia.focus()
	}
}
//--------------------------------------------------------------------------------------------------//
function buscar_deposito(){
	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_depositos_compra_proceso.php?";
	variables="nombre=TODOS";

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.dia.focus();
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_deposito_proceso(){
	var cant_objetos = document.frm.elements.length;
	 
	var contenedor=document.getElementById("listado"); 
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var buscar=document.getElementById("buscar");
	
	var dia = document.getElementById("dia");
	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;
	
	var dia_h = document.getElementById("dia2");
	var mes_h = document.getElementById("mes2");
	var ano_h = document.getElementById("ano2");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
 	
	var banco = document.getElementById("banco");
	var trans = document.getElementById("trans");
	var cta = document.getElementById("cta");
	var titular = document.getElementById("titular");
	 
	contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
	divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
			document.frm.elements[i].disabled=true;
	}	
	divMensaje.innerHTML="Buscando......."; // mensajes en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
	url="buscar_depositos_compra_proceso.php?";
	if(	fecha_desde.length != 0 || fecha_hasta.length != 0 || banco.value.length != 0 || trans.value.length != 0 || cta.value.length != 0 || titular.value.length != 0){
		variables="fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&banco="+banco.value+"&trans="+trans.value+"&cta="+cta.value+"&titular="+titular.value;
	}else{
		variables="nombre=TODOS";
	}
	//alert(variables);

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
						document.frm.elements[i].disabled=false;
				}	
				contenedor.innerHTML=ajax.responseText; // imprime la salida
				divMensaje.innerHTML=""; // mensajes en el div
				document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
	
}
//----------------------------------BUSCAR---------------------------------------//

function pasar_foco_dep_buscar_1(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla ==13 && document.frm.dia.value.length == 0){
		document.frm.dia2.focus();
	}else{
		if( document.frm.dia.value.length == 2  ) {
			document.frm.mes.focus();
		}
	}
	return 0;		 
}
function pasar_foco_dep_buscar_2(e){
		if( document.frm.mes.value.length == 2  ) {
			document.frm.ano.focus();
			return 0;		 
	   }		
}
function pasar_foco_dep_buscar_3(e){
		if( document.frm.ano.value.length == 4  ) {
			document.frm.dia2.focus();
			return 0;		 
	   }		
}
function pasar_foco_dep_buscar_4(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla ==13 && document.frm.dia2.value.length == 0){
		document.frm.banco.focus();
	}else{
		if( document.frm.dia2.value.length == 2  ) {
			document.frm.mes2.focus();
		}
	}
	return 0;		 
}
function pasar_foco_dep_buscar_5(e){
		if( document.frm.mes2.value.length == 2  ) {
			document.frm.ano2.focus();
			return 0;		 
	   }		
}
function pasar_foco_dep_buscar_6(e){
		if( document.frm.ano2.value.length == 4  ) {
			document.frm.banco.focus();
			return 0;		 
	   }		
}

function pasar_foco_dep_buscar_7(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.trans.focus();
			return 0;		 
	}
}
function pasar_foco_dep_buscar_8(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.cta.focus();
			return 0;		 
	}
}
function pasar_foco_dep_buscar_9(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.tiular.focus();
			return 0;		 
	}
}
function pasar_foco_dep_buscar_10(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
			document.frm.enviar.click();
			return 0;		 
	}
}

//--------------------------------------------------------------------------------------------------//
//--------------- NO ESTA TERMINADO [HACER] ---------------//
function buscar_detalle_deposito_compra(num_fac,suc){
	var contenedor=document.getElementById("listado_detalle_deposito"); 
	
	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_detalle_comprobante_detalle.php";
	variables = "cod_tal="+cod_tal+"&num_tal="+num_tal+"&num_fac="+num_fac+"&desc_fac="+desc_fac+"&suc="+suc;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//

//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ INFORME COMPRAS DEL DIA ---------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////

function buscar_compra_dia(){
	var contenedor=document.getElementById("listado"); 
	var contenedor2=document.getElementById("listado_detalle_repartidor"); 
	var contenedor3=document.getElementById("listado_detalle_comprobante"); 

	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_compras_del_dia.php";
	variables = "fecha_buscar="+fecha_buscar;
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						contenedor2.innerHTML=""; 		// imprime la salida
						contenedor3.innerHTML=""; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function exportar_listado_compra_del_dia(url_php){	
	//alert(url_php);
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	window.open(url_php+"?fecha_buscar="+fecha_buscar, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

//--------------------------------------------------------------------------------------------------//
function imprimir_listado_compra_del_dia(pag_exp){
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="fecha_buscar="+fecha_buscar+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function buscar_compra_dia_detalle(proveedor){
	var contenedor=document.getElementById("listado_detalle_repartidor"); 
	var contenedor2=document.getElementById("listado_detalle_comprobante"); 

	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_compras_del_dia_detalle.php";
	variables = "fecha_buscar="+fecha_buscar+"&proveedor="+proveedor;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						contenedor2.innerHTML=""; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function exportar_listado_compra_del_dia_detalle(url_php){	
	//alert(url_php);
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	var proveedor = document.getElementById("oculto_proveedor").value
	window.open(url_php+"?fecha_buscar="+fecha_buscar+"&cod_proveedor="+proveedor, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

//--------------------------------------------------------------------------------------------------//
function imprimir_listado_compra_del_dia_detalle(pag_exp){
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	var proveedor = document.getElementById("oculto_proveedor").value
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="fecha_buscar="+fecha_buscar+"&cod_proveedor="+proveedor+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
function buscar_compra_dia_detalle_comprobante(num_fac,suc){
	var contenedor=document.getElementById("listado_detalle_comprobante"); 

	//contenedor.innerHTML= '<img src="../imagenes/cargando8.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="informe_compras_del_dia_detalle_comprobante.php";
	variables = "num_fac="+num_fac+"&suc="+suc;
	//alert(variables);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						contenedor.innerHTML=ajax.responseText; 		// imprime la salida
						//document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

//--------------------------------------------------------------------------------------------------//
function exportar_listado_compra_del_dia_detalle_comprobante(url_php){	
	//alert(url_php);
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	
	var num_fac = document.getElementById("oculto_n_factura").value
	var suc = document.getElementById("oculto_suc").value
	
	window.open(url_php+"?fecha_buscar="+fecha_buscar+"&num_fac="+num_fac+"&suc="+suc, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}

//--------------------------------------------------------------------------------------------------//
function imprimir_listado_compra_del_dia_detalle_comprobante(pag_exp){
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_buscar = ano.value+mes.value+dia.value;
	
	var num_fac = document.getElementById("oculto_n_factura").value
	var suc = document.getElementById("oculto_suc").value

	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="fecha_buscar="+fecha_buscar+"&num_fac="+num_fac+"&suc="+suc+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Listado...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ INFORME DEPOSITOS -------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function informe_deposito_proceso(){
	var cant_objetos = document.frm.elements.length;
	 
	var contenedor=document.getElementById("listado"); 
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var buscar=document.getElementById("buscar");
	
	var dia = document.getElementById("dia");
	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;
	
	var dia_h = document.getElementById("dia_h");
	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
 	
	 
	contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
	divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
	for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
			document.frm.elements[i].disabled=true;
	}	
	divMensaje.innerHTML="Buscando......."; // mensajes en el div
	var ajax=nuevoAjax();					// creo una instancia de ajax
	metodo="POST";							// asigno las variables de proceso
	url="informe_depositos_proceso.php?";
	if(	fecha_desde.length != 0 || fecha_hasta.length != 0 ){
		variables="fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
	}else{
		variables="nombre=TODOS";
	}
	//alert(variables);

	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
						document.frm.elements[i].disabled=false;
				}	
				contenedor.innerHTML=ajax.responseText; // imprime la salida
				divMensaje.innerHTML=""; // mensajes en el div
				document.frm.dia.focus()
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
	
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------ INFORME CAJA / RENTABILIDAD ---------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////
function informe_caja_rentabilidad_proceso(){
	var cant_objetos = document.frm.elements.length;
	 
	var contenedor=document.getElementById("listado"); 
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var buscar=document.getElementById("buscar");
	
	var dia = document.getElementById("dia");
	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;
	
	var dia_h = document.getElementById("dia_h");
	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
 	
	if(dia.value.length == 2 && mes.value.length == 2 && ano.value.length == 4){
		if(dia_h.value.length == 2 && mes_h.value.length == 2 && ano_h.value.length == 4){		
						contenedor.innerHTML= '<img src="../imagenes/cargando9.gif">'; // width="30" height="30"
						divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
						for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
								document.frm.elements[i].disabled=true;
						}	
						divMensaje.innerHTML="Buscando......."; // mensajes en el div
						var ajax=nuevoAjax();					// creo una instancia de ajax
						metodo="POST";							// asigno las variables de proceso
						url="informe_caja_rentabilidad_proceso.php?";
						if(	fecha_desde.length != 0 || fecha_hasta.length != 0 ){
							variables="fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;
						}
						//alert(variables);
					
						ajax.open(metodo, url, true);
						ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						ajax.send(variables);
						ajax.onreadystatechange=function(){ 
								if (ajax.readyState==4){
									for (i=0; i < cant_objetos; i++){		//Deshabilito el boton y los text
											document.frm.elements[i].disabled=false;
									}	
									contenedor.innerHTML=ajax.responseText; // imprime la salida
									divMensaje.innerHTML=""; // mensajes en el div
									document.frm.dia.focus()
								} // fin de if (ajax.readyState==4)
						} // fin de funcion()

		}else{
			divMensaje.innerHTML="Debe ingresar la Fecha hasta";
			document.frm.dia_h.focus()
		}	
	}else{
		divMensaje.innerHTML="Debe ingresar la Fecha desde";
		document.frm.dia.focus()
	}	
}

//--------------------------------------------------------------------------------------------------//
function exportar_informe_caja_rentabilidad(url_php){	
	//alert(url_php);
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
	window.open(url_php+"?fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta, '_blank'); //, 'toolbar=0' muestra la pagina en antalla completa
}



//--------------------------------------------------------------------------------------------------//
function imprimir_informe_caja_rentabilidad(pag_exp){
	var dia = document.getElementById("dia");
 	var mes = document.getElementById("mes");
	var ano = document.getElementById("ano");
	var fecha_desde = ano.value+mes.value+dia.value;

	var dia_h = document.getElementById("dia_h");
 	var mes_h = document.getElementById("mes_h");
	var ano_h = document.getElementById("ano_h");
	var fecha_hasta = ano_h.value+mes_h.value+dia_h.value;
	
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
	url="imprimir_listado.php";
	var sql="fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&pag_exp="+pag_exp;
	//alert(sql+","+url);
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(sql);
	
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
						abrirVentanaFija('mensaje.php?msg=Imprimiendo Informe...', 400, 115, 'ventana', 'Atencion!!');
						//alert('IMPRIMIENDO LISTADO...'); 		// imprime la salida
			} // fin de if (ajax.readyState==4)
	} // fin de funcion()
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------  CAJA INICIAL -----------------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////

function pasar_foco_caja_1(e){
    tecla = (document.all) ? e.keyCode : e.which; // 2
	if ( tecla==13 ){
		if( document.frm.importe.value.length > 0  ) {
			document.frm.obs.focus()
			return 0;
		}
	}
}
//--------------------------------------------------------------------------------------------------//
function registrar_caja(){
	var divMensaje=document.getElementById("mensaje");  // asigna los aobjetos a las variables
	var cant_objetos = document.frm.elements.length;
	var boton=document.getElementById("enviar");
	var txtimporte = document.getElementById("importe");
	var txtobs = document.frm.obs.value;

	if(document.frm.importe.value != ""){
			divMensaje.innerHTML="";				// Limpio posibles mensajes que haya en el div
			for (i=0; i < cant_objetos; i++){		//deshabilito todos los elementos
				document.frm.elements[i].disabled=true;
			}
			divMensaje.innerHTML="Buscando......."; // mensajes en el div
			var ajax=nuevoAjax();					// creo una instancia de ajax
			metodo="POST";							// asigno las variables de proceso
    		url="caja.php?";
			variables="importe="+txtimporte.value+"&obs="+txtobs;
			//alert(variables);
			ajax.open(metodo, url, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send(variables);
			ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
					txtimporte.value="";					// Borro el contenido del input
					document.frm.obs.value="";			// Borro el contenido del input
					for (i=0; i < cant_objetos; i++){	//deshabilito todos los elementos
						document.frm.elements[i].disabled=false;
					}
					divMensaje.innerHTML=ajax.responseText; // imprime la salida
					buscar_caja();
					document.frm.importe.focus();
				} // fin de if (ajax.readyState==4)
			} // fin de funcion()
    }else{
		divMensaje.innerHTML="Debe ingresar el Importe";
		document.frm.importe.focus()
 	}
}
//--------------------------------------------------------------------------------------------------//
function buscar_caja(){
 	var divlistado=document.getElementById("listado"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url="buscar_caja_proceso.php?";
	variables="nombre=todos";
	ajax.open(metodo, url, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(variables);
	ajax.onreadystatechange=function(){ 
			if (ajax.readyState==4){
				divlistado.innerHTML=ajax.responseText; 		// imprime la salida
				document.frm.importe.focus()
			} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}
//--------------------------------------------------------------------------------------------------//
