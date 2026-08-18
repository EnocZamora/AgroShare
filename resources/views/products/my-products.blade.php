@extends('layouts.app')

@section('title', 'Agroshare - Mis Productos')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- Encabezado -->
    <div class="bg-white p-6 rounded-xl border border-emerald-700/30 shadow-sm flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-[#1B4D3E]">Mis Productos</h2>
            <p class="text-xs text-gray-500 mt-1">Gestiona los artículos que has publicado en la plataforma.</p>
        </div>
        <a href="{{ route('products.create') }}" class="bg-[#1B4D3E] text-white text-xs px-4 py-2 rounded-lg font-medium hover:bg-emerald-800 transition shadow-sm">
            + Nuevo Producto
        </a>
    </div>

    <!-- Listado de Productos -->
    <div class="bg-white rounded-xl border border-emerald-700/30 shadow-sm overflow-hidden">
        @forelse($products as $product)
            <div class="flex items-center justify-between p-4 border-b border-gray-100 hover:bg-emerald-50/50 transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center text-[#1B4D3E] font-bold text-xs shrink-0">
                        {{ strtoupper(substr($product->title, 0, 2)) }}
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-900">{{ $product->title }}</h4>
                        <p class="text-xs text-gray-500">
                            <span class="font-semibold text-[#1B4D3E]">${{ number_format($product->price, 2) }}</span> / {{ $product->unit }} 
                            <span class="mx-1">•</span> Stock: {{ $product->stock }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('products.show', $product->id) }}" class="text-xs bg-gray-100 text-gray-700 px-3 py-1.5 rounded-lg hover:bg-gray-200 transition font-medium">
                        Ver
                    </a>
                </div>
            </div>
        @empty
            <div class="p-12 text-center bg-gray-50">
                <p class="text-gray-500 text-sm">Aún no has publicado ningún producto.</p>
                <a href="{{ route('products.create') }}" class="inline-block mt-3 text-xs text-[#1B4D3E] font-bold hover:underline">
                    Publicar mi primer producto →
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection