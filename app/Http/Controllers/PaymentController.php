<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Muestra la lista de métodos de pago del usuario.
     */
    public function index()
    {
        $paymentMethods = Auth::user()->paymentMethods()->get();
        return view('payments.methods', compact('paymentMethods'));
    }

    /**
     * Almacena un nuevo método de pago en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'provider' => 'required|string|max:100',
            'account_number' => 'required|string|max:100',
            'account_holder' => 'required|string|max:255',
        ], [
            'provider.required' => 'El proveedor o banco es obligatorio.',
            'account_number.required' => 'El número de cuenta o teléfono es obligatorio.',
            'account_holder.required' => 'El nombre del titular es obligatorio.',
        ]);

        Auth::user()->paymentMethods()->create([
            'provider' => $validated['provider'],
            'account_number' => $validated['account_number'],
            'account_holder' => $validated['account_holder'],
            'is_active' => true,
        ]);

        return redirect()->route('payments.methods')->with('success', 'Método de pago registrado exitosamente.');
    }
}