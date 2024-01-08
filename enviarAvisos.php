<?php include_once "inc/codigo_inicializacion.php"; ?>
<?php comprobarProfesor($conexionBD) ?>
<?php cabeceraPlantilla()?>


<form class="enviar-contenedor container-md my-5 pt-2 min-vh-50" name="enviar" method="post" action="inc/enviarAvisos/enviar.php" onsubmit="return comprobarMensaje()">
  <fieldset class="col-md mb-3 mr-3 ml-1">
    <!-- <label for="destinatario" class="form-label" style="font-family: 'Segoe UI Bold';">Destinatario</label> -->
    <input type="text" class="form-control shadow-none input-md" name="destinatario" id="destinatario" list="destinatarios" style="font-family: 'Segoe UI'" placeholder='"Todos" o Nombre y Apellidos del Alumno'>
    <datalist id = "destinatarios">
      <option value="Todos">
<?php
  foreach (getNombresAlumnos($conexionBD) as &$alumno) {
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


<form class="enviar-contenedor container-md my-5  min-vh-50 text-center" enctype="multipart/form-data"  action="./inc/upload.php" method="POST" style="max-width: 300px;">
  <div class="w-100" style="background-color: var(--color-secundario); font-family: 'Segoe UI Bold'; color: white; text-align: center;">
    Subir fichero
  </div>
  <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
  <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
  <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
  <div>
    <label class="boton mx-auto my-2" style="max-width: 150px;" for="subir" class="mt-2" style="font-family: 'Segoe UI';">
      Elegir archivo
   </label>
  </div>
  <input id="subir" type="file" name="fichero" style="display: none;"/>
  <button class="boton my-2 mx-auto" value="Subir fichero" type="submit">
    Subir Archivo
  </button>
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
<script>
$(function(){
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const error = urlParams.get('error');
  if(error == 0){
    alert("Avisos enviados");
  }else if (error == 1){
    alert("Error al leer el archivo.");
  }else if (error == 2){
    alert("Han habido avisos que no se han podido enviar.");
  }
});
</script>
<?php include_once "inc/codigo_finalizacion.php"; ?>
