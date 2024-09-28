<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="contacto.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
</head>
<body>
<header>
      <div class="nav-conteiner">
        <a href="../inicio.php" class="logo">Magus</a>
        <div class="nav-links">
          <a href="../Usuario/perfil.php">Perfil</a>
          <a href="../sobre_nosotros/index.html">Sobre nosotros</a>
        </div>
      </div>
    </header>
    <div class="container">
        <h1>Contactanos</h1>
        <form action="procesar_contacto.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required>
            
            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" required></textarea>
            
            <button type="submit">Enviar Mensaje</button>
        </form>
    </div>
    <footer class="footer">
      <p>© 2024 Magus. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

