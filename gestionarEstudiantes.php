<?php include_once "inc/codigo_inicializacion.php"; ?>
<?php comprobarProfesor($conexionBD)?>
<?php cabeceraPlantilla()?>

<!-- <div class="mensajes-contenedorMensajes container-fluid"> -->
<!--   <div class="alumnos-alumno row m-2"> -->
<!--     <div class="col-sm" style='font-family: Segoe UI Bold;'> -->
<!--       Nombre: -->
<!--     </div> -->
<!--     <div class="col-sm" style='font-family: "Segoe UI";'> -->
<!--       Nombre -->
<!--     </div> -->
<!--     <div class="col-sm" style='font-family: Segoe UI Bold;'> -->
<!--       Login: -->
<!--     </div> -->
<!--     <div class="col-sm" style='font-family: "Segoe UI";'> -->
<!--       login@uva.es -->
<!--     </div> -->
<!--   </div> -->
<!--    -->
<!-- </div> -->

<div class="container-md py-5">
  <div class="col-lg-7 mx-auto bg-white rounded shadow">
    <div class="table-responsive">
      <table class="table table-fixed">

      </table>
    </div>
  </div>
</div>

<?php piePlantilla()?>
<?php include_once "inc/codigo_finalizacion.php"; ?>
