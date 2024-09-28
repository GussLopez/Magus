<?php
session_start();

if (!isset($_SESSION['Correo'])) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_SESSION['id_usuario'])) {
  header("Location: ../index.php");
  exit();
}

$id_usuario = $_SESSION['id_usuario'];

include('../conexion.php'); 

$query = "SELECT * FROM servicios WHERE id_usuario = '$id_usuario'";
$result = mysqli_query($conexion, $query);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Magus</title>
    <link rel="stylesheet" href="servicios.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="../img/logo_favi.ico" type="image/x-icon" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
      <div class="nav-conteiner">
        <a href="../inicio.php" class="logo">Magus</a>
        <!--  -->
        <div class="search-container">
            <input type="text" id="search" class="buscador" placeholder="Buscar servicios" aria-label="Buscar servicios">
        </div>
        <!--  -->
        <div class="nav-links">
          <a href="servicios.php">Mis Servicios</a>
          <a href="../Usuario/perfil.php">Perfil</a>
          <a href="../sobre_nosotros/index.html">Sobre nosotros</a>
        </div>
      </div>
      <div id="resultados"></div>
    </header>
    <main>
      <div class="servicios-conteiner">
        <p class="breadcrumbs">
          <a href="../inicio.php">Inicio</a> > <a href="#">Tus servicios</a>
        </p>
        <div class="row-h1">
          <h1>Tus servicios</h1>
        </div>
      </div>
      <div class="servicios-section-line">
        <ul>
          <li>
            <a href="publicar_servicio/publicar_servicio.php">+ Nuevo servicio</a>
          </li>
        </ul>
      </div>

        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo '
              <div class="tabla-servicio">
                <div class="servicio-realizado">
                    <h2 class="nombre-servicio">' . $row['Nombre'] . '</h2>
                    <p class="precio-servicio">$' . $row['Costo'] . '</p>
                </div>
                <div class="info-conteiner">
                    <div class="info-servicio">
                        <p class="ubicacion-servicio">' . $row['Ubicacion_Servicio'] . '</p>
                        <div class="servicio-img">
                            <img src="' . $row['imagen_url'] . '" alt="" class="servicio-img" />
                            <p class="descripcion-servicio">' . $row['Descripcion'] . '</p>
                        </div>
                    </div>
                </div>
                <div class="opciones-servicio">
                    <a href="editar_servicio/editar_servicio.php?id=' . $row['id_servicio'] . '" class="boton-editar">
                        <img src="../img/lapiz-de-usuario.png" alt="" class="img-boton" />Editar servicio
                    </a>
                    <a href="#" class="boton-borrar" onclick="confirmarEliminacion(' . $row['id_servicio'] . ')">
                        <img src="../img/basura.png" alt="" class="img-boton" />Eliminar servicio
                    </a>
                </div>
                <br>
              </div>';
          }
      } else {
          echo '<p class="mensaje-sin-servicios">No tienes servicios registrados.</p>';
      }
        ?>
        <!-- Confirmación para eliminar un servicio -->
      <script>
function confirmarEliminacion(id_servicio) {
    if (confirm("¿Estás seguro de que deseas eliminar este servicio?")) {
        window.location.href = "eliminar_servicio.php?id=" + id_servicio;
    }
}
</script>
    </main>
    <footer class="footer">
        <p>© 2024 Magus. Todos los derechos reservados.</p>
    </footer>
    bdo
</body>
<!-- Script del buscador -->
<script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                let query = $(this).val().trim();
                if (query !== "") {
                    $.ajax({
                        url: 'buscador.php',
                        method: 'GET',
                        data: { Servicio: query },
                        success: function(data) {
                            $("#resultados").html(data);
                        },
                        error: function() {
                            $("#resultados").html("<p>Ocurrió un error al realizar la búsqueda. Por favor, intenta nuevamente.</p>");
                        }
                    });
                } else {
                    $("#resultados").html("");
                }
            });
        });
    </script>
    <!-- // -->
</html>
