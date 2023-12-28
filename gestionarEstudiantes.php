<?php include_once "inc/codigo_inicializacion.php"; ?>
<?php
  session_start();
  if(!isset($_SESSION['usuario'])){
    echo '
    <script>
      alert("Debe iniciar sesión para entrar a esta página.");
      window.location = "index.php";
    </script>
    ';
    exit();
  }
  if($_SESSION['usuario']['type'] !== "profesor"){
    echo '
    <script>
      alert("Esta página está limitada a profesores.");
      window.location = "verAvisosAlumno.php";
    </script>
    ';
    exit();
  }
?>
<?php cabeceraPlantilla()?>

<?php piePlantilla()?>

<?php include_once "inc/codigo_finalizacion.php"; ?>
