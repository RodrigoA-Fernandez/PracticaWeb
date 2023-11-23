<?php include_once "../codigo_inicializacion.php"?>
<?php
  session_start();
  if(!isset($_SESSION['usuario'])){
    echo '
    <script>
      alert("Error: Sesión no iniciada.");
      window.location = "index.php";
    </script>
    ';
    exit();
  }
  if($_SESSION['usuario']['type'] !== "estudiante"){
    echo '
    <script>
      alert("Error: Página está limitada a estudiantes.");
      window.location = "verAvisosAlumno.php";
    </script>
    ';
    exit();
  }
?>
<?php
  $mensajes = getMensajesEstudiante($conexionBD, $_SESSION["usuario"]["username"],$_POST["filtro"], $_POST["pagina"]);

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
<?php include_once "../codigo_finalizacion.php"?>
