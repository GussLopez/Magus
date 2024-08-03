<?php
include('../conexion.php')

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Magus</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="seleccionar_pago.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="../img/logo_favi.ico" type="image/x-icon" />
    <script>
        $(document).ready(function() {
            $("#metodo_pago").change(function() {
                let metodo_pago = $(this).val();
                let id_servicio = $("input[name='id_servicio']").val();
                
                $.ajax({
                    url: 'formulario_pago.php',
                    method: 'GET',
                    data: { metodo_pago: metodo_pago, id_servicio: id_servicio },
                    success: function(data) {
                        $("#formulario_pago").html(data);
                    },
                    error: function() {
                        $("#formulario_pago").html("<p>Ocurrió un error al cargar el formulario de pago.</p>");
                    }
                });
            });
        });
    </script>
</head>
<body>
<header>
        <div class="nav-conteiner">
            <a href="../inicio.php" class="logo">Magus</a>
            <div class="nav-links">
                <a href="../Servicios/servicios.php">Mis Servicios</a>
                <a href="../Usuario/perfil.html">Perfil</a>
                <a href="../sobre_nosotros/index.html">Sobre Nosotros</a>
            </div>
        </div>
    </header>
    <main>
    <div class="conteiner">
        <h1>Seleccionar Método de Pago</h1>
        <div class="info-conteiner">
            <form id="form_seleccion_pago">
                <input type="hidden" name="id_servicio" >
                <label for="metodo_pago">Método de Pago:</label>
                <select name="metodo_pago" id="metodo_pago">
                    <option value="">Seleccione</option>
                    <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                    <option value="paypal">PayPal</option>
                    <option value="transferencia">Transferencia Bancaria</option>
                </select>
            </form>
            <div id="formulario_pago"></div>
        </div>
    </div>
  </main>
  <footer class="footer">
        <p>© 2024 Magus. Todos los derechos reservados.</p>
    </footer>
    
</body>
</html>
