<? 
session_start();   								// Iniciar sesión

$usuario_mod = $_POST["usuario_mod"]; 							// toma la variable de la url q vino de ajax.js
$clave_mod = $_POST["clave_mod"]; 								// toma la variable de la url q vino de ajax.js

if($usuario_mod){
	include("conexion.php"); 
	$usr_activo = $_SESSION['user_usuario'];
	
	//d41d8cd98f00b204e9800998ecf8427e
	
	$consulta = "SELECT * FROM usuario where usuario = '$usuario_mod' and usuario <> '$usr_activo'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call modificar_datos_usuario('$usr_activo','$usuario_mod','$clave_mod')"; // llama al procedimiento almacecnado
		if($result = mysql_query($consulta)){        // hace la consulta
			/*
			// ================================= parametros de conexion con la db ====================================================
			$host="localhost";
			$db="mysql"; 
			$usuario="root";
			$clave="gmo285coreduo";
			// ================================= parametros de conexion con la db ====================================================
			$coneccion = mysql_connect($host, $usuario,$clave)or die ("No se puede conectar con el Servidor"); 
			mysql_select_db ($db,$coneccion)or die ("No se puede conectar con la Base de Datos");
			
			$consulta = "UPDATE user SET user='$usuario_mod'  , password=PASSWORD('$clave_mod') WHERE user='$usr_activo'; "; // consulta sql                  
			
			if($result == mysql_query($consulta)){;        // hace la consulta
				include ('logout.php');
			*/	
				echo "ok";
			/*
			}else{
				echo $consulta;
			}
			*/
		}else{
			echo "error" ;
		}	
	}else{
		echo "existe"; //ERROR: El Usuario ya existe
	}
}else{
	
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	$smarty->assign('usuario',$_SESSION['user_usuario']);  //asigna una cadena a la variable "nombre"
	//$smarty->assign('nombre',$_SESSION['nombre_usuario']);  //asigna una cadena a la variable "nombre"

	$smarty->display('modificar_datos_usuario.tpl');   //define la plantilla que utilizara
}
?>