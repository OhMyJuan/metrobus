<!-- Vista -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Simulación de Uso de Tarjeta</h2>
    <div class="row px-5">
        
        <form id="demo-form" action="{{ route('simularUsoTarjeta') }}" method="POST" class="col-4">
            @csrf
            <div class="mb-3">
                <label for="codigo_tarjeta" class="form-label">Código de Tarjeta</label>
                <input type="text" class="form-control @error('codigo_tarjeta') is-invalid @enderror" id="codigo_tarjeta" name="codigo_tarjeta" placeholder="Ingrese el código de la tarjeta" required>
                @error('codigo_tarjeta')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="servicio" class="form-label">Servicio a Utilizar</label>
                <select class="form-control @error('servicio') is-invalid @enderror" id="servicio" name="servicio" required>
                    <option value="">Seleccione un servicio</option>
                    <option value="metro">Metro</option>
                    <option value="metrobus">Metrobus</option>
                    <option value="metropass">MetroPass</option>
                </select>
                @error('servicio')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
            </div>
            
            <button type="submit" class="btn btn-primary">Simular Uso</button>
        </form>

        <div class="col-4"></div>

        <div class="col-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="2" class="text-center border bg-secondary">Tarjetas registradas</th>
                </tr>
                <tr>
                    <th scope="col">Código de Tarjeta</th>
                    <th scope="col">Saldo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tarjetas as $tarjeta)
                    <tr>
                        <td>{{ $tarjeta->codigo }}</td>
                        <td>${{ number_format($tarjeta->saldo, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        </div>

        </div>
</div>

<!-- Modal de Animación -->
@if(session('animacion') === 1)
<div class="modal-animation">
    <div class="card-reader">
        <div class="card">
            <div class="card-code">{{ session('codigo_tarjeta') }}</div>
        </div>
        <!-- Mensaje dinámico -->
        <div class="transaction-message">
            @if(session('saldo_suficiente'))
                Pagado -{{ session('monto') }}
            @else
                Saldo insuficiente (Saldo: {{ session('saldo_actual') }})
            @endif
        </div>
    </div>
</div>
@endif

<!-- Estilos -->
<style>
    .modal-animation {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .card-reader {
        position: relative;
        width: 400px;
        height: 200px;
        background-color: #ddd;
        border: 4px solid #ccc;
        border-radius: 20px;
        overflow: hidden;
        animation: changeColor 2s ease-in-out;
    }

    .card {
        position: absolute;
        width: 200px;
        height: 120px;
        background-color: #ffffff;
        border-radius: 10px;
        border: 4px solid #3c3c3c;
        top: 40px;
        left: -220px;
        animation: slideCard 2s ease-in-out forwards;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        overflow: hidden;
    }

    .card::after {
        content: "";
        width: 100%;
        height: 20px;
        background-color: #3c3c3c;
        position: absolute;
        bottom: 0;
        left: 0;
    }

    .card-code {
        position: absolute;
        font-size: 16px;
        color: #000;
        bottom: 30px;
        font-weight: bold;
        width: 100%;
        text-align: center;
        margin-left: 20px;
        border-top: 3px solid #3c3c3c;
        border-left: 3px solid #3c3c3c;
        padding-top: 10px

    }

    .transaction-message {
        position: absolute;
        top: 140px;
        width: 100%;
        text-align: center;
        color: {{ session('saldo_suficiente') ? '#28a745' : '#dc3545' }};
        font-size: 20px;
        font-weight: bold;
        opacity: 0;
        animation: fadeInMessage 3s ease-in-out forwards;
    }

    @keyframes slideCard {
        0% {
            left: -220px;
        }
        50% {
            left: 100px;
        }
        100% {
            left: 500px;
        }
    }

    @keyframes changeColor {
        0% {
            background-color: #ddd;
        }
        50% {
            background-color: {{ session('saldo_suficiente') ? '#28a745' : '#dc3545' }};
        }
        100% {
            background-color: #ddd;
        }
    }

    @keyframes fadeInMessage {
        0% {
            opacity: 0;
        }
        50% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
</style>



<!-- Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.querySelector('.modal-animation');
        if (modal) {
            setTimeout(() => {
                modal.style.display = 'none';
            }, 3000);
        }
    });
</script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
