<?php include_once "inc/codigo_inicializacion.php"; ?>


<?php 
if (array_key_exists('nuevaPersona', $_POST)) { 
	$nombre = comprobar_entrada($_POST["fNombre"]);
	$email = comprobar_entrada($_POST["fEmail"]);
	$website = comprobar_entrada($_POST["fWebsite"]);
	$comentario = comprobar_entrada($_POST["fComentario"]);
	$sexo = comprobar_entrada($_POST["fSexo"]);
	
	$resultado= nuevaPersona($conexionBD, $nombre, $email, $website, $comentario, $sexo);
	if ($resultado==OK)
		header ("Location: indice-personas.php?resultado=persona-added", true, 303);
	else
		header ("Location: indice-personas.php?resultado=persona-ko", true, 303);
	exit();
}
?>	

<?php 
if (array_key_exists('modificarPersona', $_POST)) { 
	$id= intval(comprobar_entrada($_POST["fId"]));
	$nombre = comprobar_entrada($_POST["fNombre"]);
	$email = comprobar_entrada($_POST["fEmail"]);
	$website = comprobar_entrada($_POST["fWebsite"]);
	$comentario = comprobar_entrada($_POST["fComentario"]);
	$sexo = comprobar_entrada($_POST["fSexo"]);
	
	$resultado= modificarPersona($conexionBD, $id, $nombre, $email, $website, $comentario, $sexo);
	if ($resultado==OK)
		header ("Location: indice-personas.php?resultado=persona-updated", true, 303);
	else
		header ("Location: indice-personas.php?resultado=persona-ko", true, 303);
	exit();
}
?>	

<?php 
if (array_key_exists('idABorrar', $_GET)) { 
	$id= intval(comprobar_entrada($_GET["idABorrar"]));
	
	$resultado= borrarPersona($conexionBD, $id);
	if ($resultado==OK)
		header ("Location: indice-personas.php?resultado=persona-deleted", true, 303);
	else
		header ("Location: indice-personas.php?resultado=persona-ko", true, 303);
	
	exit();
}
?>	


<?php include_once "inc/codigo_finalizacion.php"; ?>
