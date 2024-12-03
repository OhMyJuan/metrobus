<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MetroBus - Panel</title>
    <!-- Agrega tus estilos CSS aquí -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    /* Estilo base para el texto */
    .texto-subrayado {
        position: relative;
        display: inline-block;
    }

    .texto-subrayado:hover {
        font-weight: bold; /* Puedes ajustar el peso del texto */
    }

    /* Subrayado cuando el mouse pasa por encima */
    .texto-subrayado::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px; /* Grosor del subrayado */
        background-color: #ccc; /* Color del subrayado */
        transform: scaleX(0);
        font-weight: bold; /* Puedes ajustar el peso del texto */
        
        transition: transform 0.15s ease-out;
    }

    /* Activar el subrayado cuando el mouse pasa sobre el texto */
    .texto-subrayado:hover::after {
        transform: scaleX(1);
        transform-origin: bottom;   
    }

    </style>

</head>
<body>
    <div class="container-fluid">
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            @if(auth()->user())
                <a class="navbar-brand" href="" disabled>MetroBus</a>
            @else
                <a class="navbar-brand" href="/" disabled>MetroBus</a>
            @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <!-- Mostrar botones dependiendo del rol del usuario -->
                        @if(auth()->user()->rol === 'admin')
                            <li class="nav-item m-2 texto-subrayado">
                                <a class="nav-link" href="{{ route('admin.mostrarCrearUsuario') }}">Crear Usuario</a>
                            </li>
                            <li class="nav-item m-2 texto-subrayado">
                                <a class="nav-link" href="{{ route('admin.mostrarCrearTarjeta') }}">Registrar Tarjeta</a>
                            </li>
                        @endif

                        @if(auth()->user()->rol === 'operador')
                            <li class="nav-item m-2 texto-subrayado">
                                <a class="nav-link" href="{{ route('operador.mostrarRecargar') }}">Recargar Saldo</a>
                            </li>
                            <li class="nav-item m-2 texto-subrayado">
                                <a class="nav-link" href="{{ route('operador.mostrarConsultarSaldo') }}">Consultar Tarjeta</a>
                            </li>
                        @endif


                        <li class="nav-item m-2 texto-subrayado">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

        <!-- Contenido principal -->
        <div class="content py-5">
            @yield('content')
        </div>
    </div>

    <!-- Scripts JS (Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
