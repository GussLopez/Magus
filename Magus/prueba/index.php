<?php
session_start();
if (!isset($_SESSION['Correo'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}
include '../conexion.php';
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT nombre, apellido, correo, telefono, contraseña FROM usuarios WHERE id_usuario = $id_usuario";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $telefono = $row['telefono'];
    $contraseña = $row['contraseña'];
    $correo = $row['correo'];
} else {
    echo "No se encontró el usuario.";
}

// Obtener el mensaje de la sesión
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
unset($_SESSION['mensaje']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Usuario</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="../img/logo_favi.ico" type="image/x-icon" />
</head>
<body>
    <header>
      <div class="nav-conteiner">
        <a href="../inicio.php" class="logo">Magus</a>
        <div class="nav-links">
          <a href="../Usuario/perfil.php">Perfil</a>
          <a href="../ayuda/contacto.php">Ayuda</a>
        </div>
      </div>
    </header>

    <div class="container">
        <h1>Configuración de Usuario</h1>

        <?php if ($mensaje): ?>
            <div class="mensaje"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        
        <div class="user-info">
            <h2>Editar información personal</h2>
            <form action="guardar_info.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>">
                
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($correo); ?>">
                
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>">
                
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>

        <div class="user-settings">
            <h2>Cambiar contraseña</h2>
            <form action="cambiar_contraseña.php" method="POST">
                <label for="contraseña">Contraseña Actual:</label>
                <input type="password" id="contraseña" name="contraseña">
                
                <label for="nueva-contraseña">Nueva Contraseña:</label>
                <input type="password" id="nueva-contraseña" name="nueva-contraseña">
                
                <label for="confirmar-contraseña">Confirmar Nueva Contraseña:</label>
                <input type="password" id="confirmar-contraseña" name="confirmar-contraseña">
                <button type="submit">Actualizar Contraseña</button>
            </form>
        </div>
    </div>
    <footer class="footer">
      <p>© 2024 Magus. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
