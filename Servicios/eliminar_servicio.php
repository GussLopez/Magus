<?php
include('../conexion.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_servicio = $_GET['id'];
    echo "ID recibido: " . $id_servicio; 
    
    $query = "DELETE FROM servicios WHERE id_servicio = $id_servicio";

    if (mysqli_query($conexion, $query)) {
        header('Location: servicios.php'); 
        exit();
    } else {
        echo "Error al eliminar el servicio: " . mysqli_error($conexion);
    }
} else {
    echo "ID inválido.";
}