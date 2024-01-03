<?php include_once "../codigo_inicializacion.php"?>
<?php
 comprobarProfesor($conexionBD); 
?>
<?php
  $mensajes = getMensajesProfesor($conexionBD, $_SESSION["usuario"]["username"],$_POST["filtro"], $_POST["pagina"]);

echo "<script>console.log(";
echo json_encode($mensajes);
echo ")</script>";
for ($i=0; $i < count($mensajes) ; $i++) { 
  $fecha = strtotime($mensajes[$i][2]);
  $strFecha = date("d/m/Y",$fecha);
  echo '<div class="mensajes-msg mensajes-Leido" id ='.$i.'>';
  echo  '<div class="mensajes-info">';
  echo '<div class="mensajes-autor">';
  echo $mensajes[$i][3];
  echo '</div>';
  echo '<div class = "mensajes-fecha" >';
  echo $strFecha;
  echo '</div>';
  echo '</div>';
  echo '<hr class="mensajes-solida"/>';
  echo '<div class="mensajes-asunto">';
  echo $mensajes[$i][0];
  echo '</div>';
  echo '<hr class = "mensajes-discontinua mensajes-ocultable mensajes-oculto">';
  echo '<div class = "mensajes-texto mensajes-ocultable mensajes-oculto">';
  echo $mensajes[$i][1];
  echo '</div>';
  echo '</div>';

}

?>
<?php include_once "../codigo_finalizacion.php"?>
