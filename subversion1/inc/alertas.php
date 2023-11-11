<?php
	if ($_GET['resultado'] == "persona-added") { ?>
	<div class="container">
		<div class="alert alert-success">
			Persona registrada correctamente
		</div>
	</div>
<?php } ?>
<?php
	if ($_GET['resultado'] == "persona-updated") { ?>
	<div class="container">
		<div class="alert alert-success">
			Persona modificada correctamente
		</div>
	</div>
<?php } ?>
<?php
	if ($_GET['resultado'] == "persona-deleted") { ?>
	<div class="container">
		<div class="alert alert-success">
			Persona borrada correctamente
		</div>
	</div>
<?php } ?>
<?php
	if ($_GET['resultado'] == "persona-ko") { ?>
	<div class="container">
		<div class="alert alert-danger">
			Fallo al procesar persona
		</div>
	</div>
<?php } ?>