<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Mostrar el formulario de inicio de sesión.
     * ############################################# PENDIENTE DE HACER #############################################
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

        // Inicio de sión
    public function login(Request $request)
    {
        // Validación del nombre de usuario y la contraseña
        $request->validate([
            'nombre_usuario' => 'required|string',
            'contraseña' => 'required|string',
        ]);
    
        // Intentar autenticar con nombre de usuario y contraseña
        if (Auth::attempt(['email' => $request->nombre_usuario, 'password' => $request->contraseña])) {
            // Obtener el usuario autenticado
            $user = Auth::user();
    
            // Verificar el rol del usuario y redirigir a la vista correspondiente
            if ($user->rol == 'admin') {
                // Redirigir al dashboard del administrador
                return redirect()->route('admin.dashboard');
            } elseif ($user->rol == 'operador') {
                // Redirigir al dashboard del operador
                return redirect()->route('operador.dashboard');
            } else {
                // Redirigir al inicio (o a una página de error si el rol no es válido)
                return redirect()->route('home');
            }
        }
    
            // Si la autenticación falla, redirige de vuelta con un error
            return back()->withErrors([
                'nombre_usuario' => 'Las credenciales son incorrectas.',
            ]);
    }


    /**
     * Cerrar sesión del usuario.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
