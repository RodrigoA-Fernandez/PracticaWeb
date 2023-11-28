<?php include_once "inc/codigo_inicializacion.php"; ?>
<?php cabeceraPlantilla()?>
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
  if($_SESSION['usuario']['type'] !== "estudiante"){
    echo '
    <script>
      alert("Esta página está limitada a estudiantes.");
      window.location = "verAvisosAlumno.php";
    </script>
    ';
    exit();
  }
?>


<script>
$(".profesor").each(function(){
  $(this).remove();
});
$(".alumno").children("#contrasenia").addClass("nav-activo");
  
</script>
<?php piePlantilla()?>
<?php include_once "inc/codigo_finalizacion.php"; ?>
