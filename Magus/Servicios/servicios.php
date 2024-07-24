<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Magus</title>
    <link rel="stylesheet" href="servicios.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="/icono/logo_favi.ico" type="image/x-icon" />
  </head>
  <body>
    <header>
      <div class="nav-conteiner">
        <a href="/" class="logo">Magus</a>
        <div class="busqueda">
          <label for="">
            <input
              class="buscador"
              type="search"
              placeholder="Buscar servicios"
            />
          </label>
        </div>
        <div class="nav-links">
          <a href="#">Mis Servicios</a>
          <a href="#">Perfil</a>
          <a href="#">Sobre nosotros</a>
        </div>
      </div>
    </header>
    <main>
      <div class="servicios-conteiner">
        <p class="breadcrumbs">
          <a href="/">Mi cuenta</a> > <a href="#">Tus servicios</a>
        </p>
        <div class="row-h1">
          <h1>Tus servicios</h1>
        </div>
      </div>
      <!-- División del h1 -->
      <div class="servicios-section-line">
        <ul>
          <li>
            <a href="publicar_servicio/publicar_servicio.php"
              >+ Nuevo servicio</a
            >
          </li>
        </ul>
      </div>
      <!-- tabla servicios -->
      <div class="tabla-servicio">
        <div class="servicio-realizado">
          <h2 class="nombre-servicio">Nombre del servicio</h2>
          <p class="precio-servicio">Precio</p>
        </div>
        <div class="info-conteiner">
          <div class="info-servicio">
            <p class="ubicacion-servicio">Ubicación del servicio</p>
            <div class="servicio-img">
              <img
                src="../img/persona-munequita.png"
                alt=""
                class="servicio-img"
              />
              <p class="descripcion-servicio">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque
                enim laboriosam provident voluptatem, veritatis asperiores quia,
                velit fugit esse quas repellendus aspernatur ab repudiandae
                minus repellat perferendis labore quis sequi at dolorum a
                deserunt? Temporibus facere autem sint cum totam, unde tempore
                perferendis suscipit impedit aspernatur sapiente natus, alias
                dolore iste quas consequuntur et odit eum illum ex aut, illo
                corrupti corporis non.
              </p>
            </div>
          </div>
        </div>
        <div class="opciones-servicio">
          <a href="editar_servicio/editar_servicio.html" class="boton-editar"
            ><img
              src="../img/lapiz-de-usuario.png"
              alt=""
              class="img-boton"
            />Editar servicio
          </a>
          <button href="#" class="boton-borrar">
            <img src="../img/basura.png" alt="" class="img-boton" />Eliminar
            servicio
          </button>
        </div>
      </div>
    </main>
  </body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Magus</title>
    <link rel="stylesheet" href="servicios.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="../img/logo_favi.ico" type="image/x-icon" />
  </head>
  <body>
    <header>
      <div class="nav-conteiner">
        <a href="../inicio.php" class="logo">Magus</a>
        <div class="busqueda">
          <label for="">
            <input
              class="buscador"
              type="search"
              placeholder="Buscar servicios"
            />
          </label>
        </div>
        <div class="nav-links">
          <a href="#">Mis Servicios</a>
          <a href="#">Perfil</a>
          <a href="#">Sobre nosotros</a>
        </div>
      </div>
    </header>
    <main>
      <div class="servicios-conteiner">
        <p class="breadcrumbs">
          <a href="/">Mi cuenta</a> > <a href="#">Tus servicios</a>
        </p>
        <div class="row-h1">
          <h1>Tus servicios</h1>
        </div>
      </div>
      <!-- División del h1 -->
      <div class="servicios-section-line">
        <ul>
          <li>
            <a href="publicar_servicio/publicar_servicio.php"
              >+ Nuevo servicio</a
            >
          </li>
        </ul>
      </div>
      <!-- tabla servicios -->
      <div class="tabla-servicio">
        <div class="servicio-realizado">
          <h2 class="nombre-servicio">Nombre del servicio</h2>
          <p class="precio-servicio">Precio</p>
        </div>
        <div class="info-conteiner">
          <div class="info-servicio">
            <p class="ubicacion-servicio">Ubicación del servicio</p>
            <div class="servicio-img">
              <img
                src="../img/persona-munequita.png"
                alt=""
                class="servicio-img"
              />
              <p class="descripcion-servicio">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque
                enim laboriosam provident voluptatem, veritatis asperiores quia,
                velit fugit esse quas repellendus aspernatur ab repudiandae
                minus repellat perferendis labore quis sequi at dolorum a
                deserunt? Temporibus facere autem sint cum totam, unde tempore
                perferendis suscipit impedit aspernatur sapiente natus, alias
                dolore iste quas consequuntur et odit eum illum ex aut, illo
                corrupti corporis non.
              </p>
            </div>
          </div>
        </div>
        <div class="opciones-servicio">
          <a href="editar_servicio/editar_servicio.html" class="boton-editar"
            ><img
              src="../img/lapiz-de-usuario.png"
              alt=""
              class="img-boton"
            />Editar servicio
          </a>
          <button href="#" class="boton-borrar">
            <img src="../img/basura.png" alt="" class="img-boton" />Eliminar
            servicio
          </button>
        </div>
      </div>
    </main>
  </body>
</html>
