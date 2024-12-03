@extends('layouts.app')

@section('content')

        @if(session('success'))
            <div id="flash-message" class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div id="flash-message" class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

<div class="container mt-5">
    <div class="d-flex justify-content-between mb-5">
        <p class="display-6">Bienvenido, {{ $admin  ->name }}</p>
        <a href="{{ route('perfil', $admin->id) }}" class="d-block btn btn-info btn-sm h-50">Mi perfil</a>
    </div>

    <!-- Sección para ver y gestionar los usuarios -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Usuarios Registrados</h4>
        </div>
        <div class="card-body">
            <!-- Tabla de usuarios -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>CID</th>
                        <th>Rol</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->cid }}</td>
                        <td>{{ $usuario->rol }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td class="d-flex justify-content-around">
                            @if($usuario->id === auth()->id()) 
                                <button href="#" class="btn btn-secondary btn-sm" disabled>Editar</button>
                                <button href="#" class="btn btn-secondary btn-sm" disabled>Eliminar</button>
                            @else
                                <a href="{{ route('admin.actualizarUsuario', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('admin.borrarUsuario', $usuario->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sección para ver y gestionar las tarjetas -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Gestión de Tarjetas</h4>
        </div>
        <div class="card-body">
            <!-- Tabla de tarjetas -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Fecha de Registro</th>
                        <th class="text-center">Código</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Saldo</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tarjetas as $tarjeta)
                    <tr>
                        <td class="text-center">{{ $tarjeta->created_at }}</td>
                        <td class="text-center">{{ $tarjeta->codigo }}</td>
                        <td class="text-center">{{ $tarjeta->tipo }}</td>
                        <td class="text-center">{{ $tarjeta->saldo }}</td>
                        @if ($tarjeta->estado === 'habilitada')
                            <td>
                                <span class="badge text-success m-auto d-block">Habilitada</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.deshabilitar', $tarjeta->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger d-block m-auto">Deshabilitar</button>
                                </form>
                            </td>
                        @elseif ($tarjeta->estado === 'deshabilitada')
                            <td>
                                <span class="badge text-danger m-auto d-block">Desabilitada</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.habilitar', $tarjeta->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Habilitar</button>
                                </form>
                            </td>  
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
