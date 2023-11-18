<?php include_once "inc/codigo_inicializacion.php"; ?>

<?php cabeceraPlantilla()?>

<div class="mensajes">
  <div class = "msg">
    <div>Jose Ignacio Farrán</div>
    <div>17/11/23 18:52</div>
    <div>Asunto</div>
    <div>Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.</div>
  </div>
</div>

<script>
  const elementos = document.getElementsByClassName("enlace");
  for (var i = 0; i< elementos.length; i++){
    if (elementos[i].id === "avisosEstudiante"){
      elementos[i].classList.add("activo");
    } else{
      elementos[i].remove();
    }
  }
</script>
<script>
  document.head.innerHTML += '<link rel="stylesheet" href="./css/mostrarMensajes.css">'
</script>
<?php piePlantilla()?>

<?php include_once "inc/codigo_finalizacion.php"; ?>
