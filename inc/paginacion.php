<?php include_once "codigo_inicializacion.php"?>
<?php
  session_start();
  $numPaginas = getPaginasMensajes($conexionBD,$_SESSION["usuario"]["username"], $_POST["filtro"]);
  echo '<button id = "primero">&laquo</button>';
  echo '<button id = "anterior"><</button>';
  $inicio = $_POST["pagActual"] - 4;
  $fin = $_POST["pagActual"] + 4;
  if($inicio < 0){
    $inicio = 0;   
  }
  if($fin > $numPaginas){
    $fin = $numPaginas;
  }
  for ($i=1; $i <= $fin; $i++) { 
    echo "<button id = ".$i.">".$i."</button>"; 
  }
  echo '<button id = "siguiente">></button>';
  echo '<button id = "ultimo">&raquo</button>';
?>
<?php include_once "codigo_finalizacion.php"?>
