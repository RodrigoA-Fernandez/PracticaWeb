<?php include_once "../codigo_inicializacion.php"; ?>
<?php
$filtro = comprobarEntrada($conexionBD,$_POST["filtro"]);
foreach (getAlumnos($conexionBD,$filtro) as $alumno) {
    echo'     <tr scope="row"  id = "'.$alumno[0].'">
                <td class="col-4 nombre">'.$alumno[1].'</td>
                <td class="col-6 login">'.$alumno[2].'</td>
                <td class="col-2">
                  <div class="d-flex justify-content-end">
                    <img class="editar" src="assets/editar.svg" height="20" >
                    <img class="eliminar" src="assets/delete.svg" height="20" >
                  </div>
                </td>
              </tr>';
  }
exit(0);
?>
<?php include_once "../codigo_finalizacion.php"; ?>
