<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Client/public/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./Client/public/css/formulario.css">
    <script src="./Client/public/js/scripts.js"></script>
    <title>Hotel_Reservas</title>
</head>

<body>
    <div class="container">
        <div class="container-encabezado">
            <div class="overlay">
                <div class="hotel">
                    <img src="https://www.shutterstock.com/image-vector/sucre-bolivia-round-travel-stamp-260nw-1892814940.jpg" alt="logo_hotel">
                    <div class="titulo"><a href="javascript:cargarPrincipal('./Client/src/views/inicio.html')">Hotel Sucre</a></div>
                </div>
                <div class="menu">
                    <div class="secciones"><a href="javascript:cargarPrincipal('./Client/src/views/inicio.html')">Inicio</a></div>
                    <div class="secciones"><a href="javascript:cargarContenido('./Client/src/models/promociones.php')">Promociones</a></div>
                    <div class="secciones"><a href="#">Acerca de Nosotros</a></div>
                    <div class="secciones"><a href="javascript:cargarInicioHabitaciones('./Client/src/models/tipos_habitaciones.php')">Habitaciones</a></div>
                </div>
                <div class="roles">
                    <div class="rol-boton">
                        <a href="./Admin/src/views/administacion.php">
                            <i class="fas fa-user-cog icon-admin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-medio">
            <div class="contenido" id="contenido">
                <!-- Contenido cargado dinámicamente aquí -->
            </div>
        </div>

        <div class="container-pie">
            <footer>
                <p>© 2024 Hotel Sucre. Todos los derechos reservados.</p>
                <p>Teléfono: (555) 123-4567 | Email: info@hotelsucre.com</p>
                <p>Dirección: Av. Principal 123, Ciudad, País</p>
                <p><a href="#">Política de Privacidad</a> | <a href="#">Términos y Condiciones</a></p>
            </footer>
        </div>
    </div>


</body>

</html>