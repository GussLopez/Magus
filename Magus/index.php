<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Magus - Inicia Sesión</title>
  <link rel="stylesheet" href="Iniciar_s.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet" />
  <link rel="icon" href="img/logo_favi.ico" type="image/x-icon" />
</head>

<body>
  <!-- Chat en vivo -->
<script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/66a8da111601a2195b9e3189/1i41p7m1m';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
</script>
<!--End of Tawk.to Script-->
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
  <footer class="footer">
        <p>© 2024 Magus. Todos los derechos reservados.</p>
    </footer>
</body>

</html>