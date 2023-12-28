<?php include_once "inc/codigo_inicializacion.php"; ?>
<?php cabeceraPlantilla()?>
<?php comprobarEstudiante($conexionBD)?>
<div class = "contrasenias-formulario" >
  <h1>Anterior Contraseña</h1>
  <div class="contrasenias-contenedorInput">
    <input id = "antigua" type = "password"></input>
  </div>
  <h1 style="margin-top: 20px;" >Nueva Contraseña</h1>
  <div class="contrasenias-contenedorInput">
    <input id = "nueva" type = "password"></input>
  </div>
  <h1 style="margin-top: 20px;" >Repita la Nueva Contraseña</h1>
  <div class="contrasenias-contenedorInput">
    <input id = "comprobarNueva" type = "password"></input>
  </div>
  <div>
    <button id = "enviar" >Enviar</button>
  </div>
  <div class="mensajeError" style="display: none;">
    <p>
      
    </p>
  </div>
  <div class="mensajeCambio" style="display: none;">
          <p>
            Contraseña cambiada.
          </p>
  </div>
</div>





<script src="./js/cambiarContrasenia.js">
</script>

<?php piePlantilla()?>
<?php include_once "inc/codigo_finalizacion.php"; ?>
