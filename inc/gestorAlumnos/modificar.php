<?php include_once "../codigo_inicializacion.php"; ?>
<?php
$id = $_POST["id"];
$nombre = htmlspecialchars($_POST["nombre"]);
$login = htmlspecialchars($_POST["login"]);
// error_log("Valores:".$nombre.",".$login);
modificarAlumno($conexionBD,$id,$nombre,$login);

exit(0);
?>
<?php include_once "../codigo_finalizacion.php"; ?>
