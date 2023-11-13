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

</head>
<body>
	  <div class="navBar"> 
      <a class="logo" href="www.uva.es">
        <img src="../assets/logo.png" />
      </a>
	    <a href="indice-personas.php" class="activo">Avisos</a>
      <a href="#">Gestor Estudiantes</a>
      <div class=busqueda>
        <input>
      </div>
    </div>

  

<?php } ?>
    
    
<?php function piePlantilla() { ?>
 
	<div class="container pie"> <!-- Con HTML5 utilizar etiqueta FOOTER -->
		Información copyright
	</div>
	<script src="js/fichero-javascript-externo.js"></script> 
</body>
</html>
<?php } ?>


