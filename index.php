<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/login.css" rel="stylesheet">
  </head>
  <body>
    <div class="wrapper">
      <div>
        <div class = "guest-box">
          <div>
            <form class = "login-form" action="inc/formhandlerLogin.php" method="post">
              <fieldset class = "login-form__fieldset">
                <!---->
                <!---->
                <!---->
                <h2 class = "login-form__headline">Iniciar Sesión</h2>

                <label for="nombreUsuario">Nombre de Usuario</label>
                <div class = "input-wrapper">
                  <input id = "nombreUsuario" type="text" name="nombreUsuario" placeholder="Nombre de Usuario" autocomplete="off">  
                </div>

                <label for="contrasenia">Contraseña</label>
                <div class = "input-wrapper">
                  <input id="contrasenia" name="contrasenia" type="password" placeholder="Contraseña">
                </div> 

                <div class="loginIncorrecto mensajeError">
                  <?php include "./assets/iconoFallo.html"?>
                  <p>
                    Nombre de usuario o contraseña incorrecta.
                  </p>
                  
                </div>
                
                <div class="loginVacio mensajeError">
                  <?php include "./assets/iconoFallo.html"?>
                  <p>
                    Introduzca nombre de usuario y contraseña.
                  </p>
                </div>

                <button type="submit" class = "boton">Entrar</button>

                </fieldset>
              </form>
            </div>
          </div>
        </div>
      
      
      <a href="https://www.uva.es" class="link-uva">
        <img class="logo" src="assets/logo.png" alt="logo" width = 50>	
      </a>
		</div> 
    <!-- Script que controla la animación del logo -->
    <script>
      const elements = document.getElementsByClassName('logo');

      for (let i = 0; i<=elements.length;i++){
        elements[i].addEventListener('animationend',function(e){
          elements[i].classList.remove("animado");
        });

        elements[i].addEventListener('mouseover', function(e){
          elements[i].classList.add("animado");
        })
      }
    </script>
    <!-- Script que se encarga de mostrar el mensaje de error en caso de que el login no sea correcto -->
    <script>
      const error = document.getElementsByClassName("loginIncorrecto");
      const vacio = document.getElementsByClassName("loginVacio");
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
  </body>
  

</html>

