function inicializarMensajes(){
  $(".mensajes-msg").click(function(){
    var id = $(this).attr("id");
    
    $.ajax({
      url: "./inc/visorAlumnos/marcarLeido.php",
      method: "POST",
      data: { mensaje: $(this).attr("id") }
    }); 
     //Expandir Mensaje
    $(this).children(".mensajes-ocultable").each(function(){
      if($(this).hasClass("mensajes-oculto")){
        $(this).removeClass("mensajes-oculto");
      }else{
        $(this).addClass("mensajes-oculto");
      }
    });

    //Cerrar el resto de Mensajes
    $(".mensajes-msg").each(function(){
      if($(this).attr("id") !== id){
        $(this).children(".mensajes-ocultable").each(function(){
          if(!$(this).hasClass("mensajes-oculto")){
            $(this).addClass("mensajes-oculto");
          }
        });
      }
    });

    //Marcar Leido
    if($(this).hasClass("mensajes-noLeido")){
      $(this).removeClass("mensajes-noLeido");
    }
  });

}
