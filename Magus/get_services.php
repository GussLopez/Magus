<?php
header('Content-Type: application/json');

// Conectar a la base de datos
$host = 'localhost'; // Cambia esto si tu host es diferente
$dbname = 'magus'; // Cambia esto por el nombre de tu base de datos
$user = 'root'; // Cambia esto por tu nombre de usuario
$password = ''; // Cambia esto por tu contraseña

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consulta para obtener los últimos 9 servicios
    $stmt = $pdo->prepare("SELECT nombre, descripcion, costo, ubicacion_servicio, imagen_url FROM servicios ORDER BY id_servicio DESC LIMIT 9");
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($services);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
