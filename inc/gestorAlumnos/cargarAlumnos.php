<?php include_once "../codigo_inicializacion.php"; ?>
<?php
$filtro = htmlspecialchars($_POST["filtro"]);
foreach (getAlumnos($conexionBD,$filtro) as $alumno) {
    echo'     <tr scope="row"  id = "'.$alumno[0].'">
                <td class="col-4 nombre">'.$alumno[1].'</td>
                <td class="col-6 login">'.$alumno[2].'</td>
                <td class="col-2">
                    <img class="editar" src="assets/editar.svg" height="20" >
                </td>
              </tr>';
  }
exit(0);
?>
<?php include_once "../codigo_finalizacion.php"; ?>
