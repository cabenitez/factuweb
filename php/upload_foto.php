<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Adjuntar foto de Atículo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- CSS -->
<link href="../css/estilos.css" rel="stylesheet" type="text/css">
<script>
//----------------------------------MOSTRAR IMAGEN --------------------------------------------------//
function mostrar(){                    
        if (document.frm.archivo.value != "") {
                document.frm.imagen.src = document.frm.archivo.value;
        }
}
//----------------------------------SUBIR IMAGEN ----------------------------------------------------//
function registrar_archivo(){
	if (document.frm.archivo.value != ""){
		   document.frm.valido.value="ok";                    //asigno OK al campo oculto
		   document.frm.submit();                             //el formulario se envia 
			
	}else{
		   document.frm.valido.value="cerrar";                    //asigno OK al campo oculto
		   document.frm.submit();                             //el formulario se envia 
	}
}
</script>
</head>
<center>
<body leftmargin="0" topmargin="2"> <!-- onLoad="javascript: ponerFocoPrecio();"  onUnload="modificarPrecio(document.precio.codigo_prod.value,document.precio.txtprecio.value); " -->
<?
// REQUISITO PARA QUE FUNCIONE EL MODULO: TENER UN SERVIDOR FTP DANDO PERMISO DE L/E EN LA CARPETA IMAGENES
// VER LA POSIBILIDAD DE TRABAJAR SIN UN SERVIDOR FTP PARA QUE SEA MAS FLEXIBLE Y MAS FACIL LA INSTALACION
$imagen = "../imagenes/sin_imagen.gif";
if ($valido=="ok" ){	
	include ("conexion.php");         // Incluiye biblioteca de funcion de conexion a bd
	include ("conexion_ftp.php");     // Incluiye biblioteca de funcion de conexion por ftp
	$error="falso";
	//----------------------------sube imagen------------------------------------------
	$nombre_archivo =  $_FILES['archivo']['name'];//datos del arhivo 
	$tipo_archivo =  $_FILES['archivo']['type'];
	$tamano_archivo =  $_FILES['archivo']['size'];
	//compruebo si las características del archivo son las que deseo       1000 = kb
	if ( $tamano_archivo > 900000 || !(strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")|| strpos($tipo_archivo, "bmp")|| strpos($tipo_archivo, "jpg"))) { 
			$error="verdadero"; 
	}else{ 
 			$nueva_carpeta= $codigo_prod;                         // defino el nombre de la nueva carpeta
			$mydir = ftp_chdir($id_con, "fotos_articulos/");      // Posicionarse en la carpeta nueva
			@$newdir = ftp_mkdir($id_con, $nueva_carpeta);        // Crear una carpeta
			@ftp_site($id_con, "CHMOD 0777 ".$newdir);            // Otorgo los permisos a la carpeta
			
			$lista = ftp_nlist ($id_con, "$nueva_carpeta/");	  // obtengo la cantidad de archivos en el dir
			$total = count ($lista);
			$i=0;
			while ($i < $total){								  // borro todos los archivos viejos antes de subir el nuevo
				$arch = substr($lista[$i], 0);
				ftp_delete($id_con, "$codigo_prod/$lista[$i]");
				$i++;
			}
			ftp_close($id_con);                                   // cierra la conexion FTP

			$uploaddir = "../imagenes/fotos_articulos/".$nueva_carpeta."/";
			$uploadfile = $uploaddir.$_FILES['archivo']['name'];
			if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
       				if (move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadfile)) {   // sube el archivo
           				chmod($uploadfile,0777);
       				}else{ 
 						echo "ERROR: Ocurrió algún problema al subir la Foto, No pudo guardarse!!"; 
       				} 
			}
	}
   	//Guarda en la base de datos   
	if ($error=="falso" ){
		$consulta= "call upload_foto_producto ($codigo_prod,'S')";
        $result = mysql_query($consulta);            // hace la consulta
		$imagen = "../imagenes/con_imagen.gif";

		//echo " <div class='advertencia'> Foto adjuntada con exito!! </div>";
    } 		
?>
	<script>
		window.close();
	</script>
<?
}
if ($valido=="cerrar" ){
?>
	<script>
		window.close();
	</script>
<?
}
?>
<!-- document.frm.lista_grupo.focus();      onUnload="modificarPrecio(document.precio.codigo_prod.value,document.precio.txtprecio.value); " -->
<form id="frm"  name="frm" action="upload_foto.php" method="post" enctype="multipart/form-data">
	<table width="100%" height="100%"  border="0">
      <tr>
		<td height="8">
			<fieldset  style="width:90%; height:10%;">	
				 <input  name="archivo"  type="file" class="caja" onMouseOver ="mostrar()">
				 <input name="codigo_prod" type="hidden" value= <? echo $codigo; ?> >
		     </fieldset>
		 </td>
      </tr>
      <tr>
        <td> <!-- <div id="images"></div>-->
		  <img src="<? echo $imagen ?>" alt="Tamaño máximo: 900 Kb, Extenciones: *.gif, *.jpeg, *.bmp, *.jpg" name="imagen" width="100" height="100">
		</td>
      </tr>
      <tr>
        <td align="center" valign="middle" class="botones">
				<input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: registrar_archivo()"  value="listo">
				<input type="hidden" name= "valido" >
	    </td>
      </tr>
  </table>
</form>   
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
</body>
</center>
</html>
