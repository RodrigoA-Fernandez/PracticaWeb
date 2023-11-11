<?php
	// Aquí se escribiría el código que se ejecutará al INICIO de cada script en PHP (código de inicialización)
    ob_start(); //Configuración procesador PHP: activa almacenamiento en buffer de la SALIDA de PHP
	
	//definición de constantes
	define("BAD_REQUEST", -2);
	define("CANCELAR", -1);
	define("OK", 0);
	define("ERROR_ALTA_PERSONA", 1);
	define("ERROR_MODIFICA_PERSONA", 2);
	define("ERROR_BORRADO_PERSONA", 3);
	define("NO_EXISTE_PERSONA", 4);
	
	//conexión con base de datos
	$host = "localhost";
	$usuario = "tweb";
	$password = "euldlm16";
	// Conectar con el servidor de bases de datos. Atención! la conexión es local
	$conexionBD = mysqli_connect($host, $usuario, $password) 
	  or die("No se pudo conectar a la base de datos");
	// Seleccionar la base de datos adecuada
	mysqli_select_db($conexionBD, "tweb");
	
	// ya se puede incluir el código de la plantilla y otros ...
	include "inc/plantilla.php";
	include "inc/codigo_funciones.php";
	include "inc/modelo-persona.php";
?>
