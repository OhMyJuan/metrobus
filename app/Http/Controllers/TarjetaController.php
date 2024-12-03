<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarjeta;
use App\Models\Transaccion;
use Illuminate\Support\Facades\Validator;

class TarjetaController extends Controller
{
    public function mostrarSimularUso()
    {
        $tarjetas = Tarjeta::all();
        
        return view('simulacion', ['tarjetas' => $tarjetas]);
    }

    public function simularUsoTarjeta(Request $request)
    {
        
        // Validación del formulario y reCAPTCHA
        $validator = Validator::make($request->all(), [
            'codigo_tarjeta' => 'required|string',
            'servicio' => 'required|string|in:metro,metrobus,metropass',
            'g-recaptcha-response' => 'required',  // Validación de reCAPTCHA
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $tarjeta = Tarjeta::where('codigo', $request->codigo_tarjeta)->first();
    
        if (!$tarjeta) {
            return back()->with('error', 'Código de tarjeta inválido.');
        }
    
        $descuento = match ($tarjeta->tipo) {
            'normal' => $request->servicio === 'metro' ? 0.50 : ($request->servicio === 'metrobus' ? 0.25 : 0.10),
            'estudiantil' => $request->servicio === 'metro' ? 0.20 : ($request->servicio === 'metrobus' ? 0.10 : 0.10),
            'jubilado' => $request->servicio === 'metro' ? 0.30 : ($request->servicio === 'metrobus' ? 0.15 : 0.10),
            default => 0
        };
    
        $saldoSuficiente = $tarjeta->saldo >= $descuento;
    
        session([
            'animacion' => 1,
            'codigo_tarjeta' => $tarjeta->codigo,
            'saldo_suficiente' => $saldoSuficiente,
            'monto' => $saldoSuficiente ? number_format($descuento, 2) : null,
            'saldo_actual' => number_format($tarjeta->saldo, 2),
        ]);
    
        if (!$saldoSuficiente) {
            return back();
        }
    
        $tarjeta->saldo -= $descuento;
        $tarjeta->save();
    
        Transaccion::create([
            'codigo_tarjeta' => $tarjeta->codigo,
            'tipo_transaccion' => $request->servicio,
            'monto' => -$descuento,
            'id_operador' => 0,
        ]);
    
        return back();
    }
     
}