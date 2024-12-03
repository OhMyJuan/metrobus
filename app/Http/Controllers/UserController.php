<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function mostrarPerfil($id)
    {
        $usuario = User::findOrFail($id);
        return view('auth.perfil', compact('usuario'));
    }
}
