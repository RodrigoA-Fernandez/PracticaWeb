
<?php 
const TITULO_PAGINA = "Gestor de Avisos UVa";
?>
<?php function cabeceraPlantilla() { ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"> 
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title><?php print constant('TITULO_PAGINA');?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="css/estilos.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js">
  </script>

</head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light nav-bg ">
      <a class="navbar-brand logo" href="https://www.uva.es">
        <img src="../assets/logo.png" >
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          
<?php
          if ($_SESSION["usuario"]["type"] == "profesor") {
          echo'  
            <li class="nav-item profesor"> 
            <a class="nav-link font ';
          if($_SERVER["REQUEST_URI"] == "/enviarAvisos.php"){
            echo "nav-activo";
          }
          echo'" id="enviarAvisos" href="../enviarAvisos.php">Enviar Avisos</a>
            </li>
            <li class="nav-item active profesor">
          <a class="nav-link font '; 
          if($_SERVER["REQUEST_URI"] == "/verAvisosProfesor.php"){
            echo "nav-activo";
          }
          echo'" id="verAvisos" href="../verAvisosProfesor.php">Avisos</a>
            </li>
            <li class="nav-item profesor">
            <a class="nav-link font ';
          if($_SERVER["REQUEST_URI"] == "/gestionarEstudiantes.php"){
            echo "nav-activo";
          }
          echo'" id = "gestorUsuarios" href="../gestionarEstudiantes.php">Gestor Usuarios</a>
          </li>
          ';
          }else if ($_SESSION["usuario"]["type"] == "estudiante"){
            echo '
              <li class="nav-item active alumno">
          <a class="nav-link font '; 
          if($_SERVER["REQUEST_URI"] == "/verAvisosAlumno.php"){
            echo "nav-activo";
          }
          echo'"id="verAvisos" href="../verAvisosAlumno.php">Avisos</a>
              </li>
              <li class="nav-item alumno">
          <a class="nav-link font ';
          if($_SERVER["REQUEST_URI"] == "/contrasenia.php"){
            echo "nav-activo";
          }
          echo'" id = "contrasenia" href="../contrasenia.php">Reestablecer Contraseña</a>
              </li>
          ';
          }
          ?>
          
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item" id="salir">
            <a class="nav-link font">
              <img style="width: 30px; height: auto;" src="./assets/salida.svg" size="20">
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="contenido min-vh-100">

  

<?php } ?>
    
    
<?php function piePlantilla() { ?>
  </div>
    <footer class=" pie p-0" style="font-family: 'Segoe UI Bold'; color: white; text-align: center;">
      Práctica hecha por Rodrigo Alejandro Fernández Vilorio
	</footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script>
    $(function(){
      $("#salir").on("click",function(){
        window.location.replace("index.php");
      });
    })
    </script>
</body>
</html>
<?php } ?>
