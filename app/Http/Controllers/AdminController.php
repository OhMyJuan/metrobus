<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Tarjeta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserCreatedNotification;

class AdminController extends Controller
{
    public function index()
    {
        $usuarios = User::where('rol', '!=', 'sis')->get();
        $tarjetas = Tarjeta::all();
        $admin = Auth::user();

        return view('admin.dashboard', ['usuarios'=>$usuarios, 'tarjetas'=>$tarjetas, 'admin'=>$admin]);
    }


    // GESTIÓN DE USUARIOS
    public function mostrarCrearUsuario()
    {
        return view('admin.crear_usuario');
    }

    public function crearUsuario(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'cid' => 'required|string',
            'rol' => 'required|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'cid' => $validated['cid'],
            'rol' => $validated['rol'],
        ]);


        if ($request->email_notification) {
            Notification::route('mail', $request->email_notification)
                ->notify(new UserCreatedNotification($user));
        }

        $user->sendEmailVerificationNotification();


        return redirect()->route('admin.dashboard')->with('success', 'Usuario creado exitosamente');
    }

    public function mostrarActualizarUsuario($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.editar_usuario', compact('usuario'));
    }

    public function actualizarUsuario(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'rol' => 'required|in:admin,operador',
            'cid' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'rol', 'cid']));

        return redirect()->route('admin.dashboard')->with('success', 'Usuario actualizado correctamente.');
    }

    public function borrarUsuario($id)
    {
        // Encontrar al usuario por su ID
        $user = User::findOrFail($id);

        // Eliminar al usuario
        $user->delete();

        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->back()->with('success', 'El usuario ha sido eliminado');
    }

    // GESTIÓN DE TARJETAS
    public function mostrarCrearTarjeta()
    {
        return view('admin.crear_tarjeta');
    }

    public function crearTarjeta(Request $request)
    {
        // Validación
        $request->validate([
            'codigo_tarjeta' => 'required|unique:tarjetas,codigo',
            'saldo' => 'required|numeric|min:0',
            'estado' => 'required|in:habilitada,deshabilitada',
            'tipo' => 'required|in:normal,estudiantil,jubilado'
        ]);

        // Crear la tarjeta
        Tarjeta::create([
            'codigo' => $request->codigo_tarjeta,
            'saldo' => $request->saldo,
            'estado' => $request->estado,
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Tarjeta creada exitosamente.');
    }

    public function habilitar($id)
    {
        $tarjeta = Tarjeta::findOrFail($id);
        $tarjeta->estado = 'habilitada';
        $tarjeta->save();

        return redirect()->back()->with('success', 'La tarjeta ha sido habilitada.');
    }

    public function deshabilitar($id)
    {
        $tarjeta = Tarjeta::findOrFail($id);
        $tarjeta->estado = 'deshabilitada';
        $tarjeta->save();

        return redirect()->back()->with('success', 'La tarjeta ha sido deshabilitada.');
    }
}
