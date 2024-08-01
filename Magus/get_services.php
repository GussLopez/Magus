<?php
header('Content-Type: application/json');

$host = 'localhost'; 
$dbname = 'magus';
$user = 'root'; 
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Incluir 'id_servicio' en la consulta
    $stmt = $pdo->prepare("SELECT id_servicio, nombre, descripcion, costo, ubicacion_servicio, imagen_url FROM servicios ORDER BY id_servicio DESC LIMIT 9");
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($services);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
