<?php include_once "inc/codigo_inicializacion.php"; ?>
<?php cabeceraPlantilla()?>
<?php
  session_start();
  if(!isset($_SESSION['usuario'])){
    echo '
    <script>
      alert("Debe iniciar sesión para entrar a esta página.");
      window.location = "index.php";
    </script>
    ';
    exit();
  }
  if($_SESSION['usuario']['type'] != "estudiante"){
    echo '
    <script>
      alert("Esta página está limitada a profesores.");
      window.location = "verAvisosAlumno.php";
    </script>
    ';
    exit();
  }
  if(comprobarLogin($conexionBD,$_SESSION["usuario"]["username"],hash("md5",$_SESSION["usuario"]["contrasenia"])) != LOGIN_ESTUDIANTE){
     echo '
    <script>
      alert("Se ha producido un error, vuelva a iniciar sesión.");
      window.location = "index.php";
    </script>
    ';
    exit();
  }
?>
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
