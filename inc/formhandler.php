<?php include_once "codigo_inicializacion.php"; ?>

<?php
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
      exit();
      break;
    
    default:
      echo("SUUUUUUUUUUUUUUU");
      break;
  }
} else {
  log(BAD_REQUEST);
}
?>  

<?php include_once "codigo_finalizacion.php"; ?>
