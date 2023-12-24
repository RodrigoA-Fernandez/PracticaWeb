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
  if(comprobarLogin($conexionBD,$_SESSION["usuario"]["username"],hash("md5",$_SESSION["usuario"]["contrasenia"])) != LOGIN_PROFESOR){
     echo '
    <script>
      alert("Se ha producido un error, vuelva a iniciar sesión.");
      window.location = "index.php";
    </script>
    ';
    exit();
  }
?>
<?php cabeceraPlantilla()?>


<script>
  const elementos = document.getElementsByClassName("enlace");
  var eliminar = [];
  for (var i = 0; i< elementos.length; i++){
    if (elementos[i].id === "enviarAvisos"){
      elementos[i].classList.add("activo");
    }else if(elementos[i].id === "avisosEstudiante"){
      elementos[i].remove();
      i--;
    }
  }
  
</script>
<?php piePlantilla()?>

<?php include_once "inc/codigo_finalizacion.php"; ?>
