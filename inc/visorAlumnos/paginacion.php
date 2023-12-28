<?php include_once "../codigo_inicializacion.php"?>
<?php
  session_start();
  $paginasMostrar = $_POST["paginas"];
  $numPaginas = getPaginasMensajes($conexionBD,$_SESSION["usuario"]["username"], $_POST["filtro"]);
  echo '<li class = "page-item"><span id = "primero" class = "page-link">&laquo</span></li>';
  echo '<li class = "page-item"><span id = "anterior" class = "page-link"><</span></li>';

  $inicio = $_POST["pagActual"] - ($paginasMostrar - 2);
  $fin = $_POST["pagActual"] + ($paginasMostrar);
  if($inicio <= 1){
    $inicio = 1;   
  }else{
    echo '<li class = "page-item disabled"><span class = "page-link">...</span></li>';
  }
  if($fin >= $numPaginas){
    $fin = $numPaginas;
    $band = false;
  }else{
    $band = true;
  }
  for ($i=$inicio; $i <= $fin; $i++) { 
    if($_POST["pagActual"] == $i -1){
      echo '<li class = "page-item"><span id = "'.$i.'" class = "page-link numerico activo">'.$i.'</span></li>';
    }else{
      echo '<li class = "page-item"><span id = "'.$i.'" class = "page-link numerico">'.$i.'</span></li>';
    }
  }
  if($band){
    echo '<li class = "page-item disabled"><span class = "page-link">...</span></li>';
  }
  echo '<li class = "page-item"><span id = "siguiente" class = "page-link">></span></li>';
  echo '<li class = "page-item"><span id = "ultimo" class = "page-link">&raquo</span></li>';
?>
<?php include_once "../codigo_finalizacion.php"?>
