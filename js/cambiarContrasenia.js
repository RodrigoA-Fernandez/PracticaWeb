$(document).ready(function(){

  $("body").keypress(function(e){
    var code = e.keyCode || e.which;
    if(code === 13){
      cambiar();
    }
  });

  $(document).on('click','#enviar',cambiar);
}); 
function cambiar(){
  if($("#antigua").val() === '' || $("#nueva").val() === '' || $("#comprobarNueva") === ''){
    $(".mensajeCambio").css("display","none");
    $(".mensajeError").css("display", "flex");
    $(".mensajeError p").text("Rellene todos los campos.");
    return;
  }

  if($("#comprobarNueva").val() != $("#nueva").val()){
    $(".mensajeCambio").css("display","none");
    $(".mensajeError").css("display", "flex");
    $(".mensajeError p").text("Las contraseñas no coinciden.");
    return;
  }

  if($("#antigua").val() === $("#nueva").val()){
    $(".mensajeCambio").css("display","none");
    $(".mensajeError").css("display", "flex");
    $(".mensajeError p").text("La contraseña antigua y la nueva deben ser distintas.");
    return;
  }

  $.ajax({
    url: "./inc/cambiarContrasenia.php",
    method: "POST",
    data: {
      "contrasenia": $("#antigua").val(),
      "nuevaContrasenia": $("#nueva").val()
    }
  }).done(function(data){
      datos = JSON.parse(data);
      if(datos["cambio"] === false){
        $(".mensajeCambio").css("display","none");
        $(".mensajeError").css("display", "flex");
        $(".mensajeError p").text(datos["causa"]);
      }else{
        $(".mensajeError").css("display","none");
        $(".mensajeCambio").css("display", "block");
      }
    });
}
