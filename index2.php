<?php include_once "inc/codigo_inicializacion.php" ?>
<!-- Login prueba : raf2003, contra -->
<?php
$consulta= comprobarLogin($conexionBD, "raf2003", hash("md5","contra"));
switch ($consulta["COUNT(*)"]) {
  case 1:
    echo "Login Correcto";
    break;
  
  default:
    echo "Login Fallido";
    break;
}

?>
<?php include_once "inc/codigo_finalizacion.php" ?>
