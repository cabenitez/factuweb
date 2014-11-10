////////////////////////////////////////////////////////////////////////////////////////////////////
//	Paginación de resultados de consultas a MySql con PHP y AJAX								  //
//																								  //
//	Versión : 1.0.0	(29/04/2007) - Versión inicial												  //
//																								  //
//	Nombre de los archivos : paginador.php - js paginador.js									  //
//																								  //
//	Autor : Benitez Carlos Alberto	<labestia01@yahoo.com.ar>									  //	
//																								  //
//	Descripción :																				  //
//		Devuelve el resultado de una consulta sql por páginas, 									  //
//		así como los enlaces de navegación respectivos. Este script ha sido pensado				  //
//		con fines didácticos, por eso la gran cantidad de comentarios.							  //
//																								  //
//	Licencia : 												  									  //
//		GPL con las siguientes extensiones:														  //
// 			*Uselo con el fin personal o lucrativo												  //
//			*Si mejora el código o encuentra errores, envieme un mail							  //
//																								  //
//	Documentación y ejemplo de uso:		http://www.award-sistemas.com.ar						  //
////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------AJAX-----------------------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function nuevoAjax(){   
    var req;
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) { 					// para IE/Windows ActiveX 
        req = new ActiveXObject("Microsoft.XMLHTTP");
      }
    return req;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------------------PAGINACION----------------------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////
function paginar2(pag_origen,pag_consulta,pag_inicio,nombre){
	var divlistado=document.getElementById("listado_2"); 
	//divlistado.innerHTML= '<img src="../imagenes/cargando.gif">'; // width="30" height="30"
	var ajax=nuevoAjax();										  // creo una instancia de ajax
	metodo="POST";												  // asigno las variables de proceso
    url=pag_origen+"?";
	variables="pag_consulta_ajax="+pag_consulta+"&limit="+pag_inicio+"&nombre="+nombre;

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