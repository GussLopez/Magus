<?php

session_start();
if (!isset($_SESSION['Correo'])) {
    header("Location: ../../index.php");
    exit();
}

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../index.php?error=Usuario no autenticado");
    exit();
}

$errorMessages = [];
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoria = $_POST["categoria"];
    $nombre = trim($_POST["nombre"]);
    $direccion = trim($_POST["direccion"]);
    $costo = trim($_POST["costo"]);
    $imagen_url = trim($_POST["imagen_url"]);
    $descripcion = trim($_POST["descripcion"]);
    $id_usuario = $_SESSION['id_usuario'];

    if (empty($id_usuario)) {
        $errorMessages['general'] = "ID de usuario no válido.";
    }

    if (empty($categoria)) {
        $errorMessages['categoria'] = "Selecciona una categoría.";
    }
    if (empty($nombre)) {
        $errorMessages['nombre'] = "El nombre del servicio es obligatorio.";
    }
    if (empty($direccion)) {
        $errorMessages['direccion'] = "La dirección es obligatoria.";
    }
    if (empty($costo)) {
        $errorMessages['costo'] = "El costo es obligatorio.";
    } elseif (!is_numeric($costo)) {
        $errorMessages['costo'] = "El costo debe ser un número.";
    }
    if (empty($imagen_url)) {
        $errorMessages['imagen_url'] = "La imagen es obligatoria.";
    }
    if (empty($descripcion)) {
        $errorMessages['descripcion'] = "La descripción es obligatoria.";
    }

    if (empty($errorMessages)) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "magus";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "INSERT INTO servicios (id_usuario, Categoria_Servicio, Nombre, Ubicacion_Servicio, Costo, imagen_url, Descripcion) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssss", $id_usuario, $categoria, $nombre, $direccion, $costo, $imagen_url, $descripcion);

        if ($stmt->execute()) {
            $successMessage = "Servicio publicado exitosamente.";
        } else {
            $errorMessages['general'] = "Error: " . $stmt->error;
        }

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
    <title>Magus</title>
    <link rel="stylesheet" href="publicar_servicio.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="../../img/logo_favi.ico" type="image/x-icon" />
    <script>
        function seleccionarCategoria(categoria) {
            // Asignar el valor al campo oculto
            document.getElementById('categoria-input').value = categoria;
        }

        window.onload = function() {
            // Seleccionar la categoría si se ha enviado previamente
            var categoriaSeleccionada = '<?= isset($_POST['categoria']) ? $_POST['categoria'] : '' ?>';
            if (categoriaSeleccionada && categoriaSeleccionada !== "select") {
                document.querySelector('.categoria-select').value = categoriaSeleccionada;
            }
        };
    </script>
  </head>
  <body>
  <?php if ($successMessage): ?>
        <div class="success-message">
            <?= $successMessage ?>
        </div>
    <?php endif; ?>
    <header>
      <div class="nav-conteiner">
        <a href="../../inicio.php" class="logo">Magus</a>
        <div class="nav-links">
          <a href="../servicios.php">Mis Servicios</a>
          <a href="../../Usuario/perfil.html">Perfil</a>
          <a href="../../sobre_nosotros/index.html">Sobre Nosotros</a>
        </div>
      </div>
    </header>

    <div class="servicios-conteiner">
      <p class="breadcrumbs">
        <a href="../../inicio.php">Inicio</a> >
        <a href="../servicios.php">Tus servicios</a> > <a href="">Publicar servicio</a>
      </p>
      <div class="row-h1">
        <h1>Empieza describiendo todo sobre tu servicio</h1>
      </div>
    </div>
    <!-- tabla servicios -->
    <form method="POST" action="publicar_servicio.php">
      <div class="tabla-servicio">
        <div class="servicio-realizado">
          <p>¿A qué categoría pertenece tu servicio?</p>
        </div>
        <div class="categorias-menu">
        <select name="categoria" class="categoria-select" onchange="seleccionarCategoria(this.value)">
                    <option value="select">Selecciona una categoría</option>
                    <option value="Reparaciones e Instalaciones">Reparaciones e Instalaciones</option>
                    <option value="Cuidado Personal">Cuidado Personal</option>
                    <option value="Eventos y Entretenimiento">Eventos y Entretenimiento</option>
                    <option value="Educación y Cursos">Educación y Cursos</option>
                    <option value="Salud y Bienestar">Salud y Bienestar</option>
                    <option value="Hogar y Jardineria">Hogar y Jardineria</option>
                    <option value="Tecnologia">Tecnologia</option>
                    <option value="Automotriz">Automotriz</option>
                    <option value="Mascotas">Mascotas</option>
                </select>
            <?php if(isset($errorMessages['categoria'])): ?>
                    <span class="error-categoria"><?= $errorMessages['categoria'] ?></span>
                <?php endif; ?>
          </ul>
          <input type="hidden" name="categoria" id="categoria-input" value="">
        </div>
        <div class="opciones-servicio">
          <div class="opciones-conteiner">
            <!--         <a href="editar_servicio.html">Editar servicio</a>
        <a href="#">Eliminar servicio</a> -->
          </div>
        </div>
      </div>
      <!-- tabla servicios -->
      <div class="tabla-servicio">
        <div class="servicio-realizado">
          <section>
            <h2>Agrega información a tu servicio</h2>
          </section>
        </div>
        <form action="">
        <div class="informacion-servicio">
        <input type="text" name="nombre" placeholder="Nombre del servicio" value="<?= isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '' ?>" />
                <?php if(isset($errorMessages['nombre'])): ?>
                    <span class="error-nombre"><?= $errorMessages['nombre'] ?></span>
                <?php endif; ?>
                <input type="text" name="direccion" placeholder="Ubicación del servicio" value="<?= isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : '' ?>" />
                <?php if(isset($errorMessages['direccion'])): ?>
                    <span class="error-direccion"><?= $errorMessages['direccion'] ?></span>
                <?php endif; ?>
                <input type="number" name="costo" placeholder="Precio" class="input-costo" value="<?= isset($_POST['costo']) ? htmlspecialchars($_POST['costo']) : '' ?>" />
                <?php if(isset($errorMessages['costo'])): ?>
                    <span class="error-costo"><?= $errorMessages['costo'] ?></span>
                <?php endif; ?>
                <!--  -->
                <input type="text" name="imagen_url" placeholder="URL" class="input-imagen" value="<?= isset($_POST['imagen_url']) ? htmlspecialchars($_POST['imagen_url']) : '' ?>" />
                <?php if(isset($errorMessages['imagen_url'])): ?>
                    <span class="error-imagen"><?= $errorMessages['imagen_url'] ?></span>
                <?php endif; ?>
                <!--  -->
                <textarea name="descripcion" placeholder="Descripción"><?= isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : '' ?></textarea>
                <?php if(isset($errorMessages['descripcion'])): ?>
                    <span class="error-descripcion"><?= $errorMessages['descripcion'] ?></span>
                <?php endif; ?>
            </div>
            <div class="opciones-servicio">
                <div class="opciones-conteiner"></div>
            </div>
            <input type="submit" value="Publicar" class="boton-publicar" />
        </div>
    </form>
    <footer class="footer">
        <p>© 2024 Magus. Todos los derechos reservados.</p>
    </footer>
  </body>
</html>