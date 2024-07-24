<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Magus</title>
    <link rel="stylesheet" href="inicio.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet" />
    <link rel="icon" href="img/logo_favi.ico" type="image/x-icon" />
</head>

<body>
    <div class="nav-conteiner">
        <a href="index.php" class="logo">Magus</a>
        <div class="nav-links">
            <a href="Servicios/index.html">Mis Servicios</a>
            <a href="#">Perfil</a>
            <a href="#">Sobre Nosotros</a>
        </div>
    </div>
    <a href="CerrarSesion.php" class="boton-cerrar-sesion">Cerrar sesión</a>
    <div class="contenido-titulo">
        <div class="slider">
            <div class="slides">
                <img src="img/servidores.png" alt="Slide 1">
                <img src="img/servidores2.png" alt="Slide 2">
                <img src="img/servidores3.png" alt="Slide 3">
            </div>
            <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
            <button class="next" onclick="moveSlide(1)">&#10095;</button>
        </div>

        <div id="services-container">
            <h2>Lo Mas Nuevo</h2>
            <div id="services"></div>
        </div>

        <footer>
            <div class="footer-container">
                <div>
                    <a href="#" class="footer-link">Términos y condiciones</a>
                    </br /a></br /a>

                    <a href="#" class="footer-link">Acerca de</a>
                </div>
                <div>
                    <p class="copyright">
                        Copyright © 2024 Todos los derechos reservados
                    </p>
                </div>
            </div>
        </footer>

        <script src="script.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                fetch('get_services.php')
                    .then(response => response.json())
                    .then(services => {
                        const servicesContainer = document.getElementById('services');
                        services.forEach(service => {
                            const serviceItem = document.createElement('a');
                            serviceItem.href = `#`;
                            serviceItem.className = 'service-item';
                            serviceItem.innerHTML = `
                            <img src="${service.imagen_url}" alt="${service.nombre}">
                            <div class="service-info">
                                <h3>${service.nombre}</h3>
                                <p>${service.descripcion}</p>
                                <p><strong>Costo:</strong> ${service.costo}</p>
                                <p><strong>Ubicación:</strong> ${service.ubicacion_servicio}</p>
                            </div>
                        `;
                            servicesContainer.appendChild(serviceItem);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>
</body>

</html>