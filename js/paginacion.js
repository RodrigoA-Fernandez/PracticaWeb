var pagina = 0;
var numPestanias;
$(document).ready(function(){
  if($(document).width() > 730){
    numPestanias = 4;
  } else if ($(document).width() > 300){
    numPestanias = 2;
  } else {
    numPestanias = 1;
  }
  inicializarMensajes();
  cargarBotonera(); 
  $(".busqueda input").on("change", function(){
    cargarBotonera();
    asignarBotones();
    cambiarPagina(0,"r");
  });

  $(window).bind("orientationchange", function(){
    console.log($(window).width());
    if($(window).width() > 730){
      numPestanias = 4;
    } else if ($(document).width() > 300){
      numPestanias = 2;
    } else {
      numPestanias = 1;
    }
    cargarBotonera();
  });
  
});

function cargarBotonera(){
  $(".cambioPagina ul").load(
    "inc/visorAlumnos/paginacion.php",
    {
      filtro: $(".busqueda input").val(),
      pagActual: pagina,
      paginas: numPestanias,
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
      $(".cambioPagina #ultimo").off();
      $(".cambioPagina #ultimo").click(
        function(){
          cambiarPagina(Number(data-1,"m"));
        }
      )
    }
  });
  $(".numerico").off();
  $(".numerico").each(function(){
    $(this).click(function(){
      cambiarPagina(Number(this.getAttribute("id"))-1,"m");
    });
    
  });
  $("#primero").off();
  $("#primero").click(function(){
    cambiarPagina(0,"m");
  });
  $("#siguiente").off();
  $("#siguiente").click(function(){
    cambiarPagina(pagina + 1,"m");
  });
  $("#anterior").off();
  $("#anterior").click(function(){
    cambiarPagina(pagina-1,"m");
  });

}
function cambiarPagina(pagCambio,modo){
  if((pagCambio < 0 || pagCambio == pagina) && modo !== "r"){
    return;
  }
  
  $.ajax({
    url: "./inc/visorAlumnos/getNumPaginas.php",
    type: "POST",
    data: {filtro: $(".busqueda input").val()},
    success: function (data){ 
    
    if(pagCambio >= Number(data)){
        pagina = Number(data)-1;
    }else{
      antPag = pagina;
      pagina = pagCambio;
      $(".mensajes").load(
        "inc/visorAlumnos/cargarAvisos.php",
        {
          filtro: $(".busqueda input").val(),
          pagina: pagina,
        },
        function(){
          $(".msg").ready(function(){
            
            inicializarMensajes();
            cargarBotonera();
          });
        }
      );
    }
  }
  });
}
