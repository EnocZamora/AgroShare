@extends('layouts.app')

@section('title', __('messages.account_title'))

@section('content')
<div class="max-w-md mx-auto space-y-5 pb-24 px-4 pt-2 bg-[#EAF5ED] min-h-screen">
    
    <!-- Encabezado superior con botón de retroceso y selector de idioma -->
    <div class="flex items-center justify-between py-2">
        <div class="flex items-center gap-3">
            <a href="{{ route('settings.index') }}" class="text-[#1B4D3E] hover:opacity-80">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-xl font-bold text-[#1B4D3E] tracking-tight">{{ __('messages.account_title') }}</h1>
        </div>
        <div class="flex items-center gap-2">
            <form action="{{ route('lang.switch', 'es') }}" method="GET" class="inline">
                <button type="submit" class="px-3 py-1.5 text-xs font-medium rounded-lg border {{ session('locale', 'es') === 'es' ? 'bg-emerald-100 border-emerald-300 text-emerald-800' : 'bg-white border-gray-200 text-gray-600 hover:border-emerald-300' }} transition">
                    ES
                </button>
            </form>
            <form action="{{ route('lang.switch', 'mi') }}" method="GET" class="inline">
                <button type="submit" class="px-3 py-1.5 text-xs font-medium rounded-lg border {{ session('locale') === 'mi' ? 'bg-emerald-100 border-emerald-300 text-emerald-800' : 'bg-white border-gray-200 text-gray-600 hover:border-emerald-300' }} transition">
                    MI
                </button>
            </form>
            <form action="{{ route('lang.switch', 'cr') }}" method="GET" class="inline">
                <button type="submit" class="px-3 py-1.5 text-xs font-medium rounded-lg border {{ session('locale') === 'cr' ? 'bg-emerald-100 border-emerald-300 text-emerald-800' : 'bg-white border-gray-200 text-gray-600 hover:border-emerald-300' }} transition">
                    CR
                </button>
            </form>
        </div>
    </div>

    <!-- Tarjeta Informativa Superior -->
    <div class="bg-white border border-emerald-900/10 p-3.5 rounded-2xl shadow-sm flex items-center gap-3">
        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center shrink-0 border border-emerald-700/20 p-1">
            <svg class="w-5 h-5 text-emerald-700" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 2a6 6 0 110 12 6 6 0 010-12z"/></svg>
        </div>
        <div>
            <h3 class="text-xs font-bold text-gray-900">{{ __('messages.account_info_title') }}</h3>
            <p class="text-[10px] text-gray-500 leading-tight mt-0.5">
                {{ __('messages.account_info_desc') }}
            </p>
        </div>
    </div>

    <!-- Sección de Información Personal -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-4 shadow-sm space-y-3">
        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('messages.account_personal_section') }}</h2>
        
        <div class="flex items-center gap-3 py-1 border-b border-gray-100 pb-3">
            <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 shrink-0">
                @if(Auth::user()->avatar ?? false)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-[#1B4D3E] text-white flex items-center justify-center font-bold text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[11px] text-gray-400 font-medium">{{ __('messages.account_username') }}</p>
                <p class="text-xs font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
            </div>
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <div class="flex items-center justify-between py-1 border-b border-gray-100 pb-2">
            <div>
                <p class="text-[11px] text-gray-400 font-medium">{{ __('messages.account_email') }}</p>
                <p class="text-xs font-bold text-gray-900">{{ Auth::user()->email }}</p>
            </div>
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <div class="flex items-center justify-between py-1 border-b border-gray-100 pb-2">
            <div>
                <p class="text-[11px] text-gray-400 font-medium">{{ __('messages.account_phone') }}</p>
                <p class="text-xs font-bold text-gray-900">{{ Auth::user()->phone ?? '+505 88445512' }}</p>
            </div>
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <div class="flex items-center justify-between py-1 border-b border-gray-100 pb-2">
            <div>
                <p class="text-[11px] text-gray-400 font-medium">{{ __('messages.account_registered') }}</p>
                <p class="text-xs font-bold text-gray-900">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
            </div>
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>

        <div class="flex items-center justify-between py-1">
            <div>
                <p class="text-[11px] text-gray-400 font-medium">{{ __('messages.account_type') }}</p>
                <p class="text-xs font-bold text-gray-900">{{ __('messages.account_type_producer') }}</p>
            </div>
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>
    </div>

    <!-- Sección de Información Comercial -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-4 shadow-sm space-y-3">
        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('messages.account_commercial_section') }}</h2>
        
        <div class="flex justify-between items-center py-1 border-b border-gray-100 pb-2 text-xs">
            <span class="text-gray-500">{{ __('messages.account_type') }}</span>
            <span class="font-bold text-gray-900">{{ __('messages.account_type_producer') }}</span>
        </div>
        <div class="flex justify-between items-center py-1 border-b border-gray-100 pb-2 text-xs">
            <span class="text-gray-500">{{ __('messages.account_farm_name') }}</span>
            <span class="font-bold text-gray-900">Finca las brisas</span>
        </div>
        <div class="flex justify-between items-center py-1 border-b border-gray-100 pb-2 text-xs">
            <span class="text-gray-500">{{ __('messages.account_department') }}</span>
            <span class="font-bold text-gray-900">Matagalpa</span>
        </div>
        <div class="flex justify-between items-center py-1 border-b border-gray-100 pb-2 text-xs">
            <span class="text-gray-500">{{ __('messages.account_community') }}</span>
            <span class="font-bold text-gray-900">Ciudad de Matagalpa</span>
        </div>
        <div class="flex justify-between items-center py-1 text-xs">
            <span class="text-gray-500">{{ __('messages.account_products_offered') }}</span>
            <span class="font-bold text-[#1B4D3E]">Café, Frijol, Guabas</span>
        </div>
    </div>

    <!-- Preferencias de la cuenta -->
    <div class="bg-white border border-emerald-900/10 rounded-2xl p-4 shadow-sm space-y-3">
        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('messages.account_preferences_section') }}</h2>
        
        <div class="flex justify-between items-center py-1 border-b border-gray-100 pb-2 text-xs">
            <span class="text-gray-500">{{ __('messages.account_language') }}</span>
            <span class="bg-[#1B4D3E] text-white px-3 py-1 rounded-full font-bold text-[10px]">Español</span>
        </div>
        <div class="flex justify-between items-center py-1 text-xs">
            <span class="text-gray-500">{{ __('messages.account_currency') }}</span>
            <span class="bg-[#1B4D3E] text-white px-3 py-1 rounded-full font-bold text-[10px]">{{ __('messages.account_currency_value') }}</span>
        </div>
    </div>

</div>
@endsection