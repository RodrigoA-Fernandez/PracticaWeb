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
	<link rel="stylesheet" href="css/plantilla.css">
	<link rel="stylesheet" href="css/mostrarMensajes.css">

</head>
  <body>
	  <div class="navBar"> 
      <a class="logo" href="www.uva.es">
        <img src="../assets/logo.png" />
      </a>
      <div class="container1">
        <a href="../verAvisosProfesor.php" class="enlace" id="avisosProfesor">
          <h1>Avisos</h1>
        </a>
        <a href="../verAvisosAlumno.php" class="enlace" id="avisosEstudiante">
          <h1>
            Avisos            
          </h1>
        </a>
        <a href="../enviarAvisos.php" class = "enlace" id="enviarAvisos">
          <h1>
            Enviar Avisos
          </h1>
        </a>
        <a href="../gestionarEstudiantes.php" class="enlace" id="gestorEstudiantes">
          <h1>
            Gestor Estudiantes
          </h1>
        </a>
      </div>
      <div class="container2">
        <div class="busqueda">
          <input>
          <img src="../assets/lupa.png">
        </div>
        <a class="salida" href="../index.php">
          <img class="salida" src="../assets/logout.png">
        </a>
      </div>
    </div>

  

<?php } ?>
    
    
<?php function piePlantilla() { ?>
 
	<div class="container pie"> <!-- Con HTML5 utilizar etiqueta FOOTER -->
		Información copyright
	</div>
</body>
</html>
<?php } ?>


