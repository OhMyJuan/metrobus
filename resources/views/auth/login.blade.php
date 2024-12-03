<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metrobus - Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <!-- Imagen y mensaje -->
            <div class="col-md-6 text-center mb-4">
                <div class="row mb-3">
                    <div class="col d-flex">
                        <a href="/" type="button" class="btn btn-secondary">Regresar</a>
                    </div>
                </div>
                <img src="https://via.placeholder.com/400x300?text=Metrobus" alt="Metrobus" class="img-fluid mb-3">
                <h3>Bienvenido al sistema de Metrobus</h3>
                <p>Inicia sesión para gestionar las operaciones y colaborar con nosotros. Juntos hacemos que el sistema funcione mejor para todos.</p>
            </div>

            <!-- Formulario de inicio de sesión -->
            <div class="col-md-6">
                <div class="card w-75 m-auto">
                    <div class="card-header text-center">
                        <h4>Iniciar sesión - Colaboradores</h4>
                    </div>
                    <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control @error('nombre_usuario') is-invalid @enderror" id="nombre_usuario" name="nombre_usuario" value="{{ old('nombre_usuario') }}">
                            @error('nombre_usuario')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contraseña" class="form-label">Contraseña</label>
                            <input type="password" class="form-control @error('contraseña') is-invalid @enderror" id="contraseña" name="contraseña">
                            @error('contraseña')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>