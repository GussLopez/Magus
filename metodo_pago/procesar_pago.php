<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Procesar Pago</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="procesar_pago.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="../img/logo_favi.ico" type="image/x-icon" />
    <script>
        $(document).ready(function() {
            $("input[name='metodo_pago']").on("change", function() {
                let metodo_pago = $(this).val();
                $("#formulario_pago").empty(); // Limpiar el contenedor del formulario
                
                let formulario = "";
                
                if (metodo_pago == 'tarjeta') {
                    formulario += `
                        <form action="confirmar_pago.php" method="POST">
                            <input type="hidden" name="id_servicio" value="${$("#id_servicio").val()}">
                            <input type="hidden" name="metodo_pago" value="${metodo_pago}">
                            <label for="numero_tarjeta">Número de Tarjeta:</label>
                            <input type="text" name="numero_tarjeta" id="numero_tarjeta" required>
                            <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
                            <input type="text" name="fecha_vencimiento" id="fecha_vencimiento" required>
                            <label for="cvv">CVV:</label>
                            <input type="text" name="cvv" id="cvv" required>
                            <button type="submit">Pagar</button>
                        </form>
                    `;
                } else if (metodo_pago == 'paypal') {
                    formulario += `
                        <form action="confirmar_pago.php" method="POST">
                            <input type="hidden" name="id_servicio" value="${$("#id_servicio").val()}">
                            <input type="hidden" name="metodo_pago" value="${metodo_pago}">
                            <label for="email_paypal">Correo Electrónico de PayPal:</label>
                            <input type="email" name="email_paypal" id="email_paypal" required>
                            <button type="submit">Pagar</button>
                        </form>
                    `;
                } else if (metodo_pago == 'transferencia') {
                    formulario += `
                        <form action="confirmar_pago.php" method="POST">
                            <input type="hidden" name="id_servicio" value="${$("#id_servicio").val()}">
                            <input type="hidden" name="metodo_pago" value="${metodo_pago}">
                            <label for="cuenta_bancaria">Número de Cuenta Bancaria:</label>
                            <input type="text" name="cuenta_bancaria" id="cuenta_bancaria" required>
                            <button type="submit">Pagar</button>
                        </form>
                    `;
                } else {
                    formulario += "<p>Método de pago no válido.</p>";
                }
                
                $("#formulario_pago").html(formulario);
            });
        });
    </script>
</head>
<body>
    <header>
        <div class="nav-conteiner">
            <a href="inicio.php" class="logo">Magus</a>
            <div class="nav-links">
                <a href="Servicios/servicios.php">Mis Servicios</a>
                <a href="Usuario/perfil.html">Perfil</a>
                <a href="sobre_nosotros/index.html">Sobre Nosotros</a>
            </div>
        </div>
    </header>
    <main>
    <div class="conteiner">

        <h1>Seleccionar Método de Pago</h1>
        <div>

        <input type="hidden" id="id_servicio" value="<?php echo isset($_GET['id_servicio']) ? htmlspecialchars($_GET['id_servicio']) : ''; ?>">
        <label><input type="radio" name="metodo_pago" value="tarjeta"> Tarjeta de Crédito/Débito</label>
        <label><input type="radio" name="metodo_pago" value="paypal"> PayPal</label>
        <label><input type="radio" name="metodo_pago" value="transferencia"> Transferencia Bancaria</label>

        <div id="formulario_pago"></div>
        </div>

    </div>

  </main>
  <footer class="footer">
        <p>© 2024 Magus. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
