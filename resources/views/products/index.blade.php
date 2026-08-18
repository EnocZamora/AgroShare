@extends('layouts.app')

@section('title', 'Agroshare - Catálogo de Productos')

@section('content')
<div class="space-y-6">
    
    <!-- Banner de Bienvenida Institucional -->
    <div class="bg-[#1B4D3E] text-white p-6 md:p-8 rounded-xl shadow-sm flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold">Plataforma de Comercio Agropecuario</h2>
            <p class="text-emerald-100 text-sm mt-1">Conectando la producción nacional directamente con el mercado.</p>
        </div>
        <a href="{{ route('products.create') }}" class="bg-white text-[#1B4D3E] px-4 py-2 rounded-lg font-bold text-sm shadow-sm hover:bg-emerald-50 transition">
            Publicar producto
        </a>
    </div>

    <!-- Listado Dinámico de Productos Reales -->
    <section>
        <div class="mb-3 flex justify-between items-center">
            <h3 class="font-bold text-[#1B4D3E] text-base">Productos disponibles</h3>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($products as $product)
                <div class="bg-white p-4 rounded-xl border border-emerald-700/30 flex flex-col justify-between shadow-sm">
                    <div>
                        <div class="flex justify-between items-start">
                            <span class="text-[10px] bg-emerald-100 text-[#1B4D3E] px-2 py-0.5 rounded font-semibold">
                                {{ $product->category->name ?? 'Sin categoría' }}
                            </span>
                            <span class="text-xs text-gray-400">Por: {{ $product->user->name ?? 'Productor' }}</span>
                        </div>
                        <h4 class="font-bold text-sm text-gray-900 mt-2">{{ $product->title }}</h4>
                        <p class="text-xs text-gray-600 mt-1 line-clamp-2">{{ $product->description }}</p>
                    </div>
                    
                    <div class="mt-4 pt-3 border-t border-gray-100 flex justify-between items-center">
                        <div>
                            <span class="text-xs text-gray-400 block">Precio</span>
                            <span class="text-sm font-bold text-[#1B4D3E]">C$ {{ number_format($product->price, 2) }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-gray-400 block">Disponible</span>
                            <span class="text-xs font-semibold text-gray-700">{{ $product->stock }} {{ $product->unit }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-gray-50 rounded-xl border border-dashed border-gray-300">
                    <p class="text-gray-500 text-sm">No hay productos registrados en el sistema actualmente.</p>
                </div>
            @endforelse
        </div>
    </section>

</div>
@endsection