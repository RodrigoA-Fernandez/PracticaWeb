<?php include_once "../codigo_inicializacion.php"?>
<?php
  $alumnos = getNombresAlumnos($conexionBD);
  $alumno = comprobarEntrada($conexionBD,$_POST["alumno"]);
  $band = false; 
  foreach ($alumnos as $a) {
    if ($a[0] == $alumno) {
      $band = true;
      break;
    }
  }
  if ($band){
    echo "true";
  }else{
    echo "false";
  }
  exit(0);
?>
<?php include_once "../codigo_finalizacion.php.php"?>
