<?php
include('../conexion.php')

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Seleccionar Método de Pago</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <div class="container">
        <h1>Seleccionar Método de Pago</h1>
        <form id="form_seleccion_pago">
            <input type="hidden" name="id_servicio" value="<?php echo $_GET['id_servicio']; ?>">
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
</body>
</html>
