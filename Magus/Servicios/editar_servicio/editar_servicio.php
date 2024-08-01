<?php
session_start();
if (!isset($_SESSION['Correo'])) {
    header("Location: ../../index.php");
    exit();
}

include('../../conexion.php'); 

if (!isset($_SESSION['id_usuario'])) {
  header("Location: index.php");
  exit();
}

$id_usuario = $_SESSION['id_usuario'];
if (!isset($_GET['id'])) {
    die("ID de servicio no especificado.");
}

$id_servicio = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['Nombre'];
    $ubicacion = $_POST['Ubicacion_Servicio'];
    $costo = $_POST['Costo'];
    $descripcion = $_POST['Descripcion'];
    $categoria = $_POST['Categoria_Servicio'];

    $sql_update = "UPDATE servicios SET Nombre=?, Ubicacion_Servicio=?, Costo=?, Descripcion=?, Categoria_Servicio=? WHERE $id_servicio=?";
    $stmt_update = $conexion->prepare($sql_update);
    $stmt_update->bind_param("ssissi", $nombre, $ubicacion, $costo, $descripcion, $categoria, $id_servicio);

    if ($stmt_update->execute()) {
        echo "Servicio actualizado con éxito."; 
    } else {
        echo "Error al actualizar el servicio: " . $conexion->error;
    }

    $stmt_update->close();
}

// Consultar los datos del servicio
$sql = "SELECT * FROM servicios WHERE id_servicio = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_servicio);
$stmt->execute();
$result = $stmt->get_result();
$servicio = $result->fetch_assoc();

if (!$servicio) {
    die("Servicio no encontrado.");
}

$stmt->close();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Magus</title>
    <link rel="stylesheet" href="editar.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="../../img/logo_favi.ico" type="image/x-icon" />
  </head>
  <body>
    <head>
      <div class="nav-conteiner">
        <a href="../../inicio.php" class="logo">Magus</a>
        <div class="nav-links">
          <a href="../servicios.php">Mis Servicios</a>
          <a href="../../Usuario/perfil.html">Perfil</a>
          <a href="../../sobre_nosotros/index.html">Sobre Nosotros</a>
        </div>
      </div>
    </head>
    <!-- Formulario para editar el servicio -->
    <form action="editar_servicio.php?$id_servicio=<?= htmlspecialchars($id_servicio) ?>" method="post">
      <div class="tabla-servicio">
        <div class="informacion-servicio">
          <!-- Campo oculto para enviar el ID del servicio -->
          <input type="hidden" name="id_servicio" value="<?= htmlspecialchars($servicio['id_servicio']) ?>" />
          
          <input type="text" name="nombre" placeholder="Nombre del servicio" value="<?= htmlspecialchars($servicio['Nombre']) ?>" />
          <input type="text" name="direccion" placeholder="Dirección del servicio" value="<?= htmlspecialchars($servicio['Ubicacion_Servicio']) ?>" />
          <input type="number" name="costo" placeholder="Costo" class="input-costo" value="<?= htmlspecialchars($servicio['Costo']) ?>" />
          <textarea name="descripcion" placeholder="Descripción"><?= htmlspecialchars($servicio['Descripcion']) ?></textarea>
        </div>
      </div>
    
      <div class="categorias">
        <div class="servicio-realizado">
          <h2>Categorías</h2>
        </div>
        <div class="categorias-menu">
          <select name="categoria" class="categoria-select">
            <option value="Reparaciones e Instalaciones" <?= $servicio['Categoria_Servicio'] == 'Reparaciones e Instalaciones' ? 'selected' : '' ?>>Reparaciones e Instalaciones</option>
            <option value="Cuidado Personal" <?= $servicio['Categoria_Servicio'] == 'Cuidado Personal' ? 'selected' : '' ?>>Cuidado Personal</option>
            <option value="Eventos y Entretenimiento" <?= $servicio['Categoria_Servicio'] == 'Eventos y Entretenimiento' ? 'selected' : '' ?>>Eventos y Entretenimiento</option>
            <option value="Educación y Cursos" <?= $servicio['Categoria_Servicio'] == 'Educación y Cursos' ? 'selected' : '' ?>>Educación y Cursos</option>
            <option value="Salud y Bienestar" <?= $servicio['Categoria_Servicio'] == 'Salud y Bienestar' ? 'selected' : '' ?>>Salud y Bienestar</option>
            <option value="Hogar y Jardineria" <?= $servicio['Categoria_Servicio'] == 'Hogar y Jardineria' ? 'selected' : '' ?>>Hogar y Jardineria</option>
            <option value="Tecnologia" <?= $servicio['Categoria_Servicio'] == 'Tecnologia' ? 'selected' : '' ?>>Tecnologia</option>
            <option value="Automotriz" <?= $servicio['Categoria_Servicio'] == 'Automotriz' ? 'selected' : '' ?>>Automotriz</option>
            <option value="Mascotas" <?= $servicio['Categoria_Servicio'] == 'Mascotas' ? 'selected' : '' ?>>Mascotas</option>
          </select>
        </div>
      </div>
      
      <div class="boton-guardar">
        <input type="submit" value="Guardar cambios">
      </div>
    </form>
    <footer class="footer">
        <p>© 2024 Magus. Todos los derechos reservados.</p>
    </footer>
  </body>
</html>