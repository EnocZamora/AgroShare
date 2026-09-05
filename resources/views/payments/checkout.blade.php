@extends('layouts.app')

@section('title', __('messages.checkout_title'))

@section('content')
<div class="max-w-md mx-auto w-full min-h-screen px-4 pb-24 overflow-x-hidden space-y-4 pt-1">

    <!-- Encabezado superior con botón de retroceso y selector de idioma -->
    <div class="flex items-center justify-between py-1.5 gap-2">
        <div class="flex items-center gap-2.5 min-w-0">
            <a href="{{ url()->previous(route('payments.methods')) }}" class="min-w-[48px] min-h-[48px] rounded-2xl bg-white border border-slate-200/80 text-[#1B4D3E] hover:bg-emerald-50 active:scale-95 flex items-center justify-center shrink-0 shadow-xs transition" title="{{ __('messages.checkout_back') }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="min-w-0">
                <h1 class="text-lg font-bold text-[#1B4D3E] tracking-tight truncate">{{ __('messages.checkout_title') }}</h1>
                <p class="text-[11px] text-slate-500 font-medium truncate">{{ __('messages.checkout_subtitle') }}</p>
            </div>
        </div>

        <!-- Selector de idioma compacto -->
        <div class="flex items-center gap-1 shrink-0">
            <form action="{{ route('lang.switch', 'es') }}" method="GET" class="inline">
                <button type="submit" class="min-h-[36px] px-2.5 py-1 text-xs font-bold rounded-xl border {{ session('locale', 'es') === 'es' ? 'bg-[#1B4D3E] text-white border-[#1B4D3E]' : 'bg-white border-slate-200 text-slate-600 hover:border-emerald-300' }} transition">
                    ES
                </button>
            </form>
            <form action="{{ route('lang.switch', 'mi') }}" method="GET" class="inline">
                <button type="submit" class="min-h-[36px] px-2.5 py-1 text-xs font-bold rounded-xl border {{ session('locale') === 'mi' ? 'bg-[#1B4D3E] text-white border-[#1B4D3E]' : 'bg-white border-slate-200 text-slate-600 hover:border-emerald-300' }} transition">
                    MI
                </button>
            </form>
            <form action="{{ route('lang.switch', 'cr') }}" method="GET" class="inline">
                <button type="submit" class="min-h-[36px] px-2.5 py-1 text-xs font-bold rounded-xl border {{ session('locale') === 'cr' ? 'bg-[#1B4D3E] text-white border-[#1B4D3E]' : 'bg-white border-slate-200 text-slate-600 hover:border-emerald-300' }} transition">
                    CR
                </button>
            </form>
        </div>
    </div>

    @if(session('order_success'))
        <!-- Tarjeta de Confirmación de Compra Exitosa Móvil -->
        <div class="bg-white border-2 border-emerald-500 rounded-2xl p-5 shadow-sm space-y-4 text-center">
            <div class="w-16 h-16 rounded-full bg-emerald-100 text-[#1B4D3E] flex items-center justify-center mx-auto border-2 border-emerald-500 shadow-sm animate-bounce">
                <svg class="w-9 h-9 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <div>
                <h2 class="text-base font-extrabold text-gray-900 tracking-tight">{{ __('messages.checkout_success_title') }}</h2>
                <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ __('messages.checkout_success_desc') }}</p>
            </div>

            <!-- Recibo compacto móvil -->
            <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3.5 text-xs space-y-2 text-left">
                <div class="flex justify-between items-center py-0.5 border-b border-slate-200/60 pb-1.5">
                    <span class="text-slate-500 font-medium">{{ __('messages.checkout_transaction_id') }}</span>
                    <span class="font-mono font-bold text-slate-800">{{ session('transaction_id') }}</span>
                </div>
                <div class="flex justify-between items-center py-0.5 border-b border-slate-200/60 pb-1.5">
                    <span class="text-slate-500 font-medium">{{ __('messages.checkout_payment_method') }}</span>
                    <span class="font-bold text-[#1B4D3E]">
                        @if(session('paid_method') === 'bac_lafise')
                            {{ __('messages.payment_method_bac_name') }}
                        @elseif(session('paid_method') === 'billetera_kash')
                            {{ __('messages.payment_method_kash_name') }}
                        @else
                            {{ __('messages.payment_method_cash_name') }}
                        @endif
                    </span>
                </div>
                <div class="flex justify-between items-center pt-1 text-sm font-extrabold">
                    <span class="text-slate-800">{{ __('messages.checkout_total') }}</span>
                    <span class="text-[#1B4D3E]">C$ {{ number_format(session('paid_amount', $totalCordobas), 2) }}</span>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="space-y-2 pt-1">
                @if(isset($product->user_id))
                    <form action="{{ route('chats.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="content" value="¡Hola! He confirmado el pago de tu producto {{ $product->title }} (Transacción {{ session('transaction_id') }}).">
                        <button type="submit" class="w-full min-h-[48px] bg-[#1B4D3E] hover:bg-[#14382c] text-white font-bold text-xs rounded-2xl flex items-center justify-center gap-2 shadow-xs transition active:scale-[0.99] cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            {{ __('messages.checkout_btn_view_chat') }}
                        </button>
                    </form>
                @endif
                <a href="{{ route('products.index') }}" class="w-full min-h-[48px] bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-2xl flex items-center justify-center gap-2 transition active:scale-[0.99]">
                    {{ __('messages.checkout_btn_catalog') }}
                </a>
            </div>
        </div>
    @else
        <!-- Formulario Principal de Checkout Móvil -->
        <form action="{{ route('payments.process') }}" method="POST" id="checkout-form" class="space-y-4">
            @csrf
            <input type="hidden" name="payment_method" id="selected-payment-method-input" value="{{ $selectedMethod->id }}">
            <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
            <input type="hidden" name="amount_cordobas" value="{{ $totalCordobas }}">

            <!-- 1. Tarjeta del Producto Adaptada a Móvil -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-xs space-y-3">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ __('messages.checkout_product_title') }}</span>
                    <span class="text-[10px] font-bold text-[#1B4D3E] bg-emerald-100 px-2.5 py-0.5 rounded-full border border-emerald-200 uppercase">
                        {{ (isset($product->category->name) && $product->category->name === 'Granos Básicos') ? __('messages.basic_grains') : ($product->category->name ?? __('messages.basic_grains')) }}
                    </span>
                </div>

                <div class="flex items-center gap-3.5">
                    <div class="w-16 h-16 rounded-2xl bg-emerald-50/70 border border-emerald-200/60 overflow-hidden flex items-center justify-center shrink-0">
                        @if(!empty($product->image))
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-2xl">🌾</span>
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="text-sm font-bold text-gray-900 leading-snug truncate">{{ $product->title }}</h3>
                        <p class="text-[11px] text-slate-500 font-medium truncate mt-0.5 flex items-center gap-1">
                            <span>📍 {{ $product->location ?? 'Nicaragua' }}</span>
                            <span>•</span>
                            <span class="truncate">{{ $product->user->name ?? __('messages.checkout_producer') }}</span>
                        </p>
                        <div class="mt-1 flex items-baseline gap-2">
                            <span class="text-xs font-bold text-slate-700">1 {{ $product->unit ?? __('messages.checkout_unit') }}</span>
                            <span class="text-xs font-extrabold text-[#1B4D3E]">C$ {{ number_format($totalCordobas, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Tarjeta Compacta de Método de Pago con Acordeón al Vuelo -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-xs space-y-3">
                <div class="flex items-center justify-between gap-2">
                    <!-- Información Compacta del Método Seleccionado -->
                    <div class="flex items-center gap-3 min-w-0">
                        <div id="compact-method-icon-box" class="w-11 h-11 rounded-2xl bg-emerald-50 text-[#1B4D3E] border border-emerald-600/20 flex items-center justify-center shrink-0">
                            @if($selectedMethod->icon === 'bank')
                                <svg class="w-5 h-5 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M3 10h18M5 10v11M9 10v11M15 10v11M19 10v11M12 3l9 7H3l9-7z"/>
                                </svg>
                            @elseif($selectedMethod->icon === 'mobile')
                                <svg class="w-5 h-5 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <span class="text-[11px] text-slate-500 font-medium block truncate">{{ __('messages.checkout_payment_method') }}</span>
                            <span id="compact-method-name" class="text-xs font-extrabold text-gray-900 block truncate leading-tight">{{ $selectedMethod->name }}</span>
                            <span id="compact-method-provider" class="text-[10px] font-semibold text-[#1B4D3E] block truncate">{{ $selectedMethod->provider }}</span>
                        </div>
                    </div>

                    <!-- Botón Sutil "Cambiar" que Despliega el Acordeón -->
                    <button type="button" id="toggle-accordion-btn" class="min-h-[44px] px-3 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 text-[#1B4D3E] text-xs font-bold flex items-center gap-1.5 shrink-0 transition active:scale-95 cursor-pointer">
                        <span id="toggle-btn-label">{{ __('messages.checkout_change_method') }}</span>
                        <svg id="accordion-chevron" class="w-3.5 h-3.5 text-[#1B4D3E] transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </div>

                <!-- Acordeón Rápido en la Misma Pantalla (Sin recargar ni redirigir) -->
                <div id="methods-accordion" class="hidden pt-3 border-t border-slate-100 space-y-2.5 transition-all duration-300">
                    <p class="text-[11px] text-slate-500 font-medium flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ __('messages.checkout_method_instant_tip') }}</span>
                    </p>

                    <!-- Lista de opciones del Acordeón -->
                    <div class="space-y-2">
                        @foreach($allMethods as $methodOption)
                            @php
                                $isSelected = ($methodOption->id === $selectedMethod->id);
                            @endphp
                            <div
                                class="accordion-method-option min-h-[48px] rounded-2xl p-3 border cursor-pointer transition active:scale-[0.99] flex items-center justify-between gap-3 {{ $isSelected ? 'bg-emerald-50/70 border-2 border-emerald-600 active-option' : 'bg-white border-slate-200/90 hover:border-emerald-300' }}"
                                data-id="{{ $methodOption->id }}"
                                data-name="{{ $methodOption->name }}"
                                data-provider="{{ $methodOption->provider }}"
                                data-icon="{{ $methodOption->icon }}"
                            >
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-9 h-9 rounded-xl {{ $isSelected ? 'bg-emerald-100/90 text-[#1B4D3E]' : 'bg-slate-100 text-slate-600' }} flex items-center justify-center shrink-0">
                                        @if($methodOption->icon === 'bank')
                                            <svg class="w-4 h-4 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M3 10h18M5 10v11M9 10v11M15 10v11M19 10v11M12 3l9 7H3l9-7z"/>
                                            </svg>
                                        @elseif($methodOption->icon === 'mobile')
                                            <svg class="w-4 h-4 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-bold text-gray-900 truncate leading-snug">{{ $methodOption->name }}</p>
                                        <p class="text-[10px] text-slate-500 truncate">{{ $methodOption->provider }}</p>
                                    </div>
                                </div>

                                <!-- Radio/Check Indicator -->
                                <div class="option-check-indicator shrink-0">
                                    @if($isSelected)
                                        <div class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center shadow-xs">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-6 h-6 rounded-full border-2 border-slate-300 bg-white"></div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- 3. Resumen del Pedido Adaptado a Pantalla Móvil -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-xs space-y-2.5">
                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ __('messages.checkout_order_summary') }}</h3>

                <div class="flex justify-between items-center text-xs text-slate-600 py-0.5">
                    <span>{{ __('messages.checkout_subtotal') }}</span>
                    <span class="font-bold text-slate-900">C$ {{ number_format($totalCordobas, 2) }}</span>
                </div>

                <div class="flex justify-between items-center text-xs text-slate-600 py-0.5 border-b border-slate-100 pb-2">
                    <span class="flex items-center gap-1">
                        {{ __('messages.checkout_platform_fee') }}
                    </span>
                    <span class="bg-emerald-100 text-[#1B4D3E] text-[10px] font-extrabold px-2 py-0.5 rounded-full border border-emerald-200">
                        {{ __('messages.checkout_fee_free') }}
                    </span>
                </div>

                <!-- Total Destacado en C$ y USD -->
                <div class="flex justify-between items-baseline pt-1">
                    <div>
                        <span class="text-xs font-bold text-slate-900 block">{{ __('messages.checkout_total') }}</span>
                        <span class="text-[10px] text-slate-400 font-medium">TC: 1 USD ≈ {{ number_format($exchangeRate, 2) }} C$</span>
                    </div>
                    <div class="text-right">
                        <span class="text-lg font-extrabold text-[#1B4D3E] block leading-tight">C$ {{ number_format($totalCordobas, 2) }}</span>
                        <span class="text-xs font-bold text-slate-500">(${{ number_format($totalUSD, 2) }} USD)</span>
                    </div>
                </div>
            </div>

            <!-- 4. Sello de Seguridad Móvil -->
            <div class="bg-emerald-50/60 border border-emerald-600/30 rounded-2xl p-3.5 flex items-start gap-3 shadow-xs">
                <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 mt-0.5 shadow-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="text-xs font-bold text-emerald-950 leading-snug">{{ __('messages.checkout_security_title') }}</h4>
                    <p class="text-[10px] text-emerald-800 leading-tight mt-0.5 break-words">
                        {{ __('messages.checkout_security_desc') }}
                    </p>
                </div>
            </div>

            <!-- 5. Botón de Pago Destacado a lo Ancho (w-full py-3.5 min-h-[48px]) -->
            <div class="space-y-2 pt-1">
                <button type="submit" class="w-full min-h-[48px] py-3.5 px-4 bg-[#1B4D3E] hover:bg-[#14382c] active:scale-[0.99] text-white font-extrabold text-sm rounded-2xl shadow-md transition flex items-center justify-center gap-2 cursor-pointer">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span>{{ __('messages.checkout_pay_button') }} • C$ {{ number_format($totalCordobas, 2) }}</span>
                </button>

                <!-- Cancelar y volver -->
                <a href="{{ url()->previous(route('payments.methods')) }}" class="block text-center text-xs text-slate-500 hover:text-slate-800 font-medium py-1.5 transition">
                    {{ __('messages.checkout_cancel') }}
                </a>
            </div>
        </form>

        <!-- Script Mobile para alternar de método al vuelo con el Acordeón sin recargar -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toggleBtn = document.getElementById('toggle-accordion-btn');
                const accordion = document.getElementById('methods-accordion');
                const chevron = document.getElementById('accordion-chevron');
                const selectedInput = document.getElementById('selected-payment-method-input');
                const compactName = document.getElementById('compact-method-name');
                const compactProvider = document.getElementById('compact-method-provider');
                const compactIconBox = document.getElementById('compact-method-icon-box');
                const methodOptions = document.querySelectorAll('.accordion-method-option');

                // Toggle del Acordeón
                if (toggleBtn && accordion) {
                    toggleBtn.addEventListener('click', function () {
                        const isHidden = accordion.classList.contains('hidden');
                        if (isHidden) {
                            accordion.classList.remove('hidden');
                            chevron.classList.add('rotate-180');
                        } else {
                            accordion.classList.add('hidden');
                            chevron.classList.remove('rotate-180');
                        }
                    });
                }

                // Selección inmediata de método dentro del acordeón
                methodOptions.forEach(function (option) {
                    option.addEventListener('click', function () {
                        const methodId = this.getAttribute('data-id');
                        const methodName = this.getAttribute('data-name');
                        const methodProvider = this.getAttribute('data-provider');
                        const methodIcon = this.getAttribute('data-icon');

                        // Actualizar input oculto
                        selectedInput.value = methodId;

                        // Actualizar textos de la tarjeta compacta
                        compactName.textContent = methodName;
                        compactProvider.textContent = methodProvider;

                        // Actualizar icono de la tarjeta compacta
                        let iconSvg = '';
                        if (methodIcon === 'bank') {
                            iconSvg = '<svg class="w-5 h-5 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M3 10h18M5 10v11M9 10v11M15 10v11M19 10v11M12 3l9 7H3l9-7z"/></svg>';
                        } else if (methodIcon === 'mobile') {
                            iconSvg = '<svg class="w-5 h-5 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>';
                        } else {
                            iconSvg = '<svg class="w-5 h-5 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>';
                        }
                        compactIconBox.innerHTML = iconSvg;

                        // Actualizar estilos activos de las opciones del acordeón
                        methodOptions.forEach(function (opt) {
                            opt.classList.remove('bg-emerald-50/70', 'border-2', 'border-emerald-600', 'active-option');
                            opt.classList.add('bg-white', 'border-slate-200/90');
                            const indicator = opt.querySelector('.option-check-indicator');
                            if (indicator) {
                                indicator.innerHTML = '<div class="w-6 h-6 rounded-full border-2 border-slate-300 bg-white"></div>';
                            }
                        });

                        this.classList.remove('bg-white', 'border-slate-200/90');
                        this.classList.add('bg-emerald-50/70', 'border-2', 'border-emerald-600', 'active-option');
                        const activeIndicator = this.querySelector('.option-check-indicator');
                        if (activeIndicator) {
                            activeIndicator.innerHTML = '<div class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center shadow-xs"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div>';
                        }

                        // Cerrar acordeón suavemente tras seleccionar
                        setTimeout(function () {
                            accordion.classList.add('hidden');
                            chevron.classList.remove('rotate-180');
                        }, 220);

                        // Persistir como predeterminado en segundo plano (sin recargar)
                        fetch('{{ route("payments.default") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ method_id: methodId })
                        }).catch(function(err) {
                            console.log('Default updated in memory/session');
                        });
                    });
                });
            });
        </script>
    @endif


</div>
@endsection
