<?php
function nuevoEstudiante($conexionBD, $nia, $nombre, $contrasenia, $login) {
	// Preparación consulta inserción nueva persona 
  $contraseniaHash= hash("md5",$contrasenia);
	$sentenciaSQL= mysqli_stmt_init($conexionBD);
	$okFlag= mysqli_stmt_prepare($sentenciaSQL, 'INSERT INTO USUARIO_ESTUDIANTE (Nia, Nombre, Contrasenia, Login) VALUES (?, ?, ?, ?)');

	if ($okFlag) {
		// vincular los parámetros para los marcadores 
		mysqli_stmt_bind_param($sentenciaSQL, "ssss", $nia, $nombre, $contraseniaHash, $login);

		// ejecutar la consulta 
		$okFlag= mysqli_stmt_execute($sentenciaSQL);

		// destruir la sentencia 
		mysqli_stmt_close($sentenciaSQL);
	}

	if ($okFlag) {
		return OK;
    echo("OK");
	} else {
		return ERROR_ALTA_PERSONA;
	}
}
?>
<?php
function comprobarLogin($conexionBD, $login, $contraseniaHash) {
  $sentenciaSQL= mysqli_stmt_init($conexionBD);
  $res= LOGIN_INCORRECTO;
  $okFlag=mysqli_stmt_prepare($sentenciaSQL, 'SELECT COUNT(*) FROM USUARIO_ESTUDIANTE WHERE Login=? AND Contrasenia=?');
  
	if ($okFlag) {
		// vincular los parámetros para los marcadores 
		mysqli_stmt_bind_param($sentenciaSQL, "ss", $login, $contraseniaHash);

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
  }
  
 
  if ($okFlag) {
    if ($fila["COUNT(*)"] == 1) {
      return LOGIN_ESTUDIANTE;
    } 
  } else {
		return ERROR_CONSULTA_PERSONA;
  }
  
  $okFlag=mysqli_stmt_prepare($sentenciaSQL, 'SELECT COUNT(*) FROM USUARIO_PROFESOR WHERE Login=? AND Contrasenia=?');
	if ($okFlag) {
		// vincular los parámetros para los marcadores 
		mysqli_stmt_bind_param($sentenciaSQL, "ss", $login, $contraseniaHash);

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
    if ($fila["COUNT(*)"] == 1) {
      return LOGIN_PROFESOR;
    }else{
      return LOGIN_INCORRECTO;
    } 
  } else {
		return ERROR_CONSULTA_PERSONA;
  }
}
?>

<?php
function nuevoProfesor($conexionBD, $nia, $nombre, $contrasenia, $login) {
	// Preparación consulta inserción nueva persona 
  $contraseniaHash= hash("md5",$contrasenia);
	$sentenciaSQL= mysqli_stmt_init($conexionBD);
	$okFlag= mysqli_stmt_prepare($sentenciaSQL, 'INSERT INTO USUARIO_PROFESOR (Nia, Nombre, Contrasenia, Login) VALUES (?, ?, ?, ?)');

	if ($okFlag) {
		// vincular los parámetros para los marcadores 
		mysqli_stmt_bind_param($sentenciaSQL, "ssss", $nia, $nombre, $contraseniaHash, $login);

		// ejecutar la consulta 
		$okFlag= mysqli_stmt_execute($sentenciaSQL);

		// destruir la sentencia 
		mysqli_stmt_close($sentenciaSQL);
	}

	if ($okFlag) {
		return OK;
    echo("OK");
	} else {
		return ERROR_ALTA_PERSONA;
	}
}
?>
