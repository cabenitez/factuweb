<?php
	include("../conexion.php");
	
	$action = $_POST['action'];
	
	switch($action) {
		case 'login':
			// Login.
			$username = stripslashes(trim($_POST['username']));
			$password = md5(stripslashes(trim($_POST['password'])));
			
			if(empty($username) || empty($password)) {
				// Stop, someone tried entering nothing into here.
				// Show an error.
				$loginMsg = 'ERROR: Debe ingresar su Usuario y Clave';
			} else {
				// The input seems to be ok, check it against the database.
				$checkDetails = mysql_query("SELECT cod_usuario FROM usuario WHERE usuario='$username' AND clave='$password' and utilidades = 'S' LIMIT 1");
				if($checkDetails) {
					if(mysql_num_rows($checkDetails) > 0) {
						setcookie('nodstrumCalendarV2', '1', time()+3600);	// Cookie will expire in 1 hour.
						// $loginMsg = '<span style="color: green">You are logged in<i>!</i></span>';
					} else {
						$loginMsg = 'USUARIO SIN PERMISOS...';
					}
				} else {
					$loginMsg = 'ERROR: Existe un error de Conexion';
				}
			}
			break;
		case 'logout':
			setcookie('nodstrumCalendarV2', '0', time()-3600000);
			header('location: index.php');
			break;
		case 'updatePassword':
			$pass1 = sha1($_POST['password1']);
			$pass2 = sha1($_POST['password2']);
			
			if($pass1 == $pass2) {
				$updatePassword = mysql_query("UPDATE user SET password='$pass1' WHERE username='admin' LIMIT 1", $coneccion);
				if($updatePassword) {
					$loginMsg = '<span style="color: green">Your password has been changed :)</span>';
				} else {
					$loginMsg = 'There was an error updating your password.';
				}
			} else {
				$loginMsg = 'Your passwords did not match, please try again.';
			}
			
			break;
		case 'updateColours':
			$dc = $_POST['dayColor'];
			$wc = $_POST['weekendColor'];
			$tc = $_POST['todayColor'];
			$ec = $_POST['eventColor'];
			$ic1 = $_POST['iteratorColor1'];
			$ic2 = $_POST['iteratorColor2'];
			
			$updateColours = mysql_query("UPDATE settings SET dayColor='$dc', weekendColor='$wc', todayColor='$tc', eventColor='$ec', iteratorColor1='$ic1', iteratorColor2='$ic2' WHERE id='1' LIMIT 1", $coneccion);
			
			if($updateColours) {
				$loginMsg = '<span style="color: green">Your colours have been updated :)</span>';
			} else {
				$loginMsg = 'There was a problem updating the colours';
			}
			
			break;
	}
	
	include('settings.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Calendario</title>
<!-- CSS -->
<link href="../../css/estilos.css" rel="stylesheet" type="text/css">

<script src="js/lib/prototype.js" type="text/javascript"></script>
<script src="js/src/scriptaculous.js" type="text/javascript"></script>

<style>
	/*body {
		font-family: Tahoma;
		font-size: 12px;
	}
	*/
	.calendarBox {
		position: relative;
		top: 35px;
		margin: 0 auto;
		padding: 5px;
		width: 254px;
		/*border: 1px solid #000;*/
		
		background-color:#eeeeee;  					/* #F0F0F0 #F9F8F8 #FAFAFA       RECOMENDADO --> #EEEEEE <--       #F3F1F1 gris clarito*/
	    border: 1px solid #b6c7e5; /*border color*/ 

	}

	.calendarFloat {
		float: left;
		width: 31px;
		height: 25px;
		margin: 1px 0px 0px 1px;
		padding: 1px;
		border: 1px solid #000;
	}
	a:link {
		text-decoration: none;
		color:#336AA2;
	}
	a:visited {
		text-decoration: none;
		color:#336AA2;
	}
	a:hover {
		text-decoration: none;
		color:#336AA2;
	}
	a:active {
		text-decoration: none;
		color:#336AA2;
	}

</style>

<script type="text/javascript">
	function highlightCalendarCell(element) {
		$(element).style.border = '1px solid #999999';
	}

	function resetCalendarCell(element) {
		$(element).style.border = '1px solid #000000';
	}
	
	function startCalendar(month, year) {
		new Ajax.Updater('calendarInternal', 'rpc.php', {method: 'post', postBody: 'action=startCalendar&month='+month+'&year='+year+''});
	}
	
	function showEventForm(day) {
		$('evtDay').value = day;
		$('evtMonth').value = $F('ccMonth');
		$('evtYear').value = $F('ccYear');
		
		displayEvents(day, $F('ccMonth'), $F('ccYear'));
		
		if(Element.visible('addEventForm')) {
			// do nothing.
		} else {
			Element.show('addEventForm');
		}
	}
	
	function displayEvents(day, month, year) {
		new Ajax.Updater('eventList', 'rpc.php', {method: 'post', postBody: 'action=listEvents&&d='+day+'&m='+month+'&y='+year+''});
		if(Element.visible('eventList')) {
			// do nothing, its already visble.
		} else {
			setTimeout("Element.show('eventList')", 300);
		}
	}
	
	function addEvent(day, month, year, body) {
		if(day && month && year && body) {
			// alert('Add Event\nDay: '+day+'\nMonth: '+month+'\nYear: '+year+'\nBody: '+body);
			new Ajax.Request('rpc.php', {method: 'post', postBody: 'action=addEvent&d='+day+'&m='+month+'&y='+year+'&body='+body+'', onSuccess: highlightEvent(day)});
			$('evtBody').value = '';
		} else {
			//alert('There was an unexpected script error.\nPlease ensure that you have not altered parts of it.');
		}
		
		// highlightEvent(day);
	} // addEvent.
	
	function highlightEvent(day) {
		Element.hide('addEventForm');
		$('calendarDay_'+day+'').style.background = '#<?= $eventColor ?>';
	}
	
	function showLoginBox() {
		Element.show('loginBox');
	}
	
	function showCP() {
		Element.show('cpBox');
	}
	
	function deleteEvent(eid) {
		confirmation = confirm('Está seguro de borrar este evento?');
		if(confirmation == true) {
			new Ajax.Request('rpc.php', {method: 'post', postBody: 'action=deleteEvent&eid='+eid+'', onSuccess: Element.hide('event_'+eid+'')});
		} else {
			// Do not delete it!.
		}
	}
</script>


</head>
<body leftmargin="0" topmargin="0"  marginheight="0" marginwidth="0">
<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="21" class="seccion" valign="top"><div align="left">Seccion: Calendario de Eventos<hr></div></td>
  </tr>
</table>


	<div id="calendar" class="calendarBox">
		<div id="calendarInternal">
			&nbsp;
		</div>
		<br style="clear: both;">
		<span id="LoginMessageBox" style="color: red; margin-top: 10px;"><?= $loginMsg; ?></span>
		<div id="eventList" style="display: none;"></div>
		<div style="display: none; margin-top: 10px;" id="addEventForm">
			<b>Nuevo Evento:</b>
			<br>
			Fecha: <input type="text" size="2" id="evtDay" disabled> <input type="text" size="2" id="evtMonth" disabled> <input type="text" size="4" id="evtYear" disabled>
			<br>
			<textarea id="evtBody" cols="28" rows="5"></textarea>
			<br>
			<input type="button" value="Agregar" class="botones" onClick="addEvent($F('evtDay'), $F('evtMonth'), $F('evtYear'), $F('evtBody'));">
			<a href="#" onClick="Element.hide('addEventForm');">Cerrar</a>
		</div>
		
		<div style="display: none; margin-top: 10px;" id="loginBox">
			<b>Iniciar Sesión:</b>
			<br>
			
			
			
			<form action="index.php" method="post">
			
			
			<table width="100%"  border="0" background="../imagenes/fondo_cuadrito.gif">
            <tr>
              <td>
			  <fieldset>
			  <table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#BFBFBF">
            <tr>
              <td width="18" height="-1" valign="top" class="LLL"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
              <td colspan="2" valign="top"><div id="mensaje" class="advertencia"></div></td>
              <td width="18" rowspan="5" valign="top"><span class="DDD"><img src="../imagenes/18.jpg" width="18" height="18" /></span></td>
            </tr>
            <tr>
              <td width="18" height="1" rowspan="2" valign="top" class="LLL">&nbsp;</td>
              <td valign="top"><div align="left">Usuario:<br>
			      </div></td>
			  <td valign="top">
			  	<input type="text" name="username" class="caja" size="20">  	    			      </td>
			  </tr>
            <tr>
              <td valign="top">Clave: </td>
              <td valign="top"> <input type="password" name="password" class="caja" size="20"></td>
            </tr>
            <tr>
              <td width="18" height="4" valign="top" class="LLL">&nbsp;</td>
              <td colspan="2" valign="bottom"><span class="TTT"><img src="../imagenes/18.jpg" width="5" height="5" />
              </span></td>
            </tr>
            <tr>
              <td width="18" height="9" valign="top" class="LLL">&nbsp;</td>
              <td colspan="2" valign="bottom"><div align="center">
			  	<input type="hidden" name="action" value="login">
                <input type="submit" value="Entrar" class="botones">
              </div></td>
            </tr>
        </table>
			 </fieldset>  
			  
			  </td>
            </tr>
          </table>
			<a href="#" onClick="Element.hide('loginBox');">Cerrar</a>
			</form>
			
			
			
			
			
			
			
			
			
			
			
			
			
		
<!-- 			<form action="index.php" method="post">
				Usuario: <input type="text" name="username" class="caja" size="20">
				<br>
				Clave: <input type="password" name="password" class="caja" size="20">
				<br>
				<input type="hidden" name="action" value="login">
				<input type="submit" value="Entrar">
				<a href="#" onClick="Element.hide('loginBox');">Cerrar</a>
			</form>
 -->		
		</div>
		
		<div style="display: none; margin-top: 10px;" id="cpBox">
<!-- 			
			<b>Panel de Control</b> <a href="#" onClick="Element.hide('cpBox');">Cerrar</a>
			<br><br>
			
			<b>Cambiar Colores</b>
			<br>
			<form action="index.php" method="post">
				Color del D&iacute;a: <input type="text" name="dayColor" size="6" maxlength="6" value="<?= $dayColor; ?>">
				<br>
				Weekend Colour: <input type="text" name="weekendColor" size="6" maxlength="6" value="<?= $weekendColor; ?>">
				<br>
				Today Colour: <input type="text" name="todayColor" size="6" maxlength="6" value="<?= $todayColor; ?>">
				<br>
				Event Colour: <input type="text" name="eventColor" size="6" maxlength="6" value="<?= $eventColor; ?>">
				<br>
				Iterator 1 Colour: <input type="text" name="iteratorColor1" size="6" maxlength="6" value="<?= $iteratorColor2; ?>">
				<br>
				Iterator 2 Colour: <input type="text" name="iteratorColor2" size="6" maxlength="6" value="<?= $iteratorColor1; ?>">
				<br>
				<input type="hidden" name="action" value="updateColours">
				<input type="submit" value="Update Colours">
			</form>
			
			<br>
			
			<form action="index.php" method="post">
				<input type="hidden" name="action" value="updatePassword">
				<b>Modificar Clave</b>
				<br>
				New Password: <input type="password" name="password1" size="20">
				<br>
				Confirm it: <input type="password" name="password2" size="20">
				<br>
				<input type="submit" value="Update Password">
			</form>

			<br><br>
 -->			
			
			<form action="index.php" method="post">
				<input type="hidden" name="action" value="logout">
				<b>Cerrar Sesi&oacute;n:</b> <input type="submit" class="botones" value="Salir">
			</form>
		</div>
		
	</div> <!-- FINAL DIV DO NOT REMOVE -->
	
	<script type="text/javascript">
		startCalendar(0,0);
	</script>

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
</body>
</html>