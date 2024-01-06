$(function () {
  $("#nuevoAlumno")
    .find(".cancel")
    .on("click", function () {
      $("#nuevoAlumno").find("#nombreNuevo").val("");
      $("#nuevoAlumno").find("#loginNuevo").val("");
    });

  $("#nuevoAlumno")
    .find(".check")
    .on("click", function () {
      let n = $("#nuevoAlumno").find("#nombreNuevo").val();
      let l = $("#nuevoAlumno").find("#loginNuevo").val();
      if (n === "" || l === "") {
        alert("Introduzca el Nombre y el Login del nuevo Alumno.");
        return;
      }
      if (!validarEmail(l)) {
        alert("El Login debe ser un email.");
        return;
      }
      $.post(
        "./inc/gestorAlumnos/insertar.php",
        {
          nombre: n,
          login: l,
        },
        function (data) {
          console.log(data.trim());
          let datos = JSON.parse(data.trim());
          console.log(datos);
          if (datos["success"] === false) {
            alert("No se ha podido realizar la inserción.\n" + datos["razon"]);
            return;
          }
          alert("La contraseña del nuevo alumno es: " + datos["contrasenia"]);
          $("#nuevoAlumno").find("#nombreNuevo").val("");
          $("#nuevoAlumno").find("#loginNuevo").val("");
          cargarAlumnos("");
        },
      );
    });
});
