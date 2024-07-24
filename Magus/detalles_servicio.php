<?php
if (isset($_GET["id_servicio"]) && $_GET["id_servicio"] != '') {
    $id_servicio = $_GET["id_servicio"];
    
    // Conexión a la base de datos
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
        echo "<div class='detalle-servicio'>";
        echo "<h1>" . htmlspecialchars($row["Nombre"]) . "</h1>";
        echo "<p>Precio: $" . htmlspecialchars($row["Costo"]) . "</p>";
        echo "<p>Ubicación: " . htmlspecialchars($row["Ubicacion_Servicio"]) . "</p>";
        echo "<img src='" . htmlspecialchars($row["imagen_url"]) . "' alt='Imagen del servicio'>";
        echo "<p>Descripción: " . htmlspecialchars($row["descripcion"]) . "</p>"; // Asegúrate de tener esta columna en tu base de datos
        echo "</div>";
    } else {
        echo "<p>Servicio no encontrado.</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>Parámetro de ID no válido.</p>";
}
?>
