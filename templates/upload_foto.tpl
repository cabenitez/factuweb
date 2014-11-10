{config_load file="conf.conf"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Adjuntar Foto de Atículo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- CSS -->
<link href="../css/estilos.css" rel="stylesheet" type="text/css">
<script>
//----------------------------------MOSTRAR IMAGEN --------------------------------------------------//
function mostrar(){                    
        if (document.frm.foto.value != "") {
                document.frm.imagen.src = document.frm.foto.value;
        }
}


</script>



</head>
<center>
<body leftmargin="0" topmargin="2"> <!-- onLoad="javascript: ponerFocoPrecio();"  onUnload="modificarPrecio(document.precio.codigo_prod.value,document.precio.txtprecio.value); " -->
<form id="frm"  name="frm">
	<table width="100%" height="100%"  border="0">
      <tr>
		<td height="21">
			<fieldset  style="width:90%; height:10%;">	
			 <input  name="foto"  id="foto"type="file" class="caja" onMouseOver ="mostrar()">
<!--
			
			<div  id="iframe">
             	<iframe src="upload.php" frameborder="0" height="40"  width="210" scrolling="no" style="margin-left: 0px; margin-right: 0px; margin-top: 0px; margin-bottom: 0px;"></iframe>
    		</div>
-->			
			<input name="codigo_prod" type="hidden" value="{$codigo}">
	    </fieldset></td>
      </tr>
      <tr>
        <td> <!-- <div id="images"></div>-->
		  <img src="../imagenes/sin_imagen.jpg" alt="Foto" name="imagen" width="120" height="120">

		</td>
      </tr>
      <tr>
        <td align="center" valign="middle" class="botones"><div  class="iconos"onClick="window.close();">[cerrar]</div> </td>
      </tr>
  </table>
</form>   
</body>
</center>
</html>
