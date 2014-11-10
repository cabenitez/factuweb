<? 
session_start(); 


// Creo el XML **************************************************************************************************************************
header('Content-Type: text/xml'); 			// encabezado obligatorio XML
echo "<variables>\n"; 						// etiqueta superior
	echo '<src>' . $_SESSION["src"] . '</src>';   
	echo '<dest>' . $_SESSION["dest"] . '</dest>';  
echo "</variables>";
?>