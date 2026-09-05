@extends('layouts.app')

@section('title', __('messages.payments_title'))

@section('content')
<div class="max-w-md mx-auto w-full min-h-screen px-4 pb-24 overflow-x-hidden space-y-4 pt-1">

    <!-- Encabezado superior con botón de retroceso y selector de idioma -->
    <div class="flex items-center justify-between py-1.5 gap-2">
        <div class="flex items-center gap-2.5 min-w-0">
            <a href="{{ route('settings.index') }}" class="min-w-[48px] min-h-[48px] rounded-2xl bg-white border border-slate-200/80 text-[#1B4D3E] hover:bg-emerald-50 active:scale-95 flex items-center justify-center shrink-0 shadow-xs transition" title="{{ __('messages.payments_back_settings') }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="min-w-0">
                <h1 class="text-lg font-bold text-[#1B4D3E] tracking-tight truncate">{{ __('messages.payments_title') }}</h1>
                <p class="text-[11px] text-slate-500 font-medium truncate">{{ __('messages.payments_subtitle') }}</p>
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

    <!-- Mensajes de Estado Flash -->
    @if(session('success'))
        <div class="p-3.5 bg-emerald-50/90 border border-emerald-300 text-emerald-900 rounded-2xl text-xs font-medium flex items-center gap-2.5 shadow-xs animate-fade-in">
            <div class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <span class="break-words">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('info'))
        <div class="p-3.5 bg-slate-100 border border-slate-200 text-slate-700 rounded-2xl text-xs font-medium flex items-center gap-2.5 shadow-xs">
            <svg class="w-5 h-5 text-slate-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="break-words">{{ session('info') }}</span>
        </div>
    @endif

    <!-- Tarjeta Informativa Superior Móvil -->
    <div class="bg-white border border-emerald-900/10 p-4 rounded-2xl shadow-xs flex items-center gap-3.5">
        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center shrink-0 border border-emerald-700/20 text-[#1B4D3E]">
            <svg class="w-6 h-6 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
        </div>
        <div class="min-w-0">
            <h2 class="text-xs font-bold text-gray-900 leading-snug">{{ __('messages.payments_info_title') }}</h2>
            <p class="text-[11px] text-slate-600 leading-tight mt-0.5 break-words">
                {{ __('messages.payments_info_desc') }}
            </p>
        </div>
    </div>

    <!-- Acceso Directo a Confirmación de Compra (Checkout) -->
    <div class="bg-gradient-to-r from-emerald-50 to-slate-50 border border-emerald-700/20 rounded-2xl p-3.5 flex items-center justify-between gap-3 shadow-xs">
        <div class="min-w-0">
            <p class="text-xs font-bold text-[#1B4D3E]">{{ __('messages.checkout_title') }}</p>
            <p class="text-[11px] text-slate-600">{{ __('messages.checkout_subtitle') }}</p>
        </div>
        <a href="{{ route('payments.checkout') }}" class="min-h-[44px] px-3.5 py-2 bg-[#1B4D3E] hover:bg-[#14382c] text-white text-xs font-bold rounded-xl flex items-center gap-1.5 shrink-0 shadow-xs transition active:scale-95">
            <span>{{ __('messages.checkout_title') }}</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    <!-- Lista de Métodos de Pago con Selección Predeterminada -->
    <div class="space-y-3">
        <div class="flex items-center justify-between px-1">
            <h2 class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ __('messages.payments_active_section') }}</h2>
            <span class="text-[10px] font-bold bg-emerald-100 text-[#1B4D3E] px-2.5 py-0.5 rounded-full border border-emerald-200">
                {{ __('messages.payments_active_badge', ['count' => count($paymentMethods)]) }}
            </span>
        </div>

        @forelse($paymentMethods as $method)
            @php
                $isDefault = !empty($method->is_default);
            @endphp
            <div class="rounded-2xl p-4 shadow-xs space-y-3 transition-all duration-200 {{ $isDefault ? 'bg-emerald-50/60 border-2 border-emerald-600' : 'bg-white border border-slate-200/90 hover:border-emerald-300' }}">

                <!-- Cabecera del Método -->
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-12 h-12 {{ $isDefault ? 'bg-emerald-100/80 text-[#1B4D3E] border border-emerald-600/30' : 'bg-slate-100 text-slate-700 border border-slate-200' }} rounded-2xl flex items-center justify-center shrink-0">
                            @if(isset($method->icon) && $method->icon === 'bank')
                                <svg class="w-6 h-6 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M3 10h18M5 10v11M9 10v11M15 10v11M19 10v11M12 3l9 7H3l9-7z"/>
                                </svg>
                            @elseif(isset($method->icon) && $method->icon === 'mobile')
                                <svg class="w-6 h-6 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            @elseif(isset($method->icon) && $method->icon === 'cash')
                                <svg class="w-6 h-6 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-sm font-bold text-gray-900 leading-snug truncate">{{ $method->name ?? $method->type }}</h3>
                            <p class="text-[11px] font-semibold text-[#1B4D3E] truncate">{{ $method->provider ?? 'Nicaragua' }}</p>
                        </div>
                    </div>

                    <!-- Badge de Predeterminado o Tipo -->
                    <div class="shrink-0 flex items-center gap-1.5">
                        @if($isDefault)
                            <span class="inline-flex items-center gap-1 bg-emerald-600 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full shadow-xs">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ __('messages.payments_default') }}
                            </span>
                        @elseif(!empty($method->badge))
                            <span class="bg-slate-100 text-slate-700 text-[10px] font-bold px-2.5 py-0.5 rounded-full border border-slate-200">
                                {{ $method->badge }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Descripción del método -->
                @if(!empty($method->description))
                    <p class="text-xs text-slate-600 leading-relaxed break-words">
                        {{ $method->description }}
                    </p>
                @endif

                <!-- Detalle técnico -->
                @if(!empty($method->details))
                    <div class="bg-white/80 border border-slate-200/70 rounded-xl p-2.5 flex items-start gap-2">
                        <svg class="w-4 h-4 text-[#1B4D3E] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-[11px] text-slate-600 leading-tight break-words">
                            {{ $method->details }}
                        </p>
                    </div>
                @endif

                <!-- Feedback Visual y Zona Táctil Accesible (min-h-[48px]) -->
                <div class="pt-1">
                    @if($isDefault)
                        <div class="w-full min-h-[48px] rounded-2xl bg-emerald-600/10 border border-emerald-500/30 text-emerald-900 font-bold text-xs flex items-center justify-between px-4">
                            <span class="inline-flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-600 animate-pulse"></span>
                                {{ __('messages.payments_default_selected') }}
                            </span>
                            <div class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('payments.default') }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="method_id" value="{{ $method->id }}">
                            <button type="submit" class="w-full min-h-[48px] rounded-2xl border border-slate-300 bg-white hover:bg-emerald-50 hover:border-emerald-500 text-slate-700 hover:text-[#1B4D3E] font-bold text-xs flex items-center justify-between px-4 shadow-xs transition active:scale-[0.99] cursor-pointer">
                                <span class="inline-flex items-center gap-2">
                                    <span class="w-4 h-4 rounded-full border-2 border-slate-300"></span>
                                    {{ __('messages.payments_set_default') }}
                                </span>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-[#1B4D3E]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </form>
                    @endif
                </div>

                <!-- Footer del método -->
                <div class="pt-1.5 flex items-center justify-between text-[11px] border-t border-slate-200/60">
                    <span class="inline-flex items-center gap-1.5 text-emerald-700 font-medium">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        {{ __('messages.payments_enabled_trans') }}
                    </span>
                    <span class="text-slate-400 font-medium">{{ __('messages.payments_scope_national') }}</span>
                </div>
            </div>
        @empty
            <div class="bg-white p-8 rounded-2xl shadow-xs border border-emerald-900/10 text-center space-y-3">
                <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mx-auto text-emerald-700">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <p class="text-slate-500 text-sm font-medium">{{ __('messages.payments_empty') }}</p>
            </div>
        @endforelse
    </div>

    <!-- Políticas de Transacción -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-4 shadow-xs space-y-2.5">
        <h2 class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ __('messages.payments_policies_title') }}</h2>

        <div class="flex justify-between items-center py-1 border-b border-slate-100 text-xs">
            <span class="text-slate-500">{{ __('messages.payments_currency_label') }}</span>
            <span class="font-bold text-slate-900">{{ __('messages.payments_currency_value') }}</span>
        </div>
        <div class="flex justify-between items-center py-1 border-b border-slate-100 text-xs">
            <span class="text-slate-500">{{ __('messages.payments_commission_label') }}</span>
            <span class="bg-[#1B4D3E] text-white px-2.5 py-0.5 rounded-full font-bold text-[10px]">{{ __('messages.payments_commission_free') }}</span>
        </div>
        <div class="flex justify-between items-center py-1 border-b border-slate-100 text-xs">
            <span class="text-slate-500">{{ __('messages.payments_security_label') }}</span>
            <span class="font-bold text-emerald-700">{{ __('messages.payments_security_value') }}</span>
        </div>
        <div class="flex justify-between items-center py-1 text-xs">
            <span class="text-slate-500">{{ __('messages.payments_coverage_label') }}</span>
            <span class="font-bold text-slate-900">{{ __('messages.payments_coverage_value') }}</span>
        </div>
    </div>

    <!-- Botón Volver a Configuración con min-h-[48px] -->
    <div class="pt-2">
        <a href="{{ route('settings.index') }}" class="w-full min-h-[48px] bg-white border border-slate-200/90 hover:border-emerald-700/40 text-[#1B4D3E] font-bold py-3 px-4 rounded-2xl shadow-xs text-center flex items-center justify-center gap-2 text-xs transition active:scale-[0.99]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            {{ __('messages.payments_back_settings') }}
        </a>
    </div>

</div>
@endsection
