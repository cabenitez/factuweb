<?php
/*
// Realiza el Backup de las bases de datos
$bdd = "--all-databases";
$opt = "";
 
$backupFile = date("Y-m-d-H-i-s") . '.gz';
$command = "mysqldump --opt $opt $bdd | gzip > $backupFile";
 
exec($command, $salida);
  
// Mantiene los ultimos 3 backups
$days=3;
$archivos = scandir("./");  
foreach ($archivos as $key => $val){
	if(substr($val,-2) != "gz")
 	unset($archivos[$key]);
}

 $i=count($archivos);
foreach ($archivos as $key => $val){
    if($i<=$days)
		 break;
	unlink($val);
	$i--;
 }
 */
if (ValidarUrl("www.lawebdeadsdlprogramador.com"))
 echo "Dirección existente";
else
 echo "Dirección inexistente";


function ValidarUrl($url) {
 //fsockopen -> Abrir una conexión de sockets de dominio de Internet o Unix
 //resource fsockopen ( string destino, int puerto [, int errno [, string errstr [, float tiempo_espera]]])
 $validar = @fsockopen($url, 80, $errno, $errstr, 15);
 if ($validar) {
  fclose($validar);
  return true;
 }else
  return false;
}
?>
