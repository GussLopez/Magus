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
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT nombre FROM usuarios WHERE id_usuario = $id_usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
} else {
    echo "No se encontró el usuario.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magus</title>
    <link rel="stylesheet" href="perfil_usuario.css">
    <link rel="icon" href="../img/logo_favi.ico" type="image/x-icon" />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
</head>
<body>
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/66ac86a432dca6db2cb90d99/1i48urt4o';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<header>
      <div class="nav-conteiner">
        <a href="../inicio.php" class="logo">Magus</a>
        <div class="nav-links">
          <a href="../Servicios/servicios.php">Mis Servicios</a>
          <a href="../ayuda/contacto.php">Ayuda</a>
        </div>
      </div>
    </header>
    <div class="container">
        <aside class="sidebar">
            <div class="profile-header">
                <img src="../img/user.png" alt="Foto de Perfil" class="profile-pic">
                <h2 class="profile-name"> <?php echo $nombre; ?></h2>
            </div>
            <nav class="profile-nav">
                <ul>
                    <li><a href="informacion_usuario.php?id=<?php echo $id_usuario; ?>">Información de usuario</a></li>
                    <li><a href="../prueba/index.php">Configuración de usuario</a></li>
                    <li><a href="pago.php">Método de pago</a></li>
                </ul>
            </nav>
        </aside>
    </div>
    <footer class="footer">
      <p>© 2024 Magus. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
