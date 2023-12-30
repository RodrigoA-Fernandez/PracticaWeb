<?php include_once "codigo_inicializacion.php"; ?>

<?php
session_start();
// var_dump($_SERVER["REQUEST_METHOD"]);
if ( $_SERVER["REQUEST_METHOD"] == "POST") {
  $nombreUsuario = htmlspecialchars($_POST["nombreUsuario"]);
  $contrasenia = htmlspecialchars($_POST["contrasenia"]);
  if($nombreUsuario == NULL ||$contrasenia == NULL){
    header("Location: ../index.php?falloLogin=sinLogin");
    exit();
  }
  $login= (comprobarLogin($conexionBD,$nombreUsuario, hash("md5",$contrasenia))); 
  switch ($login) {
    case LOGIN_INCORRECTO:
      header("Location: ../index.php?falloLogin=loginIncorrecto");
      session_destroy();
      exit();
      break;

    case LOGIN_ESTUDIANTE:
      $_SESSION['usuario'] = array(
        "id" => md5(uniqid(rand())),
        "type" => "estudiante",
        "username" => $nombreUsuario,
        "contrasenia" => $contrasenia
      ); 
      var_dump($_SESSION);
      session_write_close();
     header("Location: ../verAvisosAlumno.php");
      exit();
      break;

    case LOGIN_PROFESOR:
      $_SESSION['usuario'] = array(
        "id" => md5(uniqid(rand())),
        "type" => "profesor",
        "username" => $nombreUsuario,
        "contrasenia" => $contrasenia
      );
      var_dump($_SESSION);
      session_write_close();
      header("Location: ../enviarAvisos.php");
      exit();
      break; 
  }
} else {
  header("Location: ../index.php");
  log(BAD_REQUEST);
  exit();
}
?>  

<?php include_once "codigo_finalizacion.php"; ?>
