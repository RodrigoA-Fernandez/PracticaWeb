<?php	
	function comprobarEntrada($conexion, $dato) { /* Función para prevenir inyección código JS y SQL */
		$dato = mysqli_real_escape_string($conexion, $dato);
		$dato = trim($dato);
		$dato = stripslashes($dato);
		$dato = htmlspecialchars($dato);
		return $dato;
	}
?>
