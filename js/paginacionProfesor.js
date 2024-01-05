var pagina = 0;
var numPestanias;
$(function () {
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
});

function cargarBotonera() {
  $(".mensajes-cambioPagina ul").load(
    "inc/visorProfesores/paginacion.php",
    {
      pagActual: pagina,
      paginas: numPestanias,
    },
    function () {
      asignarBotones();
    },
  );
}

function asignarBotones() {
  $.ajax({
    url: "./inc/visorProfesores/getNumPaginas.php",
    type: "POST",
    data: { filtro: $(".busqueda input").val() },
    success: function (data) {
      $("#ultimo").off();
      $("#ultimo").on("click", function () {
        cambiarPagina(Number(data - 1, "m"));
      });
    },
  });
  $(".numerico").off();
  $(".numerico").each(function () {
    $(this).on("click", function () {
      cambiarPagina(Number(this.getAttribute("id")) - 1, "m");
    });
  });
  $("#primero").off();
  $("#primero").on("click", function () {
    cambiarPagina(0, "m");
  });
  $("#siguiente").off();
  $("#siguiente").on("click", function () {
    cambiarPagina(pagina + 1, "m");
  });
  $("#anterior").off();
  $("#anterior").on("click", function () {
    cambiarPagina(pagina - 1, "m");
  });
}
function cambiarPagina(pagCambio, modo) {
  if ((pagCambio < 0 || pagCambio == pagina) && modo !== "r") {
    return;
  }

  $.ajax({
    url: "./inc/visorProfesores/getNumPaginas.php",
    type: "POST",
    data: { filtro: $(".busqueda input").val() },
    success: function (data) {
      if (pagCambio >= Number(data)) {
        pagina = Number(data) - 1;
      } else {
        antPag = pagina;
        pagina = pagCambio;
        $(".mensajes-mensajes").load(
          "inc/visorProfesores/cargarAvisos.php",
          {
            filtro: $(".busqueda input").val(),
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
