@extends('layouts.app')

@section('title', 'Agroshare - Mis Productos')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- Encabezado con Botón de Acción -->
    <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-lg md:text-xl font-bold text-[#1B4D3E]">Mis Productos</h2>
            <p class="text-xs text-gray-500 mt-1">Gestiona de forma segura los artículos y cosechas que has publicado en la plataforma.</p>
        </div>
        <a href="{{ route('products.create') }}" class="w-full sm:w-auto text-center px-5 py-2.5 bg-[#1B4D3E] hover:bg-[#14382c] text-white text-xs font-bold rounded-xl shadow-sm transition tracking-wide">
            + Nuevo Producto
        </a>
    </div>

    <!-- Mensaje de Éxito o Alerta si existe en la sesión -->
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-[#1B4D3E] text-xs font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Listado de Productos -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden divide-y divide-gray-100">
        @forelse($products as $product)
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 sm:p-5 hover:bg-emerald-50/30 transition gap-4">
                
                <!-- Información Principal del Producto -->
                <div class="flex items-center gap-4 w-full sm:w-auto">
                    @if(!empty($product->image))
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-14 h-14 object-cover rounded-xl border border-gray-200 shrink-0">
                    @else
                        <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center text-[#1B4D3E] font-bold text-sm shrink-0">
                            {{ strtoupper(substr($product->title, 0, 2)) }}
                        </div>
                    @endif
                    <div class="space-y-1">
                        <h4 class="text-sm font-bold text-gray-900 leading-tight">{{ $product->title }}</h4>
                        <p class="text-xs text-gray-500">
                            <span class="font-bold text-[#1B4D3E]">${{ number_format($product->price, 2) }}</span> / {{ $product->unit }} 
                            <span class="mx-1.5 text-gray-300">•</span> Stock: <span class="font-medium text-gray-700">{{ $product->stock }}</span>
                        </p>
                        @if(!empty($product->location))
                            <p class="text-[10px] text-gray-400">📍 {{ $product->location }}, Nicaragua</p>
                        @endif
                    </div>
                </div>

                <!-- Botones de Acción (Ver, Editar, Eliminar) -->
                <div class="flex items-center gap-2 w-full sm:w-auto justify-end pt-2 sm:pt-0 border-t sm:border-t-0 border-gray-100">
                    <a href="{{ route('products.show', $product->id) }}" class="px-3.5 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition">
                        Ver
                    </a>
                    <a href="{{ route('products.edit', $product->id) }}" class="px-3.5 py-1.5 bg-emerald-100 hover:bg-emerald-200 text-[#1B4D3E] text-xs font-bold rounded-xl transition">
                        Editar
                    </a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto de forma permanente?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold rounded-xl transition">
                            Eliminar
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div class="p-12 text-center bg-gray-50/50">
                <div class="max-w-xs mx-auto space-y-3">
                    <div class="w-12 h-12 bg-emerald-100 text-[#1B4D3E] rounded-full flex items-center justify-center mx-auto font-bold text-lg">🌾</div>
                    <p class="text-gray-600 text-xs font-medium">Aún no has registrado ninguna cosecha o producto en el sistema.</p>
                    <a href="{{ route('products.create') }}" class="inline-block text-xs text-[#1B4D3E] font-bold hover:underline">
                        Publicar mi primer producto →
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection