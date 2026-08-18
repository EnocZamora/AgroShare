@extends('layouts.app')

@section('title', 'Agroshare - ' . $product->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- Botón de retorno -->
    <div>
        <a href="{{ route('products.index') }}" class="text-xs text-gray-500 hover:text-[#1B4D3E] font-medium">
            ← Volver al catálogo
        </a>
    </div>

    <div class="bg-white rounded-xl border border-emerald-700/30 shadow-sm overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
        
        <!-- Imagen / Placeholder del Producto -->
        <div class="w-full h-64 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-800 font-bold text-lg border border-emerald-700/10">
            {{ $product->title }}
        </div>

        <!-- Información del Producto -->
        <div class="flex flex-col justify-between space-y-4">
            <div>
                <span class="inline-block bg-emerald-100 text-[#1B4D3E] text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider mb-2">
                    {{ $product->category->name ?? 'Categoría' }}
                </span>
                <h1 class="text-2xl font-bold text-gray-900">{{ $product->title }}</h1>
                <p class="text-xl font-extrabold text-[#1B4D3E] mt-2">${{ number_format($product->price, 2) }} <span class="text-xs font-normal text-gray-500">/ {{ $product->unit }}</span></p>
                
                <p class="text-xs text-gray-600 mt-4 leading-relaxed">
                    {{ $product->description }}
                </p>
            </div>

            <!-- Datos del Productor y Botón de Contacto -->
            <div class="pt-4 border-t border-gray-100 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-[#1B4D3E] font-bold text-xs">
                        {{ strtoupper(substr($product->user->name ?? 'P', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-900">{{ $product->user->name ?? 'Productor' }}</p>
                        <p class="text-[10px] text-gray-400">Stock disponible: {{ $product->stock }} {{ $product->unit }}</p>
                    </div>
                </div>

                @auth
                    @if(Auth::id() !== $product->user_id)
                        <!-- Formulario para iniciar chat con el vendedor -->
                        <form action="{{ route('chats.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="content" value="Hola, estoy interesado en tu producto: {{ $product->title }}">
                            <button type="submit" class="w-full bg-[#1B4D3E] text-white text-xs py-2.5 rounded-lg font-medium hover:bg-emerald-800 transition text-center shadow-sm">
                                Contactar al Productor
                            </button>
                        </form>
                    @else
                        <div class="bg-emerald-50 text-[#1B4D3E] text-xs p-3 rounded-lg text-center font-medium">
                            Este es tu producto publicado.
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block w-full bg-gray-100 text-gray-700 text-xs py-2.5 rounded-lg font-medium hover:bg-gray-200 transition text-center">
                        Inicia sesión para contactar al productor
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection