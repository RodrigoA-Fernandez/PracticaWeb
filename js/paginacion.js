var pagina = 0;
var numPestanias;
$(document).ready(function () {
  if ($(document).width() > 730) {
    numPestanias = 4;
  } else if ($(document).width() > 300) {
    numPestanias = 2;
  } else {
    numPestanias = 1;
  }
  inicializarMensajes();
  cargarBotonera();
  $(".mensajes-busqueda input").on("change", function () {
    cargarBotonera();
    asignarBotones();
    cambiarPagina(0, "r");
  });

  $(window).on("resize", function () {
    if ($(document).width() > 730) {
      numPestanias = 4;
    } else if ($(document).width() > 300) {
      numPestanias = 2;
    } else {
      numPestanias = 1;
    }
    cargarBotonera();
  });
  $("#buscar").on("click", function(){
    $(".mensajes-mensajes").load(
          "inc/visorAlumnos/cargarAvisos.php",
          {
            filtro: $("#busqueda").val(),
            pagina: pagina,
          },
          function () {
            $(".mensajes-msg").ready(function () {
              inicializarMensajes();
              cargarBotonera();
            });
          },
        );
  });
});

function cargarBotonera() {
  $(".mensajes-cambioPagina ul").load(
    "inc/visorAlumnos/paginacion.php",
    {
      pagActual: pagina,
      paginas: numPestanias,
      filtro: $("#busqueda").val()
    },
    function () {
      asignarBotones();
    },
  );
}

function asignarBotones() {
  $.ajax({
    url: "./inc/visorAlumnos/getNumPaginas.php",
    type: "POST",
    data: { filtro: $("#busqueda").val() },
    success: function (data) {
      $("#ultimo").off();
      $("#ultimo").click(function () {
        cambiarPagina(Number(data - 1, "m"));
      });
    },
  });
  $(".numerico").off();
  $(".numerico").each(function () {
    $(this).click(function () {
      cambiarPagina(Number(this.getAttribute("id")) - 1, "m");
    });
  });
  $("#primero").off();
  $("#primero").click(function () {
    cambiarPagina(0, "m");
  });
  $("#siguiente").off();
  $("#siguiente").click(function () {
    cambiarPagina(pagina + 1, "m");
  });
  $("#anterior").off();
  $("#anterior").click(function () {
    cambiarPagina(pagina - 1, "m");
  });
}
function cambiarPagina(pagCambio, modo) {
  if ((pagCambio < 0 || pagCambio == pagina) && modo !== "r") {
    return;
  }

  $.ajax({
    url: "./inc/visorAlumnos/getNumPaginas.php",
    type: "POST",
    data: { filtro: $("#busqueda").val() },
    success: function (data) {
      if (pagCambio >= Number(data)) {
        pagina = Number(data) - 1;
      } else {
        antPag = pagina;
        pagina = pagCambio;
        $(".mensajes-mensajes").load(
          "inc/visorAlumnos/cargarAvisos.php",
          {
            filtro: $("#busqueda").val(),
            pagina: pagina,
          },
          function () {
            $(".mensajes-msg").ready(function () {
              inicializarMensajes();
              cargarBotonera();
            });
          },
        );
        $(".mensajes-msg").each(function () {
          $(this)
            .children(".mensajes-ocultable")
            .each(function () {
              $(this).addClass("mensajes-oculto");
            });
        });
      }
    },
  });

}
