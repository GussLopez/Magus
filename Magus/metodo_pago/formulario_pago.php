<?php
if (isset($_GET['metodo_pago']) && isset($_GET['id_servicio'])) {
    $metodo_pago = $_GET['metodo_pago'];
    $id_servicio = $_GET['id_servicio'];

    if ($metodo_pago == 'tarjeta') {
        echo '
            <form action="procesar_compra.php" method="POST">
                <input type="hidden" name="id_servicio" value="' . htmlspecialchars($id_servicio) . '">
                <input type="hidden" name="metodo_pago" value="' . htmlspecialchars($metodo_pago) . '">
                <label for="numero_tarjeta">Número de Tarjeta:</label>
                <input type="text" name="numero_tarjeta" id="numero_tarjeta" required>
                <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
                <input type="text" name="fecha_vencimiento" id="fecha_vencimiento" required>
                <label for="cvv">CVV:</label>
                <input type="text" name="cvv" id="cvv" required>
                <button type="submit">Pagar</button>
            </form>
        ';
    } elseif ($metodo_pago == 'paypal') {
        echo '
            <form action="procesar_compra.php" method="POST">
                <input type="hidden" name="id_servicio" value="' . htmlspecialchars($id_servicio) . '">
                <input type="hidden" name="metodo_pago" value="' . htmlspecialchars($metodo_pago) . '">
                <label for="email_paypal">Correo Electrónico de PayPal:</label>
                <input type="email" name="email_paypal" id="email_paypal" required>
                <button type="submit">Pagar</button>
            </form>
        ';
    } elseif ($metodo_pago == 'transferencia') {
        echo '
            <form action="procesar_compra.php" method="POST">
                <input type="hidden" name="id_servicio" value="' . htmlspecialchars($id_servicio) . '">
                <input type="hidden" name="metodo_pago" value="' . htmlspecialchars($metodo_pago) . '">
                <label for="cuenta_bancaria">Número de Cuenta Bancaria:</label>
                <input type="text" name="cuenta_bancaria" id="cuenta_bancaria" required>
                <button type="submit">Pagar</button>
            </form>
        ';
    } else {
        echo "<p>Método de pago no válido.</p>";
    }
} else {
    echo "<p>Parámetros no válidos.</p>";
}
?>
