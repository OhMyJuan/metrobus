@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row d-flex">
        <div class="col">
            <a href="{{ route('operador.dashboard') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </div>

    @if(session('error'))
        <div id="flash-message" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2 class="text-center mb-4">Recargar Tarjeta</h2>

    <!-- Formulario de recarga de tarjeta -->
    <form action="{{ route('operador.recargar') }}" method="POST" class="w-25 m-auto">
        @csrf
        <div class="mb-3">
            <label for="codigo_tarjeta" class="form-label">Código de Tarjeta</label>
            <input type="text" class="form-control" id="codigo_tarjeta" name="codigo_tarjeta" required>
        </div>

        <div class="mb-3">
            <label for="monto" class="form-label">Monto a Recargar</label>
            <input type="number" class="form-control" id="monto" name="monto" min="1" required>
            @error('monto')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Recargar</button>
    </form>
</div>
@endsection
