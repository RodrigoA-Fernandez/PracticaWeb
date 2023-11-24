<?php include_once "../codigo_inicializacion.php"?>
<?php 
session_start();
// echo $_POST["filtro"];
echo (json_encode(getPaginasMensajes($conexionBD,$_SESSION["usuario"]["username"], $_POST["filtro"])));
die;
?>
<?php include_once "../codigo_finalizacion.php"?>
