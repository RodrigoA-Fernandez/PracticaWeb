$(function () {
  cargarAlumnos("");
});

function cargarAlumnos(filtro) {
  $.ajax({
    type: "POST",
    url: "./inc/gestorAlumnos/cargarAlumnos.php",
    data: { filtro: filtro },
    async: false,
    success: function (data) {
      $("#cuerpo-tabla").html(data);
      $(".editar").on("click", function () {
        //No Funciona recargar pq deja de existir temporalmente
        if ($("#cuerpo-tabla").children(".check").length) {
          return;
        }
        let linea = $(this).closest("tr");
        let nombre = linea.children(".nombre").text();
        let login = linea.children(".login").text();

        $.ajax({
          type: "POST",
          url: "./inc/gestorAlumnos/editar.php",
          data: {
            id: $(this).closest("tr").attr("id"),
            nombre: nombre,
            login: login,
          },
          async: false,
        }).done(function (data) {
          linea.html(data);
          $("#cuerpo-tabla")
            .children(".check")
            .on("click", function () {
              let n = $("#nombre").val();
              let l = $("#login").val();
              if (l === "" && n === "") {
                alert("Introduzca algún valor.");
                return;
              }
              if (l !== "" && !validarEmail(l)) {
                return;
              }
              $.ajax({
                type: "POST",
                url: "./inc/gestorAlumnos/modificar.php",
                async: false,
                data: {
                  id: $(this).closest("tr").attr("id"),
                  nombre: n,
                  login: l,
                },
                success: function () {
                  cargarAlumnos(filtro);
                },
              });
            });
          $("#cuerpo-tabla")
            .children(".cancel")
            .on("click", function () {
              cargarAlumnos(filtro);
            });
        });
      });
    },
  });
}

function validarEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  if (regex.test(email)) {
    return true;
  }
  alert("El Login debe ser un email.");
  return false;
}
