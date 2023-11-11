<?php function cabeceraPlantilla() { ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"> 
	<!-- declaración codificación multilingüe. Atención! debe guardarse el archivo con la codificación declarada -->
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- proporciona información al navegador de cómo controlar las dimensiones de la página (ancho) y escalado -->
	
	<title><?php print constant('TITULO_PAGINA');?></title>
	<!--link rel="stylesheet" href="css/fichero-css-externo.css"--> 
	<!--Se sustituye una hoja de estilo externo por la carga de Bootstrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>
	
	<div class="container encabezado"> <!-- Con HTML5 utilizar etiqueta HEADER -->
		<h1>Contenido encabezado pagina [<?php print constant('TITULO_PAGINA');?>]</h1> 
	</div>

	<div class="container"> <!-- clase propia de Bootstrap: .container es un contenedor de ancho fijo adaptativo  -->
		<ul class="nav nav-pills">
			<li class="active"><a href="indice-personas.php">Personas</a></li>
			<li><a href="#">Enlace 2</a></li>
		</ul>
	</div>
	<?php include_once "inc/alertas.php"; ?>
<?php } ?>
<?php function piePlantilla() { ?>
 
	<div class="container pie"> <!-- Con HTML5 utilizar etiqueta FOOTER -->
		Informaicón copyright
	</div>
	<script src="js/fichero-javascript-externo.js"></script> 
</body>
</html>
<?php } ?>


