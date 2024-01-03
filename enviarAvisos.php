<?php include_once "inc/codigo_inicializacion.php"; ?>
<?php comprobarProfesor($conexionBD) ?>
<?php cabeceraPlantilla()?>


<form class="enviar-contenedor container-md mt-2 pt-2" name="enviar" method="post" action="inc/enviarAvisos/enviar.php" onsubmit="return comprobarMensaje()">
  <fieldset class="col-md mb-3 mr-3 ml-1">
    <!-- <label for="destinatario" class="form-label" style="font-family: 'Segoe UI Bold';">Destinatario</label> -->
    <input type="text" class="form-control shadow-none input-md" name="destinatario" id="destinatario" list="destinatarios" style="font-family: 'Segoe UI'" placeholder='"Todos" o Nombre y Apellidos del Alumno'>
    <datalist id = "destinatarios">
      <option value="Todos">
<?php
  foreach (getAlumnos($conexionBD) as &$alumno) {
    echo '<option value="'.$alumno["0"].'">'; 
  }
?>
    </datalist>
  </fieldset>
  <hr>
  <fieldset class="mb-3 mr-3 ml-1">
    <!-- <label for="destinatario" class="form-label" style="font-family: 'Segoe UI Bold';">Asunto</label> -->
    <input type="text" class="form-control shadow-none" name="asunto" id="asunto" style="font-family: 'Segoe UI'" placeholder='Asunto del aviso...' maxlength=30>
  </fieldset>
  <hr>
  <fieldset class="mb-3 mr-3 ml-1">
    <!-- <label for="aviso" class="form-label" style="font-family: 'Segoe UI Bold'">Contenido</label> -->
    <textarea class="form-control shadow-none" maxlength=150 name="aviso" id="aviso" style="font-family: 'Segoe UI'; resize: none;" rows="3" placeholder="Cuerpo del aviso..."></textarea>
  </fieldset>
  <button type="submit" class="boton mx-auto my-2 inline-block">Enviar</button>
</form>


<?php piePlantilla()?>

<script>
function comprobarMensaje(){

  let formulario = document.forms["enviar"];
  let destinatario = formulario["destinatario"].value;
  let asunto = formulario["asunto"].value;
  let aviso = formulario["aviso"].value;

  if ((destinatario === null || destinatario === "") || (asunto === null || asunto === "") || (aviso === null || aviso === "")){
    alert("Debe completar dodos los campos");
    return false;
  }

  let band;
  if (destinatario !== "Todos"){
    $.ajax({
      url: "inc/enviarAvisos/comprobarAlumno.php",
      type: "POST",
      data:{
        alumno: destinatario,
      },
      async: false,
    }).done(function(data){
          band = (data.trim() == "true");
        });
    if (!band){
      alert('El destinatario debe estar en el sistema o ser "Todos"');
      return false;
    }
  }
  return true;

}
</script>
<?php include_once "inc/codigo_finalizacion.php"; ?>
