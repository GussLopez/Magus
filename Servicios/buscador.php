<?php
if (isset($_GET["Servicio"]) && $_GET["Servicio"] != '') {
    $servername = "localhost";
    $username = "root";
    $password = "123456789";
    $database = "magus";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    $Servicio = $_GET['Servicio'];

    $stmt = $conn->prepare("SELECT * FROM servicios WHERE Nombre LIKE ?");
    $searchTerm = "%" . $Servicio . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            if (isset($row["id_servicio"])) {
                $url = "detalle_servicio.php?id_servicio=" . $row["id_servicio"];
                echo "<li>";
                echo "<a href='" . $url . "'>";
                echo "<div>";
                echo "<h3>" . htmlspecialchars($row["Nombre"]) . "</h3>";
                echo "<p>Tiene un precio de $" . htmlspecialchars($row["Costo"]) . ". Ubicación: " . htmlspecialchars($row["Ubicacion_Servicio"]) . "</p>";
                echo "</div>";
                echo "<img src='" . htmlspecialchars($row["imagen_url"]) . "' alt='Imagen del servicio'>";
                echo "</a>";
                echo "</li>";
            } else {
                echo "<li>Servicio sin ID.</li>";
            }
        }
        echo "</ul>";
    } else {
        echo "No se encontraron resultados para el servicio buscado.";
    }

    $stmt->close();
    $conn->close();
}
?>
