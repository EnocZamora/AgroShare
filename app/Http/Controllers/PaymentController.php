<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class PaymentController extends Controller
{
    /**
     * Muestra la lista de métodos de pago en Configuración con arquitectura Mobile-First.
     */
    public function methods()
    {
        $hasDatabaseTable = Schema::hasTable('payment_methods');
        $defaultMethodId = session('default_payment_method', 'bac_lafise');

        // Si el usuario está autenticado y la tabla existe, verificar si tiene un default en base de datos
        if ($hasDatabaseTable && Auth::check()) {
            try {
                $dbDefault = Auth::user()->paymentMethods()->where('is_default', true)->first();
                if ($dbDefault && !session()->has('default_payment_method')) {
                    $defaultMethodId = $dbDefault->type ?? $dbDefault->id;
                    session(['default_payment_method' => $defaultMethodId]);
                }
            } catch (\Throwable $e) {
                // Silenciosamente continuar con session
            }
        }

        $paymentMethods = $this->getAvailableMethods($defaultMethodId);

        return view('payments.methods', compact('paymentMethods', 'hasDatabaseTable', 'defaultMethodId'));
    }

    /**
     * Alias de methods.
     */
    public function index()
    {
        return $this->methods();
    }

    /**
     * Establece un método de pago como "Predeterminado" para el usuario.
     */
    public function setDefault(Request $request)
    {
        $request->validate([
            'method_id' => 'required|string|max:100',
        ]);

        $methodId = $request->input('method_id');

        // Guardar selección en sesión
        session(['default_payment_method' => $methodId]);

        // Sincronizar en base de datos si existe la tabla y el usuario está autenticado
        if (Schema::hasTable('payment_methods') && Auth::check()) {
            try {
                $user = Auth::user();
                $user->paymentMethods()->update(['is_default' => false]);

                $updated = $user->paymentMethods()->where('type', $methodId)->orWhere('id', $methodId)->update(['is_default' => true]);

                // Si aún no existía en BD para este usuario, lo persistimos
                if (!$updated) {
                    $defaultMethods = $this->getAvailableMethods($methodId);
                    $selected = $defaultMethods->firstWhere('id', $methodId);
                    if ($selected) {
                        $user->paymentMethods()->create([
                            'type' => $selected->id,
                            'provider' => $selected->provider,
                            'details' => $selected->details,
                            'is_default' => true,
                            'is_active' => true,
                        ]);
                    }
                }
            } catch (\Throwable $e) {
                // Continuar con fallback de sesión
            }
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('messages.payments_default_updated'),
                'default_method' => $methodId,
            ]);
        }

        return redirect()->back()->with('success', __('messages.payments_default_updated'));
    }

    /**
     * Vista de Confirmación de Compra (Checkout Móvil).
     * Carga directamente el método predeterminado y adapta el resumen al viewport móvil.
     */
    public function checkout(Request $request, $productId = null)
    {
        $productId = $productId ?? $request->query('product_id');
        $product = null;

        if ($productId) {
            $product = Product::with(['category', 'user'])->find($productId);
        }

        if (!$product) {
            $product = Product::with(['category', 'user'])->latest()->first();
        }

        // Mock realista de cosecha nicaragüense si la base de datos de productos estuviera vacía
        if (!$product) {
            $product = (object) [
                'id' => 1,
                'title' => 'Frijol Rojo Nacional de Primera',
                'description' => 'Cosecha de temporada secada al sol, grano limpio y seleccionado.',
                'price' => 45.00,
                'unit' => 'Quintal',
                'stock' => 50,
                'location' => 'Matagalpa',
                'image' => null,
                'category' => (object) ['name' => 'Granos Básicos'],
                'user' => (object) ['name' => 'Cooperativa Agrícola del Norte RL', 'phone' => '8888-0000'],
            ];
        }

        // Tipo de cambio referencial oficial C$ / USD
        $exchangeRate = 36.65;
        $rawPrice = (float) $product->price;

        if ($rawPrice < 200) {
            $totalUSD = $rawPrice;
            $totalCordobas = round($rawPrice * $exchangeRate, 2);
        } else {
            $totalCordobas = $rawPrice;
            $totalUSD = round($rawPrice / $exchangeRate, 2);
        }

        $defaultMethodId = session('default_payment_method', 'bac_lafise');
        $allMethods = $this->getAvailableMethods($defaultMethodId);

        $selectedMethod = $allMethods->firstWhere('id', $defaultMethodId) ?? $allMethods->first();

        return view('payments.checkout', compact(
            'product',
            'allMethods',
            'selectedMethod',
            'totalCordobas',
            'totalUSD',
            'exchangeRate'
        ));
    }

    /**
     * Procesa la confirmación de la orden en el checkout móvil.
     */
    public function process(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => 'required|string',
            'product_id' => 'nullable|integer',
            'amount_cordobas' => 'nullable|numeric',
        ]);

        $amount = (float) ($validated['amount_cordobas'] ?? 1650.00);
        $methodId = $validated['payment_method'];

        // Registrar transacción si la tabla transactions existe
        if (Schema::hasTable('transactions') && Auth::check()) {
            try {
                Transaction::create([
                    'user_id' => Auth::id(),
                    'amount' => $amount,
                    'status' => 'completado',
                    'payment_method' => $methodId,
                ]);
            } catch (\Throwable $e) {
                // Silenciosamente continuar
            }
        }

        $transactionId = 'AGRO-' . strtoupper(substr(uniqid(), -6));

        return redirect()->route('payments.checkout', ['product_id' => $validated['product_id'] ?? null])
            ->with('order_success', true)
            ->with('transaction_id', $transactionId)
            ->with('paid_method', $methodId)
            ->with('paid_amount', $amount);
    }

    /**
     * Almacena un nuevo método de pago en la base de datos (si la tabla existe).
     */
    public function store(Request $request)
    {
        if (!Schema::hasTable('payment_methods')) {
            return redirect()->route('payments.methods')
                ->with('info', 'El registro de métodos personalizados estará disponible próximamente.');
        }

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
            'type' => 'custom',
            'provider' => $validated['provider'],
            'account_number' => $validated['account_number'],
            'account_holder' => $validated['account_holder'],
            'is_active' => true,
        ]);

        return redirect()->route('payments.methods')->with('success', __('messages.payments_default_updated'));
    }

    /**
     * Retorna la colección de métodos disponibles con traducciones y estado de selección.
     */
    protected function getAvailableMethods(?string $defaultMethodId = null): \Illuminate\Support\Collection
    {
        $defaultMethodId = $defaultMethodId ?? session('default_payment_method', 'bac_lafise');

        $methods = [
            (object) [
                'id' => 'bac_lafise',
                'type' => 'bac_lafise',
                'name' => __('messages.payment_method_bac_name'),
                'provider' => __('messages.payment_method_bac_provider'),
                'icon' => 'bank',
                'badge' => __('messages.payment_method_bac_badge'),
                'details' => __('messages.payment_method_bac_details'),
                'description' => __('messages.payment_method_bac_desc'),
                'is_default' => ($defaultMethodId === 'bac_lafise'),
                'is_active' => true,
            ],
            (object) [
                'id' => 'billetera_kash',
                'type' => 'billetera_kash',
                'name' => __('messages.payment_method_kash_name'),
                'provider' => __('messages.payment_method_kash_provider'),
                'icon' => 'mobile',
                'badge' => __('messages.payment_method_kash_badge'),
                'details' => __('messages.payment_method_kash_details'),
                'description' => __('messages.payment_method_kash_desc'),
                'is_default' => ($defaultMethodId === 'billetera_kash'),
                'is_active' => true,
            ],
            (object) [
                'id' => 'contra_entrega',
                'type' => 'contra_entrega',
                'name' => __('messages.payment_method_cash_name'),
                'provider' => __('messages.payment_method_cash_provider'),
                'icon' => 'cash',
                'badge' => __('messages.payment_method_cash_badge'),
                'details' => __('messages.payment_method_cash_details'),
                'description' => __('messages.payment_method_cash_desc'),
                'is_default' => ($defaultMethodId === 'contra_entrega'),
                'is_active' => true,
            ],
        ];

        return collect($methods);
    }
}
