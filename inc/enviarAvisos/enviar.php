<?php include_once "../codigo_inicializacion.php"?>
<?php
$destinatario = comprobarEntrada($conexionBD,$_POST["destinatario"]);
$asunto = comprobarEntrada($conexionBD,$_POST["asunto"]);
$aviso = comprobarEntrada($conexionBD,$_POST["aviso"]);
$autor = $_SESSION["usuario"]["username"];
// error_log("Valores: ".$destinatario.", ".$autor.".");
// var_dump($_SESSION["usuario"]["username"]);
$res = hacerAviso($conexionBD,$destinatario,$asunto,$aviso,$autor);
if(!$res){
  echo '<script>
  alert("No se ha podido enviar el mensaje, contacte con la administración");
  window.location.href="../../enviarAvisos.php";
  </script>';
}else{
  echo '<script>alert("Mensaje enviado.")</script>';
  header('Location: ../../enviarAvisos.php');
}
exit(0);
?>
<?php include_once "../codigo_finalizacion.php"?>
