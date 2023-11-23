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
    "inc/visorAlumnos/paginacion.php",
    {
      filtro: $(".busqueda input").val(),
      pagActual: pagina,
    },
    function(){
      $(".cambioPagina #"+(pagina+1)).addClass("activo");
      asignarBotones();
    }
  );
}

function asignarBotones(){
  $.ajax({
    url: "./inc/visorAlumnos/getNumPaginas.php",
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
  $(".botonId").each(function(i){
    $("#"+(i+1)).click(function(){
      cambiarPagina(Number(i),"m");
    })
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
  
  $.ajax({
    url: "./inc/visorAlumnos/getNumPaginas.php",
    type: "POST",
    data: {filtro: $(".busqueda input").val()},
    success: function (data){ 
    if(pagina > Number(data)){
        pagina = Number(data);
    }else{
      $(".mensajes").load(
        "inc/visorAlumnos/cargarAvisos.php",
        {
          filtro: $(".busqueda input").val(),
          pagina: pagina,
        },
        function(){
          $(".msg").ready(function(){
            $("#anterior").off();
            $("#anterior").click(function(){
              cambiarPagina(pagina-1);
            });
            $(".cambioPagina #"+(antPag+1)).removeClass("activo");
            $(".cambioPagina #"+(pagina+1)).addClass("activo");
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
