@extends('layouts.app')

@section('title', 'Agroshare - ' . $product->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Botón de Retorno -->
    <div>
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#1B4D3E] hover:underline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            {{ __('messages.product_show_back') }}
        </a>
    </div>

    <!-- Contenedor Principal del Detalle -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-6 p-6 md:p-8">

        <!-- Imagen o Contenedor Visual del Producto -->
        <div class="w-full h-72 md:h-full min-h-[280px] bg-emerald-50/50 rounded-xl overflow-hidden flex items-center justify-center border border-gray-200 relative">
            @if(!empty($product->image))
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
            @else
                <div class="text-center p-6 space-y-2">
                    <div class="w-16 h-16 bg-emerald-100 text-[#1B4D3E] rounded-full flex items-center justify-center mx-auto text-xl font-bold">🌾</div>
                    <span class="text-xs font-bold text-[#1B4D3E]">{{ $product->title }}</span>
                </div>
            @endif
        </div>

        <!-- Información Completa del Producto -->
        <div class="flex flex-col justify-between space-y-6">
            <div class="space-y-3">
                <!-- Categoría y Ubicación -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-block bg-emerald-100 text-[#1B4D3E] text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                        {{ $product->category->name ?? 'Rubro General' }}
                    </span>
                    @if(!empty($product->location))
                        <span class="inline-block bg-gray-100 text-gray-600 text-[10px] font-bold px-2.5 py-1 rounded-full">
                            📍 {{ $product->location }}, Nicaragua
                        </span>
                    @endif
                </div>

                <h1 class="text-xl md:text-2xl font-bold text-gray-900 leading-tight">{{ $product->title }}</h1>

                <div class="text-xl md:text-2xl font-extrabold text-[#1B4D3E]">
                    ${{ number_format($product->price, 2) }}
                    <span class="text-xs font-normal text-gray-500">{{ __('messages.product_show_price_unit', ['unit' => $product->unit]) }}</span>
                </div>

                <p class="text-xs text-gray-600 leading-relaxed pt-2">
                    {{ $product->description }}
                </p>
            </div>

            <!-- Datos del Productor y Botón de Contacto -->
            <div class="pt-4 border-t border-gray-100 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-[#1B4D3E] font-bold text-xs shrink-0">
                        {{ strtoupper(substr($product->user->name ?? 'P', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-900">{{ $product->user->name ?? __('messages.product_show_producer') }}</p>
                        <p class="text-[10px] text-gray-400">{{ __('messages.product_show_stock', ['stock' => $product->stock, 'unit' => $product->unit]) }}</p>
                    </div>
                </div>

                @auth
                    @if(Auth::id() !== $product->user_id)
                        <div class="space-y-2">
                            <!-- Botón de Compra Directa Móvil -->
                            <a href="{{ route('payments.checkout', $product->id) }}" class="w-full min-h-[48px] bg-[#1B4D3E] hover:bg-[#14382c] text-white text-xs py-3 px-4 rounded-2xl font-bold transition text-center shadow-sm tracking-wide flex items-center justify-center gap-2 active:scale-[0.99]">
                                <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <span>{{ __('messages.checkout_buy_now') }}</span>
                            </a>

                            <!-- Formulario seguro para iniciar chat con el vendedor -->
                            <form action="{{ route('chats.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="content" value="Hola, estoy interesado en tu producto: {{ $product->title }}">
                                <button type="submit" class="w-full min-h-[44px] bg-emerald-50/80 border border-emerald-300 hover:bg-emerald-100 text-[#1B4D3E] text-xs py-2.5 px-4 rounded-2xl font-bold transition text-center shadow-xs tracking-wide flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                    <span>{{ __('messages.product_show_contact_button') }}</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="bg-emerald-50 border border-emerald-200 text-[#1B4D3E] text-xs p-3 rounded-xl text-center font-medium">
                            ✓ {{ __('messages.product_show_own_product') }}
                        </div>
                    @endif
                @else
                    <a href="{{ route('auth.login') }}" class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs py-3 rounded-xl font-bold transition text-center tracking-wide">
                        {{ __('messages.product_show_login_to_contact') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection