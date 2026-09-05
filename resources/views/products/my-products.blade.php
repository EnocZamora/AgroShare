@extends('layouts.app')

@section('title', __('messages.my_products_title'))

@section('content')
<div class="max-w-md mx-auto space-y-5 pb-20 px-3 pt-2">
    
    <!-- Encabezado Superior con Botón de Retroceso -->
    <div class="flex items-center justify-between gap-3 bg-[#1B4D3E] text-white p-3.5 rounded-2xl shadow-sm">
        <a href="{{ route('products.index') }}" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 active:scale-95 flex items-center justify-center shrink-0 transition" title="Volver al catálogo">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-base font-bold tracking-wide truncate flex-1 text-center pr-10">
            {{ __('messages.my_products_title') }}
        </h2>
    </div>

    <!-- Pestañas de Estado Dinámicas -->
    @php
        $currentTab = $tab ?? request('tab', 'activas');
    @endphp
    <div class="flex justify-around border-b border-slate-200 pb-1 text-xs font-bold text-slate-500">
        <a href="{{ route('products.my-products', ['tab' => 'activas']) }}" 
           class="pb-2.5 relative transition {{ $currentTab == 'activas' ? 'text-[#1B4D3E] border-b-2 border-[#1B4D3E]' : 'hover:text-slate-800' }}">
            {{ __('messages.my_products_tab_active') }}
        </a>
        <a href="{{ route('products.my-products', ['tab' => 'finalizadas']) }}" 
           class="pb-2.5 relative transition {{ $currentTab == 'finalizadas' ? 'text-[#1B4D3E] border-b-2 border-[#1B4D3E]' : 'hover:text-slate-800' }}">
            {{ __('messages.my_products_tab_finished') }}
        </a>
        <a href="{{ route('products.my-products', ['tab' => 'incompletas']) }}" 
           class="pb-2.5 relative transition {{ $currentTab == 'incompletas' ? 'text-[#1B4D3E] border-b-2 border-[#1B4D3E]' : 'hover:text-slate-800' }}">
            {{ __('messages.my_products_tab_incomplete') }}
        </a>
    </div>

    <!-- Mensaje de Éxito -->
    @if(session('success'))
        <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-2xl text-[#1B4D3E] text-xs font-semibold flex items-center gap-2">
            <svg class="w-4 h-4 shrink-0 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Listado de Tarjetas de Productos -->
    <div class="space-y-3.5">
        @forelse($products as $product)
            <div class="bg-[#1B4D3E] text-white p-4 rounded-2xl shadow-sm flex items-center justify-between gap-3 relative">
                
                <!-- Imagen y Detalles del Producto -->
                <div class="flex items-center gap-3 min-w-0 flex-1">
                    @if(!empty($product->image))
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-14 h-14 object-cover rounded-xl border border-emerald-600/80 shrink-0">
                    @else
                        <div class="w-14 h-14 bg-emerald-800/90 rounded-xl flex items-center justify-center text-white font-bold text-sm shrink-0 border border-emerald-600/80">
                            {{ strtoupper(substr($product->title, 0, 2)) }}
                        </div>
                    @endif

                    <div class="min-w-0 space-y-0.5">
                        <h4 class="text-sm font-bold text-white truncate leading-snug">{{ $product->title }}</h4>
                        <p class="text-xs text-emerald-100 font-semibold truncate">
                            C$ {{ number_format($product->price, 2) }} {{ __('messages.product_show_price_unit', ['unit' => $product->unit]) }}
                        </p>
                        <p class="text-[11px] text-emerald-200/90 truncate">
                            {{ $product->stock }} {{ $product->unit }}
                        </p>
                        @if($product->created_at)
                            <p class="text-[10px] text-emerald-300/80 truncate">
                                {{ __('messages.my_products_available_since', ['date' => $product->created_at->format('d/m/Y')]) }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Estado y Acciones Rápidas -->
                <div class="flex flex-col items-end justify-between self-stretch shrink-0 gap-2">
                    @php
                        $status = $product->status ?? 'activo';
                    @endphp
                    <span class="px-2 py-0.5 text-[9px] font-bold rounded-md uppercase tracking-wider 
                        {{ $status == 'activo' ? 'bg-emerald-600 text-white' : '' }}
                        {{ $status == 'finalizado' ? 'bg-rose-600 text-white' : '' }}
                        {{ $status == 'incompleto' ? 'bg-amber-600 text-white' : 'bg-emerald-600 text-white' }}">
                        @if($status == 'activo')
                            {{ __('messages.my_products_status_active') }}
                        @elseif($status == 'finalizado')
                            {{ __('messages.my_products_status_finished') }}
                        @elseif($status == 'incompleto')
                            {{ __('messages.my_products_status_incomplete') }}
                        @endif
                    </span>

                    <!-- Botones de Cambio de Estado y Edición -->
                    <div class="flex flex-col items-end gap-1.5">
                        <div class="flex items-center gap-1">
                            @if($status === 'activo')
                                <form action="{{ route('products.update-status', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="finalizado">
                                    <button type="submit" class="text-[10px] bg-rose-600 hover:bg-rose-700 text-white px-2.5 py-1 rounded-lg transition font-bold cursor-pointer active:scale-95">
                                        {{ __('messages.my_products_button_finish') }}
                                    </button>
                                </form>
                                <form action="{{ route('products.update-status', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="incompleto">
                                    <button type="submit" class="text-[10px] bg-amber-600 hover:bg-amber-700 text-white px-2.5 py-1 rounded-lg transition font-bold cursor-pointer active:scale-95">
                                        {{ __('messages.my_products_button_incomplete') }}
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('products.update-status', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="activo">
                                    <button type="submit" class="text-[10px] bg-emerald-600 hover:bg-emerald-700 text-white px-2.5 py-1 rounded-lg transition font-bold cursor-pointer active:scale-95">
                                        {{ __('messages.my_products_button_activate') }}
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('products.show', $product->id) }}" class="text-[10px] bg-white/15 hover:bg-white/25 text-white px-2.5 py-1 rounded-lg transition font-semibold">
                                {{ __('messages.my_products_button_view') }}
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="text-[10px] bg-white text-[#1B4D3E] px-2.5 py-1 rounded-lg hover:bg-emerald-50 transition font-bold">
                                {{ __('messages.my_products_button_edit') }}
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        @empty
            <div class="p-8 text-center bg-white rounded-2xl border border-slate-200 shadow-xs">
                <p class="text-slate-500 text-xs font-medium">{{ __('messages.my_products_empty') }}</p>
            </div>
        @endforelse
    </div>

    <!-- Bloque de Consejo Institucional -->
    <div class="bg-[#1B4D3E] text-white p-4 rounded-2xl shadow-xs text-center space-y-1 mt-6">
        <h4 class="text-xs font-bold tracking-wide text-emerald-200">{{ __('messages.my_products_advice_title') }}</h4>
        <p class="text-[11px] text-emerald-50 leading-relaxed max-w-xs mx-auto">
            {{ __('messages.my_products_advice_text') }}
        </p>
    </div>

    <!-- Botón Inferior -->
    <div>
        <a href="{{ route('products.create') }}" class="block w-full min-h-[44px] py-3 bg-[#1B4D3E] hover:bg-[#14382c] text-white text-xs font-bold rounded-2xl text-center shadow-sm transition active:scale-[0.99] tracking-wide">
            {{ __('messages.my_products_new_button') }}
        </a>
    </div>

</div>
@endsection