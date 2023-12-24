<?php include_once "codigo_inicializacion.php"; ?>

<?php
session_start();
// var_dump($_SERVER["REQUEST_METHOD"]);
if ( $_SERVER["REQUEST_METHOD"] == "POST") {
  if($_POST["nombreUsuario"] == NULL ||$_POST["contrasenia"] == NULL){
    header("Location: ../index.php?falloLogin=sinLogin");
    exit();
  }
  $login= (comprobarLogin($conexionBD,$_POST["nombreUsuario"], hash("md5",$_POST["contrasenia"]))); 
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
        "username" => $_POST["nombreUsuario"],
        "contrasenia" => $_POST["contrasenia"]
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
        "username" => $_POST["nombreUsuario"],
        "contrasenia" => $_POST["contrasenia"]
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
