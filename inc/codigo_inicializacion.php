
<?php
	// Aquí se escribiría el código que se ejecutará al INICIO de cada script en PHP (código de inicialización)
  ob_start(); //Configuración procesador PHP: activa almacenamiento en buffer de la SALIDA de PHP
	//definición de constantes
	define("BAD_REQUEST", -2);
	define("CANCELAR", -1);
	define("OK", 0);
	define("ERROR_ALTA_PERSONA", 1);
  define("ERROR_CONSULTA_PERSONA", 2);
	define("NO_EXISTE_PERSONA", 3);
  define("LOGIN_INCORRECTO",4);
  define("LOGIN_VACIO", 5);
  define("LOGIN_ESTUDIANTE", 6);
  define("LOGIN_PROFESOR",7);
  define("ERROR_CAMBIO_CONTRASENIA",8);
  define("CAMBIO_CONTRASENIA",9);
  define("ERROR_BAJA_PERSONA",10);
	
	//conexión con base de datos
	$host = "localhost";
	$usuario = "controlador";
	$password = "contr4Contro!ador";
	// Conectar con el servidor de bases de datos. Atención! la conexión es local
	$conexionBD = mysqli_connect($host, $usuario, $password) 
  or 
    die("No se pudo conectar a la base de datos");
  
	// Seleccionar la base de datos adecuada
	mysqli_select_db($conexionBD, "NotificadorAvisos");
	
  session_start();
	// ya se puede incluir el código de la plantilla y otros ...
  include "plantilla.php";
  include "funcionesBD.php";
  include "comprobarTipoUsuario.php";
  include "codigo_funciones.php";
?>


