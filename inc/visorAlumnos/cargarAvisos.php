<?php include_once "../codigo_inicializacion.php"?>
<?php
 comprobarEstudiante($conexionBD); 
?>
<?php
  $mensajes = getMensajesEstudiante($conexionBD, $_SESSION["usuario"]["username"],comprobarEntrada($conexionBD,$_POST["filtro"]), $_POST["pagina"]);

for ($i=0; $i < count($mensajes) ; $i++) { 
  $fecha = strtotime($mensajes[$i]["Fecha"]);
  $strFecha = date("d/m/Y",$fecha);
  if($mensajes[$i]["Leido"] == 0){
    echo '<div class="mensajes-msg mensajes-noLeido" id ='.$mensajes[$i]["Id"].'>';
  }else{
    echo '<div class="mensajes-msg" id ='.$mensajes[$i]["Id"].'>';
  }
  echo  '<div class="mensajes-info">';
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
<?php include_once "../codigo_finalizacion.php"?>
