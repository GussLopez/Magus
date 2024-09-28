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

include 'config.php';

$id_usuario = $_GET['id']; // Obteniendo el ID del usuario desde la URL

// Consulta para obtener la información del usuario
$sql = "SELECT nombre, apellido, correo, telefono FROM usuarios WHERE id_usuario = $id_usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener los datos del usuario
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $correo = $row['correo'];
    $telefono = $row['telefono'];
} else {
    echo "No se encontró el usuario.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Usuario</title>
    <link rel="stylesheet" href="info_usuario.css">
    <link rel="icon" href="../img/logo_favi.ico" type="image/x-icon" />
</head>
<body>
<header>
      <div class="nav-conteiner">
        <a href="../inicio.php" class="logo">Magus</a>
        <div class="nav-links">
          <a href="../Usuario/perfil.php">Perfil</a>
          <a href="../Usuario/perfil.html">Ayuda</a>
        </div>
      </div>
    </header>
    <div class="container profile-container">
        <aside class="sidebar">
            <div class="profile-header">
                <img src="../img/user.png" alt="Foto de Perfil" class="profile-pic">
                <h2 class="profile-name"><?php echo $nombre; ?></h2>
            </div>
            <div class="profile-info">
                <p><strong>Correo:</strong> <?php echo $apellido; ?></p>
                <p><strong>Correo:</strong> <?php echo $correo; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $telefono; ?></p>
            </div>
        </aside>
    </div>
    <footer class="footer">
      <p>© 2024 Magus. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
