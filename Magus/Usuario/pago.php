<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Añadir etiquetas meta para móviles e IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> Integración de PayPal Checkout | Demostración del servidor </title>
</head>

<body>
    <!-- Configurar un elemento contenedor para el botón -->
    <div id="paypal-button-container"></div>

    <!-- Incluir el SDK de JavaScript de PayPal -->
    <script src="https://www.paypal.com/sdk/js?client-id=AXHj9LrF9YpJwpPAuHsIC3oaDKqP3wRn_VVsjntmrhUhS8s1qq4MnQatGkDF_miewpdIjGd-mGQFou2k&currency=MXN"></script>

    <script>
        // Renderizar el botón de PayPal en el contenedor #paypal-button-container
        paypal.Buttons({

            // Llamar a tu servidor para configurar la transacción
            createOrder: function(data, actions) {
                return fetch('/demo/checkout/api/paypal/order/create/', {
                    method: 'post'
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },

            // Llamar a tu servidor para finalizar la transacción
            onApprove: function(data, actions) {
                return fetch('/demo/checkout/api/paypal/order/' + data.orderID + '/capture/', {
                    method: 'post'
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    // Tres casos a manejar:
                    //   (1) INSTRUMENT_DECLINED recuperable -> llamar a actions.restart()
                    //   (2) Otros errores no recuperables -> Mostrar un mensaje de fallo
                    //   (3) Transacción exitosa -> Mostrar confirmación o agradecimiento

                    var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                    if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                        return actions.restart(); // Estado recuperable
                    }

                    if (errorDetail) {
                        var msg = 'Lo sentimos, no se pudo procesar su transacción.';
                        if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                        if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                        return alert(msg); // Mostrar un mensaje de fallo
                    }

                    // ¡Captura exitosa! Para propósitos de demostración:
                    console.log('Resultado de la captura', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transacción ' + transaction.status + ': ' + transaction.id + '\n\nVer consola para todos los detalles disponibles');

                    // Reemplazar lo anterior para mostrar un mensaje de éxito en esta página, por ejemplo:
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>¡Gracias por su pago!</h3>';
                    // O ir a otra URL:  actions.redirect('thank_you.html');
                });
            }

        }).render('#paypal-button-container');
    </script>
</body>

</html>
