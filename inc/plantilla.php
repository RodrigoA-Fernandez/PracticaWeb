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
	<link rel="stylesheet" href="css/mostrarMensajes.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="css/plantilla.css">
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
        <li class="nav-item profesor">
          <a class="nav-link font" id="enviarAvisos" href="../enviarAvisos.php">Enviar Avisos</a>
        </li>
        <li class="nav-item active profesor">
          <a class="nav-link font" id="verAvisos" href="../verAvisosProfesor.php">Avisos</a>
        </li>
        <li class="nav-item active alumno">
          <a class="nav-link font" id="verAvisos" href="../verAvisosAlumno.php">Avisos</a>
        </li>
        <li class="nav-item alumno">
          <a class="nav-link font" id = "contrasenia" href="../contrasenia.php">Reestablecer Contraseña</a>
        </li>
        
        <li class="nav-item profesor">
          <a class="nav-link font" id = "gestorUsuarios" href="../gestionarEstudiantes.php">Gestor Usuarios</a>
        </li>

      </ul>
      
    </div>
      </div>
    </nav>

  

<?php } ?>
    
    
<?php function piePlantilla() { ?>
 
	<div class="container pie"> <!-- Con HTML5 utilizar etiqueta FOOTER -->
		Información copyright
	</div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
<?php } ?>


