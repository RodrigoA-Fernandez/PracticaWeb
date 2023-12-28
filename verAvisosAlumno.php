<?php include_once "inc/codigo_inicializacion.php"; ?>
<?php
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
<div class="mensajes-contenedorMensajes">
  <nav class = "mensajes-cambioPagina Page navigation dflex">
    <ul class = "pagination justify-content-center">
      
    </ul>
  </nav>

<div class="mensajes-mensajes">

<?php 
$mensajes = getMensajesEstudiante($conexionBD, $_SESSION["usuario"]["username"],"", 0);

for ($i=0; $i < count($mensajes) ; $i++) { 
  $fecha = strtotime($mensajes[$i]["Fecha"]);
  $strFecha = date("d/m/Y",$fecha);
  if($mensajes[$i]["Leido"] == 0){
    echo '<div class="mensajes-msg mensajes-noLeido" id ='.$mensajes[$i]["Id"].'>';
  }else{
    echo '<div class="mensajes-msg" id ='.$mensajes[$i]["Id"].'>';
  }
  echo '<div class="mensajes-info">';
  echo '<div class="mensajes-autor">';
  echo $mensajes[$i]["Nombre"];
  echo '</div>';
  echo '<div class = "mensajes-fecha" >';
  echo $strFecha;
  echo '</div>';
  echo '</div>';
  if($mensajes[$i]["Leido"] == 0){
    echo '<hr class=" mensajes-solida"/>';
  }else{
    echo '<hr class="mensajes-solida"/>';
  }
  echo '<div class="mensajes-asunto">';
  echo $mensajes[$i]["Asunto"];
  echo '</div>';
  echo '<hr class = "mensajes-discontinua mensajes-ocultable mensajes-oculto">';
  echo '<div class = "mensajes-texto mensajes-ocultable mensajes-oculto">';
  echo $mensajes[$i]["Contenido"];
  echo '</div>';
  echo '</div>';

}

?>
</div>
</div>

<script src="js/clickMensaje.js">
</script>

<script src="js/paginacion.js">
</script>
<?php session_commit();?>
<?php piePlantilla()?>

<?php include_once "inc/codigo_finalizacion.php"; ?>
