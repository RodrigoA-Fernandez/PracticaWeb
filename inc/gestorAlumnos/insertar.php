<?php include_once "../codigo_inicializacion.php"; ?>
<?php
$nombre = htmlspecialchars($_POST["nombre"]);
$login = htmlspecialchars($_POST["login"]);
$contra = randomPassword();

$return = array("contrasenia" => $contra);
if(!comprobarNombreAlumno($conexionBD, $nombre)){
  $return["success"] = false;
  $return["razon"] = "El nombre ya está presente en el sistema.";
  echo json_encode($return);
  exit(0);
}
if(!comprobarLoginAlumno($conexionBD, $login)){
  $return["success"] = false;
  $return["razon"] = "El login ya está presente en el sistema.";
  echo json_encode($return);
  exit(0);
}
$okFlag = nuevoEstudiante($conexionBD,$nombre,$contra,$login);
if($okFlag == OK){
  $return["success"] = true;
}else{
  $return["success"] = false;
  $return["razon"] = "Se ha producido un error en la base de datos.";
}

echo json_encode($return);
exit(0);

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
?>
<?php include_once "../codigo_finalizacion.php";?>
