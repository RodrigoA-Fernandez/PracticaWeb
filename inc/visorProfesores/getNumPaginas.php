<?php include_once "../codigo_inicializacion.php"?>
<?php 
// echo $_POST["filtro"];
echo (json_encode(getPaginasMensajesProfesor($conexionBD,$_SESSION["usuario"]["username"], htmlspecialchars($_POST["filtro"]))));
die;
?>
<?php include_once "../codigo_finalizacion.php"?>
