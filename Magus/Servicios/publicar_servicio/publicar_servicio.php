<?php
$errorMessages = [];
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $categoria = $_POST["categoria"];
    $nombre = trim($_POST["nombre"]);
    $direccion = trim($_POST["direccion"]);
    $costo = trim($_POST["costo"]);
    $descripcion = trim($_POST["descripcion"]);

    // Validar que todos los campos estén llenos
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
    if (empty($descripcion)) {
        $errorMessages['descripcion'] = "La descripción es obligatoria.";
    }

    // Si no hay errores, proceder con la inserción en la base de datos
    if (empty($errorMessages)) {
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

        $sql = "INSERT INTO servicios (Categoria_Servicio, Nombre, Ubicacion_Servicio, Costo, Descripcion) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $categoria, $nombre, $direccion, $costo, $descripcion);

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
    <link rel="stylesheet" href="publicar.css" />
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
    <head>
      <div class="nav-conteiner">
        <a href="/" class="logo">Magus</a>
        <div class="nav-links">
          <a href="/Servicios/index.html">Mis Servicios</a>
          <a href="#">Perfil</a>
          <a href="#">Sobre Nosotros</a>
        </div>
      </div>
    </head>

    <div class="servicios-conteiner">
      <p class="breadcrumbs">
        <a href="/">Mi cuenta</a> >
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
                <input type="text" name="direccion" placeholder="Dirección del servicio" value="<?= isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : '' ?>" />
                <?php if(isset($errorMessages['direccion'])): ?>
                    <span class="error-direccion"><?= $errorMessages['direccion'] ?></span>
                <?php endif; ?>
                <input type="number" name="costo" placeholder="Costo" class="input-costo" value="<?= isset($_POST['costo']) ? htmlspecialchars($_POST['costo']) : '' ?>" />
                <?php if(isset($errorMessages['costo'])): ?>
                    <span class="error-costo"><?= $errorMessages['costo'] ?></span>
                <?php endif; ?>
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
    <footer>
      <div class="footer-conteiner">
        <div>
          <a href="#" class="footer-link">Terminos y condiciones</a
          ><a href="#" class="footer-link">Acerca de</a>
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