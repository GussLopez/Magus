<?php
include 'config.php';

$id_usuario = $_GET['id_usuario']; 
$sql = "SELECT nombre, correo, telefono, nombre FROM usuarios WHERE id_usuario = $id_usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $correo = $row['correo'];
    $telefono = $row['telefono'];
    $nombre_usuario = $row['nombre'];
} else {
    echo "No se encontró el usuario.";
}

$conn->close();
?>
