<?php include_once "inc/codigo_inicializacion.php"; ?>

<?php define("TITULO_PAGINA", "Modificar persona");?>

<?php // con esta invocación se genera el HTML que aparece al COMIENZO de todas las páginas (plantilla) ?>
<?php cabeceraPlantilla();?>
<?php $id=intval(comprobar_entrada($_GET["id"]));
 $fila=getPersona($conexionBD,$id);?>
	
	<div class="container">
		<h1>Personas</h1>
		<div class="well"> <!-- clase BS para añadir un borde redondeado y relleno con color de fondo gris -->
			<h3>Modificar persona</h3>
 			<form action="controlador-persona.php" method="post" class="form-inline">
				<div><label for="fNombre">Nombre: </label></div>
				<div><input type="text" name="fNombre" value="<?php echo $fila["cNombre"];?>" id="fNombre" class="form-control"></div>

				<div><label for="fEmail">E-mail: </label></div>
				<div><input type="text" name="fEmail" value="<?php echo $fila["cEmail"];?>" id="fEmail" class="form-control"></div>
				
				<div><label for="fWebsite">Website: </label></div>
				<div><input type="text" name="fWebsite" value="<?php echo $fila["cWebsite"];?>" id="fWebsite" class="form-control"></div>
				
				<div><label for="fComentario">Comentario: </label></div>
				<div><textarea name="fComentario" id="fComentario" rows="5" cols="40"><?php echo $fila["cComentario"];?></textarea></div>
				
				<div><label for="fSexo">Sexo: </label></div>
				<div>
					<input type="radio" name="fSexo" <?php if (isset($fila["cSexo"]) && $fila["cSexo"]=="M") echo "checked";?> id="fSexo" value="M" class="form-control"> Mujer 
					<input type="radio" name="fSexo" <?php if (isset($fila["cSexo"]) && $fila["cSexo"]=="H") echo "checked";?> id="fSexo" value="H" class="form-control"> Hombre 
				</div>
				
				<div>
					<input type="hidden" name="modificarPersona" value="1" />
					<input type="hidden" name="fId" value="<?php echo $id;?>" id="fId" />
					<input type="submit" name="btnModificarPersona" value="Modificar persona" class="btn btn-primary"/>
				</div>
			</form>
		</div> <!-- /.ficha -->
		
	</div> <!-- /.contenido-principal -->

<?php // con esta invocación se genera el HTML que aparece al FINAL de todas las páginas (plantilla) ?>
<?php piePlantilla();?>
<?php include_once "inc/codigo_finalizacion.php"; ?>
