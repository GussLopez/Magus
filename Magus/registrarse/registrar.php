<?php
$errorMensajes = [];
$mensajeExitoso = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $correo = trim($_POST["correo"]);
    $contrasena = trim($_POST["contrasena"]);
    $telefono = trim($_POST["telefono"]);
    $ciudad = trim($_POST["ciudad"]);

    // Validar que todos los campos estén llenos
    if (empty($nombre)) {
        $errorMensajes['nombre'] = "El nombre es obligatorio.";
    }
    if (empty($apellido)) {
        $errorMensajes['apellido'] = "El apellido es obligatorio.";
    }
    if (empty($correo)) {
        $errorMensajes['correo'] = "El correo es obligatorio.";
    }
    if (empty($contrasena)) {
        $errorMensajes['contrasena'] = "La contraseña es obligatoria.";
    }
    if (empty($telefono)) {
        $errorMensajes['telefono'] = "El teléfono es obligatorio.";
    }
    if ($ciudad == "select") {
        $errorMensajes['ciudad'] = "Selecciona una ciudad.";
    }

    if (empty($errorMensajes)) {
        // Conectar a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "magus";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Insertar datos en la tabla usuarios
        $sql = "INSERT INTO usuarios (Nombre, Apellido, Correo, Contraseña, Telefono) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $apellido, $correo, $contrasena, $telefono);

        if ($stmt->execute()) {
            $mensajeExitoso = "Registro exitoso.";
        } else {
            $errorMensajes['general'] = "Error: " . $stmt->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="registrar_php.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="../img/logo_favi.ico" type="image/x-icon" />
</head>
<body>
    <main>
        <div class="logo">
            <img src="../img/logo_magus.png" alt="Logo Magus" />
        </div>
        <section>
            <h1>Registrarse</h1>
            <div class="conteiner">

                <form action="registrar.php" method="POST" class="forms" id="registerForm">
                    <input type="text" name="nombre" placeholder="Nombre" class="input-registrar" value="<?php echo htmlspecialchars($nombre ?? ''); ?>" />
                    <span class="error-message"><?php echo $errorMensajes['nombre'] ?? ''; ?></span>

                    <input type="text" name="apellido" placeholder="Apellido" class="input-registrar" value="<?php echo htmlspecialchars($apellido ?? ''); ?>" />
                    <span class="error-message"><?php echo $errorMensajes['apellido'] ?? ''; ?></span>

                    <input type="email" name="correo" placeholder="Correo" class="input-registrar" value="<?php echo htmlspecialchars($correo ?? ''); ?>" />
                    <span class="error-message"><?php echo $errorMensajes['correo'] ?? ''; ?></span>

                    <input type="password" name="contrasena" placeholder="Contraseña" class="input-registrar" value="<?php echo htmlspecialchars($contrasena ?? ''); ?>" />
                    <span class="error-message"><?php echo $errorMensajes['contrasena'] ?? ''; ?></span>

                    <input type="tel" name="telefono" placeholder="Telefono" class="input-registrar input-telefono" value="<?php echo htmlspecialchars($telefono ?? ''); ?>" />
                    <span class="error-message"><?php echo $errorMensajes['telefono'] ?? ''; ?></span>

                    <select name="ciudad" class="opciones-registrar">
                        <option value="select" <?php echo ($ciudad ?? '') == 'select' ? 'selected' : ''; ?>>Estado...</option>
                        <option value="Cancún" <?php echo ($ciudad ?? '') == 'Cancún' ? 'selected' : ''; ?>>Cancún</option>
                        <option value="Playa del Carmen" <?php echo ($ciudad ?? '') == 'Playa del Carmen' ? 'selected' : ''; ?>>Playa del Carmen</option>
                        <option value="Tulum" <?php echo ($ciudad ?? '') == 'Tulum' ? 'selected' : ''; ?>>Tulum</option>
                    </select>
                    <span class="error-message"><?php echo $errorMensajes['ciudad'] ?? ''; ?></span>

                    <input type="submit" value="Registrarse" class="boton-enviar" />
                    <p class="texto-iniciar-sesion">
                        ¿Ya tienes cuenta?
                        <a href="../index.php" class="link-iniciar-sesion">Inicia sesión</a>
                    </p>
                </form>
                <?php if (!empty($errorMensajes)): ?>
                    <div class="error-summary">
                        <ul>
                            <?php foreach ($errorMensajes as $message): ?>
                                <li><?php echo $message; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php elseif (!empty($mensajeExitoso)): ?>
                    <div class="success-message">
                        <?php echo $mensajeExitoso; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-conteiner">
            <div>
                <a href="#" class="footer-link">Terminos y condiciones</a>
                <a href="#" class="footer-link">Acerca de</a>
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
