<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metrobus - Página de Bienvenida</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .navbar {
            transition: background-color 0.3s ease;
        }

        .navbar:hover {
            background-color: #0056b3;
        }

        .navbar-nav .nav-link {
            font-size: 1.1rem;
            padding: 10px 15px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ffcc00;
        }

        .navbar .btn-warning {
            font-size: 1.1rem;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }

        .navbar .btn-warning:hover {
            background-color: #e6a800;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/simular_uso">Metrobus</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav d-flex">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#servicios">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tarifas">Tarifas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning px-4" href="{{ route('mostrarLogin') }}" role="button">Colaboradores</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
    <!-- Sección Servicios -->
    <section id="servicios" class="bg-light py-5 mt-5">
        <div class="container text-center">
            <h2 class="mb-5">Servicios</h2>
            <div class="row">
                <div class="col-md-4">
                    <h4>Metrobus</h4>
                    <p>El sistema de transporte más utilizado de la ciudad, con rutas que cubren amplias zonas urbanas.</p>
                </div>
                <div class="col-md-4">
                    <h4>Metro</h4>
                    <p>Un servicio subterráneo rápido y eficiente para moverse por las zonas más densas de la ciudad.</p>
                </div>
                <div class="col-md-4">
                    <h4>Metropass</h4>
                    <p>Una opción de prepago que te da acceso a todos nuestros servicios con tarifas especiales.</p>
                </div>
            </div>
        </div>
    </section>
    
    
    <!-- Sección Nosotros -->
    <section id="nosotros" class="container py-5 mt-5">
        <div class="row text-center">
            <div class="col">
                <h2 class="mb-5">¿Quiénes Somos?</h2>
                <p>Somos una empresa comprometida con ofrecer un servicio de transporte público eficiente, seguro y accesible para todos nuestros usuarios. Brindamos opciones que se adaptan a las necesidades de cada persona, con un enfoque en la calidad y el respeto al medio ambiente.</p>
            </div>
        </div>
    </section>

    
    <!-- Sección Tarifas -->
    <section id="tarifas" class="container py-5">
    <div class="row text-center">
        <div class="col">
            <h2 class="mb-4">Tarifas</h2>
            <div class="row">
                <!-- Metrobus Tarifa -->
                <div class="col-md-4 mb-4">
                    <h4 class="text-primary">Servicio de Metrobus</h4>
                    <ul class="list-unstyled">
                        <li><strong>Normal</strong>: <span class="text-success">B./0.25</span></li>
                        <li><strong>Estudiantil</strong>: <span class="text-success">B./0.10</span></li>
                        <li><strong>Jubilados</strong>: <span class="text-success">B./0.15</span></li>
                    </ul>
                </div>
                <!-- Metro Tarifa -->
                <div class="col-md-4 mb-4">
                    <h4 class="text-primary">Servicio de Metro</h4>
                    <ul class="list-unstyled">
                        <li><strong>Normal</strong>: <span class="text-success">B./0.50</span></li>
                        <li><strong>Estudiantil</strong>: <span class="text-success">B./0.20</span></li>
                        <li><strong>Jubilados</strong>: <span class="text-success">B./0.30</span></li>
                    </ul>
                </div>
                    <!-- Metropass Tarifa -->
                    <div class="col-md-4 mb-4">
                        <h4 class="text-primary">Servicio de Metropass</h4>
                        <ul class="list-unstyled">
                            <li><strong>Para todos los usuarios</strong>: <span class="text-success">B./0.10</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Sección Contacto -->
    <section id="contacto" class="bg-light py-5">
        <div class="container text-center">
            <h2 class="mb-4">Contacto</h2>
            <p class="lead mb-4">Para más información, dudas o sugerencias, por favor, contáctanos a través de los siguientes canales:</p>
            <ul class="list-unstyled">
                <li class="mb-2"><i class="bi bi-envelope-fill text-primary"></i> <strong>Email:</strong> <a href="#">contacto@metrobus.com</a></li>
                <li class="mb-2"><i class="bi bi-telephone-fill text-primary"></i> <strong>Teléfono:</strong> +507 1234 5678</li>
                <li class="mb-2"><i class="bi bi-geo-alt-fill text-primary"></i> <strong>Dirección:</strong> Ciudad de Panamá, Panamá</li>
            </ul>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Metrobus. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0irj1Ft2j2l+eJjglR1jU5j4sZZh3K1sIm8ZXm0G5DldkpzL" crossorigin="anonymous"></script>




    <!-- Scripts de Bootstrap (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
    </body>
</html>
