<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/estilos.css" rel="stylesheet">
  </head>
  <body class = "login-body">
    <div class="login-wrapper">
      <div>
        <div class = "login-guest-box">
          <div>
            <form class = "login-form" action="inc/formhandlerLogin.php" onsubmit="validarInput();" name = "login" method="post">
              <fieldset class = "login-form__fieldset">
                <!---->
                <!---->
                <!---->
                <h2 class = "login-form__headline">Iniciar Sesión</h2>

                <label class = "login-label" for="nombreUsuario">Nombre de Usuario</label>
                <div class = "login-input-wrapper">
                  <input class="login-input" id = "nombreUsuario" type="text" name="nombreUsuario" placeholder="Nombre de Usuario" autocomplete="off">  
                </div>

                <label class = "login-label" for="contrasenia">Contraseña</label>
                <div class = "login-input-wrapper">
                  <input class = "login-input" id="contrasenia" name="contrasenia" type="password" placeholder="Contraseña">
                </div> 

                <div class="login-loginIncorrecto login-mensajeError">
                  <?php include "./assets/iconoFallo.html"?>
                  <p>
                    Nombre de usuario o contraseña incorrecta.
                  </p>
                  
                </div>
                
                <div class="login-loginVacio login-mensajeError">
                  <?php include "./assets/iconoFallo.html"?>
                  <p>
                    Introduzca nombre de usuario y contraseña.
                  </p>
                </div>

                <button type="submit" class = "login-boton">Entrar</button>

                </fieldset>
              </form>
            </div>
          </div>
        </div>
      
      
      <a href="https://www.uva.es" class="login-link-uva">
        <img class="login-logo" src="assets/logo.png" alt="logo" width = 50>	
      </a>
		</div> 
    <!-- Script que controla la animación del logo -->
    <script>
      const elements = document.getElementsByClassName('login-logo');

      for (let i = 0; i<elements.length;i++){
        elements[i].addEventListener('animationend',function(e){
          elements[i].classList.remove("login-animado");
        });

        elements[i].addEventListener('mouseover', function(e){
          elements[i].classList.add("login-animado");
        })
      }
    </script>
    <!-- Script que se encarga de mostrar el mensaje de error en caso de que el login no sea correcto -->
    <script>
      const error = document.getElementsByClassName("login-loginIncorrecto");
      const vacio = document.getElementsByClassName("login-loginVacio");
      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      const tipoError= urlParams.get("falloLogin");

      switch (tipoError) {
        case "sinLogin":
          vacio[0].style.display = "flex";
          break;
        case "loginIncorrecto":
          error[0].style.display = "flex";
          break;
      }


    </script>
    <script>
    function validarInput(){
      let email = document.forms["login"]["nombreUsuario"].value;
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
        return (true);
      }
      alert("El nombre de usuario debe ser un email.");
      return (false)
    }
    </script>
  </body>
  

</html>

