<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    include 'config.php';

    $sql = "INSERT INTO atencion_cliente (Nombre, correo, Mensaje) VALUES ('$nombre', '$correo', '$mensaje')";

    if ($conn->query($sql) === TRUE) {
        echo "Gracias por tus comentarios";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
    $conn->close();
}
?>

