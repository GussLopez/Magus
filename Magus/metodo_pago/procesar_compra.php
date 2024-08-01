<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id_servicio"]) && isset($_POST["metodo_pago"])) {
        $id_servicio = $_POST["id_servicio"];
        $metodo_pago = $_POST["metodo_pago"];
        
        // Aquí se debe procesar el pago según el método seleccionado
        // ...

        // Redirigir a la página de confirmación
        header("Location: confirmar_pago.php");
        exit();
    } else {
        echo "<p>Faltan datos para procesar el pago.</p>";
    }
} else {
    echo "<p>Solicitud no válida.</p>";
}
?>
