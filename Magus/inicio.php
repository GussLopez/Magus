<?php
session_start();
if (!isset($_SESSION['Correo'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}
include('conexion.php'); 



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Magus</title>
    <link rel="stylesheet" href="iniciophp.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="img/logo_favi.ico" type="image/x-icon" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
        <!-- Chat en vivo -->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/66a8da111601a2195b9e3189/1i41p7m1m';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    <header>
      <div class="nav-conteiner">
        <a href="inicio.php" class="logo">Magus</a>
        <!--  -->
        <div class="search-container">
            <input type="text" id="search" class="buscador" placeholder="Buscar servicios" aria-label="Buscar servicios">
        </div>

        <!--  -->
        <div class="nav-links">
            <a href="Servicios/servicios.php">Mis Servicios</a>
            <a href="Usuario/perfil.html">Perfil</a>
            <a href="sobre_nosotros/index.html">Sobre Nosotros</a>
        </div>
      </div>
        <div id="resultados"></div>

      <main>
        <a href="CerrarSesion.php" class="boton-cerrar-sesion">Cerrar sesión</a>
        <div class="contenido-titulo">
            <h1>Encuentra y Ofrece Servicios de Confianza <br> para tu Hogar y Más</h1>
        </div>
      </main>
    </header>
    

    <!-- Script del buscador -->
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
    <!-- // -->
    <div id="services-container">
        <h2>Lo Mas Nuevo</h2>
        <div id="services"></div>
    </div>
    <footer class="footer">
        <p>© 2024 Magus. Todos los derechos reservados.</p>
    </footer> 

  </body>
  <!-- Script de los servicios -->
  <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('get_services.php')
                .then(response => response.json())
                .then(services => {
                    const servicesContainer = document.getElementById('services');
                    services.forEach(service => {
                        const serviceItem = document.createElement('a');
                        serviceItem.href = `mostrar_servicio/mostrar_servicio.php?id_servicio=${service.id_servicio}`;
                        serviceItem.className = 'service-item';
                        serviceItem.innerHTML = `
                            <img src="${service.imagen_url}" alt="${service.nombre}">
                            <div class="service-info">
                                <h3>${service.nombre}</h3>
                                <p class="servicio-descripcion">${service.descripcion}</p>
                                <p class="servicio-precio"><strong>$</strong> ${service.costo}</p>
                                <p class="servicio-ubicacion"><strong>Ubicación:</strong> ${service.ubicacion_servicio}</p>
                            </div>
                        `;
                        servicesContainer.appendChild(serviceItem);
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</html>
