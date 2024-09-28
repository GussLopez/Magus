<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];


    var_dump($_POST);
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: index.php");
        exit();
    }

    $id_usuario = $_SESSION['id_usuario'];
    include '../conexion.php';

    $sql = "UPDATE usuarios SET nombre=?, apellido=?, correo=?, telefono=? WHERE id_usuario=?";

    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("ssssi", $nombre, $apellido, $correo, $telefono, $id_usuario);

        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "Información personal guardada correctamente";
        } else {
            $_SESSION['mensaje'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['mensaje'] = "Error: " . $conexion->error;
    }

    $conexion->close();

    header("Location: index.php");
    exit();
}
?>
