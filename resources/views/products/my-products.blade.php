@extends('layouts.app')

@section('title', 'Agroshare - Mis Publicaciones')

@section('content')
<div class="max-w-md mx-auto space-y-6 pb-16">
    
    <!-- Encabezado Superior -->
    <div class="bg-[#1B4D3E] text-white py-4 px-6 rounded-2xl shadow-sm text-center">
        <h2 class="text-base font-bold tracking-wide">Mis publicaciones</h2>
    </div>

    <!-- Pestañas de Estado Dinámicas -->
    @php
        $currentTab = $tab ?? request('tab', 'activas');
    @endphp
    <div class="flex justify-around border-b border-gray-200 pb-2 text-xs font-bold text-gray-500">
        <a href="{{ route('products.my-products', ['tab' => 'activas']) }}" 
           class="pb-2 relative {{ $currentTab == 'activas' ? 'text-[#1B4D3E] border-b-2 border-[#1B4D3E]' : 'hover:text-gray-800' }}">
            Activas
        </a>
        <a href="{{ route('products.my-products', ['tab' => 'finalizadas']) }}" 
           class="pb-2 relative {{ $currentTab == 'finalizadas' ? 'text-[#1B4D3E] border-b-2 border-[#1B4D3E]' : 'hover:text-gray-800' }}">
            Finalizadas
        </a>
        <a href="{{ route('products.my-products', ['tab' => 'incompletas']) }}" 
           class="pb-2 relative {{ $currentTab == 'incompletas' ? 'text-[#1B4D3E] border-b-2 border-[#1B4D3E]' : 'hover:text-gray-800' }}">
            Incompletas
        </a>
    </div>

    <!-- Mensaje de Éxito -->
    @if(session('success'))
        <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-xl text-[#1B4D3E] text-xs font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Listado de Tarjetas de Productos -->
    <div class="space-y-4">
        @forelse($products as $product)
            <div class="bg-[#1B4D3E] text-white p-4 rounded-2xl shadow-md flex items-center justify-between gap-3 relative">
                
                <!-- Imagen y Detalles del Producto -->
                <div class="flex items-center gap-3.5">
                    @if(!empty($product->image))
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-16 h-16 object-cover rounded-xl border border-emerald-600 shrink-0">
                    @else
                        <div class="w-16 h-16 bg-emerald-800 rounded-xl flex items-center justify-center text-white font-bold text-sm shrink-0 border border-emerald-600">
                            {{ strtoupper(substr($product->title, 0, 2)) }}
                        </div>
                    @endif

                    <div class="space-y-1">
                        <h4 class="text-sm font-bold text-white leading-tight">{{ $product->title }}</h4>
                        <p class="text-xs text-emerald-100 font-medium">
                            C$ {{ number_format($product->price, 2) }} por {{ $product->unit }}
                        </p>
                        <p class="text-[11px] text-emerald-200/90">
                            {{ $product->stock }} {{ $product->unit }} disponibles
                        </p>
                        @if(!empty($product->created_at))
                            <p class="text-[10px] text-emerald-300/80">
                                Disponible desde el {{ $product->created_at->format('d/m/Y') }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Estado y Acciones Rápidas -->
                <div class="flex flex-col items-end justify-between h-full min-h-[85px] gap-2">
                    @php
                        $status = $product->status ?? 'activo';
                    @endphp
                    <span class="px-2 py-0.5 text-[9px] font-bold rounded-md uppercase tracking-wider 
                        {{ $status == 'activo' ? 'bg-emerald-600 text-white' : '' }}
                        {{ $status == 'finalizado' ? 'bg-red-600 text-white' : '' }}
                        {{ $status == 'incompleto' ? 'bg-amber-600 text-white' : 'bg-emerald-600 text-white' }}">
                        {{ ucfirst($status) }}
                    </span>

                    <!-- Botones de Cambio de Estado y Edición -->
                    <div class="flex flex-col items-end gap-1.5">
                        <div class="flex items-center gap-1">
                            @if($status === 'activo')
                                <form action="{{ route('products.update-status', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="finalizado">
                                    <button type="submit" class="text-[9px] bg-red-600 hover:bg-red-700 text-white px-2 py-0.5 rounded transition font-bold">
                                        Finalizar
                                    </button>
                                </form>
                                <form action="{{ route('products.update-status', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="incompleto">
                                    <button type="submit" class="text-[9px] bg-amber-600 hover:bg-amber-700 text-white px-2 py-0.5 rounded transition font-bold">
                                        Incompleto
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('products.update-status', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="activo">
                                    <button type="submit" class="text-[9px] bg-emerald-600 hover:bg-emerald-700 text-white px-2 py-0.5 rounded transition font-bold">
                                        Activar
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('products.show', $product->id) }}" class="text-[10px] bg-white/10 hover:bg-white/20 text-white px-2 py-1 rounded-lg transition font-medium">
                                Ver
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="text-[10px] bg-white text-[#1B4D3E] px-2 py-1 rounded-lg hover:bg-emerald-50 transition font-bold">
                                Editar
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        @empty
            <div class="p-10 text-center bg-white rounded-2xl border border-gray-200 shadow-sm">
                <p class="text-gray-500 text-xs">No hay publicaciones en esta sección.</p>
            </div>
        @endforelse
    </div>

    <!-- Bloque de Consejo Institucional -->
    <div class="bg-[#1B4D3E] text-white p-5 rounded-2xl shadow-sm text-center space-y-1.5 mt-8">
        <h4 class="text-xs font-bold tracking-wide text-emerald-200">Consejo</h4>
        <p class="text-xs text-emerald-50 leading-relaxed max-w-xs mx-auto">
            Investiga precios similares para que tu producto sea competitivo y personalmente apto.
        </p>
    </div>

    <!-- Botón Inferior -->
    <div>
        <a href="{{ route('products.create') }}" class="block w-full py-3 bg-[#1B4D3E] hover:bg-[#14382c] text-white text-xs font-bold rounded-xl text-center shadow-md transition tracking-wide">
            Publicar nuevo producto
        </a>
    </div>

</div>
@endsection