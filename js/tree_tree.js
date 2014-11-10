var UI = new Object();
UI.expand =   '<img src="../imagenes/mas.gif" class="iconos" width="11" height="11"> ';		// <img src="../imagenes/mas.ico" class="iconos" width="16" height="16"> 
UI.collapse = '<img src="../imagenes/menos.gif" class="iconos" width="11" height="11"> ';	// <img src="../imagenes/menos.ico" class="iconos" width="16" height="16"> 

/*************************************************************************************************************/
/************** VERIFICA SI SE HIZO CLICK EN UN PEDIDO Y CARGA EL COD DE CLIENTE *****************************/
/*************************************************************************************************************/
function getData(id){
		var ajax=nuevoAjax();										  // creo una instancia de ajax
		metodo="POST";												  // asigno las variables de proceso
		url="verificar_si_es_pedido.php";
		var sql="id="+id;
		ajax.open(metodo, url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(sql);
	
		ajax.onreadystatechange=function(){ 
				if (ajax.readyState==4){
						if(ajax.responseText > 0){  												// si se un pedido envia al frame de facturacion el codigo del cliente
							var cod_cliente = ajax.responseText;									// toma el codigo del cliente
							window.parent.frames[1].document.forms[0].codigo.value = cod_cliente;	// inserta en el text el codigo de cliente
							window.parent.frames[1].buscar_cliente_fact_vta();						// llama a la funcion para buscar el cliente
							var ajax2=nuevoAjax();										  							// creo una instancia de ajax
							metodo="POST";												  							// asigno las variables de proceso
							url="buscar_cant_art_pedido.php?";
							var id_cat = window.parent.frames[1].document.forms[0].lista_cat.value;					// Id Categoria
							var codigo_tal = window.parent.frames[1].document.forms[0].oculto_codigo_tal.value;		// Cod Talonario
							
							var sql="id="+id+"&id_cat="+id_cat+"&codigo_tal="+codigo_tal;
							//alert(sql);
							
							ajax2.open(metodo, url, true);
							ajax2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							ajax2.send(sql);
							ajax2.onreadystatechange=function(){ 
									if (ajax2.readyState==4){
											// asigno el codigo del tree view a la variable oculta
											window.parent.frames[1].document.forms[0].oculto_num_pedido.value = id;
											
											// si se un pedido envia al frame de facturacion el codigo del cliente
											if(ajax2.responseText == 'ok'){  
												// divMensaje.innerHTML = ajax.responseText;
												window.parent.frames[1].mostrar_art_fac_vta_tmp();
												window.parent.frames[1].document.forms[1].codigo_art.focus();
												
											}else{
												window.parent.frames[1].borrar_cajas_factura_vta();
												window.parent.frames[1].vaciar_tabla_fac_vta_tmp();
												window.parent.frames[1].mostrar_art_fac_vta_tmp();
												window.parent.frames[1].document.forms[1].codigo_art.focus();
												
												alert('SIN COMPRA \n'+ajax2.responseText);
											}
											
									} // fin de if (ajax.readyState==4)
							} // fin de funcion()
						}else{
							var ajax2=nuevoAjax();										  // creo una instancia de ajax
							metodo="POST";												  // asigno las variables de proceso
							url="verificar_si_es_pedido_odb.php";
							var sql="id="+id;
							ajax2.open(metodo, url, true);
							ajax2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							ajax2.send(sql);
						
							ajax2.onreadystatechange=function(){ 
									if (ajax2.readyState==4){
											if(ajax2.responseText > 0){  												// si se un pedido envia al frame de facturacion el codigo del cliente
													 if (confirm('Marcar como FACTURADO el pedido '+ ajax2.responseText)){
																var ajax3=nuevoAjax();										// creo una instancia de ajax
																metodo="POST";												// asigno las variables de proceso
																url="marcar_pedido.php?";
																variables="id="+id;
																ajax3.open(metodo, url, true);
																ajax3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
																ajax3.send(variables);
																ajax3.onreadystatechange=function(){ 
																		if (ajax3.readyState==4){
																			if(ajax3.responseText == "OK"){
																				actualizar_lista_pedidos();
																			}else{
																				alert('ERROR: NO se pudo marcar como FACTURADO este pedido');
																			}
																		} // fin de if (ajax.readyState==4)
																} // fin de funcion()
													 } // end if (confirm('¿Marcar como FACTURADO todo este pedido?')){
											} // end if(ajax2.responseText > 0){ 
									} // fin de if (ajax2.readyState==4)
							} // fin de funcion()
						}
				} // fin de if (ajax.readyState==4)
		} // fin de funcion()
}

/*************************************************************************************************************/
var Page = new Object();
Page.width;
Page.height;
Page.top;

Page.loadOut = function ()
{
	document.getElementById('loadingbox').innerHTML ='';
}
Page.getPageCenterX = function ()
{
		var fWidth;
		var fHeight;
		//For old IE browsers
		if(document.all)
		{
		fWidth = document.body.clientWidth;
		fHeight = document.body.clientHeight;
		}
		//For DOM1 browsers
		else if(document.getElementById &&!document.all)
		{
		fWidth = innerWidth;
		fHeight = innerHeight;
		}
		else if(document.getElementById)
		{
		fWidth = innerWidth;
		fHeight = innerHeight;
		}
		//For Opera
		else if (is.op)
		{
		fWidth = innerWidth;
		fHeight = innerHeight;
		}
		//For old Netscape
		else if (document.layers)
		{
		fWidth = window.innerWidth;
		fHeight = window.innerHeight;
		}
	Page.width = fWidth-180;
	Page.height = fHeight-342;
	Page.top = window.document.body.scrollTop;
}

/********************************************************************************************************/

var K0=window;
var Q1=document;
//var A2=write;
//var O2=value;


function collpase(id,O2){
	Q1.getElementById(id).style.display="none";
	var str='symbol_'+id.replace(/_/g,'');
	if(Q1.getElementById(str)){
		var mainid=id.replace(/_/g,'');
		var symbolhref='<span id="symbol_'+mainid+'"><a href="javascript:expand(\''+id+'\','+O2+');" class="nodecls">'+UI.expand+'</a></span>';
		Q1.getElementById(str).innerHTML=symbolhref;
		}
}
function expand(id,O2){
	loadChild(id,O2);
	Q1.getElementById(id).style.display="block";
	var str='symbol_'+id.replace(/_/g,'');
	//alert(str.length );
	if(Q1.getElementById(str)){
		var mainid=id.replace(/_/g,'');
		var symbolhref='<span id="symbol_'+mainid+'"><a href="javascript:collpase(\''+id+'\','+O2+');" class="nodecls">'+UI.collapse+'</a></span>';
		Q1.getElementById(str).innerHTML=symbolhref;
		}
}
function loadChild(id,O2){
	var strParam="class_treeview/class_treeview.php?method=getCat&id="+id+"&catid="+O2; 
	Ajax.Request(strParam,generateChild);
}
function generateChild(){
	//Ajax.setShowMessage(1);
	//Ajax.setMessage("Cargando..");
	if(Ajax.CheckReadyState(Ajax.request)){
		var	response=eval('('+Ajax.request.responseText+')');
		var str='';
		var i=0;
		if(response.data.length==0){
			Q1.getElementById(response.id).style.display="none";
		}
		var mainid=response.id.replace(/_/g,'');
		for(i=0;i < response.data.length;i++){
			str+='<div id="'+mainid+''+i+'" style="padding-left:2px;">';  
			str+='<span id="symbol_'+mainid+''+i+'"><a href="javascript:expand(\''+response.id+'_'+i+'\','+response.data[i].id+');" class="nodecls">'+UI.expand+'</a></span>';
			str+='<a id='+response.data[i].id+' href="javascript:getData('+response.data[i].id+');" class="nodecls">'+response.data[i].name+'</a></div>';
			str+='<div id="'+response.id+'_'+i+'" style="padding-left:15px;display:none"></div>';
		}
		Q1.getElementById(response.id).innerHTML=str;
		}
}