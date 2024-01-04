<?php include_once "inc/codigo_inicializacion.php"; ?>
<?php comprobarProfesor($conexionBD)?>
<?php cabeceraPlantilla()?>

<div class="container-sm  px-0 alumnos-contenedor">
  <div class="col-lg-7 w-100 mx-0 bg-none">
    <div class="table-responsive">
      <table class="table table-fixed table-striped" style="margin-bottom: 0;">
        <thead>
              <tr class="alumnos-cabecera">
                  <th scope="col" class="col-4" >Nombre</th>
                  <th scope="col" class="col-2" >Login</th>
                  <th scope="col" class="col-6" > </th>
              </tr>
          <tbody>
<?php
foreach (getAlumnos($conexionBD,"") as $alumno) {
    echo'     <tr scope="row" id = "'.$alumno[0].'">
                <td class="col-4">'.$alumno[1].'</td>
                <td class="col-6">'.$alumno[2].'</td>
                <td class="col-2">
                    <img src="assets/editar.svg" height="20" >
                </td>
              </tr>';
  }
?>
          </tbody>
        </thead>
      </table>
    </div>
  </div>
</div>
<script src="js/editarAlumno.js">
</script>
<?php piePlantilla()?>
<?php include_once "inc/codigo_finalizacion.php"; ?>
