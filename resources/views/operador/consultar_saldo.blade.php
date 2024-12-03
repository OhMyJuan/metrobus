@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row d-flex">
        <div class="col">
            <a href="{{ route('operador.dashboard') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </div>

    <h2 class="mb-4 text-center">Consultar Saldo de Tarjeta</h2>
    
    <!-- Formulario para ingresar el código de tarjeta -->
    <form action="{{ route('operador.consultarSaldo') }}" method="POST" class="m-auto w-25">
        @csrf
        <div class="mb-3">
            <label for="codigo_tarjeta" class="form-label">Código de Tarjeta</label>
            <input type="text" class="form-control @error('codigo_tarjeta') is-invalid @enderror" id="codigo_tarjeta" name="codigo_tarjeta" placeholder="Ingrese el código de la tarjeta" required>
            @error('codigo_tarjeta')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Consultar</button>
    </form>

    <!-- Mensajes de resultado -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif(session('saldo'))
        @if (session('saldo') > 0)
            <div class="alert alert-success w-25 m-auto text-center mt-3">
                El saldo de la tarjeta es: <strong>B./{{ number_format(session('saldo'), 2) }}</strong>
            </div>
        @elseif (session('saldo') == 0)
            <div class="alert alert-secondary w-25 m-auto text-center mt-3">
                El saldo de la tarjeta es: <strong>B./{{ number_format(session('saldo'), 2) }}</strong>
            </div>
        @else
            <div class="alert alert-danger w-25 m-auto text-center mt-3">
                El saldo de la tarjeta es: <strong>B./{{ number_format(session('saldo'), 2) }}</strong>
            </div>
        @endif
    @endif
</div>
@endsection