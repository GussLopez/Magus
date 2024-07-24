<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Magus</title>
  <link rel="stylesheet" href="styles_iniciar_sesion.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet" />
  <link rel="icon" href="/icono/logo_favi.ico" type="image/x-icon" />
</head>

<body>
  <main>
    <div class="conteiner">
      <div class="logo">
        <img src="img/logo_magus.png" alt="Logo Magus" />
      </div>

      <h1>Iniciar sesión</h1>
      <hr>
      <?php
      if (isset($_GET['error'])) {
      ?>
        <p class="error">
          <?php
          echo $_GET['error']
          ?>
        </p>

      <?php
      }
      ?>


      <hr>
      <form action="iniciar_sesion.php" method="POST">
        <div class="datos">
          <input type="email" name="email" class="login" placeholder="Correo" />
          <input type="password" name="password" class="login contra-login" placeholder="Contraseña" />
        </div>
        <div class="above">
          <a href="#" class="link-contraseña">¿Olvido su contraseña?</a>
          <input type="submit" value="Iniciar sesión" class="boton-enviar" />
        </div>
      </form>

      <div class="registrar">
        <p>
          ¿No tiene cuenta?
          <a href="registrarse/registrar.php" class="boton-registrarse">Registrarse</a>
        </p>
      </div>
    </div>
  </main>
  <footer>
    <div class="footer-conteiner">
      <div>
        <a href="#" class="footer-link">Terminos y condiciones</a><a href="#" class="footer-link">Acerca de</a>
      </div>
      <div>
        <p class="copyright">
          Copyright © 2024 Todos los derechos reservados
        </p>
      </div>
    </div>
  </footer>
</body>

</html>