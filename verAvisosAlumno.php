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
<?php cabeceraPlantilla()?>


<div class="mensajes">
<?php 
$mensajes = getMensajesEstudiante($conexionBD, $_SESSION["usuario"]["username"], 0);

for ($i=0; $i < count($mensajes) ; $i++) { 
  $fecha = strtotime($mensajes[$i]["Fecha"]);
  $strFecha = date("d/m/Y",$fecha);
  if($mensajes[$i]["Leido"] == 0){
    echo '<div class="msg noLeido" id ='.$mensajes[$i]["Id"].'>';
  }else{
    echo '<div class="msg" id ='.$mensajes[$i]["Id"].'>';
  }
  echo  '<div class="info">';
  echo '<div class="autor">';
  echo $mensajes[$i]["Nombre"];
  echo '</div>';
  echo '<div class = "fecha" >';
  echo $strFecha;
  echo '</div>';
  echo '</div>';
  if($mensajes[$i]["Leido"] == 0){
    echo '<hr class=" solida"/>';
  }else{
    echo '<hr class="solida"/>';
  }
  echo '<div class="asunto">';
  echo $mensajes[$i]["Asunto"];
  echo '</div>';
  echo '<hr class = "discontinua ocultable oculto">';
  echo '<div class = "texto ocultable oculto">';
  echo $mensajes[$i]["Contenido"];
  echo '</div>';
  echo '</div>';

}

?>
</div>

<script>
  const elementos = document.getElementsByClassName("enlace");
  for (var i = 0; i< elementos.length; i++){
    if (elementos[i].id === "avisosEstudiante"){
      elementos[i].classList.add("activo");
    } else{
      elementos[i].remove();
      i--;
    }
  }
</script>

<script src="js/clickMensaje.js">

</script>
 
<?php piePlantilla()?>

<?php include_once "inc/codigo_finalizacion.php"; ?>
