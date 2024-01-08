<?php include_once "../codigo_inicializacion.php"?>
<?php 
echo (json_encode(getPaginasMensajes($conexionBD,$_SESSION["usuario"]["username"], htmlspecialchars($_POST["filtro"]))));
die;
?>
<?php include_once "../codigo_finalizacion.php"?>
