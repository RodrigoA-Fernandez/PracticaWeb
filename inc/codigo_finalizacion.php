<?php
	// Aquí se escribiría el código que se ejecutará al FINAL de cada script en PHP (código de limpieza)
	
	// Cerrar la conexión con la base de datos
	mysqli_close($conexionBD);
	
  session_write_close();
	ob_end_flush(); //Configuración procesador PHP: volcar la SALIDA de PHP y deshabilita el buffering
?>
