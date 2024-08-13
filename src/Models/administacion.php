<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepcionista</title>
    <link rel="stylesheet" href="../../Public/styles/admin/administracion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="../../Public/Js/administracion.js"></script>
</head>

<body>
    <div class="container">
        <div class="container-menu">
            <div class="perfil-hotel">
                <img src="https://media.licdn.com/dms/image/C5603AQHspVjFZatw0A/profile-displayphoto-shrink_200_200/0/1517064065833?e=2147483647&v=beta&t=9XPDnNcafi8brTkNtU165Tka09qD19LDA6yKP5ogpkI" alt="hotel">
                <h2>Hotel Las Américas</h2>
            </div>
            <hr>
            <div class="menu-opciones">
                <div class="opciones"><a href="">Habitaciones</a></div>
                <div class="opciones"><a href="javascript:cargarContenido('reservas.php')">Reservas</a></div>
                <div class="opciones"><a href="">Clientes</a></div>
                <div class="opciones"><a href="">Reportes</a></div>
                <div class="opciones"><a href="">Administración</a></div>
            </div>
        </div>

        <div class="container-main">
            <div class="menu-navegacion">
                <a href="" class="home-link">
                    <i class="fas fa-home"></i> Home
                </a>

                <div class="perfil">
                    <img src="https://aulavirtual.cmeducativa.es/wp-content/uploads/avatars/1/5f210a29ad962-bpfull.png" alt="admin">
                    <h2>Juan Perez</h2>
                </div>
                <p><a href="">Cerrar Sesión</a></p>
            </div>

            <!-- EN ESTA PARTE SE CARGARÁN LOS CONTENIDOS -->
            <div class="contenido" id="contenido"></div>

            <footer>
                <p>© 2024 Hotel SUCRE. Todos los derechos reservados.</p>
            </footer>
        </div>
    </div>
</body>

</html>