@extends('layouts.app')

@section('content')
<div class="container py-3 mt-5">
<div class="row d-flex">
        <div class="col">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </div>

    <!-- Sección para crear un nuevo usuario -->
    <div class="card mb-4 w-50 m-auto">
        <div class="card-header">
            <h4>Crear Nuevo Usuario</h4>
        </div>
        <div class="card-body">
            <form action="#" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Nombre Completo</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="cid">Cédula</label>
                    <input type="text" class="form-control" id="cid" name="cid" required>
                </div>
                <div class="form-group mb-3">
                    <label for="rol">Rol</label>
                    <select class="form-control" id="rol" name="rol" required>
                        <option value="admin">Administrador</option>
                        <option value="operador">Operador</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email_notification">Notificar a:</label>
                    <input type="email" class="form-control" id="email_notification" name="email_notification" placeholder="Dirección de correo (opcional)">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Crear Usuario</button>
            </form>
        </div>
    </div>
</div>
@endsection
