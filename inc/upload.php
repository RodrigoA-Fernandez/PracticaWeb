<?php include_once "codigo_inicializacion.php"; ?>
<?php comprobarProfesor($conexionBD);?>
<?php
$dir_upload = "/var/www/midominio/uploads/";
$nom_fich_subido = $dir_upload . basename($_FILES["fichero"]["name"]);
if (!move_uploaded_file($_FILES["fichero"]["tmp_name"], $nom_fich_subido)) {
  header("Location: ../enviarAvisos.php?error=1");
  exit(0);
}

$archivo = fopen($nom_fich_subido,'r');
$band = true;
while ($aviso = fgetcsv($archivo)) {
  if(!comprobarNombreNia($conexionBD,htmlspecialchars($aviso[1]),htmlspecialchars($aviso[0]))){
    $band = false;
  }
  hacerAviso($conexionBD,htmlspecialchars($aviso[1]),htmlspecialchars($aviso[2]),htmlspecialchars($aviso[3]),$_SESSION["usuario"]["username"]);
}

if(!$band){
  header("Location: ../enviarAvisos.php?error=2");
}else{
  header("Location: ../enviarAvisos.php?error=0");
}
exit(0);
?>
<?php include_once "codigo_finalizacion.php"; ?>
