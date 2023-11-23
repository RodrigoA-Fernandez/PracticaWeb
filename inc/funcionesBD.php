<?php
function nuevoEstudiante($conexionBD, $nombre, $contrasenia, $login) {
	// Preparación consulta inserción nueva persona 
  $contraseniaHash= hash("md5",$contrasenia);
	$sentenciaSQL= mysqli_stmt_init($conexionBD);
	$okFlag= mysqli_stmt_prepare($sentenciaSQL, 'INSERT INTO USUARIO_ESTUDIANTE (Nombre, Contrasenia, Login) VALUES (?, ?, ?)');

	if ($okFlag) {
		// vincular los parámetros para los marcadores 
		mysqli_stmt_bind_param($sentenciaSQL, "sss", $nombre, $contraseniaHash, $login);
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
function nuevoProfesor($conexionBD, $nombre, $contrasenia, $login) {
	// Preparación consulta inserción nueva persona 
  $contraseniaHash= hash("md5",$contrasenia);
	$sentenciaSQL= mysqli_stmt_init($conexionBD);
	$okFlag= mysqli_stmt_prepare($sentenciaSQL, 'INSERT INTO USUARIO_PROFESOR (Nombre, Contrasenia, Login) VALUES (?, ?, ?)');

	if ($okFlag) {
		// vincular los parámetros para los marcadores 
		mysqli_stmt_bind_param($sentenciaSQL, "sss", $nombre, $contraseniaHash, $login);

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
function getMensajesEstudiante($conexionBD, $login,$filtro ,$pagina) {
  $numMensajes = 10;
  $patron ="%".$filtro."%";
  $sentencia = 'SELECT UP.Nombre, A.Fecha, A.Asunto, A.Contenido, A.Id, DA.Leido FROM DIRIGIR_AVISO AS DA INNER JOIN AVISO AS A ON DA.Aviso = A.Id INNER JOIN USUARIO_PROFESOR AS UP ON UP.Nia = A.Autor INNER JOIN USUARIO_ESTUDIANTE AS UE ON DA.Destinatario = UE.Nia WHERE( UE.Login = ? AND (A.Asunto LIKE ? OR A.Contenido LIKE ?))  ORDER BY A.Fecha LIMIT ?,?;';
	$sentenciaSQL= mysqli_stmt_init($conexionBD);
  mysqli_stmt_prepare($sentenciaSQL, $sentencia);
  $limite = $pagina * $numMensajes;
  mysqli_stmt_bind_param($sentenciaSQL, "sssii", $login,$patron,$patron, $limite, $numMensajes);
	mysqli_stmt_execute($sentenciaSQL);
  $resultado = mysqli_stmt_get_result($sentenciaSQL);

	$array_filas=array();

	while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
		array_Push($array_filas,$fila);
	}
	
	mysqli_free_result($resultado);
	
	mysqli_stmt_close($sentenciaSQL);
	return $array_filas;
}	
?>
<?php
function getPaginasMensajes($conexionBD, $login, $filtro){
  $numMensajes = 10;
  $patron = "%".$filtro."%";
  $sentencia = 'SELECT COUNT(*) FROM DIRIGIR_AVISO AS DA INNER JOIN AVISO AS A ON DA.Aviso = A.Id INNER JOIN USUARIO_PROFESOR AS UP ON UP.Nia = A.Autor INNER JOIN USUARIO_ESTUDIANTE AS UE ON DA.Destinatario = UE.Nia WHERE( UE.Login = ? AND (A.Asunto LIKE ? OR A.Contenido LIKE ?))';
  $sentenciaSQL = mysqli_stmt_init($conexionBD);
  mysqli_stmt_prepare($sentenciaSQL, $sentencia);
  mysqli_stmt_bind_param($sentenciaSQL, "sss", $login,$patron,$patron);
  mysqli_stmt_execute($sentenciaSQL);
  $resultado = mysqli_stmt_get_result($sentenciaSQL);
  
  if (mysqli_num_rows($resultado) > 0) {
			$fila= mysqli_fetch_assoc($resultado);
		} else {
			$fila= array();
		}

  return intdiv($fila["COUNT(*)"],$numMensajes)+1;
}
?>
