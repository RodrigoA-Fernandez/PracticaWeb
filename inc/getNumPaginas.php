<?php include_once "codigo_inicializacion.php"?>

<?php 
echo (getPaginasMensajes($conexionBD,$_SESSION["usuario"]["username"], $_POST["filtro"]));
die;
?>

<?php include_once "codigo_finalizacion.php"?>
