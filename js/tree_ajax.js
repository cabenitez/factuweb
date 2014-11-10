var Ajax = new Object();
Ajax.showMessage=1;
Ajax.Message='';
Ajax.Request = function(url, callbackMethod){
	Page.getPageCenterX();
	Ajax.request = Ajax.createRequestObject();
	Ajax.request.onreadystatechange = callbackMethod;
	Ajax.request.open("POST", url, true);
	Ajax.request.send(url);
}
Ajax.setMessage = function (message){
	Ajax.Message=message;
}
Ajax.setShowMessage = function (m){
	Ajax.showMessage=m;
}
Ajax.createRequestObject = function(){
	var obj;
	if(window.XMLHttpRequest)	{
		obj = new XMLHttpRequest();
	}else if(window.ActiveXObject)	{
		obj = new ActiveXObject("MSXML2.XMLHTTP");
	}
	return obj;
}
Ajax.CheckReadyState = function(obj){
	if ( Ajax.showMessage == 0 )	{
		document.getElementById('loadingbox').style.display = "none";
	}else{
		document.getElementById('loadingbox').style.display = "block";
	}	
	/*
	if(obj.readyState < 4) {
		document.getElementById('loadingbox').style.top = (Page.top + Page.height/2)-100;
		document.getElementById('loadingbox').style.left = Page.width/2-75;
		document.getElementById('loadingbox').style.position = "absolute";
		document.getElementById('loadingbox').innerHTML = '<table border=0 cellpadding=0 cellspacing=1 width=100 bgcolor="#000000"><tr><td align=center bgcolor="#ffffff" class=loading height="22px" style="font-family:verdana;font-size:12px">Loading..</td></tr></table>';
	}
	*/
	if( obj.readyState == 4 ){
		if(obj.status == 200){
			document.getElementById('loadingbox').innerHTML = "<table border=0 cellpadding=0 cellspacing=1 width=100 bgcolor=#000000><tr><td align=center class=loading bgcolor=#ffffff height='22px' style='font-family:verdana;font-size:12px'>"+Ajax.Message+"</td></tr></table>";
			setTimeout('Page.loadOut()',2200);
			return true;
		}else{
			document.getElementById('loadingbox').innerHTML = "HTTP " + obj.status;
		}
	}
	
}