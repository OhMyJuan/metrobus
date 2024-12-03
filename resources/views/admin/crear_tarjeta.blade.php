@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row d-flex">
        <div class="col">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </div>

    <h2 class="text-center mb-4">Registrar Tarjeta</h2>

    <!-- Mostrar mensaje de éxito si se creó la tarjeta correctamente -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mostrar mensaje de error si existe -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Formulario para crear nueva tarjeta -->
    <form action="{{ route('admin.crearTarjeta') }}" method="POST" class="w-50 m-auto">
        @csrf

        <div class="mb-3">
            <label for="codigo_tarjeta" class="form-label">Código de Tarjeta</label>
            <input type="text" class="form-control" id="codigo_tarjeta" name="codigo_tarjeta" required>
            @error('codigo_tarjeta')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="saldo" class="form-label">Saldo Inicial</label>
            <input type="number" class="form-control" id="saldo" name="saldo" min="0.00" required value="0.00" step="0.25">
            @error('saldo')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado de la Tarjeta</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="habilitada">Habilitada</option>
                <option value="deshabilitada">Deshabilitada</option>
            </select>
            @error('estado')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Tarjeta</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="normal">Normal</option>
                <option value="estudiantil">Estudiantil</option>
                <option value="jubilado">Jubilados</option>
            </select>
            @error('tipo')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Crear Tarjeta</button>
    </form>
</div>
@endsection
