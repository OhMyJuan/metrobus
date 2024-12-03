<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tarjeta;
use App\Models\Transaccion;
use Illuminate\Support\Facades\Auth;

class OperadorController extends Controller
{

    public function index()
    {
        $operador = Auth::user();
        $transacciones = collect($operador->transacciones);

        return view('operador.dashboard', compact('transacciones', 'operador'));
    }



    // RECARGA
    public function mostrarRecargar()
    {
        return view('operador.recargar');
    }

    public function recargar(Request $request)
    {
        // Validación
        $request->validate([
            'codigo_tarjeta' => 'required|exists:tarjetas,codigo',
            'monto' => 'required|numeric|min:1',
        ]);

        // Obtener tarjeta utilizando el código ingresado
        $tarjeta = Tarjeta::where('codigo', $request->codigo_tarjeta)->first();

        // Asegurarse que la tarjeta está habilitada
        if (!$tarjeta) {
            return redirect()->route('operador.mostrarRecarga')->with('error', 'Código de tarjeta inválido');
        }

        // Realizar la recarga
        $tarjeta->saldo += $request->monto;
        $tarjeta->save();

        // Registra la transacción o haz alguna otra acción si es necesario
        $operador = Auth::user();
        Transaccion::create([
            'codigo_tarjeta' => $request['codigo_tarjeta'],
            'id_operador' => $operador->id,
            'tipo_transaccion' => "recarga",
            'monto' => $request['monto'],
        ]);

        return redirect()->route('operador.dashboard')->with('success', 'La tarjeta se ha recargado correctamente.');
    }




    // CONSULTAR SALDO
    public function mostrarConsultarSaldo()
    {
        return view('operador.consultar_saldo');
    }

    public function consultarSaldo(Request $request)
    {
        $request->validate([
            'codigo_tarjeta' => 'required|string',
        ]);

        // Buscar la tarjeta por el código ingresado
        $tarjeta = Tarjeta::where('codigo', $request->codigo_tarjeta)->first();

        if (!$tarjeta) {
            return back()->with('error', 'Código de tarjeta inválido.');
        }

        // Tarjeta encontrada, enviar saldo
        return back()->with('saldo', $tarjeta->saldo);
    }

}
