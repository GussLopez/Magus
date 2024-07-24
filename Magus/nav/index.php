<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_nav.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Magus</title>
</head>
<body>
    <div class="nav-conteiner">
        <a href="/" class="logo">Magus</a>
        <div class="busqueda">
            <input type="text" id="search" class="buscador" placeholder="Ingresa el nombre del servicio" aria-label="Buscar servicios">
        </div>
        <div class="nav-links">
            <a href="#">Mis Servicios</a>
            <a href="#">Perfil</a>
            <a href="#">Sobre Nosotros</a>
        </div>
    </div>

    <div id="resultados"></div>

    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                let query = $(this).val().trim();
                if (query !== "") {
                    $.ajax({
                        url: 'buscador.php',
                        method: 'GET',
                        data: { Servicio: query },
                        success: function(data) {
                            $("#resultados").html(data);
                        },
                        error: function() {
                            $("#resultados").html("<p>Ocurrió un error al realizar la búsqueda. Por favor, intenta nuevamente.</p>");
                        }
                    });
                } else {
                    $("#resultados").html("");
                }
            });
        });
    </script>
</body>
</html>
