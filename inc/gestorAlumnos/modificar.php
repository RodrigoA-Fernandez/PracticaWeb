<?php include_once "../codigo_inicializacion.php"; ?>
<?php
$id = $_POST["id"];
$nombre = comprobarEntrada($conexionBD,$_POST["nombre"]);
$login = comprobarEntrada($conexionBD,$_POST["login"]);
// error_log("Valores:".$nombre.",".$login);
modificarAlumno($conexionBD,$id,$nombre,$login);

exit(0);
?>
<?php include_once "../codigo_finalizacion.php"; ?>
