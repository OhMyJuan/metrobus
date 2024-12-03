@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="container mt-5">
    <div class="row d-flex">
        <div class="col">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </div>

    <h1 class="mb-4 text-center">Editar Usuario</h1>
    <form action="{{ route('admin.actualizarUsuario', $usuario->id) }}" method="POST" class="w-25 m-auto">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $usuario->name) }}" required>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Correo -->
        <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Rol -->
        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select class="form-select @error('rol') is-invalid @enderror" id="rol" name="rol" required>
                <option value="admin" {{ old('rol', $usuario->rol) == 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="operador" {{ old('rol', $usuario->rol) == 'operador' ? 'selected' : '' }}>Operador</option>
            </select>
            @error('rol')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Cédula -->
        <div class="mb-3">
            <label for="cid" class="form-label">Cédula</label>
            <input type="text" class="form-control @error('cid') is-invalid @enderror" id="cid" name="cid" value="{{ old('cid', $usuario->cid) }}" required>
            @error('cid')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botón de guardar cambios -->
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection
