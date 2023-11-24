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
      $(".cambioPagina #ultimo").off();
      $(".cambioPagina #ultimo").click(
        function(){
          cambiarPagina(Number(data-1,"m"));
        }
      )
    }
  });
  $(".botonId").off();
  $(".botonId").each(function(){
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
