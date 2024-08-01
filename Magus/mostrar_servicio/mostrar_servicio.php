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
    <link rel="stylesheet" href="mostrarservicio.css" />
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
          <a href="../servicios/servicios.php">Mis Servicios</a>
          <a href="../Usuario/perfil.html">Perfil</a>
          <a href="../sobre_nosotros/index.html">Sobre nosotros</a>
        </div>
      </div>
      <div id="resultados"></div>
    </header>
    <main>

        <?php

if (isset($_GET["id_servicio"]) && $_GET["id_servicio"] != '') {
    $id_servicio = $_GET["id_servicio"];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "magus";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM Servicios WHERE id_servicio = ?");
    $stmt->bind_param("i", $id_servicio);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo'   <div class="servicio-conteiner">
                    <div class="img-conteiner">
                        <img src= '. htmlspecialchars($row["imagen_url"]) . ' alt ="imagen del servicio">
                        <h2> Descripción </h2>
                        <p class="descripcion">'. htmlspecialchars($row["Descripcion"]) . '</p>
                    </div>
                    <div class="info-conteiner">
                        <h1>' . htmlspecialchars($row["Nombre"]) . '</h1>
                        <p class="precio">$' . htmlspecialchars($row["Costo"]) . '</p>
                        <div class="ubicacion-conteiner">
                            <p class="ubicacion">Ubicación: ' . htmlspecialchars($row["Ubicacion_Servicio"]) . '</p>
                        </div>
                        <div class="boton-conteiner">
                            <a href="../metodo_pago/seleccionar_pago.php"> Comprar </a>
                        </div>
                    </div>
                </div> ';
    } else {
        echo "<p>Servicio no encontrado.</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>Parámetro de ID no válido.</p>";
}

    ?>

    </main>
    <footer class="footer">
        <p>© 2024 Magus. Todos los derechos reservados.</p>
    </footer>
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
