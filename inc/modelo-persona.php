<?php

/* Función PHP que encapsula la inserción de una nueva persona */
function nuevaPersona($conexionBD, $nombre, $email, $website, $comentario, $sexo) {
	// Preparación consulta inserción nueva persona 
	$sentenciaSQL= mysqli_stmt_init($conexionBD);
	$okFlag= mysqli_stmt_prepare($sentenciaSQL, 'INSERT INTO Persona (cNombre, cEmail, cWebsite, cComentario, cSexo) VALUES (?, ?, ?, ?, ?)');
	if ($okFlag) {
		// vincular los parámetros para los marcadores 
		mysqli_stmt_bind_param($sentenciaSQL, "sssss", $nombre, $email, $website, $comentario, $sexo);

		// ejecutar la consulta 
		$okFlag= mysqli_stmt_execute($sentenciaSQL);

		// destruir la sentencia 
		mysqli_stmt_close($sentenciaSQL);
	}

	if ($okFlag) {
		return OK;
	} else {
		return ERROR_ALTA_PERSONA;
	}
}

/* Función PHP que encapsula la consulta de una persona por id */
function getPersona($conexionBD, $id) {
	// Preparación consulta select persona 
	$sentenciaSQL= mysqli_stmt_init($conexionBD);
	$okFlag=mysqli_stmt_prepare($sentenciaSQL, 'SELECT cNombre,cEmail,cWebsite,cComentario,cSexo FROM Persona WHERE cId=?');
	if ($okFlag) {
		// vincular los parámetros para los marcadores 
		mysqli_stmt_bind_param($sentenciaSQL, "i", $id);

		// ejecutar la consulta 
		$okFlag= mysqli_stmt_execute($sentenciaSQL);
    // obtener los resultados de la consulta 
		$resultado= mysqli_stmt_get_result($sentenciaSQL);
		if (mysqli_num_rows($resultado) > 0) {
			$fila= mysqli_fetch_assoc($resultado);
		} else {
			$fila= array();
		}
		// destruir la sentencia 
		mysqli_stmt_close($sentenciaSQL);
	}

	if ($okFlag) {
		return $fila;
	} else {
		return ERROR_CONSULTA_PERSONA;
	}
}

function getPersonas($conexionBD, $sentenciaSQL = "SELECT * FROM Persona") {
	// Preparación consulta select todas las personas
	$resultado = mysqli_query($conexionBD, $sentenciaSQL);

	//Declaración del array donde se mantendrán los resultados
	$array_filas=array();
	//almacenamiento de todas las filas en el array 
	while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
		array_Push($array_filas,$fila);
	}
	//este bucle equivale a ..
	//$array_filas= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
	
	//limpieza
	mysqli_free_result($resultado);
	
	return $array_filas;
}	
?>
