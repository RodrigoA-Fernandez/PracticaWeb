<?php include_once "inc/codigo_inicializacion.php"; ?>

<?php define("TITULO_PAGINA", "Personas");?>

<?php // con esta invocación se genera el HTML que aparece al COMIENZO de todas las páginas (plantilla) ?>
<?php cabeceraPlantilla();?>

	<div class="container">
		<h1>Personas</h1>
		<div class="well"> <!-- clase BS para añadir un borde redondeado y relleno con color de fondo gris -->
			<h3>Nueva persona</h3>
 			<form action="controlador-persona.php" method="post" class="form-inline">
				<div><label for="fNombre">Nombre: </label></div>
				<div><input type="text" name="fNombre" id="fNombre" class="form-control"></div>

				<div><label for="fEmail">E-mail: </label></div>
				<div><input type="text" name="fEmail" id="fEmail" class="form-control"></div>
				
				<div><label for="fWebsite">Website: </label></div>
				<div><input type="text" name="fWebsite" id="fWebsite" class="form-control"></div>
				
				<div><label for="fComentario">Comentario: </label></div>
				<div><textarea name="fComentario" id="fComentario" rows="5" cols="40"></textarea></div>
				
				<div><label for="fSexo">Sexo: </label></div>
				<div>
					<input type="radio" name="fSexo" id="fSexo" value="M" class="form-control"> Mujer 
					<input type="radio" name="fSexo" id="fSexo" value="H" class="form-control"> Hombre 
				</div>
				
				<div>
					<input type="hidden" name="nuevaPersona" value="1" />
					<input type="submit" name="btnNuevaPersona" value="Nueva Persona" class="btn btn-primary"/>
				</div>
			</form>
		</div> <!-- /.ficha -->

		<div class="well">
			<h3>Personas registradas</h3>
			<?php
			/* Preparación consulta SELECT indice */
			$sentenciaSQL = "SELECT cId, cNombre, cEmail FROM Persona";
			//$resultado = mysqli_query($conexionBD, $sentenciaSQL);
			$resultado = getPersonas($conexionBD, $sentenciaSQL);
			//if (mysqli_num_rows($resultado) > 0) {
			if (count($resultado) > 0 ) { 
				// Encabezado tabla
				echo "<table class=\"table table-striped\">\n<tr>\n";
				echo "<th> Nombre </th><th> Email </th><th> Acciones </th>\n</tr>\n";
				// visualiza cada fila de la tabla
				//while($fila = mysqli_fetch_assoc($resultado)) {
				foreach ($resultado as $fila) { 
					echo "<tr>\n<td>{$fila["cNombre"]}</td>\n<td>{$fila["cEmail"]}</td>\n<td>\n<ul class=\"nav nav-pills\">\n<li><a href=\"modificar-persona.php?id={$fila["cId"]}\">modificar</a></li>\n<li><a href=\"controlador-persona.php?idABorrar={$fila["cId"]}\" onClick=\"return confirm('¿ Confirma borrado persona < {$fila["cNombre"]} ({$fila["cId"]}) > ?');\">borrar</a></li>\n</ul>\n</td>\n</tr>\n";
				}
				echo "</table>\n";
			} else {
				echo "<p>No hay personas registradas</p>";
			}
			?>
		</div>
		
		
	</div> <!-- /.contenido-principal -->

<?php // con esta invocación se genera el HTML que aparece al FINAL de todas las páginas (plantilla) ?>
<?php piePlantilla();?>
<?php include_once "inc/codigo_finalizacion.php"; ?>
