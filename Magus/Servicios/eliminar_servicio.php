<?php
session_start();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['Correo']) || !isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Verificar que se haya pasado el ID del servicio a eliminar
if (!isset($_GET['id'])) {
    die("ID de servicio no especificado.");
}

$id_servicio = $_GET['id'];
$id_usuario = $_SESSION['id_usuario'];

// Conectar a la base de datos
include('../conexion.php');

// Preparar y ejecutar la consulta para eliminar el servicio
$sql = "DELETE FROM servicios WHERE id_servicio = ? AND id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ii", $id_servicio, $id_usuario);

if ($stmt->execute()) {
    echo "Servicio eliminado exitosamente.";
} else {
    echo "Error al eliminar el servicio: " . $conexion->error;
}

$stmt->close();
$conexion->close();

// Redireccionar a la página de servicios
header("Location: servicios.php");
exit();
?>
