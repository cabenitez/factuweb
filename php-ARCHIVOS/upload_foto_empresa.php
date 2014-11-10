<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Adjuntar Logo de Empresa</title>
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
function mostrar2(){                    
        if (document.frm.archivo2.value != "") {
                document.frm.imagen2.src = document.frm.archivo2.value;
        }
}
//----------------------------------SUBIR IMAGEN ----------------------------------------------------//
function registrar_archivo(){
	if (document.frm.archivo.value != "" || document.frm.archivo2.value != ""){
		 document.frm.valido.value="ok";                    //asigno OK al campo oculto
		 document.frm.submit();                             //el formulario se envia 
	}else{
		 if (document.frm.archivo.value == "" && document.frm.archivo2.value == ""){  
		   		document.frm.valido.value="cerrar";                    //asigno OK al campo oculto
		   		document.frm.submit();                             //el formulario se envia 
		}   
	}
}
</script>
</head>
<center>
<body leftmargin="0" topmargin="2"> <!-- onLoad="javascript: ponerFocoPrecio();"  onUnload="modificarPrecio(document.precio.codigo_prod.value,document.precio.txtprecio.value); " -->
<?
// REQUISITO PARA QUE FUNCIONE EL MODULO: TENER UN SERVIDOR FTP DANDO PERMISO DE L/E EN LA CARPETA IMAGENES
$imagen = "../imagenes/sin_imagen.gif";
if ($valido=="ok" ){	
	include ("conexion.php");         
//----------------------------sube imagen para el LOGO------------------------------------------
//-----------------------------------------------------------------------------------------------//
					include ("conexion_ftp.php");     // Incluiye biblioteca de funcion de conexion por ftp
					$error="falso";
					$nombre_archivo =  $_FILES['archivo']['name'];//datos del arhivo 
					$tipo_archivo =  $_FILES['archivo']['type'];
					$tamano_archivo =  $_FILES['archivo']['size'];
					//compruebo si las características del archivo son las que deseo       1000 = kb
					if ( $tamano_archivo > 900000 || !(strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")|| strpos($tipo_archivo, "bmp")|| strpos($tipo_archivo, "jpg"))) { 
							$error="verdadero"; 
					}else{ 
							$lista = ftp_nlist ($id_con, "sistema_logo/");	  // obtengo la cantidad de archivos en el dir
							$total = count ($lista);
							$i=0;
							$mydir = ftp_chdir($id_con, "sistema_logo/");      // Posicionarse en la carpeta nueva
							while ($i < $total){								  // borro todos los archivos viejos antes de subir el nuevo
								$arch = substr($lista[$i], 0);
								ftp_delete($id_con, "$arch");
								$i++;
							}
							$uploaddir = "../imagenes/sistema_logo/";
							$uploadfile = $uploaddir.$_FILES['archivo']['name'];
							if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
									if (move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadfile)) {   // sube el archivo
										chmod($uploadfile,0777);
									}else{ 
										echo "ERROR: Ocurrió algún problema al subir el Logo, No pudo guardarse!!"; 
									} 
							}
					}
					//Guarda en la base de datos   
					if ($error=="falso" ){
						$consulta= "call upload_logo_empresa ('S')";
						$result = mysql_query($consulta);            // hace la consulta
					}
					ftp_close($id_con);
//-----------------------------------------------------------------------------------------------//					
//----------------------------sube imagen para el Fondo------------------------------------------//
					include ("conexion_ftp.php");     // Incluiye biblioteca de funcion de conexion por ftp
					$error="falso";
					$nombre_archivo =  $_FILES['archivo2']['name'];//datos del arhivo 
					$tipo_archivo =  $_FILES['archivo2']['type'];
					$tamano_archivo =  $_FILES['archivo2']['size'];
					//compruebo si las características del archivo son las que deseo       1000 = kb
					if ( $tamano_archivo > 900000 || !(strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")|| strpos($tipo_archivo, "bmp")|| strpos($tipo_archivo, "jpg"))) { 
							$error="verdadero"; 
					}else{ 
							$lista = ftp_nlist ($id_con, "sistema_fondo/");	  // obtengo la cantidad de archivos en el dir
							$total = count ($lista);
							$i=0;
							
							$mydir = ftp_chdir($id_con, "sistema_fondo/");      // Posicionarse en la carpeta nueva
							while ($i < $total){								  // borro todos los archivos viejos antes de subir el nuevo
								$arch = substr($lista[$i], 0);
								ftp_delete($id_con, "$arch");
								$i++;
							}
							$uploaddir = "../imagenes/sistema_fondo/";
							$uploadfile = $uploaddir.$_FILES['archivo2']['name'];
							if (is_uploaded_file($_FILES['archivo2']['tmp_name'])) {
									if (move_uploaded_file($_FILES['archivo2']['tmp_name'], $uploadfile)) {   // sube el archivo
										chmod($uploadfile,0777);
									}else{ 
										echo "ERROR: Ocurrió algún problema al subir el Fondo, No pudo guardarse!!"; 
									} 
							}
					}
					//Guarda en la base de datos   
					if ($error=="falso" ){
						$consulta= "call upload_fondo_empresa ('S')";
						$result = mysql_query($consulta);            // hace la consulta
						
					}
					ftp_close($id_con);
					
?>
	<script>
		window.close();
	</script>
<?
}
if ($valido=="cerrar" ){ ?>
	<script>
		window.close();
	</script>
						<?
}
?>
<form id="frm"  name="frm" action="upload_foto_empresa.php" method="post" enctype="multipart/form-data">
	<table width="100%" height="46%"  border="0">
		  <tr align="left" valign="bottom">
			<td width="20%" height="2" >Logo:&nbsp;</td>
			<td height="2" colspan="2" ><input  name="archivo"  type="file" class="caja" onMouseOver ="mostrar()"></td>
		  </tr>
		  <tr align="left" valign="bottom">
			<td height="2">Fondo: &nbsp;</td>
			<td height="2" colspan="2"><input  name="archivo2"  type="file" class="caja" onMouseOver ="mostrar2()"></td>
      	  </tr>
      <tr>
        <td height="50%" colspan="2"><div align="center"><img src="<? echo $imagen ?>" alt="Logo: Tamaño máximo: 900 Kb, Extenciones: gif, jpeg, bmp, jpg." name="imagen" width="100" height="100"></div></td>
        <td width="50%"><div align="center"><img src="<? echo $imagen ?>" alt="Fondo: Tamaño máximo: 900 Kb, Extenciones: gif, jpeg, bmp, jpg." name="imagen2" width="100" height="100"></div></td>
      </tr>
      <tr>
        <td height="50%"  align="center"colspan="2">Logo</td>
        <td height="50%" align="center">Fondo</td>
      </tr>
      <tr>
        <td colspan="3" align="center" valign="middle" class="botones">
				<input name="enviar" type="button" class="botones" id="enviar" onclick="javascript: registrar_archivo()"  value="listo">
				<input type="hidden" name= "valido" >
	    </td>
      </tr>
  </table>
</form>   
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
</body>
</center>
</html>
