<?php include_once "../codigo_inicializacion.php"; ?>
<?php
  $id = $_POST["id"];
  $nombre = comprobarEntrada($conexionBD,$_POST["nombre"]);
  $login = comprobarEntrada($conexionBD,$_POST["login"]);
  echo '  <td class="col-4"><input class="alumnos-input" id="nombre" placeholder="'.$nombre.'"></input></td>
          <td class="col-6"><input class="alumnos-input" id="login" placeholder='.$login.'></input></td>
          <td class="col-2">
            <div class="d-flex justify-content-end">
              <img  class="check" src="assets/check.svg" size="20">
              <img  class="cancel" src="assets/cancel.svg" size="20">
            </div>
          </td>
        ';
  exit(0);
?>
<?php include_once "../codigo_finalizacion.php"; ?>
