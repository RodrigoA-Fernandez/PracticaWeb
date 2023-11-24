function inicializarMensajes(){
  $(".msg").click(function(){
    var id = $(this).attr("id");
    
    $.ajax({
      url: "./inc/visorAlumnos/marcarLeido.php",
      method: "POST",
      data: { mensaje: $(this).attr("id") }
    }); 
     //Expandir Mensaje
    $(this).children(".ocultable").each(function(){
      if($(this).hasClass("oculto")){
        $(this).removeClass("oculto");
      }else{
        $(this).addClass("oculto");
      }
    });

    //Cerrar el resto de Mensajes
    $(".msg").each(function(){
      if($(this).attr("id") !== id){
        $(this).children(".ocultable").each(function(){
          if(!$(this).hasClass("oculto")){
            $(this).addClass("oculto");
          }
        });
      }
    });

    //Marcar Leido
    if($(this).hasClass("noLeido")){
      $(this).removeClass("noLeido");
    }
  });

}
