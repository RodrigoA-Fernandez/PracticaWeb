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
        </thead>
        <tbody id = "nuevoAlumno" style="border-right: solid var(--color-secundario) 10px;">
          <tr scope="row">
            <td class="col-4"><input class="alumnos-input" id="nombreNuevo" placeholder="Nuevo Nombre"></input></td>
            <td class="col-6"><input class="alumnos-input" id="loginNuevo" placeholder="Nuevo Login"></input></td>
            <td class="col-2">
              <div class="d-flex justify-content-end">
                <img  class="check" src="assets/check.svg" size="20">
                <img  class="cancel" src="assets/cancel.svg" size="20">
              </div>
            </td>
          </tr>
        </tbody>
        <tbody id="cuerpo-tabla">

        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="js/cargarAlumnos.js">
</script>

<script src="js/insertarAlumno.js">
</script>
<script>
$(function(){
  $(".eliminar").on("click", function(){
    let fila = $(this).parent().parent().parent();
    let nombre = fila.children(".nombre").text();
    if(confirm("¿Está seguro de eliminar el usuario "+nombre+"?")){
      $.post(
        "./inc/gestorAlumnos/eliminar.php",
        {
          id: fila.attr("id"),
        },
        function (){
          cargarAlumnos("");
          alert("Se ha eliminado el alumno " +nombre+"." );
        }
      );
    }
  });
});
</script>
<?php piePlantilla()?>
<?php include_once "inc/codigo_finalizacion.php"; ?>
