var pagina = 0;
$(document).ready(function(){
  inicializarMensajes();
  cargarBotonera(); 
  $(".busqueda input").on("change", function(){
    cargarBotonera();
    asignarBotones();
    cambiarPagina(0,"r");
  });
  
});

function cargarBotonera(){
  $(".cambioPagina").load(
    "inc/paginacion.php",
    {
      filtro: $(".busqueda input").val(),
      pagActual: pagina,
    },
    function(){
      $(".cambioPagina #"+(pagina+1)).css("background-color","var(--fondo)");
      asignarBotones();
    }
  );
}

function asignarBotones(){
  $.ajax({
    url: "./inc/getNumPaginas.php",
    type: "POST",
    data: {filtro: $(".busqueda input").val()},
    success: function (data){
      $(".cambioPagina #ultimo").click(
        function(){
          cambiarPagina(Number(data,"m"));
        }
      )
    }
  });
  $("#primero").click(function(){
    cambiarPagina(0,"m");
  });
  $("#siguiente").click(function(){
    cambiarPagina(pagina + 1,"m");
  });
  $("#anterior").click(function(){
    cambiarPagina(pagina,"m");
  });
}
function cambiarPagina(pagCambio,modo){
  if((pagCambio < 0 || pagCambio == pagina) && modo !== "r"){
    return;
  }
  antPag = pagina;
  pagina = pagCambio;

  $(".cambioPagina #"+(antPag+1)).css("background-color","var(--color-secundario)");
  $(".cambioPagina #"+(pagina+1)).css("background-color","var(--fondo)");
  
  $("#anterior").off();
  $("#anterior").click(function(){
    cambiarPagina(pagina-1);
  });
  $.ajax({
    url: "./inc/getNumPaginas.php",
    type: "POST",
    data: {filtro: $(".busqueda input").val()},
    success: function (data){ 
    if(pagina > (data)){
        pagina = data;
    }else{
      $(".mensajes").load(
        "inc/cargarAvisos.php",
        {
          filtro: $(".busqueda input").val(),
          pagina: pagina,
        },
        function(){
          $(".msg").ready(function(){
            inicializarMensajes();
            $("#siguiente").off();
            $("#siguiente").click(function(){
              cambiarPagina(pagina + 1);
            });
          });
        }
      );
    }
  }
  });
}
