<?php include_once "../codigo_inicializacion.php"?>
<?php
session_start();
echo marcarLeido($conexionBD,$_POST["mensaje"], $_SESSION["usuario"]["username"]);
die;
?>
<?php include_once "../codigo_finalizacion.php"?>
