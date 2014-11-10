<?php
session_start ();
include("conexion.php");
if (isset($_SESSION["user_usuario"])){          // si ha iniciado sesion
	ini_set('display_errors','1'); 					  //Muestra los errores de php 
	?>
	  <link rel="stylesheet" href="menu/theme.css" type="text/css">
	  
	  <script type="text/javascript" language="JavaScript" src="menu/JSCookMenu.js"></script>
	  <script type="text/javascript" language="JavaScript" src="menu/theme.js"></script>
	  <script type="text/javascript" language="JavaScript" src="menu/items.js"></script>
	<?php
	require("smarty.php");  				// requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; 				//crea una instancia
	$smarty->display('principal2.tpl');   	//define la plantilla que utilizara
}else{										// si no ha iniciado sesion 
		?> 
		 <script type="text/javascript" language="javascript"> 
		       alert("ACCESO DENEGADO...");
		       window.location.href="index.php"; 
		 </script>
        <?php
}

?>