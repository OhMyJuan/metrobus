@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card mx-auto w-50" style="max-width: 600px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Perfil del Usuario</h4>
        </div>
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="https://via.placeholder.com/150" alt="Imagen de perfil" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
                <h5>{{ $usuario->name }}</h5>
                <p class="text-muted mb-0">{{ $usuario->email }}</p>
            </div>

            <div class="mb-3 mt-3 text-center border">
                <label class="form-label fw-bold">Nombre:</label>
                <p class="form-control-plaintext">{{ $usuario->name }}</p>
            </div>

            <div class="mb-3 text-center border">
                <label class="form-label fw-bold">Correo electrónico:</label>
                <p class="form-control-plaintext">{{ $usuario->email }}</p>
            </div>

            <div class="mb-3 text-center border">
                <label class="form-label fw-bold">Rol:</label>
                <p class="form-control-plaintext text-capitalize">{{ $usuario->rol }}</p>
            </div>
            
            @if (auth()->user()->rol == 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Regresar al panel</a>
            @elseif (auth()->user()->rol == 'operador')
                <a href="{{ route('operador.dashboard') }}" class="btn btn-secondary">Regresar al panel</a>
            @endif
        </div>
    </div>
</div>
@endsection
