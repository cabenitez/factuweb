<?php
session_start ();
include("conexion.php");
//include("restar_horas.php");


//$horaini = $_SESSION["hora_entrada"];
//$horafin = date(h.':'.i.':'.s);
//$tiempo_sesion = RestarHoras($horaini,$horafin);  // llama a la funcion de restar_horas.php que obtiene el tiempo que duró la session

			
//$consulta_audit = "INSERT INTO auditoria VALUES('-','-','-','TIEMPO: $tiempo_sesion','$fecha_hora','$usuario@localhost','LOGOUT')";  // consulta sql 
//if($result_audit = mysql_query($consulta_audit)){            								// hace la consulta
	if (isset($_SESSION["usr_usuario"])){
		  session_unset();
		  //$_SESSION = array();
	      session_destroy ();  //destruye la sesion		  
	}
//}

?>
<script>
   window.location.href="/";   // redireccion
</script>
