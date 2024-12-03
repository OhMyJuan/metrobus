@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-5">
        <p class="display-6">Bienvenido, {{ $operador->name }}</p>
        <a href="{{ route('perfil', $operador->id) }}" class="d-block btn btn-info btn-sm h-50">Mi perfil</a>
    </div>

    <h2 class="text-center mb-4">Mis Transacciones Realizadas</h2>
    
    @if($transacciones->isEmpty())
        <div class="alert alert-secondary text-center">
            <strong>No hay transacciones realizadas.</strong>
        </div>
    @else
        <!-- Tabla con las transacciones -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Tarjeta</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Monto</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transacciones as $transaccion)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $transaccion->created_at }}</td>
                        <td class="text-center">{{ $transaccion->codigo_tarjeta }}</td>
                        <td class="text-center">{{ ucwords($transaccion->tipo_transaccion) }}</td>
                        <td class="text-center">{{ $transaccion->monto }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
