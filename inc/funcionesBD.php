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
    try{
      mysqli_stmt_execute($sentenciaSQL);
    }catch(Exception $e){
      $okFlag = false;
    }
		// destruir la sentencia 
		mysqli_stmt_close($sentenciaSQL);
	}

	if ($okFlag) {
		return OK;
	} else {
		return ERROR_ALTA_PERSONA;
	}
}
?>
<?php
function eliminarEstudiante($conexionBD, $id) {
	// Preparación consulta inserción nueva persona 
  $sentenciaSQL = mysqli_stmt_init($conexionBD);
	$okFlag= mysqli_stmt_prepare($sentenciaSQL, 'DELETE FROM `USUARIO_ESTUDIANTE` WHERE Nia = ?');

	if ($okFlag) {
		// vincular los parámetros para los marcadores 
		mysqli_stmt_bind_param($sentenciaSQL, "i", $id);
		// ejecutar la consulta 
    try{
      mysqli_stmt_execute($sentenciaSQL);
    }catch(Exception $e){
      $okFlag = false;
    }
		// destruir la sentencia 
		mysqli_stmt_close($sentenciaSQL);
	}

	if ($okFlag) {
		return OK;
	} else {
		return ERROR_BAJA_PERSONA;
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
function getMensajesEstudiante($conexionBD, $login,$filtro ,$pagina) {
  $numMensajes = 9;
  $patron ="%".$filtro."%";
  $sentencia = 'SELECT UP.Nombre, A.Fecha, A.Asunto, A.Contenido, A.Id, DA.Leido FROM DIRIGIR_AVISO AS DA INNER JOIN AVISO AS A ON DA.Aviso = A.Id INNER JOIN USUARIO_PROFESOR AS UP ON UP.Nia = A.Autor INNER JOIN USUARIO_ESTUDIANTE AS UE ON DA.Destinatario = UE.Nia WHERE( (UE.Login = ?) AND (A.Asunto LIKE ? OR A.Contenido LIKE ?))  ORDER BY A.Fecha LIMIT ?,?;';
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
  $numMensajes = 9;
  $patron = "%".$filtro."%";
  $sentencia = 'SELECT COUNT(*) FROM DIRIGIR_AVISO AS DA INNER JOIN AVISO AS A ON DA.Aviso = A.Id INNER JOIN USUARIO_PROFESOR AS UP ON UP.Nia = A.Autor INNER JOIN USUARIO_ESTUDIANTE AS UE ON DA.Destinatario = UE.Nia WHERE( (UE.Login = ? OR UE.Nia = 0) AND (A.Asunto LIKE ? OR A.Contenido LIKE ?))';
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
  mysqli_free_result($resultado);
  mysqli_stmt_close($sentenciaSQL);

  // return $login;
  // return $fila["COUNT(*)"];
  return intdiv($fila["COUNT(*)"],$numMensajes)+1;
}
?>
<?php
function marcarLeido($conexionBD, $idMensaje, $login){
  $sentencia = 'UPDATE `DIRIGIR_AVISO` SET `Leido`=1 WHERE Destinatario = (SELECT UE.Nia FROM USUARIO_ESTUDIANTE AS UE WHERE login = ?) AND Aviso = ?';

  $sentenciaSQL = mysqli_stmt_init($conexionBD);
  mysqli_stmt_prepare($sentenciaSQL, $sentencia);
  mysqli_stmt_bind_param($sentenciaSQL, "si", $login, $idMensaje);
  mysqli_stmt_execute($sentenciaSQL);
  mysqli_stmt_close($sentenciaSQL);

}
?>
<?php
function cambiarContrasenia($conexionBD, $login,$nuevaContrasenia){
  $sentencia = 'UPDATE `USUARIO_ESTUDIANTE` SET Contrasenia = ? WHERE Login = ?';
  $sentenciaSQL = mysqli_stmt_init($conexionBD);
  mysqli_stmt_prepare($sentenciaSQL, $sentencia);
  mysqli_stmt_bind_param($sentenciaSQL, "ss", hash("md5", $nuevaContrasenia), $login);
  mysqli_stmt_execute($sentenciaSQL);
  mysqli_stmt_close($sentenciaSQL);
}
?>
<?php
function getNombresAlumnos($conexionBD){
  $sentencia = 'SELECT `Nombre` from `USUARIO_ESTUDIANTE`';
  $sentenciaSQL = mysqli_stmt_init($conexionBD);
  $okflag = mysqli_stmt_prepare($sentenciaSQL,$sentencia);
  if ($okflag){
    mysqli_stmt_execute($sentenciaSQL);
    $resultado = mysqli_stmt_get_result($sentenciaSQL);
    while($fila = $resultado->fetch_row()){
      $filas[] = $fila; 
    }
    $resultado->close();
    $sentenciaSQL->close();
    return $filas;
  }
  return [];
}
?>
<?php
function getAlumnos($conexionBD,$filtro){
  $patron = "%".$filtro."%";
  $sentencia = 'SELECT `Nia`,`Nombre`,`Login` from `USUARIO_ESTUDIANTE` WHERE (LOWER(Nombre) LIKE LOWER(?) OR LOWER(Login) LIKE LOWER(?)) ORDER BY Nombre';
  $sentenciaSQL = mysqli_stmt_init($conexionBD);
  $okflag = mysqli_stmt_prepare($sentenciaSQL,$sentencia);
  if ($okflag){
    $sentenciaSQL -> bind_param("ss",$patron,$patron);
    mysqli_stmt_execute($sentenciaSQL);
    $resultado = mysqli_stmt_get_result($sentenciaSQL);
    while($fila = $resultado->fetch_row()){
      $filas[] = $fila; 
    }
    $resultado->close();
    $sentenciaSQL->close();
    return $filas;
  }
  return [];
}
?>
<?php
function hacerAviso($conexionBD, $destinatario, $asunto, $aviso, $autor){
  if (!comprobarLoginAlumno($conexionBD, $destinatario) ||!comprobarLoginProfesor($conexionBD, $autor) ){
    error_log("Error: Alumno o Profesor Inexistente");
    return false;
  }
  $sentenciaAviso = "INSERT INTO `AVISO`(`Asunto`, `Contenido`, `Autor`) VALUES (?,?,(SELECT Nia FROM USUARIO_PROFESOR WHERE login = ?))";
  $avisoSQL = mysqli_stmt_init($conexionBD);
  $okflag = $avisoSQL ->prepare($sentenciaAviso);
  if ($okflag){
    $avisoSQL -> bind_param("sss", $asunto, $aviso, $autor);
    $avisoSQL -> execute();
    $idAviso = $avisoSQL ->insert_id;
    $avisoSQL->close();
    $dirigirSQL = mysqli_stmt_init($conexionBD);
    if ($destinatario == "Todos"){
      $sentenciaDirigir = "INSERT INTO DIRIGIR_AVISO(`Aviso`,`Destinatario`,`Leido`) SELECT ?, UE.Nia, 0 FROM USUARIO_ESTUDIANTE AS UE";
      $dirigirSQL->prepare($sentenciaDirigir);
      $dirigirSQL -> bind_param("s",$idAviso);
      $dirigirSQL -> execute();
      $dirigirSQL -> close();
    }else{
      $sentenciaDirigir = "INSERT INTO DIRIGIR_AVISO(`Aviso`,`Destinatario`,`Leido`) VALUES (?,(SELECT Nia FROM USUARIO_ESTUDIANTE WHERE Nombre = ?),0)";
      $dirigirSQL->prepare($sentenciaDirigir);
      $dirigirSQL -> bind_param("ss",$idAviso,$destinatario);
      $dirigirSQL -> execute();
      $dirigirSQL -> close();
    }
    return true;
  }
  error_log("No se ha podido enviar el aviso.");
  return false;
}
?>
<?php
function comprobarLoginAlumno($conexionBD,$login){
  $sentencia = "SELECT COUNT(*) FROM USUARIO_ESTUDIANTE WHERE Login = ?";
  $sentenciaSQL = mysqli_stmt_init($conexionBD);
  $okflag = $sentenciaSQL -> prepare($sentencia);
  if ($okflag){
    $sentenciaSQL -> bind_param("s", $login);
    $sentenciaSQL->execute();
    $resultado = $sentenciaSQL -> get_result();
    if (mysqli_num_rows($resultado) > 0) {
			$fila= mysqli_fetch_assoc($resultado);
		} else {
			$fila= array();
		}
    mysqli_free_result($resultado);
    mysqli_stmt_close($sentenciaSQL);
    if ($fila["COUNT(*)"] == 0){
      return true;
    }
  }
  return false;
}
?>
<?php
function comprobarNombreAlumno($conexionBD,$nombre){
  $sentencia = "SELECT COUNT(*) FROM USUARIO_ESTUDIANTE WHERE Nombre = ?";
  $sentenciaSQL = mysqli_stmt_init($conexionBD);
  $okflag = $sentenciaSQL -> prepare($sentencia);
  if ($okflag){
    $sentenciaSQL -> bind_param("s", $nombre);
    $sentenciaSQL->execute();
    $resultado = $sentenciaSQL -> get_result();
    if (mysqli_num_rows($resultado) > 0) {
			$fila= mysqli_fetch_assoc($resultado);
		} else {
			$fila= array();
		}
    mysqli_free_result($resultado);
    mysqli_stmt_close($sentenciaSQL);
    if ($fila["COUNT(*)"] == 0){
      return true;
    }
  }
  return false;
}
?>
<?php
function comprobarLoginProfesor($conexionBD,$login){
  $sentencia = "SELECT COUNT(*) FROM USUARIO_PROFESOR WHERE Login = ?";
  $sentenciaSQL = mysqli_stmt_init($conexionBD);
  $okflag = $sentenciaSQL -> prepare($sentencia);
  if ($okflag){
    $sentenciaSQL -> bind_param("s", $login);
    $sentenciaSQL->execute();
    $resultado = $sentenciaSQL -> get_result();
    if (mysqli_num_rows($resultado) > 0) {
			$fila= mysqli_fetch_assoc($resultado);
		} else {
			$fila= array();
		}
    mysqli_free_result($resultado);
    mysqli_stmt_close($sentenciaSQL);
    if ($fila["COUNT(*)"] == 0){
      return false;
    }
  }
  return true;
}
?>
<?php
function getMensajesProfesor($conexionBD, $login , $filtro,$pagina) {
  $numMensajes = 9;
  $patron = "%".$filtro."%";
  $sentenciaUnicos = 'SELECT * FROM ((SELECT A.Asunto, A.Contenido, A.Fecha, UE.Nombre FROM AVISO AS A
INNER JOIN USUARIO_PROFESOR AS UP ON A.Autor = UP.Nia
INNER JOIN DIRIGIR_AVISO AS DA ON DA.Aviso = A.Id
INNER JOIN USUARIO_ESTUDIANTE AS UE ON UE.Nia = DA.Destinatario
WHERE UP.Login = ? AND (A.Contenido LIKE ? OR A.Asunto LIKE ?) AND A.Id NOT IN (SELECT A.Id FROM AVISO AS A
INNER JOIN DIRIGIR_AVISO AS DA ON DA.Aviso = A.Id
GROUP BY Id HAVING COUNT(*)>1)) UNION(
SELECT A.Asunto, A.Contenido, A.Fecha, "Todos" FROM AVISO AS A
INNER JOIN USUARIO_PROFESOR AS UP ON UP.Nia = A.Autor
INNER JOIN DIRIGIR_AVISO AS DA ON DA.Aviso = A.Id
WHERE UP.Login = ? AND (A.Contenido LIKE ? OR A.Asunto LIKE ?)
GROUP BY A.Id
HAVING COUNT(*) > 1)) AS T ORDER BY Fecha DESC LIMIT ?,?;';

  error_log($login.", ".$patron);

  $unicosSQL = mysqli_stmt_init($conexionBD);
  $okflag = $unicosSQL -> prepare($sentenciaUnicos);
  
  if (!$okflag){
    return ERROR_CONSULTA_PERSONA;
  }

  $unicosSQL -> bind_param("ssssssii", $login, $patron, $patron, $login, $patron, $patron, $pagina, $numMensajes);
  $unicosSQL -> execute();
  $resUnicos = $unicosSQL -> get_result(); 
  
  while($fila = $resUnicos->fetch_row()){
      $filasUnicos[] = $fila; 
  }
  $unicosSQL-> close();
  $resUnicos ->close();

	return $filasUnicos;
}
?>
<?php
function getPaginasMensajesProfesor($conexionBD, $login, $filtro){
  $numMensajes = 9;
  $patron = "%".$filtro."%";
  $sentencia = 'SELECT COUNT(*) FROM ((SELECT A.Asunto, A.Contenido, A.Fecha, UE.Nombre FROM AVISO AS A
  INNER JOIN USUARIO_PROFESOR AS UP ON A.Autor = UP.Nia
  INNER JOIN DIRIGIR_AVISO AS DA ON DA.Aviso = A.Id
  INNER JOIN USUARIO_ESTUDIANTE AS UE ON UE.Nia = DA.Destinatario
  WHERE UP.Login = ? AND (A.Contenido LIKE ? OR A.Asunto LIKE ?) AND A.Id NOT IN (SELECT A.Id FROM AVISO AS A
  INNER JOIN DIRIGIR_AVISO AS DA ON DA.Aviso = A.Id
  GROUP BY Id HAVING COUNT(*)>1)) UNION(
  SELECT A.Asunto, A.Contenido, A.Fecha, "Todos" FROM AVISO AS A
  INNER JOIN USUARIO_PROFESOR AS UP ON UP.Nia = A.Autor
  INNER JOIN DIRIGIR_AVISO AS DA ON DA.Aviso = A.Id
  WHERE UP.Login = ? AND (A.Contenido LIKE ? OR A.Asunto LIKE ?)
  GROUP BY A.Id
  HAVING COUNT(*) > 1       
  )) AS TABLA;';
  $sentenciaSQL = mysqli_stmt_init($conexionBD);
  mysqli_stmt_prepare($sentenciaSQL, $sentencia);
  mysqli_stmt_bind_param($sentenciaSQL, "ssssss", $login,$patron,$patron, $login,$patron,$patron);
  mysqli_stmt_execute($sentenciaSQL);
  $resultado = mysqli_stmt_get_result($sentenciaSQL);
  
  if (mysqli_num_rows($resultado) > 0) {
			$fila= mysqli_fetch_assoc($resultado);
		} else {
			$fila= array();
		}
  mysqli_free_result($resultado);
  mysqli_stmt_close($sentenciaSQL);

  // return $login;
  // return $fila["COUNT(*)"];
  return intdiv($fila["COUNT(*)"],$numMensajes)+1;
}
?>
<?php
function modificarAlumno($conexionBD, $id, $nombre, $login){
  $senteciaSQL = mysqli_stmt_init($conexionBD);
  // error_log("Valores:".$nombre.",".$login);
  if ($nombre ==""){
    $sentencia = "UPDATE `USUARIO_ESTUDIANTE` SET Login = ? WHERE Nia = ?";
    $senteciaSQL -> prepare($sentencia);
    $senteciaSQL -> bind_param("si", $login, $id);
  }else if ($login == ""){
    $sentencia = "UPDATE `USUARIO_ESTUDIANTE` SET Nombre = ? WHERE Nia = ?";
    $senteciaSQL -> prepare($sentencia);
    $senteciaSQL -> bind_param("si", $nombre, $id);
  }else{
    $sentencia = "UPDATE `USUARIO_ESTUDIANTE` SET Nombre = ?,Login = ? WHERE Nia = ?";
    $senteciaSQL -> prepare($sentencia);
    $senteciaSQL -> bind_param("ssi", $nombre,$login, $id);
  }
  $senteciaSQL ->execute();
  $senteciaSQL -> close();
}
?>
