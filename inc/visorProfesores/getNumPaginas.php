<?php include_once "../codigo_inicializacion.php"?>
<?php 
// echo $_POST["filtro"];
echo (json_encode(getPaginasMensajesProfesor($conexionBD,$_SESSION["usuario"]["username"], "")));
die;
?>
<?php include_once "../codigo_finalizacion.php"?>
