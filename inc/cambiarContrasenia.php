<?php include_once "codigo_inicializacion.php"; ?>
<?php
session_start();
if ( $_SERVER["REQUEST_METHOD"] == "POST") {
  $contraseniaPost = htmlspecialchars($_POST["contrasenia"]);
  $nuevaContraseniaPost = htmlspecialchars($_POST["nuevaContrasenia"]);
  $login= (comprobarLogin($conexionBD,$_SESSION["usuario"]["username"], hash("md5",$contraseniaPost))); 
  if($login != LOGIN_ESTUDIANTE){
    echo json_encode(array("cambio" => false, "causa" => "Contraseña antigua incorrecta"));
    exit();
  }else{
    cambiarContrasenia($conexionBD,$_SESSION["usuario"]["username"], $nuevaContraseniaPost);
    $_SESSION["usuario"]["contrasenia"] = $nuevaContraseniaPost;
    echo json_encode(array("cambio" => true));
    exit();
  }
} else {
  header("Location: ../index.php");
  log(BAD_REQUEST);
  exit();
}
?>
<?php
  
?>

<?php include_once "codigo_finalizacion.php"; ?>
