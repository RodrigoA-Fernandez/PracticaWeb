<?php include_once "../codigo_inicializacion.php"; ?>
<?php
$id = htmlspecialchars($_POST["id"]); 
eliminarEstudiante($conexionBD, $_POST["id"]);
?>
<?php include_once "../codigo_finalizacion.php"; ?>
