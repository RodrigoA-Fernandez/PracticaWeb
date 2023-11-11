<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="wrapper">
          <div>
	          <div class = "guest-box">
              <div>
                <form class = "login-form">
                  <fieldset class = "login-form__fieldset">
                    <!---->
                    <!---->
                    <!---->
                    <h2 class = "login-form__headline">Iniciar Sesión</h2>

                    <label for="login">Nombre de Usuario</label>
                    <div class = "input-wrapper">
                      <input id="login" type="text">
                    </div>
                    <label for="contrasenia">Contraseña</label>

                    <div class = "input-wrapper">
                      <input id="contrasenia" type="password">
                    </div>

                  <h1 class = "boton">Entrar</h1>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        <a href="https://www.uva.es" class="link-uva">
          <img class="logo" src="assets/logo.png" alt="logo" width = 50>	
        </a>
		</div> 
  </body>
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

</html>
